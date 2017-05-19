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
<style>
html{
min-height:100%;/* make sure it is at least as tall as the viewport */
position:relative;
}
body{
height:100%; /* force the BODY element to match the height of the HTML element */
}
</style>
<html>
<?
	include "head.php";
?>
    <body>
<?
		$d1   = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE status='1' AND tanggal=CURDATE() ORDER BY noantrian DESC"));
		$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE tanggal=CURDATE()"));
		
		if($_SESSION[noantrian]!=$d1[noantrian])
			{
?>
			<audio autoplay preload="none">
				<source src="tingtong.mp3" type="audio/mpeg" />
			</audio>
<?
			}
			
			$_SESSION[noantrian] = $d1[noantrian];
?>
			<meta http-equiv="refresh" content="2;URL='?noantrian=<?echo $d1[noantrian]?>'"></meta>
			            <div id="cloud-container">
			                	<?
								if(!empty($dCek[id]))
									{
			                	?>
	                                <div class="col-xs-8" style="margin-top: 10px;margin-bottom: 10px;">
	                                	<div style="text-align:center;height:97vh; border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
		                                	<div class="btn-danger" style="height:94vh;border-radius:5px;padding:15px;">
		                                			<h1>NO. ANTRIAN SAAT INI</h1>
							                	<?
												if(!empty($d1[id]))
													{
							                	?>
			                                    	<span style="font-size:300px;letter-spacing:10px;"><b><?echo $d1[noantrian]?></b></span>
			                                    	<div class="clearfix"></div>
			                                    	<button type="button" class="btn btn-warning" style="width:30%;font-size:24px;border:0px #fff solid;font-weight:bold"><i class="fa fa-calendar"></i> &nbsp;<?echo date("d-m-Y",strtotime($d1[tanggal]))?></button>
			                                    	<button type="button" class="btn btn-warning" style="width:30%;font-size:24px;border:0px #fff solid;font-weight:bold"><i class="fa fa-clock-o"></i> &nbsp;<?echo $d1[jammulai]?></button>
			                                    	<button type="button" class="btn btn-warning" style="width:30%;font-size:24px;border:0px #fff solid;font-weight:bold"><?echo $d1[nopol]?></button>
		                                    
		                                    	<?
						                        	}
												else
													{
													$dNan = mysql_fetch_array(mysql_query("SELECT noantrian FROM x23_antrian WHERE tanggal=CURDATE() AND status='0' ORDER BY noantrian ASC LIMIT 0,1"));
							                	?>
			                                    	<span style="font-size:300px;letter-spacing:10px;"><b><?echo $dNan[noantrian]?></b></span>
			                                    	<div class="clearfix"></div>
			                                    <?
						                        	}
						                        ?>
		                                    </div>
	                                    </div>
	                                </div>
	                                <div class="col-xs-4" style="margin-top: 10px;margin-bottom: 10px;">
	                                	<div style="text-align:center;height:97vh;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
		                                	<div class="" style="border-radius:5px;padding:5px;height:94vh;">
		                                			<h3>NO. ANTRIAN BERIKUTNYA</h3>
		                                			</br>
		                                		<?
												if(!empty($d1[id]))
													{
													$qA = mysql_query("SELECT noantrian FROM x23_antrian WHERE status='0' AND tanggal=CURDATE() ORDER BY noantrian ASC LIMIT 0,6");
													while($dA = mysql_fetch_array($qA))
														{
												?>
			                                    		<button type="button" class="btn btn-success" style="width:80%;font-size:44px;margin-bottom:10px;font-weight:bold;letter-spacing:10px;"><?echo $dA[noantrian]?></button>
			                               		<?	
														}
													}
													
												else
													{
													$dNan = mysql_fetch_array(mysql_query("SELECT noantrian FROM x23_antrian WHERE tanggal=CURDATE() AND status='0' ORDER BY noantrian ASC LIMIT 0,1"));
													$qA = mysql_query("SELECT noantrian FROM x23_antrian WHERE status='0' AND tanggal=CURDATE() AND noantrian!='$dNan[noantrian]' ORDER BY noantrian ASC LIMIT 0,6");
													while($dA = mysql_fetch_array($qA))
														{
												?>
			                                    		<button type="button" class="btn btn-success" style="width:80%;font-size:44px;margin-bottom:10px;font-weight:bold;letter-spacing:10px;"><?echo $dA[noantrian]?></button>
			                               		<?	
														}
													}
		                                		?>
		                                	</div>
	                                    </div>
	                                </div>
	                            <?
	                            	}
	                            ?>
			            </div>
    </body>
</html>