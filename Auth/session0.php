<?php
require_once "Auth/dbclass.php";
class Session {
private $loginForm="loginForm.php";
private $logged_in=false;
public $user_id;
public $user_perm;

function __construct() {
    session_start();
}
function start(){
    	$this->check_login();
    	if($this->logged_in) {
		// actions to take right away if user is logged in
    	} else {
		// actions to take right away if user is not logged in
		$_SESSION['_loginEnProgreso']=1;
		require($this->loginForm);
		exit;
    	}
}

public function is_logged_in() {
   return $this->logged_in;
}

public function login() {
	// database should find user based on username/password
	// obtener username y pass desde POST
	$name=$_POST['_username'];
	$pass=$_POST['_password'];
	//$q="select login, perm from users where login='$name' and pass=md5('$pass')";
	/*
	$q="select login, perm from users where login='$name' and pass='$pass'";
	$db=db::getInstance();
	$result=$db->query($q);
	if($result->num_rows==1){
	  //$this->user_id = $_SESSION['user_id'] = $user->id;
	  $row=$result->fetch_assoc();
	  $this->user_id = $_SESSION['user_id'] = $row['login'];
	  $this->user_perm = $_SESSION['perm'] = $row['perm'];
	  $this->logged_in = true;
	  return true;
	}
	 */
	if($name='sam' AND $pass='mas'){
		$this->logged_in = true;
	  	return true;
	}
	return false;
}

public function logout() {
	unset($_SESSION['user_id']);
	unset($_SESSION['perm']);
	unset($this->user_id);
	$this->logged_in = false;
}

private function check_login() {
	if(isset($_SESSION['user_id'])) {
	  $this->user_id = $_SESSION['user_id'];
	  $this->user_perm = $_SESSION['perm'];
	  $this->logged_in = true;
	} 
	elseif(isset($_SESSION['_loginEnProgreso'])){ // ya se presento el formulario
	  if(!$this->login()){
		// volver a incluir el formulario con mensaje de error
		require($this->loginForm);
		exit;
	  } else unset($_SESSION['_loginEnProgreso']);
	}
	else {
	  unset($this->user_id);
	  $this->logged_in = false;
	}
}
}
$session = new Session();
?>


