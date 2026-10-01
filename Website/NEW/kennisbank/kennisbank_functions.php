<?php
// =========================================================================
// Noppa Solutions & Consultants — Kennisbank Functions
// =========================================================================

define('CONTENT_DIR', dirname(__DIR__) . '/content/kennisbank/');

require_once dirname(__DIR__) . '/includes/content_loader.php';

function getArtikelen($cat = '') {
    $dir = CONTENT_DIR;
    if (!is_dir($dir)) return [];
    
    $files = glob($dir . '*.md') ?: [];
    $lijst = [];
    foreach ($files as $file) {
        $s = basename($file, '.md');
        if ($s === 'index') continue;
        
        $raw = file_get_contents($file);
        $p   = parseFrontmatter($raw);

        if (($p['meta']['status'] ?? '') === 'concept') continue;
        if ($cat && strtolower($p['meta']['categorie'] ?? '') !== strtolower($cat)) continue;

        $title = $p['meta']['title'] ?? extractH1($p['body']) ?? slugToTitle($s);
        $lijst[] = [
            'slug'         => $s,
            'title'        => $title,
            'beschrijving' => $p['meta']['beschrijving'] ?? $p['meta']['description'] ?? extractExcerpt($p['body']),
            'datum'        => $p['meta']['datum'] ?? $p['meta']['date'] ?? null,
            'categorie'    => $p['meta']['categorie'] ?? $p['meta']['category'] ?? 'Algemeen',
            'auteur'       => $p['meta']['auteur'] ?? $p['meta']['author'] ?? 'Noppa Team',
            'leestijd'     => $p['meta']['leestijd'] ?? calculateReadingTime($p['body']),
        ];
    }
    
    usort($lijst, function($a, $b) {
        $da = strtotime($a['datum'] ?? '2000-01-01');
        $db = strtotime($b['datum'] ?? '2000-01-01');
        return $db <=> $da;
    });
    
    return $lijst;
}

function getArtikel($slug) {
    $safeSlug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
    $file = CONTENT_DIR . $safeSlug . '.md';
    if (!file_exists($file)) {
        // Fallback check in subfolder indien nodig
        $file = CONTENT_DIR . 'artikelen/' . $safeSlug . '.md';
        if (!file_exists($file)) return null;
    }
    $raw = file_get_contents($file);
    return parseFrontmatter($raw);
}
