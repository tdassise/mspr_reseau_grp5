<?php
session_start();
//TODO: coonect to the AD
//if DB
//require('connect.php');
//
//if (isset($_POST['username']) and isset($_POST['password'])) {
//    $username = $_POST['username'];
//    $password = $_POST['password'];
//
//    if($count == 1){
//        $_SESSION['username'] = $username;
//        header('Location: patient.php');
//    }else{echo 'Invalid Login Credentials.';}
//}
//if (isset($_SESSION['username'])) { echo 'succes!';}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>mspr_reseau_grp5</title>
        <script>
            var loginButton = document.getElementById("login");

            function connect(){
                //TODO: authentification
                window.location.replace("file:///C:/Users/Julien/Desktop/mspr_reseau_grp5/patient.php");
            }
            loginButton.addEventListener(connect());
        </script>
    </head>
    <body>
        <h1>Login</h1>
        <div style="display: grid; width: 500px; border: solid 1px #000; padding: 10px;">
            <label for="">pseudo</label>
            <input id="username" type="text">
            <label>password</label>
            <input id="password" type="password">
            <button id="login" onclick="" style="margin-top: 10px;">Login</button>
        </div>
    </body>
    <footer>

    </footer>
</html>
