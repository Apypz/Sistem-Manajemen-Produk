<?php
session_start();
if(!isset($_SESSION['login'])){
    header('location:login.php?LoginBang');
}
include "../koneksi.php";



$sql = "SELECT * FROM mobil";
$query = mysqli_query($koneksi,$sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>Rental Mobil</title>
    <style>
        @media print{
            #cetak{
                display: none;
            }
        }
    </style>
</head>
<body>

<header class="p-3 text-bg-dark" id="cetak">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="../sewa" class="nav-link px-2 text-white">Rental Mobil</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
        
          
        </div>
      </div>
    </div>
  </header>


    <div class="container">
        <br>
    <h1 class="text-center">DATA MOBIL</h1>
    <table class="table">
        <button id="cetak" class="btn btn-info mx-1" onclick="window.print()">Print</button>
        <a href="tambah.php" id="cetak"><button class="btn btn-primary">Tambah</button></a>
        <br>
        <br>
        <tr class="table table-primary">
            <th scope="row">KD Mobil</th>
            <th scope="row">Jenis Mobil</th>
            <th scope="row">Warna</th>
            <th scope="row">Stok</th>
            <th scope="row">Tarif Sewa</th>
            <th colspan="2" class="text-center" id="cetak" scope="row">Aksi</th>
        </tr>
        <?php
        while($mobil = mysqli_fetch_assoc($query)){?>
        <tr>
            <td><?= $mobil['kd_mobil'] ?></td>
            <td><?= $mobil['jenis_mobil'] ?></td>
            <td><?= $mobil['warna'] ?></td>
            <td><?= $mobil['stok'] ?></td>
            <td><?= $mobil['tarif_sewa'] ?></td>
            <td class="text-center" id="cetak"><a href="hapus.php?kd_mobil=<?= $mobil['kd_mobil'] ?>"
            onclick="return confirm('Yakin ingin menghapus data ini?')">
            <button class="btn btn-danger">Hapus</button></a>
            <a href="edit.php?kd_mobil=<?= $mobil['kd_mobil'] ?>"><button class="btn btn-warning">Edit</button></a></td>
        </tr>
        <?php
        }

        ?>
    </table>
    </div>
</body>
</html>