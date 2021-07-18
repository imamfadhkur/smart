

<?php

include "../koneksi.php";

    function validasiForm($field){
        if ($field == 'benar') {
            $hasil = true;
        }
        else {
            $hasil = false;
        }
        return $hasil;
    }

        include 'tambahDataPasien.php';

        include 'tambahDataDokter.php';

        include 'tambahDataAdmin.php';

    ?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <style>
        .label{
            width: 200px;
        }
    </style>
</head>
<body>
    
    <?php

    if (isset($_POST['pasien'])) {
        ?>
        
        <h2>Registrasi akun pasien</h2>
        Lengkapi kolom dibawah ini:

        <form action="registrasi.php" method="POST">

    <table>
        <tr>
            <td>ID Pasien</td>
            <td><input type="text" name="id_pasien" required></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat"></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td><input type="text" name="nik" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td><input type="password" name="konfirmPassword" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td><input type="text" name="no_telp"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitRegistPasien"><input type="reset"></td>
        </tr>
    </table>

    </form>

    <?php
    }

    ?>



<?php

    if (isset($_POST['dokter'])) {
        ?>
        
        <h2>Registrasi akun dokter</h2>
        Lengkapi kolom dibawah ini:

        <form action="registrasi.php" method="POST">

    <table>
        <tr>
            <td>ID Dokter</td>
            <td><input type="text" name="id" required></td>
        </tr>
        <tr>
            <td>Spesialis</td>
            <td>
                <select name="spesialis" id="spesialis">
                    <option disabled selected>pilih spesialis</option>
                    <?php
                        $query = $dbc->prepare("SELECT * FROM spesialis");
                        $query->execute();
                        foreach ($query as $key) {
                            echo "<option value=\"{$key['ID_SPESIALIS']}\">{$key['SPESIALIS']}</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td><input type="password" name="konfirmPassword" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td><input type="text" name="no_telp"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitRegistDokter"><input type="reset"></td>
        </tr>
    </table>

    </form>

    <?php
    }

    // form tambah admin
    if (isset($_POST['admin'])) {
        ?>
        
        <h2>Registrasi akun admin</h2>
        Lengkapi kolom dibawah ini:

        <form action="registrasi.php" method="POST">

    <table>
        <tr>
            <td>ID Pegawai</td>
            <td><input type="text" name="nomor_pegawai" required></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td><input type="password" name="konfirmPassword" required></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td><input type="text" name="no_telp"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitRegistAdmin"><input type="reset"></td>
        </tr>
    </table>

    </form>

    <?php
    }

    ?>

    <a href="index.php">kembali</a> ke halaman depan

</body>
</html>