<?php
require_once("../../../php/fonctions/head.php");

$query = "INSERT INTO planning (dateDebut, dateFin, rendu, id_client, id_livre)
            VALUES (:c_dateDebut, :c_dateFin, :c_rendu, :c_id_client, :c_id_livre)";

$bdd=getDataBase();
if ($_POST['rendu'] == null ){
    $_POST['rendu'] = 0;
}

$statement = $bdd->prepare($query);

$statement->bindParam(':c_dateDebut', $_POST['dateDebut']);
$statement->bindParam(':c_dateFin', $_POST['dateFin']);
$statement->bindParam(':c_rendu', $_POST['rendu']);
$statement->bindParam(':c_id_client', $_POST['id_client']);
$statement->bindParam(':c_id_livre', $_POST['id_livre']);

if($statement->execute()){
    header('Location: ../accueil/admin_show_reserv.php');
} else {
    echo "Essaye encore";
}
?>