<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<div class="centered_alone">
    <?php

    if (isAdmin($id_client) == true) {

        $bdd = getDataBase();

        if (isset($_GET['id_client'])) {
            $id_client = $_GET['id_client'];

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
        echo "<p>Date de naissance : " . $client->dateNaiss_client . '<br>' . " Son pays : " . $client->nom_pays . '<br><br>';
        echo "Son amende est de : " . $client->amende . '<br><br>';
        echo "Ses réservations sont : " . '</p> <br>';
        $reservations = getAllReservationsByClient($bdd, $client->id_client);

        foreach ($reservations AS $reservation) {
            echo "<p>Reservation de " . $reservation->nom_livre . " - " . $reservation->prenom_auteur . " " . $reservation->nom_auteur . " du " . $reservation->dateDebut . " au " . $reservation->dateFin . '</p><br>';
        }

        echo '<a class="object_action" href="../gestion_reservations/ajouter_reservation.php">Ajouter une réservation au client';

    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
</body>