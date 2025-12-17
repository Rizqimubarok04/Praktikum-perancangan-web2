<?php

function generateID($prefix = '') {
    return $prefix . strtoupper(substr(bin2hex(random_bytes(5)), 0, 10));
}

function generateUniqueID($conn, $table, $column) {
    do {
        $id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
        $check = mysqli_query($conn, "SELECT $column FROM $table WHERE $column='$id'");
    } while (mysqli_num_rows($check) > 0);

    return $id;
}

// Fungsi khusus untuk generate user_id dengan format tertentu
function generateUserID($koneksi) {
    $query = "SELECT MAX(CAST(SUBSTRING(user_id, 3) AS UNSIGNED)) AS last_id FROM user";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    $nextID = $row['last_id'] ? $row['last_id'] + 1 : 1;
    return 'Us' . str_pad($nextID, 3, '0', STR_PAD_LEFT);
}
?>
