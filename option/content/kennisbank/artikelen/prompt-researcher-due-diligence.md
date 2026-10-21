---
title: "Prompt Due Diligence Onderzoek"
beschrijving: "Een diepgaande Engelstalige prompt voor de Copilot Researcher Agent om een integraal Due Diligence onderzoek uit te voeren over 12 strategische domeinen."
datum: 2026-10-21
categorie: "Prompt Gallery"
auteur: "Rik Dobbelsteen"
leestijd: "6 min"
tags:
  - Prompt Gallery
  - Copilot Researcher
  - Due Diligence
  - M&A
  - Strategie
---

# Prompt voor het uitvoeren van een Due Diligence onderzoek

> **Samenvatting:** Deze uitgebreide prompt uit de *Prompt Gallery* voor de Microsoft Copilot Researcher (Onderzoeker) agent voert een grondige, 12-domeinen due diligence analyse uit op potentiële overname- of investeringskandidaten.

---

## Over deze prompt

Onderstaande prompt is in het Engels opgesteld en geoptimaliseerd voor Microsoft's **Copilot Researcher / Onderzoeker agent**. De agent benut meervoudige zoekrondes, diepgaande webanalyse en cross-referencing van openbare bronnen.

Vervang vóór verzending:
- `[organisation]`: De officiële naam van het bedrijf dat je wilt onderzoeken.
- `[your company / acquiring entity]`: De naam of doelstelling van jouw eigen organisatie (optioneel, voor strategische synergieën).

---

## De Kopieer-klare Prompt

```text
Conduct comprehensive due diligence on [organisation] as a potential acquisition.

Structure the analysis across:

(1) Strategic rationale — why this acquisition makes sense (market expansion, technology acqui-hire, customer base, competitive positioning), synergy thesis, and alignment with our strategy,
(2) Company overview — history, founding team, leadership, organizational structure, culture, headcount trends, and Glassdoor/employee sentiment,
(3) Financial analysis — revenue trajectory (3-year), growth rate, gross and operating margins, burn rate, cash position, debt obligations, revenue quality (recurring vs. one-time, concentration risk), and working capital dynamics,
(4) Customer analysis — customer count, logos, segment mix, retention rates, NRR, top-10 customer revenue concentration, and contract terms,
(5) Product and technology — product architecture, tech stack, code quality indicators, technical debt, IP portfolio (patents, trade secrets), and integration complexity with our stack,
(6) Market position — market share, competitive differentiation, analyst coverage, and brand strength,
(7) Legal and compliance — pending litigation, regulatory compliance status, data privacy practices, material contracts, and any restrictive agreements,
(8) HR and talent — key person dependencies, employment contracts, retention risk for critical employees, compensation structure, and pending equity vesting,
(9) Synergy modeling — revenue synergies (cross-sell, upsell, market expansion) and cost synergies (headcount, infrastructure, vendor consolidation) with confidence-weighted estimates,
(10) Valuation — DCF, comparable transactions, public comps, and recommended offer range with key assumptions,
(11) Integration considerations — integration complexity, day-1 requirements, 100-day plan outline, and cultural risk factors,
(12) Red flags and deal-breakers — issues discovered that could reduce value or warrant walking away.
```

---

## De 12 Analyse-domeinen

De prompt instrueert de Copilot Researcher om systematisch 12 pijlers te doorgronden:

| # | Domein | Kernaspecten |
| :- | :--- | :--- |
| **1** | **Strategische Rationale** | Marktexpansie, IP acquisitie, versterking concurrentiepositie en strategische fit. |
| **2** | **Bedrijfsoverzicht** | Historie, leiderschapsteam, cultuur en sentiment (Glassdoor/medewerkers). |
| **3** | **Financiële Analyse** | 3-jaars omzet, marges, cash runway, schuldenprofiel en werkkapitaal. |
| **4** | **Klantenanalyse** | NRR (Net Retention Rate), concentratierisico top-10 klanten en contractduur. |
| **5** | **Product & Technologie** | Architectuur, tech stack, codekwaliteit, patenten en integratie-complexiteit. |
| **6** | **Marktpositie** | Marktaandeel, onderscheidend vermogen en analistenrapportages (Gartner/IDC). |
| **7** | **Juridisch & Compliance** | Lopende geschillen, AVG/GDPR compliance, IP eigendom en restrictieve clausules. |
| **8** | **HR & Sleutelpersonen** | Key person risks, retentieregelingen, concurrentiebedingen en beloningsstructuur. |
| **9** | **Synergiemodellering** | Omzet- en kostenvoordelen gewogen naar realisatietermijn en haalbaarheid. |
| **10**| **Waardering & Comps** | DCF waardering, transactie multiples en aanbevolen bandbreedte voor een bod. |
| **11**| **Integratie & 100-dagen** | Day-1 prioriteiten, systeemmigratie en cultuurintegratieplan. |
| **12**| **Red Flags** | Kritieke showstoppers en deal-breakers die afzien van de deal rechtvaardigen. |

---

## Best practices bij uitvoering

- **Verrijk met vertrouwelijke data:** Heb je al een dataroom of NDA? Voeg geanonimiseerde PDF's of financiële sheets toe aan de agent voor een combinatie van interne en openbare intelligence.
- **Verifieer bronnen:** Gebruik de bronverwijzingen van Copilot Researcher om claims over marktpositie en rechtszaken direct bij de primaire bron (bijv. toezichthouders of rechtspraak) te toetsen.
