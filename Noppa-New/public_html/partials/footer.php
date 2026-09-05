<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Kolom 1: brand + tagline -->
      <div>
        <div class="footer-brand">
          <div class="brand-mark"><img src="<?= $base ?>assets/logos/DEF_Logo_Noppa_wit.png" alt="Noppa"></div>
        </div>
        
        <p class="footer-tag">Solutions &amp; Consultants. We zetten je team in 4 weken aan de slag met Microsoft 365, Copilot en data die kloppen.</p>
      </div>

      <!-- Kolom 2: diensten -->
      <div>
        <h4>Diensten</h4>
        <ul>
          <li><a href="<?= $base ?>diensten.php">Copilot &amp; AI</a></li>
          <li><a href="<?= $base ?>visie.php">Onze visie</a></li>
          <li><a href="<?= $base ?>kennisbank/index.php">Kennisbank</a></li>
          <li><a href="<?= $base ?>veiligheid.php">Veiligheid &amp; Purview</a></li>
          <li><a href="<?= $base ?>index.php#aanpak">Aanpak</a></li>
        </ul>
      </div>

      <!-- Kolom 3: bedrijf -->
      <div>
        <h4>Noppa</h4>
        <ul>
          <li><a href="<?= $base ?>index.php#over">Over ons</a></li>
          <li><a href="<?= $base ?>team/rik-dobbelsteen.php">Over Rik</a></li>
          <li><a href="<?= $base ?>contact.php">Contact</a></li>
          <li><a href="<?= $base ?>index.php#pijlers">Werkwijze</a></li>
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
        <a href="<?= $base ?>algemene-voorwaarden.php">Voorwaarden</a>
        <span class="footer-sep">&middot;</span>
        <a href="javascript:void(0)" onclick="openCookieModal(event)">Cookie-instellingen</a>
        <span class="footer-sep">&middot;</span>
        <a href="#top">Terug naar boven &uarr;</a>
      </div>
    </div>
  </div>
</footer>

<!-- COOKIE BANNER -->
<aside class="cookie-banner" id="cookieBanner" role="dialog" aria-label="Cookiemelding" aria-live="polite">
  <div class="cookie-banner-inner">
    <div class="cookie-text">
      <div class="cookie-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color:var(--royal);display:inline;vertical-align:-3px;margin-right:6px">
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

<script>
  (function() {
    /* ── Thema Switcher Logic ── */
    function initTheme() {
      var saved = localStorage.getItem('noppa-theme') || 'auto';
      updateThemeUI(saved);

      document.querySelectorAll('#themeSwitcher .theme-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var val = this.getAttribute('data-theme-val');
          setTheme(val);
        });
      });
    }

    function setTheme(val) {
      if (val === 'dark' || val === 'light') {
        document.documentElement.setAttribute('data-theme', val);
        localStorage.setItem('noppa-theme', val);
      } else {
        document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('noppa-theme', 'auto');
      }
      updateThemeUI(val);
    }

    function updateThemeUI(val) {
      document.querySelectorAll('#themeSwitcher .theme-btn').forEach(function(btn) {
        var isMatch = btn.getAttribute('data-theme-val') === val;
        btn.classList.toggle('active', isMatch);
        btn.setAttribute('aria-pressed', isMatch ? 'true' : 'false');
      });
    }

    /* ── Mobile Navigation Drawer ── */
    function initMobileNav() {
      var toggle = document.getElementById('navToggle');
      var nav = document.getElementById('mobileNav');
      if (!toggle || !nav) return;

      function setOpen(open) {
        if (open) {
          nav.removeAttribute('hidden');
          nav.classList.add('is-open');
          toggle.classList.add('active');
          toggle.setAttribute('aria-expanded', 'true');
          toggle.setAttribute('aria-label', 'Menu sluiten');
        } else {
          nav.setAttribute('hidden', '');
          nav.classList.remove('is-open');
          toggle.classList.remove('active');
          toggle.setAttribute('aria-expanded', 'false');
          toggle.setAttribute('aria-label', 'Menu openen');
        }
      }

      toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = nav.classList.contains('is-open');
        setOpen(!isOpen);
      });

      nav.querySelectorAll('a').forEach(function(a) {
        a.addEventListener('click', function() {
          setOpen(false);
        });
      });

      document.addEventListener('click', function(e) {
        var header = document.querySelector('header.nav');
        if (header && !header.contains(e.target)) {
          setOpen(false);
        }
      });

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          setOpen(false);
          window.closeCookieModal();
        }
      });
    }

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
      closeCookieModal();
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
      if (e) e.preventDefault();
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
      document.addEventListener('DOMContentLoaded', function() {
        initTheme();
        initMobileNav();
        initCookies();
      });
    } else {
      initTheme();
      initMobileNav();
      initCookies();
    }
  })();
</script>
