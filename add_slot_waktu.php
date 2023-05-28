<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

if( isset($_POST["submit"]) ) {

    $waktu_slot_awal = $_POST['waktu_slot_awal'];
    $waktu_slot_akhir = $_POST['waktu_slot_akhir'];
    $hari_slot = $_POST['hari_slot'];

    $query = "INSERT INTO slot_waktu VALUES ('', '$waktu_slot_awal', '$waktu_slot_akhir', '$hari_slot')";
    
    mysqli_query($conn, $query);

    // cek apakah data berhasil di tambahkan atau tidak
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'slot_waktu.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'slot_waktu.php';
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
    <h1>Tambah Data Slot Waktu</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="waktu_slot_awal">Jam mulai:</label>
                <input type="text" name="waktu_slot_awal">
            </li>
            <li>
                <label for="waktu_slot_akhir">Jam akhir:</label>
                <input type="text" name="waktu_slot_akhir">
            </li>
            <li>
                <label for="hari_slot">Hari:</label>
                <input type="text" name="hari_slot">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>