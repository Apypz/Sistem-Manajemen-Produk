<?php
    include "../koneksi.php";
    $nik = $_GET['nik'];
    $sql = "DELETE FROM masyarakat WHERE nik = '$nik'";
    $query = mysqli_query($conn,$sql);
    if($query){
        header("location:index.php?hapus=berhasil");
    }
    else{
        header("location:index.php?hapus=gagal");
    }
?>