<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<div class="centered_body">
    <div class="my_account">
        <?php


        $bdd = getDataBase();
        // raffraichissement manuel des amendes
        // le rafraichissement se fait tous les jours mais on peut le faire manuellement
        $mysql = 'CALL calculAmende()';
        $q = $bdd->query($mysql);
        $q->execute();

        if (isset($_SESSION['id_client'])) {
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
        echo '<h2>' . $client->nom_client . " " . $client->prenom_client . '</h2>';
        echo "<h3>Date de naissance : " . $client->dateNaiss_client . '<br>' . " Pays : " . $client->nom_pays . '</h3>';
        echo "<h3>Votre amende : " . $client->amende . '</h3>';
        echo "<p>Vos réservations : " . '</p>';
        $reservations = getAllReservationsByClient($bdd, $client->id_client);

        foreach ($reservations AS $reservation) {
            echo "<p>- " . $reservation->nom_livre . " - " . $reservation->prenom_auteur . " " . $reservation->nom_auteur . " du " . $reservation->dateDebut . " au " . $reservation->dateFin . '</p>';
        }

        echo '<a class="object_action" href="modifier_client.php?id_client=' . $id_client . '"">Modifier mes informations</a><br>';
        echo '<a class="object_action" href="../actions/logout.php">Se déconnecter</a><br>';


        ?>
    </div>
</div>
</body>