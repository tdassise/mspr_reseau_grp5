<?php
$navigateur = $_SERVER['HTTP_USER_AGENT']; // avoir toutes les infos avec get_browser (méthode php)
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@200&display=swap" rel="stylesheet">
</head>
<header class="police">
</header>
<body>
<div class="div-center police">
    <div class="accueil-titre texte">Accueil</div>
    <div class="texte">
        <div class="cadre-accueil">
            Navigateur web : <?php echo $navigateur ?>
        </div>
    </div>
</div>
<img class="taille-ecran" src="../images/nts_vue_du_ciel.jpeg" alt="Nantes vue du ciel">
</body>
<footer>
</footer>
</html>
