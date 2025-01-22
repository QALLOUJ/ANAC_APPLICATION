<?php

// Paramètres de connexion à la base de données
$host = 'localhost';      // Hôte de la base de données (par exemple : localhost)
$dbname = 'appli_tourisme';   // Nom de la base de données

try {
    // Créer la connexion avec PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8");
    
    // Activer les exceptions pour les erreurs
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configuration du jeu de caractères UTF-8
    $db->exec('SET NAMES "UTF8"');

} catch (PDOException $e) {
    // En cas d'erreur de connexion, affiche un message d'erreur
    die('Erreur : ' . $e->getMessage());
}
?>
