<?php
    include "../koneksi.php";
    $id_pengaduan = $_GET['id'];
    $sql = "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
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
    <title>Document</title>
</head>
<body>
    <h1>Form Tanggapi</h1>
    <form action="p_tanggapi" method="post">
        <label for=""></label>
    </form>
</body>
</html>
<?php
    }
?>