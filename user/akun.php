<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: ../login.php");
	exit;
}

require '../function.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM pengguna WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $username = strtolower(stripslashes(trim(($_POST['username']))));
    $nama_pengguna = htmlspecialchars($_POST['nama_pengguna']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $password_lama = mysqli_real_escape_string($conn, $_POST['password_lama']);
    $id_pengguna = $_POST['id_pengguna'];

    $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('Username sudah terdaftar!');
                document.location.href = 'akun.php';
            </script>"
        ;
        exit;
    }
    
    if( $password !== $password2 ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
                document.location.href = 'akun.php';
            </script>"
        ;
        exit;
    }

    if (password_verify($password_lama, $data['password'])) {
        $query = "UPDATE pengguna SET
                    nama_pengguna='$nama_pengguna',
                    password='$password',
                    username='$username',
                WHERE
                    id_pengguna=$id_pengguna
        ";
        mysqli_query($conn, $query);
    
        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah!');
                    document.location.href = 'akun.php';
                </script>
            ";
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjadwalan</title>
    
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">

        <?php include 'navigation.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
                    <h1 class="text-gray-800">Pengaturan Akun</h1>
                </div>

                <div class="row mb-4">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="nama_pengguna">Nama:</label>
                                <input type="text" name="nama_pengguna" id="nama_pengguna" value="<?= $data['nama_pengguna']; ?>" disabled>
                            </li>
                            <li>
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" value="<?= $data['username']; ?>" disabled>
                            </li>
                            <li>
                                <label for="password_lama">Password lama:</label>
                                <input type="password" name="password_lama" id="password_lama">
                            </li>
                            <li>
                                <label for="password">Password baru:</label>
                                <input type="password" name="password" id="password">
                            </li>
                            <li>
                                <label for="password">Konfirmasi password baru:</label>
                                <input type="password" name="password2" id="password2">
                            </li>
                            <li>
                                <input type="hidden" name="id_pengguna" value="<?= $data['id_pengguna']; ?>">
                                <button class="btn btn-outline-primary" type="submit" name="submit">Submit</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>
</html>
