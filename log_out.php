<?php 
include "config/config.php";
$_SESSION = array();
session_destroy();
header('Location: /');
?>
