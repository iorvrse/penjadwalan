<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$result = mysqli_query($conn, "SELECT * FROM kelas INNER JOIN semester ON kelas.id_semester = semester.id_semester");

if( isset($_POST["cari"]) ) {
    $keyword = $_POST["keyword"];
    
    $query = "SELECT * FROM kelas
            INNER JOIN semester ON kelas.id_semester = semester.id_semester
            WHERE kelas.kelas LIKE '%$keyword%' OR
                semester.tahun LIKE '%$keyword%' OR
                semester.semester LIKE '%$keyword%'
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

    <h1>Data kelas</h1>
    <a href="add_kelas.php">Tambah</a>
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
                <th>Tahun / Semester</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $data['kelas']; ?></td>
                <td><?= $data['tahun'] . " " . $data['semester']; ?></td>
                <td colspan="2">
                    <a href="update_kelas.php?id_kelas=<?= $data['id_kelas']; ?>">Edit</a> |
                    <a href="delete_kelas.php?id_kelas=<?= $data['id_kelas']; ?>" 
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
</body>
</html>