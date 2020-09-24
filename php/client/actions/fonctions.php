<?php

function getDataBase() {
    try {
        // mettre @ avant la fonction (comme @PDO....) pour éviter d'afficher les errreurs
        $bdd = new PDO('mysql:host=localhost;dbname=neptune;charset=utf8',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function getAllChambres(PDO $bdd, $numC) {
    $query = "SELECT * FROM chambres AS c ,
                 tarifs AS t WHERE c.tarif_id=t.id";

// si on rentre pas quelque chose de vide ou égal à 0
    if ( is_numeric($numC) && $numC > 0) {
        $query .= " AND c.numero = :c_numero";
    }
    $chambers = null;
    //requete préparée
    $statement = $bdd->prepare($query);

    // pour afficher toute la liste
    if (is_numeric($numC) && $numC > 0) {
        $statement->bindParam(':c_numero', $numC, PDO::PARAM_INT); // dernière partie : pour dire qu'on utilise un int
    }

    if ($statement->execute()) {
        $chambers = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $chambers;
}

function getAllTarifs(PDO $bdd) {
    $query = "SELECT * FROM tarifs;";

    $statement = $bdd->query($query);
    $tarifs = $statement->fetchAll(PDO::FETCH_OBJ);
    // Fermeture de la ressource
     $statement->closeCursor();

    return $tarifs;
}

function getAllPays(PDO $bdd) {
    $query = "SELECT * FROM pays;";

    $statement = $bdd->query($query);
    $pays = $statement->fetchAll(PDO::FETCH_OBJ);
    // Fermeture de la ressource
    $statement->closeCursor();

    return $pays;
}

function getAllReserv(PDO $bdd, $date)
{
    $query = "SELECT * FROM planning AS p, chambres AS ch, 
                clients AS cl WHERE p.chambre_id=ch.numero 
                    AND p.client_id=cl.id";

// si on rentre pas quelque chose de vide ou égal à 0
    if ($date > 0) {
        $query .= " AND p.jour LIKE :p_jour";
    }
    $reservation = null;
    $statement = $bdd->prepare($query);

    // pour afficher toute la liste et pas juste un reservation
    if ($date > 0) {
        $date = $date . '%';
        $statement->bindParam(':p_jour', $date);
    }

    if ($statement->execute()) {
        $reservation = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $reservation;
}





