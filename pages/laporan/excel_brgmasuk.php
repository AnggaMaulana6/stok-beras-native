<?php
include "../../db/koneksi.php";
session_start();

if (isset($_POST['proses'])) {
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];
    if ($bln == '0') {
        $query = mysqli_query($con, "SELECT * FROM barang_masuk");
        $getData = mysqli_fetch_all($query, MYSQLI_ASSOC);
    } else {
        $queryUser = mysqli_query($con, "SELECT * FROM barang_masuk WHERE MONTH(tanggal) = '$bln' AND YEAR(tanggal) = '$thn' ORDER BY id ASC");
        $getData = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
    }
} else {
    $query = mysqli_query($con, "SELECT * FROM barang_masuk");
    $getData = mysqli_fetch_all($query, MYSQLI_ASSOC);
}
header("Content-tyoe: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Barang Masuk(" . date('d-m-Y') . ").xls");

$jumlah = 0;
if($bln == '1'){
    $blnn = 'Januari';
}else if($bln == '2'){
    $blnn = 'Februari';
}else if($bln == '3'){
    $blnn = 'Maret';
}else if($bln == '4'){
    $blnn = 'April';
}else if($bln == '5'){
    $blnn = 'Mei';
}else if($bln == '6'){
    $blnn = 'Juni';
}else if($bln == '7'){
    $blnn = 'Juli';
}else if($bln == '8'){
    $blnn = 'Agustus';
}else if($bln == '9'){
    $blnn = 'September';
}else if($bln == '10'){
    $blnn = 'Oktober';
}else if($bln == '11'){
    $blnn = 'November';
}else if($bln == '12'){
    $blnn = 'Desember';
}else{
    $blnn = $thn;
}
?>

<div class="card-body">
    <h2 class="card-title"><center>Rekap Barang Masuk</center></h2>
    <h2 class="card-title"><center>PB. SALMAIRA GEMILANG</center></h2>
    <h2 class="card-title"><center>Bulan <?= $blnn ?> Tahun  <?= $thn ?></center></h2>
    <div class="tampung1">
        <!-- Table with stripped rows -->
        <table class="table table-striped table-hover" id="dataTable" border="1">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Transaksi</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Kode Beras</th>
                    <th scope="col">Jenis Beras</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tenaga</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // perintah tampil data

                $total = 0;
                $total_bayar = 0;
                $no = 1;
                foreach ($getData as $data) {
                    // total adalah hasil dari harga x jumlah
                    $total = ($data['harga'] * $data['jumlahh']) + $data['tenaga'];
                    // total bayar adalah penjumlahan dari keseluruhan total
                    $total_bayar += $data["total"];
                ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['id_transaksi'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><?= $data['kode_barang'] ?></td>
                        <td><?= ucwords($data['nama_barang']) ?></td>
                        <td><?= $data['jumlahh'] ?> <?= ucwords($data['satuan']) ?></td>
                        <td><?= ucwords($data['supplier']) ?></td>
                        <td><?= ucwords($data['ket_bayar']) ?></td>
                        <td><?= "Rp " . $data['tenaga'] ?></td>
                        <td><?= "Rp " . $data['harga'] ?></td>
                        <td><?= "Rp " . $data['total'] ?></td>
                    </tr>
                <?php }
                ?>
                <tr>
                    <td colspan="10">Total Pengeluaran</td>
                    <td><?= "Rp " . $total_bayar ?></td>
                </tr>
            </tbody>
        </table>
        <!-- End Table with stripped rows -->
    </div>

</div>
