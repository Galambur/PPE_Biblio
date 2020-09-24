<header>
    <?php
    include_once("../../..//html/header.html");
    ?>

</header>
<body>
<?php
require_once("../../fonctions/fonctions.php");

$bdd = getDataBase();



if (isset($_GET['id_genre'])){
    $id_genre = $_GET['id_genre'];
    $genres = getAllBooksByGenre($bdd, $id_genre);

    foreach ($genres AS $genre){
        echo " Genre : " . $genre->genre . ". L'auteur de " . '<a href="../gestion_livres/infos_livre.php?id_livre='. $genre->id_livre .'">'. $genre->nom_livre . '</a>' . " est " . '<a href="../gestion_auteur/infos_auteur.php?id_auteur='. $genre->id_auteur . '">'  . $genre->prenom_auteur . " " . $genre->nom_auteur . '</a>' . '<br>';
    }



} else {
    echo "A problem has occured, we could not find the genre";
}


?>
</body>