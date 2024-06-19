<?php
require 'koneksi.php';

$username = $_POST["username"];
$password = $_POST["password"];
// $confpass = $_POST["confpass"];
$email = $_POST["email"];
$telepon = $_POST["telepon"];
$alamat = $_POST["alamat"];
$role = $_POST["role"]; // Tambahkan field role di form registrasi

// if ($password !== $confpass) {
//     die("Password dan konfirmasi password tidak sama.");
// }

function generateUniqueID($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Buat ID unik
$id_pelanggan = generateUniqueID(16); // Menggunakan fungsi generateUniqueID dengan panjang 16 karakter

// Hash password untuk keamanan
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Tentukan tabel dan nama kolom berdasarkan role
$tabel = ($role == "Admin") ? "ADMIN" : "PELANGGAN";
$id_column = ($role == "Admin") ? "ID_ADMIN" : "ID_PELANGGAN";
$username_column = ($role == "Admin") ? "NAMA_ADMIN" : "NAMA_PELANGGAN";
$password_column = ($role == "Admin") ? "PASSWORD_ADMIN" : "PASSWORD";
$email_column = ($role == "Admin") ? "EMAIL_ADMIN" : "EMAIL";
$telepon_column = ($role == "Admin") ? "NO_TELP" : "NO_TELP";
$alamat_column = ($role == "Admin") ? "ALAMAT_ADMIN" : "ALAMAT";

// Query untuk menyimpan data ke database
$query_sql = "INSERT INTO $tabel ($id_column, $username_column,$email_column, $telepon_column, $alamat_column, $password_column)
              VALUES (:ID_PELANGGAN, :NAMA_PELANGGAN, :EMAIL, :NO_TELP, :ALAMAT, :PASSWORD)";

$stid = oci_parse($conn, $query_sql);
oci_bind_by_name($stid, ':ID_PELANGGAN', $id_pelanggan);
oci_bind_by_name($stid, ':NAMA_PELANGGAN', $username);
oci_bind_by_name($stid, ':EMAIL', $email);
oci_bind_by_name($stid, ':NO_TELP', $telepon);
oci_bind_by_name($stid, ':ALAMAT', $alamat);
oci_bind_by_name($stid, ':PASSWORD', $password);

if (oci_execute($stid)) {
    header("Location: Login.html");
    exit();
} else {
    $e = oci_error($stid);
    echo "Pendaftaran gagal: " . htmlentities($e['message']);
}

// Tutup koneksi
oci_free_statement($stid);
oci_close($conn);
?>
