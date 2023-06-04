<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_kelas = $_GET['id_kelas'];
$query = "SELECT * FROM kelas INNER JOIN semester ON kelas.id_semester = semester.id_semester WHERE id_kelas = $id_kelas";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$result2 = mysqli_query($conn, "SELECT * FROM semester");
$semester = mysqli_fetch_assoc($result2);

if (isset($_POST['submit'])) {
    
    $kelas = htmlspecialchars($_POST['kelas']);
    $id_semester = $_POST['id_semester'];
    $id_kelas = $_POST['id_kelas'];

    $query = "UPDATE kelas SET kelas='$kelas', id_semester=$id_semester WHERE id_kelas=$id_kelas";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'kelas.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
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
    <title>Document</title>
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav> 

    <h1>Update Data kelas</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" id="kelas" value="<?= $data['kelas']; ?>">
            </li>
            <li>
                <label for="id_semester">Tahun / Semester:</label>
                <select name="id_semester" id="id_semester">
                    <option value="<?= $data['id_semester']; ?>"><?= $data['tahun'] . " " . $data['semester']; ?></option>
                    <?php while ($semester) : ?>
                        <?php if ($semester['id_semester'] != $data['id_semester']) : ?>
                        <option value="<?= $semester['id_semester']; ?>"><?= $semester['tahun'] . " " . $semester['semester']; ?></option>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>">
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html>
