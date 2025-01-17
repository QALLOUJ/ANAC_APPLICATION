<?php
try {

 // Base de donnéesà mettre

    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
