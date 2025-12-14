<?php
    include "../koneksi.php";
    $tgl_pengaduan = date("Y-m-d");
    $nik = $_POST['nik'];
    $isi_laporan = $_POST['isi_laporan'];
    $foto = $_FILES['foto']['name'];
    $direktori = "foto/";
    $foto1 = $_FILES['foto']['tmp_name'];
    $status = 0;
    move_uploaded_file($foto1,$direktori.$foto);
        $sql = "INSERT INTO pengaduan (tgl_pengaduan,nik,isi_laporan,foto,status) VALUE ('$tgl_pengaduan','$nik','$isi_laporan','$foto','$status')";
        $query = mysqli_query($conn,$sql);
        // echo $sql;
        // echo $foto.$direktori;
        if($query){
            header("location:index.php?simpan=berhasil");
        }
        else{
            header("location:index.php?simpan=gagal");
        }
?>