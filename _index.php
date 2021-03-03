<html>
<head>
    <link rel="stylesheet" href="../css/accueil.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <?php
    include("php/fonctions/head.php");
    echo "</header>";

    if (isset($_SESSION['id_client']) && $_SESSION['id_client'] == 0) {
        ?>
        <div class="option_recherche">
            <a href="php/admin/accueil/admin_accueil_book.php">Liste de livres</a><br>
            <a href="php/admin/accueil/admin_accueil_author.php">Liste d'auteurs</a><br>
            <a href="php/admin/accueil/admin_accueil_genre.php">Liste des genres</a><br>
            <a href="php/admin/accueil/admin_accueil_client.php">Liste des clients</a><br>
            <a href="php/admin/accueil/admin_show_reserv.php">Liste des réservations</a><br>
        </div>
        <?php
    } else {
        ?>
        <div class="option_recherche">
            <a href="php/client/accueil/client_accueil_book.php">Liste de livres</a><br>
            <a href="php/client/accueil/client_accueil_author.php">Liste d'auteurs</a><br>
            <a href="php/client/accueil/client_accueil_genre.php">Liste des genres</a><br>
        </div>
        <?php
    }
    ?>
</body>
</html>
