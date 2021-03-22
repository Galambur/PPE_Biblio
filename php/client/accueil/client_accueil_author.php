<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>
</header>
<div>

    <?php
    $author_name = ''; //on initialise la variable
    if (isset($_POST['author_name'])) {
        $author_name = htmlspecialchars($_POST['author_name']);
    }

    if (isAdmin($id_client)) {
        echo '<a href="../../admin/gestion_auteur/ajouter_auteur.php" class="button_add">Ajouter un auteur</a>';
    }
    ?>

    <div class="top_research">
        <form class="research" action="" method="post">
            <input type="text" name="author_name" value="<?php $author_name ?>" maxlength="30">
            <input type="submit" name="" value="Valider">
        </form>
    </div>

    <?php
$bdd = getDataBase();
$authors = null;

echo '<div class="centered_alone">';
if (!empty($bdd)) {
    $authors = getAllAuthors($bdd, $author_name);
    if (!empty($authors)) {
        foreach ($authors as $author) {
            ?>
    <div class="object_of_list">
        <div class="eachAuthor">
            <p>(id:<?= $author->id_auteur ?>) <a
                        class="object_title"
                        href="../infos/infos_auteur.php?id_auteur=<?= $author->id_auteur ?>"><?= $author->prenom_auteur ?> <?= $author->nom_auteur ?></a>
                (<?= $author->dateNaiss_auteur ?>)<br>
                <?php
                $books = getAllBooksByAuthor($bdd, $author->id_auteur);
                if (!empty($books)) {
                    echo "Ses livres :<br>";
                    echo"<ul style=\"list-style: square\">";
                    foreach ($books as $book) {
                        echo ' <li><a class="object_title" href="../infos/infos_livre.php?id_livre=' . $book->id_livre . '">' . $book->nom_livre . '</a>' . "<br></li>";
                    }
                    echo "</ul>";
                } else {
                    echo 'Nous ne possédons aucun livre écrit par cet auteur' . '<br>';
                }
                if (isAdmin($id_client)){
                ?>
                <a class="object_action"
                   href="../../admin/gestion_auteur/modifier_auteur.php?id_auteur=<?= $author->id_auteur ?>">Modifier</a>
                ou
                <a class="object_action"
                   href="../../admin/gestion_auteur/supprimer_auteur.php?id_auteur=<?= $author->id_auteur ?>">Supprimer</a>
                cet auteur</p>
            <?php
            }
            ?>
        </div>
    </div>
    <?php ;
    } // fin foreach
    } // fin if (!empty($authors))
    else {
        echo "Aucun auteur ne porte ce nom";
    }
    } // fin if(!empty($bdd))
    ?>
</div>
</body>
</html>
