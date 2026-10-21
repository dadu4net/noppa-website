---
name: md-converter-pagina
description: Converteert bronbestanden (PDF rapporten/documenten, Word .docx pagina's, legacy PHP pagina's en HTML websites) naar gestandaardiseerde 100% zuivere Pagina Markdown bestanden (content/pages/[slug].md) volgens de Noppa Platform specificaties en MarkdownEngine architectuur.
---

# Noppa Skill: Pagina Markdown Converter (`md-converter-pagina`)

Deze skill leert je hoe je algemene pagina's — zoals **Over Ons**, **Visie & Missie**, **Contact**, **Home**, of **specifieke landingspagina's** — vanuit willekeurige bronnen (**PDF rapporten**, **Word .docx documenten**, **legacy PHP bestanden** en **HTML webpagina's**) nauwkeurig omzet naar gestandaardiseerde, modulaire Markdown-bestanden in `content/pages/{slug}.md`.

De output sluit naadloos aan op [`MarkdownEngine.php`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/includes/MarkdownEngine.php) en de Noppa platformrichtlijnen uit [`option/README.md`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/README.md).

---

## 🎯 Doelbestand & Locatie

- **Doelpad**: `content/pages/{slug}.md` (bijvoorbeeld `content/pages/visie.md` of `content/pages/over-ons.md`)
- **URL**: Bereikbaar via `/{slug}` (bijv. `/visie`) of `index.php?page={slug}`

---

## 📋 Het Officiële Schema: Frontmatter & Secties

### 1. YAML Frontmatter Specificatie

Elke pagina begint met frontmatter voor SEO en een optionele Hero-banner bovenaan:

```yaml
---
title: "Onze Visie op Productiviteit | Noppa Solutions & Consultants"
description: "Lees hoe Noppa kijkt naar de toekomst van werk, de rol van AI en de onmisbare menskant van technologie."
canonical: "https://noppa.nl/visie"

# Optionele hero sectie bovenaan de pagina
hero:
  badge: "Visie & Filosofie"
  badge_icon: "idea" # Kies uit de 24 officiële iconen
  title: "Technologie moet voor mensen werken, <span class='gradient-text'>niet andersom</span>"
  subtitle: "Wij geloven dat de echte productiviteitswinst van AI en cloudtechnologie niet in de licentie zit, maar in de gewoontes van de mensen die er dagelijks mee werken."
  cta_primary:
    text: "Lees onze aanpak"
    url: "/diensten"
  cta_secondary:
    text: "Maak kennis met ons team"
    url: "/over-ons"
---
```

---

### 2. Sectiemarkers (`<!-- section: ... -->`)

De `MarkdownEngine.php` verdeelt een pagina in secties met HTML-commentaartags:
`<!-- section: [id] type="[type]" [cols="2|3"] [title="..."] [subtitle="..."] [desc="..."] -->`

Ondersteunde sectietypes:

#### A. Type `content` (Artikelen & Vrije Tekst)
Voor lange leesteksten, tabellen, opsommingen en tussenkopjes. Wordt automatisch verpakt in `.artikel-prose`.
```markdown
<!-- section: kernfilosofie type="content" title="De Menskant van Werk" subtitle="Onze Overtuiging" -->

## Software is een middel, geen doel
Veel organisaties investeren duizenden euro's in de nieuwste Microsoft-licenties en hopen dat teams vanzelf productiever worden. De realiteit leert dat technologie zonder gedragsverandering vooral leidt tot frustratie en verwarring.

Onze filosofie rust op drie pijlers:
1. **Helderheid boven complexiteit**: Geen onnodige toeters en bellen, maar tools die direct tijd besparen.
2. **Leren in de praktijk**: Oefenen met eigen documenten achter de eigen laptop.
3. **Blijvende borging**: Verankering in de cultuur via interne ambassadeurs.
```

#### B. Type `cards` (Responsief Kaarten Grid)
Rendert een 2- of 3-koloms grid van stijlvolle Noppa kaarten. Ondersteunt inline iconen met `*Icoon: [naam]*`.
```markdown
<!-- section: diensten-grid type="cards" cols="3" title="Waarmee Wij Helpen" subtitle="Onze Expertise" -->

## Microsoft Copilot Adoptie
*Icoon: sparkles*
Haal maximaal rendement uit Microsoft Copilot met praktische workflows en prompts voor uw hele team.
[Bekijk Copilot Dienst](/diensten/ai-copilot)

## SharePoint & Intranetten
*Icoon: dashboard*
Overzichtelijke en veilige werkplekken waar medewerkers informatie binnen enkele seconden vinden.
[Bekijk SharePoint Oplossingen](/diensten/processen-portalen)

## Beveiliging & Purview
*Icoon: shield*
Waterdichte databescherming en naleving van wetgeving zonder medewerkers te frustreren.
[Bekijk Beveiliging](/diensten/beveiliging-compliance)
```

#### C. Type `stats` (Cijfers & Impact)
Rendert kerncijfers in tabulaire cijfers (`tabular-nums`) met pulserende live-indicatoren:
```markdown
<!-- section: impact type="stats" title="Onze Impact in Cijfers" subtitle="Bewezen Resultaten" -->

- **4 uur** Gemiddelde wekelijkse tijdsbesparing per medewerker
- **85%** Actieve adoptiegraad na onze verandertrajecten
- **100%** Borging binnen uw eigen Microsoft 365-tenant
- **24/7** Grip op veilige datastromen
```

#### D. Type `team` (Interactieve Consultant Kaarten)
Voeg simpelweg de namen van de teamleden toe. De engine koppelt deze automatisch aan `data/team/{slug}.md` en rendert complete profile cards met foto, intro en link:
```markdown
<!-- section: team type="team" title="Team Noppa" subtitle="Onze Mensen" desc="Maak kennis met onze gecertificeerde Microsoft 365 consultants en adoptiespecialisten." -->

- Rik Dobbelsteen
- Deborah Stahlecker
- Kees Koertshuis
- Daniël Giessenburg
- Willem Blanken
```

#### E. Type `values` (Merk Kernwaarden)
Rendert automatisch de 4 gedefinieerde kernwaarden uit het design system:
```markdown
<!-- section: kernwaarden type="values" title="Waar Wij Voor Staan" subtitle="Onze Kernwaarden" -->
```

#### F. Type `cta` (Conversie Banner)
Een opvallende banner over de volle breedte met Noppa signature 4-staps gradient:
```markdown
<!-- section: actie type="cta" -->

## Wil je ontdekken wat dit voor jouw team betekent?
Plan een vrijblijvende inspiratiesessie van 30 minuten met een van onze adviseurs.

[Plan een gesprek in](/contact)
```

#### G. Type `kennisbank` (Dynamische Catalogus)
Rendert automatisch de kennisbank zoekbalk, categorieknoppen en artikelkaarten:
```markdown
<!-- section: catalogus type="kennisbank" title="Actuele Kennis & Inzichten" subtitle="Kennisbank" -->
```

#### H. Type `charts` (Kwalitatieve Grafieken & Besliskaders)
Rendert geavanceerde gradient staafdiagrammen (met schaal 1–5) en donutgrafieken (met centrale tekstbadge en legenda) in 100% zuivere Markdown:
```markdown
<!-- section: grafieken type="charts" title="Waar zit het onderscheid?" subtitle="Visueel besliskader" -->

## Relatieve aansluiting op een M365-organisatie
*Note: Indicatieve adviesvisualisatie op een schaal van 1–5.*
*Type: bars*

- M365-integratie: 96% | 5
- Purview: 96% | 5
- In-app werken: 92% | 5

## Aanbevolen oplossingsmix
*Note: Centraal beheerd waar data en werkprocessen samenkomen.*
*Type: donut*
*Center: Beheerde basis*

- Copilot voor M365-werk en organisatiegegevens: 72%
- Aanvullende goedgekeurde specialistische AI: 28%
```

#### I. Type `roadmap` (Gefaseerd Stappenplan)
Rendert genummerde roadmap-stappen met Noppa gradient cirkelbadges en output-labels:
```markdown
<!-- section: implementatie type="roadmap" title="Zeven stappen naar waarde" subtitle="Implementatieadvies" -->

## Bepaal zakelijke doelen
*Output: use-caseportfolio*
Selecteer concrete use-cases, proceseigenaren, risico's en succescriteria.
```

---

### 3. Tabellen & Status Badges (`[pill:...]`)

Tabellen in Markdown (`| Kolom | Kolom |`) worden door de engine automatisch voorzien van:
- Een `.table-responsive` shell met afgeronde hoeken (`18px`), schaduw en horizontale scroll op mobiel.
- Een diepe **Noppa Navy** koprij (`#0F2A66`) met witte Kentledge 800 typografie en 2px **Royal Blauw** rand.
- Een geaccentueerde **Noppa Cyaan** eerste kolomkop (`#00D0F0`).
- Een vette, scanbare eerste datakolom (vaste breedte 18%, min. 150px).
- Subtiele zebra-striping en dynamische rij-hover (`rgba(32, 96, 224, 0.04)`).
- **Pill Badges**: Gebruik `[pill:Basiskeuze]` of `[badge:Actief]` om compacte statusbadges met een zachte blauwe gloed te renderen.
- **Dark Mode**: Schakelt automatisch mee naar diep nachtblauw (`#091838`) met Cyaan accenten.

---

## 🔄 Conversiehandleiding per Brontype

### A. Van PDF (Beleidsplannen / Jaarverslagen / Brochures)

1. **Tekst extraheren:**
   ```bash
   python scripts/convert_to_md.py --input "pad/naar/beleid.pdf" --type pagina --slug visie --title "Onze Visie"
   ```
2. **Secties identificeren:**
   - Hoofdstukken met alinea's -> `type="content"`.
   - Opsommingen van diensten, speerpunten of USP's -> ombouwen naar `type="cards" cols="3"` met H2 koppen en `*Icoon: ...*`.
   - Resultaten, percentages of statistieken -> `type="stats"`.
   - Contactoproep aan het einde -> `type="cta"`.

### B. Van Word (.docx)

1. **Koppen mappen:**
   - Documenttitel -> frontmatter `title` en `hero.title`.
   - Tussenkoppen -> bepalen welk sectietype het meest geschikt is.
2. **Kaders & Callouts:**
   - Tekst in gekleurde Word-kaders converteer je naar blockquotes (`> Tekst`) binnen een `type="content"` sectie of naar een aparte kaart in `type="cards"`.

### C. Van Legacy PHP (oude `over-ons.php` of custom pagina's)

1. **PHP include-bestanden strippen:**
   - Verwijder header/footer includes, session management en database queries.
2. **HTML Secties omzetten naar sectietags:**
   - Vervang `<section id="over-ons" class="section">` door `<!-- section: over-ons type="content" ... -->`.
   - Vervang `<div class="team-grid">` door `<!-- section: team type="team" ... -->` en som enkel de namen op (`- Rik Dobbelsteen`).
   - Vervang handmatige call-to-action blocks door `<!-- section: contact-cta type="cta" -->`.

### D. Van HTML Webpagina's

1. **Container div wrappers verwijderen:**
   - Verwijder bootstrap of custom grid divs (`<div class="row">`, `<div class="col-md-4">`).
2. **Grid elementen omzetten naar Cards:**
   - Elk blokje in een 3-koloms grid wordt een `## Kaartitel` met een `*Icoon: ...*` regel en een markdown link `[Tekst](/link)`.

---

## ⚠️ Belangrijke Noppa Platform Regels

1. **100% Zuivere Markdown**: Schrijf nóóit ruwe HTML-tags zoals `<div>`, `<section>`, `<table>`, `<details>`. De secties worden uitsluitend gescheiden met het commentaar `<!-- section: id type="..." -->`.
2. **Geen 4-spaties of tabs**: Inspringingen zorgen ervoor dat Parsedown de tekst als letterlijke broncode toont.
3. **Root-relatieve interne links**: Gebruik altijd `/diensten`, `/contact`, `/over-ons`. De router vertaalt dit automatisch naar de juiste omgeving.
