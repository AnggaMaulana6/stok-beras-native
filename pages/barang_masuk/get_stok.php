<?php
include("../../db/koneksi.php");
$tamp = $_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];
$sql = "SELECT *
         FROM gudang
         where kode_barang = '$kode_bar'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
   // output data of each row
   while ($row = mysqli_fetch_assoc($result)) {
?>
      <div class="row mb-3">
         <label for="stok" class="col-sm-2 col-form-label">Stok Awal<span class="text-danger">*</span></label>
         <div class="col-sm-10">
            <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $row["jumlah"]; ?>" readonly>
         </div>
      </div>
<?php
   }
} else {
   echo "0 hasil";
}

mysqli_close($con);
?>