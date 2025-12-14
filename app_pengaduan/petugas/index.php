<?php
    include "../koneksi.php";
    $sql = "SELECT * FROM petugas";
    $query = mysqli_query($conn,$sql);
    $no = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas</title>
</head>
<body>
    <h1>Daftar Petugas</h1>
    <a href="../pengaduan/index.php">kembali</a>
    <a href="tambah.php" class="btn btn-primary">tambah</a>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nomor Telepon</th>
            <th>Level</th>
            <th>Opsi</th>
        </tr>
        
        <?php while ($pts = mysqli_fetch_assoc($query)) { ?> 
            <tr>
                <td><?=$no++;?></td>
                <td><?=$pts['nama_petugas'];?></td>
                <td><?=$pts['username'];?></td>
                <td><?=$pts['password'];?></td>
                <td><?=$pts['telp'];?></td>
                <td><?=$pts['level'];?></td>
                <td>
                    <a href="edit.php?id_petugas=<?=$pts['id_petugas'];?>">edit</a>
                    <a href="hapus.php?id_petugas=<?=$pts['id_petugas'];?>">hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>