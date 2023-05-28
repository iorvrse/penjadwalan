<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_dosen = $_GET['id_dosen'];
$query = "SELECT * FROM dosen WHERE id_dosen = $id_dosen";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $bidang_ilmu = htmlspecialchars($_POST['bidang_ilmu']);
    $id_dosen = $_POST['id_dosen'];

    $query = "UPDATE dosen SET nama='$nama', nip='$nip', bidang_ilmu='$bidang_ilmu' WHERE id_dosen=$id_dosen";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'dosen.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'dosen.php';
            </script>
        ";
    }

}

?>

<form action="" method="post">
    <h1>Update Data Dosen</h1>
    <ul>
        <li>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?= $data['nama']; ?>">
        </li>
        <li>
            <label for="nip">NIP:</label>
            <input type="text" name="nip" id="nip" value="<?= $data['nip']; ?>">
        </li>
        <li>
            <label for="bidang_ilmu">Bidang Ilmu:</label>
            <input type="text" name="bidang_ilmu" id="bidang_ilmu" value="<?= $data['bidang_ilmu']; ?>">
        </li>
        <li>
            <input type="hidden" name="id_dosen" value="<?= $data['id_dosen']; ?>">
            <button type="submit" name="submit">Edit</button>
        </li>
    </ul>
</form>