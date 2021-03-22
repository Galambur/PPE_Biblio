<?php
require_once("../../../php/fonctions/head.php");

if (isAdmin($id_client) == true){

$book = null;

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
    <h2>Modifier un livre</h2>

    <form action="update_livre.php" method="post">
        <label for="id_livre">Identifiant : </label>
        <input type="text" name="id_livre" disabled value="<?= $book->id_livre ?>"/><br><br>

        <label for="nom_livre">Nom :</label>
        <input type="text" name="nom_livre" value="<?= $book->nom_livre ?>"/><br><br>

        <label for="date_parution">Date de parution :</label>
        <input type="text" name="date_parution" value="<?= $book->date_parution ?>"/><br><br>

        <label for="resume">Resume :</label>
        <input type="text" name="resume" value="<?= $book->resume ?>"/><br><br>

        <label for="id_genre">Id genre :</label>
        <input type="text" name="id_genre" value="<?= $book->id_genre ?>"/><br><br>

        <label for="id_auteur">Son auteur :</label>
        <input type="text" name="id_auteur" value="<?= $book->id_auteur ?>"/><br><br>

        <input type="hidden" name="id_livre" value="<?= $book->id_livre ?>"/>

        <input type="submit" value="Valider"/>
    </form>
    <?php
    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
