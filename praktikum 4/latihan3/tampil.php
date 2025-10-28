<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data</title>
</head>
<body>
    <h2>Data yang Terdaftar</h2>
     <a href="register.html">Tambah Data Baru</a> <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>id</th>
            <th>username</th>
            <th>Email</th>
            <th>password</th>
            <th>konfirmasi password</th>
        </tr>
        <?php
        $sql = mysqli_query($koneksi,"SELECT * FROM form_registrasi");
        while ($row = mysqli_fetch_assoc($sql)){
       echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['username']."</td>
                <td>".$row['email']."</td>
                <td>".$row['password']."</td>
                <td>".$row['konfirmasi_password']."</td>
              </tr>";

        }?>
    </table>
</body>
</html>
