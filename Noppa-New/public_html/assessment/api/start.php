<?php
// api/start.php
header('Content-Type: application/json');
$allowed_origins = ['https://noppa.nl', 'https://www.noppa.nl', 'https://web0165.zxcs-klant.nl'];
if (isset(header('Access-Control-Allow-Origin: *'); // TODO: set to specific domainSERVER['HTTP_ORIGIN']) && in_array(header('Access-Control-Allow-Origin: *'); // TODO: set to specific domainSERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header('Access-Control-Allow-Origin: ' . header('Access-Control-Allow-Origin: *'); // TODO: set to specific domainSERVER['HTTP_ORIGIN']);
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

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON payload']);
    exit;
}

$to = "info@noppa.nl";
$subject = "Nieuwe start assessment: " . ($data['bedrijf'] ?? 'Onbekend');
$message = "Er is zojuist iemand gestart met een assessment.\n\n";
$message .= "Assessment: " . ($data['assessment_type'] ?? 'Onbekend') . "\n";
$message .= "Naam: " . ($data['naam'] ?? 'Onbekend') . "\n";
$message .= "E-mail: " . ($data['email'] ?? 'Onbekend') . "\n";
$message .= "Bedrijf: " . ($data['bedrijf'] ?? 'Onbekend') . "\n";

$headers = "From: no-reply@noppa.nl\r\n";
$headers .= "Reply-To: " . ($data['email'] ?? 'no-reply@noppa.nl') . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$mailSent = mail($to, $subject, $message, $headers);

echo json_encode(['success' => $mailSent]);

