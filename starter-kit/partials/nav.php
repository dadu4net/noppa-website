<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Navigation Partial
 * Calls NavigationEngine to assemble topbar navigation from content/navigation.md
 * =========================================================================
 */

global $navEngine, $pageSlug;

if (isset($navEngine)) {
    echo $navEngine->render($pageSlug ?? 'home');
}
