# 📋 Brand & Design Intake Vragenlijst
### Om de perfecte uitstraling, identiteit en configuratie te bepalen

Deze vragenlijst is ontworpen om in één sessie (of als intake-formulier voor een klant) de complete merkidentiteit, kleurenpsychologie, typografie en sitestructuur scherp te krijgen. 

De antwoorden kunnen direct 1-op-1 worden ingevuld in [`site.config.php`](./site.config.php) en de Markdown contentbestanden van deze starter-kit.

---

## 🏛️ Deel 1: Bedrijfsidentiteit & Kernboodschap

1. **Wat zijn de exacte bedrijfs- en domeingegevens?**
   - Handelsnaam / Merknaam: ________________________
   - Statutaire naam (B.V. / V.O.F. / Eenmanszaak): ________________________
   - Hoofddomein URL: `https://`________________________
   - Hoofd e-mailadres voor contact: ________________________
   - Algemeen telefoonnummer: ________________________
   - KvK-nummer: ________________________
   - Vestigingsadres: ________________________

2. **Wat is de kernboodschap / waardepropositie in één zin?**
   *(Wat doe je, voor wie, en welk specifiek probleem los je op?)*
   > *"Voorbeeld: Wij helpen ambitieuze MKB-bedrijven slimmer werken met Microsoft 365 en praktische AI-adoptie."*
   - Jouw payoff / slogan: ________________________

3. **Welke tone-of-voice past het beste bij de doelgroep?**
   - [ ] **Zakelijk & Gezaghebbend (U):** Formeel, betrouwbaar, gericht op directies en enterprise.
   - [ ] **Professioneel & Toegankelijk (Je/Jij):** Vriendelijk, nuchter, no-nonsense en oplossingsgericht.
   - [ ] **Innovatief & Uitdagend:** Dynamisch, tech-forward, thought leadership en actiegericht.

---

## 🎨 Deel 2: Kleurenpalet & Emotie (De 60-30-10 Regel)

Kleur bepaalt binnen 50 milliseconden het onderbuikgevoel van de bezoeker. We verdelen het palet in een heldere 60-30-10 verhouding:

```
┌──────────────────────────────────────────────────────────┐
│  60% — Basis / Achtergrond (Rust & Leesbaarheid)        │
│  Licht: #F1F5FB (Mistwit) | Donker: #070D1B (Onyx)       │
├────────────────────────────────┬─────────────────────────┤
│  30% — Primaire Merkkleur      │  10% — Accent / CTA     │
│  (Buttons, Headers, Links)     │  (Pills, Glow, Badges)  │
│  HEX: ________________________ │  HEX: _________________ │
└────────────────────────────────┴─────────────────────────┘
```

1. **Welke sfeer of emotie moet de website direct oproepen?**
   - [ ] **Betrouwbaarheid & Rust:** Blauwtinten (Navy `#0F2A66`, Royal Blue `#2060E0`)
   - [ ] **Duurzaamheid & Groei:** Natuurlijk groen (Forest Green `#107C41`, Emerald `#059669`)
   - [ ] **Energie & Innovatie:** Krachtig oranje/koraal (`#FF5722`) of paars/violet (`#7C3AED`)
   - [ ] **Prestige & Exclusiviteit:** Diep antraciet/zwart gecombineerd met warm goud (`#D4AF37`)

2. **Kies je 4 Brand Tokens voor `site.config.php`:**
   - **`brand.primary` (30%):** Hoofdkleur voor knoppen en actieve elementen (bv. `#2060E0`)
     → `HEX:` `#____________`
   - **`brand.accent` (10%):** Accentkleur voor pills, glow en gradient-start (bv. `#00D0F0`)
     → `HEX:` `#____________`
   - **`brand.surface`:** Diepe contrastkleur voor koppen en hero achtergrond (bv. `#0F2A66`)
     → `HEX:` `#____________`
   - **`brand.highlight`:** Subtiele highlightkleur voor badges en sterren (bv. `#FFCC00`)
     → `HEX:` `#____________`

3. **Welke themastand heeft de voorkeur?**
   - [ ] **Light Mode met Dark Hero:** Schone, lichte pagina's met een premium donkere header (Aanbevolen).
   - [ ] **Full Light:** Fris, minimalistisch, overal wit/lichtgrijze achtergronden.
   - [ ] **Full Dark Mode:** High-tech, modern SaaS gevoel, overal donkerblauw/zwart.
   - [ ] **Beide:** Dynamische Theme Switcher actief in het menu (standaard ingebouwd).

---

## ✍️ Deel 3: Typografie & Vormtaal

1. **Welk type lettertype past bij de uitstraling?**
   - [ ] **Modern Tech / Sans-serif:** (bv. Kentledge, Inter, SF Pro, Roboto) — Strak, functioneel, modern.
   - [ ] **Humanistisch / Vriendelijk:** (bv. Plus Jakarta Sans, DM Sans) — Warm, open en benaderbaar.
   - [ ] **Klassiek & Gezaghebbend:** (bv. Playfair Display voor koppen, sans-serif voor broodtekst) — Exclusief, juridisch/financieel.

2. **Vormgeving van knoppen en cards:**
   - [ ] **Zacht & Modern (Aanbevolen):** Afgeronde hoeken (`12px-16px`), subtiele schaduwen, translucent glassmorphism effect bij scrollen.
   - [ ] **Pill & Speels:** Volledig ronde pill-knoppen (`9999px`) en ronde badges.
   - [ ] **Strak & Corporate:** Minimale afronding (`4px-6px`), scherp gelijnde borders en platte vlakken.

---

## 🧭 Deel 4: Menustructuur & Modules

Welke functionaliteiten moeten actief zijn in [`site.config.php`](./site.config.php)?

| Module | Functie | Inschakelen? |
| :--- | :--- | :--- |
| **`modules.diensten`** | Overzicht van diensten + detailpagina's met pricing-cards & FAQ | [ ] Ja  [ ] Nee |
| **`modules.team`** | Medewerkersoverzicht + consultant profielen met automatische vCard | [ ] Ja  [ ] Nee |
| **`modules.kennisbank`** | Kennisbank/blog met categorieën, zoekfilter en automatische TOC | [ ] Ja  [ ] Nee |
| **`modules.legal`** | Algemene voorwaarden (met sticky TOC + PDF knop) & Privacybeleid | [ ] Ja  [ ] Nee |
| **`modules.cookies`** | AVG/GDPR cookie banner met instellingenmodal | [ ] Ja  [ ] Nee |

**Wat zijn de gewenste menu-items in het hoofdmenu (`content/navigation.md`)?**
1. `Home`
2. `Diensten` (met eventueel dropdown sub-items)
3. `Over Ons`
4. `Kennisbank / Inzichten`
5. `Contact`
6. *Overig:* ________________________

---

## 🎯 Deel 5: Conversiedoel & Primaire Call to Action (CTA)

Wat is de **belangrijkste actie** die een bezoeker moet ondernemen op de website?

- [ ] **Direct telefonisch bellen of WhatsAppen:** (Bovenaan prominent telefoonnummer)
- [ ] **Online afspraak inplannen:** (Koppeling met Microsoft Bookings, Calendly of HubSpot)
- [ ] **Contactformulier / Offerte-aanvraag:** (Eenvoudig formulier of e-mailknop)
- [ ] **Download / Scan uitvoeren:** (Whitepaper, checklist of interactieve assessment)

**Tekst op de primaire actieknop:**
> *Voorbeelden: "Plan een kennismaking", "Vraag een offerte aan", "Bel direct", "Boek een adviesgesprek"*
- Jouw knoptekst: ________________________
- Bestemming (URL of tel/mailto): ________________________

---

## 🌟 Deel 6: Social Proof & Vertrouwen

Welke elementen zijn beschikbaar om autoriteit en vertrouwen te versterken?

- [ ] **Logo's van klanten / referenties:** *(Plaats SVG of PNG logo's in `assets/referenties/`)*
- [ ] **Quotes / Testimonials van tevreden klanten**
- [ ] **Echte foto's van het team / consultants:** *(Cruciaal voor conversie en betrouwbaarheid)*
- [ ] **Certificeringen & Partnerschappen:** *(bv. Microsoft Partner, ISO, Branchevereniging)*
- [ ] **Feiten & Cijfers:** *(bv. 15+ jaar ervaring, 250+ projecten afgerond, 98% klanttevredenheid)*

---

## 🚀 Volgende Stap

Zodra deze vragenlijst is ingevuld:
1. Open [`site.config.php`](./site.config.php) en vul de antwoorden uit **Deel 1** en **Deel 2** in.
2. Bewerk [`content/navigation.md`](./content/navigation.md) en [`content/footer.md`](./content/footer.md) met de keuzes uit **Deel 4**.
3. Plaats eventuele logo's en foto's in `assets/logos/` en `assets/images/`.
4. Pas de teksten aan in `content/pages/home.md` en start direct!
