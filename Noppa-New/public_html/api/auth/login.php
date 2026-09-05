<?php
// Noppa-New/api/auth/login.php
session_start();
$config = require 'entra_config.php';

// Bescherm tegen CSRF
$_SESSION['oauth_state'] = bin2hex(random_bytes(16));

// Onthoud naar welk assessment de gebruiker terug moet
$_SESSION['return_to'] = $_GET['return_to'] ?? '/assessment/copilot.php';

$authUrl = $config['authority'] . $config['tenant_id'] . "/oauth2/v2.0/authorize";
$params = [
    'client_id'     => $config['client_id'],
    'response_type' => 'code',
    'redirect_uri'  => $config['redirect_uri'],
    'scope'         => 'openid profile email',
    'state'         => $_SESSION['oauth_state'],
    'prompt'        => 'select_account'
];

$redirectUrl = $authUrl . '?' . http_build_query($params);
header('Location: ' . $redirectUrl);
exit;
