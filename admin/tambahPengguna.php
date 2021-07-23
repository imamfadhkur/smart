
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
    <div>Hallo admin <?php echo "{$_SESSION['admin']}" ?>, pilih pengguna baru yang ingin ditambahkan ya</div>

    <a href="tambahDataPasien.php">tambah data pasien</a> <br>
    <a href="tambahDataAdmin.php">tambah data admin</a> <br>
    <a href="tambahDataDokter.php">tambah data dokter</a>

    <br><br>

    <a href="logout.php">logout</a>
</body>
</html>