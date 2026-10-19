<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Header Partial
 * Standardized according to:
 * - noppa-website-header
 * - noppa-ux-ui
 * - noppa-website-branding
 * - noppa-website-wcag
 * =========================================================================
 */

$meta        = $pageData['meta'] ?? [];
$pageSlug    = $pageSlug ?? 'home';
$assetPrefix = $assetPrefix ?? './';
$siteConfig  = $GLOBALS['siteConfig'] ?? [];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($siteConfig['lang'] ?? 'nl', ENT_QUOTES, 'UTF-8'); ?>" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Anti-FOUC Inline Theme Switcher Script (noppa-website-header) -->
    <script>
        (function() {
            var saved = 'auto';
            try { saved = localStorage.getItem('noppa-theme') || 'auto'; } catch(e) {}
            var effective = saved;
            if (saved === 'auto') {
                effective = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-theme', effective);
        })();
    </script>

    <!-- SEO & Metadata Tags via SeoHelper -->
    <?= SeoHelper::renderMetaTags($meta, $pageSlug); ?>

    <!-- Favicon & Icons -->
    <?php
    $favIcon   = $siteConfig['assets']['favicon'] ?? 'assets/logos/DEF_Logo_Noppa.png';
    $appleIcon = $siteConfig['assets']['apple_touch_icon'] ?? 'assets/logos/DEF_Logo_Noppa.png';
    ?>
    <link rel="icon" type="image/png" href="<?= $assetPrefix . ltrim($favIcon, './'); ?>">
    <link rel="apple-touch-icon" href="<?= $assetPrefix . ltrim($appleIcon, './'); ?>">

    <!-- Kentledge Webfont (noppa-website-branding) -->
    <link rel="preload" href="<?= $assetPrefix; ?>assets/fonts/Kentledge-Regular.woff" as="font" type="font/woff" crossorigin>

    <!-- Core Stylesheets (noppa-website-css & noppa-ux-ui) -->
    <link rel="stylesheet" href="<?= $assetPrefix; ?>assets/css/noppa.css">
    <link rel="stylesheet" href="<?= $assetPrefix; ?>assets/css/custom.css">

    <!-- Parametriseerbare Merkkleuren uit site.config.php -->
    <?php if (!empty($siteConfig['brand'])): ?>
    <style id="site-brand-tokens">
        :root {
            <?php if (!empty($siteConfig['brand']['primary'])): ?>--brand-primary: <?= htmlspecialchars($siteConfig['brand']['primary'], ENT_QUOTES, 'UTF-8'); ?>;<?php endif; ?>
            <?php if (!empty($siteConfig['brand']['accent'])): ?>--brand-accent: <?= htmlspecialchars($siteConfig['brand']['accent'], ENT_QUOTES, 'UTF-8'); ?>;<?php endif; ?>
            <?php if (!empty($siteConfig['brand']['surface'])): ?>--brand-surface: <?= htmlspecialchars($siteConfig['brand']['surface'], ENT_QUOTES, 'UTF-8'); ?>;<?php endif; ?>
            <?php if (!empty($siteConfig['brand']['highlight'])): ?>--brand-highlight: <?= htmlspecialchars($siteConfig['brand']['highlight'], ENT_QUOTES, 'UTF-8'); ?>;<?php endif; ?>
            <?php if (!empty($siteConfig['brand']['font'])): ?>--font-primary: <?= $siteConfig['brand']['font']; ?>;<?php endif; ?>
        }
    </style>
    <?php endif; ?>

    <!-- Microsoft Clarity Analytics (Geladen volgens noppa-website-cookie consent) -->
    <script type="text/plain" data-cookie-category="analytics">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "clarity-id-placeholder");
    </script>
</head>
<body class="page-<?= htmlspecialchars($pageSlug, ENT_QUOTES, 'UTF-8'); ?>">
    <!-- WCAG 2.1 AAA Toegankelijke Skip-Link (noppa-website-wcag) -->
    <a href="#main-content" class="skip-to-content">Direct naar inhoud &darr;</a>
