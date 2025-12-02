<?php
include 'koneksi.php'; 

$sql = "SELECT id_pendaftar, nama_lengkap, email, tanggal_lahir, alamat, program_dipilih, foto, tanggal_daftar 
        FROM form_pendaftaran 
        ORDER BY id_pendaftar DESC";

$result = $koneksi->query($sql);

if (!$result) {
    die("Query Gagal: " . $koneksi->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
</head>
<body>
    <h2>Data Pendaftar</h2>
    <a href="form.html">Tambah Data Baru</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>Id Pendaftar</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Program dipilih</th>
            <th>Foto</th>
            <th>Tanggal Daftar</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['id_pendaftar']); ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td><?= htmlspecialchars($row['program_dipilih']); ?></td>
                <td>
                    <?php if (!empty($row['foto'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['foto']); ?>" 
                             alt="Foto Pendaftar" 
                             style="max-width: 100px; height: auto;">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['tanggal_daftar']); ?></td>
                <td>
                <a href="edit.php?id=<?php echo $row['id_pendaftar']; ?>">Edit</a>
                <a href="hapus.php?id=<?php echo $row['id_pendaftar']; ?>" 
                onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                </td>

            </tr>
        <?php } ?>
    </table>
    <?php $koneksi->close(); ?>
</body>
</html>
