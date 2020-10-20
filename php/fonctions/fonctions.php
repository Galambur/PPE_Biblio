<?php

function getDataBase()
{
    try {
        // $bdd = new PDO('mysql:host=mysql2.montpellier.epsi.fr;dbname=biblio;charset=utf8',
        //            'gaelle.derambure', '852HTG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $bdd = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function afficherErreur($erreur = null){
    if (!empty($erreur)){
        $_SESSION["erreur"]=$erreur;
    }
    if (isset($_SESSION["erreur"])){
        $valueErreur = $_SESSION["erreur"];
        if ($valueErreur  == 1){
            $erreur = 'Veuillez contacter l\'administrateur';
        } elseif ($valueErreur  == 2) {
            $erreur = 'Mot de passe ou email incorrect';
        } elseif ($valueErreur  == 3) {
            $erreur = 'Email incorrect';
        } elseif ($valueErreur  == 4) {
            $erreur = 'Les mots de passe ne correspondent pas';
        } elseif ($valueErreur  == 5) {
            $erreur = 'Email déjà utilisé';
        } elseif ($valueErreur  == 6) {
            $erreur = 'Champ obligatoire incomplet';
        } elseif ($valueErreur  == 7) {
            $erreur = 'Serveur introuvable!';
        } elseif ($valueErreur  == 13) {
            $erreur = 'Vous devez être connecté <a href="../client/actions/connexion.php"> > Page connexion < </a>';
        } else {
            $erreur = $_SESSION["erreur"];
        }

        unset($_SESSION["erreur"]);
    }
    if (isset($erreur)){
        echo '
          <div class="erreur">
            <p>' . $erreur . '</p>
          </div>
          ';
    }
}

function getListe(PDO $bdd,$fromTable,Array $cond = [],Array $condLike = [],$askSelect = '*',$specialCond= "") { //Cond pour Condition
    //Pour utiliser cette fonction il faut lui envoyer :
    //La bdd
    //Le(s) table au quel on veux accéder
    //Une liste des condtions à récupérer tel que :
    // array(arg1 => value1, arg2 => value 2, etc)
    //Il est possible de demander les conditions avec like aussi
    //Avec un exemple :
    // array( 'idClient' => 15, 'prenom' => 'Maxime')
    $query = "SELECT {$askSelect} FROM {$fromTable} WHERE 1 ";
    //Etape 1 : On génère la requête sql avec les arguments demandés :
    foreach ($cond as $key => $arg) {
        $query = "{$query} AND {$key} = :p_{$key} ";
    }
    foreach ($condLike as $key2 => $arg2) {
        $query = "{$query} AND {$key2} LIKE :p_{$key2} ";
    }
    if (!empty($specialCond)){
        $query = "{$query} AND {$specialCond}";
    }
    //Affectation des paramètres (Pour rappel les paramètres (p_arg) sont une sécuritée)
    $statement = $bdd->prepare($query);
    foreach ($cond as $key => $arg) {
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }
    foreach ($condLike as $key => $arg) {
        $arg = $arg . '%';
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }
    //var_dump($statement);
    //On réalise la requète et on renvoie le résultat
    $liste = null;
    if ($statement->execute()) {
        $liste = $statement->fetchALL(PDO::FETCH_OBJ);
        //On finie par fermer la ressource
    }
    $statement->closeCursor();
    return $liste;
}

// get tous les genres de la bdd
function getAllGenresByName($bdd, $genre_name){
    $query = "SELECT * FROM genres AS g ";

// si on rentre pas quelque chose de vide ou égal à 0
    if (!empty($genre_name)) {
        $query .= " WHERE g.genre LIKE :g_genre";
    }
    $genres = null;
    $statement = $bdd->prepare($query);

    // pour afficher toute la liste
    if (!empty($genre_name)) {
        $genre_name = $genre_name . '%';
        $statement->bindParam(':g_genre', $genre_name);
    }

    if ($statement->execute()) {
        $genres = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $genres;
}

// get toutes les infos des livres de la base de données, peut être cherché par nom
function getAllBooks($bdd, $book_name){
    $query = "SELECT * FROM livres AS l, pays AS p, auteurs AS a, genres AS g WHERE a.id_pays = p.id_pays 
                AND g.id_genre=l.id_genre AND l.id_auteur = a.id_auteur";

    if(!empty($book_name)){
        $query .= " AND l.nom_livre LIKE :l_nom_livre";
    }

    $query .= " ORDER BY l.date_parution DESC"; // pour afficher du plus récent au plus vieux

    $books = null;
    $statement = $bdd->prepare($query);

    if (!empty($book_name)) {
        $book_name = $book_name . '%';
        $statement->bindParam(':l_nom_livre', $book_name);
    }

    if ($statement->execute()) {
        $books = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $books;
}


// get toutes les infos des auteurs et leurs pays, peut être cherché par son nom
function getAllAuthors($bdd, $author_name){
    $query = "SELECT * FROM auteurs AS a, pays AS p WHERE a.id_pays = p.id_pays";

    if(!empty($author_name)){
        $query .= " AND a.nom_auteur LIKE :a_nom_auteur";
    }

    $query .= "  ORDER BY a.nom_auteur ASC";

    $authors = null;
    $statement = $bdd->prepare($query);

    if (!empty($author_name)) {
        $author_name = $author_name . '%';
        $statement->bindParam(':a_nom_auteur', $author_name);
    }

    if ($statement->execute()) {
        $authors = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $authors;
}

//get toutes les infos des pays de la base de donnée
function getAllCountries($bdd){
    $query = "SELECT * FROM pays ORDER BY nom_pays ASC;";

    $statement = $bdd->query($query);
    $pays = $statement->fetchAll(PDO::FETCH_OBJ);
    // Fermeture de la ressource
    $statement->closeCursor();

    return $pays;
}

function getEveryGenre($bdd){
    $query = "SELECT * FROM genres ORDER BY genre ASC;";

    $statement = $bdd->query($query);
    $genres = $statement->fetchAll(PDO::FETCH_OBJ);
    // Fermeture de la ressource
    $statement->closeCursor();

    return $genres;
}

function getAllGenres($bdd, $genre_name){
    $query = "SELECT * FROM genres AS g ";

    if(!empty($genre_name)){
        $query .= " WHERE g.genre LIKE :genre_name";
    }

    $query .= " ORDER BY g.genre ASC";

    $genres = null;
    $statement = $bdd->prepare($query);

    if (!empty($genre_name)) {
        $genre_name = $genre_name . '%';
        $statement->bindParam(':genre_name', $genre_name);
    }

    if ($statement->execute()) {
        $genres = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $genres;
}

function getAllAuthorsName($bdd){
    $query = "SELECT * FROM auteurs ORDER BY nom_auteur ASC;";

    $statement = $bdd->query($query);
    $authors = $statement->fetchAll(PDO::FETCH_OBJ);
    // Fermeture de la ressource
    $statement->closeCursor();

    return $authors;
}


// get tous les livres d'un auteur en particulier
function getAllBooksByAuthor($bdd, $id_auteur){
    $query = "SELECT * FROM livres AS l, auteurs AS a, genres AS g 
                WHERE l.id_genre=g.id_genre AND l.id_auteur = a.id_auteur AND l.id_auteur LIKE :l_id_auteur 
                ORDER BY l.date_parution DESC";

    $books = null;
    $statement = $bdd->prepare($query);
    $statement->bindParam(':l_id_auteur', $id_auteur);

    if ($statement->execute()) {
        $books = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $books;
}

function getAllBooksByGenre($bdd, $id_genre){
    $query = "SELECT * FROM livres AS l, auteurs AS a, genres AS g 
                WHERE l.id_genre=g.id_genre AND l.id_auteur = a.id_auteur AND l.id_genre LIKE :l_id_genre 
                ORDER BY l.date_parution DESC";

    $books = null;
    $statement = $bdd->prepare($query);
    $statement->bindParam(':l_id_genre', $id_genre);

    if ($statement->execute()) {
        $books = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $books;
}


/*
function getAuthorById($bdd, $id_auteur){
    $query = "SELECT * FROM auteurs AS a, pays AS p WHERE a.id_pays=p.id_pays AND a.id_auteur LIKE :a_id_auteur";

    $author = null;
    $statement = $bdd->prepare($query);
    $statement->bindParam(':a_id_auteur', $id_auteur);

    if ($statement->execute()) {
        $author = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $author;
} */

function getAllClients($bdd, $client_name){
    $query = "SELECT * FROM clients AS c, pays AS p WHERE c.id_pays=p.id_pays";

    if(!empty($client_name)){
        $query .= " AND c.nom_client LIKE :c_nom_client";
    }

    $query .= " ORDER BY c.nom_client ASC"; // pour afficher les noms dans l'ordre alphabétique

    $clients = null;
    $statement = $bdd->prepare($query);

    if (!empty($client_name)) {
        $client_name = $client_name . '%';
        $statement->bindParam(':c_nom_client', $client_name);
    }

    if ($statement->execute()) {
        $clients = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $clients;
}

function getAllReservationsByClient($bdd, $id_client){
    $query = "SELECT * FROM planning AS pl, livres AS l, auteurs AS a WHERE a.id_auteur=l.id_auteur AND pl.id_livre=l.id_livre AND id_client=:pl_id_client";

    $reservations = null;
    $statement = $bdd->prepare($query);
    $statement->bindParam(':pl_id_client', $id_client);

    if ($statement->execute()) {
        $reservations = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $reservations;
}

function getAllReservations($bdd, $dateDebut){
    $query = "SELECT * FROM planning AS pl, livres AS l, clients AS c WHERE pl.id_livre=l.id_livre AND c.id_client=pl.id_client";

    if(!empty($dateDebut)){
        $query .= " AND pl.dateDebut LIKE :pl_dateDebut";
    }

    $query .= " ORDER BY pl.dateDebut DESC"; // pour afficher les noms dans l'ordre alphabétique

    $reservs = null;
    $statement = $bdd->prepare($query);

    if (!empty($dateDebut)) {
        $dateDebut = $dateDebut . '%';
        $statement->bindParam(':pl_dateDebut', $dateDebut);
    }

    if ($statement->execute()) {
        $reservs = $statement->fetchAll(PDO::FETCH_OBJ);
        // Fermeture de la ressource
        $statement->closeCursor();
    }
    return $reservs;
}


?>