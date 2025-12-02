<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Utama</title>
</head>
<body>

<h2>Login anda : <?php echo $_SESSION['username']; ?></h2>
<p>Ini di halaman utama</p>

<a href="logout.php">Logout</a>

</body>
</html>
