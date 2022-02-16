<?php
session_start();

require('../database/config_db.php');
require '../database/Requetes.php';

$navigateur = $_SERVER['HTTP_USER_AGENT'];
$adresse_ip = $_SERVER['REMOTE_ADDR'];

$req = new Requetes();
$req->insert($navigateur, $adresse_ip);

?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@200&display=swap" rel="stylesheet">
</head>
<header class="police">
</header>
<body>
<div class="div-center police">
    <div class="login-titre texte">Clinique le Châtelet</div>
    <div class="pad-left texte">
        <div class="cadre-login">
            <label class="label-identifiant">Identifiant :
                <input type="text" class="input-identifiant">
            </label>
            <label class="label-password">Mot de passe :
                <input type="password" class="input-password">
            </label>
            <!-- TODO ajouter la double authentification et la vérif sur IP -->
            <button class="button" onclick="location.href='accueil.php'">Connexion</button>
        </div>
    </div>
</div>
<img class="taille-ecran" src="../images/nts_vue_du_ciel.jpeg" alt="Nantes vue du ciel">
</body>
<footer>
</footer>
</html>

<?php
$mysqli->close();
?>
