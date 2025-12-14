<?php
    include "../koneksi.php";
    $sql = "SELECT * FROM masyarakat";
    $query = mysqli_query($conn,$sql);
    $no = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masyarakat</title>
</head>
<body>
    <h1>Daftar Masyarakat</h1>
    <a href="../index.php">kembali</a>
    <a href="tambah.php">tambah</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Nama Masyarakat</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nomor Telepon</th>
            <th>Opsi</th>
        </tr>
        <?php while ($msy = mysqli_fetch_assoc($query)) { ?> 
            <tr>
                <td><?=$no++;?></td>
                <td><?=$msy['nik'];?></td>
                <td><?=$msy['nama'];?></td>
                <td><?=$msy['username'];?></td>
                <td><?=$msy['password'];?></td>
                <td><?=$msy['telp'];?></td>
                <td>
                    <a href="edit.php?nik=<?=$msy['nik'];?>">edit</a>
                    <a href="hapus.php?nik=<?=$msy['nik'];?>">hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>