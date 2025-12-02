<?php
include 'koneksi.php';

$nama_lengkap    = trim($_POST['nama_lengkap']);
$email           = trim($_POST['email']);
$tanggal_lahir   = $_POST['tanggal_lahir'];
$alamat          = trim($_POST['alamat']);
$program_dipilih = trim($_POST['program_dipilih']);

$nama_foto = null;

// Upload foto baru
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nama_foto = rand(10000,999999).".".$ext;

    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$nama_foto);
}

// INSERT
$stmt = $koneksi->prepare("
    INSERT INTO form_pendaftaran 
    (nama_lengkap, email, tanggal_lahir, alamat, program_dipilih, foto)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("ssssss",
    $nama_lengkap,
    $email,
    $tanggal_lahir,
    $alamat,
    $program_dipilih,
    $nama_foto
);

if ($stmt->execute()) {
    header("Location: tampil.php");
} else {
    echo "Gagal simpan: " . $stmt->error;
}
