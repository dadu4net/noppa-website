---
title: Gestyled overzicht van al je Copilot Cowork sessies
beschrijving: Een praktische handleiding van Buro GEKKO
datum: 2026-06-02
categorie: Adoptie
auteur: Rik Dobbelsteen
leestijd: 10 min
---

# Zo bouw je in één prompt een gestyled overzicht van al je Copilot Cowork sessies

*Een praktische handleiding van Buro GEKKO — Microsoft 365 & Copilot adoptie*

## Waarom je dit wilt

Microsoft Copilot Cowork bewaart per sessie keurig je bestanden in OneDrive — maar **synchroniseert lang niet alles** wat je in de chat ziet. Wat wél meekomt:

- de unieke **sessie-GUID** (de cryptische foldernaam, bijv. `617e0009-428a-4264-…`)
- de **bestanden** in `input/` (je uploads) en `output/` (je deliverables)
- de **wijzigingsdatum** van die bestanden

Wat **niet** meekomt:

- de chat-titel die je in Copilot zag
- de prompt of opdracht die je hebt uitgesproken
- het verloop van de conversatie

Het gevolg: open je OneDrive-map met sessies, dan zie je een eindeloze lijst onleesbare GUID-folders zonder context. Onbruikbaar als naslagwerk en onmogelijk om met collega's te delen.

**De oplossing:** één gestyled HTML-overzicht dat per sessie de waarschijnlijke titel én opdracht reconstrueert uit de bestandsnamen, met klikbare links naar de juiste OneDrive-folder. Te delen via Teams of SharePoint, doorzoekbaar, en in je eigen huisstijl.

---

## Wat je nodig hebt

| Vereiste | Toelichting |
|----------|-------------|
| **Copilot Cowork** | Met toegang tot je OneDrive-bestanden |
| **OneDrive-map met sessies** | Standaard onder `/Documents/Cowork/sessions/` |
| **Je huisstijl (optioneel)** | Kleuren, font, en bij voorkeur een design guide als naslag |

Geen code, geen plug-ins, geen Power Automate. Alles gebeurt via één gesprek met Copilot.

---

## De aanpak in 5 stappen

### Stap 1 — Geef de basisprompt

Begin met een heldere opdracht. Vertel Copilot **wat** je wilt, **waarvan** en in **welke vorm**:

> *"Maak een overzicht van alle cowork sessies met naam/titel, opdracht en GUID, plaats deze in een HTML-bestand met onze huisstijl."*

### Stap 2 — Wijs de bron aan

Vertel waar de sessies staan, zodat Copilot de juiste map inventariseert:

> *Bron: OneDrive → `/Documents/Cowork/sessions/`*

Copilot haalt dan alle submappen (de GUID's) op en telt per sessie de bestanden in `output/` — of in `input/` als er nog geen output is.

### Stap 3 — Pas je huisstijl toe

Geef je merkkleuren, font en — als je het hebt — je design guide mee. Voorbeeld voor Buro GEKKO:

> *Huisstijl: geel `#F2B82C` / antraciet `#18222B`, Montserrat. Gebruik onze `burogekko-design-guide.md` als referentie.*

Hoe concreter je de tokens benoemt, hoe scherper het resultaat. Heb je een design guide in OneDrive? Verwijs er expliciet naar — Copilot leest 'm uit voor exacte kleuren en typografie.

### Stap 4 — Maak de GUID's klikbaar

Een GUID alleen is dood. Vraag om hyperlinks die rechtstreeks naar de sessiefolder springen:

> *"Maak de GUID's klikbare hyperlinks naar de bijbehorende OneDrive-folder."*

Elke GUID-pill linkt dan naar:
`https://{tenant}-my.sharepoint.com/personal/{gebruiker}/Documents/Documents/Cowork/sessions/{guid}/`

### Stap 5 — Houd het actueel

Het overzicht is een snapshot. Voor een verse versie volstaat:

> *"Werk het cowork-sessies overzicht bij."*

Copilot vergelijkt de huidige OneDrive-staat met het bestaande bestand, voegt nieuwe sessies toe (alfabetisch op GUID), hernummert de rijen en werkt de statistieken en datum bij.

---

## De kopieer-klare prompt

```text
Maak een overzicht van alle cowork sessies met naam/titel, opdracht en GUID,
plaats deze in een HTML-bestand met de Buro GEKKO huisstijl.
Bron: OneDrive → /Documents/Cowork/sessions/.
Huisstijl: geel #F2B82C, antraciet #18222B, Montserrat — gebruik onze design guide als referentie.
Maak de GUID's klikbare hyperlinks naar de OneDrive-folder.
```

Voor een ander type overzicht (zelfde recept, andere inhoud):

```text
Bouw een overzicht van [onderwerp] in HTML met de Buro GEKKO huisstijl
(geel #F2B82C, antraciet #18222B, Montserrat).
Gebruik onze design guide als referentie.
```

---

## Wat Copilot onder water doet

1. **Inventarisatie** — alle submappen onder `/Documents/Cowork/sessions/` ophalen (de GUID's).
2. **Bestandsenumeratie** — per sessie het aantal en de namen van bestanden in `output/` (of `input/`) parallel opvragen.
3. **Titel-afleiding** — uit de dominante bestandsnaam een kort, herkenbaar onderwerp destilleren — bijv. `Hollandia-Copilot-Basis-Workshop.pptx` → *"Hollandia — Copilot Basis Workshop"*.
4. **Brand-asset ophalen** — de design guide uit OneDrive lezen voor exacte kleurtokens en typografie.
5. **HTML-template bouwen** — één zelfstandig bestand met embedded CSS-variabelen, responsive tabel en JavaScript voor live filter + hyperlinks.
6. **Bijwerken** — bij een refresh stap 1–2 herhalen, vergelijken met de vorige versie, nieuwe rijen invoegen en stats aanpassen.

---

## Hoe het eindresultaat eruitziet

Eén zelfstandig HTML-document — geen externe afhankelijkheden behalve een Google-font import. Opbouw:

| Sectie | Inhoud |
|--------|--------|
| **Hero** | Donkere gradient met geel accent, titel + introtekst |
| **Stats** | 4 KPI-cards: totaal aantal, met output, alleen input, periode |
| **Toolbar** | Live zoekfilter op titel / opdracht / GUID |
| **Tabel** | Eén rij per sessie: #, titel + bestand, opdracht, GUID, datum, aantal bestanden |
| **Toelichting** | Uitleg over de afgeleide titels |
| **Footer** | Je eigen branding |

**Interactie:**
- Het **zoekveld** filtert real-time op alle tekstkolommen.
- Elke **GUID-pill** opent de OneDrive-folder in een nieuw tabblad.
- **Hover** geeft een gele accentkleur op rijen en pills.
- **Responsive** — onder 900px klapt de tabel naar kaartweergave.

---

## Beperkingen — waar je rekening mee houdt

- **Titels zijn interpretaties.** Copilot leidt ze af uit bestandsnamen; het is niet 1-op-1 de oorspronkelijke chat-titel.
- **Sessies met alleen `input/`** zijn nog niet (terug)gesynchroniseerd of afgebroken. Markeer ze herkenbaar, bijv. met de subtitel *"(input)"*.
- **GUID-links werken alleen voor wie toegang heeft** tot de betreffende OneDrive. Het is geen publiek deelbaar bestand zonder dat je rechten verleent.
- **Geen automatische update.** Dit is een snapshot. Wil je een live dashboard, dan heb je een Power Automate-flow + SharePoint-lijst nodig.

---

## Tips om het je eigen te maken

- **Hernoem je deliverables consistent.** Hoe duidelijker je bestandsnamen, hoe scherper de afgeleide titels. `Klantnaam-Type-Onderwerp.ext` werkt uitstekend.
- **Leg je design guide in OneDrive.** Eén keer goed vastleggen betekent dat élk toekomstig overzicht automatisch in de huisstijl komt.
- **Maak er een vaste routine van.** Werk het overzicht bij na elke nieuwe batch sessies — één zin is genoeg.
- **Hergebruik het recept.** Dezelfde aanpak werkt voor elk type overzicht: projecten, documenten, klantdossiers. Verander alleen de bron en het onderwerp.

---

**Buro GEKKO B.V.** — Microsoft 365 & Copilot adoptie
[burogekko.nl](https://www.burogekko.nl/)
