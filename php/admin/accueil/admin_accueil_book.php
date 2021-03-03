<?php

require_once("../../../php/fonctions/head.php");

if (isAdmin($id_client) == true) {

    $book_name = ''; //on initialise la variable
    if (isset($_POST['book_name'])) {
        $book_name = htmlspecialchars($_POST['book_name']);
    }
    ?>

    <a href="/php/admin/gestion_livres/ajouter_livre.php" class="button_add">Ajouter un livre</a>

    <div class="top_research">
        <form class="research" action="" method="post">
            <input type="text" name="book_name" value="<?php $book_name ?>" maxlength="30">
            <input type="submit" name="" value="Valider">
        </form>
    </div>

    <?php

    $bdd = getDataBase();
    $books = null;

    if (!empty($bdd)) {
        $books = getAllBooks($bdd, $book_name);
        if (!empty($books)) {
            foreach ($books as $book) {
                ?>
                <div class="eachBook">
                    <p>(id:<?= $book->id_livre ?>)
                        <a href="../gestion_livres/infos_livre.php?id_livre=<?= $book->id_livre ?>"><?= $book->nom_livre ?></a>
                        par
                        <a href="../gestion_auteur/infos_auteur.php?id_auteur=<?= $book->id_auteur ?>"><?= $book->nom_auteur ?> <?= $book->prenom_auteur ?></a>
                        Résumé : <?= $book->resume ?>
                        <br>
                        <a href="../gestion_livres/modifier_livre.php?id_livre=<?= $book->id_livre ?>">Modifier</a> ou
                        <a href="../gestion_livres/supprimer_livre.php?id_livre=<?= $book->id_livre ?>">Supprimer</a> ce
                        livre
                    </p>
                </div>
                <?php
            } // fin foreach
        } // fin if (!empty($books))
        else {
            echo "Aucun livre ne porte ce nom";
        }
    } // fin if(!empty($bdd))
} else {
    echo $doNotHaveAccess;
}
?>
</body>
</html>
