<?php
    include "koneksi.php";
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sqlmsy = "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password'";
    $sqlpts = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
    $querymsy = mysqli_query($conn,$sqlmsy);
    $querypts = mysqli_query($conn,$sqlpts);
    if(mysqli_num_rows($querymsy) > 0){
        $_SESSION['login'] = "$username";
        header ("location:index.php?login=berhasil");
    }
    else if(mysqli_num_rows($querypts) > 0){
        $_SESSION['login'] = "$username";
        header ("location:index.php?login=berhasil");
    }
    else{
        header ("location:login.php?login=gagal");
    }
?>