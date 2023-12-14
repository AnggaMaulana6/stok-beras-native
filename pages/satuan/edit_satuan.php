<?php
include "../../db/koneksi.php";
session_start();
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = $con ->query("SELECT * FROM satuan WHERE id = '$id'");
    $getData = $query -> fetch_assoc();
}

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $satuan = $_POST['satuan'];

    $sql = $con -> query("UPDATE satuan SET satuan ='$satuan' WHERE id = '$id' ");
    if($sql){
        ?>
        <script>
            alert("Data berhasil diubah");
            window.location.replace("./satuan.php")
        </script>
        <?php
    }else{
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
    <h5 class="card-title">Edit Satuan</h5>

    <!-- Horizontal Form -->
    <form method="POST">
        <div class="row mb-3">
            <input type="hidden" class="form-control" id="inputText" name="id" required value=<?=$getData['id'] ?>>
            <label for="" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="satuan" required value=<?=$getData['satuan'] ?>>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
            <a type="submit" class="btn btn-info" href="./satuan.php">Kembali</a>
        </div>
    </form><!-- End Horizontal Form -->

</div>

<?php include "../../layouts/footer.php" ?>