<link rel="stylesheet" href="../../../css/admin/accueil/admin_accueil_author.css">
<header>
    <?php
    include_once("../../..//html/header.html");
    ?>

</header>
<body>
<?php
require_once("../../fonctions/fonctions.php");

$book_name = ''; //on initialise la variable
if (isset($_POST['book_name'])) {
    $book_name = htmlspecialchars($_POST['book_name']);
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
        <input type="text" name="book_name"  value="<?php $book_name ?>" maxlength="30">
        <input type="submit" name="" value="Valider">
    </form>
</div>

<?php

$bdd = getDataBase();
$books = null;

if(!empty($bdd)){
    $books = getAllBooks($bdd, $book_name);
    if (!empty($books)){
        foreach ($books as $book){
            echo '<div class="eachBook">';
            echo 'Livre numero ' . $book->id_livre . ' <a href="../infos/infos_livre.php?id_livre=' . $book->id_livre . '">' . $book->nom_livre . '</a>' . " écrit par " .
                '<a href="../infos/infos_auteur.php?id_auteur=' . $book->id_auteur . '">'  . $book->nom_auteur . " " . $book->prenom_auteur . '</a>' . " paru le " .
                $book->date_parution . " son genre est : " . $book->genre . '<br>' .
                "Résumé : " . $book->resume . '<br><br>';

            echo '</div>'; // fin de la div eachAuthor
        } // fin foreach
    } // fin if (!empty($books))
    else {
        echo "Aucun livre ne porte ce nom";
    }
} // fin if(!empty($bdd))
?>
</body>
</html>
