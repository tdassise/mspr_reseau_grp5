<?php

// fichier de connexion à la bdd, à modifier en fonction de votre configuration

$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'mspr_grp5';
$db_port = 8889;

// création d'une instance de mysqli, qui permet de requêter sur la BDD
$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);

// si il y a une erreur lors de la connexion
if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}