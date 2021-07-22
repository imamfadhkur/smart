<?php
include '../koneksi.php';
ini_set('date.timezone', 'Asia/Jakarta');
session_start();

if (isset($_POST['mulaiAntrian'])) {
    $_SESSION['antrian'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>antrian</title>
    <script src="../js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    if (!isset($_SESSION['antrian'])) {
        ?>
        <form action="antrian.php" method="POST">
            <input type="submit" name="mulaiAntrian" value="mulai antrian">
        </form>
        <?php
    }
    else {
        ?>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p>
        <div id="content">

        </div>
        <script>
            var myVar = setInterval(loadNumber, 500);
            function loadNumber() {
                $.get('sedangAntri.php',function(sedangAntri){
                    $('#content').html(sedangAntri)
                })
            }
        </script>
        <?php
    }

    ?>
    <a href="index.php">kembali </a>ke halaman utama
</body>
</html>