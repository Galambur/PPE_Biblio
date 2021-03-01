<?php
session_start();
require_once( 'fonctions.php');
$id_client = null;
$doNotHaveAccess = "<h2>Vous n'avez pas acces a cette page</h2>";
$Compte = 'Se connecter/Inscription';
$lien = "LoginRegister.php";
if (isset($_SESSION['id_client'])){
    $id_client = $_SESSION['id_client'];
    $Compte = 'Mon Compte';
    $lien = "MonCompte.php";
}
var_dump($id_client);

$bdd = getDataBase();
$pageAdmin = null;
$admin = false;

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Bibliothèque Montpellier</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/template.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> <!-- style du h1 -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet"> <!-- style bouton -->
</head>
<body>
<header>
    <div class="header">
        <h1><a href="../../../_index.php">Bibliothèque de Montpellier</a></h1>
        <?php
        if($id_client == null) {
            echo '<a href="/php/client/actions/creation_compte.php" class="button">Se connecter / S\'inscrire</a>';
        } else {
            echo '<a href="/php/client/infos/mon_compte.php" class="button">Mon compte</a>';
        }

        ?>

    </div>
</header>

    <?php
    afficherErreur();
    ?>



