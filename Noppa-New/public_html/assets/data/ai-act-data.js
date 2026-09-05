const CATEGORIES = [
  {
    id: "inventory",
    name: "AI-inventaris & rol",
    icon: "📋",
    desc: "Weet je welke AI je gebruikt, met welke rol en welk risico?",
    questions: [
      {
        id: "inv-1",
        q: "Hebben jullie een actueel overzicht van alle AI-systemen in jullie organisatie?",
        hint: "Inclusief 'verborgen' AI: features in SaaS-tools, AI-add-ons in Excel/Outlook, schaduw-AI door medewerkers (ChatGPT personal accounts).",
        options: [
          { t: "Geen overzicht", s: 0 },
          { t: "Informeel — IT weet het meeste", s: 1 },
          { t: "Centraal register, niet up-to-date", s: 3 },
          { t: "Actueel centraal register met owners en review-cyclus", s: 5 }
        ]
      },
      {
        id: "inv-2",
        q: "Is jullie rol onder de AI Act vastgelegd per AI-systeem?",
        hint: "Provider, Deployer, Distributor of Importer — de verplichtingen verschillen substantieel per rol. Voor M365 Copilot zijn jullie typisch Deployer.",
        options: [
          { t: "Niet bewust van rol-onderscheid", s: 0 },
          { t: "Onderscheid bekend, niet per systeem vastgelegd", s: 2 },
          { t: "Per AI-systeem gedocumenteerd", s: 4 },
          { t: "Volledig in register + contractuele afspraken met providers", s: 5 }
        ]
      },
      {
        id: "inv-3",
        q: "Zijn jullie AI-systemen geclassificeerd naar AI Act risico-niveaus?",
        hint: "Vier niveaus: Unacceptable (verboden), High-risk (Annex III/I), Limited risk (transparantie-verplichting), Minimal risk.",
        options: [
          { t: "Niet uitgevoerd / niet bekend", s: 0 },
          { t: "Op planning", s: 1 },
          { t: "Hoofd-systemen geclassificeerd", s: 3 },
          { t: "Alle systemen geclassificeerd + periodiek herzien", s: 5 }
        ]
      },
      {
        id: "inv-4",
        q: "Is er expliciet gecheckt op verboden AI-praktijken (Art. 5)?",
        hint: "Bijv. social scoring, manipulatie, real-time biometrische identificatie in publieke ruimte, emotie-herkenning op werkvloer/in onderwijs, scraping van gezichtsbeelden.",
        options: [
          { t: "Niet uitgevoerd / niet bekend", s: 0 },
          { t: "Bewustzijn, geen formele scan", s: 1 },
          { t: "Eerste scan uitgevoerd", s: 3 },
          { t: "Periodieke compliance-check ingericht", s: 5 }
        ]
      },
      {
        id: "inv-5",
        q: "Welke vorm van Generative AI / GPAI gebruiken medewerkers?",
        hint: "GPAI = General-Purpose AI: Copilot, ChatGPT, Claude, Gemini, etc. Schaduw-AI is een groot risico.",
        options: [
          { t: "Onbekend / niet beheerd", s: 0 },
          { t: "Persoonlijke accounts (gratis ChatGPT etc.) zonder beleid", s: 1 },
          { t: "Enterprise GPAI (Copilot, ChatGPT Enterprise) toegestaan", s: 3 },
          { t: "Enterprise GPAI + governance + monitoring + verbod op persoonlijk gebruik", s: 5 }
        ]
      },
      {
        id: "inv-6",
        q: "Leveren of gebruiken jullie AI-systemen die in Annex III vallen (high-risk lijst)?",
        hint: "Annex III dekt o.a.: HR/recruitment beslissingen, kredietscoring, biometrie, kritieke infrastructuur, onderwijs (toelating/beoordeling), wetshandhaving, migratie/grenscontrole.",
        options: [
          { t: "Niet van toepassing — geen high-risk AI", s: 4 },
          { t: "Onbekend", s: 0 },
          { t: "Mogelijk wel, niet geanalyseerd", s: 1 },
          { t: "Geanalyseerd en gedocumenteerd", s: 4 },
          { t: "Geanalyseerd + actieve compliance-roadmap", s: 5 }
        ]
      },
      {
        id: "inv-7",
        q: "Is er een AI-register met owners, doel, leverancier, data en risicoklasse?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Eenvoudige spreadsheet / lijst", s: 2 },
          { t: "Gestructureerd register", s: 4 },
          { t: "Volwassen register, geïntegreerd met andere governance-tools", s: 5 }
        ]
      }
    ]
  },

  {
    id: "literacy",
    name: "AI-geletterdheid (Art. 4)",
    icon: "🎓",
    desc: "Verplicht voor alle staf die met AI werkt — sinds 2 feb 2025.",
    questions: [
      {
        id: "lit-1",
        q: "Hebben jullie de AI-literacy verplichting (Art. 4) onderkend en een plan opgesteld?",
        hint: "Geldt voor providers én deployers van AI, inclusief gebruikers van M365 Copilot, ChatGPT Enterprise, etc.",
        options: [
          { t: "Onbekend met de verplichting", s: 0 },
          { t: "Bekend, nog geen plan", s: 1 },
          { t: "Plan opgesteld", s: 3 },
          { t: "In uitvoering of afgerond", s: 5 }
        ]
      },
      {
        id: "lit-2",
        q: "Is er een AI-literacy programma operationeel?",
        options: [
          { t: "Nee", s: 0 },
          { t: "Eenmalige sessie", s: 2 },
          { t: "Periodieke trainingen", s: 3 },
          { t: "Continu programma met leerpaden en assessment", s: 5 }
        ]
      },
      {
        id: "lit-2a",
        q: "Worden er verschillende leerpaden gehanteerd op basis van rol of risicoblootstelling?",
        hint: "Een ontwikkelaar heeft andere kennis nodig dan een eindgebruiker; een HR-medewerker met AI-tooling andere dan een marketeer met Copilot.",
        dependsOn: { id: "lit-2", showIfOptionIn: [1, 2, 3] },
        options: [
          { t: "Nee, generieke training voor iedereen", s: 1 },
          { t: "Onderscheid eindgebruikers vs ontwikkelaars", s: 3 },
          { t: "Per persona en risicoblootstelling uitgewerkt", s: 5 }
        ]
      },
      {
        id: "lit-3",
        q: "Wordt deelname aan AI-literacy gedocumenteerd?",
        hint: "Bewijslast bij eventuele handhaving ligt bij de organisatie.",
        options: [
          { t: "Nee", s: 0 },
          { t: "Informeel", s: 1 },
          { t: "Geregistreerd in HR-systeem of LMS", s: 4 },
          { t: "Geregistreerd + periodiek geactualiseerd + audit-trail", s: 5 }
        ]
      },
      {
        id: "lit-4",
        q: "Is AI-literacy onderdeel van onboarding voor nieuwe medewerkers?",
        options: [
          { t: "Nee", s: 0 },
          { t: "In voorbereiding", s: 2 },
          { t: "Ja, in onboarding-programma", s: 4 },
          { t: "Ja, met verplicht assessment of certificering", s: 5 }
        ]
      }
    ]
  },

  {
    id: "governance",
    name: "Governance & verantwoording",
    icon: "⚖️",
    desc: "AI Officer, beleid, DPIA/FRIA, risicoregister en escalatie.",
    questions: [
      {
        id: "gov-1",
        q: "Is er een AI-governance structuur (AI committee, AI Officer of vergelijkbaar)?",
        options: [
          { t: "Geen structuur", s: 0 },
          { t: "Informele rolverdeling", s: 1 },
          { t: "Benoemd, maar zonder mandaat of tijd", s: 2 },
          { t: "Formeel benoemd met mandaat en budget", s: 5 }
        ]
      },
      {
        id: "gov-2",
        q: "Is er een AI-beleid of Acceptable Use Policy?",
        options: [
          { t: "Geen beleid", s: 0 },
          { t: "Concept", s: 1 },
          { t: "Gepubliceerd, niet actief uitgedragen", s: 3 },
          { t: "Gepubliceerd + bekend bij medewerkers + handhaving", s: 5 }
        ]
      },
      {
        id: "gov-3",
        q: "Zijn DPIA's (AVG) uitgevoerd waar AI persoonsgegevens verwerkt?",
        hint: "Bij hoge risico's voor betrokkenen is de DPIA AVG-verplichting (Art. 35) — AI-tooling triggert dit vrijwel altijd.",
        options: [
          { t: "Niet bekend / nooit uitgevoerd", s: 0 },
          { t: "Op de planning", s: 1 },
          { t: "Voor hoofd-systemen uitgevoerd", s: 4 },
          { t: "Alle relevante systemen + periodieke review", s: 5 }
        ]
      },
      {
        id: "gov-4",
        q: "Is een Fundamental Rights Impact Assessment (FRIA) uitgevoerd voor high-risk AI? (Art. 27)",
        hint: "FRIA is verplicht voor deployers van bepaalde high-risk AI in publieke dienstverlening, kredietverstrekking en levensverzekering.",
        options: [
          { t: "Niet van toepassing (geen high-risk)", s: 4 },
          { t: "Wel van toepassing, niet uitgevoerd", s: 0 },
          { t: "In uitvoering", s: 3 },
          { t: "Uitgevoerd voor alle relevante systemen", s: 5 }
        ]
      },
      {
        id: "gov-5",
        q: "Is er een AI-risicoregister?",
        options: [
          { t: "Geen register", s: 0 },
          { t: "AI valt onder algemeen risicoregister", s: 3 },
          { t: "Specifiek AI-risicoregister met mitigaties", s: 5 }
        ]
      },
      {
        id: "gov-6",
        q: "Is er een proces voor het melden en afhandelen van AI-incidenten?",
        hint: "Denk aan datalek via prompts, hallucinaties met schade, biased output, prompt-injection via documenten.",
        options: [
          { t: "Geen specifiek proces", s: 0 },
          { t: "AI valt onder algemeen IR-plan", s: 2 },
          { t: "Specifiek AI-incident proces", s: 4 },
          { t: "Inclusief 15-dagen meldplicht aan markttoezicht (Art. 73)", s: 5 }
        ]
      },
      {
        id: "gov-7",
        q: "Is er een rapportagelijn aan directie of bestuur over AI-risico's?",
        options: [
          { t: "Geen rapportage", s: 0 },
          { t: "Ad-hoc bij incidenten", s: 1 },
          { t: "Periodieke rapportage", s: 3 },
          { t: "Vast onderdeel van risk-reporting aan board", s: 5 }
        ]
      }
    ]
  },

  {
    id: "transparency",
    name: "Transparantie & rechten",
    icon: "👁️",
    desc: "Disclosure, watermarking, OR-betrokkenheid en recht op uitleg.",
    questions: [
      {
        id: "trans-1",
        q: "Worden gebruikers geïnformeerd wanneer ze met een AI-systeem (zoals chatbot) interacteren? (Art. 50)",
        options: [
          { t: "Nee", s: 0 },
          { t: "Soms, niet standaard", s: 2 },
          { t: "Standaard disclosure", s: 4 },
          { t: "Disclosure + opt-out / alternatief contact mogelijk", s: 5 }
        ]
      },
      {
        id: "trans-2",
        q: "Wordt AI-gegenereerde content (tekst, beeld, audio) gelabeld of gewatermerkt?",
        hint: "Voor providers van GPAI verplicht; voor deployers afhankelijk van context — zeker voor publieke content.",
        options: [
          { t: "Nee", s: 0 },
          { t: "In ontwikkeling", s: 1 },
          { t: "Alleen voor publieke content", s: 3 },
          { t: "Voor alle gegenereerde content + machine-readable markers", s: 5 }
        ]
      },
      {
        id: "trans-3",
        q: "Worden deepfakes of synthetische media als zodanig gelabeld?",
        options: [
          { t: "Niet van toepassing", s: 4 },
          { t: "Wel relevant, niet gelabeld", s: 0 },
          { t: "Gelabeld waar publiek", s: 3 },
          { t: "Conform AI Act + interne richtlijn vastgelegd", s: 5 }
        ]
      },
      {
        id: "trans-4",
        q: "Zijn werknemers via OR/PV geïnformeerd over AI-systemen die hen raken op de werkvloer?",
        hint: "OR heeft adviesrecht (WOR Art. 25/27) bij invoering van AI die personeelsbeslissingen of monitoring raakt. Voor Copilot-uitrol relevant.",
        options: [
          { t: "Niet geïnformeerd", s: 0 },
          { t: "Geïnformeerd, niet formeel", s: 2 },
          { t: "Formele communicatie via OR", s: 4 },
          { t: "OR-instemming of advies voor relevante systemen", s: 5 }
        ]
      },
      {
        id: "trans-5",
        q: "Is er een klacht- of bezwaarmechanisme voor betrokkenen die door een AI-besluit geraakt worden?",
        options: [
          { t: "Geen specifiek mechanisme", s: 0 },
          { t: "Algemene klachtenprocedure", s: 2 },
          { t: "Specifiek AI-bezwaarproces", s: 4 },
          { t: "Inclusief recht op uitleg en menselijke review", s: 5 }
        ]
      },
      {
        id: "trans-6",
        q: "Bij geautomatiseerde besluiten met rechtsgevolg: is recht op uitleg en menselijke review ingericht? (AVG Art. 22 + AI Act Art. 86)",
        options: [
          { t: "Niet van toepassing", s: 4 },
          { t: "Wel van toepassing, niet ingericht", s: 0 },
          { t: "Op aanvraag beschikbaar", s: 3 },
          { t: "Standaard onderdeel van het proces", s: 5 }
        ]
      }
    ]
  },

  {
    id: "technical",
    name: "Data & technische waarborgen",
    icon: "🛡️",
    desc: "Datakwaliteit, bias, logging, human oversight en robustness.",
    questions: [
      {
        id: "tech-1",
        q: "Is er data-governance voor AI-input (kwaliteit, representativiteit, herkomst)?",
        options: [
          { t: "Geen specifieke governance", s: 0 },
          { t: "Voor enkele systemen", s: 2 },
          { t: "Gestandaardiseerd voor alle AI", s: 4 },
          { t: "Inclusief data-lineage en audit-trail", s: 5 }
        ]
      },
      {
        id: "tech-2",
        q: "Wordt bias / fairness van AI-systemen periodiek getoetst?",
        hint: "Voor high-risk AI verplicht (Art. 10). Ook voor lagere risico's aanbevolen — bias is een reputatie- en juridisch risico.",
        options: [
          { t: "Niet getoetst", s: 0 },
          { t: "Eenmalig bij ingebruikname", s: 2 },
          { t: "Periodieke tests", s: 4 },
          { t: "Continu monitored met alerts", s: 5 }
        ]
      },
      {
        id: "tech-3",
        q: "Wordt AI-gebruik en AI-besluitvorming gelogd?",
        hint: "Voor high-risk AI verplicht (Art. 12) met minimaal 6 maanden bewaring.",
        options: [
          { t: "Niet gelogd", s: 0 },
          { t: "Beperkte logs", s: 2 },
          { t: "Volledige logging conform Art. 12", s: 4 },
          { t: "Volledige logging + langetermijn-bewaring + SIEM-integratie", s: 5 }
        ]
      },
      {
        id: "tech-4",
        q: "Is human oversight ingericht voor AI-besluiten met impact op personen? (Art. 14)",
        options: [
          { t: "Geen oversight", s: 0 },
          { t: "Steekproef-review", s: 2 },
          { t: "Volledige review voor risicobesluiten", s: 4 },
          { t: "Met geboekstaafde human-in-the-loop", s: 5 }
        ]
      },
      {
        id: "tech-5",
        q: "Worden accuracy en robustness van AI-systemen getest? (Art. 15)",
        options: [
          { t: "Niet getest", s: 0 },
          { t: "Eenmalig bij ingebruikname", s: 2 },
          { t: "Periodieke tests", s: 4 },
          { t: "Continue monitoring + drift detection", s: 5 }
        ]
      },
      {
        id: "tech-6",
        q: "Cybersecurity rond AI-systemen (prompt injection, data poisoning, model theft)?",
        hint: "AI-specifieke threats: indirect prompt injection via documenten, jailbreaks, training data poisoning, model inversion.",
        options: [
          { t: "Geen specifieke aandacht", s: 0 },
          { t: "Generieke security policies", s: 2 },
          { t: "AI-specifieke threat modeling", s: 4 },
          { t: "Red-teaming en pentests inclusief AI-scenario's", s: 5 }
        ]
      },
      {
        id: "tech-7",
        q: "Voer je vendor due diligence uit op AI-leveranciers?",
        hint: "Compliance-status leverancier, documentatie (model cards), audit-rechten, incident-notificatie, data-locatie.",
        options: [
          { t: "Niet structureel", s: 0 },
          { t: "Alleen voor grote contracten", s: 2 },
          { t: "Voor alle AI-systemen", s: 4 },
          { t: "Met juridische standaardclausules (AI Act-proof contracten)", s: 5 }
        ]
      }
    ]
  },

  {
    id: "highrisk",
    name: "High-risk & GPAI verplichtingen",
    icon: "🚨",
    desc: "Conformity assessment, technische documentatie en post-market monitoring.",
    questions: [
      {
        id: "hr-1",
        q: "Is jullie organisatie provider van high-risk AI-systemen?",
        hint: "Provider = je ontwikkelt of laat ontwikkelen onder eigen merk. Als je alleen gebruikt, ben je Deployer — de volgende vragen zijn dan minder zwaar.",
        options: [
          { t: "Nee, alleen deployer / gebruiker", s: 4 },
          { t: "Onbekend", s: 0 },
          { t: "Ja, maar nog niet onder AI Act-eisen ingericht", s: 1 },
          { t: "Ja, en wij werken aan conformiteit", s: 4 },
          { t: "Ja, en volledig conform AI Act ingericht", s: 5 }
        ]
      },
      {
        id: "hr-2",
        q: "Voor providers van high-risk AI: is een conformity assessment uitgevoerd of gepland? (Art. 43)",
        dependsOn: { id: "hr-1", showIfOptionIn: [2, 3, 4] },
        options: [
          { t: "Niet uitgevoerd / geen plan", s: 0 },
          { t: "In voorbereiding", s: 2 },
          { t: "Uitgevoerd of in eindfase", s: 4 },
          { t: "Volledig conform + CE-marking aangebracht", s: 5 }
        ]
      },
      {
        id: "hr-3",
        q: "Is technische documentatie beschikbaar conform Annex IV? (Art. 11)",
        dependsOn: { id: "hr-1", showIfOptionIn: [2, 3, 4] },
        options: [
          { t: "Niet aanwezig", s: 0 },
          { t: "Gedeeltelijk", s: 2 },
          { t: "Volledig en actueel gehouden", s: 5 }
        ]
      },
      {
        id: "hr-4",
        q: "Is er een Quality Management System (QMS) conform Art. 17?",
        dependsOn: { id: "hr-1", showIfOptionIn: [2, 3, 4] },
        options: [
          { t: "Niet ingericht", s: 0 },
          { t: "In opbouw", s: 2 },
          { t: "Volledig ingericht", s: 5 }
        ]
      },
      {
        id: "hr-5",
        q: "Is er een post-market monitoring systeem voor high-risk AI? (Art. 72)",
        dependsOn: { id: "hr-1", showIfOptionIn: [2, 3, 4] },
        options: [
          { t: "Niet ingericht", s: 0 },
          { t: "In ontwerp", s: 2 },
          { t: "Operationeel", s: 5 }
        ]
      },
      {
        id: "hr-6",
        q: "Voor deployers van GPAI (zoals M365 Copilot): hebben jullie de leveranciersdocumentatie ontvangen en geanalyseerd?",
        hint: "GPAI-providers moeten downstream-deployers o.a. een model card / transparantierapport verstrekken. Voor Copilot publiceert Microsoft Service Trust Portal-docs.",
        options: [
          { t: "Niet ontvangen / niet bekeken", s: 0 },
          { t: "Ontvangen, niet geanalyseerd", s: 1 },
          { t: "Geanalyseerd door IT/Security", s: 3 },
          { t: "Geanalyseerd + opgenomen in eigen DPIA/FRIA + jaarlijkse review", s: 5 }
        ]
      },
      {
        id: "hr-7",
        q: "Worden contracten met AI-providers 'AI Act-proof' gemaakt? (rollen, data-rechten, audit, incident-notificatie)",
        options: [
          { t: "Niet structureel", s: 0 },
          { t: "Alleen voor nieuwe contracten", s: 2 },
          { t: "Alle contracten zijn of worden herzien", s: 4 },
          { t: "Met juridische standaardclausules", s: 5 }
        ]
      }
    ]
  }
];


function getTier(pct) {
  if (pct < 30) return {
    label: "Non-compliant",
    badge: "Non-compliant",
    cls: "status-noncompliant",
    summary: "Op meerdere kerngebieden van de AI Act ontbreken nog basis-waarborgen. Voor organisaties die met AI werken (inclusief Copilot) is dit een serieus risico — boetes lopen op tot €35 miljoen of 7% van de wereldwijde jaaromzet. Start direct met AI-literacy (Art. 4 was al per 2 feb 2025 verplicht) en een AI-register."
  };
  if (pct < 55) return {
    label: "Aware",
    badge: "Aware niveau",
    cls: "status-aware",
    summary: "Het bewustzijn is er, maar de uitvoering ontbreekt op te veel onderdelen. De handhavingsmijlpaal van 2 aug 2025 voor GPAI is voorbij en de volgende deadlines (2 aug 2026, 2027) komen snel. Maak van de aanbevelingen een formele roadmap met owners en deadlines."
  };
  if (pct < 80) return {
    label: "Progressing",
    badge: "Progressing niveau",
    cls: "status-progressing",
    summary: "De fundamenten staan en de governance-structuur is herkenbaar. Er zijn nog specifieke gaps die voor een handhaver moeilijk uit te leggen kunnen zijn — focus op afronden, niet op nog meer initiatieven starten."
  };
  return {
    label: "Compliant",
    badge: "Compliant niveau",
    cls: "status-compliant",
    summary: "Jullie hebben een volwassen AI-governance ingericht die op alle AI Act-assen verdedigbaar is. Focus nu op het in stand houden — periodieke reviews, actualisatie bij nieuwe richtsnoeren en uitbreiden naar nieuwe AI-use cases."
  };
}


function buildRecommendations(catScores) {
  const recs = [];

  catScores.forEach(c => {
    if (c.pct < 40) {
      switch (c.id) {
        case "inventory":
          recs.push({
            priority: "high",
            title: "Start onmiddellijk met een AI-inventaris en risicoclassificatie",
            text: "Zonder zicht op welke AI je gebruikt en met welke rol (provider/deployer), is geen enkele andere AI Act-verplichting na te komen. Bouw binnen 4–6 weken een centraal AI-register met owners, doel, leverancier, datatype en risicoklasse. Begin met de scan op verboden praktijken (Art. 5)."
          });
          break;
        case "literacy":
          recs.push({
            priority: "high",
            title: "AI-geletterdheid is al verplicht — start het programma deze maand",
            text: "Art. 4 geldt al sinds 2 feb 2025. Een handhaver kan op elk moment vragen om bewijs van gestructureerde AI-literacy voor staf die met AI werkt. Begin met basis-modules per persona (eindgebruikers, ontwikkelaars, decision-makers) en zorg dat deelname wordt vastgelegd in HR/LMS."
          });
          break;
        case "governance":
          recs.push({
            priority: "high",
            title: "Benoem een AI-Officer en publiceer een AI Use Policy",
            text: "Zonder duidelijke eigenaar en beleid verzandt elk compliance-traject. Wijs binnen 30 dagen een AI-Officer aan (mag een bestaande rol zijn — DPO, CISO, Compliance Officer), publiceer een basis-AI Use Policy en richt een eenvoudig risicoregister in."
          });
          break;
        case "transparency":
          recs.push({
            priority: "high",
            title: "Implementeer disclosure en betrek de OR",
            text: "Voor AI die werknemers raakt (zoals Copilot, monitoring, recruitment-AI) heeft de OR adviesrecht. Een AI-uitrol zonder OR-betrokkenheid is juridisch kwetsbaar. Combineer dit met disclosure-richtlijnen voor klant-facing AI (chatbots, gegenereerde content)."
          });
          break;
        case "technical":
          recs.push({
            priority: "high",
            title: "Richt logging en human oversight in voor besluiten met impact",
            text: "Zonder logs is geen audit, geen incidentonderzoek en geen aantoonbaarheid mogelijk. Voor AI die impact heeft op personen (HR, klantbesluiten) moet human-in-the-loop een gedocumenteerd proces zijn — niet een 'we kijken mee' belofte."
          });
          break;
        case "highrisk":
          recs.push({
            priority: "high",
            title: "Voor providers: start met technische documentatie en conformity assessment",
            text: "Annex IV-documentatie en conformity assessment zijn voor providers van high-risk AI niet-onderhandelbaar voor 2 augustus 2026. Voor deployers van GPAI: vraag bij Microsoft (of andere providers) de transparantie-documentatie op en analyseer hoe je deze in eigen DPIA/FRIA integreert."
          });
          break;
      }
    } else if (c.pct < 70) {
      switch (c.id) {
        case "inventory":
          recs.push({
            priority: "medium",
            title: "Maak de AI-inventaris compleet en herzie periodiek",
            text: "Schaduw-AI (persoonlijke ChatGPT-accounts, AI-features in SaaS) is een blinde vlek. Voer een organisatiebrede AI-scan uit en zet een quarterly review-cyclus op."
          });
          break;
        case "literacy":
          recs.push({
            priority: "medium",
            title: "Differentieer AI-literacy per rol en koppel aan onboarding",
            text: "Generieke training is een minimum — verdiep met persona-specifieke leerpaden voor ontwikkelaars, DPO's, managers en eindgebruikers. Maak het verplicht in onboarding."
          });
          break;
        case "governance":
          recs.push({
            priority: "medium",
            title: "Voer DPIA/FRIA uit en formaliseer escalatielijnen",
            text: "Op papier benoemde rollen zijn niet genoeg — leg vast wie beslist over AI-incidenten en zorg dat AI-risico's vast onderdeel zijn van risk-reporting aan directie."
          });
          break;
        case "transparency":
          recs.push({
            priority: "medium",
            title: "Verbreed transparantie naar gegenereerde content en deepfakes",
            text: "Disclosure bij chatbots is een goede start — voeg labeling/watermarking van AI-content toe en richt een klacht-/bezwaarproces in voor betrokkenen."
          });
          break;
        case "technical":
          recs.push({
            priority: "medium",
            title: "Voer periodieke bias- en robustness-tests in",
            text: "Eenmalige tests bij ingebruikname dekken model drift niet. Plan minimaal half-jaarlijkse bias-audits en pentests op AI-specifieke threats (prompt injection, data poisoning)."
          });
          break;
        case "highrisk":
          recs.push({
            priority: "medium",
            title: "Maak contracten met AI-providers AI-Act-proof",
            text: "Borg in contracten: rolverdeling provider/deployer, audit-rechten, incident-notificatie binnen X dagen, data-locatie en aansprakelijkheid bij compliance-issues."
          });
          break;
      }
    } else if (c.pct < 90) {
      switch (c.id) {
        case "inventory":
          recs.push({
            priority: "low",
            title: "Automatiseer monitoring op nieuwe AI-systemen",
            text: "Integreer AI-register met IT asset management of CMDB zodat nieuwe AI-tools automatisch in scope komen."
          });
          break;
        case "literacy":
          recs.push({
            priority: "low",
            title: "Meet effectiviteit van AI-literacy",
            text: "Voeg pre/post-assessments toe om aan te tonen dat het programma resultaat oplevert — sterk bij eventuele handhaving."
          });
          break;
        case "governance":
          recs.push({
            priority: "low",
            title: "Bereid je voor op evoluerende richtsnoeren",
            text: "De EU AI Office publiceert doorlopend richtsnoeren. Plan een halfjaarlijkse review van je governance-frame tegen de meest recente guidance."
          });
          break;
        case "transparency":
          recs.push({
            priority: "low",
            title: "Documenteer transparantie-keuzes per AI-systeem",
            text: "Maak per AI-systeem een one-pager met disclosure-aanpak en motivatie — handig bij audits en transparantie-vragen van betrokkenen."
          });
          break;
        case "technical":
          recs.push({
            priority: "low",
            title: "Integreer AI-logging met SIEM en threat detection",
            text: "Tilt AI-logs naar een security-eindpunt zodat afwijkend gedrag (prompt injection patterns, ongebruikelijke prompts) automatisch wordt gedetecteerd."
          });
          break;
        case "highrisk":
          recs.push({
            priority: "low",
            title: "Bereid voor op nieuwe GPAI-richtsnoeren",
            text: "GPAI-regels zijn van toepassing sinds aug 2025; verdere richtsnoeren volgen. Houd vinger aan de pols bij Microsoft, OpenAI, Anthropic en EU AI Office publicaties."
          });
          break;
      }
    }
  });

  const order = { high: 0, medium: 1, low: 2 };
  recs.sort((a, b) => order[a.priority] - order[b.priority]);

  if (recs.length === 0) {
    recs.push({
      priority: "low",
      title: "Compliance ziet er volwassen uit — focus op continuïteit",
      text: "Sterke baseline. Investeer nu in monitoring van veranderende richtsnoeren, periodieke reviews en uitbreiding van het governance-frame naar nieuwe AI-use cases en agents."
    });
  }
  return recs;
}

