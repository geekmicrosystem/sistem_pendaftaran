<?php
session_start();
require"js/koneksi.php";

$username = $_SESSION['username']  ;
$rekap= "SELECT calon_siswa.*, kejuruan.nama_kejuruan namakej FROM calon_siswa JOIN kejuruan ON calon_siswa.id_kejuruan=kejuruan.id WHERE calon_siswa.username='$username'";

$hasilrekap = mysqli_query($conn,$rekap);
// var_dump($hasilrekap);
// die;
$datarekap = mysqli_fetch_assoc($hasilrekap);

 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>rekap Pendaftaran</title>
  </head>
  <body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/jatim.png" width="" height="50" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto" style="font-weight: bold;">
                    <a class="nav-link active" href="#">Sistem Pendaftaran Online BLK<span class="sr-only">(current)</span></a>
                     <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="registrasi.php">Registration</a>
                    <a class="nav-link btn btn-outline-danger" href="js/logout.php">Logout</a>
                    
                </div>
            </div>
        </div>
    </nav>

  <div class="container-fluid">
        <div class="card" style="width: 90%; margin:0 auto; margin-top:100px;">
            <div class="card-header style="margin:0 auto;"">
               <center><h1> Rekap Data Pendaftaran</h1></center>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-6 offset-md-3">
                        <center><label for="username">USERNAME</label></center>
                        <input class="form-control" name="username" type="text" value="<?= $datarekap['username'];?>" disabled>
                    </div>
                </div>
                
                <br>

                <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" >Nama Lengkap</label>
                                <input name="name" type="text" class="form-control" id="name" value="<?= $datarekap['nama_siswa'];?> " disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="tempat">Tempat Lahir</label>
                                <input type="text" name="tempat-lahir" class="form-control" value="<?= $datarekap['tempat_lahir'];?>" disabled>
                            </div>
                        </div>
                        <div class="col-3 align-self-end">
                            <div class="form-group">
                                <label for="tanggal-lahir">Tanggal Lahir</label>
                                <input type="text" name="tanggal-lahir" id="tanggal-lahir" class="form-control" value="<?= $datarekap['tanggal_lahir'];?>" disabled>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" disabled><?= $datarekap['alamat'];?></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-6">
                            <label for="no-hp">Nomer Handphone</label>
                            <input name="no-hp" class="form-control" type="text" value="<?= $datarekap['hp'];?>" disabled>
                        </div>
                        <div class="col-6">
                            <label for="kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control" value="<?= $datarekap['kelamin'];?>" disabled>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-6">
                            <label for="asal-sekolah">Asal Sekolah</label>
                            <input class="form-control" name="asal-sekolah" type="text" value="<?= $datarekap['asal_sekolah'];?>" disabled>
                        </div>
                        <div class="col-6">
                            <label for="kejuruan">Kejuruan</label>
                            <input type="text" class="form-control" value="<?= $datarekap['namakej'];?>" disabled>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

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
  </body>
</html>

