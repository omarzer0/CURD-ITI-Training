<?php

if($_COOKIE == null){
    echo "cookies is null";
    header('location:index.php');
}


$conn = new mysqli("localhost", "root", "root","mydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$username = $_POST['username'];
$pass = $_POST['password'];


// echo $username;
// echo $pass;
$selectQuery = "SELECT * FROM login WHERE username='$username' and pass='$pass'";
$result = $conn->query($selectQuery);
$row = $result->fetch_assoc();
if($row != null){
    setcookie('username',$username);
    setcookie('pass',$pass);

    echo "{$_COOKIE['pass']}";
    header('Location: server.php');
    echo "yes";
}else{
    header('Location: index.php');
    echo "no";
}

// var_dump($row);

?>