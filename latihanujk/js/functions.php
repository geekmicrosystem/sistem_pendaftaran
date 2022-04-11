<?php

require "koneksi.php";

function cek_siswa ($datarekap,$username)
{
    global $conn;

    if($datarekap['id_kejuruan'] != NULL){
        echo"
        <script>
        alert('Anda Sudah Mendaftar Pelatihan, Tidak Bisa Diganti! ! !')
        </script>
        ";
    } else {
        $kejuruan_id = $_POST['kejuruan'];

        $daftarkejuruan = mysqli_query($conn,"UPDATE calon_siswa SET id_kejuruan = '$kejuruan_id' WHERE calon_siswa.username ='$username';");

        if($daftarkejuruan){
            echo "<script>
            alert('Anda Berhasil Mendaftar Pelatihan! ! !')
            </script>";
        }else{
            echo "<script>
            alert('Pendaftaran Pelatihan GAGAL! ! !')
            </script>";
        }
    }
}

?>