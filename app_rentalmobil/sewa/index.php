<?php

session_start();
if(!isset($_SESSION['login'])){
header('location:login.php?LoginNgabs');
}

include "../koneksi.php";
$sql = "SELECT * FROM sewa";
$query = mysqli_query($koneksi,$sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>RENTAL MOBIL</title>

    <style>
        @media print{
            #cetak {
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
          <li><a href="../mobil" class="nav-link px-2 text-white">Data Mobil</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          <a href="logout.php" id="cetak"><button class="btn btn-primary" id="cetak">Logout</button></a>
        </div>
      </div>
    </div>
  </header>

    <div class="container">
        <br>
    <h1 class="text-center">RENTAL MOBIL</h1>
    <table class="table">
        
        <a href="tambah.php" id="cetak"><button class="btn btn-info mx-1">Tambah</button></a>
        <button id="cetak" class="btn btn-primary" onclick="window.print()">Cetak</button>
        <tr>
            <th>KD Sewa</th>
            <th>KD Mobil</th>
            <th>KD Customer</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Total Sewa</th>
            <th colspan="2" id="cetak" class="text-center">Aksi</th>
        </tr>
        <?php
        while($sewa = mysqli_fetch_assoc($query)){?>
        <tr>
            <td><?= $sewa['kd_sewa'] ?></td>
            <td><?= $sewa['kd_mobil'] ?></td>
            <td><?= $sewa['kd_customer'] ?></td>
            <td><?= $sewa['tgl_pinjam'] ?></td>
            <td><?= $sewa['tgl_kembali'] ?></td>
            <td><?= $sewa['total_sewa'] ?></td>
            <td class="text-center"><a href="hapus.php?kd_sewa=<?= $sewa['kd_sewa'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')"><button id="cetak" class="btn btn-danger">Hapus</button></a>
            <a href="edit.php?kd_sewa=<?= $sewa['kd_sewa'] ?>"><button id="cetak" class="btn btn-warning">Edit</button></a></td>
        </tr>
        <?php
        }

        ?>
    </table>
    </div>
</body>
</html>