<!-- jQuery 3.3.1 -->
<!-- <script src="<?= base_url(); ?>assets/dist/plugins/jquery/jQuery-3.3.1.min.js"></script> -->

<!-- jQuery 3.4.1 -->
<script src="<?= base_url(); ?>assets/dist/plugins/jquery/dist/jquery.min.js"></script>
<!-- -------------------------------------------------------------------------- -->

<!-- Bootstrap 3.4.1 -->
<script src="<?= base_url(); ?>assets/dist/plugins/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url(); ?>assets/adminlte/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url(); ?>assets/adminlte/dist/js/demo.js"></script> -->
<script src="<?= base_url(); ?>assets/adminlte/dist/js/app.min.js"></script>

<!-- <script src="<?= base_url(); ?>assets/adminlte/dist/js/app.js" type="text/javascript"></script> -->

<!-- DataTables Component -->
<script src="<?= base_url(); ?>assets/dist/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/dist/plugins/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!-- DataTables 1.10.18 -->
<!-- <script src="<?= base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></!-->
<!-- <script src="<?= base_url(); ?>assets/datatables/js/dataTables.bootstrap.min.js"></script> -->

<!-- FastClick Component -->
<script src="<?= base_url(); ?>assets/dist/plugins/fastclick/lib/fastclick.js" type="text/javascript"></script>

<!-- Sparkline Component -->
<script src="<?= base_url(); ?>assets/dist/plugins/jquery-sparkline/dist/jquery.sparkline.min.js" type="text/javascript"></script>

<!-- jvectormap plugin -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>

<!-- SlimScroll Component -->
<script src="<?= base_url(); ?>assets/dist/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<!-- ChartJS Component -->
<script src="<?= base_url(); ?>assets/dist/plugins/chart.js/Chart.min.js" type="text/javascript"></script>

<!-- fontawesome JS V.5 -->
<script src="<?php echo base_url() ?>assets/dist/plugins/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>

<!-- Select2 -->
<script src="<?= base_url(); ?>assets/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select2min').select2({
      minimumResultsForSearch: Infinity
    });
  })
</script>

<!-- Datepicker Component -->
<script src="<?= base_url(); ?>assets/dist/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

<!-- iCheck -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
  $(function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
     //Date picker
     $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      // language: 'ar'
      // timePicker: true,
      // todayHighlight: true,
      // todayBtn: "linked",
      // allowInputToggle: true
    });
  });

  function numerica(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
    return true;
	}
</script>

<script src="<?php echo base_url() ?>assets/dist/js/mydist.js" type="text/javascript"></script>