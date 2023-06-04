<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'jadwal_kuliah';

$conn = mysqli_connect($hostname, $username, $password, $database);

function delete($tabel, $id_tabel, $id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM $tabel WHERE $id_tabel = $id");
    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes(trim(($data["username"]))));
    $nama_pengguna = htmlspecialchars($data["nama_pengguna"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $level_pengguna = $data["level_pengguna"];

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('Username sudah terdaftar!');
            </script>"
        ;
        return false;
    }


    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>"
        ;
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO pengguna VALUES('', '$username', '$password', '$nama_pengguna', '$level_pengguna')");

    return mysqli_affected_rows($conn);

}

?>