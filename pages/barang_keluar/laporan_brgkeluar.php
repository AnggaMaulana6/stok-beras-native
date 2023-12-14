<?php
include "../../db/koneksi.php";
session_start();

if (isset($_POST['proses'])) {
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];
    if ($bln == '0') {
        $query = mysqli_query($con, "SELECT * FROM barang_keluar");
        $getData = mysqli_fetch_all($query, MYSQLI_ASSOC);
    } else {
        $queryUser = mysqli_query($con, "SELECT * FROM barang_keluar WHERE MONTH(tanggal) = '$bln' AND YEAR(tanggal) = '$thn' ORDER BY id ASC");
        $getData = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
    }
} else {
    $query = mysqli_query($con, "SELECT * FROM barang_keluar");
    $getData = mysqli_fetch_all($query, MYSQLI_ASSOC);
}

$jumlah = 0;

?>
<?php include "../../layouts/header.php" ?>

    <h5 class="card-title">Barang Keluar</h5>
    <!-- Multi Columns Form -->
    <form class="row g-3" method="POST" id="" action="../laporan/excel_brgkeluar.php">
        <div class="col-md-3 mb-3">
            <input type="hidden" name="proses" id="form1">
            <select class="form-control" name="bln" id="input">
                <option value="0" selected="">--- Pilih Bulan ---</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="col-md-3">
            <?php
            $now = date('Y');
            echo "<select name='thn' class='form-control'>";
            ?>
            <option value='0'>--- Pilih Tahun---</option>
            <?php
            for ($a = 2018; $a <= $now; $a++) {
                echo "<option value='$a'>$a</option>";
            }
            echo "</select>"; ?>
        </div>
        <div class="col-md-3">
            <input type="submit" name="proses" class="btn btn-info" value="Export ke Excel"> <br>
        </div>
    </form><!-- End Multi Columns Form -->
    <form class="row g-3 mt-2" method="POST" id="">
        <div class="col-md-3 mt-2">
            <input type="hidden" name="proses" id="form1">
            <select class="form-control " name="bln">
                <option value="0" selected="">--- Pilih Bulan ---</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="col-md-3">
            <?php
            $now = date('Y');
            echo "<select name='thn' class='form-control'>";
            ?>
            <option value='0'>--- Pilih Tahun---</option>
            <?php
            for ($a = 2018; $a <= $now; $a++) {
                echo "<option value='$a'>$a</option>";
            }
            echo "</select>"; ?>
        </div>
        <div class="col-md-3">
            <input type="submit" name="proses" class="btn btn-primary" value="Tampilkan">
        </div>
    </form><!-- End Multi Columns Form -->

    <div class="tampung1">
        <div class="table-responsive">

            <!-- Table with stripped rows -->
            <table class="table table-striped table-hover table datatable" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Petugas Insert</th>
                        <th scope="col">Petugas Edit</th>
                        <th scope="col">Tanggal Keluar</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Kode Beras</th>
                        <th scope="col">Jenis Beras</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Keterangan</th>
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
                        $total = ($data['harga'] * $data['jumlah']);
                        // total bayar adalah penjumlahan dari keseluruhan total
                        $total_bayar += $data["total"];
                    ?>
    
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['id_transaksi'] ?></td>
                            <td><?php echo $data['nama_petugas'] ?></td>
                            <td><?php echo $data['petugas_edit'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['customer'] ?></td>
                            <td><?= $data['kode_barang'] ?></td>
                            <td><?= ucwords($data['nama_barang']) ?></td>
                            <td><?= $data['jumlah'] ?> <?= ucwords($data['satuan']) ?></td>
                            <td><?= ucwords($data['ket_bayar']) ?></td>
                            <td><?= "Rp " . $data['harga'] ?></td>
                            <td><?= "Rp " . $data['total'] ?></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                    <tr>
                        <td colspan="11">Total Pemasukan</td>
                        <td><?= "Rp " . $total_bayar ?></td>
                    </tr>
            </table>
            <!-- End Table with stripped rows -->
        </div>
    </div>
<?php include "../../layouts/footer.php" ?>