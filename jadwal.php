<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$query = "SELECT * FROM kelas INNER JOIN semester ON kelas.id_semester = semester.id_semester WHERE semester.status = '1'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if( isset($_POST["cari"]) ) {
    $keyword = $_POST["keyword"];
    
    $query = "SELECT * FROM kelas WHERE
                kelas LIKE '%$keyword%'
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
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav> 

    <h1>Data jadwal</h1>
    <a href="add_jadwal.php">Tambah</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">cari</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $data['nama_jadwal']; ?></td>
                <td colspan="2">
                    <a href="detail_jadwal.php?id_kelas=<?= $data['id_kelas']; ?>">Detail</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>