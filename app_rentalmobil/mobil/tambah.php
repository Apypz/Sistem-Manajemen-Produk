<?php
session_start();
if(!isset($_SESSION['login'])){
    header('location:login.php?LoginBang');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        
        <br>
    <h1 class="text-center">Tambah Data</h1>
        <br>
    <form action="proses_tambah.php" method="post">
    <table class=table>
        
            <input type="hidden" name="kd_mobil" id="">
        
        
            <label for=""><strong>Jenis Mobil</strong></label>
            <input type="text" class="form-control" name="jenis_mobil" id="" placeholder="Masukkan Jenis Mobil">
        <br>
        
            <label for=""><strong>Warna</strong></label>
            <input type="text" class="form-control" name="warna" id="" placeholder="Masukkan Warna Mobil">
        <br>
        
            <label for=""><strong>Stok</strong></label>
            <input type="number" class="form-control" name="stok" id="" placeholder="Masukkan Stok Mobil">
        <br>
        
            <label for=""><strong>Tarif Sewa</strong></label>
            <input type="number" class="form-control" name="tarif_sewa" id="" placeholder="Masukkan Tarif Sewa">
        <br>
        
    </table>
        <input type="submit" value="Tambah" class="btn btn-success">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
    </div>
</body>
</html>