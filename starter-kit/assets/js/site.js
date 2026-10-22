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
            // Sluit drawer bij klikken op daadwerkelijke link (niet toggle buttons)
            mobileNav.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () {
                    setOpen(false);
                });
            });

            // 3-Laags Mobile Accordion Toggles (Laag 1 -> Laag 2)
            mobileNav.querySelectorAll('.mobile-nav-toggle').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var item = btn.closest('.mobile-nav-item');
                    if (!item) return;
                    var sublist = item.querySelector('.mobile-mega-group') || item.querySelector('.mobile-subnav-list');
                    var isExpanded = item.classList.toggle('is-expanded');
                    btn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
                    if (sublist) {
                        sublist.style.display = isExpanded ? '' : 'none';
                    }
                });
            });

            // 3-Laags Mobile Accordion Toggles (Laag 2 -> Laag 3)
            mobileNav.querySelectorAll('.mobile-subcat-toggle, .mobile-subnav-toggle').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var card = btn.closest('.mobile-category-card');
                    if (card) {
                        var isCollapsed = card.classList.toggle('is-collapsed');
                        btn.setAttribute('aria-expanded', isCollapsed ? 'false' : 'true');
                        return;
                    }
                    var item = btn.closest('.mobile-subnav-item');
                    if (!item) return;
                    var subsublist = item.querySelector('.mobile-sub-subnav-list');
                    var isExpanded = item.classList.toggle('is-expanded');
                    btn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
                    if (subsublist) {
                        subsublist.style.display = isExpanded ? '' : 'none';
                    }
                });
            });
        }

        // Desktop Dropdown Sub-toggles (Laag 2 -> Laag 3 verticaal inklappen/uitklappen)
        document.querySelectorAll('.dropdown-sub-toggle').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var group = btn.closest('.dropdown-group');
                if (!group) return;
                var isCollapsed = group.classList.toggle('is-collapsed');
                btn.setAttribute('aria-expanded', isCollapsed ? 'false' : 'true');
            });
        });

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

    /* ---------- 4. Scroll Reveal Engine (noppa-ux-ui) --------------------- */
    function initScrollReveal() {
        var reveals = document.querySelectorAll('.reveal');
        if (!reveals.length) return;

        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) {
                        e.target.classList.add('in');
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

            reveals.forEach(function (el) { io.observe(el); });
        } else {
            reveals.forEach(function (el) { el.classList.add('in'); });
        }
    }

    /* ---------- 5. Animated Number Counters ------------------------------ */
    function initNumberCounters() {
        var counters = document.querySelectorAll('[data-counter], .stat-value.tabular-nums, .hero-stat .num');
        if (!counters.length) return;

        // Controleer op voorkeur voor minder beweging
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        var countObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    countObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        counters.forEach(function (el) {
            // Als er nog geen data-counter attribuut is, probeer numerieke waarde te extraheren
            if (!el.hasAttribute('data-counter')) {
                var text = el.textContent.trim();
                // Match bijv. "300+", "100%", "€ 1.850", "4 uur", "85%"
                var numMatch = text.match(/([0-9]+(?:\.[0-9]+)?)/);
                if (numMatch) {
                    var rawVal = numMatch[1];
                    var num = parseFloat(rawVal.replace(/\./g, ''));
                    if (!isNaN(num) && num > 0) {
                        el.setAttribute('data-counter', num);
                        var parts = text.split(rawVal);
                        if (parts[0]) el.setAttribute('data-prefix', parts[0]);
                        if (parts[1]) el.setAttribute('data-suffix', parts[1]);
                    }
                }
            }

            if (el.hasAttribute('data-counter')) {
                countObserver.observe(el);
            }
        });
    }

    function animateCounter(el) {
        var target = parseFloat(el.getAttribute('data-counter'));
        var prefix = el.getAttribute('data-prefix') || '';
        var suffix = el.getAttribute('data-suffix') || '';
        var duration = parseInt(el.getAttribute('data-duration') || '1600', 10);
        var startTime = null;

        function step(now) {
            if (!startTime) startTime = now;
            var elapsed = now - startTime;
            var progress = Math.min(elapsed / duration, 1);
            // Easing: easeOutCubic
            var easeOut = 1 - Math.pow(1 - progress, 3);
            var currentVal = Math.floor(easeOut * target);

            el.textContent = prefix + currentVal.toLocaleString('nl-NL') + suffix;

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                el.textContent = prefix + target.toLocaleString('nl-NL') + suffix;
            }
        }
        window.requestAnimationFrame(step);
    }

    /* ---------- 6. Pinned Horizontal Scroll Engine (De 3 Pilaren) ---------- */
    function initPinnedScroll() {
        var tracks = document.querySelectorAll('.h-scroll-track');
        if (!tracks.length) return;

        tracks.forEach(function (track) {
            var slider = track.querySelector('.h-scroll-slider');
            var progressBar = track.querySelector('.h-scroll-progress-bar');
            var navPills = track.querySelectorAll('.h-nav-pill');
            if (!slider) return;

            var ticking = false;

            function update() {
                // Alleen actief op desktop/tablet breedtes (> 1024px)
                if (window.innerWidth <= 1024) {
                    slider.style.transform = 'none';
                    ticking = false;
                    return;
                }

                var rect = track.getBoundingClientRect();
                var trackHeight = track.offsetHeight;
                var windowHeight = window.innerHeight;
                var maxScroll = trackHeight - windowHeight;

                if (maxScroll <= 0) {
                    ticking = false;
                    return;
                }

                var currentScroll = -rect.top;
                var progress = Math.min(Math.max(currentScroll / maxScroll, 0), 1);
                var maxTranslate = slider.scrollWidth - window.innerWidth;
                var translateX = progress * maxTranslate;

                slider.style.transform = 'translate3d(-' + translateX + 'px, 0, 0)';

                if (progressBar) {
                    progressBar.style.width = (progress * 100) + '%';
                }

                // Actieve slide indicator
                var slideCount = navPills.length;
                if (slideCount > 0) {
                    var activeIndex = Math.min(Math.floor(progress * slideCount), slideCount - 1);
                    navPills.forEach(function (pill, idx) {
                        pill.classList.toggle('active', idx === activeIndex);
                    });
                }

                ticking = false;
            }

            function onScroll() {
                if (!ticking) {
                    window.requestAnimationFrame(update);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);
            update();

            // Klikken op nav-pills voor soepel scrollen naar de slide
            navPills.forEach(function (pill, idx) {
                pill.addEventListener('click', function (e) {
                    e.preventDefault();
                    var trackTop = track.getBoundingClientRect().top + window.pageYOffset;
                    var maxScroll = track.offsetHeight - window.innerHeight;
                    var targetScroll = trackTop + (idx / Math.max(navPills.length - 1, 1)) * maxScroll + 2;
                    window.scrollTo({ top: targetScroll, behavior: 'smooth' });
                });
            });
        });
    }

    /* ---------- 7. Interactive Checklist Engine --------------------------- */
    function initChecklist() {
        document.querySelectorAll('.check-item').forEach(function (item) {
            function toggle() {
                var on = item.classList.toggle('checked');
                item.setAttribute('aria-checked', on ? 'true' : 'false');
            }
            item.addEventListener('click', toggle);
            item.addEventListener('keydown', function (ev) {
                if (ev.key === 'Enter' || ev.key === ' ') {
                    ev.preventDefault();
                    toggle();
                }
            });
        });
    }

    /* ---------- 8. Vertical Full-Page Scroll Navigation (Side Dots) -------- */
    function initVerticalScrollNav() {
        var nav = document.querySelector('.vertical-scroll-nav');
        if (!nav) return;

        var dots = nav.querySelectorAll('.v-dot');
        var sections = document.querySelectorAll('.page-vertical-scroll .page-section, main > section');
        if (!dots.length || !sections.length) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var id = entry.target.id;
                    dots.forEach(function (dot) {
                        var target = dot.getAttribute('data-target');
                        dot.classList.toggle('active', target === id);
                    });
                }
            });
        }, { threshold: 0.4 });

        sections.forEach(function (sec) { observer.observe(sec); });

        dots.forEach(function (dot) {
            dot.addEventListener('click', function (e) {
                e.preventDefault();
                var targetId = this.getAttribute('data-target');
                var targetEl = document.getElementById(targetId);
                if (targetEl) {
                    targetEl.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    /* ---------- 9. Boot --------------------------------------------------- */
    function boot() {
        initTheme();
        wireNav();
        wireCookies();
        initScrollReveal();
        initNumberCounters();
        initPinnedScroll();
        initChecklist();
        initVerticalScrollNav();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
