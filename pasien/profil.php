
<?php

    include '../koneksi.php';
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <style>
        .sukses{
            color: green;
            font-style: italic;
        }
    </style>
</head>
<body>


<?php
        echo "<div>Hallo {$_SESSION['pasien']}, berikut adalah profile kamu.</div>";
        $query = $dbc->prepare("SELECT * FROM pasien WHERE ID_PASIEN = :id");
        $query->bindValue(':id', $_SESSION['id_pasien']);
        $query->execute();
        
        
        foreach ($query as $key) {
            ?>

            <table>
                <tr>
                    <td>ID</td>
                    <td>: <?php echo "{$key['ID_PASIEN']}"; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: <?php echo "{$key['NAMA_PASIEN']}"; ?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>: ********</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <?php echo "{$key['NIK']}"; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo "{$key['ALAMAT']}"; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?php echo "{$key['EMAIL_PASIEN']}"; ?></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>: <?php echo "{$key['NO_TELP']}"; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="ubahPassword.php">rubah password</a></td>
                </tr>
            </table>

            <a href="index.php">home</a> <br>

            <?php
            echo "{$_SESSION['pesan_ubah_password']}";
        }
?>

</body>
</html>