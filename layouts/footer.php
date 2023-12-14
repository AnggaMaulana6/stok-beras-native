
</div>
</div>
                </div>
             
              </div>
            </div>
            <!-- / Content -->

            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Page level plugins -->
<script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../assets/js/demo/datatables-demo.js"></script>
  </body>
</html>

<script>
                        jQuery(document).ready(function($) {
                            $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
                                var tamp = $(this).val(); // Ciptakan variabel provinsi
                                $.ajax({
                                    type: 'POST', // Metode pengiriman data menggunakan POST
                                    url: './get_stok.php', // File yang akan memproses data
                                    data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                                    success: function(data) { // Jika berhasil
                                        $('.tampung').html(data); // Berikan hasil ke id kota
                                    }
                                });
                            });
                        });
                    </script>

                    <script>
                        jQuery(document).ready(function($) {
                            $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
                                var tamp = $(this).val(); // Ciptakan variabel provinsi
                                $.ajax({
                                    type: 'POST', // Metode pengiriman data menggunakan POST
                                    url: './get_satuan.php', // File yang akan memproses data
                                    data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                                    success: function(data) { // Jika berhasil
                                        $('.tampung1').html(data); // Berikan hasil ke id kota
                                    }
                                });
                            });
                        });
                    </script>

                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $(function() {
                                $('#Myform1').submit(function() {
                                    $.ajax({
                                        type: 'POST',
                                        url: '../laporan/excel_brgmasuk.php',
                                        data: $(this).serialize(),
                                        success: function(data) {
                                            $(".tampung1").html(data);
                                            $('.table').DataTable();

                                        }
                                    });

                                    return false;
                                    e.preventDefault();
                                });
                            });
                        });
                    </script>

                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $(function() {
                                $('#Myform2').submit(function() {
                                    $.ajax({
                                        type: 'POST',
                                        url: '../laporan/excel_brgkeluar.php',
                                        data: $(this).serialize(),
                                        success: function(data) {
                                            $(".tampung2").html(data);
                                            $('.table').DataTable();
                                        }
                                    });

                                    return false;
                                    e.preventDefault();
                                });
                            });
                        });
                    </script>