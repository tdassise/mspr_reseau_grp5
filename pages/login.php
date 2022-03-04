<?php
require('../database/db.php');

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    var_dump($email);
    var_dump($password);

    $q = $db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue('email', $email);
    $q->execute();
    $res = $q->fetch(PDO::FETCH_ASSOC);

    var_dump($res);

    if($res){
        $passwordHash = $res['password'];
        if(password_verify($password, $res['password'])){
            echo 'connexion succed';
        }else{
            echo 'invalid password';
        }
    }else{
        echo 'invalid ID';
    }
}

?>