<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_matakuliah = $_GET['id_matakuliah'];
$query = "SELECT * FROM matakuliah WHERE id_matakuliah = $id_matakuliah";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $nama_matakuliah = htmlspecialchars($_POST['nama_matakuliah']);
    $id_matakuliah = $_POST['id_matakuliah'];

    $query = "UPDATE matakuliah SET nama_matakuliah='$nama_matakuliah' WHERE id_matakuliah=$id_matakuliah";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'matakuliah.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'matakuliah.php';
            </script>
        ";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
                    <h1 class="text-gray-800">Update Data Matakuliah</h1>
                </div>

                <div class="row">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="nama_matakuliah">Matakuliah:</label>
                                <input type="text" name="nama_matakuliah" id="nama_matakuliah" value="<?= $data['nama_matakuliah']; ?>">
                            </li>
                            <li>
                                <input type="hidden" name="id_matakuliah" value="<?= $data['id_matakuliah']; ?>">
                                <button type="submit" name="submit">Edit</button>
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
