<?php
// Connexion à la base de données
// Paramètres de connexion à la base de données
$host = 'localhost';  // Hôte de la base de données
$dbname = 'appli_tourisme';  // Nom de la base de données
$username = 'root';  // Nom d'utilisateur de la base de données (par défaut 'root' pour XAMPP)
$password = '';  // Le mot de passe de l'utilisateur (par défaut vide pour XAMPP)

try {
    // Connexion à la base de données
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Gérer les erreurs
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

$queryHotels = $db->prepare("SELECT id, nom, ville FROM hotels WHERE ville LIKE :city");
$queryHotels->bindValue(':city', '%' . $_GET['city'] . '%');
$queryHotels->execute();
$hotels = $queryHotels->fetchAll(PDO::FETCH_ASSOC);

// Requête pour récupérer les musées
$queryMusees = $db->prepare("SELECT id, nom, ville FROM musees WHERE ville LIKE :city");
$queryMusees->bindValue(':city', '%' . $_GET['city'] . '%');
$queryMusees->execute();
$musees = $queryMusees->fetchAll(PDO::FETCH_ASSOC);

// Requête pour récupérer les jardins
$queryJardins = $db->prepare("SELECT id, nom, ville FROM liste_des_jardins_remarquables WHERE ville LIKE :city");
$queryJardins->bindValue(':city', '%' . $_GET['city'] . '%');
$queryJardins->execute();
$jardins = $queryJardins->fetchAll(PDO::FETCH_ASSOC);

// Requête pour récupérer les restaurants
$queryRestaurants = $db->prepare("SELECT id, nom, ville FROM restaurants WHERE ville LIKE :city");
$queryRestaurants->bindValue(':city', '%' . $_GET['city'] . '%');
$queryRestaurants->execute();
$restaurants = $queryRestaurants->fetchAll(PDO::FETCH_ASSOC);

// Initialisation de Twig
require_once 'vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);

// Affichage avec Twig
echo $twig->render('recherche.html.twig', [
    'hotels' => $hotels,
    'musees' => $musees,
    'jardins' => $jardins,
    'restaurants' => $restaurants,
]);
?>



