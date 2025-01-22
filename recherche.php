<?php
require_once 'vendor/autoload.php'; // Charger Composer et Twig

$host = 'localhost';
$dbname = 'appli_tourisme';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données de la ville seulement si le paramètre `city` est fourni
    $places = [];
    if (isset($_GET['city']) && !empty($_GET['city'])) {
        $city = $_GET['city'];

        // Tables à récupérer
        $tables = [
            'hotels' => 'nom, position_gps',
            'musees' => 'nom, position_gps',
            'liste_des_jardins_remarquables' => 'nom, position_gps',
            'restaurants' => 'nom, position_gps'
        ];

        foreach ($tables as $table => $columns) {
            $query = $db->prepare("SELECT $columns FROM $table WHERE ville LIKE :city");
            $query->execute([':city' => "%$city%"]);
            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $place) {
                $gps = explode(',', $place['position_gps']);
                if (count($gps) === 2 && is_numeric($gps[0]) && is_numeric($gps[1])) {
                    $places[] = [
                        'name' => $place['nom'],
                        'lat' => (float) $gps[0],
                        'lon' => (float) $gps[1],
                        'type' => $table // Ajout du type de lieu (table)
                    ];
                }
            }
        }
    }

    // Initialiser Twig
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    // Passer les données à la page Twig
    echo $twig->render('recherche.html.twig', [
        'places' => $places,
        'city' => $city ?? ''
    ]);
    
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Erreur générale : ' . $e->getMessage();
}
?>
