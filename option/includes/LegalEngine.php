<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Legal Engine
 * Standardized strictly according to all Noppa skills:
 * - noppa-website-content (Prose typography, WCAG 2.1 AAA contrast)
 * - noppa-ux-ui (60-30-10, Kentledge typography, signature gradient, tactile feedback)
 * - noppa-website-branding (Tone of voice, legal clarity, B2B professionalism)
 * - noppa-website-hero (Ambient glow, breadcrumb, badge icon, gradient title)
 * - noppa-website-icons (24 official Noppa SVG gradient icons)
 * - noppa-website-wcag (Semantic tags, aria-labels, high contrast focus states)
 * =========================================================================
 */

declare(strict_types=1);

require_once __DIR__ . '/Parsedown.php';

class LegalEngine {
    private Parsedown $parsedown;
    private string $legalDir;
    private string $iconsDir;

    public function __construct(string $legalDir = '', string $iconsDir = '') {
        $this->legalDir  = rtrim($legalDir ?: dirname(__DIR__) . '/data/legal', '/\\') . '/';
        $this->iconsDir  = rtrim($iconsDir ?: dirname(__DIR__) . '/assets/icons', '/\\') . '/';
        $this->parsedown = new Parsedown();
        $this->parsedown->setSafeMode(false);
    }

    /**
     * Laad en parseer een juridisch document op basis van de slug.
     */
    public function loadDocument(string $slug): ?array {
        $cleanSlug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $filePath  = $this->legalDir . $cleanSlug . '.md';

        if (!file_exists($filePath)) {
            return null;
        }

        $raw = file_get_contents($filePath);
        return $this->parseDocument($raw, $cleanSlug);
    }

    /**
     * Parseer een juridisch document (frontmatter, artikelen, inhoudsopgave).
     */
    public function parseDocument(string $raw, string $slug): array {
        $frontmatter  = [];
        $markdownText = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
            $frontmatter  = $this->parseYaml($matches[1]);
            $markdownText = $matches[2];
        }

        $pageTitle    = $frontmatter['pageTitle'] ?? ($frontmatter['title'] ?? 'Algemene Voorwaarden | Noppa');
        $pageDesc     = $frontmatter['pageDesc'] ?? ($frontmatter['description'] ?? '');
        $date         = $frontmatter['date'] ?? 'mei 2026';
        $badge        = $frontmatter['badge'] ?? 'Juridisch';
        $badgeIcon    = $frontmatter['badge_icon'] ?? 'document';
        $heroTitle    = $frontmatter['hero_title'] ?? '';
        $heroSubtitle = $frontmatter['hero_subtitle'] ?? $pageDesc;

        if (empty($heroTitle)) {
            if ($slug === 'algemene-voorwaarden') {
                $heroTitle = 'Algemene <span class="gradient-text">Voorwaarden</span>';
            } elseif ($slug === 'privacy-policy') {
                $heroTitle = 'Privacy <span class="gradient-text">Policy</span>';
            } else {
                $heroTitle = htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8');
            }
        }

        // Converteer Markdown naar HTML via Parsedown
        $rawHtml = $this->parsedown->text($markdownText);

        // Detecteer H2 koppen en genereer ankers en inhoudsopgave (TOC)
        $toc = [];
        $contentHtml = preg_replace_callback('/<h2>(.*?)<\/h2>/i', function($matches) use (&$toc) {
            $rawHeading = $matches[1];
            $cleanText  = trim(strip_tags($rawHeading));

            $anchor      = '';
            $displayHtml = '';
            $tocTitle    = $cleanText;
            $isSub       = false;

            // Detecteer "Artikel X - Titel" of "Artikel Xa - Titel" structuur
            if (preg_match('/^(Artikel\s+([0-9]+)([a-z]?))\s*[-–:]\s*(.*)$/iu', $cleanText, $parts)) {
                $artPill   = $parts[1]; // "Artikel 1" of "Artikel 12a"
                $artNum    = $parts[2]; // "1" of "12"
                $artSub    = $parts[3] ?? ''; // "a"
                $artTitle  = trim($parts[4] ?? '');

                $anchor    = 'art-' . strtolower($artNum . $artSub);
                $isSub     = !empty($artSub);
                $tocTitle  = $artPill . ($artTitle !== '' ? ' – ' . $artTitle : '');

                $displayHtml = '<h2 id="' . htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') . '"><span class="av-num">' . htmlspecialchars($artPill, ENT_QUOTES, 'UTF-8') . '</span> ' . htmlspecialchars($artTitle, ENT_QUOTES, 'UTF-8') . '</h2>';
            } elseif (preg_match('/^(Artikel\s+([0-9]+)([a-z]?))$/iu', $cleanText, $parts)) {
                $artPill   = $parts[1];
                $artNum    = $parts[2];
                $artSub    = $parts[3] ?? '';

                $anchor    = 'art-' . strtolower($artNum . $artSub);
                $isSub     = !empty($artSub);
                $tocTitle  = $artPill;

                $displayHtml = '<h2 id="' . htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') . '"><span class="av-num">' . htmlspecialchars($artPill, ENT_QUOTES, 'UTF-8') . '</span></h2>';
            } else {
                // Algemene H2 kop (bijv. Privacy Policy secties)
                $anchor    = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cleanText), '-'));
                $tocTitle  = $cleanText;
                $displayHtml = '<h2 id="' . htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($cleanText, ENT_QUOTES, 'UTF-8') . '</h2>';
            }

            $toc[] = [
                'id'    => $anchor,
                'title' => $tocTitle,
                'sub'   => $isSub,
                'level' => $isSub ? 3 : 2
            ];

            return $displayHtml;
        }, $rawHtml);

        $meta = [
            'title'       => $pageTitle,
            'description' => strip_tags((string)$pageDesc),
            'canonical'   => 'https://noppa.nl/' . $slug,
            'og_type'     => 'article',
            'robots'      => 'index, follow'
        ];

        return [
            'slug'         => $slug,
            'title'        => $pageTitle,
            'description'  => $pageDesc,
            'date'         => $date,
            'badge'        => $badge,
            'badge_icon'   => $badgeIcon,
            'hero_title'   => $heroTitle,
            'hero_subtitle'=> $heroSubtitle,
            'toc'          => $toc,
            'contentHtml'  => $contentHtml,
            'meta'         => $meta
        ];
    }

    /**
     * Genereert de volledige semantische HTML van het juridisch document.
     */
    public function renderDocument(array $doc): string {
        $slug        = $doc['slug'];
        $toc         = $doc['toc'] ?? [];
        $contentHtml = $doc['contentHtml'] ?? '';
        $heroTitle   = $doc['hero_title'];
        $heroSub     = $doc['hero_subtitle'];
        $date        = $doc['date'];
        $badge       = $doc['badge'];
        $badgeIcon   = $doc['badge_icon'];

        ob_start();
        ?>
        <!-- HERO SECTIE JURIDISCH DOCUMENT -->
        <section class="hero-section hero-legal" aria-label="Juridisch Document Header">
            <div class="hero-ambient" aria-hidden="true">
                <div class="hero-circle hero-circle-1"></div>
                <div class="hero-circle hero-circle-2"></div>
            </div>

            <div class="container hero-container">
                <div class="hero-content">
                    <?php $breadcrumbTitle = trim(preg_replace('/\s*\|\s*Noppa.*$/i', '', $doc['title'])); ?>
                    <nav class="breadcrumb breadcrumb-hero" aria-label="Kruimelpad">
                        <a href="<?= htmlspecialchars($this->formatUrl('/home'), ENT_QUOTES, 'UTF-8'); ?>">Home</a>
                        <span class="sep" aria-hidden="true">&rsaquo;</span>
                        <span><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="sep" aria-hidden="true">&rsaquo;</span>
                        <span class="current" aria-current="page"><?= htmlspecialchars($breadcrumbTitle, ENT_QUOTES, 'UTF-8'); ?></span>
                    </nav>

                    <div class="hero-badge">
                        <span class="badge-icon" aria-hidden="true"><?= $this->getSvgIcon($badgeIcon, 16); ?></span>
                        <span><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                    <h1 class="hero-title"><?= $heroTitle; ?></h1>

                    <?php if (!empty($heroSub)): ?>
                    <p class="hero-subtitle"><?= htmlspecialchars($heroSub, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>

                    <div class="legal-meta-bar">
                        <span class="meta-icon" aria-hidden="true"><?= $this->getSvgIcon('calendar', 15); ?></span>
                        <span>Laatst bijgewerkt: <?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- MAIN CONTENT MET TWEEKOLOMS LEESLAYOUT EN STICKY TOC -->
        <section class="page-section legal-reading-section" aria-label="Voorwaarden tekst">
            <div class="container">
                <div class="artikel-layout <?= empty($toc) ? 'zonder-toc' : ''; ?>">

                    <?php if (!empty($toc)): ?>
                    <!-- STICKY TOC SIDEBAR -->
                    <aside class="artikel-toc-wrap" id="tocSidebar" aria-label="Inhoudsopgave">
                        <div class="artikel-toc-box">
                            <div class="toc-header">
                                <span class="toc-heading-label">Inhoudsopgave</span>
                                <span class="toc-percent-badge" id="tocPercent">0%</span>
                            </div>
                            <div class="toc-progress-track" aria-hidden="true">
                                <div class="toc-progress-bar" id="tocProgressBar"></div>
                            </div>
                            <nav class="toc-nav" aria-label="Artikelen navigatie">
                                <ul class="toc-list">
                                    <?php foreach ($toc as $item): ?>
                                    <li class="toc-item <?= $item['sub'] ? 'toc-level-3' : 'toc-level-2'; ?>" data-target="<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <a href="#<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>" class="toc-link" onclick="scrollNaarKop(event, '<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>')">
                                            <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>

                            <div class="toc-contact-prompt">
                                <p><strong>Vragen over de voorwaarden?</strong></p>
                                <a href="<?= htmlspecialchars($this->formatUrl('/contact'), ENT_QUOTES, 'UTF-8'); ?>" class="toc-contact-link">
                                    Neem contact met ons op &rarr;
                                </a>
                            </div>
                        </div>
                    </aside>
                    <?php endif; ?>

                    <!-- LEESTEKST KOLOM -->
                    <div class="artikel-main-column">
                        <article class="artikel-prose" id="legalProse">
                            <?= $contentHtml; ?>
                        </article>

                        <div class="artikel-meta-box">
                            <strong>Vragen over deze voorwaarden?</strong><br>
                            Neem contact met ons op via <a href="mailto:info@noppa.nl">info@noppa.nl</a> of bel <a href="tel:+31613357723">+31 (0)6 13 35 77 23</a>. Wij beantwoorden uw vraag graag persoonlijk.
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- AFSLUITENDE CTA BANNER -->
        <section id="cta-final" aria-label="Afsluitende Call to Action">
            <div class="container">
                <h2>Samenwerken met Noppa?</h2>
                <p>
                    Wij denken graag met u mee — over uw Microsoft 365-omgeving, governance of adoptie.
                    Neem gerust contact met ons op voor een vrijblijvend gesprek.
                </p>
                <a href="<?= htmlspecialchars($this->formatUrl('/contact'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
                    Neem contact op &rarr;
                </a>
            </div>
        </section>

        <!-- SCROLLSPY EN INTERACTIEVE TOC SCRIPT -->
        <script>
        function scrollNaarKop(e, id) {
            e.preventDefault();
            const el = document.getElementById(id);
            if (!el) return;
            const offset = 96;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top, behavior: 'smooth' });
            if (history.pushState) {
                history.pushState(null, '', '#' + id);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const progressEl = document.getElementById('tocProgressBar');
            const percentEl  = document.getElementById('tocPercent');
            const proseEl    = document.getElementById('legalProse');

            function updateProgress() {
                if (!proseEl) return;
                const rect = proseEl.getBoundingClientRect();
                const totalHeight = proseEl.offsetHeight;
                const windowHeight = window.innerHeight;
                
                let pct = 0;
                if (rect.top <= 100) {
                    const scrolled = 100 - rect.top;
                    pct = Math.min(100, Math.max(0, Math.round((scrolled / (totalHeight - windowHeight + 200)) * 100)));
                }

                if (progressEl) progressEl.style.width = pct + '%';
                if (percentEl) percentEl.textContent = pct + '%';
            }

            window.addEventListener('scroll', updateProgress, { passive: true });
            updateProgress();

            const items = document.querySelectorAll('.toc-item');
            if (!items.length) return;

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const targetId = entry.target.id;
                        items.forEach(i => {
                            const isMatch = i.getAttribute('data-target') === targetId;
                            i.classList.toggle('actief', isMatch);
                        });

                        const activeItem = document.querySelector('.toc-item.actief');
                        const sidebarBox = document.querySelector('.artikel-toc-box');
                        if (activeItem && sidebarBox) {
                            const itemTop = activeItem.offsetTop - sidebarBox.offsetTop;
                            const visibleBottom = sidebarBox.scrollTop + sidebarBox.clientHeight;
                            if (itemTop < sidebarBox.scrollTop || itemTop > visibleBottom - 40) {
                                sidebarBox.scrollTo({ top: itemTop - 60, behavior: 'smooth' });
                            }
                        }
                    }
                });
            }, {
                rootMargin: '-80px 0px -65% 0px',
                threshold: 0
            });

            document.querySelectorAll('#legalProse h2[id]').forEach(el => {
                observer.observe(el);
            });
        });
        </script>
        <?php
        return ob_get_clean();
    }

    /**
     * Haal SVG icoon op uit de officiële Noppa iconenmap.
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
     * Formatteer relatieve URLs consistent voor query parameters en schone URLs.
     */
    public function formatUrl(string $url): string {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
            return $url;
        }

        if (str_starts_with($url, '#')) {
            return $url;
        }

        $isQueryMode = isset($_GET['page']);
        $parts       = explode('#', $url, 2);
        $rawPath     = trim($parts[0]);
        $hash        = isset($parts[1]) ? '#' . $parts[1] : '';

        $path = preg_replace('/^(\.\.\/|\.\/)+/', '', $rawPath);
        $path = preg_replace('/\.(php|html)$/i', '', $path);
        $path = trim($path, '/');

        if ($isQueryMode) {
            if ($path === '' || $path === 'home' || $path === 'index') {
                return 'index.php' . $hash;
            }
            return 'index.php?page=' . urlencode($path) . $hash;
        }

        return '/' . $path . $hash;
    }

    /**
     * Eenvoudige YAML frontmatter parser.
     */
    private function parseYaml(string $yaml): array {
        $lines  = explode("\n", $yaml);
        $result = [];

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (empty($trimmed) || str_starts_with($trimmed, '#')) {
                continue;
            }

            if (strpos($trimmed, ':') !== false) {
                [$k, $v] = explode(':', $trimmed, 2);
                $k = trim($k);
                $v = trim($v);
                $v = trim($v, "\"'");
                $result[$k] = $v;
            }
        }

        return $result;
    }
}
