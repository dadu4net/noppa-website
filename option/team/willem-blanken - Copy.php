<?php
$base_path        = '../';
$page_title       = 'Willem Blanken — Projectleider &amp; Strategie Consultant | Noppa Solutions &amp; Consultants';
$page_description = 'Willem Blanken, M365 Projectleider, Strategie en Adoptie Consultant bij Noppa Solutions &amp; Consultants. Microsoft 365-consultancy in \'s-Hertogenbosch.';
$page_keywords    = 'Microsoft 365, SharePoint, Teams, Copilot, adoptie, implementatie, consultancy, Berlicum, \'s-Hertogenbosch, productiviteit, digitale werkplek, Power Platform, governance';
$canonical_url    = 'https://www.noppa.nl/';
$og_image         = 'https://www.noppa.nl/assets/images/DEF_Logo_Noppa.png';
$active_page      = 'team';
$extra_head = <<<'HTML'
<style>
        /* Profielspecifiek */
        .profile-hero {
            position: relative;
            overflow: hidden;
            padding: 150px 0 70px;
            color: var(--white);
            background:
                linear-gradient(120deg, rgba(24, 34, 43, 0.95) 0%, rgba(24, 34, 43, 0.82) 100%),
                radial-gradient(circle at 80% 30%, rgba(242, 184, 44, 0.18) 0%, transparent 60%),
                var(--navy);
        }
        .profile-hero-grid {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 38px;
            align-items: center;
        }
        .profile-photo {
            width: 220px;
            height: 220px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--cyan);
            box-shadow: 0 18px 48px rgba(0, 0, 0, 0.4);
        }
        .profile-photo-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--cyan) 0%, var(--royal) 100%);
            color: var(--text-main);
            font-size: 5rem;
            font-weight: 900;
        }
        .profile-name {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            line-height: 1.08;
            margin-bottom: 10px;
        }
        .profile-role {
            font-size: 1.05rem;
            color: var(--cyan);
            font-weight: 600;
            margin-bottom: 22px;
        }
        .profile-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            margin-bottom: 26px;
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.66);
        }
        .profile-meta-row a { color: var(--cyan); font-weight: 600; }
        .profile-meta-row a:hover { color: var(--cyan); }
        .profile-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Bio */
        .bio-section {
            padding: 84px 0 60px;
            background: var(--bg-card);
        }
        .bio-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 60px;
            align-items: start;
        }
        .bio-text p {
            font-size: 1.02rem;
            color: var(--text-main);
            line-height: 1.85;
            margin-bottom: 18px;
        }
        .expertise-card {
            background: var(--bg-alt);
            border-left: 3px solid var(--cyan);
            border-radius: var(--radius);
            padding: 28px 26px;
        }
        .expertise-card h3 {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: var(--royal);
            font-weight: 700;
            margin-bottom: 16px;
        }
        .expertise-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .expertise-card li {
            position: relative;
            padding: 7px 0 7px 22px;
            font-size: 0.93rem;
            color: var(--text-main);
            line-height: 1.5;
        }
        .expertise-card li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 14px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--cyan);
        }

        /* Experience */
        .experience-section {
            padding: 70px 0;
            background: var(--bg-alt);
        }
        .experience-section + .experience-section { background: var(--bg-card); }
        .exp-list {
            margin-top: 36px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .exp-item {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 28px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 22px 26px;
            transition: var(--trans);
        }
        .experience-section:nth-of-type(odd) .exp-item { background: var(--bg-card); }
        .experience-section:nth-of-type(even) .exp-item { background: var(--bg-alt); border-color: transparent; }
        .exp-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        .exp-period {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--royal);
            letter-spacing: 0.04em;
        }
        .exp-role {
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 4px;
        }
        .exp-company {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .exp-desc {
            font-size: 0.94rem;
            color: var(--text-main);
            line-height: 1.7;
        }

        /* Quotes */
        .quotes-section {
            padding: 84px 0;
            background: var(--bg-alt);
        }
        .quotes-grid {
            margin-top: 38px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }
        .quote-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            padding: 30px 26px 24px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .quote-mark {
            font-family: Georgia, serif;
            font-size: 3.6rem;
            line-height: 0.6;
            color: var(--cyan);
            font-weight: 900;
        }
        .quote-text {
            font-size: 0.96rem;
            color: var(--text-main);
            line-height: 1.7;
            font-style: italic;
        }
        .quote-author {
            margin-top: auto;
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.4;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .quote-author strong {
            color: var(--text-main);
            font-weight: 700;
            font-style: normal;
        }

        /* Contact card */
        .contact-section {
            padding: 84px 0;
            background: var(--navy);
            color: var(--white);
        }
        .contact-card {
            max-width: 760px;
            margin: 38px auto 0;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 36px;
        }
        .contact-card h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 22px;
        }
        .contact-rows {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 28px;
            margin-bottom: 26px;
        }
        .contact-row {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .contact-row .label {
            color: var(--cyan);
            margin-bottom: 0;
        }
        .contact-row .value {
            font-size: 0.96rem;
            color: rgba(255, 255, 255, 0.86);
            font-weight: 500;
            word-break: break-word;
        }
        .contact-row a { color: var(--cyan); }
        .contact-row a:hover { color: var(--cyan); }
        .vcf-note {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.45);
            margin-top: 14px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .profile-hero-grid { grid-template-columns: 1fr; text-align: center; gap: 24px; }
            .profile-photo { margin: 0 auto; width: 180px; height: 180px; }
            .profile-meta-row { justify-content: center; }
            .profile-actions { justify-content: center; }
            .bio-grid { grid-template-columns: 1fr; gap: 32px; }
            .quotes-grid { grid-template-columns: 1fr; }
            .exp-item { grid-template-columns: 1fr; gap: 8px; }
            .contact-rows { grid-template-columns: 1fr; }
        }
    </style>
HTML;
$extra_scripts = <<<'HTML'
<script>
function downloadVCard() {
    const vcard = [
        'BEGIN:VCARD',
        'VERSION:3.0',
        'N:Blanken;Willem;;;',
        'FN:Willem Blanken',
        'ORG:Noppa Solutions & Consultants',
        'TITLE:M365 Projectleider, Strategie en Adoptie Consultant',
        'EMAIL;TYPE=WORK:willem@noppa.nl',
        'TEL;TYPE=WORK,VOICE:+31 6 53 85 78 96',
        'URL:#',
        'ADR;TYPE=WORK:;;Pijlkruid 44;\'s-Hertogenbosch;;5258 BW;Nederland',
        'END:VCARD'
    ].join('\r\n');
    const blob = new Blob([vcard], { type: 'text/vcard;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'willem-blanken.vcf';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
</script>
HTML;

require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/nav.php';
?>

<!-- HERO -->
<header class="profile-hero">
<div class="container">
<div class="breadcrumb">
<a href="../index.php">Home</a>
<span>/</span>
<a href="../index.php#team">Team</a>
<span>/</span>
<span>Willem Blanken</span>
</div>
<div class="profile-hero-grid">
<div><div class="profile-photo profile-photo-initial" style="background: linear-gradient(135deg, var(--royal) 0%, var(--sky) 100%); color: var(--white);">WB</div></div>
<div>
<h1 class="profile-name">Willem Blanken</h1>
<div class="profile-role">M365 Projectleider, Strategie en Adoptie Consultant</div>
<div class="profile-meta-row">
<span>📍 's-Hertogenbosch</span>
<a href="#" rel="noopener" target="_blank">LinkedIn-profiel</a>
<a href="mailto:willem@noppa.nl">willem@noppa.nl</a>
</div>
<div class="profile-actions">
<button class="btn btn-primary" onclick="downloadVCard()">⬇ vCard downloaden</button>
<a class="btn btn-outline" href="../contact.php">Plan een gesprek</a>
</div>
</div>
</div>
</div>
</header>
<!-- BIO -->
<section class="bio-section">
<div class="container">
<div class="bio-grid">
<div class="bio-text">
<span class="label">Over Willem</span>
<h2 class="h2">De professional achter de naam</h2>
<p class="body-text">Willem is de strateeg in het team. Hij vertaalt organisatiedoelen naar concrete M365-roadmaps en zorgt dat de uitvoering aansluit bij wat mensen écht nodig hebben. Zijn kracht: complexe verandertrajecten behapbaar maken.</p>
<p class="body-text">Met jarenlange ervaring in adoptie en verandermanagement begrijpt hij dat technologie pas waarde levert als gebruikers ermee aan de slag gaan. Hij combineert die overtuiging met sterke projectvaardigheden.</p>
</div>
<aside class="expertise-card">
<h3>Expertisegebieden</h3>
<ul>
<li>Strategische M365-roadmaps</li>
<li>Adoptie &amp; verandermanagement</li>
<li>Projectleiding en programmamanagement</li>
<li>Stakeholderalignering op directieniveau</li>
<li>Microsoft 365 governance</li>
</ul>
</aside>
</div>
</div>
</section>
<!-- EXPERIENCE -->
<section class="experience-section">
<div class="container">
<span class="label">Werkervaring</span>
<h2 class="h2">Voorgaande <em>rollen</em> en functies</h2>
<p class="body-text" style="max-width:680px;">Een chronologisch overzicht van eerdere functies en verantwoordelijkheden.</p>
<div class="exp-list">
<article class="exp-item">
<div class="exp-period">2022 — heden</div>
<div class="exp-body">
<h3 class="exp-role">Co-founder &amp; Projectleider Strategie</h3>
<div class="exp-company">Noppa Solutions &amp; Consultants</div>
<p class="exp-desc">Medeoprichter. Leidt strategische M365- en adoptietrajecten en coacht klanten in de governance van hun digitale werkplek.</p>
</div>
</article>
<article class="exp-item">
<div class="exp-period">2018 — 2022</div>
<div class="exp-body">
<h3 class="exp-role">Digital Workplace  Consultant - Adoptie/Change consultant - Informatiemanager</h3>
<div class="exp-company">Maxos</div>
<p class="exp-desc"></p>
</div>
</article>
<article class="exp-item">
<div class="exp-period">2016 — 2018</div>
<div class="exp-body">
<h3 class="exp-role">Senior Workplace Consultant - Programmanager - Informationmanager</h3>
<div class="exp-company">KPN Consulting</div>
<p class="exp-desc">Organisaties adviseren over de digitalisering van de werkplek en digitale transformatie.  </p>
</div>
</article>
<article class="exp-item">
<div class="exp-period">1997 — 2007</div>
<div class="exp-body">
<h3 class="exp-role">EMEA Information Worker Director Enterprise</h3>
<div class="exp-company">Microsoft</div>
<p class="exp-desc">Verantwoordelijk voor de Microsoft-technologie voor kenniswerkers in de zakelijke markt en het partnerkanaal binnen de EMEA-regio. Aansturen van lokale communities van informatie-/kenniswerkers en strategische partners. Vertalen van corporate programma’s naar lokale implementaties.</p>
</div>
</article>
</div>
</div>
</section>
<!-- EDUCATION -->
<section class="experience-section" style="display: none;">
<div class="container">
<span class="label">Opleiding</span>
<h2 class="h2">Opleidingsachtergrond</h2>
<div class="exp-list">
<article class="exp-item">
<div class="exp-period">[Periode]</div>
<div class="exp-body">
<h3 class="exp-role">[Opleiding]</h3>
<div class="exp-company">[Onderwijsinstelling]</div>
</div>
</article>
</div>
</div>
</section>
<!-- TESTIMONIALS -->
<section class="quotes-section" style="display: none;">
<div class="container">
<span class="label">Wat anderen zeggen</span>
<h2 class="h2">Wat anderen zeggen over <em>Willem</em></h2>
<p class="body-text" style="max-width:680px;">Reacties van klanten en collega's over de samenwerking. <em>De getoonde quotes zijn placeholders.</em></p>
<div class="quotes-grid">
<figure class="quote-card">
<div class="quote-mark">“</div>
<blockquote class="quote-text">[Placeholder] Willem ziet door de waan van de dag heen waar het écht om draait. Onze digitale strategie is door zijn inbreng substantieel scherper geworden.</blockquote>
<figcaption class="quote-author">
<strong>[Naam], [Functie]</strong>
<span>[Organisatie]</span>
</figcaption>
</figure>
<figure class="quote-card">
<div class="quote-mark">“</div>
<blockquote class="quote-text">[Placeholder] Hij weet directie en uitvoering met elkaar te verbinden — geen kleine prestatie in een organisatie van onze omvang.</blockquote>
<figcaption class="quote-author">
<strong>[Naam], [Functie]</strong>
<span>[Organisatie]</span>
</figcaption>
</figure>
<figure class="quote-card">
<div class="quote-mark">“</div>
<blockquote class="quote-text">[Placeholder] Willem is een projectleider die luistert. Dat klinkt vanzelfsprekend, maar dat is het zelden.</blockquote>
<figcaption class="quote-author">
<strong>[Naam], [Functie]</strong>
<span>[Organisatie]</span>
</figcaption>
</figure>
</div>
</div>
</section>
<!-- CONTACT -->
<section class="contact-section">
<div class="container">
<span class="label" style="color: var(--cyan);">Contact</span>
<h2 class="h2 light">Direct in contact met <em>Willem</em></h2>
<div class="contact-card">
<h3>Contactgegevens</h3>
<div class="contact-rows">
<div class="contact-row">
<span class="label">Naam</span>
<span class="value">Willem Blanken</span>
</div>
<div class="contact-row">
<span class="label">Functie</span>
<span class="value">Projectleider &amp; Strategie Consultant</span>
</div>
<div class="contact-row">
<span class="label">E-mail</span>
<span class="value"><a href="mailto:willem@noppa.nl">willem@noppa.nl</a></span>
</div>
<div class="contact-row">
<span class="label">Telefoon</span>
<span class="value"><a href="tel:+31653857896">+31 6 53 85 78 96</a></span>
</div>
<div class="contact-row">
<span class="label">LinkedIn</span>
<span class="value"><a href="https://www.linkedin.com/in/willemblanken" rel="noopener" target="_blank">Bekijk profiel</a></span>
</div>
<div class="contact-row">
<span class="label">Bedrijf</span>
<span class="value">Noppa Solutions &amp; Consultants</span>
</div>
</div>
<button class="btn btn-primary" onclick="downloadVCard()">⬇ Contactgegevens downloaden (vCard)</button>
<p class="vcf-note">De vCard (.vcf) opent automatisch in je contactenapp en wordt toegevoegd aan je telefoon of mailclient.</p>
</div>
</div>
</section>
<!-- CTA -->
<section id="cta-final">
<div class="container">
<h2>Liever direct sparren?</h2>
<p>Plan een vrijblijvend kennismakingsgesprek met Willem of het team van Noppa Solutions &amp; Consultants.</p>
<a class="btn btn-dark" href="../contact.php">Plan een gesprek</a>
</div>
</section>
<!-- FOOTER (injected by assets/js/site.js) -->

<?php
require_once __DIR__ . '/../partials/footer.php';
?>
