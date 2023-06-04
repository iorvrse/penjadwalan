<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$query = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if( isset($_POST["submit"]) ) {
    
    if( registrasi($_POST) > 0 ) {
        echo "<script>
                alert('user baru berhasil ditambahkan!');
                document.location.href = 'pengguna.php';
            </script>";
    } else {
        echo mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav>
    
    <h1>Tambah Data pengguna</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="nama_pengguna">Nama: </label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" required>
            </li>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password">Konfirmasi password: </label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <select name="level_pengguna" id="level_pengguna">
                    <option value="user">user</option>               
                    <option value="admin">admin</option>               
                </select>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>