<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Team Directory Controller
 * Implements Option A: Unified central controller architecture
 * =========================================================================
 */

declare(strict_types=1);

$id = isset($_GET['id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$_GET['id']) : 'rik-dobbelsteen';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=team&id=" . urlencode($id), true, 301);
    exit;
}

$_GET['page'] = 'team';
$_GET['id']   = $id;
$assetPrefix  = '../';

require_once dirname(__DIR__) . '/index.php';
