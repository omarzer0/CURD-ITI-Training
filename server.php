<?php

$conn = new mysqli("localhost", "root", "root","mydb");

 if ($conn->connect_error) {
  echo("Connection failed: " . $conn->connect_error);
} 

$conn->query("
CREATE TABLE in not exsist myuser(
    id int PRIMARY KEY NOT null AUTO_INCREMENT,
    email varchar(50),
    username varchar(50),
	pass varchar(50)
);
");
$id = $_GET['id'];
$email = $_GET['email'];
$username = $_GET['username'];
$password = $_GET['password'];

if($_GET['add']){
    $conn = new mysqli("localhost", "root", "root","mydb");

    $insertSql = "
    INSERT INTO myuser (email, username, pass)
    VALUES ('$email', '$username', '$password')
    ";

     $conn->query($insertSql);

}else{

    $updateSql = "
    UPDATE myuser SET email='$email', username='$username', pass='$password' WHERE id=$id
    ";

    $conn->query($updateSql);
}



$showAllSql = "SELECT * FROM myuser";
$result = $conn->query($showAllSql);


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
