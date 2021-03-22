<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>
</header>
<body>
<div class="centered_alone">
    <?php
    $bdd = getDataBase();

    if (isset($_GET['id_genre'])) {
        $id_genre = $_GET['id_genre'];
        $books = getAllBooksByGenre($bdd, $id_genre);
        $genre_name = getGenreName($bdd, $id_genre);

        echo "<h2>Livres de genre " . $genre_name->genre . " </h2>";

        foreach ($books AS $book) {
            ?>
            <div class="object_of_list">
                <p>
                    <a class="object_title"
                      href="infos_livre.php?id_livre=<?= $book->id_livre ?>"><?= $book->nom_livre ?></a>
                    par <a class="object_title"
                           href="infos_auteur.php?id_auteur=<?= $book->id_auteur ?>"><?= $book->prenom_auteur ?> <?= $book->nom_auteur ?></a>
                </p>
                <br>
            </div>
            <?php
        }
    } else {
        echo "A problem has occured, we could not find the genre";
    }
    ?>
</div>
</body>