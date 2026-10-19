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
?>
<section class="hero-section" aria-label="Introductie">
    <!-- Floating Glowing Background Circles (noppa-website-hero) -->
    <div class="hero-ambient" aria-hidden="true">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>
    </div>

    <div class="container hero-container">
        <div class="hero-content">
            <?php if (!empty($badge)): ?>
            <!-- Live Status Badge with Pulse (noppa-ux-ui) -->
            <div class="hero-badge">
                <span class="badge-dot badge-pulse" aria-hidden="true"></span>
                <span><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <?php endif; ?>

            <!-- H1 Hoofdtitel (Kentledge 900) -->
            <h1 class="hero-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>

            <!-- Subtitel -->
            <p class="hero-subtitle"><?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8'); ?></p>

            <!-- CTA Knoppen -->
            <div class="hero-actions">
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
        </div>
    </div>
</section>
