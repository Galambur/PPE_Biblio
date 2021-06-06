<?php
require_once ("../../../php/fonctions/head.php");

// la requête qui sera faite dans la base de données
$query = "UPDATE clients 
            SET nom_client=:c_nom_client,
            prenom_client=:c_prenom_client, 
            sexe_client=:c_sexe_client,
            dateNaiss_client=:c_dateNaiss_client, 
            amende=:c_amende,
            id_pays=:c_id_pays,
            mdp=:c_mdp,
            email=:c_email
            WHERE id_client=:c_id_client;";

// récupération de la base de donneés
$bdd = getDataBase();

// préparation de la requête
$statement = $bdd->prepare($query);

// on relie les paramètres de la requête aux informations reçues dans le formulaire
$statement->bindParam(':c_nom_client', $_POST['nom_client']);
$statement->bindParam(':c_prenom_client', $_POST['prenom_client']);
$statement->bindParam(':c_sexe_client', $_POST['sexe_client']);
$statement->bindParam(':c_dateNaiss_client', $_POST['dateNaiss_client']);
$statement->bindParam(':c_amende', $_POST['amende']);
$statement->bindParam(':c_id_pays', $_POST['id_pays']);
$statement->bindParam(':c_id_client', $_POST['id_client']);
$statement->bindParam(':c_mdp', $_POST['mdp']);
$statement->bindParam(':c_email', $_POST['email']);


if ($statement->execute() && isset($_SESSION['id_client']) && $_SESSION['id_client'] == 0) {
    header('Location: ../../admin/accueil/admin_accueil_client.php');
} else if ($statement->execute()){
    // Rediriger vers la page de liste des clients
    header('Location: mon_compte.php');
} else {
    // la requête a échoué
    echo "Essaye encore !";

}



?>