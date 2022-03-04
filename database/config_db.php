<?php

$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = ''; //parameter for Julien B. empty, for Thibault D. = root
$db_db = 'mspr_grp5';
$db_port = 3306;

$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);

if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}