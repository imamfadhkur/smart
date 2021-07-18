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

    <h3>Silahkan Login</h3>

    <form action="index.php" method="POST">
        <input type="submit" value="pasien" name="pasien">
        <input type="submit" value="admin" name="admin">
        <input type="submit" value="dokter" name="dokter">
    </form>

    <br>
    
    <?php
        include 'login.php';
    ?>
    
</body>
</html>