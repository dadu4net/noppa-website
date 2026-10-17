<?php
$base_path        = '../';
$page_title       = 'Copilot voor Microsoft 365 | Noppa Solutions &amp; Consultants';
$page_description = 'Copilot training of experience — drie heldere proposities (Basis, Standaard, Custom). Noppa Solutions &amp; Consultants levert van kennismaking tot procesoptimalisatie.';
$page_keywords    = 'Microsoft 365, SharePoint, Teams, Copilot, adoptie, implementatie, consultancy, Berlicum, \'s-Hertogenbosch, productiviteit, digitale werkplek, Power Platform, governance';
$canonical_url    = 'https://www.noppa.nl/diensten/copilot-plannen.html';
$og_image         = 'https://www.noppa.nl/assets/images/DEF_Logo_Noppa.png';
$active_page      = 'diensten';
$extra_head = <<<'HTML'
<style>

        /* INTRO */
        .intro { background: var(--bg-alt); padding: 76px 0; }
        .label {
            display: inline-block; font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.16em; text-transform: uppercase;
            color: var(--royal); margin-bottom: 12px;
        }
        .h2 {
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            font-weight: 800; line-height: 1.2; margin-bottom: 18px;
        }
        .h2 em { font-style: normal; color: var(--royal); }
        .h2.light { color: var(--white); }
        .h2.light em { color: var(--cyan); }
        .body-text { font-size: 1.02rem; color: var(--text-muted); line-height: 1.85; margin-bottom: 16px; }

        .intro-grid { display: grid; grid-template-columns: 1.1fr 1fr; gap: 56px; align-items: center; }
        .intro-pillars { display: flex; flex-direction: column; gap: 14px; }
        .intro-pillar {
            display: flex; align-items: flex-start; gap: 15px;
            padding: 18px 20px; background: var(--bg-card);
            border: 1px solid var(--border-color); border-radius: var(--radius); transition: var(--trans);
        }
        .intro-pillar:hover { border-color: var(--cyan); box-shadow: var(--shadow); transform: translateX(4px); }
        .ip-icon {
            width: 42px; height: 42px; border-radius: 9px;
            background: rgba(0,208,240,0.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .ip-icon svg { width: 21px; height: 21px; stroke: var(--royal); fill: none; stroke-width: 1.7; stroke-linecap: round; stroke-linejoin: round; }
        .intro-pillar h4 { font-size: 0.96rem; font-weight: 700; margin-bottom: 3px; }
        .intro-pillar p  { font-size: 0.86rem; color: var(--text-muted); line-height: 1.6; }

        /* PRICING */
        #pricing { background: var(--bg-card); }
        .pricing-header { text-align: center; max-width: 720px; margin: 0 auto 48px; }
        .pricing-header .body-text { margin: 0 auto; }

        .pricing-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; align-items: stretch;
        }
        .pcard {
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 16px; padding: 36px 30px;
            display: flex; flex-direction: column; transition: var(--trans);
            position: relative;
        }
        .pcard:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); border-color: var(--cyan); }
        .pcard.featured {
            background: var(--navy); color: var(--white);
            border-color: var(--text-main); transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
        }
        .pcard.featured:hover { transform: translateY(-16px); }
        .badge-meest {
            position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
            background: var(--cyan); color: var(--text-main);
            padding: 6px 16px; border-radius: 100px;
            font-size: 0.7rem; font-weight: 800;
            letter-spacing: 0.1em; text-transform: uppercase;
            white-space: nowrap;
        }
        .p-tier {
            font-size: 0.74rem; font-weight: 800; letter-spacing: 0.16em;
            text-transform: uppercase; color: var(--royal); margin-bottom: 8px;
        }
        .pcard.featured .p-tier { color: var(--cyan); }
        .p-name {
            font-size: 1.5rem; font-weight: 900; line-height: 1.2; margin-bottom: 6px;
        }
        .p-target { font-size: 0.86rem; color: var(--text-muted); margin-bottom: 22px; line-height: 1.55; }
        .pcard.featured .p-target { color: rgba(255,255,255,0.6); }

        .p-price {
            padding: 18px 0; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);
            margin-bottom: 22px;
        }
        .pcard.featured .p-price { border-color: rgba(255,255,255,0.1); }
        .p-amount {
            font-size: 2.1rem; font-weight: 900; line-height: 1; color: var(--text-heading);
            display: block;
        }
        .pcard.featured .p-amount { color: var(--white); }
        .p-amount-prefix { font-size: 0.85rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px; }
        .pcard.featured .p-amount-prefix { color: rgba(255,255,255,0.55); }
        .p-amount-suffix { font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-top: 6px; }
        .pcard.featured .p-amount-suffix { color: rgba(255,255,255,0.55); }
        .p-permw { font-size: 0.78rem; color: var(--royal); font-weight: 700; margin-top: 10px; }
        .pcard.featured .p-permw { color: var(--cyan); }

        .p-features { list-style: none; flex-grow: 1; margin-bottom: 24px; }
        .p-features li {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 8px 0; font-size: 0.86rem; line-height: 1.55;
            color: var(--text-main);
        }
        .pcard.featured .p-features li { color: rgba(255,255,255,0.85); }
        .p-check {
            flex-shrink: 0; width: 18px; height: 18px; border-radius: 50%;
            background: rgba(0,208,240,0.18); margin-top: 2px;
            display: flex; align-items: center; justify-content: center;
        }
        .p-check svg { width: 10px; height: 10px; stroke: var(--royal); fill: none; stroke-width: 2.6; stroke-linecap: round; stroke-linejoin: round; }
        .pcard.featured .p-check { background: rgba(0,208,240,0.25); }
        .pcard.featured .p-check svg { stroke: var(--cyan); }
        .p-cta {
            width: 100%; justify-content: center;
        }

        /* COMPARISON TABLE */
        #compare { background: var(--bg-alt); }
        .compare-wrap { overflow-x: auto; margin-top: 28px; }
        .ctable {
            width: 100%; border-collapse: collapse; min-width: 720px;
            background: var(--bg-card); border-radius: 14px; overflow: hidden;
            box-shadow: var(--shadow);
        }
        .ctable th, .ctable td {
            padding: 14px 18px; text-align: left;
            border-bottom: 1px solid var(--border-color); vertical-align: top;
        }
        .ctable thead th {
            background: var(--navy); color: var(--white);
            font-size: 0.84rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.06em; border-bottom: none;
        }
        .ctable thead th:first-child {
            background: var(--navy);
        }
        .ctable thead th.col-feat {
            background: var(--royal); color: var(--text-main);
        }
        .ctable .row-section td {
            background: var(--bg-alt); font-weight: 800; color: var(--royal);
            font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.08em;
            padding: 10px 18px;
        }
        .ctable td.feat { font-weight: 700; color: var(--text-main); width: 36%; font-size: 0.9rem; }
        .ctable td.tier { color: var(--text-muted); font-size: 0.88rem; width: 21.3%; }
        .ctable td.tier.has { color: var(--text-main); font-weight: 600; }
        .ctable td.tier .tick { color: var(--royal); font-weight: 900; font-size: 1rem; }
        .ctable td.tier .dash { color: #c8ccd3; }
        .ctable tbody tr:last-child td { border-bottom: none; }

        /* PROCES */
        #proces { background: var(--navy); color: var(--white); }
        #proces .label { color: var(--cyan); }
        #proces .body-text { color: rgba(255,255,255,0.6); }
        .proces-grid {
            display: grid; grid-template-columns: repeat(5, 1fr); gap: 14px; margin-top: 24px;
        }
        .pstep {
            background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius); padding: 24px 20px; transition: var(--trans);
        }
        .pstep:hover {
            background: rgba(242,184,44,0.06); border-color: rgba(0,208,240,0.30);
            transform: translateY(-4px);
        }
        .pstep-num {
            display: inline-block; width: 32px; height: 32px; border-radius: 50%;
            background: var(--cyan); color: var(--text-main);
            text-align: center; line-height: 32px; font-weight: 900;
            font-size: 0.9rem; margin-bottom: 12px;
        }
        .pstep h4 { font-size: 0.95rem; font-weight: 800; color: var(--white); margin-bottom: 6px; }
        .pstep p  { font-size: 0.82rem; color: rgba(255,255,255,0.55); line-height: 1.6; }

        /* FAQ */
        #faq { background: var(--bg-card); }
        .faq-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-top: 22px; }
        .faq {
            border: 1px solid var(--border-color); border-radius: var(--radius);
            padding: 22px 24px; transition: var(--trans);
            background: var(--bg-card);
        }
        .faq:hover { border-color: var(--cyan); box-shadow: var(--shadow); }
        .faq summary {
            cursor: pointer; list-style: none;
            display: flex; align-items: center; justify-content: space-between;
            font-size: 0.96rem; font-weight: 700; color: var(--text-main);
        }
        .faq summary::-webkit-details-marker { display: none; }
        .faq summary::after {
            content: '+'; font-size: 1.4rem; color: var(--royal);
            transition: var(--trans); margin-left: 12px;
            line-height: 1; font-weight: 400;
        }
        .faq[open] summary::after { transform: rotate(45deg); }
        .faq p {
            font-size: 0.88rem; color: var(--text-muted);
            line-height: 1.75; margin-top: 12px;
        }

        /* CTA */
        #cta-final {
            background: linear-gradient(135deg, var(--cyan) 0%, var(--royal) 100%);
            text-align: center;
        }
        #cta-final h2 {
            font-size: clamp(1.7rem, 3vw, 2.4rem); font-weight: 900;
            color: var(--text-main); margin-bottom: 16px;
        }
        #cta-final p {
            font-size: 1.05rem; color: rgba(24,34,43,0.78);
            max-width: 560px; margin: 0 auto 32px; line-height: 1.7;
        }


        @media (max-width: 1024px) {
            .pricing-grid { grid-template-columns: 1fr; max-width: 480px; margin: 0 auto; }
            .pcard.featured { transform: none; }
            .pcard.featured:hover { transform: translateY(-4px); }
            .proces-grid { grid-template-columns: repeat(2, 1fr); }
            .faq-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            section { padding: 60px 0; }
        }
        @media (max-width: 540px) {
            .proces-grid { grid-template-columns: 1fr; }
        }
    </style>
HTML;

require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/nav.php';
?>

<svg aria-hidden="true" style="position:absolute;width:0;height:0;overflow:hidden" xmlns="http://www.w3.org/2000/svg">
<symbol fill="none" id="check-small" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M2 6l3 3 5-5"></path></symbol>
<symbol fill="none" id="ic-0d33a5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></symbol>
<symbol fill="none" id="ic-2ba45b" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"></path></symbol>
<symbol fill="none" id="ic-ad82be" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M12 5v14M5 12h14"></path></symbol>
<symbol fill="none" id="ic-b65be9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M3 9.5L12 4l9 5.5M5 10v9h14v-9M9 19v-5h6v5"></path></symbol>
<symbol fill="none" id="ic-c03fd1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></symbol>
</svg>
<!-- HERO -->
<section class="hero">
<svg aria-hidden="true" class="hero-rings" viewbox="0 0 540 540" xmlns="http://www.w3.org/2000/svg">
<circle cx="270" cy="270" fill="none" r="244" stroke="rgba(0,208,240,0.14)" stroke-width="44"></circle>
<circle cx="270" cy="270" fill="none" r="172" stroke="rgba(32,176,240,0.12)" stroke-width="36"></circle>
<circle cx="270" cy="270" fill="none" r="108" stroke="rgba(32,96,224,0.10)" stroke-width="28"></circle>
<circle cx="270" cy="270" fill="none" r="58" stroke="rgba(0,208,240,0.08)" stroke-width="20"></circle>
</svg>
<div class="container">
<div class="breadcrumb">
<a href="../index.php">Home</a>
<span>›</span>
<a href="../index.php#diensten">Diensten</a>
<span>›</span>
<span style="color: var(--white);">Copilot</span>
</div>
<div class="hero-eyebrow">
<img src="../assets/icons/sparkles.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
            Copilot voor Microsoft 365
        </div>
<h1 class="hero-h1">Ontdek de kracht van AI in <em>jouw organisatie</em></h1>
<p class="hero-sub">
            Start vandaag om kennis op te bouwen wat de mogelijkheden zijn van Copilot om jouw werk
            leuker, sneller, efficienter en professioneler te maken.
            Afhankelijk van waar jij met jouw organisatie staat hebben we verschillende trajecten om
            te starten, meer diepgang op te zoeken of daadwerkelijk een proces in je organisatie te optimaliseren.
        </p>
<div class="hero-btns">
<a class="btn btn-primary" href="#pricing">
<svg aria-hidden="true" height="15" stroke="var(--navy)" width="15"><use href="../assets/icons.svg#plus"></use></svg>
                Bekijk onze proposities
            </a>
<!-- a href="#proces" class="btn btn-outline">Onze aanpak →</a -->
</div>
</div>
</section>
<!-- INTRO + STATS -->
<section class="intro">
<div class="container">
<div class="intro-grid">
<div>
<span class="label">De uitdaging</span>
<h2 class="h2">AI is geen tool — het is een <em>verandering</em></h2>
<p class="body-text">
                    Veel organisaties schaffen Copilot-licenties aan en hopen dat de productiviteit vanzelf stijgt.
                    De realiteit: zonder duidelijke use cases, juiste data-governance en gerichte adoptie blijft
                    Copilot een dure proeftuin.
                </p>
<p class="body-text">
                    Noppa Solutions &amp; Consultants maakt de stap van <strong>licentie naar werkelijke waarde</strong>. Wij combineren
                    technische kennis van het Microsoft-ecosysteem met onze ervaring in mensgerichte adoptie —
                    zodat AI bij uw mensen écht blijft plakken.
                </p>
</div>
<div class="intro-pillars">
<div class="intro-pillar">
<div class="ip-icon"><img src="../assets/icons/clock.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
<div>
<h4>Brede intro</h4>
<p>In korte tijd grote groep van gebruiker aan de slag.</p>
</div>
</div>
<div class="intro-pillar">
<div class="ip-icon"><img src="../assets/icons/shield.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
<div>
<h4>Een traject dat bij je past</h4>
<p>Verschillende opties die voor jouw organisatie op maat gemaakt worden, zodat jouw behoefte concreet wordt ingevuld.</p>
</div>
</div>
<div class="intro-pillar">
<div class="ip-icon"><img src="../assets/icons/team.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
<div>
<h4>Mensgericht ingericht</h4>
<p>Door gebruik te maken van jullie werkvoorbeelden, is de meerwaarde snel helder en blijft beter plakken.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- PRICING -->
<section id="pricing">
<div class="container">
<div class="pricing-header">
<span class="label">Drie proposities</span>
<h2 class="h2">Kies wat past bij uw <em>organisatiegrootte</em></h2>
<p class="body-text">
                Drie vaste pakketten — van een compact intranet voor een hecht team tot een volledig op maat
                gebouwd portaal voor grotere organisaties. Alle prijzen zijn exclusief BTW.
            </p>
</div>
<div class="pricing-grid">
<!-- BASIS -->
<div class="pcard">
<span class="p-tier">Basis</span>
<h3 class="p-name">Goed van start</h3>
<p class="p-target">Voor snelle start van nieuwe gebruikers</p>
<div class="p-price">
<span class="p-amount-prefix">Per trainingssessie</span>
<span class="p-amount">€ 1.000</span>
<div class="p-permw"> </div>
</div>
<ul class="p-features">
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Training van 2,5 uur</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Op locatie of remote</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>We gebruiken jullie voorbeelden</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>maximaal 12 medewerkers</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Gebruikers voeren direct oefeningen uit op hun eigen werkplek</li>
</ul>
<a class="btn btn-dark p-cta" href="../contact.php">Plan een afspraak →</a>
</div>
<!-- STANDAARD (FEATURED) -->
<div class="pcard featured">
<span class="badge-meest">Meest gekozen</span>
<span class="p-tier">Verdieping</span>
<h3 class="p-name">Copilot boost</h3>
<p class="p-target">Je wilt meer halen uit Copilot die je al gebruikt</p>
<div class="p-price">
<span class="p-amount-prefix">Per traject</span>
<span class="p-amount">€ 3.500</span>
<div class="p-permw"> </div>
</div>
<ul class="p-features">
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>6 sessies van 2 uur over 6 weken</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Op locatie</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>We gebruiken jullie voorbeelden</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>maximaal 12 medewerkers</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Diepgang op behoefte</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Gebruikers voeren direct oefeningen uit op hun eigen werkplek</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Door herhaald te doen blijft het plakken</li>
</ul>
<a class="btn btn-primary p-cta" href="../contact.php">Plan een afspraak →</a>
</div>
<!-- CUSTOM -->
<div class="pcard">
<span class="p-tier">Custom</span>
<h3 class="p-name">Copilot experience</h3>
<p class="p-target">Gedurende 3 maanden gaan we een werkproces verbeteren met Copilot</p>
<div class="p-price">
<span class="p-amount-prefix">Vanaf</span>
<span class="p-amount">€ 25.000</span>
<!--span class="p-amount-suffix">+ vanaf € 5.940 / jaar onderhoud</span -->
<!-- div class="p-permw">≈ € 4,71 per medewerker per maand</div -->
</div>
<ul class="p-features">
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Geen losse trainingen, maar leren in de praktijk van je eigen werkprocessen en documenten./li&gt;
                    <li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Op locatie en remote ondersteuning</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Eén werkproces werkend aangepast</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Kennis om zelfstandig een volgend proces aan te passen</li>
</li></ul>
<a class="btn btn-dark p-cta" href="copilot-ai-experience.php">Meer detail →</a>
</div>
</div>
</div>
</section>
<!-- FAQ -->
<section id="faq">
<div class="container">
<span class="label">Veelgestelde vragen</span>
<h2 class="h2">Wat u nog wil <em>weten</em></h2>
<div class="faq-grid">
<details class="faq">
<summary>Hebben we extra licenties nodig?</summary>
<p>Ja — De medewerkers die gebruik maken van de sessie halen meer uit de sessies als ze een Copilot licentie hebben. Op die manier kunnen ze ook direct gaan uitproberen</p>
</details>
<details class="faq">
<summary>Kunnen we later opschalen?</summary>
<p>Ja. Dit kan op verschillende manieren, met champions, key users en kennisportalen als voorbeelden.</p>
</details>
<details class="faq">
<summary>Leert Copilot van mijn vragen en gegevens?</summary>
<p>Microsoft geeft aan hun model niet te trainen met jouw data. Wel bouwt Microsoft een historie voor jouw persoonlijk op, zodat de antwoorden steeds beter zijn voor jou.</p>
</details>
</div>
</div>
</section>
<!-- CTA -->
<section id="cta-final">
<div class="container">
<h2>Klaar om je organisatie slimmer en efficienter te maken met AI?</h2>
<p>
            Plan een vrijblijvend kennismakingsgesprek van 30 minuten. Wij denken graag mee over welke
            propositie het beste past bij uw situatie — geheel zonder verplichtingen.
        </p>
<a class="btn btn-dark" href="../contact.php">
<img src="../assets/icons/calendar.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
            Plan een kennismaking →
        </a>
</div>
</section>
<!-- FOOTER (injected by assets/js/site.js) -->

<?php
require_once __DIR__ . '/../partials/footer.php';
?>
