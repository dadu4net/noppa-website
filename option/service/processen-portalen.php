<?php
$base_path        = '../';
$page_title       = 'Processen &amp; Portalen — Intranet op SharePoint | Noppa Solutions &amp; Consultants';
$page_description = 'Een modern intranet op SharePoint Online — drie heldere proposities (Basis, Standaard, Custom). Noppa Solutions &amp; Consultants levert van inventarisatie tot live én het onderhoud daarna.';
$page_keywords    = 'Microsoft 365, SharePoint, Teams, Copilot, adoptie, implementatie, consultancy, Berlicum, \'s-Hertogenbosch, productiviteit, digitale werkplek, Power Platform, governance';
$canonical_url    = 'https://www.noppa.nl/diensten/processen-portalen.html';
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
<symbol fill="none" id="plus" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M12 5v14M5 12h14"></path></symbol>
<symbol fill="none" id="house" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewbox="0 0 24 24"><path d="M3 9.5L12 4l9 5.5M5 10v9h14v-9M9 19v-5h6v5"></path></symbol>
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
<span style="color: var(--white);">Processen &amp; Portalen</span>
</div>
<div class="hero-eyebrow">
<img src="../assets/icons/dashboard.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
            Intranet op SharePoint Online
        </div>
<h1 class="hero-h1">Eén centrale plek voor uw <em>mensen, processen en kennis</em></h1>
<p class="hero-sub">
            Een modern intranet dat uw medewerkers écht gebruiken. Wij bouwen op SharePoint Online —
            met drie heldere proposities, vaste prijzen en een traject van inventarisatie tot live.
            Zonder verrassingen, mét borging.
        </p>
<div class="hero-btns">
<a class="btn btn-primary" href="#pricing">
<div class="c-icon c-donker"><svg aria-hidden="true" viewbox="0 0 24 24"><use href="../assets/icons.svg#plus"></use></svg></div>
                Bekijk onze proposities
            </a>
<a class="btn btn-outline" href="#proces">Onze aanpak →</a>
</div>
</div>
</section>
<!-- INTRO -->
<section class="intro">
<div class="container">
<div class="intro-grid">
<div>
<span class="label">Waarom een intranet</span>
<h2 class="h2">Van versnipperde info naar één <em>digitale werkplek</em></h2>
<p class="body-text">
                    Documenten in mailboxen, nieuws op de koffieautomaat, processen in iemands hoofd —
                    veel organisaties verliezen elke week tijd aan zoeken en dubbel werk. Een goed ingericht
                    intranet brengt nieuws, kennis, processen en mensen samen op één vertrouwde plek.
                </p>
<p class="body-text">
                    Wij bouwen op <strong>SharePoint Online</strong> — onderdeel van uw bestaande Microsoft 365 —
                    en stemmen de inrichting af op uw organisatiegrootte. Geen losstaand systeem, geen extra licenties:
                    een intranet dat naadloos integreert met Teams, Outlook en de rest van uw werkplek.
                </p>
</div>
<div class="intro-pillars">
<div class="intro-pillar">
<div class="c-icon c-cyan"><img alt="Snel live" class="noppa-icon" src="../assets/icons/clock.svg"/></div>
<div>
<h4>Snel live</h4>
<p>Een werkend intranet binnen 4–8 weken, afhankelijk van de gekozen propositie.</p>
</div>
</div>
<div class="intro-pillar">
<div class="c-icon c-cyan"><img alt="Vaste prijs" class="noppa-icon" src="../assets/icons/shield.svg"/></div>
<div>
<h4>Vaste prijs, geen verrassingen</h4>
<p>Heldere proposities met vooraf bepaalde scope, kosten en doorlooptijd.</p>
</div>
</div>
<div class="intro-pillar">
<div class="c-icon c-cyan"><img alt="Mensgericht" class="noppa-icon" src="../assets/icons/team.svg"/></div>
<div>
<h4>Mensgericht ingericht</h4>
<p>Workshop, instructie en adoptie — zodat uw medewerkers het intranet daadwerkelijk gebruiken.</p>
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
<p class="p-target">Voor teams en organisaties tot ± 15 medewerkers.</p>
<div class="p-price">
<span class="p-amount-prefix">Eenmalig</span>
<span class="p-amount">€ 4.410</span>
<span class="p-amount-suffix">excl. BTW · onderhoud optioneel</span>
<div class="p-permw">≈ € 0,72 per medewerker per maand</div>
</div>
<ul class="p-features">
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Inventarisatie &amp; ontwerpsessie</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Hoofdpagina met nieuws</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>2 huisstijlkleuren</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>2 afdelingspagina's</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Basis-rechtenstructuur</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Online naslagwerk voor beheerders</li>
</ul>
<a class="btn btn-dark p-cta" href="../contact.php">Vraag een offerte aan</a>
</div>
<!-- STANDAARD (FEATURED) -->
<div class="pcard featured">
<span class="badge-meest">Meest gekozen</span>
<span class="p-tier">Standaard</span>
<h3 class="p-name">Compleet voor mkb</h3>
<p class="p-target">Voor organisaties van 15 tot 35 medewerkers.</p>
<div class="p-price">
<span class="p-amount-prefix">Eenmalig vanaf</span>
<span class="p-amount">€ 6.890</span>
<span class="p-amount-suffix">+ € 3.630 / jaar onderhoud</span>
<div class="p-permw">≈ € 2,90 per medewerker per maand</div>
</div>
<ul class="p-features">
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Alles uit Basis</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>3 afdelingspagina's</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Merkencenter, sjablonen- &amp; mediabibliotheek</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Redactie-toegang voor afdelingsbeheerders</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Instructieworkshop voor uw redactieteam</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Viva Connections (intranet in Teams)</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Maandelijks onderhoud &amp; doorontwikkeling</li>
</ul>
<a class="btn btn-primary p-cta" href="../contact.php">Vraag een offerte aan</a>
</div>
<!-- CUSTOM -->
<div class="pcard">
<span class="p-tier">Custom</span>
<h3 class="p-name">Op maat</h3>
<p class="p-target">Voor organisaties vanaf 35 medewerkers en complexere wensen.</p>
<div class="p-price">
<span class="p-amount-prefix">Eenmalig vanaf</span>
<span class="p-amount">€ 11.025</span>
<span class="p-amount-suffix">+ vanaf € 5.940 / jaar onderhoud</span>
<div class="p-permw">≈ € 4,71 per medewerker per maand</div>
</div>
<ul class="p-features">
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Alles uit Standaard</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>5 of meer afdelingspagina's</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>3 huisstijlkleuren &amp; uitgebreide branding</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Geavanceerd zoeken &amp; projecthub</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Complexe rechtenstructuur</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Power Automate-integraties</li>
<li><span class="p-check"><span style="color:var(--cyan);font-weight:900;display:inline-block;margin-right:6px;">✓</span></span>Teams-app, Viva Learning &amp; Extranet</li>
</ul>
<a class="btn btn-dark p-cta" href="../contact.php">Plan een gesprek</a>
</div>
</div>
</div>
</section>
<!-- COMPARISON -->
<section id="compare">
<div class="container">
<span class="label">Vergelijken</span>
<h2 class="h2">Wat zit er in <em>welk pakket</em>?</h2>
<p class="body-text" style="max-width: 680px;">
            Een volledig overzicht van onze drie proposities — zodat u in één oogopslag ziet welk pakket
            past bij uw organisatie.
        </p>
<div class="compare-wrap table-responsive" style="overflow-x: auto;">
<table class="ctable">
<thead>
<tr>
<th class="col-feat">Onderdeel</th>
<th>Basis</th>
<th>Standaard</th>
<th>Custom</th>
</tr>
</thead>
<tbody>
<tr class="row-section"><td colspan="4">Inventarisatie &amp; Ontwerp</td></tr>
<tr>
<td class="feat">Inventarisatiesessie</td>
<td class="tier has"><span class="tick">✓</span> 1 sessie</td>
<td class="tier has"><span class="tick">✓</span> 1 sessie</td>
<td class="tier has"><span class="tick">✓</span> Meerdere sessies</td>
</tr>
<tr>
<td class="feat">Ontwerp &amp; wireframes</td>
<td class="tier has">Basis-template</td>
<td class="tier has">Aangepast ontwerp</td>
<td class="tier has">Volledig op maat</td>
</tr>
<tr class="row-section"><td colspan="4">Indeling</td></tr>
<tr>
<td class="feat">Hoofdpagina met nieuws</td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Afdelingspagina's</td>
<td class="tier has">2</td>
<td class="tier has">3</td>
<td class="tier has">5+</td>
</tr>
<tr>
<td class="feat">Projecthub</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr class="row-section"><td colspan="4">Inrichting</td></tr>
<tr>
<td class="feat">Huisstijlkleuren</td>
<td class="tier has">2</td>
<td class="tier has">2</td>
<td class="tier has">3</td>
</tr>
<tr>
<td class="feat">Merkencenter &amp; sjablonen</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Mediabibliotheek</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Geavanceerd zoeken</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr class="row-section"><td colspan="4">Rechten</td></tr>
<tr>
<td class="feat">Rechtenstructuur</td>
<td class="tier has">Basis</td>
<td class="tier has">Met redactie-toegang</td>
<td class="tier has">Complex / op maat</td>
</tr>
<tr class="row-section"><td colspan="4">Instructie &amp; Adoptie</td></tr>
<tr>
<td class="feat">Online naslagwerk</td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Workshop voor redacteuren</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span> Uitgebreid</td>
</tr>
<tr class="row-section"><td colspan="4">Automatisering &amp; Extra's</td></tr>
<tr>
<td class="feat">Power Automate-flows</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Viva Connections</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Viva Learning</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr>
<td class="feat">Teams-app &amp; Extranet</td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier"><span class="dash">—</span></td>
<td class="tier has"><span class="tick">✓</span></td>
</tr>
<tr class="row-section"><td colspan="4">Onderhoud &amp; Support</td></tr>
<tr>
<td class="feat">Doorlopend onderhoud</td>
<td class="tier has">Optioneel</td>
<td class="tier has">Maandelijks inbegrepen</td>
<td class="tier has">Maandelijks + uitbreidingen</td>
</tr>
<tr class="row-section"><td colspan="4">Investering</td></tr>
<tr>
<td class="feat">Eenmalig (excl. BTW)</td>
<td class="tier has"><strong>€ 4.410</strong></td>
<td class="tier has"><strong>vanaf € 6.890</strong></td>
<td class="tier has"><strong>vanaf € 11.025</strong></td>
</tr>
<tr>
<td class="feat">Jaarlijks onderhoud</td>
<td class="tier has">Optioneel</td>
<td class="tier has"><strong>€ 3.630</strong></td>
<td class="tier has"><strong>vanaf € 5.940</strong></td>
</tr>
</tbody>
</table>
</div>
</div>
</section>
<!-- PROCES -->
<section id="proces">
<div class="container">
<span class="label">Onze aanpak</span>
<h2 class="h2 light">In <em>5 stappen</em> naar een werkend intranet</h2>
<p class="body-text" style="max-width: 680px;">
            Een gestructureerd traject met heldere mijlpalen — van eerste sessie tot live én daarna.
        </p>
<div class="proces-grid">
<div class="pstep">
<span class="pstep-num">1</span>
<h4>Inventarisatie</h4>
<p>Workshop met stakeholders. Wensen, doelgroepen, processen en bestaande informatie in kaart.</p>
</div>
<div class="pstep">
<span class="pstep-num">2</span>
<h4>Ontwerp</h4>
<p>Sitemap, wireframes en huisstijlvertaling. U ziet hoe het intranet eruit gaat zien voordat we bouwen.</p>
</div>
<div class="pstep">
<span class="pstep-num">3</span>
<h4>Realisatie</h4>
<p>Inrichting in SharePoint Online, opzetten rechtenstructuur, content-template en eventuele integraties.</p>
</div>
<div class="pstep">
<span class="pstep-num">4</span>
<h4>Instructie</h4>
<p>Workshop voor uw redacteuren en beheerders, inclusief naslagwerk en best practices.</p>
</div>
<div class="pstep">
<span class="pstep-num">5</span>
<h4>Live &amp; nazorg</h4>
<p>Lancering met communicatieplan en — indien gekozen — doorlopend maandelijks onderhoud.</p>
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
<p>Nee — een intranet op SharePoint Online maakt onderdeel uit van uw bestaande Microsoft 365-licenties (Business of Enterprise). U betaalt geen losse licentiekosten voor het intranet zelf.</p>
</details>
<details class="faq">
<summary>Hoe lang duurt een traject gemiddeld?</summary>
<p>Een Basis-traject is doorgaans binnen 4 weken live, Standaard binnen 6–8 weken en Custom binnen 8–12 weken — afhankelijk van scope, betrokkenheid en beschikbaarheid van content.</p>
</details>
<details class="faq">
<summary>Kunnen we later opschalen?</summary>
<p>Ja. U kunt altijd doorgroeien van Basis naar Standaard of Custom. We verrekenen de eerder gemaakte kosten en breiden de scope uit zonder dat u opnieuw begint.</p>
</details>
<details class="faq">
<summary>Wat houdt het maandelijks onderhoud in?</summary>
<p>Functioneel beheer, kleine aanpassingen, bijwerken van componenten naar nieuwe SharePoint-mogelijkheden, ondersteuning van uw redactieteam en een vast aanspreekpunt voor vragen.</p>
</details>
<details class="faq">
<summary>Werkt het intranet ook in Teams?</summary>
<p>Ja. Vanaf de Standaard-propositie zetten we Viva Connections in, waardoor uw intranet rechtstreeks beschikbaar is binnen Microsoft Teams — handig voor medewerkers die voornamelijk in Teams werken.</p>
</details>
<details class="faq">
<summary>Kunnen we ons huidige intranet migreren?</summary>
<p>Zeker. Migratie van bestaande content (documenten, nieuwsberichten, pagina's) bespreken we tijdens de inventarisatie. Voor grote migraties stellen we een aparte offerte op.</p>
</details>
</div>
</div>
</section>
<!-- CTA -->
<section id="cta-final">
<div class="container">
<h2>Klaar voor één centrale plek voor uw organisatie?</h2>
<p>
            Plan een vrijblijvend kennismakingsgesprek van 30 minuten. Wij denken graag mee over welke
            propositie het beste past bij uw situatie — geheel zonder verplichtingen.
        </p>
<a class="btn btn-dark" href="../contact.php">
            Plan een kennismaking →
        </a>
</div>
</section>
<!-- FOOTER (injected by assets/js/site.js) -->

<?php
require_once __DIR__ . '/../partials/footer.php';
?>
