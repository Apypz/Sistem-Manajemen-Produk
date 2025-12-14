<?php
session_start();
if(!isset($_SESSION['login'])){
    header('location:login.php?LoginBang');
}
include "../koneksi.php";
$kd_mobil = $_GET['kd_mobil'];
$sql = "SELECT * FROM mobil WHERE kd_mobil = '$kd_mobil'";
$query = mysqli_query($koneksi,$sql);

while ($mobil = mysqli_fetch_assoc($query)){

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
        <br>
        <h1 class="text-center">Edit Data</h1>
        <table>
            
                <input type="hidden" name="kd_mobil" value="<?= $mobil['kd_mobil'] ?>">
            
            <br>
                <label for="">Jenis Mobil</label></td>
                <input type="text" class="form-control" name="jenis_mobil" id="" value="<?= $mobil['jenis_mobil'] ?>">
            
            <br>
                <label for="">Warna</label>
                <input type="text" class="form-control" name="warna" id="" value="<?= $mobil['warna'] ?>">
            <br>
            
                <label for="">Stok</label>
                <input type="text" class="form-control" name="stok" id="" value="<?= $mobil['stok'] ?>">
            <br>
            
                <label for="">Tarif mobil</label>
                <input type="number" class="form-control" name="tarif_sewa" id="" value="<?= $mobil['tarif_sewa'] ?>">
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