<?php
$pageTitle = "Processen & Portalen — Intranet op SharePoint | Noppa";
$pageDesc = "Een modern intranet op SharePoint Online — drie heldere proposities (Basis, Standaard, Custom). Noppa levert van inventarisatie tot live en daarna.";
$base = "../";
include $base . "partials/header.php";
?>

<!-- ICON SPRITE (inline voor universele compatibiliteit) -->
<svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
<symbol id="check-small" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 6l3 3 5-5"/></symbol>
<symbol id="ic-0d33a5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></symbol>
<symbol id="ic-2ba45b" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></symbol>
<symbol id="ic-ad82be" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></symbol>
<symbol id="ic-b65be9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5L12 4l9 5.5M5 10v9h14v-9M9 19v-5h6v5"/></symbol>
<symbol id="ic-c03fd1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></symbol>
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
            <span style="color: #fff;">Processen & Portalen</span>
        </div>
        <div class="hero-eyebrow">
            <svg width="13" height="13" aria-hidden="true"><use href="#ic-b65be9"/></svg>
            Intranet op SharePoint Online
        </div>
        <h1 >Eén centrale plek voor uw <em>mensen, processen en kennis</em></h1>
        <p class="hero-sub">
            Een modern intranet dat uw medewerkers écht gebruiken. Wij bouwen op SharePoint Online —
            met drie heldere proposities, vaste prijzen en een traject van inventarisatie tot live.
            Zonder verrassingen, mét borging.
        </p>
        <div class="hero-actions">
            <a href="#pricing" class="btn btn-accent">
                <svg width="15" height="15" aria-hidden="true"><use href="#ic-ad82be"/></svg>
                Bekijk onze proposities
            </a>
            <a href="#proces" class="btn btn-ghost-dark">Onze aanpak →</a>
        </div>
    </div>
</section>

<!-- INTRO -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="eyebrow"><span class="dot"></span>Waarom een intranet</span>
                <h2 >Van versnipperde info naar één <em>digitale werkplek</em></h2>
                <p class="lead">
                    Documenten in mailboxen, nieuws op de koffieautomaat, processen in iemands hoofd —
                    veel organisaties verliezen elke week tijd aan zoeken en dubbel werk. Een goed ingericht
                    intranet brengt nieuws, kennis, processen en mensen samen op één vertrouwde plek.
                </p>
                <p class="lead">
                    Wij bouwen op <strong>SharePoint Online</strong> — onderdeel van uw bestaande Microsoft 365 —
                    en stemmen de inrichting af op uw organisatiegrootte. Geen losstaand systeem, geen extra licenties:
                    een intranet dat naadloos integreert met Teams, Outlook en de rest van uw werkplek.
                </p>
            </div>
            <div class="intro-pillars">
                <div class="intro-pillar">
                    <div class="ip-icon"><svg width="24" height="24" aria-hidden="true"><use href="#ic-c03fd1"/></svg></div>
                    <div>
                        <h4>Snel live</h4>
                        <p>Een werkend intranet binnen 4–8 weken, afhankelijk van de gekozen propositie.</p>
                    </div>
                </div>
                <div class="intro-pillar">
                    <div class="ip-icon"><svg width="24" height="24" aria-hidden="true"><use href="#ic-0d33a5"/></svg></div>
                    <div>
                        <h4>Vaste prijs, geen verrassingen</h4>
                        <p>Heldere proposities met vooraf bepaalde scope, kosten en doorlooptijd.</p>
                    </div>
                </div>
                <div class="intro-pillar">
                    <div class="ip-icon"><svg width="24" height="24" aria-hidden="true"><use href="#ic-2ba45b"/></svg></div>
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
<section id="pricing" class="section-alt">
    <div class="container">
        <div class="pricing-header">
            <span class="eyebrow"><span class="dot"></span>Drie proposities</span>
            <h2 >Kies wat past bij uw <em>organisatiegrootte</em></h2>
            <p class="lead">
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
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Inventarisatie & ontwerpsessie</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Hoofdpagina met nieuws</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>2 huisstijlkleuren</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>2 afdelingspagina's</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Basis-rechtenstructuur</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Online naslagwerk voor beheerders</li>
                </ul>
                <a href="../contact.php" class="btn btn-dark p-cta">Vraag een offerte aan</a>
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
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Alles uit Basis</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>3 afdelingspagina's</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Merkencenter, sjablonen- & mediabibliotheek</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Redactie-toegang voor afdelingsbeheerders</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Instructieworkshop voor uw redactieteam</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Viva Connections (intranet in Teams)</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Maandelijks onderhoud & doorontwikkeling</li>
                </ul>
                <a href="../contact.php" class="btn btn-geel p-cta">Vraag een offerte aan</a>
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
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Alles uit Standaard</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>5 of meer afdelingspagina's</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>3 huisstijlkleuren & uitgebreide branding</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Geavanceerd zoeken & projecthub</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Complexe rechtenstructuur</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Power Automate-integraties</li>
                    <li><span class="p-check"><svg width="24" height="24" aria-hidden="true"><use href="#check-small"/></svg></span>Teams-app, Viva Learning & Extranet</li>
                </ul>
                <a href="../contact.php" class="btn btn-dark p-cta">Plan een gesprek</a>
            </div>

        </div>
    </div>
</section>

<!-- COMPARISON -->
<section id="compare" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Vergelijken</span>
        <h2 >Wat zit er in <em>welk pakket</em>?</h2>
        <p class="lead" style="max-width: 680px;">
            Een volledig overzicht van onze drie proposities — zodat u in één oogopslag ziet welk pakket
            past bij uw organisatie.
        </p>

        <div class="compare-wrap">
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
                    <tr class="row-section"><td colspan="4">Inventarisatie & Ontwerp</td></tr>
                    <tr>
                        <td class="feat">Inventarisatiesessie</td>
                        <td class="tier has"><span class="tick">&#10003;</span> 1 sessie</td>
                        <td class="tier has"><span class="tick">&#10003;</span> 1 sessie</td>
                        <td class="tier has"><span class="tick">&#10003;</span> Meerdere sessies</td>
                    </tr>
                    <tr>
                        <td class="feat">Ontwerp & wireframes</td>
                        <td class="tier has">Basis-template</td>
                        <td class="tier has">Aangepast ontwerp</td>
                        <td class="tier has">Volledig op maat</td>
                    </tr>

                    <tr class="row-section"><td colspan="4">Indeling</td></tr>
                    <tr>
                        <td class="feat">Hoofdpagina met nieuws</td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Afdelingspagina's</td>
                        <td class="tier has">2</td>
                        <td class="tier has">3</td>
                        <td class="tier has">5+</td>
                    </tr>
                    <tr>
                        <td class="feat">Projecthub</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>

                    <tr class="row-section"><td colspan="4">Inrichting</td></tr>
                    <tr>
                        <td class="feat">Huisstijlkleuren</td>
                        <td class="tier has">2</td>
                        <td class="tier has">2</td>
                        <td class="tier has">3</td>
                    </tr>
                    <tr>
                        <td class="feat">Merkencenter & sjablonen</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Mediabibliotheek</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Geavanceerd zoeken</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>

                    <tr class="row-section"><td colspan="4">Rechten</td></tr>
                    <tr>
                        <td class="feat">Rechtenstructuur</td>
                        <td class="tier has">Basis</td>
                        <td class="tier has">Met redactie-toegang</td>
                        <td class="tier has">Complex / op maat</td>
                    </tr>

                    <tr class="row-section"><td colspan="4">Instructie & Adoptie</td></tr>
                    <tr>
                        <td class="feat">Online naslagwerk</td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Workshop voor redacteuren</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span> Uitgebreid</td>
                    </tr>

                    <tr class="row-section"><td colspan="4">Automatisering & Extra's</td></tr>
                    <tr>
                        <td class="feat">Power Automate-flows</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Viva Connections</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Viva Learning</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>
                    <tr>
                        <td class="feat">Teams-app & Extranet</td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier"><span class="dash">&mdash;</span></td>
                        <td class="tier has"><span class="tick">&#10003;</span></td>
                    </tr>

                    <tr class="row-section"><td colspan="4">Onderhoud & Support</td></tr>
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
<section id="proces" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Onze aanpak</span>
        <h2 >In <em>5 stappen</em> naar een werkend intranet</h2>
        <p class="lead" style="max-width: 680px;">
            Een gestructureerd traject met heldere mijlpalen — van eerste sessie tot live en daarna.
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
                <h4>Live & nazorg</h4>
                <p>Lancering met communicatieplan en — indien gekozen — doorlopend maandelijks onderhoud.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="section-alt">
    <div class="container">
        <span class="eyebrow"><span class="dot"></span>Veelgestelde vragen</span>
        <h2 >Wat u nog wil <em>weten</em></h2>
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
<section id="cta-final" class="section-alt">
    <div class="container">
        <h2>Klaar voor een centrale plek voor uw organisatie?</h2>
        <p>
            Plan een vrijblijvend kennismakingsgesprek van 30 minuten. Wij denken graag mee over welke
            propositie het beste past bij uw situatie — geheel zonder verplichtingen.
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



