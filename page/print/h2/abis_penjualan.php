<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RINGKASAN_PENJUALAN.xls";
header("Content-Disposition: attachment; filename=$judul");
 

mysql_query("TRUNCATE temp_x23_abispenjualan");

?>
	<h4>LAPORAN RINGKASAN PENJUALAN PERIODE TANGGAL KWITANSI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:600%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="36" style="background:#37A58A;color:#fff;"><b>PENJUALAN BARANG</b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">TGL KWITANSI</th>
												<th style="background:#37A58A;color:#fff;">NO. KWITANSI</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA INDENT</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA INDENT</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS JR</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS SEBELUMNYA</th>
												<th style="background:#37A58A;color:#fff;">NO PKB</th>
												<th style="background:#37A58A;color:#fff;">NAMA SUPPLIER</th>
												<th style="background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
												<th style="background:#37A58A;color:#fff;">NO. OHC</th> 
												<th style="background:#37A58A;color:#fff;">STATUS</th>
												<th style="background:#37A58A;color:#fff;">NO. KPB</th>
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th> 
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th> 
												<th style="background:#37A58A;color:#fff;">VARIAN</th> 
												<th style="background:#37A58A;color:#fff;">NO. NOTA BELI</th> 
												<th style="background:#37A58A;color:#fff;">TGL NOTA BELI</th> 
												<th style="background:#37A58A;color:#fff;">QTY JUAL (PCS)</th> 
												<th style="background:#37A58A;color:#fff;">HARGA JUAL SEBELUM DISKON (RP)</th> 
												<th style="background:#37A58A;color:#fff;">DISKON (RP)</th> 
												<th style="background:#37A58A;color:#fff;">HARGA JUAL SETELAH DISKON (RP)</th>
												<th style="background:#37A58A;color:#fff;">JUMLAH SETELAH DISKON (RP)</th> 
												<th style="background:#37A58A;color:#fff;">STATUS KETERSEDIAAN BARANG SETELAH TRANSAKSI</th> 
												<th style="background:#37A58A;color:#fff;">STATUS PEMBAYARAN</th> 
												<th style="background:#37A58A;color:#fff;">NO. KWITANSI PELUNASAN</th> 
												<th style="background:#37A58A;color:#fff;">JUMLAH UANG MUKA (RP)</th> 
												<th style="background:#37A58A;color:#fff;">SISA JUMLAH PEMBAYARAN (RP)</th> 
												<th style="background:#37A58A;color:#fff;">NO. KWITANSI INDENT</th> 
												<th style="background:#37A58A;color:#fff;">TOTAL JUMLAH PENJUALAN (RP)</th> 
												<th style="background:#37A58A;color:#fff;">NAMA COUNTER</th> 
												<th style="background:#37A58A;color:#fff;">NAMA MEKANIK</th> 
												<th style="background:#37A58A;color:#fff;">SISA STOK (PCS)</th> 
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$no = 1;
										$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			            					if(empty($d1[hargajual]))
			            						{
			                            		$statusservice = "SERVIS MAIN DEALER (KPB)";
												}
			            					else
			            						{
				                            	$statusservice = "PENJUALAN KONSUMEN (NON KPB)";
												}
												
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]'"));
			                            	if(!empty($d2[id])){
												$tglnota1 = "";
												$tglnota2 = date("d-m-Y",strtotime($d2[tglnota]));
												$tglnota3 = "";
												$nonota1 = "";
												$nonota2 = $d2[nonota];
												$nonota3 = "";
			                            		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE nonota='$d1[nonota]'"));
												$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE nomor='$d2[nonota]'"));
												$d6 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan_vw WHERE id='$d4[idmekanik]'"));
												//$namacounter = "";
												$namamekanik = $d6[nama];
												$jumlahdp = "";
												$nokwitansiindent = "";
												$jumlahdpX = "";
												$notajual = "";
												$notaservis = "1";
												$notaindent = "0";
												}
											else{
			                            		$d2X = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice WHERE nonota='$d1[nonota]'"));
			                            		if(!empty($d2X[id])){
			                            			$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE nonota='$d2X[nonota]'"));
													$tglnota1 = "";
													$tglnota2 = date("d-m-Y",strtotime($d2X[tglnota]));
													$tglnota3 = "";
													$nonota1 = "";
													$nonota2 = $d2X[nonota];
													$nonota3 = "";
				                            		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE nonota='$d1[nonota]'"));
				                            		$statusservice = "SERVIS KONSUMEN (NON KPB)";
													$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE nomor='$d2X[nonota]'"));
													$d6 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan_vw WHERE id='$d4[idmekanik]'"));
													//$namacounter = "";
													$namamekanik = $d6[nama];
													$jumlahdp = "";
													$nokwitansiindent = "";
													$jumlahdpX = "";
													$notajual = "";
													$notaservis = "1";
													$notaindent = "0";
			                            			}
			                            		else{
													$tglnota1 = date("d-m-Y",strtotime($d1[tglnota]));
													$tglnota2 = "";
													$tglnota3 = "";
													$nonota1 = $d1[nonota];
													$nonota2 = "";
													$nonota3 = "";
			                            			$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE nonota='$d1[nonota]'"));
													$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE nomor='$d1[nonota]'"));
													//$d6 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d4[iduser]'"));
													//$namacounter = $d6[nama];
													$namamekanik = "";
													$notajual = "1";
													$notaservis = "";
													if(!empty($d5[noindent])){
						                            	$dDP = mysql_fetch_array(mysql_query("SELECT jumlah,nokwitansi FROM x23_kwitansi WHERE jnskwitansi='indent' AND nomor='$d5[noindent]'"));
														$jumlahdp = number_format($dDP[jumlah],"0","",".");
														$nokwitansiindent = $dDP[nokwitansi];
														$jumlahdpX = $dDP[jumlah];
														$dDI = mysql_fetch_array(mysql_query("SELECT tglindent,noindent FROM x23_indent WHERE noindent='$d5[noindent]'"));
														$tglnota3 = date("d-m-Y",strtotime($dDI[tglindent]));
														$nonota3 = $d5[noindent];
														$notaindent = "1";
														}
													else{
														$jumlahdp = "";
														$nokwitansiindent = "";
														$jumlahdpX = "";
														$tglnota3 = "";
														$nonota3 = "";
														$notaindent = "0";
														}
													}
												}
												
											if($d5[status]=="0"){
												$statuspembayaran = "BELUM BAYAR";
												$sisapembayaran = number_format($d5[jumlah],"0","",".");
												$jumlahpenjualan = $jumlahdp;
												$nokwitansi = "";
												$kwlunas = "0";
												$kwindent = "0";
												$kwindent2 = "0";
												}
											else{
												$statuspembayaran = "LUNAS";
												$sisapembayaran = "0";
												//$jumlahpenjualan = number_format(($d1[total]+$jumlahdpX),"0","",".");
												$jumlahpenjualan = number_format(($d1[total]),"0","",".");
												$nokwitansi = $d5[nokwitansi];
												if(!empty($d5[noindent])){
													$kwlunas = "0";
													$kwindent = "1";
													$kwindent2 = "1";
													}
												else{
													$kwlunas = "1";
													$kwindent = "0";
													$kwindent2 = "0";
													}
												}
												
											$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_masterbarang_vw WHERE id='$d1[idbarang]'"));
											$d7 = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE idbarang='$d1[idbarang]' GROUP BY idbarang"));
			                            
			                            	$d8 = mysql_fetch_array(mysql_query("SELECT * FROM x23_returjual WHERE nonotajual='$d1[nonota]'"));
											if(!empty($d8[nonotajual])){
												$tglretur = date("d-m-Y",strtotime($d8[tanggal]));
												$noretur  = $d8[noreturjual];
												$qtyretur = number_format(($d8[qtyretur]),"0","",".");
												$jmlretur = $d1[hargajualbersih]*$qtyretur;
												}
											else{
												$tglretur = "";
												$noretur = "";
												$qtyretur = "";
												$jmlretur = "";
												}
												
											$dnc = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d4[iduser]'"));
											$namacounter = $dnc[nama];
											$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[notabeli]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d5[tanggal]))?></td>
			                                    <td align="center"><?echo $d5[nokwitansi]?></td>
			                                    <!--
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($dC[bayar])){echo "-";}else{echo number_format($dC[bayar],"0","",".");}?></span></td>
			                                    -->
			                                    <td align="center"><?if(empty($tglnota1)){echo "-";}else{echo $tglnota1;}?></td>
			                                    <td align="center"><?if(empty($nonota1)){echo "-";}else{echo $nonota1;}?></td>
			                                    <td align="center"><?if(empty($tglnota3)){echo "-";}else{echo $tglnota3;}?></td>
			                                    <td align="center"><?if(empty($nonota3)){echo "-";}else{echo $nonota3;}?></td>
			                                    <td align="center"><?if(empty($tglnota2)){echo "-";}else{echo $tglnota2;}?></td>
			                                    <td align="center"><?if(empty($nonota2)){echo "-";}else{echo $nonota2;}?></td>
			                                    <td align="center"><?if(empty($d2X[noclaim])){echo "-";}else{echo $d2X[noclaim];}?></td>
			                                    <td align="center"><?if(empty($d2X[noservis])){echo "-";}else{echo $d2X[noservis];}?></td>
			                                    <td align="center"><?if(empty($d4[nopkb])){echo "-";}else{echo $d4[nopkb];}?></td>
			                                    <td align="left"><?echo $d3[nama]?></td>
			                                    <td align="left"><?echo $d4[nama]?></td>
			                                    <td align="center"><?if(empty($d4[ohc])){echo "-";}else{echo $d4[ohc];}?></td>
			                                    <td align="left"><?echo $statusservice?></td>
			                                    <td align="center"><?if(empty($d2[kpbke])){echo "-";}else{echo $d2[kpbke];}?></td>
			                                    <td align="left"><?echo $d1[kodebarang]?></td>
			                                    <td align="left"><?echo $d1[namabarang]?></td>
			                                    <td align="left"><?echo $d1[varian]?></td>
			                                    <td align="left"><?echo $d1[notabeli]?></td>
			                                    <td align="left"><?echo date("d-m-Y",strtotime($dNbl[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajualbersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="left"><?if($d7[stok]<="0"){echo "TIDAK TERSEDIA";}else{echo "TERSEDIA";}?></td>
			                                    <td align="left"><?echo $statuspembayaran?></td>
			                                    <td align="left"><?echo $nokwitansi?></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($jumlahdp)){echo "-";}else{echo $jumlahdp;}?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $sisapembayaran?></span></td>
			                                    <td align="center"><?if(empty($nokwitansiindent)){echo "-";}else{echo $nokwitansiindent;}?></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($jumlahpenjualan)){echo "-";}else{echo $jumlahpenjualan;}?></span></td>
			                                    <td align="left"><?echo $namacounter?></td>
			                                    <td align="center"><?if(empty($namamekanik)){echo "-";}else{echo $namamekanik;}?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d7[stok],"0","",".")?></span></td>
												<!--
			                                    <td align="center"><?echo $tglretur?></td>
			                                    <td align="left"><?echo $noretur?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $qtyretur?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($jmlretur,"0","",".")?></span></td>
												-->
			                                </tr>
			                                
			                            <?
												
											if($d2[jnskj]=="KPB"){
												$tjpkpbX     = $jumlahpenjualan;
												$tjpnonkpbX  = "";
												$tjpkpb2X    = "$jumlahpenjualan";
												$tjpnonkpb2X = "";
												$tjpcashjualX = "";
												}
											else{
												$tjpkpbX     = "";
												$tjpnonkpbX  = $jumlahpenjualan;
			                            		if(!empty($d2X[id])){
													$tjpkpb2X    = "";
													$tjpnonkpb2X = "$jumlahpenjualan";
												$tjpcashjualX = "";
													}
												else{
													$tjpkpb2X    = "";
													$tjpnonkpb2X = "";
													$tjpcashjualX = $jumlahpenjualan;
													}
												}
												
											$tjpnonkpb2 = preg_replace( "/[^0-9]/", "",$tjpnonkpb2X);
											$tjpkpb2  	= preg_replace( "/[^0-9]/", "",$tjpkpb2X);
											$tjpnonkpb  = preg_replace( "/[^0-9]/", "",$tjpnonkpbX);
											$tjpkpb  	= preg_replace( "/[^0-9]/", "",$tjpkpbX);
											$tjpcash  	= preg_replace( "/[^0-9]/", "",$jumlahpenjualan);
											$tjpcashjual  = preg_replace( "/[^0-9]/", "",$tjpcashjualX);
											$sisabayar  = preg_replace( "/[^0-9]/", "",$sisapembayaran);
			                            	mysql_query("INSERT INTO temp_x23_abispenjualan (
			                            												qty,
			                            												tjpcash,
			                            												tjpnonkpb2,
			                            												tjpkpb2,
			                            												tjpnonkpb,
			                            												tjpkpb,
			                            												tjpcashjual,
			                            												kwlunas,
			                            												kwindent,
			                            												kwindent2,
			                            												notaindent,
			                            												notajual,
			                            												notaservis,
			                            												sisabayar,
			                            												diskon,
			                            												dp)
			                            											VALUES (
			                            												'$d1[qty]',
			                            												'$tjpcash',
			                            												'$tjpnonkpb2',
			                            												'$tjpkpb2',
			                            												'$tjpnonkpb',
			                            												'$tjpkpb',
			                            												'$tjpcashjual',
			                            												'$kwlunas',
			                            												'$kwindent',
			                            												'$kwindent2',
			                            												'$notaindent',
			                            												'$notajual',
			                            												'$notaservis',
			                            												'$sisabayar',
			                            												'$d1[totdiskon]',
			                            												'$jumlahdpX')
			                            					");
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
		                    		<div class="clearfix"></div>
		                    		
			                        <table id="example4" class="table table-bordered table-striped table-hover" style="width:300%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="15"></td>
											</tr>
											<tr>
												<td colspan="15"  style="background:#37A58A;color:#fff;"><b>INDENT BARANG</b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">TGL KWITANSI</th>
												<th style="background:#37A58A;color:#fff;">NO. KWITANSI</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA INDENT</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA INDENT</th>
												<th style="background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
												<th style="background:#37A58A;color:#fff;">NO. OHC</th> 
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th> 
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th> 
												<th style="background:#37A58A;color:#fff;">VARIAN</th> 
												<th style="background:#37A58A;color:#fff;">QTY INDENT (PCS)</th> 
												<th style="background:#37A58A;color:#fff;">STATUS PEMBAYARAN</th> 
												<th style="background:#37A58A;color:#fff;">JUMLAH UANG MUKA (RP)</th>  
												<th style="background:#37A58A;color:#fff;">NO. KWITANSI INDENT</th> 
												<th style="background:#37A58A;color:#fff;">TOTAL JUMLAH INDENT (RP)</th> 
												<th style="background:#37A58A;color:#fff;">NAMA COUNTER</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$no2 = 1;
										$q1 = mysql_query("SELECT * FROM x23_indent_det_vw WHERE tglindent BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			            					if(strlen($no2)==1)
			            						{
												$nostart = "00".$no2;
												}
			            					else if(strlen($no2)==2)
			            						{
												$nostart = "0".$no2;
												}
			            					else if(strlen($no2)==3)
			            						{
												$nostart = $no2;
												}
												
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent_vw WHERE noindent='$d1[noindent]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE nomor='$d1[noindent]'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d2[iduser]'"));
												
											if($d3[status]=="0"){
												$statuspembayaran = "BELUM BAYAR";
												$jumlahdp = "0";
												$nokwitansi = "";
												$kwindent = "";
												}
											else{
												$statuspembayaran = "SUDAH UANG MUKA";
												$sisapembayaran = "0";
												$jumlahdp = number_format($d3[jumlah],"0","",".");
												$nokwitansi = $d3[nokwitansi];
												$kwindent = "1";
												}
												
											$d5 = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE id='$d1[idbarang]' GROUP BY idbarang"));
										?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo $d3[nokwitansi]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d3[tanggal]))?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglindent]))?></td>
			                                    <td align="center"><?echo $d1[noindent]?></td>
			                                    <td align="left"><?echo $d2[nama]?></td>
			                                    <td align="left"><?if(empty($d2[ohc])){echo "-";}else{echo $d2[ohc];}?></td>
			                                    <td align="left"><?echo $d1[kodebarang]?></td>
			                                    <td align="left"><?echo $d1[namabarang]?></td>
			                                    <td align="left"><?echo $d1[varian]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="left"><?echo $statuspembayaran?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlahdp?></span></td>
			                                    <td align="left"><?echo $nokwitansi?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlahdp?></span></td>
			                                    <td align="left"><?if(empty($d4[nama])){echo "-";}else{echo $d4[nama];}?></td>
			                                </tr>
			                                
			                            <?
											$tjpindent  = preg_replace( "/[^0-9]/", "",$jumlahdp);
			                            	mysql_query("INSERT INTO temp_x23_abispenjualan (
			                            												tjpindent,
			                            												notaindent,
			                            												kwindent,
			                            												dp)
			                            											VALUES (
			                            												'$tjpindent',
			                            												'1',
			                            												'$kwindent',
			                            												'$tjpindent')
			                            					");
											$no2++;
			                            	}
			                            ?>
											<tr>
												<td colspan="31"></td>
											</tr>
			                            </tbody>
			                        </table>
		                    		<div class="clearfix"></div>
					
			                    	</br></br>
			                    	<?
			                    	$dX1 = mysql_fetch_array(mysql_query("SELECT    SUM(qty) AS qty,
				                    												SUM(tjpcash) AS tjpcash,
				                    												SUM(tjpindent) AS tjpindent,
				                    												SUM(tjpcashjual) AS tjpcashjual,
				                    												SUM(tjpkpb) AS tjpkpb,
				                    												SUM(tjpnonkpb) AS tjpnonkpb,
				                    												SUM(tjpkpb2) AS tjpkpb2,
				                    												SUM(tjpnonkpb2) AS tjpnonkpb2,
				                    												SUM(notajual) AS notajual,
				                    												SUM(notaindent) AS notaindent,
				                    												SUM(notaservis) AS notaservis,
				                    												SUM(kwindent) AS kwindent,
				                    												SUM(kwindent2) AS kwindent2,
				                    												SUM(kwlunas) AS kwlunas,
				                    												SUM(sisabayar) AS sisabayar,
				                    												SUM(dp) AS dp,
				                    												SUM(diskon) AS diskon
				                    											FROM temp_x23_abispenjualan"));
			                    	$tjpall = $dX1[tjpcash]+$dX1[tjpindent];
			                    	$tjpA   = $dX1[tjpcashjual]+$dX1[tjpindent];
			                    	$tjpB   = $dX1[tjpkpb2]+$dX1[tjpnonkpb2];
			                    	?>
					                <table id="example6" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">SEMUA TRANSAKSI (LUNAS DAN INDENT)</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">PENJUALAN LANGSUNG MAUPUN SERVIS</span> </td>
					                		<td>UNTUK</td>
					                		<td><span style="color:#c80000;font-weight:bold">SEMUA STATUS (SERVIS KPB/SERVIS NON KPB/PENJUALAN NON KPB)</span></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($tjpall,"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">PENJUALAN LANGSUNG MAUPUN SERVIS</span> </td>
					                		<td>UNTUK</td>
					                		<td><span style="color:#c80000;font-weight:bold">SEMUA STATUS (SERVIS KPB/SERVIS NON KPB/PENJUALAN NON KPB)</span></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpcash],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">SEMUA TRANSAKSI (LUNAS DAN INDENT)</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">PENJUALAN SAJA</span></td>
					                		<td colspan="2"></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($tjpA,"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI INDENT</span></td>
					                		<td>PENJUALAN BARANG</td>
					                		<td colspan="3"></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpindent],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">PENJUALAN SAJA</span></td>
					                		<td colspan="2"></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpcashjual],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">PENJUALAN LANGSUNG MAUPUN SERVIS</span></td>
					                		<td>UNTUK</td>
					                		<td><span style="color:#c80000;font-weight:bold">KELOMPOK NON KPB</span></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpnonkpb],"0","",".")?></td>
					                	</tr>
										<!--
					                	<tr>
					                		<td align="right">GRAND TOTAL PENJUALAN UNTUK <span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span>
					                						  PENJUALAN BARANG DARI <span style="color:#e87017;font-weight:bold">PENJUALAN LANGSUNG MAUPUN SERVIS UNTUK KELOMPOK KPB</td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpkpb],"0","",".")?></td>
					                	</tr>
										-->
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span> </td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">SERVIS SAJA</span> </td>
					                		<td>UNTUK</td>
					                		<td><span style="color:#c80000;font-weight:bold">SEMUA STATUS (SERVIS KPB/SERVIS NON KPB/PENJUALAN NON KPB)</span></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($tjpB,"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">SERVIS SAJA</span></td>
					                		<td>UNTUK</td>
					                		<td><span style="color:#c80000;font-weight:bold">KELOMPOK NON KPB</span></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpnonkpb2],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="">GRAND TOTAL PENJUALAN UNTUK </td>
					                		<td><span style="color:#02911f;font-weight:bold">TRANSAKSI LUNAS</span></td>
					                		<td>PENJUALAN BARANG DARI </td>
					                		<td><span style="color:#e87017;font-weight:bold">SERVIS SAJA</span> </td>
					                		<td>UNTUK</td>
					                		<td><span style="color:#c80000;font-weight:bold">KELOMPOK KPB</span></td>
					                		<td align="center">:</td>
					                		<td>RP.</td>
					                		<td align="right"><b><?echo number_format($dX1[tjpkpb2],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL DISKON</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%">RP.</td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[diskon],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH UANG MUKA</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%">RP.</td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[dp],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH SISA PEMBAYARAN</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%">RP.</td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[sisabayar],"0","",".")?></td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL QTY YANG TERJUAL</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="10%"><b><?echo number_format($dX1[qty],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH NOTA JUAL, NOTA SERVIS, DAN NOTA INDENT</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[notajual]+$dX1[notaservis]+$dX1[notaindent],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH NOTA JUAL DAN NOTA SERVIS</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[notajual]+$dX1[notaservis],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH NOTA JUAL</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[notajual],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH NOTA SERVIS</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[notaservis],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH NOTA INDENT</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[notaindent],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH KWITANSI PELUNASAN (TANPA UANG MUKA)</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[kwlunas],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH KWITANSI INDENT</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[kwindent],"0","",".")?> PCS</td>
					                	</tr>
					                	<tr style="cursor: pointer">
					                		<td align="" colspan="1">TOTAL JUMLAH KWITANSI PELUNASAN INDENT</td>
					                		<td width="2%" align="center">:</td>
					                		<td width="1%"></td>
					                		<td align="right" width="8%"><b><?echo number_format($dX1[kwindent2],"0","",".")?> PCS</td>
					                	</tr>
					                </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>