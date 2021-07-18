
<?php

    include '../koneksi.php';
    session_start();

    if (isset($_POST['submitUpdate'])) {
        $query = $dbc->prepare("UPDATE pasien SET ID_PASIEN = :id, NAMA_PASIEN = :nama, PASWORD = SHA2(:password,0), NIK = :nik, ALAMAT = :alamat, EMAIL_PASIEN = :email , NO_TELP = :tel WHERE pasien.ID_PASIEN = :id_asal");
        $query->bindValue(':id', $_POST['id']);
        $query->bindValue(':id_asal', $_SESSION['id_pasien']);
        $query->bindValue(':nama', $_POST['nama']);
        $query->bindValue(':password', $_POST['password']);
        $query->bindValue(':nik', $_POST['nik']);
        $query->bindValue(':alamat', $_POST['alamat']);
        $query->bindValue(':tel', $_POST['tel']);
        $query->bindValue(':email', $_POST['email']);
        $query->execute();

        echo "<h3 class=\"sukses\">Data berhasil dirubah</h3>";
        $_SESSION['pasien'] = $_POST['nama'];
        $_SESSION['id_pasien'] = $_POST['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <style>
        .sukses{
            color: green;
            font-style: italic;
        }
    </style>
</head>
<body>
    
    <h3>Hallo <?php echo "{$_SESSION['pasien']}" ?>, silahkan lengkapi profile kamu yaa jika belum lengkap :)</h3>

    <?php

        $query = $dbc->prepare("SELECT * FROM pasien WHERE ID_PASIEN = :id");
        $query->bindValue(':id', $_SESSION['id_pasien']);
        $query->execute();
        
        foreach ($query as $key) {
            ?>

            <form action="profil.php" method="POST">
            <table>
                <tr>
                    <td>ID</td>
                    <td>: 
                        <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"id\" value=\"{$key['ID_PASIEN']}\">";
                            }
                            else {
                                echo "{$key['ID_PASIEN']}";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: 
                    <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"nama\" value=\"{$key['NAMA_PASIEN']}\">";
                            }
                            else {
                                echo "{$key['NAMA_PASIEN']}";
                            }
                        ?>
                        </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>: 
                    <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"password\" value=\"{$_SESSION['password_pasien']}\">";
                            }
                            else {
                                echo "{$_SESSION['password_pasien']}";
                            }
                        ?>
                        </td>
                </tr>
                <?php
                    if (isset($_POST['ubah'])) {
                        ?>

                        <tr>
                            <td>Konfirmasi Password</td>
                            <td>: <input type="password" name="konfirmasiPassword"></td>
                        </tr>

                        <?php
                    }
                ?>
                <tr>
                    <td>NIK</td>
                    <td>: 
                    <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"nik\" value=\"{$key['NIK']}\">";
                            }
                            else {
                                echo "{$key['NIK']}";
                            }
                        ?>
                        </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: 
                    <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"alamat\" value=\"{$key['ALAMAT']}\">";
                            }
                            else {
                                echo "{$key['ALAMAT']}";
                            }
                        ?>
                        </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: 
                    <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"email\" value=\"{$key['EMAIL_PASIEN']}\">";
                            }
                            else {
                                echo "{$key['EMAIL_PASIEN']}";
                            }
                        ?>
                        </td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>: 
                    <?php 
                            if (isset($_POST['ubah'])) {
                                echo "<input type=\"text\" name=\"tel\" value=\"{$key['NO_TELP']}\">";
                            }
                            else {
                                echo "{$key['NO_TELP']}";
                            }
                        ?>
                        </td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php
                if (isset($_POST['ubah'])) {
                    echo "<input type=\"submit\" name=\"submitUpdate\" value=\"simpan\">";
                    echo "<input type=\"submit\" name=\"batal\" value=\"batal\">";
                }
                else {
                    echo "<input type=\"submit\" name=\"ubah\" value=\"ubah data\">";
                }
            ?>
            </td>
                </tr>
            </table>
            </form>

            <a href="index.php">home</a>

            <?php
        }

    ?>
</body>
</html>