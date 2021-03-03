<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>
</header>
<body>

<?php
$genre_name = ''; //on initialise la variable
if (isset($_POST['genre_name'])) {
    $genre_name = htmlspecialchars($_POST['genre_name']);
}

if (isAdmin($id_client)) {
    echo '<a href="../../admin/gestion_genres/ajouter_genre.php" class="button_add">Ajouter un genre</a>';
}
?>

<div class="top_research">
    <form class="research" action="" method="post">
        <input type="text" name="genre_name" value="<?php $genre_name ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>

<?php
$bdd = getDataBase();
$genres = null;

if (!empty($bdd)) {
    $genres = getAllGenres($bdd, $genre_name);
    if (!empty($genres)) {
        foreach ($genres as $genre) {
            echo '<p>(id:' . $genre->id_genre . ') <a href="../infos/infos_genre.php?id_genre=' . $genre->id_genre . '">' . $genre->genre . ' </a><br>';
            if (isAdmin($id_client)) {
                echo '<a href="../../admin/gestion_genres/supprimer_genre.php?id_genre=' . $genre->id_genre . '">Supprimer</a></p>';
            }
        }
    }
}
?>
</body>
</html>
