
<?php

session_start();
if (!$_SESSION['admin']) {
    header('Location: ../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data dokter</title>
</head>
<body>
    
<?php

include 'validasi.php';

if (isset($_POST['submitRegistDokter'])) {

    $cekNama = validasiNama($_POST['nama']);
    $cekPw = cekValidasiPw($_POST['password']);
    $cekPwSama = cekKesamaan($_POST['password'], $_POST['konfirmPassword']);

    if ($cekNama == false) {
        $cekNamaPasien = "Selain alfabet dan spasi, dilarang";
    }
    if ($cekPw == false) {
        $cekPwH = "Password harus alfanumerik dengan panjang delapan karakter atau lebih";
    }
    if ($cekPwSama == false) {
        $cekPwSamaH = "Password dan konfirmasi password tidak sama";
    }
    }
    if (!isset($_POST['spesialis'])) {
        $cekSpesialis = "Harus memilih spesialis";
    }
    elseif ($cekNama == true && $cekPw == true && $cekPwSama == true) {
        $query=$dbc->prepare("INSERT INTO dokter VALUES (:id, :id_spesialis, SHA2(:password,0), :nama, :email, :no_telp)");
        $query->bindValue(':id', $_POST['id']);
        $query->bindValue(':id_spesialis', $_POST['spesialis']);
        $query->bindValue(':password', $_POST['password']);
        $query->bindValue(':nama', $_POST['nama']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':no_telp', $_POST['no_telp']);
        $query->execute();
        
        ?>

            Data dokter: <br>
            username: <?php echo "{$_POST['id']}" ?> <br>
            password: <?php echo "{$_POST['password']}" ?> <br>
            Berhasil ditambahkan.<br><br>

        <?php
    }
    else {
        echo "Kesalahan.";
    }

?>

<h2>Registrasi akun dokter</h2>
        Lengkapi kolom dibawah ini:

        <form action="tambahDataDokter.php" method="POST">

    <table>
        <tr>
            <td>ID Dokter</td>
            <td><input type="text" name="id" required></td>
        </tr>
        <tr>
            <td>Spesialis</td>
            <td>
                <select name="spesialis" id="spesialis" required>
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
            <td><?php if (isset($cekSpesialis)) {
                echo $cekSpesialis;
            } ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
            <td><?php if (isset($cekNamaPasien)) {
                echo $cekNamaPasien;
            } ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" required></td>
            <td><?php if (isset($cekPwH)) {
                echo $cekPwH;
            } ?></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td><input type="password" name="konfirmPassword" required></td>
            <td><?php if (isset($cekPwSamaH)) {
                echo $cekPwSamaH;
            } ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" required></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td><input type="text" name="no_telp" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitRegistDokter"><input type="reset"></td>
        </tr>
    </table>

    </form>

    <a href="index.php">Kembali </a>ke halaman depan

</body>
</html>