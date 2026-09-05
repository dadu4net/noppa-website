<?php
/* =========================================================================
 * Noppa — USB Datablocker tellerendpoint
 *
 *  Geeft de huidige stand van de QR-bezoeken terug als JSON, zodat de
 *  campagnepagina (veilig-opladen-slimmer-werken.html) de teller via
 *  een fetch() kan tonen zonder dat de pagina zelf PHP hoeft te zijn.
 *
 *  Lees-only — schrijven gebeurt uitsluitend in /dblocker/index.php.
 * ========================================================================= */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

$file = __DIR__ . '/../data/dblocker-visits.json';

$response = [
    'count' => 0,
    'first' => null,
    'last'  => null,
    'today' => 0,
];

if (is_file($file)) {
    $raw  = @file_get_contents($file);
    $data = json_decode((string)$raw, true);
    if (is_array($data)) {
        $response['count'] = (int)($data['total'] ?? 0);
        $response['first'] = $data['first'] ?? null;
        $response['last']  = $data['last']  ?? null;

        $day = date('Y-m-d');
        if (isset($data['today'][$day])) {
            $response['today'] = (int)$data['today'][$day];
        }
    }
}

echo json_encode($response, JSON_UNESCAPED_SLASHES);


