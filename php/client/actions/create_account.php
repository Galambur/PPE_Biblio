<?php

require_once ("../../../php/fonctions/head.php");

$query = "INSERT INTO clients (id_client, nom_client, prenom_client, sexe_client, dateNaiss_client, amende, id_pays, email, mdp)
            VALUES (:c_id_client, :c_nom_client, :c_prenom_client, :c_sexe_client, :c_dateNaiss_client, :c_amende, :c_id_pays, :c_email, :c_mdp)";

$bdd=getDataBase();

if ($_POST['amende'] == null){
    $_POST['amende'] = 0;
}

$statement = $bdd->prepare($query);

$statement->bindParam(':c_id_client', $_POST['id_client']);
$statement->bindParam(':c_nom_client', $_POST['nom_client']);
$statement->bindParam(':c_prenom_client', $_POST['prenom_client']);
$statement->bindParam(':c_sexe_client', $_POST['sexe_client']);
$statement->bindParam(':c_dateNaiss_client', $_POST['dateNaiss_client']);
$statement->bindParam(':c_amende', $_POST['amende']);
$statement->bindParam(':c_id_pays', $_POST['id_pays']);
$statement->bindParam(':c_email', $_POST['email']);
$statement->bindParam(':c_mdp', $_POST['mdp']);


// si la création du compte se passe correctement
if($statement->execute()){

    // création d'une session
    session_start();

    // On stock ce qu'on reçoit avec le formulaire de la page de création de compte dans la variable $pl_login
    // Cela va être utilisé pour connecter automatiquement l'utilisateur
    $pl_login = $_POST;

    // la base de données n'est pas vide
    if (isset($bdd)) {
        // initialisation de $_SESSION["erreur"] : on pourra reconnaître le type d'erreur par sa valeur
        $_SESSION["erreur"] = null;

        // Les champs mot de passe et email sont remplis
        if (isset($pl_login['mdp']) AND isset($pl_login['email'])) {
            $mdp = htmlspecialchars($_POST['mdp']);
            // on récupère le mot de passe et l'id du client ayant pour email l'email fournie dans le formulair
            $liste = getListe($bdd, 'clients', Array("email" => $pl_login['email']), Array(), 'mdp, id_client');

            // dans le cas où on trouve un utilisateur qui correspond à l'email
            if (!empty($liste)) {
                // un seul utilisateur trouvé avec cette adresse mail
                if (count($liste) == 1) {
                    $id_client = $liste[0]->id_client;
                    $_SESSION['id_client'] = $id_client;
                } elseif (count($liste) > 1) {
                    // Il existe plusieurs clients avec cette adresse mail
                    $_SESSION['id_client'] = $id_client;
                    $_SESSION["erreur"] = 1;
                } else {
                    // Le mot de passe ne correspond pas à cette adresse mail
                    $_SESSION["erreur"] = 2;
                }
            } else {
                // Aucun utilisateur ne possède cette adresse mail
                $_SESSION["erreur"] = 3;
            }
        }
    } else {
        // La base de données est vide
        $_SESSION["erreur"] = 7;
    }

    if ($_SESSION["erreur"] != null) {
        // il y a eu une erreur lors de la connexion
        header('Location: Location: ajouter_client');
    } else {
        // il n'y a eu aucune erreur lors de la connexion, on retourne à la page d'accueil
        header('Location: ../../../index.php');
    }
} else {
    // la requête de création de compte a échoué
    echo "Essaye encore";
}

?>