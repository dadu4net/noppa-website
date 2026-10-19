<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Footer Engine
 * Standardized according to:
 * - noppa-website-footer
 * - noppa-website-branding
 * - noppa-website-cookie
 * - noppa-website-wcag
 * =========================================================================
 */

class FooterEngine {
    private string $footerFile;
    private array $siteConfig;

    public function __construct(string $footerFile = '', array $siteConfig = []) {
        $this->footerFile = $footerFile ?: dirname(__DIR__) . '/content/footer.md';
        $this->siteConfig = $siteConfig ?: ($GLOBALS['siteConfig'] ?? []);
    }

    /**
     * Laad en parseer het footer.md bestand.
     */
    public function load(): array {
        if (!file_exists($this->footerFile)) {
            return [
                'meta' => [
                    'company_name' => $this->siteConfig['company']['name'] ?? ($this->siteConfig['site_name'] ?? 'Noppa Solutions & Consultants'),
                    'payoff'       => $this->siteConfig['payoff'] ?? 'Boosting Business Productivity',
                    'email'        => $this->siteConfig['company']['email'] ?? 'info@noppa.nl',
                    'telefoon'     => $this->siteConfig['company']['phone'] ?? '+31 (0)6 13 35 77 23',
                    'kvk'          => $this->siteConfig['company']['kvk'] ?? '61868388',
                    'locatie'      => $this->siteConfig['company']['full_address'] ?? 'Pijlkruid 44, 5258 BW Berlicum'
                ],
                'columns' => []
            ];
        }

        $raw = file_get_contents($this->footerFile);
        $meta = [];
        $body = $raw;

        if (preg_match('/^---\r?\n(.*?)\r?\n---\r?\n(.*)/s', $raw, $m)) {
            $meta = $this->parseYaml($m[1]);
            $body = $m[2];
        }

        $columns = $this->parseColumns($body);

        return [
            'meta'    => $meta,
            'columns' => $columns
        ];
    }

    /**
     * Render complete footer HTML.
     */
    public function render(): string {
        $data = $this->load();
        $meta = $data['meta'];
        $columns = $data['columns'];

        $company = $meta['company_name'] ?? 'Noppa Solutions & Consultants';
        $payoff  = $meta['payoff'] ?? 'Boosting Business Productivity';
        $email   = $meta['email'] ?? 'info@noppa.nl';
        $phone   = $meta['telefoon'] ?? '+31 (0)6 13 35 77 23';
        $kvk     = $meta['kvk'] ?? '61868388';
        $locatie     = $meta['locatie'] ?? 'Pijlkruid 44, 5258 BW Berlicum';
        $year        = date('Y');
        $assetPrefix = $GLOBALS['assetPrefix'] ?? './';

        ob_start();
        ?>
        <footer class="portal-footer" role="contentinfo">
            <div class="footer-top-gradient-bar" aria-hidden="true"></div>
            <div class="footer-container">
                <div class="footer-grid">
                    <!-- Kolom 1: Noppa Merk & Contactinfo -->
                    <div class="footer-col footer-col-brand">
                        <a href="<?= htmlspecialchars($this->formatUrl('/'), ENT_QUOTES, 'UTF-8'); ?>" class="footer-logo-link" aria-label="<?= htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?> - Naar homepage">
                            <img src="<?= $assetPrefix; ?>assets/logos/DEF_Logo_Noppa.png" alt="<?= htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>" class="logo-light" width="140" height="42">
                            <img src="<?= $assetPrefix; ?>assets/logos/DEF_Logo_Noppa_wit.png" alt="<?= htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>" class="logo-dark" width="140" height="42">
                        </a>
                        <p class="footer-payoff"><?= htmlspecialchars($payoff, ENT_QUOTES, 'UTF-8'); ?></p>
                        
                        <div class="footer-contact-details">
                            <p class="contact-line">
                                <span class="contact-icon" aria-hidden="true">&#9993;</span>
                                <a href="mailto:<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" class="footer-contact-link"><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></a>
                            </p>
                            <p class="contact-line">
                                <span class="contact-icon" aria-hidden="true">&#9742;</span>
                                <a href="tel:<?= preg_replace('/[^0-9+]/', '', str_replace('(0)', '', $phone)); ?>" class="footer-contact-link"><?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></a>
                            </p>
                            <p class="contact-line">
                                <span class="contact-icon" aria-hidden="true">&#9873;</span>
                                <span><?= htmlspecialchars($locatie, ENT_QUOTES, 'UTF-8'); ?></span>
                            </p>
                            <p class="contact-line muted-small">
                                <span>KvK: <?= htmlspecialchars($kvk, ENT_QUOTES, 'UTF-8'); ?></span>
                            </p>
                        </div>
                    </div>

                    <!-- Kolommen 2..N: Dynamisch ingeladen vanuit footer.md -->
                    <?php foreach ($columns as $col): ?>
                    <div class="footer-col">
                        <h4 class="footer-col-title"><?= htmlspecialchars($col['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <ul class="footer-link-list">
                            <?php foreach ($col['links'] as $link): ?>
                            <li>
                                <a href="<?= htmlspecialchars($this->formatUrl($link['url']), ENT_QUOTES, 'UTF-8'); ?>" class="footer-link">
                                    <?= htmlspecialchars($link['text'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Footer Bottom Bar: Copyright & Cookie Switcher -->
                <div class="footer-bottom-bar">
                    <div class="footer-bottom-inner">
                        <div class="copyright-text">
                            &copy; <?= $year; ?> <?= htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>. Alle rechten voorbehouden.
                        </div>
                        <div class="footer-bottom-actions">
                            <button type="button" class="btn-cookie-trigger" onclick="openCookieSettings()" aria-label="Cookie instellingen wijzigen">
                                Cookie-voorkeuren
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
        return ob_get_clean();
    }

    /**
     * Parseer footer kolommen uit Markdown H3 koppen en lijsten.
     */
    private function parseColumns(string $markdown): array {
        $columns = [];
        $chunks = preg_split('/(?=^#{2,3}\s+)/m', $markdown, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($chunks as $chunk) {
            $chunk = trim($chunk);
            if (empty($chunk)) continue;

            $title = '';
            if (preg_match('/^#{2,3}\s+(.+)$/m', $chunk, $m)) {
                $title = trim($m[1]);
                $chunk = preg_replace('/^#{2,3}\s+.+$/m', '', $chunk, 1);
            }

            $links = [];
            if (preg_match_all('/^-\s+\[(.+?)\]\((.+?)\)/m', $chunk, $linkMatches, PREG_SET_ORDER)) {
                foreach ($linkMatches as $lm) {
                    $links[] = [
                        'text' => trim($lm[1]),
                        'url'  => trim($lm[2])
                    ];
                }
            }

            if (!empty($title)) {
                $columns[] = [
                    'title' => $title,
                    'links' => $links
                ];
            }
        }

        return $columns;
    }

    /**
     * Eenvoudige YAML frontmatter parser voor footer.md.
     */
    private function parseYaml(string $yaml): array {
        $data = [];
        $lines = explode("\n", trim($yaml));
        foreach ($lines as $line) {
            $t = trim($line);
            if (empty($t) || strpos($t, '#') === 0) continue;
            if (strpos($t, ':') !== false) {
                [$k, $v] = explode(':', $t, 2);
                $data[trim($k)] = trim($v, " \"'");
            }
        }
        return $data;
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
