<?php
header('Content-Type: application/rss+xml; charset=utf-8');

define('CONTENT_DIR', __DIR__ . '/content/artikelen/');

// ── Haal siteURL op uit nav.json ──────────────────────────────
$navJson  = file_get_contents(__DIR__ . '/nav.json');
$nav      = json_decode($navJson, true);
$sitenaam = $nav['sitenaam'] ?? 'Buro GEKKO';
$siteUrl  = $nav['siteUrl'] ?? (
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
);
$kennisbankUrl = rtrim($siteUrl, '/') . '/kennisbank/';

// ── Frontmatter parser ────────────────────────────────────────
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

function extractH1(string $md): ?string {
    if (preg_match('/^#\s+(.+)/m', $md, $m)) return trim($m[1]);
    return null;
}

function excerpt(string $md, int $len = 200): string {
    $text = preg_replace('/^#{1,6}\s+.+$/m', '', $md);
    $text = preg_replace('/\*{1,2}(.+?)\*{1,2}/', '$1', $text);
    $text = preg_replace('/\[(.+?)\]\(.+?\)/', '$1', $text);
    $text = preg_replace('/`(.+?)`/', '$1', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    return mb_strlen($text) > $len ? mb_substr($text, 0, $len) . '…' : $text;
}

// ── Laad en sorteer artikelen ─────────────────────────────────
$files = glob(CONTENT_DIR . '*.md') ?: [];
$items = [];

foreach ($files as $file) {
    $slug = basename($file, '.md');
    $raw  = file_get_contents($file);
    $p    = parseFrontmatter($raw);
    if (($p['meta']['status'] ?? '') === 'concept') continue;

    $title = $p['meta']['title'] ?? extractH1($p['body']) ?? ucwords(str_replace('-', ' ', $slug));
    $datum = $p['meta']['datum'] ?? $p['meta']['date'] ?? null;
    $desc  = $p['meta']['beschrijving'] ?? $p['meta']['description'] ?? excerpt($p['body']);

    $items[] = [
        'slug'   => $slug,
        'title'  => $title,
        'datum'  => $datum,
        'desc'   => $desc,
        'cat'    => $p['meta']['categorie'] ?? $p['meta']['category'] ?? null,
        'auteur' => $p['meta']['auteur'] ?? $p['meta']['author'] ?? null,
    ];
}

usort($items, function($a, $b) {
    if (!$a['datum'] && !$b['datum']) return 0;
    if (!$a['datum']) return 1;
    if (!$b['datum']) return -1;
    return strcmp($b['datum'], $a['datum']);
});

// ── RSS XML genereren ─────────────────────────────────────────
$lastBuild = !empty($items) && $items[0]['datum']
    ? date(DATE_RSS, strtotime($items[0]['datum']))
    : date(DATE_RSS);

$esc = fn($s) => htmlspecialchars($s ?? '', ENT_XML1, 'UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
echo '<channel>' . "\n";
echo '  <title>' . $esc($sitenaam) . ' — Kennisbank</title>' . "\n";
echo '  <link>' . $esc($kennisbankUrl) . '</link>' . "\n";
echo '  <description>Praktische gidsen, how-to&apos;s en diepgaande analyses van ' . $esc($sitenaam) . '</description>' . "\n";
echo '  <language>nl-nl</language>' . "\n";
echo '  <lastBuildDate>' . $lastBuild . '</lastBuildDate>' . "\n";
echo '  <atom:link href="' . $esc($kennisbankUrl . 'rss.php') . '" rel="self" type="application/rss+xml"/>' . "\n\n";

foreach ($items as $item) {
    $url     = $esc($kennisbankUrl . '#/artikel/' . $item['slug']);
    $pubDate = $item['datum'] ? date(DATE_RSS, strtotime($item['datum'])) : date(DATE_RSS);
    echo '  <item>' . "\n";
    echo '    <title>'       . $esc($item['title'])  . '</title>'       . "\n";
    echo '    <link>'        . $url                  . '</link>'        . "\n";
    echo '    <guid>'        . $url                  . '</guid>'        . "\n";
    echo '    <pubDate>'     . $pubDate               . '</pubDate>'     . "\n";
    echo '    <description>' . $esc($item['desc'])   . '</description>' . "\n";
    if ($item['cat'])    echo '    <category>' . $esc($item['cat'])    . '</category>' . "\n";
    if ($item['auteur']) echo '    <author>'   . $esc($item['auteur']) . '</author>'   . "\n";
    echo '  </item>' . "\n\n";
}

echo '</channel>' . "\n";
echo '</rss>' . "\n";
