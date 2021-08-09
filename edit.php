<?php

if($_COOKIE == null){
    echo "cookies is null";
    header('location:index.php');
}

$conn = new mysqli("localhost", "root", "root","mydb");

$userId = $_GET['id'];

$getQuery = "SELECT * FROM myuser WHERE id=$userId";

$result = $conn->query($getQuery);


$row = $result->fetch_assoc();

$rowId = $row['id'];
$email = $row['email'];
$username = $row['username'];
$pass = $row['pass'];

?>

<form action="validate.php" method="post">
<table>
    <input type="hidden" name="id" value=<?php echo"$rowId"?> >

    <tr>
        <td>Email</td>
        <td><input type="text" name="email" value=<?php echo"$email" ?> </td>
    </tr>

    <tr>
        <td>Username</td>
        <td><input type="text" name="username" value=<?php echo"$username"?>></td>
    </tr>

    <tr>
        <td>Password</td>
        <td><input type="password" name="password" value=<?php echo"$pass"?>></td>
    </tr>
    <tr>
        <td><input type="submit" name="edit"> </td>
    </tr>
</table>
</form>