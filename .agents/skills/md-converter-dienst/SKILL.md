---
name: md-converter-dienst
description: Converteert bronbestanden (PDF brochures/offertes, Word .docx documenten, legacy PHP dienstenpagina's en HTML landingspagina's) naar gestandaardiseerde 100% zuivere Dienst Markdown bestanden (data/diensten/[slug].md) volgens de Noppa Platform specificaties en DienstenEngine architectuur.
---

# Noppa Skill: Dienst Markdown Converter (`md-converter-dienst`)

Deze skill leert je hoe je willekeurige bronbestanden van diensten, proposities en trainingen — zoals **PDF brochures of offertes**, **Word (.docx) productbladen**, **legacy PHP pagina's** en **HTML landingspagina's** — nauwkeurig omzet naar gestandaardiseerde, 100% zuivere Markdown-bestanden in `data/diensten/{slug}.md`.

De output sluit naadloos aan op [`DienstenEngine.php`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/includes/DienstenEngine.php) en de Noppa platformrichtlijnen uit [`option/README.md`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/README.md).

---

## 🎯 Doelbestand & Locatie

- **Doelpad**: `data/diensten/{slug}.md` (bijvoorbeeld `data/diensten/beveiliging-compliance.md`)
- **URL**: Bereikbaar via `/diensten/{slug}` of `index.php?page=diensten&id={slug}`
- **Overzicht**: Moet tevens gekoppeld worden in `content/pages/diensten.md`

---

## 📋 Het Officiële Schema: YAML Frontmatter & Markdown Body

### 1. YAML Frontmatter Specificatie

Elk dienstbestand móét beginnen met een complete YAML frontmatter configuratie:

```yaml
---
id: "beveiliging-compliance"
order: 7
title: "M365 Beveiliging & Compliance | Noppa Solutions & Consultants"
shortTitle: "Beveiliging & Compliance"
eyebrow: "Veilig en in controle"
badge: "Microsoft Purview & Security"
badge_icon: "shield" # Kies uit de 24 officiële Noppa vector-iconen
hero_title: "Houd controle over uw data in het <span class='gradient-text'>AI-tijdperk</span>"
hero_subtitle: "Voorkom datalekken, borg gevoelige bedrijfsinformatie en voldoe moeiteloos aan wet- en regelgeving met Microsoft Purview en beproefde governance-kaders."
hero_cta_primary:
  text: "Vraag een Security Scan aan"
  url: "/contact"
  icon: "shield"
hero_cta_secondary:
  text: "Bekijk onze pakketten →"
  url: "#pricing"

# Keuze A: Stats grid (4 compacte metrics in de intro-rechterkolom)
stats:
  - num: "100%"
    lbl: "AVG-compliant"
  - num: "0"
    lbl: "Oversharing risico"
  - num: "24/7"
    lbl: "Inzicht in datastromen"
  - num: "A–Z"
    lbl: "Purview implementatie"

# Keuze B: Of gebruik intro_pillars (3 voordelen in plaats van stats)
# intro_pillars:
#   - icon: "shield"
#     title: "Grip op data"
#     desc: "Precies weten wie waar toegang toe heeft."

# Call-to-Action banner onderaan de dienstpagina
cta:
  title: "Klaar om uw data waterdicht te beveiligen?"
  desc: "Plan een vrijblijvend adviesgesprek van 30 minuten met een van onze compliance-specialisten."
  btn_text: "Plan een adviesgesprek →"
  btn_url: "/contact"

# Optioneel: Meerkoloms Pricing Grid (Transparante Pakketten)
pricing:
  title: "Vaste tarieven, maximale zekerheid"
  subtitle: "Transparante Pakketten"
  desc: "Kies de beveiligingsscope die past bij het risicoprofiel van uw organisatie. Alle bedragen zijn exclusief BTW."
  plans:
    - tier: "Basis"
      name: "Security Scan"
      target: "Voor organisaties die inzicht willen in hun huidige risico's."
      featured: false
      price_prefix: "Eenmalig"
      price_amount: "€ 1.850"
      price_suffix: "excl. BTW · binnen 1 week rapport"
      price_permw: ""
      cta:
        text: "Vraag scan aan"
        url: "/contact"
      features:
        - "Scan van tenant en rechtenstructuur"
        - "Controle op oversharing in SharePoint"
        - "Rapport met prioriteiten en quick wins"
    - tier: "Compleet"
      name: "Purview Inrichting"
      target: "Volledige implementatie van sensitivity labels en DLP."
      featured: true
      badge: "Meest gekozen"
      price_prefix: "Vanaf"
      price_amount: "€ 4.650"
      price_suffix: "excl. BTW · doorlooptijd 3 tot 5 weken"
      price_permw: ""
      cta:
        text: "Start implementatie"
        url: "/contact"
      features:
        - "Alles uit de Security Scan"
        - "Inrichten Microsoft Purview & DLP policies"
        - "Informatieclassificatie en labels"
        - "Instructieworkshop voor beheerders"
        - "Borging en overdrachtsdocumentatie"
---
```

---

### 2. Markdown Body Structuur

De `DienstenEngine.php` scant de Markdown-body en compileert deze naar specifieke Noppa BEM-componenten op basis van de H2 (`##`) koppen:

```markdown
## De uitdaging

Veel organisaties slaan gevoelige documenten op in Microsoft 365 zonder duidelijke classificatie. Zodra medewerkers Copilot of slimme zoekfuncties gaan gebruiken, komen documenten plotseling boven water die eigenlijk vertrouwelijk hadden moeten blijven.

Noppa helpt u grip te krijgen op uw datastromen. Wij combineren technische inrichting in Microsoft Purview met heldere afspraken voor medewerkers.

## Wat wij voor u doen

Wij dekken het volledige spectrum van databeveiliging en compliance binnen Microsoft 365.

### Purview Readiness Scan
Grondige analyse van uw huidige M365-omgeving op oversharing en datarisico's.

### Sensitivity Labels
Automatische en handmatige labels voor vertrouwelijke, interne en publieke data.

### Data Loss Prevention (DLP)
Voorkom dat burgerservicenummers, creditcarddata of persoonsgegevens onbedoeld naar buiten lekken.

### Toegangs- en rechtenstructuur
Opzetten van een strakke rechtenstructuur in SharePoint Online en Teams.

## In de praktijk

Praktijkcases waarin een goede beveiligingsinrichting direct resultaat oplevert.

### 1. Voorkomen van interne datalekken
Salarisspecificaties en MT-notulen worden automatisch afgeschermd voor zoekopdrachten van onbevoegden.

### 2. Veilig samenwerken met externen
Klanten en leveranciers krijgen uitsluitend toegang tot de afgesproken documenten zonder tenant-wijde rechten.

### 3. Automatische archivering
Documenten worden na de wettelijke bewaartermijn automatisch gearchiveerd of veilig verwijderd.

## Onze aanpak

Een gestructureerde aanpak van inventarisatie tot borging.

### 1. Nulmeting & Risicoanalyse
We brengen in kaart waar de grootste kwetsbaarheden zitten.

### 2. Beleid & Ontwerp
Samen met compliance en IT bepalen we de classificatieregels.

### 3. Technische Inrichting
Configuratie van labels, beleidsregels en uitsluitingen in Purview.

### 4. Instructie & Borging
Workshop voor uw medewerkers zodat iedereen weet hoe veilig te werken.

## Veilig én verantwoord

Compliance is geen papieren tijger, maar een dagelijkse gewoonte.

- **Microsoft Purview**: Automatische detectie van gevoelige persoonsgegevens.
- **AVG-richtlijnen**: Volledige naleving van de privacywetgeving.
- **Transparante monitoring**: Direct inzicht in verdachte databewegingen.

> "Beveiliging moet medewerkers niet belemmeren, maar juist het vertrouwen geven om voluit digitaal samen te werken."
> — Noppa, Compliancefilosofie

## Veelgestelde vragen

### Hebben we extra licenties nodig voor Microsoft Purview?
De basisfunctionaliteit zit in M365 Business Premium en Enterprise E3. Voor geavanceerde automatische classificatie is een E5 Compliance add-on gewenst. We kijken tijdens de intake wat het meest kosteneffectief is.

### Hoe lang duurt een gemiddeld security-traject?
Een scan is binnen 1 week afgerond. Een volledige inrichting van labels en policies duurt doorgaans 3 tot 5 weken.
```

---

## 🎨 Officiële Noppa Vector Iconen (24 Beschikbare Iconen)

Kies voor `badge_icon` en knopiconen altijd één van de 24 officiële iconen uit `assets/icons/`:

| Icoon Naam | Toepassing / Betekenis |
| :--- | :--- |
| `brain` | AI, machine learning, cognitieve processen, deep learning |
| `calendar` | Afspraken, workshops, planning, tijdlijnen |
| `chat` | Intakegesprek, overleg, support, communicatie |
| `checklist` | Audits, readiness scans, compliance, governance |
| `clock` | Tijdsbesparing, efficiency, doorlooptijd |
| `cloud` | Microsoft 365, Azure, cloudwerkplek, OneDrive |
| `dashboard` | SharePoint portalen, intranetten, monitoring |
| `document` | Documentbeheer, templates, rapportages, beleid |
| `email` | Outlook, mailbeheer, communicatiestromen |
| `gear` | Technische inrichting, Copilot Studio, instellingen |
| `growth` | Groei, schaalbaarheid, productiviteitswinst |
| `handshake` | Partnerschap, samenwerking, klantrelatie |
| `idea` | Innovatie, visie, inspiratie, workshops |
| `lightning` | Snelle kickstart, actie, quick wins |
| `link` | Koppelingen, integraties, externe links |
| `rocket` | Pilots, lancering, go-live, versnelling |
| `search` | Nulmeting, scan, inventarisatie, analyse |
| `shield` | Beveiliging, Microsoft Purview, AVG, privacy |
| `sparkles` | Microsoft Copilot, AI magie, moderne features |
| `star` | Uitgelichte diensten, topkwaliteit, certificering |
| `sync` | Adoptie, cultuurverandering, synchronisatie |
| `target` | Doelgerichtheid, KPI's, meetbare ROI |
| `team` | Mensen, ambassadeursnetwerk, verandering |
| `workflow` | Power Automate, processen, ketenautomatisering |

---

## 🔄 Conversiehandleiding per Brontype

### A. Van PDF (Brochures / Offertes / Productsheets)

1. **Tekst extraheren:**
   ```bash
   python scripts/convert_to_md.py --input "pad/naar/dienst-brochure.pdf" --type dienst --slug m365-beveiliging --title "M365 Beveiliging"
   ```
2. **Prijzen en Pakketten mappen:**
   - Zoek prijstabellen in de PDF.
   - Vertaal rijen naar `pricing.plans`: `tier`, `name`, `price_amount`, `price_suffix`, `cta`.
   - Vertaal opsommingen van inbegrepen onderdelen naar `features: [ ... ]`.
   - Geef het populairste of aanbevolen pakket `featured: true` en `badge: "Meest gekozen"`.
3. **Pijlers en Fasen mappen:**
   - Hoofdstukken met modules vertaal je naar `## Wat wij voor u doen` met `### Module Naam`.
   - Faseringen (Fase 1, Fase 2, Fase 3) vertaal je naar `## Onze aanpak` met `### 1. Fase Naam`.
   - Vragen en antwoorden onderaan het document vertaal je naar `## Veelgestelde vragen`.

### B. Van Word (.docx)

1. **Koppenstructuur normaliseren:**
   - `Heading 1` -> Paginatitel in frontmatter (`title`) en `hero_title`.
   - `Heading 2` -> Mappen naar de vaste Noppa sectietitels (`## De uitdaging`, `## Wat wij voor u doen`, `## In de praktijk`, `## Onze aanpak`, `## Veelgestelde vragen`).
   - `Heading 3` -> Individuele modules of stappen (`### 1. Intake`, `### 2. Realisatie`).
2. **Tarieventabellen:**
   - Haal de pakketkolommen uit de tabel en zet ze om naar het YAML `pricing.plans` blok.

### C. Van Legacy PHP (oude `diensten/dienst.php` met arrays)

1. **PHP Arrays extraheren:**
   Vaak definieerde een oud PHP-bestand een array met pricing of hero-data:
   ```php
   $plans = [
       ['name' => 'Kickstart', 'price' => '€ 1.250', 'features' => ['Scan', 'Rapport']]
   ];
   ```
   Vertaal deze direct naar het YAML `pricing:` schema bovenaan het Markdown-bestand.
2. **HTML Layout strippen:**
   - Verwijder wrappers zoals `<div class="container">`, `<section id="service-hero">`.
   - Behoud enkel de zuivere inhoudelijke tekst in Markdown-koppen en alinea's.

### D. Van HTML Landingspagina's

1. **Contentblokken isoleren:**
   - Zoek naar `.hero`, `.features`, `.pricing-table`, `.faq-accordion`.
2. **Converteren naar pure Markdown:**
   - FAQ `<details><summary>` elementen worden:
     ```markdown
     ### Vraagtekst
     Antwoordtekst.
     ```
   - Featureslijsten worden `features: [...]` in YAML of bullet points onder `## Wat wij voor u doen`.

---

## 🔗 Koppelen in de Diensten Catalogus

Vergeet na het aanmaken van `data/diensten/{slug}.md` niet om de dienst toe te voegen aan de overzichtspagina [`content/pages/diensten.md`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/content/pages/diensten.md):

```markdown
## 7. Beveiliging & Compliance
*Icoon: shield*
Houd controle over uw data in het AI-tijdperk met Microsoft Purview en waterdichte databeveiliging.
- Purview Readiness & Security Scan
- Sensitivity labels & Data Loss Prevention
- Voorkomen van oversharing in SharePoint en Copilot
[Bekijk Beveiliging & Compliance](/diensten/beveiliging-compliance)
```
