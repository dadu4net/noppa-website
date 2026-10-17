<?php
$base_path        = '../';
$page_title       = 'Copilot AI Experience | Noppa Solutions &amp; Consultants';
$page_description = 'Ontdek de kracht van AI in jouw organisatie. In de Copilot AI Experience van Noppa Solutions &amp; Consultants verken je in 3 maanden samen met collega\'s hoe Microsoft Copilot je werk versterkt, versnelt en verbetert.';
$page_keywords    = 'Microsoft 365, SharePoint, Teams, Copilot, adoptie, implementatie, consultancy, Berlicum, \'s-Hertogenbosch, productiviteit, digitale werkplek, Power Platform, governance';
$canonical_url    = 'https://www.noppa.nl/copilot-ai-experience.html';
$og_image         = 'https://www.noppa.nl/assets/images/DEF_Logo_Noppa.png';
$active_page      = 'diensten';
$extra_head = <<<'HTML'
<style>
        /* CONTENT */
        .content { padding: 80px 0 40px; }
        .content h2 {
            font-size: 1.7rem; font-weight: 800; color: var(--text-heading);
            margin: 56px 0 16px; line-height: 1.3; position: relative;
        }
        .content h2:first-of-type { margin-top: 0; }
        .content h2::before {
            content: ''; display: block; width: 36px; height: 3px;
            background: var(--cyan); margin-bottom: 16px; border-radius: 2px;
        }
        .content p {
            font-size: 1rem; color: var(--text-main);
            line-height: 1.85; margin-bottom: 18px;
        }
        .content p.lead {
            font-size: 1.12rem; font-weight: 600; color: var(--text-main);
            line-height: 1.7;
        }
        .content ul.benefits {
            list-style: none; margin: 8px 0 30px; padding: 0;
            display: grid; gap: 14px;
        }
        .content ul.benefits li {
            position: relative; padding: 14px 18px 14px 56px;
            font-size: 1rem; color: var(--text-main); line-height: 1.55;
            background: var(--bg-alt); border-radius: var(--radius);
            border-left: 3px solid var(--cyan);
        }
        .content ul.benefits li::before {
            content: '✓'; position: absolute; left: 18px; top: 50%;
            transform: translateY(-50%);
            width: 26px; height: 26px; border-radius: 50%;
            background: var(--cyan); color: var(--text-main);
            font-weight: 900; font-size: 0.9rem;
            display: flex; align-items: center; justify-content: center;
        }

        /* HOW-IT-WORKS CARDS */
        .how-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 18px; margin: 8px 0 32px;
        }
        .how-card {
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: var(--radius); padding: 24px 22px;
            transition: var(--trans);
        }
        .how-card:hover { border-color: var(--cyan); transform: translateY(-2px); box-shadow: var(--shadow); }
        .how-card-eyebrow {
            font-size: 0.72rem; font-weight: 800; color: var(--royal);
            letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 10px;
        }
        .how-card-title {
            font-size: 1.1rem; font-weight: 800; color: var(--text-main);
            margin-bottom: 6px; line-height: 1.35;
        }
        .how-card-text {
            font-size: 0.92rem; color: var(--text-muted); line-height: 1.6;
        }
        @media (max-width: 760px) {
            .how-grid { grid-template-columns: 1fr; }
        }

        /* AUDIENCE CARD */
        .audience-card {
            background: linear-gradient(135deg, var(--light) 0%, #ECE9DC 100%);
            border-radius: var(--radius); padding: 28px 30px;
            display: flex; align-items: center; gap: 22px;
            border-left: 4px solid var(--cyan);
            margin: 8px 0 30px;
        }
        .audience-card .ico {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--cyan); color: var(--text-main);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .audience-card p {
            margin: 0; font-size: 1rem; color: var(--text-main);
            line-height: 1.6; font-weight: 600;
        }
        @media (max-width: 560px) {
            .audience-card { flex-direction: column; text-align: center; }
        }

        /* COUNTER STRIP (IP-restricted, hidden by default) */
        .counter-strip {
            display: none;
            background: var(--navy); color: var(--white);
            border-top: 3px solid var(--cyan);
            padding: 26px 0;
        }
        .counter-strip.visible { display: block; }
        .counter-card {
            display: flex; align-items: center; justify-content: center;
            gap: 28px; flex-wrap: wrap; text-align: center;
        }
        .counter-block {
            display: flex; flex-direction: column; align-items: center; gap: 4px;
            min-width: 110px;
        }
        .counter-num {
            font-size: 2.4rem; font-weight: 900; color: var(--cyan);
            line-height: 1; font-variant-numeric: tabular-nums;
        }
        .counter-lbl {
            font-size: 0.74rem; font-weight: 700;
            letter-spacing: 0.14em; text-transform: uppercase;
            color: rgba(255,255,255,0.5);
        }
        .counter-sep {
            width: 1px; height: 44px; background: rgba(255,255,255,0.12);
        }
        .counter-text {
            font-size: 0.85rem; color: rgba(255,255,255,0.65);
            max-width: 320px; line-height: 1.5; text-align: left;
        }
        .counter-text span { color: var(--cyan); font-weight: 700; }
        .counter-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.66rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--cyan);
            background: rgba(0,208,240,0.15); border: 1px solid rgba(242,184,44,0.3);
            padding: 4px 9px; border-radius: 100px; margin-bottom: 8px;
        }
        @media (max-width: 600px) {
            .counter-sep { display: none; }
            .counter-text { text-align: center; }
            .counter-num { font-size: 2rem; }
        }

        /* CTA */
        #cta-final {
            background: linear-gradient(135deg, var(--cyan) 0%, var(--royal) 100%);
            text-align: center; padding: 82px 0;
        }
        #cta-final h2 {
            font-size: clamp(1.7rem, 2.8vw, 2.2rem); font-weight: 900;
            color: var(--text-main); margin-bottom: 14px;
        }
        #cta-final p {
            font-size: 1.05rem; color: rgba(24,34,43,0.8);
            max-width: 580px; margin: 0 auto 28px; line-height: 1.7;
        }
    </style>
HTML;

require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/nav.php';
?>

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
<span style="color: var(--white);">Copilot AI Experience</span>
</div>
<div class="hero-eyebrow">
<img src="../assets/icons/sparkles.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
            Copilot Experience
        </div>
<h1 class="hero-h1">Ontdek de kracht van AI in <em>jouw organisatie</em></h1>
<p class="hero-sub">
            Start vandaag met <strong>dé Copilot Experience</strong>. In een kort en krachtig
            traject verken jij samen met collega's hoe Microsoft Copilot je werk versterkt,
            versnelt en verbetert.
        </p>
<div class="hero-btns">
<a class="btn btn-primary" href="../contact.php">
<img src="../assets/icons/calendar.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;">
                Plan een afspraak →
            </a>
</div>
</div>
</section>
<!-- CONTENT -->
<section class="content">
<div class="container-narrow">
<h2>Waarom een Copilot Experience?</h2>
<p class="lead">
            Werk je veel met informatie — documenten, bestanden, generieke applicaties of
            ongestructureerde data? Dan zijn onze <strong>Copilot LABS</strong> het ideale startpunt.
        </p>
<p>
            In dit uitgebreide traject verken jij samen met collega's hoe Microsoft Copilot (AI)
            jullie gaat <strong>versterken, versnellen en verbeteren</strong>. Geen abstracte theorie,
            maar concrete experimenten in jullie eigen werkomgeving — met écht resultaat aan het
            eind van de rit.
        </p>
<h2>Wat levert het op?</h2>
<ul class="benefits">
<li><strong>Inzicht in AI-mogelijkheden</strong> vanuit jouw specifieke context.</li>
<li><strong>Hands-on ervaring</strong> met Copilot in de praktijk.</li>
<li><strong>Snel draagvlak en enthousiasme</strong> binnen jouw team en organisatie.</li>
<li><strong>Een concrete eerste stap</strong> met tastbare resultaten.</li>
<li><strong>Een nieuwe manier van werken</strong> die blijft hangen.</li>
</ul>
<h2>Voor wie?</h2>
<div class="audience-card">
<div class="ico">
<svg fill="none" height="26" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" viewbox="0 0 24 24" width="26"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><path d="M20 8v6M23 11h-6"></path></svg>
</div>
<p>
                Iedereen binnen de organisatie die toegang heeft tot een digitale werkplek —
                van management tot uitvoering, van ervaren professional tot digi-starter.
            </p>
</div>
<h2>Hoe werkt het?</h2>
<div class="how-grid">
<div class="how-card">
<div class="how-card-eyebrow">Duur</div>
<div class="how-card-title">3 maanden</div>
<div class="how-card-text">Een afgebakend traject dat lang genoeg is om écht te leren, kort genoeg om de vaart erin te houden.</div>
</div>
<div class="how-card">
<div class="how-card-eyebrow">Deelname</div>
<div class="how-card-title">Representatieve groep</div>
<div class="how-card-text">Een doorsnede van je organisatie — verschillende rollen, verschillende digitale comfortzones.</div>
</div>
<div class="how-card">
<div class="how-card-eyebrow">Integratie</div>
<div class="how-card-title">In je dagelijkse werk</div>
<div class="how-card-text">Geen losse trainingen, maar leren in de praktijk van je eigen werkprocessen en documenten.</div>
</div>
</div>
</div>
</section>
<!-- COUNTER STRIP (IP-restricted — alleen zichtbaar voor toegestane IP's) -->
<section aria-hidden="true" class="counter-strip" id="copilotCounter">
<div class="container">
<div class="counter-card">
<div class="counter-block">
<div class="counter-badge">Admin</div>
<div class="counter-num" id="copilotCount">—</div>
<div class="counter-lbl">Paginabezoeken</div>
</div>
<div aria-hidden="true" class="counter-sep"></div>
<div class="counter-block">
<div class="counter-num" id="copilotToday" style="font-size: 1.4rem;">—</div>
<div class="counter-lbl">Vandaag</div>
</div>
<div aria-hidden="true" class="counter-sep"></div>
<div class="counter-text">
                Bezoekersteller voor <span>copilot-ai-experience</span>.
                Alleen zichtbaar vanaf vooraf goedgekeurde IP-adressen.
            </div>
</div>
</div>
</section>
<!-- CTA -->
<section id="cta-final">
<div class="container">
<h2>Klaar om de eerste stap te zetten?</h2>
<p>
            Boek een intake en ontdek wat Copilot AI voor jou gaat betekenen.
            We denken graag met je mee — vrijblijvend en in mensentaal.
        </p>
<a class="btn btn-dark" href="../contact.php">
<div class="c-icon c-cyan"><img src="../assets/icons/calendar.svg" class="noppa-icon" alt="" style="width:20px;height:20px;display:inline-block;vertical-align:middle;"></div>
            Plan een afspraak →
        </a>
</div>
</section>
<!-- FOOTER (injected by assets/js/site.js) -->

<?php
require_once __DIR__ . '/../partials/footer.php';
?>
