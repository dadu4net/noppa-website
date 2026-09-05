<?php
$pageTitle = "Diensten — Copilot, Data & Procesautomatisering | Noppa";
$pageDesc = "Noppa begeleidt organisaties bij Microsoft Copilot-adoptie, dashboards die kloppen en procesautomatisering in Microsoft 365 — van strategie tot werkende adoptie.";
$base = "";
include $base . "partials/header.php";
?>

<!-- NAV (geïnjecteerd door js/include.js) -->
<?php include $base . "partials/nav.php"; ?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep">›</span>
      <span style="color:#fff">Diensten</span>
    </div>
    <div class="hero-eyebrow">Diensten</div>
    <h1>Van Microsoft 365-licentie naar <em>werkelijke waarde</em></h1>
    <p class="hero-sub">
      Wij brengen Copilot, data en processen samen tot één werkomgeving die uw team
      écht sneller, slimmer en plezieriger laat werken. Pragmatisch, mensgericht en
      meetbaar — zoals u dat van Noppa mag verwachten.
    </p>
    <div class="hero-actions">
      <a href="contact.php#booking" class="btn btn-accent">Plan een kennismaking →</a>
      <a href="#diensten-overzicht" class="btn btn-ghost-dark">Bekijk onze diensten</a>
    </div>
  </div>
</section>

<!-- INTRO -->
<section class="section-alt">
  <div class="container">
    <div class="about-grid">
      <div>
        <span class="caption">De uitdaging</span>
        <h2 style="font-size:36px;line-height:1.15;margin:10px 0 18px">AI is geen tool — het is een <span style="color:var(--royal)">verandering</span></h2>
        <p>
          Veel organisaties schaffen Copilot-licenties aan en hopen dat de productiviteit
          vanzelf stijgt. De realiteit: zonder duidelijke use cases, juiste data-governance
          en gerichte adoptie blijft Copilot een dure proeftuin.
        </p>
        <p>
          Noppa maakt de stap van <strong>licentie naar werkelijke waarde</strong>. We
          combineren technische kennis van het Microsoft-ecosysteem met onze ervaring in
          mensgerichte adoptie — zodat AI bij uw mensen écht blijft plakken.
        </p>
        <div class="about-stats">
          <div class="about-stat"><div class="num">M365</div><div class="lbl">Native Microsoft</div></div>
          <div class="about-stat"><div class="num">2026+</div><div class="lbl">Copilot-ready</div></div>
          <div class="about-stat"><div class="num">A–Z</div><div class="lbl">Strategie tot adoptie</div></div>
          <div class="about-stat"><div class="num">4 wk</div><div class="lbl">Eerste resultaat</div></div>
        </div>
      </div>
      <div class="person-card" style="text-align:left;padding:38px">
        <div style="font-size:60px;line-height:.7;color:var(--cyan);font-weight:900;position:relative;z-index:1;margin-top:40px">"</div>
        <p style="font-size:17px;font-weight:600;color:var(--navy);line-height:1.55;margin:8px 0 18px;position:relative;z-index:1">
          Een succesvolle Copilot-introductie begint <span style="color:var(--royal)">niet</span>
          bij de techniek, maar bij de vraag: <span style="color:var(--royal)">waarom</span>
          doen we dit, voor <span style="color:var(--royal)">wie</span>, en welke
          <span style="color:var(--royal)">kaders</span> hebben we daarvoor nodig.
        </p>
        <p style="font-size:13px;color:var(--slate);font-weight:600;position:relative;z-index:1">— Noppa adoptiefilosofie</p>
      </div>
    </div>
  </div>
</section>

<!-- WAT WE DOEN -->
<section class="section" id="diensten-overzicht">
  <div class="container">
    <div class="section-head">
      <span class="sec-eyebrow">Wat we voor u doen</span>
      <h2>Van strategie tot werkende <span style="color:var(--royal)">AI-agents</span></h2>
      <p>
        We dekken het hele Copilot-spectrum binnen Microsoft 365. Of u nu nog onderzoekt
        of Copilot past, of al een pilot draait die meer impact moet maken — wij sluiten
        aan bij waar u staat.
      </p>
    </div>

    <div class="services-grid">

      <div class="service">
        <div class="service-ico"><img src="assets/icons/checklist.svg" alt=""></div>
        <h3>Copilot Readiness Scan</h3>
        <p>We beoordelen uw M365-tenant op data-hygiëne, rechtenstructuur en licentiemodel. Resultaat: een concreet rapport met go/no-go en quick wins.</p>
        <ul>
          <li>Inventarisatie van data en rechten</li>
          <li>Risico's en quick wins in beeld</li>
          <li>Concreet stappenplan, geen abstracte theorie</li>
        </ul>
        <a href="diensten/ai-copilot.php" class="service-link" aria-label="Lees meer over Copilot Readiness Scan">Lees meer &rarr;</a>
      </div>

      <div class="service">
        <div class="service-ico"><img src="assets/icons/rocket.svg" alt=""></div>
        <h3>Pilot-begeleiding</h3>
        <p>Een gerichte pilot met een controlegroep van 10–25 medewerkers. Meetbare doelen, korte sprints en een afgeronde leerlus voor de bredere uitrol.</p>
        <ul>
          <li>6–8 weken, vaste planning</li>
          <li>Use cases per afdeling of rol</li>
          <li>Meetbare tijdwinst en tevredenheid</li>
        </ul>
        <a href="diensten/ai-copilot.php" class="service-link" aria-label="Lees meer over Pilot-begeleiding">Lees meer &rarr;</a>
      </div>

      <div class="service">
        <div class="service-ico"><img src="assets/icons/brain.svg" alt=""></div>
        <h3>AI-Agents & Copilot Studio</h3>
        <p>Bouw van eigen AI-agents in Copilot Studio: van een HR-assistent tot een offerte-agent die uw bedrijfskennis ontsluit voor uw mensen.</p>
        <ul>
          <li>Agents op SharePoint, Teams en data</li>
          <li>Persoonlijk én organisatiebreed</li>
          <li>Inclusief beheer en doorontwikkeling</li>
        </ul>
        <a href="diensten/ai-copilot.php" class="service-link" aria-label="Lees meer over AI-Agents & Copilot Studio">Lees meer &rarr;</a>
      </div>

      <div class="service">
        <div class="service-ico"><img src="assets/icons/shield.svg" alt=""></div>
        <h3>Governance & Compliance</h3>
        <p>Microsoft Purview, sensitivity labels, DLP-policies en duidelijke afspraken — zodat AI veilig met uw data omgaat en u in control blijft.</p>
        <ul>
          <li>Sensitivity labels & retention</li>
          <li>"Oversharing" voorkomen</li>
          <li>AVG-proof en uitlegbaar</li>
        </ul>
        <a href="veiligheid.php" class="service-link" aria-label="Lees meer over Governance & Compliance">Lees meer &rarr;</a>
      </div>

      <div class="service">
        <div class="service-ico"><img src="assets/icons/team.svg" alt=""></div>
        <h3>Adoptie & Training</h3>
        <p>Workshops, lunch-and-learns en use-case-sessies per afdeling. Elke medewerker leert prompts schrijven die werken voor zijn of haar dagelijkse taken.</p>
        <ul>
          <li>Workshops per rol of afdeling</li>
          <li>Promptbibliotheken die meegroeien</li>
          <li>Interne ambassadeurs opleiden</li>
        </ul>
        <a href="diensten/adoptie-begeleiding.php" class="service-link" aria-label="Lees meer over Adoptie & Training">Lees meer &rarr;</a>
      </div>

      <div class="service">
        <div class="service-ico"><img src="assets/icons/growth.svg" alt=""></div>
        <h3>Meetbare ROI</h3>
        <p>We meten daadwerkelijk gebruik, tijdsbesparing en gebruikerstevredenheid — zodat u kunt aantonen dat de Copilot-investering rendeert.</p>
        <ul>
          <li>Adoptie-dashboards in Power BI</li>
          <li>Tijdwinst per use case</li>
          <li>Doorlopende optimalisatie</li>
        </ul>
        <a href="diensten/processen-portalen.php" class="service-link" aria-label="Lees meer over Meetbare ROI">Lees meer &rarr;</a>
      </div>

    </div>
  </div>
</section>

<!-- USE CASES -->
<section class="section-alt">
  <div class="container">
    <div class="section-head">
      <span class="sec-eyebrow">In de praktijk</span>
      <h2>Waar AI <span style="color:var(--royal)">direct</span> waarde toevoegt</h2>
      <p>Zes gangbare use cases waar wij organisaties mee helpen — bewezen scenario's die snel resultaat opleveren.</p>
    </div>

    <div class="services-grid">

      <div class="service">
        <div class="service-ico" style="background:linear-gradient(135deg,rgba(0,208,240,.2),rgba(32,96,224,.2));color:var(--navy);font-weight:900;font-size:20px">1</div>
        <h3>Vergaderingen samenvatten in Teams</h3>
        <p>Copilot vat meetings automatisch samen, extraheert actiepunten en koppelt deze aan eigenaars. Bespaart elke deelnemer ± 30 min per vergadering.</p>
      </div>

      <div class="service">
        <div class="service-ico" style="background:linear-gradient(135deg,rgba(0,208,240,.2),rgba(32,96,224,.2));color:var(--navy);font-weight:900;font-size:20px">2</div>
        <h3>E-mail efficiënter beheren</h3>
        <p>Threads samenvatten, conceptantwoorden genereren en prioriteit suggereren in Outlook — minder tijd in de inbox, meer tijd voor uw werk.</p>
      </div>

      <div class="service">
        <div class="service-ico" style="background:linear-gradient(135deg,rgba(0,208,240,.2),rgba(32,96,224,.2));color:var(--navy);font-weight:900;font-size:20px">3</div>
        <h3>Documenten & rapporten opstellen</h3>
        <p>In Word: van bullets naar professionele tekst. In Excel: data-analyse zonder formules. In PowerPoint: van outline naar volledig deck.</p>
      </div>

      <div class="service">
        <div class="service-ico" style="background:linear-gradient(135deg,rgba(0,208,240,.2),rgba(32,96,224,.2));color:var(--navy);font-weight:900;font-size:20px">4</div>
        <h3>Bedrijfskennis ontsluiten</h3>
        <p>Copilot Studio-agents die antwoord geven op interne vragen — HR-beleid, IT-procedures, projectinformatie — direct uit SharePoint en Teams.</p>
      </div>

      <div class="service">
        <div class="service-ico" style="background:linear-gradient(135deg,rgba(0,208,240,.2),rgba(32,96,224,.2));color:var(--navy);font-weight:900;font-size:20px">5</div>
        <h3>Onboarding versnellen</h3>
        <p>Nieuwe medewerkers stellen vragen aan een persoonlijke onboarding-agent. Sneller productief, minder belasting voor HR en collega's.</p>
      </div>

      <div class="service">
        <div class="service-ico" style="background:linear-gradient(135deg,rgba(0,208,240,.2),rgba(32,96,224,.2));color:var(--navy);font-weight:900;font-size:20px">6</div>
        <h3>Power Automate × Copilot</h3>
        <p>Werkstromen die slimmer reageren — bijvoorbeeld inkomende offerteaanvragen automatisch classificeren en doorzetten naar de juiste accountmanager.</p>
      </div>

    </div>
  </div>
</section>

<!-- AANPAK 4 STAPPEN -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="sec-eyebrow">Onze aanpak</span>
      <h2>In <span style="color:var(--royal)">4 stappen</span> naar werkelijke AI-adoptie</h2>
      <p>Pragmatisch, mensgericht en altijd meetbaar — zo zorgen we dat AI bij uw mensen blijft plakken.</p>
    </div>

    <div class="steps">
      <div class="step">
        <div class="step-num">1</div>
        <h3>Verkenning & Readiness</h3>
        <p>Workshop met stakeholders, scan van uw M365-tenant en identificatie van high-impact use cases.</p>
      </div>
      <div class="step">
        <div class="step-num">2</div>
        <h3>Pilot & Bewijs</h3>
        <p>Gerichte pilot met meetbare doelen. Kleine groep, snelle leerlus, concrete resultaten in 6–8 weken.</p>
      </div>
      <div class="step">
        <div class="step-num">3</div>
        <h3>Uitrol & Training</h3>
        <p>Brede uitrol met workshops per afdeling, promptbibliotheken en interne ambassadeurs.</p>
      </div>
      <div class="step">
        <div class="step-num">4</div>
        <h3>Borging & Doorontwikkeling</h3>
        <p>Periodieke metingen, optimalisaties en uitbreiding naar nieuwe use cases of agents.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section-alt">
  <div class="container">
    <div class="cta-banner">
      <div>
        <h2>Klaar om de waarde van Copilot te ontsluiten?</h2>
        <p>Plan een vrijblijvend kennismakingsgesprek van 30 minuten. We laten zien hoe een gerichte Copilot-pilot binnen 8 weken meetbaar resultaat oplevert.</p>
      </div>
      <a href="contact.php#booking" class="btn">Plan een kennismaking →</a>
    </div>
  </div>
</section>

<!-- FOOTER (geïnjecteerd door js/include.js) -->
<?php include $base . "partials/footer.php"; ?>

<script src="js/include.js"></script>
</body>
</html>



