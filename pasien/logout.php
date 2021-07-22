<?php

    include '../koneksi.php';
    ini_set('date.timezone', 'Asia/Jakarta');
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
    <title>logout</title>
</head>
<body>
    
    <?php
    if (isset($_SESSION['mengantri'])) {
        echo "anda logout sama dengan membatalkan antrian.<br>";
    }
    ?>

    <h3>Apakah anda yakin ingin logout?</h3>
    <form action="logout.php" method="POST">
        <input type="submit" value="ya" name="ya">
        <input type="submit" value="tidak" name="tidak">
    </form>

    <?php

    function menyelesaikanAntrian($db){
        if (isset($_SESSION['mengantri'])) {
            $query = $db->prepare("UPDATE antrian SET ID_DETIL_ANTRIAN = '1' WHERE antrian.NOMOR_ANTRIAN = :sesi AND antrian.TGL = :tgl");
            $query->bindValue(':sesi',$_SESSION['mengantri']);
            $query->bindValue(':tgl',date("Y-m-d"));
            $query->execute();
            unset($_SESSION['mengantri']);
            unset($_SESSION['poli']);
        }
    }

        if (isset($_POST['ya'])) {
            menyelesaikanAntrian($dbc);
            unset($_SESSION['password_pasien']);
            unset($_SESSION['id_pasien']);
            unset($_SESSION['pesan_ubah_password']);
            unset($_SESSION['pasien']);
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