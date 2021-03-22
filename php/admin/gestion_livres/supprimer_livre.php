<?php
require_once("../../../php/fonctions/head.php");

if (isAdmin($id_client) == true){


if (isset($_GET['id_livre'])) {
    $id_livre = $_GET['id_livre'];

    $bdd = getDataBase();

    $query = "SELECT * FROM livres AS l WHERE l.id_livre= :l_id_livre";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':l_id_livre', $id_livre);

    if ($statement->execute()) {
        $book = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}
?>

<div class="centered_alone">
    <h2>Supprimer le livre</h2>

    <form action="delete_livre.php" method="post">
        <label for="id_livre">Identifiant : </label>
        <input type="text" name="id_livre" disabled value="<?= $book->id_livre ?>"/><br><br>

        <label for="nom_livre">Nom :</label>
        <input type="text" name="nom_livre" disabled value="<?= $book->nom_livre ?>"/><br><br>

        <label for="date_parution">Date de parution :</label>
        <input type="text" name="date_parution" disabled value="<?= $book->date_parution ?>"/><br><br>

        <label for="resume">Résumé :</label>
        <input type="text" name="resume" disabled value="<?= $book->resume ?>"/><br><br>

        <label for="id_genre">Id genre :</label>
        <input type="text" name="id_genre" disabled value="<?= $book->id_genre ?>"/><br><br>

        <label for="id_auteur">Id auteur :</label>
        <input type="text" name="id_auteur" disabled value="<?= $book->id_auteur ?>"/><br><br>

        <input type="hidden" name="id_livre" value="<?= $book->id_livre ?>"/>

        <input type="submit" value="Supprimer"/>
    </form>
    <?php
    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
