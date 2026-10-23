<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Dynamic XML Sitemap Generator
 * Standardized according to all Noppa skills:
 * - Scans content/pages/, data/diensten/, data/team/,
 *   content/kennisbank/artikelen/ and data/legal/
 * - Adheres strictly to the Sitemaps XML protocol (0.9)
 * - Supports HTTP response, CLI execution, and static XML file generation
 * =========================================================================
 */

$baseDir = __DIR__;
$siteConfigFile = $baseDir . '/site.config.php';
$siteConfig     = file_exists($siteConfigFile) ? require $siteConfigFile : [];

$baseUrl = rtrim($siteConfig['base_url'] ?? 'https://noppa.nl', '/');

$pagesDir    = $siteConfig['paths']['content'] ?? ($baseDir . '/content/pages');
if (is_dir($baseDir . '/content/pages') && !isset($siteConfig['paths']['content_pages'])) {
    $pagesDir = $baseDir . '/content/pages';
}
$dienstenDir = $siteConfig['paths']['diensten'] ?? ($baseDir . '/data/diensten');
$teamDir     = $siteConfig['paths']['team'] ?? ($baseDir . '/data/team');
$kbDir       = $siteConfig['paths']['kennisbank'] ?? ($baseDir . '/content/kennisbank/artikelen');
$legalDir    = $siteConfig['paths']['legal'] ?? ($baseDir . '/data/legal');

$urls = [];

// Helper om bestand te inspecteren op noindex, priority en changefreq
function inspectMeta(string $filePath, string $defaultPrio, string $defaultFreq): ?array {
    if (!file_exists($filePath)) return null;
    $raw = file_get_contents($filePath);
    if (preg_match('/robots:\s*.*noindex/i', $raw)) {
        return null;
    }
    $priority = $defaultPrio;
    $changefreq = $defaultFreq;
    if (preg_match('/priority:\s*([0-9.]+)/i', $raw, $pm)) {
        $priority = trim($pm[1]);
    }
    if (preg_match('/changefreq:\s*([a-z]+)/i', $raw, $cm)) {
        $changefreq = trim($cm[1]);
    }
    $lastmod = date('Y-m-d', filemtime($filePath));
    return [
        'priority'   => $priority,
        'changefreq' => $changefreq,
        'lastmod'    => $lastmod
    ];
}

// 1. Homepage
$homeMeta = inspectMeta($pagesDir . '/home.md', '1.0', 'weekly');
if ($homeMeta) {
    $urls[] = [
        'loc'        => $baseUrl . '/',
        'lastmod'    => $homeMeta['lastmod'],
        'changefreq' => $homeMeta['changefreq'],
        'priority'   => $homeMeta['priority']
    ];
}

// 2. Belangrijkste overzichtspagina's
$corePages = [
    'diensten'   => ['prio' => '0.9', 'freq' => 'weekly'],
    'kennisbank' => ['prio' => '0.9', 'freq' => 'weekly'],
    'over-ons'   => ['prio' => '0.8', 'freq' => 'monthly'],
    'contact'    => ['prio' => '0.8', 'freq' => 'monthly'],
];

foreach ($corePages as $slug => $defaults) {
    $meta = inspectMeta($pagesDir . '/' . $slug . '.md', $defaults['prio'], $defaults['freq']);
    if ($meta) {
        $urls[] = [
            'loc'        => $baseUrl . '/' . $slug,
            'lastmod'    => $meta['lastmod'],
            'changefreq' => $meta['changefreq'],
            'priority'   => $meta['priority']
        ];
    }
}

// Overige content/pages/ (exclusief 404, home, interne drafts, en al verwerkte core pages)
$allPageFiles = glob($pagesDir . '/*.md') ?: [];
$skipPages = array_merge(['home', '404', 'Copilot-Realiteitscheck-Noppa'], array_keys($corePages));

foreach ($allPageFiles as $pFile) {
    $slug = basename($pFile, '.md');
    if (in_array($slug, $skipPages, true)) continue;
    $meta = inspectMeta($pFile, '0.8', 'monthly');
    if ($meta) {
        $urls[] = [
            'loc'        => $baseUrl . '/' . $slug,
            'lastmod'    => $meta['lastmod'],
            'changefreq' => $meta['changefreq'],
            'priority'   => $meta['priority']
        ];
    }
}

// 3. Diensten detailpagina's (data/diensten/*.md)
if ($siteConfig['modules']['diensten'] ?? true) {
    $dienstenFiles = glob($dienstenDir . '/*.md') ?: [];
    foreach ($dienstenFiles as $dFile) {
        $slug = basename($dFile, '.md');
        $meta = inspectMeta($dFile, '0.9', 'monthly');
        if ($meta) {
            $urls[] = [
                'loc'        => $baseUrl . '/diensten/' . $slug,
                'lastmod'    => $meta['lastmod'],
                'changefreq' => $meta['changefreq'],
                'priority'   => $meta['priority']
            ];
        }
    }
}

// 4. Teamlid profielen (data/team/*.md)
if ($siteConfig['modules']['team'] ?? true) {
    $teamFiles = glob($teamDir . '/*.md') ?: [];
    foreach ($teamFiles as $tFile) {
        $slug = basename($tFile, '.md');
        $meta = inspectMeta($tFile, '0.7', 'monthly');
        if ($meta) {
            $urls[] = [
                'loc'        => $baseUrl . '/team/' . $slug,
                'lastmod'    => $meta['lastmod'],
                'changefreq' => $meta['changefreq'],
                'priority'   => $meta['priority']
            ];
        }
    }
}

// 5. Kennisbank artikelen (content/kennisbank/artikelen/*.md)
if ($siteConfig['modules']['kennisbank'] ?? true) {
    $kbFiles = glob($kbDir . '/*.md') ?: [];
    foreach ($kbFiles as $kbFile) {
        $slug = basename($kbFile, '.md');
        if ($slug === 'index' || $slug === 'README' || $slug === 'Prompt-Researcher-Due_diligence') continue;
        $meta = inspectMeta($kbFile, '0.8', 'monthly');
        if ($meta) {
            $urls[] = [
                'loc'        => $baseUrl . '/kennisbank/' . $slug,
                'lastmod'    => $meta['lastmod'],
                'changefreq' => $meta['changefreq'],
                'priority'   => $meta['priority']
            ];
        }
    }
}

// 6. Juridische pagina's (data/legal/*.md)
if ($siteConfig['modules']['legal'] ?? true) {
    $legalFiles = glob($legalDir . '/*.md') ?: [];
    foreach ($legalFiles as $lFile) {
        $slug = basename($lFile, '.md');
        $meta = inspectMeta($lFile, '0.5', 'monthly');
        if ($meta) {
            $urls[] = [
                'loc'        => $baseUrl . '/' . $slug,
                'lastmod'    => $meta['lastmod'],
                'changefreq' => $meta['changefreq'],
                'priority'   => $meta['priority']
            ];
        }
    }
}

// XML samenstellen
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($urls as $u) {
    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($u['loc'], ENT_QUOTES, 'UTF-8') . "</loc>\n";
    $xml .= "    <lastmod>" . $u['lastmod'] . "</lastmod>\n";
    $xml .= "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
    $xml .= "    <priority>" . $u['priority'] . "</priority>\n";
    $xml .= "  </url>\n";
}

$xml .= '</urlset>' . "\n";

// Als ?save=1 of CLI argument --save is meegegeven, schrijf ook direct naar static sitemap.xml
if (isset($_GET['save']) || in_array('--save', $argv ?? [], true)) {
    file_put_contents($baseDir . '/sitemap.xml', $xml);
}

// Output headers indien niet via CLI
if (php_sapi_name() !== 'cli' && !headers_sent()) {
    header('Content-Type: application/xml; charset=utf-8');
}

echo $xml;
