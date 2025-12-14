<?php
    include "../koneksi.php";
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $sql = "UPDATE masyarakat SET nama='$nama',username='$username',password='$password',telp='$telp' WHERE nik='$nik'";
    $query = mysqli_query($conn,$sql);
    if($query){
        header("location:index.php?simpan=berhasil");
    }
    else{
        header("location:index.php?simpan=gagal");
    }
?>