/* =========================================================================
 * Buro GEKKO — site.js
 * Centralised partial loader + nav behaviour.
 *
 *  - Injects assets/partials/nav.html into <div data-include="nav"></div>
 *  - Injects assets/partials/footer.html into <div data-include="footer"></div>
 *  - Rewrites {{BASE}} / {{HOME}} based on page depth so links resolve
 *    correctly from root- and subfolder-pages.
 *  - Re-binds hamburger + Escape key + mobile-menu close-on-link.
 *  - Sets active nav-link state from location.pathname (+ hash).
 *  - Attaches the scroll-aware logo swap ONLY on the homepage.
 *
 *  Usage on every page:
 *     <div data-include="nav"></div>
 *     ...page content...
 *     <div data-include="footer"></div>
 *     <script src="{depth}assets/js/site.js"></script>
 * ========================================================================= */
(function () {
    'use strict';

    /* ---------- 0. Inject shared nav/footer CSS (hamburger + mob-menu) -- */
    // These rules live with the partial so subpages that don't define them
    // in their own <style> block still render the mobile nav correctly.
    var sharedCSS = ''
        + '.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:4px;}'
        + '.hamburger span{display:block;width:24px;height:2px;background:var(--wit,#fff);border-radius:2px;transition:all .25s ease;}'
        + '#navbar.scrolled .hamburger span,nav.scrolled .hamburger span{background:var(--donker,#18222B);}'
        + '.mob-menu{display:none;position:fixed;inset:0;background:var(--donker-2,#101820);z-index:300;flex-direction:column;align-items:center;justify-content:center;gap:26px;}'
        + '.mob-menu.open{display:flex;}'
        + '.mob-menu a{font-size:1.35rem;font-weight:800;color:var(--wit,#fff);transition:all .25s ease;text-decoration:none;}'
        + '.mob-menu a:hover{color:var(--geel,#F2B82C);}'
        + '.mob-close{position:absolute;top:22px;right:26px;font-size:2.2rem;color:rgba(255,255,255,0.4);cursor:pointer;background:none;border:none;line-height:1;}'
        + '#navbar .nav-links a.active,nav .nav-links a.active{color:var(--geel,#F2B82C);font-weight:800;}'
        + '@media (max-width:900px){.hamburger{display:flex;}#navbar .nav-links,nav .nav-links,#navbar .nav-cta,nav .nav-cta{display:none;}}';
    var styleEl = document.createElement('style');
    styleEl.setAttribute('data-source', 'site.js');
    styleEl.textContent = sharedCSS;
    document.head.appendChild(styleEl);

    /* ---------- 1. Determine page depth ---------------------------------- */
    // location.pathname examples (when served from /output/):
    //   /output/index.html                -> depth 0
    //   /output/team/rik-dobbelsteen.html -> depth 1
    //   /output/diensten/ai-copilot.html  -> depth 1
    // We count the number of path-segments AFTER the deployment root.
    // Simpler heuristic: count the slashes in the part of the path that
    // refers to subfolders inside /output/.
    function computeBase() {
        // Strip query/hash, then strip the file name.
        var path = window.location.pathname.split('?')[0].split('#')[0];
        // Find last slash → everything before it is the folder path.
        var folder = path.substring(0, path.lastIndexOf('/') + 1);
        // The site lives under /output/ in dev, or at "/" in production.
        // We treat anything after the LAST occurrence of "/output/" (or root)
        // as the relevant depth.
        var marker = folder.lastIndexOf('/output/');
        var rel;
        if (marker !== -1) {
            rel = folder.substring(marker + '/output/'.length);
        } else {
            // Production: strip leading "/" only.
            rel = folder.replace(/^\//, '');
        }
        // rel is now "" (root), "team/", "diensten/", "visie/" etc.
        var depth = rel === '' ? 0 : rel.replace(/\/$/, '').split('/').length;
        return '../'.repeat(depth);
    }

    var BASE = computeBase();      // "" or "../" or "../../"
    var HOME = BASE + 'index.html'; // absolute target for hash-links

    // Are we currently ON the homepage? Hash links then resolve to "" + "#x".
    var pathLeaf = window.location.pathname.split('/').pop();
    var isHomepage = (pathLeaf === '' || pathLeaf === 'index.html');
    if (isHomepage) {
        HOME = ''; // keep #waarom etc. as pure hash on the homepage itself
    }

    /* ---------- 2. Fetch & inject a partial ----------------------------- */
    function injectPartial(slotName, fileName, callback) {
        var slot = document.querySelector('[data-include="' + slotName + '"]');
        if (!slot) { if (callback) callback(); return; }

        fetch(BASE + 'assets/partials/' + fileName, { cache: 'no-cache' })
            .then(function (r) {
                if (!r.ok) throw new Error('partial fetch failed: ' + fileName);
                return r.text();
            })
            .then(function (html) {
                html = html.replace(/\{\{BASE\}\}/g, BASE)
                           .replace(/\{\{HOME\}\}/g, HOME);
                slot.outerHTML = html;
                if (callback) callback();
            })
            .catch(function (err) {
                console.error('[site.js]', err);
                if (callback) callback();
            });
    }

    /* ---------- 3. Post-nav-injection wiring ---------------------------- */
    function wireNav() {
        var navbar    = document.getElementById('navbar');
        var hamburger = document.getElementById('hamburger');
        var mobMenu   = document.getElementById('mobMenu');
        var mobClose  = document.getElementById('mobClose');
        var navLogo   = document.getElementById('nav-logo');

        // --- Mobile menu open/close ---
        function openMob()  { if (mobMenu) mobMenu.classList.add('open');
                              if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
                              document.body.style.overflow = 'hidden'; }
        function closeMob() { if (mobMenu) mobMenu.classList.remove('open');
                              if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
                              document.body.style.overflow = ''; }
        // Expose for any legacy inline handlers that survive on older pages.
        window.closeMob = closeMob;

        if (hamburger) hamburger.addEventListener('click', openMob);
        if (mobClose)  mobClose.addEventListener('click', closeMob);
        if (mobMenu) {
            // Close on link click
            mobMenu.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', closeMob);
            });
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMob();
        });

        // --- Active link highlighting ---
        var currentLeaf = window.location.pathname.split('/').pop() || 'index.html';
        var currentHash = window.location.hash;
        document.querySelectorAll('#navbar .nav-links a, .mob-menu a').forEach(function (a) {
            var href = a.getAttribute('href') || '';
            // Strip BASE prefix and any leading "./"
            var bare = href.replace(/^(\.\.\/)+/, '').replace(/^\.\//, '');
            // "index.html#waarom" or "#waarom" on homepage
            if (currentHash && (bare === currentLeaf + currentHash || bare === currentHash)) {
                a.classList.add('active');
            } else if (!currentHash && bare === currentLeaf) {
                a.classList.add('active');
            } else if (currentLeaf === 'index.html' && bare === 'index.html') {
                a.classList.add('active');
            }
        });

        // --- Scroll-aware nav state (logo swap only meaningful on homepage) ---
        function onScroll() {
            if (!navbar) return;
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
                if (isHomepage && navLogo) {
                    navLogo.src = BASE + 'assets/images/logo-geel.png';
                }
            } else {
                navbar.classList.remove('scrolled');
                if (isHomepage && navLogo) {
                    navLogo.src = BASE + 'assets/images/logo-geel-wit.png';
                }
            }
        }
        // On non-homepage pages the nav is always solid; we still toggle
        // the "scrolled" class so subtle CSS effects (shadow etc.) work.
        if (!isHomepage && navbar) {
            navbar.classList.add('scrolled');
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ---------- 4. Boot --------------------------------------------------- */
    function boot() {
        injectPartial('nav', 'nav.html', wireNav);
        injectPartial('footer', 'footer.html');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
