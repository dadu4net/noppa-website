#!/usr/bin/env python3
"""
Convert Source Files (PDF, Word .docx, Legacy PHP, HTML) to Standardized Noppa Markdown.
Supports 4 content types:
  - teamlid    -> data/team/{slug}.md
  - dienst     -> data/diensten/{slug}.md
  - pagina     -> content/pages/{slug}.md
  - kennisbank -> content/kennisbank/artikelen/{slug}.md

Usage:
  python scripts/convert_to_md.py --input path/to/source.docx --type teamlid --slug jan-jansen
  python scripts/convert_to_md.py --input path/to/brochure.pdf --type dienst --slug ai-security
  python scripts/convert_to_md.py --input path/to/old-page.php --type pagina --slug visie
  python scripts/convert_to_md.py --input path/to/article.html --type kennisbank --slug copilot-tips
"""

import os
import re
import sys
import argparse
from pathlib import Path

# Extraction imports
try:
    import bs4
    from bs4 import BeautifulSoup
except ImportError:
    BeautifulSoup = None

try:
    import docx
except ImportError:
    docx = None

try:
    import pdfplumber
except ImportError:
    pdfplumber = None

try:
    from markitdown import MarkItDown
    markitdown_client = MarkItDown()
except Exception:
    markitdown_client = None


def extract_text_from_pdf(filepath: str) -> str:
    """Extract clean text and structure from PDF using markitdown or pdfplumber."""
    if markitdown_client:
        try:
            res = markitdown_client.convert(filepath)
            if res and res.text_content:
                return res.text_content.strip()
        except Exception:
            pass

    if pdfplumber:
        pages_text = []
        with pdfplumber.open(filepath) as pdf:
            for page in pdf.pages:
                txt = page.extract_text(layout=True)
                if txt:
                    pages_text.append(txt)
        return "\n\n".join(pages_text).strip()

    raise RuntimeError("No PDF parser available (markitdown or pdfplumber required).")


def extract_text_from_docx(filepath: str) -> str:
    """Extract clean Markdown/text from Word docx."""
    if markitdown_client:
        try:
            res = markitdown_client.convert(filepath)
            if res and res.text_content:
                return res.text_content.strip()
        except Exception:
            pass

    if docx:
        doc = docx.Document(filepath)
        lines = []
        for p in doc.paragraphs:
            text = p.text.strip()
            if not text:
                continue
            style_name = p.style.name.lower() if p.style else ""
            if "heading 1" in style_name:
                lines.append(f"# {text}")
            elif "heading 2" in style_name:
                lines.append(f"## {text}")
            elif "heading 3" in style_name:
                lines.append(f"### {text}")
            elif "list" in style_name or p.text.startswith("•") or p.text.startswith("-"):
                cleaned = re.sub(r"^[•\-\*]\s*", "", text)
                lines.append(f"- {cleaned}")
            else:
                lines.append(text)
        return "\n\n".join(lines).strip()

    raise RuntimeError("No DOCX parser available (markitdown or python-docx required).")


def extract_text_from_html_or_php(filepath: str) -> str:
    """Extract clean text/markdown from HTML or legacy PHP file."""
    with open(filepath, "r", encoding="utf-8", errors="replace") as f:
        content = f.read()

    # Strip PHP tags
    content_clean = re.sub(r"<\?php[\s\S]*?\?>", "", content, flags=re.IGNORECASE)
    content_clean = re.sub(r"<\?=[\s\S]*?\?>", "", content_clean, flags=re.IGNORECASE)

    if BeautifulSoup:
        soup = BeautifulSoup(content_clean, "html.parser")
        # Remove script, style, nav, footer, header
        for tag in soup(["script", "style", "nav", "footer", "header", "noscript"]):
            tag.decompose()

        # Extract main content if present
        main_tag = soup.find("main") or soup.find("article") or soup.find(id="content") or soup.body or soup
        
        # Convert simple tags to markdown syntax
        for h1 in main_tag.find_all("h1"):
            h1.replace_with(f"\n\n# {h1.get_text().strip()}\n\n")
        for h2 in main_tag.find_all("h2"):
            h2.replace_with(f"\n\n## {h2.get_text().strip()}\n\n")
        for h3 in main_tag.find_all("h3"):
            h3.replace_with(f"\n\n### {h3.get_text().strip()}\n\n")
        for li in main_tag.find_all("li"):
            li.replace_with(f"- {li.get_text().strip()}\n")
        for p in main_tag.find_all("p"):
            p.replace_with(f"\n\n{p.get_text().strip()}\n\n")

        raw_text = main_tag.get_text()
        # Clean consecutive newlines
        cleaned = re.sub(r"\n{3,}", "\n\n", raw_text)
        return cleaned.strip()

    # Fallback regex strip
    cleaned = re.sub(r"<[^>]+>", " ", content_clean)
    return re.sub(r"\s+", " ", cleaned).strip()


def extract_content(filepath: str) -> str:
    """Determine file type and extract structured content."""
    ext = Path(filepath).suffix.lower()
    if ext == ".pdf":
        return extract_text_from_pdf(filepath)
    elif ext in [".docx", ".doc"]:
        return extract_text_from_docx(filepath)
    elif ext in [".html", ".htm", ".php"]:
        return extract_text_from_html_or_php(filepath)
    elif ext in [".txt", ".md"]:
        with open(filepath, "r", encoding="utf-8", errors="replace") as f:
            return f.read().strip()
    else:
        raise ValueError(f"Niet-ondersteund bestandstype: {ext}")


def generate_teamlid_markdown(source_text: str, slug: str, name_hint: str = "") -> str:
    """Generate standardized team member Markdown (data/team/[slug].md)."""
    # Try guessing first/last name from slug or hint
    if name_hint:
        parts = name_hint.strip().split()
        first_name = parts[0]
        last_name = " ".join(parts[1:]) if len(parts) > 1 else ""
    else:
        parts = slug.replace("-", " ").title().split()
        first_name = parts[0] if parts else "Voornaam"
        last_name = " ".join(parts[1:]) if len(parts) > 1 else "Achternaam"

    full_name = f"{first_name} {last_name}".strip()

    # Search for email/phone patterns
    email_match = re.search(r"[\w\.-]+@[\w\.-]+\.\w+", source_text)
    email = email_match.group(0) if email_match else f"{first_name.lower()}@noppa.nl"

    phone_match = re.search(r"(?:\+31|06)[0-9\s\-]{8,}", source_text)
    phone = phone_match.group(0).strip() if phone_match else "+31 6 00 00 00 00"

    template = f"""---
firstName: {first_name}
lastName: {last_name}
pageTitle: {full_name} | Consultant | Noppa Solutions & Consultants
pageDesc: {full_name} — Specialist bij Noppa Solutions & Consultants.
roleTitle: Senior M365 & Copilot Specialist
shortBio: {full_name} helpt organisaties bij het slimmer inrichten van Microsoft 365 en adoptie van moderne werkplektechnologieën.
jobTitle: Consultant
phone: "{phone}"
email: "{email}"
linkedin: "linkedin.com/in/{slug}"
location: "Nederland"
image: "./assets/images/{full_name}.jpg"

# Quick facts voor de zijbalk
qf_experience: "10+ jaar ervaring"
qf_specialism: "Microsoft 365 & Adoptie"
qf_region: "Nederland & Vlaanderen"
qf_languages: "NL · EN"
---

## Over {first_name}

{source_text[:600].strip()}

## Expertise

### Microsoft 365 & Cloud Werkplek
Inrichten van veilige en gebruiksvriendelijke werkomgevingen in SharePoint Online, Teams en OneDrive.

### Adoptie & Gedragsverandering
Begeleiden van teams bij het effectief benutten van nieuwe technologieën met praktische trainingen.

### Procesautomatisering
Optimaliseren van dagelijkse routines met slimme sjablonen en Power Automate workflows.

## Werkervaring

### 2024 — heden | Senior Consultant | Noppa Solutions & Consultants
Verantwoordelijk voor advies, implementatie en adoptietrajecten bij diverse opdrachtgevers.

### 2018 — 2024 | Cloud & Adoptie Specialist | Zakelijke Dienstverlening
Begeleiding van digitaliseringstrajecten en gebruikersadoptie binnen middelgrote en grote organisaties.

## Referenties

### "{first_name} brengt direct structuur en overzicht"
Prettige samenwerking met tastbaar resultaat voor ons hele team.
*— Opdrachtgever, MKB+*
"""
    return template


def generate_dienst_markdown(source_text: str, slug: str, title_hint: str = "") -> str:
    """Generate standardized service Markdown (data/diensten/[slug].md)."""
    title = title_hint if title_hint else slug.replace("-", " ").title()

    template = f"""---
id: "{slug}"
order: 10
title: "{title} | Noppa Solutions & Consultants"
shortTitle: "{title}"
eyebrow: "Professionele Oplossingen"
badge: "Microsoft 365 & AI"
badge_icon: "rocket"
hero_title: "Verhoog uw impact met <span class='gradient-text'>{title}</span>"
hero_subtitle: "Krijg grip op uw processen en haal maximaal rendement uit uw Microsoft-omgeving met beproefde methodes."
hero_cta_primary:
  text: "Plan een adviesgesprek"
  url: "/contact"
  icon: "calendar"
hero_cta_secondary:
  text: "Bekijk onze pakketten →"
  url: "#pricing"

stats:
  - num: "100%"
    lbl: "Borging in eigen tenant"
  - num: "0"
    lbl: "Verborgen kosten"
  - num: "24/7"
    lbl: "Continuïteit"
  - num: "A–Z"
    lbl: "Volledige ontzorging"

cta:
  title: "Klaar om de volgende stap te zetten met {title}?"
  desc: "Plan een vrijblijvend adviesgesprek van 30 minuten met een van onze ervaren specialisten."
  btn_text: "Plan een adviesgesprek →"
  btn_url: "/contact"

pricing:
  title: "Vaste tarieven, maximale zekerheid"
  subtitle: "Transparante Pakketten"
  desc: "Kies de scope die past bij de behoeften van uw organisatie. Alle bedragen zijn exclusief BTW."
  plans:
    - tier: "Basis"
      name: "Kickstart Scan"
      target: "Voor organisaties die inzicht en een helder plan van aanpak willen."
      featured: false
      price_prefix: "Eenmalig"
      price_amount: "€ 1.450"
      price_suffix: "excl. BTW"
      price_permw: ""
      cta:
        text: "Vraag scan aan"
        url: "/contact"
      features:
        - "Grondige nulmeting van de huidige situatie"
        - "Inventarisatie van knelpunten en quick wins"
        - "Concreet adviesrapport met prioriteiten"
    - tier: "Compleet"
      name: "Volledige Implementatie"
      target: "Complete inrichting, migratie en adoptiebegeleiding."
      featured: true
      badge: "Meest gekozen"
      price_prefix: "Vanaf"
      price_amount: "€ 3.950"
      price_suffix: "excl. BTW"
      price_permw: ""
      cta:
        text: "Start implementatie"
        url: "/contact"
      features:
        - "Alles uit de Kickstart Scan"
        - "Volledige technische inrichting en configuratie"
        - "Workshops en training voor medewerkers"
        - "Borging en overdrachtsdocumentatie"
---

## De uitdaging

{source_text[:500].strip()}

## Wat wij voor u doen

Wij bieden een compleet dienstenpakket om uw organisatie te versterken.

### Analyse & Nulmeting
We brengen nauwkeurig in kaart wat er nodig is voor een succesvol resultaat.

### Technische Inrichting
Configuratie volgens de hoogste normen op het gebied van betrouwbaarheid en veiligheid.

### Adoptie & Borging
Zorg dat uw team de nieuwe werkwijze direct omarmt en toepast in de dagelijkse praktijk.

## In de praktijk

Praktijkvoorbeelden waarin deze dienst direct meerwaarde biedt.

### 1. Tijdsbesparing in dagelijkse processen
Minder handmatige handelingen en sneller toegang tot de juiste informatie.

### 2. Grip op kwaliteit en datastromen
Heldere afspraken en een centrale opzet voorkomen fouten en misverstanden.

## Onze aanpak

Een beproefde werkwijze van intake tot nazorg.

### 1. Intake & Doelen bepalen
Samen formuleren we de concrete doelen en verwachtingen.

### 2. Uitvoering & Oplevering
Pragmatische realisatie met regelmatige afstemming en korte lijnen.

### 3. Evaluatie & Nazorg
We zorgen dat alles geborgd is en beantwoorden eventuele nazorgvragen.

## Veelgestelde vragen

### Hoe snel kunnen we starten?
Meestal kunnen we binnen twee weken na de intake van start gaan met de nulmeting.

### Wat verwachten jullie van onze organisatie tijdens het traject?
Een vast aanspreekpunt voor afstemming en deelname van relevante kerngebruikers aan de sessies.
"""
    return template


def generate_pagina_markdown(source_text: str, slug: str, title_hint: str = "") -> str:
    """Generate standardized page Markdown (content/pages/[slug].md)."""
    title = title_hint if title_hint else slug.replace("-", " ").title()

    template = f"""---
title: "{title} | Noppa Solutions & Consultants"
description: "Lees meer over {title.lower()} bij Noppa Solutions & Consultants."
canonical: "https://noppa.nl/{slug}"

hero:
  badge: "Overzicht"
  badge_icon: "sparkles"
  title: "Ontdek onze visie op <span class='gradient-text'>{title}</span>"
  subtitle: "Pragmatische oplossingen en persoonlijke begeleiding voor moderne organisaties."
  cta_primary:
    text: "Neem contact op"
    url: "/contact"
  cta_secondary:
    text: "Bekijk onze diensten"
    url: "/diensten"
---

<!-- section: intro type="content" title="{title}" subtitle="In het kort" -->

## Welkom bij {title}

{source_text[:600].strip()}

<!-- section: kernpunten type="cards" cols="3" title="Onze Pijlers" subtitle="Waarom Noppa" -->

## Persoonlijke Aandacht
*Icoon: handshake*
Direct contact met ervaren consultants zonder tussenlagen of accountmanagers.
[Lees over ons team](/over-ons)

## Praktijkgericht
*Icoon: rocket*
Geen theoretische rapporten, maar oplossingen die direct werken op de werkvloer.
[Bekijk onze diensten](/diensten)

## Veilig & Betrouwbaar
*Icoon: shield*
Volledige borging binnen uw eigen tenant conform AVG en best-practices.
[Veiligheidsgarantie](/diensten)

<!-- section: impact type="stats" title="Resultaten in Cijfers" subtitle="Bewezen Impact" -->

- **100%** Borging in uw eigen tenant
- **4 uur** Wekelijkse tijdsbesparing per medewerker
- **85%** Actieve gebruikersadoptie

<!-- section: actie type="cta" -->

## Klaar om samen te werken?
Plan vandaag nog een vrijblijvend adviesgesprek van 30 minuten met een van onze adviseurs.

[Plan een gesprek in](/contact)
"""
    return template


def generate_kennisbank_markdown(source_text: str, slug: str, title_hint: str = "") -> str:
    """Generate standardized knowledge base article Markdown (content/kennisbank/artikelen/[slug].md)."""
    title = title_hint if title_hint else slug.replace("-", " ").title()

    # Search for summary
    first_p = source_text[:300].strip().replace("\n", " ")

    template = f"""---
title: "{title}"
beschrijving: "{first_p[:150]}..."
datum: 2026-10-19
categorie: "Microsoft Copilot"
auteur: "Rik Dobbelsteen"
leestijd: "5 min"
featured: false
tags:
  - Microsoft 365
  - Copilot
  - Best Practices
---

# {title}

> **Samenvatting:** {first_p[:250]}...

---

## Waarom dit belangrijk is voor uw organisatie

{source_text[:600].strip()}

---

## Belangrijkste inzichten en stappenplan

Een doordachte aanpak voorkomt valkuilen en levert direct meetbare resultaten op.

### 1. Breng de basis op orde
Zorg dat documentstructuren, rechten en metadata kloppen voordat u nieuwe tools uitrolt.

### 2. Investeer in gebruikersbegeleiding
Geef medewerkers praktische voorbeelden en direct toepasbare scenario's.

### 3. Evalueer en stuur bij
Meet regelmatig het gebruik en verzamel feedback van de werkvloer.

---

## Praktijkvoorbeelden en gouden tips

> "Technologie wordt pas waardevol wanneer medewerkers het met vertrouwen dagelijks inzetten."
> — Noppa Adoptievisie

- Tip 1: Start met een kleine enthousiaste kopgroep (ambassadeurs).
- Tip 2: Deel successen en concrete voorbeelden intern.
- Tip 3: Houd het simpel en sluit aan bij bestaande gewoontes.

---

## Conclusie

Door een gestructureerde aanpak te combineren met aandacht voor de menskant, behaalt u maximaal rendement uit uw investering.

Wilt u sparren over de toepassing binnen uw organisatie? Neem gerust [contact op met ons team](/contact).
"""
    return template


def main():
    parser = argparse.ArgumentParser(description="Converteer bronbestanden naar gestandaardiseerde Noppa Markdown.")
    parser.add_argument("--input", "-i", required=True, help="Pad naar het bronbestand (.pdf, .docx, .php, .html)")
    parser.add_argument("--type", "-t", required=True, choices=["teamlid", "dienst", "pagina", "kennisbank"],
                        help="Doel contenttype")
    parser.add_argument("--slug", "-s", required=True, help="Slug voor het markdown bestand (bijv. jan-jansen)")
    parser.add_argument("--title", help="Optionele titel hint")
    parser.add_argument("--output", "-o", help="Aangepast uitvoerpad (optioneel)")

    args = parser.parse_args()

    input_path = Path(args.input)
    if not input_path.exists():
        print(f"FOUT: Bronbestand bestaat niet: {args.input}", file=sys.stderr)
        sys.exit(1)

    print(f"Inlezen van bronbestand: {input_path} ({input_path.suffix})...")
    raw_content = extract_content(str(input_path))
    print(f"Succesvol {len(raw_content)} tekens geëxtraheerd.")

    slug = args.slug.strip().lower()
    title_hint = args.title or ""

    if args.type == "teamlid":
        md = generate_teamlid_markdown(raw_content, slug, name_hint=title_hint)
        default_dir = Path("data/team")
    elif args.type == "dienst":
        md = generate_dienst_markdown(raw_content, slug, title_hint=title_hint)
        default_dir = Path("data/diensten")
    elif args.type == "pagina":
        md = generate_pagina_markdown(raw_content, slug, title_hint=title_hint)
        default_dir = Path("content/pages")
    elif args.type == "kennisbank":
        md = generate_kennisbank_markdown(raw_content, slug, title_hint=title_hint)
        default_dir = Path("content/kennisbank/artikelen")

    output_path = Path(args.output) if args.output else default_dir / f"{slug}.md"
    output_path.parent.mkdir(parents=True, exist_ok=True)

    with open(output_path, "w", encoding="utf-8") as f:
        f.write(md)

    print(f"SUCCES: Gestandaardiseerd Markdown-bestand gegenereerd in:\n-> {output_path}")


if __name__ == "__main__":
    main()
