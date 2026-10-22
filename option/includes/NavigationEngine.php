<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Navigation Engine
 * Standardized according to:
 * - noppa-website-navigation (CSS Mega Menu Standard)
 * - noppa-website-mobile (High-visibility 3-tier mobile navigation)
 * - noppa-ux-ui (60-30-10 palette, glassmorphism & WCAG 2.1 AAA)
 * - noppa-website-wcag
 * =========================================================================
 */

class NavigationEngine {
    private string $navFile;
    private array $siteConfig;

    public function __construct(string $navFile = '', array $siteConfig = []) {
        $this->navFile    = $navFile ?: dirname(__DIR__) . '/content/navigation.md';
        $this->siteConfig = $siteConfig ?: ($GLOBALS['siteConfig'] ?? []);
    }

    /**
     * Laad en parseer het navigation.md bestand.
     */
    public function load(): array {
        if (!file_exists($this->navFile)) {
            // Veilige standaard navigatiestructuur
            return [
                'meta'  => [
                    'cta' => ['text' => 'Boek een afspraak', 'url' => '/contact', 'icon' => 'calendar'],
                    'theme_switcher' => true
                ],
                'items' => [
                    ['title' => 'Home', 'url' => '/', 'children' => []],
                    ['title' => 'Diensten', 'url' => '/diensten', 'children' => []],
                    ['title' => 'Over Ons', 'url' => '/over-ons', 'children' => []],
                    ['title' => 'Contact', 'url' => '/contact', 'children' => []]
                ]
            ];
        }

        $raw = file_get_contents($this->navFile);
        $meta = [];
        $body = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $m)) {
            $meta = $this->parseYaml($m[1]);
            $body = $m[2];
        }

        $items = $this->parseNavList($body);

        return [
            'meta'  => $meta,
            'items' => $items
        ];
    }

    /**
     * Render volledige navigatie HTML (desktop mega menu bar + mobile drawer).
     */
    public function render(string $currentPage = 'home'): string {
        $data = $this->load();
        $meta = $data['meta'];
        $items = $data['items'];

        $cta = $meta['cta'] ?? ['text' => 'Boek een afspraak', 'url' => '/contact', 'icon' => 'calendar'];
        $showTheme = $meta['theme_switcher'] ?? true;
        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';

        $desktopNavHtml = $this->buildDesktopNavHtml($items, $currentPage);
        $mobileNavHtml  = $this->buildMobileNavHtml($items, $currentPage, $cta);

        ob_start();
        ?>
        <!-- Sticky Translucent Glass Header (noppa-ux-ui & noppa-website-navigation) -->
        <header class="portal-header" id="navbar" role="banner">
            <div class="nav-container">
                <!-- Site Logo -->
                <?php
                $siteName  = htmlspecialchars($this->siteConfig['site_name'] ?? 'Noppa Solutions & Consultants', ENT_QUOTES, 'UTF-8');
                $logoLight = $this->siteConfig['assets']['logo_light'] ?? 'assets/logos/DEF_Logo_Noppa.png';
                $logoDark  = $this->siteConfig['assets']['logo_dark'] ?? 'assets/logos/DEF_Logo_Noppa_wit.png';
                ?>
                <a href="<?= htmlspecialchars($this->formatUrl('/'), ENT_QUOTES, 'UTF-8'); ?>" class="nav-logo" aria-label="<?= $siteName; ?> - Naar homepage">
                    <img src="<?= $assetPrefix . ltrim($logoLight, './'); ?>" alt="<?= $siteName; ?>" class="logo-light" width="138" height="42">
                    <img src="<?= $assetPrefix . ltrim($logoDark, './'); ?>" alt="<?= $siteName; ?>" class="logo-dark" width="138" height="42">
                </a>

                <!-- Desktop Mega Nav Links -->
                <nav class="desktop-nav" aria-label="Hoofdnavigatie">
                    <ul class="nav-list">
                        <?= $desktopNavHtml; ?>
                    </ul>
                </nav>

                <!-- Header Actions (Theme Switcher & Primary CTA) -->
                <div class="nav-actions">
                    <?php if ($showTheme): ?>
                    <!-- Theme Switcher (Dark / Light / Auto) -->
                    <div class="theme-switcher-pill" id="themeSwitcher" role="group" aria-label="Kleurthema voorkeur">
                        <button type="button" class="theme-btn" data-theme-val="light" title="Licht thema inschakelen" aria-label="Licht thema">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                        </button>
                        <button type="button" class="theme-btn" data-theme-val="dark" title="Donker thema inschakelen" aria-label="Donker thema">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                        </button>
                        <button type="button" class="theme-btn active" data-theme-val="auto" title="Automatisch systeemthema" aria-label="Systeemthema">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($cta['text'])): ?>
                    <!-- Primary CTA Button -->
                    <a href="<?= htmlspecialchars($this->formatUrl($cta['url']), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary btn-nav">
                        <span><?= htmlspecialchars($cta['text'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                    </a>
                    <?php endif; ?>

                    <!-- Mobile Hamburger Toggle (noppa-website-mobile) -->
                    <button type="button" class="hamburger-btn" id="navToggle" aria-expanded="false" aria-controls="mobileNav" aria-label="Navigatiemenu openen">
                        <span class="hamburger-bar"></span>
                        <span class="hamburger-bar"></span>
                        <span class="hamburger-bar"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Mobile Drawer Overlay & Panel (noppa-website-mobile) -->
        <div class="mobile-nav-drawer" id="mobileNav" hidden aria-hidden="true">
            <div class="mobile-nav-backdrop" id="mobBackdrop"></div>
            <div class="mobile-nav-content" role="dialog" aria-modal="true" aria-label="Mobiele navigatie">
                <div class="mobile-nav-header">
                    <img src="./assets/logos/DEF_Logo_Noppa.png" alt="Noppa" class="logo-light" width="120">
                    <img src="./assets/logos/DEF_Logo_Noppa_wit.png" alt="Noppa" class="logo-dark" width="120">
                    <button type="button" class="btn-close-mob" id="mobClose" aria-label="Menu sluiten">&times;</button>
                </div>
                <nav class="mobile-nav-links" aria-label="Mobiel menu">
                    <ul class="mobile-nav-list">
                        <?= $mobileNavHtml; ?>
                    </ul>
                </nav>
                <div class="mobile-nav-footer">
                    <?php if (!empty($cta['text'])): ?>
                    <a href="<?= htmlspecialchars($this->formatUrl($cta['url']), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary btn-block">
                        <?= htmlspecialchars($cta['text'], ENT_QUOTES, 'UTF-8'); ?> &rarr;
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Controleer recursief of een afstammeling actief is.
     */
    private function hasActiveDescendant(array $item, string $currentPage): bool {
        if (empty($item['children'])) {
            return false;
        }
        foreach ($item['children'] as $child) {
            if ($this->isItemActive($child['url'] ?? '', $currentPage)) {
                return true;
            }
            if (!empty($child['children']) && $this->hasActiveDescendant($child, $currentPage)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Bouw desktop HTML van de navigatie items volgens de CSS Mega Menu standaard (W3Schools).
     * Laag 1: Hoofdmenu in de topbar
     * Laag 2: Categorie kolommen (naast elkaar over de volle breedte van het scherm)
     * Laag 3: Sub-links per kolom (verticaal onder elkaar gegroepeerd)
     */
    private function buildDesktopNavHtml(array $items, string $currentPage): string {
        $html = [];
        foreach ($items as $item) {
            $isDirectActive = $this->isItemActive($item['url'], $currentPage);
            $hasChildActive = $this->hasActiveDescendant($item, $currentPage);
            $isActive = $isDirectActive || $hasChildActive;
            $activeClass = $isActive ? ' active' : '';
            $ariaCurrent = $isDirectActive ? ' aria-current="page"' : '';

            if (!empty($item['children'])) {
                // Bepaal of dit item een Mega Menu moet zijn:
                // Een Mega Menu wordt gebruikt wanneer een item ten minste 3 categorieën heeft EN er sublinks (Laag 3) zijn, of wanneer het specifiek 'Diensten' betreft.
                $hasLevel3 = false;
                foreach ($item['children'] as $child) {
                    if (!empty($child['children'])) {
                        $hasLevel3 = true;
                        break;
                    }
                }
                $isMegaMenu = ($item['title'] === 'Diensten') || (count($item['children']) >= 3 && $hasLevel3);

                if ($isMegaMenu) {
                    // 1. Render Full-Width CSS Mega Menu (conform W3Schools patroon)
                    $colsHtml = [];
                    $colCount = count($item['children']);

                    foreach ($item['children'] as $child) {
                        $childDirectActive = $this->isItemActive($child['url'], $currentPage);
                        $childHasActive    = $this->hasActiveDescendant($child, $currentPage);
                        $childActive       = $childDirectActive || $childHasActive;
                        $childActiveClass  = $childActive ? ' active' : '';

                        $subLinksHtml = [];
                        if (!empty($child['children'])) {
                            foreach ($child['children'] as $grandChild) {
                                $grandActive = $this->isItemActive($grandChild['url'], $currentPage);
                                $grandClass  = $grandActive ? ' active' : '';
                                $badgeHtml   = '';
                                // Highlight specifieke belangrijke diensten zoals de Copilot Realiteitscheck
                                if (str_contains(strtolower($grandChild['url']), 'copilot-realiteitscheck')) {
                                    $badgeHtml = ' <span class="mega-badge">Aanrader</span>';
                                }

                                $subLinksHtml[] = '<li class="mega-link-item">' .
                                    '<a href="' . htmlspecialchars($this->formatUrl($grandChild['url']), ENT_QUOTES, 'UTF-8') . '" class="mega-sub-link' . $grandClass . '">' .
                                        htmlspecialchars($grandChild['title'], ENT_QUOTES, 'UTF-8') .
                                        $badgeHtml .
                                    '</a></li>';
                            }
                        }

                        $colsHtml[] = '
                        <div class="mega-col">
                            <div class="mega-col-header">
                                <a href="' . htmlspecialchars($this->formatUrl($child['url']), ENT_QUOTES, 'UTF-8') . '" class="mega-col-title' . $childActiveClass . '">
                                    <span class="mega-bullet" aria-hidden="true"></span>
                                    ' . htmlspecialchars($child['title'], ENT_QUOTES, 'UTF-8') . '
                                </a>
                            </div>
                            ' . (!empty($subLinksHtml) ? '<ul class="mega-col-list">' . implode("\n", $subLinksHtml) . '</ul>' : '') . '
                        </div>';
                    }

                    $footerNote = '';
                    if ($item['title'] === 'Diensten') {
                        $footerNote = '<div class="mega-menu-footer">
                            <div class="mega-footer-left">
                                <span class="mega-footer-icon" aria-hidden="true">&#9733;</span>
                                <span class="mega-footer-text">Hulp nodig bij M365 adoptie of Copilot implementatie? <strong>Onze consultants denken graag met je mee.</strong></span>
                            </div>
                            <a href="' . htmlspecialchars($this->formatUrl('/contact'), ENT_QUOTES, 'UTF-8') . '" class="mega-footer-btn">Plan direct een afspraak &rarr;</a>
                        </div>';
                    } elseif ($item['title'] === 'Kennis' || $item['title'] === 'Kennisbank') {
                        $footerNote = '<div class="mega-menu-footer">
                            <div class="mega-footer-left">
                                <span class="mega-footer-icon" aria-hidden="true">&#128218;</span>
                                <span class="mega-footer-text">Verdiep je kennis met onze artikelen, best practices en whitepapers.</span>
                            </div>
                            <a href="' . htmlspecialchars($this->formatUrl('/kennisbank'), ENT_QUOTES, 'UTF-8') . '" class="mega-footer-btn">Naar de Kennisbank &rarr;</a>
                        </div>';
                    }

                    $gridColsClass = 'mega-grid-' . min(max($colCount, 1), 4);

                    $html[] = '
                    <li class="nav-item has-mega-menu">
                        <a href="' . htmlspecialchars($this->formatUrl($item['url']), ENT_QUOTES, 'UTF-8') . '" class="nav-link' . $activeClass . '"' . $ariaCurrent . ' aria-haspopup="true" aria-expanded="false">
                            ' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . '
                            <span class="dropdown-caret" aria-hidden="true">&dtrif;</span>
                        </a>
                        <div class="mega-menu" role="region" aria-label="' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . ' submenu">
                            <div class="mega-menu-container">
                                <div class="mega-menu-grid ' . $gridColsClass . '">
                                    ' . implode("\n", $colsHtml) . '
                                </div>
                                ' . $footerNote . '
                            </div>
                        </div>
                    </li>';
                } else {
                    // 2. Render Standaard Dropdown Menu (voor bijv. Over Ons, Visie, Kennisbank)
                    $dropLinksHtml = [];
                    foreach ($item['children'] as $child) {
                        $childDirectActive = $this->isItemActive($child['url'], $currentPage);
                        $childActiveClass  = $childDirectActive ? ' active' : '';
                        $dropLinksHtml[] = '<li class="dropdown-item">' .
                            '<a href="' . htmlspecialchars($this->formatUrl($child['url']), ENT_QUOTES, 'UTF-8') . '" class="dropdown-link' . $childActiveClass . '">' .
                                htmlspecialchars($child['title'], ENT_QUOTES, 'UTF-8') .
                            '</a></li>';
                    }

                    $html[] = '
                    <li class="nav-item has-dropdown">
                        <a href="' . htmlspecialchars($this->formatUrl($item['url']), ENT_QUOTES, 'UTF-8') . '" class="nav-link' . $activeClass . '"' . $ariaCurrent . ' aria-haspopup="true" aria-expanded="false">
                            ' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . '
                            <span class="dropdown-caret" aria-hidden="true">&dtrif;</span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-label="' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . ' submenu">
                            ' . implode("\n", $dropLinksHtml) . '
                        </ul>
                    </li>';
                }
            } else {
                $html[] = '
                <li class="nav-item">
                    <a href="' . htmlspecialchars($this->formatUrl($item['url']), ENT_QUOTES, 'UTF-8') . '" class="nav-link' . $activeClass . '"' . $ariaCurrent . '>
                        ' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . '
                    </a>
                </li>';
            }
        }
        return implode("\n", $html);
    }

    /**
     * Bouw mobiele HTML van de navigatie items zodat 3 navigatielagen kristalhelder en overzichtelijk zichtbaar blijven.
     */
    private function buildMobileNavHtml(array $items, string $currentPage, array $cta): string {
        $html = [];
        foreach ($items as $item) {
            $isDirectActive = $this->isItemActive($item['url'], $currentPage);
            $hasChildActive = $this->hasActiveDescendant($item, $currentPage);
            $isActive = $isDirectActive || $hasChildActive;
            $activeClass = $isActive ? ' active' : '';

            if (!empty($item['children'])) {
                // Hoofditem Laag 1
                $isExpanded = $hasChildActive;
                $html[] = '<li class="mobile-nav-item has-children' . ($isExpanded ? ' is-expanded' : '') . '">';
                $html[] = '  <div class="mobile-nav-row">';
                $html[] = '    <a href="' . htmlspecialchars($this->formatUrl($item['url']), ENT_QUOTES, 'UTF-8') . '" class="mobile-nav-link' . $activeClass . '">' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . '</a>';
                $html[] = '    <button type="button" class="mobile-nav-toggle" aria-expanded="' . ($isExpanded ? 'true' : 'false') . '" aria-label="' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . ' menu openen of sluiten">';
                $html[] = '      <span class="mobile-caret" aria-hidden="true">&rsaquo;</span>';
                $html[] = '    </button>';
                $html[] = '  </div>';

                // Mobiele container
                $subDisplay = $isExpanded ? '' : ' style="display:none;"';
                $html[] = '  <div class="mobile-mega-group"' . $subDisplay . '>';

                // Controleer of dit item Laag 3 (sublinks) bevat
                $hasGrandchildren = false;
                foreach ($item['children'] as $c) {
                    if (!empty($c['children'])) {
                        $hasGrandchildren = true;
                        break;
                    }
                }

                if ($hasGrandchildren) {
                    // Category cards voor 3-laags structuren (zoals Diensten)
                    foreach ($item['children'] as $child) {
                        $childDirectActive = $this->isItemActive($child['url'], $currentPage);
                        $childHasActive    = $this->hasActiveDescendant($child, $currentPage);
                        $childActive       = $childDirectActive || $childHasActive;
                        $childActiveClass  = $childActive ? ' active' : '';

                        $html[] = '    <div class="mobile-category-card' . ($childActive ? ' is-active-cat' : '') . '">';
                        $html[] = '      <div class="mobile-category-header">';
                        $html[] = '        <a href="' . htmlspecialchars($this->formatUrl($child['url']), ENT_QUOTES, 'UTF-8') . '" class="mobile-category-title' . $childActiveClass . '">';
                        $html[] = '          <span class="mobile-cat-bullet" aria-hidden="true"></span>';
                        $html[] = '          ' . htmlspecialchars($child['title'], ENT_QUOTES, 'UTF-8');
                        $html[] = '        </a>';
                        if (!empty($child['children'])) {
                            $html[] = '        <button type="button" class="mobile-subcat-toggle" aria-expanded="true" aria-label="Sublinks in- of uitklappen">';
                            $html[] = '          <span class="mobile-subcat-caret" aria-hidden="true">&rsaquo;</span>';
                            $html[] = '        </button>';
                        }
                        $html[] = '      </div>';

                        if (!empty($child['children'])) {
                            $html[] = '      <ul class="mobile-subcat-list">';
                            foreach ($child['children'] as $grandChild) {
                                $grandActive = $this->isItemActive($grandChild['url'], $currentPage);
                                $grandClass  = $grandActive ? ' active' : '';
                                $badgeHtml   = '';
                                if (str_contains(strtolower($grandChild['url']), 'copilot-realiteitscheck')) {
                                    $badgeHtml = ' <span class="mobile-mini-badge">Aanrader</span>';
                                }
                                $html[] = '        <li>';
                                $html[] = '          <a href="' . htmlspecialchars($this->formatUrl($grandChild['url']), ENT_QUOTES, 'UTF-8') . '" class="mobile-subcat-link' . $grandClass . '">';
                                $html[] = '            ' . htmlspecialchars($grandChild['title'], ENT_QUOTES, 'UTF-8') . $badgeHtml;
                                $html[] = '          </a>';
                                $html[] = '        </li>';
                            }
                            $html[] = '      </ul>';
                        }

                        $html[] = '    </div>';
                    }
                } else {
                    // Standaard 2-laags lijst voor items zonder Laag 3 (bijv. Visie, Over Ons)
                    $html[] = '    <ul class="mobile-simple-list">';
                    foreach ($item['children'] as $child) {
                        $childDirectActive = $this->isItemActive($child['url'], $currentPage);
                        $childActiveClass  = $childDirectActive ? ' active' : '';
                        $html[] = '      <li>';
                        $html[] = '        <a href="' . htmlspecialchars($this->formatUrl($child['url']), ENT_QUOTES, 'UTF-8') . '" class="mobile-simple-link' . $childActiveClass . '">';
                        $html[] = '          <span class="mobile-cat-bullet" aria-hidden="true"></span>';
                        $html[] = '          ' . htmlspecialchars($child['title'], ENT_QUOTES, 'UTF-8');
                        $html[] = '        </a>';
                        $html[] = '      </li>';
                    }
                    $html[] = '    </ul>';
                }

                $html[] = '  </div>';
                $html[] = '</li>';
            } else {
                $html[] = '<li class="mobile-nav-item">';
                $html[] = '  <div class="mobile-nav-row">';
                $html[] = '    <a href="' . htmlspecialchars($this->formatUrl($item['url']), ENT_QUOTES, 'UTF-8') . '" class="mobile-nav-link' . $activeClass . '">' . htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') . '</a>';
                $html[] = '  </div>';
                $html[] = '</li>';
            }
        }
        return implode("\n", $html);
    }

    /**
     * Formatteer relatieve URLs robuust voor submappen en query parameters.
     */
    public function formatUrl(string $url): string {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
            return $url;
        }

        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
        $isQueryMode = isset($_GET['page']);

        $parts = explode('#', $url, 2);
        $path  = trim($parts[0], '/');
        $hash  = isset($parts[1]) ? '#' . $parts[1] : '';

        if ($isQueryMode) {
            if ($path === '' || $path === 'home') {
                return 'index.php' . $hash;
            }
            return 'index.php?page=' . urlencode($path) . $hash;
        }

        if ($path === '' || $path === 'home') {
            return ($assetPrefix === './' ? './' : $assetPrefix) . $hash;
        }

        return $assetPrefix . $path . $hash;
    }

    /**
     * Controleer of een menu item overeenkomt met de huidige pagina.
     */
    private function isItemActive(string $url, string $currentPage): bool {
        // Items met een specifiek anker (#) niet globaal als actieve pagina markeren
        $fragment = parse_url($url, PHP_URL_FRAGMENT);
        if (!empty($fragment)) {
            return false;
        }

        $cleanUrl = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');
        $cleanCurrent = trim($currentPage, '/');

        if (($cleanUrl === '' || $cleanUrl === 'home') && ($cleanCurrent === '' || $cleanCurrent === 'home')) {
            return true;
        }

        return $cleanUrl !== '' && $cleanUrl === $cleanCurrent;
    }

    /**
     * Parseer Markdown lijstitems en sub-items tot 3 lagen diep.
     * Laag 1: - [Titel](url) (0 spaties)
     * Laag 2:   - [Titel](url) (2-3 spaties)
     * Laag 3:     - [Titel](url) (4+ spaties)
     */
    private function parseNavList(string $markdown): array {
        $lines = explode("\n", $markdown);
        $items = [];
        $lastL1Index = -1;
        $lastL2Index = -1;

        foreach ($lines as $line) {
            $rawLine = rtrim($line);
            if (empty(trim($rawLine))) continue;

            // Zoek lijstitem met markdown link
            if (preg_match('/^(\s*)[-*+]\s+\[(.+?)\]\((.+?)\)/', $rawLine, $m)) {
                $leadingSpaces = strlen(str_replace("\t", '    ', $m[1]));
                $title  = trim($m[2]);
                $url    = trim($m[3]);
                $node   = [
                    'title'    => $title,
                    'url'      => $url,
                    'children' => []
                ];

                if ($leadingSpaces >= 4) {
                    // Laag 3 (sub-sub-item ingesprongen onder Laag 2)
                    if ($lastL1Index >= 0 && $lastL2Index >= 0 && isset($items[$lastL1Index]['children'][$lastL2Index])) {
                        $items[$lastL1Index]['children'][$lastL2Index]['children'][] = $node;
                    } elseif ($lastL1Index >= 0) {
                        // Fallback onder laag 1 als er geen voorafgaande laag 2 is
                        $items[$lastL1Index]['children'][] = $node;
                    } else {
                        $items[] = $node;
                        $lastL1Index = count($items) - 1;
                    }
                } elseif ($leadingSpaces >= 2) {
                    // Laag 2 (sub-item ingesprongen onder Laag 1)
                    if ($lastL1Index >= 0) {
                        $items[$lastL1Index]['children'][] = $node;
                        $lastL2Index = count($items[$lastL1Index]['children']) - 1;
                    } else {
                        $items[] = $node;
                        $lastL1Index = count($items) - 1;
                        $lastL2Index = -1;
                    }
                } else {
                    // Laag 1 (hoofditem, geen inspringing)
                    $items[] = $node;
                    $lastL1Index = count($items) - 1;
                    $lastL2Index = -1;
                }
            }
        }

        return $items;
    }

    /**
     * Eenvoudige YAML frontmatter parser voor navigation.md.
     */
    private function parseYaml(string $yaml): array {
        $data = [];
        $lines = explode("\n", trim($yaml));
        $currentSection = null;

        foreach ($lines as $line) {
            $t = trim($line);
            if (empty($t) || strpos($t, '#') === 0) continue;

            if (preg_match('/^([a-zA-Z0-9_-]+):\s*$/', $t, $m)) {
                $currentSection = $m[1];
                $data[$currentSection] = [];
                continue;
            }

            if ($currentSection && preg_match('/^\s{2,4}([a-zA-Z0-9_-]+):\s*(.*)$/', $line, $m)) {
                $subKey = $m[1];
                $val = trim($m[2], " \"'");
                if (strtolower($val) === 'true') $val = true;
                if (strtolower($val) === 'false') $val = false;
                $data[$currentSection][$subKey] = $val;
                continue;
            }

            if (strpos($t, ':') !== false) {
                [$k, $v] = explode(':', $t, 2);
                $k = trim($k);
                $v = trim($v, " \"'");
                if (strtolower($v) === 'true') $v = true;
                if (strtolower($v) === 'false') $v = false;
                $data[$k] = $v;
                $currentSection = null;
            }
        }
        return $data;
    }
}
