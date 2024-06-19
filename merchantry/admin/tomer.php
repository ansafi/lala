<?php
// Sertakan file koneksi.php yang berisi koneksi OCI
include 'koneksi.php';

function select($query) {
    global $conn;

    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $rows = [];
    while ($row = oci_fetch_assoc($stid)) {
        $rows[] = $row;
    }

    return $rows;
}

// Contoh penggunaan fungsi select dengan query SELECT *
$data_customer = select("SELECT * FROM PELANGGAN");

$no = 1;
foreach ($data_customer as $pelanggan) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $pelanggan['ID_PELANGGAN']; ?></td>
        <td><?= $pelanggan['NAMA_PELANGGAN']; ?></td>
        <td><?= $pelanggan['EMAIL']; ?></td>
        <td><?= $pelanggan['NO_TELP']; ?></td>
        <td><?= $pelanggan['ALAMAT']; ?></td>
        <td><?= $pelanggan['PASSWORD']; ?></td>
    </tr>
<?php endforeach; ?>
