<?php

require_once ("../../../php/fonctions/head.php");

//var_dump($_POST);
// Insertion dans la table
$query = "INSERT INTO planning(dateDebut, dateFin, rendu, id_client, id_livre)
          VALUES(:c_dateDebut, :c_dateFin, :c_rendu, :c_id_client, :c_id_livre);";

// Etape 1
$bdd = getDataBase();
// Etape 2.1 : prepare
$statement = $bdd->prepare($query);
// Etape 2.2 : paramètres
$statement->bindParam(':c_dateDebut', $_POST['dateDebut']);
$statement->bindParam(':c_dateFin', $_POST['dateFin']);
$statement->bindParam(':c_rendu', $_POST['rendu']);
$statement->bindParam(':c_id_client', $_POST['id_client']);
$statement->bindParam(':c_id_livre', $_POST['id_livre']);
// Etape 2.3 : exécution

if ($statement->execute()) {
    // Rediriger vers la page de liste des chambres
    header('Location: ../accueil/client_accueil_book.php');
   die();
} else {
    echo "Essaye encore !";
}




