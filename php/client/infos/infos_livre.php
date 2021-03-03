<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php


$bdd = getDataBase();

if (isset($_GET['id_livre'])){
    $id_livre = $_GET['id_livre'];

    $bdd = getDataBase();

    $query = "SELECT * FROM livres AS l, genres AS g, auteurs AS a WHERE l.id_genre=g.id_genre 
                AND a.id_auteur=l.id_auteur AND l.id_livre= :l_id_livre";

    $statement = $bdd->prepare($query);
    $statement->bindParam(':l_id_livre', $id_livre);

    if ($statement->execute()) {
        $book = $statement->fetch(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
}

echo '<h2>' . "Informations de " . $book->nom_livre . " par " . $book->prenom_auteur . " " . $book->nom_auteur . '</h2>';
echo "Date de parution : " . $book->date_parution . '<br>' . " Son genre : " . $book->genre . '<br>' .
    "Résumé : " . $book->resume . '<br>';
echo "<a href='../actions/ajouter_reserv.php?id_livre=" . $book->id_livre .  "&id_client=" . $id_client . "'>Réserver ce livre</a>";
?>

</body>