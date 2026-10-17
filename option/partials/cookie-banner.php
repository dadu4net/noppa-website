<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Cookie Consent Banner & Modal
 * Standardized according to:
 * - noppa-website-cookie
 * - noppa-website-wcag
 * - AVG / GDPR Richtlijnen
 * =========================================================================
 */
?>
<!-- Cookie Consent Banner (noppa-website-cookie) -->
<div class="cookie-banner" id="cookieBanner" role="region" aria-label="Cookie-toestemming" hidden style="display: none;">
    <div class="cookie-banner-container">
        <div class="cookie-banner-text">
            <h4 class="cookie-banner-title">Wij respecteren je privacy</h4>
            <p>
                Noppa Solutions & Consultants gebruikt functionele cookies om de website te laten werken en geanonimiseerde analytische cookies om het gebruik te meten. Lees meer in ons <a href="<?= htmlspecialchars(($GLOBALS['assetPrefix'] ?? './') . 'cookiebeleid', ENT_QUOTES, 'UTF-8'); ?>" class="cookie-policy-link">cookiebeleid</a>.
            </p>
        </div>
        <div class="cookie-banner-actions">
            <button type="button" class="btn btn-outline btn-sm" id="btnCookieCustomize">Voorkeuren</button>
            <button type="button" class="btn btn-outline btn-sm" id="btnCookieReject">Alleen noodzakelijk</button>
            <button type="button" class="btn btn-primary btn-sm" id="btnCookieAcceptAll">Alles accepteren</button>
        </div>
    </div>
</div>

<!-- Cookie Voorkeuren Modal -->
<div class="cookie-modal-backdrop" id="cookieModalBackdrop" hidden style="display: none;">
    <div class="cookie-modal" role="dialog" aria-modal="true" aria-labelledby="cookieModalTitle">
        <div class="cookie-modal-header">
            <h3 id="cookieModalTitle" class="cookie-modal-title">Cookie-voorkeuren instellen</h3>
            <button type="button" class="btn-close-modal" id="btnCloseCookieModal" aria-label="Sluiten">&times;</button>
        </div>
        <div class="cookie-modal-body">
            <p class="cookie-modal-intro">
                Hier kun je aangeven welke categorieën cookies je wilt toestaan. Noodzakelijke cookies zijn altijd actief voor een correcte werking van de website.
            </p>

            <div class="cookie-category-item">
                <div class="cookie-category-info">
                    <strong>Noodzakelijk & Functioneel</strong>
                    <p>Onmisbaar voor de werking van de site, zoals het onthouden van thema en sessies.</p>
                </div>
                <div class="cookie-toggle-wrap">
                    <input type="checkbox" id="cookieEssential" checked disabled aria-label="Noodzakelijke cookies altijd actief">
                    <label for="cookieEssential" class="cookie-switch-label disabled">Altijd actief</label>
                </div>
            </div>

            <div class="cookie-category-item">
                <div class="cookie-category-info">
                    <strong>Analytisch (o.a. Microsoft Clarity)</strong>
                    <p>Helpt ons inzicht te krijgen in het websitegebruik om de ervaring continu te verbeteren.</p>
                </div>
                <div class="cookie-toggle-wrap">
                    <input type="checkbox" id="cookieAnalytics" checked>
                    <label for="cookieAnalytics" class="cookie-switch-label">Toestaan</label>
                </div>
            </div>

            <div class="cookie-category-item">
                <div class="cookie-category-info">
                    <strong>Marketing & Externe media</strong>
                    <p>Voor het tonen van embedded video's (YouTube/Vimeo) en relevante campagnes.</p>
                </div>
                <div class="cookie-toggle-wrap">
                    <input type="checkbox" id="cookieMarketing">
                    <label for="cookieMarketing" class="cookie-switch-label">Toestaan</label>
                </div>
            </div>
        </div>
        <div class="cookie-modal-footer">
            <button type="button" class="btn btn-outline" id="btnSaveCookiePreferences">Keuze opslaan</button>
            <button type="button" class="btn btn-primary" id="btnModalAcceptAll">Alles accepteren</button>
        </div>
    </div>
</div>
