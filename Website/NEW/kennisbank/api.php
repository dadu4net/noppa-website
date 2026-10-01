<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

define('CONTENT_DIR', __DIR__ . '/content/');
define('TEAM_DIR',    __DIR__ . '/../team/');

// ── Helper: parse optionele YAML frontmatter ──────────────────
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

// "Rik Dobbelsteen" → "rik-dobbelsteen"
function naamNaarSlug(string $naam): string {
    $s = mb_strtolower($naam);
    $s = preg_replace('/[^a-z0-9\s-]/u', '', $s);
    $s = trim($s);
    return preg_replace('/\s+/', '-', $s);
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

// ── Routing ───────────────────────────────────────────────────
$action = $_GET['actie'] ?? $_GET['action'] ?? '';
$slug   = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['slug'] ?? '');
$cat    = $_GET['categorie'] ?? '';

// ── GET ?actie=paginas — alle .md bestanden in content/ ───────
if ($action === 'paginas') {
    $files = glob(CONTENT_DIR . '*.md') ?: [];
    $paginas = [];
    foreach ($files as $file) {
        $s   = basename($file, '.md');
        $raw = file_get_contents($file);
        $p   = parseFrontmatter($raw);
        $title = $p['meta']['title'] ?? extractH1($p['body']) ?? slugToTitle($s);
        $paginas[] = [
            'slug'         => $s,
            'title'        => $title,
            'beschrijving' => $p['meta']['beschrijving'] ?? $p['meta']['description'] ?? null,
            'datum'        => $p['meta']['datum'] ?? $p['meta']['date'] ?? null,
            'bestand'      => basename($file),
        ];
    }
    usort($paginas, fn($a,$b) => $a['slug']==='index' ? -1 : ($b['slug']==='index' ? 1 : strcasecmp($a['title'],$b['title'])));
    echo json_encode($paginas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_INVALID_UTF8_SUBSTITUTE);

// ── GET ?actie=artikelen — alle artikelen met meta ────────────
} elseif ($action === 'artikelen') {
    $dir  = CONTENT_DIR . 'artikelen/';
    if (!is_dir($dir)) {
        echo json_encode([], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        exit;
    }
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
        if (!$a['datum'] && !$b['datum']) return 0;
        if (!$a['datum']) return 1;
        if (!$b['datum']) return -1;
        return strcmp($b['datum'], $a['datum']);
    });
    echo json_encode($lijst, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_INVALID_UTF8_SUBSTITUTE);

// ── GET ?actie=artikel&slug=xxx — één artikel ─────────────────
} elseif ($action === 'artikel') {
    if (!$slug) { http_response_code(400); echo json_encode(['fout'=>'Geen slug']); exit; }
    $file = CONTENT_DIR . 'artikelen/' . $slug . '.md';
    if (!file_exists($file)) { http_response_code(404); echo json_encode(['fout'=>"Artikel '$slug' niet gevonden"]); exit; }
    $raw  = file_get_contents($file);
    $p    = parseFrontmatter($raw);
    $title = $p['meta']['title'] ?? extractH1($p['body']) ?? slugToTitle($slug);
    echo json_encode([
        'slug'         => $slug,
        'title'        => $title,
        'meta'         => $p['meta'],
        'beschrijving' => $p['meta']['beschrijving'] ?? $p['meta']['description'] ?? extractExcerpt($p['body']),
        'datum'        => $p['meta']['datum'] ?? $p['meta']['date'] ?? null,
        'categorie'    => $p['meta']['categorie'] ?? $p['meta']['category'] ?? null,
        'auteur'       => $p['meta']['auteur'] ?? $p['meta']['author'] ?? null,
        'leestijd'     => $p['meta']['leestijd'] ?? null,
        'markdown'     => $p['body'],
    ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);

// ── GET ?actie=pagina&slug=xxx — één gewone pagina ────────────
} elseif ($action === 'pagina') {
    if (!$slug) { http_response_code(400); echo json_encode(['fout'=>'Geen slug']); exit; }
    $file = CONTENT_DIR . $slug . '.md';
    if (!file_exists($file)) { http_response_code(404); echo json_encode(['fout'=>"Pagina '$slug' niet gevonden"]); exit; }
    $raw  = file_get_contents($file);
    $p    = parseFrontmatter($raw);
    $title = $p['meta']['title'] ?? extractH1($p['body']) ?? slugToTitle($slug);
    echo json_encode([
        'slug'     => $slug,
        'title'    => $title,
        'meta'     => $p['meta'],
        'markdown' => $p['body'],
    ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);

// ── GET ?actie=auteur&slug=rik-dobbelsteen ────────────────────
// Leest team-profiel uit /output/team/<slug>.html en haalt
// auteur-metadata op via 'auteur:*' meta-tags. Valt terug op
// bestaande Noppa Solutions & Consultants team-page selectors (.profile-name,
// .profile-role, .body-text) zodat het werkt zonder dat we
// elke team-pagina hoeven aan te passen.
} elseif ($action === 'auteur') {
    if (!$slug) { http_response_code(400); echo json_encode(['fout'=>'Geen slug']); exit; }

    $file = TEAM_DIR . $slug . '.html';
    if (!file_exists($file)) {
        http_response_code(404);
        echo json_encode(['fout' => "Auteursprofiel '$slug' niet gevonden", 'slug' => $slug]);
        exit;
    }

    $html = file_get_contents($file);

    // Helper: haal meta-tag op via name of property attribuut
    $meta = function(string $name) use ($html): string {
        if (preg_match('/<meta[^>]+(?:name|property)=["\']' . preg_quote($name, '/') . '["\'][^>]+content=["\']([^"\']*)["\'][^>]*>/i', $html, $m)) return trim($m[1]);
        if (preg_match('/<meta[^>]+content=["\']([^"\']*)["\'][^>]+(?:name|property)=["\']' . preg_quote($name, '/') . '["\'][^>]*>/i', $html, $m)) return trim($m[1]);
        return '';
    };

    // Helper: haal eerste element op via class of id
    $element = function(string $selector) use ($html): string {
        $sel = ltrim($selector, '#.');
        $attr = $selector[0] === '#' ? 'id' : 'class';
        // Bestaat in class="..." (kan meerdere classes bevatten)
        if ($attr === 'class') {
            if (preg_match('/class=["\'][^"\']*\b' . preg_quote($sel, '/') . '\b[^"\']*["\'][^>]*>(.*?)<\//si', $html, $m)) return trim(strip_tags($m[1]));
        } else {
            if (preg_match('/id=["\']' . preg_quote($sel, '/') . '["\'][^>]*>(.*?)<\//si', $html, $m)) return trim(strip_tags($m[1]));
        }
        return '';
    };

    // Helper: haal img src op op basis van class
    $imageByClass = function(string $cls) use ($html): string {
        if (preg_match('/<img[^>]+class=["\'][^"\']*\b' . preg_quote($cls, '/') . '\b[^"\']*["\'][^>]+src=["\']([^"\']*)["\'][^>]*>/i', $html, $m)) return trim($m[1]);
        if (preg_match('/<img[^>]+src=["\']([^"\']*)["\'][^>]+class=["\'][^"\']*\b' . preg_quote($cls, '/') . '\b[^"\']*["\'][^>]*>/i', $html, $m)) return trim($m[1]);
        return '';
    };

    // Helper: vind eerste <a href> met substring (bv. 'linkedin.com')
    $linkContaining = function(string $needle) use ($html): string {
        if (preg_match_all('/<a[^>]+href=["\']([^"\']+)["\']/i', $html, $m)) {
            foreach ($m[1] as $href) {
                if (stripos($href, $needle) !== false) return $href;
            }
        }
        return '';
    };

    // Bouw auteur-object: meta-tag → element fallback (Noppa Solutions & Consultants team-page selectors)
    $naam    = $meta('auteur:naam')    ?: $meta('author')      ?: $element('.profile-name') ?: $element('#naam')    ?: slugToTitle($slug);
    $functie = $meta('auteur:functie') ?: $meta('job-title')   ?: $element('.profile-role') ?: $element('#functie') ?: '';
    $bio     = $meta('auteur:bio')     ?: $meta('description') ?: $element('.body-text')    ?: $element('#bio')     ?: '';
    $foto    = $meta('auteur:foto')    ?: $meta('og:image')    ?: $imageByClass('profile-photo') ?: '';
    $linkedin= $meta('auteur:linkedin')?: $linkContaining('linkedin.com');
    $twitter = $meta('auteur:twitter') ?: $linkContaining('twitter.com') ?: $linkContaining('x.com/');
    $website = $meta('auteur:website') ?: $meta('og:url')      ?: '';

    echo json_encode([
        'slug'     => $slug,
        'naam'     => $naam,
        'functie'  => $functie,
        'bio'      => $bio,
        'foto'     => $foto,
        'linkedin' => $linkedin,
        'twitter'  => $twitter,
        'website'  => $website,
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_INVALID_UTF8_SUBSTITUTE);

} else {
    http_response_code(400);
    echo json_encode([
        'fout'  => 'Onbekende actie',
        'gebruik' => [
            'paginas'   => 'api.php?actie=paginas',
            'pagina'    => 'api.php?actie=pagina&slug=jouw-slug',
            'artikelen' => 'api.php?actie=artikelen',
            'artikel'   => 'api.php?actie=artikel&slug=jouw-slug',
            'auteur'    => 'api.php?actie=auteur&slug=rik-dobbelsteen',
            'filter'    => 'api.php?actie=artikelen&categorie=how-to',
        ]
    ]);
}
