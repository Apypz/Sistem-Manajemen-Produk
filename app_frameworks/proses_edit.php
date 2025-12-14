<?php
include "koneksi.php";

$no = $_GET['no'];
$nama = $_GET['nama'];
$bahasa = $_GET['bahasa'];
$tahun = $_GET['tahun'];
$pengguna = $_GET['pengguna'];

$sql = "UPDATE frameworks SET nama= '$nama', bahasa='$bahasa', tahun='$tahun', pengguna='$pengguna' where no='$no'";
$query = mysqli_query($koneksi,$sql);

if($query){
    header("location:index.php?=EditBerhasil?>");
}else
    header("location:index.php?=EditGagal>");
?>