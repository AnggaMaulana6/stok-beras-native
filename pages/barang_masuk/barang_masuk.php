<?php
include "../../db/koneksi.php";
session_start();


// Melakukan Insert ke gudang
if (isset($_POST['simpan'])) {

    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $satuan = $_POST['satuan'];
    $pecah_satuan = explode(".", $satuan);
    $harga = $_POST['harga'];
    $id = $pecah_satuan[0];
    $satuan = $pecah_satuan[1];


    $sql = $con->query("INSERT INTO gudang (kode_barang, nama_barang, jumlah, satuan, harga ) 
                            VALUES('$kode_barang','$nama_barang','0','$satuan','$harga' )");

    if ($sql) {
?>

        <script type="text/javascript">
            alert("Data Berhasil Disimpan");
            window.location.replace("./gudang.php");
        </script>

    <?php
    } else {
        echo '<script>alert("Tidak dapat menambahkan data")</script>';
    }
} // End Insert

// Melakukan Hapus data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $Del = $con->query("DELETE FROM barang_masuk WHERE id ='$id'");
    if ($Del) {
    ?>
        <script>
            alert("Data Berhasil dihapus!");
            window.location.replace("./barang_masuk.php")
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Data tidak bisa dihapus!");
        </script>
<?php
    }
}

$jumlah = 0;
?>
<?php include "../../layouts/header.php" ?>

<div class="card-body">
    <h5 class="card-title">Barang Masuk</h5>
    <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> -->


    <!-- Basic Modal -->
    <a href="./tambah_barangmasuk.php" class="btn btn-primary mb-3" >
        Tambah Barang Masuk
    </a>

    <div class="table-responsive">
        <!-- Table with stripped rows -->
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal Masuk</th>
                <th>Kode Beras</th>
                <th>Jenis Beras</th>
                <th>Berat</th>
                <th>Supplier</th>
                <th>Keterangan</th>
                <th>Tenaga</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Pengaturan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // perintah tampil data
            $q = mysqli_query($con, "SELECT * FROM barang_masuk");

            $total = 0;
            $total_bayar = 0;
            $no = 1;

            while ($r = $q->fetch_assoc()) {
                // total adalah hasil dari harga x jumlah
                $total = ($r['harga'] * $r['jumlahh']) + $r['tenaga'];
                // total bayar adalah penjumlahan dari keseluruhan total
                $total_bayar += $r["total"];
            ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['id_transaksi'] ?></td>
                    <td><?= $r['tanggal'] ?></td>
                    <td><?= $r['kode_barang'] ?></td>
                    <td><?= ucwords($r['nama_barang']) ?></td>
                    <td><?= $r['jumlahh'] ?> <?= ucwords($r['satuan']) ?></td>
                    <td><?= ucwords($r['supplier']) ?></td>
                    <td><?= ucwords($r['ket_bayar']) ?></td>
                    <td><?= "Rp " . $r['tenaga'] ?></td>
                    <td><?= "Rp " . $r['harga'] ?></td>
                    <td><?= "Rp " . $r['total'] ?></td>
                    <td>    
                        <a href="./edit_barang_masuk.php?id=<?= $r['id'] ?>" class="badge bg-primary text-decoration-none">Edit</a>
                        <a href="?id=<?= $r['id'] ?>" class="badge bg-danger text-decoration-none" onclick="return confirm('Yaakin ingin menghapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php 
            }
            ?>
            </tbody>
        <tr>
            <td colspan="10">Total Pengeluaran</td>
            <td><?= "Rp " . $total_bayar ?></td>
        </tr>
    </table>
    <!-- End Table with stripped rows -->
    </div>

</div>
<?php include "../../layouts/footer.php" ?>