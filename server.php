<?php

if($_COOKIE == null){
    echo "cookies is null";
    header('location:index.php');
}
// var_dump($_COOKIE);


$conn = new mysqli("localhost", "root", "root","mydb");

 if ($conn->connect_error) {
  echo("Connection failed: " . $conn->connect_error);
} 

$conn->query("
CREATE TABLE IF NOT EXISTS myuser(
    id int PRIMARY KEY NOT null AUTO_INCREMENT,
    email varchar(50),
    username varchar(50),
	pass varchar(50)
);
");

$id = $_POST['id'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];


// if($_POST['add']){
//     // $conn = new mysqli("localhost", "root", "root","mydb");

//     // $insertSql = "
//     // INSERT INTO myuser (email, username, pass)
//     // VALUES ('$email', '$username', '$password')
//     // ";

//     //  $conn->query($insertSql);

// }else{

//     // $updateSql = "
//     // UPDATE myuser SET email='$email', username='$username', pass='$password' WHERE id=$id
//     // ";

//     // $conn->query($updateSql);
// }



$showAllSql = "SELECT * FROM myuser";
$result = $conn->query($showAllSql);


echo "<a href='register.php'>Add</a>";

createTable(); 

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['username']}</td>";
    echo "<td>{$row['pass']}</td>";
    echo "<td>"."<a href='edit.php?id={$row['id']}'>Edit </a>"."</td>";
    echo "<td>"."<a href='delete.php?id={$row['id']}'>Delete </a>"."</td>";
    echo "</tr>";
}
echo "</table>";



function createTable(){
    echo "<table border=2>";
    echo "<tr>";
    echo "<br><br><br>";
    echo "<th>id</th>";
    echo "<th>email</th>";
    echo "<th>username</th>";
    echo "<th>password</th>";
    echo "<th>edit</th>";
    echo "<th>delete</th>";
    echo "</tr>";
}

?>
