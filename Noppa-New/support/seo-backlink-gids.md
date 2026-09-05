# SEO & Backlinking Gids — Noppa

**Doel:** Noppa zichtbaar maken voor potentiële klanten die zoeken op Microsoft 365-gerelateerde termen in Nederland, met focus op de regio 's-Hertogenbosch / Noord-Brabant.

---

## 1. Wat is al geïmplementeerd (technisch SEO)

### In `index.html`
| Element | Waarde |
|---|---|
| `<title>` | "Noppa \| Microsoft 365 Specialist 's-Hertogenbosch" |
| `<meta description>` | 155 tekens, bevat kernwoorden + USP |
| `<link rel="canonical">` | `https://www.noppa.nl/` |
| Open Graph tags | Titel, beschrijving, afbeelding (1200×630) |
| Twitter Card | `summary_large_image` |
| Geo-meta | NL-NB, 's-Hertogenbosch, coördinaten |
| JSON-LD schema | Organization · LocalBusiness · WebSite · ProfessionalService |

### Overige bestanden
- `sitemap.xml` — hoofdpagina + ankersecties
- `robots.txt` — crawl-instructies, sitemap-verwijzing

### Nog te doen na deployment
1. Maak een OG-afbeelding (`og-image.jpg`, 1200×630px) — b.v. logo op donkere Grasso-achtergrond
2. Voeg favicon toe als `.ico` en SVG variant
3. Meld de website aan bij **Google Search Console** (`search.google.com/search-console`)
4. Meld de website aan bij **Bing Webmaster Tools** (`bing.com/webmasters`)
5. Vul de verificatietags in `<head>` in na aanmelding

---

## 2. Zoekwoorden-strategie

### Primaire zoekwoorden (hoog volume, hoge relevantie)
| Zoekwoord | Intentie |
|---|---|
| `Microsoft 365 consultant Nederland` | Commercieel |
| `Microsoft 365 implementatie Den Bosch` | Lokaal + commercieel |
| `SharePoint intranet implementeren` | Informatief → commercieel |
| `Microsoft Teams adoptie begeleiding` | Commercieel |
| `Copilot Microsoft 365 adoptie` | Commercieel, groeiend |
| `digitale werkplek Microsoft 365` | Informatief |

### Secundaire zoekwoorden
- `SharePoint Online consultant`
- `Power Automate implementatie`
- `Microsoft 365 governance beheer`
- `gebruikersadoptie Microsoft 365`
- `Microsoft 365 training medewerkers`
- `Purview informatiebeheer`
- `Microsoft 365 licentie advies`

### Lokale zoekwoorden (geo-targeting)
- `Microsoft 365 consultant 's-Hertogenbosch`
- `IT consultancy Den Bosch`
- `digitale transformatie Noord-Brabant`
- `Microsoft partner Brabant`

---

## 3. Backlinking — Prioriteitslijst

### Tier 1 — Hoge autoriteit, directe relevantie

| Bron | Actie | Moeite |
|---|---|---|
| **Microsoft Partner Network** | Zorg dat Noppa vermeld staat als officieel Microsoft-partner; dit levert een backlink van microsoft.com | Medium |
| **LinkedIn bedrijfspagina** | Vul de website-URL volledig in op `noppa.nl`; LinkedIn-links worden door Google meegewogen | Laag |
| **GitHub profiel** | `Noppa` GitHub-profiel verwijst al naar de website — zorg dat het actief is | Laag |
| **Google Business Profile** | Maak/claim een Google Business profiel aan voor lokale SEO ('s-Hertogenbosch) | Laag |
| **Bing Places** | Zelfde als Google Business, maar voor Bing | Laag |

### Tier 2 — Sectorgerichte vermeldingen

| Bron | Actie |
|---|---|
| **Grasso / degrasso.nl** | Vraag vermelding als huurder op de Grasso-website (community-pagina) |
| **JADS (Jheronimus Academy of Data Science)** | Co-locatie Den Bosch → vraag vermeling in hun netwerk-/partnerlijst |
| **Microsoft 365 Community (techcommunity.microsoft.com)** | Schrijf een blogpost/artikel over een adoptie-case en link terug naar noppa.nl |
| **ICT-Magazine / Computable.nl** | Stuur een nieuwsbericht of expert-opinie in bij een vakblad |
| **SharePoint Saturday Netherlands** | Spreek op een evenement en zorg voor vermelding op de evenementenpagina |
| **Dutch Microsoft 365 Community (DUCH)** | Word lid en zorg voor profiel-backlink |

### Tier 3 — Klant- en partnerlinks

| Actie | Toelichting |
|---|---|
| **Vraag klanten om een referentie-link** | Vraag bij tevreden klanten (KLM Catering, Ebusco, etc.) om een 'partners'-vermelding op hun website |
| **ShareGate partner-pagina** | Vraag vermelding als ShareGate-partner/reseller |
| **Grasso community-blog** | Schrijf een bijdrage voor de Grasso-blog over digitale werkplek |
| **Kamer van Koophandel** | Zorg dat het KvK-profiel (86739573) de website-URL bevat |

---

## 4. Content-marketing voor organisch verkeer

Blogs of artikelen die goed scoren op zoekwoorden én backlinks aantrekken:

| Onderwerp | Zoekwoord-focus |
|---|---|
| "Microsoft Copilot in de praktijk: 5 use cases voor MKB" | Copilot adoptie |
| "SharePoint intranet bouwen: de 7 fouten die je moet vermijden" | SharePoint intranet |
| "Microsoft 365 licenties vergelijken in 2025: Business vs. Enterprise" | M365 licenties |
| "Gebruikersadoptie meten: hoe weet je of Teams echt werkt?" | Teams adoptie |
| "Power Automate voor beginners: 3 workflows die direct waarde toevoegen" | Power Automate |

> **Tip:** Publiceer blogartikelen via de website (voeg een `/blog/` sectie toe) of op LinkedIn als newsletter-artikel. Deel elk artikel via de LinkedIn-bedrijfspagina van Noppa.

---

## 5. Lokale SEO Checklist

- [ ] Google Business Profile aangemaakt en geverifieerd
- [ ] Bedrijfsnaam, adres en telefoonnummer (NAP) consistent op alle platforms
- [ ] Minimaal 5 Google-recensies gevraagd aan tevreden klanten
- [ ] Grasso-vermelding als huurder (lokale backlink)
- [ ] Vermelding in lokale ondernemersgidsen ('s-Hertogenbosch Ondernemersfonds, etc.)
- [ ] KvK-profiel bijgewerkt met website-URL

---

## 6. Technische SEO — Doorlopende aandachtspunten

| Punt | Status | Actie |
|---|---|---|
| Core Web Vitals (LCP, CLS, FID) | Te meten na deployment | Gebruik PageSpeed Insights |
| HTTPS / SSL | Pending | Let's Encrypt via DirectAdmin |
| Geen gebroken links | ✓ (statische site) | Controleer na elke update |
| Afbeeldingen geoptimaliseerd | Deels | Compress `grasso-gebouw.jpg` (1.5MB) via TinyPNG |
| `alt`-teksten op alle afbeeldingen | ✓ | Aanwezig in HTML |
| `sitemap.xml` aangemeld | Pending | Na deployment |
| Schema.org gevalideerd | Te doen | Gebruik `schema.dev` of Google Rich Results Test |
| Paginasnelheid | Te meten | Streef naar score ≥ 90 op mobiel |

---

## 7. Tools

| Tool | Doel | URL |
|---|---|---|
| Google Search Console | Indexering, keywords, fouten | search.google.com/search-console |
| Bing Webmaster Tools | Bing indexering | bing.com/webmasters |
| PageSpeed Insights | Core Web Vitals | pagespeed.web.dev |
| Ahrefs Free / Ubersuggest | Backlink-analyse | ahrefs.com / neilpatel.com/ubersuggest |
| Schema Markup Validator | JSON-LD testen | validator.schema.org |
| Google Rich Results Test | Structured data testen | search.google.com/test/rich-results |
| TinyPNG | Afbeeldingen comprimeren | tinypng.com |

