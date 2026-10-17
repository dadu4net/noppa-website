/* =========================================================================
 * Noppa Solutions & Consultants — site.js
 * Standardized according to:
 * - noppa-website-navigation
 * - noppa-website-mobile
 * - noppa-website-cookie
 * - noppa-ux-ui
 * ========================================================================= */

(function () {
    'use strict';

    /* ---------- 1. Theme Switcher Engine --------------------------------- */
    function getSystemTheme() {
        return (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
    }

    function applyTheme(val) {
        var preference = val || 'auto';
        var effective = preference;
        if (preference === 'auto') {
            effective = getSystemTheme();
        }
        document.documentElement.setAttribute('data-theme', effective);
        try {
            localStorage.setItem('noppa-theme', preference);
        } catch(e) {}
        updateThemeUI(preference);
    }

    function updateThemeUI(val) {
        document.querySelectorAll('#themeSwitcher .theme-btn').forEach(function (btn) {
            var btnVal = btn.getAttribute('data-theme-val');
            var isMatch = (btnVal === val);
            btn.classList.toggle('active', isMatch);
            btn.setAttribute('aria-pressed', isMatch ? 'true' : 'false');
        });
    }

    function initTheme() {
        var saved = 'auto';
        try {
            saved = localStorage.getItem('noppa-theme') || 'auto';
        } catch(e) {}
        applyTheme(saved);

        document.querySelectorAll('#themeSwitcher .theme-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var val = this.getAttribute('data-theme-val');
                applyTheme(val);
            });
        });

        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
                var currentSaved = 'auto';
                try {
                    currentSaved = localStorage.getItem('noppa-theme') || 'auto';
                } catch(err) {}
                if (currentSaved === 'auto') {
                    document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
                }
            });
        }
    }

    /* ---------- 2. Navigation & Mobile Drawer (noppa-website-navigation) - */
    function wireNav() {
        var toggle = document.getElementById('navToggle');
        var mobileNav = document.getElementById('mobileNav');
        var mobClose = document.getElementById('mobClose');
        var mobBackdrop = document.getElementById('mobBackdrop');

        function setOpen(open) {
            if (!mobileNav) return;
            if (open) {
                mobileNav.removeAttribute('hidden');
                mobileNav.setAttribute('aria-hidden', 'false');
                mobileNav.classList.add('is-open', 'open');
                if (toggle) {
                    toggle.setAttribute('aria-expanded', 'true');
                    toggle.setAttribute('aria-label', 'Menu sluiten');
                }
                document.body.style.overflow = 'hidden';
            } else {
                mobileNav.setAttribute('hidden', '');
                mobileNav.setAttribute('aria-hidden', 'true');
                mobileNav.classList.remove('is-open', 'open');
                if (toggle) {
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.setAttribute('aria-label', 'Menu openen');
                }
                document.body.style.overflow = '';
            }
        }

        if (toggle) {
            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                var isOpen = mobileNav && (mobileNav.classList.contains('is-open') || mobileNav.classList.contains('open'));
                setOpen(!isOpen);
            });
        }

        if (mobClose) {
            mobClose.addEventListener('click', function () {
                setOpen(false);
            });
        }

        if (mobBackdrop) {
            mobBackdrop.addEventListener('click', function () {
                setOpen(false);
            });
        }

        if (mobileNav) {
            mobileNav.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () {
                    setOpen(false);
                });
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                setOpen(false);
                closeCookieModal();
            }
        });
    }

    /* ---------- 3. Cookie Consent Management (noppa-website-cookie) ------ */
    var COOKIE_KEY = 'noppa-cookie-consent';
    var memoryConsent = null;

    function getCookieConsent() {
        if (memoryConsent) return memoryConsent;
        try {
            var raw = localStorage.getItem(COOKIE_KEY);
            if (raw) {
                memoryConsent = JSON.parse(raw);
                return memoryConsent;
            }
        } catch(e) {}
        return null;
    }

    function saveCookieConsent(consent) {
        memoryConsent = consent;
        try {
            localStorage.setItem(COOKIE_KEY, JSON.stringify(consent));
        } catch(e) {}
        applyCookieConsent(consent);
    }

    function applyCookieConsent(consent) {
        var banner = document.getElementById('cookieBanner');
        if (banner) {
            banner.setAttribute('hidden', '');
            banner.style.display = 'none';
        }
        closeCookieModal();

        // Als analytische cookies zijn toegestaan, activeer scripts met data-cookie-category="analytics"
        if (consent && consent.analytics) {
            document.querySelectorAll('script[data-cookie-category="analytics"]').forEach(function(s) {
                if (s.type === 'text/plain') {
                    var newScript = document.createElement('script');
                    Array.from(s.attributes).forEach(function(attr) {
                        if (attr.name !== 'type') newScript.setAttribute(attr.name, attr.value);
                    });
                    newScript.appendChild(document.createTextNode(s.innerHTML));
                    s.parentNode.replaceChild(newScript, s);
                }
            });
        }
    }

    function openCookieModal() {
        var modalBackdrop = document.getElementById('cookieModalBackdrop');
        if (modalBackdrop) {
            modalBackdrop.removeAttribute('hidden');
            modalBackdrop.classList.remove('is-hidden');
            modalBackdrop.style.display = 'flex';
            var chkAnalytics = document.getElementById('cookieAnalytics');
            var chkMarketing = document.getElementById('cookieMarketing');
            var consent = getCookieConsent();
            if (chkAnalytics) chkAnalytics.checked = consent ? !!consent.analytics : true;
            if (chkMarketing) chkMarketing.checked = consent ? !!consent.marketing : false;
        }
    }

    function closeCookieModal() {
        var modalBackdrop = document.getElementById('cookieModalBackdrop');
        if (modalBackdrop) {
            modalBackdrop.setAttribute('hidden', '');
            modalBackdrop.classList.add('is-hidden');
            modalBackdrop.style.display = 'none';
        }
    }

    function wireCookies() {
        var banner = document.getElementById('cookieBanner');
        var modalBackdrop = document.getElementById('cookieModalBackdrop');
        var btnAcceptAll = document.getElementById('btnCookieAcceptAll');
        var btnReject = document.getElementById('btnCookieReject');
        var btnCustomize = document.getElementById('btnCookieCustomize');
        var btnCloseModal = document.getElementById('btnCloseCookieModal');
        var btnSavePrefs = document.getElementById('btnSaveCookiePreferences');
        var btnModalAccept = document.getElementById('btnModalAcceptAll');
        var chkAnalytics = document.getElementById('cookieAnalytics');
        var chkMarketing = document.getElementById('cookieMarketing');

        // Modal altijd initieel sluiten
        closeCookieModal();

        var consent = getCookieConsent();
        if (!consent) {
            if (banner) {
                banner.removeAttribute('hidden');
                banner.style.display = 'block';
            }
        } else {
            applyCookieConsent(consent);
        }

        if (btnAcceptAll) {
            btnAcceptAll.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                saveCookieConsent({ essential: true, analytics: true, marketing: true, timestamp: Date.now() });
            });
        }

        if (btnReject) {
            btnReject.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                saveCookieConsent({ essential: true, analytics: false, marketing: false, timestamp: Date.now() });
            });
        }

        if (btnCustomize) {
            btnCustomize.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openCookieModal();
            });
        }

        if (btnCloseModal) {
            btnCloseModal.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeCookieModal();
            });
        }

        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', function(e) {
                if (e.target === modalBackdrop) {
                    closeCookieModal();
                }
            });
        }

        if (btnSavePrefs) {
            btnSavePrefs.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var c = {
                    essential: true,
                    analytics: chkAnalytics ? chkAnalytics.checked : false,
                    marketing: chkMarketing ? chkMarketing.checked : false,
                    timestamp: Date.now()
                };
                saveCookieConsent(c);
            });
        }

        if (btnModalAccept) {
            btnModalAccept.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                saveCookieConsent({ essential: true, analytics: true, marketing: true, timestamp: Date.now() });
            });
        }
    }

    // Exposeer openCookieSettings globaal voor links in de footer of content
    window.openCookieSettings = openCookieModal;
    window.closeCookieModal = closeCookieModal;

    /* ---------- 4. Boot --------------------------------------------------- */
    function boot() {
        initTheme();
        wireNav();
        wireCookies();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
