<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Site & Engine Configuration
 *
 * Dit bestand fungeert als de centrale 'Single Source of Truth' voor de site.
 * 
 * OM DEZE STRUCTUUR TE HERGEBRUIKEN VOOR EEN ANDER PROJECT / KLANT:
 * 1. Pas 'site_name', 'payoff' en 'base_url' aan.
 * 2. Vul de 'company' gegevens in (gebruikt in footer, vCard, legal, SEO).
 * 3. Kies je 3 merkkleuren in 'brand' (de hele site past zich hier direct op aan).
 * 4. Zet gewenste modules aan/uit in 'modules' (team, diensten, kennisbank, legal).
 * =========================================================================
 */

return [
    // 1. Algemene site- & domeingegevens
    'site_name'    => 'Noppa Solutions & Consultants',
    'payoff'       => 'Boosting Business Productivity',
    'base_url'     => 'https://noppa.nl',
    'lang'         => 'nl',
    'locale'       => 'nl_NL',

    // 2. Bedrijfs- & contactgegevens (gebruikt in footer, vCard, legal, SEO Schema)
    'company' => [
        'name'             => 'Noppa Solutions & Consultants',
        'email'            => 'info@noppa.nl',
        'phone'            => '+31 (0)6 13 35 77 23',
        'phone_raw'        => '+31613357723',
        'kvk'              => '61868388',
        'btw'              => 'NL859223348B01',
        'address'          => 'Pijlkruid 44',
        'postal_code'      => '5258 BW',
        'city'             => 'Berlicum',
        'region'           => 'Noord-Brabant',
        'country'          => 'NL',
        'full_address'     => 'Pijlkruid 44, 5258 BW Berlicum',
        'linkedin'         => 'https://linkedin.com/company/noppa',
    ],

    // 3. Design Tokens & Huisstijl (Parametriseerbare merkkleuren)
    // Pas deze 3 HEX-waarden aan om de hele site direct een nieuwe huisstijl te geven!
    'brand' => [
        'primary'   => '#2060E0', // Primaire merkkleur (knoppen, links, hover borders)
        'accent'    => '#00D0F0', // Accentkleur (electric cyan, pills, glow, gradients)
        'surface'   => '#0F2A66', // Diepe contrastkleur (navy, hero achtergrond, headings)
        'highlight' => '#FFCC00', // Highlight accentkleur (goudgeel in gradient)
        'font'      => "'Kentledge', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
    ],

    // 4. Logo's & Favicons (relatief aan assetPrefix)
    'assets' => [
        'logo_light'       => 'assets/logos/DEF_Logo_Noppa.png',
        'logo_dark'        => 'assets/logos/DEF_Logo_Noppa_wit.png',
        'favicon'          => 'assets/logos/DEF_Logo_Noppa.png',
        'apple_touch_icon' => 'assets/logos/DEF_Logo_Noppa.png',
        'default_og_image' => 'assets/logos/DEF_Logo_Noppa.png',
    ],

    // 5. SEO & Social Meta defaults
    'seo' => [
        'default_description' => 'Noppa Solutions & Consultants verhoogt de bedrijfsproductiviteit met Microsoft 365, Copilot AI en slimme procesautomatisering.',
        'robots_default'      => 'index, follow',
        'twitter_card'        => 'summary_large_image',
    ],

    // 6. Actieve modules (eenvoudig uit te schakelen bij eenvoudigere sites)
    'modules' => [
        'diensten'   => true, // Activeren van /diensten/ en data/diensten/*.md
        'team'       => true, // Activeren van /team/ en data/team/*.md
        'kennisbank' => true, // Activeren van /kennisbank/ en content/kennisbank/
        'legal'      => true, // Activeren van /algemene-voorwaarden en /privacy-policy
    ],

    // 7. Pad-configuratie (optioneel aanpasbaar voor afwijkende mappenstructuren)
    'paths' => [
        'content'    => __DIR__ . '/content',
        'diensten'   => __DIR__ . '/data/diensten',
        'team'       => __DIR__ . '/data/team',
        'legal'      => __DIR__ . '/data/legal',
        'icons'      => __DIR__ . '/assets/icons',
        'kennisbank' => __DIR__ . '/content/kennisbank/artikelen',
    ]
];
