<?php
require_once("../../../php/fonctions/head.php");


$client = null;

if (isset($_GET['id_client'])){
    $id_client = $_GET['id_client'];

    $bdd = getDataBase();

    $query = "SELECT * FROM clients AS c WHERE c.id_client= :c_id_client";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':c_id_client', $id_client);

    if ($statement->execute()) {
        $client = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}
?>
<h2>Modifier un client</h2>

<form action="update_client.php" method="post">
    <label for="id_client">Identifiant : </label>
    <input type="text" name="id_client" disabled value="<?= $client->id_client ?>"/><br><br>

    <label for="nom_client">Nom :</label>
    <input type="text" name="nom_client" value="<?= $client->nom_client ?>"/><br><br>

    <label for="prenom_client">Prenom :</label>
    <input type="text" name="prenom_client" value="<?= $client->prenom_client ?>"/><br><br>

    <label for="sexe_client">Sexe :</label>
    <input type="text" name="sexe_client" value="<?= $client->sexe_client ?>"/><br><br>

    <label for="dateNaiss_client">Date de naissance :</label>
    <input type="text" name="dateNaiss_client" value="<?= $client->dateNaiss_client ?>"/><br><br>

    <label for="id_pays">Id pays :</label>
    <input type="text" name="id_pays" value="<?= $client->id_pays ?>"/><br><br>

    <label for="email">Email :</label>
    <input type="text" name="email" value="<?= $client->email ?>"/><br><br>

    <label for="mdp">Mot de passe :</label>
    <input type="text" name="mdp" value="<?= $client->mdp ?>"/><br><br>

    <input type="hidden" name="id_client" value="<?= $client->id_client ?>"/>
    <input type="hidden" name="amende" value="<?= $client->amende ?>"/><br><br>

    <input type="submit" value="Valider"/>
</form>

