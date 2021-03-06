<?php
require_once("../../../php/fonctions/head.php");


if (isAdmin($id_client) == true){

if (isset($_GET['id_auteur'])) {
    $id_auteur = $_GET['id_auteur'];

    $bdd = getDataBase();

    $query = "SELECT * FROM auteurs AS a WHERE a.id_auteur= :a_id_auteur";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':a_id_auteur', $id_auteur);

    if ($statement->execute()) {
        $author = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}
?>

<div class="centered_alone">
    <h2>Supprimer l'auteur</h2>

    <form action="delete_auteur.php" method="post">
        <label for="id_auteur">Identifiant : </label>
        <input type="text" name="id_auteur" disabled value="<?= $author->id_auteur ?>"/><br><br>

        <label for="nom_auteur">Nom :</label>
        <input type="text" name="nom_auteur" disabled value="<?= $author->nom_auteur ?>"/><br><br>

        <label for="prenom_auteur">Prenom :</label>
        <input type="text" name="prenom_auteur" disabled value="<?= $author->prenom_auteur ?>"/><br><br>

        <label for="dateNaiss_auteur">Date de naissance :</label>
        <input type="text" name="dateNaiss_auteur" disabled value="<?= $author->dateNaiss_auteur ?>"/><br><br>

        <label for="id_pays">Id pays :</label>
        <input type="text" name="id_pays" disabled value="<?= $author->id_pays ?>"/><br><br>

        <input type="hidden" name="id_auteur" value="<?= $author->id_auteur ?>"/>

        <input type="submit" value="Supprimer"/>
    </form>
    <?php
    }
    else {
        echo "<h2>Vous  n'avez pas acces a cette page</h2>";
    }
    ?>
</div>
