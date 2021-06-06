<html>
<head>
    <link rel="stylesheet" href="../css/accueil.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
<div class="index_body">
    <header>
        <?php
        include("php/fonctions/head.php");
        ?>
    </header>
    <div class="liste_index">
        <div class="option_recherche">
            <a href="php/client/accueil/client_accueil_book.php" id="index_title">Liste de livres</a><br>
            <a href="php/client/accueil/client_accueil_author.php" id="index_title">Liste d'auteurs</a><br>
            <a href="php/client/accueil/client_accueil_genre.php" id="index_title">Liste des genres</a><br>
            <?php
            if (isset($_SESSION['id_client']) && $_SESSION['id_client'] == 0) {
                echo '<a href="php/admin/accueil/admin_accueil_client.php" id="index_title">Liste des clients</a><br>';
                echo '<a href="php/admin/accueil/admin_show_reserv.php" id="index_title">Liste des réservations</a><br>';
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
