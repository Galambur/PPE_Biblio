<html>
<head>
    <link rel="stylesheet" href="../css/accueil.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
  <body>
    <header>
      <?php
        include("php/fonctions/head.php");
      ?>
    </header>

    <div class="option_recherche">
       <a href="php/client/accueil/client_accueil_book.php">Regarder la liste de livres</a><br>
       <a href="php/client/accueil/client_accueil_author.php">Regarder la liste d'auteurs</a><br>
       <a href="php/client/accueil/client_accueil_genre.php">Regarder la liste des genres</a><br>
    </div>

    <?php
    if(isset($_SESSION['id_client']) && $_SESSION['id_client']== 0){
        echo '<a href="php/admin/accueil/admin_index.php" class="mode_admin">Mode administrateur</a>';
    }
    ?>


  </body>
</html>
