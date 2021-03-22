<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>

</header>
<body>

<div class="centered_alone">
    <h2>Se connecter</h2>

    <br>
    <form action="login.php" method="post">
        <label for="email">email :</label>
        <input type="text" name="email" value=""/><br/><br/>

        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" value=""/><br/><br/>

        <input type="submit" class="button_form" value="Valider"/>
    </form>
</div>
</body>
</html>
