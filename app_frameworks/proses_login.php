<?php
session_start();

include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM user WHERE username = '$username' AND password = md5('$password')";
$query = mysqli_query($koneksi,$sql);

if(mysqli_num_rows($query) > 0 ){
    $_SESSION['login'] = "$username";
    header("location:index.php?=LoginBerhasil");
}else {
    header("location:login.php?=LoginGagal");
}
?>