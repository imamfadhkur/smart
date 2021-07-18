<?php

if (isset($_POST['submitRegistAdmin'])) {
    $cek = validasiform('benar');
    if ($cek) {
        $query=$dbc->prepare("INSERT INTO admin VALUES (:id, SHA2(:password,0), :nama, :alamat, :email, :no_telp)");
        $query->bindValue(':id', $_POST['nomor_pegawai']);
        $query->bindValue(':nama', $_POST['nama']);
        $query->bindValue(':password', $_POST['password']);
        $query->bindValue(':alamat', $_POST['alamat']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':no_telp', $_POST['no_telp']);
        $query->execute();
        
        ?>

            Data admin: <br>
            username: <?php echo "{$_POST['nomor_pegawai']}" ?> <br>
            password: <?php echo "{$_POST['password']}" ?> <br>
            Berhasil ditambahkan.<br><br>

        <?php
    }
    else {
        // notifikasi kesalahan input
    }
}

?>