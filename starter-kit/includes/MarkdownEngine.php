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
    private string $teamDir;
    private array $siteConfig;
    private array $teamMembersCache = [];

    public function __construct(string $contentDir = '', string $iconsDir = '', string $teamDir = '', array $siteConfig = []) {
        $this->contentDir = rtrim($contentDir ?: dirname(__DIR__) . '/content', '/\\') . '/';
        $this->iconsDir   = rtrim($iconsDir ?: dirname(__DIR__) . '/assets/icons', '/\\') . '/';
        $this->teamDir    = rtrim($teamDir ?: dirname(__DIR__) . '/data/team', '/\\') . '/';
        $this->siteConfig = $siteConfig ?: ($GLOBALS['siteConfig'] ?? []);
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
            // Case-insensitive & dash-flexibele fallback voor Linux webservers
            $normalizedSlug = strtolower(str_replace('_', '-', $cleanSlug));
            $pagesDir = $this->contentDir . 'pages/';
            $allPages = glob($pagesDir . '*.md') ?: [];
            $found = false;
            foreach ($allPages as $candidate) {
                $base = basename($candidate, '.md');
                if (strtolower(str_replace('_', '-', $base)) === $normalizedSlug || strtolower($base) === strtolower($cleanSlug)) {
                    $filePath = $candidate;
                    $cleanSlug = $base;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                return null;
            }
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

            case 'team':
            case 'team-grid':
            case 'profile-card':
            case 'profile-cards':
            case 'teamleden':
                return $this->renderTeamSection($raw, $attrs);

            case 'pijlers':
            case 'values':
                return $this->renderValuesSection($raw, $attrs);

            case 'stats':
                return $this->renderStatsSection($raw, $attrs);

            case 'cta':
                return $this->renderCtaSection($raw, $attrs);

            case 'hero':
                return $this->renderHeroSection($raw, $attrs, $pageMeta);

            case 'pinned-scroll':
            case 'pillars':
            case 'pilaren':
                return $this->renderPinnedScrollSection($raw, $attrs);

            case 'visual':
            case 'ijsberg':
                return $this->renderVisualSection($raw, $attrs);

            case 'formula':
            case 'formule':
                return $this->renderFormulaSection($raw, $attrs);

            case 'decisions':
            case 'besluiten':
                return $this->renderDecisionsSection($raw, $attrs);

            case 'checklist':
                return $this->renderChecklistSection($raw, $attrs);

            case 'scorecard':
                return $this->renderScorecardSection($raw, $attrs);

            case 'split':
            case 'media-text':
                return $this->renderSplitSection($raw, $attrs);

            case 'overlay':
            case 'banner':
                return $this->renderOverlaySection($raw, $attrs);

            case 'modules':
            case 'services':
            case 'diensten-modules':
                return $this->renderModulesSection($raw, $attrs);

            case 'contact':
            case 'contact-cta':
                return $this->renderContactSection($raw, $attrs);

            case 'sources':
            case 'bronnen':
                return $this->renderSourcesSection($raw, $attrs);

            case 'charts':
            case 'grafieken':
            case 'chart-grid':
                return $this->renderChartsSection($raw, $attrs);

            case 'roadmap':
            case 'steps':
            case 'stappen':
                return $this->renderRoadmapSection($raw, $attrs);

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
     * Render Team Profile Cards sectie op basis van enkel namen in Markdown.
     * Ondersteunt:
     * - Rik Dobbelsteen
     * - Deborah Stahlecker
     * of
     * ## Rik Dobbelsteen
     * of platte tekstregels met namen.
     */
    public function renderTeamSection(string $markdown, array $attrs = []): string {
        $lines = preg_split('/\r?\n/', trim($markdown));
        $names = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;

            // Negeer HTML commentaren, knop-links of icoon metadata
            if (str_starts_with($line, '<!--') || str_starts_with($line, '-->') || str_starts_with($line, '*Icoon:') || str_starts_with($line, '[icon:')) {
                continue;
            }

            // Verwijder bullet prefixes (- , * , + , 1. ) of header prefixes (## , ### )
            $cleanName = preg_replace('/^(?:[-*+]\s+|\d+\.\s+|#{1,4}\s+)/', '', $line);
            // Verwijder markdown bold / italic
            $cleanName = trim(preg_replace('/[*_~`]/', '', $cleanName));

            // Als er toevallig nog een link in stond [Naam](url), pak de link tekst
            if (preg_match('/\[([^\]]+)\]/', $cleanName, $lm)) {
                $cleanName = trim($lm[1]);
            }

            if ($cleanName !== '' && !in_array($cleanName, $names, true)) {
                $names[] = $cleanName;
            }
        }

        if (empty($names)) {
            // Als er geen namen zijn opgegeven, laad automatisch alle teamleden uit de team map
            $names = $this->getAllTeamSlugs();
        }

        $cardsHtml = [];
        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';

        foreach ($names as $name) {
            $member = $this->resolveTeamMember($name);
            if (!$member) continue;

            $fullName   = htmlspecialchars($member['fullName'], ENT_QUOTES, 'UTF-8');
            $roleTitle  = htmlspecialchars($member['roleTitle'], ENT_QUOTES, 'UTF-8');
            $shortBio   = htmlspecialchars($member['shortBio'], ENT_QUOTES, 'UTF-8');
            $profileUrl = htmlspecialchars($this->formatUrl('/team/' . $member['id']), ENT_QUOTES, 'UTF-8');
            $initials   = htmlspecialchars($member['initials'], ENT_QUOTES, 'UTF-8');

            // Bepaal avatar: foto of gestileerde initials placeholder
            $avatarHtml = '';
            if (!empty($member['image'])) {
                $imgSrc = (strpos($member['image'], 'http') === 0) ? $member['image'] : ($assetPrefix . ltrim($member['image'], './'));
                $avatarHtml = '<img src="' . htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') . '" alt="' . $fullName . '" class="team-profile-avatar" width="120" height="120" loading="lazy">';
            } else {
                $avatarHtml = '<div class="team-profile-avatar-placeholder" aria-hidden="true"><span>' . $initials . '</span></div>';
            }

            $cardsHtml[] = '
            <article class="team-profile-card" tabindex="0">
                <div class="team-profile-header">
                    <div class="team-profile-avatar-wrap">
                        ' . $avatarHtml . '
                    </div>
                    <div class="team-profile-identity">
                        <h3 class="team-profile-name">' . $fullName . '</h3>
                        <span class="team-profile-role">' . $roleTitle . '</span>
                    </div>
                </div>
                <p class="team-profile-bio">' . $shortBio . '</p>
                <div class="team-profile-footer">
                    <a href="' . $profileUrl . '" class="btn btn-outline btn-sm team-profile-btn">
                        <span>Bekijk profiel</span>
                        <span class="arrow" aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </article>';
        }

        $gridCols = $attrs['cols'] ?? '3';
        return '<div class="team-cards-grid team-cards-grid-' . htmlspecialchars((string)$gridCols, ENT_QUOTES, 'UTF-8') . '">' . implode("\n", $cardsHtml) . '</div>';
    }

    /**
     * Resolvet een teamlid op basis van naam of slug naar een gestructureerd profiel.
     * Ondersteunt accent-normalisatie (bijv. "Daniël" -> "daniel-giessenburg").
     */
    public function resolveTeamMember(string $nameOrSlug): array {
        $nameOrSlug = trim($nameOrSlug);
        $cacheKey = strtolower($nameOrSlug);
        if (isset($this->teamMembersCache[$cacheKey])) {
            return $this->teamMembersCache[$cacheKey];
        }

        // Normaliseer accenten (bijv. ë -> e, é -> e, etc.)
        $normalized = $this->normalizeAccents($nameOrSlug);
        $candidateSlug = $this->slugify($normalized);

        // 1. Directe bestandsmatch op slug
        $directFile = $this->teamDir . $candidateSlug . '.md';
        if (file_exists($directFile)) {
            $parsed = $this->parseTeamProfileFile(file_get_contents($directFile), $candidateSlug);
            $this->teamMembersCache[$cacheKey] = $parsed;
            return $parsed;
        }

        // 2. Scan alle profielen in de data/team map
        if (is_dir($this->teamDir)) {
            $files = glob($this->teamDir . '*.md') ?: [];
            foreach ($files as $file) {
                $raw = file_get_contents($file);
                $fileSlug = pathinfo($file, PATHINFO_FILENAME);
                $parsed = $this->parseTeamProfileFile($raw, $fileSlug);

                // Match op volledige naam, voornaam + achternaam of slug
                $matchFullName = $this->normalizeAccents($parsed['fullName']);
                $matchFirst = $this->normalizeAccents($parsed['firstName']);
                $matchLast = $this->normalizeAccents($parsed['lastName']);

                if (
                    strcasecmp($normalized, $matchFullName) === 0 ||
                    strcasecmp($candidateSlug, $fileSlug) === 0 ||
                    (stripos($normalized, $matchFirst) !== false && !empty($matchLast) && stripos($normalized, $matchLast) !== false)
                ) {
                    $this->teamMembersCache[$cacheKey] = $parsed;
                    return $parsed;
                }
            }

            // Tweede doorgang: match op alleen voornaam indien uniek
            foreach ($files as $file) {
                $raw = file_get_contents($file);
                $fileSlug = pathinfo($file, PATHINFO_FILENAME);
                $parsed = $this->parseTeamProfileFile($raw, $fileSlug);
                $matchFirst = $this->normalizeAccents($parsed['firstName']);
                if (strcasecmp($normalized, $matchFirst) === 0) {
                    $this->teamMembersCache[$cacheKey] = $parsed;
                    return $parsed;
                }
            }
        }

        // 3. Fallback indien teamlid (nog) geen eigen bestand heeft
        $parts = preg_split('/\s+/', $nameOrSlug);
        $firstName = $parts[0] ?? $nameOrSlug;
        $lastName = count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';
        $initials = mb_substr($firstName, 0, 1) . ($lastName !== '' ? mb_substr($lastName, 0, 1) : '');

        $fallback = [
            'id'        => $candidateSlug,
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'fullName'  => $nameOrSlug,
            'roleTitle' => 'Consultant',
            'jobTitle'  => 'Consultant',
            'shortBio'  => 'Specialist bij ' . ($this->siteConfig['site_name'] ?? 'Noppa Solutions & Consultants') . ', gedreven door mens en productiviteit.',
            'image'     => '',
            'initials'  => strtoupper($initials),
            'email'     => $this->siteConfig['company']['email'] ?? 'info@noppa.nl',
            'phone'     => $this->siteConfig['company']['phone'] ?? '+31 6 13 35 77 23',
            'location'  => $this->siteConfig['company']['full_address'] ?? 'Berlicum, Noord-Brabant'
        ];

        $this->teamMembersCache[$cacheKey] = $fallback;
        return $fallback;
    }

    /**
     * Normaliseert diakrieten en accenten (bijv. ë -> e, é -> e).
     */
    public function normalizeAccents(string $str): string {
        $accents = [
            'ë' => 'e', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'Ë' => 'E', 'É' => 'E', 'È' => 'E', 'Ê' => 'E',
            'ï' => 'i', 'í' => 'i', 'ì' => 'i', 'î' => 'i', 'Ï' => 'I', 'Í' => 'I', 'Ì' => 'I', 'Î' => 'I',
            'ö' => 'o', 'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'Ö' => 'O', 'Ó' => 'O', 'Ò' => 'O', 'Ô' => 'O',
            'ü' => 'u', 'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'Ü' => 'U', 'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U',
            'ä' => 'a', 'á' => 'a', 'à' => 'a', 'â' => 'a', 'Ä' => 'A', 'Á' => 'A', 'À' => 'A', 'Â' => 'A',
            'ñ' => 'n', 'Ñ' => 'N', 'ç' => 'c', 'Ç' => 'C'
        ];
        return strtr($str, $accents);
    }

    /**
     * Parseer een teamprofiel markdown bestand.
     */
    public function parseTeamProfileFile(string $raw, string $slug): array {
        $meta = [];
        $body = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
            $meta = $this->parseYaml($matches[1]);
            $body = $matches[2];
        }

        $firstName = $meta['firstName'] ?? 'Consultant';
        $lastName  = $meta['lastName'] ?? '';
        $fullName  = trim($firstName . ' ' . $lastName);
        $roleTitle = $meta['roleTitle'] ?? ($meta['jobTitle'] ?? 'Consultant Microsoft 365');
        $jobTitle  = $meta['jobTitle'] ?? 'Consultant';
        $shortBio  = $meta['shortBio'] ?? $this->extractExcerpt($body, 140);
        $image     = $meta['image'] ?? '';
        $initials  = mb_substr($firstName, 0, 1) . ($lastName !== '' ? mb_substr($lastName, 0, 1) : '');

        // Auto-detectie van afbeelding indien leeg in frontmatter
        if (empty($image)) {
            $possibleNames = [
                $fullName . '.jpeg',
                $fullName . '.jpg',
                $fullName . '.png',
                $firstName . '.jpg',
                $firstName . '.png',
            ];
            $assetsImagesDir = dirname($this->iconsDir) . '/images/';
            foreach ($possibleNames as $pName) {
                if (file_exists($assetsImagesDir . $pName)) {
                    $image = './assets/images/' . $pName;
                    break;
                }
            }
        }

        return [
            'id'        => $slug,
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'fullName'  => $fullName,
            'roleTitle' => $roleTitle,
            'jobTitle'  => $jobTitle,
            'shortBio'  => $shortBio,
            'image'     => $image,
            'initials'  => strtoupper($initials),
            'email'     => $meta['email'] ?? 'info@noppa.nl',
            'phone'     => $meta['phone'] ?? '+31 6 13 35 77 23',
            'location'  => $meta['location'] ?? 'Berlicum, Noord-Brabant',
            'raw_body'  => $body
        ];
    }

    /**
     * Haalt alle teamlid slugs op uit de team directory.
     */
    public function getAllTeamSlugs(): array {
        if (!is_dir($this->teamDir)) return [];
        $files = glob($this->teamDir . '*.md') ?: [];
        $slugs = [];
        foreach ($files as $file) {
            $slugs[] = pathinfo($file, PATHINFO_FILENAME);
        }
        return $slugs;
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
                $numClean = preg_replace('/[^0-9]/', '', $val);
                $dataAttr = (!empty($numClean)) ? ' data-counter="' . htmlspecialchars($numClean, ENT_QUOTES, 'UTF-8') . '"' : '';
                $stats[] = '
                <div class="stat-card reveal">
                    <div class="stat-value tabular-nums"' . $dataAttr . '>' . htmlspecialchars($val, ENT_QUOTES, 'UTF-8') . '</div>
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
        <div class="cta-banner reveal">
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
            $out .= '<div class="hero-badge reveal"><span class="badge-dot badge-pulse"></span> ' . htmlspecialchars($badge, ENT_QUOTES, 'UTF-8') . '</div>';
        }
        $out .= '<h1 class="hero-title reveal">' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h1>';
        if ($subtitle) {
            $out .= '<p class="hero-subtitle reveal">' . htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        $out .= '<div class="hero-actions reveal">';
        $out .= '<a href="' . htmlspecialchars($this->formatUrl($ctaUrl), ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary btn-lg">' . htmlspecialchars($ctaText, ENT_QUOTES, 'UTF-8') . ' <span aria-hidden="true">&rarr;</span></a>';
        $out .= '</div>';
        $out .= '</div>';

        return $out;
    }

    /**
     * Render Pinned Horizontal Scroll Pilaren (De 3 Pilaren).
     */
    public function renderPinnedScrollSection(string $markdown, array $attrs = []): string {
        $trackId = $attrs['id'] ?? 'risico';
        $trackTitle = $attrs['title'] ?? 'De 3 Pilaren';
        $trackBg = !empty($attrs['bg']) ? 'bg-' . htmlspecialchars($attrs['bg'], ENT_QUOTES, 'UTF-8') : 'bg-deep';

        // Splits slides op H2 koppen (## 1. ..., ## 2. ..., etc.)
        $rawSlides = preg_split('/(?=^##\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $slidesHtml = [];
        $navPillsHtml = [];

        foreach ($rawSlides as $index => $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            $pillarNum = (string)($index + 1);
            $title = '';
            if (preg_match('/^##\s+(?:(\d+)\.\s*)?(.+)$/m', $chunk, $tm)) {
                if (!empty($tm[1])) {
                    $pillarNum = $tm[1];
                }
                $title = trim($tm[2]);
                $chunk = preg_replace('/^##\s+.+$/m', '', $chunk, 1);
            }

            // Extraheer optioneel pill-label
            $pillLabel = $title;
            if (preg_match('/\*Label:\s*(.*?)\*/i', $chunk, $lm)) {
                $pillLabel = trim($lm[1]);
                $chunk = str_replace($lm[0], '', $chunk);
            }

            // Extraheer optionele voorwaarde
            $conditionText = '';
            if (preg_match('/\*Voorwaarde:\s*(.*?)\*/i', $chunk, $cm)) {
                $conditionText = trim($cm[1]);
                $chunk = str_replace($cm[0], '', $chunk);
            }

            // Extraheer optioneel thema
            $slideTheme = '';
            if (preg_match('/\*Thema:\s*(.*?)\*/i', $chunk, $thm)) {
                $slideTheme = trim($thm[1]) === 'dark' ? 'on-dark' : '';
                $chunk = str_replace($thm[0], '', $chunk);
            }

            $activeClass = ($index === 0) ? ' active' : '';
            $navPillsHtml[] = '<button class="h-nav-pill' . $activeClass . '" type="button" data-slide="' . $index . '">' .
                '<span class="pill-num">' . htmlspecialchars($pillarNum, ENT_QUOTES, 'UTF-8') . '</span> ' .
                '<span class="pill-text">' . htmlspecialchars($pillLabel, ENT_QUOTES, 'UTF-8') . '</span>' .
                '</button>';

            $conditionHtml = '';
            if (!empty($conditionText)) {
                $conditionHtml = '
                <div class="condition-box">
                    <div>
                        <div class="lbl">Rendementsvoorwaarde ' . htmlspecialchars($pillarNum, ENT_QUOTES, 'UTF-8') . '</div>
                        <p>' . htmlspecialchars($conditionText, ENT_QUOTES, 'UTF-8') . '</p>
                    </div>
                </div>';
            }

            // Splits eventueel in twee kolommen via <!-- col --> of |||
            $cols = preg_split('/<!--\s*(?:col|column)\s*-->|(?:\r?\n)\s*\|\|\|\s*(?:\r?\n)/i', $chunk);

            if (count($cols) > 1) {
                $col1Html = $this->parseSlideChunk(trim($cols[0]));
                $col2Html = $this->parseSlideChunk(trim($cols[1]));

                $slideColsHtml = '
                <div class="h-slide-col">
                    <div class="pillar-index">' . htmlspecialchars($pillarNum, ENT_QUOTES, 'UTF-8') . '</div>
                    <h2>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h2>
                    ' . $col1Html . '
                    ' . $conditionHtml . '
                </div>
                <div class="h-slide-col">
                    ' . $col2Html . '
                </div>';
            } else {
                $bodyHtml = $this->parseSlideChunk(trim($chunk));
                $slideColsHtml = '
                <div class="h-slide-col" style="grid-column: 1 / -1; max-width: 820px;">
                    <div class="pillar-index">' . htmlspecialchars($pillarNum, ENT_QUOTES, 'UTF-8') . '</div>
                    <h2>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h2>
                    ' . $bodyHtml . '
                    ' . $conditionHtml . '
                </div>';
            }

            $slideIndexClass = 'h-slide-' . htmlspecialchars($pillarNum, ENT_QUOTES, 'UTF-8');
            $slidesHtml[] = '
            <div class="h-slide ' . $slideIndexClass . ' ' . $slideTheme . '" data-slide-index="' . $index . '">
                <div class="h-slide-inner">
                    <div class="h-slide-grid">
                        ' . $slideColsHtml . '
                    </div>
                </div>
            </div>';
        }

        return '
        <div class="h-scroll-track ' . $trackBg . '" id="' . htmlspecialchars($trackId, ENT_QUOTES, 'UTF-8') . '">
            <div class="h-scroll-sticky">
                <div class="h-scroll-nav">
                    <div class="h-scroll-nav-inner">
                        <span class="h-nav-label">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            ' . htmlspecialchars($trackTitle, ENT_QUOTES, 'UTF-8') . '
                        </span>
                        <div class="h-nav-pills">
                            ' . implode("\n", $navPillsHtml) . '
                        </div>
                        <div class="h-scroll-progress-bg" title="Scroll-voortgang">
                            <div class="h-scroll-progress-bar"></div>
                        </div>
                    </div>
                </div>
                <div class="h-scroll-slider">
                    ' . implode("\n", $slidesHtml) . '
                </div>
            </div>
        </div>';
    }

    /**
     * Parseer individuele slide chunks inclusief directives (route-a, route-b, law-box, flow, etc.)
     */
    private function parseSlideChunk(string $markdown): string {
        // Directives: ::: directive_name ... :::
        $markdown = preg_replace_callback('/:::\s*([a-zA-Z0-9_-]+)\r?\n(.*?)\r?\n:::/s', function($m) {
            $dir = strtolower($m[1]);
            $inner = trim($m[2]);

            if ($dir === 'route-a' || $dir === 'route-b') {
                $head = '';
                if (preg_match('/^#{3,4}\s+(.+)$/m', $inner, $hm)) {
                    $head = trim($hm[1]);
                    $inner = preg_replace('/^#{3,4}\s+.+$/m', '', $inner, 1);
                }
                $icon = ($dir === 'route-a') ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>' : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>';
                $innerHtml = $this->parsedown->text(trim($inner));
                return '<div class="route-card ' . $dir . '"><div class="route-head">' . $icon . ' ' . htmlspecialchars($head, ENT_QUOTES, 'UTF-8') . '</div>' . $innerHtml . '</div>';
            }

            if ($dir === 'routes') {
                return '<div class="routes">' . $this->parseSlideChunk($inner) . '</div>';
            }

            if ($dir === 'law-box') {
                $title = 'Wettelijke verplichting: AI Act artikel 4';
                $sub = 'Van kracht sinds 2 februari 2025';
                if (preg_match('/^#{2,3}\s+(.+)$/m', $inner, $tm)) {
                    $title = trim($tm[1]);
                    $inner = preg_replace('/^#{2,3}\s+.+$/m', '', $inner, 1);
                }
                if (preg_match('/^\*(?:Sub:)?\s*(.*?)\*/m', $inner, $sm)) {
                    $sub = trim($sm[1]);
                    $inner = preg_replace('/^\*(?:Sub:)?\s*.*?\*/m', '', $inner, 1);
                }
                $iconSvg = $this->renderIconSvg('scale', 28);
                $innerHtml = $this->parsedown->text(trim($inner));
                $innerHtml = str_replace('<ul>', '<ul class="bullet-list">', $innerHtml);
                $innerHtml = preg_replace_callback('/<li>(.*?)<\/li>/s', function($lm) {
                    return '<li><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg><span>' . $lm[1] . '</span></li>';
                }, $innerHtml);

                return '
                <div class="law-box">
                    <div class="law-head">
                        <div class="icon-badge">' . $iconSvg . '</div>
                        <div>
                            <h3>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                            <div class="law-sub">' . htmlspecialchars($sub, ENT_QUOTES, 'UTF-8') . '</div>
                        </div>
                    </div>
                    ' . $innerHtml . '
                </div>';
            }

            return '<div class="' . htmlspecialchars($dir, ENT_QUOTES, 'UTF-8') . '">' . $this->parsedown->text($inner) . '</div>';
        }, $markdown);

        $html = $this->parsedown->text(trim($markdown));

        // Transformeer lijsten
        $html = str_replace('<ul>', '<ul class="bullet-list">', $html);
        $html = preg_replace_callback('/<li>(.*?)<\/li>/s', function($lm) {
            return '<li><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg><span>' . $lm[1] . '</span></li>';
        }, $html);

        // Transformeer genummerde lijsten naar roi-list
        $html = str_replace('<ol>', '<ol class="roi-list">', $html);

        return $html;
    }

    /**
     * Render Visual Model Sectie (zoals de Copilot Waarde-IJsberg).
     */
    public function renderVisualSection(string $markdown, array $attrs = []): string {
        $image = $attrs['image'] ?? '';
        $alt   = $attrs['alt'] ?? ($attrs['title'] ?? 'Visueel Model');

        // Automatische detectie van afbeelding uit Markdown indien leeg
        if (empty($image) && preg_match('/!\[(.*?)\]\((.*?)\)/', $markdown, $im)) {
            $alt = $im[1] ?: $alt;
            $image = $im[2];
            $markdown = str_replace($im[0], '', $markdown);
        }

        // Extraheer eventuele caption uit blockquote (> ...)
        $caption = '';
        if (preg_match('/^>\s*(.+)$/m', $markdown, $cm)) {
            $caption = trim($cm[1]);
            $markdown = preg_replace('/^>\s*.+$/m', '', $markdown);
        }

        $introHtml = !empty(trim($markdown)) ? '<div class="visual-intro artikel-prose reveal mb-4">' . $this->parsedown->text(trim($markdown)) . '</div>' : '';

        $captionHtml = !empty($caption) ? '<p class="iceberg-caption reveal">' . htmlspecialchars($caption, ENT_QUOTES, 'UTF-8') . '</p>' : '';

        return '
        ' . $introHtml . '
        <div class="iceberg-wrap reveal">
            <img src="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') . '" loading="lazy">
        </div>
        ' . $captionHtml;
    }

    /**
     * Render Formule Kaart met Pijler Voorwaarden (noppa-website-content).
     */
    public function renderFormulaSection(string $markdown, array $attrs = []): string {
        $eq = $attrs['eq'] ?? '';
        $note = $attrs['note'] ?? '';

        // Formatteer eventuele wiskundige symbolen in de formule
        $eqFormatted = htmlspecialchars($eq, ENT_QUOTES, 'UTF-8');
        $eqFormatted = str_replace('&times;', '<span class="x">&times;</span>', $eqFormatted);
        $eqFormatted = str_replace('×', '<span class="x">&times;</span>', $eqFormatted);
        $eqFormatted = str_replace('−', '<span class="op">&minus;</span>', $eqFormatted);
        $eqFormatted = str_replace('-', '<span class="op">&minus;</span>', $eqFormatted);

        // Splits conditiekaarten op H2 of H3
        $chunks = preg_split('/(?=^#{2,3}\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $cardsHtml = [];
        $introText = '';

        foreach ($chunks as $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            if (!preg_match('/^#{2,3}\s+(.+)$/m', $chunk)) {
                $introText .= $this->parsedown->text($chunk);
                continue;
            }

            $title = '';
            if (preg_match('/^#{2,3}\s+(.+)$/m', $chunk, $tm)) {
                $title = trim($tm[1]);
                $chunk = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
            }

            $icon = 'sparkles';
            if (preg_match('/(?:(?:\*Icoon:\s*|\[icon:|\bicon:\s*)([a-z0-9_-]+)(?:\*|\])?)/i', $chunk, $im)) {
                $icon = strtolower(trim($im[1]));
                $chunk = preg_replace('/(?:(?:\*Icoon:\s*|\[icon:|\bicon:\s*)[a-z0-9_-]+(?:\*|\])?)/i', '', $chunk);
            }

            $body = $this->parsedown->text(trim($chunk));

            $cardsHtml[] = '
            <div class="cond-card reveal">
                <div class="icon-badge">' . $this->renderIconSvg($icon, 28) . '</div>
                <h3>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                <div class="cond-body">' . $body . '</div>
            </div>';
        }

        $formulaHtml = '';
        if (!empty($eq)) {
            $formulaHtml = '
            <div class="formula-card reveal">
                <div class="formula-eq">' . $eqFormatted . '</div>
                ' . (!empty($note) ? '<div class="formula-note">' . htmlspecialchars($note, ENT_QUOTES, 'UTF-8') . '</div>' : '') . '
            </div>';
        }

        return $introText . $formulaHtml . '<div class="cond-grid">' . implode("\n", $cardsHtml) . '</div>';
    }

    /**
     * Render Strategische Besluitkaarten (Directieperspectief).
     */
    public function renderDecisionsSection(string $markdown, array $attrs = []): string {
        $chunks = preg_split('/(?=^#{2,3}\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $cardsHtml = [];
        $questionHtml = '';

        foreach ($chunks as $index => $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            // Vraagbox onderaan herkennen
            if (stripos($chunk, 'Besluitvraag') !== false && preg_match('/^#{2,3}\s+Besluitvraag/i', $chunk)) {
                $qText = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
                $questionHtml = '
                <div class="decision-question reveal">
                    <div class="icon-badge">' . $this->renderIconSvg('search', 28) . '</div>
                    <div>
                        <h3>Besluitvraag voor het directieteam</h3>
                        <p>' . htmlspecialchars(trim(strip_tags($qText)), ENT_QUOTES, 'UTF-8') . '</p>
                    </div>
                </div>';
                continue;
            }

            $num = (string)($index + 1);
            $title = '';
            if (preg_match('/^#{2,3}\s+(?:(\d+)\.\s*)?(.+)$/m', $chunk, $tm)) {
                if (!empty($tm[1])) $num = $tm[1];
                $title = trim($tm[2]);
                $chunk = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
            }

            $parsed = $this->parsedown->text(trim($chunk));

            $cardsHtml[] = '
            <div class="decision-card reveal">
                <div class="decision-num">' . htmlspecialchars($num, ENT_QUOTES, 'UTF-8') . '</div>
                <div class="decision-body">
                    <h3>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                    <div class="decision-content">' . $parsed . '</div>
                </div>
            </div>';
        }

        return '<div class="decision-list">' . implode("\n", $cardsHtml) . '</div>' . $questionHtml;
    }

    /**
     * Render Interactieve Management Checklist.
     */
    public function renderChecklistSection(string $markdown, array $attrs = []): string {
        $lines = explode("\n", trim($markdown));
        $itemsHtml = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Formaat: - [ ] Tekst of - [x] Tekst of - Tekst
            $checked = false;
            $text = $line;
            if (preg_match('/^-\s*\[([ xX])\]\s*(.+)$/', $line, $m)) {
                $checked = strtolower($m[1]) === 'x';
                $text = $m[2];
            } elseif (preg_match('/^-\s*(.+)$/', $line, $m)) {
                $text = $m[1];
            }

            $checkedClass = $checked ? ' checked' : '';
            $ariaChecked  = $checked ? 'true' : 'false';

            $itemsHtml[] = '
            <div class="check-item' . $checkedClass . '" role="checkbox" aria-checked="' . $ariaChecked . '" tabindex="0">
                <div class="check-box">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <span>' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</span>
            </div>';
        }

        return '<div class="checklist reveal">' . implode("\n", $itemsHtml) . '</div>';
    }

    /**
     * Render Scorecard Matrix (Rood / Oranje / Groen).
     */
    public function renderScorecardSection(string $markdown, array $attrs = []): string {
        $legendHtml = '
        <div class="legend reveal">
            <div class="legend-pill legend-red"><span class="dot"></span>Rood · Nulmeting (Vertrekpunt voor optimalisatie)</div>
            <div class="legend-pill legend-orange"><span class="dot"></span>Oranje · In ontwikkeling (Verdere verfijning mogelijk)</div>
            <div class="legend-pill legend-green"><span class="dot"></span>Groen · AI-Ready (Klaar voor schaalbaar succes)</div>
        </div>';

        // Verwerk eventuele Markdown tabel
        $tableHtml = $this->parsedown->text($markdown);
        // Voeg scorecard classes toe aan cellen
        $tableHtml = preg_replace('/<table>/i', '<table class="score-table reveal">', $tableHtml);

        return $legendHtml . $tableHtml;
    }

    /**
     * Render Split Media-Tekst Sectie (Afbeelding links of rechts naast tekst).
     */
    public function renderSplitSection(string $markdown, array $attrs = []): string {
        $image = $attrs['image'] ?? '';
        $imagePos = $attrs['image_pos'] ?? 'right';
        $ratio = $attrs['ratio'] ?? '50-50';
        $alt = $attrs['image_alt'] ?? ($attrs['title'] ?? 'Illustratie');

        // Detectie van afbeelding uit Markdown indien niet in attributen
        if (empty($image) && preg_match('/!\[(.*?)\]\((.*?)\)/', $markdown, $im)) {
            $alt = $im[1] ?: $alt;
            $image = $im[2];
            $markdown = str_replace($im[0], '', $markdown);
        }

        $posClass = ($imagePos === 'left') ? 'split-media-left' : 'split-media-right';
        $ratioClass = 'split-ratio-' . htmlspecialchars($ratio, ENT_QUOTES, 'UTF-8');

        $contentHtml = $this->parsedown->text(trim($markdown));

        return '
        <div class="split-grid ' . $posClass . ' ' . $ratioClass . '">
            <div class="split-media reveal">
                <img src="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') . '" loading="lazy">
            </div>
            <div class="split-content artikel-prose reveal">
                ' . $contentHtml . '
            </div>
        </div>';
    }

    /**
     * Render Gecentreerde Overlay Banner met Achtergrondafbeelding.
     */
    public function renderOverlaySection(string $markdown, array $attrs = []): string {
        $image = $attrs['image'] ?? '';
        $overlay = $attrs['overlay'] ?? 'dark';

        $parsed = $this->parsedown->text(trim($markdown));
        // Transformeer knoppen
        $parsed = preg_replace_callback('/<a\s+href="([^"]+)">([^<]+)<\/a>/i', function($m) {
            return '<a href="' . htmlspecialchars($this->formatUrl($m[1]), ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary btn-lg">' . $m[2] . ' <span aria-hidden="true">&rarr;</span></a>';
        }, $parsed);

        return '
        <div class="section-overlay-banner reveal">
            <div class="overlay-banner-media" aria-hidden="true">
                <img src="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" alt="" loading="lazy">
            </div>
            <div class="overlay-banner-overlay hero-overlay-' . htmlspecialchars($overlay, ENT_QUOTES, 'UTF-8') . '" aria-hidden="true"></div>
            <div class="overlay-banner-content">
                ' . $parsed . '
            </div>
        </div>';
    }

    /**
     * Render Dienstmodules (5-card grid + accordions).
     */
    public function renderModulesSection(string $markdown, array $attrs = []): string {
        $chunks = preg_split('/(?=^##\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $serviceCards = [];
        $accordionModules = [];

        foreach ($chunks as $index => $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            $idx = sprintf('%02d', $index + 1);
            $title = '';
            if (preg_match('/^##\s+(?:(\d+)\.\s*)?(.+)$/m', $chunk, $tm)) {
                if (!empty($tm[1])) $idx = sprintf('%02d', (int)$tm[1]);
                $title = trim($tm[2]);
                $chunk = preg_replace('/^##\s+.+$/m', '', $chunk, 1);
            }

            $icon = 'sparkles';
            if (preg_match('/\*Icoon:\s*(.*?)\*/i', $chunk, $im)) {
                $icon = strtolower(trim($im[1]));
                $chunk = str_replace($im[0], '', $chunk);
            }

            $result = '';
            if (preg_match('/\*Resultaat:\s*(.*?)\*/i', $chunk, $rm)) {
                $result = trim($rm[1]);
                $chunk = str_replace($rm[0], '', $chunk);
            }

            $sub = '';
            if (preg_match('/\*Sub:\s*(.*?)\*/i', $chunk, $sm)) {
                $sub = trim($sm[1]);
                $chunk = str_replace($sm[0], '', $chunk);
            }

            // Scheid korte samenvatting (eerste alinea) van module body
            $parts = preg_split('/\r?\n\r?\n/', trim($chunk), 2);
            $summaryText = trim($parts[0] ?? '');
            $detailBody = trim($parts[1] ?? $parts[0] ?? '');

            $serviceCards[] = '
            <div class="service-card reveal">
                <div class="idx">' . htmlspecialchars($idx, ENT_QUOTES, 'UTF-8') . '</div>
                <div class="icon-badge on-light sm" style="margin-bottom:14px;">' . $this->renderIconSvg($icon, 24) . '</div>
                <h4>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h4>
                <p>' . htmlspecialchars($summaryText, ENT_QUOTES, 'UTF-8') . '</p>
                ' . (!empty($result) ? '<div class="result">Resultaat: ' . htmlspecialchars($result, ENT_QUOTES, 'UTF-8') . '</div>' : '') . '
            </div>';

            $detailHtml = $this->parsedown->text($detailBody);

            $accordionModules[] = '
            <details class="module reveal">
                <summary>
                    <div class="module-title">
                        <div class="icon-badge on-light">' . $this->renderIconSvg($icon, 28) . '</div>
                        <div>
                            <h3>Module ' . (int)$idx . ' · ' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                            ' . (!empty($sub) ? '<div class="sub">' . htmlspecialchars($sub, ENT_QUOTES, 'UTF-8') . '</div>' : '') . '
                        </div>
                    </div>
                    <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </summary>
                <div class="module-body">
                    ' . $detailHtml . '
                </div>
            </details>';
        }

        return '
        <div class="service-grid reveal">
            ' . implode("\n", $serviceCards) . '
        </div>
        <div class="modules-accordion" style="max-width:820px; margin: 0 auto;">
            ' . implode("\n", $accordionModules) . '
        </div>';
    }

    /**
     * Render Conclusie & Contact Sectie met CTA Knoppen en Contact Grid.
     */
    public function renderContactSection(string $markdown, array $attrs = []): string {
        $contactCardsHtml = [];

        if (preg_match('/:::\s*contact-grid\r?\n(.*?)\r?\n:::/s', $markdown, $cm)) {
            $gridText = $cm[1];
            $markdown = str_replace($cm[0], '', $markdown);

            $lines = explode("\n", trim($gridText));
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line) || strpos($line, '-') !== 0) continue;

                $label = '';
                $url = '';
                $val = '';
                $icon = 'chat';

                if (preg_match('/-\s+\[(.*?)\]\((.*?)\):\s*(.+)/', $line, $lm)) {
                    $label = trim($lm[1]);
                    $url = trim($lm[2]);
                    $val = trim($lm[3]);
                } elseif (preg_match('/-\s+([^:]+):\s*(.+)/', $line, $lm)) {
                    $label = trim($lm[1]);
                    $val = trim($lm[2]);
                }

                $lowerLabel = strtolower($label);
                if (str_contains($lowerLabel, 'telefoon') || str_contains($lowerLabel, 'bel')) $icon = 'phone';
                elseif (str_contains($lowerLabel, 'mail')) $icon = 'email';
                elseif (str_contains($lowerLabel, 'web')) $icon = 'globe';
                elseif (str_contains($lowerLabel, 'adres')) $icon = 'pin';

                $iconSvg = $this->renderIconSvg($icon, 22);

                if (!empty($url)) {
                    $contactCardsHtml[] = '
                    <a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" class="contact-card reveal">
                        <div class="icon-badge sm">' . $iconSvg . '</div>
                        <div class="lbl">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="val">' . htmlspecialchars($val, ENT_QUOTES, 'UTF-8') . '</div>
                    </a>';
                } else {
                    $contactCardsHtml[] = '
                    <div class="contact-card reveal" style="cursor:default;">
                        <div class="icon-badge sm">' . $iconSvg . '</div>
                        <div class="lbl">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="val">' . htmlspecialchars($val, ENT_QUOTES, 'UTF-8') . '</div>
                    </div>';
                }
            }
        }

        $parsed = $this->parsedown->text(trim($markdown));

        // Transformeer knoppen
        $parsed = preg_replace_callback('/<a\s+href="([^"]+)">([^<]+)<\/a>/i', function($m) {
            $url = $m[1];
            $text = $m[2];
            $btnClass = (str_starts_with($url, 'tel:')) ? 'btn-ghost-dark' : 'btn-primary';
            return '<a href="' . htmlspecialchars($this->formatUrl($url), ENT_QUOTES, 'UTF-8') . '" class="btn ' . $btnClass . ' btn-lg">' . $text . '</a>';
        }, $parsed);

        $gridHtml = !empty($contactCardsHtml) ? '<div class="contact-grid reveal">' . implode("\n", $contactCardsHtml) . '</div>' : '';

        return '<div class="contact-section-inner prose center reveal" style="max-width:760px; margin: 0 auto;">' . $parsed . '</div>' . $gridHtml;
    }

    /**
     * Render Bronnen & Verantwoording Sectie.
     */
    public function renderSourcesSection(string $markdown, array $attrs = []): string {
        $title = $attrs['title'] ?? 'Bronnen en verantwoording';
        $parsed = $this->parsedown->text(trim($markdown));

        return '
        <div class="sources reveal">
            <div class="wrap">
                <h4>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h4>
                ' . $parsed . '
            </div>
        </div>';
    }

    /**
     * Render Interactieve Grafieken / Besliskader (bars & donut charts).
     */
    public function renderChartsSection(string $markdown, array $attrs = []): string {
        $chunks = preg_split('/(?=^#{2,3}\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $chartsHtml = [];

        foreach ($chunks as $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            $title = '';
            if (preg_match('/^#{2,3}\s+(.+)$/m', $chunk, $tm)) {
                $title = trim($tm[1]);
                $chunk = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
            }

            $note = '';
            if (preg_match('/^\*(?:Note|Toelichting):\s*(.*?)\*/m', $chunk, $nm)) {
                $note = trim($nm[1]);
                $chunk = preg_replace('/^\*(?:Note|Toelichting):\s*.*?\*/m', '', $chunk, 1);
            }

            $chartType = 'bars';
            if (preg_match('/^\*Type:\s*(.*?)\*/m', $chunk, $ctm)) {
                $chartType = strtolower(trim($ctm[1]));
                $chunk = preg_replace('/^\*Type:\s*.*?\*/m', '', $chunk, 1);
            }

            $centerLabel = 'Beheerde basis';
            if (preg_match('/^\*(?:Center|Label):\s*(.*?)\*/m', $chunk, $clm)) {
                $centerLabel = trim($clm[1]);
                $chunk = preg_replace('/^\*(?:Center|Label):\s*.*?\*/m', '', $chunk, 1);
            }

            $innerContentHtml = '';

            if ($chartType === 'donut') {
                $legendItems = [];
                $slices = [];
                $lines = explode("\n", trim($chunk));
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line) || strpos($line, '-') !== 0) continue;
                    if (preg_match('/^-\s+(.+?)(?::\s*(\d+)%?)?$/', $line, $lm)) {
                        $label = trim($lm[1]);
                        $pct = isset($lm[2]) ? (int)$lm[2] : 50;
                        $slices[] = ['label' => $label, 'pct' => $pct];
                        $legendItems[] = '<span>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>';
                    }
                }
                $firstPct = !empty($slices[0]['pct']) ? $slices[0]['pct'] : 72;
                $innerContentHtml = '
                <div class="donut-wrap">
                    <div class="donut" role="img" aria-label="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '" style="background: conic-gradient(var(--color-royal, #2060E0) 0% ' . $firstPct . '%, #CBD5E1 ' . $firstPct . '% 100%);">
                        <span class="donut-center-text">' . htmlspecialchars($centerLabel, ENT_QUOTES, 'UTF-8') . '</span>
                    </div>
                    <div class="legend">
                        ' . implode("\n", $legendItems) . '
                    </div>
                </div>';
            } else {
                // Default: bar chart
                $barRows = [];
                $lines = explode("\n", trim($chunk));
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line) || strpos($line, '-') !== 0) continue;
                    if (preg_match('/^-\s+(.+?):\s*(\d+)%?(?:\s*\|\s*([0-9.]+))?$/', $line, $bm)) {
                        $label = trim($bm[1]);
                        $pct   = $bm[2];
                        $score = $bm[3] ?? round((int)$pct / 20, 1);
                        $barRows[] = '
                        <div class="bar-row">
                            <span>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>
                            <div class="track"><div class="fill" style="width:' . (int)$pct . '%"></div></div>
                            <b>' . htmlspecialchars((string)$score, ENT_QUOTES, 'UTF-8') . '</b>
                        </div>';
                    }
                }
                $innerContentHtml = '<div class="bars">' . implode("\n", $barRows) . '</div>';
            }

            $chartsHtml[] = '
            <section class="chart reveal">
                <h3>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                ' . (!empty($note) ? '<p class="chart-note">' . htmlspecialchars($note, ENT_QUOTES, 'UTF-8') . '</p>' : '') . '
                ' . $innerContentHtml . '
            </section>';
        }

        return '<div class="chart-grid reveal">' . implode("\n", $chartsHtml) . '</div>';
    }

    /**
     * Render Stappenplan / Implementatie Roadmap.
     */
    public function renderRoadmapSection(string $markdown, array $attrs = []): string {
        $chunks = preg_split('/(?=^#{2,3}\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);
        $stepsHtml = [];

        foreach ($chunks as $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            $title = '';
            if (preg_match('/^#{2,3}\s+(?:(\d+)\.\s*)?(.+)$/m', $chunk, $tm)) {
                $title = trim($tm[2]);
                $chunk = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
            }

            $output = '';
            if (preg_match('/^\*(?:Output|Resultaat):\s*(.*?)\*/m', $chunk, $om)) {
                $output = trim($om[1]);
                $chunk = preg_replace('/^\*(?:Output|Resultaat):\s*.*?\*/m', '', $chunk, 1);
            }

            $desc = trim($chunk);

            $stepsHtml[] = '
            <article class="step reveal">
                <div>
                    <h3>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3>
                    <p>' . htmlspecialchars($desc, ENT_QUOTES, 'UTF-8') . '</p>
                </div>
                ' . (!empty($output) ? '<div class="output">Output: ' . htmlspecialchars($output, ENT_QUOTES, 'UTF-8') . '</div>' : '') . '
            </article>';
        }

        return '<div class="roadmap reveal">' . implode("\n", $stepsHtml) . '</div>';
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

        // Shortcodes voor pill badges in tabellen en prose: [pill:Tekst] of [badge:Tekst]
        $html = preg_replace('/\[(?:pill|badge):([^\]]+)\]/i', '<span class="pill">$1</span>', $html);

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

        // Aliassen mappen naar beschikbare iconen
        $aliases = [
            'mail'    => 'email',
            'data'    => 'dashboard',
            'people'  => 'team',
            'spark'   => 'sparkles',
            'process' => 'workflow',
            'target'  => 'target',
        ];
        if (isset($aliases[$safeName])) {
            $safeName = $aliases[$safeName];
        }

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

        // Inline SVGs voor extra iconen
        if ($safeName === 'phone') {
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="noppa-icon"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>';
        }
        if ($safeName === 'pin') {
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="noppa-icon"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
        }
        if ($safeName === 'globe') {
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="noppa-icon"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>';
        }
        if ($safeName === 'scale') {
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="noppa-icon"><path d="M12 3v18M12 3l-6 3m6-3l6 3M4 9l2.5 6a2.5 2.5 0 0 0 5 0L9 9m10 0l-2.5 6a2.5 2.5 0 0 1-5 0L14 9M4 9h5m5 0h5"></path></svg>';
        }
        if ($safeName === 'warn') {
            return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="noppa-icon"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>';
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
