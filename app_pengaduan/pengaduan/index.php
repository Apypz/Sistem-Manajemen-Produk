<?php
    include "../koneksi.php";
    $sql = "SELECT * FROM pengaduan";
    $query = mysqli_query($conn,$sql);
    $no = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</nav>
<body>
    <div class="container">
    <h1 align="center">Daftar Pengaduan</h1>
    <a href="tambah.php">tambah</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Tanggal Pengaduan</th>
            <th>NIK</th>
            <th>Isi Laporan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Opsi</th>
        </tr>
        <?php while($pd = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?=$pd['tgl_pengaduan'];?></td>
                <td><?=$pd['nik'];?></td>
                <td><?=$pd['isi_laporan'];?></td>
                <td><img src="foto/<?=$pd['foto'];?>" alt=""></td>
                <td><?=$pd['status'];?></td>
                <td>
                    <a href="edit.php?id=<?=$pd['id_pengaduan'];?>">edit</a>
                    <a href="hapus.php?id=<?=$pd['id_pengaduan'];?>">hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>