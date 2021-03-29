<?php
require_once("../../../php/fonctions/head.php");


$client = null;

// l'id client est bien spécifié dans l'url
if (isset($_GET['id_client'])) {
    // on stock cette valeur dans $id_client
    $id_client = $_GET['id_client'];

    // on récupère la base de données
    $bdd = getDataBase();

    // la requête qui permettra de récupérer les informations du client
    $query = "SELECT * FROM clients AS c WHERE c.id_client= :c_id_client";

    // préparation de la requête
    $statement = $bdd->prepare($query);
    // on relie le paramètre :c_id_client à l'id client spécifié dans l'url
    $statement->bindParam(':c_id_client', $id_client);


    if ($statement->execute()) {
        // récupération des informations
        $client = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}

// si c'est un administrateur connecté, ou alors qu'un client essaie de modifier ses propres informations
// cela évite qu'un client puisse modifier les informations d'un autre client en changeant juste sont URL
if($_SESSION['id_client'] == $_GET['id_client'] || $_SESSION['id_client'] == 0) {
    ?>
    <div class="centered_body">
        <div>
            <h2>Modifier vos informations</h2>

            <!-- formulaire pour modifier les informations -->
            <form action="update_client.php" method="post">
                <label for="id_client">Identifiant : </label>
                <input type="text" name="id_client" disabled value="<?= $client->id_client ?>"/><br><br>

                <label for="nom_client">Nom :</label>
                <input type="text" name="nom_client" value="<?= $client->nom_client ?>"/><br><br>

                <label for="prenom_client">Prenom :</label>
                <input type="text" name="prenom_client" value="<?= $client->prenom_client ?>"/><br><br>

                <label for="sexe_client">Sexe :</label>
                <select name="sexe_client">
                    <option value='H'>Homme</option>
                    <option value='F'>Femme</option>
                    <option value='A'>Autre</option>
                </select><br/><br/>

                <label for="dateNaiss_client">Date de naissance :</label>
                <input type="text" name="dateNaiss_client" value="<?= $client->dateNaiss_client ?>"/><br><br>

                <label for="id_pays">Pays :</label>
                <?php
                // tous les pays
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
                <input type="text" name="email" value="<?= $client->email ?>"/><br><br>

                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" value="<?= $client->mdp ?>"/><br><br>

                <input type="hidden" name="id_client" value="<?= $client->id_client ?>"/>
                <input type="hidden" name="amende" value="<?= $client->amende ?>"/><br><br>

                <input type="submit" value="Valider"/>
            </form>
        </div>
    </div>
    <?php
} else {
    // $doNotHaveAccess = "<h2>Vous n'avez pas acces a cette page</h2>"
    echo $doNotHaveAccess;
}
