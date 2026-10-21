# SharePoint CRM Systeemspecificatie & Datamodel

Dit document beschrijft de volledige opzet van een lichtgewicht, relationeel Customer Relationship Management (CRM) systeem binnen Microsoft SharePoint Online en Microsoft Lists. Dit document kan direct worden gebruikt als architectuur- en contextbron voor vervolgprompts (zoals Power Apps formulieren of Power Automate flows).

---

## 1. Datamodel & Entiteitsrelaties

Het datamodel bestaat uit vier relationele lijsten:

```
[ CRM_Organisaties ] (Accounts)
         ▲
         │ (1:N)
   ┌─────┴───────────────┐
   │                     │
[ CRM_Contacten ]   [ CRM_Deals ] (Opportunities)
   ▲                     ▲
   │ (1:N)               │ (1:N)
   └──────────┬──────────┘
              │
      [ CRM_Activiteiten ] (Interacties & Taken)
```

---

## 2. Lijstdefinities & Veldspecificaties

### Lijst 1: `CRM_Organisaties`
Centrale tabel voor bedrijven en organisaties.

| Veldnaam (Display) | Interne Naam | Veldtype | Waarden / Opties | Verplicht |
| :--- | :--- | :--- | :--- | :--- |
| Bedrijfsnaam | `Title` | Single line of text | Vrije invoer | Ja (Uniek) |
| KvK Nummer | `KvKNummer` | Single line of text | Max. 8 cijfers | Nee |
| Type Relatie | `TypeRelatie` | Choice | `Prospect`, `Klant`, `Partner`, `Leverancier`, `Oud-klant` | Ja |
| Sector | `Sector` | Choice | `Zakelijke Dienstverlening`, `IT/Tech`, `Bouw`, `Zorg`, `Industrie`, `Overheid`, `Overig` | Nee |
| Accountmanager | `Accountmanager` | Person or Group | Enkele selectie binnen organisatie | Nee |
| Website | `Website` | Hyperlink | Valide URL | Nee |
| Telefoon Algemeen | `TelefoonAlgemeen` | Single line of text | Telefoonnotatie | Nee |
| Bezoekadres | `BezoekAdres` | Multiple lines of text | Plain text adresblok | Nee |
| Factuur E-mail | `FactuurEmail` | Single line of text | E-mailadres formaat | Nee |
| Status | `Status` | Choice | `Actief`, `Inactief`, `On hold` (Standaard: `Actief`) | Ja |

---

### Lijst 2: `CRM_Contacten`
Contactpersonen die horen bij een organisatie.

| Veldnaam (Display) | Interne Naam | Veldtype | Waarden / Opties | Verplicht |
| :--- | :--- | :--- | :--- | :--- |
| Volledige Naam | `Title` | Single line of text | Automatisch of handmatig samengesteld | Ja |
| Voornaam | `Voornaam` | Single line of text | Voornaam | Nee |
| Achternaam | `Achternaam` | Single line of text | Achternaam | Ja |
| Organisatie | `OrganisatieLookup` | Lookup | Bron: `CRM_Organisaties` -> `Title` | Ja |
| Functie | `Functie` | Single line of text | Beroep/rol | Nee |
| E-mail | `Email` | Single line of text | Valide e-mailadres | Ja |
| Mobiel | `Mobiel` | Single line of text | Telefoonnotatie | Nee |
| Beslisser Status | `BeslisserStatus` | Choice | `Eindbeslisser`, `Beinvloeder`, `Gebruiker`, `Inkoop` | Nee |
| Nieuwsbrief Opt-In | `NieuwsbriefOptIn` | Yes/No | Boolean (Standaard: `No`) | Ja |
| Status | `Status` | Choice | `Actief`, `Uit dienst` (Standaard: `Actief`) | Ja |

---

### Lijst 3: `CRM_Deals`
Verkoopkansen en pijplijnbeheer.

| Veldnaam (Display) | Interne Naam | Veldtype | Waarden / Opties | Verplicht |
| :--- | :--- | :--- | :--- | :--- |
| Dealnaam | `Title` | Single line of text | Omschrijving van het project/traject | Ja |
| Organisatie | `OrganisatieLookup` | Lookup | Bron: `CRM_Organisaties` -> `Title` | Ja |
| Primair Contact | `PrimairContact` | Lookup | Bron: `CRM_Contacten` -> `Title` | Nee |
| Fase | `Fase` | Choice | `Lead`, `Kwalificatie`, `Voorstel`, `Onderhandeling`, `Gewonnen`, `Verloren` | Ja |
| Geschatte Waarde | `GeschatteWaarde` | Currency | EUR (€) | Nee |
| Slagingskans (%) | `Slagingskans` | Number | Percentage (0 - 100) | Nee |
| Verwachte Sluitingsdatum | `VerwachteSluiting` | Date only | Datumveld | Nee |
| Eigenaar Deal | `EigenaarDeal` | Person or Group | Enkele selectie | Ja |
| Verliesreden | `VerliesReden` | Choice | `Prijs`, `Concurrentie`, `Geen budget`, `Geen gehoor`, `Overig` | Alleen bij `Verloren` |
| Dossier Link | `DossierLink` | Hyperlink | URL naar bijbehorende SharePoint map | Nee |

---

### Lijst 4: `CRM_Activiteiten`
Tijdlijn van interacties en openstaande follow-up taken.

| Veldnaam (Display) | Interne Naam | Veldtype | Waarden / Opties | Verplicht |
| :--- | :--- | :--- | :--- | :--- |
| Onderwerp | `Title` | Single line of text | Korte samenvatting actie | Ja |
| Type Activiteit | `TypeActiviteit` | Choice | `Telefoongesprek`, `Vergadering`, `E-mail`, `Notitie`, `Taak` | Ja |
| Datum en Tijd | `DatumTijd` | Date and Time | Tijdstip contact/notitie | Ja |
| Organisatie | `OrganisatieLookup` | Lookup | Bron: `CRM_Organisaties` -> `Title` | Ja |
| Contactpersoon | `ContactLookup` | Lookup | Bron: `CRM_Contacten` -> `Title` | Nee |
| Gekoppelde Deal | `DealLookup` | Lookup | Bron: `CRM_Deals` -> `Title` | Nee |
| Beschrijving | `Beschrijving` | Multiple lines of text | Gespreksverslag of toelichting | Nee |
| Status Taak | `StatusTaak` | Choice | `Niet gestart`, `In behandeling`, `Voltooid` | Ja |
| Deadline Taak | `DeadlineTaak` | Date only | Vervaldatum actiepunt | Nee |
| Toegewezen Aan | `ToegewezenAan` | Person or Group | Verantwoordelijke medewerker | Nee |

---

## 3. Aanbevolen Views & Inrichting

1. **Pipeline Kanban View:**
   * Lijst: `CRM_Deals`
   * Type weergave: **Board** gegroepeerd op de kolom `Fase`.
2. **Mijn Open Taken:**
   * Lijst: `CRM_Activiteiten`
   * Filter: `Toegewezen Aan = [Me]` EN `Status Taak != Voltooid`.
   * Sortering: `Deadline Taak` oplopend.
3. **Klant 360-Pagina:**
   * SharePoint sitepagina met gekoppelde List Webparts waarin de selectie van een organisatie de gefilterde deals en contacten toont.

---

## 4. Kernprocessen (Power Automate)

* **Accountpromotie:** Wanneer `CRM_Deals.Fase` wijzigt naar `Gewonnen`, zet een cloud flow `CRM_Organisaties.TypeRelatie` automatisch om naar `Klant`.
* **Notificaties:** Teams webhook notificatie naar het verkoopkanaal wanneer een deal wordt gewonnen.
* **Opvolgherinneringen:** Dagelijkse geplande flow die verlooptaken uit `CRM_Activiteiten` bundelt en per e-mail of Teams Adaptive Card naar de eigenaar stuurt.


# CRM site

**Site Type:** Team

**Description:** Een gezamenlijke CRM-werkruimte voor accountmanagement en klantenservice, met organisaties, contacten, deals en activiteiten.

## Pages

### Home
**Title:** Home

**Purpose:** Biedt een centraal startpunt voor accountmanagement en klantenservice. De pagina brengt open deals, aankomende activiteiten en snelle toegang tot CRM-gegevens samen.

**User requested behavior:** Gebruik een professionele en overzichtelijke toon. Richt de inhoud op accountmanagement en klantenservice.

**Description:** Een professionele startpagina met een helder overzicht van de CRM-werkruimte. Gebruikers vinden de belangrijkste werklijsten, actuele aandachtspunten, open deals en aankomende activiteiten.

**Tone:** Professional

### Klant 360-Pagina
**Title:** Klant 360-Pagina

**Purpose:** Geeft medewerkers een samenhangend klantbeeld voor één organisatie. De pagina helpt hen snel relevante contactpersonen, deals en activiteiten te vinden.

**User requested behavior:** Gebruik een professionele, overzichtelijke toon. Neem organisaties, contacten, deals en activiteiten als kernonderwerpen op. De gewenste gekoppelde lijstinteractie kan later handmatig worden ingericht.

**Description:** Een klantgerichte informatiepagina voor accountmanagement en klantenservice. De pagina ondersteunt het raadplegen van relevante klantgegevens rond een organisatie, waaronder contacten, deals en activiteiten.

**Tone:** Professional

## Lists

### CRM_Organisaties
Description: Beheer bedrijven, organisaties en klantrelaties.

Title column display name: Bedrijfsnaam

Columns:
- KvK Nummer (InternalName: KvKNummer, Type: Text)
- Type Relatie (InternalName: TypeRelatie, Type: Choice, Required: Yes, Choices: Prospect, Klant, Partner, Leverancier, Oud-klant)
- Sector (InternalName: Sector, Type: Choice, Choices: Zakelijke Dienstverlening, IT/Tech, Bouw, Zorg, Industrie, Overheid, Overig)
- Accountmanager (InternalName: Accountmanager, Type: User)
- Website (InternalName: Website, Type: URL)
- Telefoon Algemeen (InternalName: TelefoonAlgemeen, Type: Text)
- Bezoekadres (InternalName: BezoekAdres, Type: Note)
- Factuur E-mail (InternalName: FactuurEmail, Type: Text)
- Status (InternalName: Status, Type: Choice, Required: Yes, Choices: Actief, Inactief, On hold)

Views:
- Actieve organisaties — gefilterd op Status = Actief (default)
- Mijn organisaties — gefilterd op Accountmanager = huidige gebruiker
- All Items — alle organisaties en alle kolommen
- Per type relatie — gegroepeerd op Type Relatie
- Per sector — gegroepeerd op Sector

Sample Data (5 items):
- Sample Noordwind Advies | KvK Nummer: 12345678 | Type Relatie: Klant | Sector: Zakelijke Dienstverlening | Accountmanager: [CurrentUser] | Website: https://www.noordwindadvies.example | Telefoon Algemeen: 010-1234567 | Bezoekadres: Havenstraat 10, 3011 AA Rotterdam | Factuur E-mail: facturen@noordwindadvies.example | Status: Actief
- Sample Delta Tech | KvK Nummer: 23456789 | Type Relatie: Prospect | Sector: IT/Tech | Accountmanager: [CurrentUser] | Website: https://www.deltatech.example | Telefoon Algemeen: 020-2345678 | Bezoekadres: Stationsplein 25, 1012 AB Amsterdam | Factuur E-mail: finance@deltatech.example | Status: Actief
- Sample Bouwgroep Rijn | KvK Nummer: 34567890 | Type Relatie: Partner | Sector: Bouw | Accountmanager: [CurrentUser] | Website: https://www.bouwgroeprijn.example | Telefoon Algemeen: 030-3456789 | Bezoekadres: Rijnkade 18, 3511 CC Utrecht | Factuur E-mail: administratie@bouwgroeprijn.example | Status: Actief
- Sample Zorgpunt Nederland | KvK Nummer: 45678901 | Type Relatie: Klant | Sector: Zorg | Accountmanager: [CurrentUser] | Website: https://www.zorgpunt.example | Telefoon Algemeen: 070-4567890 | Bezoekadres: Parklaan 7, 2514 BD Den Haag | Factuur E-mail: factuur@zorgpunt.example | Status: Actief
- Sample Metaal Partners | KvK Nummer: 56789012 | Type Relatie: Oud-klant | Sector: Industrie | Accountmanager: [CurrentUser] | Website: https://www.metaalpartners.example | Telefoon Algemeen: 040-5678901 | Bezoekadres: Industrieweg 42, 5617 BC Eindhoven | Factuur E-mail: facturen@metaalpartners.example | Status: Inactief

### CRM_Contacten
Description: Beheer contactpersonen die aan organisaties zijn gekoppeld.

Title column display name: Volledige Naam

Columns:
- Voornaam (InternalName: Voornaam, Type: Text)
- Achternaam (InternalName: Achternaam, Type: Text, Required: Yes)
- Organisatie (InternalName: OrganisatieLookup, Type: Lookup → CRM_Organisaties, Required: Yes)
- Functie (InternalName: Functie, Type: Text)
- E-mail (InternalName: Email, Type: Text, Required: Yes)
- Mobiel (InternalName: Mobiel, Type: Text)
- Beslisser Status (InternalName: BeslisserStatus, Type: Choice, Choices: Eindbeslisser, Beinvloeder, Gebruiker, Inkoop)
- Nieuwsbrief Opt-In (InternalName: NieuwsbriefOptIn, Type: Boolean, Required: Yes)
- Status (InternalName: Status, Type: Choice, Required: Yes, Choices: Actief, Uit dienst)

Views:
- Actieve contacten — gefilterd op Status = Actief (default)
- Mijn contacten — gefilterd op Created By = huidige gebruiker
- All Items — alle contacten en alle kolommen
- Per organisatie — gegroepeerd op Organisatie
- Per beslisserstatus — gegroepeerd op Beslisser Status

Sample Data (5 items):
- Sample Anna de Vries | Voornaam: Anna | Achternaam: de Vries | Organisatie: Sample Noordwind Advies | Functie: Directeur | E-mail: anna.devries@noordwindadvies.example | Mobiel: 06-12345678 | Beslisser Status: Eindbeslisser | Nieuwsbrief Opt-In: Ja | Status: Actief
- Sample Bram Jansen | Voornaam: Bram | Achternaam: Jansen | Organisatie: Sample Delta Tech | Functie: IT-manager | E-mail: bram.jansen@deltatech.example | Mobiel: 06-23456789 | Beslisser Status: Beinvloeder | Nieuwsbrief Opt-In: Nee | Status: Actief
- Sample Chantal Smit | Voornaam: Chantal | Achternaam: Smit | Organisatie: Sample Bouwgroep Rijn | Functie: Inkoper | E-mail: chantal.smit@bouwgroeprijn.example | Mobiel: 06-34567890 | Beslisser Status: Inkoop | Nieuwsbrief Opt-In: Nee | Status: Actief
- Sample David Visser | Voornaam: David | Achternaam: Visser | Organisatie: Sample Zorgpunt Nederland | Functie: Teamleider | E-mail: david.visser@zorgpunt.example | Mobiel: 06-45678901 | Beslisser Status: Gebruiker | Nieuwsbrief Opt-In: Ja | Status: Actief
- Sample Eva Bakker | Voornaam: Eva | Achternaam: Bakker | Organisatie: Sample Metaal Partners | Functie: Controller | E-mail: eva.bakker@metaalpartners.example | Mobiel: 06-56789012 | Beslisser Status: Beinvloeder | Nieuwsbrief Opt-In: Nee | Status: Uit dienst

### CRM_Deals
Description: Beheer verkoopkansen, pijplijnfasen, waarde en sluitingsdatum.

Title column display name: Dealnaam

Columns:
- Organisatie (InternalName: OrganisatieLookup, Type: Lookup → CRM_Organisaties, Required: Yes)
- Primair Contact (InternalName: PrimairContact, Type: Lookup → CRM_Contacten)
- Fase (InternalName: Fase, Type: Choice, Required: Yes, Choices: Lead, Kwalificatie, Voorstel, Onderhandeling, Gewonnen, Verloren)
- Geschatte Waarde (InternalName: GeschatteWaarde, Type: Number)
- Slagingskans (%) (InternalName: Slagingskans, Type: Number)
- Verwachte Sluitingsdatum (InternalName: VerwachteSluiting, Type: DateTime)
- Eigenaar Deal (InternalName: EigenaarDeal, Type: User, Required: Yes)
- Verliesreden (InternalName: VerliesReden, Type: Choice, Choices: Prijs, Concurrentie, Geen budget, Geen gehoor, Overig)
- Dossier Link (InternalName: DossierLink, Type: URL)

Views:
- Open deals — gefilterd op Fase is niet Gewonnen of Verloren (default)
- Mijn deals — gefilterd op Eigenaar Deal = huidige gebruiker
- All Items — alle deals en alle kolommen
- Pipeline Kanban (Kanban) — gegroepeerd op Fase
- Sluitdatumkalender (Calendar, by VerwachteSluiting) — deals op verwachte sluitingsdatum
- Binnenkort sluiten — Verwachte Sluitingsdatum binnen de komende 30 dagen
- Per organisatie — gegroepeerd op Organisatie

Sample Data (5 items):
- Sample CRM-vernieuwing Noordwind | Organisatie: Sample Noordwind Advies | Primair Contact: Sample Anna de Vries | Fase: Voorstel | Geschatte Waarde: 45000 | Slagingskans (%): 60 | Verwachte Sluitingsdatum: 10/15/2026 | Eigenaar Deal: [CurrentUser] | Verliesreden: | Dossier Link: https://contoso.sharepoint.com/sites/crm/Shared%20Documents/Noordwind
- Sample Beveiligingsplatform Delta | Organisatie: Sample Delta Tech | Primair Contact: Sample Bram Jansen | Fase: Kwalificatie | Geschatte Waarde: 28000 | Slagingskans (%): 40 | Verwachte Sluitingsdatum: 10/30/2026 | Eigenaar Deal: [CurrentUser] | Verliesreden: | Dossier Link: https://contoso.sharepoint.com/sites/crm/Shared%20Documents/Delta
- Sample Onderhoudscontract Rijn | Organisatie: Sample Bouwgroep Rijn | Primair Contact: Sample Chantal Smit | Fase: Onderhandeling | Geschatte Waarde: 75000 | Slagingskans (%): 80 | Verwachte Sluitingsdatum: 10/08/2026 | Eigenaar Deal: [CurrentUser] | Verliesreden: | Dossier Link: https://contoso.sharepoint.com/sites/crm/Shared%20Documents/Rijn
- Sample Service-uitbreiding Zorgpunt | Organisatie: Sample Zorgpunt Nederland | Primair Contact: Sample David Visser | Fase: Lead | Geschatte Waarde: 18000 | Slagingskans (%): 20 | Verwachte Sluitingsdatum: 11/12/2026 | Eigenaar Deal: [CurrentUser] | Verliesreden: | Dossier Link: https://contoso.sharepoint.com/sites/crm/Shared%20Documents/Zorgpunt
- Sample Rapportageproject Metaal | Organisatie: Sample Metaal Partners | Primair Contact: Sample Eva Bakker | Fase: Verloren | Geschatte Waarde: 22000 | Slagingskans (%): 0 | Verwachte Sluitingsdatum: 09/18/2026 | Eigenaar Deal: [CurrentUser] | Verliesreden: Concurrentie | Dossier Link: https://contoso.sharepoint.com/sites/crm/Shared%20Documents/Metaal

### CRM_Activiteiten
Description: Leg klantinteracties vast en beheer openstaande follow-uptaken.

Title column display name: Onderwerp

Columns:
- Type Activiteit (InternalName: TypeActiviteit, Type: Choice, Required: Yes, Choices: Telefoongesprek, Vergadering, E-mail, Notitie, Taak)
- Datum en Tijd (InternalName: DatumTijd, Type: DateTime, Required: Yes)
- Organisatie (InternalName: OrganisatieLookup, Type: Lookup → CRM_Organisaties, Required: Yes)
- Contactpersoon (InternalName: ContactLookup, Type: Lookup → CRM_Contacten)
- Gekoppelde Deal (InternalName: DealLookup, Type: Lookup → CRM_Deals)
- Beschrijving (InternalName: Beschrijving, Type: Note)
- Status Taak (InternalName: StatusTaak, Type: Choice, Required: Yes, Choices: Niet gestart, In behandeling, Voltooid)
- Deadline Taak (InternalName: DeadlineTaak, Type: DateTime)
- Toegewezen Aan (InternalName: ToegewezenAan, Type: User)

Views:
- Open activiteiten — gefilterd op Status Taak is niet Voltooid (default)
- Mijn open taken — gefilterd op Toegewezen Aan = huidige gebruiker en Status Taak is niet Voltooid, gesorteerd op Deadline Taak oplopend
- All Items — alle activiteiten en alle kolommen
- Takenbord (Kanban) — gegroepeerd op Status Taak
- Activiteitenkalender (Calendar, by DatumTijd) — interacties op datum en tijd
- Deadlineskalender (Calendar, by DeadlineTaak) — taken op deadline
- Binnenkort verschuldigd — Deadline Taak binnen de komende 30 dagen
- Per type activiteit — gegroepeerd op Type Activiteit

Sample Data (5 items):
- Sample voorstel bespreken | Type Activiteit: Vergadering | Datum en Tijd: 09/25/2026 10:00 | Organisatie: Sample Noordwind Advies | Contactpersoon: Sample Anna de Vries | Gekoppelde Deal: Sample CRM-vernieuwing Noordwind | Beschrijving: Bespreek het voorstel en de gewenste implementatieplanning. | Status Taak: In behandeling | Deadline Taak: 09/26/2026 | Toegewezen Aan: [CurrentUser]
- Sample kwalificatiegesprek | Type Activiteit: Telefoongesprek | Datum en Tijd: 09/24/2026 14:30 | Organisatie: Sample Delta Tech | Contactpersoon: Sample Bram Jansen | Gekoppelde Deal: Sample Beveiligingsplatform Delta | Beschrijving: Verken budget, besluitvormers en planning voor het beveiligingsplatform. | Status Taak: Niet gestart | Deadline Taak: 09/24/2026 | Toegewezen Aan: [CurrentUser]
- Sample contractvoorwaarden afstemmen | Type Activiteit: E-mail | Datum en Tijd: 09/23/2026 15:15 | Organisatie: Sample Bouwgroep Rijn | Contactpersoon: Sample Chantal Smit | Gekoppelde Deal: Sample Onderhoudscontract Rijn | Beschrijving: Verstuur de bijgewerkte contractvoorwaarden ter controle. | Status Taak: In behandeling | Deadline Taak: 09/29/2026 | Toegewezen Aan: [CurrentUser]
- Sample klantbezoek voorbereiden | Type Activiteit: Taak | Datum en Tijd: 09/28/2026 09:00 | Organisatie: Sample Zorgpunt Nederland | Contactpersoon: Sample David Visser | Gekoppelde Deal: Sample Service-uitbreiding Zorgpunt | Beschrijving: Bereid agenda, demonstratie en gesprekspunten voor het klantbezoek voor. | Status Taak: Niet gestart | Deadline Taak: 10/02/2026 | Toegewezen Aan: [CurrentUser]
- Sample evaluatie verloren deal | Type Activiteit: Notitie | Datum en Tijd: 09/20/2026 11:00 | Organisatie: Sample Metaal Partners | Contactpersoon: Sample Eva Bakker | Gekoppelde Deal: Sample Rapportageproject Metaal | Beschrijving: Leg de belangrijkste leerpunten uit de verloren deal vast. | Status Taak: Voltooid | Deadline Taak: 09/20/2026 | Toegewezen Aan: [CurrentUser]

## Document Libraries

Geen documentbibliotheken opgenomen.

## Navigation Order
- Home
- Klant 360-Pagina
- CRM_Organisaties
- CRM_Contacten
- CRM_Deals
- CRM_Activiteiten