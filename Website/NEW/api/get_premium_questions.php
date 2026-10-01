<?php
// Noppa-New/api/get_premium_questions.php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Niet ingelogd']);
    exit;
}

$type = $_GET['type'] ?? 'copilot';

// In een later stadium halen we dit uit een afgeschermd JSON bestand of de DB.
// Voor nu hardcoden we hier een voorbeeld van premium data structuur die we later uit de originele copilot-data.js snijden.

if ($type === 'copilot') {
    $premiumData = [
        [
            'id' => 'security_advanced',
            'title' => 'Geavanceerde Beveiliging & DLP',
            'questions' => [
                [
                    'id' => 'dlp_policies',
                    'label' => 'Zijn er Microsoft Purview DLP (Data Loss Prevention) policies actief voor Copilot?',
                    'options' => [
                        ['label' => 'Nee, we gebruiken geen DLP', 'value' => 0],
                        ['label' => 'Ja, basis policies zijn actief', 'value' => 5],
                        ['label' => 'Ja, uitgebreid en specifiek voor AI/Copilot ingesteld', 'value' => 10]
                    ]
                ]
            ]
        ]
    ];
} else {
    $premiumData = [];
}

echo json_encode(['premiumCategories' => $premiumData]);
