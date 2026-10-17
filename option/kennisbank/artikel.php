<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Kennisbank Artikel Controller
 * Delegates cleanly to the unified central controller
 * =========================================================================
 */

declare(strict_types=1);

$slug = isset($_GET['slug']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$_GET['slug']) : '';
$target = '../index.php?page=kennisbank' . ($slug ? '&slug=' . urlencode($slug) : '');

if (!headers_sent() && php_sapi_name() !== 'cli') {
    header("Location: " . $target, true, 301);
    exit;
}

$_GET['page'] = 'kennisbank';
$_GET['slug'] = $slug;
$assetPrefix  = '../';

require_once dirname(__DIR__) . '/index.php';
