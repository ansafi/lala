<?php
require 'koneksi.php';

$productName = $_POST["productName"];
$productPrice = $_POST["productPrice"];
$productStock = $_POST["productStock"];
$productImage = $_POST["productImage"];
$productSuplier = $_POST["productSuplier"];


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
$id_produk = generateUniqueID(8); // Menggunakan fungsi generateUniqueID dengan panjang 16 karakter

// Query untuk menyimpan data ke database
$query_sql = "INSERT INTO PRODUK ($id_produk, $productName, $productPrice, $productStock, $productImage, $productSuplier, $password_column)
              VALUES (:ID_PRODUK, :NAMA_PRODUK, :HARGA, :STOK, :GAMBAR, :SUPLIER_ID_SUPLIER)";

$stid = oci_parse($conn, $query_sql);
oci_bind_by_name($stid, ':ID_PRODUK', $id_produk);
oci_bind_by_name($stid, ':NAMA_PRODUK', $productName);
oci_bind_by_name($stid, ':HARGA', $productPrice);
oci_bind_by_name($stid, ':STOK', $productStock);
oci_bind_by_name($stid, ':GAMBAR', $productImage);
oci_bind_by_name($stid, ':SUPLIER_ID_SUPLIER', $productSuplier);

if (oci_execute($stid)) {
    header("Location: produk.html");
    exit();
} else {
    $e = oci_error($stid);
    echo "Pendaftaran gagal: " . htmlentities($e['message']);
}

// Tutup koneksi
oci_free_statement($stid);
oci_close($conn);
?>
