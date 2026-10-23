<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Base Page Controller
 * Standardized strictly according to all Noppa skills:
 * - noppa-website-master
 * - noppa-ux-ui
 * - noppa-website-branding
 * - noppa-website-content
 * - noppa-website-header
 * - noppa-website-navigation
 * - noppa-website-hero
 * - noppa-website-footer
 * - noppa-website-cookie
 * =========================================================================
 */

declare(strict_types=1);

// Definieer basismap constanten
define('NOPPA_BASE_DIR', __DIR__);
define('NOPPA_INCLUDES_DIR', NOPPA_BASE_DIR . '/includes');
define('NOPPA_CONTENT_DIR', NOPPA_BASE_DIR . '/content');
define('NOPPA_PARTIALS_DIR', NOPPA_BASE_DIR . '/partials');
define('NOPPA_ASSETS_DIR', NOPPA_BASE_DIR . '/assets');

// Laad site configuratie (white-label & herbruikbaar)
$siteConfigFile = NOPPA_BASE_DIR . '/site.config.php';
$siteConfig     = file_exists($siteConfigFile) ? require $siteConfigFile : [];
$GLOBALS['siteConfig'] = $siteConfig;

// Laad vereiste engines
require_once NOPPA_INCLUDES_DIR . '/Parsedown.php';
require_once NOPPA_INCLUDES_DIR . '/SeoHelper.php';
require_once NOPPA_INCLUDES_DIR . '/MarkdownEngine.php';
require_once NOPPA_INCLUDES_DIR . '/NavigationEngine.php';
require_once NOPPA_INCLUDES_DIR . '/FooterEngine.php';
require_once NOPPA_INCLUDES_DIR . '/TeamEngine.php';
require_once NOPPA_INCLUDES_DIR . '/KennisbankEngine.php';
require_once NOPPA_INCLUDES_DIR . '/DienstenEngine.php';
require_once NOPPA_INCLUDES_DIR . '/LegalEngine.php';

// Configureer SEO defaults vanuit siteConfig
SeoHelper::configure($siteConfig);

// Initialiseer engines
$mdEngine         = new MarkdownEngine(NOPPA_CONTENT_DIR, NOPPA_ASSETS_DIR . '/icons', NOPPA_BASE_DIR . '/data/team', $siteConfig);
$navEngine        = new NavigationEngine(NOPPA_CONTENT_DIR . '/navigation.md', $siteConfig);
$footerEngine     = new FooterEngine(NOPPA_CONTENT_DIR . '/footer.md', $siteConfig);
$teamEngine       = new TeamEngine(NOPPA_BASE_DIR . '/data/team', NOPPA_ASSETS_DIR . '/icons', $siteConfig);
$kennisbankEngine = new KennisbankEngine(NOPPA_CONTENT_DIR . '/kennisbank/artikelen', NOPPA_ASSETS_DIR . '/icons', $siteConfig);
$dienstenEngine   = new DienstenEngine(NOPPA_BASE_DIR . '/data/diensten', NOPPA_ASSETS_DIR . '/icons', $siteConfig);
$legalEngine      = new LegalEngine(NOPPA_BASE_DIR . '/data/legal', NOPPA_ASSETS_DIR . '/icons', $siteConfig);

// Bepaal de opgevraagde pagina (route)
$requestedPage = $_GET['page'] ?? '';
if (empty($requestedPage)) {
    // Haal route uit REQUEST_URI als .htaccess rewrite actief is
    $uriPath = trim((string)parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    // Verwijder eventuele subdirectories
    $scriptDir = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    if (!empty($scriptDir) && strpos($uriPath, $scriptDir) === 0) {
        $uriPath = trim(substr($uriPath, strlen($scriptDir)), '/');
    }
    // Verwijder index.php indien direct aangeroepen
    if ($uriPath === 'index.php' || strpos($uriPath, 'index.php/') === 0) {
        $uriPath = trim(substr($uriPath, 9), '/');
    }
    $requestedPage = $uriPath ?: 'home';
}

$cleanRequested   = trim($requestedPage, '/');
if (!isset($assetPrefix)) {
    $urlDepth    = substr_count($cleanRequested, '/');
    $assetPrefix = ($urlDepth > 0) ? str_repeat('../', $urlDepth) : './';
}
$GLOBALS['assetPrefix'] = $assetPrefix;

$isTeamPage       = false;
$teamProfileHtml  = '';
$isKennisbankPage = false;
$isArticleDetail  = false;
$articleDetailHtml = '';
$kennisbankCatalogHtml = '';
$isDienstenPage   = false;
$isDienstDetail   = false;
$dienstDetailHtml = '';
$isLegalPage      = false;
$legalHtml        = '';
$pageData         = null;

// 1. Routeer teamprofiel verzoeken (bijv. team, team/rik-dobbelsteen, profiel-poc, of ?page=team&id=...)
if ($cleanRequested === 'team' || str_starts_with($cleanRequested, 'team/') || isset($_GET['team_id']) || $cleanRequested === 'profiel-poc') {
    $isTeamPage = true;
    $teamId = $_GET['id'] ?? $_GET['team_id'] ?? '';
    if (empty($teamId) && str_starts_with($cleanRequested, 'team/')) {
        $teamId = substr($cleanRequested, 5);
    }
    if (empty($teamId)) {
        $teamId = 'rik-dobbelsteen'; // Standaard consultant
    }
    $teamId = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $teamId));

    $profileData = $teamEngine->loadProfile($teamId);
    if ($profileData) {
        $pageSlug = 'team-' . $teamId;
        $pageData = [
            'meta'     => $profileData['meta'],
            'sections' => [],
            'toc'      => []
        ];
        $teamProfileHtml = $teamEngine->renderProfile($profileData);
    }
}
// 2. Routeer Kennisbank verzoeken (bijv. kennisbank, kennisbank/artikel-slug, of ?page=kennisbank&slug=...)
elseif ($cleanRequested === 'kennisbank' || str_starts_with($cleanRequested, 'kennisbank/') || ($requestedPage === 'kennisbank')) {
    $isKennisbankPage = true;
    $artSlug = $_GET['slug'] ?? '';
    if (empty($artSlug) && str_starts_with($cleanRequested, 'kennisbank/')) {
        $artSlug = substr($cleanRequested, 11);
    }
    $artSlug = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$artSlug));

    if (!empty($artSlug) && $artSlug !== 'index' && $artSlug !== 'overzicht') {
        // Detailpagina van specifiek artikel
        $isArticleDetail = true;
        $artikel = $kennisbankEngine->getArtikel($artSlug);
        if ($artikel) {
            $pageSlug = 'kennisbank-' . $artSlug;
            $allInCategory = $kennisbankEngine->getArtikelen($artikel['categorie']);
            $gerelateerd = array_values(array_filter($allInCategory, fn($a) => $a['slug'] !== $artSlug));
            $gerelateerd = array_slice($gerelateerd, 0, 3);

            $siteName = $siteConfig['site_name'] ?? 'Noppa Solutions & Consultants';
            $siteBase = rtrim($siteConfig['base_url'] ?? 'https://noppa.nl', '/');
            $logoPath = $siteConfig['assets']['logo_light'] ?? 'assets/logos/DEF_Logo_Noppa.png';

            $pageData = [
                'meta' => [
                    'title'          => $artikel['title'] . ' | Kennisbank | ' . $siteName,
                    'description'    => $artikel['description'],
                    'canonical'      => $siteBase . '/kennisbank/' . $artSlug,
                    'og_type'        => 'article',
                    'og_image'       => $assetPrefix . $logoPath,
                    'published_time' => $artikel['datum'],
                    'author'         => $artikel['auteur'],
                    'section'        => $artikel['categorie'],
                    'robots'         => 'index, follow'
                ],
                'sections' => [],
                'toc'      => $artikel['toc']
            ];
            $articleDetailHtml = $kennisbankEngine->renderArticleHtml($artikel, $gerelateerd);
        }
    } else {
        // Overzichtspagina van Kennisbank via content/pages/kennisbank.md
        $activeCat = $_GET['cat'] ?? $_GET['categorie'] ?? '';
        $searchQ   = $_GET['search'] ?? $_GET['q'] ?? '';
        $artikelen = $kennisbankEngine->getArtikelen($activeCat ?: null, $searchQ ?: null);
        $cats      = $kennisbankEngine->getCategories();

        $pageSlug = 'kennisbank';
        $pageData = $mdEngine->loadPage('kennisbank');
        if (!$pageData) {
            $siteName = $siteConfig['site_name'] ?? 'Noppa Solutions & Consultants';
            $siteBase = rtrim($siteConfig['base_url'] ?? 'https://noppa.nl', '/');
            $pageData = [
                'meta' => [
                    'title'       => 'Kennisbank | Praktische Gidsen & Inzichten | ' . $siteName,
                    'description' => 'Praktische gidsen, how-to\'s en diepgaande analyses.',
                    'canonical'   => $siteBase . '/kennisbank' . (!empty($activeCat) ? '?cat=' . urlencode($activeCat) : ''),
                    'robots'      => 'index, follow'
                ],
                'sections' => [
                    [
                        'id'    => 'artikelen',
                        'type'  => 'kennisbank',
                        'attrs' => ['title' => 'Artikelen & Publicaties', 'subtitle' => 'Kennis & Ervaring'],
                        'html'  => ''
                    ]
                ],
                'toc' => []
            ];
        }

        $kennisbankCatalogHtml = $kennisbankEngine->renderOverviewHtml($artikelen, $cats, $activeCat, $searchQ);
    }
}
// 3. Routeer Diensten verzoeken (bijv. diensten, diensten/processen-portalen, of ?page=diensten&id=...)
elseif ($cleanRequested === 'diensten' || str_starts_with($cleanRequested, 'diensten/') || ($requestedPage === 'diensten')) {
    $isDienstenPage = true;
    $dienstId = $_GET['id'] ?? '';
    if (empty($dienstId) && str_starts_with($cleanRequested, 'diensten/')) {
        $dienstId = substr($cleanRequested, 9);
    }
    $dienstId = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$dienstId));

    if (!empty($dienstId) && $dienstId !== 'index' && $dienstId !== 'overzicht') {
        // Detailpagina van specifieke dienst
        $isDienstDetail = true;
        $service = $dienstenEngine->loadService($dienstId);
        if ($service) {
            $pageSlug = 'dienst-' . $dienstId;
            $pageData = [
                'meta'     => $service['meta'],
                'sections' => [],
                'toc'      => []
            ];
            $dienstDetailHtml = $dienstenEngine->renderServiceDetail($service);
        }
    } else {
        // Overzichtspagina van Diensten via content/pages/diensten.md
        $pageSlug = 'diensten';
        $pageData = $mdEngine->loadPage('diensten');
    }
}
// 4. Routeer Juridische documenten (bijv. algemene-voorwaarden, privacy-policy, of ?page=algemene-voorwaarden)
elseif ($cleanRequested === 'algemene-voorwaarden' || $cleanRequested === 'privacy-policy' || $cleanRequested === 'legal' || str_starts_with($cleanRequested, 'legal/') || ($requestedPage === 'algemene-voorwaarden') || ($requestedPage === 'privacy-policy')) {
    $isLegalPage = true;
    $legalSlug = $_GET['id'] ?? $_GET['slug'] ?? '';
    if (empty($legalSlug)) {
        if (str_starts_with($cleanRequested, 'legal/')) {
            $legalSlug = substr($cleanRequested, 6);
        } else {
            $legalSlug = $cleanRequested;
        }
    }
    if (empty($legalSlug) || $legalSlug === 'legal') {
        $legalSlug = 'algemene-voorwaarden';
    }
    $legalSlug = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$legalSlug));

    $legalDoc = $legalEngine->loadDocument($legalSlug);
    if ($legalDoc) {
        $pageSlug = 'legal-' . $legalSlug;
        $pageData = [
            'meta'     => $legalDoc['meta'],
            'sections' => [],
            'toc'      => $legalDoc['toc']
        ];
        $legalHtml = $legalEngine->renderDocument($legalDoc);
    }
}

// 5. Standaard pagina's (home, over-ons, contact, etc.)
if (!$isTeamPage && !$isKennisbankPage && !$isDienstenPage && !$isLegalPage) {
    $pageSlug = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $requestedPage));
    if (empty($pageSlug) || $pageSlug === 'index' || $pageSlug === 'indexphp') {
        $pageSlug = 'home';
    }

    // Laad Markdown content
    $pageData = $mdEngine->loadPage($pageSlug);
}

// 404 Fallback indien bestand niet bestaat
if (!$pageData) {
    http_response_code(404);
    $pageSlug = '404';
    $pageData = $mdEngine->loadPage('404');

    // Noodvalback als ook 404.md ontbreekt
    if (!$pageData) {
        $pageData = [
            'meta' => [
                'title' => 'Pagina niet gevonden (404)',
                'description' => 'De opgevraagde pagina bestaat helaas niet.',
                'robots' => 'noindex, nofollow'
            ],
            'sections' => [
                [
                    'id' => '404-fallback',
                    'type' => 'content',
                    'attrs' => [],
                    'html' => '<div class="artikel-prose text-center"><h1>404 — Pagina niet gevonden</h1><p>De pagina die je zoekt bestaat niet of is verplaatst.</p><p><a href="./" class="btn btn-primary">Terug naar de homepage &rarr;</a></p></div>'
                ]
            ],
            'toc' => []
        ];
    }
}

// 1. Render Header Partial (bevat <head>, SEO tags, FOUC-prevention, fonts)
require NOPPA_PARTIALS_DIR . '/header.php';

// 2. Render Nav Partial (bevat sticky glassmorphism header & mobile drawer)
require NOPPA_PARTIALS_DIR . '/nav.php';

// 3. Render Main Content
if ($isTeamPage && !empty($teamProfileHtml)): ?>
<main id="main-content" role="main" class="portal-main team-profile-main">
    <?= $teamProfileHtml; ?>
</main>
<?php elseif ($isKennisbankPage && $isArticleDetail && !empty($articleDetailHtml)): ?>
<main id="main-content" role="main" class="portal-main kennisbank-detail-main">
    <?= $articleDetailHtml; ?>
</main>
<?php elseif ($isDienstenPage && $isDienstDetail && !empty($dienstDetailHtml)): ?>
<main id="main-content" role="main" class="portal-main diensten-detail-main">
    <?= $dienstDetailHtml; ?>
</main>
<?php elseif ($isLegalPage && !empty($legalHtml)): ?>
<main id="main-content" role="main" class="portal-main legal-document-main">
    <?= $legalHtml; ?>
</main>
<?php else:
    // Render Hero Partial indien gedefinieerd in frontmatter (voor home, diensten, over-ons, contact, kennisbank overview)
    if (!empty($pageData['meta']['hero'])) {
        require NOPPA_PARTIALS_DIR . '/hero.php';
    }

    $scrollMode = $pageData['meta']['scroll_mode'] ?? '';
    $scrollNav  = !empty($pageData['meta']['scroll_nav']);
    $mainScrollClass = ($scrollMode === 'snap' || $scrollMode === 'vertical-snap') ? 'page-vertical-scroll' : '';
    $sections = $pageData['sections'] ?? [];
?>
<main id="main-content" role="main" class="portal-main <?= $mainScrollClass; ?>">
    <?php if ($scrollNav && !empty($sections)): ?>
    <!-- Floating Vertical Side Dots Navigation -->
    <nav class="vertical-scroll-nav" aria-label="Sectie navigatie">
        <?php foreach ($sections as $s): 
            $sId = htmlspecialchars($s['id'], ENT_QUOTES, 'UTF-8');
            $sTitle = htmlspecialchars($s['attrs']['title'] ?? $s['id'], ENT_QUOTES, 'UTF-8');
        ?>
        <button class="v-dot" data-target="<?= $sId; ?>" title="<?= $sTitle; ?>" aria-label="<?= $sTitle; ?>"></button>
        <?php endforeach; ?>
    </nav>
    <?php endif; ?>

    <?php
    foreach ($sections as $index => $section):
        $sectionId    = htmlspecialchars($section['id'], ENT_QUOTES, 'UTF-8');
        $sectionType  = $section['type'];
        $sectionAttrs = $section['attrs'];
        $html         = $section['html'];

        // Voor pinned-scroll tracks rendert de engine zelf de complete track structuur
        if ($sectionType === 'pinned-scroll' || $sectionType === 'pillars' || $sectionType === 'pilaren') {
            echo $html;
            continue;
        }

        // Styling en layout modifiers (Noppa CSS Achtergrond Standaarden)
        $bgAttr = strtolower(trim((string)($sectionAttrs['bg'] ?? '')));
        if (!empty($bgAttr)) {
            $bgMap = [
                'white'         => 'surface',
                'alt'           => 'alt',
                'surface'       => 'surface',
                'subtle'        => 'subtle',
                'tint'          => 'tint',
                'mist'          => 'mist',
                'navy'          => 'navy',
                'dark'          => 'dark',
                'ink'           => 'ink',
                'night'         => 'night',
                'deep'          => 'ink',
                'hero'          => 'hero',
                'gradient-hero' => 'gradient-hero',
                'royal'         => 'royal',
                'primary'       => 'primary',
                'gradient'      => 'gradient',
                'accent'        => 'accent',
                'cta'           => 'gradient',
                'default'       => '',
                'page'          => '',
                'none'          => ''
            ];
            $resolvedBg = $bgMap[$bgAttr] ?? preg_replace('/[^a-zA-Z0-9_-]/', '', $bgAttr);
            $bgClass = !empty($resolvedBg) ? 'page-section-' . $resolvedBg : '';
        } else {
            $bgClass = ($index % 2 === 1) ? 'page-section-alt' : '';
        }
        $isContainerNone = ($sectionAttrs['container'] ?? '') === 'none' || ($sectionAttrs['container'] ?? '') === 'full';
        $containerClass = ($sectionAttrs['container'] ?? '') === 'narrow' ? 'container-narrow' : 'container';

        // Optionele sectie header
        $sectionTitle    = $sectionAttrs['title'] ?? '';
        $sectionSubtitle = $sectionAttrs['subtitle'] ?? '';
        $sectionDesc     = $sectionAttrs['desc'] ?? '';
        $sectionKicker   = $sectionAttrs['kicker'] ?? '';
    ?>
    <section id="<?= $sectionId; ?>" class="page-section section-<?= $sectionType; ?> <?= $bgClass; ?>" aria-label="<?= htmlspecialchars($sectionTitle ?: $sectionId, ENT_QUOTES, 'UTF-8'); ?>">
        <?php if (!$isContainerNone): ?>
        <div class="<?= $containerClass; ?>">
        <?php endif; ?>

            <?php if (!empty($sectionTitle)): ?>
            <header class="section-header reveal">
                <?php if (!empty($sectionKicker)): ?>
                <div class="kicker"><?= htmlspecialchars($sectionKicker, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>
                <?php if (!empty($sectionSubtitle)): ?>
                <span class="section-subtitle-tag"><?= htmlspecialchars($sectionSubtitle, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>
                <h2 class="section-title"><?= htmlspecialchars($sectionTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
                <?php if (!empty($sectionDesc)): ?>
                <p class="section-desc"><?= htmlspecialchars($sectionDesc, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </header>
            <?php endif; ?>

            <div class="section-body">
                <?php if ($sectionType === 'kennisbank' && !empty($kennisbankCatalogHtml)): ?>
                    <?= $kennisbankCatalogHtml; ?>
                <?php else: ?>
                    <?= $html; ?>
                <?php endif; ?>
            </div>

        <?php if (!$isContainerNone): ?>
        </div>
        <?php endif; ?>
    </section>
    <?php endforeach; ?>
</main>
<?php endif; ?>
<?php

// 5. Render Footer Partial (bevat footer.md parsing, copyright, cookie modal, scripts)
require NOPPA_PARTIALS_DIR . '/footer.php';
