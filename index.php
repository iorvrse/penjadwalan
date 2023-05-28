<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan</title>
</head>
<body>
    <h1>Aplikasi Penjadwalan</h1>
    <nav>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="dosen.php">Database Dosen</a></li>
            <li><a href="semester.php">Database Semester</a></li>
            <li><a href="slot_waktu.php">Database Slot Waktu</a></li>
        </ul>
    </nav>
</body>
</html>