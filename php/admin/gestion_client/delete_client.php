<?php

require_once ("../../../php/fonctions/head.php");
var_dump($_POST);

// Supprimer dans la table
$query = "DELETE FROM clients 
            WHERE id_client=:c_id_client;";

// Etape 1
$bdd = getDataBase();
// Etape 2.1 : prepare
$statement = $bdd->prepare($query);
// Etape 2.2 : paramètres
$statement->bindParam(':c_id_client', $_POST['id_client']);
// Etape 2.3 : exécution
if ($statement->execute()) {
    // Rediriger vers la page de liste des chambres
    header('Location: ../accueil/admin_accueil_client.php');
} else {
    echo "Essaye encore !";
}




