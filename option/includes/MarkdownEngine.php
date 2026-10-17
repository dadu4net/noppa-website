<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Markdown Section Engine
 * Standardized according to all Noppa skills:
 * - noppa-website-content
 * - noppa-website-diensten-cards
 * - noppa-website-hero
 * - noppa-website-cta
 * - noppa-website-table
 * - noppa-website-icons
 * - noppa-website-kennisbank
 * - noppa-website-wcag
 * =========================================================================
 */

require_once __DIR__ . '/Parsedown.php';

class MarkdownEngine {
    private Parsedown $parsedown;
    private string $contentDir;
    private string $iconsDir;

    public function __construct(string $contentDir = '', string $iconsDir = '') {
        $this->contentDir = rtrim($contentDir ?: dirname(__DIR__) . '/content', '/\\') . '/';
        $this->iconsDir   = rtrim($iconsDir ?: dirname(__DIR__) . '/assets/icons', '/\\') . '/';
        $this->parsedown  = new Parsedown();
        $this->parsedown->setSafeMode(false); // Trusted internal markdown
    }

    /**
     * Laad een pagina op basis van slug (bijv. 'home', 'diensten', 'over-ons').
     */
    public function loadPage(string $slug): ?array {
        $cleanSlug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $filePath = $this->contentDir . 'pages/' . $cleanSlug . '.md';

        if (!file_exists($filePath)) {
            return null;
        }

        $raw = file_get_contents($filePath);
        return $this->parseDocument($raw, $cleanSlug);
    }

    /**
     * Parseer een compleet Markdown document met YAML frontmatter en secties.
     */
    public function parseDocument(string $raw, string $slug = ''): array {
        // 1. Extraheer YAML frontmatter
        $meta = [];
        $body = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
            $meta = $this->parseYaml($matches[1]);
            $body = $matches[2];
        }

        // Automatische fallbacks
        if (empty($meta['title'])) {
            $meta['title'] = $this->extractH1($body) ?? ucwords(str_replace(['-', '_'], ' ', $slug));
        }
        if (empty($meta['description'])) {
            $meta['description'] = $this->extractExcerpt($body);
        }

        // 2. Extraheer en structureer secties
        $sections = $this->parseSections($body, $meta);

        // 3. Bouw eventuele Table of Contents (TOC) op
        $toc = $this->buildToc($body);

        return [
            'meta'     => $meta,
            'sections' => $sections,
            'toc'      => $toc,
            'raw_body' => $body
        ];
    }

    /**
     * Parseer secties gemarkeerd via:
     * <!-- section: [id] type="[type]" ... -->
     * of
     * <!-- section: [id] -->
     */
    public function parseSections(string $body, array $pageMeta = []): array {
        // Controleer of de auteur sectie-tags gebruikt heeft
        $pattern = '/<!--\s*section:\s*([a-zA-Z0-9_-]+)(.*?)\s*-->/i';

        if (!preg_match_all($pattern, $body, $matches, PREG_OFFSET_CAPTURE)) {
            // Geen expliciete sectietags: behandel hele body als 1 hoofdcontent sectie
            return [
                [
                    'id'      => 'content',
                    'type'    => 'content',
                    'attrs'   => [],
                    'raw'     => trim($body),
                    'html'    => $this->renderProse(trim($body))
                ]
            ];
        }

        $sections = [];
        $totalMatches = count($matches[0]);

        for ($i = 0; $i < $totalMatches; $i++) {
            $id = trim($matches[1][$i][0]);
            $rawAttrs = trim($matches[2][$i][0]);
            $attrs = $this->parseAttributes($rawAttrs);

            $startIndex = $matches[0][$i][1] + strlen($matches[0][$i][0]);
            $endIndex = ($i + 1 < $totalMatches) ? $matches[0][$i + 1][1] : strlen($body);

            $sectionContent = trim(substr($body, $startIndex, $endIndex - $startIndex));
            $type = $attrs['type'] ?? $id;

            $renderedHtml = $this->renderSectionByType($type, $sectionContent, $attrs, $pageMeta);

            $sections[] = [
                'id'      => $id,
                'type'    => $type,
                'attrs'   => $attrs,
                'raw'     => $sectionContent,
                'html'    => $renderedHtml
            ];
        }

        return $sections;
    }

    /**
     * Render specifieke Noppa sectietypes (hero, cards, pijlers, stats, cta, content).
     */
    private function renderSectionByType(string $type, string $raw, array $attrs, array $pageMeta): string {
        switch ($type) {
            case 'cards':
            case 'diensten':
                return $this->renderCardsSection($raw, $attrs);

            case 'pijlers':
            case 'values':
                return $this->renderValuesSection($raw, $attrs);

            case 'stats':
                return $this->renderStatsSection($raw, $attrs);

            case 'cta':
                return $this->renderCtaSection($raw, $attrs);

            case 'hero':
                return $this->renderHeroSection($raw, $attrs, $pageMeta);

            case 'content':
            default:
                return $this->renderProse($raw, $attrs);
        }
    }

    /**
     * Render Dienst/Feature Kaarten volgens noppa-website-diensten-cards & noppa-ux-ui.
     */
    public function renderCardsSection(string $markdown, array $attrs = []): string {
        // Splits kaarten op H2 of H3
        $chunks = preg_split('/(?=^#{2,3}\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $cardsHtml = [];

        foreach ($chunks as $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            // Extraheer titel
            $title = '';
            if (preg_match('/^#{2,3}\s+(.+)$/m', $chunk, $tm)) {
                $title = trim($tm[1]);
                $chunk = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
            }

            // Extraheer icoon (bv *Icoon: brain* of [icon:brain] of icon: brain)
            $icon = 'sparkles';
            if (preg_match('/(?:(?:\*Icoon:\s*|\[icon:|\bicon:\s*)([a-z0-9_-]+)(?:\*|\])?)/i', $chunk, $im)) {
                $icon = strtolower(trim($im[1]));
                $chunk = preg_replace('/(?:(?:\*Icoon:\s*|\[icon:|\bicon:\s*)[a-z0-9_-]+(?:\*|\])?)/i', '', $chunk);
            }

            // Extraheer primaire link/knop onderaan (zoek bij voorkeur naar de laatste link op eigen regel)
            $linkUrl = '';
            $linkText = '';
            if (preg_match('/(?:\r?\n|^)\s*\[(.+?)\]\((.+?)\)\s*$/', $chunk, $lm)) {
                $linkText = $lm[1];
                $linkUrl  = $lm[2];
                $chunk    = substr($chunk, 0, (int)strrpos($chunk, $lm[0]));
            } elseif (preg_match('/\[(.+?)\]\((.+?)\)/', $chunk, $lm)) {
                $linkText = $lm[1];
                $linkUrl  = $lm[2];
                $chunk    = str_replace($lm[0], '', $chunk);
            }

            // Render overige beschrijving via Parsedown
            $descHtml = $this->parsedown->text(trim($chunk));

            $iconSvg = $this->renderIconSvg($icon, 28);

            $cardsHtml[] = '
            <div class="dienst-kaart" tabindex="0">
                <div class="dienst-icon" aria-hidden="true">
                    ' . $iconSvg . '
                </div>
                <h3 class="dienst-titel">' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                <div class="dienst-desc">' . $descHtml . '</div>
                ' . ($linkUrl ? '<a href="' . htmlspecialchars($this->formatUrl($linkUrl), ENT_QUOTES, 'UTF-8') . '" class="btn btn-outline btn-sm">' . htmlspecialchars($linkText, ENT_QUOTES, 'UTF-8') . ' <span class="arrow" aria-hidden="true">&rarr;</span></a>' : '') . '
            </div>';
        }

        $gridCols = $attrs['cols'] ?? '3';
        return '<div class="diensten-grid diensten-grid-' . htmlspecialchars($gridCols, ENT_QUOTES, 'UTF-8') . '">' . implode("\n", $cardsHtml) . '</div>';
    }

    /**
     * Render de 4 Noppa Kernwaarden (Helder, Vooruit, Verbonden, Vakkundig).
     */
    public function renderValuesSection(string $markdown, array $attrs = []): string {
        $pijlers = [
            ['name' => 'Helder', 'icon' => 'target', 'desc' => 'Duidelijke doelen, heldere taal en transparante afspraken. Geen vage theorie, maar direct toepasbaar advies.'],
            ['name' => 'Vooruit', 'icon' => 'lightning', 'desc' => 'Met energie en daadkracht stappen zetten. Wij zorgen voor tempo en innovatie met blijvend resultaat.'],
            ['name' => 'Verbonden', 'icon' => 'handshake', 'desc' => 'Echte samenwerking en persoonlijke betrokkenheid. We staan náást je team om adoptie te borgen.'],
            ['name' => 'Vakkundig', 'icon' => 'star', 'desc' => 'Gecertificeerde expertise op het hoogste niveau. Microsoft 365, Copilot en security tot in de puntjes beheerst.']
        ];

        // Indien er custom markdown is aangeleverd, overschrijf of toon markdown erbij
        $extraHtml = !empty(trim($markdown)) ? '<div class="values-intro artikel-prose mb-4">' . $this->renderProse($markdown) . '</div>' : '';

        $cards = [];
        foreach ($pijlers as $p) {
            $cards[] = '
            <div class="pijler-kaart">
                <div class="pijler-icon-box">
                    ' . $this->renderIconSvg($p['icon'], 32) . '
                </div>
                <h3 class="pijler-titel">' . $p['name'] . '</h3>
                <p class="pijler-desc">' . $p['desc'] . '</p>
            </div>';
        }

        return $extraHtml . '<div class="pijlers-grid">' . implode("\n", $cards) . '</div>';
    }

    /**
     * Render Enterprise Stat counters volgens noppa-ux-ui (tabular-nums, live indicators).
     */
    public function renderStatsSection(string $markdown, array $attrs = []): string {
        $lines = explode("\n", trim($markdown));
        $stats = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '-') !== 0) continue;
            // Formaat: - **35%** Tijdsbesparing op routine-taken
            if (preg_match('/-\s+\*\*([^\*]+)\*\*\s+(.+)/', $line, $m)) {
                $val = trim($m[1]);
                $lbl = trim($m[2]);
                $stats[] = '
                <div class="stat-card">
                    <div class="stat-value tabular-nums">' . htmlspecialchars($val, ENT_QUOTES, 'UTF-8') . '</div>
                    <div class="stat-label">' . htmlspecialchars($lbl, ENT_QUOTES, 'UTF-8') . '</div>
                </div>';
            }
        }

        return '<div class="stats-grid">' . implode("\n", $stats) . '</div>';
    }

    /**
     * Render Call To Action banner.
     */
    public function renderCtaSection(string $markdown, array $attrs = []): string {
        $parsed = $this->parsedown->text($markdown);
        // Transformeer standaard knoplinks
        $parsed = preg_replace_callback('/<a\s+href="([^"]+)">([^<]+)<\/a>/i', function($m) {
            return '<a href="' . htmlspecialchars($this->formatUrl($m[1]), ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary btn-lg">' . $m[2] . ' <span aria-hidden="true">&rarr;</span></a>';
        }, $parsed);

        return '
        <div class="cta-banner">
            <div class="cta-content">
                ' . $parsed . '
            </div>
        </div>';
    }

    /**
     * Render Hero sectie indien direct in Markdown gedefinieerd.
     */
    public function renderHeroSection(string $markdown, array $attrs = [], array $pageMeta = []): string {
        // Gebruik eventueel frontmatter waarden
        $title = $attrs['title'] ?? $this->extractH1($markdown) ?? ($pageMeta['title'] ?? '');
        $markdown = preg_replace('/^#\s+.+$/m', '', $markdown, 1);
        $subtitle = trim($markdown);

        $badge = $attrs['badge'] ?? '';
        $ctaText = $attrs['cta_text'] ?? 'Boek een afspraak';
        $ctaUrl  = $attrs['cta_url'] ?? '/contact';

        $out = '<div class="hero-inner">';
        if ($badge) {
            $out .= '<div class="hero-badge"><span class="badge-dot badge-pulse"></span> ' . htmlspecialchars($badge, ENT_QUOTES, 'UTF-8') . '</div>';
        }
        $out .= '<h1 class="hero-title">' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h1>';
        if ($subtitle) {
            $out .= '<p class="hero-subtitle">' . htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        $out .= '<div class="hero-actions">';
        $out .= '<a href="' . htmlspecialchars($this->formatUrl($ctaUrl), ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary btn-lg">' . htmlspecialchars($ctaText, ENT_QUOTES, 'UTF-8') . ' <span aria-hidden="true">&rarr;</span></a>';
        $out .= '</div>';
        $out .= '</div>';

        return $out;
    }

    /**
     * Render standaard prose tekst volgens noppa-website-content en noppa-website-table.
     */
    public function renderProse(string $markdown, array $attrs = []): string {
        // Voeg unieke ID's toe aan H2 en H3 koppen
        $markdownWithAnchors = preg_replace_callback('/^(#{2,4})\s+(.+)$/m', function($m) {
            $level = strlen($m[1]);
            $title = trim($m[2]);
            $slug = $this->slugify($title);
            return "<h{$level} id=\"{$slug}\">{$title}</h{$level}>";
        }, $markdown);

        // Parsedown parsing
        $html = $this->parsedown->text($markdownWithAnchors);

        // Wrappen van tabellen in .table-responsive conform noppa-website-table
        $html = preg_replace('/<table>/i', '<div class="table-responsive"><table class="noppa-table">', $html);
        $html = preg_replace('/<\/table>/i', '</table></div>', $html);

        // Shortcodes vervangen voor iconen: [icon:name] of *Icoon: name*
        $html = preg_replace_callback('/(?:\[icon:([a-z0-9_-]+)\]|\*Icoon:\s*([a-z0-9_-]+)\*)/i', function($m) {
            $iconName = !empty($m[1]) ? $m[1] : $m[2];
            return $this->renderIconSvg($iconName, 24);
        }, $html);

        // Ondersteuning voor Noppa button classes in Markdown links: [Tekst](link){.btn-primary}
        $html = preg_replace_callback('/<a\s+href="([^"]+)">([^<]+)<\/a>\{(\.btn[^\}]+)\}/i', function($m) {
            $url = $m[1];
            $text = $m[2];
            $classes = str_replace('.', '', $m[3]);
            return '<a href="' . $url . '" class="btn ' . htmlspecialchars($classes, ENT_QUOTES, 'UTF-8') . '">' . $text . '</a>';
        }, $html);

        return '<div class="artikel-prose">' . $html . '</div>';
    }

    /**
     * Render SVG icoon met Noppa 4-staps linear-gradient stroke en unieke gradient ID.
     */
    public function renderIconSvg(string $name, int $size = 28): string {
        $safeName = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $name));
        $file = $this->iconsDir . $safeName . '.svg';

        if (file_exists($file)) {
            $svg = file_get_contents($file);
            // Scopeer gradient IDs conform noppa-website-icons om DOM-conflicten te voorkomen
            $uniqueId = $safeName . '-' . substr(md5(uniqid((string)mt_rand(), true)), 0, 6);
            $svg = str_replace(
                ['id="g"', 'id="gh"', 'url(#g)', 'url(#gh)'],
                ['id="g-' . $uniqueId . '"', 'id="gh-' . $uniqueId . '"', 'url(#g-' . $uniqueId . ')', 'url(#gh-' . $uniqueId . ')'],
                $svg
            );
            // Zorg voor schone afmetingen en aria attributen
            $svg = preg_replace('/<svg\b([^>]*)>/i', '<svg$1 width="' . $size . '" height="' . $size . '" class="noppa-icon" role="img" aria-label="' . $safeName . '">', $svg, 1);
            return $svg;
        }

        // Fallback: toon img tag
        return '<img src="./assets/icons/' . $safeName . '.svg" alt="' . $safeName . '" class="noppa-icon" width="' . $size . '" height="' . $size . '" loading="lazy">';
    }

    /**
     * Bouw een Table of Contents (TOC) array op basis van H2 en H3 tags.
     */
    public function buildToc(string $markdown): array {
        $toc = [];
        if (preg_match_all('/^(#{2,3})\s+(.+)$/m', $markdown, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $m) {
                $level = strlen($m[1]);
                $title = trim($m[2]);
                $toc[] = [
                    'level' => $level,
                    'title' => $title,
                    'slug'  => $this->slugify($title)
                ];
            }
        }
        return $toc;
    }

    /**
     * Extraheer de eerste H1 uit Markdown.
     */
    public function extractH1(string $md): ?string {
        if (preg_match('/^#\s+(.+)/m', $md, $m)) {
            return trim($m[1]);
        }
        return null;
    }

    /**
     * Genereer excerpt uit Markdown.
     */
    public function extractExcerpt(string $md, int $length = 160): string {
        $text = preg_replace('/^#{1,6}\s+.+$/m', '', $md);
        $text = preg_replace('/\*{1,2}(.+?)\*{1,2}/', '$1', $text);
        $text = preg_replace('/\[(.+?)\]\(.+?\)/', '$1', $text);
        $text = preg_replace('/`(.+?)`/', '$1', $text);
        $text = trim(preg_replace('/\s+/', ' ', $text));
        return mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '…' : $text;
    }

    /**
     * Maak een URL-vriendelijke anker slug.
     */
    public function slugify(string $text): string {
        $text = strtolower(strip_tags($text));
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        return trim($text, '-');
    }

    /**
     * Eenvoudige, robuuste YAML frontmatter parser.
     */
    private function parseYaml(string $yaml): array {
        $data = [];
        $lines = explode("\n", trim($yaml));
        $currentArrayKey = null;
        $currentSectionKey = null;

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (empty($trimmed) || strpos($trimmed, '#') === 0) continue;

            // Geneste secties (bijv. hero: of cta:)
            if (preg_match('/^([a-zA-Z0-9_-]+):\s*$/', $trimmed, $m)) {
                $currentSectionKey = $m[1];
                $data[$currentSectionKey] = [];
                $currentArrayKey = null;
                continue;
            }

            // Geneste key/value onder een sectie (bijv.   badge: "Tekst")
            if ($currentSectionKey && preg_match('/^\s{2,4}([a-zA-Z0-9_-]+):\s*(.*)$/', $line, $m)) {
                $subKey = $m[1];
                $val = $this->cleanYamlValue($m[2]);
                $data[$currentSectionKey][$subKey] = $val;
                continue;
            }

            // Array elementen onder een sectie of root (bijv. - item)
            if (preg_match('/^(\s*)-\s+(.*)$/', $line, $m)) {
                $val = $this->cleanYamlValue($m[2]);
                if ($currentSectionKey) {
                    $data[$currentSectionKey][] = $val;
                } else {
                    $data[] = $val;
                }
                continue;
            }

            // Standaard root key: value
            if (strpos($trimmed, ':') !== false) {
                [$k, $v] = explode(':', $trimmed, 2);
                $k = trim($k);
                $v = $this->cleanYamlValue($v);
                $data[$k] = $v;
                $currentSectionKey = null;
            }
        }

        return $data;
    }

    /**
     * Opschonen en type-casting van YAML string values.
     */
    private function cleanYamlValue(string $val): mixed {
        $val = trim($val);
        $val = trim($val, "\"'");

        if (strtolower($val) === 'true') return true;
        if (strtolower($val) === 'false') return false;
        if (strtolower($val) === 'null' || $val === '~') return null;
        if (is_numeric($val)) return strpos($val, '.') !== false ? (float)$val : (int)$val;

        // JSON inline objecten zoals { text: "...", url: "..." }
        if (strpos($val, '{') === 0 && substr($val, -1) === '}') {
            $jsonCandidate = preg_replace('/([a-zA-Z0-9_-]+):/', '"$1":', $val);
            $decoded = json_decode($jsonCandidate, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return $val;
    }

    /**
     * Parseer HTML-achtige attributen in section comments (bijv. type="cards" cols="3").
     */
    private function parseAttributes(string $str): array {
        $attrs = [];
        if (preg_match_all('/([a-zA-Z0-9_-]+)=(?:"([^"]*)"|\'([^\']*)\'|([^\s>]+))/i', $str, $m, PREG_SET_ORDER)) {
            foreach ($m as $match) {
                $key = strtolower($match[1]);
                $val = $match[2] !== '' ? $match[2] : ($match[3] !== '' ? $match[3] : $match[4]);
                $attrs[$key] = $val;
            }
        }
        return $attrs;
    }

    /**
     * Formatteer relatieve URLs robuust voor submappen en query parameters.
     */
    public function formatUrl(string $url): string {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
            return $url;
        }

        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
        $isQueryMode = isset($_GET['page']);

        $parts = explode('#', $url, 2);
        $path  = trim($parts[0], '/');
        $hash  = isset($parts[1]) ? '#' . $parts[1] : '';

        if ($isQueryMode) {
            if ($path === '' || $path === 'home') {
                return 'index.php' . $hash;
            }
            if ($path === 'diensten') {
                return 'index.php?page=diensten' . $hash;
            }
            if (str_starts_with($path, 'diensten/')) {
                $slug = substr($path, 9);
                return 'index.php?page=diensten&id=' . urlencode($slug) . $hash;
            }
            if ($path === 'kennisbank') {
                return 'index.php?page=kennisbank' . $hash;
            }
            if (str_starts_with($path, 'kennisbank/')) {
                $slug = substr($path, 11);
                return 'index.php?page=kennisbank&slug=' . urlencode($slug) . $hash;
            }
            if (str_starts_with($path, 'team/')) {
                $id = substr($path, 5);
                return 'index.php?page=team&id=' . urlencode($id) . $hash;
            }
            return 'index.php?page=' . urlencode($path) . $hash;
        }

        if ($path === '' || $path === 'home') {
            return ($assetPrefix === './' ? './' : $assetPrefix) . $hash;
        }

        return $assetPrefix . $path . $hash;
    }
}
