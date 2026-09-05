<?php
$pageTitle = "Sitemap Overzicht | Noppa";
$pageDesc = "Interne overzichtspagina van alle Noppa website pagina's.";
$base = "";
include $base . "partials/header.php";
include $base . "partials/nav.php";

// Functie om recursief alle PHP bestanden te zoeken
function getPhpFiles($dir, &$results = array()) {
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (pathinfo($path, PATHINFO_EXTENSION) == 'php') {
                $results[] = $path;
            }
        } else if ($value != "." && $value != "..") {
            getPhpFiles($path, $results);
        }
    }
    return $results;
}

$rootPath = realpath(__DIR__);
$allFiles = getPhpFiles($rootPath);
$pages = [];

foreach ($allFiles as $file) {
    if (is_file($file)) {
        // Relatief pad berekenen
        $relativePath = str_replace($rootPath . DIRECTORY_SEPARATOR, '', $file);
        $relativePath = str_replace('\\', '/', $relativePath);
        
        // Exclude bepaalde mappen en bestanden
        if (
            strpos($relativePath, 'partials/') === 0 ||
            strpos($relativePath, 'api/') === 0 ||
            strpos($relativePath, 'data/') === 0 ||
            strpos($relativePath, 'dblocker/') === 0 ||
            strpos($relativePath, 'kennisbank_functions.php') !== false ||
            strpos($relativePath, 'Parsedown.php') !== false ||
            strpos($relativePath, 'api.php') !== false ||
            strpos($relativePath, 'rss.php') !== false ||
            strpos($relativePath, 'test.js') !== false ||
            strpos($relativePath, 'sitemap-overzicht.php') !== false
        ) {
            continue;
        }
        
        $pages[] = $relativePath;
    }
}
sort($pages);
?>

<section class="section" style="padding-top: 140px; min-height: 80vh;">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Interne Navigatie</span>
        <h1 style="margin-bottom: 30px;">Sitemap Overzicht</h1>
        
        <p class="lead" style="margin-bottom: 40px;">
            Een overzicht van alle beschikbare pagina's op de website om eenvoudig te navigeren en teksten te controleren.
        </p>

        <div style="overflow-x:auto;">
            <table class="ctable" style="width: 100%; text-align: left; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 16px; background: var(--navy); color: #fff; border-radius: 8px 0 0 0;">Type / Sectie</th>
                        <th style="padding: 16px; background: var(--navy); color: #fff;">Pagina Bestand</th>
                        <th style="padding: 16px; background: var(--navy); color: #fff; border-radius: 0 8px 0 0;">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $index => $page): 
                        // Bepaal de map voor categorisatie
                        $folder = dirname($page);
                        $type = ($folder == '.') ? 'Hoofdpagina' : ucfirst($folder);
                        
                        // Achtergrondkleur voor afwisselende rijen
                        $bg = ($index % 2 == 0) ? '#fdfdfd' : '#f5f7f9';
                    ?>
                    <tr style="background: <?php echo $bg; ?>; border-bottom: 1px solid var(--mist);">
                        <td style="padding: 16px; font-weight: 600; color: var(--slate);"><?php echo htmlspecialchars($type); ?></td>
                        <td style="padding: 16px; color: var(--ink);"><code><?php echo htmlspecialchars($page); ?></code></td>
                        <td style="padding: 16px;">
                            <a href="<?php echo htmlspecialchars($page); ?>" class="btn btn-ghost" style="padding: 6px 14px; font-size: 13px;">Bekijk pagina &rarr;</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include $base . "partials/footer.php"; ?>
