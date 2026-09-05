<?php
// Noppa-New/api/auth/callback.php
session_start();
$config = require 'entra_config.php';
require '../db.php'; // Zorgt dat $pdo beschikbaar is

if (empty($_GET['state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
    die('State mismatch. Mogelijk een beveiligingsprobleem.');
}

if (isset($_GET['error'])) {
    die('Inloggen geannuleerd of mislukt: ' . htmlspecialchars($_GET['error_description'] ?? $_GET['error']));
}

$code = $_GET['code'];
$tokenUrl = $config['authority'] . $config['tenant_id'] . "/oauth2/v2.0/token";

$postParams = [
    'client_id'     => $config['client_id'],
    'client_secret' => $config['client_secret'],
    'code'          => $code,
    'redirect_uri'  => $config['redirect_uri'],
    'grant_type'    => 'authorization_code',
];

$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postParams));
$response = curl_exec($ch);
curl_close($ch);

$tokenData = json_decode($response, true);

if (!isset($tokenData['id_token'])) {
    die('Kon geen token ophalen. Controleer configuratie.');
}

// id_token bevat JWT met email en naam
$jwtParts = explode('.', $tokenData['id_token']);
if (count($jwtParts) < 2) die('Ongeldige token ontvangen.');

$payload = json_decode(base64_decode($jwtParts[1]), true);
$uid = $payload['oid'] ?? $payload['sub'];
$email = $payload['preferred_username'] ?? $payload['email'] ?? $payload['upn'] ?? '';
$name = $payload['name'] ?? '';

if (!$email) {
    die('Kon geen e-mailadres uitlezen. Zorg dat OpenID email scopes aanstaan in Entra.');
}

// Gebruiker updaten/opslaan in database
$stmt = $pdo->prepare("SELECT id FROM users WHERE entra_uid = ?");
$stmt->execute([$uid]);
$user = $stmt->fetch();

if ($user) {
    $userId = $user['id'];
} else {
    $stmt = $pdo->prepare("INSERT INTO users (entra_uid, email, name) VALUES (?, ?, ?)");
    $stmt->execute([$uid, $email, $name]);
    $userId = $pdo->lastInsertId();
}

// Sessie zetten
$_SESSION['user_id'] = $userId;
$_SESSION['user_email'] = $email;
$_SESSION['user_name'] = $name;

// Stuur terug naar het assessment
$returnTo = $_SESSION['return_to'] ?? '/';
header('Location: ' . $returnTo);
exit;
