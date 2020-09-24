<?php
require_once("../../fonctions/fonctions.php");

var_dump($_POST);

// Supprimer dans la table
$query = "DELETE FROM genres 
            WHERE id_genre=:c_id_genre;";

// Etape 1
$bdd = getDataBase();
// Etape 2.1 : prepare
$statement = $bdd->prepare($query);
// Etape 2.2 : paramètres
$statement->bindParam(':c_id_genre', $_POST['id_genre']);
// Etape 2.3 : exécution
if ($statement->execute()) {
    // Rediriger vers la page de liste des chambres
    header('Location: ../accueil/admin_accueil_genre.php');
} else {
    echo "Essaye encore !";
}




