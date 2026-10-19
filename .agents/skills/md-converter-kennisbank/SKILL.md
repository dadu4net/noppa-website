---
name: md-converter-kennisbank
description: Converteert bronbestanden (PDF whitepapers/artikelen, Word .docx documenten, legacy PHP blogs en HTML artikelen) naar gestandaardiseerde 100% zuivere Kennisbank Markdown bestanden (content/kennisbank/artikelen/[slug].md) volgens de Noppa Platform specificaties en KennisbankEngine architectuur.
---

# Noppa Skill: Kennisbank Artikel Markdown Converter (`md-converter-kennisbank`)

Deze skill leert je hoe je willekeurige bronbestanden — zoals **PDF whitepapers en handleidingen**, **Word (.docx) artikelen**, **legacy PHP blogposts** en **HTML artikelen** — nauwkeurig omzet naar gestandaardiseerde, 100% zuivere Markdown-bestanden in `content/kennisbank/artikelen/{slug}.md`.

De output sluit naadloos aan op [`KennisbankEngine.php`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/includes/KennisbankEngine.php) en de Noppa platformrichtlijnen uit [`option/README.md`](file:///c:/NOPPA/OneDrive%20-%20Noppa%20Solutions%20&%20Consultants/FRESH/option/README.md).

---

## 🎯 Doelbestand & Locatie

- **Doelpad**: `content/kennisbank/artikelen/{slug}.md` (bijvoorbeeld `content/kennisbank/artikelen/microsoft-copilot-prompt-gids.md`)
- **URL**: Bereikbaar via `/kennisbank/{slug}` of `index.php?page=kennisbank&slug={slug}`
- **Overzicht**: Verschijnt automatisch in het kennisbankoverzicht (`/kennisbank`) en kan gefilterd worden op categorie.

---

## 📋 Het Officiële Schema: Frontmatter & Body

### 1. YAML Frontmatter Specificatie

Elk kennisbank-artikel móét beginnen met de volgende frontmatter:

```yaml
---
title: "De Ultieme Gids voor Effectieve Microsoft Copilot Prompts"
beschrijving: "Leer hoe u krachtige prompts formuleert in Word, Teams en Outlook om direct tijd te besparen met Copilot."
datum: 2026-10-16
categorie: "Microsoft Copilot" # Bijv: Microsoft Copilot, SharePoint & M365, Adoptie & Cultuur, Beveiliging & Governance
auteur: "Rik Dobbelsteen" # Naam van een teamlid uit data/team/
leestijd: "5 min"
featured: false # Zet op true om dit artikel bovenaan de kennisbank uit te lichten
pdf: "copilot-prompt-gids.pdf" # Optioneel: link naar een downloadbare PDF in dezelfde map
tags:
  - Microsoft Copilot
  - AI Prompts
  - Productiviteit
---
```

#### Velden Uitleg:
| Veld | Type | Verplicht | Toelichting |
| :--- | :--- | :--- | :--- |
| `title` | String | Ja | Volledige titel van het artikel |
| `beschrijving` | String | Ja | Pakkende introductie / samenvatting (150-200 tekens) voor artikelkaarten en zoekmachines |
| `datum` | YYYY-MM-DD | Ja | Publicatiedatum |
| `categorie` | String | Ja | Primaire categorie voor filtering in de kennisbank |
| `auteur` | String | Ja | Naam van de auteur (koppelt automatisch aan een consultantprofiel) |
| `leestijd` | String | Ja | Geschatte leestijd (bijv. "4 min" of "7 min") |
| `featured` | Boolean | Nee | `true` indien het artikel als uitgelichte banner bovenaan moet staan |
| `pdf` | String | Nee | Optionele bestandsnaam van een downloadbare PDF-versie |
| `tags` | Array | Nee | Lijst met trefwoorden |

---

### 2. Markdown Body Structuur & Automatische Table of Contents (TOC)

De `KennisbankEngine.php` leest de body en bouwt automatisch een **sticky Table of Contents** met een scroll-progressiebalk op basis van alle `## ` (H2) koppen:

```markdown
# De Ultieme Gids voor Effectieve Microsoft Copilot Prompts

> **Samenvatting:** Een goede prompt bevat vier elementen: doel, context, bron en gewenste toon. In dit artikel behandelen we praktijkvoorbeelden voor direct gebruik binnen Word, Teams en Outlook.

---

## Waarom de meeste prompts teleurstellen

Wanneer u Copilot vraagt: *"Schrijf een offerte voor klant X"*, krijgt u een generiek antwoord. Copilot weet namelijk niet wat u belangrijk vindt, welke tarieven gelden of welke toon uw organisatie hanteert.

### De 4 bouwstenen van een goede prompt

1. **Doel**: Wat moet Copilot precies produceren? (samenvatting, tabel, concepttekst)
2. **Context**: Voor wie is het bedoeld en wat is de achtergrond?
3. **Bron**: Welke bestanden of e-mails moet Copilot als bronmateriaal gebruiken?
4. **Verwachting**: Wat is de lengte, stijl en vorm van de output?

---

## Praktijkvoorbeelden per applicatie

Hieronder vindt u beproefde prompts die direct resultaat opleveren.

### Prompts in Microsoft Teams
- *"Vat de actiepunten van deze meeting samen en zet ze in een tabel met kolommen: Actie, Eigenaar en Deadline."*

### Prompts in Microsoft Word
- *"Herschrijf onderstaande alinea in een professionele B2B-toon voor een directieverslag, maximaal 150 woorden."*

### Prompts in Microsoft Outlook
- *"Stel een vriendelijk maar dringend herinneringsbericht op over de openstaande factuur van vorige week."*

---

## Veelvoorkomende valkuilen

> [!WARNING]
> Voer nooit vertrouwelijke persoonsgegevens of creditcardinformatie in prompts in zonder dat Microsoft Purview DLP actief is geconfigureerd op uw tenant!

Let op de volgende drie risico's:
1. Te brede instructies zonder context.
2. Niet controleren van de bronvermeldingen.
3. Blindelings overnemen van gegenereerde cijfers.

---

## Conclusie & Volgende Stappen

Door prompts te structureren volgens de 4 bouwstenen verandert Copilot van een willekeurige tekstgenerator in een waardevolle persoonlijke assistent.

Wilt u een gerichte [Copilot Training](/diensten/workshops-trainingen) organiseren voor uw team? Of heeft u advies nodig over [databeveiliging](/diensten/beveiliging-compliance)? Neem gerust [contact](/contact) op met onze specialisten.
```

---

## 🔄 Conversiehandleiding per Brontype

### A. Van PDF (Whitepapers / Rapporten / Handboeken)

1. **Tekst extraheren:**
   ```bash
   python scripts/convert_to_md.py --input "pad/naar/whitepaper.pdf" --type kennisbank --slug copilot-whitepaper --title "Copilot Whitepaper"
   ```
2. **Structuur herstellen:**
   - **Titel:** Neem de hoofdtitel van het voorblad als `# Titel`.
   - **Managementsamenvatting:** Vertaal de "Executive Summary" of abstract naar `> **Samenvatting:** ...`.
   - **Hoofdstukken:** Elk genummerd hoofdstuk (1., 2., 3.) wordt een `## Hoofdstuknaam`. Deze verschijnen direct in de interactieve sticky TOC.
   - **Paragrafen:** Paragrafen (1.1, 1.2) worden `### Deelonderwerp`.
   - **Tabellen & Grafieken:** Converteer PDF-tabellen naar Markdown pipe-tabellen (`| Kolom 1 | Kolom 2 |`).
   - **PDF Download:** Als de originele PDF in de map blijft staan, voeg `pdf: "bestandsnaam.pdf"` toe aan de frontmatter. De engine toont dan automatisch een stijlvolle downloadknop!

### B. Van Word (.docx)

1. **Stijlen analyseren:**
   - `Title` of `Heading 1` -> `# Titel` en frontmatter `title`.
   - `Heading 2` -> `## H2 Kop` (voeding voor de TOC).
   - `Heading 3` -> `### H3 Kop`.
   - `Quote` / kaders -> `> Citaat of tip`.
2. **Leestijd bepalen:**
   - Tel het aantal woorden (ongeveer 200-250 woorden per minuut). Bijvoorbeeld 1.000 woorden = `5 min`.

### C. Van Legacy PHP (oude blog CMS templates)

1. **CMS Ruis strippen:**
   - Verwijder database connecties, WordPress loop code (`have_posts()`), sidebar widgets en comments sections.
2. **Metadata mappen:**
   - Vertaal `the_time('Y-m-d')` naar `datum: YYYY-MM-DD`.
   - Vertaal `the_author()` naar `auteur: "..."`.
   - Vertaal `the_category()` naar `categorie: "..."`.
3. **HTML content omzetten naar Markdown:**
   - Vervang `<p>` door witregels, `<h2>` door `##`, `<ul><li>` door `- `, `<blockquote>` door `> `.

### D. Van HTML Webartikelen

1. **Artikelcontainer isoleren:**
   - Selecteer `<article>` of `.entry-content` en negeer header, footer en gerelateerde posts.
2. **Interne links opschonen:**
   - Zorg dat interne links verwijzen naar Noppa routes (bijv. `/contact` of `/diensten/...`).

---

## ⚠️ Belangrijke Noppa Platform Regels

1. **100% Zuivere Markdown**: Geen ruwe HTML `<div class="artikel-...">`, `<section>`, etc. De `KennisbankEngine.php` verzorgt alle layout en CSS-classes automatisch.
2. **Geen 4-spaties of tabs**: Inspringingen zorgen ervoor dat Parsedown de tekst als letterlijke broncode toont.
3. **Automatische TOC**: Gebruik altijd `## ` voor de hoofdsecties. Zonder `## ` koppen kan de engine geen inhoudsopgave genereren!
4. **Koppeling met Teamleden**: Zorg dat `auteur` exact overeenkomt met de `firstName lastName` van een consultant in `data/team/` (bijvoorbeeld `Rik Dobbelsteen`). De engine linkt dan automatisch de auteurwidget aan het consultantprofiel.
