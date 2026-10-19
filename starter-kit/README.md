# 🚀 Website Starter-Kit (White-Label Flat-File Platform)

Welkom bij de **Website Starter-Kit**! Dit is een compleet, modulair, ultrasnel en merk-onafhankelijk platform gebouwd met **PHP component-compilers** en **100% zuivere Markdown (`.md`)**.

Geen ingewikkelde CMS-databases, geen zware Node.js build-stappen en geen spaghetti-HTML: alles is overzichtelijk, direct bewerkbaar en geoptimaliseerd voor maximale SEO-prestaties (WCAG 2.1 AAA).

---

## ⚡ Direct Starten in 3 Stappen

### Stap 1: Vul de Merk- en Design Vragenlijst in
Bekijk het bestand [`BRAND_INTAKE_VRAGENLIJST.md`](./BRAND_INTAKE_VRAGENLIJST.md). Dit helpt je (of jouw klant) om in 15 minuten alle kleuren, bedrijfsgegevens, tone-of-voice en menukeuzes scherp te stellen.

### Stap 2: Pas `site.config.php` aan
Open [`site.config.php`](./site.config.php) en vul de gegevens in:
- **`site_name` & `base_url`:** Naam en domein van het project.
- **`company`:** E-mail, telefoon, KvK en adres (automatisch gebruikt in footer, vCards en Schema.org SEO).
- **`brand`:** Kies jouw 4 HEX-merkkleuren (`primary`, `accent`, `surface`, `highlight`). De hele website (knoppen, hero gradient, links, pills) past zich direct hierop aan!
- **`modules`:** Zet eventueel modules uit die je niet nodig hebt (bijv. `team` of `kennisbank`).

### Stap 3: Plaats je logo's en bewerk de teksten
- **Logo's:** Plaats jouw logo in `assets/logos/`.
- **Navigatie:** Bewerk [`content/navigation.md`](./content/navigation.md) en [`content/footer.md`](./content/footer.md).
- **Pagina's:** Pas [`content/pages/home.md`](./content/pages/home.md), `over-ons.md`, `diensten.md` en `contact.md` aan.

---

## 📁 Mappenstructuur

```text
starter-kit/
├── site.config.php                # Centrale configuratie & Single Source of Truth
├── BRAND_INTAKE_VRAGENLIJST.md    # Intake-vragenlijst voor huisstijl & content
├── index.php                      # Centrale router & controller
├── sitemap.php                    # Dynamische XML sitemap generator
├── sitemap.xml                    # Statische XML sitemap
├── robots.txt                     # Zoekmachine instructies
├── .htaccess                      # Apache rewrite regels voor schone URLs
│
├── includes/                      # De 9 PHP Core Engines (volledig geautomatiseerd)
│   ├── Parsedown.php              # Markdown parser
│   ├── DienstenEngine.php         # Diensten- & pricing compiler
│   ├── TeamEngine.php             # Teamprofielen & dynamische vCard generator
│   ├── KennisbankEngine.php       # Kennisbank & artikel compiler met TOC
│   ├── LegalEngine.php            # Algemene voorwaarden & privacy compiler met scrollspy
│   ├── MarkdownEngine.php         # Pagina- & sectieparser
│   ├── NavigationEngine.php       # Header- & mobiele menu compiler
│   ├── FooterEngine.php           # Footer kolommen compiler
│   └── SeoHelper.php              # Schema.org JSON-LD & meta tag generator
│
├── partials/                      # Template componenten
│   ├── header.php                 # <head>, font-loading, theme injection
│   ├── nav.php                    # Sticky glassmorphism header & drawer
│   ├── hero.php                   # Algemene hero banner
│   ├── footer.php                 # Footer grid & copyright
│   └── cookie-banner.php          # AVG/GDPR cookie banner & instellingenmodal
│
├── assets/
│   ├── css/custom.css             # Geparametriseerd design system met CSS tokens
│   ├── fonts/                     # Webfonts (Kentledge)
│   ├── icons/                     # 24 officiële vector SVG iconen
│   ├── js/site.js                 # Theme switcher, drawer & cookie consent
│   └── logos/                     # Logo bestanden
│
├── content/
│   ├── navigation.md              # Menustructuur & CTA knop
│   ├── footer.md                  # Footer kolommen & bedrijfsinfo
│   ├── pages/                     # Alle statische pagina's (home, over-ons, etc.)
│   └── kennisbank/artikelen/      # Markdown artikelen
│
└── data/
    ├── diensten/                  # Gestructureerde diensten (.md) met pricing plans
    ├── team/                      # Consultant profielen (.md) met bio & vCard
    └── legal/                     # Algemene voorwaarden & privacy policy (.md)
```

---

## 🎨 Huisstijl & Kleuren Wijzigen

In `site.config.php` pas je eenvoudig de merkkleuren aan:
```php
'brand' => [
    'primary'   => '#2060E0', // Primaire knoppen en actieve elementen
    'accent'    => '#00D0F0', // Secundaire gradientkleur en pills
    'surface'   => '#0F2A66', // Diepe achtergrond van de hero en titels
    'highlight' => '#FFCC00', // Subtiel accent voor badges
]
```
De engines injecteren deze waarden automatisch in de `<head>` van elke pagina. Alle componenten in `custom.css` schalen direct mee!

---

## 🔒 Licentie & Rechten
Gebouwd als modulaire architectuur door Noppa Solutions & Consultants. Vrij te hergebruiken voor interne en externe webprojecten.
