<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$result = mysqli_query($conn, "SELECT * FROM dosen");

if( isset($_POST["cari"]) ) {
    $keyword = $_POST["keyword"];
    
    $query = "SELECT * FROM dosen WHERE
                nama LIKE '%$keyword%' OR
                nip LIKE '%$keyword%' OR
                bidang_ilmu LIKE '%$keyword%'
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

    <h1>Data Dosen</h1>
    <a href="add_dosen.php">Tambah</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">cari</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama</th>
            <th>NIP</th>
            <th>Bidang Ilmu</th>
            <th>Action</th>
        </tr>
        
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['nip']; ?></td>
            <td><?= $data['bidang_ilmu']; ?></td>
            <td colspan="2">
                <a href="update_dosen.php?id_dosen=<?= $data['id_dosen']; ?>">Edit</a> |
                <a href="delete_dosen.php?id_dosen=<?= $data['id_dosen']; ?>" 
                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>