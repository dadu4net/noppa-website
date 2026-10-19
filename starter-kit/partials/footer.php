<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Footer Partial
 * Calls FooterEngine and embeds Cookie Consent & site.js
 * =========================================================================
 */

global $footerEngine;

if (isset($footerEngine)) {
    echo $footerEngine->render();
}

// Cookie Banner & Preferences Modal
require __DIR__ . '/cookie-banner.php';
?>
    <!-- Deferred Scripts (noppa-website-footer) -->
    <script src="<?= $assetPrefix ?? './'; ?>assets/js/site.js" defer></script>
</body>
</html>
