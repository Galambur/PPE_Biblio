<?php
require_once("../../../php/fonctions/head.php");


if (isAdmin($id_client) == true) {

$dateDebut = ''; //on initialise la variable
if (isset($_POST['dateDebut'])) {
    $dateDebut = htmlspecialchars($_POST['dateDebut']);
}
echo '<a href="../gestion_reservations/ajouter_reservation.php" class="button_add">Ajouter une réservation</a>';
?>


<div class="top_research">

    <form class="research" action="" method="post">
        <input type="text" name="dateDebut" value="<?php $dateDebut ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>
<div class="centered_alone">

    <?php

    $bdd = getDataBase();
    $reservs = null;

    if (!empty($bdd)) {
        $reservs = getAllReservations($bdd, $dateDebut);
        if (!empty($reservs)) {
            foreach ($reservs as $reserv) {
                ?>
                <div class="object_of_list">
                    <p>Emprunt de <a class="object_title"
                                     href="../../client/infos/infos_livre.php?id_livre=<?= $reserv->id_livre ?>"><?= $reserv->nom_livre ?></a>
                        par <a class="object_title"
                               href="../gestion_client/infos_client.php?id_client=<?= $reserv->id_client ?>"><?= $reserv->nom_client ?> <?= $reserv->prenom_client ?></a>
                        du <?= $reserv->dateDebut ?> au <?= $reserv->dateFin ?>
                    </p>
                </div>
                <?php
            }
        }
    }
    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
</body>
</html>
