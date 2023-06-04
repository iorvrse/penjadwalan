<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$result = mysqli_query($conn, "SELECT * FROM pengguna");

if( isset($_POST["cari"]) ) {
    $keyword = $_POST["keyword"];
    
    $query = "SELECT * FROM pengguna WHERE
                username LIKE '%$keyword%' OR
                password LIKE '%$keyword%' OR
                level_pengguna LIKE '%$keyword%' OR
                nama_pengguna LIKE '%$keyword%'
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

    <h1>Data Pengguna</h1>
    <a href="add_pengguna.php">Tambah</a>
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
                <th>Nama</th>
                <th>Username</th>
                <th>Level Pengguna</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $data['nama_pengguna']; ?></td>
                <td><?= $data['username']; ?></td>
                <td><?= $data['level_pengguna']; ?></td>
                <td colspan="2">
                <?php if ($data['username'] == "admin") : ?>
                    <a role="link" aria-disabled="true">Edit</a> |
                    <a role="link" aria-disabled="true">Delete</a>
                <?php elseif ($data['level_pengguna'] != "admin") : ?>
                    <a href="update_pengguna.php?id_pengguna=<?= $data['id_pengguna']; ?>">Edit</a> |
                    <a href="delete_pengguna.php?id_pengguna=<?= $data['id_pengguna']; ?>" 
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete
                    </a>
                <?php else : ?>
                    <a role="link" aria-disabled="true">Edit</a> |
                    <a role="link" aria-disabled="true">Delete</a>
                <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>