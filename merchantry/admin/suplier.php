<?php
include 'koneksi.php';

// Ambil data dari form jika ada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin = $_POST['id_admin'];
    $nama_suplier = $_POST['suplierName'];
    $nama_toko = $_POST['storeName'];
    $no_telp = $_POST['call'];
    $produk_disuply = $_POST['jumlah'];
    $tanggal_datang = $_POST['tanggal'];

    // Query untuk memeriksa keberadaan ID admin di tabel admin
    $query_admin = "SELECT * FROM ADMIN WHERE ID_ADMIN = :id_admin";
    $stid_admin = oci_parse($conn, $query_admin);
    oci_bind_by_name($stid_admin, ':id_admin', $id_admin);
    oci_execute($stid_admin);
    $admin_exists = oci_fetch_assoc($stid_admin);

    if ($admin_exists) {
        // Generate ID suplier
        function generateRandomID($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $randomString;
        }
        $id_suplier = generateRandomID();

        // Query untuk memasukkan data ke dalam tabel suplier
        $sql = "INSERT INTO SUPLIER (ID_SUPLIER, NAMA_SUPLIER, NAMA_TOKO, NO_TELP, PRODUK_YANG_DISUPLY, TANGGAL_DATANG, ADMIN_ID_ADMIN)
                VALUES (:id_suplier, :nama_suplier, :nama_toko, :no_telp, :produk_disuply, TO_DATE(:tanggal_datang, 'YYYY-MM-DD'), :id_admin)";

        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':id_suplier', $id_suplier);
        oci_bind_by_name($stid, ':nama_suplier', $nama_suplier);
        oci_bind_by_name($stid, ':nama_toko', $nama_toko);
        oci_bind_by_name($stid, ':no_telp', $no_telp);
        oci_bind_by_name($stid, ':produk_disuply', $produk_disuply);
        oci_bind_by_name($stid, ':tanggal_datang', $tanggal_datang);
        oci_bind_by_name($stid, ':id_admin', $id_admin);

        if (oci_execute($stid)) {
            echo "Data suplier berhasil ditambahkan";
            header("Location: suplier.html");
            exit();
        } else {
            $e = oci_error($stid);
            echo "Pendaftaran gagal: " . htmlentities($e['message']);
        }
        oci_free_statement($stid);
    } else {
        echo "<center><h1>ID Admin tidak valid. Harap masukkan ID Admin yang valid.</h1>";
        echo "<button><strong><a href='suplier.html'>Kembali</a></strong></button></center>";
    }
    oci_free_statement($stid_admin);
    oci_close($conn);
}

// Tampilkan data suplier

function select($query) {
    global $conn;

    $statement = oci_parse($conn, $query);
    oci_execute($statement);

    $rows = [];
    while ($row = oci_fetch_assoc($statement)) {
        $rows[] = $row;
    }

    return $rows;
}

// Contoh penggunaan fungsi selectSuplier dengan query SELECT *
$data_suplier = select("SELECT * FROM SUPLIER");

foreach ($data_suplier as $SUPLIER) : ?>
    <tr>
        <td><?= $SUPLIER['ADMIN_ID_ADMIN']; ?></td>
        <td><?= $SUPLIER['ID_SUPLIER']; ?></td>
        <td><?= $SUPLIER['NAMA_SUPLIER']; ?></td>
        <td><?= $SUPLIER['NAMA_TOKO']; ?></td>
        <td><?= $SUPLIER['NO_TELP']; ?></td>
        <td><?= $SUPLIER['PRODUK_YANG_DISUPLY']; ?></td>
        <td><?= $SUPLIER['TANGGAL_DATANG']; ?></td>
    </tr>
<?php endforeach;
