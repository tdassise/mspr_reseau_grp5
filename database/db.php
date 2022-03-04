<?php
session_start();
require('../vendor/autoload.php');

try{
    $db = new PDO("mysql:host=localhost;dbname=mspr_grp5", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'connexion failed :'.$e->getMessage();
}