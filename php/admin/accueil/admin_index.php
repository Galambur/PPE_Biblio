<html>
<?php
require_once("../../../php/fonctions/head.php");
if (isAdmin($id_client) == true){
?>
<head>
    <link rel="stylesheet" href="../../../css/accueil.css">
</head>
<body>
<header>
    <?php
    require_once("../../../php/fonctions/head.php");
    ?>
</header>



<?php
} else {
    echo $doNotHaveAccess;
}
?>


</body>
</html>
