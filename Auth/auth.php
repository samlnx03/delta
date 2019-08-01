<?php
require_once "Auth/session.php";
require_once "Auth/dbclass.php";

class Auth {
private $loginForm="loginForm.php";
private $logged_in=false;
private $session;
public $user_id;
public $user_perm;

private static $instance;  // la instancia de onjeto auth

public static function getInstance(){
		if ( !isset(self::$instance))
		{
			self::$instance = new self;
		}
		//self::$instance->start();  // llamar explicitamente
		return self::$instance;
}

function __construct() {
	$this->session = Session::getInstance();
}

function start(){
	if($this->is_logged_in()){
		return;
	}
	// actions to take right away if user is not logged in
	if(!$this->session->__isset('_loginEnProgreso')){
		$this->session->__set('_loginEnProgreso',true);
	  	//echo "start: _loginEnProgreso just set<br>\n";
		require($this->loginForm);
		exit;
	} else { // validar datos del formulario
	  	//echo "start: _loginEnProgreso set, going to check form data<br>\n";
		if(!$this->login()){
		  require($this->loginForm);
		  exit;
		}
	}
}

public function is_logged_in() {
	if($this->session->__isset('_logged_in'))
		$this->logged_in=true;
	return $this->logged_in;
}

public function login() {
	// database should find user based on username/password
	// obtener username y pass desde POST
	if(!isset($_POST['_username']) OR !isset($_POST['_password']))
		return false;
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
	//echo "login: verif credenciales<br>\n";
	if($name=='delta' AND $pass=='0atled1'){
		$this->logged_in = true;
		$this->session->__unset('_loginEnProgreso');
		$this->session->__set('_logged_in',true);
		//echo "credenciales ok<br>\n";
		//print_r( $_SESSION );
	  	return true;
	}
	//echo "credenciales erroneas<br>\n";
	echo "Autenticacion invalida<br>\n";
	return false;
}

public function logout() {
	if ( !isset(self::$instance))
	{
		self::$instance = new self;
	}

	$this->session->__unset('_logged_in');
	$this->session->destroy();
	$this->logged_in = false;
}
}
?>
