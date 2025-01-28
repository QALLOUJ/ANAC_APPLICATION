<?php

// Démarrer la session
session_start();


require 'vendor/autoload.php'; // Autoloader pour Twig

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Initialiser Twig
$loader = new FilesystemLoader('templates'); // Assurez-vous que 'templates' contient 'login.html.twig'
$twig = new Environment($loader);


// Définir la page active
$pageActive = 'avis'; 
$pageAvis = 'restaurants'; 
$type = "du restaurant"; 

// Afficher la page de connexion (formulaire)
echo $twig->render('voirAvisRestaurants.html.twig', [
    'pageActive' => $pageActive,
    'pageAvis' => $pageAvis,
    'type' => $type
]);
