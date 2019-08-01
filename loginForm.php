<?php
require_once "Auth/proteger.php";
//echo "<html><head></head><body>\n";
echo "<form method='POST' action={$_SERVER['PHP_SELF']}>
	Username: <input type='text' name='_username'> 
	Password: <input type=password name='_password'><br>
	<input type=submit name='submit' value='Acceder'>
	</form>\n";
//echo "</body></html>\n";
?>
