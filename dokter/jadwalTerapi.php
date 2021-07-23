
<?php
    include '../koneksi.php';
    ini_set('date.timezone', 'Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jadwal terapi</title>
</head>
<body>
    Jadwal Terapi Hari ini:
    <?php
        $arr = array();
        $query = $dbc->prepare("SELECT * FROM antrian WHERE TGL = :tgl");
        $query->bindValue(':tgl',date("Y-m-d"));
        $query->execute();
        $temp = "";
        foreach ($query as $key) {
            if ($temp != $key['NOMOR_ANTRIAN'][0]) {
                array_push($arr,$key['NOMOR_ANTRIAN'][0]);
                $temp = $key['NOMOR_ANTRIAN'][0];
            }
        }
        ?>

        <table border="1">
            <tr>
                <td>Klinik</td>
                <td>Jumlah antrian</td>
                <td>Selesai</td>
            </tr>
                    <?php
                        $kunci = array("A"=>"Umum","B"=>"Konservasi Gigi","C"=>"Periodonti","D"=>"Penyakit Dalam","E"=>"Kebidanan dan Kandungan","F"=>"Anak","G"=>"Bedah Umum","H"=>"Bedah Anak","I"=>"Bedah Mulut","J"=>"Jantung dan Pembuluh Darah","K"=>"Mata","L"=>"THT","M"=>"Paru","N"=>"Urologi","O"=>"Orthopedi","P"=>"Saraf","Q"=>"Penyakit Kulit dan Kelamin","R"=>"Kejiwaan Jiwa","S"=>"Psikologi");
                        foreach ($arr as $keyArr => $valueArr) {
                            foreach ($kunci as $keyKunci => $valueKunci) {
                                if ($valueArr == $keyKunci) {
                                    ?>
                                    <tr>
                                        <td><?php echo $valueKunci ?></td>
                                        <td>
                                            <?php
                                                $query = $dbc->prepare("SELECT COUNT(*) AS jml FROM antrian WHERE TGL = :tgl AND NOMOR_ANTRIAN LIKE concat(:na, '%')");
                                                $query->bindValue(':na',$valueArr);
                                                $query->bindValue(':tgl',date("Y-m-d"));
                                                $query->execute();

                                                foreach ($query as $key) {
                                                    echo $key['jml'];
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                                $query = $dbc->prepare("SELECT COUNT(*) AS jml FROM antrian WHERE TGL = :tgl AND NOMOR_ANTRIAN LIKE concat(:na, '%') AND ID_DETIL_ANTRIAN IS NOT NULL");
                                                $query->bindValue(':na',$valueArr);
                                                $query->bindValue(':tgl',date("Y-m-d"));
                                                $query->execute();

                                                foreach ($query as $key) {
                                                    echo $key['jml'];
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        if (!isset($valueArr)) {
                            ?>
                                <tr>
                                    <td>Tidak ada data</td>
                                    <td>Tidak ada data</td>
                                    <td>Tidak ada data</td>
                                </tr>
                            <?php
                        }
                    ?>
    </table>

    <a href="index.php">Kembali </a>ke halaman depan
</body>
</html>