<?php
session_start(); 
include "../db/koneksi.php";

$getGudang = $con->query('SELECT * FROM gudang');
$exgudang = mysqli_num_rows($getGudang);

$getBarangMasuk = $con->query('SELECT * FROM barang_masuk');
$exbrgmasuk = mysqli_num_rows($getBarangMasuk);

$getBarangKeluar = $con->query('SELECT * FROM barang_keluar');
$exbrgKeluar = mysqli_num_rows($getBarangKeluar);

$getUser = $con->query("SELECT * FROM users where status_users ='valid'");
$exUser = mysqli_num_rows($getUser);

$getUser2 = $con->query("SELECT * FROM users where status_users ='nonvalid'");
$exUser2 = mysqli_num_rows($getUser2);

$getsatuan = $con->query('SELECT * FROM satuan');
$exsatuan = mysqli_num_rows($getsatuan);


?>
<?php include "../layouts/header_dashboard.php" ?>
<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang di PB.SALMAIRA GEMILANG <?= $_SESSION['nama'] ?>! 🎉</h5>
                  <h6 class="card-title text-primary"> Anda Login Sebagai 
                   <?=$_SESSION['level'] ?></h6>
                  <p class="mb-4">
                  Alamat: 92MJ+57H, Jl. Karanganyar-Karangpandan, Bangsri, Kec. Karangpandan, Kabupaten Karanganyar, Jawa Tengah 57791                  
                </p>
                <a href="./gudang/gudang.php" class="btn btn-sm btn-outline-info">Lihat data gudang</a>
                <!-- <a href="/verifikasi-nonvalid" class="btn btn-sm btn-outline-primary">Lihat Data Aduan</a> -->
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
 
        <div class="col-lg-12 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="d-block mb-1">Data Gudang</span>
                  <h3 class="card-title text-nowrap mb-2"><?=$exgudang ?></h3>
                  <small class="text-danger fw-semibold"><a href="./gudang/gudang.php">Lihat Gudang</a></small> 
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Data Satuan</span>
                  <h3 class="card-title mb-2"><?=$exsatuan ?></h3>
                  <small class="text-danger fw-semibold"><a href="./satuan/satuan.php">Lihat Satuan</a></small> 
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Data Barang Masuk</span>
                  <h3 class="card-title mb-2"><?=$exbrgmasuk ?></h3>
                  <small class="text-danger fw-semibold"><a href="./barang_masuk/barang_masuk.php">Lihat Barang Masuk</a></small> 
                </div>
              </div>
            </div>
            <div class="col-3 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Data Barang Keluar</span>
                  <h3 class="card-title mb-2"><?=$exbrgKeluar ?></h3>
                  <small class="text-danger fw-semibold"><a href="./barang_keluar/barang_keluar.php">Lihat Barang Masuk</a></small> 
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-4 order-1">
                <div class="row">
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="d-block mb-1">Data User Aktif</span>
                        <h3 class="card-title text-nowrap mb-2"><?=$exUser ?></h3>
                        <small class="text-danger fw-semibold"><a href="./pengguna/user.php">Lihat Pengguna</a></small> 
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Data Verifikasi</span>
                        <h3 class="card-title mb-2"><?=$exUser2 ?></h3>
                        <small class="text-danger fw-semibold"><a href="./pengguna/validasi.php">Verifikasi</a></small> 
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">History Petugas</span>
                        <h3 class="card-title mb-2">Sejarah</h3>
                        <small class="text-danger fw-semibold"><a href="./pengguna/validasi.php">Verifikasi</a></small> 
                      </div>
                    </div>
                  </div> -->
             
            <!-- </div>
<div class="row"> -->

          <!-- Content wrapper -->
<?php include "../layouts/footer_dashboard.php" ?>