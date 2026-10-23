<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Hero Section Partial
 * Standardized according to:
 * - noppa-website-hero (60-30-10 ratio, floating glowing circles, 900 font-weight)
 * - noppa-ux-ui (badge-pulse, tactile button springs)
 * - noppa-website-branding
 * =========================================================================
 */

$hero = $pageData['meta']['hero'] ?? [];
if (empty($hero) && !isset($forceHero)) {
    return;
}

$title       = $hero['title'] ?? $pageData['meta']['title'] ?? 'Slimmer werken. Sneller groeien.';
$subtitle    = $hero['subtitle'] ?? $pageData['meta']['description'] ?? 'Wij verhogen de bedrijfsproductiviteit met Microsoft 365, Copilot en procesautomatisering.';
$badge       = $hero['badge'] ?? 'Microsoft 365 & Copilot Specialisten';
$badgeIcon   = $hero['badge_icon'] ?? 'sparkles';
$ctaPrimary  = $hero['cta_primary'] ?? ['text' => 'Boek een adviesgesprek', 'url' => '/contact', 'icon' => 'calendar'];
$ctaSecondary= $hero['cta_secondary'] ?? ['text' => 'Ontdek onze diensten', 'url' => '#diensten', 'icon' => 'arrow-right'];
$bgImage     = $hero['bg_image'] ?? $hero['image'] ?? $hero['background_image'] ?? '';
$bgOverlay   = $hero['bg_overlay'] ?? $hero['overlay'] ?? 'dark';
$stats       = $hero['stats'] ?? ($pageData['meta']['stats'] ?? []);

$hasBgClass  = !empty($bgImage) ? 'hero-has-bg' : '';
$overlayClass= 'hero-overlay-' . htmlspecialchars($bgOverlay, ENT_QUOTES, 'UTF-8');

$bgImageSrc  = $bgImage;
if (!empty($bgImageSrc) && !str_starts_with($bgImageSrc, 'http://') && !str_starts_with($bgImageSrc, 'https://') && !str_starts_with($bgImageSrc, 'data:')) {
    $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
    $bgImageSrc  = $assetPrefix . ltrim($bgImageSrc, '/.');
}

// Toestaan van veilige span tags met class gradient-text in hero titel
$titleFormatted = preg_replace('/<span class=([\'"])gradient-text\1>(.*?)<\/span>/i', '<span class="gradient-text">$2</span>', $title);
if ($titleFormatted === $title && !str_contains($title, '<span')) {
    $titleFormatted = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
}
?>
<section class="hero-section <?= $hasBgClass; ?>" aria-label="Introductie">
    <?php if (!empty($bgImageSrc)): ?>
    <!-- Background Image Media Layer (beveiligd tegen verhoudingswijzigingen via object-fit: cover) -->
    <div class="hero-bg-media" aria-hidden="true">
        <img src="<?= htmlspecialchars($bgImageSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="" loading="eager">
    </div>
    <div class="hero-overlay <?= $overlayClass; ?>" aria-hidden="true"></div>
    <?php endif; ?>

    <!-- Floating Glowing Background Circles (noppa-website-hero) -->
    <div class="hero-ambient" aria-hidden="true">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>
    </div>

    <div class="container hero-container">
        <div class="hero-content">
            <?php if (!empty($badge)): ?>
            <!-- Live Status Badge with Pulse (noppa-ux-ui) -->
            <div class="hero-badge reveal">
                <span class="badge-dot badge-pulse" aria-hidden="true"></span>
                <span><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <?php endif; ?>

            <!-- H1 Hoofdtitel (Kentledge 900) -->
            <h1 class="hero-title reveal"><?= $titleFormatted; ?></h1>

            <!-- Subtitel -->
            <p class="hero-subtitle reveal"><?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8'); ?></p>

            <!-- CTA Knoppen -->
            <div class="hero-actions reveal">
                <?php if (!empty($ctaPrimary['text'])): ?>
                <a href="<?= htmlspecialchars($ctaPrimary['url'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary btn-lg">
                    <span><?= htmlspecialchars($ctaPrimary['text'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                </a>
                <?php endif; ?>

                <?php if (!empty($ctaSecondary['text'])): ?>
                <a href="<?= htmlspecialchars($ctaSecondary['url'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-outline btn-lg">
                    <span><?= htmlspecialchars($ctaSecondary['text'], ENT_QUOTES, 'UTF-8'); ?></span>
                </a>
                <?php endif; ?>
            </div>

            <?php if (!empty($stats) && is_array($stats)): ?>
            <!-- Hero Stats Bar (geanimeerd via site.js) -->
            <div class="hero-stats reveal">
                <?php foreach ($stats as $st): ?>
                <div class="hero-stat">
                    <div class="num"><?= htmlspecialchars($st['num'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="lbl"><?= htmlspecialchars($st['lbl'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
