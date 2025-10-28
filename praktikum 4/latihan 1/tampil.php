<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data user</title>
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
            <th>Tanggal Daftar</th>
        </tr>
        <?php
        $squery = mysqli_query($koneksi,"SELECT * FROM form_pendaftaran");
        while ($row = mysqli_fetch_assoc($squery)){
       echo "<tr>
                <td>".$row['id_pendaftar']."</td>
                <td>".$row['nama_lengkap']."</td>
                <td>".$row['email']."</td>
                <td>".$row['tanggal_lahir']."</td>
                <td>".$row['alamat']."</td>
                <td>".$row['program_dipilih']."</td>
                <td>".$row['tanggal_daftar']."</td>
              </tr>";

        }?>
    </table>
</body>
</html>
