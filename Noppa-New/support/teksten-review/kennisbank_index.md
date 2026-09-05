- 

### 

Delen via Discord

Vul een Discord Webhook-URL in en pas het bericht aan. Je vindt de webhook via **Serverinstellingen â†’ Integraties â†’ Webhooks**.

Annuleren
Versturen â†’

### 

Delen via Instagram

Instagram heeft geen directe deellink. Kopieer de tekst hieronder en open Instagram handmatig om een post of story te maken.

Sluiten
Kopieer tekst

Weigeren
Akkoord

marked.setOptions({ breaks: true, gfm: true });

let cfg = null;              // sitenaam / siteUrl uit nav.json
let huidigSlug = null;
let huidigType = null;
let huidigArtikel = null;

// â”€â”€ API â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
const API = {
config:    ()     => fetch('nav.json').then(r => r.json()),
pagina:    (slug) => fetch(`api.php?actie=pagina&slug=${enc(slug)}`).then(ok),
artikelen: (cat)  => fetch(`api.php?actie=artikelen${cat?'&categorie='+enc(cat):''}`).then(ok),
artikel:   (slug) => fetch(`api.php?actie=artikel&slug=${enc(slug)}`).then(ok),
auteur:    (slug) => fetch(`api.php?actie=auteur&slug=${enc(slug)}`).then(ok),
};
const enc = encodeURIComponent;
const ok  = r => { if (!r.ok) throw new Error('Niet gevonden'); return r.json(); };

// â”€â”€ Hash routing â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function parseHash() {
const h = window.location.hash.replace(/^#\//, '');
if (!h) return { type: 'overzicht', slug: null };
const [type, slug] = h.split('/');
if (type === 'artikelen' && !slug)  return { type: 'overzicht', slug: null };
if (type === 'artikel'   &&  slug)  return { type: 'artikel',   slug };
if (type === 'pagina'    &&  slug)  return { type: 'pagina',    slug };
return { type: 'overzicht', slug: null };
}

window.addEventListener('hashchange', () => routeer());

async function routeer() {
const { type, slug } = parseHash();
huidigType = type; huidigSlug = slug;
if      (type === 'overzicht') await laadArtikelenOverzicht();
else if (type === 'artikel')   await laadArtikel(slug);
else                           await laadPagina(slug);
}

// â”€â”€ Bootstrap â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
async function init() {
try {
cfg = await API.config();
await routeer();
} catch(e) { toonFout('Initialisatie mislukt: ' + e.message); }
}

// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
//  GEWONE PAGINA (content/*.md, optioneel — meestal niet gebruikt
//  in kennisbank-modus, want gewone pagina's komen uit hoofdsite)
// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
async function laadPagina(slug) {
toonSkeleton();
try { renderPagina(await API.pagina(slug)); }
catch(e) { toonFout(e.message); }
}

function renderPagina({ slug, title, meta, markdown }) {
const body  = markdown.replace(/^#\s+.+\n?/m, '').trim();
const datum = meta.datum || meta.date || null;
const sub   = meta.beschrijving || meta.description || '';
document.title = `${title} — ${cfg?.sitenaam || 'Noppa'}`;
document.getElementById('pageBody').innerHTML = `

${datum?`Bijgewerkt:${datum}`:''}

${slug}

# ${title}

${sub?`
${sub}
`:''}

${heroRings()}

${marked.parse(body)}

`;
scrollTo({top:0,behavior:'smooth'});
}

// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
//  ARTIKELEN OVERZICHT
// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
let actieveCat = '';

async function laadArtikelenOverzicht(cat) {
if (cat !== undefined) actieveCat = cat;
toonArtikelenSkeleton();
try { renderArtikelenOverzicht(await API.artikelen(actieveCat)); }
catch(e) { toonFout(e.message); }
}

function renderArtikelenOverzicht(artikelen) {
const cats = [...new Set(artikelen.map(a => a.categorie).filter(Boolean))].sort();
document.title = `Kennisbank — ${cfg?.sitenaam || 'Noppa'}`;
document.getElementById('pageBody').innerHTML = `

Kennisbank

# Artikelen

Praktische gidsen, how-to's en diepgaande analyses. Geschreven vanuit echte projecten.

Abonneer via RSS

Alle artikelen
${cats.map(c=>`${c}`).join('')}

${artikelen.length === 0
? `Geen artikelen gevonden.`
: artikelen.map(a => kaartHTML(a)).join('')}

`;
scrollTo({top:0,behavior:'smooth'});
}

function kaartHTML(a) {
return `

${a.datum ? `${formatDatum(a.datum)}` : ''}
${a.categorie ? `${a.categorie}` : ''}

${a.leestijd ? `${a.leestijd}` : ''}

${a.title}
${a.beschrijving ? `${a.beschrijving}
` : ''}

${a.auteur ? `Door ${a.auteur}` : ''}
â†’

`;
}

function filterArtikel(cat) { actieveCat = cat; laadArtikelenOverzicht(cat); }

// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
//  ARTIKEL DETAIL
// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
async function laadArtikel(slug) {
toonSkeleton();
try { renderArtikel(await API.artikel(slug)); }
catch(e) { toonFout(e.message); }
}

function renderArtikel(d) {
huidigArtikel = d;
const body = d.markdown.replace(/^#\s+.+\n?/m, '').trim();
document.title = `${d.title} — ${cfg?.sitenaam||'Noppa'}`;
const baseUrl    = cfg?.siteUrl || window.location.origin;
const artikelUrl = `${baseUrl}/kennisbank/#/artikel/${d.slug}`;

// â”€â”€ Parse koppen voor TOC â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
const kopRegex = /^(#{2,3})\s+(.+)$/gm;
const koppen = [];
let match;
while ((match = kopRegex.exec(body)) !== null) {
const niveau = match[1].length;
const tekst  = match[2].trim();
const id     = 'kop-' + tekst
.toLowerCase()
.replace(/[^a-z0-9\s-]/g, '')
.trim()
.replace(/\s+/g, '-');
koppen.push({ niveau, tekst, id });
}

let html = marked.parse(body);
koppen.forEach(k => {
const tag   = `h${k.niveau}`;
const esc   = k.tekst.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
const regex = new RegExp(`([^`, 'i');
html = html.replace(regex, `$1`);
});

const tocHTML = koppen.length 

Op deze pagina

${koppen.map(k => `

${k.tekst}
`).join('')}

`;

document.getElementById('pageBody').innerHTML = `

â† Terug naar kennisbank

${d.categorie || 'Artikel'}

# ${d.title}

${d.beschrijving ? `
${d.beschrijving}
` : ''}

${d.datum    ? `${formatDatum(d.datum)}` : ''}
${d.auteur   ? `Â·Door ${d.auteur}` : ''}
${d.leestijd ? `Â·${d.leestijd}` : ''}

${heroRings()}

${tocHTML}

${html}

**Gepubliceerd:** ${formatDatum(d.datum)||'onbekend'}
${d.auteur ? ` &nbsp;Â·&nbsp; **Auteur:** ${d.auteur}` : ''}

${d.auteur ? `

` : ''}

Delen

LinkedIn

X

Instagram

Discord

Kopieer link

RSS-feed

â† Alle artikelen

`;

scrollTo({top:0,behavior:'smooth'});

if (d.auteur) {
const auteurSlug = naamNaarSlug(d.auteur);
laadAuteurWidget(auteurSlug);
}

if (koppen.length >= 2) {
initToc(koppen);
}
}

// â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
//  AUTEUR-WIDGET — koppelt aan output/team/.html
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
? `${initialen}'">`
: `${initialen}`;

// Link naar team-profiel
const profielUrl = `../team/${slug}.html`;

const socialsHTML = [
a.linkedin ? `

LinkedIn` : '',
a.twitter ? `

X` : '',
`

Profiel`,
].filter(Boolean).join('');

return `

${fotoHTML}

Over de auteur
${a.naam}
${a.functie ? `${a.functie}` : ''}
${a.bio     ? `${a.bio}
` : ''}
${socialsHTML ? `${socialsHTML}` : ''}

`;
}

// â”€â”€ TOC scroll naar kop â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
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
const doc  = document.documentElement;
const pct  = (window.scrollY / (doc.scrollHeight - doc.clientHeight)) * 100;
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
const itemTop  = tocItem.offsetTop - sidebar.offsetTop;
const visible  = sidebar.scrollTop + sidebar.clientHeight;
if (itemTop  visible - 40) {
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
const d   = huidigArtikel;
const baseUrl = cfg?.siteUrl || window.location.origin;
const url = `${baseUrl}/kennisbank/#/artikel/${d.slug}`;
const tekst = `ðŸ“– ${d.title}\n\n${d.beschrijving || ''}\n\nðŸ”— ${url}\n\n${d.categorie ? '#' + d.categorie.replace(/\s+/g,'') + ' ' : ''}#noppa`;
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
const d   = huidigArtikel;
const baseUrl = cfg?.siteUrl || window.location.origin;
const url = `${baseUrl}/kennisbank/#/artikel/${d.slug}`;
const bericht = `**${d.title}**\n${d.beschrijving || ''}\n\nðŸ”— ${url}`;
document.getElementById('discordBericht').value = bericht;
const opgeslagen = localStorage.getItem('discordWebhook') || '';
document.getElementById('discordWebhook').value = opgeslagen;
document.getElementById('discordModal').classList.add('open');
}

async function verzendDiscord() {
const webhook  = document.getElementById('discordWebhook').value.trim();
const bericht  = document.getElementById('discordBericht').value.trim();
const knop     = document.getElementById('discordVerzend');

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
} catch(e) {
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

// â”€â”€ Helpers â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function heroRings() {
return `

`;
}

function formatDatum(d) {
if (!d) return '';
try { return new Date(d).toLocaleDateString('nl-NL', {day:'numeric',month:'long',year:'numeric'}); }
catch { return d; }
}

function toonSkeleton() {
document.getElementById('pageBody').innerHTML = `

${[100,88,94,82,90,76,85].map(w=>``).join('')}
`;
}

function toonArtikelenSkeleton() {
document.getElementById('pageBody').innerHTML = `

${[80,90,70,95].map(w=>``).join('')}

${[1,2,3].map(()=>`

`).join('')}

`;
}

function toonFout(msg) {
console.error('Kennisbank fout:', msg);
document.getElementById('pageBody').innerHTML = `

âœ• ${msg}
`;
}

init();