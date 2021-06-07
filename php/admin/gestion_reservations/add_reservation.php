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

$q = $bdd->query($mysql);

$row = $bdd->query("SELECT @result AS result")->fetch(PDO::FETCH_ASSOC);

// on peut ajouter
if ($row && $row['result'] == 0) {
    if($q = $bdd->query($mysql)){
        header('Location: ../accueil/admin_show_reserv.php');
    }  else {
        echo "Essaye encore";
    }
} else {
    header('Location: ../accueil/admin_show_reserv.php');
}


?>