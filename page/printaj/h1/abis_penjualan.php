<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "AKTIVITAS_BISNIS_PENJUALAN$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");

?>
	<h4>DAFTAR AKTIVITAS BISNIS PENJUALAN UNIT PERIODE TANGGAL NOTA PESAN <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:600%;padding-right:20px">
										<thead>
											<tr>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA PESAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA PESAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">WARNA</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NO. MESIN</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NO. RANGKA</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA SALES/COUNTER</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">JENIS TRANSAKSI</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">JENIS CASH TEMPO</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">LEASING</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS LEASING</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">SISA STOK (UNIT)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">OTR (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">OTR + PPN (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL UANG MUKA (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL TITIPAN (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL POTONGAN (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">BROKER</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">POTONGAN TAMBAHAN (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">HARGA JADI (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">HARGA JADI + PPN (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL SISA BAYAR (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">PEMBAYARAN + PPN (RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">PEMBAYARAN + PPN (PEMBULATAN)(RP)</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS PELUNASAN</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NO. PDI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA CHECKER</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NO. SURAT JALAN</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PENGIRIM</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS TAGIHAN KE LEASING</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN LEASING</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN AHM</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN MD</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">KIRIM STNK & BPKB</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NO. STNK</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NO. BPKB</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PENERIMA STNK</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PENERIMA BPKB</th> 
												<th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th> 
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND tglpesan BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nopesan='$d1[nopesan]'"));
			                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
			                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d1[idsales]'"));
			                            	$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det WHERE norangka='$d1[norangka]'"));
			                            	$dE = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
			                            	$dF = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			                            	$dG = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stok_global_vw WHERE idbarang='$d1[idbarang]'"));
			                            	$dH = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$d1[norangka]'"));
			                            	$dI = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$dA[nonota]'"));
			                            	$dK = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE norangka='$d1[norangka]'"));
			                            	$dL = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id=(SELECT user FROM tbl_cekfisik WHERE norangka='$d1[norangka]')"));
			                            	$dM = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE nomor='$dA[nonota]'"));
			                            	
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
													$dJ = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dI[user]'"));
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
														$dT3 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kwitansi WHERE nomor='$dA[nonota]' AND jnskwitansi='lunas'"));
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
														$dT6 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_history_bcashtempo WHERE nomor='$dA[nonota]'"));
					                            		$pembayaranpembulatan		= "<span style='padding-right:20%'>".number_format($dT6[total],'0','','.')."</span>";
													
						                            	$dN = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_history_bcashtempo WHERE nonota='$dA[nonota]'"));
						                            	
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
			                            <tfoot>
			                                <tr>
			                                    <th colspan="29">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>