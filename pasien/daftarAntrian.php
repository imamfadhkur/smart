
<?php
    include '../koneksi.php';
    session_start();
    ini_set('date.timezone', 'Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>daftar antrian</title>
    <script src="../js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php

    if (isset($_POST['batalkanAntrian'])) {
        $query = $dbc->prepare("UPDATE antrian SET ID_DETIL_ANTRIAN = '1' WHERE antrian.NOMOR_ANTRIAN = :sesi AND antrian.TGL = :tgl");
        $query->bindValue(':sesi',$_SESSION['mengantri']);
        $query->bindValue(':tgl',date("Y-m-d"));
        $query->execute();
        unset($_SESSION['mengantri']);
        unset($_SESSION['poli']);
    }

    if (isset($_POST['daftarAntrian'])) {
        $kunci = array(1=>"A",2=>"B",3=>"C",4=>"D",5=>"E",6=>"F",7=>"G",8=>"H",9=>"I",10=>"J",11=>"K",12=>"L",13=>"M",14=>"N",15=>"O",16=>"P",17=>"Q",18=>"R",19=>"S");
        $keyAntrian = "";
        $_SESSION['poli'] = $_POST['poli'];
        foreach ($kunci as $key => $value) {
            if ($key == $_POST['poli']) {
                $keyAntrian = $value;
            }
        }
        $tgl = date("Y-m-d");
        $jmlAntrian = $dbc->prepare("SELECT COUNT(*) as total FROM antrian WHERE NOMOR_ANTRIAN LIKE concat( :na, '%') AND TGL = :tgl");
        $jmlAntrian->bindValue(':na',$keyAntrian);
        $jmlAntrian->bindValue(':tgl',$tgl);
        $jmlAntrian->execute();

        $n = $jmlAntrian->rowCount();
        $nomorAntrian = "";
        if ($n > 0) {
            foreach ($jmlAntrian as $key) {
                $x = $key['total']+1;
                $nomorAntrian = "{$keyAntrian}".$x;
            }
        }
        else {
            $nomorAntrian = $keyAntrian."1";
        }
        
        $time = date("H:i:s");
        $query = $dbc->prepare("INSERT INTO antrian VALUES (:na, :tgl, :id_detil_antrian, :nomor_pegawai, :id_penyakit, :id_pasien, :id_dokter, :waktu)");
        $query->bindValue(':na',$nomorAntrian);
        $query->bindValue(':tgl',$tgl);
        $query->bindValue(':id_detil_antrian',null);
        $query->bindValue(':nomor_pegawai',null);
        $query->bindValue(':id_penyakit',null);
        $query->bindValue(':id_pasien',null);
        $query->bindValue(':id_dokter',null);
        $query->bindValue(':waktu',$time);
        $query->execute();

        // echo "berhasil menambahkan data antrian"." ; ".$nomorAntrian." ; ".$tgl." ; ".$time;
        $_SESSION['mengantri'] = $nomorAntrian;
    }

    if (!isset($_SESSION['mengantri'])) {

    ?>

    Pilih poli anda, lalu klik tombol dibawah ini untuk mendaftar antrian.
    <br>
    <form action="daftarAntrian.php" method="POST">
        <select name="poli" id="poli">
            <option disabled selected>Pilih poli</option>

            <?php
            $query = $dbc->prepare("SELECT * FROM spesialis");
            $query->execute();

            foreach ($query as $key) {
                echo "<option value=\"{$key['ID_SPESIALIS']}\">Poli {$key['SPESIALIS']}</option>";
            }
            ?>

        </select> <br>
        <input type="submit" value="Mulai Mengantri" name="daftarAntrian">
    </form>

    <?php
    }
    else {
        echo "Anda sedang mengantri di nomor ".$_SESSION['mengantri'];
        ?>
        <br>
        <div id="nomorAntrian">

        </div>
        <script>
            var myVar = setInterval(loadNumber, 1000);
            function loadNumber() {
                $.get('nomorAntri.php',function(nomorAntri){
                    $('#nomorAntrian').html(nomorAntri)
                })
            }
        </script>
        <?php
    }
    ?>

    <br>
    <a href="index.php">kembali</a> ke halaman utama.

</body>
</html>