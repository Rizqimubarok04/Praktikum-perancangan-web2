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
    <h2>Data Validation</h2>
    <a href="form.html">Tambah Data Baru</a> <br> <br>
    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Website</th>
            <th>Komentar</th>
            <th>Gender</th>
        </tr>
        <?php
        $squery = mysqli_query($koneksi,"SELECT * FROM form_validasi");
        while ($row = mysqli_fetch_assoc($squery)){
       echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['website']."</td>
                <td>".$row['comment']."</td>
                <td>".$row['gender']."</td>
              </tr>";

        }?>
    </table>
</body>
</html>
