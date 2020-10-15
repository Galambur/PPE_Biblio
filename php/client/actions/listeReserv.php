<?php
    require_once('../../../php/fonctions/head.php');
    ?>

<?php
$date = '';
if (isset($_POST['date'])) {
    $date = htmlspecialchars($_POST['date']); //convertit les caractères spéciaux en entités HTML
}
?>

<!-- pour recherher les chambres -->
<div class="formulaire">
    <form method="post">
        <br>
        <label for="date">Le contrat débute en :</label>
        <input type="text" name="date" value="<?= $date ?>"/>
        <input type="submit" class="button_form" value="Valider"/>
    </form>
    <br>
</div> <!-- fin formulaire -->

<a href="ajouterReserv.php" class="button_form">Ajouter un reservation</a>
<br><br><br>



<?php

require ('fonctions.php');

// Etape 1 : Connexion au serveur
$bdd = getDataBase();
$reservs = null;
if (!empty($bdd)) {
    // Etape 2 : Obtention des informations
    $reservs = getAllReserv($bdd, $date);
    if (!empty($reservs)) {
        //var_dump($reservs);
        // Etape 3 : Affichage
        foreach ($reservs as $reserv) {
            // Afficher

            ?>
            <div class="liste_reserv">
                <?php echo '<h3>Date de debut de la reservation : ' . $reserv->jour . '</h3>';
                echo '<p>Informations de la réservation : </p>';

                echo '<p>' . $reserv->civilite . ' ' . $reserv->nom . ' ' . $reserv->prenom .
                    ' a reservé la chambre numéro ' . $reserv->numero . '<br> </p>';
                if ($reserv->paye == 0) {
                    echo '<p>La reservation a été payée</p>';
                } else {
                    echo "<p>La réservation n'a pas été payée</p>";
                }
                ?>
            </div> <!-- fin liste_reserv -->

            <?php
        }
    } else {
        echo '<p>Le planning est vide</p>';
    }
} else {
    echo  "Erreur d'accès au serveur";
}

?>

</body>
<footer>
    <?php
    include('../../html/footer.html');
    ?>
</footer>
</html>
