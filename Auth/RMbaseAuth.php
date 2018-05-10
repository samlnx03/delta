<?php

require "dbclass.php";
//For security reasons, don't display any errors or warnings. Comment out in DEV.
error_reporting(0);
//start session
session_start();
class auth {
    //database and table fields
    //var $db=db::getInstance();  // mejor en loas funciones
    var $user_table = 'users';          //Users table name
    var $user_column = 'login';     //USERNAME column (value MUST be valid email)
    var $pass_column = 'pass';      //PASSWORD column

   var $userlogin;
 
    // functions
    // function login($table, $username, $password){
    // function logout(){
    // function logincheck($logincode, $user_table, $pass_column, $user_column){
    // function loginform($formname, $formclass, $formaction){

    function __constructor(){
	if(isset($_SESSION['user'])){
		$this->user=
	}
		
    }
    function login($username, $password){
        //conect to DB
	$db=db::getInstance();
        $password = md5($password);
        //execute login via qry function that prevents MySQL injections
        $result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->user_column."='?' AND ".$this->pass_column." = '?';" , $username, $password);

        //$row=mysql_fetch_assoc($result);
        $row=$result->fetch_assoc();
        if($row){
            if($row[$this->user_column] !="" && $row[$this->pass_column] !=""){
                //register sessions
                //you can add additional sessions here if needed
                $_SESSION['loggedin'] = $row[$this->pass_column];
                //userlevel session is optional. Use it if you have different user levels
                //$_SESSION['userlevel'] = $row[$this->user_level];
		$this->userlogin=$username;
                return true;
            }else{
                session_destroy();
		unset($this->userlogin);
                return false;
            }
        }else{
            return false;
        }
 
    }
 
    //prevent injection
    function qry($query) {
      $db=db::getInstance();
      $args  = func_get_args();
      $query = array_shift($args);
      $query = str_replace("?", "%s", $query);
      $args  = array_map('mysql_real_escape_string', $args);
      array_unshift($args,$query);
      $query = call_user_func_array('sprintf',$args);
      //$result = mysql_query($query) or die(mysql_error());
      $result=$db->query($query);
      if($result){
            return $result;
      }else{
            $error = "Error";
            return $result;
      }
    }
 
    //logout function
    function logout(){
        session_destroy();
        return;
    }
 
    //check if loggedin
    function logincheck($logincode){
        $result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->pass_column." = '?';" , $logincode);
        //$rownum = mysql_num_rows($result);
        $rownum = $result->num_rows;
        //return true if logged in and false if not
        if($row != "Error"){
            if($rownum > 0){
		$row=$result->fetch_assoc();
		$this->userlogin=$row[$this->user_column];
                return true;
            }else{
                return false;
            }
        }
    }
 
 
    //login form
    function loginform($formname, $formclass, $formaction){
	include("loginform.ihtml");
    }
}

?>
