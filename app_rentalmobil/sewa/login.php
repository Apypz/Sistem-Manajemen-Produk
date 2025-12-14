<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>Document</title>
</head>
<body>

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <div class="card p-5">
    <h1 class="text-center">Login</h1>
    <form action="proses_login.php" method="post">
       
            
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" id="" class="form-control" placeholder="Masukkan Username" required>
           
            <br>
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" id="" class="form-control" placeholder="Masukkan Password" required>
           
        <br>
     
        <button type="submit" class="btn btn-primary text-center">Login</button>
    </form>
    </div>
</div>
</body>
</html>