<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Dynamic XML Sitemap Generator
 * Automatically scans content/pages/ and builds a search-engine ready sitemap
 * =========================================================================
 */

$baseUrl = 'https://noppa.nl';
$pagesDir = __DIR__ . '/content/pages';

$files = glob($pagesDir . '/*.md') ?: [];

header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($files as $file) {
    $slug = basename($file, '.md');
    
    // Skip 404 pagina
    if ($slug === '404') {
        continue;
    }

    $lastMod = date('Y-m-d', filemtime($file));
    $urlPath = ($slug === 'home') ? '/' : '/' . $slug;
    $fullUrl = $baseUrl . $urlPath;

    // Prioriteit en frequentie
    $priority = ($slug === 'home') ? '1.0' : '0.8';
    $changefreq = ($slug === 'home') ? 'weekly' : 'monthly';

    // Optionele override via frontmatter
    $raw = file_get_contents($file);
    if (preg_match('/^---\r?\n(.*?)\r?\n---/s', $raw, $m)) {
        if (preg_match('/priority:\s*([0-9.]+)/i', $m[1], $pm)) {
            $priority = trim($pm[1]);
        }
        if (preg_match('/changefreq:\s*([a-z]+)/i', $m[1], $cm)) {
            $changefreq = trim($cm[1]);
        }
        if (preg_match('/robots:\s*.*noindex/i', $m[1])) {
            continue; // Skip noindex pagina's
        }
    }

    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($fullUrl, ENT_QUOTES, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>" . $lastMod . "</lastmod>\n";
    echo "    <changefreq>" . $changefreq . "</changefreq>\n";
    echo "    <priority>" . $priority . "</priority>\n";
    echo "  </url>\n";
}

// Voeg teamleden toe vanuit data/team/
$teamDir = __DIR__ . '/data/team';
$teamFiles = glob($teamDir . '/*.md') ?: [];

foreach ($teamFiles as $teamFile) {
    $teamId = basename($teamFile, '.md');
    $lastMod = date('Y-m-d', filemtime($teamFile));
    $fullUrl = $baseUrl . '/team/' . $teamId;

    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($fullUrl, ENT_QUOTES, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>" . $lastMod . "</lastmod>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>\n";
}

// Voeg Kennisbank hoofdpagina en artikelen toe
$kbDir = __DIR__ . '/content/kennisbank/artikelen';
$kbFiles = glob($kbDir . '/*.md') ?: [];

echo "  <url>\n";
echo "    <loc>" . htmlspecialchars($baseUrl . '/kennisbank', ENT_QUOTES, 'UTF-8') . "</loc>\n";
echo "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
echo "    <changefreq>weekly</changefreq>\n";
echo "    <priority>0.9</priority>\n";
echo "  </url>\n";

foreach ($kbFiles as $kbFile) {
    $artSlug = basename($kbFile, '.md');
    if ($artSlug === 'index' || $artSlug === 'README') continue;
    
    $lastMod = date('Y-m-d', filemtime($kbFile));
    $fullUrl = $baseUrl . '/kennisbank/' . $artSlug;

    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($fullUrl, ENT_QUOTES, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>" . $lastMod . "</lastmod>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.8</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>' . "\n";
