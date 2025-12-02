<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Proses Login</h2>
<form method="POST">
    Username : <input type="text" name="username" required><br><br>
    Password : <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM login WHERE username='$user'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();


        if (password_verify($pass, $data['password'])) {
            $_SESSION['username'] = $user;
            header("Location: halaman_utama.php");
            exit();
        } else {
            echo "<p>Password salah!</p>";
        }
    } else {
        echo "<p>Username tidak ditemukan</p>";
    }
}
?>
<br>
<a href="form_daftar.php">Daftar User Baru</a>

</body>
</html>
