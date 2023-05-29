<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

if( isset($_POST["submit"]) ) {

    $tahun = $_POST['tahun'];
    $semester = $_POST['semester'];

    $query = "INSERT INTO semester VALUES ('', '$tahun', '$semester', 0)";
    
    mysqli_query($conn, $query);

    // cek apakah data berhasil di tambahkan atau tidak
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'semester.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'semester.php';
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
    <title></title>
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav>
    
    <h1>Tambah Data semester</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="tahun">Tahun:</label>
                <input type="text" name="tahun">
            </li>
            <li>
                <label for="semester">Semester:</label>
                <input type="text" name="semester">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>