<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Team Profile: Rik Dobbelsteen
 * Implements Option A: Unified central controller architecture
 * =========================================================================
 */

declare(strict_types=1);

$_GET['page'] = 'team';
$_GET['id']   = 'rik-dobbelsteen';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=team&id=rik-dobbelsteen", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';