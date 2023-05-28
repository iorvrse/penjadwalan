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
    
    $waktu_slot_awal = htmlspecialchars($_POST['waktu_slot_awal']);
    $waktu_slot_akhir = htmlspecialchars($_POST['waktu_slot_akhir']);
    $hari_slot = htmlspecialchars($_POST['hari_slot']);
    $id_slot = $_POST['id_slot'];

    $query = "UPDATE slot_waktu SET
        waktu_slot_awal='$waktu_slot_awal',
        waktu_slot_akhir='$waktu_slot_akhir',
        hari_slot='$hari_slot'
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

<form action="" method="post">
    <h1>Update Data slot_waktu</h1>
    <ul>
        <li>
            <label for="waktu_slot_awal">Jam awal:</label>
            <input type="text" name="waktu_slot_awal" id="waktu_slot_awal" value="<?= $data['waktu_slot_awal']; ?>">
        </li>
        <li>
            <label for="waktu_slot_akhir">Jam akhir:</label>
            <input type="text" name="waktu_slot_akhir" id="waktu_slot_akhir" value="<?= $data['waktu_slot_akhir']; ?>">
        </li>
        <li>
            <label for="hari_slot">Hari:</label>
            <input type="text" name="hari_slot" id="hari_slot" value="<?= $data['hari_slot']; ?>">
        </li>
        <li>
            <input type="hidden" name="id_slot" value="<?= $data['id_slot']; ?>">
            <button type="submit" name="submit">Edit</button>
        </li>
    </ul>
</form>