<?php
$pageTitle = "Online Assessments — Noppa";
$pageDesc = "Start een online assessment van Noppa om de AI-klaarheid en compliance van uw organisatie te meten.";
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>



<link rel="stylesheet" href="../css/assessment.css">


<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-eyebrow"><svg width="13" height="13" aria-hidden="true"><use href="#ic-0c40c7"/></svg>Noppa · Online assessments</div><h1>Hoe staat jullie organisatie ervoor met <em>AI</em>?</h1>
    <p class="hero-sub">Twee gratis online assessments — beide direct invulbaar, met een persoonlijk rapport. Eén focust op de praktische readiness voor Microsoft 365 Copilot, de ander op de compliance-status onder de EU AI Act.</p>
  </div>
</section>

<!-- ASSESSMENT CARDS -->
<section>
  <div class="container">
    <div class="assessments">

      <article class="assess-card">
        <div class="assess-icon">🚀</div>
        <span class="assess-tag">Operationeel</span>
        <h3>Microsoft 365 <em>Copilot Readiness</em></h3>
        <p class="hero-sub">Een diepgaande zelfdiagnose: zijn jullie licenties, identity, data governance, adoptie en strategie klaar voor een veilige en waardevolle Copilot-uitrol?</p>

        <div class="assess-meta">
          <span>~15 minuten</span>
          <span>47 vragen</span>
          <span>6 categorieën</span>
        </div>

        <ul class="assess-features">
          <li>Technische fundatie (licenties, Intune, OneDrive)</li>
          <li>Identity &amp; Security (MFA, PIM, Defender)</li>
          <li>Data governance (oversharing, labels, DLP)</li>
          <li>Compliance, adoptie en strategie</li>
          <li>Geprioriteerde aanbevelingen + e-mailrapport</li>
        </ul>

        <a href="copilot-readiness-assessment.php" class="btn btn-geel assess-cta">Start Copilot Readiness →</a>
      </article>

      <article class="assess-card">
        <div class="assess-icon">⚖️</div>
        <span class="assess-tag urgent">Wettelijk verplicht — vanaf 2 feb 2025</span>
        <h3>EU AI Act <em>Compliance Check</em></h3>
        <p class="hero-sub">Voldoen jullie aan de Europese AI-verordening? Toets je AI-inventaris, AI-literacy (Art. 4), governance, transparantie, technische waarborgen en high-risk verplichtingen.</p>

        <div class="assess-meta">
          <span>~15 minuten</span>
          <span>39 vragen</span>
          <span>6 categorieën</span>
        </div>

        <ul class="assess-features">
          <li>AI-inventaris &amp; risicoclassificatie</li>
          <li>AI-geletterdheid (Art. 4) — al verplicht!</li>
          <li>Governance, DPIA/FRIA en escalatielijnen</li>
          <li>Transparantie, OR-betrokkenheid, recht op uitleg</li>
          <li>High-risk en GPAI-verplichtingen (Copilot, ChatGPT)</li>
        </ul>

        <a href="ai-act-assessment.php" class="btn btn-geel assess-cta">Start AI Act Compliance →</a>
      </article>

    </div>

    <div class="trust-row">
      <span>Geen account nodig</span>
      <span>Antwoorden lokaal opgeslagen</span>
      <span>Direct rapport</span>
      <span>Privacy-vriendelijk</span>
    </div>
  </div>
</section>

<!-- COMPARE -->
<section class="section section-light">
  <div class="container">
    <span class="label">Welke past bij mij?</span>
    <h2>De twee assessments <em>vergeleken</em></h2>
    <p class="section-intro">Beide assessments staan op zichzelf en kunnen los worden ingevuld. Voor de meeste organisaties is het zinvol beide te doen — Copilot zonder AI Act-compliance is een risico, AI Act-compliance zonder Copilot-readiness mist de praktische uitvoering.</p>

    <div class="compare-table">
      <div class="compare-row head">
        <div>Aspect</div>
        <div>Copilot Readiness</div>
        <div>AI Act Compliance</div>
      </div>
      <div class="compare-row">
        <div>Focus</div>
        <div>Praktische uitvoer</div>
        <div>Juridische compliance</div>
      </div>
      <div class="compare-row">
        <div>Primaire doelgroep</div>
        <div>CIO / IT-manager / M365-beheer</div>
        <div>DPO / Compliance / Legal / Bestuur</div>
      </div>
      <div class="compare-row">
        <div>Resultaat</div>
        <div>Readiness-score &amp; roadmap</div>
        <div>Compliance-score &amp; risico's</div>
      </div>
      <div class="compare-row">
        <div>Geschikt vóór Copilot-aanschaf?</div>
        <div class="yes">Ja — start hier</div>
        <div>Aanbevolen</div>
      </div>
      <div class="compare-row">
        <div>Geschikt na Copilot-uitrol?</div>
        <div>Voor uitbreiding / volwassenheid</div>
        <div class="yes">Ja — vanaf moment 1</div>
      </div>
      <div class="compare-row">
        <div>Tijdsinvestering</div>
        <div>~15 minuten</div>
        <div>~15 minuten</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section-white">
  <div class="container">
    <div class="cta-block">
      <h2>Liever direct sparren met een specialist?</h2>
      <p class="hero-sub">Noppa begeleidt organisaties bij M365 Copilot-uitrol, AI-governance en compliance — van eerste pilot tot organisatiebrede adoptie. Plan een vrijblijvend kennismakingsgesprek.</p>
      <a href="mailto:info@noppa.nl?subject=Vrijblijvend%20gesprek%20—%20Copilot%20%2F%20AI%20Act" class="btn" style="background:var(--donker);color:var(--wit);">Plan een gesprek →</a>
    </div>
  </div>
</section>




<?php include $base . "partials/footer.php"; ?>




