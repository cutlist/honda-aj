<?
	if($submenu == 'A')
		{
		$d1   = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE status='1' AND tanggal=CURDATE() ORDER BY noantrian DESC"));
		$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE tanggal=CURDATE()"));
?>
			<meta http-equiv="refresh" content="10"></meta>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;">
			                	<h4>SERVIS <small>ANTRIAN BERJALAN</small></h4>
			                	<?
								if(!empty($dCek[id]))
									{
			                	?>
	                                <div class="inner col-xs-7">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
		                                	<div class="btn-danger" style="width:100%;height:358px;border-radius:5px;padding:5px;">
		                                			<h2>NO. ANTRIAN SAAT INI</h2>
							                	<?
												if(!empty($d1[id]))
													{
							                	?>
			                                    	<span style="font-size:145px;letter-spacing:5px;"><b><?echo $d1[noantrian]?></b></span>
			                                    	<div class="clearfix"></div>
			                                    	<button type="button" class="btn btn-success" style="width:30%;font-size:17px;border:1px #fff solid;font-weight:bold"><i class="fa fa-calendar"></i> &nbsp;<?echo date("d-m-Y",strtotime($d1[tanggal]))?></button>
			                                    	<button type="button" class="btn btn-success" style="width:30%;font-size:17px;border:1px #fff solid;font-weight:bold"><i class="fa fa-clock-o"></i> &nbsp;<?echo $d1[jammulai]?></button>
			                                    	<button type="button" class="btn btn-success" style="width:30%;font-size:17px;border:1px #fff solid;font-weight:bold"><?echo $d1[nopol]?></button>
		                                    
						                        <?
						                        	}
												else
													{
													$dNan = mysql_fetch_array(mysql_query("SELECT noantrian FROM x23_antrian WHERE tanggal=CURDATE() AND status='0' ORDER BY noantrian ASC LIMIT 0,1"));
							                	?>
			                                    	<span style="font-size:145px;letter-spacing:5px;"><b><?echo $dNan[noantrian]?></b></span>
			                                    	<div class="clearfix"></div>
			                                    <?
						                        	}
						                        ?>
		                                    </div>
	                                    </div>
	                                </div>
	                                <div class="inner col-xs-5">
	                                	<div style="text-align:center;width:100%;height:380px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
		                                	<div class="" style="width:100%;height:358px;border-radius:5px;padding:5px;">
		                                			<h3>NO. ANTRIAN BERIKUTNYA</h3>
		                                			</br>
		                                		<?
												if(!empty($d1[id]))
													{
													$qA = mysql_query("SELECT noantrian FROM x23_antrian WHERE status='0' AND tanggal=CURDATE() ORDER BY noantrian ASC LIMIT 0,3");
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
													$qA = mysql_query("SELECT noantrian FROM x23_antrian WHERE status='0' AND tanggal=CURDATE() AND noantrian!='$dNan[noantrian]' ORDER BY noantrian ASC LIMIT 0,3");
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
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
?>