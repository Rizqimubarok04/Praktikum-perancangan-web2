<?php
$host ="localhost";
$user ="root";
$pass ="";
$db ="pendaftaran";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error)
    {
    die("koneksi gagal: " . $koneksi->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$nama_lengkap    = $_POST['nama_lengkap'];
$email           = $_POST['email'];
$tanggal_lahir   = $_POST['tanggal_lahir'];
$alamat          = $_POST['alamat'];
$program_dipilih = $_POST['program_dipilih'];

// Query untuk menyimpan data
$sql = "INSERT INTO form_pendaftaran (nama_lengkap, email, tanggal_lahir,alamat, program_dipilih)
        VALUES ('$nama_lengkap', '$email', '$tanggal_lahir', '$alamat','$program_dipilih')";

if ($koneksi->query($sql) === TRUE) {
    echo "Data berhasil disimpan! <br>";
    echo "<a href='form.html'>Kembali ke Form</a>"; "<br>";
    echo "<p><a href='tampil.php'>Lihat Data</a></p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}



?>
