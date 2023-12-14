<?php
include "../../db/koneksi.php";
session_start();

$query = mysqli_query($con, "SELECT * FROM users");
$getData = mysqli_fetch_all($query, MYSQLI_ASSOC);


// Melakukan Insert ke users
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
    $getData = $con->query("SELECT * FROM users where id = '$id'");
    $exData = $getData->fetch_assoc();

    // Dapatkan path lengkap ke file foto
    $DeleteFoto = "../../assets/img/foto-user/" . $exData['foto'];

    // Periksa apakah file foto ada
    if (file_exists($DeleteFoto)) {
        // Hapus file foto
        unlink($DeleteFoto);
    }


    $Del = $con->query("DELETE FROM users WHERE id ='$id'");
    if ($Del) {
    ?>
        <script>
            alert("Data Berhasil dihapus!");
            window.location.replace("./user.php")
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
    <a href="./tambah_user.php" class="btn btn-primary mb-3">
        Tambah User
    </a>
    <!-- Table with stripped rows -->
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col">Telepon</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">level</th>
                <th scope="col">Foto</th>
                <th scope="col">Status</th>
                <th scope="col">Pengaturan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($getData as $data) { ?>
                <tr>
                    <td scope="row"><?= $no++ ?></td>
                    <td><?= $data['nik'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['telepon'] ?></td>
                    <td><?= $data['username'] ?></td>
                    <td><?= $data['password'] ?></td>
                    <td><?= $data['level'] ?></td>
                    <td>
                        <img src="../../assets/img/foto-user/<?php echo $data['foto'] ?>" alt="" width="50" height="50">
                    </td>
                    <td><?= $data['status_users'] ?></td>
                    <td>
                        <a href="./edit_user.php?id=<?= $data['id'] ?>" class="badge bg-primary text-decoration-none">Edit</a>
                        <a href="?id=<?= $data['id'] ?>" class="badge bg-danger text-decoration-none" onclick="return confirm('Yaakin ingin menghapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->

</div>
<?php include "../../layouts/footer.php" ?>