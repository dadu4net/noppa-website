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
        $tocTitle = $parts[4];
        
        // Als er een letter achter het nummer staat (zoals bij 12a), is het een sub-item
        if (!empty($parts[3])) {
            $isSub = true;
        }
    } else {
        // Fallback voor gewone H2 headers
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
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

<!-- NAV -->
<?php include $base . "partials/nav.php"; ?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>›</span>
            <span style="color: var(--wit);">Algemene Voorwaarden</span>
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

<!-- CONTENT -->
<section class="content">
    <div class="container-narrow">

        <!-- Dynamische Inhoudsopgave -->
        <?php if (!empty($toc)): ?>
        <nav class="toc" aria-label="Inhoudsopgave">
            <h3>Inhoudsopgave</h3>
            <ol>
                <?php foreach ($toc as $item): ?>
                    <li <?php echo $item['sub'] ? 'class="sub"' : ''; ?>>
                        <a href="#<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['title']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
        <?php endif; ?>

        <!-- Markdown Content -->
        <?php echo $contentHtml; ?>

        <div class="content-meta">
            <strong>Vragen over deze voorwaarden?</strong><br>
            Neem contact met ons op via <a href="mailto:info@noppa.nl">info@noppa.nl</a>
            of bel <a href="tel:+31613357723">+31 6 13 35 77 23</a>. Wij beantwoorden uw vraag
            graag persoonlijk.
        </div>

    </div>
</section>

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
</body>
</html>
