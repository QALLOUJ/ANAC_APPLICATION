<?php
session_start();
require 'vendor/autoload.php';  // Assurez-vous que Twig est bien chargé

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'appli_tourisme';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$errors = [];
$success = '';

// Récupérer les hôtels depuis la base de données
try {
    $result = $db->query('SELECT nom FROM musees')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = "Erreur lors de la récupération des hôtels : " . $e->getMessage();
}

// Traitement du formulaire lors de la soumission
// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $date = $_POST['date'];
    $note = $_POST['note'];
    $avis = $_POST['avis'];
    $pseudo = $_POST['pseudo'];

    // Validation des données
    if (empty($nom) || empty($date) || empty($note) || empty($avis) || empty($pseudo)) {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    // Si pas d'erreurs, on récupère le code postal de l'hôtel
    if (empty($errors)) {
        try {
            // Récupérer le code postal de l'hôtel sélectionné
            $stmt = $db->prepare("SELECT code_postal FROM musees WHERE nom = :nom");
            $stmt->execute([':nom' => $nom]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $code_postal = $result['code_postal'];

                // Insertion dans la base de données
                $stmt = $db->prepare("INSERT INTO avis (nom, date, note, avis, pseudo, type, code_postal) 
                                      VALUES (:nom, :date, :note, :avis, :pseudo, 'Musee', :code_postal)");

                // Exécution de la requête avec les données envoyées
                $stmt->execute([
                    ':nom' => $nom,
                    ':date' => $date,
                    ':note' => $note,
                    ':avis' => $avis,
                    ':pseudo' => $pseudo,
                    ':code_postal' => $code_postal
                ]);

                $success = "Votre avis a été enregistré avec succès!";
            } else {
                $errors[] = "L'hôtel sélectionné n'existe pas.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de l'enregistrement de l'avis : " . $e->getMessage();
            echo $e->getMessage();  // Affiche l'erreur SQL
        }
    }
}

// Charger le template Twig
$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);

$pageActive = 'avis';
$pageAvis = 'musees'; 
$type = "du musée"; 

// Affichage du template avec les variables
echo $twig->render('avisMusees.html.twig', [
    'result' => $result,
    'errors' => $errors,
    'success' => $success,
    'pageActive' => $pageActive,
    'pageAvis' => $pageAvis,
    'type' => $type
]);
?>
