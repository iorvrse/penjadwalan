<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_semester = $_GET['id_semester'];
$query = "SELECT * FROM semester WHERE id_semester = $id_semester";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $tahun = htmlspecialchars($_POST['tahun']);
    $semester = $_POST['semester'];
    $id_semester = $_POST['id_semester'];

    $query = "UPDATE semester SET tahun='$tahun', semester='$semester' WHERE id_semester=$id_semester";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'semester.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
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
    <title>Document</title>
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav> 
    
    <h1>Update Data semester</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="tahun">Tahun:</label>
                <input type="text" name="tahun" id="tahun" value="<?= $data['tahun']; ?>">
            </li>
            <li>
                <label for="semester">Semester:</label>
                <select name="semester" id="semester">
                    <option value="ganjil" <?= $data['semester'] == 'ganjil' ? 'selected' : ''; ?>>ganjil</option>
                    <option value="genap" <?= $data['semester'] == 'genap' ? 'selected' : ''; ?>>genap</option>
                </select>
            </li>
            <li>
                <input type="hidden" name="id_semester" value="<?= $data['id_semester']; ?>">
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html>
