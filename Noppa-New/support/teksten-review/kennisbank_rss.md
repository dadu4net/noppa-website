' . "\n";
echo '' . "\n";
echo '' . "\n";
echo '  ' . $esc($sitenaam) . ' — Kennisbank' . "\n";
echo '  ' . $esc($kennisbankUrl) . '' . "\n";
echo '  Praktische gidsen, how-to&apos;s en diepgaande analyses van ' . $esc($sitenaam) . '' . "\n";
echo '  nl-nl' . "\n";
echo '  ' . $lastBuild . '' . "\n";
echo '  ' . "\n\n";

foreach ($items as $item) {
$url     = $esc($kennisbankUrl . '#/artikel/' . $item['slug']);
$pubDate = $item['datum'] ? date(DATE_RSS, strtotime($item['datum'])) : date(DATE_RSS);
echo '  ' . "\n";
echo '    '       . $esc($item['title'])  . ''       . "\n";
echo '    '        . $url                  . ''        . "\n";
echo '    '        . $url                  . ''        . "\n";
echo '    '     . $pubDate               . ''     . "\n";
echo '    ' . $esc($item['desc'])   . '' . "\n";
if ($item['cat'])    echo '    ' . $esc($item['cat'])    . '' . "\n";
if ($item['auteur']) echo '    '   . $esc($item['auteur']) . ''   . "\n";
echo '  ' . "\n\n";
}

echo '' . "\n";
echo '' . "\n";