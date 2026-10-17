<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Dienst: Copilot AI Experience
 * Standardized delegate to central controller
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'diensten';
$_GET['id']   = 'copilot-ai-experience';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=diensten&id=copilot-ai-experience", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';
