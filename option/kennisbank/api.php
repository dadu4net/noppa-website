<?php
/**
 * =========================================================================
 * Noppa Solutions & Consultants — Kennisbank JSON API
 * =========================================================================
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once dirname(__DIR__) . '/includes/Parsedown.php';
require_once dirname(__DIR__) . '/includes/KennisbankEngine.php';

$kennisbankEngine = new KennisbankEngine(dirname(__DIR__) . '/content/kennisbank/artikelen');

$actie     = $_GET['actie'] ?? $_GET['action'] ?? 'artikelen';
$slug      = isset($_GET['slug']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string)$_GET['slug']) : '';
$categorie = isset($_GET['categorie']) ? (string)$_GET['categorie'] : (isset($_GET['cat']) ? (string)$_GET['cat'] : null);
$search    = isset($_GET['search']) ? (string)$_GET['search'] : (isset($_GET['q']) ? (string)$_GET['q'] : null);

switch ($actie) {
    case 'artikel':
        if (empty($slug)) {
            http_response_code(400);
            echo json_encode(['error' => 'Geen slug opgegeven'], JSON_UNESCAPED_UNICODE);
            exit;
        }
        $artikel = $kennisbankEngine->getArtikel($slug);
        if (!$artikel) {
            http_response_code(404);
            echo json_encode(['error' => 'Artikel niet gevonden'], JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo json_encode($artikel, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        break;

    case 'categorieen':
    case 'categories':
        $cats = $kennisbankEngine->getCategories();
        echo json_encode($cats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'artikelen':
    default:
        $artikelen = $kennisbankEngine->getArtikelen($categorie, $search);
        // Strippen van overbodige raw markdown voor compacte API response
        $result = array_map(function ($a) {
            return [
                'slug'        => $a['slug'],
                'title'       => $a['title'],
                'description' => $a['description'],
                'datum'       => $a['datum'],
                'datum_nl'    => $a['datum_nl'],
                'categorie'   => $a['categorie'],
                'auteur'      => $a['auteur'],
                'auteur_slug' => $a['auteur_slug'],
                'leestijd'    => $a['leestijd'],
                'url'         => 'https://noppa.nl/kennisbank/' . $a['slug']
            ];
        }, $artikelen);

        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        break;
}
