
<?php
    include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>riwayat pasien</title>
</head>
<body>
    <form action="riwayatPasien.php" method="POST">
        pilih pasien yang akan anda lihat <br>
        <select name="pasien" id="pasien">
            <option disabled selected>nama (id)</option>
            <?php
                $query = $dbc->prepare("SELECT * FROM pasien");
                $query->execute();

                foreach ($query as $key) {
                    echo "<option value=\"{$key['ID_PASIEN']}\">{$key['NAMA_PASIEN']} ({$key['ID_PASIEN']})</option>";
                }
            ?>
        </select> <br>
        <input type="submit" name="submitDataCari" value="lihat data">
    </form>

    <?php
        if (isset($_POST['submitDataCari'])) {
            $query = $dbc->prepare("SELECT * FROM antrian WHERE ID_PASIEN = :ipa");
            $query->bindValue(':ipa',$_POST['pasien']);
            $query->execute();

            ?>
            <table border="1">
                <tr>
                    <td>No.</td>
                    <td>ID Pasien</td>
                    <td>Nama Pasien</td>
                    <td>Penyakit</td>
                    <td>Dokter Pemeriksa</td>
                    <td>Tanggal dan Waktu</td>
                </tr>
            <?php
            $i = 1;
            foreach ($query as $key) {
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $key['ID_PASIEN'] ?></td>
                        <td><?php
                            $kueri = $dbc->prepare("SELECT * FROM pasien WHERE ID_PASIEN = :ipa");
                            $kueri->bindValue(':ipa',$key['ID_PASIEN']);
                            $kueri->execute();
                            foreach ($kueri as $keyA) {
                                echo $keyA['NAMA_PASIEN'];
                            }
                        ?></td>
                        <td><?php
                            $kueri = $dbc->prepare("SELECT * FROM penyakit WHERE ID_PENYAKIT = :ipa");
                            $kueri->bindValue(':ipa',$key['ID_PENYAKIT']);
                            $kueri->execute();
                            foreach ($kueri as $keyA) {
                                echo $keyA['NAMA_PENYAKIT'];
                            }
                        ?></td>
                        <td><?php
                            $kueri = $dbc->prepare("SELECT * FROM dokter WHERE ID_DOKTER = :ipa");
                            $kueri->bindValue(':ipa',$key['ID_DOKTER']);
                            $kueri->execute();
                            foreach ($kueri as $keyA) {
                                echo $keyA['NAMA_DOKTER'];
                            }
                        ?></td>
                        <td><?php echo $key['TGL']." ".$key['WAKTU'] ?></td>
                    </tr>
                <?php
                $i += 1;
            }
            if (!isset($keyA)) {
                ?>
                <tr>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                </tr>
                <?php
            }
        }
    ?>
</table>

<a href="index.php">kembali </a>ke halaman depan

</body>
</html>