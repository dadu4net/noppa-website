<?php
define('CONTENT_DIR', __DIR__ . '/content/');

function parseFrontmatter(string $raw): array {
    if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $m)) {
        $meta = [];
        foreach (explode("\n", trim($m[1])) as $line) {
            if (strpos($line, ':') !== false) {
                [$key, $val] = explode(':', $line, 2);
                $meta[trim($key)] = trim($val);
            }
        }
        return ['meta' => $meta, 'body' => $m[2]];
    }
    return ['meta' => [], 'body' => $raw];
}

function slugToTitle(string $slug): string {
    return ucwords(str_replace('-', ' ', $slug));
}

function extractH1(string $md): ?string {
    if (preg_match('/^#\s+(.+)/m', $md, $m)) return trim($m[1]);
    return null;
}

function extractExcerpt(string $md, int $length = 160): string {
    $text = preg_replace('/^#{1,6}\s+.+$/m', '', $md);
    $text = preg_replace('/\*{1,2}(.+?)\*{1,2}/', '$1', $text);
    $text = preg_replace('/\[(.+?)\]\(.+?\)/', '$1', $text);
    $text = preg_replace('/`(.+?)`/', '$1', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    return mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '…' : $text;
}

function getArtikelen($cat = '') {
    $dir  = CONTENT_DIR . 'artikelen/';
    if (!is_dir($dir)) return [];
    $files = glob($dir . '*.md') ?: [];
    $lijst = [];
    foreach ($files as $file) {
        $s   = basename($file, '.md');
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
            'categorie'    => $p['meta']['categorie'] ?? $p['meta']['category'] ?? null,
            'auteur'       => $p['meta']['auteur'] ?? $p['meta']['author'] ?? null,
            'leestijd'     => $p['meta']['leestijd'] ?? null,
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
    $file = CONTENT_DIR . 'artikelen/' . preg_replace('/[^a-zA-Z0-9_-]/', '', $slug) . '.md';
    if (!file_exists($file)) return null;
    $raw = file_get_contents($file);
    return parseFrontmatter($raw);
}

// Datum formattering
function formatDatumNL($datumStr) {
    if (!$datumStr) return '';
    $maanden = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
    $t = strtotime($datumStr);
    return date('j', $t) . ' ' . $maanden[date('n', $t)-1] . ' ' . date('Y', $t);
}
?>
