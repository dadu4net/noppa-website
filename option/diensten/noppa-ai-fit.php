<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Dienst: AI-Fit
 * Standardized delegate to central controller (ai-copilot)
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'diensten';
$_GET['id']   = 'ai-copilot';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=diensten&id=ai-copilot", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';
