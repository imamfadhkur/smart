
<?php


include "koneksi.php";


if (isset($_POST['admin'])) {
    ?>

    <form action="index.php" method="POST">
        <label for="username">ID Admin</label>
        <input type="text" name="username"> <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit_login_admin" value="login">
        <input type="reset" value="reset">
        <br>
    </form>

    <?php
}
elseif (isset($_POST['dokter'])) {
    ?>

<form action="index.php" method="POST">
        <label for="username">ID Dokter</label>
        <input type="text" name="username"> <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit_login_dokter" value="login">
        <input type="reset" value="reset">
        <br>
    </form>

    <?php
}
else {
    ?>

    <form action="index.php" method="POST">
        <label for="username">ID Pasien</label>
        <input type="text" name="username"> <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>
        <input type="submit" name="submit_login_pasien" value="login">
        <input type="reset" value="reset">
        <br>
        <br>
        <Label for="registrasi">Anda tidak punya akun?</Label>
        <a href="registrasi.php">Hubungi admin.</a>
    </form>
    
    <?php
}

if (isset($_POST['submit_login_admin'])) {

    echo "<h1>Username atau password salah</h1>";

    $query=$dbc->prepare("SELECT * FROM admin WHERE NOMOR_PEGAWAI = :nomor_pegawai AND PASSWORD = SHA2(:password,0)");
    $query->bindValue(':nomor_pegawai', $_POST['username']);
    $query->bindValue(':password', $_POST['password']);
	$query->execute();

    $sesi = "";
    foreach ($query as $key) {
        $sesi = $key['NAMA_ADMIN'];
    }

    if ($query->rowCount()>0) {
        session_start();
        $_SESSION['admin'] = $sesi;
        header('Location: admin/index.php');
        exit();
    }
}

if (isset($_POST['submit_login_pasien'])) {

    echo "<h1>Username atau password salah</h1>";

    $query=$dbc->prepare("SELECT * FROM pasien WHERE ID_PASIEN = :id AND PASWORD = SHA2(:password,0)");
    $query->bindValue(':id', $_POST['username']);
    $query->bindValue(':password', $_POST['password']);
	$query->execute();

    $sesi = "";
    $id_sesi = "";
    foreach ($query as $key) {
        $sesi = $key['NAMA_PASIEN'];
        $id_sesi = $key['ID_PASIEN'];
    }

    if ($query->rowCount()>0) {
        session_start();
        $_SESSION['pasien'] = $sesi;
        $_SESSION['id_pasien'] = $id_sesi;
        $_SESSION['password_pasien'] = $_POST['password'];
        header('Location: pasien/index.php');
        exit();
    }
}

if (isset($_POST['submit_login_dokter'])) {

    echo "<h1>Username atau password salah</h1>";

    $query=$dbc->prepare("SELECT * FROM dokter WHERE ID_DOKTER = :id AND PASWORD = SHA2(:password,0)");
    $query->bindValue(':id', $_POST['username']);
    $query->bindValue(':password', $_POST['password']);
	$query->execute();

    $sesi = "";
    foreach ($query as $key) {
        $sesi = $key['NAMA_DOKTER'];
    }

    if ($query->rowCount()>0) {
        session_start();
        $_SESSION['dokter'] = $sesi;
        header('Location: dokter/index.php');
        exit();
    }
}

?>
