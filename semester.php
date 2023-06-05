<?php 
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$result = mysqli_query($conn, "SELECT * FROM semester");

if( isset($_POST["cari"]) ) {
    $keyword = $_POST["keyword"];
    
    $query = "SELECT * FROM semester WHERE
                tahun LIKE '%$keyword%' OR
                semester LIKE '%$keyword%' OR
                status LIKE '%$keyword%'
            ";

    $result = mysqli_query($conn, $query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjadwalan</title>
    
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
                    <h1 class="text-gray-800">Data Semester</h1>
                </div>

                <div class="row mb-4">
                    <a class="btn btn-primary" role="button" href="add_semester.php">Tambah</a>
                </div>

                <div class="row mb-4">
                    <form action="" method="post">
                        <input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian.." autocomplete="off">
                        <button type="submit" name="cari">cari</button>
                    </form>
                </div>

                <div class="row mb-4">
                    <table border="1" cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php $i = 1; ?>
                            <?php while ($data = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $data['tahun']; ?></td>
                                <td><?= $data['semester']; ?></td>
                                <td><?= $data['status'] == '1' ? 'aktif': 'tidak aktif'; ?></td>
                                <td>
                                    <a class="btn btn-outline-success" role="button" href="update_semester_aktivasi.php?id_semester=<?= $data['id_semester']; ?>&status=<?= $data['status']; ?>">
                                        <i class="fas fa-fw fa-lock"></i>
                                    </a>
                                </td>
                                <td colspan="2">
                                    <a class="btn btn-outline-success" role="button" href="update_semester.php?id_semester=<?= $data['id_semester']; ?>">Edit</a> 
                                    <a class="btn btn-outline-danger" role="button" href="delete_semester.php?id_semester=<?= $data['id_semester']; ?>" 
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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