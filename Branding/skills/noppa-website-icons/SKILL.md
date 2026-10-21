---
name: noppa-website-icons
description: >-
  Richtlijn, catalogus en implementatiehandleiding voor alle officiële Noppa vector-iconen (SVG) op de website en in gerelateerde interfaces. Bevat de 24 officiële gradient-iconen, semantische betekenissen, stijldefinities en integratierichtlijnen.
---

# Noppa Website Icons Skill

Deze skill biedt een complete handleiding en referentie voor het toepassen van de officiële Noppa SVG iconenset op de website en gerelateerde webapplicaties van **Noppa Solutions & Consultants**.

---

## 1. Iconenlocatie & Architectuur

### Bronbestanden
- **Master Iconenmap (Design Source):**
  `C:\NOPPA\OneDrive - Noppa Solutions & Consultants\FRESH\Branding\noppa-icons\`
- **Website Assets (Productie):**
  `C:\NOPPA\OneDrive - Noppa Solutions & Consultants\FRESH\Noppa-New\REBRAND\assets\icons\`

### Ontwerpspecificaties (Noppa Design System)
- **ViewBox:** `0 0 48 48`
- **Stroke Width:** `2.4px` (met `stroke-linecap="round"` en `stroke-linejoin="round"`)
- **Stroke Gradient:** `linear-gradient` over 4 Noppa merkkleuren:
  1. `#00D0F0` (Noppa Cyan - 0%)
  2. `#20B0F0` (Noppa Sky - 35%)
  3. `#2060E0` (Noppa Royal - 70%)
  4. `#3A4FD0` (Noppa Indigo - 100%)
- **Highlight Fill (Semi-transparant):**
  `linear-gradient` van `#00D0F0` (18% opacity) naar `#2060E0` (18% opacity).
- **ID Scoping Regel:**
  Bij gebruik van inline SVG's of meerdere SVG-bestanden worden de gradient-ID's altijd gescoped per icoonnaam (bijv. `id="g-brain"` en `id="gh-brain"`), zodat gradienten elkaar op dezelfde HTML-pagina nooit overschrijven.

---

## 2. De 24 Officiële Noppa Iconen

| # | Bestandsnaam | Label / Titel | Semantische Betekenis & Toepassing | Sleutelwoorden |
| :-: | :--- | :--- | :--- | :--- |
| 1 | `brain.svg` | Noppa · Intelligentie | Strategie, advies, kennisoverdracht, trainingen, denkvermogen. | strategie, kennis, training, analyse, brein |
| 2 | `calendar.svg` | Noppa · Planning | Agenda, online afspraken boeken (Bookings), fasering, tijdlijnen. | planning, agenda, afspraak, tijdlijn |
| 3 | `chat.svg` | Noppa · Gesprek | Communicatie, intake, Ask-Me-Anything, telefonisch contact, Q&A. | gesprek, bellen, intake, vraag, dialoog |
| 4 | `checklist.svg` | Noppa · Taken | Stappenplannen, readiness-audits, licentiescans, governance check. | checklist, taken, audit, compliance, stappen |
| 5 | `clock.svg` | Noppa · Tijd | Tijdwinst, tijdsbesparing, korte modules (Lunch & Learn), snelheid. | tijd, klok, urenbesparing, doorlooptijd |
| 6 | `cloud.svg` | Noppa · Cloud | Microsoft 365, Azure, cloudmigratie, serververvanging, online werken. | cloud, m365, azure, server, migratie |
| 7 | `dashboard.svg` | Noppa · Dashboard | SharePoint Online intranet, portalen, overzicht, structuur & grip. | intranet, portaal, overzicht, dashboard |
| 8 | `document.svg` | Noppa · Document | Bestandsbeheer, SharePoint libraries, metadata, juridische info / KvK. | document, bestand, metadata, kvk, contract |
| 9 | `email.svg` | Noppa · E-mail | E-mailcontact (`rik@noppa.nl`), Outlook, nieuwsbrieven, berichten. | mail, email, contact, outlook, envelop |
| 10 | `gear.svg` | Noppa · Proces | Technisch beheer, systeemconfiguratie, Power Platform, bouw/ontwikkeling. | techniek, proces, beheer, tandwiel, instelling |
| 11 | `growth.svg` | Noppa · Groei | Productiviteitsgroei, rendement, meetbare ROI, monitoring, urenwinst. | groei, roi, rendement, productiviteit, grafiek |
| 12 | `handshake.svg` | Noppa · Samenwerking | De kernwaarde *Verbonden*, partnerschap, klantrelatie, overeenkomst. | samenwerking, verbonden, partners, relatie |
| 13 | `idea.svg` | Noppa · Idee | Visie, concepten, innovatie, inspiratiesessies, creatieve oplossingen. | idee, inspiratie, visie, innovatie, lamp |
| 14 | `lightning.svg` | Noppa · Snelheid | De kernwaarde *Vooruit*, versnelling, energie, actie, daadkracht. | snelheid, vooruit, energie, versnelling, bliksem |
| 15 | `link.svg` | Noppa · Verbinding | Integraties, API's, systeemkoppelingen (ERP/CRM), netwerkconnecties. | koppeling, integratie, link, verbinding |
| 16 | `rocket.svg` | Noppa · Lancering | Pilots, kick-off sessies, Copilot Experience, start van projecten. | kick-off, lancering, pilot, raket, start |
| 17 | `search.svg` | Noppa · Inzicht | Copilot Readiness Scan, persona-analyse, discovery, zoeken & vinden. | scan, analyse, onderzoek, inzicht, vergrootglas |
| 18 | `shield.svg` | Noppa · Beveiliging | Microsoft Purview, security, rechtenbeheer, DLP, governance. | beveiliging, privacy, purview, security, schild |
| 19 | `sparkles.svg` | Noppa · AI | Microsoft 365 Copilot, AI-agents, Copilot Studio, prompt training. | ai, copilot, assistent, prompt, sparkles |
| 20 | `star.svg` | Noppa · Kwaliteit | De kernwaarde *Vakkundig*, best practices, train-the-trainer, kwaliteit. | kwaliteit, vakkundig, ster, expertise, review |
| 21 | `sync.svg` | Noppa · Integratie | Adoptieborging, continue updates, flow, cultuurverandering. | adoptie, borging, updates, flow, sync |
| 22 | `target.svg` | Noppa · Doel | De kernwaarde *Helder*, doelstellingen, doelgroepen, vestigingslocatie. | doel, helder, focus, doelgroep, locatie |
| 23 | `team.svg` | Noppa · Team | Medewerkers, ambassadeursnetwerk, change management, cultuur. | team, mensen, medewerkers, ambassadeurs |
| 24 | `workflow.svg` | Noppa · Workflow | Power Automate, procesautomatisering, routings, stroomdiagrammen. | workflow, automatisering, power automate, stroom |

---

## 3. Implementatierichtlijnen in HTML/CSS

### A. Aanbevolen HTML Notatie (via `<img>`)
Voor standaard websitecomponenten is het aanroepen van het SVG-bestand als afbeelding de meest betrouwbare en schone methode:

```html
<!-- Root pagina's (zoals index.html, contact.html) -->
<div class="c-icon c-geel">
    <img src="assets/icons/target.svg" alt="Helder" class="noppa-icon">
</div>

<!-- Subpagina's (zoals diensten/*.html, visie/*.html) -->
<div class="c-icon c-geel">
    <img src="../assets/icons/target.svg" alt="Helder" class="noppa-icon">
</div>
```

### B. Inline SVG Notatie
Wanneer een icoon rechtstreeks inline in de DOM wordt geplaatst, zorg altijd voor unieke gradient-ID's:

```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" class="noppa-icon" role="img" aria-label="Noppa · Doel">
  <title>Noppa · Doel</title>
  <defs>
    <linearGradient id="g-target" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
      <stop offset="0" stop-color="#00D0F0"/>
      <stop offset="0.35" stop-color="#20B0F0"/>
      <stop offset="0.7" stop-color="#2060E0"/>
      <stop offset="1" stop-color="#3A4FD0"/>
    </linearGradient>
    <linearGradient id="gh-target" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
      <stop offset="0" stop-color="#00D0F0" stop-opacity="0.18"/>
      <stop offset="1" stop-color="#2060E0" stop-opacity="0.18"/>
    </linearGradient>
  </defs>
  <g stroke="url(#g-target)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="24" cy="24" r="16" fill="url(#gh-target)"/>
    <circle cx="24" cy="24" r="8"/>
    <circle cx="24" cy="24" r="2" fill="url(#g-target)"/>
  </g>
</svg>
```

### C. CSS Styling Standaard
De basis styling is gedefinieerd in `assets/css/burogekko.css`:

```css
.noppa-icon, .c-icon img {
    width: 24px;
    height: 24px;
    object-fit: contain;
    display: block;
}

.c-box img, .c-box svg {
    width: 26px;
    height: 26px;
}

.c-icon {
    width: 42px;
    height: 42px;
    border-radius: 9px;
    background: rgba(32, 96, 224, 0.10);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
```

---

## 4. Paginaspecifieke Mapping Tabel

### 🏠 Homepage (`index.html`)
- **Pijler Helder:** `target.svg`
- **Pijler Vooruit:** `lightning.svg`
- **Pijler Verbonden:** `handshake.svg`
- **Pijler Vakkundig:** `star.svg`
- **Strategie & Advies:** `brain.svg`
- **Implementatie & Migratie:** `cloud.svg`
- **Processen & Portalen:** `dashboard.svg`
- **Adoptie & Begeleiding:** `team.svg`
- **AI-integratie & Copilot:** `sparkles.svg`
- **Workshops & Trainingen:** `idea.svg`
- **Copilot Experience:** `rocket.svg`
- **Licenties & Support:** `checklist.svg`
- **Governance & Compliance:** `shield.svg`

### 📘 Diensten
- **Adoptie & Begeleiding:** `cloud.svg`, `team.svg`, `growth.svg`, `shield.svg`, `sparkles.svg`, `sync.svg`, `search.svg`, `brain.svg`, `chat.svg`, `handshake.svg`, `dashboard.svg`, `workflow.svg`, `checklist.svg`
- **AI & Copilot:** `search.svg`, `shield.svg`, `growth.svg`, `brain.svg`, `rocket.svg`, `sparkles.svg`
- **Processen & Portalen:** `dashboard.svg`, `document.svg`, `workflow.svg`, `link.svg`
- **Workshops & Trainingen:** `team.svg`, `cloud.svg`, `clock.svg`, `lightning.svg`, `gear.svg`, `star.svg`

---

## 5. Uitzonderingen & Behoud van Externe Iconen
- **Klantlogo's / Referenties** (`assets/referenties/*.svg`): Blijven de officiële vectorlogo's van klanten (o.a. KLM, Ebusco, Frans Hals Museum).
- **Functionele UI Controls**: Kleine chevron-pijltjes (`→`), breadcrumbs (`›`), vinkjes in formulieren/lijsten (`.p-check`, `.check-list`) en social media iconen (LinkedIn, RSS, Instagram, Discord) behouden hun specifieke micro-vector styling.
