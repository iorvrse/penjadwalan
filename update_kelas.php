<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
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
    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">

        <?php include 'navigation.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
                    <h1 class="text-gray-800">Update Data Kelas</h1>
                </div>
        
                <div class="row">
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
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
