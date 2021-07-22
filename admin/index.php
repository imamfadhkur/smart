
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
    <title>admin</title>
</head>
<body>
    <div>Selamat datang admin <?php echo "{$_SESSION['admin']}" ?>, semangat untuk hari ini.</div>

    <a href="tambahPengguna.php">tambah pengguna baru</a>
    <br>
    <?php
    if (isset($_SESSION['antrian'])) {
        echo "<a href=\"antrian.php\">kembali ke antrian</a>";
    }
    else {
        echo "<a href=\"antrian.php\">mulai antrian</a>";
    }
    ?>
    <br>
    <a href="logout.php">logout</a>
</body>
</html>