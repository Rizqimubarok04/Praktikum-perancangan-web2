<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("Error: ID tidak ditemukan.");
}

$id = $_GET['id'];

// Prepared Statement untuk keamanan
$stmt = $koneksi->prepare("SELECT * FROM form_pendaftaran WHERE id_pendaftar = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
<h2>Edit Data Pendaftar</h2>

<form action="update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data['id_pendaftar']; ?>">

    Nama Lengkap:<br>
    <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>"><br><br>

    Email:<br>
    <input type="email" name="email" value="<?php echo $data['email']; ?>"><br><br>

    Tanggal Lahir:<br>
    <input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>"><br><br>

    Alamat:<br>
    <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>"><br><br>

    Program Dipilih:<br>
    <select name="program_dipilih">
        <option value="Teknik Informatika" <?php echo ($data['program_dipilih'] == "Teknik Informatika") ? "selected" : ""; ?>>Teknik Informatika</option>
        <option value="Teknik Mesin" <?php echo ($data['program_dipilih'] == "Teknik Mesin") ? "selected" : ""; ?>>Teknik Mesin</option>
    </select>
    <br><br>

    Foto Saat Ini:<br>
    <?php if ($data['foto']) { ?>
        <img src="uploads/<?php echo $data['foto']; ?>" width="100"><br>
    <?php } ?>

    Ganti Foto (opsional):<br>
    <input type="file" name="foto"><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
