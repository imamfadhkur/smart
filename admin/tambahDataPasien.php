
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
    <title>tambah data pasien</title>
</head>
<body>
    
<?php

include 'validasi.php';

    if (isset($_POST['submitRegistPasien'])) {

        $cekNama = validasiNama($_POST['nama']);
        $cekNIK = cekNik($_POST['nik']);
        $cekPw = cekValidasiPw($_POST['password']);
        $cekPwSama = cekKesamaan($_POST['password'], $_POST['konfirmPassword']);

        if ($cekNama == false) {
            $cekNamaPasien = "Selain alfabet dan spasi, dilarang";
        }
        if ($cekNIK == false) {
            $cekNIKH = "Panjang NIK harus 16 digit";
        }
        if ($cekPw == false) {
            $cekPwH = "Password harus alfanumerik dengan panjang delapan karakter atau lebih";
        }
        if ($cekPwSama == false) {
            $cekPwSamaH = "Password dan konfirmasi password tidak sama";
        }
        if ($cekNama == true && $cekNIK == true && $cekPw == true && $cekPwSama == true) {
            $id_pasien = 0;
            $cek = $dbc->prepare("SELECT COUNT(*) as total FROM pasien");
            $cek->execute();
            foreach ($cek as $key) {
                if ($key['total'] == 0) {
                    $id_pasien = 1;
                }
                else {
                    $id_pasien = $key['total'] + 1;
                }
            }
            $query=$dbc->prepare("INSERT INTO pasien VALUES (:id_pasien, :nama_pasien, SHA2(:password,0), :nik, :alamat, :email, :no_telp)");
            $query->bindValue(':id_pasien', $id_pasien);
            $query->bindValue(':nama_pasien', $_POST['nama']);
            $query->bindValue(':password', $_POST['password']);
            $query->bindValue(':nik', $_POST['nik']);
            $query->bindValue(':alamat', $_POST['alamat']);
            $query->bindValue(':email', $_POST['email']);
            $query->bindValue(':no_telp', $_POST['no_telp']);
            $query->execute();
            
            ?>
    
                Data pasien: <br>
                username: <?php echo "{$id_pasien}" ?> <br>
                password: <?php echo "{$_POST['password']}" ?> <br>
                Berhasil ditambahkan.<br><br>
    
            <?php
        }
    }

    ?>
        
        <h2>Registrasi akun pasien</h2>
        Lengkapi kolom dibawah ini:

        <form action="tambahDataPasien.php" method="POST">

    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
            <td><?php if (isset($cekNamaPasien)) {
                echo $cekNamaPasien;
            } ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat" required></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td><input type="text" name="nik" required></td>
            <td><?php if (isset($cekNIKH)) {
                echo $cekNIKH;
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
            <td><input type="submit" name="submitRegistPasien"><input type="reset"></td>
        </tr>
    </table>

    </form>

    
    <a href="index.php">kembali</a> ke halaman depan
    
</body>
</html>