<?
	if($submenu == 'A')
		{
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/h2/pndharianservis.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>PENDAPATAN HARIAN <i class="fa fa-angle-right"></i> SERVIS</small></h4>	 
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Nota Servis" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
			                        <table id="example2" class="table table-bordered table-striped" style="width:220%">
										<thead>
											<tr>
												<th rowspan="2" colspan="7"></th>
												<th colspan="10"><center>PEMBAYARAN</center></th>
												<th rowspan="3"><center>TOTAL (RP)</center></th>
											</tr>
											<tr>
												<th colspan="5"><center>KONSUMEN</center></th>
												<th colspan="5"><center>MAIN DEALER</center></th>
											</tr>
											<tr>
												<th width="3%"><center>NO.</center></th>
												<th width="6%"><center>TGL NOTA SERVIS</center></th>
												<th><center>NO. NOTA SERVIS</center></th>
												<th><center>NO. PKB</center></th>
												<th><center>NO. POLISI</center></th>
												<th width=""><center>WAKTU SERVIS</center></th>
												<th><center>NAMA MEKANIK</center></th>
												<th width="6%"><center>JASA (RP)</center></th>
												<th width="6%"><center>DISKON JASA (RP)</center></th>
												<th width="6%"><center>JASA + PPN (RP)</center></th>
												<th width="6%"><center>PART (RP)</center></th>
												<th width="6%"><center>DISKON PART (RP)</center></th>
												<th width="6%"><center>JASA (RP)</center></th>
												<th width="6%"><center>JASA (- 2%) (RP)</center></th>
												<th width="6%"><center>DISKON JASA (RP)</center></th>
												<th width="6%"><center>PART (RP)</center></th>
												<th width="6%"><center>DISKON PART (RP)</center></th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
			                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            $no=1;
										mysql_query("TRUNCATE temp_x23_pndharian");
										if(empty($_REQUEST[periode]))
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE() AND status='2'");
											}
										else
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND status='2'");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$mulai   = mktime(date("H",strtotime($d1[jammulai])), date("i",strtotime($d1[jammulai])), date("s",strtotime($d1[jammulai])), date("m",strtotime($d1[tglnota])), date("d",strtotime($d1[tglnota])), date("Y",strtotime($d1[tglnota])));
											$selesai = mktime(date("H",strtotime($d1[jamselesai])), date("i",strtotime($d1[jamselesai])), date("s",strtotime($d1[jamselesai])), date("m",strtotime($d1[tglselesai])), date("d",strtotime($d1[tglselesai])), date("Y",strtotime($d1[tglselesai])));
											
											$selisih_waktu = $selesai-$mulai;
											$jumlah_hari = floor($selisih_waktu/86400);
											if($jumlah_hari=="0"){
												$hari = "";
												}
											if($jumlah_hari!="0"){
												$hari = "$jumlah_hari Hari";
												}

											//Untuk menghitung jumlah dalam satuan jam:
											$sisa = $selisih_waktu % 86400;
											$jumlah_jam = floor($sisa/3600);
											if($jumlah_jam=="0"){
												$jam = "";
												}
											if($jumlah_jam!="0"){
												$jam = "$jumlah_jam Jam";
												}

											//Untuk menghitung jumlah dalam satuan menit:
											$sisa = $sisa % 3600;
											$jumlah_menit = floor($sisa/60);
											if(strlen($jumlah_menit)==1){
												$menit = "0".$jumlah_menit;
												}
											if(strlen($jumlah_menit) == 2){
												$menit = $jumlah_menit;
												}
											
											$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT SUM(tarifasli) AS tarifasli, SUM(tarifkpb*0.98) AS tarifkpb, SUM(diskon) AS diskon, SUM(tarif*1.1) AS tarif FROM x23_notaservice_det WHERE nonota='$d1[nonota]'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT SUM(totdiskon) AS totdiskon, SUM(total) AS total FROM x23_notajual_det WHERE nonota='$d1[nonota]'"));
											$hargasli = $d4[total]+$d4[diskon];
											
											//$total = $d3[tarif]+$hargasli-$d4[totdiskon]+$d3[tarifkpb];
											$total = $d3[tarif]+$hargasli+$d3[tarifkpb];
											
											$dcp = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]' AND jnskj='KPB'"));	
											
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right:20%"><?echo "$no."?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?echo $d1[nopkb]?></td>
			                                    <td align=""><?echo $d1[nopol]?></td>
			                                    <td align="right"><span style="padding-right:0%"><?echo "$hari $jam $jumlah_menit Menit"?></span></td>
			                                    <td align=""><?echo $d2[nama]?></td>
										<?
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
										?>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifasli],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarif],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($hargasli,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d4[totdiskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
										<?
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
										?>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifasli],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarif],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($hargasli,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d4[totdiskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifkpb]/0.98,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifkpb],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format(0,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format(0,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format(0,"0","",".")?></span></td>
										<?
													}
										?>
				                                <td align="right"><span style="padding-right:20%"><?echo number_format($total,"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
											
										$dA = mysql_fetch_array(mysql_query("SELECT SUM(a) AS a,
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
																				
										$konsumen   = $dA[c]+$dA[d]-$dA[e];
										$maindealer = $dA[f];
										
										//$pot = ROUND($dA[e]*0.02,0);
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="20"></th>
			                                </tr>
			                                <tr>
			                                    <td colspan="7" style="text-align:center;font-weight:bold">GRAND TOTAL (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[a],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[b],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[c],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[d],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[e],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[f]/0.98,"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[f],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[g],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[h],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[i],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[x],"0","",".")?></span></td>
			                                </tr>
			                                <!--
			                                <tr>
			                                    <td colspan="6" style="text-align:center;font-weight:bold">GRAND TOTAL - 2% (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
												
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[e]-$pot,"0","",".")?></span></td>
												
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                </tr>
			                                -->
			                                <tr>
			                                    <td colspan="7" style="text-align:center;font-weight:bold">TOTAL PENDAPATAN BENGKEL JASA & PART (RP) : </td>
			                                    <td colspan="5" align="center"><span style="padding-right:0%;font-weight:bold"><?echo number_format($konsumen,"0","",".")?></span></td>
			                                    <td colspan="5" align="center"><span style="padding-right:0%;font-weight:bold"><?echo number_format($maindealer,"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[x],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/h2/pndhariansp.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>PENDAPATAN HARIAN <i class="fa fa-angle-right"></i>PENJUALAN BARANG</small></h4>	 
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Nota Jual" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
			                        <table id="example2" class="table table-bordered table-striped" style="width:150%">
										<thead>
											<tr>
												<th width="3%"><center>NO.</center></th>
												<th width=""><center>TGL NOTA JUAL</center></th>
												<th width=""><center>NO. NOTA JUAL</center></th>
												<th width=""><center>KODE BARANG</center></th>
												<th width=""><center>BARANG</center></th>
												<th width=""><center>NO. NOTA BELI</center></th>
												<th width=""><center>TGL NOTA BELI</center></th>
												<th width=""><center>HARGA JUAL (RP)</center></th>
												<th width=""><center>QTY JUAL (PCS)</center></th>
												<th width=""><center>DISKON/PCS (RP)</center></th>
												<th width=""><center>JUMLAH JUAL (RP)</center></th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
			                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            $no=1;
										if(empty($_REQUEST[periode]))
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND tglnota=CURDATE() AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')");
											$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																					SUM(diskon) AS b,
																					SUM(total) AS c
																				FROM x23_notajual_det WHERE  id%2=0 ANDtglnota=CURDATE() AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')"));
											}
										else
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')");
											$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																					SUM(diskon) AS b,
																					SUM(total) AS c
																				FROM x23_notajual_det WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nomor FROM x23_kwitansi WHERE tanggal BETWEEN '$periode_awal' AND '$periode_akhir' AND jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')"));
			                            	}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{			
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[notabeli]'"));								
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right:20%"><?echo "$no."?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?echo $d1[kodebarang]?></td>
			                                    <td align=""><?echo "$d1[namabarang] | $d1[varian]"?></td>
			                                    <td align=""><?echo $d1[notabeli]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="19"></th>
			                                </tr>
			                                <tr>
			                                    <td colspan="8" style="text-align:center;font-weight:bold">TOTAL (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[a],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[b],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[c],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
?>
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