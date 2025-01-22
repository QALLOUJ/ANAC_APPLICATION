<?php
require_once 'vendor/autoload.php'; // Charger Composer et Twig

$host = 'localhost';
$dbname = 'appli_tourisme';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialisation des variables
    $places = [];
    $city = '';
    $type = '';

    // Vérifier les paramètres de recherche
    if (isset($_GET['city']) && !empty($_GET['city'])) {
        $city = $_GET['city'];
    } else {
        // Si la ville n'est pas définie, on peut rediriger ou afficher un message d'erreur
        echo 'La ville est requise pour la recherche.';
        exit;
    }

    if (isset($_GET['type']) && !empty($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        // Si le type n'est pas défini, on peut rediriger ou afficher un message d'erreur
        echo 'Le type de lieu est requis pour la recherche.';
        exit;
    }

    // Pagination : récupérer la page actuelle
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Nombre d'éléments par page
    $offset = ($page - 1) * $limit;

    // Tables à récupérer en fonction du type
    $tables = [
        'hotels' => 'nom, position_gps, photo_url',
        'musees' => 'nom, position_gps, photo_url',
        'liste_des_jardins_remarquables' => 'nom, position_gps, photo_url',
        'restaurants' => 'nom, position_gps, photo_url'
    ];

    // Vérifier que le type existe dans la liste des tables
    if (isset($tables[$type])) {
        $queryStr = "SELECT nom, position_gps, photo_url FROM " . $tables[$type] . " WHERE ville LIKE :city LIMIT :limit OFFSET :offset";
        $query = $db->prepare($queryStr);
        $query->bindValue(':city', "%$city%", PDO::PARAM_STR);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();

        $places = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo 'Type de lieu invalide.';
        exit;
    }

    // Calculer le nombre total de résultats
    $totalResultsQuery = $db->prepare("SELECT COUNT(*) FROM " . $tables[$type] . " WHERE ville LIKE :city");
    $totalResultsQuery->bindValue(':city', "%$city%", PDO::PARAM_STR);
    $totalResultsQuery->execute();
    $totalResults = $totalResultsQuery->fetchColumn();
    $totalPages = ceil($totalResults / $limit);

    // Initialiser Twig
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    // Passer les données à la page Twig
    echo $twig->render('rechercheHotel.html.twig', [
        'places' => $places,
        'city' => $city,
        'type' => $type,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ]);

} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
