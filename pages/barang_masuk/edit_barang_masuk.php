<?php
include "../../db/koneksi.php";
session_start();


    $id = $_GET['id'];

    $query = $con->query("SELECT * FROM barang_masuk WHERE id = '$id'");
    $tampil = $query->fetch_assoc();



if (isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $tanggal = $_POST['tanggal_masuk'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $total = $_POST['total'];
    $jumlah_masuk = $_POST['jumlah_masuk'];
    $supplier = $_POST['supplier'];
    $satuan = $_POST['satuan'];
    $ket_bayar = $_POST['ket_bayar'];
    $tenaga = $_POST['tenaga'];
    $petugas = $_POST['petugas_edit'];

    $sql = $con->query("UPDATE barang_masuk SET petugas_edit = '$petugas', tanggal = '$tanggal', jumlahh = '$jumlah_masuk', harga = '$harga', tenaga = '$tenaga', total = '$total', supplier = '$supplier', ket_bayar = '$ket_bayar' WHERE id = '$id' ");

    if ($sql) {
?>
        <script>
            alert("Data Berhasil diubah");
            window.location.replace("./barang_masuk.php");
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


$tanggal_masuk = date("Y-m-d");

?>


<?php include "../../layouts/header.php" ?>

<h5 class="card-title">Tambah Barang Masuk</h5>

<!-- Horizontal Form -->
<form method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">ID Transaksi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" value="<?php echo $tampil['id_transaksi'] ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Masuk <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="" name="tanggal_masuk" value="<?php echo $tampil['tanggal'] ?>">
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
        <label for="" class="col-sm-2 col-form-label">Jumlah Masuk<span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlahmasuk" onkeyup="sum2()" name="jumlah_masuk" placeholder="Jumlah Beras Masuk" value="<?php echo $tampil['jumlahh'] ?>" required>
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
        <label for="" class="col-sm-2 col-form-label">Tenaga <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="tenaga" name="tenaga" value="<?php echo $tampil['tenaga'] ?>" onkeyup="sum2()" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="total" class="col-sm-2 col-form-label">Total Pengeluaran</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="total" name="total" placeholder="Total Pengeluaran didapat dari Harga x Jumlah Masuk + Tenaga" value="<?php echo $tampil['total'] ?>" readonly>
        </div>
    </div>

    <div class="tampung1"></div>

    <div class="row mb-3">
        <label for="supplier" class="col-sm-2 col-form-label">Supplier <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $tampil['supplier'] ?>" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ket_bayar" name="ket_bayar" value="<?php echo $tampil['ket_bayar'] ?>" required>
        </div>
    </div>
    <input type="hidden" name="petugas_edit" id="" value="<?php echo $_SESSION['nama'] ?>">
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
        var result = (parseInt(hrg) * parseInt(jml)) + parseInt(tng);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
</script>

<?php include "../../layouts/footer.php" ?>