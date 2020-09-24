<link rel="stylesheet" href="../../../css/admin/accueil/admin_accueil_author.css">
<header>
    <?php
    include_once("../../..//html/header.html");
    ?>

</header>
<body>
<?php
require_once("../../fonctions/fonctions.php");
include_once("../../..//html/header.html");

$genre_name = ''; //on initialise la variable
if (isset($_POST['genre_name'])) {
    $genre_name = htmlspecialchars($_POST['genre_name']);
}
?>


<a href="../gestion_genres/ajouter_genre.php" class="button_add">Ajouter un genre</a>

<div class="top_research">

    <form class="research" action="" method="post">
        <input type="text" name="genre_name"  value="<?php $genre_name ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>

<?php

$bdd = getDataBase();
$genres = null;

if(!empty($bdd)){
    $genres = getAllGenres($bdd, $genre_name);
    if (!empty($genres)){
        foreach ($genres as $genre){
            echo 'Le genre numéro ' . $genre->id_genre . ' est du style ' . '<a href="../gestion_genres/infos_genre.php?id_genre=' . $genre->id_genre . '">' . $genre->genre . '</a><br>';
            echo '<a href="../gestion_genres/supprimer_genre.php?id_genre=' . $genre->id_genre . '">Supprimer</a><br><br>' ;

        }
    }
}


?>


</body>
</html>
