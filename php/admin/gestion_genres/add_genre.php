<?php
require_once("../../fonctions/fonctions.php");

$query = "INSERT INTO genres (id_genre, genre)
            VALUES (:c_id_genre, :c_genre)";

$bdd=getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':c_id_genre', $_POST['id_genre']);
$statement->bindParam(':c_genre', $_POST['genre']);

if($statement->execute()){
    header('Location: ../accueil/admin_accueil_genre.php');
} else {
    echo "Essaye encore";
}
?>