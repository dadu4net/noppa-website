<?php
$pageTitle = "Contact | Noppa Solutions &amp; Consultants";
$pageDesc = "Plan een kennismaking met Noppa — Microsoft 365, Copilot en data-consultancy in Berlicum. Boek online of bel direct.";
$base = "";
include $base . "partials/header.php";
?>

<!-- NAV: bewerk partials/nav.html om het menu aan te passen -->
<?php include $base . "partials/nav.php"; ?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="index.php">Home</a><span class="sep">›</span><span style="color:#fff">Contact</span>
    </div>
    <div class="hero-eyebrow">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
      Kennismaken
    </div>
    <h1>Plan direct een <em>kennismaking</em></h1>
    <p class="hero-sub">Een vrijblijvend gesprek van 30 minuten — online of bij jou op locatie. Kies hieronder een moment dat uitkomt en je krijgt direct een bevestiging.</p>
  </div>
</section>

<!-- INFO STRIP -->
<section class="info-strip">
  <div class="container">
    <div class="info-grid">
      <div class="info-card">
        <span class="ic-label">Adres</span>
        <span class="ic-value">Pijlkruid 44<br>5258 BW Berlicum</span>
      </div>
      <div class="info-card">
        <span class="ic-label">Telefoon</span>
        <span class="ic-value"><a href="tel:+31613357723">+31 6 13 35 77 23</a></span>
      </div>
      <div class="info-card">
        <span class="ic-label">E-mail</span>
        <span class="ic-value"><a href="mailto:rik@noppa.nl">rik@noppa.nl</a></span>
      </div>
      <div class="info-card">
        <span class="ic-label">Website</span>
        <span class="ic-value"><a href="https://www.noppa.nl">www.noppa.nl</a></span>
      </div>
    </div>
  </div>
</section>

<!-- BOOKING -->
<section class="booking" id="booking">
  <div class="container-narrow">
    <div class="booking-head">
      <span class="sec-eyebrow">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Online agenda
      </span>
      <h2>Boek je gesprek direct in</h2>
      <p>Selecteer een datum en tijd in de agenda. Je ontvangt direct een bevestiging per mail met een Teams-link voor het gesprek.</p>
    </div>

    <p class="booking-fallback">
      Werkt de agenda niet? Open de boekingspagina <a href="mailto:rik@noppa.nl?subject=Kennismaking%20Noppa" target="_blank" rel="noopener">via e-mail</a>.
    </p>

    <div class="booking-frame-wrap">
      <iframe
        src="https://outlook.office.com/book/Algemeen@noppa.nl/?ismsaljsauthenabled"
        width="100%" height="100%" scrolling="yes" style="border:0"
        title="Noppa — boek een afspraak"
        loading="lazy"></iframe>
    </div>
  </div>
</section>

<!-- ALT CONTACT -->
<section class="alt-contact">
  <div class="container">
    <div class="alt-grid">
      <div>
        <span class="caption" style="color:var(--cyan)">Direct contact</span>
        <h2 style="margin-top:14px">Liever <em>direct</em> contact?</h2>
        <p>Korte vraag, of liever even bellen? Geen probleem. Mail, bel of stuur een bericht via LinkedIn — je krijgt doorgaans dezelfde werkdag reactie.</p>
        <div class="alt-buttons">
          <a href="mailto:rik@noppa.nl" class="btn btn-accent">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            Mail ons
          </a>
          <a href="tel:+31613357723" class="btn btn-ghost-dark">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.37 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.33 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
            Bel ons
          </a>
        </div>
      </div>

      <div class="map-card">
        <h3>Onze gegevens</h3>
        <div class="map-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <div>
            <div class="mr-lbl">Adres</div>
            <div class="mr-val">Pijlkruid 44<br>5258 BW Berlicum</div>
          </div>
        </div>
        <div class="map-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.37 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.33 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
          <div>
            <div class="mr-lbl">Telefoon</div>
            <div class="mr-val"><a href="tel:+31613357723">+31 6 13 35 77 23</a></div>
          </div>
        </div>
        <div class="map-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <div>
            <div class="mr-lbl">E-mail</div>
            <div class="mr-val"><a href="mailto:rik@noppa.nl">rik@noppa.nl</a></div>
          </div>
        </div>
        <div class="map-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 010 20M12 2a15 15 0 000 20"/></svg>
          <div>
            <div class="mr-lbl">Website</div>
            <div class="mr-val"><a href="https://www.noppa.nl">www.noppa.nl</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER: bewerk partials/footer.html om de footer aan te passen -->
<?php include $base . "partials/footer.php"; ?>


</body>
</html>


