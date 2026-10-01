/* =========================================================================
 * Noppa Solutions & Consultants — site.js
 * Centralised navigation, theme switcher, and cookie consent engine.
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

        // Listen for OS preference changes when in 'auto' mode
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
        var toggle = document.getElementById('navToggle') || document.getElementById('hamburger');
        var mobileNav = document.getElementById('mobileNav') || document.getElementById('mobMenu');
        var mobClose = document.getElementById('mobClose');
        var navbar = document.getElementById('navbar') || document.querySelector('header.nav');

        function setOpen(open) {
            if (!mobileNav) return;
            if (open) {
                mobileNav.removeAttribute('hidden');
                mobileNav.classList.add('is-open', 'open');
                if (toggle) {
                    toggle.classList.add('active');
                    toggle.setAttribute('aria-expanded', 'true');
                    toggle.setAttribute('aria-label', 'Menu sluiten');
                }
                document.body.style.overflow = 'hidden';
            } else {
                mobileNav.setAttribute('hidden', '');
                mobileNav.classList.remove('is-open', 'open');
                if (toggle) {
                    toggle.classList.remove('active');
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

        if (mobileNav) {
            mobileNav.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () {
                    setOpen(false);
                });
            });
        }

        document.addEventListener('click', function (e) {
            if (navbar && !navbar.contains(e.target) && mobileNav && !mobileNav.contains(e.target)) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                setOpen(false);
                if (typeof window.closeCookieModal === 'function') {
                    window.closeCookieModal();
                }
            }
        });

        // Active link highlighting
        var currentPath = window.location.pathname;
        var currentLeaf = currentPath.split('/').pop() || 'index.php';
        var currentHash = window.location.hash;
        document.querySelectorAll('nav.desktop-nav a, #navbar .nav-links a, .mobile-nav a, .mob-menu a').forEach(function (a) {
            var href = a.getAttribute('href') || '';
            var bare = href.replace(/^(\.\.\/)+/, '').replace(/^\.\//, '');
            if (currentHash && (bare === currentLeaf + currentHash || bare === currentHash)) {
                a.classList.add('active');
            } else if (!currentHash && bare === currentLeaf) {
                a.classList.add('active');
            } else if ((currentLeaf === '' || currentLeaf === 'index.php') && (bare === 'index.php' || bare === '')) {
                a.classList.add('active');
            }
        });
    }

    /* ---------- 3. Boot --------------------------------------------------- */
    function boot() {
        initTheme();
        wireNav();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
