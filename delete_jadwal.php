<?php 
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$id = $_GET['id_jadwal'];

if (delete('jadwal', 'id_jadwal', $id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus!');
            document.location.href = 'jadwal.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus!');
            document.location.href = 'jadwal.php';
        </script>
    ";
}

?>