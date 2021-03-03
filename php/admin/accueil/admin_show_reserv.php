<?php
require_once ("../../../php/fonctions/head.php");


if (isAdmin($id_client) == true){

$dateDebut = ''; //on initialise la variable
if (isset($_POST['dateDebut'])) {
    $dateDebut = htmlspecialchars($_POST['dateDebut']);
}
?>


<div class="top_research">

    <form class="research" action="" method="post">
        <input type="text" name="dateDebut"  value="<?php $dateDebut ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>

<a href="../gestion_reservations/ajouter_reservation.php">Ajouter une réservation</a><br><br>


<?php

$bdd = getDataBase();
$reservs = null;

if(!empty($bdd)){
    $reservs = getAllReservations($bdd, $dateDebut);
    if (!empty($reservs)){
        foreach ($reservs as $reserv){
            ?>
            <p>La reservation commence le <span id="date"><?=$reserv->dateDebut ?></span> et se termine le <span id="date"><?=$reserv->dateFin ?></span> faite par
                <a href="../gestion_client/infos_client.php?id_client=<?= $reserv->id_client ?>"><?= $reserv->nom_client?> <?= $reserv->prenom_client ?></a> pour le livre
                <a href="../gestion_livres/infos_livre.php?id_livre=<?= $reserv->id_livre ?>"><?= $reserv->nom_livre ?></a>
                 </p>
        <?php
}
    }
}

} else{
    echo $doNotHaveAccess;
}


?>



</body>
</html>
