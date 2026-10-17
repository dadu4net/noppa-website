<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Kennisbank Index Controller
 * Delegates cleanly to the unified central controller
 * =========================================================================
 */

declare(strict_types=1);

$query = $_SERVER['QUERY_STRING'] ?? '';
$target = '../index.php?page=kennisbank' . ($query ? '&' . $query : '');

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: " . $target, true, 301);
    exit;
}

$_GET['page'] = 'kennisbank';
$assetPrefix  = '../';

require_once dirname(__DIR__) . '/index.php';
