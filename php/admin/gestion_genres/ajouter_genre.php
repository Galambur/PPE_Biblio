<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php
if (isAdmin($id_client) == true){
?>

<h2>Ajouter un client</h2>

<form action="add_genre.php" method="post">
    <label for="genre">Nom du genre :</label>
    <input type="text" name="genre"  value=""/><br /><br />

    <input type="submit" class="button_form" value="Ajouter"/>
</form>

<?php
} else {
    echo $doNotHaveAccess;
}
?>

</body>