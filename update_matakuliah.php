<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_matakuliah = $_GET['id_matakuliah'];
$query = "SELECT * FROM matakuliah WHERE id_matakuliah = $id_matakuliah";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $nama_matakuliah = htmlspecialchars($_POST['nama_matakuliah']);
    $id_matakuliah = $_POST['id_matakuliah'];

    $query = "UPDATE matakuliah SET nama_matakuliah='$nama_matakuliah' WHERE id_matakuliah=$id_matakuliah";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'matakuliah.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'matakuliah.php';
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

    <h1>Update Data Matakuliah</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="nama_matakuliah">Matakuliah:</label>
                <input type="text" name="nama_matakuliah" id="nama_matakuliah" value="<?= $data['nama_matakuliah']; ?>">
            </li>
            <li>
                <input type="hidden" name="id_matakuliah" value="<?= $data['id_matakuliah']; ?>">
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html>
