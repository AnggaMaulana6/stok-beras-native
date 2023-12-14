<?php
include "../../db/koneksi.php";
session_start();

if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $status = $_POST['status'];

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    $upload = move_uploaded_file($lokasi, "../../assets/img/foto-user/" . $foto);

        $sql = $con->query("INSERT INTO users (nik, nama, alamat, telepon, username, password, level, foto, status_users )
                            VALUES ('$nik', '$nama', '$alamat', '$telepon', '$username', '$password', '$level', '$foto', '$status')");
        if ($sql) {
        ?>
            <script>
                alert("Akun Berhasil didaftarkan!");
                window.location.replace("./user.php")
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Akun gagal didaftarkan!");
            </script>
        <?php
        }
    }

?>
<?php include "../../layouts/header.php" ?>
<h5 class="card-title">Edit Pengguna</h5>
<!-- Multi Columns Form -->
<form class="row g-3" method="post" enctype="multipart/form-data">
    <div class="col-md-12">
        <label for="" class="form-label">NIK</label>
        <input type="number" class="form-control" id="" name="nik" placeholder="Masukkan NIK" required>
    </div>
    <div class="col-md-12">
        <label for="" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="" name="nama" placeholder="Masukan Nama Lengkap anda" required>
    </div>
    <div class="col-md-12">
        <label for="" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="" name="alamat" placeholder="Masukkan Alamat Anda" required>
    </div>
    <div class="col-md-12">
        <label for="" class="form-label">Telepon</label>
        <input type="number" class="form-control" id="" name="telepon" placeholder="08***********" required>
    </div>
    <div class="col-md-6">
        <label for="" class="form-label">Username</label>
        <input type="text" class="form-control" id="" name="username" placeholder="Username" required>
    </div>
    <div class="col-md-6">
        <label for="" class="form-label">Password</label>
        <input type="password" class="form-control" id="" name="password" placeholder="*******">
    </div>
    <div class="col-12">
        <label for="inputAddress5" class="form-label">Level</label>
        <select name="level" id="" class="form-control show-trick" required>
            <option value="">-- Pilih Level ---</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>
    <div class="col-12">
        <label for="inputAddress2" class="form-label g-4">Foto</label>
        <input type="file" name="foto" class="form-control" required>
    </div>
  <input type="hidden" name="status" value="valid" id="">
    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
        <a href="./user.php" class="btn btn-info">Kembali</a>
    </div>
</form><!-- End Multi Columns Form -->


<?php include "../../layouts/footer.php" ?>