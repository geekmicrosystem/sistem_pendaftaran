<?php
session_start();
require "js/koneksi.php";


if (isset($_SESSION['username'])) {
    echo "
    <script>
    window.location.href='pilihjurusan.php';
    </script>
    ";
} else {

    $selectkej = "SELECT * FROM kejuruan";
    $kej = mysqli_query($conn, $selectkej);

    if (isset($_POST['submit'])) {

        $username = htmlspecialchars($_POST['username']);
        $password1 = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['repassword']);

        date_default_timezone_set('Asia/jakarta');

        $tanggalpendaftaran = date('Y-m-d');
        // $username = htmlspecialchars($_POST['username']);
        $namalengkap = htmlspecialchars($_POST['name']);
        $tempat_lahir = htmlspecialchars($_POST['tempat-lahir']);
        $tanggal_lahir = htmlspecialchars($_POST['tanggal-lahir']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $nomer_hp = htmlspecialchars($_POST['no-hp']);
        $jenis_kelamin = htmlspecialchars($_POST['kelamin']);
        $asal_sekolah = htmlspecialchars($_POST['asal-sekolah']);
        // $kejuruan = htmlspecialchars($_POST['kejuruan']);

        if ($password1 != $password2) {
            $passwordbeda = true;
        } else {
            $cekusernameakun = "SELECT * FROM akun_siswa WHERE username = '$username'";
            $hasilcek = mysqli_fetch_assoc(mysqli_query($conn, $cekusernameakun));

            $cekusername = "SELECT * FROM calon_siswa WHERE username='$username'";
            $hasilcek2 = mysqli_fetch_assoc(mysqli_query($conn, $cekusername));

            // tampilan jika username sudah ada
            if ($hasilcek && $hasilcek2) {
                $usernamesudahada = true;
            } else {
                
                // inpu password yang sudah di encrypt
                $passwordakhir = htmlspecialchars(password_hash($password1, PASSWORD_DEFAULT));

                // prosses tambah akun
                $data = "INSERT INTO akun_siswa VALUES ('NULL','$username','$passwordakhir')";
                $insert = mysqli_query($conn, $data);

                $data2 = "INSERT INTO calon_siswa 
                        VALUES(NULL,
                            '$tanggalpendaftaran',
                            '$username',
                            '$namalengkap',
                            '$tempat_lahir',
                            '$tanggal_lahir',
                            '$alamat',
                            '$nomer_hp',
                            '$jenis_kelamin',
                            '$asal_sekolah',
                            NULL
                            );";
                
                $daftar = mysqli_query($conn, $data2);


                if ($daftar) {
                    echo "
                            <script>
                            alert('Pendaftaran Siswa Baru Berhasil'),
                            window.location.href='pilihjurusan.php';
                            </script>";
                } else {
                    echo "
                            <script>
                            alert('Pendaftaran Siswa Baru Gagal')</script>";
                }
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

    <title>Registration Page</title>
</head>

<body>
    <!-- <h1>Registrasi</h1> -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/jatim.png" width="" height="50" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">Sistem Pendaftaran Online BLK</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav " style="font-weight: bold;">
                    <a class="nav-link active" href="#">Sistem Pendaftaran Online BLK <span class="sr-only">(current)</span></a>
                    <!-- <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="registrasi.php">Registration</a> -->
                    <!-- <a class="nav-link btn btn-outline-danger" href="js/logout.php">Logout</a> -->
                </div>
                <div class="navbar-nav ml-auto" style="font-weight: bold;">
                    <!-- <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a> -->
                    <!-- <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="registrasi.php">Registration</a> -->
                    <a class="nav-link btn btn-outline-danger" href="index.php">kembali</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card" style="width: 90%; margin:0 auto; margin-top:100px;">
            <div class="card-header" style="margin:0 auto;">
                Halaman Pendaftaran Siswa Baru
                <?php if (isset($usersudahdaftar)) : ?>
                    <br>
                    <small style="color: red;">
                        Akun anda sudah mendaftar
                    </small>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">username</label>
                                <?php if (isset($usernamesudahada)) : ?>

                                    <small id="salah" style="color: red;">username sudah ada!</small>

                                <?php endif ?>
                                <input class="form-control" name="username" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" type="password" required>
                                <?php if (isset($passwordbeda)) : ?>

                                    <small id="salah" style="color: red;">Password Harus Sama!</small>

                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="repassword">re-Password</label>
                                <input class="form-control" name="repassword" type="password" required>
                                <?php if (isset($passwordbeda)) : ?>

                                    <small id="salah" style="color: red;">Password Harus Sama!</small>

                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Masukan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="tempat">Tempat Tanggal Lahir</label>
                                <input type="text" name="tempat-lahir" class="form-control" placeholder="Masukan Tempat Lahir" required>
                            </div>
                        </div>
                        <div class="col-3 align-self-end">
                            <div class="form-group">
                                <input type="date" name="tanggal-lahir" id="tanggal-lahir" class="form-control" placeholder="Pilih tanggal lahir" required >
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" required ></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-6">
                            <label for="no-hp">Nomer Handphone</label>
                            <input name="no-hp" class="form-control" type="text" required >
                        </div>
                        <div class="col-6">
                            <label for="kelamin">Jenis Kelamin</label>
                            <br>
                            <div class="form-check-inline align-self-end">
                                <input class="form-check-input" type="radio" name="kelamin" id="kelamin" value="laki-laki" checked>
                                <label class="form-check-label" for="kelamin">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check-inline align-self-end">
                                <input class="form-check-input" type="radio" name="kelamin" id="kelamin" value="perempuan">
                                <label class="form-check-label" for="kelamin">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-6">
                            <label for="asal-sekolah">Asal Sekolah</label>
                            <input class="form-control" name="asal-sekolah" type="text" required >
                        </div>

                    </div>

                    <br>

                    <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block">Daftar</button>
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
</body>

</html>