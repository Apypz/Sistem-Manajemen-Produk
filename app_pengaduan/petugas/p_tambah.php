<?php
    include "../koneksi.php";
    $nama = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];
    $sql = "INSERT INTO petugas (nama_petugas,username,password,telp,level) VALUE ('$nama','$username','$password','$telp','$level')";
    // echo $sql;
    $query = mysqli_query($conn,$sql);
    if($query){
        header("location:index.php?simpan=berhasil");
    }
    else{
        header("location:index.php?simpan=gagal");
    }
?>