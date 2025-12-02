<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran User</title>
</head>
<body>

<h2>Pendaftaran User</h2>
<form method="POST">
    Username : <input type="text" name="username" required><br><br>
    Password : <input type="password" name="password" required><br><br>
    Re-type Password : <input type="password" name="password2" required><br><br>
    Gender :
    <input type="radio" name="gender" value="Laki-laki" required> Laki-laki
    <input type="radio" name="gender" value="Perempuan" required> Perempuan<br><br>

    <button type="submit" name="daftar">Sign Up</button>
</form>

<?php
if (isset($_POST['daftar'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $gender = $_POST['gender'];

    if ($pass != $pass2) {
        echo "<p>Password tidak sama!</p>";
    } else {
        // Enkripsi password
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO login (username, password, gender)
                VALUES ('$user', '$hash', '$gender')";

        if ($koneksi->query($sql)) {
            echo "<p><b>User berhasil terdaftar</b></p>";
        } else {
            echo "Gagal: " . $koneksi->error;
        }
    }
}
?>
<br>
<a href="login.php">Kembali ke Login</a>
</body>
</html>
