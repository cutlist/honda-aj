<!DOCTYPE html>
<?
error_reporting(0);
include "include/application_top.php";
$opt 	 = $_REQUEST['opt'];
$menu 	 = $_REQUEST['menu'];
$submenu = $_REQUEST['submenu'];
$act 	 = $_REQUEST['act'];
$mod 	 = $_REQUEST['mod'];
	//echo $_SESSION['lvl'];
	//exit();
	if (empty($_SESSION['posisi']))
	{
		echo '<script>alert ("Silahkan Login Terlebih Dahulu!")</script>';
		print '<meta http-equiv="refresh" content="0;url=../index.php"/>';
		exit;
	}
?>
<html>
<?
	include "head.php";
?>
    <body class="skin-blue">
<?
	include "header.php";
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
<?
		include "menu.php";
		include "contents.php";
?>
        </div>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
		<script src="js/mousetrap.js" type="text/javascript"></script> 
<?
if(!empty($opt))
	{
?>
	    <!-- DATA TABES SCRIPT -->
	    <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	    <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	    <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
	    <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		
        <!-- select2 -->
        <script src="js/select2/select2.js" type="text/javascript"></script> 
<?
	}
/*
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- select2 -->
        <script src="js/select2/select2.js" type="text/javascript"></script> 
        <!-- Morris.js charts -->
        <script src="js/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script> 
*/
?>
        
    </body>
</html>