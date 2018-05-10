<?php
function htmlpost($campo){
	if(isset($_POST[$campo])) 
		return $_POST[$campo];
	return '';
}
function htmlNpost($campo){	// numero
	$d=htmlpost($campo);
	if(strlen($d)==0)
		return "NULL";
	return $d;
}
function htmlFpost($campo){  // fecha
	$d=htmlpost($campo);
	if(strlen($d)==0)
		return "NULL";
	return "'$d'";
}

?>
