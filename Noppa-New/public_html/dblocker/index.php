<?php
/* =========================================================================
 * Noppa — USB Datablocker landingsverwijzing
 *
 *  Doel  : QR-code op de USB Datablocker verwijst naar deze URL.
 *          Wij registreren elke scan (atomair, met flock) en sturen
 *          de bezoeker direct door naar de campagnepagina.
 *
 *  Opslag: ../data/dblocker-visits.json   (wordt zelf aangemaakt)
 *          {
 *            "total":  <int>,
 *            "first":  "<ISO8601>",
 *            "last":   "<ISO8601>",
 *            "today":  { "<YYYY-MM-DD>": <int>, ... }   (laatste 30 dagen)
 *          }
 * ========================================================================= */

declare(strict_types=1);

$target  = '/veilig-opladen-slimmer-werken.html';
$dataDir = __DIR__ . '/../data';
$file    = $dataDir . '/dblocker-visits.json';

// Zorg dat de opslagmap bestaat.
if (!is_dir($dataDir)) {
    @mkdir($dataDir, 0755, true);
}

// Sla simpele bot-scans over om de teller schoon te houden.
$ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$isBot = $ua === '' || preg_match('/bot|crawl|spider|preview|monitor|fetch|curl|wget/i', $ua) === 1;

if (!$isBot) {
    $fp = @fopen($file, 'c+');
    if ($fp !== false) {
        if (flock($fp, LOCK_EX)) {
            // Lees bestaande inhoud (kan leeg zijn bij eerste run).
            $raw  = stream_get_contents($fp);
            $data = json_decode((string)$raw, true);
            if (!is_array($data)) {
                $data = [];
            }
            $data += ['total' => 0, 'first' => null, 'last' => null, 'today' => []];
            if (!is_array($data['today'])) {
                $data['today'] = [];
            }

            // Update tellers.
            $now            = date('c');
            $day            = date('Y-m-d');
            $data['total']  = (int)$data['total'] + 1;
            $data['last']   = $now;
            $data['first']  = $data['first'] ?: $now;
            $data['today'][$day] = (int)($data['today'][$day] ?? 0) + 1;

            // Beperk dagopslag tot laatste 30 dagen om het bestand klein te houden.
            if (count($data['today']) > 30) {
                ksort($data['today']);
                $data['today'] = array_slice($data['today'], -30, null, true);
            }

            // Schrijf atomair terug.
            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
}

// Geen caching — elke scan is uniek.
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// 302-redirect naar de campagnepagina, met herkenbare referrer-marker.
header('Location: ' . $target . '?ref=dblocker', true, 302);

// Fallback voor het zeldzame geval dat de redirect niet uitgevoerd wordt
// (bijv. door een agressieve crawler die geen Location-header volgt).
?>
<?php
$pageTitle = "Doorverwijzen… | Noppa";
$pageDesc = "";
$base = "../";
include $base . "partials/header.php";
?>
    <div>
        <p>Even doorverwijzen naar <strong>Veilig opladen, Slimmer werken</strong>…</p>
        <p>Werkt dit niet automatisch? <a href="<?= htmlspecialchars($target, ENT_QUOTES, 'UTF-8') ?>">Klik hier om verder te gaan →</a></p>
    </div>
</body>
</html>


