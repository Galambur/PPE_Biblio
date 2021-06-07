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
    $_POST['id_livre'] . ", @result )";




if($q = $bdd->query($mysql)){
    header('Location: ../accueil/client_accueil_book.php');
}  else {
    echo "Essaye encore";
}
?>