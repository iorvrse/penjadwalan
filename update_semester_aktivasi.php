<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_semester = $_GET['id_semester'];
$status = $_GET['status'];

$result = mysqli_query($conn, "SELECT * FROM semester WHERE status='1'");

if (mysqli_num_rows($result) > 0) {
    if ($status == 1){
        $query = "UPDATE semester SET status='0' WHERE id_semester='$id_semester'";
        mysqli_query($conn, $query);
    } else {
        echo "<script>
                alert 'non-aktifkan semester yang sedang aktif terlebih dahulu';
            <script>"
        ;
        header('Location: semester.php');
    }
} else{
    $status = $status == 0 ? 1 : 0;
    $query = "UPDATE semester SET status='$status' WHERE id_semester='$id_semester'";
    mysqli_query($conn, $query);
}

header("Location: semester.php");
?>