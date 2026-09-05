<?php
/* =========================================================================
 * Noppa — Copilot AI Experience visit-beacon
 *
 *  Wordt aangeroepen door /copilot-ai-experience.html bij elke pagina-load.
 *
 *  1. Registreert het bezoek atomair in /data/copilot-ai-visits.json
 *     (zelfde patroon als de USB Datablocker-teller).
 *  2. Controleert of het client-IP in de allowlist staat
 *     (/data/copilot-ai-allowed-ips.php).
 *  3. Geeft JSON terug:
 *        - admin: false  → reguliere bezoeker, geen teller-data
 *        - admin: true   → toegestaan IP, inclusief count + today
 *
 *  Bot-scans worden gefilterd op User-Agent zodat de teller schoon blijft.
 * ========================================================================= */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

$dataDir   = __DIR__ . '/../data';
$file      = $dataDir . '/copilot-ai-visits.json';
$allowFile = $dataDir . '/copilot-ai-allowed-ips.php';

/* ---------- 1. Bezoekers-IP bepalen (achter proxy-veilig) ---------------- */
function client_ip(): string
{
    // Reverse-proxy headers worden alleen vertrouwd als de directe peer een
    // bekende loopback / private-range is. Op shared hosting valt 'ie meestal
    // direct terug op REMOTE_ADDR — dat is goed.
    $remote = $_SERVER['REMOTE_ADDR'] ?? '';
    $trustedPeers = ['127.0.0.1', '::1'];
    if (in_array($remote, $trustedPeers, true)) {
        $fwd = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
        if ($fwd !== '') {
            $first = trim(explode(',', $fwd)[0]);
            if ($first !== '') {
                return $first;
            }
        }
    }
    return $remote;
}

/* ---------- 2. Allowlist-check (IPv4, IPv6, CIDR) ----------------------- */
function ip_in_list(string $ip, array $list): bool
{
    foreach ($list as $entry) {
        $entry = trim((string)$entry);
        if ($entry === '') continue;

        if (strpos($entry, '/') === false) {
            if (strcasecmp($entry, $ip) === 0) return true;
            continue;
        }

        [$subnet, $bits] = explode('/', $entry, 2);
        $bits = (int)$bits;

        $ipBin     = @inet_pton($ip);
        $subnetBin = @inet_pton($subnet);
        if ($ipBin === false || $subnetBin === false) continue;
        if (strlen($ipBin) !== strlen($subnetBin))   continue;

        $bytes     = intdiv($bits, 8);
        $remainder = $bits % 8;

        if ($bytes > 0 && substr($ipBin, 0, $bytes) !== substr($subnetBin, 0, $bytes)) {
            continue;
        }
        if ($remainder === 0) return true;

        $mask = chr((0xff << (8 - $remainder)) & 0xff);
        if ((ord($ipBin[$bytes]) & ord($mask)) === (ord($subnetBin[$bytes]) & ord($mask))) {
            return true;
        }
    }
    return false;
}

/* ---------- 3. Bezoek registreren --------------------------------------- */
if (!is_dir($dataDir)) {
    @mkdir($dataDir, 0755, true);
}

$ua    = $_SERVER['HTTP_USER_AGENT'] ?? '';
$isBot = $ua === '' || preg_match('/bot|crawl|spider|preview|monitor|fetch|curl|wget|headless/i', $ua) === 1;

$totals = ['total' => 0, 'first' => null, 'last' => null, 'today' => []];

if (!$isBot) {
    $fp = @fopen($file, 'c+');
    if ($fp !== false) {
        if (flock($fp, LOCK_EX)) {
            $raw  = stream_get_contents($fp);
            $data = json_decode((string)$raw, true);
            if (!is_array($data)) $data = [];
            $data += $totals;
            if (!is_array($data['today'])) $data['today'] = [];

            $now = date('c');
            $day = date('Y-m-d');
            $data['total']         = (int)$data['total'] + 1;
            $data['last']          = $now;
            $data['first']         = $data['first'] ?: $now;
            $data['today'][$day]   = (int)($data['today'][$day] ?? 0) + 1;

            // Hou per-dag map klein.
            if (count($data['today']) > 30) {
                ksort($data['today']);
                $data['today'] = array_slice($data['today'], -30, null, true);
            }

            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fflush($fp);
            flock($fp, LOCK_UN);
            $totals = $data;
        }
        fclose($fp);
    }
} elseif (is_file($file)) {
    // Geen schrijfactie, maar wel data lezen voor de admin-view.
    $raw  = @file_get_contents($file);
    $data = json_decode((string)$raw, true);
    if (is_array($data)) {
        $totals = $data + $totals;
        if (!is_array($totals['today'])) $totals['today'] = [];
    }
}

/* ---------- 4. Allowlist evalueren en respons opbouwen ------------------ */
$ip      = client_ip();
$allowed = [];
if (is_file($allowFile)) {
    $loaded = include $allowFile;
    if (is_array($loaded)) $allowed = $loaded;
}
$isAdmin = $ip !== '' && ip_in_list($ip, $allowed);

$response = ['admin' => $isAdmin];

if ($isAdmin) {
    $day = date('Y-m-d');
    $response['count'] = (int)($totals['total'] ?? 0);
    $response['today'] = (int)($totals['today'][$day] ?? 0);
    $response['first'] = $totals['first'] ?? null;
    $response['last']  = $totals['last']  ?? null;
}

echo json_encode($response, JSON_UNESCAPED_SLASHES);


