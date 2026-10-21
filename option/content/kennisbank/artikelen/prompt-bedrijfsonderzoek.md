---
title: "Prompt Bedrijfsonderzoek"
beschrijving: "Praktische Engelstalige prompt uit de Microsoft Cowork Prompt Gallery voor een diepgaand financieel en strategisch bedrijfsonderzoek."
datum: 2026-10-21
categorie: "Prompt Gallery"
auteur: "Rik Dobbelsteen"
leestijd: "5 min"
tags:
  - Prompt Gallery
  - Microsoft Cowork
  - Bedrijfsonderzoek
  - Financiële Analyse
---

# Prompt voor het uitvoeren van een bedrijfsonderzoek

> **Samenvatting:** Deze kant-en-klare prompt uit de *Microsoft Cowork Prompt Gallery* stelt je in staat om met één opdracht een complete analyse van een organisatie uit te voeren: een executive summary in de chat, een 2-pagina Word managementsamenvatting en een gestructureerd financieel spreadsheetmodel.

---

## Instructies & Toepassing

Onderstaande prompt is in het Engels geschreven voor maximale precisie en consistentie binnen Microsoft Copilot en Cowork agents. 

Lees de prompt door en maak aanpassingen waar nodig:
1. Vervang `[organisation]` door de officiële statutaire of handelsnaam van de doelorganisatie.
2. Geef eventueel de beursticker mee (bijv. `Microsoft (MSFT)` of `ASML (ASML)`).
3. Plak de prompt in Copilot of Cowork en laat de AI het web en openbare financiële bronnen doorzoeken.

---

## De Kopieer-klare Prompt

```text
Help me analyze a company. If I do not provide one, ask me which one (and make a few suggestions, e.g. Microsoft (MSFT)).

Use web search to gather the most current information available, including recent earnings reports, SEC filings, analyst commentary, and relevant news. Do an exhaustive search, and be sure to place extra emphasis on the official financial data (and not news or editorialization). This is not financial advice, but just to help people understand a company.

Take the findings and create three things:

1. A short executive summary: share in the chat 3 paragraphs covering the company, its performance, and key financial highlights. Use a concise, analyst-style tone.

2. A 2 page Word document that is a cover sheet of the research:
- Page 1 – company overview (name, ticker, sector, market cap, current price, 52-week range)
- Page 2 – recent developments (last 1-2 quarters of earnings, guidance updates, M&A activity), a summary of bull/bear arguments, and a table of key financial metrics

3. A thorough spreadsheet with the financials. All tabs should include clear labels, source notes, and consistent formatting:
- Tab 1 — Income Statement: Last 3–5 years of annual data plus most recent quarterly results (revenue, COGS, gross profit, operating expenses, EBIT, net income, EPS)
- Tab 2 — Balance Sheet: Total assets, liabilities, equity, cash & equivalents, total debt, net debt
- Tab 3 — Cash Flow Statement: Operating cash flow, capex, free cash flow, dividends, share repurchases
- Tab 4 — Key Ratios & Metrics: Gross margin, operating margin, net margin, ROE, ROA, debt/equity, current ratio, EV/EBITDA, P/E, FCF yield
- Tab 5 — Valuation Snapshot: Current vs. 5-year average multiples, peer comparison if data is available.
```

---

## Verwachte Deliverables

Wanneer je deze prompt uitvoert in Microsoft Cowork levert de AI drie afzonderlijke deliverables op:

| Deliverable | Formaat | Doel |
| :--- | :--- | :--- |
| **Executive Summary** | Direct in de chat | Snelle briefing voor directie of projectteam |
| **Onderzoeksnotitie** | Word document (2 pag.) | Deelbare cover sheet voor besluitvorming of dossier |
| **Financieel Model** | Excel spreadsheet (5 tabs) | Grondige kwantitatieve onderbouwing met ratio's en trends |

---

## Tips voor optimaal resultaat

- **Beursgenoteerde bedrijven:** Werkt het allerbest bij beursgenoteerde ondernemingen omdat SEC-filings (10-K, 10-Q), jaarverslagen en persberichten openbaar beschikbaar zijn.
- **Niet-beursgenoteerde ondernemingen:** Voeg bij niet-beursgenoteerde bedrijven eventueel zelf jaarrekeningen (PDF) of KvK-uittreksels toe als bijlage in de Cowork sessie.
- **Bronverificatie:** Controleer altijd de bronnotities in de voetnoten van de gegenereerde Excel tabs voor compliance en due diligence doeleinden.
