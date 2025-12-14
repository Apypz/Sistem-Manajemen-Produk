<?php
    include "../koneksi.php";
    $sql = "SELECT *,pengaduan.id_pengaduan, pengaduan.isi_laporan, pengaduan.foto, tanggapan.tanggapan, tanggapan.tgl_tanggapan, status FROM pengaduan
            LEFT JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_tanggapan";
    $query = mysqli_query($conn,$sql);
    $no = 1;
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
    <div class="container">
    <h1 align="center">Daftar Tanggapan</h1>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Isi Laporan</th>
            <th>Foto</th>
            <th>Tanggapan</th>
            <th>Tanggal Tanggapan</th>
            <th>Status</th>
            <th>Opsi</th>
        </tr>
        <?php while($pd = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?=$pd['isi_laporan'];?></td>
                <td><img src="../pengaduan/foto/<?=$pd['foto'];?>" alt=""></td>
                <td><?=$pd['tanggapan'];?></td>
                <td><?=$pd['tgl_tanggapan'];?></td>
                <td><?=$pd['status'];?></td>
                <td>
                    <a href="tanggapi.php?id=<?=$pd['id_pengaduan'];?>">tanggapi</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>