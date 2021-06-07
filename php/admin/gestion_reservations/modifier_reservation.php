<?php
require_once("../../../php/fonctions/head.php");

if (isAdmin($id_client) == true){

$reserv = null;

if (isset($_GET['idReserv'])) {
    $idReserv = $_GET['idReserv'];

    $bdd = getDataBase();

    $query = "SELECT * FROM planning AS p WHERE p.idReserv= :p_idReserv";

    $statement = $bdd->prepare($query);

    $statement->bindParam(':p_idReserv', $idReserv);

    if ($statement->execute()) {
        $reserv = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}
?>
<div class="centered_alone">
    <h2>Modifier une réservation</h2>

    <form action="update_reservation.php" method="post">
        <label for="idReserv">Identifiant : </label>
        <input type="text" name="idReserv" disabled value="<?= $reserv->idReserv ?>"/><br><br>

        <label for="dateDebut">Date début :</label>
        <input type="text" name="dateDebut" value="<?= $reserv->dateDebut ?>"/><br><br>

        <label for="dateFin">Date fin :</label>
        <input type="text" name="dateFin" value="<?= $reserv->dateFin ?>"/><br><br>

        <label for="rendu">Rendu ?</label>
        <select name="rendu">
            <?php
            if ($reserv->rendu == 1){
                echo '<option value="1" selected>Oui</option>';
                echo '<option value="0">Non</option>';
            } else {
                echo '<option value="1">Oui</option>';
                echo '<option value="0" selected>Non</option>';
            }
            ?>
        </select><br><br>

        <label for="id_client">Id client :</label>
        <input type="text" name="id_client" value="<?= $reserv->id_client ?>"/><br><br>

        <label for="id_livre">Id livre :</label>
        <input type="text" name="id_livre" value="<?= $reserv->id_livre ?>"/><br><br>

        <input type="hidden" name="idReserv" value="<?= $reserv->idReserv ?>"/>

        <input type="submit" value="Valider"/>
    </form>
    <?php
    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
