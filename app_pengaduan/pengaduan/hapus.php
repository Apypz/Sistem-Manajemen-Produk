<?php
    include "../koneksi.php";
    $id_pengaduan = $_GET['id'];
    $sql = "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
    // echo $id_pengaduan;
    $query = mysqli_query($conn,$sql);
    if($query){
        header("location:index.php?hapus=berhasil");
    }
    else{
        header("location:index.php?hapus=gagal");
    }
?>