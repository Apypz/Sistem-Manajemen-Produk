<?php
include "koneksi.php";

$no = $_GET['no'];
$nama = $_GET['nama'];
$bahasa = $_GET['bahasa'];
$tahun = $_GET['tahun'];
$pengguna = $_GET['pengguna'];

$sql = "INSERT INTO frameworks (nama,bahasa,tahun,pengguna) VALUES ('$nama', '$bahasa','$tahun', '$pengguna')";
$query = mysqli_query($koneksi,$sql);

if($query){
    header("location:index.php?=SimpanBerhasil?>");
}else
    header("location:index.php?=SimpanGagal>");
?>