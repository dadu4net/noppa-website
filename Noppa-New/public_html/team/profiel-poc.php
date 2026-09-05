<?php
// 1. DATA OPHALEN EN PARSEN
$id = isset($_GET['id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['id']) : 'rik-dobbelsteen';
$filePath = "../data/team/{$id}.md";

if (!file_exists($filePath)) {
    die("Profiel niet gevonden in data map.");
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

// Splits het markdown document op op basis van H2 koppen (## )
$rawSections = explode("\n## ", "\n" . $markdownText);
$sections = [];
foreach($rawSections as $sec) {
    if (trim($sec) === '') continue;
    $lines = explode("\n", $sec, 2);
    $title = trim($lines[0]);
    $content = isset($lines[1]) ? trim($lines[1]) : '';
    $sections[$title] = $content;
}

// Functie om de body netjes naar HTML te converteren (enters en bold)
function parseBody($text) {
    $html = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $html = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $html);
    $html = '<p style="font-size:1.02rem;color:var(--ink);line-height:1.8;margin-bottom:18px">' . str_replace("\n\n", '</p><p style="font-size:1.02rem;color:var(--ink);line-height:1.8;margin-bottom:18px">', trim($html)) . '</p>';
    return str_replace('<p style="font-size:1.02rem;color:var(--ink);line-height:1.8;margin-bottom:18px"></p>', '', $html);
}

// Functie om lijst items (zoals Expertise en Referenties) op basis van H3 (### ) uit te lezen
function parseItems($content) {
    $rawItems = explode("\n### ", "\n" . $content);
    $items = [];
    foreach($rawItems as $item) {
        if (trim($item) === '') continue;
        $lines = explode("\n", $item, 2);
        $items[] = [
            'title' => trim($lines[0]),
            'text' => isset($lines[1]) ? trim($lines[1]) : ''
        ];
    }
    return $items;
}

// Data klaarmaken
$name = $frontmatter['firstName'] ?? 'Onbekend';
$lastName = $frontmatter['lastName'] ?? '';
$fullName = trim($name . ' ' . $lastName);
$initials = substr($name, 0, 1) . substr($lastName, 0, 1);
$pageTitle = $frontmatter['pageTitle'] ?? "$fullName | Team Noppa";
$pageDesc = $frontmatter['pageDesc'] ?? "";
$roleTitle = $frontmatter['roleTitle'] ?? "";
$jobTitle = $frontmatter['jobTitle'] ?? "";
$shortBio = $frontmatter['shortBio'] ?? "";
$phone = $frontmatter['phone'] ?? "";
$email = $frontmatter['email'] ?? "";
$linkedin = $frontmatter['linkedin'] ?? "";
$location = $frontmatter['location'] ?? "";

// Secties
$bioHtml = parseBody($sections['Over Rik'] ?? '');
$expertiseItems = parseItems($sections['Expertise'] ?? '');
$werkervaringItems = parseItems($sections['Werkervaring'] ?? '');
$referentiesItems = parseItems($sections['Referenties'] ?? '');

// SVGs voor expertise kaarten (hergebruikt en afwisselend gekozen per item als fallback)
$svgIcons = [
    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="8" r="3"/><path d="M3 21c0-3 3-5 6-5s6 2 6 5M21 21c0-2-2-4-4-4"/></svg>',
    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/></svg>',
    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9h18M9 21V9"/></svg>',
    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>',
    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>',
    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>'
];

// 2. TEMPLATE RENDEREN
$base = "../";
include $base . "partials/header.php";
?>

<!-- NAV -->
<?php include $base . "partials/nav.php"; ?>

<!-- Custom PoC CSS om te garanderen dat eventuele dynamische items perfect ogen -->
<style>
.poc-dynamic-text p {
    margin-bottom: 1.2rem;
    line-height: 1.8;
}
.poc-dynamic-text p:last-child {
    margin-bottom: 0;
}
</style>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="../index.php">Home</a><span class="sep">›</span><a href="../index.php#over">Team</a><span class="sep">›</span><span style="color:#fff"><?php echo htmlspecialchars($fullName); ?></span>
    </div>
    <div class="hero-grid">
      <div>
        <div class="hero-eyebrow">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg>
          Team Noppa
        </div>
        <h1><?php echo htmlspecialchars($name); ?> <em><?php echo htmlspecialchars($lastName); ?></em></h1>
        <div class="hero-role"><?php echo htmlspecialchars($roleTitle); ?></div>
        <p class="hero-sub"><?php echo htmlspecialchars($shortBio); ?></p>
        <div class="hero-actions">
          <a href="../contact.php#booking" class="btn btn-accent">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Plan kennismaking
          </a>
          <button class="btn btn-ghost-dark" id="vcard-btn" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download vCard
          </button>
        </div>
      </div>

      <aside class="profile-card" aria-label="<?php echo htmlspecialchars($fullName); ?>">
        <div class="profile-avatar" aria-hidden="true"
             <?php if (!empty($frontmatter['image'])): ?>
             style="background-image: url('../assets/<?php echo htmlspecialchars($frontmatter['image']); ?>'); background-size: cover; background-position: center; color: transparent;"
             <?php endif; ?>>
          <?php echo empty($frontmatter['image']) ? htmlspecialchars($initials) : ''; ?>
        </div>
        <div class="profile-name"><?php echo htmlspecialchars($fullName); ?></div>
        <div class="profile-title"><?php echo htmlspecialchars($jobTitle); ?></div>
        <div class="profile-meta">
          <div class="pm-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
            <span class="pm-val"><a href="tel:<?php echo htmlspecialchars(str_replace(' ', '', $phone)); ?>"><?php echo htmlspecialchars($phone); ?></a></span>
          </div>
          <div class="pm-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
            <span class="pm-val"><a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></span>
          </div>
          <div class="pm-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
            <span class="pm-val"><a href="https://www.<?php echo htmlspecialchars($linkedin); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($linkedin); ?></a></span>
          </div>
          <div class="pm-row">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="pm-val"><?php echo htmlspecialchars($location); ?></span>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="section">
  <div class="container">
    <div class="section-head" style="text-align:left;max-width:none;margin-bottom:40px">
      <span class="sec-eyebrow">Over <?php echo htmlspecialchars($name); ?></span>
      <h2>Vraag, antwoord, doen.</h2>
    </div>
    <div class="about-grid" style="grid-template-columns:1.3fr 1fr;align-items:start">
      <div class="poc-dynamic-text">
        <?php echo $bioHtml; ?>
      </div>
      <aside class="quick-facts">
        <h3>Kort &amp; bondig</h3>
        <div class="qf-row"><span class="qf-lbl">Functie</span><span class="qf-val"><?php echo htmlspecialchars($jobTitle); ?></span></div>
        <div class="qf-row"><span class="qf-lbl">Ervaring</span><span class="qf-val"><?php echo htmlspecialchars($frontmatter['qf_experience'] ?? '-'); ?></span></div>
        <div class="qf-row"><span class="qf-lbl">Specialisme</span><span class="qf-val"><?php echo htmlspecialchars($frontmatter['qf_specialism'] ?? '-'); ?></span></div>
        <div class="qf-row"><span class="qf-lbl">Werkgebied</span><span class="qf-val"><?php echo htmlspecialchars($frontmatter['qf_region'] ?? '-'); ?></span></div>
        <div class="qf-row"><span class="qf-lbl">Talen</span><span class="qf-val"><?php echo htmlspecialchars($frontmatter['qf_languages'] ?? '-'); ?></span></div>
        <div class="qf-row"><span class="qf-lbl">Standplaats</span><span class="qf-val"><?php echo htmlspecialchars(explode(',', $location)[0]); ?></span></div>
      </aside>
    </div>
  </div>
</section>

<!-- EXPERTISE -->
<?php if(!empty($expertiseItems)): ?>
<section class="section-alt">
  <div class="container">
    <div class="section-head">
      <span class="sec-eyebrow">Expertise</span>
      <h2>Waar ik teams mee vooruit help</h2>
      <p>Praktijkervaring en resultaatgericht werken voor onze opdrachtgevers.</p>
    </div>
    <div class="expertise-grid">
      <?php foreach($expertiseItems as $index => $item): ?>
      <div class="exp-card">
        <div class="exp-ico"><?php echo $svgIcons[$index % count($svgIcons)]; ?></div>
        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($item['text'])); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- TIMELINE -->
<?php if(!empty($werkervaringItems)): ?>
<section class="section">
  <div class="container-narrow">
    <div class="section-head">
      <span class="sec-eyebrow">Werkervaring</span>
      <h2>Achtergrond & Ervaring</h2>
      <p>Van implementatie tot strategisch advies.</p>
    </div>
    <div class="timeline">
      <?php foreach($werkervaringItems as $index => $item): 
          // Parse the title which is stored as "Periode | Rol | Bedrijf"
          $parts = array_map('trim', explode('|', $item['title']));
          $period = $parts[0] ?? '';
          $role = $parts[1] ?? '';
          $company = $parts[2] ?? '';
          $isCurrent = ($index === 0) ? 'current' : '';
      ?>
      <div class="tl-item <?php echo $isCurrent; ?>">
        <div class="tl-period"><?php echo htmlspecialchars($period); ?></div>
        <div class="tl-role"><?php echo htmlspecialchars($role); ?></div>
        <div class="tl-company"><?php echo htmlspecialchars($company); ?></div>
        <div class="tl-desc"><?php echo nl2br(htmlspecialchars($item['text'])); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- TESTIMONIALS -->
<?php if(!empty($referentiesItems)): ?>
<section class="section-alt">
  <div class="container">
    <div class="section-head">
      <span class="sec-eyebrow">Referenties</span>
      <h2>Wat opdrachtgevers zeggen</h2>
      <p>Reacties uit recente trajecten.</p>
    </div>
    <div class="quotes-grid">
      <?php foreach($referentiesItems as $item): 
          // Parse the title which is stored as "Initialen | Naam | Rol"
          $parts = array_map('trim', explode('|', $item['title']));
          $avatar = $parts[0] ?? '';
          $refName = $parts[1] ?? '';
          $refRole = $parts[2] ?? '';
      ?>
      <article class="quote-card">
        <div class="quote-mark">"</div>
        <p class="quote-text"><?php echo nl2br(htmlspecialchars($item['text'])); ?></p>
        <div class="quote-author">
          <div class="quote-avatar"><?php echo htmlspecialchars($avatar); ?></div>
          <div>
            <div class="qa-name"><?php echo htmlspecialchars($refName); ?></div>
            <div class="qa-role"><?php echo htmlspecialchars($refRole); ?></div>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="cta-dark">
  <div class="container">
    <div class="cta-grid">
      <div>
        <span class="caption" style="color:var(--cyan)">Direct contact</span>
        <h2 style="margin-top:14px">Laten we <em>kennismaken</em></h2>
        <p>Vrijblijvend sparren over Microsoft 365, Copilot of adoptie binnen jouw organisatie. Online of op locatie — jij kiest.</p>
        <div class="cta-buttons">
          <a href="../contact.php#booking" class="btn btn-accent">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Plan een gesprek
          </a>
          <a href="mailto:<?php echo htmlspecialchars($email); ?>" class="btn btn-ghost-dark">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            Mail direct
          </a>
        </div>
      </div>

      <div class="info-card-dark">
        <h3>Contactgegevens</h3>
        <div class="ic-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
          <div>
            <div class="ic-lbl">Telefoon</div>
            <div class="ic-val"><a href="tel:<?php echo htmlspecialchars(str_replace(' ', '', $phone)); ?>"><?php echo htmlspecialchars($phone); ?></a></div>
          </div>
        </div>
        <div class="ic-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
          <div>
            <div class="ic-lbl">E-mail</div>
            <div class="ic-val"><a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></div>
          </div>
        </div>
        <div class="ic-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          <div>
            <div class="ic-lbl">LinkedIn</div>
            <div class="ic-val"><a href="https://www.<?php echo htmlspecialchars($linkedin); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($linkedin); ?></a></div>
          </div>
        </div>
        <div class="ic-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <div>
            <div class="ic-lbl">Adres</div>
            <div class="ic-val"><?php echo htmlspecialchars(explode(',', $location)[0]); ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include $base . "partials/footer.php"; ?>

<script>
  // Dynamische vCard generatie
  document.getElementById('vcard-btn')?.addEventListener('click', function () {
    var vcard = [
      'BEGIN:VCARD',
      'VERSION:3.0',
      'N:<?php echo htmlspecialchars($lastName); ?>;<?php echo htmlspecialchars($name); ?>;;;',
      'FN:<?php echo htmlspecialchars($fullName); ?>',
      'ORG:Noppa Solutions & Consultants',
      'TITLE:<?php echo htmlspecialchars($jobTitle); ?>',
      'TEL;TYPE=CELL:<?php echo htmlspecialchars($phone); ?>',
      'EMAIL;TYPE=WORK:<?php echo htmlspecialchars($email); ?>',
      'URL:https://www.noppa.nl',
      'URL;TYPE=LinkedIn:https://<?php echo htmlspecialchars($linkedin); ?>',
      'ADR;TYPE=WORK:;;;<?php echo htmlspecialchars(explode(',', $location)[0]); ?>;;;Nederland',
      'END:VCARD'
    ].join('\r\n');
    var blob = new Blob([vcard], { type: 'text/vcard;charset=utf-8' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = '<?php echo htmlspecialchars($name . "-" . $lastName); ?>-Noppa.vcf';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  });
</script>

</body>
</html>
