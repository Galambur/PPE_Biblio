<?php
require_once("../../fonctions/fonctions.php");
$bdd = getDataBase();

$query_count = "SELECT COUNT(*) AS CountLivre FROM livres WHERE id_auteur=:l_id_auteur";

$statement_count = $bdd->prepare($query_count);
$statement_count->bindParam(':l_id_auteur', $_POST['id_auteur']);
$statement_count->execute();

$result = $statement_count->fetch(PDO::FETCH_OBJ);

$count = intval($result->CountLivre);
var_dump($count);

if ($count == 0){
    echo "ca degage";
    $query = "DELETE FROM auteurs WHERE id_auteur=:a_id_auteur";

    $statement = $bdd->prepare($query);

    $statement->bindParam(':a_id_auteur', $_POST['id_auteur']);

    if ($statement->execute()){
        header('Location: ../accueil/admin_accueil_author.php');
    } else {
        echo "Essaye encore";
    }
} else {
    echo "Nous possédons encore des livres de cet auteur, tu ne peux pas le supprimer";
}












