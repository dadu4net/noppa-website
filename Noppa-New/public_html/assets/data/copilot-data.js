const CATEGORIES = [
  {
    id: "tech",
    name: "Technische fundatie",
    icon: "🏗️",
    desc: "M365-licenties, apps en infrastructuur die Copilot nodig heeft.",
    questions: [
      {
        id: "tech-1",
        q: "Welke Microsoft 365-licentie heeft het grootste deel van jullie gebruikers?",
        hint: "Copilot vereist minimaal Business Standard. Voor een veilige uitrol is Business Premium of E3+ aanbevolen.",
        options: [
          { t: "Geen / alleen e-mail via externe provider", s: 0 },
          { t: "Microsoft 365 Business Basic of Apps for Business", s: 1 },
          { t: "Microsoft 365 Business Standard", s: 2 },
          { t: "Microsoft 365 Business Premium", s: 4 },
          { t: "Microsoft 365 E3", s: 4 },
          { t: "Microsoft 365 E5 (volledig)", s: 5 }
        ]
      },
      {
        id: "tech-1a",
        q: "Welke E3/E5-features benutten jullie ook daadwerkelijk?",
        hint: "Veel organisaties kopen E3/E5 maar gebruiken alleen de basis-Office.",
        dependsOn: { id: "tech-1", showIfOptionIn: [4, 5] },
        options: [
          { t: "Alleen Office-apps en mailbox", s: 1 },
          { t: "Office + Intune voor apparaatbeheer", s: 3 },
          { t: "Office + Intune + Defender", s: 4 },
          { t: "Volledige stack incl. Purview, Defender en Entra P2", s: 5 }
        ]
      },
      {
        id: "tech-2",
        q: "Op welk update-kanaal staan jullie Office-apps?",
        hint: "Copilot vereist een actuele Office-versie. Mixen van kanalen geeft onverwachte verschillen tussen gebruikers.",
        options: [
          { t: "Onbekend / weet niet", s: 0 },
          { t: "Mix van kanalen door elkaar", s: 1 },
          { t: "Semi-Annual Channel (verouderd)", s: 2 },
          { t: "Monthly Enterprise Channel (gestandaardiseerd)", s: 4 },
          { t: "Current Channel (gestandaardiseerd, recent)", s: 5 }
        ]
      },
      {
        id: "tech-3",
        q: "Hoe worden eindgebruikers-apparaten beheerd?",
        hint: "Copilot werkt het beste op compliant beheerde apparaten — dit is ook een voorwaarde voor sterk Conditional Access-beleid.",
        options: [
          { t: "Geen device management", s: 0 },
          { t: "Alleen mobiele apparaten via Intune", s: 2 },
          { t: "Windows-clients via Intune", s: 4 },
          { t: "Alle apparaten managed (Windows + macOS + mobile)", s: 5 }
        ]
      },
      {
        id: "tech-4",
        q: "Wat is jullie status met Microsoft 365 Copilot-licenties?",
        options: [
          { t: "Nog geen plannen", s: 0 },
          { t: "Aan het oriënteren / business case in opbouw", s: 1 },
          { t: "Kleine pilot (< 10 gebruikers)", s: 3 },
          { t: "Bredere pilot (10–50 gebruikers)", s: 4 },
          { t: "Organisatiebrede uitrol gestart of voltooid", s: 5 }
        ]
      },
      {
        id: "tech-4a",
        q: "Met welke doelgroep zijn jullie pilot gestart?",
        hint: "Een goede pilotgroep is cross-functioneel, niet alleen IT.",
        dependsOn: { id: "tech-4", showIfOptionIn: [2, 3, 4] },
        options: [
          { t: "Alleen IT-team", s: 1 },
          { t: "Willekeurige selectie / vrijwilligers", s: 2 },
          { t: "Management of staf", s: 3 },
          { t: "Cross-functioneel (meerdere afdelingen + personas)", s: 5 }
        ]
      },
      {
        id: "tech-5",
        q: "Welke browser is standaard voor M365 Copilot Chat?",
        hint: "Edge geeft de beste integratie met Copilot Chat (work search, side bar).",
        options: [
          { t: "Geen standaard — gebruikers kiezen zelf", s: 1 },
          { t: "Mix van Edge en Chrome", s: 3 },
          { t: "Edge gestandaardiseerd, andere browsers ook beschikbaar", s: 4 },
          { t: "Edge volledig gestandaardiseerd en beheerd", s: 5 }
        ]
      },
      {
        id: "tech-6",
        q: "Hoe volwassen is jullie Teams-gebruik?",
        hint: "Veel Copilot-waarde zit in Teams (meeting recap, chat, channels). Beperkt Teams-gebruik = beperkte Copilot-waarde.",
        options: [
          { t: "Teams nauwelijks gebruikt", s: 0 },
          { t: "Vooral chat en meetings", s: 2 },
          { t: "Chat, meetings én channels", s: 4 },
          { t: "Diepe integratie (apps, tabs, externe samenwerking)", s: 5 }
        ]
      },
      {
        id: "tech-7",
        q: "Hoe is jullie OneDrive en SharePoint-bestandsbeheer ingericht?",
        hint: "Copilot doorzoekt OneDrive en SharePoint. Bestanden op netwerkschijven of lokaal zijn voor Copilot onzichtbaar.",
        options: [
          { t: "Bestanden vooral op netwerkschijven / lokaal", s: 0 },
          { t: "Mix — deels OneDrive/SharePoint, deels elders", s: 2 },
          { t: "Grotendeels in OneDrive en SharePoint, sync actief", s: 4 },
          { t: "100% in OneDrive/SharePoint, beheerd via Known Folder Move", s: 5 }
        ]
      }
    ]
  },

  {
    id: "identity",
    name: "Identity & Security",
    icon: "🔐",
    desc: "Toegang, authenticatie en bescherming van accounts.",
    questions: [
      {
        id: "id-1",
        q: "Is multi-factor authentication (MFA) verplicht?",
        options: [
          { t: "Niet verplicht", s: 0 },
          { t: "Alleen voor admins", s: 1 },
          { t: "Vrijwillig voor gebruikers", s: 1 },
          { t: "Verplicht voor de meeste, met uitzonderingen", s: 3 },
          { t: "Verplicht voor 100% (incl. service accounts waar mogelijk)", s: 5 }
        ]
      },
      {
        id: "id-1a",
        q: "Welke authenticatiemethoden zijn toegestaan?",
        hint: "SMS is kwetsbaar voor SIM-swap aanvallen. Phishing-resistant methodes (FIDO2, Windows Hello) zijn de standaard voor 2025+.",
        dependsOn: { id: "id-1", showIfOptionIn: [1, 2, 3, 4] },
        options: [
          { t: "Voornamelijk SMS / telefoonbericht", s: 1 },
          { t: "Authenticator app (push of TOTP)", s: 3 },
          { t: "Mix incl. phishing-resistant (Windows Hello, FIDO2)", s: 4 },
          { t: "Phishing-resistant verplicht voor admins, app voor gebruikers", s: 5 }
        ]
      },
      {
        id: "id-2",
        q: "Hoe volwassen is jullie Conditional Access?",
        options: [
          { t: "Niet ingericht / niet bekend", s: 0 },
          { t: "Alleen Microsoft security defaults", s: 2 },
          { t: "Basis-policies (locatie, apparaat)", s: 3 },
          { t: "Volwassen set (device compliance, sign-in risk, app-specifiek)", s: 5 }
        ]
      },
      {
        id: "id-3",
        q: "Welke Entra ID (voorheen Azure AD) licentie hebben jullie?",
        options: [
          { t: "Alleen Entra ID Free", s: 1 },
          { t: "Entra ID P1 (incl. via Business Premium / E3)", s: 3 },
          { t: "Entra ID P2 (incl. via E5)", s: 5 }
        ]
      },
      {
        id: "id-4",
        q: "Is Privileged Identity Management (PIM) of just-in-time-toegang ingericht?",
        hint: "Permanente admin-rechten vormen het grootste risico bij een Copilot-incident.",
        options: [
          { t: "Nee — admins hebben permanente rechten", s: 0 },
          { t: "Op de roadmap", s: 1 },
          { t: "Gedeeltelijk (voor de hoogste rollen)", s: 3 },
          { t: "Volledig ingericht voor alle privileged rollen", s: 5 }
        ]
      },
      {
        id: "id-5",
        q: "Maken jullie gebruik van Entra ID Identity Protection?",
        hint: "Vereist P2. Detecteert risicovolle sign-ins en gecompromitteerde accounts — relevanter wanneer Copilot data kan ontsluiten.",
        dependsOn: { id: "id-3", showIfOptionIn: [2] },
        options: [
          { t: "Niet geconfigureerd", s: 1 },
          { t: "Alerts ingeschakeld, geen automation", s: 2 },
          { t: "Sign-in risk policy actief", s: 4 },
          { t: "Sign-in risk + user risk policies actief", s: 5 }
        ]
      },
      {
        id: "id-6",
        q: "Welke endpoint-bescherming gebruiken jullie?",
        options: [
          { t: "Geen / basis Defender Antivirus", s: 1 },
          { t: "Third-party EDR", s: 3 },
          { t: "Defender for Endpoint P1", s: 4 },
          { t: "Defender for Endpoint P2 + Defender XDR", s: 5 }
        ]
      },
      {
        id: "id-7",
        q: "Hoe wordt guest- en extern-toegang beheerd?",
        hint: "Copilot indexeert ook content waar gasten toegang toe hebben.",
        options: [
          { t: "Iedereen kan gasten uitnodigen, geen review", s: 0 },
          { t: "Aanmaak vrij, beperkte review", s: 2 },
          { t: "Aanmaak via admin / proces", s: 4 },
          { t: "Volwassen lifecycle (review, expiry, restricted access)", s: 5 }
        ]
      },
      {
        id: "id-8",
        q: "Hebben jullie zicht en grip op service accounts / non-human identities?",
        options: [
          { t: "Geen overzicht", s: 0 },
          { t: "Basis-overzicht", s: 2 },
          { t: "Inventaris + eigenaarschap", s: 4 },
          { t: "Workload identities en managed identities waar mogelijk", s: 5 }
        ]
      }
    ]
  },

  {
    id: "data",
    name: "Data governance",
    icon: "🗂️",
    desc: "Het zwaartepunt voor Copilot — wie ziet wat en hoe?",
    questions: [
      {
        id: "data-1",
        q: "Bestaat er een SharePoint / Teams governance-model?",
        hint: "Site sprawl is een van de grootste oversharing-risico's onder Copilot.",
        options: [
          { t: "Geen governance — iedereen maakt sites/teams aan", s: 0 },
          { t: "Aanmaak via verzoek, geen verdere review", s: 2 },
          { t: "Beleid op papier, gedeeltelijk gehandhaafd", s: 3 },
          { t: "Volwassen model met eigenaarschap, review en archivering", s: 5 }
        ]
      },
      {
        id: "data-2",
        q: "Hoe worden permissions op sites/Teams gereviewed?",
        options: [
          { t: "Nooit gereviewed", s: 0 },
          { t: "Ad-hoc bij vermoeden", s: 1 },
          { t: "Jaarlijkse access reviews", s: 3 },
          { t: "Geautomatiseerde reviews (Entra Access Reviews)", s: 5 }
        ]
      },
      {
        id: "data-3",
        q: "Wat is de status van sensitivity labels (Microsoft Purview)?",
        options: [
          { t: "Niet ingericht", s: 0 },
          { t: "Gedefinieerd, niet uitgerold", s: 1 },
          { t: "Uitgerold, alleen handmatig labelen", s: 3 },
          { t: "Uitgerold met verplichte labels", s: 4 },
          { t: "Auto-labeling actief op gevoelige content", s: 5 }
        ]
      },
      {
        id: "data-3a",
        q: "Worden labels ook toegepast op containers (sites, teams, groups)?",
        hint: "Container-labels regelen oversharing en guest-toegang per site.",
        dependsOn: { id: "data-3", showIfOptionIn: [2, 3, 4] },
        options: [
          { t: "Nee, alleen op bestanden", s: 1 },
          { t: "Beperkt, voor enkele sites", s: 3 },
          { t: "Ja, container-labels organisatiebreed", s: 5 }
        ]
      },
      {
        id: "data-4",
        q: "Welke kanalen worden gedekt door Data Loss Prevention (DLP)?",
        options: [
          { t: "Geen DLP actief", s: 0 },
          { t: "Alleen e-mail", s: 1 },
          { t: "E-mail + SharePoint + OneDrive", s: 3 },
          { t: "Alle workloads incl. Teams chat", s: 4 },
          { t: "Alle workloads + endpoint DLP", s: 5 }
        ]
      },
      {
        id: "data-5",
        q: "Is er een oversharing-audit uitgevoerd op SharePoint en OneDrive?",
        hint: "Bestanden gedeeld met 'Iedereen behalve externe gebruikers' duiken direct op in Copilot-antwoorden.",
        options: [
          { t: "Nee, geen overzicht", s: 0 },
          { t: "Vermoeden van issues, geen audit", s: 1 },
          { t: "Audit uitgevoerd, opschoning loopt", s: 3 },
          { t: "Audit + opschoning afgerond", s: 4 },
          { t: "Continue monitoring (SharePoint Advanced Management / DSPM)", s: 5 }
        ]
      },
      {
        id: "data-6",
        q: "Wat is jullie beleid voor extern delen vanuit SharePoint/OneDrive?",
        options: [
          { t: "Iedereen kan extern delen, geen restricties", s: 0 },
          { t: "Beperkt tot bestaande gasten", s: 2 },
          { t: "Per-site policy, beheerd door site owners", s: 4 },
          { t: "Strikt beleid + logging + alerts", s: 5 }
        ]
      },
      {
        id: "data-7",
        q: "Hoe wordt OneDrive (persoonlijke opslag) beheerd?",
        options: [
          { t: "Geen beleid", s: 0 },
          { t: "Basis quota's en sync", s: 2 },
          { t: "Met retention en sharing-controles", s: 4 },
          { t: "Volwassen lifecycle (offboarding, archivering)", s: 5 }
        ]
      },
      {
        id: "data-8",
        q: "Wat is jullie retention-strategie?",
        options: [
          { t: "Geen retention ingericht", s: 0 },
          { t: "Alleen mailbox retention", s: 2 },
          { t: "Retention voor SharePoint, OneDrive, Teams", s: 4 },
          { t: "Volwassen records management programma", s: 5 }
        ]
      },
      {
        id: "data-9",
        q: "Hoe worden audit-logs gebruikt?",
        options: [
          { t: "Standaard logging, niet gebruikt", s: 1 },
          { t: "Bekeken alleen bij incidenten", s: 2 },
          { t: "Periodieke review", s: 3 },
          { t: "Integratie met SIEM (Sentinel/Splunk)", s: 4 },
          { t: "SIEM + premium audit + lange bewaartermijn", s: 5 }
        ]
      },
      {
        id: "data-10",
        q: "Is Restricted SharePoint Search overwogen / ingericht?",
        hint: "Beperkt waar Copilot zoekt naar een korte lijst toegestane sites — handig tijdens overgangsperiode.",
        options: [
          { t: "Niet bekend / niet relevant geacht", s: 1 },
          { t: "Bekend, niet ingericht", s: 2 },
          { t: "Overwogen, niet nodig in jullie situatie", s: 4 },
          { t: "Geïmplementeerd waar nodig", s: 5 }
        ]
      }
    ]
  },

  {
    id: "compliance",
    name: "Compliance & risico",
    icon: "⚖️",
    desc: "AVG, AI-beleid en juridische verankering.",
    questions: [
      {
        id: "comp-1",
        q: "Is er een Data Protection Impact Assessment (DPIA) uitgevoerd voor Copilot?",
        hint: "Voor de AVG verplicht zodra je AI-tools inzet op persoonsgegevens.",
        options: [
          { t: "Niet bekend / nog niet over nagedacht", s: 0 },
          { t: "Op de planning", s: 1 },
          { t: "In uitvoering", s: 3 },
          { t: "Uitgevoerd en goedgekeurd door FG/DPO", s: 5 }
        ]
      },
      {
        id: "comp-2",
        q: "Is er een AI Acceptable Use Policy voor medewerkers?",
        hint: "Wat mag wel/niet met Copilot? Welke data nooit erin? Hoe omgaan met hallucinaties?",
        options: [
          { t: "Niet bestaand", s: 0 },
          { t: "Concept", s: 1 },
          { t: "Gepubliceerd, niet actief gecommuniceerd", s: 3 },
          { t: "Gepubliceerd + actief gecommuniceerd + onderdeel onboarding", s: 5 }
        ]
      },
      {
        id: "comp-3",
        q: "Zijn legal en compliance betrokken bij het Copilot-besluit?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Geïnformeerd na besluit", s: 2 },
          { t: "Geconsulteerd in voorbereiding", s: 4 },
          { t: "Mede-eigenaar van het governance frame", s: 5 }
        ]
      },
      {
        id: "comp-4",
        q: "Zijn sector-specifieke compliance-eisen in kaart gebracht?",
        hint: "Denk aan NEN7510 (zorg), DNB (finance), BIO (overheid), ISO27001, SOC2, etc.",
        options: [
          { t: "Niet van toepassing of niet onderzocht", s: 1 },
          { t: "Bewust van eisen, nog geen actie", s: 2 },
          { t: "In kaart gebracht", s: 4 },
          { t: "Volledig gevalideerd dat Copilot binnen kaders past", s: 5 }
        ]
      },
      {
        id: "comp-5",
        q: "Houdt jullie Incident Response plan rekening met AI-incidenten?",
        hint: "Denk aan data-lekken via prompts, hallucinaties die schade veroorzaken, of prompt-injection in documenten.",
        options: [
          { t: "Geen IR-plan", s: 0 },
          { t: "IR-plan aanwezig, AI niet meegenomen", s: 2 },
          { t: "AI-scenario's toegevoegd aan plan", s: 4 },
          { t: "AI-scenario's geoefend (tabletop / war game)", s: 5 }
        ]
      },
      {
        id: "comp-6",
        q: "Hoe zit het met data residency en grensoverschrijdende dataverwerking?",
        hint: "Copilot-data wordt verwerkt in de EU Data Boundary, maar dit moet je wel kunnen aantonen.",
        options: [
          { t: "Onbekend", s: 0 },
          { t: "Op de roadmap om uit te zoeken", s: 1 },
          { t: "In kaart gebracht (EU Data Boundary bekend)", s: 4 },
          { t: "Multi-Geo ingericht waar nodig", s: 5 }
        ]
      }
    ]
  },

  {
    id: "adoption",
    name: "Adoptie & change",
    icon: "🎓",
    desc: "Sponsorship, training en draagvlak.",
    questions: [
      {
        id: "adopt-1",
        q: "Is er executive sponsorship voor Copilot?",
        options: [
          { t: "Geen sponsor", s: 0 },
          { t: "IT-management", s: 2 },
          { t: "C-level sponsor benoemd", s: 4 },
          { t: "C-level sponsor + steering committee", s: 5 }
        ]
      },
      {
        id: "adopt-2",
        q: "Bestaat er een gedragen M365- of Copilot-adoptiestrategie?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Op papier, weinig executie", s: 1 },
          { t: "Lopend programma met sponsor", s: 3 },
          { t: "Volwassen programma met KPI's en rapportage", s: 5 }
        ]
      },
      {
        id: "adopt-3",
        q: "Is er een champions-netwerk?",
        options: [
          { t: "Niet bestaand", s: 0 },
          { t: "Informeel — een paar enthousiastelingen", s: 2 },
          { t: "Formeel netwerk met regelmatige sessies", s: 4 },
          { t: "Champions per afdeling, met tijd/budget", s: 5 }
        ]
      },
      {
        id: "adopt-4",
        q: "Hoe worden eindgebruikers getraind?",
        options: [
          { t: "Geen structurele training", s: 0 },
          { t: "Alleen onboarding bij indiensttreding", s: 1 },
          { t: "Periodieke trainingen op aanvraag", s: 3 },
          { t: "Doorlopend programma met leerpaden per rol", s: 5 }
        ]
      },
      {
        id: "adopt-4a",
        q: "Bevat het trainingsaanbod ook Copilot-specifieke inhoud?",
        dependsOn: { id: "adopt-4", showIfOptionIn: [1, 2, 3] },
        options: [
          { t: "Nee, alleen algemene M365-training", s: 2 },
          { t: "Algemene Copilot-introductie", s: 3 },
          { t: "Per persona / rol uitgewerkt", s: 5 }
        ]
      },
      {
        id: "adopt-5",
        q: "Is er een prompt-skills programma (leren effectief vragen aan Copilot)?",
        hint: "Slechte prompts = slechte resultaten = mensen die afhaken. Prompt-skill is grootste voorspeller van adoptie.",
        options: [
          { t: "Niet bestaand", s: 0 },
          { t: "Algemeen materiaal beschikbaar", s: 2 },
          { t: "Workshops + voorbeeld-prompts per rol", s: 4 },
          { t: "Continu programma met community + prompt library", s: 5 }
        ]
      },
      {
        id: "adopt-6",
        q: "Bestaat er een communicatie-/change-plan voor de Copilot-uitrol?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Ad-hoc berichten", s: 1 },
          { t: "Gedefinieerd plan met kanalen en momenten", s: 3 },
          { t: "Volledige campagne met storytelling en showcases", s: 5 }
        ]
      },
      {
        id: "adopt-7",
        q: "Is er een feedback-loop met gebruikers?",
        options: [
          { t: "Geen kanaal", s: 0 },
          { t: "Algemene mailbox / helpdesk", s: 1 },
          { t: "Teams-kanaal en periodieke surveys", s: 3 },
          { t: "Continu + structureel opgevolgd in roadmap", s: 5 }
        ]
      },
      {
        id: "adopt-8",
        q: "Wordt Copilot-gebruik gemonitord en geanalyseerd?",
        hint: "Microsoft 365 Copilot Dashboard (Viva Insights) geeft adoptie- en impact-metrics.",
        options: [
          { t: "Niet", s: 0 },
          { t: "Eenmalige analyse", s: 1 },
          { t: "Periodieke rapportages", s: 3 },
          { t: "Continue dashboards met opvolging", s: 5 }
        ]
      }
    ]
  },

  {
    id: "strategy",
    name: "Strategie & use cases",
    icon: "🎯",
    desc: "Visie, business cases en meetbare doelen.",
    questions: [
      {
        id: "strat-1",
        q: "Is er een geformaliseerde AI- of Copilot-strategie?",
        options: [
          { t: "Niet geformaliseerd", s: 0 },
          { t: "Op brainstorm-niveau", s: 1 },
          { t: "Gedocumenteerd voor IT-afdeling", s: 3 },
          { t: "Onderdeel van de bedrijfsstrategie", s: 5 }
        ]
      },
      {
        id: "strat-2",
        q: "Hoe concreet zijn jullie business cases voor Copilot?",
        options: [
          { t: "Geen", s: 0 },
          { t: "'Productiviteit verhogen' — abstract", s: 1 },
          { t: "Per afdeling concreet uitgewerkt", s: 3 },
          { t: "Geprioriteerde portfolio met ROI-onderbouwing", s: 5 }
        ]
      },
      {
        id: "strat-3",
        q: "Zijn use cases geprioriteerd en gekwantificeerd?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Lijstje met ideeën", s: 1 },
          { t: "Top-3 met owners en doelen", s: 3 },
          { t: "Portfolio + roadmap + meetpunten", s: 5 }
        ]
      },
      {
        id: "strat-4",
        q: "Is de pilot-scope gedefinieerd?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Globaal idee wie meedoet", s: 1 },
          { t: "Gedefinieerd, loopt", s: 3 },
          { t: "Afgerond met evaluatie en go/no-go", s: 5 }
        ]
      },
      {
        id: "strat-5",
        q: "Welke KPI's of succescriteria zijn vastgesteld?",
        options: [
          { t: "Geen", s: 0 },
          { t: "Zachte indicatoren ('iedereen tevreden')", s: 1 },
          { t: "Gebruiks-KPI's (actieve gebruikers, frequentie)", s: 3 },
          { t: "Gebruik + business outcomes + tijdbesparing/€", s: 5 }
        ]
      },
      {
        id: "strat-6",
        q: "Welk budget is gereserveerd?",
        options: [
          { t: "Geen specifiek budget", s: 0 },
          { t: "Alleen licenties", s: 2 },
          { t: "Licenties + adoptie", s: 4 },
          { t: "Volledig programmabudget (licenties, governance, training, support)", s: 5 }
        ]
      },
      {
        id: "strat-7",
        q: "Bestaat er een multi-jaar roadmap voor AI/Copilot?",
        options: [
          { t: "Nee", s: 0 },
          { t: "In ontwikkeling", s: 2 },
          { t: "1-jaars plan", s: 3 },
          { t: "Meerjaren plan met milestones (incl. Copilot Studio / agents)", s: 5 }
        ]
      },
      {
        id: "strat-8",
        q: "Wat is de bredere AI-volwassenheid van jullie organisatie?",
        hint: "Een organisatie die al AI gebruikt (Power Platform, custom models) heeft een voorsprong.",
        options: [
          { t: "Geen AI-ervaring", s: 1 },
          { t: "Losse experimenten", s: 2 },
          { t: "Productie-AI (bv. Power Platform AI Builder)", s: 4 },
          { t: "Brede AI-volwassenheid (data platform + ML + governance)", s: 5 }
        ]
      }
    ]
  }
];


function getTier(pct) {
  if (pct < 35) return {
    label: "Foundation",
    badge: "Foundation niveau",
    cls: "status-foundation",
    summary: "De basis ontbreekt nog op meerdere assen. Een directe uitrol van Copilot brengt risico's met zich mee op het gebied van security en data. Begin met de fundamenten voordat je grootschalig licenties aanschaft."
  };
  if (pct < 60) return {
    label: "Emerging",
    badge: "Emerging niveau",
    cls: "status-emerging",
    summary: "Er is een basis, maar belangrijke onderdelen ontbreken nog — vooral rond data governance en security. Met gerichte ingrepen kun je binnen enkele maanden Copilot-klaar zijn."
  };
  if (pct < 80) return {
    label: "Progressing",
    badge: "Progressing niveau",
    cls: "status-progressing",
    summary: "Jullie zijn goed op weg. De fundatie is grotendeels op orde, maar er zijn nog risico's of blinde vlekken die een succesvolle Copilot-uitrol kunnen vertragen. Een pilot is een logische volgende stap."
  };
  return {
    label: "Copilot Ready",
    badge: "Copilot Ready",
    cls: "status-ready",
    summary: "Jullie hebben een sterke fundatie op alle assen. Focus nu op het maximaliseren van waarde — concrete use cases, meetbare KPI's en het opschalen van adoptie."
  };
}


function buildRecommendations(catScores) {
  const recs = [];

  catScores.forEach(c => {
    if (c.pct < 40) {
      // High priority recs
      switch (c.id) {
        case "tech":
          recs.push({
            priority: "high",
            title: "Versterk je licentie- en app-fundament",
            text: "Een Copilot-rollout vereist Microsoft 365 Business Premium of E3/E5 én gestandaardiseerde Office-apps op Current of Monthly Enterprise Channel. Inventariseer huidige licenties, kanalen en Intune-coverage; zet KFM (Known Folder Move) aan zodat OneDrive de primaire opslag wordt."
          });
          break;
        case "identity":
          recs.push({
            priority: "high",
            title: "Implementeer MFA en Conditional Access voor iedereen",
            text: "Zonder verplichte phishing-resistant MFA en basis Conditional Access is een Copilot-rollout veiligheidsmatig onverantwoord. Begin met een security-baseline (MFA, blokkeer legacy auth, beperk admin-accounts via PIM, schakel Identity Protection in waar P2 beschikbaar is)."
          });
          break;
        case "data":
          recs.push({
            priority: "high",
            title: "Voer eerst een oversharing-audit uit",
            text: "Copilot doorzoekt alle content waar gebruikers toegang toe hebben — inclusief gevoelige bestanden die per ongeluk breed gedeeld zijn. Een audit op SharePoint- en OneDrive-permissies, gecombineerd met sensitivity labels en DLP, is een blocker — geen optie."
          });
          break;
        case "compliance":
          recs.push({
            priority: "high",
            title: "Start een DPIA en AI Acceptable Use Policy",
            text: "Een Data Protection Impact Assessment is voor de AVG verplicht zodra je AI op persoonsgegevens inzet. Combineer dit met een AI Acceptable Use Policy en betrek legal/compliance vóór de pilot — anders riskeer je achteraf de rollout te moeten terugdraaien."
          });
          break;
        case "adoption":
          recs.push({
            priority: "high",
            title: "Bouw een adoptie-fundament voordat je Copilot uitrolt",
            text: "Zonder executive sponsor, adoptiestrategie, champions en prompt-skills training blijft Copilot een dure tool die binnen drie maanden onbenut blijft. Stel een sponsor aan en richt een klein champions-netwerk in vóór de pilot start."
          });
          break;
        case "strategy":
          recs.push({
            priority: "high",
            title: "Definieer business cases vóór licentieaanschaf",
            text: "Zonder concrete use cases, KPI's en management-sponsorship verzandt elk Copilot-traject. Identificeer 3–5 use cases per afdeling met meetbare impact (uren bespaard, doorlooptijd verkort, kwaliteit verbeterd) en koppel er een ROI aan."
          });
          break;
      }
    } else if (c.pct < 70) {
      // Medium recs
      switch (c.id) {
        case "tech":
          recs.push({
            priority: "medium",
            title: "Standaardiseer je Office-omgeving verder",
            text: "Niet alle gebruikers zitten op dezelfde versie, licentie of update-channel. Standaardiseer Intune voor alle endpoints en zet OneDrive Known Folder Move aan zodat Copilot daadwerkelijk overal bij kan."
          });
          break;
        case "identity":
          recs.push({
            priority: "medium",
            title: "Implementeer Privileged Identity Management (PIM)",
            text: "Permanente admin-rechten vergroten het aanvalsoppervlak. Schakel just-in-time toegang in voor alle privileged rollen en activeer phishing-resistant MFA (Windows Hello / FIDO2) voor admin-accounts."
          });
          break;
        case "data":
          recs.push({
            priority: "medium",
            title: "Rol sensitivity labels en DLP breder uit",
            text: "De basis staat, maar uitbreiding naar container-labels, auto-labeling en endpoint DLP voorkomt dat Copilot vertrouwelijke data onbedoeld in samenvattingen of Chat-antwoorden surfaceert."
          });
          break;
        case "compliance":
          recs.push({
            priority: "medium",
            title: "Voeg AI-scenario's toe aan je Incident Response plan",
            text: "Een tabletop-oefening rondom data-lek via prompts, hallucinaties die schade veroorzaken of prompt-injection in documenten brengt blinde vlekken in beeld voordat ze in productie problemen geven."
          });
          break;
        case "adoption":
          recs.push({
            priority: "medium",
            title: "Formaliseer je champions-netwerk en prompt-skills",
            text: "Informele early adopters zijn een goede start. Maak er een gestructureerd programma van met regelmatige sessies, persona-specifieke leerpaden en een prompt-library."
          });
          break;
        case "strategy":
          recs.push({
            priority: "medium",
            title: "Definieer meetbare KPI's en pilot-scope",
            text: "Zonder concrete succescriteria is een go/no-go besluit na de pilot onmogelijk. Stel zowel gebruiks-KPI's (frequentie, retentie) als business outcome-KPI's (tijdbesparing in uren, doorlooptijd) vast."
          });
          break;
      }
    } else if (c.pct < 90) {
      // Low recs
      switch (c.id) {
        case "tech":
          recs.push({
            priority: "low",
            title: "Optimaliseer je app-rollout en update-strategie",
            text: "Centraal beheer via Intune maakt updates en troubleshooting eenvoudiger naarmate Copilot opschaalt — overweeg ook Edge for Business management voor consistente Copilot Chat-ervaring."
          });
          break;
        case "identity":
          recs.push({
            priority: "low",
            title: "Evalueer Conditional Access op nieuwe scenario's",
            text: "Met Copilot ontstaan nieuwe risico's (data-uitwisseling via plugins, Copilot Studio agents). Review je policies regelmatig op deze scenario's en sluit aan op Defender XDR."
          });
          break;
        case "data":
          recs.push({
            priority: "low",
            title: "Overweeg SharePoint Advanced Management of DSPM for AI",
            text: "Voor continue monitoring van oversharing, restricted SharePoint search en DSPM for AI — geeft IT-grip zonder gebruiksfrictie."
          });
          break;
        case "compliance":
          recs.push({
            priority: "low",
            title: "Update je governance-frame periodiek",
            text: "Het Copilot-landschap verandert snel (agents, Copilot Studio, M365 Copilot Chat). Plan een halfjaarlijkse review van je AI-beleid en DPIA-actualisatie."
          });
          break;
        case "adoption":
          recs.push({
            priority: "low",
            title: "Sluit de feedback-loop tussen gebruikers en IT",
            text: "Bouw een community waar gebruikers prompts, ervaringen en use cases delen — dit versnelt adoptie organisch en voedt je use case-portfolio."
          });
          break;
        case "strategy":
          recs.push({
            priority: "low",
            title: "Schaal naar de volgende use case-portfolio",
            text: "Bouw voort op succesvolle eerste use cases met geavanceerde scenario's (custom agents in Copilot Studio, integraties met line-of-business systemen)."
          });
          break;
      }
    }
  });

  // Sort by priority (high > medium > low)
  const order = { high: 0, medium: 1, low: 2 };
  recs.sort((a, b) => order[a.priority] - order[b.priority]);

  if (recs.length === 0) {
    recs.push({
      priority: "low",
      title: "Jullie staan sterk — focus op waarde-realisatie",
      text: "De fundatie is op orde. Investeer nu in het meten van impact, opschalen van use cases en het bouwen van geavanceerde scenario's met Copilot Studio of custom agents."
    });
  }

  return recs;
}

