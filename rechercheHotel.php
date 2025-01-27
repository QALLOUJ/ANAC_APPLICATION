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

// Récupérer les données des jardins remarquables
$queryJardins = $db->query("SELECT nom , ville, type FROM hotels");
$jardins = $queryJardins->fetchAll(PDO::FETCH_ASSOC);

// Initialiser Twig
$loader = new FilesystemLoader('templates'); // Assurez-vous que 'templates' contient 'rechercheJardin.html.twig'
$twig = new Environment($loader);

// Passer les données à Twig
echo $twig->render('rechercheHotel.html.twig', [
    'jardins' => $jardins // Passe les données des jardins à Twig
]);
?>
