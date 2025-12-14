<?php
    include "../koneksi.php";
    $id_petugas = $_GET['id_petugas'];
    $sql = "DELETE FROM petugas WHERE id_petugas = '$id_petugas'";
    $query = mysqli_query($conn,$sql);
    if($query){
        header("location:index.php?hapus=berhasil");
    }
    else{
        header("location:index.php?hapus=gagal");
    }
?>