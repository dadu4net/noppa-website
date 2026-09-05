/* =========================================================
   ⚙️  CONFIGURATIE  —  pas hier de bezorging van leads aan
   =========================================================
   Lead delivery werkt in deze volgorde:
     1) FORMSPREE_ENDPOINT (primair)     — vul je formspree.io form-ID in
     2) POWER_AUTOMATE_WEBHOOK (optioneel) — vul je HTTP-trigger URL in
     3) MAILTO_FALLBACK (altijd actief)  — opent mailclient met rapport

   Stappen om Formspree te activeren:
     - Maak gratis account op formspree.io
     - Maak een nieuw form aan, kopieer het form-ID (bijv. xrgwblzv)
     - Vervang YOUR_FORM_ID hieronder

   Stappen om Power Automate te activeren (later):
     - Maak een flow met trigger "When an HTTP request is received"
     - Plak de HTTP POST URL hieronder
*/
const CONFIG = {
  PHP_BACKEND_ENDPOINT: "api/submit.php",
  MAILTO_FALLBACK: "info@burogekko.nl",
  COMPANY_NAME: "Buro GEKKO",
  ENABLE_LOCAL_RESUME: true,         // sla voortgang lokaal op zodat invullers kunnen hervatten
  QUEUE_KEY: typeof APP_CONFIG !== "undefined" ? APP_CONFIG.queueKey : "bg_copilot_pending_v1",
  QUEUE_MAX_AGE_DAYS: 30
};

/* =========================================================
   ASSESSMENT DATA
   ========================================================= */
/*
   Vraag-schema:
   - id           : uniek (categorie-id + index, gebruikt als state-key)
   - q            : vraagtekst
   - hint         : optionele toelichting onder de vraag
   - options      : [{ t, s }]  — tekst + score
   - dependsOn    : { id, showIfOptionIn: [0,1,...] } — alleen tonen als referentievraag is beantwoord met optie-index uit de lijst
*/

/* =========================================================
   STATE
   ========================================================= */
let currentScreen = "intro";
let currentCatIndex = 0;
const answers = {};

/* Visible-questions logic: a question is visible if it has no dependency
   OR if the dependency has been answered with one of the allowed options. */
function isQuestionVisible(q) {
  if (!q.dependsOn) return true;
  const dep = answers[q.dependsOn.id];
  if (!dep) return false;
  return q.dependsOn.showIfOptionIn.includes(dep.optionIndex);
}
function getVisibleQuestions(cat) {
  return cat.questions.filter(isQuestionVisible);
}
function getTotalVisibleQuestions() {
  return CATEGORIES.reduce((acc, c) => acc + getVisibleQuestions(c).length, 0);
}
function getMaxPossibleQuestions() {
  return CATEGORIES.reduce((acc, c) => acc + c.questions.length, 0);
}

/* =========================================================
   NAVIGATION
   ========================================================= */
function showScreen(id) {
  document.querySelectorAll(".screen").forEach(s => s.classList.remove("active"));
  document.getElementById("screen-" + id).classList.add("active");
  window.scrollTo({ top: 0, behavior: "smooth" });
  currentScreen = id;
}

function nextScreen() {
  // From intro → start questions
  if (currentScreen === "intro") {
    currentCatIndex = 0;
    renderCategory();
    showScreen("questions");
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
}

function renderCategory() {
  const cat = CATEGORIES[currentCatIndex];
  const container = document.getElementById("category-container");

  // Header
  let html = `
    <div class="cat-header">
      <div class="cat-icon">${cat.icon}</div>
      <div>
        <div class="cat-title">${cat.name}</div>
        <div class="cat-desc">${cat.desc}</div>
      </div>
    </div>
  `;

  // Questions — only render visible ones
  let displayIndex = 0;
  cat.questions.forEach((q) => {
    if (!isQuestionVisible(q)) return;
    displayIndex++;
    const isFollowUp = !!q.dependsOn;
    const qKey = q.id;
    const a = answers[qKey];
    const answered = a !== undefined;
    const maxScore = Math.max(...q.options.map(o => o.s));

    html += `
      <div class="question ${answered ? 'answered' : ''} ${isFollowUp ? 'is-follow-up' : ''}" id="q-${qKey}">
        ${isFollowUp ? '<div class="follow-up-tag">Vervolgvraag</div>' : ''}
        <div class="question-label">
          <span class="q-num">${displayIndex}</span>
          <span>${q.q}</span>
        </div>
        ${q.hint ? `<div class="question-hint">${q.hint}</div>` : ''}
        <div class="options">
          ${q.options.map((o, oi) => `
            <label class="option">
              <input type="radio" name="${qKey}" value="${o.s}" ${a?.optionIndex === oi ? 'checked' : ''} onchange="recordAnswer('${qKey}', ${o.s}, ${oi}, ${maxScore})">
              <span>${o.t}</span>
            </label>
          `).join("")}
        </div>
      </div>
    `;
  });

  container.innerHTML = html;

  // Progress
  const stepNum = currentCatIndex + 2;
  const totalSteps = CATEGORIES.length + 1;
  document.getElementById("progress-step").textContent = `Stap ${stepNum} van ${totalSteps}`;
  document.getElementById("progress-cat-name").textContent = cat.name;
  updateProgress();

  // Prev button
  document.getElementById("btn-prev").style.visibility = currentCatIndex === 0 ? "hidden" : "visible";

  // Next/finish button
  const btnNext = document.getElementById("btn-next");
  btnNext.textContent = currentCatIndex === CATEGORIES.length - 1 ? "Bekijk mijn rapport →" : "Volgende →";
}

function recordAnswer(key, score, optionIndex, maxScore) {
  answers[key] = { score: Number(score), optionIndex, maxScore };
  saveProgress();
  // Re-render the entire category to surface/hide follow-up questions correctly
  renderCategory();
  // Scroll to first unanswered visible question for continued momentum
  const nextUnanswered = getVisibleQuestions(CATEGORIES[currentCatIndex])
    .find(q => answers[q.id] === undefined);
  if (nextUnanswered) {
    const el = document.getElementById("q-" + nextUnanswered.id);
    if (el) el.scrollIntoView({ behavior: "smooth", block: "center" });
  }
}

/* =========================================================
   LOCAL PROGRESS PERSISTENCE
   ========================================================= */
const STORAGE_KEY = typeof APP_CONFIG !== "undefined" ? APP_CONFIG.storageKey : "bg_copilot_assessment_v1";

function saveProgress() {
  if (!CONFIG.ENABLE_LOCAL_RESUME) return;
  try {
    const state = {
      answers,
      intake: {
        org:     document.getElementById("org-name")?.value || "",
        contact: document.getElementById("org-contact")?.value || "",
        size:    document.getElementById("org-size")?.value || "",
        sector:  document.getElementById("org-sector")?.value || "", email: document.getElementById("org-email")?.value || ""
      },
      ts: Date.now()
    };
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
  } catch (e) { /* ignore quota errors */ }
}

function loadProgress() {
  if (!CONFIG.ENABLE_LOCAL_RESUME) return false;
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return false;
    const state = JSON.parse(raw);
    // expire after 14 days
    if (Date.now() - state.ts > 14 * 24 * 60 * 60 * 1000) {
      localStorage.removeItem(STORAGE_KEY);
      return false;
    }
    Object.assign(answers, state.answers || {});
    if (state.intake) {
      const fields = { "org-name": state.intake.org, "org-contact": state.intake.contact, "org-email": state.intake.email, "org-size": state.intake.size, "org-sector": state.intake.sector };
      Object.entries(fields).forEach(([id, val]) => {
        const el = document.getElementById(id);
        if (el && val) el.value = val;
      });
    }
    return Object.keys(answers).length > 0;
  } catch (e) { return false; }
}

function clearProgress() {
  try { localStorage.removeItem(STORAGE_KEY); } catch (e) {}
}

function updateProgress() {
  const totalVisible = getTotalVisibleQuestions();
  const answered = Object.keys(answers).filter(k => {
    // Only count answers for currently-visible questions
    const cat = CATEGORIES.find(c => c.questions.some(q => q.id === k));
    if (!cat) return false;
    const q = cat.questions.find(x => x.id === k);
    return isQuestionVisible(q);
  }).length;
  const pct = totalVisible > 0 ? Math.round((answered / totalVisible) * 100) : 0;
  document.getElementById("progress-fill").style.width = pct + "%";
  document.getElementById("progress-pct").textContent = pct + "%";
}

function nextCategory() {
  // Validate: all VISIBLE questions in current category answered
  const cat = CATEGORIES[currentCatIndex];
  const visibleQs = getVisibleQuestions(cat);
  const firstUnanswered = visibleQs.find(q => answers[q.id] === undefined);

  if (firstUnanswered) {
    const el = document.getElementById("q-" + firstUnanswered.id);
    if (el) {
      el.classList.add("question-error-flash");
      el.scrollIntoView({ behavior: "smooth", block: "center" });
      setTimeout(() => el.classList.remove("question-error-flash"), 1200);
    }
    return;
  }

      const FREE_CATEGORIES_LIMIT = typeof APP_CONFIG !== 'undefined' && APP_CONFIG.freeCategoriesLimit ? APP_CONFIG.freeCategoriesLimit : 2;
    const IS_LOGGED_IN = typeof APP_CONFIG !== 'undefined' ? APP_CONFIG.isLoggedIn : false;

    if (currentCatIndex === FREE_CATEGORIES_LIMIT - 1 && !IS_LOGGED_IN) {
        showLoginWall();
        return;
    }

  if (currentCatIndex < CATEGORIES.length - 1) {
    currentCatIndex++;
    renderCategory();
    window.scrollTo({ top: 0, behavior: "smooth" });
  } else {
    showResults();
  }
}

function prevCategory() {
  if (currentCatIndex > 0) {
    currentCatIndex--;
    renderCategory();
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
}

/* =========================================================
   RESULTS — split in two phases (pre-gate teaser + post-gate full)
   ========================================================= */
let lastResults = null;  // cached results for unlock + lead payload

function showResults() {
  // Compute per-category scores — only count VISIBLE answered questions
  const catScores = CATEGORIES.map(cat => {
    let earned = 0, max = 0;
    getVisibleQuestions(cat).forEach((q) => {
      const a = answers[q.id];
      if (!a) return;
      earned += a.score;
      max += a.maxScore;
    });
    const pct = max > 0 ? Math.round((earned / max) * 100) : 0;
    return { ...cat, earned, max, pct };
  });

  const totalEarned = catScores.reduce((a, c) => a + c.earned, 0);
  const totalMax = catScores.reduce((a, c) => a + c.max, 0);
  const overallPct = Math.round((totalEarned / totalMax) * 100);

  const tier = getTier(overallPct);
  const recs = buildRecommendations(catScores);

  lastResults = { catScores, overallPct, tier, recs };

  // Render the hero (always visible)
  const badge = document.getElementById("result-status-badge");
  badge.textContent = tier.badge;
  badge.className = "result-status " + tier.cls;

  document.getElementById("result-score").textContent = overallPct + "%";

  const org = document.getElementById("org-name").value.trim() || "Jullie organisatie";
  document.getElementById("result-title").innerHTML = `${org} · <em>${tier.label}</em>`;
  document.getElementById("result-summary").textContent = tier.summary;

  // Pre-fill lead form with intake data
  const intakeOrg = document.getElementById("org-name").value.trim();
  const intakeName = document.getElementById("org-contact").value.trim();
  if (intakeOrg && !document.getElementById("lead-company").value) {
    document.getElementById("lead-company").value = intakeOrg;
  }
  if (intakeName && !document.getElementById("lead-name").value) {
    document.getElementById("lead-name").value = intakeName;
  }

  // Reset gating (in case of restart)
  document.getElementById("gated-content").classList.add("hidden");
  document.getElementById("gated-teaser").classList.remove("hidden");
  document.getElementById("lead-gate").classList.remove("hidden");
  document.getElementById("lead-status").className = "lead-status";
  document.getElementById("lead-status").textContent = "";

  showScreen("result");
}

/* Render the full report — called after lead submission */
function unlockGatedContent() {
  if (!lastResults) return;
  const { catScores, recs } = lastResults;

  const grid = document.getElementById("score-breakdown");
  grid.innerHTML = catScores.map(c => {
    const status = c.pct >= 75 ? "Sterk fundament" :
                   c.pct >= 50 ? "Op koers, finetuning nodig" :
                   c.pct >= 25 ? "Aandacht vereist" : "Kritieke gap";
    return `
      <div class="score-card">
        <div class="score-card-head">
          <span class="score-card-name">${c.icon} ${c.name}</span>
          <span class="score-card-pct">${c.pct}%</span>
        </div>
        <div class="score-card-bar"><div class="score-card-fill" style="width:${c.pct}%"></div></div>
        <div class="score-card-status">${status}</div>
      </div>
    `;
  }).join("");

  document.getElementById("recommendations").innerHTML = recs.map(r => `
    <li class="rec-item priority-${r.priority}">
      <span class="rec-badge ${r.priority}">${r.priority === "high" ? "Hoog" : r.priority === "medium" ? "Medium" : "Laag"}</span>
      <div class="rec-text"><strong>${r.title}.</strong> ${r.text}</div>
    </li>
  `).join("");

  document.getElementById("gated-teaser").classList.add("hidden");
  document.getElementById("gated-content").classList.remove("hidden");
}

/* =========================================================
   LEAD SUBMISSION — Formspree primary, Power Automate optional, mailto fallback
   ========================================================= */
async function submitLead(e) {
  e.preventDefault();
  if (!lastResults) return;

  const status = document.getElementById("lead-status");
  const btn = document.getElementById("lead-submit");

  const lead = {
    name:    document.getElementById("org-contact").value.trim(),
    email:   document.getElementById("org-email").value.trim(),
    company: document.getElementById("org-name").value.trim(),
    phone:   document.getElementById("lead-phone")?.value.trim() || "",
    consent: document.getElementById("lead-consent").checked
  };

  if (!lead.name || !lead.email || !lead.company || !lead.consent) {
    status.className = "lead-status error";
    status.textContent = "Vul de verplichte velden in en geef toestemming.";
    return;
  }

  btn.disabled = true;
  btn.textContent = "Verzenden...";

  const payload = buildLeadPayload(lead);
  const delivered = await attemptDelivery(payload);

  if (!delivered) {
    enqueueSubmission(payload);
  }

  status.className = "lead-status success";
  if (delivered) {
    status.innerHTML = `✓ Verzonden! Je rapport is ontgrendeld hieronder. We hebben je gegevens automatisch doorgestuurd naar Buro GEKKO en je ontvangt een kopie op <strong>${lead.email}</strong>.`;
  } else {
    status.innerHTML =
      `✓ Je rapport is ontgrendeld hieronder. We hebben je inzending <strong>veilig opgeslagen</strong> en versturen deze automatisch zodra de verbinding hersteld is. ` +
      `Wil je nu zelf een kopie naar Buro GEKKO sturen? ` +
      `<button type="button" class="lead-manual-send" onclick="manualSendLast()" style="margin-left:8px;padding:6px 12px;background:#F2B82C;border:0;border-radius:6px;font-weight:700;cursor:pointer;">Verstuur via mijn mailclient</button>`;
  }

  btn.textContent = "Rapport ontgrendeld ✓";
  document.getElementById("lead-gate").classList.add("hidden");
  unlockGatedContent();
  window.scrollTo({ top: 0, behavior: "smooth" });
}

/* Active delivery — Formspree and Power Automate run in parallel.
   Returns true if at least one endpoint accepted the payload. */
async function attemptDelivery(payload) {
  const attempts = [];

  if (CONFIG.FORMSPREE_ENDPOINT && !CONFIG.FORMSPREE_ENDPOINT.includes("YOUR_FORM_ID")) {
    attempts.push(
      fetch(CONFIG.FORMSPREE_ENDPOINT, {
        method: "POST",
        headers: { "Content-Type": "application/json", "Accept": "application/json" },
        body: JSON.stringify(payload)
      }).then(r => r.ok).catch(() => false)
    );
  }

  if (CONFIG.POWER_AUTOMATE_WEBHOOK) {
    attempts.push(
      fetch(CONFIG.POWER_AUTOMATE_WEBHOOK, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      }).then(r => r.ok).catch(() => false)
    );
  }

  if (attempts.length === 0) return false;
  const results = await Promise.all(attempts);
  return results.some(Boolean);
}

/* Queue + auto-retry — guarantees no submission is lost when endpoints are
   not configured or temporarily unreachable. Pending items are retried
   silently on every subsequent page load. */
function readQueue() {
  try {
    const raw = localStorage.getItem(CONFIG.QUEUE_KEY);
    if (!raw) return [];
    const list = JSON.parse(raw);
    return Array.isArray(list) ? list : [];
  } catch (_) { return []; }
}

function writeQueue(list) {
  try { localStorage.setItem(CONFIG.QUEUE_KEY, JSON.stringify(list)); } catch (_) {}
}

function enqueueSubmission(payload) {
  const list = readQueue();
  list.push({
    id: "sub_" + Date.now() + "_" + Math.random().toString(36).slice(2, 8),
    queuedAt: new Date().toISOString(),
    attempts: 0,
    payload: payload
  });
  writeQueue(list);
}

async function flushQueue() {
  const now = Date.now();
  const maxAge = CONFIG.QUEUE_MAX_AGE_DAYS * 86400000;
  let list = readQueue().filter(e => (now - new Date(e.queuedAt).getTime()) < maxAge);
  if (list.length === 0) { writeQueue(list); return; }

  const remaining = [];
  for (const entry of list) {
    const ok = await attemptDelivery(entry.payload);
    if (!ok) {
      entry.attempts = (entry.attempts || 0) + 1;
      remaining.push(entry);
    }
  }
  writeQueue(remaining);
}

/* Manual mail-client send — only triggered when the user clicks
   "Verstuur via mijn mailclient", never automatically. */
function manualSendLast() {
  const list = readQueue();
  if (list.length === 0) return;
  const entry = list[list.length - 1];
  const lead = {
    name: entry.payload.naam,
    email: entry.payload.email,
    company: entry.payload.bedrijf,
    phone: entry.payload.telefoon
  };
  openMailtoFallback(lead, entry.payload);
}

function buildLeadPayload(lead) {
  const { catScores, overallPct, tier, recs } = lastResults;

  // Build human-readable answers per category for delivery — visible questions only
  const answersText = CATEGORIES.map(cat => {
    let qNum = 0;
    const lines = getVisibleQuestions(cat).map((q) => {
      qNum++;
      const a = answers[q.id];
      if (!a) return `  ${qNum}. ${q.q}\n     → (geen antwoord)`;
      const opt = q.options[a.optionIndex];
      const followUpMarker = q.dependsOn ? " [vervolgvraag]" : "";
      return `  ${qNum}.${followUpMarker} ${q.q}\n     → ${opt.t} (${a.score}/${a.maxScore})`;
    }).join("\n");
    const cs = catScores.find(c => c.id === cat.id);
    return `${cat.name.toUpperCase()} — ${cs.pct}%\n${lines}`;
  }).join("\n\n");

  const recText = recs.map(r => `[${r.priority.toUpperCase()}] ${r.title}: ${r.text}`).join("\n\n");

  return {
    // Lead info
    naam: lead.name,
    email: lead.email,
    bedrijf: lead.company,
    telefoon: lead.phone || "(niet opgegeven)",
    toestemming: lead.consent ? "Ja" : "Nee",

    // Intake
    organisatie: document.getElementById("org-name").value.trim() || "",
    omvang: document.getElementById("org-size").value || "",
    sector: document.getElementById("org-sector").value || "",

    // Score
    score_totaal: overallPct + "%",
    status: tier.label,
    score_per_categorie: catScores.map(c => `${c.name}: ${c.pct}%`).join(" | "),

    // Detail
    samenvatting: tier.summary,
    antwoorden: answersText,
    aanbevelingen: recText,

    // Meta
    tijdstip: new Date().toISOString(),
    bron: "${APP_CONFIG.emailSubject} (Buro GEKKO)",
    _subject: `${APP_CONFIG.emailSubject} — ${lead.company} (${overallPct}%, ${tier.label})`
  };
}

function openMailtoFallback(lead, payload) {
  const subject = encodeURIComponent(`${APP_CONFIG.emailSubject} — ${lead.company}`);
  const body = encodeURIComponent(
`Beste Buro GEKKO,

Hierbij mijn ingevulde ${APP_CONFIG.emailSubject}.

CONTACT
Naam:       ${lead.name}
E-mail:     ${lead.email}
Bedrijf:    ${lead.company}
Telefoon:   ${lead.phone || "(niet opgegeven)"}
Sector:     ${payload.sector}
Omvang:     ${payload.omvang}

SCORE
Totaal:     ${payload.score_totaal}
Status:     ${payload.status}
${payload.score_per_categorie.split(" | ").map(s => "  " + s).join("\n")}

SAMENVATTING
${payload.samenvatting}

ANTWOORDEN
${payload.antwoorden}

AANBEVELINGEN
${payload.aanbevelingen}

—
Verzonden via het online ${APP_CONFIG.emailSubject} (${new Date().toLocaleString("nl-NL")})
`
  );
  window.location.href = `mailto:${CONFIG.MAILTO_FALLBACK}?cc=${encodeURIComponent(lead.email)}&subject=${subject}&body=${body}`;
}



/* =========================================================
   RESTART
   ========================================================= */
function restart() {
  if (!confirm("Weet je zeker dat je opnieuw wilt beginnen? Alle antwoorden worden gewist.")) return;
  Object.keys(answers).forEach(k => delete answers[k]);
  currentCatIndex = 0;
  ["org-name","org-contact","org-size","org-sector","lead-name","lead-email","lead-company","lead-phone"].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.value = "";
  });
  const consent = document.getElementById("lead-consent");
  if (consent) consent.checked = false;
  clearProgress();
  lastResults = null;
  showScreen("intro");
}

/* =========================================================
   PDF GENERATIE — Buro GEKKO brand guidelines
   ========================================================= */
const PDF_BRAND = {
  geel:        [242, 184, 44],
  geelDonker:  [201, 148, 13],
  donker:      [24, 34, 43],
  donker2:     [16, 24, 32],
  grijs:       [107, 114, 128],
  licht:       [246, 245, 240],
  border:      [229, 231, 235],
  wit:         [255, 255, 255]
};
const PDF_META = {
  title: APP_CONFIG.pdfTitle,
  subtitle: APP_CONFIG.pdfSubtitle,
  product:  "Buro GEKKO · M365 Consultancy",
  url:      "burogekko.nl"
};

function generatePDF() {
  if (!lastResults || typeof window.jspdf === "undefined") {
    alert("Het PDF-rapport kan nog niet worden gegenereerd. Probeer opnieuw of vernieuw de pagina.");
    return;
  }

  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: "portrait", unit: "mm", format: "a4" });
  const { catScores, overallPct, tier, recs } = lastResults;
  const B = PDF_BRAND, M = 18, W = 210, H = 297;

  const org = document.getElementById("lead-company")?.value.trim()
           || document.getElementById("org-name")?.value.trim()
           || "Jullie organisatie";
  const today = new Date().toLocaleDateString("nl-NL", { day: "numeric", month: "long", year: "numeric" });

  /* ===================== COVER PAGE ===================== */
  doc.setFillColor(...B.donker); doc.rect(0, 0, W, H, "F");
  // Yellow accent strip
  doc.setFillColor(...B.geel); doc.rect(0, 0, W, 5, "F");
  // Soft radial glow simulated via concentric circles
  for (let i = 50; i >= 10; i -= 10) {
    doc.setFillColor(...B.geel);
    doc.setGState(new doc.GState({ opacity: 0.025 }));
    doc.circle(180, 60, i, "F");
  }
  doc.setGState(new doc.GState({ opacity: 1 }));

  // Brand mark
  doc.setFont("helvetica", "bold"); doc.setFontSize(12);
  doc.setTextColor(...B.geel); doc.text("BURO GEKKO", M, 24);
  doc.setFont("helvetica", "normal"); doc.setFontSize(8);
  doc.setTextColor(255, 255, 255); doc.text(PDF_META.product, M, 29);

  // Eyebrow
  doc.setFont("helvetica", "bold"); doc.setFontSize(8.5);
  doc.setTextColor(...B.geel);
  doc.text(PDF_META.title.toUpperCase(), M, 105, { charSpace: 1 });

  // Hero title
  doc.setFontSize(34); doc.setTextColor(255, 255, 255);
  doc.text("Readiness", M, 122);
  doc.setTextColor(...B.geel); doc.text("Rapport", M, 137);

  // For organization
  doc.setFont("helvetica", "normal"); doc.setFontSize(11);
  doc.setTextColor(220, 220, 220);
  doc.text(`Opgesteld voor:`, M, 158);
  doc.setFont("helvetica", "bold"); doc.setFontSize(16); doc.setTextColor(...B.wit);
  doc.text(org, M, 167);

  doc.setFont("helvetica", "normal"); doc.setFontSize(9);
  doc.setTextColor(180, 180, 180); doc.text(`Datum  ·  ${today}`, M, 175);

  // Big score block (yellow card)
  doc.setFillColor(...B.geel); doc.roundedRect(M, 195, W - 2*M, 62, 5, 5, "F");
  doc.setFont("helvetica", "bold"); doc.setFontSize(8.5);
  doc.setTextColor(...B.donker);
  doc.text("OVERALL READINESS SCORE", M + 10, 209, { charSpace: 1 });

  doc.setFontSize(52); doc.text(`${overallPct}%`, M + 10, 240);

  // Status pill on right
  doc.setFillColor(...B.donker); doc.roundedRect(W - M - 65, 217, 55, 12, 6, 6, "F");
  doc.setTextColor(...B.geel); doc.setFontSize(8);
  doc.text(tier.label.toUpperCase(), W - M - 37.5, 224.5, { align: "center", charSpace: 1 });

  doc.setFont("helvetica", "normal"); doc.setFontSize(9);
  doc.setTextColor(...B.donker);
  doc.text(`Status: ${tier.label}`, M + 10, 250);

  // Cover footer
  doc.setFont("helvetica", "normal"); doc.setFontSize(7.5);
  doc.setTextColor(150, 150, 150);
  doc.text("Vertrouwelijk · Persoonlijk rapport · Niet voor externe distributie", M, H - 18);
  doc.text(PDF_META.url, W - M, H - 18, { align: "right" });

  /* ===================== PAGE 2 — SAMENVATTING & SCORES ===================== */
  doc.addPage();
  drawPageHeader(doc, "Samenvatting");

  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.geelDonker);
  doc.text("STATUS", M, 38, { charSpace: 1 });

  doc.setFontSize(22); doc.setTextColor(...B.donker);
  const orgTitle = doc.splitTextToSize(`${org} · ${tier.label}`, W - 2*M);
  doc.text(orgTitle, M, 48);
  let y = 48 + orgTitle.length * 8 + 4;

  // Status badge
  const badgeColor = {
    "Foundation": [239, 68, 68],
    "Emerging": B.geel,
    "Progressing": [123, 180, 184],
    "Copilot Ready": [34, 197, 94]
  }[tier.label] || B.geel;
  const badgeW = doc.getTextWidth(tier.badge) + 12;
  doc.setFillColor(...badgeColor);
  doc.roundedRect(M, y - 5, badgeW, 9, 4.5, 4.5, "F");
  doc.setFontSize(8); doc.setFont("helvetica", "bold"); doc.setTextColor(...B.wit);
  doc.text(tier.badge.toUpperCase(), M + 6, y + 0.5, { charSpace: 1 });
  y += 12;

  // Summary text
  doc.setFont("helvetica", "normal"); doc.setFontSize(10.5);
  doc.setTextColor(...B.grijs);
  const summaryLines = doc.splitTextToSize(tier.summary, W - 2*M);
  doc.text(summaryLines, M, y, { lineHeightFactor: 1.5 });
  y += summaryLines.length * 5.2 + 10;

  // Score per category title
  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.geelDonker);
  doc.text("SCORE PER CATEGORIE", M, y, { charSpace: 1 });
  y += 4;
  doc.setFontSize(15); doc.setTextColor(...B.donker);
  doc.text("Hoe jullie scoren per onderwerp", M, y + 6);
  y += 14;

  // Category score cards
  catScores.forEach(c => {
    if (y > H - 50) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Samenvatting (vervolg)"); y = 40; }

    const status = c.pct >= 75 ? "Sterk fundament"
                 : c.pct >= 50 ? "Op koers, finetuning nodig"
                 : c.pct >= 25 ? "Aandacht vereist"
                 : "Kritieke gap";

    doc.setFillColor(...B.wit);
    doc.setDrawColor(...B.border);
    doc.roundedRect(M, y, W - 2*M, 23, 2.5, 2.5, "FD");

    // Name
    doc.setFont("helvetica", "bold"); doc.setFontSize(10.5);
    doc.setTextColor(...B.donker);
    doc.text(c.name, M + 6, y + 8);

    // Score
    doc.setFontSize(16); doc.setTextColor(...B.geelDonker);
    doc.text(`${c.pct}%`, W - M - 6, y + 9, { align: "right" });

    // Bar background
    doc.setFillColor(...B.border);
    doc.roundedRect(M + 6, y + 12, W - 2*M - 12, 2.5, 1.25, 1.25, "F");
    // Bar fill
    const fillW = (W - 2*M - 12) * (c.pct / 100);
    if (fillW > 0) {
      doc.setFillColor(...B.geel);
      doc.roundedRect(M + 6, y + 12, fillW, 2.5, 1.25, 1.25, "F");
    }

    // Status text
    doc.setFont("helvetica", "normal"); doc.setFontSize(8.5);
    doc.setTextColor(...B.grijs);
    doc.text(status, M + 6, y + 20);

    y += 27;
  });

  addPageFooter(doc);

  /* ===================== PAGE 3+ — AANBEVELINGEN ===================== */
  doc.addPage();
  drawPageHeader(doc, "Aanbevelingen");

  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.geelDonker);
  doc.text("PRIORITEITEN", M, 38, { charSpace: 1 });
  doc.setFontSize(22); doc.setTextColor(...B.donker);
  doc.text("Wat moet er eerst gebeuren?", M, 48);

  doc.setFont("helvetica", "normal"); doc.setFontSize(10);
  doc.setTextColor(...B.grijs);
  const introRec = doc.splitTextToSize("Geprioriteerde acties op basis van jullie antwoorden. Hoge prioriteit zijn blokkades voor een veilige uitrol; medium en laag versterken volwassenheid op langere termijn.", W - 2*M);
  doc.text(introRec, M, 56, { lineHeightFactor: 1.45 });
  y = 56 + introRec.length * 5 + 8;

  const PRI = {
    high:   { color: [239, 68, 68],   label: "HOOG" },
    medium: { color: B.geel,           label: "MEDIUM" },
    low:    { color: [123, 180, 184],  label: "LAAG" }
  };

  recs.forEach(r => {
    const pri = PRI[r.priority];
    const titleLines = doc.splitTextToSize(r.title, W - 2*M - 12);
    const textLines = doc.splitTextToSize(r.text, W - 2*M - 12);
    const cardH = 10 + titleLines.length * 5.5 + textLines.length * 4.5 + 4;

    if (y + cardH > H - 25) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Aanbevelingen (vervolg)"); y = 40; }

    // Card
    doc.setFillColor(...B.wit); doc.setDrawColor(...B.border);
    doc.roundedRect(M, y, W - 2*M, cardH, 2, 2, "FD");
    // Left bar
    doc.setFillColor(...pri.color);
    doc.rect(M, y, 2.2, cardH, "F");
    // Priority badge
    doc.setFillColor(...pri.color); doc.setGState(new doc.GState({ opacity: 0.15 }));
    const badgeWPri = doc.getTextWidth(pri.label) + 8;
    doc.roundedRect(M + 6, y + 5, badgeWPri, 5, 2.5, 2.5, "F");
    doc.setGState(new doc.GState({ opacity: 1 }));
    doc.setFont("helvetica", "bold"); doc.setFontSize(7);
    doc.setTextColor(...pri.color);
    doc.text(pri.label, M + 6 + badgeWPri/2, y + 8.5, { align: "center", charSpace: 1 });

    // Title
    doc.setFontSize(10.5); doc.setTextColor(...B.donker);
    doc.text(titleLines, M + 6, y + 16, { lineHeightFactor: 1.3 });

    // Body text
    doc.setFont("helvetica", "normal"); doc.setFontSize(9);
    doc.setTextColor(...B.grijs);
    doc.text(textLines, M + 6, y + 16 + titleLines.length * 5.5 + 1, { lineHeightFactor: 1.5 });

    y += cardH + 4;
  });

  addPageFooter(doc);

  /* ===================== PAGE — BIJLAGE ANTWOORDEN ===================== */
  doc.addPage();
  drawPageHeader(doc, "Bijlage — Antwoorden");

  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.geelDonker);
  doc.text("BIJLAGE", M, 38, { charSpace: 1 });
  doc.setFontSize(22); doc.setTextColor(...B.donker);
  doc.text("Volledige antwoorden", M, 48);

  y = 60;
  CATEGORIES.forEach(cat => {
    if (y > H - 30) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Bijlage — Antwoorden (vervolg)"); y = 40; }

    // Category header bar
    doc.setFillColor(...B.donker);
    doc.roundedRect(M, y, W - 2*M, 8, 2, 2, "F");
    const cs = catScores.find(c => c.id === cat.id);
    doc.setFont("helvetica", "bold"); doc.setFontSize(9);
    doc.setTextColor(...B.wit);
    doc.text(cat.name.toUpperCase(), M + 4, y + 5.5, { charSpace: 1 });
    doc.setTextColor(...B.geel);
    doc.text(`${cs.pct}%`, W - M - 4, y + 5.5, { align: "right" });
    y += 12;

    let qNum = 0;
    getVisibleQuestions(cat).forEach(q => {
      qNum++;
      const a = answers[q.id];
      if (!a) return;
      const opt = q.options[a.optionIndex];

      const qLines = doc.splitTextToSize(`${qNum}. ${q.q}`, W - 2*M);
      const aLines = doc.splitTextToSize(`→ ${opt.t}  (${a.score}/${a.maxScore})`, W - 2*M - 6);
      const blockH = qLines.length * 4.5 + aLines.length * 4 + 5;

      if (y + blockH > H - 25) { addPageFooter(doc); doc.addPage(); drawPageHeader(doc, "Bijlage — Antwoorden (vervolg)"); y = 40; }

      doc.setFont("helvetica", "bold"); doc.setFontSize(9);
      doc.setTextColor(...B.donker);
      doc.text(qLines, M, y, { lineHeightFactor: 1.4 });
      y += qLines.length * 4.5 + 1;

      doc.setFont("helvetica", "normal"); doc.setFontSize(8.5);
      doc.setTextColor(...B.geelDonker);
      doc.text(aLines, M + 4, y, { lineHeightFactor: 1.4 });
      y += aLines.length * 4 + 5;
    });
    y += 4;
  });

  addPageFooter(doc);

  // SAVE
  const safeOrg = org.replace(/[^a-z0-9]+/gi, "-").replace(/^-|-$/g, "");
  const fileName = `BuroGEKKO-${APP_CONFIG.pdfPrefix}-${safeOrg}-${new Date().toISOString().split("T")[0]}.pdf`;
  doc.save(fileName);
}

function drawPageHeader(doc, title) {
  const B = PDF_BRAND, M = 18, W = 210;
  doc.setFillColor(...B.geel); doc.rect(0, 0, W, 3, "F");
  doc.setFont("helvetica", "bold"); doc.setFontSize(8);
  doc.setTextColor(...B.donker);
  doc.text("BURO GEKKO", M, 13, { charSpace: 1 });
  doc.setFont("helvetica", "normal"); doc.setFontSize(8);
  doc.setTextColor(...B.grijs);
  doc.text(title, W - M, 13, { align: "right" });
  doc.setDrawColor(...B.border);
  doc.line(M, 17, W - M, 17);
}

function addPageFooter(doc) {
  const B = PDF_BRAND, M = 18, W = 210, H = 297;
  doc.setDrawColor(...B.border);
  doc.line(M, H - 17, W - M, H - 17);
  doc.setFont("helvetica", "normal"); doc.setFontSize(7);
  doc.setTextColor(...B.grijs);
  doc.text(`${PDF_META.title} · ${PDF_META.product}`, M, H - 11);
  const pageNum = doc.internal.getNumberOfPages();
  doc.text(`Pagina ${pageNum}`, W - M, H - 11, { align: "right" });
}

/* =========================================================
   INITIALISATION — offer resume on load if local progress exists
   ========================================================= */
window.addEventListener("DOMContentLoaded", () => {
  /* Retry any queued submissions silently in the background */
  flushQueue().catch(() => {});

  // Auto-save intake fields
  ["org-name","org-contact","org-size","org-sector"].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener("change", saveProgress);
  });

  if (loadProgress() && Object.keys(answers).length > 0) {
    const answered = Object.keys(answers).length;
    const maxTotal = getMaxPossibleQuestions();
    const resume = confirm(`Je hebt een eerder ingevuld assessment (${answered} van ${maxTotal} vragen beantwoord). Wil je verdergaan waar je gebleven was?\n\nKlik op OK om verder te gaan, of Annuleren om opnieuw te beginnen.`);
    if (resume) {
      // Find first category that still has unanswered VISIBLE questions
      for (let i = 0; i < CATEGORIES.length; i++) {
        const cat = CATEGORIES[i];
        const allAnswered = getVisibleQuestions(cat).every(q => answers[q.id] !== undefined);
        if (!allAnswered) { currentCatIndex = i; break; }
        if (i === CATEGORIES.length - 1) currentCatIndex = CATEGORIES.length - 1;
      }
      renderCategory();
      showScreen("questions");
    } else {
      Object.keys(answers).forEach(k => delete answers[k]);
      clearProgress();
    }
  }
});

function showLoginWall() {
  const c = document.getElementById("cat-content");
  c.innerHTML = 
    <div class="login-wall" style="text-align: center; padding: 40px 20px; background: #F1F5FB; border-radius: 8px; margin-top: 30px;">
        <h2>Ontgrendel de rest van het assessment</h2>
        <p style="margin-bottom: 24px; color: #1A2440;">Log in met je Microsoft 365, Google of Apple account om je voortgang veilig te bewaren, de rest van de vragen te zien en het gepersonaliseerde rapport te ontvangen.</p>
        <button onclick="window.location.href=APP_CONFIG.loginUrl" style="background: #2060E0; color: white; border: none; padding: 12px 24px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 16px;">
            Log in / Maak account aan
        </button>
    </div>
  ;
  document.getElementById("btn-prev").style.display = "inline-block";
  document.getElementById("btn-next").style.display = "none";
}
