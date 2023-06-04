<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

$id_jadwal = $_GET['id_jadwal'];

$query = "SELECT * FROM jadwal
            INNER JOIN slot_waktu
            ON jadwal.id_slot = slot_waktu.id_slot
            INNER JOIN dosen
            ON jadwal.id_dosen = dosen.id_dosen
            INNER JOIN matakuliah
            ON jadwal.id_matakuliah = matakuliah.id_matakuliah
            INNER JOIN kelas
            ON jadwal.id_kelas = kelas.id_kelas
            WHERE jadwal.id_kelas = $id_jadwal
        ";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if( isset($_POST["submit"]) ) {

    $id_kelas = $_POST['id_kelas'];
    $id_jadwal = $_POST['id_jadwal'];
    $id_slot = $_POST['id_slot'];
    $id_dosen = $_POST['id_dosen'];
    $id_matakuliah = $_POST['id_matakuliah'];
    $hari = $_POST['hari'];

    $query = "UPDATE jadwal SET id_jadwal=$id_jadwal, hari='$hari', id_slot=$id_slot, id_dosen=$id_dosen, id_matakuliah=$id_matakuliah, id_kelas=$id_kelas)";
    
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
    <h1>Update Data Jadwal</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="id_slot">Jam:</label>
                <select name="id_slot" id="id_slot">
                    <option value="<?= $data['id_slot']; ?>"><?= $data['slot_waktu_awal'] . "-" . $data['slot_waktu_akhir']; ?></option>
                    <?php 
                        $get_waktu = mysqli_query($conn, "SELECT * FROM slot_waktu");
                        $waktu = mysqli_fetch_assoc($get_waktu);
                    ?>
                    <?php while ($waktu) : ?>
                        <?php if ($waktu['id_slot'] != $data['id_slot']) : ?>
                        <option value="<?= $waktu['id_slot']; ?>"><?= $waktu['slot_waktu_awal'] . "-" . $waktu['slot_waktu_akhir']; ?></option>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <label for="hari">Hari:</label>
                <select name="hari" id="hari">
                    <option value="senin" <?= $data['hari'] == "senin" ? "selected" : ""; ?>>Senin</option>
                    <option value="selasa" <?= $data['hari'] == "selasa" ? "selected" : ""; ?>>Selasa</option>
                    <option value="rabu" <?= $data['hari'] == "rabu" ? "selected" : ""; ?>>Rabu</option>
                    <option value="kamis" <?= $data['hari'] == "kamis" ? "selected" : ""; ?>>Kamis</option>
                    <option value="jumat" <?= $data['hari'] == "jumat" ? "selected" : ""; ?>>Jum'at</option>
                </select>
            </li>
            <li>
                <label for="id_dosen">Dosen:</label>
                <select name="id_dosen" id="id_dosen">
                    <option value="<?= $data['nama']; ?>"><?= $data['nama'] ?></option>
                    <?php 
                        $get_nama = mysqli_query($conn, "SELECT * FROM dosen");
                        $nama = mysqli_fetch_assoc($get_nama);
                    ?>
                    <?php while ($nama) : ?>
                        <?php if ($nama['id_dosen'] != $data['id_jadwal']) : ?>
                        <option value="<?= $nama['id_dosen']; ?>"><?= $nama['nama']; ?></option>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <label for="id_matakuliah">Matakuliah:</label>
                <select name="id_matakuliah" id="id_matakuliah">
                    <option value="<?= $data['id_matakuliah']; ?>"><?= $data['nama_matakuliah'] ?></option>
                    <?php 
                        $get_matakuliah = mysqli_query($conn, "SELECT * FROM matakuliah");
                        $matakuliah = mysqli_fetch_assoc($get_matakuliah);
                    ?>
                    <?php while ($matakuliah) : ?>
                        <?php if ($matakuliah['id_matakuliah'] != $data['id_matakuliah']) : ?>
                        <option value="<?= $matakuliah['id_matakuliah']; ?>"><?= $matakuliah['nama_matakuliah']; ?></option>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </select>
            </li>
            <li>
                <input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>">
                <input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal']; ?>">
                <button type="submit" name="submit">Edit</button>
            </li>
        </ul>
    </form>
</body>
</html>