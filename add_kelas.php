<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$query = "SELECT * FROM semester";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if( isset($_POST["submit"]) ) {

    $kelas = $_POST['kelas'];
    $semester = $_POST['id_semester'];

    $query = "INSERT INTO kelas VALUES ('', '$kelas', $id_semester)";
    
    mysqli_query($conn, $query);

    // cek apakah data berhasil di tambahkan atau tidak
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'kelas.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'kelas.php';
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
    <h1>Tambah Data Kelas</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas">
            </li>
            <li>
                <label for="id_semester">Tahun / Semester:</label>
                <select name="id_semester" id="id_semester">
                    
                <?php while ($data) : ?>
                    <option value="<?= $data['id_semester']; ?>"><?= $data['tahun'] . " " . $data['semester']; ?></option>
                <?php endwhile; ?>

                </select>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>