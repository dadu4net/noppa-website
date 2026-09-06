import sys

with open('Noppa-New/public_html/kennisbank/index.php', 'r', encoding='utf-8') as f:
    content = f.read()

replacements = {
    'â†’': '→',
    'â† ': '←',
    'Â·': '·',
    'âœ“': '✓',
    'âš ': '⚠️',
    'âœ—': '✗',
    'ðŸ“–': '📖',
    'ðŸ”—': '🔗',
    'â”€': '─',
    'â• ': '═',
    'Ã«': 'ë',
    'â€”': '—'
}

for k, v in replacements.items():
    content = content.replace(k, v)

with open('Noppa-New/public_html/kennisbank/index.php', 'w', encoding='utf-8') as f:
    f.write(content)

print('Success')
