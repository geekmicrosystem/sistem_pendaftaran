<?php
session_start();
require"js/koneksi.php";


if(isset($_SESSION['username'])){
    echo "<script>window.location.href='pendaftaran.php';</script>";
}


if(isset($_POST['submit'])){
    $username = htmlspecialchars($_POST['username']);
    $password1= htmlspecialchars($_POST['password']);
    $password2= htmlspecialchars($_POST['repassword']);
    // $cek = $username.''.$password1.''.$password2;


    if($password1!=$password2){
        $passwordbeda= true;
    }else{
        $sql = "SELECT * FROM akun_siswa WHERE username='$username'";
        $akun= mysqli_fetch_assoc(mysqli_query($conn,$sql));
        

        if($akun){
            if(password_verify($password1,$akun['password'])){
                $_SESSION['username'] = "$username";
                // var_dump($akun);
                // die;
                echo"
                <script>
                window.location.href='pendaftaran.php';
                </script>
                ";
            }else{
                $salah = true;
            }
        }
    }
}
 ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Css -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login Page</title>
</head>

<body>
    <!-- <h1>Registrasi</h1> -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/jatim.png" width="" height="50" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav" style="font-weight: bold;">
                    <a class="nav-link active" href="#">Sistem Pendaftaran Online BLK<span class="sr-only">(current)</span></a>
                     <!-- <a class="nav-link" href="login.php">Login</a> -->
                    <!-- <a class="nav-link" href="registrasi.php">Registration</a> -->
                </div>
                <div class="navbar-nav ml-auto" style="font-weight: bold;">
                    <!-- <a class="nav-link active" href="#">Sistem Pendaftaran Online BLK<span class="sr-only">(current)</span></a> -->
                     <!-- <a class="nav-link" href="login.php">Login</a> -->
                    <a class="nav-link btn btn-success" href="pendaftaran.php">Pendaftaran</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card" style="width: 25rem; margin:0 auto; margin-top:15%;">
            <div class="card-header" style="margin:0 auto;">
                Login Page
                <?php if(isset($salah)): ?> 
                        
                            <small id="salah" style="color: red;" >Username atau Password Salah!</small> 
                        
                        <?php endif ?>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" type="text" class="form-control" id="username" >
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <?php if(isset($passwordbeda)): ?> 
                        
                            <small id="salah" style="color: red;" >Password Harus Sama!</small> 
                        
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="repassword">Re-Password</label>
                        <input name="repassword" type="password" class="form-control" id="repassword">
                        <?php if(isset($passwordbeda)): ?> 
                        
                            <small id="salah" style="color: red;" >Password Harus Sama!</small> 
                        
                        <?php endif ?>
                    </div>
                    <!-- <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->

    <?php 
    
    $conn = mysqli_connect($hostname, $username, $password, $db);
    ?>

</body>

</html>