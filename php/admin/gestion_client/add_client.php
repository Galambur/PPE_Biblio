<?php

require_once ("../../../php/fonctions/head.php");

// la requête pour ajouter une ligne dans notre base de données dans la table "client"
$query = "INSERT INTO clients (id_client, nom_client, prenom_client, sexe_client, dateNaiss_client, amende, id_pays, email, mdp)
            VALUES (:c_id_client, :c_nom_client, :c_prenom_client, :c_sexe_client, :c_dateNaiss_client, :c_amende, :c_id_pays, :c_email, :c_mdp)";

// on récupère la base de données existante
$bdd=getDataBase();

// comme l'utilisateur ne spécifie pas son amende, on l'initialise à 0
if ($_POST['amende'] == null){
    $_POST['amende'] = 0;
}

// préparation de la requête
$statement = $bdd->prepare($query);

// on relie chaque paramètre à la valeur spécifiée dans le formulaire
$statement->bindParam(':c_id_client', $_POST['id_client']);
$statement->bindParam(':c_nom_client', $_POST['nom_client']);
$statement->bindParam(':c_prenom_client', $_POST['prenom_client']);
$statement->bindParam(':c_sexe_client', $_POST['sexe_client']);
$statement->bindParam(':c_dateNaiss_client', $_POST['dateNaiss_client']);
$statement->bindParam(':c_amende', $_POST['amende']);
$statement->bindParam(':c_id_pays', $_POST['id_pays']);
$statement->bindParam(':c_email', $_POST['email']);
$statement->bindParam(':c_mdp', $_POST['mdp']);

if($statement->execute()){
    // si la requête réussi, on revient sur la page d'accueil, l'utilisateur est créé
    header('Location: ../../../_index.php');
} else {
    // sinon, on spécifie qu'une erreur s'est produite
    echo "Essaye encore";
}
?>