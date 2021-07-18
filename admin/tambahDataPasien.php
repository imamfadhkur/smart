<?php

if (isset($_POST['submitRegistPasien'])) {
    $cek = validasiform('benar');
    if ($cek) {
        $query=$dbc->prepare("INSERT INTO pasien VALUES (:id_pasien, :nama_pasien, SHA2(:password,0), :nik, :alamat, :email, :no_telp)");
        $query->bindValue(':id_pasien', $_POST['id_pasien']);
        $query->bindValue(':nama_pasien', $_POST['nama']);
        $query->bindValue(':password', $_POST['password']);
        $query->bindValue(':nik', $_POST['nik']);
        $query->bindValue(':alamat', $_POST['alamat']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':no_telp', $_POST['no_telp']);
        $query->execute();
        
        ?>

            Data pasien: <br>
            username: <?php echo "{$_POST['id_pasien']}" ?> <br>
            password: <?php echo "{$_POST['password']}" ?> <br>
            Berhasil ditambahkan.<br><br>

        <?php
    }
    else {
        // notifikasi kesalahan input
    }
}

?>