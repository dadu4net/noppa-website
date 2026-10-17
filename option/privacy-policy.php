<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Privacy Policy
 * Standardized delegate to central controller
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'privacy-policy';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: index.php?page=privacy-policy", true, 301);
    exit;
}

$assetPrefix = './';
require_once __DIR__ . '/index.php';
