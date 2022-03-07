<?php
session_start();
require('../vendor/autoload.php');

$debug=0;

try{
    $db = new PDO("mysql:host=localhost;dbname=mspr_grp5", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'connexion failed :'.$e->getMessage();
}

function loginAttempts($loginAttempts, $id, $db){
    $loginAttempts += 1;
    $q = $db->prepare('UPDATE users SET loginAttempt = '.$loginAttempts.' WHERE id = :'.$id.'');
    $q->execute();
}
function clearLoginAttempts($id, $db){
    $loginAttempts = 0;
    $q = $db->prepare('UPDATE users SET loginAttempt = '.$loginAttempts.' WHERE id = :'.$id.'');
    $q->execute();
}