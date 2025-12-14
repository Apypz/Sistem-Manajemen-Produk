<?php
    include "../koneksi.php";
    $id_petugas = $_GET['id_petugas'];
    $sql = "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'";
    $query = mysqli_query($conn,$sql);
    $sql1 = "SELECT (level) FROM petugas";
    $query1 = mysqli_query($conn,$sql1);
    while($msy = mysqli_fetch_assoc($query))
    while($pts = mysqli_fetch_assoc($query1))
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit petugas</title>
</head>
<body>
    <h1>Form Edit</h1>
    <form action="p_edit.php" method="post">
        <input type="hidden" name="id_petugas" value="<?=$msy['id_petugas'];?>"><br>
        <label for="">Nama</label>
        <input type="text" name="nama" value="<?=$msy['nama_petugas'];?>"><br>
        <label for="">Username</label>
        <input type="text" name="username" value="<?=$msy['username'];?>"><br>
        <label for="">Password</label>
        <input type="password" name="password" value="<?=$msy['password'];?>"><br>
        <label for="">Telepon</label>
        <input type="text" name="telp" value="<?=$msy['telp'];?>"><br>
        <label for="">Level</label>
        <select name="level" id="">
            <option value="<?=$pts['level'];?>">Pilih</option>
        </select>
        <input type="submit" value="simpan">
    </form>
</body>
</html>
<?php
    }
?>