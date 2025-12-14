<?php
include "../koneksi.php";

$kd_mobil = $_GET['kd_mobil'];
$sql = "DELETE FROM mobil WHERE kd_mobil = '$kd_mobil'";
$query = mysqli_query($koneksi,$sql);

if ($query){
    header("location:index.php?hapus=berhasil");
}else{
    header("location:index.php?hapus=gagal");
}

?>