<?php
session_start();

require 'function.php';

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
    <title>Document</title>
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav>
    <h1>Jadwal Kuliah</h1>
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
</body>
</html>
