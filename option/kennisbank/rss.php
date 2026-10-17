<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Kennisbank RSS 2.0 Generator
 * =========================================================================
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/Parsedown.php';
require_once dirname(__DIR__) . '/includes/KennisbankEngine.php';

header('Content-Type: application/rss+xml; charset=utf-8');

$kennisbankEngine = new KennisbankEngine(dirname(__DIR__) . '/content/kennisbank/artikelen');
echo $kennisbankEngine->renderRssXml('https://noppa.nl');
