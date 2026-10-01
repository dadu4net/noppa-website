---
title: Welkom bij de Noppa Solutions & Consultants Kennisbank
beschrijving: Een eerste blik op de kennisbank — wat je hier vindt, hoe je een nieuw artikel toevoegt en waarom we deze plek bouwen.
datum: 2026-05-25
categorie: Aankondiging
auteur: Kees Koertshuis
leestijd: 3 min
---

# Welkom bij de Noppa Solutions & Consultants Kennisbank

De kennisbank is onze plek voor **praktische gidsen, how-to's en diepgaande analyses** — geschreven vanuit echte projecten die we bij klanten uitvoeren.

Geen marketingverhalen, geen herhaalde whitepapers. Wel uitleg over wat we tegenkomen, wat werkt en wat niet.

## Wat je hier gaat vinden

In deze kennisbank publiceren we artikelen over de onderwerpen waar we dagelijks mee bezig zijn:

- **Microsoft 365 & Copilot** — implementatie, adoptie, governance
- **Power Platform** — Power Apps, Power Automate, Dataverse
- **SharePoint & intranetten** — bouw, beheer en informatie-architectuur
- **Adoptie & verandermanagement** — niet de techniek, maar de mensen
- **Workshops & trainingen** — wat we onderwijzen en hoe we dat doen

Elk artikel heeft een categorie, een geschatte leestijd en een auteur. Filteren op categorie kan via de balk bovenaan het overzicht.

## Hoe nieuwe artikelen erbij komen

Een artikel toevoegen is simpel — we werken met Markdown-bestanden in de map `content/artikelen/`. Elk bestand begint met **frontmatter** waarin de metadata staat:

```markdown
---
title: De titel van je artikel
beschrijving: Een korte intro van één of twee zinnen.
datum: 2026-05-25
categorie: How-to
auteur: Rik Dobbelsteen
leestijd: 5 min
---

# Hier begint je artikel

En vanaf hier schrijf je gewoon in Markdown.
```

De bestandsnaam (zonder `.md`) is meteen de URL-slug. Een bestand `copilot-uitrollen.md` wordt dus bereikbaar via `/kennisbank/#/artikel/copilot-uitrollen`.

### Status: concept

Wil je iets schrijven maar nog niet publiceren? Zet dan `status: concept` in de frontmatter. Het artikel verschijnt dan niet in het overzicht en niet in de RSS-feed.

## Auteurs gekoppeld aan teamprofielen

De auteur-widget onder elk artikel haalt automatisch de gegevens op van het [teamprofiel](../team/rik-dobbelsteen.html). Zo zie je naast elk artikel:

- Een foto (of initialen als er geen foto is)
- De naam en functie zoals op het teamprofiel
- Een korte bio
- Sociale links en een doorklik naar het volledige profiel

> Voorwaarde: de naam in de frontmatter moet exact overeenkomen met de bestandsnaam van het teamprofiel. **Rik Dobbelsteen** koppelt aan `team/rik-dobbelsteen.html`.

## Abonneren via RSS

Wil je niets missen? Abonneer je via de [RSS-feed](rss.php). Werkt in elke moderne RSS-lezer zoals Feedly, Inoreader of NetNewsWire.

## Delen mag

Onderaan elk artikel staat een deel-balk: LinkedIn, X, Instagram, Discord en een knop om de link te kopiëren. Vind je een artikel nuttig? Deel het gerust — zo bereikt de kennis meer mensen.

---

Veel leesplezier. En heb je een onderwerp waar je graag een artikel over zou zien? Stuur het ons via [hallo@noppa.nl](mailto:hallo@noppa.nl).
