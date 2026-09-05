- 





← Andere assessments

Noppa · EU AI Act Compliance

# Voldoet jullie organisatie aan de *EU AI Act*?


De AI Act is sinds 1 augustus 2024 in werking. AI-geletterdheid (artikel 4) geldt al sinds 2 februari 2025 — verplicht voor iedereen die met AI werkt. Met dit assessment krijg je binnen 15 minuten een eerlijk beeld van jullie compliance-status en de prioriteiten richting de volgende handhavingsmijlpalen.


~15 minuten
39 vragen + follow-ups
Risico-geprioriteerd rapport










Voor wie

## Een eerlijk vertrekpunt voor jullie *AI-governance*


Dit assessment is bedoeld voor compliance officers, DPO's, juristen, CIO's en bestuurders die willen weten waar hun organisatie staat ten opzichte van de EU AI Act — als deployer van AI-systemen (zoals Microsoft 365 Copilot), als provider van AI, of beide. We dekken de zes assen die handhavers zullen toetsen.




①

### AI-inventaris &amp; rol


Welke AI gebruik je, met welke rol (provider, deployer) en risicoklasse?



②

### AI-geletterdheid (Art. 4)


Verplicht sinds 2 feb 2025 voor alle staf die met AI werkt.



③

### Governance &amp; verantwoording


AI Officer, policy, DPIA/FRIA, risicoregister en escalatie.



④

### Transparantie &amp; rechten


Disclosure, watermarking, OR-betrokkenheid, recht op uitleg.



⑤

### Data &amp; technische waarborgen


Datakwaliteit, bias, logging, human oversight, robustness.



⑥

### High-risk &amp; GPAI verplichtingen


Conformity assessment, technische documentatie en post-market monitoring.






### De belangrijkste *deadlines* op een rij


1 aug 2024 AI Act in werking getreden

- 2 feb 2025 Verbod op onaanvaardbare AI-praktijken + AI-geletterdheid (Art. 4) verplicht

- 2 aug 2025 Regels voor General-Purpose AI (GPAI) van toepassing — denk aan governance van Copilot, ChatGPT, etc.

- 2 aug 2026 Volledige toepassing op nieuwe high-risk AI-systemen (Annex III)

- 2 aug 2027 Volledige toepassing voor high-risk AI in gereguleerde sectoren (Annex I)







Stap 1 van 7

## Vertel ons kort iets over *jullie organisatie*


Deze gegevens helpen het rapport in context te plaatsen. Niets wordt opgeslagen of doorgestuurd zonder toestemming.




Organisatienaam *



Jouw naam *



E-mailadres *



Jouw rol

Selecteer...
Compliance Officer / Privacy Officer / DPO
Legal / Bedrijfsjurist
CIO / CTO / IT-manager
CISO / Security
Risk Manager
Bestuurder / Directie
Consultant / Advies
Anders



Sector

Selecteer...
Zorg
Financiële dienstverlening
Overheid / publieke sector
Onderwijs
Industrie / productie
Retail / e-commerce
Zakelijke dienstverlening
Bouw / vastgoed
HR / recruitment
Anders






Start het assessment →











**Stap 2 van 7** · AI-inventaris
**0%** voltooid







← Vorige
Volgende →











Status

## EU AI Act Compliance Score

0%
Op basis van 39 vragen verdeeld over 6 categorieën







🔓


### Ontgrendel jullie *volledige rapport*


Vul je gegevens in om de gedetailleerde score per categorie en risico-geprioriteerde aanbevelingen te zien — én een kopie per e-mail te ontvangen.






- Score per categorie

- Geprioriteerde compliance-acties

- Rapport per e-mail

- Verwijzingen naar relevante artikelen






Naam *
E-mailadres *
Bedrijfsnaam *
Telefoonnummer (optioneel)




Ja, ik ga akkoord dat Noppa mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.



**Privacy:** jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail info@noppa.nl.


Ontgrendel mijn rapport →





Score per categorie

## Hoe jullie scoren per *compliance-as*


Bekijk waar de basis op orde is en waar urgente compliance-gaps zitten.





Aanbevelingen

## Wat moet er *eerst* gebeuren?


Geprioriteerde acties op basis van handhavingsmijlpalen en risico. Hoge prioriteit = vereist op korte termijn.





**Disclaimer:** dit assessment biedt een indicatieve zelfevaluatie en is geen juridisch advies. De interpretatie van de AI Act blijft op onderdelen onderhevig aan ontwikkeling (richtsnoeren van de EU AI Office, geharmoniseerde normen, jurisprudentie). Voor een formeel compliance-oordeel raadpleeg een gekwalificeerd jurist of compliance-specialist.




### Klaar voor een grondige compliance-review?


Noppa helpt organisaties met AI-governance, AI-literacy programma's, DPIA/FRIA en het inrichten van duurzame compliance — toegespitst op Microsoft 365 Copilot en bredere AI-portfolio's.


📄 Download als PDF
Plan een gesprek →







Score per categorie

## Hoe jullie scoren per *compliance-as*


●●● ●●●●●●●%●●●●●●●●●●
●●● ●●●●●●●%●●●●●●●●●●
●●● ●●●●●●●%●●●●●●●●●●



🔒
**Vul het formulier hierboven in**
om de volledige analyse te ontgrendelen




↺ Opnieuw beginnen











/* =========================================================
⚙️  CONFIGURATIE — lead delivery
========================================================= */
const CONFIG = {
PHP_BACKEND_ENDPOINT: "api/submit.php",
MAILTO_FALLBACK: "info@noppa.nl",
COMPANY_NAME: "Noppa",
ENABLE_LOCAL_RESUME: true,
QUEUE_KEY: "bg_aiact_pending_v1",
QUEUE_MAX_AGE_DAYS: 30
};

/* =========================================================
ASSESSMENT DATA — EU AI Act
========================================================= */
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

/* =========================================================
STATE
========================================================= */
let currentScreen = "intro";
let currentCatIndex = 0;
const answers = {};

function isQuestionVisible(q) {
if (!q.dependsOn) return true;
const dep = answers[q.dependsOn.id];
if (!dep) return false;
return q.dependsOn.showIfOptionIn.includes(dep.optionIndex);
}
function getVisibleQuestions(cat) { return cat.questions.filter(isQuestionVisible); }
function getTotalVisibleQuestions() {
return CATEGORIES.reduce((acc, c) => acc + getVisibleQuestions(c).length, 0);
}
function getMaxPossibleQuestions() {
return CATEGORIES.reduce((acc, c) => acc + c.questions.length, 0);
}

/* =========================================================
NAV
========================================================= */
function showScreen(id) {
document.querySelectorAll(".screen").forEach(s => s.classList.remove("active"));
document.getElementById("screen-" + id).classList.add("active");
window.scrollTo({ top: 0, behavior: "smooth" });
currentScreen = id;
}

function nextScreen() {
if (currentScreen === "intro") {
currentCatIndex = 0;
renderCategory();
showScreen("questions");
}
}

function renderCategory() {
const cat = CATEGORIES[currentCatIndex];
const container = document.getElementById("category-container");

let html = `

${cat.icon}

${cat.name}
${cat.desc}


`;

let displayIndex = 0;
cat.questions.forEach((q) => {
if (!isQuestionVisible(q)) return;
displayIndex++;
const isFollowUp = !!q.dependsOn;
const qKey = q.id;
const a = answers[qKey];
const answered = a !== undefined;
const maxScore = Math.max(...q.options.map(o => o.s));

html += `

${isFollowUp ? 'Vervolgvraag' : ''}

${displayIndex}
${q.q}

${q.hint ? `${q.hint}` : ''}

${q.options.map((o, oi) => `


${o.t}

`).join("")}


`;
});

container.innerHTML = html;

const stepNum = currentCatIndex + 2;
const totalSteps = CATEGORIES.length + 1;
document.getElementById("progress-step").textContent = `Stap ${stepNum} van ${totalSteps}`;
document.getElementById("progress-cat-name").textContent = cat.name;
updateProgress();

document.getElementById("btn-prev").style.visibility = currentCatIndex === 0 ? "hidden" : "visible";
const btnNext = document.getElementById("btn-next");
btnNext.textContent = currentCatIndex === CATEGORIES.length - 1 ? "Bekijk mijn rapport →" : "Volgende →";
}

function recordAnswer(key, score, optionIndex, maxScore) {
answers[key] = { score: Number(score), optionIndex, maxScore };
saveProgress();
renderCategory();
const nextUnanswered = getVisibleQuestions(CATEGORIES[currentCatIndex])
.find(q => answers[q.id] === undefined);
if (nextUnanswered) {
const el = document.getElementById("q-" + nextUnanswered.id);
if (el) el.scrollIntoView({ behavior: "smooth", block: "center" });
}
}

function updateProgress() {
const totalVisible = getTotalVisibleQuestions();
const answered = Object.keys(answers).filter(k => {
const cat = CATEGORIES.find(c => c.questions.some(q => q.id === k));
if (!cat) return false;
const q = cat.questions.find(x => x.id === k);
return isQuestionVisible(q);
}).length;
const pct = totalVisible > 0 ? Math.round((answered / totalVisible) * 100) : 0;
document.getElementById("progress-fill").style.width = pct + "%";
document.getElementById("progress-pct").textContent = pct + "%";
}

function nextCategory() {
const cat = CATEGORIES[currentCatIndex];
const visibleQs = getVisibleQuestions(cat);
const firstUnanswered = visibleQs.find(q => answers[q.id] === undefined);
if (firstUnanswered) {
const el = document.getElementById("q-" + firstUnanswered.id);
if (el) {
el.classList.add("question-error-flash");
el.scrollIntoView({ behavior: "smooth", block: "center" });
setTimeout(() => el.classList.remove("question-error-flash"), 1200);
}
return;
}
if (currentCatIndex  0) {
currentCatIndex--;
renderCategory();
}
}

/* =========================================================
RESULTS
========================================================= */
let lastResults = null;

function showResults() {
const catScores = CATEGORIES.map(cat => {
let earned = 0, max = 0;
getVisibleQuestions(cat).forEach((q) => {
const a = answers[q.id];
if (!a) return;
earned += a.score;
max += a.maxScore;
});
const pct = max > 0 ? Math.round((earned / max) * 100) : 0;
return { ...cat, earned, max, pct };
});

const totalEarned = catScores.reduce((a, c) => a + c.earned, 0);
const totalMax = catScores.reduce((a, c) => a + c.max, 0);
const overallPct = Math.round((totalEarned / totalMax) * 100);

const tier = getTier(overallPct);
const recs = buildRecommendations(catScores);
lastResults = { catScores, overallPct, tier, recs };

const badge = document.getElementById("result-status-badge");
badge.textContent = tier.badge;
badge.className = "result-status " + tier.cls;

document.getElementById("result-score").textContent = overallPct + "%";
const org = document.getElementById("org-name").value.trim() || "Jullie organisatie";
document.getElementById("result-title").innerHTML = `${org} · *${tier.label}*`;
document.getElementById("result-summary").textContent = tier.summary;

const intakeOrg = document.getElementById("org-name").value.trim();
const intakeName = document.getElementById("org-contact").value.trim();
if (intakeOrg && !document.getElementById("lead-company").value) document.getElementById("lead-company").value = intakeOrg;
if (intakeName && !document.getElementById("lead-name").value) document.getElementById("lead-name").value = intakeName;

document.getElementById("gated-content").classList.add("hidden");
document.getElementById("gated-teaser").classList.remove("hidden");
document.getElementById("lead-gate").classList.remove("hidden");
document.getElementById("lead-status").className = "lead-status";
document.getElementById("lead-status").textContent = "";

showScreen("result");
}

function unlockGatedContent() {
if (!lastResults) return;
const { catScores, recs } = lastResults;

const grid = document.getElementById("score-breakdown");
grid.innerHTML = catScores.map(c => {
const status = c.pct >= 75 ? "Compliant" :
c.pct >= 50 ? "Op koers, gaps te dichten" :
c.pct >= 25 ? "Aware — actie vereist" : "Kritieke compliance-gap";
return `


${c.icon} ${c.name}
${c.pct}%


${status}

`;
}).join("");

document.getElementById("recommendations").innerHTML = recs.map(r => `

- 
${r.priority === "high" ? "Hoog" : r.priority === "medium" ? "Medium" : "Laag"}
**${r.title}.** ${r.text}

`).join("");

document.getElementById("gated-teaser").classList.add("hidden");
document.getElementById("gated-content").classList.remove("hidden");
}

function getTier(pct) {
if (pct  {
if (c.pct  order[a.priority] - order[b.priority]);

if (recs.length === 0) {
recs.push({
priority: "low",
title: "Compliance ziet er volwassen uit — focus op continuïteit",
text: "Sterke baseline. Investeer nu in monitoring van veranderende richtsnoeren, periodieke reviews en uitbreiding van het governance-frame naar nieuwe AI-use cases en agents."
});
}
return recs;
}

/* =========================================================
LEAD DELIVERY
========================================================= */
async function submitLead(e) {
e.preventDefault();
if (!lastResults) return;

const status = document.getElementById("lead-status");
const btn = document.getElementById("lead-submit");

const lead = {
name:    document.getElementById("org-contact").value.trim(),
email:   document.getElementById("org-email").value.trim(),
company: document.getElementById("org-name").value.trim(),
phone:   document.getElementById("lead-phone")?.value.trim() || "",
consent: document.getElementById("lead-consent").checked
};

if (!lead.name || !lead.email || !lead.company || !lead.consent) {
status.className = "lead-status error";
status.textContent = "Vul de verplichte velden in en geef toestemming.";
return;
}

btn.disabled = true;
btn.textContent = "Verzenden...";

const payload = buildLeadPayload(lead);
const delivered = await attemptDelivery(payload);

if (!delivered) {
enqueueSubmission(payload);
}

status.className = "lead-status success";
if (delivered) {
status.innerHTML = `✓ Verzonden! Je rapport is ontgrendeld hieronder. We hebben je gegevens automatisch doorgestuurd naar Noppa en je ontvangt een kopie op **${lead.email}**.`;
} else {
status.innerHTML =
`✓ Je rapport is ontgrendeld hieronder. We hebben je inzending **veilig opgeslagen** en versturen deze automatisch zodra de verbinding hersteld is. ` +
`Wil je nu zelf een kopie naar Noppa sturen? ` +
`Verstuur via mijn mailclient`;
}

btn.textContent = "Rapport ontgrendeld ✓";
document.getElementById("lead-gate").classList.add("hidden");
unlockGatedContent();
window.scrollTo({ top: 0, behavior: "smooth" });
}

/* Active delivery attempt — tries Formspree and Power Automate in parallel */
async function attemptDelivery(payload) {
const attempts = [];

if (CONFIG.FORMSPREE_ENDPOINT && !CONFIG.FORMSPREE_ENDPOINT.includes("YOUR_FORM_ID")) {
attempts.push(
fetch(CONFIG.FORMSPREE_ENDPOINT, {
method: "POST",
headers: { "Content-Type": "application/json", "Accept": "application/json" },
body: JSON.stringify(payload)
}).then(r => r.ok).catch(() => false)
);
}

if (CONFIG.POWER_AUTOMATE_WEBHOOK) {
attempts.push(
fetch(CONFIG.POWER_AUTOMATE_WEBHOOK, {
method: "POST",
headers: { "Content-Type": "application/json" },
body: JSON.stringify(payload)
}).then(r => r.ok).catch(() => false)
);
}

if (attempts.length === 0) return false;
const results = await Promise.all(attempts);
return results.some(Boolean);
}

/* Queue + auto-retry — guarantees no submission is lost when endpoints are
not configured or temporarily unreachable. Entries are retried silently
on every subsequent page load, and surfaced as a one-click manual send. */
function readQueue() {
try {
const raw = localStorage.getItem(CONFIG.QUEUE_KEY);
if (!raw) return [];
const list = JSON.parse(raw);
return Array.isArray(list) ? list : [];
} catch (_) { return []; }
}

function writeQueue(list) {
try { localStorage.setItem(CONFIG.QUEUE_KEY, JSON.stringify(list)); } catch (_) {}
}

function enqueueSubmission(payload) {
const list = readQueue();
list.push({
id: "sub_" + Date.now() + "_" + Math.random().toString(36).slice(2, 8),
queuedAt: new Date().toISOString(),
attempts: 0,
payload: payload
});
writeQueue(list);
}

async function flushQueue() {
const now = Date.now();
const maxAge = CONFIG.QUEUE_MAX_AGE_DAYS * 86400000;
let list = readQueue().filter(e => (now - new Date(e.queuedAt).getTime())  {
let qNum = 0;
const lines = getVisibleQuestions(cat).map((q) => {
qNum++;
const a = answers[q.id];
if (!a) return `  ${qNum}. ${q.q}\n     → (geen antwoord)`;
const opt = q.options[a.optionIndex];
const followUpMarker = q.dependsOn ? " [vervolgvraag]" : "";
return `  ${qNum}.${followUpMarker} ${q.q}\n     → ${opt.t} (${a.score}/${a.maxScore})`;
}).join("\n");
const cs = catScores.find(c => c.id === cat.id);
return `${cat.name.toUpperCase()} — ${cs.pct}%\n${lines}`;
}).join("\n\n");

const recText = recs.map(r => `[${r.priority.toUpperCase()}] ${r.title}: ${r.text}`).join("\n\n");

return {
naam: lead.name,
email: lead.email,
bedrijf: lead.company,
telefoon: lead.phone || "(niet opgegeven)",
toestemming: lead.consent ? "Ja" : "Nee",
organisatie: document.getElementById("org-name").value.trim() || "",
rol: document.getElementById("org-role").value || "",
sector: document.getElementById("org-sector").value || "",
score_totaal: overallPct + "%",
status: tier.label,
assessment_type: "EU AI Act Compliance",
score_per_categorie: catScores.map(c => `${c.name}: ${c.pct}%`).join(" | "),
samenvatting: tier.summary,
antwoorden: answersText,
aanbevelingen: recText,
tijdstip: new Date().toISOString(),
bron: "EU AI Act Compliance Assessment (Noppa)",
_subject: `AI Act Compliance — ${lead.company} (${overallPct}%, ${tier.label})`
};
}

function openMailtoFallback(lead, payload) {
const subject = encodeURIComponent(`EU AI Act Compliance Assessment — ${lead.company}`);
const body = encodeURIComponent(
`Beste Noppa,

Hierbij mijn ingevulde EU AI Act Compliance Assessment.

CONTACT
Naam:       ${lead.name}
E-mail:     ${lead.email}
Bedrijf:    ${lead.company}
Telefoon:   ${lead.phone || "(niet opgegeven)"}
Rol:        ${payload.rol}
Sector:     ${payload.sector}

SCORE
Totaal:     ${payload.score_totaal}
Status:     ${payload.status}
${payload.score_per_categorie.split(" | ").map(s => "  " + s).join("\n")}

SAMENVATTING
${payload.samenvatting}

ANTWOORDEN
${payload.antwoorden}

AANBEVELINGEN
${payload.aanbevelingen}

—
Verzonden via het online AI Act Compliance Assessment (${new Date().toLocaleString("nl-NL")})
`
);
window.location.href = `mailto:${CONFIG.MAILTO_FALLBACK}?cc=${encodeURIComponent(lead.email)}&subject=${subject}&body=${body}`;
}

/* =========================================================
LOCAL PROGRESS
========================================================= */
const STORAGE_KEY = "bg_aiact_assessment_v1";

function saveProgress() {
if (!CONFIG.ENABLE_LOCAL_RESUME) return;
try {
const state = {
answers,
intake: {
org:     document.getElementById("org-name")?.value || "",
contact: document.getElementById("org-contact")?.value || "",
role:    document.getElementById("org-role")?.value || "",
sector:  document.getElementById("org-sector")?.value || "", email: document.getElementById("org-email")?.value || ""
},
ts: Date.now()
};
localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
} catch (e) {}
}
function loadProgress() {
if (!CONFIG.ENABLE_LOCAL_RESUME) return false;
try {
const raw = localStorage.getItem(STORAGE_KEY);
if (!raw) return false;
const state = JSON.parse(raw);
if (Date.now() - state.ts > 14 * 24 * 60 * 60 * 1000) {
localStorage.removeItem(STORAGE_KEY);
return false;
}
Object.assign(answers, state.answers || {});
if (state.intake) {
const fields = { "org-name": state.intake.org, "org-contact": state.intake.contact, "org-role": state.intake.role, "org-sector": state.intake.sector };
Object.entries(fields).forEach(([id, val]) => {
const el = document.getElementById(id);
if (el && val) el.value = val;
});
}
return Object.keys(answers).length > 0;
} catch (e) { return false; }
}
function clearProgress() { try { localStorage.removeItem(STORAGE_KEY); } catch (e) {} }

/* =========================================================
PDF GENERATIE — Noppa brand guidelines
========================================================= */
const PDF_BRAND = {
geel:        [242, 184, 44],
geelDonker:  [201, 148, 13],
donker:      [24, 34, 43],
donker2:     [16, 24, 32],
grijs:       [107, 114, 128],
licht:       [246, 245, 240],
border:      [229, 231, 235],
wit:         [255, 255, 255]
};
const PDF_META = {
title:    "EU AI Act Compliance Assessment",
subtitle: "Compliance-status onder de Europese AI-verordening",
product:  "Noppa · AI Governance",
url:      "noppa.nl"
};

function generatePDF() {
if (!lastResults || typeof window.jspdf === "undefined") {
alert("Het PDF-rapport kan nog niet worden gegenereerd. Probeer opnieuw of vernieuw de pagina.");
return;
}

const { jsPDF } = window.jspdf;
const doc = new jsPDF({ orientation: "portrait", unit: "mm", format: "a4" });
const { catScores, overallPct, tier, recs } = lastResults;
const B = PDF_BRAND, M = 18, W = 210, H = 297;

const org = document.getElementById("lead-company")?.value.trim()
|| document.getElementById("org-name")?.value.trim()
|| "Jullie organisatie";
const today = new Date().toLocaleDateString("nl-NL", { day: "numeric", month: "long", year: "numeric" });

/* COVER */
doc.setFillColor(...B.donker); doc.rect(0, 0, W, H, "F");
doc.setFillColor(...B.cyan); doc.rect(0, 0, W, 5, "F");
for (let i = 50; i >= 10; i -= 10) {
doc.setFillColor(...B.cyan);
doc.setGState(new doc.GState({ opacity: 0.025 }));
doc.circle(180, 60, i, "F");
}
doc.setGState(new doc.GState({ opacity: 1 }));

doc.setFont("helvetica", "bold"); doc.setFontSize(12);
doc.setTextColor(...B.cyan); doc.text("Noppa", M, 24);
doc.setFont("helvetica", "normal"); doc.setFontSize(8);
doc.setTextColor(255, 255, 255); doc.text(PDF_META.product, M, 29);

doc.setFont("helvetica", "bold"); doc.setFontSize(8.5);
doc.setTextColor(...B.cyan);
doc.text(PDF_META.title.toUpperCase(), M, 105, { charSpace: 1 });

doc.setFontSize(34); doc.setTextColor(255, 255, 255);
doc.text("Compliance", M, 122);
doc.setTextColor(...B.cyan); doc.text("Rapport", M, 137);

doc.setFont("helvetica", "normal"); doc.setFontSize(11);
doc.setTextColor(220, 220, 220);
doc.text("Opgesteld voor:", M, 158);
doc.setFont("helvetica", "bold"); doc.setFontSize(16); doc.setTextColor(...B.wit);
doc.text(org, M, 167);

doc.setFont("helvetica", "normal"); doc.setFontSize(9);
doc.setTextColor(180, 180, 180); doc.text(`Datum  ·  ${today}`, M, 175);

// Score block
doc.setFillColor(...B.cyan); doc.roundedRect(M, 195, W - 2*M, 62, 5, 5, "F");
doc.setFont("helvetica", "bold"); doc.setFontSize(8.5);
doc.setTextColor(...B.donker);
doc.text("EU AI ACT COMPLIANCE SCORE", M + 10, 209, { charSpace: 1 });

doc.setFontSize(52); doc.text(`${overallPct}%`, M + 10, 240);

doc.setFillColor(...B.donker); doc.roundedRect(W - M - 65, 217, 55, 12, 6, 6, "F");
doc.setTextColor(...B.cyan); doc.setFontSize(8);
doc.text(tier.label.toUpperCase(), W - M - 37.5, 224.5, { align: "center", charSpace: 1 });

doc.setFont("helvetica", "normal"); doc.setFontSize(9);
doc.setTextColor(...B.donker);
doc.text(`Status: ${tier.label}`, M + 10, 250);

doc.setFont("helvetica", "normal"); doc.setFontSize(7.5);
doc.setTextColor(150, 150, 150);
doc.text("Vertrouwelijk · Indicatieve zelfevaluatie · Geen juridisch advies", M, H - 18);
doc.text(PDF_META.url, W - M, H - 18, { align: "right" });

/* PAGE 2 — SAMENVATTING */
doc.addPage();
drawPageHeader(doc, "Samenvatting");

doc.setFont("helvetica", "bold"); doc.setFontSize(8);
doc.setTextColor(...B.cyanDonker);
doc.text("COMPLIANCE STATUS", M, 38, { charSpace: 1 });

doc.setFontSize(22); doc.setTextColor(...B.donker);
const orgTitle = doc.splitTextToSize(`${org} · ${tier.label}`, W - 2*M);
doc.text(orgTitle, M, 48);
let y = 48 + orgTitle.length * 8 + 4;

const badgeColor = {
"Non-compliant": [239, 68, 68],
"Aware": B.cyan,
"Progressing": [123, 180, 184],
"Compliant": [34, 197, 94]
}[tier.label] || B.cyan;
const badgeW = doc.getTextWidth(tier.badge) + 12;
doc.setFillColor(...badgeColor);
doc.roundedRect(M, y - 5, badgeW, 9, 4.5, 4.5, "F");
doc.setFontSize(8); doc.setFont("helvetica", "bold"); doc.setTextColor(...B.wit);
doc.text(tier.badge.toUpperCase(), M + 6, y + 0.5, { charSpace: 1 });
y += 12;

doc.setFont("helvetica", "normal"); doc.setFontSize(10.5);
doc.setTextColor(...B.grijs);
const summaryLines = doc.splitTextToSize(tier.summary, W - 2*M);
doc.text(summaryLines, M, y, { lineHeightFactor: 1.5 });
y += summaryLines.length * 5.2 + 10;

doc.setFont("helvetica", "bold"); doc.setFontSize(8);
doc.setTextColor(...B.cyanDonker);
doc.text("SCORE PER CATEGORIE", M, y, { charSpace: 1 });
y += 4;
doc.setFontSize(15); doc.setTextColor(...B.donker);
doc.text("Hoe jullie scoren per compliance-as", M, y + 6);
y += 14;

catScores.forEach(c => {
if (y > H - 50) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Samenvatting (vervolg)"); y = 40; }

const status = c.pct >= 75 ? "Compliant"
: c.pct >= 50 ? "Op koers, gaps te dichten"
: c.pct >= 25 ? "Aware — actie vereist"
: "Kritieke compliance-gap";

doc.setFillColor(...B.wit);
doc.setDrawColor(...B.border);
doc.roundedRect(M, y, W - 2*M, 23, 2.5, 2.5, "FD");

doc.setFont("helvetica", "bold"); doc.setFontSize(10.5);
doc.setTextColor(...B.donker);
doc.text(c.name, M + 6, y + 8);

doc.setFontSize(16); doc.setTextColor(...B.cyanDonker);
doc.text(`${c.pct}%`, W - M - 6, y + 9, { align: "right" });

doc.setFillColor(...B.border);
doc.roundedRect(M + 6, y + 12, W - 2*M - 12, 2.5, 1.25, 1.25, "F");
const fillW = (W - 2*M - 12) * (c.pct / 100);
if (fillW > 0) {
doc.setFillColor(...B.cyan);
doc.roundedRect(M + 6, y + 12, fillW, 2.5, 1.25, 1.25, "F");
}

doc.setFont("helvetica", "normal"); doc.setFontSize(8.5);
doc.setTextColor(...B.grijs);
doc.text(status, M + 6, y + 20);

y += 27;
});

addPageFooter(doc);

/* PAGE 3 — AANBEVELINGEN */
doc.addPage();
drawPageHeader(doc, "Aanbevelingen");

doc.setFont("helvetica", "bold"); doc.setFontSize(8);
doc.setTextColor(...B.cyanDonker);
doc.text("PRIORITEITEN", M, 38, { charSpace: 1 });
doc.setFontSize(22); doc.setTextColor(...B.donker);
doc.text("Wat moet er eerst gebeuren?", M, 48);

doc.setFont("helvetica", "normal"); doc.setFontSize(10);
doc.setTextColor(...B.grijs);
const introRec = doc.splitTextToSize("Geprioriteerde acties op basis van handhavingsmijlpalen en risico. Hoge prioriteit zijn juridische verplichtingen die niet kunnen wachten; medium en laag bouwen aan duurzame governance.", W - 2*M);
doc.text(introRec, M, 56, { lineHeightFactor: 1.45 });
y = 56 + introRec.length * 5 + 8;

const PRI = {
high:   { color: [239, 68, 68],   label: "HOOG" },
medium: { color: B.cyan,           label: "MEDIUM" },
low:    { color: [123, 180, 184],  label: "LAAG" }
};

recs.forEach(r => {
const pri = PRI[r.priority];
const titleLines = doc.splitTextToSize(r.title, W - 2*M - 12);
const textLines = doc.splitTextToSize(r.text, W - 2*M - 12);
const cardH = 10 + titleLines.length * 5.5 + textLines.length * 4.5 + 4;

if (y + cardH > H - 25) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Aanbevelingen (vervolg)"); y = 40; }

doc.setFillColor(...B.wit); doc.setDrawColor(...B.border);
doc.roundedRect(M, y, W - 2*M, cardH, 2, 2, "FD");
doc.setFillColor(...pri.color);
doc.rect(M, y, 2.2, cardH, "F");

doc.setFillColor(...pri.color); doc.setGState(new doc.GState({ opacity: 0.15 }));
const badgeWPri = doc.getTextWidth(pri.label) + 8;
doc.roundedRect(M + 6, y + 5, badgeWPri, 5, 2.5, 2.5, "F");
doc.setGState(new doc.GState({ opacity: 1 }));
doc.setFont("helvetica", "bold"); doc.setFontSize(7);
doc.setTextColor(...pri.color);
doc.text(pri.label, M + 6 + badgeWPri/2, y + 8.5, { align: "center", charSpace: 1 });

doc.setFontSize(10.5); doc.setTextColor(...B.donker);
doc.text(titleLines, M + 6, y + 16, { lineHeightFactor: 1.3 });

doc.setFont("helvetica", "normal"); doc.setFontSize(9);
doc.setTextColor(...B.grijs);
doc.text(textLines, M + 6, y + 16 + titleLines.length * 5.5 + 1, { lineHeightFactor: 1.5 });

y += cardH + 4;
});

// Legal disclaimer block
if (y + 30 > H - 25) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Aanbevelingen (vervolg)"); y = 40; }
doc.setFillColor(...B.licht);
doc.setDrawColor(...B.cyan);
doc.setLineWidth(0.5);
doc.roundedRect(M, y + 4, W - 2*M, 22, 2, 2, "FD");
doc.setFont("helvetica", "bold"); doc.setFontSize(8);
doc.setTextColor(...B.donker);
doc.text("DISCLAIMER", M + 5, y + 10, { charSpace: 1 });
doc.setFont("helvetica", "normal"); doc.setFontSize(8);
doc.setTextColor(...B.grijs);
const disc = doc.splitTextToSize("Dit assessment biedt een indicatieve zelfevaluatie en is geen juridisch advies. De interpretatie van de AI Act blijft op onderdelen onderhevig aan ontwikkeling (richtsnoeren EU AI Office, geharmoniseerde normen, jurisprudentie). Raadpleeg voor een formeel oordeel een gekwalificeerd jurist.", W - 2*M - 10);
doc.text(disc, M + 5, y + 15, { lineHeightFactor: 1.3 });

addPageFooter(doc);

/* BIJLAGE — ANTWOORDEN */
doc.addPage();
drawPageHeader(doc, "Bijlage — Antwoorden");

doc.setFont("helvetica", "bold"); doc.setFontSize(8);
doc.setTextColor(...B.cyanDonker);
doc.text("BIJLAGE", M, 38, { charSpace: 1 });
doc.setFontSize(22); doc.setTextColor(...B.donker);
doc.text("Volledige antwoorden", M, 48);

y = 60;
CATEGORIES.forEach(cat => {
if (y > H - 30) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Bijlage — Antwoorden (vervolg)"); y = 40; }

doc.setFillColor(...B.donker);
doc.roundedRect(M, y, W - 2*M, 8, 2, 2, "F");
const cs = catScores.find(c => c.id === cat.id);
doc.setFont("helvetica", "bold"); doc.setFontSize(9);
doc.setTextColor(...B.wit);
doc.text(cat.name.toUpperCase(), M + 4, y + 5.5, { charSpace: 1 });
doc.setTextColor(...B.cyan);
doc.text(`${cs.pct}%`, W - M - 4, y + 5.5, { align: "right" });
y += 12;

let qNum = 0;
getVisibleQuestions(cat).forEach(q => {
qNum++;
const a = answers[q.id];
if (!a) return;
const opt = q.options[a.optionIndex];

const qLines = doc.splitTextToSize(`${qNum}. ${q.q}`, W - 2*M);
const aLines = doc.splitTextToSize(`→ ${opt.t}  (${a.score}/${a.maxScore})`, W - 2*M - 6);
const blockH = qLines.length * 4.5 + aLines.length * 4 + 5;

if (y + blockH > H - 25) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Bijlage — Antwoorden (vervolg)"); y = 40; }

doc.setFont("helvetica", "bold"); doc.setFontSize(9);
doc.setTextColor(...B.donker);
doc.text(qLines, M, y, { lineHeightFactor: 1.4 });
y += qLines.length * 4.5 + 1;

doc.setFont("helvetica", "normal"); doc.setFontSize(8.5);
doc.setTextColor(...B.cyanDonker);
doc.text(aLines, M + 4, y, { lineHeightFactor: 1.4 });
y += aLines.length * 4 + 5;
});
y += 4;
});

addPageFooter(doc);

const safeOrg = org.replace(/[^a-z0-9]+/gi, "-").replace(/^-|-$/g, "");
const fileName = `BuroGEKKO-AIAct-${safeOrg}-${new Date().toISOString().split("T")[0]}.pdf`;
doc.save(fileName);
}

function drawPageHeader(doc, title) {
const B = PDF_BRAND, M = 18, W = 210;
doc.setFillColor(...B.cyan); doc.rect(0, 0, W, 3, "F");
doc.setFont("helvetica", "bold"); doc.setFontSize(8);
doc.setTextColor(...B.donker);
doc.text("Noppa", M, 13, { charSpace: 1 });
doc.setFont("helvetica", "normal"); doc.setFontSize(8);
doc.setTextColor(...B.grijs);
doc.text(title, W - M, 13, { align: "right" });
doc.setDrawColor(...B.border);
doc.line(M, 17, W - M, 17);
}

function addPageFooter(doc) {
const B = PDF_BRAND, M = 18, W = 210, H = 297;
doc.setDrawColor(...B.border);
doc.line(M, H - 17, W - M, H - 17);
doc.setFont("helvetica", "normal"); doc.setFontSize(7);
doc.setTextColor(...B.grijs);
doc.text(`${PDF_META.title} · ${PDF_META.product}`, M, H - 11);
const pageNum = doc.internal.getNumberOfPages();
doc.text(`Pagina ${pageNum}`, W - M, H - 11, { align: "right" });
}

/* =========================================================
RESTART + INIT
========================================================= */
function restart() {
if (!confirm("Weet je zeker dat je opnieuw wilt beginnen? Alle antwoorden worden gewist.")) return;
Object.keys(answers).forEach(k => delete answers[k]);
currentCatIndex = 0;
["org-name","org-contact","org-role","org-sector","lead-name","lead-email","lead-company","lead-phone"].forEach(id => {
const el = document.getElementById(id);
if (el) el.value = "";
});
const consent = document.getElementById("lead-consent");
if (consent) consent.checked = false;
clearProgress();
lastResults = null;
showScreen("intro");
}

window.addEventListener("DOMContentLoaded", () => {
/* Retry any queued submissions silently in the background */
flushQueue().catch(() => {});

["org-name","org-contact","org-role","org-sector"].forEach(id => {
const el = document.getElementById(id);
if (el) el.addEventListener("change", saveProgress);
});

if (loadProgress() && Object.keys(answers).length > 0) {
const answered = Object.keys(answers).length;
const maxTotal = getMaxPossibleQuestions();
const resume = confirm(`Je hebt een eerder ingevuld AI Act assessment (${answered} van ${maxTotal} vragen beantwoord). Wil je verdergaan?\n\nOK = doorgaan, Annuleren = opnieuw beginnen.`);
if (resume) {
for (let i = 0; i  answers[q.id] !== undefined);
if (!allAnswered) { currentCatIndex = i; break; }
if (i === CATEGORIES.length - 1) currentCatIndex = CATEGORIES.length - 1;
}
renderCategory();
showScreen("questions");
} else {
Object.keys(answers).forEach(k => delete answers[k]);
clearProgress();
}
}
});