<?php
$host ="localhost";
$user ="root";
$pass ="";
$db ="validasi";

$koneksi =new mysqli($host, $user, $pass, $db);
if($koneksi->connect_error){
    die("koneksi gagal: " .$koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $website = $_POST['website'] ?? '';
    $comment = $_POST['comment'] ?? '';
    $gender  = $_POST['gender'] ?? '';

    // Validasi sederhana
    if (empty($name) || empty($email) || empty($gender)) {
        echo "Nama, Email, dan Gender wajib diisi!";
        exit;
    }

    // Query simpan ke database
    $sql = "INSERT INTO form_validasi (name, email, website, comment, gender)
            VALUES ('$name', '$email', '$website', '$comment', '$gender')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil disimpan!<br>";
        echo "<a href='form.html'>Kembali ke Form</a><br>";
        echo "<a href='tampil.php'>Lihat Data</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

}

?>
