<?php
require_once('user.php');

if($_COOKIE == null){
    echo "cookies is null";
    header('location:index.php');
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

    
$user = new user();

if($_POST['add']){
  $error = $user->insert($email,$username,$password,$_SERVER["REQUEST_METHOD"]);
}else if($_POST['edit']){
  $id = $_POST['id'];
  $error = $user->update($id,$email,$username,$password,$_SERVER["REQUEST_METHOD"]);
}

if(count($error) == 0){
  header('location:server.php');
}else{
  foreach($error as $value){
      echo $value;
      echo "<br>";
  }
  echo '<a href="javascript:history.go(-1)">Try again</a>';
}
?>