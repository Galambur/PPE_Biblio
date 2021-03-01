<header>
    <?php
    require_once ("../../../php/fonctions/head.php");
    ?>

</header>
<body>
<?php
if (isAdmin($id_client) == true){

?>

<h2>Ajouter un livre</h2>

<form action="add_livre.php" method="post">
    <label for="nom_livre">Nom :</label>
    <input type="text" name="nom_livre"  value=""/><br /><br />

    <label for="date_parution">Date de parution :</label>
    <input type="text" name="date_parution"  value=""/><br /><br />

    <label for="resume">Résumé :</label>
    <input type="text" name="resume"  value=""/><br/><br />

    <label for="id_genre">Son genre :</label>
    <?php
    $bdd=getDataBase();
    $genres=getEveryGenre($bdd);
    ?>
    <select name="id_genre" id="">
        <?php
        foreach ($genres as $genre) {
            echo "<option value='" . $genre->id_genre . "'" . ">" . $genre->genre . "</option>";
        }
        ?>
    </select><br/><br />



    <label for="id_auteur">Son auteur :</label>
    <?php
    $authors=getAllAuthorsName($bdd);



    $this_author = null;

    if (isset($_GET['id_auteur'])){
        $id_auteur = $_GET['id_auteur'];

        $bdd = getDataBase();

        $query = "SELECT * FROM auteurs AS a WHERE a.id_auteur= :a_id_auteur";

        $statement = $bdd->prepare($query);
        $statement->bindParam(':a_id_auteur', $id_auteur);

        if ($statement->execute()) {
            $this_author = $statement->fetch(PDO::FETCH_OBJ);
            // Fermeture de la ressource
            $statement->closeCursor();
        }
    }

    if (!empty($_GET['id_auteur'])){
        echo '<input type="text" name="nom_auteur" disabled value="'  . $this_author->nom_auteur . " " . $this_author->prenom_auteur . '"/><br/><br />';
        echo '<input type="text" name="id_auteur"  hidden value="'  . $this_author->id_auteur . '"/><br/><br />';
    } else {
        ?>
        <select name="id_auteur" id="">
            <?php
            foreach ($authors as $author) {
                echo "<option value='" . $author->id_auteur . "'" . ">" . $author->nom_auteur . " " . $author->prenom_auteur . "</option>";
            }
            ?>
        </select><br/><br/>
        <?php
    }
    ?>


    <input type="submit" class="button_form" value="Ajouter"/>
</form>

<?php
} else {
    echo $doNotHaveAccess;
}
?>


</body>