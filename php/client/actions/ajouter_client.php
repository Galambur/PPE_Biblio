<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>
</header>
<body>
<div class="centered_body">
    <div class="connexion_form">
        <!-- Titre de la page -->
        <h2>Créer un compte</h2>

        <?php
        // si c'est un administrateur qui fait cette action ou si c'est un utilisateur, nous n'aurons pas la même action de faite :
        // un utilisateur sera directement connecté après la création de son compte.
        // un administrateur ne sera pas connecté au compte du nouvel utilisateur
        // dans les deux cas, on utilise un formulaire
        if (isset($_SESSION['id_client']) && $_SESSION['id_client'] == 0) {
            // l'action faite à la validation si c'est un administrateur
            echo '<form action="../../admin/gestion_client/add_client.php" method="post">';
        } else {
            // l'action faite à la validation si c'est un simple utilisateur
            echo '<form action="../../client/actions/create_account.php" method="post">';
        }
        ?>

        <!-- L'input pour le nom du client -->
        <label for="nom_client">Nom :</label>
        <input type="text" name="nom_client" value=""/><br/><br/>

        <!-- L'input pour le prénom du client -->
        <label for="prenom_client">Prenom :</label>
        <input type="text" name="prenom_client" value=""/><br/><br/>

        <!-- Trois choix possibles pour le sexe du client -->
        <label for="sexe_client">Sexe :</label>
        <select name="sexe_client">
            <option value='H'>Homme</option>
            <option value='F'>Femme</option>
            <option value='A'>Autre</option>
        </select><br/><br/>

        <!-- L'input pour la date de naissance du client, sous la forme (YYY-MM-DD) -->
        <label for="dateNaiss_client">Date de naissance (YYYY-MM-DD):</label>
        <input type="text" name="dateNaiss_client" value=""/><br/><br/>

        <!-- Un select avec tous les pays présents dans notre base de données, l'utilisateur n'a qu'à sélectionner son pays -->
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

        <!-- L'input pour le mail de l'utilisateur -->
        <label for="email">Email :</label>
        <input type="text" name="email" value=""/><br/><br/>

        <!-- L'input pour le mot de passe de l'utilisateur, il sera caché à la vue -->
        <label for="mdp">Mot de passe:</label>
        <input type="password" name="mdp" value=""/><br/><br/>

        <!-- On ne laisse pas l'utilisateur entrer une valeur pour sa propre amende -->
        <label for="amende"></label>

        <!-- Bouton valider, au clic de ce bouton, le compte sera créé -->
        <input type="submit" class="button_add" value="Valider"/><br>
        </form>
        <br>

        <!-- Bouton qui redirige vers notre page de connexion -->
        <a href="connexion.php" class="connexion_button"> Vous avez déjà un compte ? Connectez vous</a>
    </div>
</div>

</body>




