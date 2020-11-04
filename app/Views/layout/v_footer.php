<!-- /.col-md-6 -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
</section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Dion Kuarta</a>.</strong>
    All rights reserved.

</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>/template/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>/template/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>/template/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url() ?>/template/plugins/select2/js/select2.full.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>/template/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>/template/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>/template/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/template/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>/template/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/template/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- page script -->












<script>
    $(function() {


        $('#reservationdate').datetimepicker({
            // dateFormat: 'dd-mm-yy',
            format: 'YYYY-MM-DD',
            minDate: getFormattedDate(new Date())
        });

        function getFormattedDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getYear().toString().slice(2);
            return day + '-' + month + '-' + year;
        }

        $('.select2').select2()





        $('#tabelmaster').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Datamaster/jquery_master'); ?>",
                "type": "POST"
            }
        });
        $('#tabelkk').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Datakk/jquery_master'); ?>",
                "type": "POST"
            }
        });
        $('#tabellaki').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_laki'); ?>",
                "type": "POST"
            }
        });
        $('#tabelperempuan').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_perempuan'); ?>",
                "type": "POST"
            }
        });

        $('#tabelkksarilamak').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_kk_sarilamak'); ?>",
                "type": "POST"
            }
        });

        $('#tabelkkpurwajaya').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_kk_purwajaya'); ?>",
                "type": "POST"
            }
        });


        $('#tabelkkketinggian').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_kk_ketinggian'); ?>",
                "type": "POST"
            }
        });

        $('#tabelkkair_putih').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_kk_air_putih'); ?>",
                "type": "POST"
            }
        });


        $('#tabelkkbuluh_kasok').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_kk_buluh_kasok'); ?>",
                "type": "POST"
            }
        });

        $('#tabelsarilamak').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_sarilamak'); ?>",
                "type": "POST"
            }
        });

        $('#tabelpurwajaya').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_purwajaya'); ?>",
                "type": "POST"
            }
        });

        $('#tabelketinggian').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_ketinggian'); ?>",
                "type": "POST"
            }
        });

        $('#tabelair_putih').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_air_putih'); ?>",
                "type": "POST"
            }
        });

        $('#tabelbuluh_kasok').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_buluh_kasok'); ?>",
                "type": "POST"
            }
        });

        $('#tabelislam').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_islam'); ?>",
                "type": "POST"
            }
        });

        $('#tabelprotestan').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_protestan'); ?>",
                "type": "POST"
            }
        });

        $('#tabelkatolik').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_katolik'); ?>",
                "type": "POST"
            }
        });

        $('#tabelhindu').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_hindu'); ?>",
                "type": "POST"
            }
        });

        $('#tabelbuddha').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_buddha'); ?>",
                "type": "POST"
            }
        });

        $('#tabelkonghucu').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_konghucu'); ?>",
                "type": "POST"
            }
        });

        $('#tabelstunting').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_stunting'); ?>",
                "type": "POST"
            }
        });

        $('#tabelbalita').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_balita'); ?>",
                "type": "POST"
            }
        });

        $('#tabelanak_anak').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_anak_anak'); ?>",
                "type": "POST"
            }
        });

        $('#tabelremaja').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_remaja'); ?>",
                "type": "POST"
            }
        });

        $('#tabeldewasa').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_dewasa'); ?>",
                "type": "POST"
            }
        });

        $('#tabellansia').DataTable({
            "order": [],
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Home/jquery_master_lansia'); ?>",
                "type": "POST"
            }
        });


        $('#example1').DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>
</body>

</html>