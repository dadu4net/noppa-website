---
name: noppa-brand
description: Pas de Noppa Solutions & Consultants huisstijl toe op alle merkmaterialen — kleuren, typografie (Kentledge), logo-regels, tone of voice en componentpatronen. Gebruik wanneer de gebruiker vraagt om iets "voor Noppa", "in Noppa-stijl", "in de Noppa-huisstijl", "Noppa-branded", de payoff "Boosting Business Productivity" gebruikt, of als de input een Noppa-document is (deck, brief, social tile, icon, brand guide). NIET gebruiken voor andere merken of voor algemene documenten zonder Noppa-context.
cowork:
  category: writing
  icon: Sparkle
---

# Noppa — Brand Guidelines

> **Boosting Business Productivity**
> Versie 1.0 · 2026 · Noppa Solutions & Consultants

---

## 1. Over Noppa

Noppa Solutions & Consultants helpt organisaties slimmer werken. We bouwen aan productiviteit, structuur en grip — met technologie als motor en mensen als drijfveer.

**Payoff:** *Boosting Business Productivity* — staat altijd onder of bij het logo.

### Merkpijlers (tone-anker)

| Pijler | Betekenis |
|---|---|
| **Helder** | Zonder ruis. Concrete oplossingen, geen jargon. |
| **Vooruit** | Altijd in beweging. We versnellen waar het kan. |
| **Verbonden** | Met de klant, het team en de techniek. |
| **Vakkundig** | Onderbouwde keuzes, kwaliteit als standaard. |

---

## 2. Logo

### Varianten

| Variant | Wanneer | Bestand |
|---|---|---|
| Primair logo (kleur) | Witte of lichte achtergrond | `DEF_Logo_Noppa.png` / `.eps` / `.pdf` |
| Wit logo | Donkere of fotografische achtergrond | `DEF_Logo_Noppa_wit.png` / `.eps` |

### Regels

- **Witruimte** — minimaal de hoogte van de 'o' rondom het logo vrij van tekst, randen of beeld. Meer mag, minder nooit.
- **Minimale grootte** — digitaal **80 px** breed; print **25 mm** breed.
- **Verhouding** — altijd 1:1, nooit vervormen.

### Do's & Don'ts

- ✓ Gebruik altijd één van de twee officiële varianten
- ✓ Gebruik het witte logo op donkere of gekleurde achtergronden
- ✓ Behoud de originele kleurverloop en proporties
- ✕ Niet vervormen (scale x/y los van elkaar)
- ✕ Niet roteren of kantelen
- ✕ Niet herkleuren of eigen kleuren toevoegen
- ✕ Geen lage contrasten (logo nét niet leesbaar)
- ✕ Geen slagschaduw, gloed of andere effecten
- ✕ Geen drukke of patroon-achtergronden

---

## 3. Kleurpalet

### Signature gradient

Cyan → Sky → Royal → Indigo. Altijd horizontaal of 45°. Nooit losse vlekken of cirkels — altijd vloeiend verloop.

```css
linear-gradient(90deg, #00D0F0 0%, #20B0F0 35%, #2060E0 70%, #3A4FD0 100%)
```

### Primair palet

| Naam | HEX | RGB | CMYK | Gebruik |
|---|---|---|---|---|
| **Noppa Royal** | `#2060E0` | 32 / 96 / 224 | 86 / 68 / 0 / 0 | Primaire merkkleur, knoppen, links, accenten |
| **Noppa Sky** | `#20B0F0` | 32 / 176 / 240 | 72 / 22 / 0 / 0 | Secundair, achtergronden, illustraties |
| **Noppa Cyan** | `#00D0F0` | 0 / 208 / 240 | 72 / 0 / 6 / 0 | Accent, highlights, calls-to-action |
| **Noppa Navy** | `#0F2A66` | 15 / 42 / 102 | 100 / 85 / 20 / 30 | Headings, diepe vlakken |
| **Noppa Indigo**| `#3A4FD0` | - | - | Gradient-eindpunt |

### Neutralen & Functioneel

| Naam | HEX | Gebruik |
|---|---|---|
| Ink | `#1A2440` | Bodytekst |
| Slate | `#6B7280` | Secundaire tekst, captions |
| Mist | `#E4E9F2` | Dividers, randen |
| Light | `#F1F5FB` | Lichte vlakken, achtergronden |
| White | `#FFFFFF` | Pagina-achtergrond |
| Success | `#16A34A` | Bevestigingen, "do" |
| Warning | `#E53E3E` | Waarschuwingen, "don't" |

### Verhoudingen (60 · 30 · 10)
- **60%** wit / licht (Light, White)
- **30%** Noppa Royal
- **10%** accent (Cyan, Sky)

---

## 4. Typografie

**Familie:** Kentledge — sans-serif, 9 gewichten (100–950) + italics.

### Hiërarchie (print / web)

| Niveau | Gewicht | Grootte / Leading | Kleur | Notitie |
|---|---|---|---|---|
| H1 | Black 900 | 36 / 42 pt | Navy | Letterspacing −0.02em |
| H2 | Bold 700 | 22 / 28 pt | Navy | Letterspacing −0.015em |
| H3 | Bold 700 | 14 / 20 pt | Navy | |
| Body | Regular 400 | 10.5 / 15 pt | Ink | |
| Caption | Medium 500 | 8.5 / 12 pt | Slate | UPPERCASE, +0.16em tracking |

### Web fallback

```css
font-family: 'Kentledge', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
```

---

## 5. Tone of voice

Schrijf in het Nederlands tenzij de gebruiker expliciet Engels vraagt.

### Vier richtlijnen

1. **Direct** — we komen snel tot de kern.
2. **Menselijk** — geen jargon, wel persoonlijkheid.
3. **Concreet** — voorbeelden boven abstracties.
4. **Vooruitkijkend** — we benoemen de volgende stap.

### Wel doen
- "We zetten je team in 4 weken aan de slag met Copilot."
- "Eén dashboard. Eén bron van waarheid. Klaar."
- "Vraag, antwoord, doen."

### Niet doen
- "Wij faciliteren een transformatietraject richting AI-paraatheid."
- "Een holistische data-integratiebenadering voor stakeholders."
- "Het proces betreft een iteratieve cyclus van validatie."

---

## 6. Toepassingen & Componentpatronen

### Digitaal
- **Hyperlinks:** Noppa Royal (`#2060E0`), bij hover Navy (`#0F2A66`)
- **Knoppen primair:** vlak Royal, tekst wit, 700-gewicht
- **Knoppen accent:** vlak Cyan, tekst Navy

### Visitekaartje (85 × 55 mm)
- **Voorzijde:** wit met logo, naam in Royal Bold, contactgegevens in Ink
- **Achterzijde:** gradient met wit logo gecentreerd + payoff

### Briefpapier (A4)
- **Bovenrand:** 18 mm gradient-balk
- **Logo:** linksboven (70 × 25 mm)
- **Contactgegevens:** rechtsboven, Slate 6.5 pt
- **Onderrand:** 4 pt Royal-balk

### Social tiles (1080 × 1080 px)
Vier basistypes: *gradient hero* · *navy met cyan accent* · *light quote* · *white CTA*

### Iconen
24-pack in `output/noppa-icons/` — 48×48 viewBox, gradient stroke (`#g`), lichte gradient fill (`#gh`), stroke-width 2.4, ronde line caps.
*Namen: lightning, rocket, target, checklist, calendar, clock, gear, sparkles, brain, cloud, dashboard, growth, team, chat, handshake, idea, document, email, sync, link, shield, workflow, search, star.*

---

## 7. Workflow bij merkmateriaal

1. **Identificeer het type** (deck, brief, social, icon, e-mail, web).
2. **Pas de kleuren toe** volgens 60·30·10. Gebruik gradient alleen voor hero-momenten.
3. **Kies typografie** uit de hiërarchie hierboven. Headings altijd Navy.
4. **Plaats het logo** volgens de variant-regel (kleur op licht, wit op donker).
5. **Schrijf in Noppa-stem** — kort, concreet, geen jargon.
6. **Verifieer** dat de output payoff/contactgegevens correct heeft als het een extern stuk is.

### Wanneer NIET te gebruiken
- Materialen voor andere merken (klanten van Noppa, derden).
- Algemene documenten/decks zonder Noppa-context.
- Persoonlijke e-mails of berichten van de gebruiker zelf.

---

## 8. Bestanden & Assets

Bestaande deliverables staan in `/mnt/workspace/output/` (of vergelijkbare output mappen):

| Bestand | Toepassing |
|---|---|
| `DEF_Logo_Noppa.eps` / `.pdf` | Drukwerk (vector) |
| `DEF_Logo_Noppa.png` | Web / digitaal (kleur) |
| `DEF_Logo_Noppa_wit.eps` | Drukwerk wit (vector) |
| `DEF_Logo_Noppa_wit.png` | Web / digitaal (wit) |
| `Kentledge *.otf` | Print / desktoptypografie |
| `Kentledge-Regular.woff` | Web embedding |
| `Noppa_Brand_Guide.pdf` | Print-ready brand guide |
| `noppa-brand-guide.html` | Interactieve brand guide (standalone, fonts ingesloten) |
| `Noppa-deck-template.pptx` | PowerPoint-template, 10 slides |
| `Noppa-briefpapier.docx` | Word-briefpapier |
| `noppa-icons.zip` | 24 SVG-iconen |
| `noppa-social.zip` | Social PNG-pack |

Hergebruik deze waar mogelijk in plaats van opnieuw bouwen.

---

## 9. Contact

**Noppa Solutions & Consultants**
Pijlkruid 44, 5258 BW Berlicum

T 06 - 13 35 77 23
E [rik@noppa.nl](mailto:rik@noppa.nl)
W [www.noppa.nl](https://www.noppa.nl)

*© 2026 Noppa Solutions & Consultants · Brand Guide v1.0*
