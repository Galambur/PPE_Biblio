<?php


var_dump($_POST);

$query = "UPDATE livres 
            SET nom_livre=:l_nom_livre,
            date_parution=:l_date_parution, 
            resume=:l_resume, 
            id_genre=:l_id_genre,
            id_auteur=:l_id_auteur
            WHERE id_livre=:l_id_livre;";

$bdd = getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':l_nom_livre', $_POST['nom_livre']);
$statement->bindParam(':l_date_parution', $_POST['date_parution']);
$statement->bindParam(':l_resume', $_POST['resume']);
$statement->bindParam(':l_id_genre', $_POST['id_genre']);
$statement->bindParam(':l_id_auteur', $_POST['id_auteur']);
$statement->bindParam(':l_id_livre', $_POST['id_livre']);


//var_dump($_POST['nom_auteur'], $_POST['prenom_auteur'], $_POST['dateNaiss_auteur'], $_POST['id_pays'], $_POST['id_auteur']);

if ($statement->execute()) {
    // Rediriger vers la page de liste des publishers
    header('Location: ../accueil/admin_accueil_book.php');
var_dump($_POST);
} else {
    echo "Essaye encore !";
}



?>