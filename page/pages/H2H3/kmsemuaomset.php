
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KINERJA MEKANIK <small>SEMUA (RP)</small></h4>
                                    <div style="float:right;width:50%">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    		<tr>
                                    			<td><input type="text" name="periode" style="height:33px" required="" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode Tanggal Selesai Servis"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/></td>
                                    			
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    			<td width="1%">	<button type="button"  onclick="window.open('print/h2/kmsemuaomset.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           					</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
										
	                            <?
	                            if(!empty($_REQUEST[periode]))
	                            	{    
						            $pecah = explode(" s.d. ", $_REQUEST[periode]);
						            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
						            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
						            
									$dC1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
									$widthtable  = $dC1[total]*25 ."%";
									$widthtable2 = 82/$dC1[total] ."%";
									$widthtable3 = 82/$dC1[total]/2 ."%";
									$colspan = $dC1[total]*2;
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:<?echo $widthtable;?>;padding-right:20px">
										<thead>
											<tr>
												<td rowspan="3" style="font-size:14px;width:<?echo $widthtable3;?>"><b><center>TANGGAL SERVIS</center></b></td>
												<td colspan="<?echo $colspan;?>" style="font-size:14px"><b><center>NAMA MEKANIK</center></b></td>
											</tr>
											<tr>
												<?
												$qM = mysql_query("SELECT nama FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
												?>
													<td style="font-size:14px;width:<?echo $widthtable2;?>"colspan="2"><b><center><?echo $dM[nama]?></center></b></td>
												<?
													}
												?>
											</tr>
											<tr>
												<?
												$qM = mysql_query("SELECT nama FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
												?>
													<td style="font-size:14px;width:<?echo $widthtable3;?>"><b><center>KPB (RP)</center></b></td>
													<td style="font-size:14px;width:<?echo $widthtable3;?>"><b><center>CASH (RP)</center></b></td>
												<?
													}
												?>
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1' GROUP BY tglnota");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
												<?
												$qM = mysql_query("SELECT id FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
													$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND tglselesai='$d1[tglnota]' AND statuskwitansi='1')"));
													$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND tglselesai='$d1[tglnota]' AND statuskwitansi='1')"));
												?>
													<td align="right"><span style="margin-right:20%"><?echo number_format($dNS1[total],"0","",".")?></span></td>
													<td align="right"><span style="margin-right:20%"><?echo number_format($dNS2[total],"0","",".")?></span></td>
												<?
													}
												?>
			                                </tr>
			                            <?
			                            	}
								
										/*
										$dNS1x = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
										$dNS2x = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
										$x = round(($dNS1x[total]-($dNS1x[total]*2/100)+$dNS2x[total])/1.1,0);
										
										$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE jenis='OUTPUT' AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND status='1'"));
										
										$y = round($dOx[total]/$x*100,0);
										$a = round($x*$y/100,0);
										$b = $x-$a;
										$c = round($b*3/100,0);
										*/
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<td align="center" rowspan="2"><b>TOTAL (RP)</br>(KPB - 2%)</b></td>
												<?
												$qM = mysql_query("SELECT id FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
													$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
												?>
													<td align="right"><b><span style="margin-right:20%"><?echo number_format(round($dNS1[total]-($dNS1[total]*2/100),0),"0","",".")?></span></td>
													<td align="right"><b><span style="margin-right:20%"><?echo number_format($dNS2[total],"0","",".")?></span></td>
												<?
													}
												?>
											</tr>
											<tr>
												<?
												$qM = mysql_query("SELECT id FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
													$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$x0 = round(($dNS1[total]-($dNS1[total]*2/100)+$dNS2[total]),0);
												?>
													<td align="center" colspan="2"><b><span style="margin-right:0%"><?echo number_format(round($dNS1[total]-($dNS1[total]*2/100)+$dNS2[total],0),"0","",".")?></span></td>
												<?
													}
												?>
											</tr>
											<!--
											<tr>
												<?
												$qM = mysql_query("SELECT id FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
													$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$d = round(($dNS1[total]-($dNS1[total]*2/100)+$dNS2[total])/1.1,0);
													$e = round($d*$y/100,0);
													$f = $d-$e;
												?>
													<td align="center" colspan="2"><b>
													D : <?echo number_format($d,"0","",".")?></br>
													E : <?echo number_format($e,"0","",".")?></br>
													F : <?echo number_format($f,"0","",".")?></br>
														
													</span></td>
												<?
													}
												?>
											</tr>
											-->
			                            </tfoot>
									</table>
								<?
									}
									
								/*
								$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
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
										
								$d2 = $dA[c]+$servis-$dC[total];
								$e2 = round($d2/1.1,0);
								$f2 = round($e2*0.01,0);
								*/
								?>
								<!--
								X : <?echo number_format($x,"0","",".")?></br>
								Total Pengeluaran : <?echo number_format($dOx[total],"0","",".")?></br>
								Y% : <?echo number_format($y,"0","",".")?> %</br>
								</br>
								A : <?echo number_format($a,"0","",".")?></br>
								B : <?echo number_format($b,"0","",".")?></br>
								C : <?echo number_format($c,"0","",".")?></br>
								Jumlah Omset Barang (Penjualan) : <?echo number_format($dA[c],"0","",".")?></br>
								Jumlah Omset Barang (Servis) : <?echo number_format($servis,"0","",".")?></br>
								Jumlah Omset Oli KPB : <?echo number_format($dC[total],"0","",".")?></br>
								D : <?echo number_format($d2,"0","",".")?></br>
								E : <?echo number_format($e2,"0","",".")?></br>
								F : <?echo number_format($f2,"0","",".")?></br>
								-->
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        <!-- buat angka -->
        <script type="text/javascript">
			function buat_angka(e,teks)
			{
				var goodInput = teks;
				var evt = (e)?e:window.event;
				var key_code = (document.all)?evt.keyCode:evt.which;
				
				if (key_code == 0 || key_code == 8 || key_code == 11 || key_code == 9 || key_code == 13) 
					return true;
				if (goodInput.indexOf(String.fromCharCode(key_code)) == -1)	
					return false;
				else
					return true;
			}
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
		
		$('.uang').on('keypress', function(e) {
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
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example5').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example6').dataTable({
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