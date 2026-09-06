<?php
$pageTitle = "Copilot Readiness Assessment — Noppa";
$pageDesc = "Doe de Microsoft 365 Copilot Readiness scan en zie of jouw data en licenties klaar zijn voor AI.";
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>

<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

<link rel="stylesheet" href="assets/css/style.css">




<!-- ============ HERO ============ -->
<header class="hero">
  <a href="index.php" class="nav-back">← Andere assessments</a>
  <div class="container hero-inner">
    <span class="eyebrow">Noppa · Microsoft 365 Consultancy</span>
    <h1>Hoe <em>Copilot-klaar</em> is jullie omgeving?</h1>
    <p>Een diepgaande zelfdiagnose op zes assen: technische fundatie, identity &amp; security, data governance, compliance, adoptie en strategie. Binnen vijftien minuten weet je waar de risico's en versnellers zitten — en wat je eerste vervolgstap zou moeten zijn.</p>
    <div class="hero-meta">
      <span>~15 minuten</span>
      <span>45+ vragen met logische follow-ups</span>
      <span>Direct rapport</span>
    </div>
  </div>
</header>

<main>

<!-- ============ SCREEN 1 — INTRO + COMPANY ============ -->
<section class="screen active" id="screen-intro">
  <div class="section section-light">
    <div class="container">
      <span class="label">Voor wie</span>
      <h2>Een eerlijk vertrekpunt voor je <em>Copilot-traject</em></h2>
      <p class="section-intro">Dit assessment is bedoeld voor IT-managers, CIO's, en M365-beheerders die overwegen om Microsoft 365 Copilot uit te rollen — of die willen weten waar hun huidige uitrol vastloopt. Geen vrijblijvende score, maar concrete aandachtspunten.</p>

      <div class="pillars">
        <div class="pillar">
          <div class="pillar-icon">①</div>
          <h3>Technische fundatie</h3>
          <p>M365-licenties, deployment channels, Intune en infrastructuur.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>Identity &amp; Security</h3>
          <p>MFA, Conditional Access, PIM, Identity Protection en Defender.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Data governance</h3>
          <p>SharePoint, sensitivity labels, DLP, oversharing en retention.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Compliance &amp; risico</h3>
          <p>AVG/DPIA, AI-beleid, legal-betrokkenheid en incident response.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Adoptie &amp; change</h3>
          <p>Sponsorship, training, champions en prompt-skills.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>Strategie &amp; use cases</h3>
          <p>AI-strategie, business cases, KPI's, budget en roadmap.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="section section-white">
    <div class="container">
      <span class="label">Stap 1 van 7</span>
      <h2>Vertel ons kort iets over <em>jullie organisatie</em></h2>
      <p class="section-intro">Deze gegevens worden alleen gebruikt om het rapport te personaliseren. Niets wordt opgeslagen of doorgestuurd zonder jouw toestemming.</p>

      <div class="form-grid">
        <div class="form-field">
          <label for="org-name">Organisatienaam *</label>
          <input type="text" id="org-name" placeholder="Bijv. Voorbeeld B.V." required />
        </div>
        <div class="form-field">
          <label for="org-contact">Jouw naam *</label>
          <input type="text" id="org-contact" placeholder="Bijv. Jan Jansen" required />
        </div>
        <div class="form-field">
          <label for="org-email">E-mailadres *</label>
          <input type="email" id="org-email" placeholder="Bijv. jan@voorbeeld.nl" required />
        </div>
        <div class="form-field">
          <label for="org-size">Aantal medewerkers</label>
          <select id="org-size">
            <option value="">Selecteer...</option>
            <option value="xs">1 – 24</option>
            <option value="s">25 – 99</option>
            <option value="m">100 – 499</option>
            <option value="l">500 – 1.499</option>
            <option value="xl">1.500+</option>
          </select>
        </div>
        <div class="form-field">
          <label for="org-sector">Sector</label>
          <select id="org-sector">
            <option value="">Selecteer...</option>
            <option>Zakelijke dienstverlening</option>
            <option>Industrie / productie</option>
            <option>Zorg</option>
            <option>Overheid / publieke sector</option>
            <option>Onderwijs</option>
            <option>Retail / e-commerce</option>
            <option>Financiële dienstverlening</option>
            <option>Bouw / vastgoed</option>
            <option>Anders</option>
          </select>
        </div>
      </div>

      <div class="nav-row">
        <span></span>
        <button class="btn btn-geel" onclick="nextScreen()">Start het assessment →</button>
      </div>
    </div>
  </div>
</section>

<!-- ============ SCREENS 2-6 — VRAGEN (gegenereerd in JS) ============ -->
<section class="screen" id="screen-questions">
  <div class="section section-light">
    <div class="container">
      <div class="progress-wrap">
        <div class="progress-meta">
          <span><strong id="progress-step">Stap 2 van 7</strong> · <span id="progress-cat-name">Technische fundatie</span></span>
          <span><strong id="progress-pct">0%</strong> voltooid</span>
        </div>
        <div class="progress-bar"><div class="progress-fill" id="progress-fill"></div></div>
      </div>

      <div id="category-container"></div>

      <div class="nav-row">
        <button class="btn btn-outline" id="btn-prev" onclick="prevCategory()">← Vorige</button>
        <button class="btn btn-geel" id="btn-next" onclick="nextCategory()">Volgende →</button>
      </div>
    </div>
  </div>
</section>

<!-- ============ SCREEN 7 — RESULT ============ -->
<section class="screen" id="screen-result">
  <div class="section section-light">
    <div class="container">

      <div class="result-hero">
        <span class="result-status" id="result-status-badge">Status</span>
        <h2 id="result-title">Jullie Copilot Readiness Score</h2>
        <div class="score-big" id="result-score">0%</div>
        <div class="score-sub" id="result-score-sub">Op basis van 45+ vragen verdeeld over 6 categorieën</div>
        <p class="summary-text" id="result-summary"></p>
      </div>

      <!-- ===== LEAD GATE (visible until form submitted) ===== -->
      <div class="lead-gate" id="lead-gate">
        <div class="lead-gate-head">
          <div class="lead-gate-icon">🔓</div>
          <div>
            <h3>Ontgrendel jullie <em>volledige rapport</em></h3>
            <p class="lead-gate-sub">Vul je gegevens in om de gedetailleerde score per categorie en geprioriteerde aanbevelingen te zien — én een kopie per e-mail te ontvangen.</p>
          </div>
        </div>

        <ul class="lead-bullets">
          <li>Score per categorie met statusduiding</li>
          <li>Geprioriteerde aanbevelingen</li>
          <li>Rapport per e-mail</li>
          <li>Concrete vervolgstappen</li>
        </ul>

        <div class="lead-status" id="lead-status"></div>

        <form id="lead-form" onsubmit="submitLead(event)">
          <div class="lead-form-grid">
            <div class="form-field">
              <label for="lead-name">Naam *</label>
              <input type="text" id="lead-name" name="name" required placeholder="Voor- en achternaam" />
            </div>
            <div class="form-field">
              <label for="lead-email">E-mailadres *</label>
              <input type="email" id="lead-email" name="email" required placeholder="naam@bedrijf.nl" />
            </div>
            <div class="form-field">
              <label for="lead-company">Bedrijfsnaam *</label>
              <input type="text" id="lead-company" name="company" required placeholder="Organisatie" />
            </div>
            <div class="form-field">
              <label for="lead-phone">Telefoonnummer <span style="text-transform:none;font-weight:500;color:var(--grijs);">(optioneel)</span></label>
              <input type="tel" id="lead-phone" name="phone" placeholder="+31 6 ..." />
            </div>
          </div>

          <label class="checkbox-row">
            <input type="checkbox" id="lead-consent" required />
            <span>Ja, ik ga akkoord dat Noppa mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@noppa.nl" style="color:var(--royal);font-weight:700;">info@noppa.nl</a>.</p>

          <button type="submit" class="btn btn-geel" id="lead-submit">Ontgrendel mijn rapport →</button>
        </form>
      </div>

      <!-- ===== GATED CONTENT (hidden until submission) ===== -->
      <div id="gated-content" class="hidden">
        <span class="label">Score per categorie</span>
        <h2>Hoe jullie scoren per <em>onderwerp</em></h2>
        <p class="section-intro">Bekijk waar de fundatie sterk staat en waar nog werk wacht.</p>

        <div class="score-grid" id="score-breakdown"></div>

        <div class="rec-section">
          <span class="label">Aanbevelingen</span>
          <h2>Wat moet er <em>eerst</em> gebeuren?</h2>
          <p class="section-intro">Geprioriteerde acties op basis van jullie antwoorden — beginnend bij de blokkades voor een veilige Copilot-uitrol.</p>
          <ul class="rec-list" id="recommendations"></ul>
        </div>

        <div class="cta-block">
          <h3>Klaar om de volgende stap te zetten?</h3>
          <p>Noppa helpt organisaties met de fundatie, het beleid en de adoptie die Copilot écht waardevol maken. Boek een vrijblijvend gesprek of bewaar het rapport voor intern overleg.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@noppa.nl?subject=Copilot%20Readiness%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
          </div>
        </div>
      </div>

      <!-- ===== TEASER (visible while gated) ===== -->
      <div id="gated-teaser" class="gated-teaser">
        <div class="gated-teaser-inner">
          <span class="label">Score per categorie</span>
          <h2>Hoe jullie scoren per <em>onderwerp</em></h2>
          <p class="section-intro">Bekijk waar de fundatie sterk staat en waar nog werk wacht.</p>
          <div class="score-grid">
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:55%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:72%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:38%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
          </div>
        </div>
        <div class="gated-teaser-overlay">
          <div class="lock-icon">🔒</div>
          <strong>Vul het formulier hierboven in</strong>
          <span>om de volledige analyse te ontgrendelen</span>
        </div>
      </div>

      <div class="nav-row">
        <button class="btn btn-outline" onclick="restart()">↺ Opnieuw beginnen</button>
        <span></span>
      </div>

    </div>
  </div>
</section>

</main>



<script>
/* =========================================================
   ⚙️  CONFIGURATIE  —  pas hier de bezorging van leads aan
   =========================================================
   Lead delivery werkt in deze volgorde:
     1) FORMSPREE_ENDPOINT (primair)     — vul je formspree.io form-ID in
     2) POWER_AUTOMATE_WEBHOOK (optioneel) — vul je HTTP-trigger URL in
     3) MAILTO_FALLBACK (altijd actief)  — opent mailclient met rapport

   Stappen om Formspree te activeren:
     - Maak gratis account op formspree.io
     - Maak een nieuw form aan, kopieer het form-ID (bijv. xrgwblzv)
     - Vervang YOUR_FORM_ID hieronder

   Stappen om Power Automate te activeren (later):
     - Maak een flow met trigger "When an HTTP request is received"
     - Plak de HTTP POST URL hieronder
*/
const CONFIG = {
  PHP_BACKEND_ENDPOINT: "api/submit.php",
  MAILTO_FALLBACK: "info@noppa.nl",
  COMPANY_NAME: "Noppa",
  ENABLE_LOCAL_RESUME: true,         // sla voortgang lokaal op zodat invullers kunnen hervatten
  QUEUE_KEY: "bg_copilot_pending_v1",
  QUEUE_MAX_AGE_DAYS: 30
};

/* =========================================================
   ASSESSMENT DATA
   ========================================================= */
/*
   Vraag-schema:
   - id           : uniek (categorie-id + index, gebruikt als state-key)
   - q            : vraagtekst
   - hint         : optionele toelichting onder de vraag
   - options      : [{ t, s }]  — tekst + score
   - dependsOn    : { id, showIfOptionIn: [0,1,...] } — alleen tonen als referentievraag is beantwoord met optie-index uit de lijst
*/
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

/* =========================================================
   STATE
   ========================================================= */
let currentScreen = "intro";
let currentCatIndex = 0;
const answers = {};

/* Visible-questions logic: a question is visible if it has no dependency
   OR if the dependency has been answered with one of the allowed options. */
function isQuestionVisible(q) {
  if (!q.dependsOn) return true;
  const dep = answers[q.dependsOn.id];
  if (!dep) return false;
  return q.dependsOn.showIfOptionIn.includes(dep.optionIndex);
}
function getVisibleQuestions(cat) {
  return cat.questions.filter(isQuestionVisible);
}
function getTotalVisibleQuestions() {
  return CATEGORIES.reduce((acc, c) => acc + getVisibleQuestions(c).length, 0);
}
function getMaxPossibleQuestions() {
  return CATEGORIES.reduce((acc, c) => acc + c.questions.length, 0);
}

/* =========================================================
   NAVIGATION
   ========================================================= */
function showScreen(id) {
  document.querySelectorAll(".screen").forEach(s => s.classList.remove("active"));
  document.getElementById("screen-" + id).classList.add("active");
  window.scrollTo({ top: 0, behavior: "smooth" });
  currentScreen = id;
}

function nextScreen() {
  // From intro → start questions
  if (currentScreen === "intro") {
    currentCatIndex = 0;
    renderCategory();
    showScreen("questions");
  }
}

function renderCategory() {
  const cat = CATEGORIES[currentCatIndex];
  const container = document.getElementById("category-container");

  // Header
  let html = `
    <div class="cat-header">
      <div class="cat-icon">${cat.icon}</div>
      <div>
        <div class="cat-title">${cat.name}</div>
        <div class="cat-desc">${cat.desc}</div>
      </div>
    </div>
  `;

  // Questions — only render visible ones
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
      <div class="question ${answered ? 'answered' : ''} ${isFollowUp ? 'is-follow-up' : ''}" id="q-${qKey}">
        ${isFollowUp ? '<div class="follow-up-tag">Vervolgvraag</div>' : ''}
        <div class="question-label">
          <span class="q-num">${displayIndex}</span>
          <span>${q.q}</span>
        </div>
        ${q.hint ? `<div class="question-hint">${q.hint}</div>` : ''}
        <div class="options">
          ${q.options.map((o, oi) => `
            <label class="option">
              <input type="radio" name="${qKey}" value="${o.s}" ${a?.optionIndex === oi ? 'checked' : ''} onchange="recordAnswer('${qKey}', ${o.s}, ${oi}, ${maxScore})">
              <span>${o.t}</span>
            </label>
          `).join("")}
        </div>
      </div>
    `;
  });

  container.innerHTML = html;

  // Progress
  const stepNum = currentCatIndex + 2;
  const totalSteps = CATEGORIES.length + 1;
  document.getElementById("progress-step").textContent = `Stap ${stepNum} van ${totalSteps}`;
  document.getElementById("progress-cat-name").textContent = cat.name;
  updateProgress();

  // Prev button
  document.getElementById("btn-prev").style.visibility = currentCatIndex === 0 ? "hidden" : "visible";

  // Next/finish button
  const btnNext = document.getElementById("btn-next");
  btnNext.textContent = currentCatIndex === CATEGORIES.length - 1 ? "Bekijk mijn rapport →" : "Volgende →";
}

function recordAnswer(key, score, optionIndex, maxScore) {
  answers[key] = { score: Number(score), optionIndex, maxScore };
  saveProgress();
  // Re-render the entire category to surface/hide follow-up questions correctly
  renderCategory();
  // Scroll to first unanswered visible question for continued momentum
  const nextUnanswered = getVisibleQuestions(CATEGORIES[currentCatIndex])
    .find(q => answers[q.id] === undefined);
  if (nextUnanswered) {
    const el = document.getElementById("q-" + nextUnanswered.id);
    if (el) el.scrollIntoView({ behavior: "smooth", block: "center" });
  }
}

/* =========================================================
   LOCAL PROGRESS PERSISTENCE
   ========================================================= */
const STORAGE_KEY = "bg_copilot_assessment_v1";

function saveProgress() {
  if (!CONFIG.ENABLE_LOCAL_RESUME) return;
  try {
    const state = {
      answers,
      intake: {
        org:     document.getElementById("org-name")?.value || "",
        contact: document.getElementById("org-contact")?.value || "",
        size:    document.getElementById("org-size")?.value || "",
        sector:  document.getElementById("org-sector")?.value || "", email: document.getElementById("org-email")?.value || ""
      },
      ts: Date.now()
    };
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
  } catch (e) { /* ignore quota errors */ }
}

function loadProgress() {
  if (!CONFIG.ENABLE_LOCAL_RESUME) return false;
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return false;
    const state = JSON.parse(raw);
    // expire after 14 days
    if (Date.now() - state.ts > 14 * 24 * 60 * 60 * 1000) {
      localStorage.removeItem(STORAGE_KEY);
      return false;
    }
    Object.assign(answers, state.answers || {});
    if (state.intake) {
      const fields = { "org-name": state.intake.org, "org-contact": state.intake.contact, "org-email": state.intake.email, "org-size": state.intake.size, "org-sector": state.intake.sector };
      Object.entries(fields).forEach(([id, val]) => {
        const el = document.getElementById(id);
        if (el && val) el.value = val;
      });
    }
    return Object.keys(answers).length > 0;
  } catch (e) { return false; }
}

function clearProgress() {
  try { localStorage.removeItem(STORAGE_KEY); } catch (e) {}
}

function updateProgress() {
  const totalVisible = getTotalVisibleQuestions();
  const answered = Object.keys(answers).filter(k => {
    // Only count answers for currently-visible questions
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
  // Validate: all VISIBLE questions in current category answered
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

  if (currentCatIndex < CATEGORIES.length - 1) {
    currentCatIndex++;
    renderCategory();
  } else {
    showResults();
  }
}

function prevCategory() {
  if (currentCatIndex > 0) {
    currentCatIndex--;
    renderCategory();
  }
}

/* =========================================================
   RESULTS — split in two phases (pre-gate teaser + post-gate full)
   ========================================================= */
let lastResults = null;  // cached results for unlock + lead payload

function showResults() {
  // Compute per-category scores — only count VISIBLE answered questions
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

  // Render the hero (always visible)
  const badge = document.getElementById("result-status-badge");
  badge.textContent = tier.badge;
  badge.className = "result-status " + tier.cls;

  document.getElementById("result-score").textContent = overallPct + "%";

  const org = document.getElementById("org-name").value.trim() || "Jullie organisatie";
  document.getElementById("result-title").innerHTML = `${org} · <em>${tier.label}</em>`;
  document.getElementById("result-summary").textContent = tier.summary;

  // Pre-fill lead form with intake data
  const intakeOrg = document.getElementById("org-name").value.trim();
  const intakeName = document.getElementById("org-contact").value.trim();
  if (intakeOrg && !document.getElementById("lead-company").value) {
    document.getElementById("lead-company").value = intakeOrg;
  }
  if (intakeName && !document.getElementById("lead-name").value) {
    document.getElementById("lead-name").value = intakeName;
  }

  // Reset gating (in case of restart)
  document.getElementById("gated-content").classList.add("hidden");
  document.getElementById("gated-teaser").classList.remove("hidden");
  document.getElementById("lead-gate").classList.remove("hidden");
  document.getElementById("lead-status").className = "lead-status";
  document.getElementById("lead-status").textContent = "";

  showScreen("result");
}

/* Render the full report — called after lead submission */
function unlockGatedContent() {
  if (!lastResults) return;
  const { catScores, recs } = lastResults;

  const grid = document.getElementById("score-breakdown");
  grid.innerHTML = catScores.map(c => {
    const status = c.pct >= 75 ? "Sterk fundament" :
                   c.pct >= 50 ? "Op koers, finetuning nodig" :
                   c.pct >= 25 ? "Aandacht vereist" : "Kritieke gap";
    return `
      <div class="score-card">
        <div class="score-card-head">
          <span class="score-card-name">${c.icon} ${c.name}</span>
          <span class="score-card-pct">${c.pct}%</span>
        </div>
        <div class="score-card-bar"><div class="score-card-fill" style="width:${c.pct}%"></div></div>
        <div class="score-card-status">${status}</div>
      </div>
    `;
  }).join("");

  document.getElementById("recommendations").innerHTML = recs.map(r => `
    <li class="rec-item priority-${r.priority}">
      <span class="rec-badge ${r.priority}">${r.priority === "high" ? "Hoog" : r.priority === "medium" ? "Medium" : "Laag"}</span>
      <div class="rec-text"><strong>${r.title}.</strong> ${r.text}</div>
    </li>
  `).join("");

  document.getElementById("gated-teaser").classList.add("hidden");
  document.getElementById("gated-content").classList.remove("hidden");
}

/* =========================================================
   LEAD SUBMISSION — Formspree primary, Power Automate optional, mailto fallback
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
    status.innerHTML = `✓ Verzonden! Je rapport is ontgrendeld hieronder. We hebben je gegevens automatisch doorgestuurd naar Noppa en je ontvangt een kopie op <strong>${lead.email}</strong>.`;
  } else {
    status.innerHTML =
      `✓ Je rapport is ontgrendeld hieronder. We hebben je inzending <strong>veilig opgeslagen</strong> en versturen deze automatisch zodra de verbinding hersteld is. ` +
      `Wil je nu zelf een kopie naar Noppa sturen? ` +
      `<button type="button" class="lead-manual-send" onclick="manualSendLast()" style="margin-left:8px;padding:6px 12px;background:#00D0F0;border:0;border-radius:6px;font-weight:700;cursor:pointer;">Verstuur via mijn mailclient</button>`;
  }

  btn.textContent = "Rapport ontgrendeld ✓";
  document.getElementById("lead-gate").classList.add("hidden");
  unlockGatedContent();
  window.scrollTo({ top: 0, behavior: "smooth" });
}

/* Active delivery — Formspree and Power Automate run in parallel.
   Returns true if at least one endpoint accepted the payload. */
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
   not configured or temporarily unreachable. Pending items are retried
   silently on every subsequent page load. */
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
  let list = readQueue().filter(e => (now - new Date(e.queuedAt).getTime()) < maxAge);
  if (list.length === 0) { writeQueue(list); return; }

  const remaining = [];
  for (const entry of list) {
    const ok = await attemptDelivery(entry.payload);
    if (!ok) {
      entry.attempts = (entry.attempts || 0) + 1;
      remaining.push(entry);
    }
  }
  writeQueue(remaining);
}

/* Manual mail-client send — only triggered when the user clicks
   "Verstuur via mijn mailclient", never automatically. */
function manualSendLast() {
  const list = readQueue();
  if (list.length === 0) return;
  const entry = list[list.length - 1];
  const lead = {
    name: entry.payload.naam,
    email: entry.payload.email,
    company: entry.payload.bedrijf,
    phone: entry.payload.telefoon
  };
  openMailtoFallback(lead, entry.payload);
}

function buildLeadPayload(lead) {
  const { catScores, overallPct, tier, recs } = lastResults;

  // Build human-readable answers per category for delivery — visible questions only
  const answersText = CATEGORIES.map(cat => {
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
    // Lead info
    naam: lead.name,
    email: lead.email,
    bedrijf: lead.company,
    telefoon: lead.phone || "(niet opgegeven)",
    toestemming: lead.consent ? "Ja" : "Nee",

    // Intake
    organisatie: document.getElementById("org-name").value.trim() || "",
    omvang: document.getElementById("org-size").value || "",
    sector: document.getElementById("org-sector").value || "",

    // Score
    score_totaal: overallPct + "%",
    status: tier.label,
    score_per_categorie: catScores.map(c => `${c.name}: ${c.pct}%`).join(" | "),

    // Detail
    samenvatting: tier.summary,
    antwoorden: answersText,
    aanbevelingen: recText,

    // Meta
    tijdstip: new Date().toISOString(),
    bron: "Copilot Readiness Assessment (Noppa)",
    _subject: `Copilot Readiness — ${lead.company} (${overallPct}%, ${tier.label})`
  };
}

function openMailtoFallback(lead, payload) {
  const subject = encodeURIComponent(`Copilot Readiness Assessment — ${lead.company}`);
  const body = encodeURIComponent(
`Beste Noppa,

Hierbij mijn ingevulde Copilot Readiness Assessment.

CONTACT
Naam:       ${lead.name}
E-mail:     ${lead.email}
Bedrijf:    ${lead.company}
Telefoon:   ${lead.phone || "(niet opgegeven)"}
Sector:     ${payload.sector}
Omvang:     ${payload.omvang}

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
Verzonden via het online Copilot Readiness Assessment (${new Date().toLocaleString("nl-NL")})
`
  );
  window.location.href = `mailto:${CONFIG.MAILTO_FALLBACK}?cc=${encodeURIComponent(lead.email)}&subject=${subject}&body=${body}`;
}

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

/* =========================================================
   RESTART
   ========================================================= */
function restart() {
  if (!confirm("Weet je zeker dat je opnieuw wilt beginnen? Alle antwoorden worden gewist.")) return;
  Object.keys(answers).forEach(k => delete answers[k]);
  currentCatIndex = 0;
  ["org-name","org-contact","org-size","org-sector","lead-name","lead-email","lead-company","lead-phone"].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.value = "";
  });
  const consent = document.getElementById("lead-consent");
  if (consent) consent.checked = false;
  clearProgress();
  lastResults = null;
  showScreen("intro");
}

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
  title:    "Copilot Readiness Assessment",
  subtitle: "Microsoft 365 Copilot — Diagnose & roadmap",
  product:  "Noppa · M365 Consultancy",
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

  /* ===================== COVER PAGE ===================== */
  doc.setFillColor(...B.donker); doc.rect(0, 0, W, H, "F");
  // Yellow accent strip
  doc.setFillColor(...B.cyan); doc.rect(0, 0, W, 5, "F");
  // Soft radial glow simulated via concentric circles
  for (let i = 50; i >= 10; i -= 10) {
    doc.setFillColor(...B.cyan);
    doc.setGState(new doc.GState({ opacity: 0.025 }));
    doc.circle(180, 60, i, "F");
  }
  doc.setGState(new doc.GState({ opacity: 1 }));

  // Brand mark
  doc.setFont("helvetica", "bold"); doc.setFontSize(12);
  doc.setTextColor(...B.cyan); doc.text("Noppa", M, 24);
  doc.setFont("helvetica", "normal"); doc.setFontSize(8);
  doc.setTextColor(255, 255, 255); doc.text(PDF_META.product, M, 29);

  // Eyebrow
  doc.setFont("helvetica", "bold"); doc.setFontSize(8.5);
  doc.setTextColor(...B.cyan);
  doc.text(PDF_META.title.toUpperCase(), M, 105, { charSpace: 1 });

  // Hero title
  doc.setFontSize(34); doc.setTextColor(255, 255, 255);
  doc.text("Readiness", M, 122);
  doc.setTextColor(...B.cyan); doc.text("Rapport", M, 137);

  // For organization
  doc.setFont("helvetica", "normal"); doc.setFontSize(11);
  doc.setTextColor(220, 220, 220);
  doc.text(`Opgesteld voor:`, M, 158);
  doc.setFont("helvetica", "bold"); doc.setFontSize(16); doc.setTextColor(...B.wit);
  doc.text(org, M, 167);

  doc.setFont("helvetica", "normal"); doc.setFontSize(9);
  doc.setTextColor(180, 180, 180); doc.text(`Datum  ·  ${today}`, M, 175);

  // Big score block (yellow card)
  doc.setFillColor(...B.cyan); doc.roundedRect(M, 195, W - 2*M, 62, 5, 5, "F");
  doc.setFont("helvetica", "bold"); doc.setFontSize(8.5);
  doc.setTextColor(...B.donker);
  doc.text("OVERALL READINESS SCORE", M + 10, 209, { charSpace: 1 });

  doc.setFontSize(52); doc.text(`${overallPct}%`, M + 10, 240);

  // Status pill on right
  doc.setFillColor(...B.donker); doc.roundedRect(W - M - 65, 217, 55, 12, 6, 6, "F");
  doc.setTextColor(...B.cyan); doc.setFontSize(8);
  doc.text(tier.label.toUpperCase(), W - M - 37.5, 224.5, { align: "center", charSpace: 1 });

  doc.setFont("helvetica", "normal"); doc.setFontSize(9);
  doc.setTextColor(...B.donker);
  doc.text(`Status: ${tier.label}`, M + 10, 250);

  // Cover footer
  doc.setFont("helvetica", "normal"); doc.setFontSize(7.5);
  doc.setTextColor(150, 150, 150);
  doc.text("Vertrouwelijk · Persoonlijk rapport · Niet voor externe distributie", M, H - 18);
  doc.text(PDF_META.url, W - M, H - 18, { align: "right" });

  /* ===================== PAGE 2 — SAMENVATTING & SCORES ===================== */
  doc.addPage();
  drawPageHeader(doc, "Samenvatting");

  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.cyanDonker);
  doc.text("STATUS", M, 38, { charSpace: 1 });

  doc.setFontSize(22); doc.setTextColor(...B.donker);
  const orgTitle = doc.splitTextToSize(`${org} · ${tier.label}`, W - 2*M);
  doc.text(orgTitle, M, 48);
  let y = 48 + orgTitle.length * 8 + 4;

  // Status badge
  const badgeColor = {
    "Foundation": [239, 68, 68],
    "Emerging": B.cyan,
    "Progressing": [123, 180, 184],
    "Copilot Ready": [34, 197, 94]
  }[tier.label] || B.cyan;
  const badgeW = doc.getTextWidth(tier.badge) + 12;
  doc.setFillColor(...badgeColor);
  doc.roundedRect(M, y - 5, badgeW, 9, 4.5, 4.5, "F");
  doc.setFontSize(8); doc.setFont("helvetica", "bold"); doc.setTextColor(...B.wit);
  doc.text(tier.badge.toUpperCase(), M + 6, y + 0.5, { charSpace: 1 });
  y += 12;

  // Summary text
  doc.setFont("helvetica", "normal"); doc.setFontSize(10.5);
  doc.setTextColor(...B.grijs);
  const summaryLines = doc.splitTextToSize(tier.summary, W - 2*M);
  doc.text(summaryLines, M, y, { lineHeightFactor: 1.5 });
  y += summaryLines.length * 5.2 + 10;

  // Score per category title
  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.cyanDonker);
  doc.text("SCORE PER CATEGORIE", M, y, { charSpace: 1 });
  y += 4;
  doc.setFontSize(15); doc.setTextColor(...B.donker);
  doc.text("Hoe jullie scoren per onderwerp", M, y + 6);
  y += 14;

  // Category score cards
  catScores.forEach(c => {
    if (y > H - 50) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Samenvatting (vervolg)"); y = 40; }

    const status = c.pct >= 75 ? "Sterk fundament"
                 : c.pct >= 50 ? "Op koers, finetuning nodig"
                 : c.pct >= 25 ? "Aandacht vereist"
                 : "Kritieke gap";

    doc.setFillColor(...B.wit);
    doc.setDrawColor(...B.border);
    doc.roundedRect(M, y, W - 2*M, 23, 2.5, 2.5, "FD");

    // Name
    doc.setFont("helvetica", "bold"); doc.setFontSize(10.5);
    doc.setTextColor(...B.donker);
    doc.text(c.name, M + 6, y + 8);

    // Score
    doc.setFontSize(16); doc.setTextColor(...B.cyanDonker);
    doc.text(`${c.pct}%`, W - M - 6, y + 9, { align: "right" });

    // Bar background
    doc.setFillColor(...B.border);
    doc.roundedRect(M + 6, y + 12, W - 2*M - 12, 2.5, 1.25, 1.25, "F");
    // Bar fill
    const fillW = (W - 2*M - 12) * (c.pct / 100);
    if (fillW > 0) {
      doc.setFillColor(...B.cyan);
      doc.roundedRect(M + 6, y + 12, fillW, 2.5, 1.25, 1.25, "F");
    }

    // Status text
    doc.setFont("helvetica", "normal"); doc.setFontSize(8.5);
    doc.setTextColor(...B.grijs);
    doc.text(status, M + 6, y + 20);

    y += 27;
  });

  addPageFooter(doc);

  /* ===================== PAGE 3+ — AANBEVELINGEN ===================== */
  doc.addPage();
  drawPageHeader(doc, "Aanbevelingen");

  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.cyanDonker);
  doc.text("PRIORITEITEN", M, 38, { charSpace: 1 });
  doc.setFontSize(22); doc.setTextColor(...B.donker);
  doc.text("Wat moet er eerst gebeuren?", M, 48);

  doc.setFont("helvetica", "normal"); doc.setFontSize(10);
  doc.setTextColor(...B.grijs);
  const introRec = doc.splitTextToSize("Geprioriteerde acties op basis van jullie antwoorden. Hoge prioriteit zijn blokkades voor een veilige uitrol; medium en laag versterken volwassenheid op langere termijn.", W - 2*M);
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

    // Card
    doc.setFillColor(...B.wit); doc.setDrawColor(...B.border);
    doc.roundedRect(M, y, W - 2*M, cardH, 2, 2, "FD");
    // Left bar
    doc.setFillColor(...pri.color);
    doc.rect(M, y, 2.2, cardH, "F");
    // Priority badge
    doc.setFillColor(...pri.color); doc.setGState(new doc.GState({ opacity: 0.15 }));
    const badgeWPri = doc.getTextWidth(pri.label) + 8;
    doc.roundedRect(M + 6, y + 5, badgeWPri, 5, 2.5, 2.5, "F");
    doc.setGState(new doc.GState({ opacity: 1 }));
    doc.setFont("helvetica", "bold"); doc.setFontSize(7);
    doc.setTextColor(...pri.color);
    doc.text(pri.label, M + 6 + badgeWPri/2, y + 8.5, { align: "center", charSpace: 1 });

    // Title
    doc.setFontSize(10.5); doc.setTextColor(...B.donker);
    doc.text(titleLines, M + 6, y + 16, { lineHeightFactor: 1.3 });

    // Body text
    doc.setFont("helvetica", "normal"); doc.setFontSize(9);
    doc.setTextColor(...B.grijs);
    doc.text(textLines, M + 6, y + 16 + titleLines.length * 5.5 + 1, { lineHeightFactor: 1.5 });

    y += cardH + 4;
  });

  addPageFooter(doc);

  /* ===================== PAGE — BIJLAGE ANTWOORDEN ===================== */
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

    // Category header bar
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

  // SAVE
  const safeOrg = org.replace(/[^a-z0-9]+/gi, "-").replace(/^-|-$/g, "");
  const fileName = `Noppa Solutions & Consultants-CopilotReadiness-${safeOrg}-${new Date().toISOString().split("T")[0]}.pdf`;
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
   INITIALISATION — offer resume on load if local progress exists
   ========================================================= */
window.addEventListener("DOMContentLoaded", () => {
  /* Retry any queued submissions silently in the background */
  flushQueue().catch(() => {});

  // Auto-save intake fields
  ["org-name","org-contact","org-size","org-sector"].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener("change", saveProgress);
  });

  if (loadProgress() && Object.keys(answers).length > 0) {
    const answered = Object.keys(answers).length;
    const maxTotal = getMaxPossibleQuestions();
    const resume = confirm(`Je hebt een eerder ingevuld assessment (${answered} van ${maxTotal} vragen beantwoord). Wil je verdergaan waar je gebleven was?\n\nKlik op OK om verder te gaan, of Annuleren om opnieuw te beginnen.`);
    if (resume) {
      // Find first category that still has unanswered VISIBLE questions
      for (let i = 0; i < CATEGORIES.length; i++) {
        const cat = CATEGORIES[i];
        const allAnswered = getVisibleQuestions(cat).every(q => answers[q.id] !== undefined);
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
</script>


<?php include $base . "partials/footer.php"; ?>




