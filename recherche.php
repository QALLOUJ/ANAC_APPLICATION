<?php
require_once 'vendor/autoload.php'; // Charger Composer et Twig

$host = 'localhost';
$dbname = 'appli_tourisme';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialiser les variables
    $places = [];
    $city = isset($_GET['city']) ? $_GET['city'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    // Tables et leurs colonnes correspondantes
    $tables = [
        'hotels' => 'nom, position_gps',
        'musees' => 'nom, position_gps',
        'jardins' => 'nom, position_gps',
        'restaurants' => 'nom, position_gps'
    ];

    // Si une ville est spécifiée
    if (!empty($city)) {
        // Si une catégorie spécifique est sélectionnée
        if (!empty($type) && array_key_exists($type, $tables)) {
            $query = $db->prepare("SELECT id, nom, position_gps FROM $type WHERE ville LIKE :city ");
            $query->execute([':city' => "%$city%"]);
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            
          
            
            foreach ($results as $place) {
                $gps = explode(',', $place['position_gps']);
                if (count($gps) === 2 && is_numeric($gps[0]) && is_numeric($gps[1])) {
                    $places[] = [
                        'id' => $place['id'],  // Assurez-vous que l'ID est récupéré ici
                        'name' => $place['nom'],
                        'lat' => (float) $gps[0],
                        'lon' => (float) $gps[1],
                        'type' => $type
                    ];
                }
            }
        } else {
            // Si aucune catégorie spécifique n'est sélectionnée, récupérer les 3 premiers résultats de chaque catégorie
            foreach ($tables as $table => $columns) {
                $query = $db->prepare("SELECT id, nom, position_gps FROM $table WHERE ville LIKE :city ");
                $query->execute([':city' => "%$city%"]);
                foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $place) {
                    $gps = explode(',', $place['position_gps']);
                    if (count($gps) === 2 && is_numeric($gps[0]) && is_numeric($gps[1])) {
                        $places[] = [
                            'id' => $place['id'],  // Assurez-vous que l'ID est récupéré ici
                            'name' => $place['nom'],
                            'lat' => (float) $gps[0],
                            'lon' => (float) $gps[1],
                            'type' => $table
                        ];
                    }
                }
            }
        }
    }

    // Initialiser Twig
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $pageActive = 'recherche'; 

    // Passer les données au modèle Twig
    echo $twig->render('recherche.html.twig', [
        'places' => $places,
        'city' => $city,
        'type' => $type,
        'pageActive' => $pageActive,
    ]);

} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Erreur générale : ' . $e->getMessage();
}
?>
