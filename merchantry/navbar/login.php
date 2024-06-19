<?php
require 'koneksi.php';

$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"]; // Ambil role dari form login

// Tentukan tabel dan kolom email dan password berdasarkan role
$tabel = ($role == "Admin") ? "ADMIN" : "PELANGGAN";
$email_column = ($role == "Admin") ? "EMAIL_ADMIN" : "EMAIL";
$password_column = ($role == "Admin") ? "PASSWORD_ADMIN" : "PASSWORD";

// Query untuk memeriksa keberadaan email dan password di database
$query_sql = "SELECT * FROM $tabel
                WHERE $email_column = :EMAIL AND $password_column = :PASSWORD";

$stid = oci_parse($conn, $query_sql);
oci_bind_by_name($stid, ':EMAIL', $email);
oci_bind_by_name($stid, ':PASSWORD', $password);
oci_execute($stid);

// Hitung jumlah baris yang ditemukan
$row_count = oci_fetch_all($stid, $results);

if ($row_count > 0) {
    // Email dan password cocok, arahkan ke halaman beranda atau dashboard sesuai role
    if ($role == "Admin") {
        header("Location: ../admin/index.html");
    } else {
        header("Location:../index.html ");
    }
    exit();
} else {
    // Email atau password tidak cocok
    echo "<center><h1>Email atau password Anda salah. Silakan coba lagi.</h1>";
    echo "<button><strong><a href='Login.html'>Login</a></strong></button></center>";
}

// Tutup koneksi dan statement
oci_free_statement($stid);
oci_close($conn);
?>
