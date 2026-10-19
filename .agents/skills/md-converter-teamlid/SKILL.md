---
name: md-converter-teamlid
description: Converteert bronbestanden (PDF CV's/bio's, Word .docx documenten, legacy PHP teampagina's en HTML profielen) naar gestandaardiseerde 100% zuivere Teamlid Markdown bestanden (data/team/[slug].md) volgens de Noppa Platform specificaties en TeamEngine architectuur.
---

# Noppa Skill: Teamlid Markdown Converter (`md-converter-teamlid`)

Deze skill leert je hoe je willekeurige bronbestanden van consultants, specialisten en medewerkers — zoals **PDF curricula vitae**, **Word (.docx) profielen**, **legacy PHP bestanden** en **HTML webpagina's** — nauwkeurig omzet naar gestandaardiseerde, 100% zuivere Markdown-bestanden in `data/team/{slug}.md`.

De output sluit naadloos aan op [`TeamEngine.php`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/includes/TeamEngine.php) en de Noppa platformrichtlijnen uit [`option/README.md`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/README.md).

---

## 🎯 Doelbestand & Locatie

- **Doelpad**: `data/team/{slug}.md` (bijvoorbeeld `data/team/jan-jansen.md`)
- **URL**: Bereikbaar via `/team/{slug}` of `index.php?page=team&id={slug}`
- **Foto**: `./assets/images/{Voornaam Achternaam}.jpg` (vierkant formaat, bijv. 600×600 px)

---

## 📋 Het Officiële Schema: YAML Frontmatter & Markdown Body

### 1. YAML Frontmatter Specificatie

Elk teamlid-bestand móét beginnen met een YAML frontmatter blok tussen `---` scheidingstekens:

```yaml
---
firstName: Jan
lastName: Jansen
pageTitle: Jan Jansen | M365 Architect | Noppa Solutions & Consultants
pageDesc: Jan Jansen — Senior Microsoft 365 Architect en SharePoint Specialist bij Noppa.
roleTitle: Senior M365 Architect & Cloud Specialist
shortBio: Jan helpt organisaties bij het ontwerpen van schaalbare, veilige cloudinfrastructuren. Met ruim 12 jaar ervaring vertaalt hij complexe IT-vraagstukken naar pragmatische werkplekken.
jobTitle: Senior Consultant
phone: "+31 6 12 34 56 78"
email: "jan@noppa.nl"
linkedin: "linkedin.com/in/janjansen"
location: "'s-Hertogenbosch, Noord-Brabant"
image: "./assets/images/Jan Jansen.jpg"

# Quick facts voor het zijpaneel (compacte badges)
qf_experience: "12+ jaar M365"
qf_specialism: "SharePoint & Architectuur"
qf_region: "Nederland & België"
qf_languages: "NL · EN · DU"
---
```

#### Velden Uitleg:
| Veld | Type | Verplicht | Toelichting |
| :--- | :--- | :--- | :--- |
| `firstName` | String | Ja | Voornaam van het teamlid |
| `lastName` | String | Ja | Achternaam (inclusief eventuele tussenvoegsels) |
| `pageTitle` | String | Ja | SEO paginatitel voor de `<title>` tag |
| `pageDesc` | String | Ja | Meta description voor Google en LinkedIn previews (1-2 zinnen) |
| `roleTitle` | String | Ja | Volledige inhoudelijke functietitel (bijv. "Senior M365 Architect & Cloud Specialist") |
| `shortBio` | String | Ja | Korte introductie (2-3 zinnen). Wordt ook getoond op de profile cards in `over-ons.md` |
| `jobTitle` | String | Ja | Compacte functienaam voor vCard export (bijv. "Senior Consultant") |
| `phone` | String | Nee | Telefoonnummer met landcode |
| `email` | String | Ja | Zakelijk e-mailadres |
| `linkedin` | String | Nee | LinkedIn profiel-URL of gebruikersnaam |
| `location` | String | Nee | Standplaats of regio |
| `image` | String | Ja | Pad naar de profielfoto (`./assets/images/Voornaam Achternaam.jpg`) |
| `qf_experience` | String | Ja | Jaren relevante werkervaring voor de Quick Facts sidebar |
| `qf_specialism` | String | Ja | Hoofdspecialisatie voor de Quick Facts sidebar |
| `qf_region` | String | Ja | Werkregio voor de Quick Facts sidebar |
| `qf_languages` | String | Ja | Talenkennis voor de Quick Facts sidebar (bijv. "NL · EN") |

---

### 2. Markdown Body Structuur

Onder de frontmatter volgt de inhoudelijke opbouw in **100% zuivere Markdown**. `TeamEngine.php` verwacht de volgende H2 (`##`) koppen:

```markdown
## Over Jan

Met ruim 12 jaar ervaring binnen het Microsoft-ecosysteem heeft Jan tientallen complexe migraties en intranetprojecten geleid. Zijn kracht ligt in het vertalen van ingewikkelde governance- en architectuurvraagstukken naar een overzichtelijke en veilige werkomgeving.

Bij Noppa Solutions & Consultants richt Jan zich op SharePoint Online-architectuur, rechtenstructuren en hybride migratietrajecten.

## Expertise

### SharePoint Online Architectuur
Ontwerp van schaalbare sites, hub-structuren en documentbibliotheken met doordachte metadata.

### Rechten & Governance
Inrichten van veilige toegangsmodellen zonder wildgroei aan losse groepen of verweesde rechten.

### Cloud Migraties
Soepele overstap van on-premises bestandsservers naar SharePoint Online en OneDrive for Business.

### Power Automate Integraties
Automatiseren van goedkeuringsprocessen, notificaties en documentstromen tussen afdelingen.

## Werkervaring

### 2024 — heden | Senior M365 Architect | Noppa Solutions & Consultants
Verantwoordelijk voor de architectuur en technische regie bij grootschalige SharePoint- en Copilot-projecten.

### 2018 — 2024 | Cloud Consultant | Zakelijke Dienstverlening
Leiding gegeven aan migratieteams en implementatie van moderne Microsoft 365-werkplekken bij MKB+.

### 2012 — 2018 | Systeembeheerder & SharePoint Beheerder | IT Services
Beheer van on-premises SharePoint omgevingen, Exchange en werkplekautomatisering.

## Referenties

### "Jan brengt direct rust en overzicht"
Jan doorziet binnen een uur waar de knelpunten in de bestandsstructuur zitten en levert een plan waar iedereen direct mee verder kan.
*— IT Manager, Logistieke Dienstverlener*

### "Enorme kennis van rechten en security"
Dankzij de strakke structuur die Jan heeft neergezet werken onze teams eindelijk zorgeloos samen met externe partners.
*— Operationeel Directeur, Financiële Dienstverlening*

## Certificeringen (optioneel)
- Microsoft 365 Certified: Enterprise Administrator Expert
- Information Protection and Compliance Administrator Associate (SC-400)
- Microsoft Certified: Security, Compliance, and Identity Fundamentals (SC-900)
```

---

## 🔄 Conversiehandleiding per Brontype

### A. Van PDF (Curriculum Vitae / LinkedIn Export / Profiel)

1. **Tekst extraheren:**
   Gebruik het ingebouwde script of Python met `markitdown` / `pdfplumber`:
   ```bash
   python scripts/convert_to_md.py --input "pad/naar/cv.pdf" --type teamlid --slug jan-jansen --title "Jan Jansen"
   ```
2. **Metadata mappen:**
   - **Kop / Contactgegevens:** Zoek bovenaan de PDF naar naam, e-mail (`@`), telefoonnummer (`06...` of `+31...`), woonplaats en LinkedIn URL. Plaats deze in de frontmatter.
   - **Profielschets / Introductie:** De inleidende samenvatting vormt `shortBio` (max. 250 tekens) en de eerste alinea's onder `## Over [Voornaam]`.
   - **Werkervaring / Werkverleden:** Zet chronologische functies om naar `### [Jaar — Jaar] | [Functietitel] | [Bedrijfsnaam]` met daaronder 1-2 zinnen toelichting.
   - **Vaardigheden / Competenties:** Groepeer losse vaardigheden in 3 tot 5 logische specialismen onder `## Expertise` met `### [Specialisme Titel]` en een korte alinea.
   - **Opleidingen / Certificaten:** Plaats relevante certificeringen onder `## Certificeringen` als opsomming (`- `).

### B. Van Word (.docx)

1. **Koppen & Stijlen analyseren:**
   - Kop 1 (`Heading 1`) met de persoonsnaam vertaal je naar `firstName` en `lastName`.
   - Kop 2 (`Heading 2`) stijlen vertaal je naar de gestandaardiseerde secties: `## Over [Naam]`, `## Expertise`, `## Werkervaring`, `## Referenties`.
2. **Tabellen en lijsten:**
   - Als werkervaring in een Word-tabel staat, converteer elke rij naar: `### [Jaar — Jaar] | [Functie] | [Bedrijf]`.
   - Verwijder Word-opmaaksporen zoals tabs of 4-spatie inspringingen.

### C. Van Legacy PHP (oude `team/naam.php` of custom arrays)

1. **PHP code strippen:**
   - Verwijder alle `<?php ... ?>` tags, `include`, `require_once 'header.php'`, en footer includes.
2. **PHP Arrays extraheren:**
   Als het oude bestand een PHP-array bevatte zoals:
   ```php
   $member = [
       'name' => 'Deborah Stahlecker',
       'role' => 'M365 Consultant',
       'bio' => '...',
   ];
   ```
   vertaal je deze sleutels 1-op-1 naar de YAML frontmatter velden.
3. **HTML tags opschonen:**
   - Vervang `<div class="bio">` of `<p>` door pure alinea's gescheiden door witregels.
   - Vervang `<h3>` of `<h4>` door `###`.
   - Vervang `<ul><li>` door Markdown opsommingen (`- `).

### D. Van HTML Webpagina's

1. **HTML ruis verwijderen:**
   - Verwijder `<header>`, `<nav>`, `<footer>`, `<aside>`, `<script>`, `<style>` en cookie-banners.
2. **Schema.org Person metadata benutten:**
   Kijk of de pagina JSON-LD of microdata bevat (`"jobTitle"`, `"email"`, `"telephone"`).
3. **Puur Markdown maken:**
   Geen `<div>` of inline styling behouden; enkel Markdown koppen, paragrafen en lijsten.

---

## ⚠️ Belangrijke Noppa Platform Regels

1. **100% Zuivere Markdown**: Schrijf nóóit ruwe HTML-tags zoals `<div>`, `<section>`, `<span>` of `<br>` in de body.
2. **Geen 4-Spaties of Tabs**: Laat regels nooit beginnen met 4 spaties of tabs. Dit activeert in Parsedown per ongeluk een letterlijk codeblok (`<pre><code>`)!
3. **Initialen Fallback**: Als de afbeelding `./assets/images/{Voornaam Achternaam}.jpg` nog niet fysiek bestaat, toont `TeamEngine.php` automatisch een representatieve Noppa-badge met de initialen. De website breekt dus nooit!
4. **Koppelen in `over-ons.md`**:
   Om dit teamlid te tonen op de teampagina, voeg je simpelweg de naam toe in `content/pages/over-ons.md`:
   ```markdown
   <!-- section: team type="team" title="Ons Team" subtitle="Onze Mensen" -->

   - Rik Dobbelsteen
   - Deborah Stahlecker
   - Jan Jansen
   ```
   De `MarkdownEngine` herkent `Jan Jansen`, leest `data/team/jan-jansen.md` uit en rendert direct een interactieve profile-card met foto, intro en doorkliklink!
