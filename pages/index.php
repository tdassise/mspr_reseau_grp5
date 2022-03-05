<?php

require('../database/config_db.php');
require('../database/db.php');
require '../database/Requetes.php';

$navigateur = $_SERVER['HTTP_USER_AGENT'];
$adresse_ip = $_SERVER['REMOTE_ADDR'];

$req = new Requetes();
$req->insert($navigateur, $adresse_ip);

//register form
if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if($debug == 1){
        var_dump($email);
        var_dump($password);
    }

    $q = $db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
    $q->bindValue('email', $email);
    $q->bindValue('password', $password);
    $res = $q->execute();

    if($res){
        echo 'register succed';
    }
}

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

    <div id="main-container">
        <div id="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" class="input-group" method="POST" action="login.php">
                <input class="input-field" type="email" placeholder="Email" name="email"></br>
                <input class="input-field" type="password" placeholder="Password" name="password"></br>
                <input class="input-field" type="text" placeholder="verification code" name="tfa_code"></br>
                <button class="submit-btn" type="submit">Login</button>
            </form>
            <form id="register" class="input-group" method="POST">
                <input class="input-field" type="email" placeholder="Email" name="email"></br>
                <input class="input-field" type="password" placeholder="Password" name="password"></br>
                <button class="submit-btn" type="submit">Register</button></br>
            </form>
        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        //form animation
        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
    </script>
    
</body>
<footer>
</footer>
</html>

<?php
$mysqli->close();
?>
