<?php
$pageTitle = "EU AI Act Assessment";
$pageDesc = "Checklist voor conformiteit & risicobeheer rondom de AI Act.";
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>

<!-- Assessment Specifieke CSS -->
<link rel="stylesheet" href="<?php echo $base; ?>css/assessment.css">

<main>

<!-- ============ SCREEN 1: INTRO + COMPANY ============ -->
<section class="screen active" id="screen-intro">
  <div class="section section-light">
    <div class="container">
      <span class="label">Voor wie</span>
      <h2>Een eerlijk vertrekpunt voor jullie <em>AI-governance</em></h2>
      <p class="section-intro">Dit assessment is bedoeld voor compliance officers, DPO's, juristen, CIO's en bestuurders die willen weten waar hun organisatie staat ten opzichte van de EU AI Act — als deployer van AI-systemen (zoals Microsoft 365 Copilot), als provider van AI, of beide. We dekken de zes assen die handhavers zullen toetsen.</p>

      <div class="pillars">
        <div class="pillar">
          <div class="pillar-icon">①</div>
          <h3>AI-inventaris &amp; rol</h3>
          <p class="hero-sub">Welke AI gebruik je, met welke rol (provider, deployer) en risicoklasse?</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>AI-geletterdheid (Art. 4)</h3>
          <p class="hero-sub">Verplicht sinds 2 feb 2025 voor alle staf die met AI werkt.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Governance &amp; verantwoording</h3>
          <p class="hero-sub">AI Officer, policy, DPIA/FRIA, risicoregister en escalatie.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Transparantie &amp; rechten</h3>
          <p class="hero-sub">Disclosure, watermarking, OR-betrokkenheid, recht op uitleg.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Data &amp; technische waarborgen</h3>
          <p class="hero-sub">Datakwaliteit, bias, logging, human oversight, robustness.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>High-risk &amp; GPAI verplichtingen</h3>
          <p class="hero-sub">Conformity assessment, technische documentatie en post-market monitoring.</p>
        </div>
      </div>

      <div class="deadlines">
        <h3>De belangrijkste <em>deadlines</em> op een rij</h3>
        <ul class="deadlines-list">
          <li><span class="date">1 aug 2024</span> AI Act in werking getreden</li>
          <li><span class="date">2 feb 2025</span> Verbod op onaanvaardbare AI-praktijken + AI-geletterdheid (Art. 4) verplicht</li>
          <li><span class="date">2 aug 2025</span> Regels voor General-Purpose AI (GPAI) van toepassing — denk aan governance van Copilot, ChatGPT, etc.</li>
          <li><span class="date">2 aug 2026</span> Volledige toepassing op nieuwe high-risk AI-systemen (Annex III)</li>
          <li><span class="date">2 aug 2027</span> Volledige toepassing voor high-risk AI in gereguleerde sectoren (Annex I)</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="section section-white">
    <div class="container">
      <span class="label">Stap 1 van 7</span>
      <h2>Vertel ons kort iets over <em>jullie organisatie</em></h2>
      <p class="section-intro">Deze gegevens helpen het rapport in context te plaatsen. Niets wordt opgeslagen of doorgestuurd zonder toestemming.</p>

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
          <label for="org-role">Jouw rol</label>
          <select id="org-role">
            <option value="">Selecteer...</option>
            <option>Compliance Officer / Privacy Officer / DPO</option>
            <option>Legal / Bedrijfsjurist</option>
            <option>CIO / CTO / IT-manager</option>
            <option>CISO / Security</option>
            <option>Risk Manager</option>
            <option>Bestuurder / Directie</option>
            <option>Consultant / Advies</option>
            <option>Anders</option>
          </select>
        </div>
        <div class="form-field">
          <label for="org-sector">Sector</label>
          <select id="org-sector">
            <option value="">Selecteer...</option>
            <option>Zorg</option>
            <option>Financiële dienstverlening</option>
            <option>Overheid / publieke sector</option>
            <option>Onderwijs</option>
            <option>Industrie / productie</option>
            <option>Retail / e-commerce</option>
            <option>Zakelijke dienstverlening</option>
            <option>Bouw / vastgoed</option>
            <option>HR / recruitment</option>
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

<!-- ============ SCREEN 2: QUESTIONS ============ -->
<section class="screen" id="screen-questions">
  <div class="section section-light">
    <div class="container">
      <div class="progress-wrap">
        <div class="progress-meta">
          <span><strong id="progress-step">Stap 2 van 7</strong> · <span id="progress-cat-name">AI-inventaris</span></span>
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

<!-- ============ SCREEN 3: RESULT ============ -->
<section class="screen" id="screen-result">
  <div class="section section-light">
    <div class="container">

      <div class="result-hero">
        <span class="result-status" id="result-status-badge">Status</span>
        <h2 id="result-title">EU AI Act Compliance Score</h2>
        <div class="score-big" id="result-score">0%</div>
        <div class="score-sub" id="result-score-sub">Op basis van 39 vragen verdeeld over 6 categorieën</div>
        <p class="summary-text" id="result-summary"></p>
      </div>

      <!-- LEAD GATE -->
      <div class="lead-gate" id="lead-gate">
        <div class="lead-gate-head">
          <div class="lead-gate-icon">🔓</div>
          <div>
            <h3>Ontgrendel jullie <em>volledige rapport</em></h3>
            <p class="lead-gate-sub">Vul je gegevens in om de gedetailleerde score per categorie en risico-geprioriteerde aanbevelingen te zien — én een kopie per e-mail te ontvangen.</p>
          </div>
        </div>

        <ul class="lead-bullets">
          <li>Score per categorie</li>
          <li>Geprioriteerde compliance-acties</li>
          <li>Rapport per e-mail</li>
          <li>Verwijzingen naar relevante artikelen</li>
        </ul>

        <div class="lead-status" id="lead-status"></div>

        <form id="lead-form" onsubmit="submitLead(event)">
          <div class="lead-form-grid">
            <div class="form-field"><label for="lead-name">Naam *</label><input type="text" id="lead-name" name="name" required placeholder="Voor- en achternaam" /></div>
            <div class="form-field"><label for="lead-email">E-mailadres *</label><input type="email" id="lead-email" name="email" required placeholder="naam@bedrijf.nl" /></div>
            <div class="form-field"><label for="lead-company">Bedrijfsnaam *</label><input type="text" id="lead-company" name="company" required placeholder="Organisatie" /></div>
            <div class="form-field"><label for="lead-phone">Telefoonnummer <span style="text-transform:none;font-weight:500;color:var(--grijs);">(optioneel)</span></label><input type="tel" id="lead-phone" name="phone" placeholder="+31 6 ..." /></div>
          </div>

          <label class="checkbox-row">
            <input type="checkbox" id="lead-consent" required />
            <span>Ja, ik ga akkoord dat Buro GEKKO mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@burogekko.nl" style="color:var(--geel-donker);font-weight:700;">info@burogekko.nl</a>.</p>

          <button type="submit" class="btn btn-geel" id="lead-submit">Ontgrendel mijn rapport →</button>
        </form>
      </div>

      <!-- GATED CONTENT -->
      <div id="gated-content" class="hidden">
        <span class="label">Score per categorie</span>
        <h2>Hoe jullie scoren per <em>compliance-as</em></h2>
        <p class="section-intro">Bekijk waar de basis op orde is en waar urgente compliance-gaps zitten.</p>

        <div class="score-grid" id="score-breakdown"></div>

        <div class="rec-section">
          <span class="label">Aanbevelingen</span>
          <h2>Wat moet er <em>eerst</em> gebeuren?</h2>
          <p class="section-intro">Geprioriteerde acties op basis van handhavingsmijlpalen en risico. Hoge prioriteit = vereist op korte termijn.</p>
          <ul class="rec-list" id="recommendations"></ul>
        </div>

        <div class="legal-disclaimer">
          <strong>Disclaimer:</strong> dit assessment biedt een indicatieve zelfevaluatie en is geen juridisch advies. De interpretatie van de AI Act blijft op onderdelen onderhevig aan ontwikkeling (richtsnoeren van de EU AI Office, geharmoniseerde normen, jurisprudentie). Voor een formeel compliance-oordeel raadpleeg een gekwalificeerd jurist of compliance-specialist.
        </div>

        <div class="cta-block">
          <h3>Klaar voor een grondige compliance-review?</h3>
          <p class="hero-sub">Buro GEKKO helpt organisaties met AI-governance, AI-literacy programma's, DPIA/FRIA en het inrichten van duurzame compliance — toegespitst op Microsoft 365 Copilot en bredere AI-portfolio's.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@burogekko.nl?subject=AI%20Act%20Compliance%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
          </div>
        </div>
      </div>

      <!-- TEASER -->
      <div id="gated-teaser" class="gated-teaser">
        <div class="gated-teaser-inner">
          <span class="label">Score per categorie</span>
          <h2>Hoe jullie scoren per <em>compliance-as</em></h2>
          <div class="score-grid">
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:42%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:68%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:35%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
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
    <div class="hero-eyebrow"><svg width="13" height="13" aria-hidden="true"><use href="#ic-0c40c7"/></svg>Buro GEKKO · EU AI Act Compliance</div><h1>Voldoet jullie organisatie aan de <em>EU AI Act</em>?</h1>
    <p class="hero-sub">De AI Act is sinds 1 augustus 2024 in werking. AI-geletterdheid (artikel 4) geldt al sinds 2 februari 2025 — verplicht voor iedereen die met AI werkt. Met dit assessment krijg je binnen 15 minuten een eerlijk beeld van jullie compliance-status en de prioriteiten richting de volgende handhavingsmijlpalen.</p>
    <div class="hero-meta">
      <span>~15 minuten</span>
      <span>39 vragen + follow-ups</span>
      <span>Risico-geprioriteerd rapport</span>
    </div>
  </div>
</section>

<main>

<!-- ============ SCREEN 1: INTRO + COMPANY ============ -->
<section class="screen active" id="screen-intro">
  <div class="section section-light">
    <div class="container">
      <span class="label">Voor wie</span>
      <h2>Een eerlijk vertrekpunt voor jullie <em>AI-governance</em></h2>
      <p class="section-intro">Dit assessment is bedoeld voor compliance officers, DPO's, juristen, CIO's en bestuurders die willen weten waar hun organisatie staat ten opzichte van de EU AI Act — als deployer van AI-systemen (zoals Microsoft 365 Copilot), als provider van AI, of beide. We dekken de zes assen die handhavers zullen toetsen.</p>

      <div class="pillars">
        <div class="pillar">
          <div class="pillar-icon">①</div>
          <h3>AI-inventaris &amp; rol</h3>
          <p class="hero-sub">Welke AI gebruik je, met welke rol (provider, deployer) en risicoklasse?</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">②</div>
          <h3>AI-geletterdheid (Art. 4)</h3>
          <p class="hero-sub">Verplicht sinds 2 feb 2025 voor alle staf die met AI werkt.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">③</div>
          <h3>Governance &amp; verantwoording</h3>
          <p class="hero-sub">AI Officer, policy, DPIA/FRIA, risicoregister en escalatie.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">④</div>
          <h3>Transparantie &amp; rechten</h3>
          <p class="hero-sub">Disclosure, watermarking, OR-betrokkenheid, recht op uitleg.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑤</div>
          <h3>Data &amp; technische waarborgen</h3>
          <p class="hero-sub">Datakwaliteit, bias, logging, human oversight, robustness.</p>
        </div>
        <div class="pillar">
          <div class="pillar-icon">⑥</div>
          <h3>High-risk &amp; GPAI verplichtingen</h3>
          <p class="hero-sub">Conformity assessment, technische documentatie en post-market monitoring.</p>
        </div>
      </div>

      <div class="deadlines">
        <h3>De belangrijkste <em>deadlines</em> op een rij</h3>
        <ul class="deadlines-list">
          <li><span class="date">1 aug 2024</span> AI Act in werking getreden</li>
          <li><span class="date">2 feb 2025</span> Verbod op onaanvaardbare AI-praktijken + AI-geletterdheid (Art. 4) verplicht</li>
          <li><span class="date">2 aug 2025</span> Regels voor General-Purpose AI (GPAI) van toepassing — denk aan governance van Copilot, ChatGPT, etc.</li>
          <li><span class="date">2 aug 2026</span> Volledige toepassing op nieuwe high-risk AI-systemen (Annex III)</li>
          <li><span class="date">2 aug 2027</span> Volledige toepassing voor high-risk AI in gereguleerde sectoren (Annex I)</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="section section-white">
    <div class="container">
      <span class="label">Stap 1 van 7</span>
      <h2>Vertel ons kort iets over <em>jullie organisatie</em></h2>
      <p class="section-intro">Deze gegevens helpen het rapport in context te plaatsen. Niets wordt opgeslagen of doorgestuurd zonder toestemming.</p>

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
          <label for="org-role">Jouw rol</label>
          <select id="org-role">
            <option value="">Selecteer...</option>
            <option>Compliance Officer / Privacy Officer / DPO</option>
            <option>Legal / Bedrijfsjurist</option>
            <option>CIO / CTO / IT-manager</option>
            <option>CISO / Security</option>
            <option>Risk Manager</option>
            <option>Bestuurder / Directie</option>
            <option>Consultant / Advies</option>
            <option>Anders</option>
          </select>
        </div>
        <div class="form-field">
          <label for="org-sector">Sector</label>
          <select id="org-sector">
            <option value="">Selecteer...</option>
            <option>Zorg</option>
            <option>Financiële dienstverlening</option>
            <option>Overheid / publieke sector</option>
            <option>Onderwijs</option>
            <option>Industrie / productie</option>
            <option>Retail / e-commerce</option>
            <option>Zakelijke dienstverlening</option>
            <option>Bouw / vastgoed</option>
            <option>HR / recruitment</option>
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

<!-- ============ SCREEN 2: QUESTIONS ============ -->
<section class="screen" id="screen-questions">
  <div class="section section-light">
    <div class="container">
      <div class="progress-wrap">
        <div class="progress-meta">
          <span><strong id="progress-step">Stap 2 van 7</strong> · <span id="progress-cat-name">AI-inventaris</span></span>
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

<!-- ============ SCREEN 3: RESULT ============ -->
<section class="screen" id="screen-result">
  <div class="section section-light">
    <div class="container">

      <div class="result-hero">
        <span class="result-status" id="result-status-badge">Status</span>
        <h2 id="result-title">EU AI Act Compliance Score</h2>
        <div class="score-big" id="result-score">0%</div>
        <div class="score-sub" id="result-score-sub">Op basis van 39 vragen verdeeld over 6 categorieën</div>
        <p class="summary-text" id="result-summary"></p>
      </div>

      <!-- LEAD GATE -->
      <div class="lead-gate" id="lead-gate">
        <div class="lead-gate-head">
          <div class="lead-gate-icon">🔓</div>
          <div>
            <h3>Ontgrendel jullie <em>volledige rapport</em></h3>
            <p class="lead-gate-sub">Vul je gegevens in om de gedetailleerde score per categorie en risico-geprioriteerde aanbevelingen te zien — én een kopie per e-mail te ontvangen.</p>
          </div>
        </div>

        <ul class="lead-bullets">
          <li>Score per categorie</li>
          <li>Geprioriteerde compliance-acties</li>
          <li>Rapport per e-mail</li>
          <li>Verwijzingen naar relevante artikelen</li>
        </ul>

        <div class="lead-status" id="lead-status"></div>

        <form id="lead-form" onsubmit="submitLead(event)">
          <div class="lead-form-grid">
            <div class="form-field"><label for="lead-name">Naam *</label><input type="text" id="lead-name" name="name" required placeholder="Voor- en achternaam" /></div>
            <div class="form-field"><label for="lead-email">E-mailadres *</label><input type="email" id="lead-email" name="email" required placeholder="naam@bedrijf.nl" /></div>
            <div class="form-field"><label for="lead-company">Bedrijfsnaam *</label><input type="text" id="lead-company" name="company" required placeholder="Organisatie" /></div>
            <div class="form-field"><label for="lead-phone">Telefoonnummer <span style="text-transform:none;font-weight:500;color:var(--grijs);">(optioneel)</span></label><input type="tel" id="lead-phone" name="phone" placeholder="+31 6 ..." /></div>
          </div>

          <label class="checkbox-row">
            <input type="checkbox" id="lead-consent" required />
            <span>Ja, ik ga akkoord dat Buro GEKKO mijn gegevens gebruikt om mij dit rapport toe te sturen en eventueel contact op te nemen voor een vervolggesprek.</span>
          </label>

          <p class="lead-privacy"><strong>Privacy:</strong> jouw gegevens worden uitsluitend gebruikt voor de opvolging van dit assessment. Geen nieuwsbrieven, geen verkoop aan derden. Inzage of verwijdering? Mail <a href="mailto:info@burogekko.nl" style="color:var(--geel-donker);font-weight:700;">info@burogekko.nl</a>.</p>

          <button type="submit" class="btn btn-geel" id="lead-submit">Ontgrendel mijn rapport →</button>
        </form>
      </div>

      <!-- GATED CONTENT -->
      <div id="gated-content" class="hidden">
        <span class="label">Score per categorie</span>
        <h2>Hoe jullie scoren per <em>compliance-as</em></h2>
        <p class="section-intro">Bekijk waar de basis op orde is en waar urgente compliance-gaps zitten.</p>

        <div class="score-grid" id="score-breakdown"></div>

        <div class="rec-section">
          <span class="label">Aanbevelingen</span>
          <h2>Wat moet er <em>eerst</em> gebeuren?</h2>
          <p class="section-intro">Geprioriteerde acties op basis van handhavingsmijlpalen en risico. Hoge prioriteit = vereist op korte termijn.</p>
          <ul class="rec-list" id="recommendations"></ul>
        </div>

        <div class="legal-disclaimer">
          <strong>Disclaimer:</strong> dit assessment biedt een indicatieve zelfevaluatie en is geen juridisch advies. De interpretatie van de AI Act blijft op onderdelen onderhevig aan ontwikkeling (richtsnoeren van de EU AI Office, geharmoniseerde normen, jurisprudentie). Voor een formeel compliance-oordeel raadpleeg een gekwalificeerd jurist of compliance-specialist.
        </div>

        <div class="cta-block">
          <h3>Klaar voor een grondige compliance-review?</h3>
          <p class="hero-sub">Buro GEKKO helpt organisaties met AI-governance, AI-literacy programma's, DPIA/FRIA en het inrichten van duurzame compliance — toegespitst op Microsoft 365 Copilot en bredere AI-portfolio's.</p>
          <div class="cta-actions">
            <button class="btn btn-dark" onclick="generatePDF()">📄 Download als PDF</button>
            <a href="mailto:info@burogekko.nl?subject=AI%20Act%20Compliance%20—%20vervolggesprek" class="btn btn-geel">Plan een gesprek →</a>
          </div>
        </div>
      </div>

      <!-- TEASER -->
      <div id="gated-teaser" class="gated-teaser">
        <div class="gated-teaser-inner">
          <span class="label">Score per categorie</span>
          <h2>Hoe jullie scoren per <em>compliance-as</em></h2>
          <div class="score-grid">
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:42%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:68%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
            <div class="score-card"><div class="score-card-head"><span class="score-card-name">●●● ●●●●●</span><span class="score-card-pct">●●%</span></div><div class="score-card-bar"><div class="score-card-fill" style="width:35%"></div></div><div class="score-card-status">●●●●●●●●●●</div></div>
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
    <div><strong>Buro GEKKO</strong> · EU AI Act Compliance Assessment</div>
    <div><a href="https://www.burogekko.nl">burogekko.nl</a> · 's-Hertogenbosch</div>
  </div>
</footer>

<script>
const APP_CONFIG = {
  storageKey: "bg_aiact_assessment_v1",
  queueKey: "bg_aiact_pending_v1",
  emailSubject: "AI Act Assessment",
  pdfTitle: "EU AI Act Compliance Assessment",
  pdfSubtitle: "Checklist voor conformiteit & risicobeheer",
  pdfPrefix: "AIAct"
};
</script>
<script src="assets/data/ai-act-data.js"></script>
<script src="assets/js/assessment-engine.js"></script>



<?php include $base . "partials/footer.php"; ?>
