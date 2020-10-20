<?php


var_dump($_POST);

$query = "UPDATE auteurs 
            SET nom_auteur=:a_nom_auteur,
            prenom_auteur=:a_prenom_auteur, 
            dateNaiss_auteur=:a_dateNaiss_auteur, 
            id_pays=:a_id_pays
            WHERE id_auteur=:a_id_auteur;";

$bdd = getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':a_nom_auteur', $_POST['nom_auteur']);
$statement->bindParam(':a_prenom_auteur', $_POST['prenom_auteur']);
$statement->bindParam(':a_dateNaiss_auteur', $_POST['dateNaiss_auteur']);
$statement->bindParam(':a_id_pays', $_POST['id_pays']);
$statement->bindParam(':a_id_auteur', $_POST['id_auteur']);

//var_dump($_POST['nom_auteur'], $_POST['prenom_auteur'], $_POST['dateNaiss_auteur'], $_POST['id_pays'], $_POST['id_auteur']);

if ($statement->execute()) {
    // Rediriger vers la page de liste des publishers
    header('Location: ../accueil/admin_accueil_author.php');
    //var_dump($_POST['nom_auteur'], $_POST['prenom_auteur'], $_POST['dateNaiss_auteur'], $_POST['id_pays'], $_POST['id_auteur']);
var_dump($_POST);
} else {
    echo "Essaye encore !";
}



?>