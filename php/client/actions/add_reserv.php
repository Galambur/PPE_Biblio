<?php
require_once("../../../php/fonctions/head.php");

$bdd=getDataBase();

if ($_POST['rendu'] == null ){
    $_POST['rendu'] = 0;
}

$mysql = "CALL addReserv('" . $_POST['dateDebut'] . "', '" .
    $_POST['dateFin'] . "', " .
    $_POST['rendu'] . ", " .
    $_POST['id_client'] . ", " .
    $_POST['id_client'] . ")";

var_dump($mysql);
$q = $bdd->query($mysql);


if($q->execute() && isAdmin($id_client) == true){
    header('Location: ../accueil/admin_show_reserv.php');
} else if ($q->execute()){
    header('Location: ../accueil/client_accueil_book.php');
} else {
    echo "Essaye encore";
}
?>