<?php
session_start();

require '../function.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: ../login.php");
	exit;
}

$id_kelas = $_GET['id_kelas'];
$get_kelas = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = $id_kelas");
$data_kelas = mysqli_fetch_assoc($get_kelas);

$query = "SELECT * FROM jadwal
            INNER JOIN slot_waktu
            ON jadwal.id_slot = slot_waktu.id_slot
            INNER JOIN dosen
            ON jadwal.id_dosen = dosen.id_dosen
            INNER JOIN matakuliah
            ON jadwal.id_matakuliah = matakuliah.id_matakuliah
            INNER JOIN kelas
            ON jadwal.id_kelas = kelas.id_kelas
            WHERE jadwal.id_kelas = $id_kelas
        ";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                <h1 class="text-gray-800">Detail Jadwal</h1>
            </div>
        
        </div>

    </div>

    <h2><?= 'Kelas ' . $data_kelas['kelas']; ?></h2>
    
    <table>
        <thead>
            <tr>
                <th>Jam</th>
                <th>Hari</th>
                <th>Dosen</th>
                <th>Matakuliah</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data) : ?>
                <tr>
                    <td><?= $data['waktu_slot_awal'] . "-" . $data['waktu_slot_akhir']; ?></td>
                    <td><?= $data['hari']; ?></td>
                    <td><?= $data['dosen']; ?></td>
                    <td><?= $data['matakuliah']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
