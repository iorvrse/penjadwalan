<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$query = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if( isset($_POST["submit"]) ) {
    
    if( registrasi($_POST) > 0 ) {
        echo "<script>
                alert('user baru berhasil ditambahkan!');
                document.location.href = 'pengguna.php';
            </script>";
    } else {
        echo mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">

        <?php include 'navigation.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
                    <h1 class="text-gray-800">Tambah Data Pengguna</h1>
                </div>
        
                <div class="row mb-4">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="nama_pengguna">Nama: </label>
                                <input type="text" name="nama_pengguna" id="nama_pengguna" required>
                            </li>
                            <li>
                                <label for="username">Username: </label>
                                <input type="text" name="username" id="username" required>
                            </li>
                            <li>
                                <label for="password">Password: </label>
                                <input type="password" name="password" id="password" required>
                            </li>
                            <li>
                                <label for="password">Konfirmasi password: </label>
                                <input type="password" name="password2" id="password2" required>
                            </li>
                            <li>
                                <select name="level_pengguna" id="level_pengguna">
                                    <option value="user">user</option>               
                                    <option value="admin">admin</option>               
                                </select>
                                <button type="submit" name="submit">Tambah</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>