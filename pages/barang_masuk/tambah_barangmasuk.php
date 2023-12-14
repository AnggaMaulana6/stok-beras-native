<?php
include "../../db/koneksi.php";
session_start();

$no = mysqli_query($con, "SELECT id_transaksi FROM barang_masuk ORDER BY id DESC");
$idtran = mysqli_fetch_array($no);
$kode = $idtran['id_transaksi'];
$urut = substr($kode, 8, 3);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");
if (strlen($tambah) == 1) {
    $format = "TRM-" . $bulan . $tahun . "00" . $tambah;
} elseif (strlen($tambah) == 2) {
    $format = "TRM-" . $bulan . $tahun . "0" . $tambah;
} else {
    $format = "TRM-" . $bulan . $tahun . $tambah;
}

if (isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $tanggal = $_POST['tanggal_masuk'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $total = $_POST['total'];
    $pecah_barang = explode(".", $nama_barang);
    $kode_barang = $pecah_barang[0];
    $nama_barang = $pecah_barang[1];
    $jumlah_masuk = $_POST['jumlah_masuk'];
    $supplier = $_POST['supplier'];
    $satuan = $_POST['satuan'];
    $ket_bayar = $_POST['ket_bayar'];
    $tenaga = $_POST['tenaga'];
    $nama_petugas = $_POST['nama_petugas'];

    $sql = $con->query("INSERT INTO barang_masuk (id_transaksi, nama_petugas, tanggal, kode_barang, nama_barang, jumlahh, satuan, supplier, ket_bayar, harga, total, tenaga)
                        VALUES ('$id_transaksi', '$nama_petugas', '$tanggal', '$kode_barang', '$nama_barang', '$jumlah_masuk', '$satuan', '$supplier', '$ket_bayar', '$harga', '$total', '$tenaga')");

    if ($sql) {
?>
        <script>
            alert("Data Berhasil disimpan");
            window.location.replace("./barang_masuk.php");
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Data gagal disimpan");
        </script>
<?php
    echo "<script>alert('$sql')</script>";
        var_dump($sql);

    }
}


$tanggal_masuk = date("Y-m-d");

?>

<?php include "../../layouts/header.php" ?>
<h5 class="card-title">Tambah Barang Masuk</h5>

<!-- Horizontal Form -->
<form method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">ID Transaksi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" value="<?php echo $format ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Masuk <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="" name="tanggal_masuk" value="<?php echo $tanggal_masuk ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Jenis Beras <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <select name="nama_barang" id="cmb_barang" class="form-control">
                <option value="">-- Pilih Beras --</option>
                <?php
                $sql = $con->query("SELECT * FROM gudang ORDER by id");
                while ($data = $sql->fetch_assoc()) {
                    echo "<option value='$data[kode_barang].$data[nama_barang]' > $data[kode_barang] | $data[nama_barang] </option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="tampung"></div>

    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Jumlah Masuk<span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlahmasuk" onkeyup="sum()" onkeyup="sum2()" name="jumlah_masuk" placeholder="Jumlah Beras Masuk" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="jumlahh" class="col-sm-2 col-form-label">Total Stok</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlahh" name="total_stok" value="" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="harga" class="col-sm-2 col-form-label">Harga<span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="harga" name="harga" value="" onkeyup="sum2()" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Tenaga <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="tenaga" name="tenaga" value="" onkeyup="sum2()" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="total" class="col-sm-2 col-form-label">Total Pengeluaran</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="total" name="total" value="" placeholder="Total Pengeluaran didapat dari Harga x Jumlah Masuk - Tenaga" readonly>
        </div>
    </div>

    <div class="tampung1"></div>

    <div class="row mb-3">
        <label for="supplier" class="col-sm-2 col-form-label">Supplier <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="supplier" name="supplier" value="" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ket_bayar" name="ket_bayar" value="" required>
        </div>
    </div>
    <input type="hidden" value="<?php echo $_SESSION['nama'] ?>" name="nama_petugas">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
        <a href="./barang_masuk.php" class="btn btn-warning">Kembali</a>
    </div>
</form><!-- End Horizontal Form -->

<script>
    function sum() {
        var stok = document.getElementById('stok').value;
        var jumlahmasuk = document.getElementById('jumlahmasuk').value;
        var result = parseInt(stok) + parseInt(jumlahmasuk);
        if (!isNaN(result)) {
            document.getElementById('jumlahh').value = result;
        }
    }

    function sum2() {
        var hrg = document.getElementById('harga').value;
        var tng = document.getElementById('tenaga').value;
        var jml = document.getElementById('jumlahmasuk').value;
        var result = (parseInt(hrg) * parseInt(jml)) - parseInt(tng);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
</script>

<?php include "../../layouts/footer.php" ?>