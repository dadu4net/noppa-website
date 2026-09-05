"""
WCAG 2.1 Contrast Ratio Validator for Noppa
Tests Light and Dark mode color combinations against WCAG AA (4.5:1 / 3.0:1) and AAA (7.0:1 / 4.5:1).
"""

def hex_to_rgb(hex_color):
    hex_color = hex_color.lstrip('#')
    if len(hex_color) == 3:
        hex_color = ''.join(c + c for c in hex_color)
    return tuple(int(hex_color[i:i+2], 16) for i in (0, 2, 4))

def get_luminance(r, g, b):
    a = [v / 255.0 for v in (r, g, b)]
    a = [v / 12.92 if v <= 0.03928 else ((v + 0.055) / 1.055) ** 2.4 for v in a]
    return a[0] * 0.2126 + a[1] * 0.7152 + a[2] * 0.0722

def contrast_ratio(color1, color2):
    l1 = get_luminance(*hex_to_rgb(color1))
    l2 = get_luminance(*hex_to_rgb(color2))
    return (max(l1, l2) + 0.05) / (min(l1, l2) + 0.05)

colors = {
    # Base Palette
    'cyan': '#00D0F0',
    'sky': '#20B0F0',
    'royal': '#2060E0',
    'indigo': '#3A4FD0',
    'navy': '#0F2A66',
    'ink': '#1A2440',
    'slate': '#555C68',
    'mist': '#E4E9F2',
    'light': '#F1F5FB',
    'white': '#FFFFFF',
    'success': '#15803D',
    'warning': '#DC2626',

    # Dark Mode Semantic Palette
    'dark-bg': '#0B1528',
    'dark-bg-alt': '#10213D',
    'dark-card': '#152A4E',
    'dark-card-alt': '#1A335C',
    'dark-text-main': '#E0E5EE',
    'dark-text-muted': '#94A7C1',
    'dark-footer-bg': '#0A1F4D',
    'dark-footer-text': '#C8D2E6',
}

light_pairs = [
    ('Main Text (ink)', 'ink', 'White Background', 'white'),
    ('Main Text (ink)', 'ink', 'Light Background (light)', 'light'),
    ('Headings (navy)', 'navy', 'White Background', 'white'),
    ('Headings (navy)', 'navy', 'Light Background (light)', 'light'),
    ('Muted Text (slate)', 'slate', 'White Background', 'white'),
    ('Muted Text (slate)', 'slate', 'Light Background (light)', 'light'),
    ('Links (royal)', 'royal', 'White Background', 'white'),
    ('Links (royal)', 'royal', 'Light Background (light)', 'light'),
    ('Button Primary Text (white)', 'white', 'Royal Button (royal)', 'royal'),
    ('Button Accent Text (navy)', 'navy', 'Cyan Button (cyan)', 'cyan'),
    ('Success Text (success)', 'success', 'White Background', 'white'),
    ('Warning Text (warning)', 'warning', 'White Background', 'white'),
]

dark_pairs = [
    ('Main Text (dark-text-main)', 'dark-text-main', 'Dark Background (dark-bg)', 'dark-bg'),
    ('Main Text (dark-text-main)', 'dark-text-main', 'Dark Card (dark-card)', 'dark-card'),
    ('Headings (white)', 'white', 'Dark Background (dark-bg)', 'dark-bg'),
    ('Headings (white)', 'white', 'Dark Card (dark-card)', 'dark-card'),
    ('Muted Text (dark-text-muted)', 'dark-text-muted', 'Dark Background (dark-bg)', 'dark-bg'),
    ('Muted Text (dark-text-muted)', 'dark-text-muted', 'Dark Card (dark-card)', 'dark-card'),
    ('Links (cyan)', 'cyan', 'Dark Background (dark-bg)', 'dark-bg'),
    ('Links (cyan)', 'cyan', 'Dark Card (dark-card)', 'dark-card'),
    ('Links Hover (white)', 'white', 'Dark Background (dark-bg)', 'dark-bg'),
    ('Focus Ring (cyan)', 'cyan', 'Dark Background (dark-bg)', 'dark-bg'),
    ('Accent Text (cyan)', 'cyan', 'Navy Background (navy)', 'navy'),
    ('Footer Text', 'dark-footer-text', 'Footer Background', 'dark-footer-bg'),
]

def print_table(title, pairs):
    print(f"\n=== {title} ===")
    print(f"{'Foreground':<30} | {'Background':<26} | {'Ratio':<8} | {'WCAG AA (4.5:1)'} | {'WCAG AAA (7.0:1)'}")
    print("-" * 105)
    for name1, k1, name2, k2 in pairs:
        r = contrast_ratio(colors[k1], colors[k2])
        aa = "PASS" if r >= 4.5 else ("PASS (Large text)" if r >= 3.0 else "FAIL")
        aaa = "PASS" if r >= 7.0 else ("PASS (Large text)" if r >= 4.5 else "FAIL")
        print(f"{name1:<30} | {name2:<26} | {r:5.2f}:1 | {aa:<17} | {aaa}")

if __name__ == '__main__':
    print_table("LIGHT MODE CONTRAST CHECK", light_pairs)
    print_table("DARK MODE CONTRAST CHECK", dark_pairs)