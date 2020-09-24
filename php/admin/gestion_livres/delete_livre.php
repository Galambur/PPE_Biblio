<?php
require_once("../../fonctions/fonctions.php");

var_dump($_POST);

// Supprimer dans la table
$query = "DELETE FROM livres 
            WHERE id_livre=:l_id_livre;";

// Etape 1
$bdd = getDataBase();
// Etape 2.1 : prepare
$statement = $bdd->prepare($query);
// Etape 2.2 : paramètres
$statement->bindParam(':l_id_livre', $_POST['id_livre']);
// Etape 2.3 : exécution
if ($statement->execute()) {
    // Rediriger vers la page de liste des chambres
    header('Location: ../accueil/admin_accueil_book.php');
} else {
    echo "Essaye encore !";
}




