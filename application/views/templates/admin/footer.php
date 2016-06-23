<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2016 editing by <a href="http://jvc.or.id">JVC</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jQuery-2.2.0.min.js' ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js' ?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js' ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js' ?>"></script>
<!-- Event Calender -->
<script src="<?php echo base_url().'assets/js/jquery.eventCalendar.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js' ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js' ?>"></script>

<script>
  
  $(function () {
    //Table
    $("#tabelMember").DataTable();
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      todayHighlight: true
    });

    //Timepicker
    $("#timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });
    //Kalender
    $("#eventCalendarHumanDate").eventCalendar({
        eventsjson: "<?php echo base_url().'api/jadwal/'; ?>",
        jsonDateFormat: "human"  // 'YYYY-MM-DD HH:MM:SS'
    });
    $( window ).load( counter );
  });


  $( window ).load(function() {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url().'api/counter/' ?>"
        }).done(function( data ) {
        $('#counter').html(data);
    });

    $.ajax({
      type: "GET",
      url: "<?php echo base_url().'api/members/' ?>"
      }).done(function( data ) {
      $('#registrasi-widget').html(data);
       $('#registrasi').html(data);
    });

    $.ajax({
      type: "GET",
      url: "<?php echo base_url().'api/kalender/' ?>"
      }).done(function( data ) {
       $('#kalender').html(data);
    });
  });

</script>
</body>
</html>
