<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah</title>
</head>
<body>
    <h1>Form Pengaduan</h1>
    <form action="p_tambah.php" method="post" enctype="multipart/form-data">
        <label for="">NIK</label>
        <input type="text" name="nik" id=""><br>
        <label for="">Isi Laporan</label>
        <textarea name="isi_laporan" id="" cols="30" rows="10"></textarea><br>
        <label for="">Foto</label>
        <input type="file" name="foto" id=""><br>
        <input type="submit" value="simpan">
    </form>
</body>
</html>