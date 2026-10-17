<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Dienst: Adoptie & Begeleiding
 * Standardized delegate to central controller
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'diensten';
$_GET['id']   = 'adoptie-begeleiding';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=diensten&id=adoptie-begeleiding", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';
