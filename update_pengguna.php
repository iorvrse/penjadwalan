<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_pengguna = $_GET['id_pengguna'];
$query = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $level_pengguna = $_POST['level_pengguna'];
    $id_pengguna = $_POST['id_pengguna'];

    $query = "UPDATE pengguna SET
                level_pengguna='$level_pengguna'
            WHERE
                id_pengguna=$id_pengguna
    ";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'pengguna.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'pengguna.php';
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
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav> 

    <h1>Update Data Pengguna</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="nama_pengguna">Nama:</label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" value="<?= $data['nama_pengguna']; ?>" disabled>
            </li>
            <li>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?= $data['username']; ?>" disabled>
            </li>
            <li>
                <!-- <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password">Konfirmasi Password:</label>
                <input type="password" name="password2" id="password2">
            </li> -->
            <li>
                <label for="level_pengguna">Privilege:</label>
                <select name="level_pengguna" id="level_pengguna">
                    <option value="user" <?= $data['level_pengguna'] == "user" ? "selected" : ""; ?>>user</option>
                    <option value="admin" <?= $data['level_pengguna'] == "admin" ? "selected" : ""; ?>>admin</option>
                </select>
            </li>
            <li>
                <input type="hidden" name="id_pengguna" value="<?= $data['id_pengguna']; ?>">
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html>
