<header>
    <?php
    include_once("../../..//html/header.html");
    ?>

</header>
<body>
<?php
require_once("../../fonctions/fonctions.php");
?>

<h2>Ajouter une réservation</h2>

<form action="add_reservation.php" method="post">
    <label for="dateDebut">Date début :</label>
    <input type="text" name="dateDebut"  value=""/><br /><br />

    <label for="dateFin">Date fin :</label>
    <input type="text" name="dateFin"  value=""/><br /><br />

    <label for="rendu">Rendu :</label>
    <select name="rendu" id="">
        <option value="1">Oui</option>;
        <option value="0">Non</option>;
    </select><br><br>

    <label for="id_client">Id client :</label>
    <input type="text" name="id_client"  value=""/><br/><br />

    <label for="id_livre">Son id_livre :</label>
    <input type="text" name="id_livre"  value=""/><br/><br />

    <input type="submit" class="button_form" value="Ajouter"/>
</form>


</body>