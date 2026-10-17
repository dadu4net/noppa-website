<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Algemene Voorwaarden
 * Standardized delegate to central controller
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'algemene-voorwaarden';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: index.php?page=algemene-voorwaarden", true, 301);
    exit;
}

$assetPrefix = './';
require_once __DIR__ . '/index.php';
