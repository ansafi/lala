<?php
// Parameter koneksi
$servername = "localhost";  // Sesuaikan dengan host dan service name Oracle kamu
$username = "merchantry";
$password = "system";

// Membuat koneksi ke database Oracle
$conn = oci_connect($username, $password, $servername);

// Mengecek koneksi
if (!$conn) {
    $e = oci_error();
    die("Koneksi gagal: " . htmlentities($e['message']));
} else {
    echo "Koneksi berhasil";
}

// Tutup koneksi
oci_close($conn);
?>
