<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — SEO & Metadata Helper
 * Implements noppa-website-header, noppa-website-wcag, and SEO standards
 * =========================================================================
 */

class SeoHelper {
    public static string $defaultSiteName = 'Noppa Solutions & Consultants';
    public static string $defaultPayoff = 'Boosting Business Productivity';
    public static string $defaultBaseUrl = 'https://noppa.nl';
    public static string $defaultImage = './assets/images/DEF_Logo_Noppa.png';
    public static string $defaultDescription = 'Noppa Solutions & Consultants verhoogt de bedrijfsproductiviteit met Microsoft 365, Copilot AI en slimme procesautomatisering.';

    public static array $config = [];

    /**
     * Configureer SEO defaults vanuit site.config.php.
     */
    public static function configure(array $config): void {
        self::$config = $config;
        if (!empty($config['site_name'])) {
            self::$defaultSiteName = $config['site_name'];
        }
        if (!empty($config['payoff'])) {
            self::$defaultPayoff = $config['payoff'];
        }
        if (!empty($config['base_url'])) {
            self::$defaultBaseUrl = rtrim($config['base_url'], '/');
        }
        if (!empty($config['assets']['default_og_image'])) {
            self::$defaultImage = $config['assets']['default_og_image'];
        }
        if (!empty($config['seo']['default_description'])) {
            self::$defaultDescription = $config['seo']['default_description'];
        }
    }

    /**
     * Genereer complete set aan SEO tags voor in de <head>.
     *
     * @param array $meta Metadata afkomstig uit YAML frontmatter van het MD bestand.
     * @param string $pageSlug Huidige pagina slug.
     * @return string Gecompileerde HTML tags.
     */
    public static function renderMetaTags(array $meta, string $pageSlug = 'home'): string {
        $baseUrl = rtrim($meta['base_url'] ?? self::$defaultBaseUrl, '/');
        
        // Bepaal titel
        $pageTitle = $meta['title'] ?? $meta['titel'] ?? self::$defaultSiteName;
        $fullTitle = (stripos($pageTitle, self::$defaultSiteName) !== false) 
            ? $pageTitle 
            : $pageTitle . ' | ' . self::$defaultSiteName;

        // Bepaal omschrijving
        $description = $meta['description'] ?? $meta['beschrijving'] ?? self::$defaultDescription;
        $description = htmlspecialchars(strip_tags($description), ENT_QUOTES, 'UTF-8');

        // Bepaal URL en Canonical
        $canonical = $meta['canonical'] ?? ($baseUrl . ($pageSlug === 'home' ? '/' : '/' . ltrim($pageSlug, '/')));
        
        // Bepaal afbeelding
        $ogImage = $meta['og_image'] ?? $meta['image'] ?? self::$defaultImage;
        if (!preg_match('#^https?://#i', $ogImage)) {
            $cleanImg = preg_replace('#^\.?/#', '', $ogImage);
            $ogImage = $baseUrl . '/' . $cleanImg;
        }

        // Robots
        $robots = $meta['robots'] ?? ($pageSlug === '404' ? 'noindex, nofollow' : 'index, follow');

        $out = [];
        $out[] = '<!-- Primaire SEO Metadata -->';
        $out[] = '<title>' . htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8') . '</title>';
        $out[] = '<meta name="description" content="' . $description . '">';
        $out[] = '<meta name="robots" content="' . htmlspecialchars($robots, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<link rel="canonical" href="' . htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') . '">';

        // Open Graph / Facebook / LinkedIn
        $out[] = '';
        $out[] = '<!-- Open Graph / Social Media -->';
        $out[] = '<meta property="og:site_name" content="' . htmlspecialchars(self::$defaultSiteName, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta property="og:type" content="' . htmlspecialchars($meta['og_type'] ?? 'website', ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta property="og:url" content="' . htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta property="og:title" content="' . htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta property="og:description" content="' . $description . '">';
        $out[] = '<meta property="og:image" content="' . htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta property="og:locale" content="nl_NL">';

        // Twitter Cards
        $out[] = '';
        $out[] = '<!-- Twitter Cards -->';
        $out[] = '<meta name="twitter:card" content="summary_large_image">';
        $out[] = '<meta name="twitter:url" content="' . htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta name="twitter:title" content="' . htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8') . '">';
        $out[] = '<meta name="twitter:description" content="' . $description . '">';
        $out[] = '<meta name="twitter:image" content="' . htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') . '">';

        // Schema.org JSON-LD Structured Data
        $out[] = '';
        $out[] = '<!-- Structured Data (JSON-LD) -->';
        $schema = self::buildSchemaJsonLd($fullTitle, $description, $canonical, $ogImage, $pageSlug, $baseUrl, $meta);
        $out[] = '<script type="application/ld+json">' . "\n" . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n</script>";

        return implode("\n    ", $out);
    }

    /**
     * Bouw gestructureerde data op volgens Schema.org standaarden.
     */
    private static function buildSchemaJsonLd(string $title, string $desc, string $url, string $image, string $slug, string $baseUrl, array $meta = []): array {
        $graph = [
            [
                '@type' => 'Organization',
                '@id' => $baseUrl . '/#organization',
                'name' => self::$defaultSiteName,
                'url' => $baseUrl . '/',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $baseUrl . self::$defaultImage
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => self::$config['company']['phone_raw'] ?? (self::$config['company']['phone'] ?? '+31-6-1335-7723'),
                    'contactType' => 'customer service',
                    'areaServed' => self::$config['company']['country'] ?? 'NL',
                    'availableLanguage' => ['Dutch', 'English']
                ],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => self::$config['company']['address'] ?? 'Pijlkruid 44',
                    'addressLocality' => self::$config['company']['city'] ?? 'Berlicum',
                    'postalCode' => self::$config['company']['postal_code'] ?? '5258 BW',
                    'addressCountry' => self::$config['company']['country'] ?? 'NL'
                ]
            ],
            [
                '@type' => 'WebPage',
                '@id' => $url . '#webpage',
                'url' => $url,
                'name' => $title,
                'description' => $desc,
                'isPartOf' => ['@id' => $baseUrl . '/#website'],
                'inLanguage' => 'nl-NL'
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $url . '#breadcrumb',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => $baseUrl . '/'
                    ],
                    ($slug !== 'home' ? [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => ucfirst(str_replace(['-', '_'], ' ', $slug)),
                        'item' => $url
                    ] : null)
                ]
            ]
        ];

        // Optioneel: Article gestructureerde data voor Kennisbank artikelen
        if (($meta['og_type'] ?? '') === 'article') {
            $graph[] = [
                '@type' => 'Article',
                '@id' => $url . '#article',
                'headline' => $title,
                'description' => $desc,
                'image' => $image,
                'datePublished' => $meta['published_time'] ?? date('Y-m-d'),
                'author' => [
                    '@type' => 'Person',
                    'name' => $meta['author'] ?? 'Rik Dobbelsteen'
                ],
                'publisher' => [
                    '@id' => $baseUrl . '/#organization'
                ],
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $url
                ]
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph
        ];
    }
}
