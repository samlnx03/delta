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

function htmlSelect($qry, $name, $val, $tit, $selected){
	$db=db::getInstance();
	$db->query($qry);
	$ops="<select id='$name' name='$name'>\n";
	while($db->next_row()){
		$ops=$ops."<option ";
		if($db->f($val)==$selected){
			$ops.="selected ";
		}
		$ops.= "value='".$db->f("$val")."'>".$db->f($tit)."</option>\n";
	}
	$ops=$ops."</select>\n";
	return $ops;
}
?>
