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
    <title>logout</title>
</head>
<body>
    <h3>Apakah anda yakin ingin logout?</h3>
    <form action="logout.php" method="POST">
        <input type="submit" value="ya" name="ya">
        <input type="submit" value="tidak" name="tidak">
    </form>

    <?php

        if (isset($_POST['ya'])) {
            unset($_SESSION['dokter']);
            header('Location: ../index.php');
            exit();
        }
        elseif (isset($_POST['tidak'])) {
            header("Location: index.php");
            exit();
        }

    ?>

</body>
</html>