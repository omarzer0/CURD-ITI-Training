<?php

if($_COOKIE == null){
    echo "cookies is null";
    header('location:index.php');
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$error = [];

// $email = test_input($email);
// $username = test_input($username);
// $password = test_input($password);

// echo $email;
// echo $username;
// echo $password;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
      $error['name'] = "Name is required";
    } else {
      $username = test_input($_POST["username"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
        $error['name'] = "Only letters and white space allowed";
      }
    }


    if (empty($_POST["email"])) {
        $error['email'] = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email format";
        }
      }

      if (empty($_POST["password"])) {
        $error['password'] = "Password is required";
      }


}else{
    $error['request'] = 'Insecure request method';
}


if(count($error) == 0){
    // no error send the data to server
     $conn = new mysqli("localhost", "root", "root","mydb");


    $selectedQuery = "";
    if($_POST['add']){
        $selectedQuery = "INSERT INTO myuser (email, username, pass)
        VALUES ('$email', '$username', '$password')
        ";
    }else if($_POST['edit']){
        $id = $_POST['id'];
        $selectedQuery = 
        "UPDATE myuser SET email='$email', username='$username', pass='$password' WHERE id=$id";
    }
    
    $conn->query($selectedQuery);
    header('location:server.php');

}else{
    // // go back to register with the errors
    // $errorJson = json_encode($error);
    // if($_POST['add']){
    //     header("location:register.php?error='$errorJson'");
    // }else{
    //     header("location:edit.php?error='$errorJson'");
    // }

    // echo  "<pre>";
    // var_dump($error);
    // echo  "</pre>";


    foreach($error as $value){
        echo $value;
        echo "<br>";
    }
    echo '<a href="javascript:history.go(-1)">Try again</a>';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>