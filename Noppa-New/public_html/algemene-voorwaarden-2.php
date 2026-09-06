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
$pageDesc = $frontmatter['pageDesc'] ?? "";
$date = $frontmatter['date'] ?? "mei 2026";

// Converteer Markdown naar HTML met Parsedown
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(false);
$rawHtml = $Parsedown->text($markdownText);

// Genereer de Table of Contents (TOC) en formatteer de H2 headers
$toc = [];
$contentHtml = preg_replace_callback('/<h2>(.*?)<\/h2>/i', function ($matches) use (&$toc) {
    $text = $matches[1]; // Bijv: "Artikel 1 - Algemeen"

    $slug = '';
    $displayTitle = $text;
    $tocTitle = $text;
    $isSub = false;

    // Detecteer de "Artikel X -" structuur
    if (preg_match('/^(Artikel\s+([0-9]+)([a-z]?))\s*-\s*(.*)$/i', $text, $parts)) {
        $slug = 'art-' . $parts[2] . $parts[3];
        $displayTitle = '<span class="av-num">' . $parts[1] . '</span>' . $parts[4];
        $tocTitle = $parts[4];

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

<link rel="stylesheet" href="css/kennisbank.css">

<div class="page-wrap">
    <div class="page-body">
        <section class="hero fade-in">
            <div class="container" style="position:relative;z-index:2">
                <?php if ($date): ?>
                    <div class="breadcrumb"><span>Bijgewerkt:</span><span><?php echo htmlspecialchars($date); ?></span>
                    </div>
                <?php endif; ?>
                <div class="hero-eyebrow">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" aria-hidden="true">
                        <circle cx="5" cy="5" r="5" />
                    </svg>
                    Juridisch
                </div>
                <h1 class="hero-h1">Algemene <em>Voorwaarden</em></h1>
                <p class="hero-sub">
                    Deze voorwaarden beheersen alle offertes en overeenkomsten van Noppa Solutions &amp; Consultants
                    voor het leveren van diensten en producten aan onze opdrachtgevers.
                </p>
            </div>
        </section>

        <section class="content fade-in" style="animation-delay:.1s; padding-bottom: 80px;">
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

                <div class="content-meta"
                    style="margin-top: 40px; border-top: 1px solid var(--border); padding-top: 20px;">
                    <strong>Vragen over deze voorwaarden?</strong><br>
                    Neem contact met ons op via <a
                        href="mailto:info@noppa.nl?subject=Algemene Voorwaarden (website)">info@noppa.nl</a>
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
    </div>
</div>

<!-- FOOTER -->
<?php include $base . "partials/footer.php"; ?>
</body>

</html>