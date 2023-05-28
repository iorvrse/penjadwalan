<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_semester = $_GET['id_semester'];
$status = $_GET['status'];

if (isset($id_semester) && isset($status)) {

    if ($status == 0) {
        // Update semua semester menjadi tidak aktif (status = 0)
        $query = "UPDATE semester SET status = 0";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Set semester yang dipilih menjadi aktif (status = 1)
            $query = "UPDATE semester SET status = 1 WHERE id_semester = '$id_semester'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Redirect ke halaman semester.php
                header("Location: semester.php");
                exit;
            }
        }
    }
}

// Redirect jika error
header("Location: semester.php");
exit;

?>