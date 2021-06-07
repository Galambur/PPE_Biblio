<?php
require_once("../../../php/fonctions/head.php");


$query = "UPDATE planning 
            SET dateDebut=:p_dateDebut,
            dateFin=:p_dateFin, 
            rendu=:p_rendu, 
            id_client=:p_id_client,
            id_livre=:p_id_livre
            WHERE idReserv=:p_idReserv;";

$bdd = getDataBase();

$statement = $bdd->prepare($query);

$statement->bindParam(':p_dateDebut', $_POST['dateDebut']);
$statement->bindParam(':p_dateFin', $_POST['dateFin']);
$statement->bindParam(':p_rendu', $_POST['rendu']);
$statement->bindParam(':p_id_client', $_POST['id_client']);
$statement->bindParam(':p_id_livre', $_POST['id_livre']);
$statement->bindParam(':p_idReserv', $_POST['idReserv']);


if ($statement->execute()) {
    // Rediriger vers la page de liste des publishers
    header('Location: ../accueil/admin_show_reserv.php');
} else {
    echo "Essaye encore !";
}

?>