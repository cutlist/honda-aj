<?
	include "include/fungsi_indotgl1.php";
	if(!empty($_REQUEST[tahun2]) && !empty($_REQUEST[bulan2]))
		{
		$periode_tahun1 = $_REQUEST[tahun1];
		$periode_bulan1 = $_REQUEST[bulan1];
		$periode_tahun2 = $_REQUEST[tahun2];
		$periode_bulan2 = $_REQUEST[bulan2];
		}
	else if(empty($_REQUEST[tahun1]) && empty($_REQUEST[bulan1]))
		{
		$periode_tahun1 = date("Y");
		$periode_bulan1 = date('m');
		$periode_tahun2 = date("Y");
		$periode_bulan2 = date('m');
		}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KOMPENSASI <small>RINCIAN</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:left;width:60%">
				                    	<table style="width:100%">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
				                    			<td width="3%">:</td>
				                    			<td colspan="2"><select name="EmployeeID" style="padding:3px;" class="form-control" id="select1" required="">
				                    							<option value=''>PILIH KARYAWAN</option>
																		<?
																			if($_SESSION[posisi]=='DIREKSI')
												                            	{
																				$q1 = mysql_query("SELECT * FROM abs_x23_employee_vw WHERE status='AKTIF' GROUP BY EmployeeID  ORDER BY FirstName");
																				}
			                           									 	else
												                            	{
												                            	$dEmp = mysql_fetch_array(mysql_query("SELECT nik FROM x23_user_vw WHERE id='$_SESSION[id]'"));
																				$q1 = mysql_query("SELECT * FROM abs_x23_employee_vw WHERE EmployeeID='$dEmp[nik]'");
																				}
																			
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[EmployeeID]?>" <?if($_REQUEST[EmployeeID]==$dA[EmployeeID]){?>selected=""<?}?> ><?echo "$dA[FirstName] $dA[LastName] | $dA[DepartmentName]"?></option>
																		<?
																				}
																		?>
															    </select><//?echo $_SESSION[id]?></td>
				                    		</tr>
				                    		<tr>
				                    			<td>BULAN AWAL/TAHUN AWAL</td>
				                    			<td>:</td>
                                    			<td width="50%"><select name="bulan1" class="form-control" style="height:35px" required="">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan1 == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td><select name="tahun1" class="form-control" style="height:35px" required="">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun1 == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
				                    		</tr>
				                    		<tr>
				                    			<td>BULAN AKHIR/TAHUN AKHIR</td>
				                    			<td>:</td>
                                    			<td width="50%"><select name="bulan2" class="form-control" style="height:35px" required="">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan2 == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td><select name="tahun2" class="form-control" style="height:35px" required="">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun2 == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
                                    			<td colspan="2"><button type="submit" class="btn btn-primary pull-left" style="width:100%"><i class="fa fa-search"></i> Cari</button></td>
				                    		</tr>
				                    		<?
				                            if(!empty($_REQUEST[EmployeeID]))
				                            	{
												if($_SESSION[posisi]=='DIREKSI'){
				                    		?>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
		                                    			<td colspan="2"><button type="button" style="width: 100%" onclick="window.open('printaj/h2/kom_rincian.php?<?echo "EmployeeID=$_REQUEST[EmployeeID]&bulan1=$_REQUEST[bulan1]&tahun1=$_REQUEST[tahun1]&bulan2=$_REQUEST[bulan2]&tahun2=$_REQUEST[tahun2]";?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button></td>
						                    		</tr>
					                    	<?
					                    			}
					                    		}
					                    	?>
		                            	</table>
	                            	</div>
                                    </form>
	                            <?
	                            $start 		= date("$_REQUEST[tahun1]-$_REQUEST[bulan1]-01");
	                            $end		= date("$_REQUEST[tahun2]-$_REQUEST[bulan2]-01");;
								$timeStart 	= strtotime($start);
								$timeEnd 	= strtotime($end);
								
								$numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
								$numBulan += date("m",$timeEnd)-date("m",$timeStart);
								//echo $numBulan;
								
								if($numBulan < 0){
									echo '<script>alert ("Periode Awal Tidak Boleh Lebih Besar Dari Periode Akhir!")</script>';
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
									exit();
									}
								if($numBulan > 12){
									echo '<script>alert ("Periode  Tidak Boleh Lebih Dari 12 Bulan!")</script>';
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
									exit();
									}
										
	                            if(!empty($_REQUEST[EmployeeID]))
	                            	{
	                            ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:120%">
			                            <thead>
			                    			<th style="padding:7px;">BULAN</th>
			                    			<th style="padding:7px;">TAHUN</th>
			                    			<th style="padding:7px;">GAJI POKOK (RP)</th>
			                    			<th style="padding:7px;">UANG HARIAN (RP)</th>
			                    			<th style="padding:7px;">KOMISI SERVIS (RP)</th>
			                    			<th style="padding:7px;">KOMISI JASA (RP)</th>
			                    			<th style="padding:7px;">KOMISI KEPALA BENGKEL (RP)</th>
			                    			<th style="padding:7px;">TAMBAHAN (RP)</th>
			                    			<th style="padding:7px;">POTONGAN (RP)</th>
			                            </thead>
			                            <tbody>
			                    		
	                            <?
		                            	for($selisihbulan = 1; $selisihbulan <= $numBulan; $selisihbulan++) 
		                            		{
		                            		$periode_bulan 	= $periode_bulan1-1+$selisihbulan;
		                            		if($periode_bulan > 12){
												$periode_tahun = $periode_tahun1+1;
												$periode_bulan = $periode_bulan-12;
												}
											else{
												$periode_tahun = $periode_tahun1;
												$periode_bulan = $periode_bulan;
												}
												
			            					if(strlen($periode_bulan)==1){
												$periode_bulan = "0".$periode_bulan;
												}
			            					else{
												$periode_bulan = $periode_bulan;
												}
											
											//echo "$periode_bulan $periode_tahun</br>";
		                            		
				                            $dBln = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bulan WHERE angkabln='$periode_bulan'"));
				                            
				                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
				                            
				                            $hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE SUBSTR(Scan4,1,4)='$periode_tahun' AND SUBSTR(DATE,6,2)='$periode_bulan' AND EmployeeID='$_REQUEST[EmployeeID]'"));
				                            $gaji 		= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
				                            $tharian	= $gaji[uharian]*$hadir[total]; 
				                            $ugaji 		= $gaji[ugapok];
											
				                            // HITUNG UANG LEMBUR
				                            $dL 		= mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS totulembur FROM x23_uanglembur WHERE tahun='$periode_tahun' AND bulan='$periode_bulan' AND idkaryawan='$dA[id]'"));
				                            
				                            // HITUNG POTONG
				                            $dP1 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[id]' AND metodebayar='GAJI' AND status='1'"));
				                            $dP2 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[id]' AND metodebayar='GAJI' AND status='1'"));
				                            $totpot		= $dP1[total]+$dP2[total];
				                            
				                            $dNS1x = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
											$dNS2x = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
											$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE jenis='OUTPUT' AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND status='1'"));
											
											$x = round(($dNS1x[total]-($dNS1x[total]*2/100)+$dNS2x[total])/1.1,0);
											$y = round($dOx[total]/$x*100,0);
											
				                    		if($dA[posisi]=="4")
				                    			{
												$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dA[id]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
												$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dA[id]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
												$d = round(($dNS1[total]-($dNS1[total]*2/100)+$dNS2[total])/1.1,0);
												$e = round($d*$y/100,0);
												$f = $d-$e;
												
					                    		$dB1=mysql_fetch_array(mysql_query("SELECT persenkomisi FROM x23_komsetbruto WHERE omsetbruto <= '$f' ORDER BY omsetbruto DESC LIMIT 1"));
					                    		$g = round($f+($f*$dB1[persenkomisi]/100),0);
					                    		
					                    		$dB2=mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
												$a = round($x*$y/100,0);
												$b = $x-$a;
												
					                    		if($dA[pangkat]=="KEPALA MEKANIK"){
													$c = round($b*$dB2[kepalamekanik]/100,0);
													}
												}
												
				                    		if($dA[posisi]=="3" || $dA[posisi]=="7")
				                    			{
					                    		$dB2=mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
												$a = round($x*$y/100,0);
												$b = $x-$a;
												if($dA[posisi]=="3"){$c = round($b*$dB2[sa]/100,0);}
												if($dA[posisi]=="7"){$c = round($b*$dB2[kepalamekanik]/100,0);}
												
					                    		if($dA[posisi]=="7")
					                    			{
													$dAX = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																										SUM(diskon) AS b,
																										SUM(total) AS c
																									FROM x23_notajual_det WHERE 
																									substr(tglnota,6,2)='$periode_bulan' AND substr(tglnota,1,4)='$periode_tahun' AND 
																									nonota IN (
																										SELECT nomor FROM x23_kwitansi WHERE 
																										substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND 
																										jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')"));
																										
													
													mysql_query("TRUNCATE temp_x23_pndharian");
						                            $q1 = mysql_query("SELECT * FROM x23_notaservice WHERE substr(tglnota,6,2)='$periode_bulan' AND substr(tglnota,1,4)='$periode_tahun' AND status='2'");
													while($d1 = mysql_fetch_array($q1))
						                            	{
														$d3 = mysql_fetch_array(mysql_query("SELECT SUM(tarifasli) AS tarifasli, SUM(tarifkpb*0.98) AS tarifkpb, SUM(diskon) AS diskon, SUM(tarif*1.1) AS tarif FROM x23_notaservice_det WHERE nonota='$d1[nonota]'"));
														$d4 = mysql_fetch_array(mysql_query("SELECT SUM(totdiskon) AS totdiskon, SUM(total) AS total FROM x23_notajual_det WHERE nonota='$d1[nonota]'"));
														$hargasli = $d4[total]+$d4[diskon];
														$total = $d3[tarif]+$hargasli+$d3[tarifkpb];
														
														$dcp = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]' AND jnskj='KPB'"));	
														
															if(empty($dcp[id]))
																{
																mysql_query("INSERT INTO temp_x23_pndharian (a,b,c,d,e,x) VALUES (
																													'$d3[tarifasli]',
																													'$d3[diskon]',
																													'$d3[tarif]',
																													'$hargasli',
																													'$d4[totdiskon]',
																													$total)
																			");
																			
																}
															if(!empty($dcp[id]))
																{
																mysql_query("INSERT INTO temp_x23_pndharian (a,b,c,d,e,f,x) VALUES (
																													'$d3[tarifasli]',
																													'$d3[diskon]',
																													'$d3[tarif]',
																													'$hargasli',
																													'$d4[totdiskon]',
																													'$d3[tarifkpb]',
																													$total)
																			");
																}
						                            	}
														
													$dB = mysql_fetch_array(mysql_query("SELECT SUM(a) AS a,
																								SUM(b) AS b,
																								SUM(c) AS c,
																								SUM(d) AS d,
																								SUM(e) AS e,
																								SUM(f) AS f,
																								SUM(g) AS g,
																								SUM(h) AS h,
																								SUM(i) AS i,
																								SUM(j) AS j,
																								SUM(x) AS x
																							FROM temp_x23_pndharian"));
																							
													$servis   = $dB[d]-$dB[e];
													
													$dC = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS total FROM x23_claimoli_det WHERE substr(tglservis,6,2)='$periode_bulan' AND substr(tglservis,1,4)='$periode_tahun'"));
															
													$d2 = $dAX[c]+$servis-$dC[total];
													$e2 = round($d2/1.1,0);
													$f2 = round($e2*0.01,0);
													}
												}
								?>
				                    		
			                                <tr style="cursor:pointer">
				                    			<td><?echo $dBln[namabln]?></td>
				                    			<td width="5%"><?echo $periode_tahun?></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format($ugaji,"0","",".")?></span></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format($tharian,"0","",".")?></span></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format(round($g/2),"0","",".")?></span></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format(round($c/2),"0","",".")?></span></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format(round($f2/2),"0","",".")?></span></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format($dTt[utambahan],"0","",".")?></span></td>
				                    			<td width="12%"align="right"><span style="padding-right:10%"><?echo number_format($totpot,"0","",".")?></span></td>
				                    		</tr>
				                <?
											}
								?>
				                		</tbody>
		                           	</table>
				                    <div class="clearfix"></div>
								<?
				                	}
				                ?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>
        <script>
        //SELECT2
			$(function(){
			           
			  /* dropdown and filter select */
			  var select = $('#select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
		</script>
        <!-- uang -->
        <script type="text/javascript">
		// memformat angka ribuan
		function formatAngka(angka) {
			 if (typeof(angka) != 'string') angka = angka.toString();
			 var reg = new RegExp('([0-9]+)([0-9]{3})');
			 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			 return angka;
			}
		
		$('#uang').on('keypress', function(e) {
			 var c = e.keyCode || e.charCode;
			 switch (c) {
			  case 8: case 9: case 27: case 13: return;
			  case 65:
			   if (e.ctrlKey === true) return;
			 }
			 if (c < 48 || c > 57) e.preventDefault();
			})
			.on('keyup', function() {
			 var inp = $(this).val().replace(/\./g, '');
		  
			 $(this).val(formatAngka(inp));
			});
		$('#uang2').on('keypress', function(e) {
			 var c = e.keyCode || e.charCode;
			 switch (c) {
			  case 8: case 9: case 27: case 13: return;
			  case 65:
			   if (e.ctrlKey === true) return;
			 }
			 if (c < 48 || c > 57) e.preventDefault();
			})
			.on('keyup', function() {
			 var inp = $(this).val().replace(/\./g, '');
		  
			 $(this).val(formatAngka(inp));
			});
		</script>
        <!-- datemask -->
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

            });
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();

        </script>