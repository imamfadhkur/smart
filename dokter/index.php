
<?php

    session_start();
    if (!$_SESSION['dokter']) {
        header("Location: ../index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pasien</title>
</head>
<body>
    <h1>Selamat datang dokter <?php echo "{$_SESSION['dokter']}" ?></h1>
    <a href="dataPasien.php">lihat data pasien</a> <br>
    <a href="jadwalTerapi.php">lihat jadwal terapi</a> <br>
    <a href="riwayatPasien.php">lihat riwayat pasien</a> <br>
    <a href="logout.php">logout</a>
</body>
</html>