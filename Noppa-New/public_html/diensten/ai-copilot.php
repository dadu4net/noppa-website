<?php
$pageTitle = "AI-integratie & Microsoft Copilot | Noppa";
$pageDesc = "Noppa begeleidt organisaties bij de adoptie van Microsoft Copilot en AI binnen Microsoft 365. Pilots, governance, training en concrete use cases.";
$base = "../";
include $base . "partials/header.php";
?>

<!-- ICON SPRITE (inline voor universele compatibiliteit) -->
<svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
<symbol id="ic-0c40c7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></symbol>
<symbol id="ic-0d33a5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></symbol>
<symbol id="ic-2ecd50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></symbol>
<symbol id="ic-6142af" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 18L9 11.25l4.306 4.306a11.95 11.95 0 015.814-5.518l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></symbol>
<symbol id="ic-a6c534" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></symbol>
<symbol id="ic-dfe03d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></symbol>
<symbol id="phone-old" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></symbol>
<symbol id="users-group-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></symbol>
<symbol id="wrench-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63"/></symbol>
</svg>

<!-- NAV (injected by assets/js/site.js) -->
<?php include $base . "partials/nav.php"; ?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="../index.php">Home</a>
            <span>›</span>
            <a href="../index.php#diensten">Diensten</a>
            <span>›</span>
            <span style="color: #fff;">AI-integratie & Copilot</span>
        </div>
        <div class="hero-eyebrow">
            <svg width="13" height="13" aria-hidden="true"><use href="#ic-0c40c7"/></svg>
            AI-integratie & Microsoft Copilot
        </div>
        <h1 >Maak AI <em>echt waardevol</em><br>voor uw organisatie</h1>
        <p class="hero-sub">
            Microsoft Copilot belooft veel — wij zorgen dat het ook <strong>levert</strong>.
            Van de eerste verkenning tot een gedragen, veilige uitrol: wij begeleiden uw team
            bij elke stap van de AI-reis binnen Microsoft 365.
        </p>
        <div class="hero-actions">
            <a href="../contact.php" class="btn btn-accent">
                <svg width="15" height="15" aria-hidden="true"><use href="#phone-old"/></svg>
                Plan een Copilot-pilot
            </a>
            <a href="#aanpak" class="btn btn-ghost-dark">Onze aanpak →</a>
        </div>
    </div>
</section>

<!-- INTRO + STATS -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>De uitdaging</span>
                <h2 >AI is geen tool — het is een <em>verandering</em></h2>
                <p class="lead">
                    Veel organisaties schaffen Copilot-licenties aan en hopen dat de productiviteit vanzelf stijgt.
                    De realiteit: zonder duidelijke use cases, juiste data-governance en gerichte adoptie blijft
                    Copilot een dure proeftuin.
                </p>
                <p class="lead">
                    Noppa maakt de stap van <strong>licentie naar werkelijke waarde</strong>. Wij combineren
                    technische kennis van het Microsoft-ecosysteem met onze ervaring in mensgerichte adoptie —
                    zodat AI bij uw mensen écht blijft plakken.
                </p>
            </div>
            <div class="about-stats">
                <div class="about-stat"><span class="num">M365</span><span class="lbl">Native Microsoft</span></div>
                <div class="about-stat"><span class="num">2025+</span><span class="lbl">Copilot-ready</span></div>
                <div class="about-stat"><span class="num">5</span><span class="lbl">Specialisten</span></div>
                <div class="about-stat"><span class="num">A–Z</span><span class="lbl">Strategie tot adoptie</span></div>
            </div>
        </div>
    </div>
</section>

<!-- WAT WE DOEN -->
<section id="wat-doen" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Wat wij voor u doen</span>
        <h2 >Van strategie tot werkende <em>AI-agents</em></h2>
        <p class="lead" style="max-width: 680px; margin-bottom: 18px;">
            Wij dekken het hele Copilot-spectrum binnen Microsoft 365. Of u nu nog onderzoekt of Copilot
            past bij uw organisatie, of al een pilot draait die meer impact moet maken — wij sluiten aan
            bij uw situatie.
        </p>

        <div class="pillars-grid">
            <div class="pillar">
                <div class="pillar-ic"><svg width="24" height="24" aria-hidden="true"><use href="#ic-0d33a5"/></svg></div>
                <h3>Copilot Readiness Scan</h3>
                <p>Wij beoordelen uw M365-tenant op data-hygiëne, rechtenstructuur en licentiemodel. Resultaat: een concreet rapport met go/no-go en quick wins.</p>
            </div>
            <div class="pillar">
                <div class="pillar-ic"><svg width="24" height="24" aria-hidden="true"><use href="#ic-dfe03d"/></svg></div>
                <h3>Pilot-begeleiding</h3>
                <p>Een gerichte pilot met een controlegroep van 10–25 medewerkers. Meetbare doelen, korte sprints, en een afgeronde leerlus voor de bredere uitrol.</p>
            </div>
            <div class="pillar">
                <div class="pillar-ic"><svg width="24" height="24" aria-hidden="true"><use href="#wrench-2"/></svg></div>
                <h3>AI-Agents & Copilot Studio</h3>
                <p>Bouw van eigen AI-agents in Copilot Studio: van een HR-assistent tot een offerte-assistent die uw bedrijfskennis ontsluit voor uw medewerkers.</p>
            </div>
            <div class="pillar">
                <div class="pillar-ic"><svg width="24" height="24" aria-hidden="true"><use href="#ic-a6c534"/></svg></div>
                <h3>Governance & Compliance</h3>
                <p>Microsoft Purview, gevoeligheidslabels (sensitivity labels), DLP-policies en duidelijke afspraken — zodat AI veilig met uw data omgaat.</p>
            </div>
            <div class="pillar">
                <div class="pillar-ic"><svg width="24" height="24" aria-hidden="true"><use href="#users-group-2"/></svg></div>
                <h3>Adoptie & Training</h3>
                <p>Workshops, lunch-and-learns en use-case-sessies per afdeling. Elke medewerker leert prompts schrijven die werken voor zijn of haar dagelijkse taken.</p>
            </div>
            <div class="pillar">
                <div class="pillar-ic"><svg width="24" height="24" aria-hidden="true"><use href="#ic-6142af"/></svg></div>
                <h3>Meetbare ROI</h3>
                <p>Wij meten daadwerkelijk gebruik, tijdsbesparing en gebruikerstevredenheid — zodat u kunt aantonen dat de Copilot-investering rendeert.</p>
            </div>
        </div>
    </div>
</section>

<!-- USE CASES -->
<section id="cases" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>In de praktijk</span>
        <h2 >Waar AI <em>direct</em> waarde toevoegt</h2>
        <p class="lead" style="max-width: 680px;">
            Vijf gangbare use cases waar wij organisaties mee helpen — bewezen scenario's die snel resultaat opleveren.
        </p>

        <div class="services-grid">
            <div class="service">
                <div class="s-label">1</div>
                <div>
                    <h4>Vergaderingen samenvatten in Teams</h4>
                    <p>Copilot vat meetings automatisch samen, extracteert actiepunten en koppelt deze aan eigenaars. Bespaart elke deelnemer ± 30 min per vergadering.</p>
                </div>
            </div>
            <div class="service">
                <div class="s-label">2</div>
                <div>
                    <h4>E-mail efficiënter beheren</h4>
                    <p>Threads samenvatten, conceptantwoorden genereren en prioriteit suggereren in Outlook — minder tijd in de inbox, meer tijd voor uw werk.</p>
                </div>
            </div>
            <div class="service">
                <div class="s-label">3</div>
                <div>
                    <h4>Documenten & rapporten opstellen</h4>
                    <p>In Word: van bullets naar professionele tekst. In Excel: data-analyse en visualisaties zonder formules. In PowerPoint: van outline naar volledig deck.</p>
                </div>
            </div>
            <div class="service">
                <div class="s-label">4</div>
                <div>
                    <h4>Bedrijfskennis ontsluiten</h4>
                    <p>Copilot Studio-agents die antwoord geven op interne vragen — HR-beleid, IT-procedures, projectinformatie — direct uit SharePoint en Teams.</p>
                </div>
            </div>
            <div class="service">
                <div class="s-label">5</div>
                <div>
                    <h4>Onboarding versnellen</h4>
                    <p>Nieuwe medewerkers stellen vragen aan een persoonlijke onboarding-agent. Sneller productief, minder belasting voor HR en collega's.</p>
                </div>
            </div>
            <div class="service">
                <div class="s-label">6</div>
                <div>
                    <h4>Power Automate × Copilot</h4>
                    <p>Werkstromen die slimmer reageren — bijvoorbeeld inkomende offerteaanvragen automatisch classificeren en doorzetten naar de juiste accountmanager.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AANPAK -->
<section id="aanpak" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Onze aanpak</span>
        <h2 >In <em>4 stappen</em> naar werkelijke AI-adoptie</h2>
        <p class="lead" style="max-width: 680px;">
            Pragmatisch, mensgericht en altijd meetbaar — zo zorgen wij dat AI bij uw mensen blijft plakken.
        </p>

        <div class="timeline-grid">
            <div class="tl-step">
                <span class="tl-num">1</span>
                <h4>Verkenning & Readiness</h4>
                <p>Workshop met stakeholders, scan van uw M365-tenant en identificatie van high-impact use cases.</p>
            </div>
            <div class="tl-step">
                <span class="tl-num">2</span>
                <h4>Pilot & Bewijs</h4>
                <p>Gerichte pilot met meetbare doelen. Kleine groep, snelle leerlus, concrete resultaten in 6–8 weken.</p>
            </div>
            <div class="tl-step">
                <span class="tl-num">3</span>
                <h4>Uitrol & Training</h4>
                <p>Brede uitrol met workshops per afdeling, prompt-bibliotheken en interne ambassadeurs.</p>
            </div>
            <div class="tl-step">
                <span class="tl-num">4</span>
                <h4>Borging & Doorontwikkeling</h4>
                <p>Periodieke metingen, optimalisaties en uitbreiding naar nieuwe use cases of agents.</p>
            </div>
        </div>
    </div>
</section>

<!-- GOVERNANCE -->
<section id="governance" class="section-alt">
    <div class="container">
        <div class="gov-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>Veilig én verantwoord</span>
                <h2 >AI mét <em>governance</em>, niet ondanks</h2>
                <p class="lead">
                    Copilot is zo veilig als de data waarop het wordt losgelaten. Wij zorgen dat uw informatie
                    correct geclassificeerd, beveiligd en gegovernet is — voordat AI er toegang toe krijgt.
                </p>
                <ul class="gov-list">
                    <li>
                        <span class="gov-check"><svg width="24" height="24" aria-hidden="true"><use href="#ic-2ecd50"/></svg></span>
                        <div class="gov-text"><strong>Microsoft Purview-inrichting</strong><span>Sensitivity labels, retention policies en informatieclassificatie op orde.</span></div>
                    </li>
                    <li>
                        <span class="gov-check"><svg width="24" height="24" aria-hidden="true"><use href="#ic-2ecd50"/></svg></span>
                        <div class="gov-text"><strong>Rechten & toegang</strong><span>"Oversharing" voorkomen door de juiste SharePoint-rechtenstructuur.</span></div>
                    </li>
                    <li>
                        <span class="gov-check"><svg width="24" height="24" aria-hidden="true"><use href="#ic-2ecd50"/></svg></span>
                        <div class="gov-text"><strong>AVG & verantwoord gebruik</strong><span>Acceptabel gebruik, verantwoordelijkheidsmatrix en heldere afspraken voor uw medewerkers.</span></div>
                    </li>
                    <li>
                        <span class="gov-check"><svg width="24" height="24" aria-hidden="true"><use href="#ic-2ecd50"/></svg></span>
                        <div class="gov-text"><strong>Monitoring & rapportage</strong><span>Inzicht in wie wat doet met Copilot, waar het waarde toevoegt en waar het stagneert.</span></div>
                    </li>
                </ul>
            </div>
            <div class="gov-visual">
                <p class="gov-quote">
                    "Een succesvolle Copilot-introductie begint <em>niet</em> bij de techniek,
                    maar bij de vraag: <em>waarom</em> doen wij dit, voor <em>wie</em>,
                    en welke <em>kaders</em> hebben we daarvoor nodig."
                </p>
                <p class="gov-by">— Noppa, AI-adoptiefilosofie</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section id="cta-final" class="section-alt">
    <div class="container">
        <h2>Klaar om de waarde van Copilot te ontsluiten?</h2>
        <p>
            Plan een vrijblijvend kennismakingsgesprek van 30 minuten. Wij laten zien hoe een gerichte
            Copilot-pilot binnen 8 weken meetbaar resultaat oplevert voor uw organisatie.
        </p>
        <a href="../contact.php" class="btn btn-dark">
            Plan een kennismaking &rarr;→
        </a>
    </div>
</section>

<!-- FOOTER (injected by assets/js/site.js) -->
<?php include $base . "partials/footer.php"; ?>

</body>
</html>



