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

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    $upload = move_uploaded_file($lokasi, "../../assets/img/foto-user/" . $foto);

        $sql = $con->query("INSERT INTO users (nik, nama, alamat, telepon, username, password, level, foto )
                            VALUES ('$nik', '$nama', '$alamat', '$telepon', '$username', '$password', '$level', '$foto')");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register Gudang Beras</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="../../assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">PB.SALMAIRA</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Registrasi Akun</h5>
                                        <p class="text-center small">Masukkan Data Anda dengan Benar</p>
                                    </div>

                                    <form class="row g-3 needs-validation" enctype="multipart/form-data" method="POST">
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">NIK</label>
                                            <input type="number" name="nik" class="form-control" id="nik" placeholder="NIK" required>
                                            <div class="invalid-feedback">Maukkan NIK anda!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                                            <div class="invalid-feedback">Masukkan Nama Lengkap anda!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat Anda" required>
                                            <div class="invalid-feedback">Masukkan Alamat anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">No Telephone</label>
                                            <input type="number" name="telepon" class="form-control" id="" placeholder="No Telephone" required>
                                            <div class="invalid-feedback">Masukkan No Telephone anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Username" required>
                                                <div class="invalid-feedback">Masukkan Username Anda!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Password" required>
                                            <div class="invalid-feedback">Masukkan Password anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="" class="form-label">Level</label>
                                            <div class="input-group has-validation">
                                                <select name="level" id="" class="form-control">
                                                    <option value="petugas">--- Pilih Level ---</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="petugas">Petugas</option>
                                                </select>
                                                <div class="invalid-feedback">Masukkan Username Anda!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="" class="form-label">Foto</label>
                                            <input type="file" name="foto" class="form-control" id="" placeholder="Foto" required>
                                            <div class="invalid-feedback">Masukkan Foto anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                                <div class="invalid-feedback">Kamu Harus menchecklist dahulu sebelum login.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="simpan">Buat Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <a class="btn btn-warning w-100" href="./user.php">Kembali</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>

</body>

</html>