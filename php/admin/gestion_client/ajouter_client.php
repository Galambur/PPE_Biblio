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

    <label for="dateNaiss_client">Date de naissance :</label>
    <input type="text" name="dateNaiss_client"  value=""/><br/><br />

    <label for="amende">Son amende :</label>
    <input type="text" name="amende"  value=""/><br/><br />

    <label for="id_pays">Pays :</label>
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

    <label for="email">Son email :</label>
    <input type="text" name="email"  value=""/><br/><br />

    <label for="mdp">Son mdp :</label>
    <input type="text" name="mdp"  value=""/><br/><br />

    <input type="submit" class="button_form" value="Ajouter"/>
</form>


</body>