<?php

if($_COOKIE == null){
    echo "cookies is null";
    header('location:index.php');
}


echo '
    <form action="validate.php" method="post">
        <table>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>

            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>

            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="add"> </td>
            </tr>
        </table>
    </form>
';

?>

