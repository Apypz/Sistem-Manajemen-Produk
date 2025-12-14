<?php
    include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah petugas</title>
</head>
<body>
    <h1>Form Tambah</h1>
    <form action="p_tambah.php" method="post">
        <label for="">Nama</label>
        <input type="text" name="nama_petugas" id="">
        <label for="">Username</label>
        <input type="text" name="username" id="">
        <label for="">Password</label>
        <input type="password" name="password" id="">
        <label for="">Telepon</label>
        <input type="number" name="telp" id="">
        <label for="">Level</label>
        <select name="level" id="">
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
        <input type="submit" value="simpan">
    </form>
</body>
</html>