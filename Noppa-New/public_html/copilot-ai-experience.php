<?php
$pageTitle = "Copilot AI Experience | Noppa";
$pageDesc = "Ontdek de kracht van AI in jouw organisatie. In de Copilot AI Experience van Noppa verken je in 3 maanden samen met collega's hoe Microsoft Copilot je werk versterkt, versnelt en verbetert.";
$base = "";
include $base . "partials/header.php";
?>

<!-- NAV -->
<?php include $base . "partials/nav.php"; ?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>›</span>
            <span style="color: var(--wit);">Copilot AI Experience</span>
        </div>
        <div class="hero-eyebrow">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/><circle cx="12" cy="12" r="5"/></svg>
            Copilot Experience
        </div>
        <h1 class="hero-h1">Ontdek de kracht van AI in <em>jouw organisatie</em></h1>
        <p class="hero-sub">
            Start vandaag met <strong>dé Copilot Experience</strong>. In een kort en krachtig
            traject verken jij samen met collega's hoe Microsoft Copilot je werk versterkt,
            versnelt en verbetert.
        </p>
        <div class="hero-btns">
            <a href="contact.php" class="btn btn-geel">📅 Book een intake →</a>
            <a href="contact.php" class="btn btn-ghost">📧 Neem contact op</a>
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
            In een kort en krachtig traject verken jij samen met collega's hoe Microsoft Copilot (AI)
            jullie gaat <strong>versterken, versnellen en verbeteren</strong>. Geen abstracte theorie,
            maar concrete experimenten in jullie eigen werkomgeving — met écht resultaat aan het
            eind van de rit.
        </p>

        <h2>Wat levert het op?</h2>
        <ul class="benefits">
            <li><strong>Inzicht in AI-mogelijkheden</strong> vanuit jouw specifieke context.</li>
            <li><strong>Hands-on ervaring</strong> met AI in de praktijk.</li>
            <li><strong>Snel draagvlak en enthousiasme</strong> binnen jouw team en organisatie.</li>
            <li><strong>Een concrete eerste stap</strong> met tastbare resultaten.</li>
            <li><strong>Een nieuwe manier van werken</strong> die blijft hangen.</li>
        </ul>

        <h2>Voor wie?</h2>
        <div class="audience-card">
            <div class="ico">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg>
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
<section class="counter-strip" id="copilotCounter" aria-hidden="true">
    <div class="container">
        <div class="counter-card">
            <div class="counter-block">
                <div class="counter-badge">Admin</div>
                <div class="counter-num" id="copilotCount">—</div>
                <div class="counter-lbl">Paginabezoeken</div>
            </div>
            <div class="counter-sep" aria-hidden="true"></div>
            <div class="counter-block">
                <div class="counter-num" id="copilotToday" style="font-size: 1.4rem;">—</div>
                <div class="counter-lbl">Vandaag</div>
            </div>
            <div class="counter-sep" aria-hidden="true"></div>
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
        <h2>🚀 Klaar om de eerste stap te zetten?</h2>
        <p>
            Boek een intake en ontdek wat Copilot AI voor jou gaat betekenen.
            We denken graag met je mee — vrijblijvend en in mensentaal.
        </p>
        <a href="contact.php" class="btn btn-primary">
            📅 Book een intake →
        </a>
    </div>
</section>

<script>
    /* ---------- Visit beacon + admin counter --------------------------- */
    /*  Elke pagina-load roept /api/copilot-ai-visit.php aan.
        - Server registreert het bezoek (atomair, met bot-filter).
        - Server kijkt of het IP in de allowlist staat en stuurt alleen
          dan de teller mee. Voor reguliere bezoekers blijft de strip
          onzichtbaar (display:none + aria-hidden=true).               */
    (function() {
        fetch('/api/copilot-ai-visit.php', { cache: 'no-store', credentials: 'same-origin' })
            .then(function(r) { return r.ok ? r.json() : null; })
            .then(function(data) {
                if (!data || !data.admin) return;
                var strip  = document.getElementById('copilotCounter');
                var total  = document.getElementById('copilotCount');
                var today  = document.getElementById('copilotToday');
                if (!strip || !total) return;
                try {
                    total.textContent = (data.count || 0).toLocaleString('nl-NL');
                    today.textContent = (data.today || 0).toLocaleString('nl-NL');
                } catch (e) {
                    total.textContent = String(data.count || 0);
                    today.textContent = String(data.today || 0);
                }
                strip.classList.add('visible');
                strip.setAttribute('aria-hidden', 'false');
            })
            .catch(function() { /* stil falen — counter blijft verborgen */ });
    })();
</script>

<!-- FOOTER -->
<?php include $base . "partials/footer.php"; ?>
</body>
</html>



