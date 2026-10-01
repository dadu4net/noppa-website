<?php
// api/submit.php
header('Content-Type: application/json');
$allowed_origins = ['https://noppa.nl', 'https://www.noppa.nl', 'https://web0165.zxcs-klant.nl'];
if (isset(header('Access-Control-Allow-Origin: *'); // Pas dit later aan naar het specifieke domeinSERVER['HTTP_ORIGIN']) && in_array(header('Access-Control-Allow-Origin: *'); // Pas dit later aan naar het specifieke domeinSERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header('Access-Control-Allow-Origin: ' . header('Access-Control-Allow-Origin: *'); // Pas dit later aan naar het specifieke domeinSERVER['HTTP_ORIGIN']);
} else {
    header('Access-Control-Allow-Origin: https://noppa.nl');
}
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Only POST allowed']);
    exit;
}

$configPath = __DIR__ . '/config.php';
if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Configuration file missing']);
    exit;
}

$config = require $configPath;

// Read JSON POST payload
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON payload']);
    exit;
}

// Prepare SharePoint fields matching the list schema
$fields = [
    'Title'             => ($data['bedrijf'] ?? 'Onbekend') . ' - ' . ($data['assessment_type'] ?? 'Assessment'),
    'AssessmentType'    => $data['assessment_type'] ?? $data['bron'] ?? '',
    'ContactNaam'       => $data['naam'] ?? '',
    'ContactEmail'      => $data['email'] ?? '',
    'ContactTelefoon'   => $data['telefoon'] ?? '',
    'Bedrijf'           => $data['bedrijf'] ?? '',
    'Sector'            => $data['sector'] ?? '',
    'Rol'               => $data['rol'] ?? '',
    'Omvang'            => $data['omvang'] ?? '',
    'ScoreTotaal'       => intval(str_replace('%', '', $data['score_totaal'] ?? '0')),
    'Status'            => $data['status'] ?? '',
    'ScorePerCategorie' => $data['score_per_categorie'] ?? '',
    'Samenvatting'      => $data['samenvatting'] ?? '',
    'Antwoorden'        => $data['antwoorden'] ?? '',
    'Aanbevelingen'     => $data['aanbevelingen'] ?? '',
    'Toestemming'       => (isset($data['toestemming']) && strtolower($data['toestemming']) === 'ja')
];

// --- 1. Get OAuth Token ---
$tokenUrl = "https://login.microsoftonline.com/" . $config['TENANT_ID'] . "/oauth2/v2.0/token";
$tokenData = [
    'client_id'     => $config['CLIENT_ID'],
    'scope'         => 'https://graph.microsoft.com/.default',
    'client_secret' => $config['CLIENT_SECRET'],
    'grant_type'    => 'client_credentials'
];

$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenData));
$tokenResponse = curl_exec($ch);
$tokenStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$tokenJson = json_decode($tokenResponse, true);

if ($tokenStatusCode !== 200 || empty($tokenJson['access_token'])) {
    // Implement fallback if configured
    if ($config['USE_MYSQL_FALLBACK']) {
        // Here you would connect to MySQL and insert the $fields array
        // For brevity, this is a placeholder.
        saveToMysqlFallback($fields, $config);
        echo json_encode(['success' => true, 'message' => 'Saved to fallback database']);
        exit;
    }

    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to obtain access token', 'details' => $tokenJson]);
    exit;
}

$accessToken = $tokenJson['access_token'];

// --- 2. Push to SharePoint via Graph API ---
$graphUrl = "https://graph.microsoft.com/v1.0/sites/" . $config['SITE_ID'] . "/lists/" . $config['LIST_ID'] . "/items";

$payload = [
    'fields' => $fields
];

$ch2 = curl_init($graphUrl);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json'
]);
$graphResponse = curl_exec($ch2);
$graphStatusCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
curl_close($ch2);

if ($graphStatusCode === 201) {
    echo json_encode(['success' => true]);
} else {
    // If Graph API fails, try fallback
    if ($config['USE_MYSQL_FALLBACK']) {
        saveToMysqlFallback($fields, $config);
        echo json_encode(['success' => true, 'message' => 'Saved to fallback database after Graph API error']);
        exit;
    }
    
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to write to SharePoint', 'details' => json_decode($graphResponse, true)]);
}

// --- 3. Send email to info@noppa.nl ---
$to = 'info@noppa.nl';
$subject = 'Voltooid assessment: ' . $fields['Title'];
$message = "Een assessment is voltooid!\n\n";
foreach ($fields as $key => $value) {
    if (is_bool($value)) { $value = $value ? 'Ja' : 'Nee'; }
    if (is_array($value)) { $value = json_encode($value); }
    $message .= "$key: $value\n";
}
$headers = "From: no-reply@noppa.nl\r\n";
$headers .= "Reply-To: " . $fields['ContactEmail'] . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
@mail($to, $subject, $message, $headers);

// Fallback Function
function saveToMysqlFallback($fields, $config) {
    $conn = new mysqli($config['DB_HOST'], $config['DB_USER'], $config['DB_PASS'], $config['DB_NAME']);
    if ($conn->connect_error) {
        error_log("MySQL Connection failed: " . $conn->connect_error);
        return false;
    }
    
    $stmt = $conn->prepare("INSERT INTO assessments (title, assessment_type, contact_naam, contact_email, bedrijf, score_totaal, data_json) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if($stmt) {
        $json_data = json_encode($fields);
        $stmt->bind_param("sssssis", 
            $fields['Title'], 
            $fields['AssessmentType'], 
            $fields['ContactNaam'], 
            $fields['ContactEmail'], 
            $fields['Bedrijf'], 
            $fields['ScoreTotaal'],
            $json_data
        );
        $stmt->execute();
        $stmt->close();
    }
    $conn->close();
}

