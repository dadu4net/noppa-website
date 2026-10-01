<?php
// =========================================================================
// Noppa Solutions & Consultants — Header Partial (noppa-website-header)
// =========================================================================

$siteName      = "Noppa Solutions & Consultants";
$base          = isset($base) ? $base : (isset($base_path) ? $base_path : "");
$rawTitle      = !empty($page_title) ? $page_title : (!empty($pageTitle) ? $pageTitle : (!empty($title) ? $title : "Boosting Business Productivity"));
$title         = (strpos($rawTitle, $siteName) !== false) ? $rawTitle : $rawTitle . " | " . $siteName;

$description   = !empty($page_description) ? $page_description : (!empty($pageDesc) ? $pageDesc : (!empty($description) ? $description : "Noppa Solutions & Consultants helpt organisaties slimmer werken met Microsoft 365. Strategie, implementatie, adoptie en Copilot — van A tot Z ontzorgd."));
$keywords      = !empty($page_keywords) ? $page_keywords : (!empty($pageKeywords) ? $pageKeywords : "Microsoft 365, SharePoint, Teams, Copilot, adoptie, implementatie, consultancy, Berlicum, 's-Hertogenbosch, productiviteit, digitale werkplek, Power Platform, governance");
$canonical_url = !empty($canonical_url) ? $canonical_url : (!empty($canonicalUrl) ? $canonicalUrl : "https://www.noppa.nl/");
$og_image      = !empty($og_image) ? $og_image : (!empty($ogImage) ? $ogImage : "https://www.noppa.nl/assets/images/DEF_Logo_Noppa.png");
$extra_head    = !empty($extra_head) ? $extra_head : (!empty($extraHead) ? $extraHead : "");
?>
<!DOCTYPE html>
<html lang="nl" prefix="og: https://ogp.me/ns#">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<!-- ===== SEO: Basis ===== -->
<title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
<meta content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>" name="description"/>
<meta content="<?= htmlspecialchars($keywords, ENT_QUOTES, 'UTF-8') ?>" name="keywords"/>
<meta content="Noppa Solutions &amp; Consultants" name="author"/>
<meta content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" name="robots"/>
<link href="<?= htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8') ?>" rel="canonical"/>

<!-- ===== SEO: Open Graph ===== -->
<meta content="website" property="og:type"/>
<meta content="nl_NL" property="og:locale"/>
<meta content="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>" property="og:site_name"/>
<meta content="<?= htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8') ?>" property="og:url"/>
<meta content="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>" property="og:title"/>
<meta content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>" property="og:description"/>
<meta content="<?= htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8') ?>" property="og:image"/>
<meta content="1200" property="og:image:width"/>
<meta content="630" property="og:image:height"/>
<meta content="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>" property="og:image:alt"/>

<!-- ===== SEO: Twitter / X Card ===== -->
<meta content="summary_large_image" name="twitter:card"/>
<meta content="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>" name="twitter:title"/>
<meta content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>" name="twitter:description"/>
<meta content="<?= htmlspecialchars($og_image, ENT_QUOTES, 'UTF-8') ?>" name="twitter:image"/>

<!-- ===== SEO: Geografisch ===== -->
<meta content="NL-NB" name="geo.region"/>
<meta content="Berlicum" name="geo.placename"/>
<meta content="51.6780;5.3970" name="geo.position"/>
<meta content="51.6780, 5.3970" name="ICBM"/>

<!-- ===== Favicons ===== -->
<link href="<?= $base ?>assets/images/DEF_Logo_Noppa.png" rel="icon" sizes="32x32" type="image/png"/>
<link href="<?= $base ?>assets/images/DEF_Logo_Noppa.png" rel="apple-touch-icon"/>

<!-- ===== Typography & Stylesheets ===== -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="<?= $base ?>assets/css/noppa.css" rel="stylesheet"/>

<!-- ===== Schema.org ===== -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Noppa Solutions & Consultants",
  "alternateName": "Noppa",
  "url": "https://www.noppa.nl",
  "logo": "https://www.noppa.nl/assets/images/DEF_Logo_Noppa.png",
  "description": "Noppa Solutions & Consultants helpt organisaties slimmer werken. We bouwen aan productiviteit, structuur en grip — met technologie als motor en mensen als drijfveer.",
  "email": "rik@noppa.nl",
  "telephone": "+31613357723",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Pijlkruid 44",
    "addressLocality": "Berlicum",
    "postalCode": "5258 BW",
    "addressCountry": "NL"
  },
  "sameAs": [
    "https://nl.linkedin.com/company/noppa-solutions-consultants"
  ],
  "knowsAbout": ["Microsoft 365","SharePoint","Microsoft Teams","Microsoft Copilot","Power Platform","Gebruikersadoptie","Digitale transformatie","Productiviteit","Governance"]
}
</script>

<!-- ===== Microsoft Clarity Tracking ===== -->
<script type="text/javascript">
  (function(c,l,a,r,i,t,y){
      c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
      t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
      y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
  })(window, document, "clarity", "script", "x8d0jgm9hr");
</script>

<!-- ===== Theme Switcher Initializer (Anti-FOUC) ===== -->
<script>
  (function() {
    try {
      var saved = localStorage.getItem('noppa-theme') || 'auto';
      var effective = saved;
      if (saved === 'auto' || !saved) {
        effective = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
      }
      document.documentElement.setAttribute('data-theme', effective);
    } catch(e) {}
  })();
</script>

<?= $extra_head ?>
</head>
<body>
