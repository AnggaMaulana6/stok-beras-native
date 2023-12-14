<?php
include("../../db/koneksi.php");
$tamp = $_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];
$sql = "SELECT *
          FROM gudang
          WHERE kode_barang = '$kode_bar'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {
?>

    <div class="row mb-3">
      <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $row["satuan"]; ?>" readonly>
      </div>
    </div>
<?php
  }
} else {
  echo "0 results";
}
mysqli_close($con);

?>