<?php
$base          = $base ?? ($base_path ?? '');
$extra_scripts = $extra_scripts ?? '';
?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Kolom 1: brand + tagline -->
      <div>
        <div class="footer-brand">
          <div class="brand-mark"><img src="<?= $base ?>assets/images/DEF_Logo_Noppa_wit.png" alt="Noppa Solutions &amp; Consultants"></div>
        </div>
        <p class="footer-tag">Solutions &amp; Consultants. Grip op Microsoft 365, een veilige Copilot en adoptie die écht landt. Binnen vier weken van nul naar een veilig en getraind team.</p>
      </div>

      <!-- Kolom 2: diensten -->
      <div>
        <h4>Diensten</h4>
        <ul>
          <li><a href="<?= $base ?>diensten/ai-copilot.php">Copilot Readiness &amp; Security</a></li>
          <li><a href="<?= $base ?>diensten/workshops-trainingen.php">Workshops &amp; Prompt Training</a></li>
          <li><a href="<?= $base ?>diensten/adoptie-begeleiding.php">M365 Adoptie &amp; Begeleiding</a></li>
          <li><a href="<?= $base ?>diensten/processen-portalen.php">Processen &amp; Portalen</a></li>
          <li><a href="<?= $base ?>diensten/copilot-plannen.php">Copilot Plannen</a></li>
        </ul>
      </div>

      <!-- Kolom 3: bedrijf -->
      <div>
        <h4>Noppa</h4>
        <ul>
          <li><a href="<?= $base ?>index.php#waarom">Waarom Noppa</a></li>
          <li><a href="<?= $base ?>visie/productiviteit.php">Onze Visie</a></li>
          <li><a href="<?= $base ?>kennisbank/index.php">Kennisbank</a></li>
          <li><a href="<?= $base ?>team/rik-dobbelsteen.php">Over Rik</a></li>
          <li><a href="<?= $base ?>contact.php">Contact</a></li>
        </ul>
      </div>

      <!-- Kolom 4: contact -->
      <div>
        <h4>Contact</h4>
        <ul>
          <li>Pijlkruid 44</li>
          <li>5258 BW Berlicum</li>
          <li><a href="tel:+31613357723">06-13 35 77 23</a></li>
          <li><a href="mailto:rik@noppa.nl">rik@noppa.nl</a></li>
        </ul>
      </div>

    </div>
    <div class="footer-bottom">
      <div>&copy; <?= date("Y") ?> Noppa Solutions &amp; Consultants &mdash; Alle rechten voorbehouden</div>
      <div class="footer-links">
        <a href="<?= $base ?>privacy-policy.php">Privacy Policy</a>
        <span class="footer-sep">&middot;</span>
        <a href="<?= $base ?>algemene-voorwaarden.php">Algemene Voorwaarden</a>
        <span class="footer-sep">&middot;</span>
        <a href="javascript:void(0)" onclick="openCookieModal(event)">Cookie-instellingen</a>
        <span class="footer-sep">&middot;</span>
        <a href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;">Terug naar boven &uarr;</a>
      </div>
    </div>
  </div>
</footer>

<!-- COOKIE BANNER -->
<aside class="cookie-banner" id="cookieBanner" role="dialog" aria-label="Cookiemelding" aria-live="polite">
  <div class="cookie-banner-inner">
    <div class="cookie-text">
      <div class="cookie-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color:var(--royal, #2060e0);display:inline;vertical-align:-3px;margin-right:6px">
          <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"></path>
          <path d="M8.5 8.5v.01"></path>
          <path d="M7.5 15.5v.01"></path>
          <path d="M12 18v.01"></path>
          <path d="M11 13v.01"></path>
          <path d="M16 13v.01"></path>
        </svg>
        <strong>Wij hechten waarde aan uw privacy</strong>
      </div>
      <p>
        Noppa Solutions &amp; Consultants gebruikt noodzakelijke functionele cookies om de website betrouwbaar en veilig te laten werken (zoals formulierbeveiliging en themavoorkeuren). Met uw toestemming gebruiken we ook geanonimiseerde analytische cookies om het functioneren en de gebruiksvriendelijkheid van onze website continu te verbeteren. Wij verkopen uw gegevens nooit aan derden. Lees meer in onze <a href="<?= $base ?>privacy-policy.php">Privacy Policy</a>.
      </p>
    </div>
    <div class="cookie-actions">
      <button type="button" class="btn btn-primary cookie-btn-accept" id="cookieAcceptAll">Alles accepteren</button>
      <button type="button" class="btn btn-ghost cookie-btn-decline" id="cookieDeclineAll">Alleen noodzakelijk</button>
      <button type="button" class="cookie-btn-link" id="cookieOpenSettings">Voorkeuren instellen</button>
    </div>
  </div>
</aside>

<!-- COOKIE PREFERENCES MODAL -->
<div class="modal-backdrop" id="cookieModal" role="dialog" aria-modal="true" aria-labelledby="cookieModalTitle">
  <div class="modal cookie-modal">
    <div class="cookie-modal-header">
      <h3 id="cookieModalTitle">Cookie-instellingen beheren</h3>
      <button type="button" class="modal-close-icon" onclick="closeCookieModal()" aria-label="Sluiten">&times;</button>
    </div>
    <p class="cookie-modal-desc">
      Bepaal welke categorieën cookies u toestaat. U kunt uw keuze op elk gewenst moment aanpassen via de link 'Cookie-instellingen' in de footer.
    </p>
    
    <div class="cookie-categories">
      <!-- Noodzakelijk -->
      <div class="cookie-cat-card">
        <div class="cookie-cat-head">
          <div>
            <strong>Noodzakelijk &amp; Functioneel</strong>
            <span class="cookie-badge-locked">Altijd actief</span>
          </div>
          <label class="cookie-switch">
            <input type="checkbox" checked disabled aria-label="Noodzakelijke cookies altijd actief">
            <span class="cookie-slider" style="opacity:.6;cursor:not-allowed"></span>
          </label>
        </div>
        <p class="cookie-cat-desc">
          Essentieel voor de basisfunctionaliteit van de website, zoals beveiligde formulierinzendingen, sessiebeveiliging en het onthouden van uw themavoorkeur (automatisch/licht/donker). Deze cookies slaan geen direct herleidbare persoonsgegevens op.
        </p>
      </div>

      <!-- Analytisch -->
      <div class="cookie-cat-card">
        <div class="cookie-cat-head">
          <div>
            <strong>Analytisch &amp; Prestaties</strong>
            <span class="cookie-badge-opt">Optioneel</span>
          </div>
          <label class="cookie-switch">
            <input type="checkbox" id="cookieAnalyticsToggle" checked>
            <span class="cookie-slider"></span>
          </label>
        </div>
        <p class="cookie-cat-desc">
          Helpt ons inzicht te krijgen in het bezoek en de paginaprestaties (via geanonimiseerde statistieken en analyses). Hiermee optimaliseren we de navigatie, leessnelheid en relevantie van onze artikelen.
        </p>
      </div>
    </div>

    <div class="cookie-modal-footer">
      <a href="<?= $base ?>privacy-policy.php" class="cookie-privacy-link">Privacy Policy bekijken &rarr;</a>
      <div class="cookie-modal-actions">
        <button type="button" class="btn btn-ghost" id="cookieSavePreferences">Selectie opslaan</button>
        <button type="button" class="btn btn-primary" id="cookieModalAcceptAll">Alles accepteren</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= $base ?>assets/js/site.js"></script>
<script>
  (function() {
    /* ── Cookie Consent Management ── */
    var COOKIE_KEY = 'noppa-cookie-consent';

    function getConsent() {
      try {
        var val = localStorage.getItem(COOKIE_KEY);
        return val ? JSON.parse(val) : null;
      } catch(e) {
        return null;
      }
    }

    function saveConsent(analytics) {
      var consent = {
        necessary: true,
        analytics: !!analytics,
        timestamp: new Date().toISOString()
      };
      try {
        localStorage.setItem(COOKIE_KEY, JSON.stringify(consent));
      } catch(e) {}
      hideBanner();
      window.closeCookieModal();
    }

    function showBanner() {
      var b = document.getElementById('cookieBanner');
      if (b) b.classList.add('show');
    }

    function hideBanner() {
      var b = document.getElementById('cookieBanner');
      if (b) b.classList.remove('show');
    }

    window.openCookieModal = function(e) {
      if (e && e.preventDefault) e.preventDefault();
      var m = document.getElementById('cookieModal');
      var consent = getConsent();
      var toggle = document.getElementById('cookieAnalyticsToggle');
      if (toggle) {
        toggle.checked = consent ? consent.analytics : true;
      }
      if (m) {
        m.removeAttribute('hidden');
        m.classList.add('open');
        m.classList.add('show');
        document.body.style.overflow = 'hidden';
      }
    };

    window.closeCookieModal = function() {
      var m = document.getElementById('cookieModal');
      if (m) {
        m.classList.remove('open');
        m.classList.remove('show');
        document.body.style.overflow = '';
      }
    };

    function initCookies() {
      var consent = getConsent();
      if (!consent) {
        setTimeout(showBanner, 500);
      }

      var acceptAll = document.getElementById('cookieAcceptAll');
      if (acceptAll) {
        acceptAll.addEventListener('click', function() { saveConsent(true); });
      }

      var declineAll = document.getElementById('cookieDeclineAll');
      if (declineAll) {
        declineAll.addEventListener('click', function() { saveConsent(false); });
      }

      var openSettings = document.getElementById('cookieOpenSettings');
      if (openSettings) {
        openSettings.addEventListener('click', function(e) {
          e.preventDefault();
          window.openCookieModal();
        });
      }

      var modalAcceptAll = document.getElementById('cookieModalAcceptAll');
      if (modalAcceptAll) {
        modalAcceptAll.addEventListener('click', function() { saveConsent(true); });
      }

      var savePrefs = document.getElementById('cookieSavePreferences');
      if (savePrefs) {
        savePrefs.addEventListener('click', function() {
          var toggle = document.getElementById('cookieAnalyticsToggle');
          var isAnalytics = toggle ? toggle.checked : false;
          saveConsent(isAnalytics);
        });
      }

      var modalBackdrop = document.getElementById('cookieModal');
      if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function(e) {
          if (e.target === modalBackdrop) window.closeCookieModal();
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initCookies);
    } else {
      initCookies();
    }
  })();
</script>
<?= $extra_scripts ?>
</body>
</html>
