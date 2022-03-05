<?php
require('../database/db.php');

$_SESSION = [];
session_destroy();
header('location:/mspr_reseau_grp5/pages/index.php');
exit();