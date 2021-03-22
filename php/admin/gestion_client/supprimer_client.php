<?php
require_once("../../../php/fonctions/head.php");

if (isAdmin($id_client) == true){

if (isset($_GET['id_client'])) {
    $id_client = $_GET['id_client'];

    $bdd = getDataBase();

    $query = "SELECT * FROM clients AS a WHERE a.id_client= :a_id_client";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':a_id_client', $id_client);

    if ($statement->execute()) {
        $client = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}
?>

<div class="centered_alone">
    <h2>Supprimer le client</h2>

    <form action="delete_client.php" method="post">
        <label for="id_client">Identifiant : </label>
        <input type="text" name="id_client" disabled value="<?= $client->id_client ?>"/><br><br>

        <label for="nom_client">Nom :</label>
        <input type="text" name="nom_client" disabled value="<?= $client->nom_client ?>"/><br><br>

        <label for="prenom_client">Prenom :</label>
        <input type="text" name="prenom_client" disabled value="<?= $client->prenom_client ?>"/><br><br>

        <label for="dateNaiss_client">Date de naissance :</label>
        <input type="text" name="dateNaiss_client" disabled value="<?= $client->dateNaiss_client ?>"/><br><br>

        <label for="id_pays">Id pays :</label>
        <input type="text" name="id_pays" disabled value="<?= $client->id_pays ?>"/><br><br>

        <label for="email">Email :</label>
        <input type="text" name="email" disabled value="<?= $client->email ?>"/><br><br>

        <label for="mdp">Mot de passe :</label>
        <input type="text" name="mdp" disabled value="<?= $client->mdp ?>"/><br><br>

        <input type="hidden" name="id_client" value="<?= $client->id_client ?>"/>

        <input type="submit" value="Supprimer"/>
    </form>
    <?php
    }
    else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
