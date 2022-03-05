<?php
require('../database/db.php');

use RobThree\Auth\TwoFactorAuth;
$tfa = new TwoFactorAuth();

if(empty($_SESSION['tfa_secret'])){
    $_SESSION['tfa_secret'] = $tfa->createSecret();
}

if(empty($_SESSION['user_id'])){
    header('location:/');
    exit();
}

if(!empty($_POST['tfa_code'])){
    if($tfa->verifyCode($_SESSION['tfa_secret'], $_POST['tfa_code'])){
        $q = $db->prepare('UPDATE users SET secret = :secret WHERE id = :id');
        $q->bindValue('secret', $_SESSION['tfa_secret']);
        $q->bindValue('id', $_SESSION['user_id']);
        $q->execute();
        echo '<pre>';
            echo 'code valid';
        echo '</pre>';
    }else{
        echo '<pre>';
            echo 'invalid code';
        echo '</pre>';
    }
}

$userReq = $db->prepare('SELECT * FROM users WHERE id = :id');
$userReq->bindValue('id', $_SESSION['user_id']);
$userReq->execute();
$user = $userReq->fetch(PDO::FETCH_ASSOC);

?>

<h1>Your profile</h1>

<?php 
if($debug == 1)
    var_dump($user); 
?>

<a href="/mspr_reseau_grp5/pages/logout.php">Logout</a><br>
<?php 
if(!$user['secret']){
    if($debug == 1){
        echo var_dump($user);
        echo 'code: '.$_SESSION['tfa_secret'];
    }
    ?>
    <h2>Activate 2FA</h2>
    <img src="<?php echo($tfa->getQRCodeImageAsDataUri('mspr_grp5', $_SESSION['tfa_secret'])) ?>">

    <form method="POST">
        <input type="text" placeholder="verification code" name="tfa_code">
        <button type="submit">send</button>
    </form>
<?php }else{
    echo '2FA activated';
} 

?>