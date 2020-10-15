<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php

?>

<h2>Ajouter une réservation</h2>

<br>

<form action="add_reserv.php" method="post">
    <label for="id_livre">Id du livre :</label>
    <input type="text" name="id_livre"  value=""/><br /><br />

    <label for="dateDebut">Jour début :</label>
    <input type="text" name="dateDebut"  value=""/><br /><br />

    <label for="dateFin">Date fin </label>
    <input type="text" name="dateFin"  value=""/><br /><br />

    <label for="id_client">Id client ? :</label>
    <input type="text" name="id_client"  value=""/><br /><br />

    <input type="submit" class="button_form" value="Ajouter"/>

    <input type="text" name="rendu"  hidden value="0"/><br /><br />

</form>






</body>
</html>
