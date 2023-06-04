<?php
session_start();

if( !isset($_SESSION["login"]) or $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_kelas = $_GET['id_kelas'];

if( isset($_POST["submit"]) ) {

    $id_kelas = $_POST['id_kelas'];
    $id_slot = $_POST['id_slot'];
    $id_dosen = $_POST['id_dosen'];
    $id_matakuliah = $_POST['id_matakuliah'];
    $hari = $_POST['hari'];

    $query = "INSERT INTO jadwal VALUES ('', $id_slot, '$hari', $id_dosen, $id_matakuliah, $id_kelas)";
    
    mysqli_query($conn, $query);

    // cek apakah data berhasil di tambahkan atau tidak
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'detail_jadwal.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'detail_jadwal.php';
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
    <nav>
        <?php include 'navigation.php'; ?>
    </nav>
    <h1>Tambah Data Jadwal</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="id_slot">Jam:</label>
                <select name="id_slot" id="id_slot">
                    <?php 
                        $get_waktu = mysqli_query($conn, "SELECT * FROM slot_waktu");
                        $data_waktu = mysqli_fetch_assoc($get_waktu);
                    ?>
                    <?php while ($data_waktu) : ?>
                    <option value="<?= $data_waktu['id_slot']; ?>"><?= $data_waktu['slot_waktu_awal'] . "-" . $data_waktu['slot_waktu_akhir']; ?></option>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <label for="hari">Hari:</label>
                <select name="hari" id="hari">
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jum'at</option>
                </select>
            </li>
            <li>
                <label for="id_dosen">Dosen:</label>
                <select name="id_dosen" id="id_dosen">
                    <?php 
                        $get_dosen = mysqli_query($conn, "SELECT * FROM dosen");
                        $data_dosen = mysqli_fetch_assoc($get_dosen);
                        ?>
                    <?php while ($data_dosen) : ?>
                    <option value="<?= $data_dosen['id_dosen']; ?>"><?= $data_dosen['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <label for="id_matakuliah">Matakuliah:</label>
                <select name="id_matakuliah" id="id_matakuliah">
                    <?php 
                        $get_matakuliah = mysqli_query($conn, "SELECT * FROM matakuliah");
                        $data_matakuliah = mysqli_fetch_assoc($get_matakuliah);
                        ?>
                    <?php while ($data_matakuliah) : ?>
                    <option value="<?= $data_matakuliah['id_matakuliah']; ?>"><?= $data_matakuliah['nama_matakuliah']; ?></option>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>">
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>