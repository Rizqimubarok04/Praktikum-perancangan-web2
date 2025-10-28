<?php
$host ="localhost";
$user ="root";
$pass ="";
$db ="registrasi";

$koneksi =new mysqli($host, $user, $pass, $db);
if($koneksi->connect_error){
    die("koneksi gagal: " .$koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $username  = $_POST['username'] ?? '';
    $email     = $_POST['email'] ?? '';
    $password  = $_POST['password'] ?? '';
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Query simpan ke database
    $sql = "INSERT INTO form_registrasi (username, email, password,konfirmasi_password)
            VALUES ('$username', '$email', '$password','$konfirmasi_password')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Registrasi Berhasil!<br>";
        echo "<a href='register.html'>Kembali ke Form</a><br>";
        echo "<a href='tampil.php'>Lihat Data</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

}

?>
