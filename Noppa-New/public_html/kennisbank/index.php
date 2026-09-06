<?php
$pageTitle = "Kennisbank — Noppa";
$pageDesc = "Praktische gidsen, how-to's en diepgaande analyses van Noppa. Geschreven vanuit echte projecten.";
$base = "../";
include $base . "partials/header.php";
include $base . "partials/nav.php";
?>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<link rel="stylesheet" href="../css/kennisbank.css">

<!-- Toast melding -->
<div class="toast" id="toast"></div>

<!-- Discord modal -->
<div class="modal-backdrop" id="discordModal">
  <div class="modal">
    <h3>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="#5865f2"
        style="display:inline;vertical-align:middle;margin-right:8px" aria-hidden="true">
        <path
          d="M20.317 4.37a19.79 19.79 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028 14.09 14.09 0 001.226-1.994.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z" />
      </svg>
      Delen via Discord
    </h3>
    <p>Vul een Discord Webhook-URL in en pas het bericht aan. Je vindt de webhook via <strong>Serverinstellingen â†’
        Integraties â†’ Webhooks</strong>.</p>
    <input type="url" class="modal-input" id="discordWebhook" placeholder="https://discord.com/api/webhooks/..." />
    <textarea class="modal-textarea" id="discordBericht"></textarea>
    <div class="modal-actions">
      <button class="modal-close" onclick="sluitModal('discordModal')">Annuleren</button>
      <button class="modal-send" id="discordVerzend" onclick="verzendDiscord()">Versturen â†’</button>
    </div>
  </div>
</div>

<!-- Instagram modal -->
<div class="modal-backdrop" id="instaModal">
  <div class="modal">
    <h3>
      <svg width="18" height="18" viewBox="0 0 24 24" fill="url(#ig)"
        style="display:inline;vertical-align:middle;margin-right:8px" aria-hidden="true">
        <defs>
          <linearGradient id="ig" x1="0%" y1="100%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#f58529" />
            <stop offset="50%" stop-color="#dd2a7b" />
            <stop offset="100%" stop-color="#8134af" />
          </linearGradient>
        </defs>
        <path
          d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
      </svg>
      Delen via Instagram
    </h3>
    <p>Instagram heeft geen directe deellink. Kopieer de tekst hieronder en open Instagram handmatig om een post of
      story te maken.</p>
    <div class="insta-copy-box" id="instaTekst"></div>
    <div class="modal-actions">
      <button class="modal-close" onclick="sluitModal('instaModal')">Sluiten</button>
      <button class="modal-send" style="background:linear-gradient(135deg,#f58529,#dd2a7b,#8134af)"
        onclick="kopieerInsta()">Kopieer tekst</button>
    </div>
  </div>
</div>



<!-- PAGINA BODY -->
<div class="page-wrap">
  <div class="page-body" id="pageBody">
    <div class="hero">
      <div class="container">
        <div class="skel skel-dark" style="width:120px;height:22px;margin-bottom:18px"></div>
        <div class="skel skel-dark" style="width:50%;height:48px;margin-bottom:14px"></div>
        <div class="skel skel-dark" style="width:36%;height:16px"></div>
      </div>
    </div>
  </div>
</div>

<!-- ===== JS ===== -->


<!-- Canonical Noppa partial-loader: injecteert nav + footer -->


<script>
  marked.setOptions({ breaks: true, gfm: true });

  let cfg = null;              // sitenaam / siteUrl uit nav.json
  let huidigSlug = null;
  let huidigType = null;
  let huidigArtikel = null;

  //API
  const API = {
    config: () => fetch('nav.json').then(r => r.json()),
    pagina: (slug) => fetch(`api.php?actie=pagina&slug=${enc(slug)}`).then(ok),
    artikelen: (cat) => fetch(`api.php?actie=artikelen${cat ? '&categorie=' + enc(cat) : ''}`).then(ok),
    artikel: (slug) => fetch(`api.php?actie=artikel&slug=${enc(slug)}`).then(ok),
    auteur: (slug) => fetch(`api.php?actie=auteur&slug=${enc(slug)}`).then(ok),
  };
  const enc = encodeURIComponent;
  const ok = r => { if (!r.ok) throw new Error('Niet gevonden'); return r.json(); };

  // Hash routing 
  function parseHash() {
    const h = window.location.hash.replace(/^#\//, '');
    if (!h) return { type: 'overzicht', slug: null };
    const [type, slug] = h.split('/');
    if (type === 'artikelen' && !slug) return { type: 'overzicht', slug: null };
    if (type === 'artikel' && slug) return { type: 'artikel', slug };
    if (type === 'pagina' && slug) return { type: 'pagina', slug };
    return { type: 'overzicht', slug: null };
  }

  window.addEventListener('hashchange', () => routeer());

  async function routeer() {
    const { type, slug } = parseHash();
    huidigType = type; huidigSlug = slug;
    if (type === 'overzicht') await laadArtikelenOverzicht();
    else if (type === 'artikel') await laadArtikel(slug);
    else await laadPagina(slug);
  }

  //  Bootstrap â”€
  async function init() {
    try {
      cfg = await API.config();
      await routeer();
    } catch (e) { toonFout('Initialisatie mislukt: ' + e.message); }
  }

  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  //  GEWONE PAGINA (content/*.md, optioneel — meestal niet gebruikt
  //  in kennisbank-modus, want gewone pagina's komen uit hoofdsite)
  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  async function laadPagina(slug) {
    toonSkeleton();
    try { renderPagina(await API.pagina(slug)); }
    catch (e) { toonFout(e.message); }
  }

  function renderPagina({ slug, title, meta, markdown }) {
    const body = markdown.replace(/^#\s+.+\n?/m, '').trim();
    const datum = meta.datum || meta.date || null;
    const sub = meta.beschrijving || meta.description || '';
    document.title = `${title} — ${cfg?.sitenaam || 'Noppa'}`;
    document.getElementById('pageBody').innerHTML = `
      <section class="hero fade-in">
        <div class="container" style="position:relative;z-index:2">
          ${datum ? `<div class="breadcrumb"><span>Bijgewerkt:</span><span>${datum}</span></div>` : ''}
          <div class="hero-eyebrow">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" aria-hidden="true"><circle cx="5" cy="5" r="5"/></svg>
            ${slug}
          </div>
          <h1>${title}</h1>
          ${sub ? `<p class="hero-sub">${sub}</p>` : ''}
        </div>
        ${heroRings()}
      </section>
      <section class="content fade-in" style="animation-delay:.1s">
        <div class="container-narrow">
          ${marked.parse(body)}
        </div>
      </section>`;
    scrollTo({ top: 0, behavior: 'smooth' });
  }

  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  //  ARTIKELEN OVERZICHT
  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  let actieveCat = '';

  async function laadArtikelenOverzicht(cat) {
    if (cat !== undefined) actieveCat = cat;
    toonArtikelenSkeleton();
    try { renderArtikelenOverzicht(await API.artikelen(actieveCat)); }
    catch (e) { toonFout(e.message); }
  }

  function renderArtikelenOverzicht(artikelen) {
    const cats = [...new Set(artikelen.map(a => a.categorie).filter(Boolean))].sort();
    document.title = `Kennisbank — ${cfg?.sitenaam || 'Noppa'}`;
    document.getElementById('pageBody').innerHTML = `
      <div class="artikelen-hero fade-in">
        <div class="container artikelen-hero-inner">
          <div class="hero-eyebrow">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" aria-hidden="true"><circle cx="5" cy="5" r="5"/></svg>
            Kennisbank
          </div>
          <h1>Artikelen</h1>
          <p class="hero-sub">Praktische gidsen, how-to's en diepgaande analyses. Geschreven vanuit echte projecten.</p>
          <a class="rss-badge" href="rss.php" target="_blank" rel="noopener">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M6.18 15.64a2.18 2.18 0 010 4.36 2.18 2.18 0 010-4.36M4 4.44A15.56 15.56 0 0119.56 20h-2.83A12.73 12.73 0 004 7.27V4.44m0 5.66a9.9 9.9 0 019.9 9.9h-2.83A7.07 7.07 0 004 12.93V10.1z"/>
            </svg>
            Abonneer via RSS
          </a>
        </div>
      </div>
      <section style="padding:0 0 80px">
        <div class="container">
          <div class="filter-bar">
            <button class="filter-tab ${!actieveCat ? 'actief' : ''}" onclick="filterArtikel('')">Alle artikelen</button>
            ${cats.map(c => `<button class="filter-tab ${actieveCat === c ? 'actief' : ''}" onclick="filterArtikel('${c}')">${c}</button>`).join('')}
          </div>
          <div class="artikelen-grid">
            ${artikelen.length === 0
        ? `<div class="leeg-state">Geen artikelen gevonden.</div>`
        : artikelen.map(a => kaartHTML(a)).join('')}
          </div>
        </div>
      </section>`;
    scrollTo({ top: 0, behavior: 'smooth' });
  }

  function kaartHTML(a) {
    return `
      <a class="artikel-kaart fade-in" href="#/artikel/${a.slug}">
        <div class="kaart-top">
          <div class="kaart-meta">
            ${a.datum ? `<span class="kaart-datum">${formatDatum(a.datum)}</span>` : ''}
            ${a.categorie ? `<span class="kaart-cat">${a.categorie}</span>` : ''}
          </div>
          ${a.leestijd ? `<span class="kaart-leestijd">${a.leestijd}</span>` : ''}
        </div>
        <div class="kaart-body">
          <div class="kaart-titel">${a.title}</div>
          ${a.beschrijving ? `<p class="kaart-beschrijving">${a.beschrijving}</p>` : ''}
        </div>
        <div class="kaart-footer">
          <span class="kaart-auteur">${a.auteur ? `Door ${a.auteur}` : ''}</span>
          <span class="kaart-pijl">â†’</span>
        </div>
      </a>`;
  }

  function filterArtikel(cat) { actieveCat = cat; laadArtikelenOverzicht(cat); }

  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  //  ARTIKEL DETAIL
  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  async function laadArtikel(slug) {
    toonSkeleton();
    try { renderArtikel(await API.artikel(slug)); }
    catch (e) { toonFout(e.message); }
  }

  function renderArtikel(d) {
    huidigArtikel = d;
    const body = d.markdown.replace(/^#\s+.+\n?/m, '').trim();
    document.title = `${d.title} — ${cfg?.sitenaam || 'Noppa'}`;
    const baseUrl = cfg?.siteUrl || window.location.origin;
    const artikelUrl = `${baseUrl}/kennisbank/#/artikel/${d.slug}`;

    //  Parse koppen voor TOC 
    const kopRegex = /^(#{2,3})\s+(.+)$/gm;
    const koppen = [];
    let match;
    while ((match = kopRegex.exec(body)) !== null) {
      const niveau = match[1].length;
      const tekst = match[2].trim();
      const id = 'kop-' + tekst
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-');
      koppen.push({ niveau, tekst, id });
    }

    let html = marked.parse(body);
    koppen.forEach(k => {
      const tag = `h${k.niveau}`;
      const esc = k.tekst.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
      const regex = new RegExp(`<${tag}>([^<]*${esc}[^<]*)<\/${tag}>`, 'i');
      html = html.replace(regex, `<${tag} id="${k.id}">$1</${tag}>`);
    });

    const tocHTML = koppen.length < 2 ? '' : `
      <aside class="toc-sidebar" id="tocSidebar">
        <div class="toc-progress"><div class="toc-progress-inner" id="tocProgress"></div></div>
        <span class="toc-label">Op deze pagina</span>
        <ul class="toc-list">
          ${koppen.map(k => `
            <li class="toc-item ${k.niveau === 3 ? 'h3' : ''}" data-toc-id="${k.id}">
              <a href="#${k.id}" onclick="scrollNaarKop(event,'${k.id}')">${k.tekst}</a>
            </li>`).join('')}
        </ul>
      </aside>`;

    document.getElementById('pageBody').innerHTML = `
      <section class="hero fade-in">
        <div class="container" style="position:relative;z-index:2">
          <button class="artikel-back" onclick="history.back()">â† Terug naar kennisbank</button>
          <div class="hero-eyebrow">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" aria-hidden="true"><circle cx="5" cy="5" r="5"/></svg>
            ${d.categorie || 'Artikel'}
          </div>
          <h1>${d.title}</h1>
          ${d.beschrijving ? `<p class="hero-sub">${d.beschrijving}</p>` : ''}
          <div class="hero-meta">
            ${d.datum ? `<span>${formatDatum(d.datum)}</span>` : ''}
            ${d.auteur ? `<span style="margin:0 10px">Â·</span><span>Door ${d.auteur}</span>` : ''}
            ${d.leestijd ? `<span style="margin:0 10px">Â·</span><span>${d.leestijd}</span>` : ''}
          </div>
        </div>
        ${heroRings()}
      </section>

      <div class="artikel-prose fade-in" style="animation-delay:.1s">
        <div class="artikel-layout">

          ${tocHTML}

          <div class="artikel-content-col">
            ${html}

            <div class="artikel-meta-box">
              <strong>Gepubliceerd:</strong> ${formatDatum(d.datum) || 'onbekend'}
              ${d.auteur ? ` &nbsp;Â·&nbsp; <strong>Auteur:</strong> ${d.auteur}` : ''}
            </div>

            ${d.auteur ? `<div id="auteurWidget" class="auteur-widget-skel">
              <div class="skel" style="width:72px;height:72px;border-radius:50%;flex-shrink:0"></div>
              <div style="flex:1;display:flex;flex-direction:column;gap:10px;padding-top:4px">
                <div class="skel" style="width:50%;height:13px"></div>
                <div class="skel" style="width:35%;height:11px"></div>
                <div class="skel" style="width:100%;height:11px"></div>
                <div class="skel" style="width:85%;height:11px"></div>
              </div>
            </div>` : ''}

          <div class="deel-balk">
            <span class="deel-label">Delen</span>

            <a class="deel-btn linkedin"
               href="https://www.linkedin.com/sharing/share-offsite/?url=${enc(artikelUrl)}"
               target="_blank" rel="noopener">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
              LinkedIn
            </a>

            <a class="deel-btn xtwitter"
               href="https://twitter.com/intent/tweet?text=${enc(d.title)}&url=${enc(artikelUrl)}"
               target="_blank" rel="noopener">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
              </svg>
              X
            </a>

            <button class="deel-btn instagram" onclick="openInstaModal()">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
              Instagram
            </button>

            <button class="deel-btn discord" onclick="openDiscordModal()">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M20.317 4.37a19.79 19.79 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028 14.09 14.09 0 001.226-1.994.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/>
              </svg>
              Discord
            </button>

            <button class="deel-btn kopieer" onclick="kopieerLink('${artikelUrl.replace(/'/g, "\\'")}')">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>
              </svg>
              Kopieer link
            </button>

            <a class="deel-btn rss" href="rss.php" target="_blank" rel="noopener">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M6.18 15.64a2.18 2.18 0 010 4.36 2.18 2.18 0 010-4.36M4 4.44A15.56 15.56 0 0119.56 20h-2.83A12.73 12.73 0 004 7.27V4.44m0 5.66a9.9 9.9 0 019.9 9.9h-2.83A7.07 7.07 0 004 12.93V10.1z"/>
              </svg>
              RSS-feed
            </a>
          </div>

          <div style="margin-top:32px">
            <a href="#/artikelen" class="btn btn-dark">â† Alle artikelen</a>
          </div>
          </div><!-- /artikel-content-col -->
        </div><!-- /artikel-layout -->
      </div><!-- /artikel-prose -->`;

    scrollTo({ top: 0, behavior: 'smooth' });

    if (d.auteur) {
      const auteurSlug = naamNaarSlug(d.auteur);
      laadAuteurWidget(auteurSlug);
    }

    if (koppen.length >= 2) {
      initToc(koppen);
    }
  }

  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  //  AUTEUR-WIDGET — koppelt aan output/team/<slug>.html
  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  function naamNaarSlug(naam) {
    return naam
      .toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9\s-]/g, '')
      .trim()
      .replace(/\s+/g, '-');
  }

  async function laadAuteurWidget(slug) {
    const el = document.getElementById('auteurWidget');
    if (!el) return;
    try {
      const auteur = await API.auteur(slug);
      el.outerHTML = renderAuteurWidget(auteur, slug);
    } catch {
      const el2 = document.getElementById('auteurWidget');
      if (el2) el2.remove();
    }
  }

  function renderAuteurWidget(a, slug) {
    const initialen = (a.naam || '?')
      .split(' ')
      .map(w => w[0])
      .slice(0, 2)
      .join('')
      .toUpperCase();

    // Foto-pad: het kan een relatief pad zijn vanuit team/*.html
    // (bv. "../assets/images/Rik Dobbelsteen - Foto website.jpeg").
    // Vanuit kennisbank/index.html werkt hetzelfde pad omdat
    // /output/kennisbank/ en /output/team/ even diep zitten.
    const fotoHTML = a.foto
      ? `<img class="auteur-avatar" src="${a.foto}" alt="${a.naam}" loading="lazy"
             onerror="this.outerHTML='<div class=\\'auteur-avatar-placeholder\\'>${initialen}</div>'">`
      : `<div class="auteur-avatar-placeholder">${initialen}</div>`;

    // Link naar team-profiel
    const profielUrl = `../team/${slug}.html`;

    const socialsHTML = [
      a.linkedin ? `<a class="auteur-social-link linkedin" href="${a.linkedin}" target="_blank" rel="noopener">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
        LinkedIn</a>` : '',
      a.twitter ? `<a class="auteur-social-link twitter" href="${a.twitter}" target="_blank" rel="noopener">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
        X</a>` : '',
      `<a class="auteur-social-link website" href="${profielUrl}">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
        Profiel</a>`,
    ].filter(Boolean).join('');

    return `
      <div class="auteur-widget" id="auteurWidget">
        ${fotoHTML}
        <div class="auteur-info">
          <span class="auteur-label">Over de auteur</span>
          <div class="auteur-naam">${a.naam}</div>
          ${a.functie ? `<div class="auteur-functie">${a.functie}</div>` : ''}
          ${a.bio ? `<p class="auteur-bio">${a.bio}</p>` : ''}
          ${socialsHTML ? `<div class="auteur-socials">${socialsHTML}</div>` : ''}
        </div>
      </div>`;
  }

  //  TOC scroll naar kop 
  function scrollNaarKop(e, id) {
    e.preventDefault();
    const el = document.getElementById(id);
    if (!el) return;
    const offset = 88;
    const top = el.getBoundingClientRect().top + window.scrollY - offset;
    window.scrollTo({ top, behavior: 'smooth' });
  }

  function initToc(koppen) {
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

    koppen.forEach(k => {
      const el = document.getElementById(k.id);
      if (el) observer.observe(el);
    });

    window.addEventListener('hashchange', () => {
      observer.disconnect();
      window.removeEventListener('scroll', updateProgress);
    }, { once: true });
  }

  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  //  DEEL-FUNCTIES
  // â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
  function kopieerLink(url) {
    navigator.clipboard.writeText(url).then(() => toonToast('âœ“ Link gekopieerd!'));
  }

  function openInstaModal() {
    if (!huidigArtikel) return;
    const d = huidigArtikel;
    const baseUrl = cfg?.siteUrl || window.location.origin;
    const url = `${baseUrl}/kennisbank/#/artikel/${d.slug}`;
    const tekst = `ðŸ“– ${d.title}\n\n${d.beschrijving || ''}\n\nðŸ”— ${url}\n\n${d.categorie ? '#' + d.categorie.replace(/\s+/g, '') + ' ' : ''}#noppa`;
    document.getElementById('instaTekst').textContent = tekst;
    document.getElementById('instaModal').classList.add('open');
  }
  function kopieerInsta() {
    const tekst = document.getElementById('instaTekst').textContent;
    navigator.clipboard.writeText(tekst).then(() => {
      toonToast('âœ“ Tekst gekopieerd! Open Instagram om te plakken.');
      sluitModal('instaModal');
    });
  }

  function openDiscordModal() {
    if (!huidigArtikel) return;
    const d = huidigArtikel;
    const baseUrl = cfg?.siteUrl || window.location.origin;
    const url = `${baseUrl}/kennisbank/#/artikel/${d.slug}`;
    const bericht = `**${d.title}**\n${d.beschrijving || ''}\n\nðŸ”— ${url}`;
    document.getElementById('discordBericht').value = bericht;
    const opgeslagen = localStorage.getItem('discordWebhook') || '';
    document.getElementById('discordWebhook').value = opgeslagen;
    document.getElementById('discordModal').classList.add('open');
  }

  async function verzendDiscord() {
    const webhook = document.getElementById('discordWebhook').value.trim();
    const bericht = document.getElementById('discordBericht').value.trim();
    const knop = document.getElementById('discordVerzend');

    if (!webhook) { toonToast('âš  Vul een webhook-URL in'); return; }
    if (!webhook.startsWith('https://discord.com/api/webhooks/')) {
      toonToast('âš  Geen geldige Discord webhook-URL'); return;
    }
    if (!bericht) { toonToast('âš  Bericht is leeg'); return; }

    knop.disabled = true;
    knop.textContent = 'Versturen...';

    try {
      const res = await fetch(webhook, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ content: bericht })
      });
      if (res.ok) {
        localStorage.setItem('discordWebhook', webhook);
        toonToast('âœ“ Bericht verstuurd naar Discord!');
        sluitModal('discordModal');
      } else {
        toonToast('âœ— Fout: ' + res.status + ' — controleer de webhook-URL');
      }
    } catch (e) {
      toonToast('âœ— Versturen mislukt: ' + e.message);
    } finally {
      knop.disabled = false;
      knop.textContent = 'Versturen â†’';
    }
  }

  function sluitModal(id) {
    document.getElementById(id).classList.remove('open');
  }
  document.querySelectorAll('.modal-backdrop').forEach(el => {
    el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
  });

  function toonToast(tekst) {
    const t = document.getElementById('toast');
    t.textContent = tekst;
    t.classList.add('show');
    clearTimeout(t._timer);
    t._timer = setTimeout(() => t.classList.remove('show'), 3000);
  }

  //  Helpers
  function heroRings() {
    return ``;
  }

  function formatDatum(d) {
    if (!d) return '';
    try { return new Date(d).toLocaleDateString('nl-NL', { day: 'numeric', month: 'long', year: 'numeric' }); }
    catch { return d; }
  }

  function toonSkeleton() {
    document.getElementById('pageBody').innerHTML = `
      <div style="background:var(--donker);padding:120px 0 72px">
        <div class="container">
          <div class="skel skel-dark" style="width:120px;height:22px;margin-bottom:18px"></div>
          <div class="skel skel-dark" style="width:52%;height:48px;margin-bottom:14px"></div>
          <div class="skel skel-dark" style="width:36%;height:16px"></div>
        </div>
      </div>
      <div class="container-narrow" style="padding-top:52px">
        ${[100, 88, 94, 82, 90, 76, 85].map(w => `<div class="skel" style="width:${w}%;height:13px;margin-bottom:14px"></div>`).join('')}
      </div>`;
  }

  function toonArtikelenSkeleton() {
    document.getElementById('pageBody').innerHTML = `
      <div style="background:var(--donker);padding:120px 0 72px">
        <div class="container">
          <div class="skel skel-dark" style="width:100px;height:22px;margin-bottom:18px"></div>
          <div class="skel skel-dark" style="width:30%;height:48px;margin-bottom:14px"></div>
          <div class="skel skel-dark" style="width:45%;height:16px"></div>
        </div>
      </div>
      <div class="container" style="padding-top:48px">
        <div style="display:flex;gap:8px;margin-bottom:40px">
          ${[80, 90, 70, 95].map(w => `<div class="skel" style="width:${w}px;height:34px;border-radius:100px"></div>`).join('')}
        </div>
        <div class="artikelen-grid">
          ${[1, 2, 3].map(() => `<div class="skel-kaart">
            <div class="skel" style="width:60%;height:12px"></div>
            <div class="skel" style="width:90%;height:20px;margin-top:4px"></div>
            <div class="skel" style="width:100%;height:12px;margin-top:8px"></div>
            <div class="skel" style="width:80%;height:12px"></div>
          </div>`).join('')}
        </div>
      </div>`;
  }

  function toonFout(msg) {
    console.error('Kennisbank fout:', msg);
    document.getElementById('pageBody').innerHTML = `
      <div class="container-narrow">
        <div class="fout-box fade-in">âœ• ${msg}</div>
      </div>`;
  }

  init();
</script>


<?php include $base . "partials/footer.php"; ?>