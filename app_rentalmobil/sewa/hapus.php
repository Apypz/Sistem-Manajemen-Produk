<?php
include "../koneksi.php";

$kd_sewa = $_GET['kd_sewa'];
$sql = "DELETE FROM sewa WHERE kd_sewa = '$kd_sewa'";
$query = mysqli_query($koneksi,$sql);

if ($query){
    header("location:index.php?hapus=berhasil");
}else{
    header("location:index.php?hapus=gagal");
}

?>