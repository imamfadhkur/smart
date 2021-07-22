<?php

include '../koneksi.php';
    $query = $dbc->prepare("SELECT * FROM antrian WHERE TGL = :tgl AND ID_DETIL_ANTRIAN IS NULL");
    $query->bindValue(':tgl',date("Y-m-d"));
    $query->execute();
    $i = 1;
    foreach ($query as $key) {
    ?>
    <form action="buatLaporan.php" method="POST">
    <table border="1">
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo "{$key['NOMOR_ANTRIAN']}" ?></td>
                <td><input type="submit" name="kirimData" value="edit"></td>
                <input type="hidden" name="id" value="<?php echo "{$key['NOMOR_ANTRIAN']}" ?>">
                <input type="hidden" name="tgl" value="<?php echo "{$key['TGL']}" ?>">
            </tr>
    </table>
    </form>

            <?php
            $i += 1;
        }
        ?>