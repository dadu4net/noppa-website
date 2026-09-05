<?php
require_once 'kennisbank_functions.php';
require_once 'Parsedown.php';

$slug = $_GET['slug'] ?? '';
$artikel = getArtikel($slug);

if (!$artikel) {
    header("HTTP/1.0 404 Not Found");
    $pageTitle = "Niet gevonden — Noppa";
    $base = "../";
    include $base . "partials/header.php";
    include $base . "partials/nav.php";
    echo '<div class="container" style="padding: 120px 0;"><h1>Artikel niet gevonden</h1><p>Sorry, het opgevraagde artikel bestaat niet (meer).</p></div>';
    include $base . "partials/footer.php";
    exit;
}

$meta = $artikel['meta'];
$markdown = $artikel['body'];

$pageTitle = ($meta['title'] ?? extractH1($markdown) ?? slugToTitle($slug));
$pageDesc = $meta['beschrijving'] ?? $meta['description'] ?? extractExcerpt($markdown);
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>
<link rel="stylesheet" href="../css/kennisbank.css">
<?php
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(false); // We trust our own content

// Strip out H1 if we want to display it separately in the hero
$bodyHtml = $Parsedown->text(preg_replace('/^#\s+(.+)/m', '', $markdown));
$datumStr = $meta['datum'] ?? $meta['date'] ?? '';
$sub = $meta['beschrijving'] ?? $meta['description'] ?? '';
?>

<div class="page-wrap">
  <div class="page-body">
    <section class="hero fade-in">
      <div class="container" style="position:relative;z-index:2">
        <?php if ($datumStr): ?>
            <div class="breadcrumb"><span>Bijgewerkt:</span><span><?= formatDatumNL($datumStr) ?></span></div>
        <?php endif; ?>
        <div class="hero-eyebrow">
          <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" aria-hidden="true"><circle cx="5" cy="5" r="5"/></svg>
          <?= htmlspecialchars($meta['categorie'] ?? 'Kennisbank') ?>
        </div>
        <h1 class="hero-h1"><?= htmlspecialchars($pageTitle) ?></h1>
        <?php if ($sub): ?>
            <p class="hero-sub"><?= htmlspecialchars($sub) ?></p>
        <?php endif; ?>
      </div>
    </section>
    
    <section class="content fade-in" style="animation-delay:.1s; padding-bottom: 80px;">
      <div class="container-narrow">
        <?= $bodyHtml ?>
      </div>
    </section>
  </div>
</div>

<?php include $base . "partials/footer.php"; ?>
