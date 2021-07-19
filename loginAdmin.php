<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
<?php

include "koneksi.php";

?>

    <form action="loginAdmin.php" method="POST">
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

if (isset($_POST['submit_login_admin'])) {

    

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
    else {
        echo "Username atau password salah";
    }
}
?>

<br>
Bukan admin? <a href="index.php">home</a>

</body>
</html>