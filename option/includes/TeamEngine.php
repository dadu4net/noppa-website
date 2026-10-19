<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Team Profile Engine
 * Standardized according to all Noppa skills:
 * - noppa-website-content
 * - noppa-ux-ui (60-30-10, Kentledge, tactile feedback, glassmorphism)
 * - noppa-website-branding
 * - noppa-website-hero
 * - noppa-website-icons
 * - noppa-website-wcag
 * =========================================================================
 */

declare(strict_types=1);

require_once __DIR__ . '/Parsedown.php';

class TeamEngine {
    private Parsedown $parsedown;
    private string $teamDir;
    private string $iconsDir;
    private array $siteConfig;

    public function __construct(string $teamDir = '', string $iconsDir = '', array $siteConfig = []) {
        $this->teamDir    = rtrim($teamDir ?: dirname(__DIR__) . '/data/team', '/\\') . '/';
        $this->iconsDir   = rtrim($iconsDir ?: dirname(__DIR__) . '/assets/icons', '/\\') . '/';
        $this->siteConfig = $siteConfig ?: ($GLOBALS['siteConfig'] ?? []);
        $this->parsedown  = new Parsedown();
        $this->parsedown->setSafeMode(false);
    }

    /**
     * Laad een teamlid profiel op basis van ID (slug).
     */
    public function loadProfile(string $id): ?array {
        $cleanId = preg_replace('/[^a-zA-Z0-9_-]/', '', $id);
        $filePath = $this->teamDir . $cleanId . '.md';

        if (!file_exists($filePath)) {
            return null;
        }

        $raw = file_get_contents($filePath);
        return $this->parseProfile($raw, $cleanId);
    }

    /**
     * Parseer het Markdown document van het teamlid.
     */
    public function parseProfile(string $raw, string $id): array {
        $frontmatter = [];
        $markdownText = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $matches)) {
            $frontmatter = $this->parseYaml($matches[1]);
            $markdownText = $matches[2];
        }

        // Basisinformatie
        $firstName = $frontmatter['firstName'] ?? 'Consultant';
        $lastName  = $frontmatter['lastName'] ?? '';
        $fullName  = trim($firstName . ' ' . $lastName);
        $jobTitle  = $frontmatter['jobTitle'] ?? 'Consultant';
        $roleTitle = $frontmatter['roleTitle'] ?? $jobTitle;
        $shortBio  = $frontmatter['shortBio'] ?? '';
        $phone     = $frontmatter['phone'] ?? ($this->siteConfig['company']['phone'] ?? '+31 (0)6 13 35 77 23');
        $email     = $frontmatter['email'] ?? ($this->siteConfig['company']['email'] ?? 'info@noppa.nl');
        $linkedin  = $frontmatter['linkedin'] ?? ($this->siteConfig['company']['linkedin'] ?? '');
        $location  = $frontmatter['location'] ?? ($this->siteConfig['company']['full_address'] ?? 'Berlicum, Noord-Brabant');
        $image     = $frontmatter['image'] ?? './assets/images/Rik Dobbelsteen.jpeg';
        $initials  = mb_substr($firstName, 0, 1) . mb_substr($lastName, 0, 1);

        // Splits Markdown secties op basis van ## koppen
        $rawSections = explode("\n## ", "\n" . $markdownText);
        $sections = [];
        foreach ($rawSections as $sec) {
            if (trim($sec) === '') continue;
            $lines = explode("\n", $sec, 2);
            $secTitle = trim($lines[0]);
            $secContent = isset($lines[1]) ? trim($lines[1]) : '';
            $sections[$secTitle] = $secContent;
        }

        // Parseer onderdelen
        $bioKey = 'Over ' . $firstName;
        $bioMarkdown = $sections[$bioKey] ?? ($sections['Over ' . $fullName] ?? ($sections['Biografie'] ?? ''));
        $bioHtml = $this->parsedown->text($bioMarkdown);

        $expertiseItems    = $this->parseSubItems($sections['Expertise'] ?? '');
        $werkervaringItems = $this->parseSubItems($sections['Werkervaring'] ?? '');
        $referentiesItems  = $this->parseSubItems($sections['Referenties'] ?? '');

        // Stel page meta samen voor SeoHelper
        $meta = [
            'title'       => $frontmatter['pageTitle'] ?? ($fullName . ' | Team Noppa'),
            'description' => $frontmatter['pageDesc'] ?? ($shortBio ?: 'Maak kennis met ' . $fullName . ' bij Noppa Solutions & Consultants.'),
            'canonical'   => 'https://noppa.nl/team/' . $id,
            'og_image'    => $image,
            'og_type'     => 'profile',
            'robots'      => 'index, follow'
        ];

        return [
            'id'                => $id,
            'meta'              => $meta,
            'frontmatter'       => $frontmatter,
            'firstName'         => $firstName,
            'lastName'          => $lastName,
            'fullName'          => $fullName,
            'initials'          => $initials,
            'jobTitle'          => $jobTitle,
            'roleTitle'         => $roleTitle,
            'shortBio'          => $shortBio,
            'phone'             => $phone,
            'email'             => $email,
            'linkedin'          => $linkedin,
            'location'          => $location,
            'image'             => $image,
            'bioHtml'           => $bioHtml,
            'expertiseItems'    => $expertiseItems,
            'werkervaringItems' => $werkervaringItems,
            'referentiesItems'  => $referentiesItems
        ];
    }

    /**
     * Render volledige HTML voor de teampagina.
     */
    public function renderProfile(array $p): string {
        $telClean = preg_replace('/[^0-9+]/', '', str_replace('(0)', '', $p['phone']));
        $icons = ['sparkles', 'team', 'dashboard', 'idea', 'workflow', 'shield'];

        ob_start();
        ?>
        <!-- HERO SECTIE VOOR CONSULTANT PROFIEL -->
        <section class="portal-hero team-hero" role="region" aria-label="Profiel van <?= htmlspecialchars($p['fullName'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="hero-backdrop" aria-hidden="true"></div>
            <div class="container hero-container">
                <!-- Kruimelpad -->
                <nav class="breadcrumb" aria-label="Kruimelpad">
                    <a href="<?= htmlspecialchars($this->formatUrl('/'), ENT_QUOTES, 'UTF-8'); ?>">Home</a>
                    <span class="sep" aria-hidden="true">&#8250;</span>
                    <a href="<?= htmlspecialchars($this->formatUrl('/over-ons'), ENT_QUOTES, 'UTF-8'); ?>">Over Ons</a>
                    <span class="sep" aria-hidden="true">&#8250;</span>
                    <span class="current" aria-current="page"><?= htmlspecialchars($p['fullName'], ENT_QUOTES, 'UTF-8'); ?></span>
                </nav>

                <div class="team-hero-grid">
                    <div class="team-hero-info">
                        <div class="hero-badge">
                            <span class="badge-icon" aria-hidden="true"><?= $this->loadSvgIcon('team'); ?></span>
                            <span>Team Noppa</span>
                        </div>
                        <h1 class="hero-title">
                            <?= htmlspecialchars($p['firstName'], ENT_QUOTES, 'UTF-8'); ?> <span class="gradient-text"><?= htmlspecialchars($p['lastName'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </h1>
                        <div class="team-role-badge"><?= htmlspecialchars($p['roleTitle'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <p class="hero-subtitle"><?= htmlspecialchars($p['shortBio'], ENT_QUOTES, 'UTF-8'); ?></p>

                        <div class="hero-cta-group">
                            <a href="<?= htmlspecialchars($this->formatUrl('/contact'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
                                <span class="btn-icon" aria-hidden="true"><?= $this->loadSvgIcon('calendar'); ?></span>
                                <span>Plan kennismaking</span>
                            </a>
                            <button class="btn btn-secondary" id="vcard-btn" type="button">
                                <span class="btn-icon" aria-hidden="true"><?= $this->loadSvgIcon('document'); ?></span>
                                <span>Download vCard</span>
                            </button>
                        </div>
                    </div>

                    <!-- Profile Card Glassmorphism -->
                    <aside class="profile-card" aria-label="Visitekaartje <?= htmlspecialchars($p['fullName'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="profile-avatar-wrap">
                            <?php if (!empty($p['image'])): 
                                $imgSrc = (strpos($p['image'], 'http') === 0) ? $p['image'] : (($GLOBALS['assetPrefix'] ?? './') . ltrim($p['image'], './'));
                            ?>
                            <img src="<?= htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($p['fullName'], ENT_QUOTES, 'UTF-8'); ?>" class="profile-avatar profile-photo" width="150" height="150">
                            <?php else: ?>
                            <div class="profile-avatar profile-initials"><?= htmlspecialchars($p['initials'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <?php endif; ?>
                        </div>
                        <h2 class="profile-name"><?= htmlspecialchars($p['fullName'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <div class="profile-title"><?= htmlspecialchars($p['jobTitle'], ENT_QUOTES, 'UTF-8'); ?></div>

                        <div class="profile-meta">
                            <div class="pm-row">
                                <span class="pm-icon" aria-hidden="true"><?= $this->loadSvgIcon('chat'); ?></span>
                                <span class="pm-val">
                                    <a href="tel:<?= $telClean; ?>">
                                        <?= htmlspecialchars($p['phone'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                </span>
                            </div>
                            <div class="pm-row">
                                <span class="pm-icon" aria-hidden="true"><?= $this->loadSvgIcon('email'); ?></span>
                                <span class="pm-val">
                                    <a href="mailto:<?= htmlspecialchars($p['email'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?= htmlspecialchars($p['email'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                </span>
                            </div>
                            <?php if (!empty($p['linkedin'])): ?>
                            <div class="pm-row">
                                <span class="pm-icon" aria-hidden="true"><?= $this->loadSvgIcon('link'); ?></span>
                                <span class="pm-val">
                                    <a href="https://<?= htmlspecialchars(ltrim($p['linkedin'], 'https://'), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                                        <?= htmlspecialchars($p['linkedin'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                </span>
                            </div>
                            <?php endif; ?>
                            <div class="pm-row">
                                <span class="pm-icon" aria-hidden="true"><?= $this->loadSvgIcon('target'); ?></span>
                                <span class="pm-val"><?= htmlspecialchars($p['location'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- OVER CONSULTANT + QUICK FACTS -->
        <section class="page-section section-content" id="over-consultant">
            <div class="container">
                <header class="section-header text-left">
                    <span class="section-subtitle-tag">Over <?= htmlspecialchars($p['firstName'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <h2 class="section-title">Vraag, antwoord, doen.</h2>
                </header>

                <div class="team-about-grid">
                    <div class="artikel-prose">
                        <?= $p['bioHtml']; ?>
                    </div>

                    <aside class="quick-facts" aria-label="Kort en bondig">
                        <h3>Kort &amp; bondig</h3>
                        <div class="qf-row">
                            <span class="qf-lbl">Functie</span>
                            <span class="qf-val"><?= htmlspecialchars($p['jobTitle'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="qf-row">
                            <span class="qf-lbl">Ervaring</span>
                            <span class="qf-val"><?= htmlspecialchars($p['frontmatter']['qf_experience'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="qf-row">
                            <span class="qf-lbl">Specialisme</span>
                            <span class="qf-val"><?= htmlspecialchars($p['frontmatter']['qf_specialism'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="qf-row">
                            <span class="qf-lbl">Werkgebied</span>
                            <span class="qf-val"><?= htmlspecialchars($p['frontmatter']['qf_region'] ?? 'Nederland', ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="qf-row">
                            <span class="qf-lbl">Talen</span>
                            <span class="qf-val"><?= htmlspecialchars($p['frontmatter']['qf_languages'] ?? 'NL · EN', ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="qf-row">
                            <span class="qf-lbl">Standplaats</span>
                            <span class="qf-val"><?= htmlspecialchars(explode(',', $p['location'])[0], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- EXPERTISE SECTIE -->
        <?php if (!empty($p['expertiseItems'])): ?>
        <section class="page-section page-section-alt" id="expertise">
            <div class="container">
                <header class="section-header">
                    <span class="section-subtitle-tag">Expertise</span>
                    <h2 class="section-title">Waar ik teams mee vooruit help</h2>
                    <p class="section-desc">Praktijkervaring en resultaatgericht werken voor onze opdrachtgevers.</p>
                </header>

                <div class="expertise-grid">
                    <?php foreach ($p['expertiseItems'] as $idx => $exp): 
                        $iconName = $icons[$idx % count($icons)];
                        $svgIcon = $this->loadSvgIcon($iconName);
                    ?>
                    <article class="exp-card">
                        <div class="exp-ico" aria-hidden="true">
                            <?= $svgIcon; ?>
                        </div>
                        <h3><?= htmlspecialchars($exp['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?= nl2br(htmlspecialchars($exp['text'], ENT_QUOTES, 'UTF-8')); ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- WERKERVARING TIMELINE -->
        <?php if (!empty($p['werkervaringItems'])): ?>
        <section class="page-section" id="werkervaring">
            <div class="container-narrow">
                <header class="section-header">
                    <span class="section-subtitle-tag">Werkervaring</span>
                    <h2 class="section-title">Achtergrond &amp; Ervaring</h2>
                    <p class="section-desc">Van implementatie tot strategisch advies.</p>
                </header>

                <div class="timeline">
                    <?php foreach ($p['werkervaringItems'] as $idx => $item): 
                        $parts = array_map('trim', explode('|', $item['title']));
                        $period = $parts[0] ?? '';
                        $role = $parts[1] ?? '';
                        $company = $parts[2] ?? '';
                        $isCurrent = ($idx === 0) ? 'current' : '';
                    ?>
                    <div class="tl-item <?= $isCurrent; ?>">
                        <div class="tl-period"><?= htmlspecialchars($period, ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="tl-role"><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="tl-company"><?= htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="tl-desc"><?= nl2br(htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8')); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- REFERENTIES QUOTES -->
        <?php if (!empty($p['referentiesItems'])): ?>
        <section class="page-section page-section-alt" id="referenties">
            <div class="container">
                <header class="section-header">
                    <span class="section-subtitle-tag">Referenties</span>
                    <h2 class="section-title">Wat opdrachtgevers zeggen</h2>
                    <p class="section-desc">Reacties uit recente trajecten.</p>
                </header>

                <div class="quotes-grid">
                    <?php foreach ($p['referentiesItems'] as $ref): 
                        $parts = array_map('trim', explode('|', $ref['title']));
                        $avatar = $parts[0] ?? 'NL';
                        $refName = $parts[1] ?? '';
                        $refRole = $parts[2] ?? '';
                    ?>
                    <article class="quote-card">
                        <div class="quote-mark" aria-hidden="true">&ldquo;</div>
                        <p class="quote-text"><?= nl2br(htmlspecialchars($ref['text'], ENT_QUOTES, 'UTF-8')); ?></p>
                        <div class="quote-author">
                            <div class="quote-avatar"><?= htmlspecialchars($avatar, ENT_QUOTES, 'UTF-8'); ?></div>
                            <div>
                                <div class="qa-name"><?= htmlspecialchars($refName, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="qa-role"><?= htmlspecialchars($refRole, ENT_QUOTES, 'UTF-8'); ?></div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- CTA BANNER -->
        <section class="page-section" id="kennismaking">
            <div class="container">
                <div class="cta-banner">
                    <div class="cta-banner-content">
                        <span class="section-subtitle-tag" style="color:var(--color-cyan, #00D0F0);">Direct contact</span>
                        <h2 class="cta-title">Laten we <em>kennismaken</em></h2>
                        <p class="cta-desc">Vrijblijvend sparren over Microsoft 365, Copilot of adoptie binnen jouw organisatie. In Berlicum of online via Microsoft Teams.</p>
                        <div class="cta-buttons">
                            <a href="<?= htmlspecialchars($this->formatUrl('/contact'), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">
                                <span class="btn-icon" aria-hidden="true"><?= $this->loadSvgIcon('calendar'); ?></span>
                                <span>Plan een gesprek</span>
                            </a>
                            <a href="mailto:<?= htmlspecialchars($p['email'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-secondary">
                                <span class="btn-icon" aria-hidden="true"><?= $this->loadSvgIcon('email'); ?></span>
                                <span>Mail direct naar <?= htmlspecialchars($p['firstName'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- VCARD DOWNLOAD SCRIPT -->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var vcardBtn = document.getElementById('vcard-btn');
            if (!vcardBtn) return;
            
            vcardBtn.addEventListener('click', function () {
                var vcard = [
                    'BEGIN:VCARD',
                    'VERSION:3.0',
                    'N:<?= addslashes($p['lastName']); ?>;<?= addslashes($p['firstName']); ?>;;;',
                    'FN:<?= addslashes($p['fullName']); ?>',
                    'ORG:<?= addslashes($this->siteConfig['company']['name'] ?? ($this->siteConfig['site_name'] ?? 'Noppa Solutions & Consultants')); ?>',
                    'TITLE:<?= addslashes($p['jobTitle']); ?>',
                    'TEL;TYPE=CELL:<?= addslashes($p['phone']); ?>',
                    'EMAIL;TYPE=WORK:<?= addslashes($p['email']); ?>',
                    'URL:<?= addslashes($this->siteConfig['base_url'] ?? 'https://noppa.nl'); ?>',
                    'URL;TYPE=LinkedIn:https://<?= addslashes(ltrim($p['linkedin'], 'https://')); ?>',
                    'ADR;TYPE=WORK:;;<?= addslashes($this->siteConfig['company']['address'] ?? 'Pijlkruid 44'); ?>;<?= addslashes($this->siteConfig['company']['city'] ?? 'Berlicum'); ?>;<?= addslashes($this->siteConfig['company']['region'] ?? 'Noord-Brabant'); ?>;<?= addslashes($this->siteConfig['company']['postal_code'] ?? '5258 BW'); ?>;<?= addslashes($this->siteConfig['company']['country'] ?? 'Nederland'); ?>',
                    'END:VCARD'
                ].join('\r\n');
                
                var blob = new Blob([vcard], { type: 'text/vcard;charset=utf-8' });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = '<?= addslashes($p['firstName'] . '-' . $p['lastName']); ?>-<?= addslashes(preg_replace('/[^a-zA-Z0-9_-]/', '', $this->siteConfig['site_name'] ?? 'Noppa')); ?>.vcf';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            });
        });
        </script>
        <?php
        return (string)ob_get_clean();
    }

    /**
     * Splits sub-items (### Koppen) uit een Markdown sectie.
     */
    private function parseSubItems(string $content): array {
        $rawItems = explode("\n### ", "\n" . $content);
        $items = [];
        foreach ($rawItems as $item) {
            if (trim($item) === '') continue;
            $lines = explode("\n", $item, 2);
            $items[] = [
                'title' => trim($lines[0]),
                'text'  => isset($lines[1]) ? trim($lines[1]) : ''
            ];
        }
        return $items;
    }

    /**
     * Eenvoudige maar robuuste parser voor YAML frontmatter strings.
     */
    private function parseYaml(string $yaml): array {
        $lines = explode("\n", $yaml);
        $data = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            if (strpos($line, ':') !== false) {
                [$k, $v] = explode(':', $line, 2);
                $k = trim($k);
                $v = trim($v, " \"'");
                $data[$k] = $v;
            }
        }
        return $data;
    }

    /**
     * Laad een officiële Noppa SVG-vectoricon uit de assets map.
     */
    private function loadSvgIcon(string $name): string {
        $filePath = $this->iconsDir . $name . '.svg';
        if (file_exists($filePath)) {
            return (string)file_get_contents($filePath);
        }
        // Fallback
        return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>';
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
}
