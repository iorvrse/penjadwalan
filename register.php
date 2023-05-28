<?php 

require 'function.php';

if( isset($_POST["submit"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
			    alert('User baru berhasil ditambahkan!');
			</script>";
        header("Location: login.php");
	} else {
		echo mysqli_error($conn);
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <h1>Register</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nama_pengguna">Nama: </label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" required>
            </li>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="username">Password: </label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password">Konfirmasi password: </label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <label for="level_pengguna">Role: </label>
                <select name="level_pengguna" id="level_pengguna">
                    <option value="admin">Admin</option>
                    <option value="staff">Staff Akademik</option>
                </select>
            </li>
            <li>
                <button type="submit" name="submit">Register</button>
            </li>
        </ul>
    </form>

</body>
</html>