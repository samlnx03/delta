<?php
require "Auth/session.php";

$session=Session::getInstance();

if(isset($_GET['logout'])){
	$session->destroy();
	echo "bye";
	exit;
}

if(!$session->__isset("counter")){
	$session->__set("counter",1);
}
else
	$session->__set("counter",$session->__get("counter")+1);

echo "counter: ".$session->__get("counter")."<br>\n";


