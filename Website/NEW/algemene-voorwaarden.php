<?php
// Inladen van Parsedown (die al in de kennisbank map staat)
require_once 'kennisbank/Parsedown.php';

$filePath = "data/legal/algemene-voorwaarden.md";
if (!file_exists($filePath)) {
    die("Markdown bestand voor algemene voorwaarden niet gevonden.");
}

$fileContent = file_get_contents($filePath);
$frontmatter = [];
$markdownText = "";

// Haal de frontmatter (alles tussen de eerste --- en de tweede ---) eruit
if (preg_match('/^---\s*(.*?)\s*---\s*(.*)$/s', $fileContent, $matches)) {
    $yamlString = $matches[1];
    $markdownText = $matches[2];
    
    $lines = explode("\n", $yamlString);
    foreach ($lines as $line) {
        if (strpos($line, ':') !== false) {
            list($key, $value) = explode(':', $line, 2);
            $frontmatter[trim($key)] = trim($value);
        }
    }
} else {
    $markdownText = $fileContent;
}

$pageTitle = $frontmatter['pageTitle'] ?? "Algemene Voorwaarden | Noppa";
$pageDesc  = $frontmatter['pageDesc'] ?? "";
$date      = $frontmatter['date'] ?? "mei 2026";

// Converteer Markdown naar HTML met Parsedown
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(false);
$rawHtml = $Parsedown->text($markdownText);

// Genereer de Table of Contents (TOC) en formatteer de H2 headers
$toc = [];
$contentHtml = preg_replace_callback('/<h2>(.*?)<\/h2>/i', function($matches) use (&$toc) {
    $text = $matches[1]; // Bijv: "Artikel 1 - Algemeen"
    
    $slug = '';
    $displayTitle = $text;
    $tocTitle = $text;
    $isSub = false;

    // Detecteer de "Artikel X -" structuur
    if (preg_match('/^(Artikel\s+([0-9]+)([a-z]?))\s*-\s*(.*)$/i', $text, $parts)) {
        // $parts[1] = "Artikel 12a"
        // $parts[2] = "12"
        // $parts[3] = "a" (of leeg)
        // $parts[4] = "Levering van Microsoft licenties"
        
        $slug = 'art-' . $parts[2] . $parts[3];
        $displayTitle = '<span class="av-num">' . $parts[1] . '</span>' . $parts[4];
        $tocTitle = $parts[1] . ' - ' . $parts[4];
        
        // Als er een letter achter het nummer staat (zoals bij 12a), is het een sub-item
        if (!empty($parts[3])) {
            $isSub = true;
        }
    } else {
        // Fallback voor gewone H2 headers
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
        $tocTitle = $text;
    }
    
    $toc[] = [
        'id' => $slug,
        'title' => $tocTitle,
        'sub' => $isSub
    ];
    
    return "<h2 id=\"$slug\">$displayTitle</h2>";
}, $rawHtml);

$base = "";
include $base . "partials/header.php";
?>
<link rel="stylesheet" href="assets/css/kennisbank.css">

<!-- NAV -->
<?php include $base . "partials/nav.php"; ?>

<div class="page-wrap">
  <div class="page-body">
    <!-- HERO -->
    <section class="hero fade-in">
        <div class="container" style="position:relative;z-index:2">
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>›</span>
                <span style="color: var(--white);">Algemene Voorwaarden</span>
            </div>
            <div class="hero-eyebrow">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Juridisch
            </div>
            <h1 class="hero-h1">Algemene <em>Voorwaarden</em></h1>
            <p class="hero-sub">
                Deze voorwaarden beheersen alle offertes en overeenkomsten van Noppa B.V.
                voor het leveren van diensten en producten aan onze opdrachtgevers.
            </p>
            <div class="hero-meta">Laatst bijgewerkt: <?php echo htmlspecialchars($date); ?></div>
        </div>
    </section>

    <!-- CONTENT MET STICKY TOC LAYOUT (IN LIJN MET KENNISBANK) -->
    <section class="content fade-in" style="animation-delay:.1s; padding-bottom: 80px;">
        <div class="container">
            <div class="artikel-layout">

                <!-- Dynamische Inhoudsopgave (Sticky Sidebar) -->
                <?php if (!empty($toc)): ?>
                <aside class="toc-sidebar" id="tocSidebar">
                    <div class="toc-progress"><div class="toc-progress-inner" id="tocProgress"></div></div>
                    <span class="toc-label">Inhoudsopgave</span>
                    <ul class="toc-list">
                        <?php foreach ($toc as $item): ?>
                            <li class="toc-item <?php echo $item['sub'] ? 'h3' : ''; ?>" data-toc-id="<?php echo $item['id']; ?>">
                                <a href="#<?php echo $item['id']; ?>" onclick="scrollNaarKop(event, '<?php echo $item['id']; ?>')">
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
                <?php endif; ?>

                <!-- Markdown Content Kolom -->
                <div class="artikel-content-col artikel-prose" style="padding-top:0;">
                    <?php echo $contentHtml; ?>

                    <div class="artikel-meta-box">
                        <strong>Vragen over deze voorwaarden?</strong><br>
                        Neem contact met ons op via <a href="mailto:info@noppa.nl">info@noppa.nl</a>
                        of bel <a href="tel:+31613357723">+31 6 13 35 77 23</a>. Wij beantwoorden uw vraag graag persoonlijk.
                    </div>
                </div>

            </div>
        </div>
    </section>
  </div>
</div>

<!-- CTA -->
<section id="cta-final">
    <div class="container">
        <h2>Samenwerken met Noppa?</h2>
        <p>
            Wij denken graag met u mee — over uw Microsoft 365-omgeving, governance of
            adoptie. Neem gerust contact met ons op voor een vrijblijvend gesprek.
        </p>
        <a href="contact.php" class="btn btn-primary">
            Neem contact op →
        </a>
    </div>
</section>

<!-- FOOTER -->
<?php include $base . "partials/footer.php"; ?>

<script>
function scrollNaarKop(e, id) {
    e.preventDefault();
    const el = document.getElementById(id);
    if (!el) return;
    const offset = 88;
    const top = el.getBoundingClientRect().top + window.scrollY - offset;
    window.scrollTo({ top, behavior: 'smooth' });
}

document.addEventListener('DOMContentLoaded', function() {
    const progressEl = document.getElementById('tocProgress');

    function updateProgress() {
        const doc = document.documentElement;
        const pct = (window.scrollY / (doc.scrollHeight - doc.clientHeight)) * 100;
        if (progressEl) progressEl.style.width = Math.min(pct, 100) + '%';
    }

    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();

    const items = document.querySelectorAll('.toc-item');
    if (!items.length) return;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const tocItem = document.querySelector(`.toc-item[data-toc-id="${entry.target.id}"]`);
            if (!tocItem) return;
            if (entry.isIntersecting) {
                items.forEach(i => i.classList.remove('actief'));
                tocItem.classList.add('actief');
                const sidebar = document.getElementById('tocSidebar');
                if (sidebar) {
                    const itemTop = tocItem.offsetTop - sidebar.offsetTop;
                    const visible = sidebar.scrollTop + sidebar.clientHeight;
                    if (itemTop < sidebar.scrollTop || itemTop > visible - 40) {
                        sidebar.scrollTo({ top: itemTop - 60, behavior: 'smooth' });
                    }
                }
            }
        });
    }, {
        rootMargin: '-80px 0px -60% 0px',
        threshold: 0
    });

    document.querySelectorAll('.artikel-content-col h2').forEach(el => {
        if (el.id) observer.observe(el);
    });
});
</script>
</body>
</html>
