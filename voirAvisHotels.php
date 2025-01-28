<?php
session_start();
require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'appli_tourisme';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Récupérer la ville depuis l'URL
$ville = isset($_GET['ville']) ? trim($_GET['ville']) : null;

// Récupérer la page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 21; // Nombre d'hôtels par page
$offset = ($page - 1) * $perPage;

// Préparer la requête pour récupérer les hôtels et leurs avis pour une ville spécifique
if ($ville) {
    $queryHotels = $db->prepare("
    SELECT hotels.id, hotels.nom, hotels.type, hotels.nb_etoiles, hotels.ville, hotels.telephone, hotels.site_web, hotels.region, 
           GROUP_CONCAT('De : ' , avis.pseudo, ' (', avis.note, '/5) ', avis.avis ORDER BY avis.date DESC) AS avis,
           AVG(avis.note) AS avg_note
    FROM hotels 
    LEFT JOIN avis ON avis.nom = hotels.nom 
    WHERE hotels.ville = :ville 
    GROUP BY hotels.id
    ORDER BY avg_note DESC
    LIMIT :offset, :perPage
");

$queryHotels->bindParam(':ville', $ville);
$queryHotels->bindParam(':offset', $offset, PDO::PARAM_INT);
$queryHotels->bindParam(':perPage', $perPage, PDO::PARAM_INT);
$queryHotels->execute();

} else {
    // Récupérer tous les hôtels si aucune ville n'est spécifiée
    $queryHotels = $db->prepare("
        SELECT hotels.id, hotels.nom, hotels.type, hotels.nb_etoiles, hotels.ville, hotels.telephone, hotels.site_web, hotels.region
        FROM hotels
        LIMIT :offset, :perPage
    ");
    $queryHotels->bindParam(':offset', $offset, PDO::PARAM_INT);
    $queryHotels->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $queryHotels->execute();
}

$hotels = $queryHotels->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le total d'hôtels pour la pagination
if ($ville) {
    $totalQuery = $db->prepare("SELECT COUNT(*) FROM hotels WHERE ville = :ville");
    $totalQuery->bindParam(':ville', $ville);
} else {
    // Si aucune ville n'est spécifiée, on récupère le total de tous les hôtels
    $totalQuery = $db->query("SELECT COUNT(*) FROM hotels");
}

$totalQuery->execute();
$totalHotels = $totalQuery->fetchColumn();
$totalPages = ceil($totalHotels / $perPage);

// Récupérer les villes uniques
$queryVilles = $db->query("SELECT DISTINCT ville FROM hotels WHERE ville IS NOT NULL AND TRIM(ville) != '' ORDER BY ville ASC");
$villes = $queryVilles->fetchAll(PDO::FETCH_ASSOC);

// Charger Twig
$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);

// Définir la page active
$pageActive = 'avis'; 
$pageAvis = 'hotels'; 
$type = "du hôtel"; 

// Rendre la page avec les données nécessaires
echo $twig->render('voirAvisHotels.html.twig', [
    'pageActive' => $pageActive,
    'pageAvis' => $pageAvis,
    'type' => $type,
    'hotels' => $hotels,
    'villes' => $villes,
    'villeChoisie' => $ville,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);
?>
