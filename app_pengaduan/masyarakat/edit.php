<?php
    include "../koneksi.php";
    $nik = $_GET['nik'];
    $sql = "SELECT * FROM masyarakat WHERE nik = '$nik'";
    $query = mysqli_query($conn,$sql);
    while($msy = mysqli_fetch_assoc($query))
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
        
        <input type="hidden" name="nik" value="<?=$msy['nik'];?>"><br>
        <label for="">Nama</label>
        <input type="text" name="nama" value="<?=$msy['nama'];?>"><br>
        <label for="">Username</label>
        <input type="text" name="username" value="<?=$msy['username'];?>"><br>
        <label for="">Password</label>
        <input type="password" name="password" value="<?=$msy['password'];?>"><br>
        <label for="">Telepon</label>
        <input type="text" name="telp" value="<?=$msy['telp'];?>"><br>
        <input type="submit" value="simpan">
    </form>
</body>
</html>
<?php
    }
?>