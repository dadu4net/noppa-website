<?php
$base_path = '../';
$page_title = 'Rik Dobbelsteen — Business &amp; Adoptie Consultant | Noppa Solutions &amp; Consultants';
$page_description = 'Rik Dobbelsteen, M365 Business-, Functioneel- en Adoptie Consultant bij Noppa Solutions &amp; Consultants. Microsoft 365-consultancy in \'s-Hertogenbosch.';
$page_keywords = 'Microsoft 365, SharePoint, Teams, Copilot, adoptie, implementatie, consultancy, Berlicum, \'s-Hertogenbosch, productiviteit, digitale werkplek, Power Platform, governance';
$canonical_url = 'https://www.noppa.nl/';
$og_image = 'https://www.noppa.nl/assets/images/DEF_Logo_Noppa.png';
$active_page = 'team';
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
        'N:Dobbelsteen;Rik;;;',
        'FN:Rik Dobbelsteen',
        'ORG:Noppa Solutions & Consultants',
        'TITLE:M365 Business-, Functioneel- en Adoptie Consultant',
        'EMAIL;TYPE=WORK:rik@noppa.nl',
        'TEL;TYPE=WORK,VOICE:+31 6 13 35 77 23',
        'URL:https://www.linkedin.com/in/rikdobbelsteen/',
        'ADR;TYPE=WORK:;;Pijlkruid 44;\'s-Hertogenbosch;;5258 BW;Nederland',
        'END:VCARD'
    ].join('\r\n');
    const blob = new Blob([vcard], { type: 'text/vcard;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'rik-dobbelsteen.vcf';
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
            <span>Rik Dobbelsteen</span>
        </div>
        <div class="profile-hero-grid">
            <div>
                <div class="profile-photo profile-photo-initial"
                    style="background: linear-gradient(135deg, var(--royal) 0%, var(--sky) 100%); color: var(--white);border-radius: 50%;">
                    <img src="../assets/images/Rik Dobbelsteen.jpg" alt="Rik Dobbelsteen">
                </div>
            </div>
            <div>
                <h1 class="profile-name">Rik Dobbelsteen</h1>
                <div class="profile-role">M365 Business-, Functioneel- en Adoptie Consultant</div>
                <div class="profile-meta-row">
                    <span>📍 's-Hertogenbosch</span>
                    <a href="https://www.linkedin.com/in/rikdobbelsteen/" rel="noopener"
                        target="_blank">LinkedIn-profiel</a>
                    <a href="mailto:rik@noppa.nl">rik@noppa.nl</a>
                </div>
                <div class="profile-actions">
                    <button class="btn btn-primary" onclick="downloadVCard()">⬇ vCard downloaden</button>
                    <a class="btn btn-outline" href="../index.php#contact">Plan een gesprek</a>
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
                <span class="label">Over Rik</span>
                <h2 class="h2">De professional achter de naam</h2>
                <p class="body-text">Rik werkt op het snijvlak van business, functioneel ontwerp en adoptie. Hij houdt
                    zich bezig met de vraag: hoe maken we Microsoft 365 niet alleen technisch, maar ook menselijk
                    werkbaar?</p>
                <p class="body-text">Als consultant en mede-oprichter van Noppa Solutions &amp; Consultants begeleidt
                    hij teams van eerste analyse tot opgeleide eindgebruiker. Pragmatisch, met oog voor wat er ná de
                    implementatie nodig is.</p>
            </div>
            <aside class="expertise-card">
                <h3>Expertisegebieden</h3>
                <ul>
                    <li>Adoptie- en trainingstrajecten</li>
                    <li>Functioneel ontwerp &amp; requirements</li>
                    <li>Microsoft 365 / Copilot consulting</li>
                    <li>Workshops en leertrajecten</li>
                    <li>Business analyse</li>
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
        <p class="body-text" style="max-width:680px;">Een chronologisch overzicht van eerdere functies en
            verantwoordelijkheden.</p>
        <div class="exp-list">
            <article class="exp-item">
                <div class="exp-period">2022 — heden</div>
                <div class="exp-body">
                    <h3 class="exp-role">Co-founder &amp; Consultant</h3>
                    <div class="exp-company">Noppa Solutions &amp; Consultants</div>
                    <p class="exp-desc">Medeoprichter en dé verbinder van Noppa Solutions &amp; Consultants.
                        Verantwoordelijk voor adoptie-, business-, analyse- en functionele trajecten bij klanten.</p>
                </div>
            </article>
            <article class="exp-item">
                <div class="exp-period">2014 - 2022</div>
                <div class="exp-body">
                    <h3 class="exp-role">Microsoft 365 specialist - adoptie-, business- &amp; functioneel consultant
                    </h3>
                    <div class="exp-company">Noppa Soluntions &amp; Consultants</div>
                    <p class="exp-desc">Productiviteit begint bij mensen. Door mee te kijken in de dagelijkse praktijk
                        en in gesprek te gaan met medewerkers, bieden wij gericht advies en implementatie van Microsoft
                        365-oplossingen. Zo ontzorgen we de organisatie en halen we samen het beste uit de cloud.</p>
                </div>
            </article>
            <article class="exp-item">
                <div class="exp-period">2012 - 2014</div>
                <div class="exp-body">
                    <h3 class="exp-role">SharePoint Consultant</h3>
                    <div class="exp-company">GAC Business Solutions (Bravx)</div>
                    <p class="exp-desc">Het adviseren, ondersteunen, implementeren en beheren van SharePoint (2010, 2013
                        en Online) oplossingen. Pre-sales ter ondersteuning van sales in gesprekken met klanten.</p>
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
<section class="experience-section"> <!--class="quotes-section"-->
    <div class="container">
        <span class="label">Wat anderen zeggen</span>
        <h2 class="h2">Wat anderen zeggen over <em>Rik</em></h2>
        <p class="body-text" style="max-width:680px;">Reacties van klanten en collega's over de samenwerking.</p>
        <div class="quotes-grid">
            <figure class="quote-card">
                <div class="quote-mark">“</div>
                <blockquote class="quote-text">Rik krijgt zelfs de meest sceptische gebruikers mee. Zijn workshops zijn
                    praktisch en altijd toegespitst op wat ons team daadwerkelijk doet.</blockquote>
                <figcaption class="quote-author">
                    <strong>Rick Wijgergangs, CTO</strong>
                    <span>Faber Group</span>
                </figcaption>
            </figure>
            <figure class="quote-card">
                <div class="quote-mark">“</div>
                <blockquote class="quote-text">Veelzijdig, betrokken, kundig, gedreven en zeer sociaal, dat is Rik! Ik
                    kijk terug op een dijk van een periode waarin ik Rik heb zien groeien en excelleren. Altijd op zoek
                    naar een manier om als professional te groeien en zijn klant maximaal van dienst te kunnen en zelfs
                    positief te kunnen verrassen.</blockquote>
                <figcaption class="quote-author">
                    <strong>Emile Stam, CEO</strong>
                    <span>CEO Open Line</span>
                </figcaption>
            </figure>
            <figure class="quote-card">
                <div class="quote-mark">“</div>
                <blockquote class="quote-text">Binnen goede teams is altijd een gangmaker en katalysator aanwezig, Rik
                    is bij uitstek z’n persoon. Rik is enthousiast, open, creatief en vooral ook resultaat gericht. Hij
                    heeft een unieke combinatie van kennis en vaardigheden. Zijn bedrijfskundige achtergrond
                    gecombineerd met veel functionele en technische kennis van het Microsoft Office 365 platform maken
                    hem een zeer waardevolle consultant. Rik is tevens erg goed om organisaties te coachen naar meer en
                    betere productiviteit.</blockquote>
                <figcaption class="quote-author">
                    <strong>Michiel C.W. Willemse, Directeur</strong>
                    <span> Adoptify</span>
                </figcaption>
            </figure>
            <figure class="quote-card" style="display: none;">
                <div class="quote-mark">“</div>
                <blockquote class="quote-text">Hij is een verbinder. Tussen IT en business, tussen ambitie en realiteit
                    — daar wordt onze adoptie meetbaar beter van.</blockquote>
                <figcaption class="quote-author">
                    <strong>[Naam], [Functie]</strong>
                    <span>[Organisatie]</span>
                </figcaption>
            </figure>
            <figure class="quote-card" style="display: none;">
                <div class="quote-mark">“</div>
                <blockquote class="quote-text">[Placeholder] Wat ik waardeer is dat Rik niet stopt na het 'go-live'
                    moment. Hij blijft denken in gebruikersgedrag, niet in opgeleverde features.</blockquote>
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
        <h2 class="h2 light">Direct in contact met <em>Rik</em></h2>
        <div class="contact-card">
            <h3>Contactgegevens</h3>
            <div class="contact-rows">
                <div class="contact-row">
                    <span class="label">Naam</span>
                    <span class="value">Rik Dobbelsteen</span>
                </div>
                <div class="contact-row">
                    <span class="label">Functie</span>
                    <span class="value">Business &amp; Adoptie Consultant</span>
                </div>
                <div class="contact-row">
                    <span class="label">E-mail</span>
                    <span class="value"><a href="mailto:rik@noppa.nl">rik@noppa.nl</a></span>
                </div>
                <div class="contact-row">
                    <span class="label">Telefoon</span>
                    <span class="value"><a href="tel:+31613357723">+31 6 13 35 77 23</a></span>
                </div>
                <div class="contact-row">
                    <span class="label">LinkedIn</span>
                    <span class="value"><a href="https://www.linkedin.com/in/rikdobbelsteen/" rel="noopener"
                            target="_blank">Bekijk profiel</a></span>
                </div>
                <div class="contact-row">
                    <span class="label">Bedrijf</span>
                    <span class="value">Noppa Solutions &amp; Consultants</span>
                </div>
            </div>
            <button class="btn btn-primary" onclick="downloadVCard()">⬇ Contactgegevens downloaden (vCard)</button>
            <p class="vcf-note">De vCard (.vcf) opent automatisch in je contactenapp en wordt toegevoegd aan je telefoon
                of mailclient.</p>
        </div>
    </div>
</section>
<!-- CTA -->
<section id="cta-final">
    <div class="container">
        <h2>Liever direct sparren?</h2>
        <p>Plan een vrijblijvend kennismakingsgesprek met Rik of het team van Noppa Solutions &amp; Consultants.</p>
        <a class="btn btn-dark" href="../contact.php">Plan een gesprek</a>
    </div>
</section>
<!-- FOOTER (injected by assets/js/site.js) -->

<?php
require_once __DIR__ . '/../partials/footer.php';
?>