<?php
require('../database/db.php');

$_SESSION = [];
session_destroy();
header('location:/');
exit();