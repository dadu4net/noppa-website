<?php
session_start();
$pageTitle = "Copilot Readiness Assessment";
$pageDesc = "Diagnose en roadmap voor Microsoft 365 Copilot implementatie.";
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>

<script>
const APP_CONFIG = {
  isLoggedIn: <?php
session_start(); echo isset(<?php
session_start();
$pageTitle = "Copilot Readiness Assessment";
$pageDesc = "Diagnose en roadmap voor Microsoft 365 Copilot implementatie.";
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>

<!-- Assessment Specifieke CSS -->
<link rel="stylesheet" href="<?php
session_start(); echo $base; ?>assets/css/assessment.css">

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
          <p class="hero-sub">M365-licenties, deployment channels, Intune en infrastructuur.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>Identity &amp; Security</h3>
          <p class="hero-sub">MFA, Conditional Access, PIM, Identity Protection en Defender.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Data governance</h3>
          <p class="hero-sub">SharePoint, sensitivity labels, DLP, oversharing en retention.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Compliance &amp; risico</h3>
          <p class="hero-sub">AVG/DPIA, AI-beleid, legal-betrokkenheid en incident response.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Adoptie &amp; change</h3>
          <p class="hero-sub">Sponsorship, training, champions en prompt-skills.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>Strategie &amp; use cases</h3>
          <p class="hero-sub">AI-strategie, business cases, KPI's, budget en roadmap.</p>
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
            <span>Ja, ik ga akkoord dat Buro GEKKO mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@burogekko.nl" style="color:var(--geel-donker);font-weight:700;">info@burogekko.nl</a>.</p>

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
          <p class="hero-sub">Buro GEKKO helpt organisaties met de fundatie, het beleid en de adoptie die Copilot écht waardevol maken. Boek een vrijblijvend gesprek of bewaar het rapport voor intern overleg.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@burogekko.nl?subject=Copilot%20Readiness%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
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

<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ============ HERO ============ -->
<section class="hero">
  <a href="index.html" class="nav-back">← Andere assessments</a>
  <div class="container">
    <div class="hero-eyebrow"><svg width="13" height="13" aria-hidden="true"><use href="#ic-0c40c7"/></svg>Buro GEKKO · Microsoft 365 Consultancy</div><h1>Hoe <em>Copilot-klaar</em> is jullie omgeving?</h1>
    <p class="hero-sub">Een diepgaande zelfdiagnose op zes assen: technische fundatie, identity &amp; security, data governance, compliance, adoptie en strategie. Binnen vijftien minuten weet je waar de risico's en versnellers zitten — en wat je eerste vervolgstap zou moeten zijn.</p>
    <div class="hero-meta">
      <span>~15 minuten</span>
      <span>45+ vragen met logische follow-ups</span>
      <span>Direct rapport</span>
    </div>
  </div>
</section>

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
          <p class="hero-sub">M365-licenties, deployment channels, Intune en infrastructuur.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>Identity &amp; Security</h3>
          <p class="hero-sub">MFA, Conditional Access, PIM, Identity Protection en Defender.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Data governance</h3>
          <p class="hero-sub">SharePoint, sensitivity labels, DLP, oversharing en retention.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Compliance &amp; risico</h3>
          <p class="hero-sub">AVG/DPIA, AI-beleid, legal-betrokkenheid en incident response.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Adoptie &amp; change</h3>
          <p class="hero-sub">Sponsorship, training, champions en prompt-skills.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>Strategie &amp; use cases</h3>
          <p class="hero-sub">AI-strategie, business cases, KPI's, budget en roadmap.</p>
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
            <span>Ja, ik ga akkoord dat Buro GEKKO mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@burogekko.nl" style="color:var(--geel-donker);font-weight:700;">info@burogekko.nl</a>.</p>

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
          <p class="hero-sub">Buro GEKKO helpt organisaties met de fundatie, het beleid en de adoptie die Copilot écht waardevol maken. Boek een vrijblijvend gesprek of bewaar het rapport voor intern overleg.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@burogekko.nl?subject=Copilot%20Readiness%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
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

<footer>
  <div class="container footer-inner">
    <div><strong>Buro GEKKO</strong> · Microsoft 365 Copilot Readiness Assessment</div>
    <div><a href="https://www.burogekko.nl">burogekko.nl</a> · 's-Hertogenbosch</div>
  </div>
</footer>

<script>
const APP_CONFIG = {
  storageKey: "bg_copilot_assessment_v1",
  queueKey: "bg_copilot_pending_v1",
  emailSubject: "Copilot Readiness Assessment",
  pdfTitle: "Copilot Readiness Assessment",
  pdfSubtitle: "Microsoft 365 Copilot — Diagnose & roadmap",
  pdfPrefix: "CopilotReadiness"
};
</script>
<script src="../assets/data/copilot-data.js"></script>
<script src="../assets/js/assessment-engine.js"></script>



<?php
session_start(); include $base . "partials/footer.php"; ?>

SESSION['user_id']) ? 'true' : 'false'; ?>,
  loginUrl: '<?php
session_start(); echo $base; ?>api/auth/login.php?return_to=' + encodeURIComponent(window.location.pathname),
  freeCategoriesLimit: 2,
  storageKey: "bg_copilot_assessment_v1",
  queueKey: "bg_copilot_pending_v1",
  emailSubject: "Copilot Readiness Assessment",
  pdfTitle: "Copilot Readiness Assessment",
  pdfSubtitle: "Microsoft 365 Copilot — Diagnose & roadmap",
  pdfPrefix: "CopilotReadiness"
};
</script>

<!-- Assessment Specifieke CSS -->
<link rel="stylesheet" href="<?php
session_start(); echo $base; ?>assets/css/assessment.css">

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
          <p class="hero-sub">M365-licenties, deployment channels, Intune en infrastructuur.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>Identity &amp; Security</h3>
          <p class="hero-sub">MFA, Conditional Access, PIM, Identity Protection en Defender.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Data governance</h3>
          <p class="hero-sub">SharePoint, sensitivity labels, DLP, oversharing en retention.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Compliance &amp; risico</h3>
          <p class="hero-sub">AVG/DPIA, AI-beleid, legal-betrokkenheid en incident response.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Adoptie &amp; change</h3>
          <p class="hero-sub">Sponsorship, training, champions en prompt-skills.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>Strategie &amp; use cases</h3>
          <p class="hero-sub">AI-strategie, business cases, KPI's, budget en roadmap.</p>
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
            <span>Ja, ik ga akkoord dat Buro GEKKO mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@burogekko.nl" style="color:var(--geel-donker);font-weight:700;">info@burogekko.nl</a>.</p>

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
          <p class="hero-sub">Buro GEKKO helpt organisaties met de fundatie, het beleid en de adoptie die Copilot écht waardevol maken. Boek een vrijblijvend gesprek of bewaar het rapport voor intern overleg.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@burogekko.nl?subject=Copilot%20Readiness%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
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

<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ============ HERO ============ -->
<section class="hero">
  <a href="index.html" class="nav-back">← Andere assessments</a>
  <div class="container">
    <div class="hero-eyebrow"><svg width="13" height="13" aria-hidden="true"><use href="#ic-0c40c7"/></svg>Buro GEKKO · Microsoft 365 Consultancy</div><h1>Hoe <em>Copilot-klaar</em> is jullie omgeving?</h1>
    <p class="hero-sub">Een diepgaande zelfdiagnose op zes assen: technische fundatie, identity &amp; security, data governance, compliance, adoptie en strategie. Binnen vijftien minuten weet je waar de risico's en versnellers zitten — en wat je eerste vervolgstap zou moeten zijn.</p>
    <div class="hero-meta">
      <span>~15 minuten</span>
      <span>45+ vragen met logische follow-ups</span>
      <span>Direct rapport</span>
    </div>
  </div>
</section>

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
          <p class="hero-sub">M365-licenties, deployment channels, Intune en infrastructuur.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>Identity &amp; Security</h3>
          <p class="hero-sub">MFA, Conditional Access, PIM, Identity Protection en Defender.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Data governance</h3>
          <p class="hero-sub">SharePoint, sensitivity labels, DLP, oversharing en retention.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Compliance &amp; risico</h3>
          <p class="hero-sub">AVG/DPIA, AI-beleid, legal-betrokkenheid en incident response.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Adoptie &amp; change</h3>
          <p class="hero-sub">Sponsorship, training, champions en prompt-skills.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>Strategie &amp; use cases</h3>
          <p class="hero-sub">AI-strategie, business cases, KPI's, budget en roadmap.</p>
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
            <span>Ja, ik ga akkoord dat Buro GEKKO mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@burogekko.nl" style="color:var(--geel-donker);font-weight:700;">info@burogekko.nl</a>.</p>

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
          <p class="hero-sub">Buro GEKKO helpt organisaties met de fundatie, het beleid en de adoptie die Copilot écht waardevol maken. Boek een vrijblijvend gesprek of bewaar het rapport voor intern overleg.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@burogekko.nl?subject=Copilot%20Readiness%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
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

<footer>
  <div class="container footer-inner">
    <div><strong>Buro GEKKO</strong> · Microsoft 365 Copilot Readiness Assessment</div>
    <div><a href="https://www.burogekko.nl">burogekko.nl</a> · 's-Hertogenbosch</div>
  </div>
</footer>

<script>
const APP_CONFIG = {
  storageKey: "bg_copilot_assessment_v1",
  queueKey: "bg_copilot_pending_v1",
  emailSubject: "Copilot Readiness Assessment",
  pdfTitle: "Copilot Readiness Assessment",
  pdfSubtitle: "Microsoft 365 Copilot — Diagnose & roadmap",
  pdfPrefix: "CopilotReadiness"
};
</script>
<script src="../assets/data/copilot-data.js"></script>
<script src="../assets/js/assessment-engine.js"></script>



<?php
session_start(); include $base . "partials/footer.php"; ?>



