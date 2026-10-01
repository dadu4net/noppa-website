<?php
$pageTitle = "Mens & Organisatie Verandering — Microsoft 365 Adoptie | Noppa";
$pageDesc = "Techniek moet aansluiten bij de mensen, niet andersom. Noppa begeleidt organisaties bij digitale verandering en Microsoft 365-adoptie in 7 concrete stappen.";
$base = "../";
include $base . "partials/header.php";
?>

<!-- ICON SPRITE (inline voor universele compatibiliteit) -->
<svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
  <symbol id="icon-users" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/>
  </symbol>
  <symbol id="icon-phone" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
  </symbol>
  <symbol id="icon-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M4.5 12.75l6 6 9-13.5"/>
  </symbol>
  <symbol id="icon-sparkles" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/>
  </symbol>
  <symbol id="icon-laptop" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/>
  </symbol>
  <symbol id="icon-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.75.75 0 01-.874-1.048 3.528 3.528 0 00.569-1.928 8.087 8.087 0 01-2.095-4.994C3.01 7.444 7.04 3.75 12 3.75s9 3.694 9 8.25z"/>
  </symbol>
  <symbol id="icon-video" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
  </symbol>
  <symbol id="icon-book" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
  </symbol>
  <symbol id="icon-shield" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
  </symbol>
  <symbol id="icon-rocket" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
  </symbol>
</svg>

<!-- NAV -->
<?php 
$active = 'diensten';
include $base . "partials/nav.php"; 
?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="../index.php">Home</a>
      <span class="sep">›</span>
      <a href="../diensten.php">Diensten</a>
      <span class="sep">›</span>
      <span style="color: #fff;">Mens &amp; Organisatie Verandering</span>
    </div>
    <div class="hero-eyebrow">
      <img src="../assets/icons/team.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
      Adoptie &amp; Verandermanagement
    </div>
    <h1>De brug tussen <em>technologie</em> en de <em>mensen</em> die ermee werken</h1>
    <p class="hero-sub">
      Microsoft 365 en Copilot leveren pas werkelijke waarde wanneer medewerkers de tools met
      vertrouwen en plezier gebruiken. Wij begeleiden uw organisatie van eerste veranderplan tot
      blijvende adoptie — mensgericht, gestructureerd en meetbaar.
    </p>
    <div class="hero-actions">
      <a href="../contact.php#booking" class="btn btn-accent">
        <img src="../assets/icons/chat.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
        Plan een kennismaking &rarr;
      </a>
      <a href="#stappen" class="btn btn-ghost-dark">Bekijk de 7 stappen &darr;</a>
    </div>
  </div>
</section>

<!-- INTRO: VERANDEREN IS MENSENWERK -->
<section id="intro" class="section-alt">
  <div class="container">
    <div class="about-grid">
      <div>
        <span class="caption">Onze filosofie</span>
        <h2 style="font-size:36px;line-height:1.15;margin:10px 0 18px">
          Veranderen is <span style="color:var(--royal)">mensenwerk</span>
        </h2>
        <p class="lead" style="font-weight:600;color:var(--text-heading);margin-bottom:16px;">
          Techniek moet aansluiten bij de mensen, niet andersom. Wij benaderen digitale veranderingen
          daarom altijd vanuit de mens.
        </p>
        <p>
          De introductie van Microsoft 365, Copilot of een nieuw sociaal intranet is ingrijpend voor elke
          organisatie. Nieuwe tools vragen om nieuwe gewoonten en een andere manier van samenwerken.
          Veel organisaties investeren fors in licenties en techniek, maar onderschatten de menselijke kant
          van de verandering.
        </p>
        <p>
          Bij Noppa staat de medewerker centraal. Niet als eindgebruiker die een handleiding in de maag
          gesplitst krijgt, maar als professional die begrijpt <em>waarom</em> een oplossing er is, <em>hoe</em>
          hij die efficiënt inzet en die werkwijze ook morgen nog omarmt.
        </p>
      </div>
      <div>
        <div class="person-card" style="text-align:left;padding:36px">
          <div style="font-size:56px;line-height:.7;color:var(--cyan);font-weight:900;margin-top:30px">"</div>
          <p style="font-size:17px;font-weight:600;color:var(--text-heading);line-height:1.55;margin:10px 0 18px;position:relative;z-index:1">
            Adoptie draait erom dat mensen écht begrijpen waarom en hoe ze nieuwe werkwijzen inzetten — op zo'n
            manier dat zij zich toekomstige innovaties ook op een gemakkelijke manier eigen maken.
          </p>
          <p style="font-size:13px;color:var(--text-muted);font-weight:700;position:relative;z-index:1">
            — Noppa Veranderfilosofie
          </p>
        </div>

        <div style="margin-top:20px;display:flex;flex-direction:column;gap:12px">
          <div style="display:flex;gap:14px;align-items:flex-start;padding:16px 20px;background:var(--bg-card);border:1px solid var(--border-color);border-radius:var(--radius)">
            <span style="color:var(--royal);flex-shrink:0;margin-top:2px">
              <img src="../assets/icons/sparkles.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
            </span>
            <div>
              <div style="font-size:0.92rem;font-weight:800;color:var(--text-heading);margin-bottom:3px">Geen knoppencursus, maar werkprocessen</div>
              <div style="font-size:0.85rem;color:var(--text-muted);line-height:1.55">We trainen medewerkers direct in hun dagelijkse context en scenario's — direct toepasbaar.</div>
            </div>
          </div>
          <div style="display:flex;gap:14px;align-items:flex-start;padding:16px 20px;background:var(--bg-card);border:1px solid var(--border-color);border-radius:var(--radius)">
            <span style="color:var(--royal);flex-shrink:0;margin-top:2px">
              <img src="../assets/icons/shield.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
            </span>
            <div>
              <div style="font-size:0.92rem;font-weight:800;color:var(--text-heading);margin-bottom:3px">Borging vanaf dag één</div>
              <div style="font-size:0.85rem;color:var(--text-muted);line-height:1.55">Met ambassadeurs en actuele leerpaden voorkomen we terugval naar oude e-mail- en opslaggewoonten.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DE 7 STAPPEN NAAR BLIJVENDE VERANDERING -->
<section id="stappen" class="section">
  <div class="container">
    <div class="section-head" style="max-width:760px;margin-bottom:40px">
      <span class="caption">Onze aanpak</span>
      <h2>De 7 stappen naar <em>blijvende verandering</em></h2>
      <p>
        Een succesvolle adoptie volgt een beproefde methodiek. Wij begeleiden uw organisatie
        stap voor stap: van strategisch doel en werkstijlen tot doorlopende ondersteuning.
      </p>
    </div>

    <div class="roadmap-container">

      <!-- STAP 01 -->
      <div class="roadmap-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">01</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Veranderplan</h3>
            <span class="roadmap-tag">Fase 01 · Fundament &amp; Doel</span>
          </div>
          <div class="roadmap-desc">
            <p>
              Vanuit onze ervaring en best practices stellen we samen het concrete doel van de verandering op.
              We inventariseren de werkstijlen (persona's) en doorlopen de bedrijfsprocessen en de behoeften
              van zowel het MT als de medewerkers op de werkvloer.
            </p>
            <p>
              Deze wensen brengen we samen in scenario's om ze vervolgens helder te prioriteren. Aansluitend
              voeren wij de technische inventarisatie uit en bekijken we welke beleidskeuzes hierbij horen met
              betrekking tot governance, rechtenstructuur en informatiebeveiliging.
            </p>
          </div>
          <ul class="roadmap-checklist">
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Doelstellingen &amp; KPI's vaststellen</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Persona's &amp; werkstijlen in kaart</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Bedrijfsprocessen doorlichten</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Governance &amp; security kaders bepalen</li>
          </ul>
        </div>
      </div>

      <!-- STAP 02 -->
      <div class="roadmap-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">02</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Scenario's</h3>
            <span class="roadmap-tag">Fase 02 · Praktijkvertaling</span>
          </div>
          <div class="roadmap-desc">
            <p>
              De moderne werkplek introduceren we op basis van de wensen en behoeften van medewerkers en de organisatie,
              vertaald naar herkenbare bedrijfsprocessen. Scenario's zijn thema's waarin we doelgericht samenwerken,
              communiceren en kennisdelen samenbrengen.
            </p>
            <p>
              Dit zijn geen theoretische knoppentrainingen, maar praktische toepassingen op basis van de dagelijkse werkprocessen.
            </p>
          </div>
          <div style="font-size:0.88rem;font-weight:700;color:var(--text-heading);margin-top:6px">Veelgekozen scenario's:</div>
          <div class="scenario-pills">
            <span class="scenario-pill">
              <img src="../assets/icons/dashboard.svg" class="noppa-icon" alt="" style="width:16px;height:16px;display:inline-block;vertical-align:middle;">
              Altijd en overal veilig werken
            </span>
            <span class="scenario-pill">
              <img src="../assets/icons/team.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
              Slim samenwerken in Teams &amp; SharePoint
            </span>
            <span class="scenario-pill">
              <img src="../assets/icons/chat.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
              Doelgericht communiceren zonder e-mailruis
            </span>
            <span class="scenario-pill">
              <img src="../assets/icons/chat.svg" class="noppa-icon" alt="" style="width:16px;height:16px;display:inline-block;vertical-align:middle;">
              Efficiënt vergaderen &amp; AI-notulen
            </span>
          </div>
        </div>
      </div>

      <!-- STAP 03 -->
      <div class="roadmap-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">03</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Communicatieplan</h3>
            <span class="roadmap-tag">Fase 03 · Bewustwording</span>
          </div>
          <div class="roadmap-desc">
            <p>
              Op basis van de ADKAR-methodiek stellen we een doordacht communicatieplan op. Door eerst te zorgen voor
              bewustwording van de noodzaak (Awareness) en het persoonlijke voordeel (Desire / WIIFM: <em>What's In It For Me?</em>),
              verlagen we weerstand en kan het leren veranderen écht beginnen.
            </p>
            <p>
              Om uiteindelijk te komen tot instandhouding van de verandering is het essentieel dat op het juiste moment de juiste
              boodschap gecommuniceerd wordt. Hiervoor maken wij samen met uw communicatieverantwoordelijke een strak plan.
            </p>
          </div>
          <ul class="roadmap-checklist">
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> WIIFM-boodschap per doelgroep</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Tijdlijn &amp; communicatiekanalen</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Leiderschapsboodschappen &amp; teasers</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Vroegtijdige weerstand adresseren</li>
          </ul>
        </div>
      </div>

      <!-- STAP 04 -->
      <div class="roadmap-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">04</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Ambassadeursnetwerk</h3>
            <span class="roadmap-tag">Fase 04 · Draagvlak van binnenuit</span>
          </div>
          <div class="roadmap-desc">
            <p>
              Ambassadeurs (champions) zijn de vertegenwoordigers van de organisatie die graag meedenken over de moderne
              werkplek. Zij zijn essentieel voor bewustwording, adoptie en educatie binnen uw teams.
            </p>
            <p>
              Een ambassadeur is een collega die gemotiveerd is om anderen te helpen en interesse heeft in slimmere manieren
              van werken. Zij vangen vragen laagdrempelig op, inspireren hun eigen afdeling en zorgen dat de verandering
              van binnenuit wordt gedragen.
            </p>
          </div>
          <ul class="roadmap-checklist">
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Selectie uit alle geledingen van het bedrijf</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Vroege toegang &amp; deep-dive sessies</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Periodieke ambassadeursbijeenkomsten</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Eerste aanspreekpunt op de werkvloer</li>
          </ul>
        </div>
      </div>

      <!-- STAP 05 -->
      <div class="roadmap-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">05</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Trainingen op maat</h3>
            <span class="roadmap-tag">Fase 05 · Kennis &amp; Vaardigheden</span>
          </div>
          <div class="roadmap-desc">
            <p>
              Elke organisatie heeft unieke medewerkers met elk hun eigen leervoorkeur en tempo. Trainingen maken wij altijd
              op maat op basis van de werkwijze en processen van uw organisatie. Het moet naadloos aansluiten bij hun dagelijkse werk.
            </p>
            <p>
              We werken met kleine groepen van maximaal 10 deelnemers voor optimale interactie. De opbouw is gebaseerd op de
              ADKAR-methode: <em>bewustwording &rarr; verlangen &rarr; kennisoverdracht &rarr; kennisborging &rarr; instandhouding</em>.
            </p>
          </div>
          <ul class="roadmap-checklist">
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Max. 10 deelnemers voor maximale interactie</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Fysiek op locatie of interactief online</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> In de eigen Microsoft 365-omgeving</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Directe vertaling naar de eigen taken</li>
          </ul>
        </div>
      </div>

      <!-- STAP 06 -->
      <div class="roadmap-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">06</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Digitale Leeromgeving</h3>
            <span class="roadmap-tag">Fase 06 · Zelfredzaamheid &amp; Borging</span>
          </div>
          <div class="roadmap-desc">
            <p>
              Deze centrale digitale leeromgeving bouwen wij op basis van Microsoft 365 Learning Pathways. Microsoft past haar
              instructies en video's automatisch aan zodra er een update is uitgerold, waardoor uw instructies en leerpaden
              altijd onderhoudsvriendelijk en actueel blijven.
            </p>
            <p>
              Tevens voegen we eenvoudig uw eigen specifieke bedrijfsprocessen, protocollen en sjablonen toe — een blijvende
              kennisbank voor zittende medewerkers én nieuwe collega's.
            </p>
          </div>
          <ul class="roadmap-checklist">
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Altijd actuele Microsoft-instructies</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Verrijkt met eigen bedrijfsprocessen</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Geïntegreerd in SharePoint &amp; Teams</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Direct inzetbaar voor onboarding</li>
          </ul>
        </div>
      </div>

      <!-- STAP 07 -->
      <div class="roadmap-card vaas-card fade-up">
        <div class="roadmap-badge-col">
          <div class="roadmap-badge">07</div>
        </div>
        <div class="roadmap-content">
          <div class="roadmap-top">
            <h3>Verandering as a Service (VaaS)</h3>
            <span class="roadmap-tag">Fase 07 · Continue Begeleiding &amp; Groei</span>
          </div>
          <div class="roadmap-desc">
            <p>
              Start je binnen je bedrijf met een verandering of heb je moeite om draagvlak te creëren voor veranderingen die al gaande zijn?
              Onze experts helpen graag mee om dit proces tot een blijvend succes te maken.
            </p>
            <p>
              Met onze unieke dienst <strong>Verandering as a Service (VaaS)</strong> krijg je de beschikking over een vaste Noppa-expert
              die je begeleidt, voor een vast en transparant bedrag per maand. De inzet is flexibel af te stemmen, zodat deze naadloos
              aansluit bij de voortgang en intensiteit van het project. Optimale begeleiding en inzet van kennis op een passende wijze.
            </p>
          </div>
          <ul class="roadmap-checklist">
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Vast maandbedrag, geen onverwachte kosten</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Flexibel op- en afschalen naar projectbehoefte</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Doorlopende monitoring van adoptieresultaten</li>
            <li><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span> Vaste sparringpartner voor directie en teams</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- HET ADKAR MODEL -->
<section class="section-alt">
  <div class="container">
    <div class="section-head" style="max-width:760px">
      <span class="caption">Verandermodel</span>
      <h2>Gebaseerd op het beproefde <em>ADKAR-model</em></h2>
      <p>
        Verandering slaagt pas wanneer individuele medewerkers de verandering doormaken. Ons programma
        is stevig geworteld in het wereldwijd erkende ADKAR-model van Prosci.
      </p>
    </div>

    <div class="adkar-grid">
      <div class="adkar-card fade-up">
        <div class="adkar-letter">A</div>
        <div class="adkar-word">Awareness</div>
        <p class="adkar-desc">Begrip van de noodzaak. Waarom veranderen we en wat gebeurt er als we niets doen?</p>
      </div>
      <div class="adkar-card fade-up">
        <div class="adkar-letter">D</div>
        <div class="adkar-word">Desire</div>
        <p class="adkar-desc">De wil om mee te doen. Wat levert het de individuele medewerker op (WIIFM)?</p>
      </div>
      <div class="adkar-card fade-up">
        <div class="adkar-letter">K</div>
        <div class="adkar-word">Knowledge</div>
        <p class="adkar-desc">Kennis van de tools en de nieuwe werkwijzen via gerichte trainingen.</p>
      </div>
      <div class="adkar-card fade-up">
        <div class="adkar-letter">A</div>
        <div class="adkar-word">Ability</div>
        <p class="adkar-desc">Het vermogen om de kennis daadwerkelijk toe te passen in het dagelijkse werk.</p>
      </div>
      <div class="adkar-card fade-up">
        <div class="adkar-letter">R</div>
        <div class="adkar-word">Reinforcement</div>
        <p class="adkar-desc">Borging van het nieuwe gedrag zodat terugval naar oude gewoonten wordt voorkomen.</p>
      </div>
    </div>

    <div class="journey-bar fade-up">
      <div class="journey-step">
        <div class="j-icon"><img src="../assets/icons/sparkles.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
        <div class="j-lbl">Bewust</div>
      </div>
      <div class="journey-arrow">›</div>
      <div class="journey-step">
        <div class="j-icon"><img src="../assets/icons/chat.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
        <div class="j-lbl">Geïnteresseerd</div>
      </div>
      <div class="journey-arrow">›</div>
      <div class="journey-step">
        <div class="j-icon"><img src="../assets/icons/rocket.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
        <div class="j-lbl">Gemotiveerd</div>
      </div>
      <div class="journey-arrow">›</div>
      <div class="journey-step">
        <div class="j-icon"><img src="../assets/icons/dashboard.svg" class="noppa-icon" alt="" style="width:16px;height:16px;display:inline-block;vertical-align:middle;"></div>
        <div class="j-lbl">Eerste ervaring</div>
      </div>
      <div class="journey-arrow">›</div>
      <div class="journey-step">
        <div class="j-icon"><img src="../assets/icons/document.svg" class="noppa-icon" alt="" style="width:16px;height:16px;display:inline-block;vertical-align:middle;"></div>
        <div class="j-lbl">Opleiding</div>
      </div>
      <div class="journey-arrow">›</div>
      <div class="journey-step">
        <div class="j-icon"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></div>
        <div class="j-lbl">Gebruik</div>
      </div>
      <div class="journey-arrow">›</div>
      <div class="journey-step">
        <div class="j-icon"><img src="../assets/icons/shield.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
        <div class="j-lbl">Geborgd</div>
      </div>
    </div>
  </div>
</section>

<!-- WIJ ZIJN NOPPA (OVER ONS / VERTROUWEN) -->
<section class="section">
  <div class="container">
    <div class="about-team-grid">
      <div class="about-team-img-wrap">
        <img src="../assets/images/grasso-ondernemers.png" alt="Noppa Solutions &amp; Consultants bij Grasso Den Bosch" loading="lazy">
      </div>
      <div>
        <span class="caption">Over Noppa</span>
        <h2 style="font-size:36px;line-height:1.15;margin:10px 0 16px">Wij zijn Noppa Solutions &amp; Consultants</h2>
        <p class="lead" style="font-size:1.05rem;line-height:1.65;margin-bottom:14px">
          Wij zijn dé no-nonsense Microsoft 365 partner die de mens centraal stelt. Wij ondersteunen
          organisaties met zinvolle, concrete oplossingen die aansluiten bij uw visie, teams en werkprocessen.
        </p>
        <p style="font-size:0.95rem;color:var(--text-muted);line-height:1.65;margin-bottom:20px">
          Klanttevredenheid, kwaliteit en werkplezier staan bij ons altijd voorop. Geen ellenlange rapporten
          die in een la verdwijnen, maar directe begeleiding die landt op de werkvloer.
        </p>

        <div class="pillar-badges-grid">
          <div class="pillar-badge-box">
            <strong>Helder</strong>
            <p>Zonder ruis. Concrete oplossingen en duidelijke taal, geen jargon.</p>
          </div>
          <div class="pillar-badge-box">
            <strong>Vooruit</strong>
            <p>Altijd in beweging. We versnellen waar het kan en borgen het resultaat.</p>
          </div>
          <div class="pillar-badge-box">
            <strong>Verbonden</strong>
            <p>Met uw team, de praktijk en de nieuwste Microsoft-technologie.</p>
          </div>
          <div class="pillar-badge-box">
            <strong>Vakkundig</strong>
            <p>Onderbouwde keuzes en bewezen methodieken als vaste kwaliteitsstandaard.</p>
          </div>
        </div>

        <div style="margin-top:28px">
          <a href="../index.php#over" class="btn btn-secondary">Ontmoet ons team &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="section" style="padding-top:0">
  <div class="container">
    <div class="cta-banner">
      <div class="cta-content">
        <h2 style="margin-bottom:10px">Benieuwd hoe we jouw organisatie kunnen helpen?</h2>
        <p style="font-size:16px;opacity:.95;max-width:540px;margin:0">
          Plan een vrijblijvend adviesgesprek en ontdek hoe we de menselijke kant van verandering
          laten slagen — met meetbaar resultaat vanaf dag één.
        </p>
      </div>
      <div style="display:flex;gap:12px;flex-wrap:wrap">
        <a href="../contact.php#booking" class="btn btn-white">Plan een kennismaking &rarr;</a>
        <a href="../noppa-ai-fit.php" class="btn btn-ghost-light">Doe de AI-fit scan</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php include $base . "partials/footer.php"; ?>

<script>
const obs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 80);
            obs.unobserve(e.target);
        }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
</script>
<script src="../assets/js/site.js"></script>
</body>
</html>
