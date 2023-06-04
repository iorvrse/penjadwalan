<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_dosen = $_GET['id_dosen'];
$query = "SELECT * FROM dosen WHERE id_dosen = $id_dosen";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $bidang_ilmu = htmlspecialchars($_POST['bidang_ilmu']);
    $id_dosen = $_POST['id_dosen'];

    $query = "UPDATE dosen SET nama='$nama', nip='$nip', bidang_ilmu='$bidang_ilmu' WHERE id_dosen=$id_dosen";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'dosen.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'dosen.php';
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
                    <h1 class="text-gray-800">Update Data Dosen</h1>
                </div>
        
                <div class="row">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama" id="nama" value="<?= $data['nama']; ?>">
                            </li>
                            <li>
                                <label for="nip">NIP:</label>
                                <input type="text" name="nip" id="nip" value="<?= $data['nip']; ?>">
                            </li>
                            <li>
                                <label for="bidang_ilmu">Bidang Ilmu:</label>
                                <input type="text" name="bidang_ilmu" id="bidang_ilmu" value="<?= $data['bidang_ilmu']; ?>">
                            </li>
                            <li>
                                <input type="hidden" name="id_dosen" value="<?= $data['id_dosen']; ?>">
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
