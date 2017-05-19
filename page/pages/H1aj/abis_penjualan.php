<?
	if(!empty($_REQUEST[tahun]) && !empty($_REQUEST[bulan]))
		{
		$periode_tahun = $_REQUEST[tahun];
		$periode_bulan = $_REQUEST[bulan];
		}
	else if(empty($_REQUEST[tahun]) && empty($_REQUEST[bulan]))
		{
		$periode_tahun = date("Y");
		$periode_bulan = date('m');
		}
	
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>AKTIVITAS BISNIS <small>PENJUALAN UNIT</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:45%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" placeholder="Pilih Periode Tanggal Nota Pesan" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
													<button type="button"  onclick="window.open('printaj/h1/abis_penjualan.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                       			<?
				                       				}
				                       			?>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{      
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:600%;padding-right:20px">
										<thead>
											<tr>
												<th>TGL NOTA PESAN</th>
												<th>NO. NOTA PESAN</th>
												<th>TGL NOTA JUAL</th>
												<th>NO. NOTA JUAL</th>
												<th>NAMA PELANGGAN</th>
												<th>KODE BARANG</th> 
												<th>NAMA BARANG</th>
												<th>VARIAN</th> 
												<th>WARNA</th> 
												<th>NOSIN</th> 
												<th>NOKA</th> 
												<th>NAMA SALES/COUNTER</th> 
												<th>JENIS TRANSAKSI</th> 
												<th>JENIS CASH TEMPO</th> 
												<th>LEASING</th> 
												<th>STATUS LEASING</th> 
												<th>SISA STOK (UNIT)</th> 
												<th width="3%">OTR (RP)</th> 
												<th width="3%">OTR + PPN (RP)</th> 
												<th width="3%">TOTAL UANG MUKA (RP)</th> 
												<th width="3%">TOTAL TITIPAN (RP)</th> 
												<th width="3%">TOTAL POTONGAN (RP)</th> 
												<th>BROKER</th> 
												<th width="4%">POTONGAN TAMBAHAN (RP)</th> 
												<th width="3%">HARGA JADI (RP)</th> 
												<th width="3%">HARGA JADI + PPN (RP)</th> 
												<th width="3%">TOTAL SISA BAYAR (RP)</th> 
												<th>PEMBAYARAN + PPN (RP)</th> 
												<th>PEMBAYARAN + PPN (PEMBULATAN) (RP)</th> 
												<th>STATUS PELUNASAN</th> 
												<th>NO. PDI</th>
												<th>NAMA CHECKER</th> 
												<th>NO. SURAT JALAN</th> 
												<th>NAMA PENGIRIM</th> 
												<th>STATUS TAGIHAN KE LEASING</th> 
												<th>STATUS PEMBAYARAN LEASING</th> 
												<th>STATUS PEMBAYARAN AHM</th> 
												<th>STATUS PEMBAYARAN MD</th> 
												<th>KIRIM STNK & BPKB</th> 
												<th>NO. STNK</th> 
												<th>NO. BPKB</th> 
												<th>NAMA PENERIMA STNK</th> 
												<th>NAMA PENERIMA BPKB</th> 
												<th>KETERANGAN</th> 
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
										$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND tglpesan BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE  nopesan='$d1[nopesan]'"));
			                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE  id='$dA[idpelanggan]'"));
			                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d1[idsales]'"));
			                            	$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det WHERE  norangka='$d1[norangka]'"));
			                            	$dE = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE  id='$d1[idbarang]'"));
			                            	$dF = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE  id='$d1[idleasing]'"));
			                            	$dG = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stok_global_vw WHERE  idbarang='$d1[idbarang]'"));
			                            	$dH = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE  norangka='$d1[norangka]'"));
			                            	$dI = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE  nonota='$dA[nonota]'"));
			                            	$dK = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE  norangka='$d1[norangka]'"));
			                            	$dL = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id=(SELECT user FROM tbl_cekfisik WHERE  norangka='$d1[norangka]')"));
			                            	$dM = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE  nomor='$dA[nonota]'"));
			                            	
				                            $hargajadi = $dA[totr] - $dA[tdisc];
				                            	
											if($d1[status]=='BATAL'){
					                            $batal = "DIBATALKAN OLEH $d1[batal]";
												}
											else{
				                            	$batal = "<center>-</center>";
												}
											
		                            		if(empty($dK[stnkpengambil])){
				                            	$statusstnk = "<center>-</center>";
												}
											else{
				                            	$statusstnk = $dK[stnkpengambil];
				                            	}
				                            	
		                            		if(empty($dK[nostnk])){
				                            	$nostnk = "<center>-</center>";
												}
											else{
				                            	$nostnk = $dK[nostnk];
				                            	}
				                            	
		                            		if(empty($dK[nostnk])){
				                            	$nobpkb= "<center>-</center>";
												}
											else{
				                            	$nobpkb = $dK[nobpkb];
				                            	}
				                            	
			                            	if($d1[jnstransaksi]=='CASH' || ($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='DEALER')){
												$statusleasing   = "<center>-</center>";
												$namaleasing 	 = "<center>-</center>";
												}
											else{
												$namaleasing = $dF[namaleasing];
			                            		if(!empty($d1[batal])){
					                            	$statusleasing = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";
													}
												else if(empty($d1[batal])){
				                            		if($d1[status]=="0"){
					                            		$statusleasing = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>Diproses</span>";
					                            		}
					                            	else{
						                            	$statusleasing = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";
														}
													}
												}
																								
				                            if(empty($dA[tglnota])){
												$tglnota 	= "-";
												$nonota	 	= "-";
												$cheker 	= "<center>-</center>";
												$ref 		= "<center>-</center>";
												$nosj 		= "<center>-</center>";
												$nomesin 	= "<center>-</center>";
												$norangka 	= "<center>-</center>";
												$penyerahan	= "<center>-</center>";
												$statustagihanls	= "<center>-</center>";
												$stspmbyrnleasing	= "<center>-</center>";
												$statusscpahm	= "<center>-</center>";
												$statusscpmd	= "<center>-</center>";
												$krmstnkesmsat = "<center>-</center>";
												$nopdi = "<center>-</center>";
												$namabpkb = "<center>-</center>";
							                    $pembayaran		= "<center>-</center>";
												$pembayaranpembulatan		= "<span style='padding-right:20%'>".number_format(0,'0','','.')."</span>";
							                    $stspelunasan		= "<center>-</center>";
												}
											else{
												$tglnota 	= date("d-m-Y",strtotime($dA[tglnota]));
												$nonota	 	= $dA[nonota];
												$cheker 	= $dL[nama];
												$ref 		= $dD[ref];
												$nosj 		= $dI[nosj];
												$nomesin 	= $dH[nomesin];
												$norangka 	= $d1[norangka];
												$nopdi = $dA[nopdi];
												$namabpkb = $dF[namaleasing];
												
													
				                            	if($dI[penyerahan]=='KIRIM'){
													$dJ = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$dI[user]'"));
													$penyerahan = $dJ[nama];	
													}
												else{
													$penyerahan = $dI[penyerahan];	
													}
													
				                            	if($d1[jnstransaksi]=='CASH' || ($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='DEALER')){
													$statustagihanls ='-';
													$statusleasing   ='-';
													$stspmbyrnleasing	= "<center>-</center>";
													$statusscpahm	= "<center>-</center>";
													$statusscpmd	= "<center>-</center>";
						                            $krmstnkesmsat = "-";;
							                        if($d1[jnstransaksi]=='CASH')
					                            		{
														$dT3 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE  nomor='$dA[nonota]' AND jnskwitansi='lunas'"));
							                        	$pembayaranpembulatan		= "<span style='padding-right:20%'>".number_format($dT3[total],'0','','.')."</span>";
														
						                            	$totsisabayarX    = $hargajadi - $dA[utitipan] + $dA[ppn];
					                            		if(empty($dM[id])){
							                            	$pembayaran		= "<center>-</center>";
							                            	$totsisabayar 	= $totsisabayarX;
							                            	$stspelunasan	= "-";
															}
														else{
							                            	$pembayaran 	= "<span style='padding-right:20%'>".number_format($totsisabayarX,'0','','.')."</span>";
							                            	$totsisabayar 	= "0";
							                            	$stspelunasan	= "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Lunas</span>";
							                            	}
														}
					                            	if($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='DEALER')
					                            		{
														$dT6 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_history_bcashtempo WHERE  nomor='$dA[nonota]'"));
					                            		$pembayaranpembulatan		= "<span style='padding-right:20%'>".number_format($dT6[total],'0','','.')."</span>";
													
						                            	$dN = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_history_bcashtempo WHERE  nonota='$dA[nonota]'"));
						                            	
						                            	$totsisabayarX    = $hargajadi - $dA[utitipan] + $dA[ppn] - $dN[total];
							                            $pembayaran 	= "<span style='padding-right:20%'>".number_format($dN[total],'0','','.')."</span>";
						                            	$totsisabayar 	= $totsisabayarX;
						                            	if($totsisabayarX == "0"){$stspelunasan	= "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Lunas</span>";}
						                            	else{$stspelunasan	= "-";}
														}
													}
												else{
				                            		if($dD[statustagihanls]=="0"){
						                            	$statustagihanls = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Belum Dikirim</span>";
														}
													else if($dD[statustagihanls]=="1"){
						                            	$statustagihanls = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terkirim</span>";
						                            	}
						                            	
				                            		if($dD[statusotr]=="1" && $dD[statusgross]=="1" && $dD[statussubsidi]=="1" && $dD[statusmatrix]=="1"){
						                            	$stspmbyrnleasing = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terbayar Penuh</span>";
														}
													else if($dD[statusotr]=="0" && $dD[statusgross]=="0" && $dD[statussubsidi]=="0" && $dD[statusmatrix]=="0"){
														$stspmbyrnleasing	= "<center>-</center>";
						                            	}
						                            else{
						                            	$stspmbyrnleasing = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>Terbayar Sebagian</span>";
														}
						                            	
				                            		if($dD[statusscpahm]=="1"){
						                            	$statusscpahm = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terbayar</span>";
														}
													else{
														$statusscpahm = "<center>-</center>";
						                            	}
						                            	
				                            		if($dD[statusscpmd]=="1"){
						                            	$statusscpmd = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terbayar</span>";
														}
													else{
														$statusscpmd = "<center>-</center>";
						                            	}
						                            	
				                            		if($dK[krmstnkesmsat]=='0000-00-00' || $dK[krmstnkesmsat]=='1970-01-01'){
						                            	$krmstnkesmsat = "-";
														}
													else{
						                            	$krmstnkesmsat = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terkirim</span>";
						                            	}
						                            	
						                            $totsisabayarX = $dA[totr] - $dA[utitipan] + $dA[ppn];
													}
												}
			                            	
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
			                                    <td align="center"><?echo $d1[nopesan]?></td>
			                                    <td align="center"><?echo $tglnota?></td>
			                                    <td align="center"><?echo $nonota?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $dE[kodebarang]?></td>
			                                    <td><?echo $dE[namabarang]?></td>
			                                    <td><?echo $dE[varian]?></td>
			                                    <td><?echo $dE[warna]?></td>
			                                    <td><?echo $nomesin?></td>
			                                    <td><?echo $norangka?></td>
			                                    <td><?echo $dC[nama]?></td>
			                                    <td><?echo $d1[jnstransaksi]?></td>
			                                    <?
			                                    if($d1[jnscashtempo]=='DEALER'){$jnscashtempo = "DEALER";}
			                                    else{$jnscashtempo = $d1[jnscashtempo];}
			                                    ?>
			                                    <td><?if(empty($jnscashtempo)){echo "-";}else{echo $jnscashtempo;}?></td>
			                                    <td><?echo $namaleasing?></td>
			                                    <td align="center"><?echo $statusleasing?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dG[stok],"0","",".")?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dD[otr],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dD[otr]+$dA[ppn],"0","",".")?></span></td>
			                                    <?
			                                    if($d1[jnstransaksi]=='CASH' || ($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='DEALER'))
			                                    	{
												?>
			                                    	<td align="center">-</td>
			                                    	<td align="right"><span style="padding-right:20%"><?echo number_format($dA[utitipan],"0","",".")?></span></td>
												<?
													}
												else
													{
												?>
			                                    	<td align="right"><span style="padding-right:20%"><?echo number_format($dA[utitipan],"0","",".")?></span></td>
			                                    	<td align="center">-</td>
												<?
													}
			                                    ?>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dA[tdisc],"0","",".")?></span></td>
			                                    <td><?if(empty($ref)){echo "-";}else{echo $ref;}?></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($dD[komisi])){echo "-";}else{echo number_format($dD[komisi],"0","",".");}?></span></td>
			                                    <?
			                                    if($d1[jnstransaksi]=='CASH' || ($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='DEALER'))
			                                    	{
												?>
			                                   	 <td align="right"><span style="padding-right:20%"><?echo number_format($hargajadi,"0","",".")?></span></td>
			                                   	 <td align="right"><span style="padding-right:20%"><?echo number_format($hargajadi+$dA[ppn],"0","",".")?></span></td>
												<?
													}
												else
													{
												?>
			                                    	<td align="center">-</td>
			                                    	<td align="center">-</td>
												<?
													}
			                                    ?>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($totsisabayar,"0","",".")?></span></td>
			                                    <td align="right"><?echo $pembayaran?></td>
			                                    <td align="right"><?echo $pembayaranpembulatan?></td>
			                                    <td align="center"><?echo $stspelunasan?></td>
			                                    <td align="center"><?echo $nopdi?></td>
			                                    <td><?if(empty($cheker)){echo "-";}else{echo $cheker;}?></td>
			                                    <td><?if(empty($$nosj)){echo "-";}else{echo $nosj;}?></td>
			                                    <td><?if(empty($penyerahan)){echo "-";}else{echo $penyerahan;}?></td>
			                                    <td align="center"><?echo $statustagihanls?></td>
			                                    <td align="center"><?echo $stspmbyrnleasing?></td>
			                                    <td align="center"><?echo $statusscpahm?></td>
			                                    <td align="center"><?echo $statusscpmd?></td>
			                                    <td align="center"><?echo $krmstnkesmsat?></td>
			                                    <td align="center"><?echo $nostnk?></td>
			                                    <td align="center"><?echo $nobpkb?></td>
			                                    <td><?echo $statusstnk?></td>
			                                    <td><?if(empty($$namabpkb)){echo "-";}else{echo $namabpkb;}?></td>
			                                    <td><?echo $batal?></td>
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
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