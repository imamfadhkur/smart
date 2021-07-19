<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login pasien</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
<?php

include "koneksi.php";

    ?>

    <form action="loginPasien.php" method="POST">
        <label for="username">ID Pasien</label>
        <input type="text" name="username"> <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit_login_pasien" value="login">
        <input type="reset" value="reset">
        <br>
        <br>
        <Label for="registrasi">Anda tidak punya akun?</Label>
        <a href="registrasi.php">Hubungi admin.</a>
    </form>
    
    <?php

if (isset($_POST['submit_login_pasien'])) {

    $query=$dbc->prepare("SELECT * FROM pasien WHERE ID_PASIEN = :id AND PASWORD = SHA2(:password,0)");
    $query->bindValue(':id', $_POST['username']);
    $query->bindValue(':password', $_POST['password']);
	$query->execute();

    $sesi = "";
    $id_sesi = "";
    foreach ($query as $key) {
        $sesi = $key['NAMA_PASIEN'];
        $id_sesi = $key['ID_PASIEN'];
    }

    if ($query->rowCount()>0) {
        session_start();
        $_SESSION['pasien'] = $sesi;
        $_SESSION['id_pasien'] = $id_sesi;
        $_SESSION['password_pasien'] = $_POST['password'];
        header('Location: pasien/index.php');
        exit();
    }
    else {
        echo "Username atau password salah";
    }
}

?>

<br>
Bukan pasien? <a href="index.php">home</a>
</body>
</html>