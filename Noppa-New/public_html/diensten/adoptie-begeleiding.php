<?php
$pageTitle = "Adoptie & Begeleiding — Microsoft 365 | Noppa";
$pageDesc = "Noppa begeleidt organisaties bij de adoptie van Microsoft 365. Van ambassadeursnetwerk en persona-analyse tot trainingen op maat en borging — de medewerker centraal.";
$base = "../";
include $base . "partials/header.php";
?>

<!-- ICON SPRITE (inline voor universele compatibiliteit) -->
<svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
<symbol id="phone-old" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></symbol>
<symbol id="users-group-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></symbol>
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
            <span style="color: #fff;">Adoptie &amp; Begeleiding</span>
        </div>
        <div class="hero-eyebrow">
            <svg width="13" height="13" aria-hidden="true"><use href="#users-group-2"/></svg>
            Adoptie & Begeleiding Microsoft 365
        </div>
        <h1 >Technologie slaagt alleen als <em>mensen meegaan</em></h1>
        <p class="hero-sub">
            Microsoft 365 levert pas waarde wanneer medewerkers de tools écht gebruiken.
            Wij begeleiden uw organisatie van de eerste stap tot blijvend gebruik —
            met een bewezen 5-fasen aanpak en het ADKAR-model als fundament.
        </p>
        <div class="hero-actions">
            <a href="../contact.php" class="btn btn-accent">
                <svg width="15" height="15" aria-hidden="true"><use href="#phone-old"/></svg>
                Plan een kennismaking &rarr;</a>
            <a href="#aanpak" class="btn btn-ghost-dark">Bekijk onze aanpak →</a>
        </div>
    </div>
</section>

<!-- INTRO -->
<section id="intro" class="section-alt">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>Over deze dienst</span>
                <h2 >Technologie verandert.<br><em>Mensen veranderen niet vanzelf.</em></h2>
                <p>De introductie van Microsoft 365 is een grote stap voor elke organisatie. Nieuwe tools, nieuwe manieren van samenwerken, nieuwe gewoonten. Veel organisaties investeren in de technologie, maar onderschatten de menselijke kant van de verandering.</p>
                <p>Bij Noppa staat de medewerker centraal. Niet als eindgebruiker die een handleiding krijgt, maar als professional die begrijpt <em>waarom</em> een oplossing er is, <em>hoe</em> hij die inzet en die verandering ook morgen nog omarmt.</p>
                <p>Succesvolle adoptie levert medewerkers op die digitaal fitter zijn: ze kunnen zich effectiever richten op hun kerntaken, zijn minder gefrustreerd en stellen minder vragen aan interne ondersteuners.</p>
            </div>
            <div>
                <div class="intro-highlight">
                    <blockquote>Adoptie draait erom dat mensen écht begrijpen hoe en waarom ze bepaalde oplossingen kunnen of moeten gebruiken — op zo'n manier dat zij zich toekomstige wijzigingen óók op een gemakkelijke manier eigen maken.</blockquote>
                </div>
                <div style="margin-top: 22px; display: flex; flex-direction: column; gap: 12px;">
                    <div style="display:flex; gap:12px; align-items:flex-start; padding: 16px 18px; background: var(--licht); border-radius: var(--radius);">
                        <span style="flex-shrink:0; color:var(--geel-donker);"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg></span>
                        <div>
                            <div style="font-size:0.88rem; font-weight:800; margin-bottom:4px;">Maatwerk per organisatie</div>
                            <div style="font-size:0.83rem; color:var(--grijs); line-height:1.6;">Onze aanpak past zich aan op de uitkomsten van de verkenningsfase — geen standaard programma.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:12px; align-items:flex-start; padding: 16px 18px; background: var(--licht); border-radius: var(--radius);">
                        <span style="flex-shrink:0; color:var(--geel-donker);"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg></span>
                        <div>
                            <div style="font-size:0.88rem; font-weight:800; margin-bottom:4px;">Borging na go-live</div>
                            <div style="font-size:0.83rem; color:var(--grijs); line-height:1.6;">We stoppen niet bij oplevering. Nieuwe medewerkers, nieuwe functionaliteiten — wij helpen u grip te houden.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- UITDAGINGEN -->
<section id="uitdaging" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Herkent u dit?</span>
        <h2 >Veelvoorkomende <em>startpunten</em></h2>
        <p class="lead" style="max-width:680px;">Adoptietrajecten starten vanuit verschillende situaties. Wij begeleiden organisaties ongeacht het vertrekpunt.</p>
        <div class="challenge-grid">
            <div class="challenge-card fade-up">
                <div class="challenge-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z"/></svg></div>
                <h3>Migratie naar de cloud</h3>
                <p>Netwerkschijven, lokale servers of verouderde mailomgevingen worden vervangen door Microsoft 365. Medewerkers moeten een nieuwe werkwijze aannemen.</p>
            </div>
            <div class="challenge-card fade-up">
                <div class="challenge-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg></div>
                <h3>Teams niet van de grond</h3>
                <p>Microsoft Teams is technisch uitgerold, maar medewerkers werken nog via e-mail en WhatsApp. De samenwerking verbetert niet.</p>
            </div>
            <div class="challenge-card fade-up">
                <div class="challenge-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg></div>
                <h3>Productiviteit verhogen</h3>
                <p>Werkprocessen digitaliseren met Power Platform, Copilot of SharePoint. Medewerkers moeten de nieuwe tools integreren in hun dagelijkse werk.</p>
            </div>
            <div class="challenge-card fade-up">
                <div class="challenge-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg></div>
                <h3>Veiliger documenten delen</h3>
                <p>Organisaties willen externe samenwerking veiliger inrichten en medewerkers bewust maken van de juiste manier van delen en opslaan.</p>
            </div>
            <div class="challenge-card fade-up">
                <div class="challenge-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></svg></div>
                <h3>Copilot & AI adoptie</h3>
                <p>Microsoft Copilot biedt grote kansen, maar vraagt om een weloverwogen uitrolstrategie. Mensen moeten leren hoe zij AI effectief inzetten.</p>
            </div>
            <div class="challenge-card fade-up">
                <div class="challenge-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg></div>
                <h3>Borging na uitrol</h3>
                <p>Na de initiële uitrol vervalt gebruik terug naar oud gedrag. Nieuwe medewerkers ontvangen geen structurele onboarding op M365.</p>
            </div>
        </div>
    </div>
</section>

<!-- AANPAK: 5 FASEN -->
<section id="aanpak" class="section-alt">
    <div class="container">
        <div class="fasen-intro">
            <span class="eyebrow"><span class="dot"></span>Onze aanpak</span>
            <h2 >Een bewezen aanpak in <em>vijf fasen</em></h2>
            <p>Ons succesvol adoptieprogramma volgt een gestructureerde vijf-fasen-aanpak, waarbij elke stap voortborduurt op de vorige. De inhoud en planning worden afgestemd op de specifieke situatie en uitkomsten van de verkenningsfase.</p>
        </div>
        <div class="fasen-grid">
            <div class="fase-item fade-up">
                <div class="fase-nr">
                    <span class="fase-num">01</span>
                    <span class="fase-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0015.803 15.803z"/></svg></span>
                </div>
                <div class="fase-naam">Voorbereiding</div>
                <div class="fase-desc">Inventarisatie van digitale vaardigheidsniveaus, ontwikkeling van persona's en het samenstellen van een ambassadeursgroep.</div>
            </div>
            <div class="fase-item fade-up">
                <div class="fase-nr">
                    <span class="fase-num">02</span>
                    <span class="fase-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/></svg></span>
                </div>
                <div class="fase-naam">Realisatie</div>
                <div class="fase-desc">Ontwikkelen en afstemmen van trainingsmateriaal, communicatiemiddelen en activiteiten, passend bij de geïdentificeerde doelgroepen.</div>
            </div>
            <div class="fase-item fade-up">
                <div class="fase-nr">
                    <span class="fase-num">03</span>
                    <span class="fase-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/></svg></span>
                </div>
                <div class="fase-naam">Motivatie</div>
                <div class="fase-desc">Medewerkers informeren over het waarom, hoe en de voordelen van de verandering — op een manier die aansluit bij de organisatie.</div>
            </div>
            <div class="fase-item fade-up">
                <div class="fase-nr">
                    <span class="fase-num">04</span>
                    <span class="fase-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg></span>
                </div>
                <div class="fase-naam">Educatie</div>
                <div class="fase-desc">Afgestemde trainingen per gebruikersgroep, zowel fysiek als online. Groepen van maximaal 10 deelnemers voor maximaal leereffect.</div>
            </div>
            <div class="fase-item fade-up">
                <div class="fase-nr">
                    <span class="fase-num">05</span>
                    <span class="fase-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg></span>
                </div>
                <div class="fase-naam">Activatie</div>
                <div class="fase-desc">Medewerkers worden na de training ondersteund en aangemoedigd bij het daadwerkelijk toepassen — en het gebruik wordt geborgd voor de lange termijn.</div>
            </div>
        </div>
    </div>
</section>

<!-- FASE DETAILS -->
<section id="fase-details" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Fase voor fase</span>
        <h2 >Wat elke fase <em>inhoudt</em></h2>
        <p class="lead" style="max-width:680px;">Onderstaand een verdieping per fase. De definitieve invulling, planning en producten worden altijd afgestemd op de specifieke situatie van uw organisatie.</p>
        <div class="fase-detail-grid">

            <div class="fase-detail-card fade-up">
                <div class="fase-detail-header">
                    <div class="fase-detail-badge">01</div>
                    <h3>Voorbereiding</h3>
                </div>
                <p>We starten met een inventarisatie van het digitale vaardigheidsniveau van medewerkers. Dit levert input voor het ontwikkelen van <strong>persona's of werkstijlen</strong>: herkenbare profielen van typen gebruikers waarmee we gerichter de juiste groepen kunnen bedienen.</p>
                <p>Tegelijk formeren we een <strong>kerngroep van ambassadeurs of champions</strong> — medewerkers die de nieuwe werkwijze omarmen en als ambassadeur optreden voor de rest van de organisatie.</p>
            </div>

            <div class="fase-detail-card fade-up">
                <div class="fase-detail-header">
                    <div class="fase-detail-badge">02</div>
                    <h3>Realisatie</h3>
                </div>
                <p>Op basis van de verkenningsfase realiseren, aanpassen en toetsen we materiaal. We bereiden de kerngroep voor op hun rol in de uitrol.</p>
                <ul>
                    <li>Trainingen op maat</li>
                    <li>Communicatiebanners</li>
                    <li>Video-instructies</li>
                    <li>Inventariserende enquête</li>
                    <li>Opleiden ambassadeurs</li>
                    <li>Communicatieplan</li>
                </ul>
            </div>

            <div class="fase-detail-card fade-up">
                <div class="fase-detail-header">
                    <div class="fase-detail-badge">03</div>
                    <h3>Motivatie</h3>
                </div>
                <p>Voorafgaand aan de daadwerkelijke educatie zorgen we voor de <strong>juiste motivatie</strong>. We informeren medewerkers uitgebreid over het waarom, de hoe en de voordelen van het programma — op een manier die is afgestemd op de uitkomsten van de voorbereidingsfase.</p>
                <p>Middelen kunnen zijn: nieuwsberichten, video's van het management, briefings, teasers en inspiratiesessies via ambassadeurs.</p>
            </div>

            <div class="fase-detail-card fade-up">
                <div class="fase-detail-header">
                    <div class="fase-detail-badge">04</div>
                    <h3>Educatie</h3>
                </div>
                <p>Via afgestemde trainingen nemen we de verschillende gebruikersgroepen mee in het gebruik van Microsoft 365. Trainingen worden aangescherpt naar het type medewerker (bijv. lijnverantwoordelijke of kantoormedewerker).</p>
                <ul>
                    <li>Fysiek, max. 10 pp. per sessie</li>
                    <li>Online of hybride</li>
                    <li>Webinars & zelfstudiemateriaal</li>
                    <li>Verdiepingstrainingen</li>
                    <li>Tip van de dag</li>
                    <li>E-learning modules</li>
                </ul>
            </div>

            <div class="fase-detail-card accent fade-up">
                <div class="fase-detail-header">
                    <div class="fase-detail-badge">05</div>
                    <h3>Activatie &amp; Borging</h3>
                </div>
                <p>Na het vergroten van kennis worden medewerkers ondersteund en aangemoedigd bij het <strong>daadwerkelijk toepassen</strong>. Na afloop van het traject vindt een volledige overdracht binnen de organisatie plaats — ook voor nieuwe medewerkers.</p>
                <ul>
                    <li>Ask me anything-sessies</li>
                    <li>Één-op-één coaching</li>
                    <li>FAQ-pagina op SharePoint</li>
                    <li>Online en offline trainingen</li>
                    <li>Onboarding nieuwe medewerkers</li>
                    <li>Floorwalking door ambassadeurs</li>
                    <li>Digitale coaching op afroep</li>
                    <li>Voortgangsrapportage gebruik</li>
                    <li>Inloopsessies &amp; vragenuurtjes</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ADKAR -->
<section id="adkar" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Verandermodel</span>
        <h2 >Gebaseerd op het <em>ADKAR-model</em></h2>
        <p class="lead" style="max-width:680px;">Onze aanpak is geworteld in het bewezen ADKAR-verandermodel van Prosci. Elke fase in ons programma draagt bij aan een van de vijf bouwstenen van succesvolle verandering.</p>
        <div class="adkar-grid">
            <div class="adkar-card fade-up">
                <div class="adkar-letter">A</div>
                <div class="adkar-word">Awareness</div>
                <div class="adkar-desc">Medewerkers zijn zich bewust van de noodzaak van de verandering en begrijpen het waarom.</div>
            </div>
            <div class="adkar-card fade-up">
                <div class="adkar-letter">D</div>
                <div class="adkar-word">Desire</div>
                <div class="adkar-desc">Medewerkers willen meedoen. Ze zijn geïnteresseerd en gemotiveerd om de nieuwe manier te omarmen.</div>
            </div>
            <div class="adkar-card fade-up">
                <div class="adkar-letter">K</div>
                <div class="adkar-word">Knowledge</div>
                <div class="adkar-desc">Medewerkers weten hoe ze de nieuwe tools en werkwijzen moeten gebruiken. Kennis is opgebouwd.</div>
            </div>
            <div class="adkar-card fade-up">
                <div class="adkar-letter">A</div>
                <div class="adkar-word">Ability</div>
                <div class="adkar-desc">Medewerkers kunnen de kennis ook daadwerkelijk toepassen in hun dagelijkse werk.</div>
            </div>
            <div class="adkar-card fade-up">
                <div class="adkar-letter">R</div>
                <div class="adkar-word">Reinforcement</div>
                <div class="adkar-desc">Het nieuwe gedrag wordt verankerd. Terugval wordt voorkomen door actieve borging en ondersteuning.</div>
            </div>
        </div>
        <div class="adkar-journey fade-up">
            <h3>De medewerkerjourney</h3>
            <div class="journey-bar">
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                    <div class="j-lbl">Bewust</div>
                </div>
                <div class="journey-arrow">›</div>
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg></div>
                    <div class="j-lbl">Geïnteresseerd</div>
                </div>
                <div class="journey-arrow">›</div>
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg></div>
                    <div class="j-lbl">Gemotiveerd</div>
                </div>
                <div class="journey-arrow">›</div>
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1 .03 2.798-1.414 2.798H4.213c-1.444 0-2.414-1.798-1.414-2.798L4.2 15.3"/></svg></div>
                    <div class="j-lbl">Eerste ervaring</div>
                </div>
                <div class="journey-arrow">›</div>
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg></div>
                    <div class="j-lbl">Opleiding</div>
                </div>
                <div class="journey-arrow">›</div>
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                    <div class="j-lbl">Gebruik</div>
                </div>
                <div class="journey-arrow">›</div>
                <div class="journey-step">
                    <div class="j-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg></div>
                    <div class="j-lbl">Geborgd gebruik</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AMBASSADEURS -->
<section id="ambassadeurs" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Ambassadeursnetwerk</span>
        <h2 >Verandering gedragen door <em>de organisatie zelf</em></h2>
        <div class="amb-grid">
            <div class="amb-tekst">
                <p>Een sterk ambassadeursnetwerk is het hart van een succesvol adoptietraject. Ambassadeurs zijn medewerkers uit de eigen organisatie die de nieuwe werkwijze omarmen en als vraagbaak en rolmodel optreden voor hun collega's.</p>
                <p>Zij vertegenwoordigen de diversiteit van de organisatie — van magazijn tot directie — en worden door Noppa opgeleid en begeleid gedurende het gehele traject. Na afloop zijn zij zelfstandig in staat de adoptie te continueren.</p>
                <p>De kracht van ambassadeurs: collega's luisteren naar collega's. Verandering die van binnenuit wordt gedragen, beklijft.</p>
            </div>
            <div class="amb-rollen">
                <div class="amb-rol">
                    <h4>Ambassadeur / Champion</h4>
                    <p>Omarmt nieuwe functionaliteiten, is beschikbaar als vraagbaak (reactief én proactief), geeft uitleg in teamoverleggen, begeleidt migratie op de werkvloer en geeft webinars.</p>
                </div>
                <div class="amb-rol">
                    <h4>User Adoptie Groep (UAG)</h4>
                    <p>Stelt het integrale adoptieplan op, coacht ambassadeurs, zorgt voor maximale deelname aan interventies en levert voortgangsrapportages aan de stuurgroep.</p>
                </div>
                <div class="amb-rol">
                    <h4>Stuurgroep / Management</h4>
                    <p>Faciliteert commitment op het juiste niveau, helpt bij de communicatie richting de organisatie en stelt prioriteiten bij. Zichtbare steun vanuit leiderschap is cruciaal.</p>
                </div>
                <div class="amb-rol">
                    <h4>Noppa</h4>
                    <p>Begeleidt het gehele traject, traint ambassadeurs, verzorgt inhoudelijke sessies, bewaakt de methodiek en zorgt voor de overdracht naar de organisatie na afloop.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WAT WIJ BIEDEN -->
<section id="aanbod" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Ons aanbod</span>
        <h2 >Wat wij <em>bieden</em></h2>
        <p class="lead" style="max-width:680px;">Afhankelijk van uw vraag en de fase waarin uw organisatie zich bevindt, bieden wij de volgende diensten aan — los of als onderdeel van een integraal traject.</p>
        <div class="aanbod-grid">
            <div class="aanbod-card fade-up">
                <div class="aanbod-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0015.803 15.803z"/></svg></div>
                <h3>Verkenning &amp; persona-analyse</h3>
                <p>Inventarisatie van digitale vaardigheidsniveaus, werkstijlen en gebruikersgroepen als basis voor een op maat gemaakte aanpak.</p>
                <span class="aanbod-tag">Voorbereiding</span>
            </div>
            <div class="aanbod-card fade-up">
                <div class="aanbod-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg></div>
                <h3>Trainingen op maat</h3>
                <p>Fysieke of online trainingen per gebruikersgroep, aangescherpt op rol en vaardigheidsniveau. Maximaal 10 deelnemers per sessie voor optimale interactie.</p>
                <span class="aanbod-tag">Educatie</span>
            </div>
            <div class="aanbod-card fade-up">
                <div class="aanbod-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg></div>
                <h3>Ambassadeursprogramma</h3>
                <p>Opzetten, opleiden en begeleiden van een intern ambassadeursnetwerk dat de adoptie draagt — ook na afloop van het traject.</p>
                <span class="aanbod-tag">Motivatie &amp; Activatie</span>
            </div>
            <div class="aanbod-card fade-up">
                <div class="aanbod-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m-2.081 4.318l-4.64-1.082"/></svg></div>
                <h3>Ask me anything-sessies</h3>
                <p>Laagdrempelige sessies waarbij medewerkers al hun vragen kwijt kunnen. Reactief én proactief, op locatie of online.</p>
                <span class="aanbod-tag">Activatie</span>
            </div>
            <div class="aanbod-card fade-up">
                <div class="aanbod-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg></div>
                <h3>Één-op-één coaching</h3>
                <p>Persoonlijke begeleiding voor medewerkers die extra ondersteuning nodig hebben bij het toepassen van de nieuwe werkwijze.</p>
                <span class="aanbod-tag">Activatie</span>
            </div>
            <div class="aanbod-card fade-up">
                <div class="aanbod-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/></svg></div>
                <h3>FAQ &amp; kennisportaal</h3>
                <p>Opzetten en inrichten van een FAQ-pagina of supportsite op SharePoint — als blijvende kennisbron voor medewerkers en nieuwe collega's.</p>
                <span class="aanbod-tag">Borging</span>
            </div>
        </div>
    </div>
</section>

<!-- CONTINUE ONDERSTEUNING -->
<section id="continu" class="section-alt">
    <div class="container">
        <div class="continu-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>Blijvende ondersteuning</span>
                <h2 >Het platform ontwikkelt.<br><em>Wij blijven erbij.</em></h2>
                <p>Microsoft 365 is geen statisch product. Nieuwe functies, updates en mogelijkheden volgen elkaar in hoog tempo op. Voor veel organisaties is het lastig bij te houden wat er verandert en wat dat betekent voor hun medewerkers.</p>
                <p>Noppa ondersteunt organisaties ook ná de initiële uitrol: we houden relevante ontwikkelingen bij, informeren uw medewerkers en helpen nieuwe kansen te vertalen naar concrete toepassingen.</p>
            </div>
            <div class="continu-items">
                <div class="continu-item">
                    <div class="continu-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z"/></svg></div>
                    <div>
                        <h4>Continue monitoring</h4>
                        <p>We monitoren M365-diensten en productiviteitsrapportages voor prestatieoptimalisatie en signaleren kansen voor uw organisatie.</p>
                    </div>
                </div>
                <div class="continu-item">
                    <div class="continu-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg></div>
                    <div>
                        <h4>Updates voor medewerkers</h4>
                        <p>We vertalen nieuwe Microsoft-functies naar begrijpelijke informatie die past bij de werkwijze van uw organisatie.</p>
                    </div>
                </div>
                <div class="continu-item">
                    <div class="continu-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></svg></div>
                    <div>
                        <h4>Toekomstige uitbreidingen</h4>
                        <p>Samen werken we aan uitbreidingen en aanpassingen op basis van nieuwe bedrijfsbehoeften — zoals Copilot of Power Platform.</p>
                    </div>
                </div>
                <div class="continu-item">
                    <div class="continu-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg></div>
                    <div>
                        <h4>Onboarding nieuwe medewerkers</h4>
                        <p>We zorgen voor een structurele borging zodat nieuwe medewerkers direct op de juiste manier met M365 aan de slag gaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section id="cta-final" class="section-alt">
    <div class="container">
        <h2>Klaar voor een adoptietraject dat blijft plakken?</h2>
        <p>Plan een vrijblijvend gesprek en ontdek hoe Noppa uw organisatie begeleidt — van eerste stap tot geborgd gebruik.</p>
        <a href="../contact.php" class="btn btn-dark">Plan een kennismaking</a>
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



