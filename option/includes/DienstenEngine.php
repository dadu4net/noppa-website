<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Diensten Engine
 * Standardized strictly according to all Noppa skills:
 * - noppa-website-diensten-cards (Pcards, multi-column pricing, badges, icons)
 * - noppa-ux-ui (60-30-10, Kentledge typography, signature gradient, tactile buttons)
 * - noppa-website-branding (Tone of voice, clear B2B value propositions)
 * - noppa-website-hero (Gradient text, pill badge, CTA buttons)
 * - noppa-website-icons (24 official Noppa SVG gradient icons)
 * - noppa-website-wcag (WCAG 2.1 AAA contrast, semantic tags, aria attributes)
 * =========================================================================
 */

declare(strict_types=1);

require_once __DIR__ . '/Parsedown.php';

class DienstenEngine {
    private Parsedown $parsedown;
    private string $dienstenDir;
    private string $iconsDir;
    private array $siteConfig;

    public function __construct(string $dienstenDir = '', string $iconsDir = '', array $siteConfig = []) {
        $this->dienstenDir = rtrim($dienstenDir ?: dirname(__DIR__) . '/data/diensten', '/\\') . '/';
        $this->iconsDir    = rtrim($iconsDir ?: dirname(__DIR__) . '/assets/icons', '/\\') . '/';
        $this->siteConfig  = $siteConfig ?: ($GLOBALS['siteConfig'] ?? []);
        $this->parsedown   = new Parsedown();
        $this->parsedown->setSafeMode(false);
    }

    /**
     * Laad een dienst op basis van ID (slug).
     */
    public function loadService(string $id): ?array {
        $cleanId = preg_replace('/[^a-zA-Z0-9_-]/', '', $id);
        $filePath = $this->dienstenDir . $cleanId . '.md';

        if (!file_exists($filePath)) {
            return null;
        }

        $raw = file_get_contents($filePath);
        return $this->parseService($raw, $cleanId);
    }

    /**
     * Haal alle beschikbare diensten op met hun metadata.
     */
    public function getAllServices(): array {
        if (!is_dir($this->dienstenDir)) {
            return [];
        }

        $files = glob($this->dienstenDir . '*.md') ?: [];
        $services = [];

        foreach ($files as $file) {
            $slug = basename($file, '.md');
            if ($slug === 'index' || $slug === 'README') {
                continue;
            }
            $raw = file_get_contents($file);
            $parsed = $this->parseService($raw, $slug);
            if ($parsed) {
                $services[] = $parsed;
            }
        }

        // Sorteer op volgorde ('order' in frontmatter) indien aanwezig
        usort($services, function ($a, $b) {
            $oa = $a['frontmatter']['order'] ?? 99;
            $ob = $b['frontmatter']['order'] ?? 99;
            return $oa <=> $ob;
        });

        return $services;
    }

    /**
     * Parseer een dienst Markdown-bestand met YAML frontmatter en gestructureerde secties.
     */
    public function parseService(string $raw, string $id): array {
        $frontmatter = [];
        $markdownText = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
            $frontmatter = $this->parseYaml($matches[1]);
            $markdownText = $matches[2];
        }

        $title       = $frontmatter['title'] ?? 'Dienst | Noppa Solutions & Consultants';
        $shortTitle  = $frontmatter['shortTitle'] ?? ($frontmatter['eyebrow'] ?? 'Dienstverlening');
        $eyebrow     = $frontmatter['eyebrow'] ?? 'Noppa Oplossingen';
        $badge       = $frontmatter['badge'] ?? 'Microsoft 365 & Copilot';
        $badgeIcon   = $frontmatter['badge_icon'] ?? 'sparkles';
        $description = $frontmatter['description'] ?? ($frontmatter['hero_subtitle'] ?? '');

        // Splits Markdown secties op basis van ## koppen
        $rawSections = explode("\n## ", "\n" . $markdownText);
        $sections = [];
        $faqItems = [];

        foreach ($rawSections as $idx => $sec) {
            if ($idx === 0 && trim($sec) === '') continue;
            $lines = explode("\n", $sec, 2);
            $secTitle = trim($lines[0]);
            $secContent = isset($lines[1]) ? trim($lines[1]) : '';
            if (empty($secTitle)) continue;

            // Controleer of dit een FAQ sectie is
            if (preg_match('/^(Veelgestelde vragen|FAQ|Wat u nog wil weten)/i', $secTitle)) {
                $rawFaqs = explode("\n### ", "\n" . $secContent);
                foreach ($rawFaqs as $f) {
                    if (trim($f) === '') continue;
                    $flines = explode("\n", $f, 2);
                    $q = trim($flines[0]);
                    $a = isset($flines[1]) ? trim($flines[1]) : '';
                    if (!empty($q)) {
                        $faqItems[] = [
                            'question' => $q,
                            'answer'   => $this->parsedown->text($a)
                        ];
                    }
                }
            } else {
                $sections[] = [
                    'title'   => $secTitle,
                    'content' => $secContent
                ];
            }
        }

        // Meta data voor SeoHelper
        $meta = [
            'title'       => $title,
            'description' => strip_tags((string)$description),
            'canonical'   => 'https://noppa.nl/diensten/' . $id,
            'og_type'     => 'website',
            'robots'      => 'index, follow'
        ];

        return [
            'id'            => $id,
            'frontmatter'   => $frontmatter,
            'meta'          => $meta,
            'title'         => $title,
            'shortTitle'    => $shortTitle,
            'eyebrow'       => $eyebrow,
            'badge'         => $badge,
            'badgeIcon'     => $badgeIcon,
            'description'   => $description,
            'pricing'       => $frontmatter['pricing'] ?? null,
            'stats'         => $frontmatter['stats'] ?? null,
            'intro_pillars' => $frontmatter['intro_pillars'] ?? null,
            'cta'           => $frontmatter['cta'] ?? null,
            'sections'      => $sections,
            'faq'           => $faqItems,
            'raw_body'      => $markdownText
        ];
    }

    /**
     * Render de complete HTML voor een dienstpagina via de BEM componenten pipeline.
     */
    public function renderServiceDetail(array $service): string {
        $fm = $service['frontmatter'];
        $id = $service['id'];

        ob_start();
        ?>
        <div class="service-detail-container" id="dienst-<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
            <!-- 1. Hero Sectie -->
            <section class="hero service-hero">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="<?= htmlspecialchars($this->formatUrl('/'), ENT_QUOTES, 'UTF-8'); ?>">Home</a>
                        <span>›</span>
                        <a href="<?= htmlspecialchars($this->formatUrl('/diensten'), ENT_QUOTES, 'UTF-8'); ?>">Diensten</a>
                        <span>›</span>
                        <span style="color: var(--white);"><?= htmlspecialchars($service['shortTitle'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                    <?php if (!empty($service['badge']) || !empty($service['eyebrow'])): ?>
                    <div class="hero-eyebrow">
                        <?php if (!empty($service['badgeIcon'])): ?>
                        <span class="badge-icon-wrap" aria-hidden="true" style="display:inline-flex;align-items:center;vertical-align:middle;margin-right:6px;">
                            <?= $this->getSvgIcon($service['badgeIcon'], 20); ?>
                        </span>
                        <?php endif; ?>
                        <span><?= htmlspecialchars($service['eyebrow'] ?: $service['badge'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <?php endif; ?>

                    <h1 class="hero-h1">
                        <?= !empty($fm['hero_title']) ? $this->formatEmTitle($fm['hero_title']) : htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?>
                    </h1>

                    <?php if (!empty($fm['hero_subtitle'])): ?>
                    <p class="hero-sub">
                        <?= $this->parsedown->line($fm['hero_subtitle']); ?>
                    </p>
                    <?php endif; ?>

                    <div class="hero-actions hero-btns">
                        <?php if (!empty($fm['hero_cta_primary'])): ?>
                        <a href="<?= htmlspecialchars($this->formatUrl($fm['hero_cta_primary']['url'] ?? '/contact'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
                            <?php if (!empty($fm['hero_cta_primary']['icon'])): ?>
                                <?= $this->getSvgIcon($fm['hero_cta_primary']['icon'], 18); ?>
                            <?php endif; ?>
                            <span><?= htmlspecialchars($fm['hero_cta_primary']['text'] ?? 'Plan een afspraak', ENT_QUOTES, 'UTF-8'); ?></span>
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($fm['hero_cta_secondary'])): ?>
                        <a href="<?= htmlspecialchars($this->formatUrl($fm['hero_cta_secondary']['url'] ?? '#aanpak'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-outline">
                            <span><?= htmlspecialchars($fm['hero_cta_secondary']['text'] ?? 'Onze aanpak →', ENT_QUOTES, 'UTF-8'); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- 2. Dynamisch samengestelde secties -->
            <?php
            $hasPricingRendered = false;
            $hasComparisonRendered = false;

            foreach ($service['sections'] as $sIdx => $sec):
                $secTitle   = $sec['title'];
                $secContent = $sec['content'];

                // Backwards compatibility: als de sectie al ruwe HTML bevat
                if (preg_match('/^\s*<(section|div)\b/i', $secContent)) {
                    echo $this->renderRawHtmlSection($secContent);
                    continue;
                }

                // A. Intro / Uitdaging Sectie
                if (preg_match('/^(De uitdaging|Waarom|Over|Introductie|Technologie verandert)/i', $secTitle)) {
                    echo $this->renderIntroSection($secTitle, $secContent, $service);

                    // Toon Pricing na Intro indien pricing aanwezig is en dit geen AI-Copilot is (AI-Copilot heeft geen vaste pricing plans)
                    if (!empty($service['pricing']) && !$hasPricingRendered && in_array($id, ['processen-portalen', 'adoptie-begeleiding', 'copilot-plannen', 'workshops-trainingen', 'copilot-ai-experience'], true)) {
                        echo $this->renderPricingSection($service['pricing']);
                        $hasPricingRendered = true;
                    }
                    continue;
                }

                // B. Wat wij voor u doen / Pijlers / Features
                if (preg_match('/^(Wat wij|Wat we|Pijlers|Features|Diensten|Bouwstenen|Zes modules|Zes vormen)/i', $secTitle)) {
                    echo $this->renderPillarsSection($secTitle, $secContent, $service);
                    continue;
                }

                // C. In de praktijk / Use Cases
                if (preg_match('/^(In de praktijk|Use cases|Cases|Praktijkcases)/i', $secTitle)) {
                    echo $this->renderCasesSection($secTitle, $secContent, $service);
                    continue;
                }

                // D. Onze aanpak / Stappen / Proces
                if (preg_match('/^(Onze aanpak|Aanpak|In \d+ stappen|Stappen|Proces|Werkwijze|Hoe werkt|Een bewezen aanpak)/i', $secTitle)) {
                    echo $this->renderAanpakSection($secTitle, $secContent, $service);
                    continue;
                }

                // E. Governance & Veiligheid
                if (preg_match('/^(Veilig én verantwoord|Governance|Veiligheid|Compliance)/i', $secTitle)) {
                    echo $this->renderGovernanceSection($secTitle, $secContent, $service);
                    continue;
                }

                // F. Vergelijking / Comparison Table
                if (preg_match('/^(Wat zit er in welk pakket|Vergelijken|Vergelijking|De verschillen)/i', $secTitle) || strpos($secContent, '| ---') !== false) {
                    echo $this->renderCompareSection($secTitle, $secContent, $service);
                    $hasComparisonRendered = true;
                    continue;
                }

                // G. Standaard Prose Sectie (bijv. Randvoorwaarden, Ambassadeurs, Startpunten)
                echo $this->renderProseSection($secTitle, $secContent, $service);
            endforeach;
            ?>

            <!-- 3. Meerkoloms Pricing Grid (indien nog niet getoond) -->
            <?php if (!empty($service['pricing']) && !$hasPricingRendered): ?>
                <?= $this->renderPricingSection($service['pricing']); ?>
            <?php endif; ?>

            <!-- 4. Veelgestelde Vragen (FAQ) -->
            <?php if (!empty($service['faq'])): ?>
                <?= $this->renderFaqSection($service['faq'], $service); ?>
            <?php endif; ?>

            <!-- 5. Gerelateerde Diensten (Doorklikken) -->
            <?= $this->renderRelatedServices($id); ?>

            <!-- 6. Signature Call to Action Banner (#cta-final) -->
            <?= $this->renderCtaFinal($service); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Intro / Uitdaging sectie (.intro-grid met .stat-card of .intro-pillars).
     */
    private function renderIntroSection(string $title, string $content, array $service): string {
        $fm = $service['frontmatter'];
        $eyebrow = $service['eyebrow'] ?: 'Waarom Noppa';

        // Splits intro in tekst en eventuele inline sub-elementen
        $paragraphs = array_filter(explode("\n\n", $content), fn($p) => trim($p) !== '');
        $leadHtml = '';
        foreach ($paragraphs as $p) {
            $leadHtml .= '<p class="body-text">' . $this->parsedown->line($p) . '</p>';
        }

        // Bepaal rechterkolom (stats of intro_pillars)
        $rightColHtml = '';
        if (!empty($service['stats'])) {
            $rightColHtml .= '<div class="stat-card">';
            foreach ($service['stats'] as $s) {
                $rightColHtml .= '<div class="stat">';
                $rightColHtml .= '<span class="stat-num">' . htmlspecialchars($s['num'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>';
                $rightColHtml .= '<span class="stat-lbl">' . htmlspecialchars($s['lbl'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>';
                $rightColHtml .= '</div>';
            }
            $rightColHtml .= '</div>';
        } elseif (!empty($service['intro_pillars'])) {
            $rightColHtml .= '<div class="intro-pillars">';
            foreach ($service['intro_pillars'] as $ip) {
                $icon = $ip['icon'] ?? 'sparkles';
                $rightColHtml .= '<div class="intro-pillar">';
                $rightColHtml .= '<div class="ip-icon">' . $this->getSvgIcon($icon, 20) . '</div>';
                $rightColHtml .= '<div>';
                $rightColHtml .= '<h4>' . htmlspecialchars($ip['title'] ?? '', ENT_QUOTES, 'UTF-8') . '</h4>';
                $rightColHtml .= '<p>' . htmlspecialchars($ip['desc'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
                $rightColHtml .= '</div>';
                $rightColHtml .= '</div>';
            }
            $rightColHtml .= '</div>';
        }

        ob_start();
        ?>
        <section class="intro" id="intro">
            <div class="container">
                <div class="intro-grid">
                    <div>
                        <span class="label"><span class="dot"></span><?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8'); ?></span>
                        <h2 class="h2"><?= $this->formatEmTitle($title); ?></h2>
                        <?= $leadHtml; ?>
                    </div>
                    <?php if (!empty($rightColHtml)): ?>
                    <div>
                        <?= $rightColHtml; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Wat wij voor u doen / Pijlers grid (.pillars-grid met .pillar).
     */
    private function renderPillarsSection(string $title, string $content, array $service): string {
        $subItems = $this->parseSubItems($content);
        $introText = $this->extractIntroText($content);

        // Icon mapping helper
        $iconMap = [
            'readiness'   => 'search',
            'scan'        => 'search',
            'pilot'       => 'rocket',
            'agent'       => 'gear',
            'studio'      => 'gear',
            'governance'  => 'shield',
            'purview'     => 'shield',
            'adoptie'     => 'team',
            'training'    => 'team',
            'roi'         => 'chart',
            'meetbaar'    => 'chart',
            'snel'        => 'sparkles',
            'vast'        => 'dashboard',
            'mens'        => 'team'
        ];

        ob_start();
        ?>
        <section id="wat-doen" class="section-alt">
            <div class="container">
                <span class="label"><span class="dot"></span>Wat wij voor u doen</span>
                <h2 class="h2"><?= $this->formatEmTitle($title); ?></h2>
                <?php if (!empty($introText)): ?>
                <p class="body-text" style="max-width: 680px; margin-bottom: 18px;"><?= $introText; ?></p>
                <?php endif; ?>

                <?php if (!empty($subItems)): ?>
                <div class="pillars-grid">
                    <?php foreach ($subItems as $item):
                        $cleanTitle = $item['cleanTitle'];
                        $lowerTitle = strtolower($cleanTitle);
                        $icon = 'sparkles';
                        foreach ($iconMap as $kw => $ic) {
                            if (strpos($lowerTitle, $kw) !== false) {
                                $icon = $ic;
                                break;
                            }
                        }
                    ?>
                    <div class="pillar">
                        <div class="pillar-ic">
                            <?= $this->getSvgIcon($icon, 22); ?>
                        </div>
                        <h3><?= htmlspecialchars($cleanTitle, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?= $this->parsedown->line($item['content']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render In de praktijk / Use Cases grid (.cases-grid met .case en .case-num).
     */
    private function renderCasesSection(string $title, string $content, array $service): string {
        $subItems = $this->parseSubItems($content);
        $introText = $this->extractIntroText($content);

        ob_start();
        ?>
        <section id="cases" class="section">
            <div class="container">
                <span class="label"><span class="dot"></span>In de praktijk</span>
                <h2 class="h2"><?= $this->formatEmTitle($title); ?></h2>
                <?php if (!empty($introText)): ?>
                <p class="body-text" style="max-width: 680px;"><?= $introText; ?></p>
                <?php endif; ?>

                <?php if (!empty($subItems)): ?>
                <div class="cases-grid">
                    <?php foreach ($subItems as $idx => $item): ?>
                    <div class="case">
                        <div class="case-num"><?= $idx + 1; ?></div>
                        <div>
                            <h4><?= htmlspecialchars($item['cleanTitle'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p><?= $this->parsedown->line($item['content']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Onze aanpak / Stappen / Proces (.timeline-grid of .proces-grid in .section-navy).
     */
    private function renderAanpakSection(string $title, string $content, array $service): string {
        $subItems = $this->parseSubItems($content);
        $introText = $this->extractIntroText($content);

        // Indien geen ### koppen gevonden, probeer genummerde lijst 1. **Titel** Beschrijving
        if (empty($subItems)) {
            $subItems = $this->parseNumberedList($content);
        }

        $stepCount = count($subItems);
        $gridClass = ($stepCount === 5) ? 'proces-grid' : 'timeline-grid';
        $cardClass = ($stepCount === 5) ? 'pstep' : 'tl-step';
        $numClass  = ($stepCount === 5) ? 'pstep-num' : 'tl-num';

        ob_start();
        ?>
        <section id="aanpak" class="section-navy">
            <div class="container">
                <span class="label"><span class="dot"></span>Onze aanpak</span>
                <h2 class="h2 light"><?= $this->formatEmTitle($title); ?></h2>
                <?php if (!empty($introText)): ?>
                <p class="body-text" style="max-width: 680px;"><?= $introText; ?></p>
                <?php endif; ?>

                <?php if (!empty($subItems)): ?>
                <div class="<?= $gridClass; ?>">
                    <?php foreach ($subItems as $idx => $item): ?>
                    <div class="<?= $cardClass; ?>">
                        <span class="<?= $numClass; ?>"><?= $idx + 1; ?></span>
                        <h4><?= htmlspecialchars($item['cleanTitle'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p><?= $this->parsedown->line($item['content']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Governance sectie (.gov-grid met checklist en visual quote card).
     */
    private function renderGovernanceSection(string $title, string $content, array $service): string {
        $paragraphs = [];
        $listItems = [];
        $quote = '';
        $quoteBy = '';

        $lines = explode("\n", $content);
        $textBuffer = [];

        foreach ($lines as $line) {
            $t = trim($line);
            if (str_starts_with($t, '>')) {
                $qText = trim(ltrim($t, '> '));
                if (str_starts_with($qText, '—') || str_starts_with($qText, '-')) {
                    $quoteBy = $qText;
                } else {
                    $quote .= ($quote ? ' ' : '') . $qText;
                }
                continue;
            }

            if (preg_match('/^[-*]\s+\*\*(.*?)\*\*:\s*(.*)$/', $t, $m)) {
                $listItems[] = [
                    'strong' => $m[1],
                    'text'   => $m[2]
                ];
                continue;
            }

            if ($t === '') {
                if (!empty($textBuffer)) {
                    $paragraphs[] = implode(' ', $textBuffer);
                    $textBuffer = [];
                }
            } else {
                $textBuffer[] = $t;
            }
        }
        if (!empty($textBuffer)) {
            $paragraphs[] = implode(' ', $textBuffer);
        }

        $leadText = !empty($paragraphs) ? '<p class="body-text">' . $this->parsedown->line($paragraphs[0]) . '</p>' : '';
        $iconList = ['cloud', 'shield', 'document', 'chart', 'sparkles'];

        ob_start();
        ?>
        <section id="governance" class="section-alt">
            <div class="container">
                <div class="gov-grid">
                    <div>
                        <span class="label"><span class="dot"></span>Veilig én verantwoord</span>
                        <h2 class="h2"><?= $this->formatEmTitle($title); ?></h2>
                        <?= $leadText; ?>

                        <?php if (!empty($listItems)): ?>
                        <ul class="gov-list">
                            <?php foreach ($listItems as $idx => $li):
                                $icon = $iconList[$idx % count($iconList)];
                            ?>
                            <li>
                                <span class="gov-check"><?= $this->getSvgIcon($icon, 18); ?></span>
                                <div class="gov-text">
                                    <strong><?= htmlspecialchars($li['strong'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                    <span><?= htmlspecialchars($li['text'], ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($quote)): ?>
                    <div class="gov-visual">
                        <p class="gov-quote"><?= $this->formatEmTitle($quote); ?></p>
                        <?php if (!empty($quoteBy)): ?>
                        <p class="gov-by"><?= htmlspecialchars($quoteBy, ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Vergelijkingstabel sectie (.compare-wrap met .ctable).
     */
    private function renderCompareSection(string $title, string $content, array $service): string {
        $introText = $this->extractIntroText($content);
        $tableStart = strpos($content, '|');
        $tableMarkdown = ($tableStart !== false) ? substr($content, $tableStart) : '';

        ob_start();
        ?>
        <section id="compare" class="section-alt">
            <div class="container">
                <span class="label"><span class="dot"></span>Vergelijken</span>
                <h2 class="h2"><?= $this->formatEmTitle($title); ?></h2>
                <?php if (!empty($introText)): ?>
                <p class="body-text" style="max-width: 680px;"><?= $introText; ?></p>
                <?php endif; ?>

                <?php if (!empty($tableMarkdown)): ?>
                <div class="compare-wrap table-responsive">
                    <?= $this->renderComparisonContent($tableMarkdown); ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Standaard Prose sectie (.artikel-prose).
     */
    private function renderProseSection(string $title, string $content, array $service): string {
        ob_start();
        ?>
        <section class="section">
            <div class="container">
                <div class="artikel-prose">
                    <h2><?= $this->formatEmTitle($title); ?></h2>
                    <?= $this->parsedown->text($content); ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Pricing Grid sectie (#pricing met .pcard en badges).
     */
    public function renderPricingSection(array $pricing): string {
        $plans = $pricing['plans'] ?? [];
        if (empty($plans)) {
            return '';
        }

        ob_start();
        ?>
        <section class="page-section section-pricing page-section-alt" id="pricing">
            <div class="container">
                <header class="section-header text-center">
                    <?php if (!empty($pricing['subtitle'])): ?>
                    <span class="section-subtitle-tag"><?= htmlspecialchars($pricing['subtitle'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                    <h2 class="section-title"><?= htmlspecialchars($pricing['title'] ?? 'Kies wat past bij uw organisatiegrootte', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php if (!empty($pricing['desc'])): ?>
                    <p class="section-desc"><?= htmlspecialchars($pricing['desc'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </header>

                <?= $this->renderPricingGrid($pricing); ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render het meerkoloms pricing grid met .pcard en badges.
     */
    public function renderPricingGrid(array $pricing): string {
        $plans = $pricing['plans'] ?? [];
        if (empty($plans)) {
            return '';
        }

        $gridCols = count($plans);
        $gridClass = ($gridCols === 3) ? 'pricing-grid grid-3' : ($gridCols === 2 ? 'pricing-grid grid-2' : 'pricing-grid');

        ob_start();
        ?>
        <div class="<?= $gridClass; ?>">
            <?php foreach ($plans as $plan):
                $isFeatured = !empty($plan['featured']);
                $cardClasses = 'pcard' . ($isFeatured ? ' featured' : '');
                $tier   = $plan['tier'] ?? '';
                $name   = $plan['name'] ?? '';
                $target = $plan['target'] ?? '';
                $badge  = $plan['badge'] ?? ($isFeatured ? 'Meest gekozen' : '');
                $prefix = $plan['price_prefix'] ?? '';
                $amount = $plan['price_amount'] ?? '';
                $suffix = $plan['price_suffix'] ?? '';
                $permw  = $plan['price_permw'] ?? '';
                $feats  = $plan['features'] ?? [];
                $ctaText = $plan['cta']['text'] ?? 'Plan een afspraak →';
                $ctaUrl  = $plan['cta']['url'] ?? '/contact';
                $ctaVar  = $isFeatured ? 'btn-primary' : 'btn-dark';
            ?>
            <div class="<?= $cardClasses; ?>">
                <?php if (!empty($badge)): ?>
                <span class="badge-meest"><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>

                <?php if (!empty($tier)): ?>
                <span class="p-tier"><?= htmlspecialchars($tier, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>

                <h3 class="p-name"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h3>

                <?php if (!empty($target)): ?>
                <p class="p-target"><?= htmlspecialchars($target, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>

                <div class="p-price">
                    <?php if (!empty($prefix)): ?>
                    <span class="p-amount-prefix"><?= htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>

                    <span class="p-amount"><?= htmlspecialchars($amount, ENT_QUOTES, 'UTF-8'); ?></span>

                    <?php if (!empty($suffix)): ?>
                    <span class="p-amount-suffix"><?= htmlspecialchars($suffix, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>

                    <?php if (!empty($permw)): ?>
                    <div class="p-permw"><?= htmlspecialchars($permw, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($feats)): ?>
                <ul class="p-features">
                    <?php foreach ($feats as $feat): ?>
                    <li>
                        <span class="p-check" aria-hidden="true">
                            <span class="p-check-tick">✓</span>
                        </span>
                        <span><?= htmlspecialchars($feat, ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <a class="btn <?= $ctaVar; ?> p-cta" href="<?= htmlspecialchars($this->formatUrl($ctaUrl), ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($ctaText, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Render Veelgestelde Vragen sectie (#faq met .faq-grid en interactive details).
     */
    public function renderFaqSection(array $faqItems, array $service): string {
        ob_start();
        ?>
        <section class="page-section section-faq section-alt" id="faq">
            <div class="container">
                <span class="label"><span class="dot"></span>Veelgestelde vragen</span>
                <h2 class="h2">Wat u nog wil <em>weten</em></h2>
                <div class="faq-grid">
                    <?php foreach ($faqItems as $fIdx => $item): ?>
                    <details class="faq" <?= $fIdx === 0 ? 'open' : ''; ?>>
                        <summary><?= htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8'); ?></summary>
                        <div class="faq-answer">
                            <?= $item['answer']; ?>
                        </div>
                    </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render de Signature Call to Action banner (#cta-final met navy button).
     */
    public function renderCtaFinal(array $service): string {
        $cta = $service['cta'] ?? [];
        $title = $cta['title'] ?? 'Klaar om de volgende stap te zetten?';
        $desc  = $cta['desc']  ?? 'Plan een vrijblijvend kennismakingsgesprek van 30 minuten. Wij bespreken graag hoe we uw organisatie direct productiever maken.';
        $text  = $cta['btn_text'] ?? 'Plan een kennismaking →';
        $url   = $cta['btn_url'] ?? '/contact';

        ob_start();
        ?>
        <section id="cta-final">
            <div class="container">
                <h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>
                <p><?= htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></p>
                <a href="<?= htmlspecialchars($this->formatUrl($url), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-dark">
                    <?= htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render gerelateerde diensten kaarten voor doorklikken.
     */
    public function renderRelatedServices(string $currentId): string {
        $all = $this->getAllServices();
        $related = array_filter($all, fn($s) => $s['id'] !== $currentId);
        $related = array_slice($related, 0, 3);

        if (empty($related)) {
            return '';
        }

        ob_start();
        ?>
        <section class="page-section section-related" id="gerelateerde-diensten">
            <div class="container">
                <header class="section-header">
                    <span class="section-subtitle-tag">Samenhang & Meerwaarde</span>
                    <h2 class="section-title">Bekijk ook onze andere oplossingen</h2>
                    <p class="section-desc">Onze diensten versterken elkaar. Combineer adoptie, governance en training voor maximaal rendement.</p>
                </header>

                <div class="related-services-grid">
                    <?php foreach ($related as $item):
                        $rIcon = $item['badgeIcon'] ?: 'sparkles';
                    ?>
                    <article class="related-service-card">
                        <div class="related-card-icon" aria-hidden="true">
                            <?= $this->getSvgIcon($rIcon, 24); ?>
                        </div>
                        <span class="related-card-eyebrow"><?= htmlspecialchars($item['eyebrow'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <h3 class="related-card-title"><?= htmlspecialchars($item['shortTitle'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="related-card-desc"><?= htmlspecialchars(strip_tags((string)$item['description']), ENT_QUOTES, 'UTF-8'); ?></p>
                        <a href="<?= htmlspecialchars($this->formatUrl('/diensten/' . $item['id']), ENT_QUOTES, 'UTF-8'); ?>" class="related-card-link">
                            Bekijk dienst &rarr;
                        </a>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Render vergelijkingstabel content en styleer als .ctable.
     */
    public function renderComparisonContent(string $rawMarkdown): string {
        $html = $this->parsedown->text($rawMarkdown);
        $html = preg_replace('/<table>/i', '<table class="ctable">', $html);
        $html = preg_replace('/<tr>\s*<td><strong>(.*?)<\/strong><\/td>\s*<td><\/td>\s*<td><\/td>\s*<td><\/td>\s*<\/tr>/i', '<tr class="row-section"><td colspan="4"><strong>$1</strong></td></tr>', $html);
        $html = preg_replace('/<td>\s*(?:✓|&#10003;)\s*([^<]*)<\/td>/u', '<td class="tier has"><span class="tick">&#10003;</span> $1</td>', $html);
        $html = preg_replace('/<td>\s*(?:—|&mdash;)\s*<\/td>/u', '<td class="tier"><span class="dash">&mdash;</span></td>', $html);
        $html = preg_replace('/<td>(.*?€.*?)<\/td>/u', '<td class="tier has"><strong>$1</strong></td>', $html);
        return $html;
    }

    /**
     * Render ruwe HTML sectie met shortcodes & URL formatting.
     */
    private function renderRawHtmlSection(string $rawHtml): string {
        $bodyHtml = $this->parsedown->text($rawHtml);

        $bodyHtml = preg_replace_callback('/<img[^>]*src=["\'](?:\.\.\/|\.\/)?assets\/icons\/([a-zA-Z0-9_-]+)\.svg["\'][^>]*>/i', function($m) {
            $svg = $this->getSvgIcon($m[1], 20);
            return $svg ?: $m[0];
        }, $bodyHtml);

        $bodyHtml = preg_replace_callback('/\[icon:([a-zA-Z0-9_-]+)\]/i', function($m) {
            return $this->getSvgIcon($m[1], 20);
        }, $bodyHtml);

        $bodyHtml = preg_replace_callback('/href=["\']((?:\.\.\/|\.\/)?[^"\'#]+)(\#[^"\']*)?["\']/i', function($m) {
            $rawTarget = $m[1];
            $hash = $m[2] ?? '';
            if (str_starts_with($rawTarget, 'http://') || str_starts_with($rawTarget, 'https://') || str_starts_with($rawTarget, 'mailto:') || str_starts_with($rawTarget, 'tel:')) {
                return 'href="' . $rawTarget . $hash . '"';
            }
            return 'href="' . htmlspecialchars($this->formatUrl($rawTarget . $hash), ENT_QUOTES, 'UTF-8') . '"';
        }, $bodyHtml);

        return $bodyHtml;
    }

    /**
     * Hulpfunctie: parseer sub-elementen onder ### koppen.
     */
    private function parseSubItems(string $markdown): array {
        $rawItems = explode("\n### ", "\n" . $markdown);
        $items = [];

        foreach ($rawItems as $idx => $item) {
            if ($idx === 0 && trim($item) === '') continue;
            $lines = explode("\n", $item, 2);
            $rawTitle = trim($lines[0]);
            $body = isset($lines[1]) ? trim($lines[1]) : '';
            if (empty($rawTitle)) continue;

            $num = null;
            $cleanTitle = $rawTitle;
            if (preg_match('/^(\d+)\.\s*(.*)$/', $rawTitle, $m)) {
                $num = (int)$m[1];
                $cleanTitle = trim($m[2]);
            }

            $items[] = [
                'rawTitle'   => $rawTitle,
                'cleanTitle' => $cleanTitle,
                'num'        => $num,
                'content'    => $body
            ];
        }

        return $items;
    }

    /**
     * Hulpfunctie: parseer genummerde lijstitems 1. **Titel**\nBeschrijving.
     */
    private function parseNumberedList(string $markdown): array {
        $lines = explode("\n", $markdown);
        $items = [];
        $current = null;

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (preg_match('/^(\d+)\.\s+\*\*(.*?)\*\*(.*)$/', $trimmed, $m)) {
                if ($current !== null) {
                    $items[] = $current;
                }
                $current = [
                    'rawTitle'   => $m[2],
                    'cleanTitle' => $m[2],
                    'num'        => (int)$m[1],
                    'content'    => trim($m[3])
                ];
            } elseif ($current !== null && $trimmed !== '') {
                $current['content'] .= ($current['content'] ? ' ' : '') . $trimmed;
            }
        }
        if ($current !== null) {
            $items[] = $current;
        }

        return $items;
    }

    /**
     * Hulpfunctie: haal introductietekst op vóór sub-elementen of tabellen.
     */
    private function extractIntroText(string $markdown): string {
        $lines = explode("\n", $markdown);
        $introLines = [];

        foreach ($lines as $line) {
            $t = trim($line);
            if (str_starts_with($t, '###') || str_starts_with($t, '|') || preg_match('/^\d+\.\s+\*\*/', $t)) {
                break;
            }
            if ($t !== '') {
                $introLines[] = $t;
            }
        }

        return implode(' ', $introLines);
    }

    /**
     * Formatteer titel met <em> accent styling.
     */
    private function formatEmTitle(string $title): string {
        if (strpos($title, '<em>') !== false || strpos($title, '<span>') !== false || strpos($title, '<span ') !== false) {
            return $title;
        }
        // Vervang *accent* door <em>accent</em>
        if (preg_match('/\*(.*?)\*/', $title)) {
            return preg_replace('/\*(.*?)\*/', '<em>$1</em>', $title);
        }
        return htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
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
     * Formatteer relatieve URLs robuust voor submappen en query parameters.
     */
    public function formatUrl(string $url): string {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
            return $url;
        }

        // Interne ankers zoals #pricing of #aanpak
        if (str_starts_with($url, '#')) {
            return $url;
        }

        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';
        $isQueryMode = isset($_GET['page']);

        $parts = explode('#', $url, 2);
        $rawPath = trim($parts[0]);
        $hash  = isset($parts[1]) ? '#' . $parts[1] : '';

        // Strip leading ../ en ./
        $path = preg_replace('/^(\.\.\/|\.\/)+/', '', $rawPath);
        // Strip .php of .html extensies
        $path = preg_replace('/\.(php|html)$/i', '', $path);
        $path = trim($path, '/');

        // Normaliseer bekende standalone diensten-bestanden
        if (in_array($path, ['ai-copilot', 'copilot-plannen', 'copilot-ai-experience', 'processen-portalen', 'adoptie-begeleiding', 'workshops-trainingen', 'noppa-ai-fit'], true)) {
            $path = 'diensten/' . $path;
        }

        if ($isQueryMode) {
            if ($path === '' || $path === 'home' || $path === 'index') {
                return 'index.php' . $hash;
            }
            if ($path === 'diensten') {
                return 'index.php?page=diensten' . $hash;
            }
            if (str_starts_with($path, 'diensten/')) {
                $slug = substr($path, 9);
                return 'index.php?page=diensten&id=' . urlencode($slug) . $hash;
            }
            if ($path === 'kennisbank') {
                return 'index.php?page=kennisbank' . $hash;
            }
            if (str_starts_with($path, 'kennisbank/')) {
                $slug = substr($path, 11);
                return 'index.php?page=kennisbank&slug=' . urlencode($slug) . $hash;
            }
            if (str_starts_with($path, 'team/')) {
                $id = substr($path, 5);
                return 'index.php?page=team&id=' . urlencode($id) . $hash;
            }
            return 'index.php?page=' . urlencode($path) . $hash;
        }

        if ($path === '' || $path === 'home' || $path === 'index') {
            return ($assetPrefix === './' ? './' : $assetPrefix) . $hash;
        }

        return $assetPrefix . $path . $hash;
    }

    /**
     * Robuuste YAML frontmatter parser voor geneste structures, arrays en objecten.
     */
    private function parseYaml(string $yaml): array {
        $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", $yaml));
        $result = [];
        $currentSection = null;
        $currentSub = null;
        $currentPlan = null;
        $currentFeatures = null;

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '' || str_starts_with($trimmed, '#')) continue;

            $indent = strlen($line) - strlen(ltrim($line));

            // Indent 0: Root keys
            if ($indent === 0) {
                if (preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $trimmed, $m)) {
                    $key = $m[1];
                    $val = trim($m[2]);
                    if ($val === '') {
                        $result[$key] = [];
                        $currentSection = $key;
                        $currentSub = null;
                        $currentPlan = null;
                        $currentFeatures = null;
                    } else {
                        $result[$key] = $this->cleanYamlValue($val);
                        $currentSection = null;
                        $currentSub = null;
                        $currentPlan = null;
                        $currentFeatures = null;
                    }
                    continue;
                }
            }

            // Indent 2: Sub-keys onder root (bijv. pricing: -> title: "..." of stats: -> - num: ...)
            if ($indent === 2 && $currentSection) {
                if (preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $trimmed, $m)) {
                    $k = $m[1];
                    $v = trim($m[2]);
                    if (!isset($result[$currentSection]) || (is_array($result[$currentSection]) && empty($result[$currentSection]))) {
                        $result[$currentSection] = [];
                    }
                    if ($v === '') {
                        $result[$currentSection][$k] = [];
                        $currentSub = $k;
                        $currentPlan = null;
                        $currentFeatures = null;
                    } else {
                        $result[$currentSection][$k] = $this->cleanYamlValue($v);
                        $currentSub = null;
                        $currentPlan = null;
                        $currentFeatures = null;
                    }
                    continue;
                }

                if (preg_match('/^-\s+(.*)$/', $trimmed, $m)) {
                    if (!isset($result[$currentSection]) || !is_array($result[$currentSection])) {
                        $result[$currentSection] = [];
                    }
                    $rest = trim($m[1]);
                    if ($rest !== '' && preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $rest, $rm)) {
                        $item = [$rm[1] => $this->cleanYamlValue($rm[2])];
                        $result[$currentSection][] = $item;
                        $lastIdx = array_key_last($result[$currentSection]);
                        $currentPlan = &$result[$currentSection][$lastIdx];
                        $currentSub = null;
                        $currentFeatures = null;
                    } else {
                        $result[$currentSection][] = $this->cleanYamlValue($m[1]);
                        $currentPlan = null;
                    }
                    continue;
                }
            }

            // Indent 4: Onder sub-section (pricing.plans -> - tier: ...) OF onder indent-2 list item
            if ($indent === 4 && $currentSection) {
                // Case A: Onder indent-2 list item (bijv. stats of intro_pillars)
                if ($currentPlan !== null && $currentSub === null) {
                    if (preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $trimmed, $m)) {
                        $currentPlan[$m[1]] = $this->cleanYamlValue($m[2]);
                        continue;
                    }
                }

                // Case B: List item onder currentSub (bijv. pricing.plans -> - tier: ...)
                if ($currentSub) {
                    if (preg_match('/^-\s*(.*)$/', $trimmed, $m)) {
                        $rest = trim($m[1]);
                        $newPlan = [];
                        if ($rest !== '' && preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $rest, $rm)) {
                            $newPlan[$rm[1]] = $this->cleanYamlValue($rm[2]);
                        }
                        if (!isset($result[$currentSection][$currentSub]) || !is_array($result[$currentSection][$currentSub])) {
                            $result[$currentSection][$currentSub] = [];
                        }
                        $result[$currentSection][$currentSub][] = $newPlan;
                        $lastIdx = array_key_last($result[$currentSection][$currentSub]);
                        $currentPlan = &$result[$currentSection][$currentSub][$lastIdx];
                        $currentFeatures = null;
                        continue;
                    }
                    if (preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $trimmed, $m)) {
                        $k = $m[1];
                        $v = trim($m[2]);
                        $result[$currentSection][$currentSub][$k] = $this->cleanYamlValue($v);
                        continue;
                    }
                }
            }

            // Indent 6: Velden binnen een plan (bijv. tier, name, features:)
            if ($indent === 6 && $currentPlan !== null) {
                if (preg_match('/^([a-zA-Z0-9_-]+):\s*(.*)$/', $trimmed, $m)) {
                    $k = $m[1];
                    $v = trim($m[2]);
                    if ($v === '') {
                        $currentPlan[$k] = [];
                        $currentFeatures = &$currentPlan[$k];
                    } else {
                        $currentPlan[$k] = $this->cleanYamlValue($v);
                        $currentFeatures = null;
                    }
                    continue;
                }
                if (preg_match('/^-\s+(.*)$/', $trimmed, $m)) {
                    $currentPlan[] = $this->cleanYamlValue($m[1]);
                    continue;
                }
            }

            // Indent 8: Feature items binnen een featurelijst
            if ($indent === 8 && $currentFeatures !== null) {
                if (preg_match('/^-\s+(.*)$/', $trimmed, $m)) {
                    $currentFeatures[] = $this->cleanYamlValue($m[1]);
                    continue;
                }
            }
        }

        return $result;
    }

    private function cleanYamlValue(string $val): mixed {
        $val = trim($val);
        $val = trim($val, "\"'");

        if (strtolower($val) === 'true') return true;
        if (strtolower($val) === 'false') return false;
        if (strtolower($val) === 'null') return null;

        // JSON candidate
        if (str_starts_with($val, '{') && str_ends_with($val, '}')) {
            $jsonCandidate = preg_replace('/([a-zA-Z0-9_-]+):/', '"$1":', $val);
            $decoded = json_decode($jsonCandidate, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return $val;
    }
}
