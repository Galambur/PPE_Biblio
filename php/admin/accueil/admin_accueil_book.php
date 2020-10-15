<?php

require_once ("../../../php/fonctions/head.php");


$book_name = ''; //on initialise la variable
if (isset($_POST['book_name'])) {
    $book_name = htmlspecialchars($_POST['book_name']);
}
?>

<a href="/php/admin/gestion_livres/ajouter_livre.php" class="button_add">Ajouter un livre</a>



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
            echo 'Livre numero ' . $book->id_livre . ' <a href="../gestion_livres/infos_livre.php?id_livre=' . $book->id_livre . '">' . $book->nom_livre . '</a>' . " écrit par " .
                '<a href="../gestion_auteur/infos_auteur.php?id_auteur=' . $book->id_auteur . '">'  . $book->nom_auteur . " " . $book->prenom_auteur . '</a>' . " paru le " .
                $book->date_parution . " son genre est : " . $book->genre . '<br>' .
                "Résumé : " . $book->resume . '<br>';

            echo '<a href="../gestion_livres/modifier_livre.php?id_livre=' . $book->id_livre .'">Modifier</a>' . ' ou ' .
                '<a href="../gestion_livres/supprimer_livre.php?id_livre=' . $book->id_livre .'">Supprimer</a>' .' ce livre' . '<br><br>';
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
