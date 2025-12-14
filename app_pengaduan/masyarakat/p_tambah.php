<?php
    include "../koneksi.php";
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $sql = "INSERT INTO masyarakat (nik,nama,username,password,telp) VALUES ('$nik','$nama','$username','$password','$telp')";
    $query = mysqli_query($conn,$sql);
    if($query){
        header("location:index.php?simpan=berhasil");
    }
    else{
        header("location:index.php?simpan=gagal");
    }
?>