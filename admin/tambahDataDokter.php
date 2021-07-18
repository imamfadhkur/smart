<?php

if (isset($_POST['submitRegistDokter'])) {
    $cek = validasiform('benar');
    if ($cek) {
        $query=$dbc->prepare("INSERT INTO dokter VALUES (:id, :id_spesialis, SHA2(:password,0), :nama, :email, :no_telp)");
        $query->bindValue(':id', $_POST['id']);
        $query->bindValue(':id_spesialis', $_POST['spesialis']);
        $query->bindValue(':password', $_POST['password']);
        $query->bindValue(':nama', $_POST['nama']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':no_telp', $_POST['no_telp']);
        $query->execute();
        
        ?>

            Data dokter: <br>
            username: <?php echo "{$_POST['id']}" ?> <br>
            password: <?php echo "{$_POST['password']}" ?> <br>
            Berhasil ditambahkan.<br><br>

        <?php
    }
    else {
        // notifikasi kesalahan input
    }
}

?>