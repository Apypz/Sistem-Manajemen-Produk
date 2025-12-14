<?php
include "../koneksi.php";
$kd_sewa = $_GET['kd_sewa'];
$sql = "SELECT * FROM sewa WHERE kd_sewa = '$kd_sewa'";
$query = mysqli_query($koneksi,$sql);

while ($sewa = mysqli_fetch_assoc($query)){

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
    <form action="proses_edit.php" method="post">
        <table>
            <br>
                <input type="hidden" name="kd_sewa" value="<?= $sewa['kd_sewa'] ?>">

                <label for="" class="form-label">KD Mobil</label>
                <input type="number" class="form-control" name="kd_mobil" id="" value="<?= $sewa['kd_mobil'] ?>">
            <br>
            
                <label for="">KD Customer</label>
                <input type="number" class="form-control" name="kd_customer" id="" value="<?= $sewa['kd_customer'] ?>">
            <br>
            
                <label for="">Tanggal Pinjam</label>
                <input type="date" class="form-control" name="tgl_pinjam" id="" value="<?= $sewa['tgl_pinjam'] ?>">
            <br>
            
                <label for="">Tanggal Kembali</label>
                <input type="date" class="form-control" name="tgl_kembali" id="" value="<?= $sewa['tgl_kembali'] ?>">
            <br>
        </table>
        <input type="submit" value="Simpan" class="btn btn-success">
        <a href="index.php" class="btn btn-secondary">Kembali</a>    
    </form>
    </div>
</body>
</html>

<?php
}
?>