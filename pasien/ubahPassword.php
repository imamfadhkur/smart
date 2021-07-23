<?php

include '../koneksi.php';
session_start();
$_SESSION['pesan_ubah_password'] = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>profile</title>
<style>
    .sukses{
        color: green;
        font-style: italic;
    }
</style>
</head>
<body>

<script>
function showPassword() {
    var x = document.getElementById("password");
    var y = document.getElementById("passwordBaru");
    var z = document.getElementById("konfirmPassword");
    
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
    
    if (z.type === "password") {
        z.type = "text";
    } else {
        z.type = "password";
    }
}
</script>

<?php
function cekPW($pw,$db,$id){
    $query = $db->prepare("SELECT * FROM pasien WHERE ID_PASIEN = :id AND PASSWORD = SHA2(:password,0)");
    $query->bindValue(':id',$id);
    $query->bindValue(':password',$pw);
    $query->execute();
    $cek = false;
    if ($query->rowCount()>0) {
        $cek = true;
    }
    return $cek;
}

function cekKesamaan($pw1, $pw2){
    $hasil = false;
    if ($pw1 == $pw2) {
        $hasil = true;
    }
    return $hasil;
}

function cekValidasiPw($pw2){
    $error = true;
    $alpha = "/[a-zA-Z]/"; //Alfabet
		$num = "/[0-9]/"; //Numerik
		$antisimbol = "/^[a-zA-Z0-9]+$/"; //Selain karakter yang ada pada pattern ini akan invalid
		if(!(preg_match($alpha, $pw2) && preg_match($num, $pw2) && preg_match($antisimbol, $pw2)) || strlen($pw2) < 8){
			$error = false; //Password harus mengandung alfanumerik tanpa simbol satupun dan minimal panjang harus 8 karakter
		}
        return $error;
}

if (isset($_POST['submitUpdate'])) {

    $cekPass = cekPW($_POST['password'],$dbc,$_SESSION['id_pasien']);
    $cekKesamaan = cekKesamaan($_POST['passwordBaru'], $_POST['konfirmPassword']);
    $cekValidasi = cekValidasiPw($_POST['passwordBaru']);
    
    if ($cekPass == false) {
        $_SESSION['pesan_ubah_password'] = "Password lama anda salah.";
    }
    
    elseif($cekValidasi == false) {
        $_SESSION['pesan_ubah_password'] = "Password harus alfanumerik dengan panjang delapan karakter atau lebih";
    }
    
    elseif($cekKesamaan == false) {
        $_SESSION['pesan_ubah_password'] = "Password anda tidak sama.";
    }

    elseif ($cekPass == true && $cekKesamaan == true && $cekValidasi && $cekValidasi == true) {
        $query = $dbc->prepare("UPDATE pasien SET PASSWORD = SHA2(:password,0) WHERE pasien.ID_PASIEN = :id_asal");
        $query->bindValue(':id_asal', $_SESSION['id_pasien']);
        $query->bindValue(':password', $_POST['passwordBaru']);
        $query->execute();

        $_SESSION['pesan_ubah_password'] = "Password berhasil dirubah";
        header("Location: profil.php");
        exit();
    }
    
    else {
        $_SESSION['pesan_ubah_password'] = "Kesalahan.";
    }

}

    echo "{$_SESSION['pesan_ubah_password']}";
    ?>

    <form action="ubahPassword.php" method="POST">
    <table>
        <tr>
            <td>Password lama</td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
            <td>Password baru</td>
            <td><input type="password" name="passwordBaru" id="passwordBaru" required></td>
        </tr>
        <tr>
            <td>Konfirmasi password baru</td>
            <td><input type="password" name="konfirmPassword" id="konfirmPassword" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" onclick="showPassword()">Lihat Password</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitUpdate" value="update"><input type="reset" value="reset"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="batal" name="batal"></td>
        </tr>
    </table>
    </form>

</body>
</html>