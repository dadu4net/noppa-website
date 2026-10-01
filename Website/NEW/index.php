<?php
// =========================================================================
// Noppa Solutions & Consultants — Homepage
// Driven by content/pages/index.md and standardized according to Noppa skills
// =========================================================================

require_once __DIR__ . '/includes/content_loader.php';

$pageContent = getPageContent('index');
$meta = $pageContent['meta'] ?? [];

$pageTitle = $meta['title'] ?? "Noppa Solutions — Grip op Microsoft 365, Copilot Readiness & Adoptie";
$pageDesc  = $meta['description'] ?? "Grip op Microsoft 365, een veilige Copilot en adoptie die écht landt. Binnen vier weken van nul naar een veilig en getraind team. Geen consultancy-marathons.";
$active    = 'home';
$base      = "";

include __DIR__ . "/partials/header.php";
include __DIR__ . "/partials/nav.php";
?>

<main id="top">

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div>
        <span class="eyebrow"><span class="dot"></span> <?= htmlspecialchars($meta['eyebrow'] ?? 'Microsoft 365 Consultancy · Copilot Readiness · Adoptie & Governance') ?></span>
        <h1>Grip op Microsoft 365. <span class="grad">Een veilige Copilot.</span> Adoptie die écht landt.</h1>
        <p class="lead"><?= htmlspecialchars($meta['lead'] ?? 'Wij helpen MKB- en enterprise-teams binnen vier weken aan een veilige Microsoft 365-omgeving en medewerkers die Copilot dagelijks benutten. Geen theoretische nota\'s of consultancy-marathons, maar pragmatische governance en directe productiviteitswinst.') ?></p>
        <div class="cta-row">
          <a href="contact.php#booking" class="btn btn-primary">Plan direct een kennismaking <span class="arrow">→</span></a>
          <a href="#workshops" class="btn btn-ghost">Bekijk onze workshops ↓</a>
        </div>
      </div>
    </div>
  </section>

  <!-- SOCIAL PROOF BAR (Eenmalig direct onder de Hero) -->
  <section class="section" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="container" style="max-width: 980px;">
      <aside class="hero-card" aria-label="Resultaat in cijfers">
        <span class="caption">Resultaat in cijfers</span>
        <div class="stat-row">
          <div class="stat">
            <div class="num tabular-nums">4 wk</div>
            <div class="lbl">Van nul naar een veilig &amp; getraind team</div>
          </div>
          <div class="stat">
            <div class="num tabular-nums">100%</div>
            <div class="lbl">Grip op data &amp; rechten (geen oversharing)</div>
          </div>
          <div class="stat">
            <div class="num tabular-nums">+38%</div>
            <div class="lbl">Tijdwinst op dagelijkse routinetaken</div>
          </div>
          <div class="stat">
            <div class="num tabular-nums">10+</div>
            <div class="lbl">Jaar diepgaande Microsoft 365-ervaring</div>
          </div>
        </div>
        <ul class="feature-list">
          <li><span class="check">✓</span> Copilot-adoptie die landt op de werkvloer</li>
          <li><span class="check">✓</span> Waterdichte inrichting met Microsoft Purview</li>
          <li><span class="check">✓</span> Geen adviesrapporten, direct live resultaat</li>
        </ul>
      </aside>
    </div>
  </section>

  <!-- VERTROUWD DOOR (REFERENTIES LOGOS) -->
  <section class="section-alt" style="padding-top: 30px; padding-bottom: 30px; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
    <div class="container" style="text-align: center;">
      <span class="caption" style="display:block; margin-bottom: 20px; font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase;">Vertrouwd door toonaangevende organisaties</span>
      <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 36px; opacity: 0.75;">
        <img src="assets/referenties/bernhoven.svg" alt="Bernhoven" height="26" style="filter: grayscale(1); max-width: 120px;" loading="lazy">
        <img src="assets/referenties/certe.svg" alt="Certe" height="26" style="filter: grayscale(1); max-width: 120px;" loading="lazy">
        <img src="assets/referenties/hollandia.svg" alt="Hollandia" height="26" style="filter: grayscale(1); max-width: 120px;" loading="lazy">
        <img src="assets/referenties/klm-catering.svg" alt="KLM Catering Services" height="26" style="filter: grayscale(1); max-width: 120px;" loading="lazy">
        <img src="assets/referenties/gemeente-best.svg" alt="Gemeente Best" height="26" style="filter: grayscale(1); max-width: 120px;" loading="lazy">
        <img src="assets/referenties/svn.svg" alt="SVN" height="26" style="filter: grayscale(1); max-width: 100px;" loading="lazy">
        <img src="assets/referenties/eurosort.svg" alt="Eurosort" height="26" style="filter: grayscale(1); max-width: 120px;" loading="lazy">
        <img src="assets/referenties/ebusco.svg" alt="Ebusco" height="26" style="filter: grayscale(1); max-width: 110px;" loading="lazy">
      </div>
    </div>
  </section>

  <!-- HET VRAAGSTUK / DE PIJN VAN DE MARKT -->
  <section class="section-alt" id="waarom">
    <div class="container" style="max-width: 960px;">
      <div class="section-head" style="margin-bottom: 32px;">
        <span class="caption">Het Vraagstuk</span>
        <h2>Licenties aanzetten is makkelijk. Zorgen dat het veilig werkt én gebruikt wordt, is het echte werk.</h2>
      </div>
      <div class="pain-manifest-card">
        <p>
          Veel organisaties lopen vast op twee uitersten: óf de IT-afdeling houdt de rem erop uit angst voor datalekken en oversharing in SharePoint, óf medewerkers krijgen een Copilot-licentie en openen na twee weken gewoon weer hun oude Word-sjabloon.
        </p>
        <p>
          <strong>Noppa slaat de brug.</strong> Wij zorgen dat je tenant waterdicht is ingericht met <strong>Microsoft Purview</strong> én dat je teams precies weten welke prompts en workflows hen dagelijks uren besparen.
        </p>
      </div>
    </div>
  </section>

  <!-- 4 KERNPIJLERS (DIENSTEN CARDS) -->
  <section class="section" id="diensten">
    <div class="container">
      <div class="section-head">
        <span class="caption">Diensten</span>
        <h2>Vier pijlers voor grip, veiligheid en adoptie</h2>
        <p>Van tenant security en governance tot praktijktrainingen en blijvende adoptie op de werkvloer.</p>
      </div>
      <div class="services-grid" style="grid-template-columns: repeat(2, 1fr);">
        
        <!-- Pijler 1: Copilot Readiness & Security -->
        <article class="service">
          <div class="service-ico"><?= renderNoppaIcon('shield', '', 36, $base) ?></div>
          <span class="caption" style="display:block;margin-bottom:6px">Pijler 01</span>
          <h3>Copilot Readiness &amp; Tenant Security</h3>
          <p style="font-weight:600;color:var(--text-heading);margin-bottom:8px">Veilig starten met Copilot zonder datalekken</p>
          <p>Voordat Copilot live gaat, moet je data op orde zijn. We analyseren SharePoint-rechten, gevoelige documenten en oversharing. Met Microsoft Purview richten we automatische labels en databescherming in, zodat gevoelige directie- of HR-informatie nooit bij de verkeerde medewerker opduikt.</p>
          <ul>
            <li>Tenant Readiness Scan &amp; rechtenanalyse</li>
            <li>Microsoft Purview &amp; Sensitivity Labels</li>
            <li>Data hygiene &amp; opschoning van verouderde structuren</li>
          </ul>
          <div style="margin-top:20px">
            <a href="diensten/ai-copilot.php" class="btn btn-ghost" style="padding: 8px 16px; font-size: 0.85rem;">Ontdek Copilot Readiness →</a>
          </div>
        </article>

        <!-- Pijler 2: Workshops & Trainingen -->
        <article class="service">
          <div class="service-ico"><?= renderNoppaIcon('brain', '', 36, $base) ?></div>
          <span class="caption" style="display:block;margin-bottom:6px">Pijler 02</span>
          <h3>Praktijkgerichte Workshops &amp; Prompt Training</h3>
          <p style="font-weight:600;color:var(--text-heading);margin-bottom:8px">Van AI-scepsis naar direct dagelijks rendement</p>
          <p>Geen algemene demo's, maar hands-on sessies op de eigen laptop met eigen werkprocessen. We leren teams hoe ze prompts schrijven die wél werken, hoe ze routinewerk automatiseren en hoe Copilot een vaste collega wordt.</p>
          <ul>
            <li>Directe use-case identificatie per rol (HR, Finance, Sales, Projectleiding)</li>
            <li>Hands-on prompt engineering &amp; best practices</li>
            <li>Vaste formats: van inspiratiesessie (1,5 - 2 uur) tot team-deep-dive</li>
          </ul>
          <div style="margin-top:20px">
            <a href="diensten/workshops-trainingen.php" class="btn btn-ghost" style="padding: 8px 16px; font-size: 0.85rem;">Bekijk Workshops →</a>
          </div>
        </article>

        <!-- Pijler 3: Adoptie & Begeleiding -->
        <article class="service">
          <div class="service-ico"><?= renderNoppaIcon('team', '', 36, $base) ?></div>
          <span class="caption" style="display:block;margin-bottom:6px">Pijler 03</span>
          <h3>M365 Adoptie &amp; Begeleiding</h3>
          <p style="font-weight:600;color:var(--text-heading);margin-bottom:8px">Gedragsverandering die beklijft op de werkvloer</p>
          <p>Software implementeren is techniek; adoptie is mensenwerk. We werken náást je team op de werkvloer. Met champions-programma's, wekelijkse sprints en laagdrempelige Q&amp;A's borgen we dat de nieuwe manier van werken standaard wordt.</p>
          <ul>
            <li>4- tot 8-weken adoptieprogramma</li>
            <li>Champions-netwerk binnen jouw organisatie</li>
            <li>Meetbare adoptiemetrics en continue bijsturing</li>
          </ul>
          <div style="margin-top:20px">
            <a href="diensten/adoptie-begeleiding.php" class="btn btn-ghost" style="padding: 8px 16px; font-size: 0.85rem;">Lees over Adoptie →</a>
          </div>
        </article>

        <!-- Pijler 4: Governance & Consultancy -->
        <article class="service">
          <div class="service-ico"><?= renderNoppaIcon('workflow', '', 36, $base) ?></div>
          <span class="caption" style="display:block;margin-bottom:6px">Pijler 04</span>
          <h3>Microsoft 365 Consultancy &amp; Governance</h3>
          <p style="font-weight:600;color:var(--text-heading);margin-bottom:8px">Rust, structuur en regie in Teams &amp; SharePoint</p>
          <p>Voorkom wildgroei van kanalen, sites en zwevende bestanden. We ontwerpen een heldere governance-structuur die de IT-beheerder ontlast en de medewerker niet belemmert. Werkend beleid in plaats van dikke handboeken.</p>
          <ul>
            <li>Inrichting &amp; lifecycle management voor Microsoft Teams &amp; SharePoint</li>
            <li>Guest access en externe samenwerkingsprotocollen</li>
            <li>Power Automate koppelingen voor repeterende goedkeuringsprocessen</li>
          </ul>
          <div style="margin-top:20px">
            <a href="diensten/processen-portalen.php" class="btn btn-ghost" style="padding: 8px 16px; font-size: 0.85rem;">Ontdek Governance &amp; Portalen →</a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- PRODUCTKAARTEN WORKSHOPS (Direct inkoopbaar) -->
  <section class="section-alt" id="workshops">
    <div class="container">
      <div class="section-head">
        <span class="caption">Praktijkgerichte Sessies</span>
        <h2>Direct inzetbare workshops &amp; programma's</h2>
        <p>Kies het format dat aansluit bij jouw fase: van inspiratie voor het hele team tot een intensief 4-weken adoptietraject.</p>
      </div>

      <div class="workshop-cards-grid">
        
        <!-- Kaart 1: Inspiratie & Demo -->
        <div class="workshop-card">
          <div>
            <span class="workshop-badge">1,5 – 2 uur · Plenair / Hybride</span>
            <h3>Copilot Kickstart</h3>
            <p style="font-size:0.9rem;color:var(--text-muted);margin-bottom:12px">Inspiratie &amp; Live Demonstratie</p>
            
            <div class="workshop-meta">
              <div class="workshop-meta-row">
                <strong>Duur:</strong>
                <span>1,5 – 2 uur (Plenair of Hybride)</span>
              </div>
              <div class="workshop-meta-row">
                <strong>Voor wie:</strong>
                <span>Directie, management of voltallige teams die willen zien wat er mogelijk is.</span>
              </div>
            </div>

            <div class="workshop-result">
              <strong>Wat levert het op?</strong>
              Draagvlak in de organisatie, live demonstraties met herkenbare use cases, inzicht in licenties en directe kansen.
            </div>
          </div>

          <a href="contact.php#booking" class="btn btn-ghost workshop-cta">Vraag datum aan →</a>
        </div>

        <!-- Kaart 2: Rolgerichte Deep-Dive (Featured) -->
        <div class="workshop-card featured">
          <div>
            <span class="workshop-badge">Halve dag · Max 10 pers · Hands-on</span>
            <h3>Team Productivity Lab</h3>
            <p style="font-size:0.9rem;color:var(--text-muted);margin-bottom:12px">Rolgerichte Deep-Dive</p>
            
            <div class="workshop-meta">
              <div class="workshop-meta-row">
                <strong>Duur:</strong>
                <span>Halve dag (max. 10 deelnemers)</span>
              </div>
              <div class="workshop-meta-row">
                <strong>Voor wie:</strong>
                <span>Specifieke afdelingen (HR, Finance, Sales, Projectleiding) met eigen cases &amp; data.</span>
              </div>
            </div>

            <div class="workshop-result">
              <strong>Wat levert het op?</strong>
              5 direct werkende prompts per persoon, concrete workflows in eigen apps en directe tijdwinst vanaf week één.
            </div>
          </div>

          <a href="contact.php#booking" class="btn btn-primary workshop-cta">Boek workshop →</a>
        </div>

        <!-- Kaart 3: 4-Weken Adoptie Sprint -->
        <div class="workshop-card">
          <div>
            <span class="workshop-badge">4 weken · Volledige Implementatie</span>
            <h3>4-Weken Adoptie Sprint</h3>
            <p style="font-size:0.9rem;color:var(--text-muted);margin-bottom:12px">Beveiliging, Training &amp; Borging</p>
            
            <div class="workshop-meta">
              <div class="workshop-meta-row">
                <strong>Duur:</strong>
                <span>4 weken intensieve begeleiding</span>
              </div>
              <div class="workshop-meta-row">
                <strong>Voor wie:</strong>
                <span>Organisaties die Copilot veilig, compliant en geborgd willen uitrollen.</span>
              </div>
            </div>

            <div class="workshop-result">
              <strong>Wat levert het op?</strong>
              Veilige tenant zonder oversharing, getrainde champions, Microsoft Purview ingericht en meetbare adoptie.
            </div>
          </div>

          <a href="contact.php#booking" class="btn btn-ghost workshop-cta">Plan intake →</a>
        </div>

      </div>
    </div>
  </section>

  <!-- AANPAK (4 WEKEN TIJDLINJ) -->
  <section class="section" id="aanpak">
    <div class="container">
      <div class="section-head">
        <span class="caption">Aanpak</span>
        <h2>Vier stappen. Vier weken. Klaar.</h2>
        <p>Geen eindeloze adviestrajecten. We werken in overzichtelijke sprints met direct zichtbaar resultaat per week.</p>
      </div>
      <div class="steps">
        <div class="step">
          <div class="step-num tabular-nums">01</div>
          <h3>Luisteren &amp; Scannen</h3>
          <p>We kijken mee met je team en analyseren je Microsoft 365-tenant. Waar lekt data? Waar stokt de samenwerking?</p>
        </div>
        <div class="step">
          <div class="step-num tabular-nums">02</div>
          <h3>Inrichten &amp; Beveiligen</h3>
          <p>We zetten de governance, rechten en Purview-instellingen strak. Geen theorie, direct live in productie.</p>
        </div>
        <div class="step">
          <div class="step-num tabular-nums">03</div>
          <h3>Trainen &amp; Activeren</h3>
          <p>Hands-on use-case workshops en prompt-trainingen op de werkplek. Mensen gaan zélf aan de knoppen.</p>
        </div>
        <div class="step">
          <div class="step-num tabular-nums">04</div>
          <h3>Borgen &amp; Doorpakken</h3>
          <p>Evaluatie, champions trainen en overdracht van eigenaarschap. Jouw team kan zelfstandig verder.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- WAT ONS DRIJFT (4 ANKERS) -->
  <section class="section-alt" id="pijlers">
    <div class="container">
      <div class="section-head">
        <span class="caption">Wat ons drijft</span>
        <h2>Vier ankers. Eén belofte.</h2>
        <p>Helder, vooruit, verbonden en vakkundig — dit is hoe we werken bij elke opdracht.</p>
      </div>
      <div class="pillars-grid">
        <div class="pillar">
          <div class="ico"><?= renderNoppaIcon('lightning', '', 32, $base) ?></div>
          <h3>Helder</h3>
          <p>Geen jargon, geen aannames. We zeggen wat we zien en wat het oplost.</p>
        </div>
        <div class="pillar">
          <div class="ico"><?= renderNoppaIcon('growth', '', 32, $base) ?></div>
          <h3>Vooruit</h3>
          <p>Korte cycli, snelle wins. Resultaat boven roadmap-romantiek.</p>
        </div>
        <div class="pillar">
          <div class="ico"><?= renderNoppaIcon('team', '', 32, $base) ?></div>
          <h3>Verbonden</h3>
          <p>We werken náást je team — niet erboven. Jij houdt het stuur, wij de versnelling.</p>
        </div>
        <div class="pillar">
          <div class="ico"><?= renderNoppaIcon('brain', '', 32, $base) ?></div>
          <h3>Vakkundig</h3>
          <p>Microsoft-stack, data en AI — diepe expertise, scherpe uitvoering.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- OVER RIK / NOPPA -->
  <section class="section" id="over">
    <div class="container about-grid">
      <div>
        <span class="caption">Over Noppa</span>
        <h2>Klein team. Grote impact. Geen omhaal.</h2>
        <p>Noppa Solutions &amp; Consultants helpt organisaties productiever te worden met het Microsoft-platform. We zijn praktisch, direct en altijd vooruit denkend.</p>
        <p>Geen lange offertes, geen volle Gantt-charts. Wel: een telefoon die wordt opgenomen, een afspraak die wordt nagekomen, en oplossingen die werken op maandagochtend om 9 uur.</p>
        <div class="about-stats">
          <div class="about-stat">
            <div class="num tabular-nums">10+</div>
            <div class="lbl">jaar Microsoft-ervaring</div>
          </div>
          <div class="about-stat">
            <div class="num tabular-nums">4 wk</div>
            <div class="lbl">tot werkend resultaat</div>
          </div>
        </div>
      </div>

      <aside class="person-card" aria-label="Rik Dobbelsteen">
        <a href="team/rik-dobbelsteen.php" style="display:block;color:inherit;text-decoration:none">
          <div style="width: 72px; height: 72px; border-radius: 50%; overflow: hidden; margin-bottom: 14px; border: 2px solid var(--color-cyan);">
            <img src="assets/images/Rik Dobbelsteen.jpg" alt="Rik Dobbelsteen" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div class="person-name">Rik Dobbelsteen</div>
          <div class="person-role">Consultant &amp; Co-founder</div>
          <p class="person-bio">"Ik help teams in een paar weken écht aan de slag met Microsoft 365 en Copilot. Praktisch, hands-on en met een resultaat waar je morgen al iets aan hebt."</p>
        </a>
        <div style="margin-top:18px"><a href="team/rik-dobbelsteen.php" class="btn btn-ghost" style="padding:10px 18px;font-size:13px">Bekijk profiel →</a></div>
        <div class="person-contact">
          <span class="contact-pill">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
            06-13 35 77 23
          </span>
          <span class="contact-pill">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            rik@noppa.nl
          </span>
        </div>
      </aside>
    </div>
  </section>

  <!-- CTA BANNER (SLUITENDE CONVERSIE) -->
  <section class="section-alt" style="padding-bottom: 90px;">
    <div class="container">
      <div class="cta-banner">
        <div>
          <h2>Klaar voor rust in Microsoft 365 en een werkende Copilot?</h2>
          <p>Plan 30 minuten met Rik. Geen verkooppresentatie, wel direct inzicht in de readiness van jouw organisatie.</p>
        </div>
        <a href="contact.php#booking" class="btn">Plan een gesprek <span class="arrow">→</span></a>
      </div>
    </div>
  </section>

</main>

<?php include __DIR__ . "/partials/footer.php"; ?>
