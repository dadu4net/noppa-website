<?php
declare(strict_types=1);

$_GET['page'] = 'team';
$_GET['id']   = 'kees-koertshuis';

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: ../index.php?page=team&id=kees-koertshuis", true, 301);
    exit;
}

$assetPrefix = '../';
require_once dirname(__DIR__) . '/index.php';
