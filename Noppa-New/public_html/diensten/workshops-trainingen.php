<?php
$pageTitle = "Workshops & Trainingen — Microsoft 365 | Noppa";
$pageDesc = "Praktische workshops en trainingen Microsoft 365 — van inspiratiesessies en Copilot-workshops tot Teams-trainingen, SharePoint beheer en Purview round tables. Leren door te doen, in uw eigen werkomgeving.";
$base = "../";
include $base . "partials/header.php";
?>

<!-- ICON SPRITE (inline voor universele compatibiliteit) -->
<svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
<symbol id="bolt" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></symbol>
<symbol id="book-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></symbol>
<symbol id="chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></symbol>
<symbol id="check-circle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></symbol>
<symbol id="clipboard" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/></symbol>
<symbol id="globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></symbol>
<symbol id="lightbulb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/></symbol>
<symbol id="lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></symbol>
<symbol id="people" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></symbol>
<symbol id="refresh" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></symbol>
<symbol id="sparkle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></symbol>
<symbol id="user-plus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></symbol>
<symbol id="academic-cap" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4.26 10.147a60.438 60.438 0 0015.232 0M3 18.75v-7.5a.75.75 0 01.75-.75h16.5a.75.75 0 01.75.75v7.5M3 18.75h18M4.5 12.75v6M19.5 12.75v6M12 4.5l9 4.5-9 4.5-9-4.5 9-4.5z"/></symbol>
<symbol id="trend-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 18L9 11.25l4.306 4.306a11.95 11.95 0 015.814-5.518l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></symbol>
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
            <span style="color: #fff;">Workshops &amp; Trainingen</span>
        </div>
        <div class="hero-eyebrow">
            <svg width="13" height="13" viewBox="0 0 24 24" aria-hidden="true"><use href="#academic-cap"/></svg>
            Workshops &amp; Trainingen
        </div>
        <h1 >Leren door te <em>doen</em> — in uw eigen werkomgeving</h1>
        <p class="hero-sub">
            Van een korte inspiratiesessie tot een meerweeks programma — onze workshops en trainingen
            zijn altijd hands-on, in uw eigen Microsoft 365-omgeving en afgestemd op uw rollen,
            processen en doelen. Geen theorie zonder toepassing.
        </p>
        <div class="hero-actions">
            <a href="../contact.php" class="btn btn-accent">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                Plan een intake
            </a>
            <a href="#vormen" class="btn btn-ghost-dark">Bekijk trainingsvormen →</a>
        </div>
    </div>
</section>

<!-- INTRO -->
<section id="intro" class="section-alt">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>Over onze trainingen</span>
                <h2 >Microsoft 365 leert u niet uit een <em>handleiding</em></h2>
                <p>Microsoft 365 ontwikkelt zich razendsnel. Nieuwe functies, AI-mogelijkheden en samenwerkingsvormen volgen elkaar in hoog tempo op. Tegelijk werken veel medewerkers nog op dezelfde manier als vijf jaar geleden — terwijl de tools fundamenteel zijn veranderd.</p>
                <p>Wij geloven dat training pas effect heeft als deelnemers <strong>direct in hun eigen werkomgeving</strong> aan de slag gaan, met hun eigen documenten en concrete werkvragen. Geen demo-omgevingen, geen generieke voorbeelden — wel relevante toepassing.</p>
                <p>Daarom leveren we workshops en trainingen op maat: per rol, per applicatie en per organisatie. Van korte inspiratiesessies tot meerweekse leertrajecten.</p>
            </div>
            <div>
                <div class="intro-highlight">
                    <blockquote>De grootste belemmering voor adoptie is niet de techniek, maar de tijd en ruimte om er écht mee te leren werken. Dat is precies wat wij faciliteren.</blockquote>
                </div>
                <div style="margin-top: 22px; display: flex; flex-direction: column; gap: 12px;">
                    <div style="display:flex; gap:12px; align-items:flex-start; padding: 16px 18px; background: var(--licht); border-radius: var(--radius);">
                        <span style="flex-shrink:0; color:var(--geel-donker);"><svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true"><use href="#book-open"/></svg></span>
                        <div>
                            <div style="font-size:0.88rem; font-weight:800; margin-bottom:4px;">Incompany &amp; op maat</div>
                            <div style="font-size:0.83rem; color:var(--grijs); line-height:1.6;">Trainingen op uw locatie of online, met uw eigen Microsoft 365-tenant, casussen en collega's.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:12px; align-items:flex-start; padding: 16px 18px; background: var(--licht); border-radius: var(--radius);">
                        <span style="flex-shrink:0; color:var(--geel-donker);"><svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true"><use href="#check-circle"/></svg></span>
                        <div>
                            <div style="font-size:0.88rem; font-weight:800; margin-bottom:4px;">Max. 10 deelnemers per sessie</div>
                            <div style="font-size:0.83rem; color:var(--grijs); line-height:1.6;">Kleine groepen voor maximaal leereffect, interactie en individuele aandacht per deelnemer.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRAININGSVORMEN -->
<section id="vormen" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Trainingsvormen</span>
        <h2 >Zes vormen, één <em>rode draad</em>: hands-on</h2>
        <p class="lead" style="max-width:680px;">Afhankelijk van uw vraag en het niveau van de deelnemers kiezen we de juiste vorm — of combineren we meerdere vormen tot een passend programma.</p>

        <div class="vormen-grid">
            <div class="vorm-card fade-up">
                <div class="vorm-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#lightbulb-2"/></svg>
                </div>
                <h3>Inspiratiesessies</h3>
                <p>Korte, energieke sessies (1–2 uur) waarin medewerkers ontdekken wat Microsoft 365, Copilot of een specifieke werkwijze kan betekenen — met live demo's en concrete voorbeelden uit uw eigen branche.</p>
                <span class="vorm-tag">1–2 uur</span>
            </div>

            <div class="vorm-card fade-up">
                <div class="vorm-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#bolt"/></svg>
                </div>
                <h3>Productivity workshops</h3>
                <p>Praktische werksessies waarin medewerkers hun dagelijkse werk slimmer leren inrichten — taakbeheer in To Do en Planner, OneNote, Loop, e-mailbeheer en effectief samenwerken aan documenten.</p>
                <span class="vorm-tag">Halve dag</span>
            </div>

            <div class="vorm-card fade-up">
                <div class="vorm-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#sparkle"/></svg>
                </div>
                <h3>Copilot workshops</h3>
                <p>Per rol gerichte workshops voor Sales, IT, HR, Finance en management. Prompt engineering, integratie in Word, Excel, Outlook en Teams, plus persoonlijk Copilot-playbook.</p>
                <span class="vorm-tag">Per rol</span>
            </div>

            <div class="vorm-card fade-up">
                <div class="vorm-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#chat"/></svg>
                </div>
                <h3>Teams trainingen</h3>
                <p>Van chat en kanalen tot vergader-etiquette, bestanden delen en integratie met Planner, SharePoint en Loop. Voor gebruikers én voor team-eigenaren die hun teamruimte willen inrichten.</p>
                <span class="vorm-tag">Per niveau</span>
            </div>

            <div class="vorm-card fade-up">
                <div class="vorm-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#clipboard"/></svg>
                </div>
                <h3>SharePoint beheerder</h3>
                <p>Voor sitebeheerders en informatiemanagers: site-architectuur, machtigingen, metadata, content types, retentiebeleid, navigatie en governance van uw SharePoint-omgeving.</p>
                <span class="vorm-tag">Verdieping</span>
            </div>

            <div class="vorm-card fade-up">
                <div class="vorm-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#lock"/></svg>
                </div>
                <h3>Round tables: Purview &amp; Governance</h3>
                <p>Besloten kennissessies voor IT-, security- en complianceverantwoordelijken over data classificatie, sensitivity labels, DLP, retention, AVG, NEN7510 en BIO — met peers en hands-on demo's.</p>
                <span class="vorm-tag">Besloten</span>
            </div>
        </div>
    </div>
</section>

<!-- DETAILS PER VORM -->
<section id="details" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Per trainingsvorm</span>
        <h2 >Wat u <em>concreet</em> kunt verwachten</h2>
        <p class="lead" style="max-width:680px;">Onderstaand een verdieping per trainingsvorm — inclusief duur, doelgroep en de belangrijkste leerdoelen. De definitieve invulling stemmen we altijd af op uw situatie.</p>

        <div class="detail-grid">

            <!-- INSPIRATIESESSIES -->
            <div class="detail-card fade-up">
                <div class="detail-side">
                    <span class="detail-badge">01 · Inspiratie</span>
                    <h3>Inspiratiesessies</h3>
                    <div class="detail-meta">
                        <div class="detail-meta-row"><strong>Duur</strong><span>1–2 uur</span></div>
                        <div class="detail-meta-row"><strong>Vorm</strong><span>Plenair, fysiek of online</span></div>
                        <div class="detail-meta-row"><strong>Voor wie</strong><span>Alle medewerkers, MT, ambassadeurs</span></div>
                    </div>
                </div>
                <div class="detail-content">
                    <p>De ideale start: een energieke kennismakingssessie die laat zien wat Microsoft 365, Copilot of een specifieke werkwijze kan betekenen voor uw organisatie. Geen abstracte theorie, maar concrete demo's met herkenbare voorbeelden uit uw eigen branche en werkpraktijk.</p>
                    <p>We gebruiken deze sessies vaak als opmaat naar een breder traject — om motivatie en draagvlak te creëren voordat de daadwerkelijke trainingen starten.</p>
                    <ul>
                        <li>Live demo Copilot in eigen Office-apps</li>
                        <li>Wat verandert er voor mijn rol?</li>
                        <li>Q&amp;A met de zaal</li>
                        <li>Inspirerende klantvoorbeelden</li>
                        <li>Vervolgstappen &amp; routekaart</li>
                        <li>Praktische tips direct toepasbaar</li>
                    </ul>
                </div>
            </div>

            <!-- PRODUCTIVITY WORKSHOPS -->
            <div class="detail-card fade-up">
                <div class="detail-side">
                    <span class="detail-badge">02 · Productivity</span>
                    <h3>Productivity workshops</h3>
                    <div class="detail-meta">
                        <div class="detail-meta-row"><strong>Duur</strong><span>Halve dag (3–4 uur)</span></div>
                        <div class="detail-meta-row"><strong>Vorm</strong><span>Hands-on, max. 10 deelnemers</span></div>
                        <div class="detail-meta-row"><strong>Voor wie</strong><span>Kantoor- en kenniswerkers</span></div>
                    </div>
                </div>
                <div class="detail-content">
                    <p>Praktische werksessies waarin medewerkers hun dagelijkse werk slimmer leren inrichten. Iedere deelnemer werkt met zijn eigen agenda, e-mail, taken en documenten — niet met fictieve voorbeelden. Het effect: vanaf de eerste dag tijdwinst en minder digitale frustratie.</p>
                    <p>Workshops zijn modulair en kunnen los of als programma worden gegeven, afhankelijk van de onderwerpen die relevant zijn voor uw mensen.</p>
                    <ul>
                        <li>Taakbeheer met To Do &amp; Planner</li>
                        <li>OneNote &amp; Loop als digitaal notitieboek</li>
                        <li>Effectief e-mailbeheer in Outlook</li>
                        <li>Slim samenwerken aan documenten</li>
                        <li>Agenda &amp; focustijd organiseren</li>
                        <li>Bestanden vinden &amp; delen via OneDrive</li>
                    </ul>
                </div>
            </div>

            <!-- COPILOT WORKSHOPS -->
            <div class="detail-card fade-up">
                <div class="detail-side">
                    <span class="detail-badge">03 · AI &amp; Copilot</span>
                    <h3>Copilot workshops</h3>
                    <div class="detail-meta">
                        <div class="detail-meta-row"><strong>Duur</strong><span>2 × 3 uur per rol</span></div>
                        <div class="detail-meta-row"><strong>Vorm</strong><span>Per rol, hands-on</span></div>
                        <div class="detail-meta-row"><strong>Voor wie</strong><span>Sales, IT, HR, Finance, MT</span></div>
                    </div>
                </div>
                <div class="detail-content">
                    <p>Copilot levert pas écht waarde als medewerkers leren <strong>hoe</strong> ze ermee werken — niet alleen wát het kan. Onze rolgerichte workshops combineren prompt engineering met use-cases per functie: een Sales-medewerker traint anders dan een controller of HR-specialist.</p>
                    <p>Iedere deelnemer verlaat de workshop met een persoonlijk <strong>Copilot-playbook</strong>: een set werkende prompts, sjablonen en gewoontes die direct in het dagelijkse werk toepasbaar zijn.</p>
                    <ul>
                        <li>Prompt engineering: van vraag naar resultaat</li>
                        <li>Copilot in Word, Excel, Outlook &amp; Teams</li>
                        <li>Persoonlijk Copilot-playbook</li>
                        <li>Veilig omgaan met bedrijfsdata</li>
                        <li>Use-cases per rol &amp; afdeling</li>
                        <li>Aan de slag met Copilot Agents</li>
                    </ul>
                </div>
            </div>

            <!-- TEAMS TRAININGEN -->
            <div class="detail-card fade-up">
                <div class="detail-side">
                    <span class="detail-badge">04 · Teams</span>
                    <h3>Teams trainingen</h3>
                    <div class="detail-meta">
                        <div class="detail-meta-row"><strong>Duur</strong><span>2–4 uur per module</span></div>
                        <div class="detail-meta-row"><strong>Vorm</strong><span>Per niveau (basis / verdieping)</span></div>
                        <div class="detail-meta-row"><strong>Voor wie</strong><span>Gebruikers én team-eigenaren</span></div>
                    </div>
                </div>
                <div class="detail-content">
                    <p>Teams is voor veel organisaties uitgegroeid tot de centrale werkplek — maar wordt nog vaak gebruikt als chat-app. Onze trainingen helpen medewerkers Teams structureel in te zetten als <strong>samenwerkingshub</strong>: van team-inrichting tot bestandsbeheer en vergaderdiscipline.</p>
                    <p>We onderscheiden trainingen voor eindgebruikers en voor team-eigenaren — die laatste leren hun teamruimte goed in te richten, kanalen te structureren en de juiste apps te integreren.</p>
                    <ul>
                        <li>Chat, kanalen &amp; mentions</li>
                        <li>Vergaderen &amp; vergader-etiquette</li>
                        <li>Bestanden delen, niet rondsturen</li>
                        <li>Planner, Loop &amp; SharePoint integratie</li>
                        <li>Team-eigenaarschap &amp; governance</li>
                        <li>Werken met externe gasten</li>
                    </ul>
                </div>
            </div>

            <!-- SHAREPOINT BEHEERDER -->
            <div class="detail-card fade-up">
                <div class="detail-side">
                    <span class="detail-badge">05 · SharePoint</span>
                    <h3>SharePoint beheerder</h3>
                    <div class="detail-meta">
                        <div class="detail-meta-row"><strong>Duur</strong><span>2 dagen (verdieping)</span></div>
                        <div class="detail-meta-row"><strong>Vorm</strong><span>Hands-on, eigen tenant</span></div>
                        <div class="detail-meta-row"><strong>Voor wie</strong><span>Sitebeheerders, informatiemanagers</span></div>
                    </div>
                </div>
                <div class="detail-content">
                    <p>Een goed beheerde SharePoint-omgeving begint bij beheerders die weten waar ze mee bezig zijn. Onze verdiepende training behandelt site-architectuur, machtigingen en metadata — maar ook de strategische keuzes rond informatiehuishouding, retention en navigatie.</p>
                    <p>Deelnemers werken in een testsite én leren hoe ze hun productieomgeving stap voor stap kunnen optimaliseren — met aandacht voor zowel techniek als governance.</p>
                    <ul>
                        <li>Site-architectuur &amp; hubsites</li>
                        <li>Machtigingen &amp; gasttoegang</li>
                        <li>Metadata &amp; content types</li>
                        <li>Retentiebeleid &amp; archivering</li>
                        <li>Navigatie &amp; zoekoptimalisatie</li>
                        <li>Site eigenaarschap &amp; lifecycle</li>
                    </ul>
                </div>
            </div>

            <!-- PURVIEW ROUND TABLES -->
            <div class="detail-card fade-up">
                <div class="detail-side">
                    <span class="detail-badge">06 · Round Table</span>
                    <h3>Purview &amp; Governance</h3>
                    <div class="detail-meta">
                        <div class="detail-meta-row"><strong>Duur</strong><span>Dagdeel, besloten setting</span></div>
                        <div class="detail-meta-row"><strong>Vorm</strong><span>Round table met peers</span></div>
                        <div class="detail-meta-row"><strong>Voor wie</strong><span>IT, security, compliance</span></div>
                    </div>
                </div>
                <div class="detail-content">
                    <p>Voor IT-, security- en complianceverantwoordelijken organiseren we besloten round table-sessies rondom Microsoft Purview en data governance. In een kleine groep van peers bespreken we strategie, ervaringen en valkuilen — aangevuld met hands-on demo's in een live omgeving.</p>
                    <p>Geen verkoop, geen marketing — wel scherpe vakinhoudelijke gesprekken over hoe organisaties hun datalandschap onder controle krijgen volgens AVG, NEN7510 en BIO.</p>
                    <ul>
                        <li>Data classification &amp; sensitivity labels</li>
                        <li>Data Loss Prevention (DLP)</li>
                        <li>Retentielabels &amp; records management</li>
                        <li>Insider Risk Management</li>
                        <li>Compliance: AVG, NEN7510, BIO</li>
                        <li>Roadmap voor uw organisatie</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- AANPAK -->
<section id="aanpak-strip" class="section-alt">
    <div class="container">
        <div class="aanpak-strip-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>Onze aanpak</span>
                <h2>Vier stappen naar <em>blijvende kennis</em></h2>
            </div>
            <div class="aanpak-strip-steps">
                <div class="aanpak-strip-step">
                    <span class="aanpak-strip-num">01</span>
                    <h4>Intake &amp; nulmeting</h4>
                    <p>Wat is het huidige niveau en wat is het doel?</p>
                </div>
                <div class="aanpak-strip-step">
                    <span class="aanpak-strip-num">02</span>
                    <h4>Programma op maat</h4>
                    <p>Modules en cases afgestemd op uw mensen.</p>
                </div>
                <div class="aanpak-strip-step">
                    <span class="aanpak-strip-num">03</span>
                    <h4>Hands-on sessies</h4>
                    <p>Leren in uw eigen omgeving en data.</p>
                </div>
                <div class="aanpak-strip-step">
                    <span class="aanpak-strip-num">04</span>
                    <h4>Follow-up &amp; borging</h4>
                    <p>Q&amp;A, refreshers en blijvende ondersteuning.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAMMA -->
<section id="programma" class="section-alt">
    <div class="container">
        <div class="programma-grid">
            <div class="programma-text">
                <span class="eyebrow"><span class="dot"></span>Programma uitgelicht</span>
                <h2 >6 weken aan de slag met <em>AI &amp; Copilot</em></h2>
                <p>Ons populairste programma is de 6-weekse leerreis "Werken met AI &amp; Copilot". Geen losse training, maar een gestructureerde reis waarin deelnemers wekelijks een nieuw thema verkennen, oefenen in hun eigen werk en in de volgende sessie ervaringen delen.</p>
                <p>Het resultaat: medewerkers die Copilot écht in hun routine hebben opgenomen — niet één keer geprobeerd en vergeten. Het programma is geschikt voor groepen van 6 tot 12 deelnemers per cohort.</p>
                <a href="../contact.php" class="btn btn-accent" style="margin-top: 8px;">Informatie aanvragen →</a>
            </div>
            <div class="programma-weeks">
                <h3>Het 6-weekse programma</h3>
                <div class="week-item">
                    <div class="week-num">1</div>
                    <div class="week-info">
                        <h4>Kennismaken met Copilot</h4>
                        <p>Wat is het, wat kan het, en hoe zit het met data &amp; veiligheid?</p>
                    </div>
                </div>
                <div class="week-item">
                    <div class="week-num">2</div>
                    <div class="week-info">
                        <h4>Prompt engineering basis</h4>
                        <p>Van vage vraag naar specifieke, bruikbare output.</p>
                    </div>
                </div>
                <div class="week-item">
                    <div class="week-num">3</div>
                    <div class="week-info">
                        <h4>Copilot in Word &amp; Outlook</h4>
                        <p>Schrijven, samenvatten, antwoorden — sneller en beter.</p>
                    </div>
                </div>
                <div class="week-item">
                    <div class="week-num">4</div>
                    <div class="week-info">
                        <h4>Copilot in Excel &amp; Teams</h4>
                        <p>Data analyseren, vergaderingen samenvatten, acties opvolgen.</p>
                    </div>
                </div>
                <div class="week-item">
                    <div class="week-num">5</div>
                    <div class="week-info">
                        <h4>Rol-specifieke toepassingen</h4>
                        <p>Verdieping naar uw eigen rol en concrete werkprocessen.</p>
                    </div>
                </div>
                <div class="week-item">
                    <div class="week-num">6</div>
                    <div class="week-info">
                        <h4>Persoonlijk playbook &amp; borging</h4>
                        <p>Uw eigen Copilot-routine vastleggen en delen met collega's.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WAAROM LEREN -->
<section id="waarom-leren" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Waarom investeren in trainen</span>
        <h2 >Training is geen <em>kostenpost</em></h2>
        <p class="lead" style="max-width:680px;">Organisaties investeren fors in Microsoft 365-licenties — maar gebruiken vaak slechts een fractie van de mogelijkheden. Investeren in de mensen achter de licenties verdient zichzelf snel terug.</p>

        <div class="waarom-grid">
            <div class="waarom-card fade-up">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#trend-up"/></svg></div>
                <h3>Aantoonbare productiviteit</h3>
                <p>Medewerkers die getraind zijn in Microsoft 365 en Copilot besparen gemiddeld meerdere uren per week aan repeterend werk — tijd die direct ten goede komt aan kerntaken.</p>
            </div>
            <div class="waarom-card fade-up">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#check-circle"/></svg></div>
                <h3>Minder digitale frustratie</h3>
                <p>Medewerkers die hun tools beheersen zijn minder gefrustreerd, stellen minder vragen aan IT-support en raken minder snel uitgekeken op de digitale werkplek.</p>
            </div>
            <div class="waarom-card fade-up">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#lock"/></svg></div>
                <h3>Veiliger gedrag</h3>
                <p>Bewuste gebruikers maken minder fouten met delen, classificatie en externe samenwerking. Training is daarmee ook een investering in compliance en informatiebeveiliging.</p>
            </div>
            <div class="waarom-card fade-up">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#globe"/></svg></div>
                <h3>Snellere AI-adoptie</h3>
                <p>Met goede begeleiding verdient een Copilot-licentie zich vaak binnen enkele weken terug. Zonder begeleiding blijft de tool ongebruikt op de plank liggen.</p>
            </div>
            <div class="waarom-card fade-up">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#people"/></svg></div>
                <h3>Sterker werkgeversmerk</h3>
                <p>Organisaties die hun mensen actief opleiden in moderne tools zijn aantrekkelijker voor talent en behouden medewerkers langer. Leren is een arbeidsvoorwaarde geworden.</p>
            </div>
            <div class="waarom-card fade-up">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><use href="#refresh"/></svg></div>
                <h3>Continue waarde</h3>
                <p>Microsoft 365 ontwikkelt continu. Door regelmatig bij te leren blijft uw organisatie aansluiten bij nieuwe functionaliteit — in plaats van achterop te raken.</p>
            </div>
        </div>
    </div>
</section>

<!-- DOELGROEPEN -->
<section id="doelgroepen" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Voor wie</span>
        <h2 >Onze trainingen zijn op maat gemaakt voor <em>iedere rol</em></h2>
        <p class="lead" style="max-width:680px; color: rgba(255,255,255,0.66);">Van directie tot magazijn — we trainen verschillende doelgroepen op verschillende niveaus, telkens met andere voorbeelden, casussen en leerdoelen.</p>

        <div class="doel-grid">
            <div class="doel-item">
                <div class="doel-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><use href="#lightbulb-2"/></svg>
                </div>
                <div>
                    <h4>MT &amp; directie</h4>
                    <p>Strategische inspiratie over de impact van AI en moderne samenwerking — niet over knoppen, wel over richting en voorbeeldgedrag.</p>
                </div>
            </div>
            <div class="doel-item">
                <div class="doel-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84"/></svg>
                </div>
                <div>
                    <h4>Kenniswerkers</h4>
                    <p>Mensen die het meeste profijt halen uit Copilot, Teams en Loop — verdieping in efficiënte werkwijzen, samenwerking en focus.</p>
                </div>
            </div>
            <div class="doel-item">
                <div class="doel-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><use href="#people"/></svg>
                </div>
                <div>
                    <h4>Ambassadeurs &amp; key-users</h4>
                    <p>Train-the-trainer programma's voor interne ambassadeurs die de adoptie binnen hun team gaan dragen. Inhoudelijk én didactisch.</p>
                </div>
            </div>
            <div class="doel-item">
                <div class="doel-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><use href="#clipboard"/></svg>
                </div>
                <div>
                    <h4>Beheerders &amp; IT</h4>
                    <p>Verdiepende, technische trainingen voor SharePoint-, Teams- en M365-beheerders. Architectuur, configuratie en governance.</p>
                </div>
            </div>
            <div class="doel-item">
                <div class="doel-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><use href="#lock"/></svg>
                </div>
                <div>
                    <h4>Compliance &amp; security</h4>
                    <p>Round table-sessies voor functionarissen die zich bezighouden met data governance, AVG, NEN7510 en informatiebeveiliging.</p>
                </div>
            </div>
            <div class="doel-item">
                <div class="doel-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><use href="#user-plus"/></svg>
                </div>
                <div>
                    <h4>Nieuwe medewerkers</h4>
                    <p>Onboarding-modules zodat iedere nieuwe medewerker vanaf dag één productief en op de juiste manier met Microsoft 365 aan de slag gaat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section id="cta-final" class="section-alt">
    <div class="container">
        <h2>Klaar om uw mensen écht aan boord te krijgen?</h2>
        <p>Plan een vrijblijvend intakegesprek — we kijken samen welke trainingsvorm of programma het beste past bij uw organisatie.</p>
        <a href="../contact.php" class="btn btn-dark">Plan een intake</a>
    </div>
</section>

<!-- FOOTER (injected by assets/js/site.js) -->
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



