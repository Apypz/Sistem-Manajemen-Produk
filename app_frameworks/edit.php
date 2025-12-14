<?php
include "koneksi.php";

$no= $_GET['no'];
$sql = "SELECT * FROM frameworks WHERE no= '$no'";
$query = mysqli_query($koneksi,$sql);

while ($frame = mysqli_fetch_assoc($query)) { ?>

<!DOCTYPE html>
<html lang="en">
  <script></script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

<header class="p-3 text-bg-dark">
    <div class="container">
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
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </div>
  </header>

    <div class="container">
      <br><br>
    <h1>Edit Data</h1>
    <form action="proses_edit.php" method="get">
        <table class="table">
            <input type="hidden" name="no" id="" class="form-control" value="<?= $frame['no'] ?>"> 
            
                <label for="">Nama</label>
                <input type="text" name="nama" id="" class="form-control" value="<?= $frame['nama'] ?>">
            <br>
            
                <label for="">Bahasa</label>
                <input type="text" name="bahasa" id="" class="form-control"  value="<?= $frame['bahasa'] ?>">
            <br>
            
                <label for="">Tahun</label>
                <input type="text" name="tahun" id="" class="form-control"  value="<?= $frame['tahun'] ?>">
            
            <br>
                <label for="">Pengguna</label>
                <input type="text" name="pengguna" id="" class="form-control"  value="<?= $frame['pengguna'] ?>">
            
        </table>
        <input type="submit" value="Edit" class="btn btn-success">
    </form>
    </div>
</body>
</html>

<?php
}
?>
