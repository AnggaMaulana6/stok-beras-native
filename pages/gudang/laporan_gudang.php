<?php
include "../../db/koneksi.php";
session_start();

$query = mysqli_query($con, "SELECT * FROM gudang");
$getData = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Membuat kode barang otomatis
$no = mysqli_query($con, "SELECT kode_barang FROM gudang ORDER BY id DESC");
$kdbarang = mysqli_fetch_array($no);
$kode = $kdbarang['kode_barang'];

$urut = substr($kode, 8, 3);
$tambah = (int)$urut + 1;
$bulan = date("m");
$tahun = date("y");

if (strlen($tambah) == 1) {
    $format = "BAR-" . $bulan . $tahun . "00" . $tambah;
} elseif (strlen($tambah) == 2) {
    $format = "BAR-" . $bulan . $tahun . "0" . $tambah;
} else {
    $format = "BAR-" . $bulan . $tahun . $tambah++;
} // end kode_barang

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

    $Del = $con->query("DELETE FROM gudang WHERE id ='$id'");
    if ($Del) {
    ?>
        <script>
            alert("Data Berhasil dihapus!");
            window.location.replace("./gudang.php")
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
    <h5 class="card-title">Stok Beras</h5>
    <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> -->


    <!-- Basic Modal -->
    <a href="../laporan/excel_gudang.php" class="btn btn-primary mb-2">
        Download ke Excel
    </a>
    <div class="table-responsive">

        <!-- Table with stripped rows -->
        <table class="table table-striped table-hover" id='dataTable'>
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
        <!-- End Table with stripped rows -->
    </div>

</div>
<?php include "../../layouts/footer.php" ?>