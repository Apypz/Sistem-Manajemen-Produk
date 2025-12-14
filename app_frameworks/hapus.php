<?php
include "koneksi.php";

$no = $_GET['no'];
$sql = "DELETE FROM frameworks where no='$no'";
$query = mysqli_query($koneksi,$sql);

if($query){
    header("location:index.php?=HapusBerhasil?>");
}else
    header("location:index.php?=HapusGagal>");
?>