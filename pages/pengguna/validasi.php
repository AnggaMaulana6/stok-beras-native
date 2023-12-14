<?php
include "../../db/koneksi.php";
session_start();

$query = mysqli_query($con, "SELECT * FROM users WHERE status_users = 'nonvalid'");
$getData = mysqli_fetch_all($query, MYSQLI_ASSOC);


// Melakukan Validasi data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $Del = $con->query("UPDATE users SET status_users = 'valid' WHERE id ='$id'");
    if ($Del) {
    ?>
        <script>
            alert("Akun Berhasil divalidasi!");
            window.location.replace("./validasi.php")
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Data tidak bisa divalidasi!");
        </script>
<?php
    }
}

$jumlah = 0;
?>
<?php include "../../layouts/header.php" ?>

<div class="card-body">
    <h5 class="card-title">Stok Beras</h5>
    <p>Jika status Non valid maka pengguna tidak bisa login</p>


    <!-- Basic Modal -->
    <a href="./tambah_user.php" class="btn btn-primary">
        Tambah User
    </a>
    <!-- Table with stripped rows -->
    <table class="table table-striped table-hover">
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
                        <a href="?id=<?= $data['id'] ?>" class="btn btn-primary" onclick="return confirm('Yaakin ingin memvalidasi data?')">Validasi</a>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->

</div>
<?php include "../../layouts/footer.php" ?>