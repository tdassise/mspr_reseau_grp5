<?php
session_start();

require('../modele/config_db.php');
require('../modele/Requetes.php');

$req = new Requetes();

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
            <!-- TODO il faudra modifier le fonctionnement du formulaire pour pouvoir accueillir la connexion au LDAP et la 2FA-->
            <form name="form" action="login.php" method="POST">
                <label class="label-identifiant">Identifiant :
                    <input type="text" name="username" class="input-identifiant">
                </label>
                <label class="label-password">Mot de passe :
                    <input type="password" class="input-password">
                </label>
                <button class="button" type="submit">Connexion</button>
            </form>
        </div>
    </div>
</div>
</body>
<footer>
</footer>
</html>

<?php

$navigateur = $_SERVER['HTTP_USER_AGENT']; // récupère le navigateur (user agent) de l'utilisateur
$adresse_ip = $_SERVER['REMOTE_ADDR']; // récupère l'adresse IP de l'utilisateur

// Quand l'utilisateur envoie le formulaire
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    // on insère dans la BDD l'username, son navigateur et son IP
    $req->insert($username, $navigateur, $adresse_ip);
}

// On récupère toute la table 'verification'
$bdd = $req->selectAll();

// TODO ajouter un test sur l'authentification LDAP, si l'utilisateur n'est pas dans le LDAP => ne pas ajouter de ligne dans la BDD
// on boucle sur les lignes de la BDD pour chercher à faire correspondre le username entré, l'adresse IP et le navigateur avec une ligne de la BDD
while ($row = mysqli_fetch_array($bdd,MYSQLI_ASSOC)) {
    // si l'username correspond bien au navigateur et à l'IP associés lors de l'insertion en BDD
    if ($row['username'] == $_POST['username'] && $row['navigateur'] == $_SERVER['HTTP_USER_AGENT'] && $row['adresse_ip'] == $_SERVER['REMOTE_ADDR']) {
        echo "La connexion est autorisée <br>"; // à retirer pour la mise en prod
        break; // si c'est bon, passer à la double authentification
    } elseif ($row['username'] != $_POST['username']) {
        echo $_POST['username'] . ' : recherche de l\'utilisateur <br>'; // à retirer pour la mise en prod
    }elseif ($row['navigateur'] != $_SERVER['HTTP_USER_AGENT']) {
        echo 'Mauvais navigateur <br>'; // à retirer pour la mise en prod
    }elseif ($row['adresse_ip'] != $_SERVER['REMOTE_ADDR']) {
        echo 'Mauvaise adresse IP <br>'; // à retirer pour la mise en prod
    }
}

$mysqli->close();
?>
