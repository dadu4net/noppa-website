<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Kennisbank Engine
 * Standardized strictly according to all Noppa skills:
 * - noppa-website-kennisbank (TOC, leesvoortgang, metadata, artikel layout)
 * - noppa-ux-ui (60-30-10, Kentledge, tactile feedback, glassmorphism)
 * - noppa-website-branding
 * - noppa-website-content
 * - noppa-website-icons (24 officiële Noppa SVG gradient iconen)
 * - noppa-website-wcag (WCAG 2.1 AAA contrast & aria attributen)
 * =========================================================================
 */

declare(strict_types=1);

require_once __DIR__ . '/Parsedown.php';

class KennisbankEngine {
    private Parsedown $parsedown;
    private string $contentDir;
    private string $iconsDir;
    private array $siteConfig;

    public function __construct(string $contentDir = '', string $iconsDir = '', array $siteConfig = []) {
        $this->contentDir = rtrim($contentDir ?: dirname(__DIR__) . '/content/kennisbank/artikelen', '/\\') . '/';
        $this->iconsDir   = rtrim($iconsDir ?: dirname(__DIR__) . '/assets/icons', '/\\') . '/';
        $this->siteConfig = $siteConfig ?: ($GLOBALS['siteConfig'] ?? []);
        $this->parsedown  = new Parsedown();
        $this->parsedown->setSafeMode(false);
    }

    /**
     * Haal alle gepubliceerde artikelen op, optioneel gefilterd op categorie of zoekterm.
     */
    public function getArtikelen(?string $category = null, ?string $search = null): array {
        if (!is_dir($this->contentDir)) {
            return [];
        }

        $files = glob($this->contentDir . '*.md') ?: [];
        $artikelen = [];

        foreach ($files as $file) {
            $slug = basename($file, '.md');
            if ($slug === 'index' || $slug === 'README') {
                continue;
            }

            $raw = file_get_contents($file);
            $parsed = $this->parseArticleFile($raw, $slug);

            // Negeer concepten
            if (($parsed['meta']['status'] ?? '') === 'concept') {
                continue;
            }

            // Filter op categorie indien opgegeven
            if (!empty($category) && strcasecmp((string)$parsed['categorie'], (string)$category) !== 0) {
                continue;
            }

            // Filter op zoekterm indien opgegeven
            if (!empty($search)) {
                $q = mb_strtolower(trim($search));
                $haystack = mb_strtolower($parsed['title'] . ' ' . $parsed['description'] . ' ' . $parsed['raw_body'] . ' ' . $parsed['categorie']);
                if (mb_strpos($haystack, $q) === false) {
                    continue;
                }
            }

            $artikelen[] = $parsed;
        }

        // Sorteer aflopend op datum (nieuwste eerst)
        usort($artikelen, function ($a, $b) {
            $da = !empty($a['datum']) ? strtotime($a['datum']) : 0;
            $db = !empty($b['datum']) ? strtotime($b['datum']) : 0;
            return $db <=> $da;
        });

        return $artikelen;
    }

    /**
     * Haal een unieke lijst van categorieën op met het aantal artikelen per categorie.
     */
    public function getCategories(): array {
        $alle = $this->getArtikelen();
        $telling = [];

        foreach ($alle as $art) {
            $cat = !empty($art['categorie']) ? trim($art['categorie']) : 'Algemeen';
            $telling[$cat] = ($telling[$cat] ?? 0) + 1;
        }

        ksort($telling, SORT_NATURAL | SORT_FLAG_CASE);
        return $telling;
    }

    /**
     * Haal een specifiek artikel op basis van de slug.
     */
    public function getArtikel(string $slug): ?array {
        $cleanSlug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $file = $this->contentDir . $cleanSlug . '.md';

        if (!file_exists($file)) {
            return null;
        }

        $raw = file_get_contents($file);
        $artikel = $this->parseArticleFile($raw, $cleanSlug);

        // Verwerk body naar HTML met kop-IDs voor TOC
        $rawHtml = $this->parsedown->text($artikel['raw_body']);
        $tocResult = $this->buildTocFromHtml($rawHtml);
        $artikel['html'] = $tocResult['html'];
        $artikel['toc']  = $tocResult['toc'];

        return $artikel;
    }

    /**
     * Parseer frontmatter en body van een artikelbestand.
     */
    private function parseArticleFile(string $raw, string $slug): array {
        $meta = [];
        $body = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
            $meta = $this->parseYaml($matches[1]);
            $body = $matches[2];
        }

        $title = $meta['title'] ?? ($this->extractH1($body) ?: $this->slugToTitle($slug));
        $cleanBody = preg_replace('/^#\s+.+\n?/m', '', $body); // Strip hoofd H1 kop
        $cleanBody = trim($cleanBody);

        $description = $meta['beschrijving'] ?? ($meta['description'] ?? $this->extractExcerpt($cleanBody));
        $datum       = $meta['datum'] ?? ($meta['date'] ?? date('Y-m-d', filemtime($this->contentDir . $slug . '.md')));
        $categorie   = $meta['categorie'] ?? ($meta['category'] ?? 'Kennisbank');
        $auteur      = $meta['auteur'] ?? ($meta['author'] ?? 'Rik Dobbelsteen');
        $leestijd    = $meta['leestijd'] ?? ($this->calculateReadingTime($cleanBody) . ' min');
        $pdf         = $meta['pdf'] ?? '';

        $auteurSlug = $this->slugify($auteur);
        $aliases = [
            'rik'     => 'rik-dobbelsteen',
            'kees'    => 'kees-koertshuis',
            'willem'  => 'willem-blanken',
            'deborah' => 'deborah-stahlecker',
            'daniel'  => 'daniel-giessenburg',
        ];
        $auteurSlug = $aliases[$auteurSlug] ?? $auteurSlug;
        if ($auteur === 'Rik') {
            $auteur = 'Rik Dobbelsteen';
        }

        return [
            'slug'        => $slug,
            'meta'        => $meta,
            'title'       => $title,
            'description' => $description,
            'datum'       => $datum,
            'datum_nl'    => $this->formatDateNL($datum),
            'categorie'   => $categorie,
            'auteur'      => $auteur,
            'auteur_slug' => $auteurSlug,
            'leestijd'    => $leestijd,
            'pdf'         => $pdf,
            'raw_body'    => $cleanBody
        ];
    }

    /**
     * Bouw een slimme, robuuste URL die werkt in elke submap en met zowel query strings als schone URL's.
     */
    public function url(string $path = '', array $params = []): string {
        $clean = trim($path, '/');
        $isQueryMode = isset($_GET['page']);

        if ($isQueryMode) {
            if ($clean === 'home' || $clean === '') {
                $p = array_merge(['page' => 'home'], $params);
                return 'index.php?' . http_build_query($p);
            }
            if ($clean === 'kennisbank') {
                $p = array_merge(['page' => 'kennisbank'], $params);
                return 'index.php?' . http_build_query($p);
            }
            if (str_starts_with($clean, 'kennisbank/')) {
                $slug = substr($clean, 11);
                $p = array_merge(['page' => 'kennisbank', 'slug' => $slug], $params);
                return 'index.php?' . http_build_query($p);
            }
            if (str_starts_with($clean, 'team/')) {
                $id = substr($clean, 5);
                $p = array_merge(['page' => 'team', 'id' => $id], $params);
                return 'index.php?' . http_build_query($p);
            }
            $p = array_merge(['page' => $clean], $params);
            return 'index.php?' . http_build_query($p);
        }

        // Relatieve paden voor directe map-resolutie
        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
        $prefix = rtrim($assetPrefix, './');
        $url = ($prefix ? $prefix . '/' : './') . $clean;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
    }

    /**
     * Haal een officieel Noppa gradient SVG icoon op uit de centrale assets map.
     */
    public function getSvgIcon(string $name, int $size = 20, string $class = 'noppa-icon'): string {
        $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
        $path = $this->iconsDir . $cleanName . '.svg';
        if (file_exists($path)) {
            $svg = file_get_contents($path);
            if ($size > 0) {
                $svg = preg_replace('/<svg([^>]*)width="[^"]*"/i', '<svg$1', $svg);
                $svg = preg_replace('/<svg([^>]*)height="[^"]*"/i', '<svg$1', $svg);
                $svg = preg_replace('/<svg/i', '<svg width="' . $size . '" height="' . $size . '" class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" aria-hidden="true"', $svg, 1);
            }
            return $svg;
        }
        return '';
    }

    /**
     * Genereert de interactieve overzichtscatalogus HTML voor Kennisbank.
     */
    public function renderOverviewHtml(array $artikelen, array $categories, string $activeCategory = '', string $searchQuery = ''): string {
        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
        $rssUrl = $assetPrefix . 'kennisbank/rss.php';
        ob_start();
        ?>
        <div class="kennisbank-catalog-wrapper" id="artikelen">
            <!-- Zoekbalk & Live Filters -->
            <div class="kennisbank-toolbar">
                <div class="kennisbank-search-wrap">
                    <span class="search-icon-badge" aria-hidden="true">
                        <?= $this->getSvgIcon('search', 18); ?>
                    </span>
                    <input type="search" id="kbLiveSearch" value="<?= htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Zoek op trefwoord of technologie..." aria-label="Zoek in artikelen">
                    <button type="button" id="kbClearSearch" class="search-clear-btn" title="Wis zoekopdracht" style="display: <?= !empty($searchQuery) ? 'block' : 'none'; ?>;">&times;</button>
                </div>

                <div class="kennisbank-rss-action">
                    <a href="<?= htmlspecialchars($rssUrl, ENT_QUOTES, 'UTF-8'); ?>" class="rss-link-pill" target="_blank" rel="noopener" title="Abonneer op de Noppa RSS feed">
                        <?= $this->getSvgIcon('sync', 16); ?>
                        <span>RSS Feed</span>
                    </a>
                </div>
            </div>

            <!-- Categorie Tabs -->
            <div class="filter-bar" role="tablist" aria-label="Kennisbank categorieën">
                <button type="button" class="filter-tab <?= empty($activeCategory) ? 'actief' : ''; ?>" data-category="" role="tab" aria-selected="<?= empty($activeCategory) ? 'true' : 'false'; ?>">
                    Alle artikelen (<?= count($this->getArtikelen()); ?>)
                </button>
                <?php foreach ($categories as $catName => $count): ?>
                <button type="button" class="filter-tab <?= strcasecmp($activeCategory, $catName) === 0 ? 'actief' : ''; ?>" data-category="<?= htmlspecialchars($catName, ENT_QUOTES, 'UTF-8'); ?>" role="tab" aria-selected="<?= strcasecmp($activeCategory, $catName) === 0 ? 'true' : 'false'; ?>">
                    <?= htmlspecialchars($catName, ENT_QUOTES, 'UTF-8'); ?> (<?= $count; ?>)
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Artikelen Grid -->
            <div class="artikelen-grid" id="kbGrid">
                <?php foreach ($artikelen as $art): 
                    $artUrl = $this->url('kennisbank/' . $art['slug']);
                ?>
                <a class="artikel-kaart fade-in" href="<?= htmlspecialchars($artUrl, ENT_QUOTES, 'UTF-8'); ?>" data-category="<?= htmlspecialchars(mb_strtolower($art['categorie']), ENT_QUOTES, 'UTF-8'); ?>" data-title="<?= htmlspecialchars(mb_strtolower($art['title']), ENT_QUOTES, 'UTF-8'); ?>" data-desc="<?= htmlspecialchars(mb_strtolower($art['description']), ENT_QUOTES, 'UTF-8'); ?>" data-author="<?= htmlspecialchars(mb_strtolower($art['auteur']), ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="kaart-top">
                        <div class="kaart-meta">
                            <span class="kaart-cat"><?= htmlspecialchars($art['categorie'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="kaart-datum"><?= htmlspecialchars($art['datum_nl'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="kaart-leestijd">
                            <span class="leestijd-icon" aria-hidden="true"><?= $this->getSvgIcon('clock', 14); ?></span>
                            <span><?= htmlspecialchars($art['leestijd'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    </div>
                    <div class="kaart-body">
                        <h3 class="kaart-titel"><?= htmlspecialchars($art['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="kaart-beschrijving"><?= htmlspecialchars($art['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="kaart-footer">
                        <span class="kaart-auteur">
                            <span class="auteur-icon" aria-hidden="true"><?= $this->getSvgIcon('team', 14); ?></span>
                            Door <?= htmlspecialchars($art['auteur'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                        <span class="kaart-pijl" aria-hidden="true">&rarr;</span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Lege status -->
            <div class="leeg-state" id="kbEmptyState" style="display: <?= empty($artikelen) ? 'block' : 'none'; ?>;">
                <div class="empty-icon-wrap" aria-hidden="true">
                    <?= $this->getSvgIcon('search', 40); ?>
                </div>
                <h3>Geen artikelen gevonden</h3>
                <p>Er zijn geen artikelen die overeenkomen met je zoekopdracht of geselecteerde categorie.</p>
                <button type="button" class="btn btn-secondary btn-sm" id="kbResetFilters">Alle filters wissen</button>
            </div>
        </div>

        <!-- Client-Side Instant Filtering Script -->
        <script>
        (function() {
            var searchInput = document.getElementById('kbLiveSearch');
            var clearBtn = document.getElementById('kbClearSearch');
            var tabs = document.querySelectorAll('.filter-tab');
            var cards = document.querySelectorAll('.artikel-kaart');
            var emptyState = document.getElementById('kbEmptyState');
            var resetBtn = document.getElementById('kbResetFilters');
            var activeCat = <?= json_encode($activeCategory ? mb_strtolower($activeCategory) : ''); ?>;

            function filterCards() {
                var query = searchInput ? searchInput.value.toLowerCase().trim() : '';
                if (clearBtn) clearBtn.style.display = query ? 'block' : 'none';
                var visibleCount = 0;

                cards.forEach(function(card) {
                    var cardCat = card.getAttribute('data-category') || '';
                    var cardTitle = card.getAttribute('data-title') || '';
                    var cardDesc = card.getAttribute('data-desc') || '';
                    var cardAuthor = card.getAttribute('data-author') || '';

                    var matchesCat = !activeCat || cardCat === activeCat;
                    var matchesQuery = !query || cardTitle.indexOf(query) !== -1 || cardDesc.indexOf(query) !== -1 || cardAuthor.indexOf(query) !== -1 || cardCat.indexOf(query) !== -1;

                    if (matchesCat && matchesQuery) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (emptyState) emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterCards);
            }
            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    filterCards();
                    searchInput.focus();
                });
            }
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    activeCat = '';
                    if (searchInput) searchInput.value = '';
                    tabs.forEach(function(t) {
                        t.classList.toggle('actief', t.getAttribute('data-category') === '');
                        t.setAttribute('aria-selected', t.getAttribute('data-category') === '' ? 'true' : 'false');
                    });
                    filterCards();
                });
            }

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    tabs.forEach(function(t) {
                        t.classList.remove('actief');
                        t.setAttribute('aria-selected', 'false');
                    });
                    tab.classList.add('actief');
                    tab.setAttribute('aria-selected', 'true');
                    activeCat = (tab.getAttribute('data-category') || '').toLowerCase().trim();
                    filterCards();
                });
            });

            filterCards();
        })();
        </script>
        <?php
        return ob_get_clean();
    }

    /**
     * Genereert de complete artikel detailpagina HTML.
     */
    public function renderArticleHtml(array $artikel, array $gerelateerd = []): string {
        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
        $currentFullUrl = 'https://noppa.nl/kennisbank/' . $artikel['slug'];
        $encodedUrl = urlencode($currentFullUrl);
        $encodedTitle = urlencode($artikel['title']);

        // Auteur gegevens koppelen
        $auteurData = $this->getAuthorDetails($artikel['auteur_slug']);

        ob_start();
        ?>
        <!-- HERO SECTIE ARTIKEL DETAIL -->
        <section class="hero-section hero-artikel" aria-label="Artikel Header">
            <div class="hero-ambient" aria-hidden="true">
                <div class="hero-circle hero-circle-1"></div>
                <div class="hero-circle hero-circle-2"></div>
            </div>

            <div class="container hero-container">
                <div class="hero-content">
                    <nav class="breadcrumb breadcrumb-hero" aria-label="Kruimelpad">
                        <a href="<?= htmlspecialchars($this->url('home'), ENT_QUOTES, 'UTF-8'); ?>">Home</a>
                        <span class="sep" aria-hidden="true">&rsaquo;</span>
                        <a href="<?= htmlspecialchars($this->url('kennisbank'), ENT_QUOTES, 'UTF-8'); ?>">Kennisbank</a>
                        <span class="sep" aria-hidden="true">&rsaquo;</span>
                        <span class="current" aria-current="page"><?= htmlspecialchars($artikel['categorie'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </nav>

                    <div class="hero-badge">
                        <span class="badge-icon" aria-hidden="true"><?= $this->getSvgIcon('brain', 16); ?></span>
                        <span><?= htmlspecialchars($artikel['categorie'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                    <h1 class="hero-title"><?= htmlspecialchars($artikel['title'], ENT_QUOTES, 'UTF-8'); ?></h1>

                    <?php if (!empty($artikel['description'])): ?>
                    <p class="hero-subtitle"><?= htmlspecialchars($artikel['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>

                    <div class="artikel-meta-bar">
                        <span class="meta-item">
                            <span class="meta-icon" aria-hidden="true"><?= $this->getSvgIcon('calendar', 16); ?></span>
                            <span><?= htmlspecialchars($artikel['datum_nl'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </span>
                        <span class="meta-item">
                            <span class="meta-icon" aria-hidden="true"><?= $this->getSvgIcon('clock', 16); ?></span>
                            <span><?= htmlspecialchars($artikel['leestijd'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </span>
                        <span class="meta-item">
                            <span class="meta-icon" aria-hidden="true"><?= $this->getSvgIcon('team', 16); ?></span>
                            <span>Door <a href="<?= htmlspecialchars($this->url('team/' . $artikel['auteur_slug']), ENT_QUOTES, 'UTF-8'); ?>" class="meta-author-link"><?= htmlspecialchars($artikel['auteur'], ENT_QUOTES, 'UTF-8'); ?></a></span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- MAIN CONTENT AREA MET TWEEKOLOMS ARTIKEL LAYOUT -->
        <section class="page-section artikel-reading-section">
            <div class="container">
                <div class="artikel-layout <?= empty($artikel['toc']) ? 'zonder-toc' : ''; ?>">
                    <?php if (!empty($artikel['toc'])): ?>
                    <!-- STICKY TOC SIDEBAR -->
                    <aside class="artikel-toc-wrap" aria-label="Inhoudsopgave">
                        <div class="artikel-toc-box">
                            <div class="toc-header">
                                <span class="toc-heading-label">Inhoud</span>
                                <span class="toc-percent-badge" id="tocPercent">0%</span>
                            </div>
                            <div class="toc-progress-track" aria-hidden="true">
                                <div class="toc-progress-bar" id="tocProgressBar"></div>
                            </div>
                            <nav class="toc-nav">
                                <ul class="toc-list">
                                    <?php foreach ($artikel['toc'] as $item): ?>
                                    <li class="toc-item toc-level-<?= $item['level']; ?>" data-target="<?= htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <a href="#<?= htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8'); ?>" class="toc-link" onclick="scrollNaarKop(event, '<?= htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8'); ?>')">
                                            <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>

                            <?php if (!empty($artikel['pdf'])): ?>
                            <div class="toc-download-box">
                                <a href="<?= htmlspecialchars($assetPrefix . 'content/kennisbank/artikelen/' . $artikel['pdf'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-secondary btn-sm btn-block" download>
                                    <?= $this->getSvgIcon('document', 16); ?>
                                    <span>Download PDF-versie</span>
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="toc-contact-prompt">
                                <p>Hulp nodig bij adoptie?</p>
                                <a href="<?= htmlspecialchars($this->url('contact'), ENT_QUOTES, 'UTF-8'); ?>" class="toc-contact-link">
                                    Plan een sessie met <?= htmlspecialchars(explode(' ', $artikel['auteur'])[0], ENT_QUOTES, 'UTF-8'); ?> &rarr;
                                </a>
                            </div>
                        </div>
                    </aside>
                    <?php endif; ?>

                    <!-- ARTIKEL BODY INHOUD -->
                    <div class="artikel-main-column">
                        <article class="artikel-prose" id="artikelProse">
                            <?= $artikel['html']; ?>
                        </article>

                        <!-- Gepubliceerd box -->
                        <div class="artikel-meta-box">
                            <strong>Gepubliceerd:</strong> <?= htmlspecialchars($artikel['datum_nl'], ENT_QUOTES, 'UTF-8'); ?>
                            &nbsp;&middot;&nbsp; <strong>Auteur:</strong> <?= htmlspecialchars($artikel['auteur'], ENT_QUOTES, 'UTF-8'); ?>
                            &nbsp;&middot;&nbsp; <strong>Categorie:</strong> <?= htmlspecialchars($artikel['categorie'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>

                        <!-- DEELBALK -->
                        <div class="deel-balk" aria-label="Deel dit artikel">
                            <span class="deel-label">Delen</span>
                            <div class="deel-buttons-group">
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $encodedUrl; ?>" target="_blank" rel="noopener noreferrer" class="deel-btn linkedin" title="Deel op LinkedIn">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    <span>LinkedIn</span>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= $encodedUrl; ?>&text=<?= $encodedTitle; ?>" target="_blank" rel="noopener noreferrer" class="deel-btn xtwitter" title="Deel op X">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
                                    <span>X</span>
                                </a>
                                <button type="button" class="deel-btn instagram" onclick="openInstaModal()" title="Delen via Instagram">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    <span>Instagram</span>
                                </button>
                                <button type="button" class="deel-btn discord" onclick="openDiscordModal()" title="Delen via Discord Webhook">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.317 4.37a19.79 19.79 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028 14.09 14.09 0 001.226-1.994.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
                                    <span>Discord</span>
                                </button>
                                <a href="https://api.whatsapp.com/send?text=<?= $encodedTitle; ?>%20<?= $encodedUrl; ?>" target="_blank" rel="noopener noreferrer" class="deel-btn whatsapp" title="Deel via WhatsApp">
                                    <span>WhatsApp</span>
                                </a>
                                <a href="mailto:?subject=<?= $encodedTitle; ?>&body=Bekijk%20dit%20artikel%20op%20Noppa:%20<?= $encodedUrl; ?>" class="deel-btn email" title="Deel via E-mail">
                                    <?= $this->getSvgIcon('email', 14); ?>
                                    <span>E-mail</span>
                                </a>
                                <button type="button" class="deel-btn kopieer" onclick="kopieerLink('<?= $currentFullUrl; ?>')" title="Kopieer directe artikel URL">
                                    <?= $this->getSvgIcon('link', 14); ?>
                                    <span>Kopieer link</span>
                                </button>
                            </div>
                        </div>

                        <!-- AUTEUR WIDGET -->
                        <div class="auteur-widget">
                            <?php if (!empty($auteurData['image'])): ?>
                            <img src="<?= htmlspecialchars($assetPrefix . ltrim($auteurData['image'], './'), ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($artikel['auteur'], ENT_QUOTES, 'UTF-8'); ?>" class="auteur-avatar" width="72" height="72">
                            <?php else: ?>
                            <div class="auteur-avatar-placeholder" aria-hidden="true"><?= htmlspecialchars($auteurData['initials'] ?? 'ND', ENT_QUOTES, 'UTF-8'); ?></div>
                            <?php endif; ?>

                            <div class="auteur-info">
                                <span class="auteur-label">Geschreven door</span>
                                <h4 class="auteur-naam">
                                    <a href="<?= htmlspecialchars($this->url('team/' . $artikel['auteur_slug']), ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($artikel['auteur'], ENT_QUOTES, 'UTF-8'); ?></a>
                                </h4>
                                <div class="auteur-functie"><?= htmlspecialchars($auteurData['roleTitle'] ?? 'Consultant bij Noppa Solutions & Consultants', ENT_QUOTES, 'UTF-8'); ?></div>
                                <p class="auteur-bio"><?= htmlspecialchars($auteurData['shortBio'] ?? 'Gespecialiseerd in Microsoft 365, Copilot AI en persoonlijke adoptie op de werkvloer.', ENT_QUOTES, 'UTF-8'); ?></p>
                                
                                <div class="auteur-socials">
                                    <?php if (!empty($auteurData['linkedin'])): ?>
                                    <a href="https://<?= htmlspecialchars(ltrim($auteurData['linkedin'], 'https://'), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="auteur-social-link linkedin">
                                        LinkedIn
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= htmlspecialchars($this->url('team/' . $artikel['auteur_slug']), ENT_QUOTES, 'UTF-8'); ?>" class="auteur-social-link website">
                                        Volledig profiel &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- GERELATEERDE ARTIKELEN -->
                        <?php if (!empty($gerelateerd)): ?>
                        <div class="gerelateerde-sectie">
                            <h3 class="gerelateerd-title">Meer over <?= htmlspecialchars($artikel['categorie'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <div class="gerelateerd-grid">
                                <?php foreach ($gerelateerd as $g): 
                                    $gUrl = $this->url('kennisbank/' . $g['slug']);
                                ?>
                                <a href="<?= htmlspecialchars($gUrl, ENT_QUOTES, 'UTF-8'); ?>" class="gerelateerd-card">
                                    <span class="gerelateerd-datum"><?= htmlspecialchars($g['datum_nl'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <h4 class="gerelateerd-naam"><?= htmlspecialchars($g['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <span class="gerelateerd-link">Lees artikel &rarr;</span>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- CTA BANNER ONDERAAN HET ARTIKEL -->
                        <div class="artikel-cta-banner">
                            <div class="cta-banner-content">
                                <h3>Direct aan de slag met deze inzichten?</h3>
                                <p>Onze consultants helpen jouw team bij de veilige inrichting, adoptie en praktische toepassing van Microsoft 365 en Copilot.</p>
                                <div class="cta-banner-actions">
                                    <a href="<?= htmlspecialchars($this->url('contact'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
                                        <span>Plan een adviesgesprek</span>
                                        <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                                    </a>
                                    <a href="<?= htmlspecialchars($this->url('kennisbank'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-outline">
                                        <span>Terug naar Kennisbank</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DISCORD MODAL -->
        <div class="modal-backdrop" id="discordModal" hidden aria-hidden="true">
            <div class="modal" role="dialog" aria-modal="true" aria-labelledby="discordModalTitle">
                <h3 id="discordModalTitle">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#5865f2" style="display:inline;vertical-align:middle;margin-right:8px" aria-hidden="true"><path d="M20.317 4.37a19.79 19.79 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028 14.09 14.09 0 001.226-1.994.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
                    Delen via Discord
                </h3>
                <p>Vul een Discord Webhook-URL in en pas het bericht aan. Je vindt de webhook via <strong>Serverinstellingen &rarr; Integraties &rarr; Webhooks</strong>.</p>
                <input type="url" class="modal-input" id="discordWebhook" placeholder="https://discord.com/api/webhooks/..." />
                <textarea class="modal-textarea" id="discordBericht"></textarea>
                <div class="modal-actions">
                    <button type="button" class="modal-close" onclick="sluitModal('discordModal')">Annuleren</button>
                    <button type="button" class="modal-send" id="discordVerzend" onclick="verzendDiscord()">Versturen &rarr;</button>
                </div>
            </div>
        </div>

        <!-- INSTAGRAM MODAL -->
        <div class="modal-backdrop" id="instaModal" hidden aria-hidden="true">
            <div class="modal" role="dialog" aria-modal="true" aria-labelledby="instaModalTitle">
                <h3 id="instaModalTitle">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="url(#igGrad)" style="display:inline;vertical-align:middle;margin-right:8px" aria-hidden="true">
                        <defs><linearGradient id="igGrad" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#f58529"/><stop offset="50%" stop-color="#dd2a7b"/><stop offset="100%" stop-color="#8134af"/></linearGradient></defs>
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    Delen via Instagram
                </h3>
                <p>Instagram heeft geen directe deellink. Kopieer de tekst hieronder en open Instagram handmatig om een post of story te maken.</p>
                <div class="insta-copy-box" id="instaTekst"></div>
                <div class="modal-actions">
                    <button type="button" class="modal-close" onclick="sluitModal('instaModal')">Sluiten</button>
                    <button type="button" class="modal-send modal-send-insta" onclick="kopieerInsta()">Kopieer tekst</button>
                </div>
            </div>
        </div>

        <!-- TOAST MELDING -->
        <div class="toast" id="toast" role="status" aria-live="polite"></div>

        <!-- CLIENT SCRIPTS VOOR TOC SCROLL, VOORTGANG EN DEEL MODALS -->
        <script>
        function openDiscordModal() {
            var m = document.getElementById('discordModal');
            if (m) {
                m.removeAttribute('hidden');
                m.classList.add('open');
                var b = document.getElementById('discordBericht');
                if (b && !b.value) {
                    b.value = "Interessant artikel op Noppa: " + document.title + "\n" + window.location.href;
                }
            }
        }
        function openInstaModal() {
            var m = document.getElementById('instaModal');
            if (m) {
                m.removeAttribute('hidden');
                m.classList.add('open');
                var t = document.getElementById('instaTekst');
                if (t) {
                    t.innerText = document.title + "\n\nPraktische inzichten over Microsoft 365 & Copilot via Noppa Solutions & Consultants.\n\nLees meer via: " + window.location.href;
                }
            }
        }
        function sluitModal(id) {
            var m = document.getElementById(id);
            if (m) {
                m.setAttribute('hidden', '');
                m.classList.remove('open');
            }
        }
        function kopieerInsta() {
            var t = document.getElementById('instaTekst');
            if (t) {
                navigator.clipboard.writeText(t.innerText).then(function() {
                    toonToast('Instagram-tekst gekopieerd naar klembord!');
                    sluitModal('instaModal');
                });
            }
        }
        function verzendDiscord() {
            var url = (document.getElementById('discordWebhook').value || '').trim();
            var content = (document.getElementById('discordBericht').value || '').trim();
            if (!url) { alert('Vul a.u.b. een geldige Discord webhook URL in.'); return; }
            fetch(url, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ content: content })
            }).then(function(res) {
                if (res.ok) {
                    toonToast('Bericht verzonden naar Discord!');
                    sluitModal('discordModal');
                } else {
                    alert('Fout bij verzenden naar Discord (status ' + res.status + ')');
                }
            }).catch(function(e) { alert('Verbindingsfout: ' + e.message); });
        }
        function toonToast(msg) {
            var t = document.getElementById('toast');
            if (!t) return;
            t.textContent = msg;
            t.classList.add('show');
            clearTimeout(window.__toastTimer);
            window.__toastTimer = setTimeout(function() {
                t.classList.remove('show');
            }, 2800);
        }
        function kopieerLink(url) {
            var targetUrl = url || window.location.href;
            navigator.clipboard.writeText(targetUrl).then(function() {
                toonToast('Link gekopieerd naar klembord!');
            }).catch(function() {
                toonToast('Kopiëren mislukt.');
            });
        }
        function scrollNaarKop(e, id) {
            if (e) e.preventDefault();
            var el = document.getElementById(id);
            if (!el) return;
            var offset = 96;
            var top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
            if (history.pushState) {
                history.pushState(null, null, '#' + id);
            }
        }

        // Scroll Progress & Active TOC Spy
        (function() {
            var pBar = document.getElementById('tocProgressBar');
            var pBadge = document.getElementById('tocPercent');
            var prose = document.getElementById('artikelProse');
            var tocItems = document.querySelectorAll('.toc-item');

            function updateScrollProgress() {
                if (!prose) return;
                var rect = prose.getBoundingClientRect();
                var windowHeight = window.innerHeight;
                var total = rect.height - windowHeight;
                var current = -rect.top;
                var percent = 0;
                if (total > 0) {
                    percent = Math.min(100, Math.max(0, Math.round((current / total) * 100)));
                } else if (rect.bottom < windowHeight) {
                    percent = 100;
                }
                if (pBar) pBar.style.width = percent + '%';
                if (pBadge) pBadge.textContent = percent + '%';

                // Active heading detectie
                var headings = prose.querySelectorAll('h2, h3');
                var activeId = '';
                headings.forEach(function(h) {
                    var hRect = h.getBoundingClientRect();
                    if (hRect.top <= 140) {
                        activeId = h.id;
                    }
                });

                if (activeId) {
                    tocItems.forEach(function(item) {
                        var target = item.getAttribute('data-target');
                        if (target === activeId) {
                            item.classList.add('actief');
                        } else {
                            item.classList.remove('actief');
                        }
                    });
                }
            }

            window.addEventListener('scroll', updateScrollProgress, { passive: true });
            updateScrollProgress();
        })();
        </script>
        <?php
        return ob_get_clean();
    }

    /**
     * Genereert een RSS 2.0 XML feed.
     */
    public function renderRssXml(string $baseUrl): string {
        $artikelen = $this->getArtikelen();
        $buildDate = !empty($artikelen[0]['datum']) ? date(DATE_RSS, strtotime($artikelen[0]['datum'])) : date(DATE_RSS);

        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        ?>
        <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
            <channel>
                <title>Noppa Solutions &amp; Consultants Kennisbank</title>
                <link><?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8'); ?>/kennisbank</link>
                <description>Praktische gidsen, how-to's en diepgaande analyses over Microsoft 365, Copilot AI en adoptie.</description>
                <language>nl-NL</language>
                <lastBuildDate><?= $buildDate; ?></lastBuildDate>
                <atom:link href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8'); ?>/kennisbank/rss.php" rel="self" type="application/rss+xml" />
                <?php foreach ($artikelen as $art): 
                    $artUrl = $baseUrl . '/kennisbank/' . $art['slug'];
                    $pubDate = !empty($art['datum']) ? date(DATE_RSS, strtotime($art['datum'])) : date(DATE_RSS);
                ?>
                <item>
                    <title><![CDATA[<?= $art['title']; ?>]]></title>
                    <link><?= htmlspecialchars($artUrl, ENT_QUOTES, 'UTF-8'); ?></link>
                    <guid isPermaLink="true"><?= htmlspecialchars($artUrl, ENT_QUOTES, 'UTF-8'); ?></guid>
                    <pubDate><?= $pubDate; ?></pubDate>
                    <category><![CDATA[<?= $art['categorie']; ?>]]></category>
                    <author>info@noppa.nl (<?= htmlspecialchars($art['auteur'], ENT_QUOTES, 'UTF-8'); ?>)</author>
                    <description><![CDATA[<?= $art['description']; ?>]]></description>
                </item>
                <?php endforeach; ?>
            </channel>
        </rss>
        <?php
        return ob_get_clean();
    }

    /**
     * Haal auteursgegevens op uit data/team/.
     */
    private function getAuthorDetails(string $auteurSlug): array {
        $aliases = [
            'rik'     => 'rik-dobbelsteen',
            'kees'    => 'kees-koertshuis',
            'willem'  => 'willem-blanken',
            'deborah' => 'deborah-stahlecker',
            'daniel'  => 'daniel-giessenburg',
        ];
        $auteurSlug = $aliases[$auteurSlug] ?? $auteurSlug;
        $teamDir = dirname(__DIR__) . '/data/team/';
        $file = $teamDir . $auteurSlug . '.md';

        if (!file_exists($file)) {
            // Fallback naar Rik Dobbelsteen
            $file = $teamDir . 'rik-dobbelsteen.md';
        }

        if (file_exists($file)) {
            $raw = file_get_contents($file);
            if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $m)) {
                $yaml = $this->parseYaml($m[1]);
                $first = $yaml['firstName'] ?? '';
                $last = $yaml['lastName'] ?? '';
                return [
                    'fullName'  => trim($first . ' ' . $last),
                    'roleTitle' => $yaml['roleTitle'] ?? ($yaml['jobTitle'] ?? 'Consultant bij Noppa'),
                    'shortBio'  => $yaml['shortBio'] ?? '',
                    'linkedin'  => $yaml['linkedin'] ?? '',
                    'image'     => $yaml['image'] ?? './assets/images/Rik Dobbelsteen.jpeg',
                    'initials'  => mb_substr($first, 0, 1) . mb_substr($last, 0, 1)
                ];
            }
        }

        return [
            'fullName'  => 'Noppa Consultant',
            'roleTitle' => 'Specialist Microsoft 365 & Copilot',
            'shortBio'  => 'Gespecialiseerd in digitale werkplekken en mensgerichte adoptie.',
            'linkedin'  => 'linkedin.com/company/noppa',
            'image'     => './assets/images/Rik Dobbelsteen.jpeg',
            'initials'  => 'ND'
        ];
    }

    /**
     * Bouw TOC op en injecteer unieke anker IDs in de H2 en H3 koppen.
     */
    private function buildTocFromHtml(string $html): array {
        $toc = [];
        $slugCounts = [];

        $htmlWithIds = preg_replace_callback('/<h([23])>(.*?)<\/h\1>/i', function ($m) use (&$toc, &$slugCounts) {
            $level = (int)$m[1];
            $inner = $m[2];
            $plain = trim(strip_tags($inner));
            $baseSlug = $this->slugify($plain);

            if (!isset($slugCounts[$baseSlug])) {
                $slugCounts[$baseSlug] = 1;
                $uniqueSlug = $baseSlug;
            } else {
                $slugCounts[$baseSlug]++;
                $uniqueSlug = $baseSlug . '-' . $slugCounts[$baseSlug];
            }

            $toc[] = [
                'level' => $level,
                'title' => $plain,
                'slug'  => $uniqueSlug
            ];

            return "<h{$level} id=\"{$uniqueSlug}\">{$inner}</h{$level}>";
        }, $html);

        return [
            'html' => $htmlWithIds,
            'toc'  => $toc
        ];
    }

    private function parseYaml(string $yaml): array {
        $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", $yaml));
        $res = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, '#')) continue;
            if (str_contains($line, ':')) {
                [$k, $v] = explode(':', $line, 2);
                $k = trim($k);
                $v = trim($v, " \t\n\r\0\x0B\"'");
                $res[$k] = $v;
            }
        }
        return $res;
    }

    private function extractH1(string $body): ?string {
        if (preg_match('/^#\s+(.+)$/m', $body, $m)) {
            return trim($m[1]);
        }
        return null;
    }

    private function extractExcerpt(string $body, int $max = 160): string {
        $plain = strip_tags($this->parsedown->text($body));
        $plain = preg_replace('/\s+/', ' ', $plain);
        if (mb_strlen($plain) <= $max) return $plain;
        return mb_substr($plain, 0, $max) . '...';
    }

    private function calculateReadingTime(string $text): int {
        $words = str_word_count(strip_tags($text));
        return max(1, (int)ceil($words / 200));
    }

    private function slugify(string $text): string {
        $text = strtolower(trim($text));
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        return preg_replace('/[\s-]+/', '-', $text);
    }

    private function slugToTitle(string $slug): string {
        return ucwords(str_replace(['-', '_'], ' ', $slug));
    }

    private function formatDateNL(string $dateStr): string {
        $time = strtotime($dateStr);
        if (!$time) return $dateStr;

        $months = [
            1 => 'januari', 2 => 'februari', 3 => 'maart', 4 => 'april',
            5 => 'mei', 6 => 'juni', 7 => 'juli', 8 => 'augustus',
            9 => 'september', 10 => 'oktober', 11 => 'november', 12 => 'december'
        ];

        $day = (int)date('j', $time);
        $month = $months[(int)date('n', $time)] ?? date('F', $time);
        $year = date('Y', $time);

        return "{$day} {$month} {$year}";
    }
}
