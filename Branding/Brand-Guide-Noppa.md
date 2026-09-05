---
name: noppa-brand
description: Pas de Noppa Solutions & Consultants huisstijl toe op alle merkmaterialen — kleuren, typografie (Kentledge), logo-regels, tone of voice en componentpatronen. Gebruik wanneer de gebruiker vraagt om iets "voor Noppa", "in Noppa-stijl", "in de Noppa-huisstijl", "Noppa-branded", de payoff "Boosting Business Productivity" gebruikt, of als de input een Noppa-document is (deck, brief, social tile, icon, brand guide). NIET gebruiken voor andere merken of voor algemene documenten zonder Noppa-context.
cowork:
  category: writing
  icon: Sparkle
---

# Noppa-huisstijl

Pas deze richtlijnen toe op elk merkmateriaal voor **Noppa Solutions & Consultants**.
Payoff: *Boosting Business Productivity* — altijd onder of bij het logo.

## Merkpijlers (tone-anker)
**Helder · Vooruit · Verbonden · Vakkundig**

## Kleurpalet (HEX)

| Token | HEX | Gebruik |
|---|---|---|
| Noppa Cyan   | `#00D0F0` | Accent, highlights, CTA |
| Noppa Sky    | `#20B0F0` | Secundair, achtergronden |
| Noppa Royal  | `#2060E0` | Primair, knoppen, links |
| Noppa Indigo | `#3A4FD0` | Gradient-eindpunt |
| Noppa Navy   | `#0F2A66` | Headings, donkere vlakken |
| Ink          | `#1A2440` | Bodytekst |
| Slate        | `#6B7280` | Captions, secundaire tekst |
| Mist         | `#E4E9F2` | Dividers, randen |
| Light        | `#F1F5FB` | Lichte vlakken |
| Success      | `#16A34A` | Bevestigingen, "do" |
| Warning      | `#E53E3E` | Waarschuwingen, "don't" |

**Signature gradient** (horizontaal of 45°, nooit losse vlekken):

```
linear-gradient(90deg, #00D0F0 0%, #20B0F0 35%, #2060E0 70%, #3A4FD0 100%)
```

**Verhouding 60·30·10**: 60% wit/licht · 30% Royal · 10% Cyan/Sky-accent.

## Typografie

**Familie**: Kentledge (9 gewichten, 100–950, met italics).
**Webfallback**: `font-family: 'Kentledge', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;`

| Niveau | Gewicht | Grootte/Leading | Kleur | Notitie |
|---|---|---|---|---|
| H1 | Black 900 | 36/42 pt | Navy | letter-spacing −0.02em |
| H2 | Bold 700  | 22/28 pt | Navy | letter-spacing −0.015em |
| H3 | Bold 700  | 14/20 pt | Navy | |
| Body | Regular 400 | 10.5/15 pt | Ink | |
| Caption | Medium 500 | 8.5/12 pt | Slate | UPPERCASE, +0.16em |

## Logo

**Varianten**: `DEF_Logo_Noppa.png` (kleur, op licht) · `DEF_Logo_Noppa_wit.png` (wit, op donker/foto).
**Witruimte**: minimaal de hoogte van de 'o' rondom vrij.
**Minimum**: 80 px digitaal, 25 mm print.
**Verhouding**: altijd 1:1.

**Do**: officiële varianten, originele gradient en proporties behouden.
**Don't**: vervormen, roteren, herkleuren, slagschaduw/gloed, drukke achtergronden.

## Tone of voice

**Vier richtlijnen**: Direct · Menselijk · Concreet · Vooruitkijkend.

**Wel**:
- "We zetten je team in 4 weken aan de slag met Copilot."
- "Eén dashboard. Eén bron van waarheid. Klaar."
- "Vraag, antwoord, doen."

**Niet**:
- "Wij faciliteren een transformatietraject richting AI-paraatheid."
- "Een holistische data-integratiebenadering voor stakeholders."
- "Het proces betreft een iteratieve cyclus van validatie."

Schrijf in het Nederlands tenzij de gebruiker expliciet Engels vraagt.

## Componentpatronen

**Briefpapier (A4)**: 18 mm gradient-balk boven, logo linksboven (70×25 mm), contactgegevens rechtsboven in Slate 6.5 pt, onderrand 4 pt Royal-balk.

**Visitekaartje (85×55 mm)**: voorzijde wit met logo + naam Royal Bold; achterzijde gradient met wit logo + payoff.

**Social tile (1080×1080)**: vier types — gradient hero · navy + cyan accent · light quote · white CTA.

**Knoppen**:
- Primair = vlak Royal, witte tekst, gewicht 700
- Accent = vlak Cyan, Navy-tekst
- Hyperlinks Royal, hover Navy

**Iconen**: 24-pack in `output/noppa-icons/` — 48×48 viewBox, gradient stroke (`#g`), lichte gradient fill (`#gh`), stroke-width 2.4, ronde line caps.
Namen: lightning, rocket, target, checklist, calendar, clock, gear, sparkles, brain, cloud, dashboard, growth, team, chat, handshake, idea, document, email, sync, link, shield, workflow, search, star.

## Contact

**Noppa Solutions & Consultants**
Pijlkruid 44, 5258 BW Berlicum
T 06-13 35 77 23 · E rik@noppa.nl · W www.noppa.nl

## Workflow bij merkmateriaal

1. **Identificeer het type** (deck, brief, social, icon, e-mail, web).
2. **Pas de kleuren toe** volgens 60·30·10. Gebruik gradient alleen voor hero-momenten.
3. **Kies typografie** uit de hiërarchie hierboven. Headings altijd Navy.
4. **Plaats het logo** volgens de variant-regel (kleur op licht, wit op donker).
5. **Schrijf in Noppa-stem** — kort, concreet, geen jargon.
6. **Verifieer** dat de output payoff/contactgegevens correct heeft als het een extern stuk is.

## Bestaande assets

Bestaande deliverables staan in `/mnt/workspace/output/`:
- `Noppa_Brand_Guide.pdf` + `noppa-brand-guide.html` (volledige gids)
- `brand-guidelines-noppa.md` (markdown-referentie)
- `Noppa-deck-template.pptx` (PowerPoint-template, 10 slides)
- `Noppa-briefpapier.docx` (Word-briefpapier)
- `noppa-icons.zip` + `noppa-icons/` (24 SVG-iconen)
- `noppa-social.zip` + `noppa-social/` (social PNG-pack)

Hergebruik deze waar mogelijk in plaats van opnieuw bouwen.

## Wanneer NIET te gebruiken

- Materialen voor andere merken (Buro GEKKO, klanten van Noppa, derden).
- Algemene documenten/decks zonder Noppa-context.
- Persoonlijke e-mails of berichten van de gebruiker zelf.
