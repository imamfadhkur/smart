<?php
include '../koneksi.php';
ini_set('date.timezone', 'Asia/Jakarta');
session_start();
$tgl = date("Y-m-d");
$abjad = $_SESSION['mengantri'];
$aa = $abjad[0];
$query = $dbc->prepare("SELECT * FROM antrian WHERE NOMOR_ANTRIAN LIKE concat( :na, '%') AND TGL = :tgl AND ID_DETIL_ANTRIAN IS NULL");
$query->bindValue(':na',$aa);
$query->bindValue(':tgl',$tgl);
$query->execute();

$arr = array();
$n = $query->rowCount();
// echo $n." ; ".$tgl." ; ".$aa;
foreach ($query as $key) {
    // echo "<br>MASUK ".$key['NOMOR_ANTRIAN'];
    array_push($arr,$key['NOMOR_ANTRIAN']);
}
echo "Antrian nomor: <br>";
echo $arr[0];
$query = $dbc->prepare("SELECT * FROM spesialis WHERE ID_SPESIALIS = :id");
$query->bindValue(':id',$_SESSION['poli']);
$query->execute();
foreach ($query as $key) {
    echo "<br>masuk ke poli: ".$key['SPESIALIS'];
    echo "<br>Nomor antrian berikutnya silahkan datang ke rumah sakit";
}
?>

    <form action="daftarAntrian.php" method="POST">
        <input type="submit" name="batalkanAntrian" value="batalkan antrian" onclick="return confirm('Yakin ingin membatalkan?')">
    </form>