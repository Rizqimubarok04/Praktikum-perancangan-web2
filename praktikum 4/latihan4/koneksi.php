<?php
$host ="localhost";
$user ="root";
$pass ="";
$db ="english_course";

$koneksi =new mysqli($host, $user, $pass, $db);
if($koneksi->connect_error){
    die("koneksi gagal: " .$koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $full_name  = $_POST['full_name'];
    $address     = $_POST['address'] ?? '';
    $postal_code  = $_POST['postal_code'] ?? '';
    $telephone = $_POST['telephone'];
    $place_of_birth = $_POST['place_of_birth'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $attended_school_at = $_POST['attended_school_at'];
    
    // Query simpan ke database
    $sql = "INSERT INTO tb_registration ( full_name, address, postal_code, telephone, place_of_birth, date_of_birth, gender, religion, attended_school_at)
            VALUES ('$full_name', '$address', '$postal_code','$telephone','$place_of_birth','$date_of_birth','$gender','$religion','$attended_school_at')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Registration Successfull!<br>";
        echo "<a href='form.html'>Back to Form</a><br>";

        // Tampilkan semua data dari tabel
        echo "<h3>Data Pendaftar yang Sudah Masuk</h3>";
        $result = $koneksi->query("SELECT * FROM tb_registration ORDER BY id DESC");

        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='6' cellspacing='0'>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Postal Code</th>
                        <th>Telephone</th>
                        <th>Place of Birth</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Religion</th>
                        <th>Attended School At</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['full_name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['postal_code']}</td>
                        <td>{$row['telephone']}</td>
                        <td>{$row['place_of_birth']}</td>
                        <td>{$row['date_of_birth']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['religion']}</td>
                        <td>{$row['attended_school_at']}</td>
                      </tr>";
            }
            echo "</table>";


    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

}}

?>
