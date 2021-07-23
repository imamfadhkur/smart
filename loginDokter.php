<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login dokter</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
<?php

include "koneksi.php";

    ?>

<form action="loginDokter.php" method="POST">
        <label for="username">ID Dokter</label>
        <input type="text" name="username"> <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit_login_dokter" value="login">
        <input type="reset" value="reset">
        <br>
    </form>

    <?php

if (isset($_POST['submit_login_dokter'])) {

    $query=$dbc->prepare("SELECT * FROM dokter WHERE ID_DOKTER = :id AND PASSWORD = SHA2(:password,0)");
    $query->bindValue(':id', $_POST['username']);
    $query->bindValue(':password', $_POST['password']);
	$query->execute();

    $sesi = "";
    foreach ($query as $key) {
        $sesi = $key['NAMA_DOKTER'];
    }

    if ($query->rowCount()>0) {
        session_start();
        $_SESSION['dokter'] = $sesi;
        header('Location: dokter/index.php');
        exit();
    }
    else {
        echo "Username atau password salah";
    }
}

?>
<br>
Bukan dokter? <a href="index.php">home</a>
</body>
</html>