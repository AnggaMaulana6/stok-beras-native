<?php
include "../../db/koneksi.php";
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $con->query("SELECT * FROM gudang WHERE id = '$id'");
    $getData = $query->fetch_assoc();
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    $sql = $con->query("UPDATE gudang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', satuan ='$satuan', harga ='$harga' WHERE id = '$id' ");
    if ($sql) {
?>
        <script>
            alert("Data berhasil diubah");
            window.location.replace("./gudang.php")
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

?>
<?php include "../../layouts/header.php" ?>

<div class="card-body">
    <h5 class="card-title">Edit Gudang</h5>

    <!-- Horizontal Form -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group row mb-3">
            <input type="hidden" class="form-control" id="inputText" name="id" required value=<?= $getData['id'] ?>>
            <label for="" class="col-sm-2 col-form-label">Kode Beras</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="kode_barang" value="<?php echo $getData['kode_barang'] ?> " readonly>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="" class="col-sm-2 col-form-label">Jenis Beras</label>
            <div class="col-sm-10">
                <input type="text" id="inputText" name="nama_barang" required value="<?php echo $getData['nama_barang'] ?>" class="form-control" />
            </div>
        </div>
        <!-- <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="jumlah" required value="<?php echo $getData['jumlah'] ?>" readonly>
            </div>
        </div> -->
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
                <select class="form-control" name="satuan">

                    <?php
                    $sql = $con->query("SELECT * FROM satuan ORDER BY id");
                    while ($data = $sql->fetch_assoc()) {
                        // echo "<option value='$data[id_event]'>$getData[id_event]. $data[nama_event]</option>";

                        if ($getData['satuan'] == $data['satuan']) {
                            echo "<option value='$data[satuan]' selected>$data[satuan]</option>";
                        } else {
                            echo "<option value='$data[satuan]'>$data[satuan]</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Harga per satuan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="harga" required value="<?php echo $getData['harga'] ?>">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
            <a type="submit" class="btn btn-warning" href="./gudang.php">Kembali</a>
        </div>
    </form><!-- End Horizontal Form -->

</div>

<?php include "../../layouts/footer.php" ?>