<?php
// $host = 'DESKTOP-GGPP0QM';  // Sesuaikan dengan nama host Oracle kamu
// $port = '1521';  // Sesuaikan dengan port yang digunakan oleh Oracle
// $sid = 'xe';  // Sesuaikan dengan SID atau service name Oracle kamu
// $username = 'MERCHANTRY';  // Sesuaikan dengan username Oracle kamu
// $password = 'system';  // Sesuaikan dengan password Oracle kamu

// $conn = oci_($username, $password, "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVER = DEDICATED)(SID=$sid)))");

$conn = oci_connect("MERCHANTRY", "system", "Localhost/XE");
if(!$conn) {
    $e = oci_error();
    die("Koneksi gagal: " . htmlentities($e['message']));
} else {
    echo "Koneksi berhasil";
}

// Tutup koneksi
// oci_close($conn);
?>
