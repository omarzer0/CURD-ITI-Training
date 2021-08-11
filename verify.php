<?php
require_once('user.php');

$user = new user();


$username = $_POST['username'];
$pass = $_POST['password'];
$tableName = "login";

$row = $user->getSingleRow($tableName,$username,$pass);
if($row != null){
    setcookie('username',$username);
    setcookie('pass',$pass);

    echo "{$_COOKIE['pass']}";
    header('Location: server.php');
    echo "yes";
}else{
    // var_dump($row);
    header('Location: index.php');
    echo "no";
}
?>