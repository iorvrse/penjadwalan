<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_slot = $_GET['id_slot'];
$query = "SELECT * FROM slot_waktu WHERE id_slot = $id_slot";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $waktu_slot_awal = $_POST['waktu_slot_awal'];
    $waktu_slot_akhir = $_POST['waktu_slot_akhir'];
    $slot_hari = $_POST['slot_hari'];
    $id_slot = $_POST['id_slot'];

    $query = "UPDATE slot_waktu SET
        waktu_slot_awal='$waktu_slot_awal',
        waktu_slot_akhir='$waktu_slot_akhir',
        slot_hari='$slot_hari'
        WHERE id_slot=$id_slot"
    ;
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'slot_waktu.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
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
    <title>Document</title>
</head>
<body>
    <nav>
        <?php include 'navigation.php'; ?>
    </nav> 
    
    <h1>Update Data slot_waktu</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="waktu_slot_awal">Jam awal:</label>
                <input type="time" name="waktu_slot_awal" id="waktu_slot_awal" value="<?= $data['waktu_slot_awal']; ?>">
            </li>
            <li>
                <label for="waktu_slot_akhir">Jam akhir:</label>
                <input type="time" name="waktu_slot_akhir" id="waktu_slot_akhir" value="<?= $data['waktu_slot_akhir']; ?>">
            </li>
            <li>
                <label for="slot_hari">Hari:</label>
                <select name="slot_hari" id="slot_hari">
                    <option value="senin" <?= $data['slot_hari'] == 'senin' ? 'selected' : ''; ?>>Senin</option>
                    <option value="selasa" <?= $data['slot_hari'] == 'selasa' ? 'selected' : ''; ?>>Selasa</option>
                    <option value="rabu" <?= $data['slot_hari'] == 'rabu' ? 'selected' : ''; ?>>Rabu</option>
                    <option value="kamis" <?= $data['slot_hari'] == 'kamis' ? 'selected' : ''; ?>>Kamis</option>
                    <option value="jumat" <?= $data['slot_hari'] == 'jumat' ? 'selected' : ''; ?>>Jumat</option>
                </select>
            </li>
            <li>
                <input type="hidden" name="id_slot" value="<?= $data['id_slot']; ?>">
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html>
