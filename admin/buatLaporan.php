
<?php

    include '../koneksi.php';

    function penyakit($db,$penyakit){
        $id = 0;
        $query = $db->prepare("SELECT * FROM penyakit WHERE NAMA_PENYAKIT = :nama");
        $query->bindValue(':nama',$penyakit);
        $query->execute();
        $n = $query->rowCount();
        if ($n > 0) {
            foreach ($query as $key) {
                $id = $key['ID_PENYAKIT'];
            }
        }
        else {
            $query2 = $db->prepare("SELECT COUNT(*) AS total FROM penyakit");
            $query2->execute();
            $total = 0;
            foreach ($query2 as $key) {
                $total = $key['total'];
            }
            $query = $db->prepare("INSERT INTO penyakit VALUES (:id, :nama)");
            $query->bindValue(':id',$total+1);
            $query->bindValue(':nama',$penyakit);
            $query->execute();

            $id = $total+1;
        }

        return $id;
    }
    if (isset($_POST['submitLaporan'])) {

        $p = penyakit($dbc, $_POST['penyakit']);
        
        echo "p ".$p."; detil antrian ".$_POST['id_detil_antrian']."; id pasien ".$_POST['id_pasien']."; id dokter ".$_POST['dokter']."; Nomor pegawai ".$_POST['pegawai']."; id pasien ".$_POST['id_pasien']."; nomor antrian ".$_POST['na']."; tgl ".$_POST['tgl'];

        $query = $dbc->prepare("INSERT INTO ppd VALUES (:penyakit, :pasien, :dokter)");
        $query->bindValue(':penyakit',$p);
        $query->bindValue(':pasien',$_POST['id_pasien']);
        $query->bindValue(':dokter',$_POST['dokter']);
        $query->execute();

        $AQUA = $dbc->prepare("UPDATE antrian SET ID_DETIL_ANTRIAN = :id_detil_antrian, NOMOR_PEGAWAI = :nop, ID_PENYAKIT = :ipe, ID_PASIEN = :ipa, ID_DOKTER = :idd WHERE NOMOR_ANTRIAN = :na AND TGL = :tgl");
        $AQUA->bindValue(':id_detil_antrian',$_POST['id_detil_antrian']);
        $AQUA->bindValue(':nop',$_POST['pegawai']);
        $AQUA->bindValue(':ipe',$p);
        $AQUA->bindValue(':ipa',$_POST['id_pasien']);
        $AQUA->bindValue(':idd',$_POST['dokter']);
        $AQUA->bindValue(':na',$_POST['na']);
        $AQUA->bindValue(':tgl',$_POST['tgl']);
        $AQUA->execute();

        header("Location: antrian.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buat laporan</title>
</head>
<body>
    <?php
    if (isset($_POST['kirimData'])) {
        $query = $dbc->prepare("SELECT * FROM antrian WHERE NOMOR_ANTRIAN = :id AND TGL = :tgl");
        $query->bindValue(':id',$_POST['id']);
        $query->bindValue(':tgl',$_POST['tgl']);
        $query->execute();
        echo "BISAAA ".$_POST['id']." ".$_POST['tgl'];

        foreach ($query as $key) {
            ?>
            <form action="buatLaporan.php" method="POST">
                <input type="hidden" name="na" value="<?php echo "{$key['NOMOR_ANTRIAN']}" ?>">
                <input type="hidden" name="tgl" value="<?php echo "{$key['TGL']}" ?>">
            <table>
                <tr>
                    <td>ID Antrian</td>
                    <td>: <?php echo "{$key['NOMOR_ANTRIAN']}" ?></td>
                </tr>
                <tr>
                    <td>Tanggal dan waktu pendaftaran</td>
                    <td>: <?php echo "{$key['TGL']} {$key['WAKTU']}" ?></td>
                </tr>
                <tr>
                    <td>Pegawai</td>
                    <td>: 
                        <select name="pegawai" id="id">
                            <option disabled selected>Pilih pegawai</option>
                            <?php 
                            $query = $dbc->prepare("SELECT * FROM admin");
                            $query->execute();
                            foreach ($query as $key) {
                                ?> <option value="<?php echo "{$key['NOMOR_PEGAWAI']}" ?>"><?php echo "{$key['NAMA_ADMIN']}" ?></option> <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mengantri</td>
                    <td>: <input type="radio" value="2" name="id_detil_antrian">ya <br> &nbsp; <input type="radio" value="1" name="id_detil_antrian">tidak</td>
                </tr>
                <tr>
                    <td>ID Pasien</td>
                    <td>: 
                        <select name="id_pasien" id="id_pasien">
                            <option disabled selected>Pilih pasien</option>
                        <?php
                        $query = $dbc->prepare("SELECT * FROM pasien");
                        $query->execute();
                        foreach ($query as $key) {
                            echo "<option value=\"{$key['ID_PASIEN']}\">{$key['NAMA_PASIEN']}</option>";
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Penyakit</td>
                    <td>: <input type="text" name="penyakit"></td>
                </tr>
                <tr>
                    <td>Dokter</td>
                    <td>: 
                        <select name="dokter" id="dokter">
                            <option disabled selected>Pilih dokter</option>
                        <?php
                        $query = $dbc->prepare("SELECT * FROM dokter");
                        $query->execute();
                        foreach ($query as $key) {
                            echo "<option value=\"{$key['ID_DOKTER']}\">{$key['NAMA_DOKTER']}</option>";
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="submit" name="submitLaporan"><input type="reset"></td>
                </tr>
            </table>
            </form>
            <?php
        }
    }
    ?>
</body>
</html>