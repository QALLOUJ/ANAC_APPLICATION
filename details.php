<?php
require_once 'vendor/autoload.php'; // Charger Composer et Twig

$host = 'localhost';
$dbname = 'appli_tourisme';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les paramètres 'type' et 'id' sont présents dans l'URL
    $type = $_GET['type'] ?? null;
    $id = $_GET['id'] ?? null;

    if ($type && $id) {
        // Préparer et exécuter la requête pour récupérer les détails du lieu
        $query = $db->prepare("SELECT * FROM $type WHERE id = :id");
        $query->execute([':id' => $id]);
        $place = $query->fetch(PDO::FETCH_ASSOC);

        // Si le lieu est trouvé, afficher les détails
        if ($place) {
            // Initialiser Twig
            $loader = new \Twig\Loader\FilesystemLoader('templates');
            $twig = new \Twig\Environment($loader);

            echo $twig->render('details.html.twig', [
                'place' => $place,
                'type' => $type,
            ]);
        } else {
            // Si le lieu n'est pas trouvé
            echo 'Lieu introuvable.';
        }
    } else {
        // Si le type ou l'ID sont manquants
        echo 'Type ou ID manquant.';
    }

} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Erreur générale : ' . $e->getMessage();
}
?>
