<?php
require_once ("../../../php/fonctions/head.php");


if (isset($_GET['id_genre'])){
    $id_genre = $_GET['id_genre'];

    $bdd = getDataBase();

    $query = "SELECT * FROM genres AS g WHERE g.id_genre= :g_id_genre";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':g_id_genre', $id_genre);

    if ($statement->execute()) {
        $genre = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}
?>

<h2>Supprimer le genre</h2>

<form action="delete_genre.php" method="post">
    <label for="id_genre">Identifiant : </label>
    <input type="text" name="id_genre" disabled value="<?= $genre->id_genre ?>"/><br><br>

    <label for="genre">Prenom :</label>
    <input type="text" name="genre" disabled value="<?= $genre->genre ?>"/><br><br>

    <input type="hidden" name="id_genre" value="<?= $genre->id_genre ?>"/>

    <input type="submit" value="Supprimer"/>
</form>
