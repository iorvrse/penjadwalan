<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: ../login.php");
	exit;
}

require '../function.php';

$id_pengguna = $_GET['id_pengguna'];
$query = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $username = strtolower(stripslashes(trim(($_POST['username']))));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $id = $_POST['id_pengguna'];

    if (password_verify($password, $data['password'])) {
        if (delete('pengguna', 'id_pengguna', $id)) {
            echo "
                <script>
                    alert('data berhasil dihapus!');
                    document.location.href = '../logout.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal dihapus!');
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
                    <h1 class="text-gray-800">Konfirmasi Hapus Akun</h1>
                </div>

                <div class="row mb-4">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" required>
                            </li>
                            <li>
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" required>
                            </li>
                            <li>
                                <input type="hidden" name="id_pengguna" value="<?= $id_pengguna; ?>">
                               <button class="btn btn-outline-danger" type="submit" name="submit">Delete</button>                      
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

