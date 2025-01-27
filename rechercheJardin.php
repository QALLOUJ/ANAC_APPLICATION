<?php
session_start();

require 'vendor/autoload.php'; // Assurez-vous que Twig est bien chargé

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

// Récupérer les paramètres de recherche
$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$ville = isset($_GET['ville']) ? $_GET['ville'] : '';

// Construire la requête SQL en fonction des filtres
$query = "SELECT nom FROM liste_des_jardins_remarquables"; // On garde seulement le nom

if ($nom) {
    $query .= " AND LOWER(nom) LIKE :nom";
}

if ($ville) {
    $query .= " AND LOWER(ville) LIKE :ville";
}

// Préparer et exécuter la requête SQL
$stmt = $db->prepare($query);

if ($nom) {
    $stmt->bindValue(':nom', '%' . strtolower($nom) . '%');
}

if ($ville) {
    $stmt->bindValue(':ville', '%' . strtolower($ville) . '%');
}

$stmt->execute();
$jardins = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialiser Twig
$loader = new FilesystemLoader('templates'); // Assurez-vous que 'templates' contient 'rechercheJardin.html.twig'
$twig = new Environment($loader);

// Passer les données à Twig
echo $twig->render('rechercheJardin.html.twig', [
    'liste_des_jardins_remarquables' => $jardins // Passe les données des jardins à Twig
]);
?>
