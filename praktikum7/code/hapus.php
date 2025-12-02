<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file foto dulu
    $queryFoto = $koneksi->query("SELECT foto FROM form_pendaftaran WHERE id_pendaftar = '$id'");
    $data = $queryFoto->fetch_assoc();
    $namaFoto = $data['foto'];

    // Hapus data dari database
    $sql = "DELETE FROM form_pendaftaran WHERE id_pendaftar = '$id'";

    if ($koneksi->query($sql) === TRUE) {
        // Hapus file foto jika ada
        if (!empty($namaFoto) && file_exists("uploads/$namaFoto")) {
            unlink("uploads/$namaFoto");
        }

        echo "Data berhasil dihapus!";
        echo "<br><a href='tampil.php'>Kembali</a>";
    } else {
        echo "Error menghapus data: " . $koneksi->error;
    }
}
?>
