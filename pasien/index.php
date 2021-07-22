
<?php

    session_start();
    $_SESSION['pesan_ubah_password'] = "";
    if (!$_SESSION['pasien']) {
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
    <h1>Hallo pasien <?php echo "{$_SESSION['pasien']}" ?></h1>

    <?php
    if (isset($_SESSION['mengantri'])) {
        echo "<a href=\"daftarAntrian.php\">Kembali ke antrian</a>";
    }
    else {
        echo "<a href=\"daftarAntrian.php\">daftar antrian terapi</a>";
    }
    ?>
    <a href="profil.php">profil</a>
    <a href="riwayatTerapi.php">riwayat terapi</a>
    <a href="logout.php">logout</a>
</body>
</html>