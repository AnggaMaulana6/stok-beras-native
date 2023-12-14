<?php
include "../../db/koneksi.php";
session_start();

$query = mysqli_query($con, "SELECT * FROM satuan");
$getData = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST['simpan'])) {
    $satuan = $_POST['satuan'];

    $query = mysqli_query($con, "INSERT INTO satuan (satuan) VALUES ('$satuan')");
    if ($query) {
        echo '<script>
        alert("Data berhasil disimpan");
        window.location.replace("./satuan.php")
        </script>';
    } else {
        echo '<script>
        alert("Data tidak bisa disimpan!")
        </script>';
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $queryDel = mysqli_query($con, "DELETE FROM satuan WHERE id = '$id'");
    if($queryDel){
        ?>
        <script>
            alert("Data Berhasil dihapus!");
            window.location.replace("./satuan.php")
        </script>
        <?php
    }else{
        ?>
         <script>
            alert("Data tidak bisa dihapus!");
        </script>
        <?php
    }
}

?>
<?php include "../../layouts/header.php" ?>

<div class="card-body">
    <h5 class="card-title">Satuan Beras</h5>
    <!-- Basic Modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
        Tambah Satuan
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
                        <label for="">Satuan Beras<spain class="text-danger">*</spain></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="satuan" class="form-control" placeholder="Satuan Beras" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->
    <!-- Table with stripped rows -->
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Satuan Beras</th>
                <th scope="col">Pengaturan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($getData as $data) { ?>
                <tr>
                    <td scope="row"><?= $no++ ?></td>
                    <td><?= $data['satuan'] ?></td>
                    <td>
                        <a href="./edit_satuan.php?id=<?= $data['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="?id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
</div>
<?php include "../../layouts/footer.php" ?>