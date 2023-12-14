<?php
include "../../db/koneksi.php";
session_start();


$id = $_GET['id'];

$query = $con->query("SELECT * FROM barang_keluar WHERE id = '$id'");
$tampil = $query->fetch_assoc();



if (isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $petugas = $_POST['petugas_edit'];
    $tanggal = $_POST['tanggal_keluar'];
    $customer = $_POST['customer'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $total = $_POST['total'];
    $jumlah_keluar = $_POST['jumlah_keluar'];
    $satuan = $_POST['satuan'];
    $ket_bayar = $_POST['ket_bayar'];

    $sql = $con->query("UPDATE barang_keluar SET petugas_edit = '$petugas', tanggal = '$tanggal', jumlah = '$jumlah_keluar', customer = '$customer', harga = '$harga', total = '$total', ket_bayar = '$ket_bayar' WHERE id = '$id' ");

    if ($sql) {
?>
        <script>
            alert("Data Berhasil diubah");
            window.location.replace("./barang_keluar.php");
        </script>
    <?php

    } else {
    ?>
        <script>
            alert("Data gagal diubah");
        </script>
<?php

    }
}


$tanggal_keluar = date("Y-m-d");

?>


<?php include "../../layouts/header.php" ?>

<h5 class="card-title">Edit Barang Keluar</h5>

<!-- Horizontal Form -->
<form method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">ID Transaksi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" value="<?php echo $tampil['id_transaksi'] ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Keluar <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="" name="tanggal_keluar" value="<?php echo $tampil['tanggal'] ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Customer <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="customer" name="customer" value="<?php echo $tampil['customer'] ?>" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Jenis Beras <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="" name="nama_barang" value="<?php echo $tampil['kode_barang'] . " | " . $tampil['nama_barang'] ?>" readonly>
        </div>
    </div>
    <!-- <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Jenis Beras <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <select name="nama_barang" id="cmb_barang" class="form-control">
                <?php
                $sql = $con->query("SELECT * FROM gudang ORDER by id");
                while ($data = $sql->fetch_assoc()) {
                    if ($tampil['kode_barang'] == $data['kode_barang']) {
                        echo "<option value='$data[kode_barang].$data[nama_barang]' selected readonly> $data[kode_barang] | $data[nama_barang] </option>";
                    } else {
                        echo "<option value='$data[kode_barang].$data[nama_barang]' > $data[kode_barang] | $data[nama_barang] </option>";
                    }
                }
                ?>
            </select>
        </div>
    </div> -->

    <div class="tampung"></div>

    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Jumlah Keuar<span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlahkeluar" onkeyup="sum2()" name="jumlah_keluar" placeholder="Jumlah Beras Keluar" value="<?php echo $tampil['jumlah'] ?>" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Satuan <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="" name="satuan" value="<?php echo $tampil['satuan'] ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="harga" class="col-sm-2 col-form-label">Harga<span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $tampil['harga'] ?>" onkeyup="sum2()" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="total" class="col-sm-2 col-form-label">Total Pemasukan</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="total" name="total" placeholder="Total Pengeluaran didapat dari Harga x Jumlah Keluar" value="<?php echo $tampil['total'] ?>" readonly>
        </div>
    </div>

    <div class="tampung1"></div>

    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Keterangan Bayar <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ket_bayar" name="ket_bayar" value="<?php echo $tampil['ket_bayar'] ?>" required>
        </div>
    </div>
    <input type="hidden" class="form-control" id="" name="petugas_edit" value="<?php echo $_SESSION['nama'] ?>" required>

    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
        <a href="./barang_keluar.php" class="btn btn-warning">Kembali</a>
    </div>
</form><!-- End Horizontal Form -->

<script>
    function sum() {
        var stok = document.getElementById('stok').value;
        var jumlahkeluar = document.getElementById('jumlahkeluar').value;
        var result = parseInt(stok) - parseInt(jumlahkeluar);
        if (!isNaN(result)) {
            document.getElementById('jumlahh').value = result;
        }
    }

    function sum2() {
        var hrg = document.getElementById('harga').value;
        var jml = document.getElementById('jumlahkeluar').value;
        var result = (parseInt(hrg) * parseInt(jml));
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
</script>

<?php include "../../layouts/footer.php" ?>