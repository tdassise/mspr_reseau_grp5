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
    $user = $q->fetch(PDO::FETCH_ASSOC);

    var_dump($user);

    if($user){
        $passwordHash = $user['password'];
        if(password_verify($password, $passwordHash)){
            $_SESSION['user_id'] = $user['id'];
            header('location:/mspr_reseau_grp5/pages/profile.php');
            exit();
        }else{
            echo 'invalid password';
        }
    }else{
        echo 'invalid ID';
    }
}

?>