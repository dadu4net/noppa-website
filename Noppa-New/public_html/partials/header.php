<?php
// Dynamische SEO variabelen
$siteName = "Noppa Solutions & Consultants";
$title = !empty($pageTitle) ? $pageTitle . " | " . $siteName : $siteName;
$description = !empty($pageDesc) ? $pageDesc : "Noppa helpt teams in 4 weken aan de slag met Microsoft 365, Copilot en data. Eén dashboard. Eén bron van waarheid. Klaar.";
$base = isset($base) ? $base : "";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="<?= htmlspecialchars($description) ?>">

<!-- Open Graph / Social -->
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta property="og:type" content="website">

<!-- Geo / LocalBusiness Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Consulting",
  "name": "Noppa Solutions & Consultants",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Pijlkruid 44",
    "addressLocality": "Berlicum",
    "postalCode": "5258 BW",
    "addressCountry": "NL"
  },
  "telephone": "+31613357723",
  "url": "https://noppa.nl"
}
</script>

<!-- Microsoft Clarity Tracking -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "x8d0jgm9hr");
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $base ?>css/noppa.css">
<script>
  (function() {
    try {
      var saved = localStorage.getItem('noppa-theme') || 'auto';
      if (saved === 'dark' || saved === 'light') {
        document.documentElement.setAttribute('data-theme', saved);
      } else {
        document.documentElement.removeAttribute('data-theme');
      }
    } catch(e) {}
  })();
</script>
</head>
<body>
