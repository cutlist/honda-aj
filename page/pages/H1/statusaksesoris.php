<?
	if($submenu == 'A')
		{
		$dHitungX = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli_det WHERE status='1'"));
		$h1X = $dHitung[total];
		$h2X = $dHitung[total]*2;
		
		if($d1[accu] != $h1X){
			$red1aX="1";
			}
			else{$red1aX="0";}
		if($d3[anakkunci] != $h1X){
			$red3aX="1";
			}
			else{$red3aX="0";}
		if($d4[helm] != $h1X){
			$red4aX="1";
			}
			else{$red4aX="0";}
		if($d5[spion] != $h2X){
			$red5aX="1";
			}
			else{$red5aX="0";}
		if($d6[toolkit] != $h1X){
			$red6aX="1";;
			}
			else{$red6aX="0";}
		if($d8[bukuservis] != $h1X){
			$red8aX="1";
			}
			else{$red8aX="0";}
		
		if($red1aX == "1" || $red3aX == "1" || $red4aX == "1" || $red5aX == "1" || $red6aX == "1" || $red8aX == "1"){
			$statusX = "<span class='btn btn-warning' style='padding:5px;font-size:14px;'>TIDAK SEIMBANG</span>";
			}
		else{
			$statusX = "<span class='btn btn-primary' style='padding:5px;font-size:14px;'>TELAH SEIMBANG</span>";
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>STATUS AKSESORIS MASUK</h4>
	                           		<div style="float:left" class="col-xs-7">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA BELI / NO. NOTA MUTASI MASUK" class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                           				<button type="button"  onclick="window.open('print/h1/statusaksesoris.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
			                           			<?
			                           				}
			                           			?>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
                                    
									<!--
	                           		<div style="float:right" class="col-xs-7">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="" align="right"><b>STATUS SAAT INI : </b></td>
                                    			<td width="1%" align="right"><?echo $statusX?></td>
                                    		</tr>
                                    	</table>
                                    </div>
									-->
                                    
			                        <table id="example1" class="table table-striped table-hover table-bordered" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px;">NO. NOTA BELI / NO. NOTA MUTASI MASUK</th>
			                                    <th style="padding:7px;width:9%">JUMLAH BELI MOTOR</th>
			                                    <th style="padding:7px;width:9%">ACCU</th>
			                                    <th style="padding:7px;width:9%">ALAS KAKI</th>
			                                    <th style="padding:7px;width:9%">2 ANAK KUNCI</th>
			                                    <th style="padding:7px;width:9%">HELM</th>
			                                    <th style="padding:7px;width:9%">SPION</th>
			                                    <th style="padding:7px;width:9%">TOOLKIT</th>
			                                    <th style="padding:7px;width:9%">JAKET</th>
			                                    <th style="padding:7px;width:9%">BUKU SERVIS</th>
												<!--
			                                    <th style="padding:7px;width:9%">STATUS</th>
												-->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$qA = mysql_query("SELECT * FROM tbl_notabeli WHERE scan='1' AND nonota LIKE '%$_REQUEST[cari]%' ORDER BY id DESC");
											}
										else
											{
											$qA = mysql_query("SELECT * FROM tbl_notabeli WHERE scan='1' ORDER BY id DESC");
											}
		                            	
		                            	while($dA = mysql_fetch_array($qA))
		                            		{
		                            		//$d0 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS qty FROM tbl_stokunit WHERE nonota='$dA[nonota]'"));
		                            		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM stok_accu WHERE nonota='$dA[nonota]'"));
		                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM stok_alaskaki WHERE nonota='$dA[nonota]'"));
		                            		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM stok_anakkunci WHERE nonota='$dA[nonota]'"));
		                            		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM stok_helm WHERE nonota='$dA[nonota]'"));
		                            		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM stok_spion WHERE nonota='$dA[nonota]'"));
		                            		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM stok_toolkit WHERE nonota='$dA[nonota]'"));
		                            		$d7 = mysql_fetch_array(mysql_query("SELECT * FROM stok_jaket WHERE nonota='$dA[nonota]'"));
		                            		$d8 = mysql_fetch_array(mysql_query("SELECT * FROM stok_bukuservis WHERE nonota='$dA[nonota]'"));
		                            		
											$dHitung = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_stokunit WHERE nonota='$dA[nonota]'"));
											$h1 = $dHitung[total];
											$h2 = $dHitung[total]*2;
		
											if($d1[accu] != $h1){
												$red1a = "1";
												if($d1[accu] < $h1){
													$x = $h1-$d1[accu];
													$red1 = "color:red";
													$accu="Kurang $x PCS";}
												if($d1[accu] > $h1){
													$x = $d1[accu]-$h1;
													$red1 = "color:green";
													$accu="Lebih $x PCS";}
												}
												else{$red1a="0";$red1="";$accu="Cukup";}
											if($d3[anakkunci] != $h1){
												$red3a = "1";
												if($d3[anakkunci] < $h1){
													$x = $h1-$d3[anakkunci];
													$red3 = "color:red";
													$anakkunci="Kurang $x PCS";}
												if($d3[anakkunci] > $h1){
													$x = $d3[anakkunci]-$h1;
													$red3 = "color:green";
													$anakkunci="Lebih $x PCS";}
												}
												else{$red3a="0";$red3="";$anakkunci="Cukup";}
											if($d4[helm] != $h1){
												$red4a = "1";
												if($d4[helm] < $h1){
													$x = $h1-$d4[helm];
													$red4 = "color:red";
													$helm="Kurang $x PCS";}
												if($d4[helm] > $h1){
													$x = $d4[helm]-$h1;
													$red4 = "color:green";
													$helm="Lebih $x PCS";}
												}
												else{$red4a="0";$red4="";$helm="Cukup";}
											if($d5[spion] != $h2){
												$red5a = "1";
												if($d5[spion] < $h1){
													$x = $h1-$d5[spion];
													$red5 = "color:red";
													$spion="Kurang $x PCS";}
												if($d5[spion] > $h1){
													$x = $d5[spion]-$h1;
													$red5 = "color:green";
													$spion="Lebih $x PCS";}
												}
												else{$red5a="0";$red5="";$spion="Cukup";}
											if($d6[toolkit] != $h1){
												$red6a = "1";
												if($d6[toolkit] < $h1){
													$x = $h1-$d6[toolkit];
													$red6 = "color:red";
													$toolkit="Kurang $x PCS";}
												if($d6[toolkit] > $h1){
													$x = $d6[toolkit]-$h1;
													$red6 = "color:green";
													$toolkit="Lebih $x PCS";}
												}
												else{$red6a="0";$red6="";$toolkit="Cukup";}
											if($d8[bukuservis] != $h1){
												$red8a = "1";
												if($d8[bukuservis] < $h1){
													$x = $h1-$d8[bukuservis];
													$red8 = "color:red";
													$bukuservis="Kurang $x PCS";}
												if($d8[bukuservis] > $h1){
													$x = $d8[bukuservis]-$h1;
													$red8 = "color:green";
													$bukuservis="Lebih $x PCS";}
												}
												else{$red8a="0";$red8="";$bukuservis="Cukup";}
											
											if($red1a == "1" || $red3a == "1" || $red4a == "1" || $red5a == "1" || $red6a == "1" || $red8a == "1"){
												$status = "<span class='btn btn-warning' style='padding:0px 5px;font-size:12px;'>TIDAK SEIMBANG</span>";
												
											if(empty($d2[alaskaki])){
												$alaskasi = "0";
												}
											else{
												$alaskasi = $d2[alaskaki];
												}
											if(empty($d7[jaket])){
												$jaket = "0";
												}
											else{
												$jaket = $d7[jaket];
												}
										?>
												<tr style="cursor:pointer">
													<td align="center"><?echo $dA[nonota]?></td>
													<td align="right"><span style="padding-right: 15%;"><?echo $dHitung[total]?> UNIT</span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red1?>"><?echo $accu?></span></td>
													<td align="right"><span style="padding-right: 15%;"><?echo $alaskasi?> PCS</span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red3?>"><?echo $anakkunci?></span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red4?>"><?echo $helm?></span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red5?>"><?echo $spion?></span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red6?>"><?echo $toolkit?></span></td>
													<td align="right"><span style="padding-right: 15%;<?echo $red7?>"><?echo $jaket?> PCS</span></td>
													<td align="left"><span style="padding-right: 15%;<?echo $red8?>"><?echo $bukuservis?></span></td>
													<!--
													<td align="center"><?echo $status?></td>
													-->
												</tr>
										<?
												}
											else{
												$status = "<span class='btn btn-primary' style='padding:0px 5px;font-size:12px;'>TELAH SEIMBANG</span>";
												}
											}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
?>
	
        <script src="js/jquery.min.js"></script>
        
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>