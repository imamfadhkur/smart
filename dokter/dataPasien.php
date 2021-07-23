
<?php
    include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data pasien</title>
</head>
<body>
    <form action="dataPasien.php" method="POST">
        Masukkan nama atau id pasien
        <input type="text" name="nameOrId"> <br>
        <input type="submit" name="cariDataPasien" value="cari">
    </form>

    <?php
        if (isset($_POST['cariDataPasien'])) {
            $query = $dbc->prepare("SELECT * FROM pasien WHERE ID_PASIEN LIKE concat('%', :ni, '%') OR NAMA_PASIEN LIKE concat('%', :ni, '%')");
            $query->bindValue(':ni',$_POST['nameOrId']);
            $query->execute();

            $n = $query->rowCount();
            if ($n > 0) {
                foreach ($query as $key) {
                    ?>
                    <table>
                        <tr>
                            <td>ID Pasien</td>
                            <td>: <?php echo "{$key['ID_PASIEN']}" ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>: <?php echo "{$key['NAMA_PASIEN']}" ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: <?php echo "{$key['ALAMAT']}" ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: <?php echo "{$key['EMAIL_PASIEN']}" ?></td>
                        </tr>
                        <tr>
                            <td>No. Telp.</td>
                            <td>: <?php echo "{$key['NO_TELP']}" ?></td>
                        </tr>
                    </table>
                    <?php
                }
            }
        }
    ?>

    <a href="index.php">kembali </a>ke halaman depan.

</body>
</html>