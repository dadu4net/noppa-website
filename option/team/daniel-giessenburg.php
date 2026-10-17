<?php
declare(strict_types=1);

$_GET['page'] = 'team';
$_GET['id']   = 'daniel-giessenburg';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=team&id=daniel-giessenburg", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';
