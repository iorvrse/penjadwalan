<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
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

    <h1>Data Semester</h1>
    <a href="add_semester.php">Tambah</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">cari</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Tahun</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $data['tahun']; ?></td>
            <td><?= $data['semester']; ?></td>
            <td><?= $data['status'] == 1 ? 'aktif': 'tidak aktif'; ?></td>
            <td>
                <a href="update_semester_aktivasi.php?id_semester=<?= $data['id_semester']; ?>&status=<?= $data['status']; ?>">
                    #
                </a>
            </td>
            <td colspan="2">
                <a href="update_semester.php?id_semester=<?= $data['id_semester']; ?>">Edit</a> |
                <a href="delete_semester.php?id_semester=<?= $data['id_semester']; ?>" 
                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>