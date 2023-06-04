<?php 
session_start();

if ( isset($_SESSION['login']) and $_SESSION['level_pengguna'] != "admin" ) {
	header("Location: user/index.php");
	exit;
} elseif ( isset($_SESSION['login']) ) {
    header("Location: index.php");
	exit;
}

require 'function.php';

if (isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM pengguna WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['level_pengguna'] = $row['level_pengguna'];
            
            if ( $row['level_pengguna'] != "admin" ) {
                header("Location: user/index.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        }

    }
    
    $error = true;
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <?php if (isset($error)) : ?>
        <p style="color: red;">username atau password salah!</p>
    <?php endif; ?>

    <h1>Login</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>

    <br>
    
    <a href="register.php">Register</a>

</body>
</html>