<?php
// =========================================================================
// Noppa Solutions & Consultants — Markdown Content Loader Engine
// Standardized according to noppa-website-content & noppa-website-master
// =========================================================================

define('NOPPA_ROOT', dirname(__DIR__) . '/');
define('NOPPA_CONTENT_DIR', NOPPA_ROOT . 'content/');
define('NOPPA_ICONS_DIR', NOPPA_ROOT . 'assets/icons/');

require_once __DIR__ . '/Parsedown.php';

/**
 * Parsen van YAML frontmatter en body uit een ruw markdown bestand.
 */
function parseFrontmatter(string $raw): array {
    if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
        $meta = [];
        $lines = explode("\n", trim($matches[1]));
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) continue;
            if (strpos($line, ':') !== false) {
                [$key, $val] = explode(':', $line, 2);
                $key = trim($key);
                $val = trim($val);
                // Strip quotes indien aanwezig
                $val = trim($val, "\"'");
                // Check boolean
                if (strtolower($val) === 'true') $val = true;
                elseif (strtolower($val) === 'false') $val = false;
                $meta[$key] = $val;
            }
        }
        return ['meta' => $meta, 'body' => $matches[2]];
    }
    return ['meta' => [], 'body' => $raw];
}

/**
 * Laad een markdown bestand in en parseer metadata en content.
 */
function loadMarkdownFile(string $filepath): ?array {
    if (!file_exists($filepath)) {
        return null;
    }
    $raw = file_get_contents($filepath);
    $parsed = parseFrontmatter($raw);
    
    // Voeg automatische fallbacks toe indien frontmatter ontbreekt
    if (empty($parsed['meta']['title'])) {
        $parsed['meta']['title'] = extractH1($parsed['body']) ?? slugToTitle(basename($filepath, '.md'));
    }
    if (empty($parsed['meta']['description']) && empty($parsed['meta']['beschrijving'])) {
        $parsed['meta']['description'] = extractExcerpt($parsed['body']);
    }
    
    return $parsed;
}

/**
 * Converteer een slug naar een leesbare titel.
 */
function slugToTitle(string $slug): string {
    return ucwords(str_replace(['-', '_'], ' ', $slug));
}

/**
 * Extraheer de eerste H1 uit Markdown.
 */
function extractH1(string $md): ?string {
    if (preg_match('/^#\s+(.+)/m', $md, $m)) {
        return trim($m[1]);
    }
    return null;
}

/**
 * Genereer een samenvatting / excerpt zonder opmaak.
 */
function extractExcerpt(string $md, int $length = 160): string {
    $text = preg_replace('/^#{1,6}\s+.+$/m', '', $md);
    $text = preg_replace('/\*{1,2}(.+?)\*{1,2}/', '$1', $text);
    $text = preg_replace('/\[(.+?)\]\(.+?\)/', '$1', $text);
    $text = preg_replace('/`(.+?)`/', '$1', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    return mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '…' : $text;
}

/**
 * Bereken leestijd in minuten (o.b.v. 200 woorden per minuut).
 */
function calculateReadingTime(string $md): int {
    $words = str_word_count(strip_tags($md));
    $minutes = ceil($words / 200);
    return max(1, (int)$minutes);
}

/**
 * Datum formatting in het Nederlands (bijv. 12 januari 2026).
 */
function formatDatumNL(?string $datumStr): string {
    if (!$datumStr) return '';
    $maanden = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
    $t = strtotime($datumStr);
    if (!$t) return $datumStr;
    return date('j', $t) . ' ' . $maanden[date('n', $t)-1] . ' ' . date('Y', $t);
}

/**
 * Genereer een veilige anker-slug van een heading titel.
 */
function headingToSlug(string $title): string {
    $slug = strtolower(strip_tags($title));
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    return trim($slug, '-');
}

/**
 * Render Markdown naar HTML met ondersteuning voor TOC extractie en ID injectie.
 */
function renderMarkdown(string $markdown, array $options = []): array {
    $stripH1 = $options['stripH1'] ?? false;
    $toc = [];
    
    // Optioneel H1 verwijderen omdat deze al in de hero staat
    if ($stripH1) {
        $markdown = preg_replace('/^#\s+(.+)$/m', '', $markdown);
    }
    
    // Voeg automatische ankers toe aan H2 en H3 koppen
    $lines = explode("\n", $markdown);
    $newLines = [];
    foreach ($lines as $line) {
        if (preg_match('/^(#{2,3})\s+(.+)$/', $line, $m)) {
            $level = strlen($m[1]);
            $title = trim($m[2]);
            $slug = headingToSlug($title);
            $toc[] = [
                'level' => $level,
                'title' => $title,
                'slug'  => $slug
            ];
            // Markdown inline anchor toevoegen of HTML heading
            $newLines[] = "<h{$level} id=\"{$slug}\">{$title}</h{$level}>";
        } else {
            $newLines[] = $line;
        }
    }
    $processedMarkdown = implode("\n", $newLines);
    
    $parsedown = new Parsedown();
    $parsedown->setSafeMode(false); // We vertrouwen onze eigen markdown bestanden
    $html = $parsedown->text($processedMarkdown);
    
    // Optionele shortcode vervanging voor Noppa Iconen: [icon:shield] of *Icoon: shield*
    $html = preg_replace_callback('/(?:\[icon:([a-z0-9_-]+)\]|\*Icoon:\s*([a-z0-9_-]+)\*)/i', function($m) use ($options) {
        $iconName = !empty($m[1]) ? $m[1] : $m[2];
        $base = $options['base'] ?? '';
        return "<span class=\"noppa-icon-wrap\"><img src=\"{$base}assets/icons/{$iconName}.svg\" alt=\"{$iconName}\" class=\"noppa-icon\" width=\"28\" height=\"28\"></span>";
    }, $html);

    return [
        'html' => $html,
        'toc'  => $toc
    ];
}

/**
 * Haal een statische pagina op uit content/pages/{slug}.md
 */
function getPageContent(string $slug): ?array {
    $file = NOPPA_CONTENT_DIR . 'pages/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.md';
    return loadMarkdownFile($file);
}

/**
 * Haal een dienst op uit content/diensten/{slug}.md
 */
function getDienstContent(string $slug): ?array {
    $file = NOPPA_CONTENT_DIR . 'diensten/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.md';
    return loadMarkdownFile($file);
}

/**
 * Haal een teamlid op uit content/team/{slug}.md
 */
function getTeamMemberContent(string $slug): ?array {
    $file = NOPPA_CONTENT_DIR . 'team/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.md';
    return loadMarkdownFile($file);
}

/**
 * Haal een kennisbank artikel op uit content/kennisbank/{slug}.md
 */
function getKennisbankArtikel(string $slug): ?array {
    $file = NOPPA_CONTENT_DIR . 'kennisbank/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.md';
    return loadMarkdownFile($file);
}

/**
 * Haal een lijst van alle kennisbank artikelen op (gesorteerd op datum aflopend).
 */
function getKennisbankArtikelen(string $cat = ''): array {
    $dir = NOPPA_CONTENT_DIR . 'kennisbank/';
    if (!is_dir($dir)) return [];
    
    $files = glob($dir . '*.md') ?: [];
    $lijst = [];
    
    foreach ($files as $file) {
        $slug = basename($file, '.md');
        if ($slug === 'index') continue; // Skip de index pagina zelf
        
        $item = loadMarkdownFile($file);
        if (!$item) continue;
        
        $meta = $item['meta'];
        if (($meta['status'] ?? '') === 'concept') continue;
        if ($cat && strtolower($meta['categorie'] ?? '') !== strtolower($cat)) continue;
        
        $title = $meta['title'] ?? extractH1($item['body']) ?? slugToTitle($slug);
        $desc = $meta['beschrijving'] ?? $meta['description'] ?? extractExcerpt($item['body']);
        $readTime = $meta['leestijd'] ?? calculateReadingTime($item['body']);
        
        $lijst[] = [
            'slug'         => $slug,
            'title'        => $title,
            'beschrijving' => $desc,
            'datum'        => $meta['datum'] ?? $meta['date'] ?? null,
            'categorie'    => $meta['categorie'] ?? $meta['category'] ?? 'Algemeen',
            'auteur'       => $meta['auteur'] ?? $meta['author'] ?? 'Noppa Team',
            'leestijd'     => $readTime,
            'icoon'        => $meta['icoon'] ?? $meta['icon'] ?? 'document'
        ];
    }
    
    usort($lijst, function($a, $b) {
        $da = strtotime($a['datum'] ?? '2000-01-01');
        $db = strtotime($b['datum'] ?? '2000-01-01');
        return $db <=> $da;
    });
    
    return $lijst;
}

/**
 * Helper om een Noppa vector icon renderen.
 */
function renderNoppaIcon(string $name, string $class = '', int $size = 28, string $base = ''): string {
    $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
    return "<img src=\"{$base}assets/icons/{$safeName}.svg\" alt=\"{$safeName}\" class=\"noppa-icon {$class}\" width=\"{$size}\" height=\"{$size}\" loading=\"lazy\">";
}
