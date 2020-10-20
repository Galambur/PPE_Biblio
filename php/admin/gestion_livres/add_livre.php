<?php
require_once("../../../php/fonctions/head.php");

$query = "INSERT INTO livres (id_livre, nom_livre, date_parution, resume, id_genre, id_auteur)
            VALUES (:l_id_livre, :l_nom_livre, :l_date_parution, :l_resume, :l_id_genre, :l_id_auteur)";

$bdd=getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':l_id_livre', $_POST['id_livre']);
$statement->bindParam(':l_nom_livre', $_POST['nom_livre']);
$statement->bindParam(':l_date_parution', $_POST['date_parution']);
$statement->bindParam(':l_resume', $_POST['resume']);
$statement->bindParam(':l_id_genre', $_POST['id_genre']);
$statement->bindParam(':l_id_auteur', $_POST['id_auteur']);


if($statement->execute()){
    header('Location: ../accueil/admin_accueil_book.php');
} else {
    echo "Essaye encore";
}
?>