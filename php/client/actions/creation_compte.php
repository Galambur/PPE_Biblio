<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php

?>

<h2>Ajouter un client</h2>

<form action="add_client.php" method="post">
    <label for="nom_client">Nom :</label>
    <input type="text" name="nom_client"  value=""/><br /><br />

    <label for="prenom_client">Prenom :</label>
    <input type="text" name="prenom_client"  value=""/><br /><br />

    <label for="sexe_client">Sexe :</label>
    <input type="text" name="sexe_client"  value=""/><br /><br />

    <label for="dateNaiss_client">Date de naissance (YYYY-MM-DD):</label>
    <input type="text" name="dateNaiss_client"  value=""/><br/><br />

<!--    <label for="amende">Son amende :</label>
    <input type="text" name="amende"  value=""/><br/><br /> -->

    <label for="id_pays">Identifiant du pays :</label>
    <?php
    $bdd=getDataBase();
    $countries=getAllCountries($bdd);
    ?>
    <select name="id_pays">
        <?php
        foreach ($countries as $country) {
            echo "<option value='" . $country->id_pays . "'" . ">" . $country->nom_pays . "</option>";
        }
        ?>
    </select><br/><br />

    <input type="submit" class="button_form" value="Ajouter"/><br>
</form>

<a href="connexion.php"> Vous avez déjà un compte ? Connectez vous</a>



</body>