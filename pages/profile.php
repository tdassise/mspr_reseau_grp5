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
        header('location:/mspr_reseau_grp5/pages/logout.php');
    }else{
        header('location:/mspr_reseau_grp5/pages/index.php');
    }
}

$userReq = $db->prepare('SELECT * FROM users WHERE id = :id');
$userReq->bindValue('id', $_SESSION['user_id']);
$userReq->execute();
$user = $userReq->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="../css/profile.css">

<?php 
if($debug == 1)
    var_dump($user); 
?>

<div id="main-container">
<?php 
if(!$user['secret']){
    if($debug == 1){
        echo var_dump($user);
        echo 'code: '.$_SESSION['tfa_secret'];
    }
    ?>
    
    <div id="QRCode-container">
        <a id="logout-btn" href="/mspr_reseau_grp5/pages/logout.php"><img src="../images/cancel.png" alt="cross"></a>
        <h2>2FA Activation</h2>
        <img id="QRCode" src="<?php echo($tfa->getQRCodeImageAsDataUri('mspr_grp5', $_SESSION['tfa_secret'])) ?>">
        <form class="input-group" method="POST">
            <input class="input-field" type="text" placeholder="verification code" name="tfa_code">
            <button class="submit-btn" type="submit">register</button>
        </form>
    </div>
<?php }?>
</div>