<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$result = mysqli_query($conn, "SELECT * FROM slot_waktu");

if( isset($_POST["cari"]) ) {
    $keyword = $_POST["keyword"];
    
    $query = "SELECT * FROM slot_waktu WHERE
                waktu_slot_awal LIKE '%$keyword%' OR
                waktu_slot_akhir LIKE '%$keyword%' OR
                hari_slot LIKE '%$keyword%'
            ";

    mysqli_query($conn, $query);
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
    
    <h1>Data slot waktu</h1>
    <a href="add_slot_waktu.php">Tambah</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">cari</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Jam awal</th>
            <th>Jam akhir</th>
            <th>Hari</th>
            <th>Action</th>
        </tr>
        
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $data['waktu_slot_awal']; ?></td>
            <td><?= $data['waktu_slot_akhir']; ?></td>
            <td><?= $data['hari_slot']; ?></td>
            <td colspan="2">
                <a href="update_slot_waktu.php?id_slot=<?= $data['id_slot_waktu']; ?>">Edit</a> |
                <a href="delete_slot_waktu.php?id_slot=<?= $data['id_slot_waktu']; ?>" 
                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>