<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php


$bdd = getDataBase();



if (isset($_GET['id_genre'])){
    $id_genre = $_GET['id_genre'];
    $books = getAllBooksByGenre($bdd, $id_genre);

    foreach ($books AS $book){
        echo " Genre : " . $book->genre . ". L'auteur de " . '<a href="infos_livre.php?id_livre='. $book->id_livre .'">'. $book->nom_livre . '</a>' . " est " . '<a href="infos_auteur.php?id_auteur='. $book->id_auteur . '">'  . $book->prenom_auteur . " " . $book->nom_auteur . '</a>' . '<br>';
    }



} else {
    echo "A problem has occured, we could not find the genre";
}


?>
</body>