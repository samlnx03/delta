<?php
//
// logintest
//
//require_once "Auth/session.php";
//require_once "Auth/auth.php";
require_once "Auth/proteger.php";

$session = Session::getInstance();
$auth = Auth::getInstance();

if(isset($_GET['logout'])){
	echo "destruyendo session<br>\n";
	$auth=Auth::getInstance();
	$auth->logout();
	echo "<a href=logintest.php>Login again</a><br>\n";
	exit;
}

echo "en logintest.php<br>\n";
echo "<a href=logintest.php?logout=y>Logout</a><br>\n";

?>

