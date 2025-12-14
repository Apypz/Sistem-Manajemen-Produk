<?php
session_start();
include "koneksi.php";

$sql = "SELECT * FROM frameworks";
$query = mysqli_query($koneksi,$sql);

if(!isset($_SESSION['login'])){
  header("location:login.php?pesan=LoginDuluBanh");
}
//echo "Anda Login Sebagai " . $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Frameworks</title>
    
    <link rel="stylesheet" href="bootstrap.css">

    <style>
      @media print {
        #pr {
          display: none;
        }
      }
    </style>
</head>
<body>

<header class="p-3 text-bg-dark">
    <div id="pr" class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <a href="logout.php"><button type="button" class="btn btn-outline-light me-2">Logout</button></a>

        </div>
      </div>
    </div>
  </header>


    <div class="container">
    <br><br>
    <h1 class="text-center"><strong>Data Frameworks</strong></h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <a id="pr" href="tambah.php" id="pr"><button class="btn btn-success">Tambah</button></a>
    <button id="pr" class="btn btn-outline-primary" onclick="window.print()">Cetak</button>
      
    <table class="table">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Bahasa</th>
            <th>Tahun</th>
            <th>Pengguna</th>
            <th id="pr" class="text-center">Aksi</th>
        </tr>
        <?php
        while ($frame = mysqli_fetch_assoc($query)){?>
            <tr>
                <td><?= $frame['no'] ?></td>
                <td><?= $frame['nama'] ?></td>
                <td><?= $frame['bahasa'] ?></td>
                <td><?= $frame['tahun'] ?></td>
                <td><?= $frame['pengguna'] ?></td>
                <td id="pr" class="text-center"><a href="hapus.php?no=<?= $frame['no'] ?>"><button class="btn btn-primary">Hapus</button></a>
                 <a href="edit.php?no=<?= $frame['no'] ?>"><button class="btn btn-warning">Edit</button></a></td>
                
            </tr>
    
         <?php
        }
        ?>
         
    </table>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </div>
  
</body>
</html>