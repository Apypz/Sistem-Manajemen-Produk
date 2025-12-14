<?php
    include "../koneksi.php";
    $id_pengaduan = $_GET['id'];
    $sql = "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
    $query = mysqli_query($conn,$sql);
    while($pd = mysqli_fetch_assoc($query))
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Form Pengaduan</h1>
    <form action="p_tambah.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pengaduan" value="<?=$pd['id_pengaduan'];?>">
        <label for="">NIK</label>
        <input type="text" name="nik" value="<?=$pd['nik'];?>"><br>
        <label for="">Isi Laporan</label>
        <textarea name="isi_laporan" id="" cols="30" rows="10"><?=$pd['isi_laporan'];?></textarea><br>
        <label for="">Foto</label>
        <img src="foto/<?=$pd['foto'];?>" alt=""><br>
        <input type="submit" value="simpan">
    </form>
</body>
</html>
<?php
    }
?>