<?php
include "../../db/koneksi.php";
session_start();


    $query = mysqli_query($con, "SELECT * FROM gudang");
    $getData = mysqli_fetch_all($query, MYSQLI_ASSOC);

    header("Content-tyoe: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan Stok Gudang(" . date('d-m-Y') . ").xls");


?>

<!-- <link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.min.css"> -->

<h2>Laporan Stok Gudang</h2>

<table class="table datatable" border="1">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Beras</th>
            <th scope="col">Jenis Beras</th>
            <th scope="col">Stok</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($getData as $data) { ?>
            <tr>
                <td scope="row"><?= $no++ ?></td>
                <td><?= $data['kode_barang'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['jumlah'] ?></td>
                <td><?= $data['satuan'] ?></td>
                <td>Rp <?= $data['harga'] ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>


<script src="../assets/vendor/bootstrap/js/min"></script>