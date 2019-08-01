<?php
//
// logout
//
require_once "Auth/auth.php";

$auth = Auth::getInstance();
$auth->logout();
header("Location: index.php");
?>

