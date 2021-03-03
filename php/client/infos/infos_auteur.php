<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>
</header>
<body>
<?php

$bdd = getDataBase();

if (isset($_GET['id_auteur'])){
    $id_auteur = $_GET['id_auteur'];

    $bdd = getDataBase();

    $query = "SELECT * FROM auteurs AS a, pays AS p WHERE a.id_pays=p.id_pays AND a.id_auteur= :a_id_auteur";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':a_id_auteur', $id_auteur);

    if ($statement->execute()) {
        $author = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}

echo '<h2>' . $author->nom_auteur . " " . $author->prenom_auteur . ' (' . $author->dateNaiss_auteur . ')</h2>';
echo "<p>Pays : " . $author->nom_pays . '</p>';

$books = getAllBooksByAuthor($bdd, $author->id_auteur);

if (!empty($books)){
    echo '<h3>' . "Les livres de cet auteur : " . '</h3>';
    foreach ($books as $book){
        echo '<p><a href="infos_livre.php?id_livre=' . $book->id_livre . '">' . $book->nom_livre . '</a>' . " paru le " . $book->date_parution . " genre : " . $book->genre . '<br>Résumé : '.
        $book->resume . '</p>';
    }
}

if(isAdmin($id_client) == true){
    echo '<a href="../../admin/gestion_livres/ajouter_livre.php?id_auteur=' . $author->id_auteur . '">Ajouter un livre</a>';
}

?>
</body>
</html>