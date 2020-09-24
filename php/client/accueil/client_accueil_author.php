<link rel="stylesheet" href="../../../css/admin/accueil/admin_accueil_author.css">
<header>
    <?php
    include_once("../../..//html/header.html");
    ?>

</header>
<body>
<?php
require_once("../../fonctions/fonctions.php");

$author_name = ''; //on initialise la variable
if (isset($_POST['author_name'])) {
    $author_name = htmlspecialchars($_POST['author_name']);
}
?>

<div class="top_research">

    <!--
    <select class="type" name="">
        <optgroup label="Par quoi voulez-vous chercher ?">
            <option>Genre</option>
            <option>Année</option>
            <option>Auteur</option>
        </optgroup>
    </select>
    -->

    <form class="research" action="" method="post">
        <input type="text" name="author_name"  value="<?php $author_name ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>

<?php

$bdd = getDataBase();
$authors = null;

if(!empty($bdd)){
    $authors = getAllAuthors($bdd, $author_name);
    if (!empty($authors)){
        foreach ($authors as $author){
            echo '<div class="eachAuthor">';
            echo "L'auteur numéro " . $author->id_auteur . " s'appelle " . '<a href ="../infos/infos_auteur.php?id_auteur=' .$author->id_auteur .'">' . $author->prenom_auteur . ' ' . $author->nom_auteur . '</a>' .
                ". Il est né le " . $author->dateNaiss_auteur . '<br>' . "\tIl a ecrit : " . '<br>';
            $books = getAllBooksByAuthor($bdd, $author->id_auteur);
            if (!empty($books)){
                foreach ($books as $book){
                    echo ' <a href="../infos/infos_livre.php?id_livre=' . $book->id_livre . '">' . $book->nom_livre . '</a>' . "<br>";
                }
            } else {
                echo 'Nous ne possédons aucun livre écrit par cet auteur' . '<br>';
            }
            echo '</div>'; // fin de la div eachAuthor
        } // fin foreach
    } // fin if (!empty($authors))
    else {
        echo "Aucun auteur ne porte ce nom";
    }
} // fin if(!empty($bdd))
?>
</body>
</html>
