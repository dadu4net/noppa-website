<?php
// Noppa-New/api/db.php

$host = 'localhost'; // Pas aan naar je ZXCS host (bijv. localhost of een specifiek IP)
$db   = 'vul_in_databasenaam';
$user = 'vul_in_gebruiker';
$pass = 'vul_in_wachtwoord';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Fout netjes afvangen voor productie
    die("Database connectie mislukt. Controleer de configuratie.");
}
