<?php
include "../koneksi.php";

$kd_mobil = $_POST['kd_mobil'];
$jenis_mobil = $_POST['jenis_mobil'];
$warna = $_POST['warna'];
$stok = $_POST['stok'];
$tarif_sewa = $_POST['tarif_sewa'];

$sql = "UPDATE mobil SET jenis_mobil = '$jenis_mobil', warna = '$warna' , stok = '$stok', tarif_sewa = '$tarif_sewa' WHERE kd_mobil = '$kd_mobil'";
$query = mysqli_query($koneksi,$sql);

if($query){
    header("location:index.php?edit=berhasil");
}else {
    header("location:index.php?edit=gagal");
}
?>