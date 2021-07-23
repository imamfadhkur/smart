
<?php

include '../koneksi.php';
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
    <title>tambah data admin</title>
</head>
<body>
    
<?php

include 'validasi.php';

if (isset($_POST['submitRegistAdmin'])) {
    
    $cekNama = validasiNama($_POST['nama']);
    $cekPw = cekValidasiPw($_POST['password']);
    $cekPwSama = cekKesamaan($_POST['password'], $_POST['konfirmPassword']);

    $cekIDAdmin = $dbc->prepare("SELECT * FROM admin WHERE NOMOR_PEGAWAI = :id");
    $cekIDAdmin->bindValue(':id',$_POST['nomor_pegawai']);
    $cekIDAdmin->execute();

    $n = $cekIDAdmin->rowCount();
    if ($n > 0) {
        $cekId = "Nomor sudah ada, silahkan ganti yang baru";
    }

    if ($cekNama == false) {
        $cekNamaPasien = "Selain alfabet dan spasi, dilarang";
    }
    if ($cekPw == false) {
        $cekPwH = "Password harus alfanumerik dengan panjang delapan karakter atau lebih";
    }
    if ($cekPwSama == false) {
        $cekPwSamaH = "Password dan konfirmasi password tidak sama";
    }
    if ($cekNama == false) {
        echo "Selain alfabet dan spasi, dilarang";
    }
    if ($cekNama == true && $cekPw == true && $cekPwSama == true && $n == 0) {
        $query=$dbc->prepare("INSERT INTO admin VALUES (:id, SHA2(:password,0), :nama, :alamat, :email, :no_telp)");
        $query->bindValue(':id', $_POST['nomor_pegawai']);
        $query->bindValue(':nama', $_POST['nama']);
        $query->bindValue(':password', $_POST['password']);
        $query->bindValue(':alamat', $_POST['alamat']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':no_telp', $_POST['no_telp']);
        $query->execute();
        
        ?>

            Data admin: <br>
            username: <?php echo "{$_POST['nomor_pegawai']}" ?> <br>
            password: <?php echo "{$_POST['password']}" ?> <br>
            Berhasil ditambahkan.<br><br>

        <?php
    }
    else {
        echo "Kesalahan.";
    }
}

?>

<h2>Registrasi akun admin</h2>
        Lengkapi kolom dibawah ini:

        <form action="tambahDataAdmin.php" method="POST">

    <table>
        <tr>
            <td>ID Pegawai</td>
            <td><input type="text" name="nomor_pegawai" required></td>
            <td><?php if (isset($cekId)) {
                echo $cekId;
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
            <td>Alamat</td>
            <td><input type="text" name="alamat" required></td>
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
            <td><input type="submit" name="submitRegistAdmin"><input type="reset"></td>
        </tr>
    </table>

    </form>
    
    <a href="index.php">kembali</a> ke halaman depan

</body>
</html>