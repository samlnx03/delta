<?php
require "Auth/samAuth.php";
$auth=new auth();
if(isset($_GET['logout'])){
        $auth->logout();
        header('Location: ./bye.html');
}
if(isset($_POST['login'])){
        if(!$auth->login($_POST['username'], $_POST['password'])){
                echo '<html><body>';
                $auth->loginform("forma", "class", $_SERVER['PHP_SELF']);
                echo '</body></html>';
                exit;
        }
}

if(!$auth->logincheck($_SESSION['loggedin'])){
        // need to login first
        echo '<html><body>';
        echo '<H1>Punto de entrada</H1>';
        $auth->loginform("form", "class", $_SERVER['PHP_SELF']);
        echo '</body></html>';
        exit;
}

error_reporting(E_ALL | E_STRICT);
?>

