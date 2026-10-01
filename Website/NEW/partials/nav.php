<?php
// =========================================================================
// Noppa Solutions & Consultants — Navigation Partial (noppa-website-navigation)
// =========================================================================

$base   = isset($base) ? $base : (isset($base_path) ? $base_path : "");
$active = isset($active) ? $active : (isset($active_page) ? $active_page : "");
?>
<div class="gradient-bar"></div>

<header class="nav" id="navbar">
  <div class="nav-inner">
    <a href="<?= $base ?>index.php" class="brand" aria-label="Noppa Solutions &amp; Consultants Home">
      <div class="brand-mark">
        <img src="<?= $base ?>assets/images/DEF_Logo_Noppa.png" alt="Noppa Solutions &amp; Consultants" class="brand-logo-light">
        <img src="<?= $base ?>assets/images/DEF_Logo_Noppa_wit.png" alt="Noppa Solutions &amp; Consultants" class="brand-logo-dark">
      </div>
    </a>
    <nav class="desktop-nav" aria-label="Hoofdnavigatie">
      <ul>
        <li><a href="<?= $base ?>diensten/ai-copilot.php" class="<?= in_array($active, ['copilot', 'ai-copilot']) ? 'active' : '' ?>">Copilot Readiness</a></li>
        <li><a href="<?= $base ?>diensten/workshops-trainingen.php" class="<?= in_array($active, ['workshops', 'workshops-trainingen']) ? 'active' : '' ?>">Workshops</a></li>
        <li><a href="<?= $base ?>diensten/adoptie-begeleiding.php" class="<?= in_array($active, ['adoptie', 'adoptie-begeleiding']) ? 'active' : '' ?>">M365 Adoptie</a></li>
        <li><a href="<?= $base ?>diensten/processen-portalen.php" class="<?= in_array($active, ['processen', 'processen-portalen']) ? 'active' : '' ?>">Processen &amp; Portalen</a></li>
        <li><a href="<?= $base ?>kennisbank/index.php" class="<?= $active === 'kennisbank' ? 'active' : '' ?>">Kennisbank</a></li>
        <li><a href="<?= $base ?>index.php#waarom" class="<?= in_array($active, ['waarom', 'over']) ? 'active' : '' ?>">Over Noppa</a></li>
        <li><a href="<?= $base ?>contact.php" class="<?= $active === 'contact' ? 'active' : '' ?>">Contact</a></li>
      </ul>
    </nav>
    <div class="nav-actions">
      <!-- Theme Switcher -->
      <div class="theme-switcher" role="group" aria-label="Themakeuze" id="themeSwitcher">
        <button type="button" class="theme-btn" data-theme-val="auto" title="Automatisch (volgt systeem)" aria-label="Systeemthema">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
            <line x1="8" y1="21" x2="16" y2="21"></line>
            <line x1="12" y1="17" x2="12" y2="21"></line>
          </svg>
        </button>
        <button type="button" class="theme-btn" data-theme-val="light" title="Licht thema" aria-label="Licht thema">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
        </button>
        <button type="button" class="theme-btn" data-theme-val="dark" title="Donker thema" aria-label="Donker thema">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
        </button>
      </div>

      <!-- Primary Action CTA -->
      <a href="<?= $base ?>contact.php" class="nav-cta">Plan kennismaking</a>

      <!-- Hamburger Button -->
      <button class="hamburger" id="navToggle" aria-label="Menu openen" aria-expanded="false" aria-controls="mobileNav" type="button">
        <svg class="hamburger-open-ico" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        <svg class="hamburger-close-ico" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true" style="display:none"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>
  </div>

  <!-- Mobile Navigation Drawer -->
  <div class="mobile-nav" id="mobileNav" aria-label="Mobiele navigatie" hidden>
    <div class="mobile-nav-inner">
      <ul>
        <li><a href="<?= $base ?>diensten/ai-copilot.php" class="<?= in_array($active, ['copilot', 'ai-copilot']) ? 'active' : '' ?>">Copilot Readiness</a></li>
        <li><a href="<?= $base ?>diensten/workshops-trainingen.php" class="<?= in_array($active, ['workshops', 'workshops-trainingen']) ? 'active' : '' ?>">Workshops</a></li>
        <li><a href="<?= $base ?>diensten/adoptie-begeleiding.php" class="<?= in_array($active, ['adoptie', 'adoptie-begeleiding']) ? 'active' : '' ?>">M365 Adoptie</a></li>
        <li><a href="<?= $base ?>diensten/processen-portalen.php" class="<?= in_array($active, ['processen', 'processen-portalen']) ? 'active' : '' ?>">Processen &amp; Portalen</a></li>
        <li><a href="<?= $base ?>kennisbank/index.php" class="<?= $active === 'kennisbank' ? 'active' : '' ?>">Kennisbank</a></li>
        <li><a href="<?= $base ?>index.php#waarom" class="<?= in_array($active, ['waarom', 'over']) ? 'active' : '' ?>">Over Noppa</a></li>
        <li><a href="<?= $base ?>contact.php" class="<?= $active === 'contact' ? 'active' : '' ?>">Contact</a></li>
      </ul>
      <div class="mobile-nav-cta">
        <a href="<?= $base ?>contact.php" class="nav-cta" style="width:100%;justify-content:center;padding:12px 20px;">Plan kennismaking →</a>
      </div>
    </div>
  </div>
</header>
