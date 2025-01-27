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

// Récupérer les musées
$queryMusees = $db->query("SELECT id, nom, themes, ville, telephone, site_web, region FROM musees");
$musees = $queryMusees->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les thèmes uniques des musées
$queryThemes = $db->query("SELECT DISTINCT themes FROM Musees");
$themes = $queryThemes->fetchAll(PDO::FETCH_COLUMN);

// Charger Twig
$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);

// Afficher la page avec les données
echo $twig->render('rechercheMusee.html.twig', [
    'musees' => $musees, // Correction ici
    'themes' => $themes,
]);
?>
