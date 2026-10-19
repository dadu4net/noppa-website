<?php
/**
 * =========================================================================
 * Starter-Kit — Centrale Site & Engine Configuratie
 *
 * Dit bestand fungeert als de centrale 'Single Source of Truth' voor de website.
 * 
 * IN 4 STAPPEN JE NIEUWE WEBSITE KLAARMAKEN:
 * 1. Pas 'site_name', 'payoff' en 'base_url' aan.
 * 2. Vul de 'company' gegevens in (gebruikt in footer, vCards, legal, SEO).
 * 3. Kies je gewenste merkkleuren in 'brand' (knoppen, gradients & headers passen zich direct aan).
 * 4. Zet gewenste modules aan/uit in 'modules' (diensten, team, kennisbank, legal).
 * =========================================================================
 */

return [
    // 1. Algemene site- & domeingegevens
    'site_name'    => 'Bedrijfsnaam',
    'payoff'       => 'Jouw Krachtige Slogan of Waardepropositie',
    'base_url'     => 'https://jouwdomein.nl',
    'lang'         => 'nl',
    'locale'       => 'nl_NL',

    // 2. Bedrijfs- & contactgegevens (automatisch gebruikt in footer, vCard, legal & Schema.org SEO)
    'company' => [
        'name'             => 'Bedrijfsnaam B.V.',
        'email'            => 'info@jouwdomein.nl',
        'phone'            => '+31 (0)85 000 0000',
        'phone_raw'        => '+31850000000',
        'kvk'              => '12345678',
        'btw'              => 'NL123456789B01',
        'address'          => 'Voorbeeldstraat 10',
        'postal_code'      => '1000 AA',
        'city'             => 'Amsterdam',
        'region'           => 'Noord-Holland',
        'country'          => 'NL',
        'full_address'     => 'Voorbeeldstraat 10, 1000 AA Amsterdam',
        'linkedin'         => 'https://linkedin.com/company/jouwbedrijf',
    ],

    // 3. Design Tokens & Huisstijl (Geparametriseerde merkkleuren)
    // Pas deze 4 waarden aan om de hele site direct een unieke look & feel te geven!
    'brand' => [
        'primary'   => '#2060E0', // Primaire merkkleur (knoppen, links, acties)
        'accent'    => '#00D0F0', // Accentkleur (highlights, pills, gradient start)
        'surface'   => '#0F2A66', // Diepe achtergrondkleur (headings, hero gradient achtergrond)
        'highlight' => '#FFCC00', // Subtiele extra accentkleur (sterretjes, badges, warme accenten)
        'font'      => "'Kentledge', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
    ],

    // 4. Logo's & Favicons (paden relatief aan de webroot)
    'assets' => [
        'logo_light'       => 'assets/logos/DEF_Logo_Noppa.png',
        'logo_dark'        => 'assets/logos/DEF_Logo_Noppa_wit.png',
        'favicon'          => 'assets/logos/DEF_Logo_Noppa.png',
        'apple_touch_icon' => 'assets/logos/DEF_Logo_Noppa.png',
        'default_og_image' => 'assets/logos/DEF_Logo_Noppa.png',
    ],

    // 5. SEO & Social Meta defaults
    'seo' => [
        'default_description' => 'Welkom op de website van Bedrijfsnaam. Wij helpen organisaties met slimme oplossingen en deskundig advies.',
        'robots_default'      => 'index, follow',
        'twitter_card'        => 'summary_large_image',
    ],

    // 6. Actieve modules (eenvoudig uit te schakelen bij eenvoudigere websites)
    'modules' => [
        'diensten'   => true, // Activeren van /diensten/ en data/diensten/*.md
        'team'       => true, // Activeren van /team/ en data/team/*.md
        'kennisbank' => true, // Activeren van /kennisbank/ en content/kennisbank/
        'legal'      => true, // Activeren van /algemene-voorwaarden en /privacy-policy
    ],

    // 7. Pad-configuratie (standaard mappenstructuur)
    'paths' => [
        'content'    => __DIR__ . '/content',
        'diensten'   => __DIR__ . '/data/diensten',
        'team'       => __DIR__ . '/data/team',
        'legal'      => __DIR__ . '/data/legal',
        'icons'      => __DIR__ . '/assets/icons',
        'kennisbank' => __DIR__ . '/content/kennisbank/artikelen',
    ]
];
