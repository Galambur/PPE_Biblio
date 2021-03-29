<?php
require_once("../../../php/fonctions/head.php");


// La requête qui va supprimer dans la table
$query = "DELETE FROM livres 
            WHERE id_livre=:l_id_livre;";

// Recuperation de la bdd
$bdd = getDataBase();

// Preparation de la requete
$statement = $bdd->prepare($query);

// On relie le paramètre a notre identifiant
$statement->bindParam(':l_id_livre', $_POST['id_livre']);

if ($statement->execute()) {
    // Rediriger vers la page de liste des livres
    header('Location: ../../client/accueil/client_accueil_book.php');
} else {
    echo "Essaye encore !";
}




