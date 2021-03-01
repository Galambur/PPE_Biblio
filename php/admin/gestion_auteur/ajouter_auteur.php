<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php
if (isAdmin($id_client) == true){
    ?>

    <h2>Ajouter un auteur</h2>

    <form action="add_auteur.php" method="post">
        <label for="nom_auteur">Nom :</label>
        <input type="text" name="nom_auteur"  value=""/><br /><br />

        <label for="prenom_auteur">Prenom :</label>
        <input type="text" name="prenom_auteur"  value=""/><br /><br />

        <label for="dateNaiss_auteur">Date de naissance :</label>
        <input type="text" name="dateNaiss_auteur"  value=""/><br/><br />

        <label for="id_pays">Identifiant du pays :</label>
        <?php
        $bdd=getDataBase();
        $countries=getAllCountries($bdd);
        ?>
        <select name="id_pays" id="">
            <?php
            foreach ($countries as $country) {
                echo "<option value='" . $country->id_pays . "'" . ">" . $country->nom_pays . "</option>";
            }
            ?>
        </select><br/><br />

        <input type="submit" class="button_form" value="Ajouter"/>
    </form>
<?php
}
else {
    echo $doNotHaveAccess;
}
?>

</body>