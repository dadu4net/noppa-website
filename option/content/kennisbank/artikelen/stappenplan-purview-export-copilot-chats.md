---
title: "Exporteer Copilot chats"
description: "Copilot-chatinteracties veiligstellen bij een tenantmigratie, overname of tenantconsolidatie.."
canonical: "https://noppa.nl/exporteer-copilot-chats"
datum: 2026-10-23
categorie: "Microsoft Copilot"
auteur: "Rik Dobbelsteen"
leestijd: "15 min"
---

<!-- section: intro type="content" bg="surface" kicker="Overzicht & Actualiteit" title="AI binnen de Digitale Werkplek" desc="Wat organisaties moeten weten over kansen, grenzen en randvoorwaarden van Microsoft Copilot." -->

# Stappenplan Purview-export van Copilot-chats

## Doel

Copilot-chatinteracties veiligstellen bij een tenantmigratie, overname of tenantconsolidatie. De export dient als archief of als bron voor een kennisbank in de doeltenant. De oorspronkelijke Copilot-chatthreads kunnen hiermee niet als actieve gesprekken in de nieuwe tenant worden hersteld.

---

## Fase 1. Voorbereiding

### Stap 1. Controleer licenties en rollen

Zorg dat de uitvoerende beheerder toegang heeft tot:

- Microsoft Purview
- eDiscovery Standard of Premium
- De rol Compliance Administrator of eDiscovery Manager

### Stap 2. Controleer retentie

Controleer of de relevante Copilot-interacties nog binnen de ingestelde bewaartermijnen vallen.

Navigatie:

```text
Microsoft Purview
├── Data Lifecycle Management
│   └── Retention Policies
└── Information Governance
```

Controlepunten:

- Welke bewaartermijn geldt voor Copilot-interacties?
- Zijn alle te migreren gebruikers opgenomen?
- Zijn er bewaarbeleidsregels of holds die de export beïnvloeden?

---

## Fase 2. Copilot-interacties zoeken

### Stap 3. Open Microsoft Purview

Open het Microsoft Purview-portaal en ga naar:

```text
Solutions
└── eDiscovery
    └── Content Search
```

Portaal: [Microsoft Purview](https://purview.microsoft.com)

### Stap 4. Maak een nieuwe zoekopdracht

Gebruik een herkenbare naam, bijvoorbeeld:

```text
Copilot Export Tenant Migration
```

Leg minimaal vast:

- Doel van de export
- Bron- en doeltenant
- Scope van gebruikers
- Gewenste periode
- Eigenaar van de export

### Stap 5. Selecteer de gegevenslocaties

Selecteer de locaties waarin de Copilot-interacties volgens de configuratie van de tenant beschikbaar zijn. Begin met de relevante Exchange-mailboxen van de gebruikers binnen de migratiescope.

Controleer vooraf met een kleine testgroep of de verwachte Copilot-interacties worden gevonden.

---

## Fase 3. Zoekscope en filters instellen

### Stap 6. Selecteer gebruikers

Voor één gebruiker:

```text
user@bedrijf.nl
```

Voor meerdere gebruikers:

- Selecteer de mailboxen afzonderlijk; of
- Gebruik een vooraf vastgestelde migratielijst als werklijst.

> Gebruik een groep alleen wanneer Purview deze in de gekozen zoekinterface en configuratie correct kan verwerken. Valideer dit altijd met een voorbeeldzoekopdracht.

### Stap 7. Stel de zoekperiode in

Beperk de zoekopdracht indien nodig tot de periode die moet worden gearchiveerd.

Voorbeeldregistratie:

```text
Begindatum: JJJJ-MM-DD
Einddatum: JJJJ-MM-DD
```

### Stap 8. Filter op Copilot-interacties

Gebruik in de Purview-interface het beschikbare contenttype of filter voor Copilot-interacties. Controleer de ondersteunde zoekvelden en voorwaarden in de actuele tenantinterface voordat je een KQL-query toepast.

Voer eerst een beperkte test uit met:

- Eén gebruiker
- Een korte, bekende periode
- Een bekende Copilot-interactie

Leg de werkende zoekconfiguratie vast voor hergebruik bij de volledige export.

---

## Fase 4. Zoekresultaten controleren

### Stap 9. Start de zoekopdracht

Voer de zoekopdracht uit en wacht totdat Purview de resultaten beschikbaar heeft gemaakt.

### Stap 10. Bekijk de preview

Controleer of de resultaten de verwachte informatie bevatten, zoals:

- Prompt of gebruikersinvoer
- Copilot-antwoord
- Datum en tijd
- Gebruiker
- Beschikbare conversatie- of itemmetadata

### Stap 11. Voer een volledigheidscontrole uit

Controleer minimaal:

- Of alle gebruikers uit de migratiescope resultaten hebben
- Of de gewenste periode volledig wordt geraakt
- Of prompts én antwoorden aanwezig zijn
- Of er gebruikers zonder resultaten zijn
- Of retentie, holds of licenties afwijkingen veroorzaken

Leg uitzonderingen vast in een migratielogboek.

---

## Fase 5. Export uitvoeren

### Stap 12. Start de export

Open de afgeronde zoekopdracht en kies de beschikbare exportoptie in Purview.

Exporteer waar mogelijk:

- De gevonden content
- Het resultatenrapport
- Beschikbare metadata
- Het manifest of exportoverzicht

### Stap 13. Kies het exportformaat

Kies het formaat dat past bij het vervolgdoel:

- **Native bestanden:** geschikt voor verdere verwerking en archivering
- **Rapportage/CSV:** geschikt voor controle, inventarisatie en metadata
- **PST:** alleen wanneer de exportinterface en het gekozen scenario dit formaat aanbieden en dit praktisch nodig is

### Stap 14. Download het exportpakket

Sla het exportpakket op in een beveiligde projectlocatie met beperkte toegang.

Mogelijke structuur:

```text
Export/
├── Content/
├── Reports/
├── Results.csv
├── Manifest.xml
└── Export-log.md
```

### Stap 15. Valideer het exportpakket

Controleer:

- Aantal gebruikers in scope
- Aanwezigheid van content en metadata
- Ontbrekende of beschadigde bestanden
- Afwijkingen tussen preview en export
- Toegangsbeveiliging van de exportlocatie

Maak waar mogelijk een hash of controlebestand voor integriteitscontrole.

---

## Fase 6. Export structureren als kennisarchief

### Stap 16. Bepaal de doelstructuur

Aanbevolen structuur:

```text
copilot-history/
├── gebruiker-01/
│   ├── 2026-01-15-chat-001.md
│   └── 2026-01-22-chat-002.md
├── gebruiker-02/
├── metadata/
│   └── index.csv
└── index.md
```

### Stap 17. Converteer relevante gesprekken naar Markdown

Gebruik per gesprek een vaste opbouw:

```markdown
# Copilot-gesprek

## Metadata

- Datum: 2026-02-15
- Gebruiker: user@bedrijf.nl
- Brontenant: tenant-a.onmicrosoft.com
- Classificatie: intern
- Migratiestatus: gearchiveerd

## Prompt

Maak een implementatieplan voor Teams-governance.

## Antwoord

[Geëxporteerd Copilot-antwoord]
```

### Stap 18. Verwijder of bescherm gevoelige informatie

Controleer vóór herpublicatie:

- Persoonsgegevens
- Klantgegevens
- Vertrouwelijke projectinformatie
- Geheimen, tokens en wachtwoorden
- Informatie die niet naar de doeltenant mag worden overgebracht

Pas waar nodig classificatie, toegangsbeperkingen of verwijdering toe.

---

## Fase 7. Beschikbaar maken in de doeltenant

### Stap 19. Maak een SharePoint-kennisbibliotheek

Voorbeeld:

```text
SharePoint
└── AI Knowledge Base
    └── Copilot Chat Archive
```

Aanbevolen metadata:

| Kolom          | Voorbeeldwaarde          |
| -------------- | ------------------------ |
| Type           | Copilot Chat             |
| Eigenaar       | user@bedrijf.nl          |
| Gespreksdatum  | 2026-02-15               |
| Brontenant     | tenant-a.onmicrosoft.com |
| Migratiestatus | Gearchiveerd             |
| Classificatie  | Intern                   |
| Onderwerp      | Teams-governance         |

### Stap 20. Upload de gecontroleerde bestanden

Upload alleen bestanden die:

- Zijn gevalideerd
- Binnen de afgesproken migratiescope vallen
- De juiste classificatie hebben
- Geen ongewenste gevoelige informatie bevatten

### Stap 21. Richt toegang en governance in

Configureer:

- Site- en bibliotheekmachtigingen
- Sensitivity labels
- Retentie in de doeltenant
- Versiebeheer
- Audit en toegangscontrole
- Eigenaarschap van de kennisbank

### Stap 22. Gebruik de kennisbank als bron

Koppel de gecontroleerde SharePoint-inhoud indien gewenst als kennisbron aan een Copilot-agent. Behandel dit als een nieuw kennisarchief, niet als herstel van de oorspronkelijke persoonlijke Copilot-chatgeschiedenis.

---

## Fase 8. Afronding en controle

### Stap 23. Voer een steekproef uit

Controleer per migratiebatch:

- Minimaal enkele gebruikers
- Verschillende datums
- Meerdere gesprekstypen
- Volledigheid van prompt en antwoord
- Correcte metadata en toegangsrechten

### Stap 24. Laat de export formeel accepteren

Leg vast:

- Welke gebruikers zijn verwerkt
- Welke periode is geëxporteerd
- Welke uitzonderingen bestaan
- Waar het archief is opgeslagen
- Wie eigenaar is in de doeltenant
- Wanneer de bronexport mag worden verwijderd

### Stap 25. Rond de brondata gecontroleerd af

Verwijder bronexports pas nadat:

- De doelomgeving is gevalideerd
- De business- of data-eigenaar akkoord heeft gegeven
- Juridische en complianceverplichtingen zijn gecontroleerd
- De bewaartermijn voor het migratiearchief is vastgesteld

---

## Belangrijke beperking

Deze werkwijze archiveert Copilot-interacties en maakt ze opnieuw raadpleegbaar als bestanden of kennisbron. De oorspronkelijke persoonlijke Copilot-chatthreads worden hiermee niet als actieve gesprekken in de doeltenant teruggeplaatst.

## Aanbevolen eindresultaten

- Gevalideerd Purview-exportpakket
- Resultatenrapport en migratielogboek
- Gestructureerd Markdown-archief
- SharePoint-kennisbibliotheek met metadata
- Rechten- en classificatiemodel
- Acceptatie- en uitzonderingenrapport
