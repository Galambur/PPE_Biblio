<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php
if (isAdmin($id_client) == true){
?>

<div class="centered_alone">
    <h2>Ajouter une réservation</h2>

    <form action="add_reservation.php" method="post">
        <label for="dateDebut">Date début :</label>
        <input type="text" name="dateDebut" value=""/><br/><br/>

        <label for="dateFin">Date fin :</label>
        <input type="text" name="dateFin" value=""/><br/><br/>

        <label for="id_client">Client :</label>
        <?php
        // tous les pays
        $bdd = getDataBase();
        $clients = getAllClients($bdd, "");
        ?>
        <select name="id_client">
            <?php
            foreach ($clients as $client) {
                echo "<option value='" . $client->id_client . "'" . ">" . $client->nom_client . " " . $client->prenom_client . "</option>";
            }
            ?>
        </select><br/><br/>

        <label for="id_livre">Livre emprunté :</label>
        <?php
        // tous les pays
        $bdd = getDataBase();
        $books = getAllBooks($bdd, "");
        ?>
        <select name="id_livre">
            <?php
            foreach ($books as $book) {
                echo "<option value='" . $book->id_livre . "'" . ">" . $book->nom_livre . "</option>";
            }
            ?>
        </select><br/><br/>

        <label for="rendu">Rendu ?</label>
        <select name="rendu">
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
        <br/><br/>

        <input type="submit" class="button_form" value="Ajouter"/>
    </form>
    <?php
    } else {
        echo $doNotHaveAccess;
    }
    ?>
</div>
</body>