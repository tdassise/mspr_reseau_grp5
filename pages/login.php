<?php
require('../database/db.php');

use RobThree\Auth\TwoFactorAuth;
$tfa = new TwoFactorAuth();

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tfaCode = $_POST['tfa_code'];

    if($debug == 1){
        var_dump($email);
        var_dump($password);
    }

    $q = $db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue('email', $email);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);

    if($debug == 1){var_dump($user);}

    if($user){
        $passwordHash = $user['password'];
        if(password_verify($password, $passwordHash)){
            if($tfa->verifyCode($user['secret'], $tfaCode)){
                header('location:/mspr_reseau_grp5/pages/accueil.php');
                exit();   
            }
        }
        if(!$user['secret']){
            $_SESSION['user_id'] = $user['id'];
            header('location:/mspr_reseau_grp5/pages/profile.php');
            exit();
        }
        if($tfaCode != $user['secret']){
            echo '<h1>invalid TOTP code</h1>';
        }
        if($password != $user['password']){
        echo '<h1>invalid password</h1>';
        }
      
    }else{
        echo '<h1>invalid ID</h1>';
    }
}
?>

<a id="logout-btn" href="/mspr_reseau_grp5/pages/logout.php">Logout</a>