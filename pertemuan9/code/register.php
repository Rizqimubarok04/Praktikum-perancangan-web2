<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';
include 'function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password_plain = $_POST['password'];
    $posisi = trim($_POST['posisi']);

    $user_id = generateUserID($koneksi);
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($koneksi,
        "INSERT INTO user (user_id, username, password, email, nama, posisi)
         VALUES (?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, 'ssssss',
        $user_id, $username, $password_hash, $email, $nama, $posisi
    );

    if (mysqli_stmt_execute($stmt)) {

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rizqimbrk19@gmail.com';
            $mail->Password = 'jqweeszdqsuoohlj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('rizqimbrk19@gmail.com', 'Sistem Informasi TPQ');
            $mail->addAddress($email, $nama);

            $mail->isHTML(true);
            $mail->Subject = 'Akun TPQ Berhasil Dibuat'; 
            $mail->Body = " <h3>Assalamu'alaikum, 
            $nama</h3> <p>Akun Anda berhasil dibuat.</p> <table> <tr><td><b>Username</b></td><td>: 
            $username</td></tr> <tr><td><b>Password</b></td><td>: 
            $password_plain</td></tr> <tr><td><b>Posisi</b></td><td>: 
            $posisi</td></tr> </table> <p>Silakan login menggunakan username dan password diatas .</p> ";
            $mail->send();

            echo "<script>alert('Registrasi berhasil, cek email'); location='login.php';</script>";

        } catch (Exception $e) {
            echo "Email gagal dikirim: {$mail->ErrorInfo}";
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
    <style>
        body { font-family: Arial; padding: 20px; justify-self: center; align-items: center;}
        form { max-width: 400px; margin: auto;}
        input { width: 100%; padding: 10px; margin: 8px 0; }
        button { padding: 10px; width: 100%; background: #28a745; color: white; border: none; }
        .footer {
    margin-top: 20px;
    font-size: 12px;
    }
    h2{
        text-align: center;
    }
    .box {
    width: 350px;
    background: white;
    padding: 30px 35px;
    border-radius: 30px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    }
    </style>
</head>
<body>
<h2>Daftar Akun Baru</h2>
<div class="box">
<form action="" method="POST">
    <label>Nama Lengkap</label>
    <input type="text" name="nama" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Posisi</label>
    <select name="posisi" required>
        <option value="">-- Pilih Posisi --</option>
        <option value="admin">Admin</option>
        <option value="kepala">Kepala TPQ</option>
        <option value="pengajar">Guru</option>
        <option value="santri">Santri</option>
    </select>

    <button type="submit">Daftar</button>
</form>
<p>Sudah punya akun? <a href="login.php">Login</a></p>
    <p class="footer">@ 25 Sistem Informasi TPQ</p>
</div>
</body>
</html>

