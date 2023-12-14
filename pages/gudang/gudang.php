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
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
        Tambah Beras
    </button>
 
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Satuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- Vertical Form -->
                            <div class="col-12">
                                <label for="" class="form-label">Kode Beras</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?php echo $format; ?>" readonly />
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Jenis Beras</label>
                                <input type="text" class="form-control" name="nama_barang" id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?php echo $jumlah; ?>" readonly disabled />
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Satuan Beras</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="satuan" id="" class="form-control">
                                            <option value="">-- Pilih Satuan Barang --</option>
                                            <?php
                                            $sql = $con->query("SELECT * FROM satuan ORDER BY id");
                                            while ($data = $sql->fetch_assoc()) {
                                                echo "<option value='$data[id].$data[satuan]'>$data[satuan]</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Hargaa per satuan</label>
                                <input type="number" class="form-control" name="harga" id="inputEmail4">
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Kembali</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->
   <div class="table-responsive">
     <!-- Table with stripped rows -->
     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Beras</th>
                <th scope="col">Jenis Beras</th>
                <th scope="col">Stok</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga</th>
                <th scope="col">Pengaturan</th>
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
                    <td>
                        <a href="./edit_gudang.php?id=<?= $data['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="?id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yaakin ingin menghapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
   </div>
  
</div>

<?php include "../../layouts/footer.php" ?>