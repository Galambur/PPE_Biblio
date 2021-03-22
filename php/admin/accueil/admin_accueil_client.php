<?php
require_once("../../../php/fonctions/head.php");

if (isAdmin($id_client) == true) {

$client_name = ''; //on initialise la variable
if (isset($_POST['client_name'])) {
    $client_name = htmlspecialchars($_POST['client_name']);
}
?>

<a href="../gestion_client/ajouter_client.php" class="button_add">Ajouter un client</a>

<div class="top_research">
    <form class="research" action="" method="post">
        <input type="text" name="client_name" value="<?php $client_name ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>

<div class="centered_alone">
    <?php

    $bdd = getDataBase();
    $clients = null;

    if (!empty($bdd)) {
        $clients = getAllClients($bdd, $client_name);
        if (!empty($clients)) {
            foreach ($clients as $client) {
                ?>
                <div class="object_of_list">
                    <p>(id:<?= $client->id_client ?>) <a class="object_title"
                                href="../gestion_client/infos_client.php?id_client=<?= $client->id_client ?>"><?= $client->nom_client ?> <?= $client->prenom_client ?></a><br>
                        <a class="object_action" href="../../client/infos/modifier_client.php?id_client=<?= $client->id_client ?>">Modifier</a> ou
                        <a class="object_action" href="../gestion_client/supprimer_client.php?id_client=<?= $client->id_client ?>">Supprimer</a>
                        ce client</p>
                </div>
                <?php
            } // fin foreach
        } // fin if (!empty($clients))
        else {
            echo "Aucun auteur ne porte ce nom";
        }
    } // fin if(!empty($bdd))
    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
</body>
</html>
