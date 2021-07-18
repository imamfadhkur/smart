
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
    <h1>Selamat datang <?php echo "{$_SESSION['admin']}" ?></h1>

    <form action="registrasi.php" method="POST">
        <input type="submit" value="tambah akun pasien" name="pasien">
        <input type="submit" value="tambah akun admin" name="admin">
        <input type="submit" value="tambah akun dokter" name="dokter">
    </form>

    <br><br>

    <a href="logout.php">logout</a>
</body>
</html>