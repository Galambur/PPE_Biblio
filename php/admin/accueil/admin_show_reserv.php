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
            echo 'La reservation commence le ' . $reserv->dateDebut . ' et se termine le ' . $reserv->dateFin ." faite par " .  $reserv->nom_client . " " . $reserv->prenom_client . " pour le livre " . $reserv->nom_livre . '<br>';
        }
    }
}

} else{
    echo $doNotHaveAccess;
}


?>



</body>
</html>
