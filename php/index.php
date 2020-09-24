<html>
<head>
    <link rel="stylesheet" href="../css/accueil.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
  <body>
    <header>
      <?php
        include("../html/header.html");
      ?>
    </header>


    <!--

    <div class="recherche">
      <select id="select" name="type">
        <optgroup label="Par quoi filtrer ?">
          <option value="">Genre</option>
          <option value="">Année</option>
          <option value="">Auteur</option>
        </optgroup>
      </select> -->

    <!--
      <form class="input" action="#" method="post">
        <input type="text" name="" value="">
      </form>
    </div>  fin class recherche -->



    <div class="option_recherche">
       <a href="client/accueil/client_accueil_book.php">Regarder la liste de livres</a><br>
       <a href="client/accueil/client_accueil_author.php">Regarder la liste d'auteurs</a><br>
       <a href="client/accueil/client_accueil_genre.php">Regarder la liste des genres</a><br>
    </div>



  </body>
</html>
