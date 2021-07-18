
<?php

    session_start();
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
    <h1>Selamat datang <?php echo "{$_SESSION['pasien']}" ?></h1>

    <a href="profil.php">profil</a>
    <br>
    <br>
    <a href="logout.php">logout</a>
</body>
</html>