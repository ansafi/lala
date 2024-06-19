<?php
// Sertakan file koneksi.php yang berisi koneksi OCI
include 'koneksi.php';

// Tangkap data yang dikirimkan melalui form
$nama = $_POST['nama'];
$email = $_POST['email'];
$ide = $_POST['ide'];
$tanggal_vote = date("Y-m-d H:i:s"); // Mengambil tanggal saat ini
$jumlah_vote = 0; // Jumlah vote awal adalah 0

// Query untuk menyimpan data ke database
$query = "INSERT INTO ide_voting (nama, email, ide, tanggal_vote, jumlah_vote) VALUES ('$nama', '$email', '$ide', TO_DATE('$tanggal_vote', 'YYYY-MM-DD HH24:MI:SS'), $jumlah_vote)";

// Eksekusi query
$result = oci_parse($conn, $query);
oci_execute($result);

// Redirect ke halaman yang diinginkan setelah data disimpan
header("Location: index.php");
exit();
?>
