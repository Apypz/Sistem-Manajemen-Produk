<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="proses_login.php" method="post">
        <table>
            <tr>
                <td><label for="">username</label></td>
                <td><input type="text" name="username" id=""></td>
            </tr>
            <tr>
                <td><label for="">password</label></td>
                <td><input type="password" name="password" id=""></td>
            </tr>
        </table>
        <input type="submit" value="Login">
    </form>
</body>
</html>