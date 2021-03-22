<?php

session_start();

require_once("../../../php/fonctions/head.php");

$bdd = getDatabase();
$pl_login = $_POST;

if (isset($bdd)) {
    $_SESSION["erreur"] = null;
    if (isset($pl_login['mdp']) AND isset($pl_login['email'])) {
        $mdp = htmlspecialchars($_POST['mdp']);
        $liste = getListe($bdd, 'clients', Array("email" => $pl_login['email']), Array(), 'mdp, id_client');
        var_dump($liste);
        if (!empty($liste)) {
            if (count($liste) == 1 /*&& mdp_verify($mdp, $liste[0]->mdp)*/) {
                $id_client = $liste[0]->id_client;
                $_SESSION['id_client'] = $id_client;

            } elseif (count($liste) > 1) {
                $_SESSION['id_client'] = $id_client;
                //Erreur : Il existe plusieurs client avec la même adresse mail!! Grosse erreur d'identification!
                $_SESSION["erreur"] = 1;
            } else {
                //Erreur fréquente : le mot de passe ou l'email ne correspond pas
                $_SESSION["erreur"] = 2;
            }
        } else {
            //Erreur aussi fréquente : L'email n'est pas reconnu
            $_SESSION["erreur"] = 3;
        }
    }


} else {
    $_SESSION["erreur"] = 7;

}

if ($_SESSION["erreur"] != null) {
    header('Location: ../../admin/gestion_client/ajouter_client.php');
} else {
    header('Location: ../../../_index.php');
}


?>