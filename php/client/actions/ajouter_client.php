<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<div class="centered_body">
    <div class="connexion_form">
        <h2>Créer un compte</h2>

        <?php
        if (isset($_SESSION['id_client']) && $_SESSION['id_client'] == 0) {
            echo '<form action="../../admin/gestion_client/add_client.php" method="post">';
        } else {
            echo '<form action="../../client/actions/create_account.php" method="post">';
        }
        ?>

        <label for="nom_client">Nom :</label>
        <input type="text" name="nom_client" value=""/><br/><br/>

        <label for="prenom_client">Prenom :</label>
        <input type="text" name="prenom_client" value=""/><br/><br/>

        <label for="sexe_client">Sexe :</label>
        <select name="sexe_client">
            <option value='H'>Homme</option>
            <option value='F'>Femme</option>
            <option value='A'>Autre</option>
        </select><br/><br/>

        <label for="dateNaiss_client">Date de naissance (YYYY-MM-DD):</label>
        <input type="text" name="dateNaiss_client" value=""/><br/><br/>

        <label for="id_pays">Pays :</label>
        <?php
        $bdd = getDataBase();
        $countries = getAllCountries($bdd);
        ?>
        <select name="id_pays">
            <?php
            foreach ($countries as $country) {
                echo "<option value='" . $country->id_pays . "'" . ">" . $country->nom_pays . "</option>";
            }
            ?>
        </select><br/><br/>

        <label for="email">Email :</label>
        <input type="text" name="email" value=""/><br/><br/>

        <label for="mdp">Mot de passe:</label>
        <input type="password" name="mdp" value=""/><br/><br/>

        <label for="amende"></label>

        <input type="submit" class="button_add" value="Valider"/><br>
        </form>
        <br>

        <a href="connexion.php" class="connexion_button"> Vous avez déjà un compte ? Connectez vous</a>
    </div>
</div>

</body>