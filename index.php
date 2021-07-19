<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>home</title>
</head>
<body>

    <h1>Selamat Datang di SMART</h1>
    <p>Sistem Antrian Terapi</p>

    <?php

    if (isset($_POST['dokter'])) {
            include 'loginDokter.php';
    }
    
    elseif (isset($_POST['pasien'])) {
        include 'loginPasien.php';
    }
    
    elseif (isset($_POST['admin'])) {
        include 'loginAdmin.php';
    }

    else {
        ?>

    <form action="index.php" method="POST">
        <h3>Silahkan Login Sesuai Akun Anda</h3>
        <input type="submit" value="pasien" name="pasien"> <br>
        <input type="submit" value="admin" name="admin"> <br>
        <input type="submit" value="dokter" name="dokter">
    </form>

        <?php
    }

    ?>

</body>
</html>