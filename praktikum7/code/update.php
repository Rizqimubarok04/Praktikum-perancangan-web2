<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = trim($_POST['nama_lengkap']);
$email = trim($_POST['email']);
$tanggal = $_POST['tanggal_lahir'];
$alamat = trim($_POST['alamat']);
$program = trim($_POST['program_dipilih']);

$cek = $koneksi->prepare(
    "SELECT id_pendaftar FROM form_pendaftaran WHERE email = ? AND id_pendaftar != ?"
);
$cek->bind_param("si", $email, $id);
$cek->execute();
$hasil = $cek->get_result();

if ($hasil->num_rows > 0) {
    die("Email sudah digunakan oleh pendaftar lain!");
}


// Mengambil data lama (untuk foto lama)
$getFoto = $koneksi->prepare("SELECT foto FROM form_pendaftaran WHERE id_pendaftar = ?");
$getFoto->bind_param("i", $id);
$getFoto->execute();
$fotoLama = $getFoto->get_result()->fetch_assoc()['foto'];

$nama_foto_baru = $fotoLama;

// Jika upload foto baru
if ($_FILES['foto']['error'] === 0) {

    $tmp  = $_FILES['foto']['tmp_name'];
    $name = rand(10000, 999999) . "_" . $_FILES['foto']['name'];

    move_uploaded_file($tmp, "uploads/" . $name);

    // Hapus foto lama jika ada
    if ($fotoLama && file_exists("uploads/" . $fotoLama)) {
        unlink("uploads/" . $fotoLama);
    }

    $nama_foto_baru = $name;
}

// UPDATE
$update = $koneksi->prepare("
    UPDATE form_pendaftaran 
    SET nama_lengkap=?, email=?, tanggal_lahir=?, alamat=?, program_dipilih=?, foto=?
    WHERE id_pendaftar=?
");

$update->bind_param("ssssssi", $nama, $email, $tanggal, $alamat, $program, $nama_foto_baru, $id);

if ($update->execute()) {
    echo "Data berhasil diupdate! <br><a href='tampil.php'>Kembali</a>";
} else {
    echo "Gagal update: " . $update->error;
}
