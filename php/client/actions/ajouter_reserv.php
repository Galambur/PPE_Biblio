<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>

<h2>Ajouter une réservation</h2><br>

<form action="add_reserv.php" method="post">

    <label for="dateDebut">Jour début :</label>
    <input type="text" name="dateDebut"  value=""/><br /><br />

    <label for="dateFin">Date fin </label>
    <input type="text" name="dateFin"  value=""/><br /><br />
    <input type="text" name="rendu"  hidden value="0"/>
    <input type="text" name="id_client"  hidden value="<?= $_GET['id_client'] ?>"/>
    <input type="text" name="id_livre"  hidden value="<?= $_GET['id_livre'] ?>"/>

    <input type="submit" class="button_form" value="Ajouter"/>


</form>

</body>
</html>
