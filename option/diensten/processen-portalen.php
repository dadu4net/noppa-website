<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Dienst: Processen & Portalen
 * Standardized delegate to central controller
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'diensten';
$_GET['id']   = 'processen-portalen';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=diensten&id=processen-portalen", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';
