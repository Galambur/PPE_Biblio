<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php


$bdd = getDataBase();

if (isset($_SESSION['id_client'])){
    $id_client = $_SESSION['id_client'];

    $bdd = getDataBase();

    $query = "SELECT * FROM clients AS c, pays AS p WHERE c.id_pays=p.id_pays AND c.id_client=:c_id_client";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':c_id_client', $id_client);

    if ($statement->execute()) {
        $client = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}

echo '<h2>' . "Informations de " . $client->nom_client . " " . $client->prenom_client . '</h2>';
echo "Date de naissance : " . $client->dateNaiss_client . '<br>' . " Son pays : " . $client->nom_pays . '<br><br>';
echo"Vos réservations : " . '<br>';
$reservations = getAllReservationsByClient($bdd, $client->id_client);

foreach ($reservations AS $reservation){
    echo "Reservation de " . $reservation->nom_livre . " - " . $reservation->prenom_auteur . " " . $reservation->nom_auteur . " à partir de " . $reservation->dateDebut . " jusqu'à " . $reservation->dateFin . '<br>';
}

echo '<a href="../actions/logout.php">Se déconnecter</a>';


?>
</body>