<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
   
</head>
<body>
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <div class="card p-5">
    <h1 class="text-center"><strong>Login</strong></h1>
    <br>
    <br>
    <br>

    <form action="proses_login.php" method="post">
        <label for="">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" id="" class="form-control" required>
        <div id="emailHelp" class="form-text">Username bebas, tidak harus nama asli</div><br>
        
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Masukkan Password" id="" class="form-control" required>
        
        <br>
        <br>
        <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label" for="exampleCheck1" required>I'm not robot</label>

        </div>
        <input type="submit" value="Login" class="btn btn-info form-control" > 
    </form>
    
    </div>
    </div>
</body>
</html>