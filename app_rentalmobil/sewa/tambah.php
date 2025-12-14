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
    <form action="proses_tambah.php" method="post">
    <table>
        
            <label for="">KD Mobil</label>
            <input type="text" class="form-control" name="kd_mobil" placeholder="Masukkan KD Mobil" id="">
        
        <br>
            <label for="">KD Customer</label>
            <input type="text" class="form-control" name="kd_customer" placeholder="Masukkan KD Customer" id="">
        
        <br>
            <label for="">Tanggal Pinjam</label>
            <input type="date" class="form-control" name="tgl_pinjam" id="">
        
        <br>
            <label for="">Tanggal Kembali</label>
            <input type="date" class="form-control" name="tgl_kembali"  id="">
        <br>
        
    </table>
    <input type="submit" value="Tambah" class="btn btn-primary">
    <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
    </div>
</body>
</html>