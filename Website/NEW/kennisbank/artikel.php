<?php
// =========================================================================
// Noppa Solutions & Consultants — Kennisbank Artikel Detail
// Standardized according to noppa-website-kennisbank & noppa-website-content
// =========================================================================

require_once __DIR__ . '/kennisbank_functions.php';

$slug = $_GET['slug'] ?? '';
$artikel = getArtikel($slug);

$base = "../";

if (!$artikel) {
    header("HTTP/1.0 404 Not Found");
    $pageTitle = "Artikel niet gevonden | Noppa";
    $pageDesc  = "Het opgevraagde kennisbank artikel bestaat niet of is verplaatst.";
    include $base . "partials/header.php";
    include $base . "partials/nav.php";
    ?>
    <main class="page-wrap">
      <div class="container" style="padding: 120px 20px; text-align: center;">
        <span class="caption" style="color:var(--color-royal)">404</span>
        <h1 style="margin-top: 10px;">Artikel niet gevonden</h1>
        <p style="color:var(--text-muted); max-width: 500px; margin: 16px auto 32px;">
          Het artikel dat je zoekt bestaat helaas niet (meer). Bekijk het volledige overzicht in onze kennisbank.
        </p>
        <a href="index.php" class="btn btn-primary">Naar Kennisbank overzicht →</a>
      </div>
    </main>
    <?php
    include $base . "partials/footer.php";
    exit;
}

$meta = $artikel['meta'];
$markdown = $artikel['body'];

$pageTitle = $meta['title'] ?? extractH1($markdown) ?? slugToTitle($slug);
$pageDesc  = $meta['beschrijving'] ?? $meta['description'] ?? extractExcerpt($markdown);
$active    = 'kennisbank';

$extraHead = '<link rel="stylesheet" href="' . $base . 'assets/css/kennisbank.css">';

include $base . "partials/header.php";
include $base . "partials/nav.php";

// Render Markdown via content_loader helper (strips H1, injects IDs on H2/H3, generates TOC)
$rendered = renderMarkdown($markdown, [
    'stripH1' => true,
    'base'    => $base
]);

$datumStr   = $meta['datum'] ?? $meta['date'] ?? '';
$sub        = $meta['beschrijving'] ?? $meta['description'] ?? '';
$categorie  = $meta['categorie'] ?? $meta['category'] ?? 'Kennisbank';
$auteur     = $meta['auteur'] ?? $meta['author'] ?? 'Rik Dobbelsteen';
$leestijd   = $meta['leestijd'] ?? calculateReadingTime($markdown);
$toc        = $rendered['toc'] ?? [];
?>

<main class="page-wrap">
  <div class="page-body">
    
    <!-- HERO -->
    <section class="hero fade-in">
      <div class="container" style="position:relative;z-index:2">
        <div class="breadcrumb">
          <a href="<?= $base ?>index.php">Home</a>
          <span class="sep">›</span>
          <a href="index.php">Kennisbank</a>
          <span class="sep">›</span>
          <span style="color:#fff"><?= htmlspecialchars($categorie) ?></span>
        </div>
        <div class="hero-eyebrow">
          <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" aria-hidden="true"><circle cx="5" cy="5" r="5"/></svg>
          <?= htmlspecialchars($categorie) ?>
        </div>
        <h1 class="hero-h1"><?= htmlspecialchars($pageTitle) ?></h1>
        <?php if ($sub): ?>
          <p class="hero-sub"><?= htmlspecialchars($sub) ?></p>
        <?php endif; ?>
        
        <div style="display:flex; flex-wrap:wrap; gap:18px; align-items:center; margin-top:20px; font-size:0.875rem; color:rgba(255,255,255,0.8);">
          <?php if ($datumStr): ?>
            <div><strong>Bijgewerkt:</strong> <?= formatDatumNL($datumStr) ?></div>
          <?php endif; ?>
          <div><strong>Auteur:</strong> <?= htmlspecialchars($auteur) ?></div>
          <div><strong>Leestijd:</strong> ca. <?= $leestijd ?> min</div>
        </div>
      </div>
    </section>

    <!-- CONTENT GRID MET STICKY TOC -->
    <section class="content fade-in" style="padding: 60px 0 100px;">
      <div class="container">
        <div class="artikel-layout" style="display: grid; grid-template-columns: <?= !empty($toc) ? '280px 1fr' : '1fr' ?>; gap: 48px; align-items: start;">
          
          <?php if (!empty($toc)): ?>
            <!-- STICKY TOC SIDEBAR -->
            <aside class="artikel-toc-wrap" style="position: sticky; top: 100px;">
              <div class="artikel-toc" style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                  <span class="caption" style="font-size: 0.75rem; color: var(--color-royal); text-transform: uppercase; font-weight: 700;">Inhoudsopgave</span>
                  <span class="badge" id="scrollPercentBadge" style="font-size: 0.75rem;">0%</span>
                </div>
                
                <!-- Scroll Progress Bar -->
                <div class="toc-progress-track" style="height: 4px; background: var(--color-mist); border-radius: 2px; overflow: hidden; margin-bottom: 18px;">
                  <div class="toc-progress-bar" id="tocProgressBar" style="height: 100%; width: 0%; background: var(--gradient-signature); transition: width 0.1s ease;"></div>
                </div>

                <nav aria-label="Inhoudsopgave">
                  <ul class="toc-list" style="list-style: none; padding: 0; margin: 0; font-size: 0.875rem;">
                    <?php foreach ($toc as $item): ?>
                      <li class="toc-item toc-item-l<?= $item['level'] ?>" style="margin-bottom: 10px; padding-left: <?= ($item['level'] === 3) ? '14px' : '0' ?>;">
                        <a href="#<?= htmlspecialchars($item['slug']) ?>" style="color: var(--text-main); text-decoration: none; transition: color 0.15s ease;">
                          <?= htmlspecialchars($item['title']) ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </nav>

                <hr style="border: none; border-top: 1px solid var(--border-color); margin: 24px 0 16px;">

                <div style="font-size: 0.8125rem; color: var(--text-muted);">
                  Vragen over dit onderwerp? <br>
                  <a href="<?= $base ?>contact.php" style="color: var(--color-royal); font-weight: 600;">Plan een sessie met Rik &rarr;</a>
                </div>
              </div>
            </aside>
          <?php endif; ?>

          <!-- BODY PROSE -->
          <article class="artikel-prose" style="min-width: 0;">
            <?= $rendered['html'] ?>
          </article>

        </div>
      </div>
    </section>

  </div>
</main>

<script>
  // Leesvoortgang bijwerken op scroll
  window.addEventListener('scroll', function() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    var bar = document.getElementById('tocProgressBar');
    var badge = document.getElementById('scrollPercentBadge');
    if (bar) bar.style.width = Math.min(100, Math.max(0, scrolled)) + '%';
    if (badge) badge.innerText = Math.round(Math.min(100, Math.max(0, scrolled))) + '%';
  });
</script>

<?php include $base . "partials/footer.php"; ?>
