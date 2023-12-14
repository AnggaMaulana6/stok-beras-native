<?php
include "../../db/koneksi.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $con->query("SELECT * FROM users WHERE id = '$id'");
    $tampil = $query->fetch_assoc();
}

if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $status = $_POST['status'];
    $lokasiOld = '../../assets/img/foto-user/' . $_POST['oldFoto'];

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];

    // Jika ada file foto yang diunggah
    if (!empty($lokasi)) {
        // Pindahkan file foto baru ke direktori 'assets/img/foto-user/'
        $upload = move_uploaded_file($lokasi, "../../assets/img/foto-user/" . $foto);

        // Hapus foto lama jika ada
        if (!empty($lokasiOld)) {
            unlink($lokasiOld);
        }
    } else {
        // Jika tidak ada file baru diunggah, gunakan foto lama
        $foto = $_POST['oldFoto'];
    }

    $sql = $con->query("UPDATE users SET nik = '$nik', nama = '$nama', alamat = '$alamat', telepon = '$telepon', username = '$username', password = '$password', level = '$level', foto = '$foto', status_users = '$status' WHERE id = '$id'");

    if ($sql) {
    ?>
        <script>
            alert("Data Berhasil diubah!");
            window.location.replace("./user.php")
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Data gagal diubah!");
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
        <input type="number" class="form-control" id="" name="nik" value="<?php echo $tampil['nik'] ?>" required>
    </div>
    <div class="col-md-12">
        <label for="" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="" name="nama" value="<?php echo $tampil['nama'] ?>" required>
    </div>
    <div class="col-md-12">
        <label for="" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="" name="alamat" value="<?php echo $tampil['alamat'] ?>" required>
    </div>
    <div class="col-md-12">
        <label for="" class="form-label">Telepon</label>
        <input type="text" class="form-control" id="" name="telepon" value="<?php echo $tampil['telepon'] ?>" required>
    </div>
    <div class="col-md-6">
        <label for="" class="form-label">Username</label>
        <input type="text" class="form-control" id="" name="username" value="<?php echo $tampil['username'] ?>" required>
    </div>
    <div class="col-md-6">
        <label for="" class="form-label">Password</label>
        <input type="text" class="form-control" id="" name="password" value="<?php echo $tampil['password'] ?>">
    </div>
    <div class="col-12">
        <label for="inputAddress5" class="form-label">Level</label>
        <select name="level" id="" class="form-control show-trick">
            <option value="">-- Pilih Level ---</option>
            <option value="admin" <?php echo ($tampil['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="petugas" <?php echo ($tampil['level'] == 'petugas') ? 'selected' : ''; ?>>Petugas</option>
        </select>
    </div>
    <input type="hidden" name="oldFoto" value="<?php echo $tampil['foto'] ?>">
    <label for="inputAddress2" class="form-label">Foto</label>
    <?php 
    if($tampil['foto']){
        ?>
        <div class="col-12">
        <img src="../../assets/img/foto-user/<?php echo $tampil['foto'] ?>" width="160" height="160" class="img-preview img-fluid mb-3 col-sm-5 d-block" alt="">
    </div>
    <?php
    }else{
        ?>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <?php 
    }
    ?>
    <div class="col-12">
        <label for="inputAddress2" class="form-label g-4">Ganti Foto</label>
        <input type="file" name="foto" class="form-control" id="foto" onchange="previewFoto()">
    </div>
    <div class="col-12">
        <label for="inputAddress5" class="form-label">Status Pengguna</label>
        <select name="status" id="" class="form-control show-trick">
            <option value="nonvalid" <?php echo ($tampil['status_users'] == 'nonvalid') ? 'selected' : ''; ?>>Non Valid</option>
            <option value="valid" <?php echo ($tampil['status_users'] == 'valid') ? 'selected' : ''; ?>>Valid</option>
        </select>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
        <a href="./user.php" class="btn btn-warning">Kembali</a>
    </div>
</form><!-- End Multi Columns Form -->


<?php include "../../layouts/footer.php" ?>
<script>
  function previewFoto(){
    const foto = document.querySelector('#foto');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(foto.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>