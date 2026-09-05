<?php
$pageTitle = "Veilig opladen, Slimmer werken | Noppa";
$pageDesc = "Van USB-datablocker tot een veilige Copilot-implementatie. Noppa helpt organisaties bij fysieke databescherming én een verantwoorde AI-strategie met Microsoft Purview.";
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
            <span style="color: var(--wit);">Veilig opladen, Slimmer werken</span>
        </div>
        <div class="hero-eyebrow">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Security &amp; AI
        </div>
        <h1 class="hero-h1">Veilig opladen,<br><em>Slimmer werken</em></h1>
        <p class="hero-sub">
            Van USB-datablocker tot een veilige Copilot-implementatie. <strong>Wij helpen graag!</strong>
            Boek nu vrijblijvend een kennismakingsgesprek.
        </p>
        <div class="hero-btns">
            <a href="contact.php" class="btn btn-geel">Plan een kennismaking →</a>
        </div>
    </div>
</section>

<!-- COUNTER STRIP -->
<section class="counter-strip">
    <div class="container">
        <div class="counter-card">
            <div class="counter-block">
                <div class="counter-num pending" id="dblocker-counter" aria-live="polite">—</div>
                <div class="counter-lbl">QR-scans</div>
            </div>
            <div class="counter-sep" aria-hidden="true"></div>
            <div class="counter-text">
                Bezoekers via de <span>USB Datablocker</span> QR-code op je dB-stekker.
            </div>
        </div>
    </div>
</section>

<!-- CONTENT -->
<section class="content">
    <div class="container-narrow">

        <h2>Een opgeladen telefoon — zonder verrassingen</h2>
        <p>
            Even je telefoon opladen aan een openbare USB-poort? Handig, maar vaak niet zonder risico.
            Met onze <strong>USB Datablocker</strong> wél. Dit kleine tussenstukje blokkeert de datapinnen,
            waardoor alleen stroom wordt doorgegeven. Geen datalekken, geen ongewenste toegang —
            wel een opgeladen telefoon.
        </p>

        <p class="lead">Maar fysieke veiligheid is nog maar de basis.</p>

        <h2>AI brengt nieuwe vragen met zich mee</h2>
        <p>
            Met de komst van <strong>Microsoft Copilot</strong> verandert de manier waarop organisaties met data
            omgaan. AI maakt je productiever, maar ziet ook álles. Zonder goede grenzen kunnen documenten,
            persoonsgegevens of bedrijfsgeheimen ineens opduiken op plekken waar je ze niet wilt hebben.
        </p>

        <div class="pull-quote">
            Daar komt <em>Microsoft Purview</em> in beeld.
        </div>

        <h2>Grip houden in je Microsoft 365-omgeving</h2>
        <p>
            Waar de USB-datablocker de buitenwereld tegenhoudt, zorgt Purview voor grip
            <em>binnen</em> je Microsoft 365-omgeving:
        </p>
        <ul>
            <li><strong>Automatische dataclassificatie:</strong> Purview herkent en labelt gevoelige informatie.</li>
            <li><strong>Veilige inzet van Copilot:</strong> Je bepaalt precies welke data door AI gebruikt mag worden.</li>
            <li><strong>Voorkomen in plaats van genezen:</strong> Bescherm persoonsgegevens en bedrijfsinformatie voordat er iets misgaat.</li>
        </ul>

        <h2>Beide kanten goed afgedekt</h2>
        <p>
            Bij <strong>Noppa</strong> helpen we organisaties om beide kanten af te dekken:
            veilige hardware én een moderne AI-strategie die rust en controle brengt.
        </p>

    </div>
</section>

<!-- CTA -->
<section id="cta-final">
    <div class="container">
        <h2>Klaar om veilig én slimmer te werken?</h2>
        <p>
            Plan een vrijblijvend kennismakingsgesprek. Wij denken graag met u mee —
            van USB-datablocker tot een verantwoorde Copilot-implementatie met Microsoft Purview.
        </p>
        <a href="contact.php" class="btn btn-primary">
            Plan een kennismaking →
        </a>
    </div>
</section>

<script>
    (function() {
        var el = document.getElementById('dblocker-counter');
        if (!el) return;
        fetch('/api/dblocker-count.php', { cache: 'no-store' })
            .then(function(r) { return r.ok ? r.json() : null; })
            .then(function(data) {
                if (!data || typeof data.count !== 'number') return;
                try {
                    el.textContent = data.count.toLocaleString('nl-NL');
                } catch (e) {
                    el.textContent = String(data.count);
                }
                el.classList.remove('pending');
            })
            .catch(function() { /* stil falen — teller blijft op — */ });
    })();
</script>

<!-- FOOTER -->
<?php include $base . "partials/footer.php"; ?>
</body>
</html>



