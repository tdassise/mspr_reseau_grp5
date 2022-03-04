<?php
require('../database/db.php');

use RobThree\Auth\TwoFactorAuth;
$tfa = new TwoFactorAuth();

if(empty($_SESSION['tfa_secret'])){
    $_SESSION['tfa_secret'] = $tfa->createSecret();
}

$secret = $_SESSION['tfa_secret'];

if(empty($_SESSION['user_id'])){
    header('location:/');
    exit();
}

if(!empty($_POST['user_id'])){
    header('location:/');
    exit();
}

if(!empty($_POST['$tfa_code'])){
    if($tfa->verifyCode($secret, $_POST['tfa_code'])){
        echo 'valid';
    }else{
        echo 'invalid';
    }
}

$userReq = $db->prepare('SELECT * FROM users WHERE id = :id');
$userReq->bindValue('id', $_SESSION['user_id']);
$userReq->execute();
$user = $userReq->fetch(PDO::FETCH_ASSOC);

?>

<h1>Your profile</h1>

<a href="/logout.php">Logout</a>
<?php 
echo '<pre>';
    var_dump($user);
    echo 'code: '.$secret;
echo '</pre>'; 
echo '<img src="'.$tfa->getQRCodeImageAsDataUri('mspr_grp5', $secret).'">';
?>
<form method="POST">
    <input type="text" placeholder="verification code" name="tfa_code">
    <button type="submit">send</button>
</form>