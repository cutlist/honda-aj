<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$periode_tahun = $_REQUEST[tahun];
$periode_bulan = $_REQUEST[bulan];

$tgl = date("Ymd");
$judul = "STNKBPKB$periode_tahun$periode_bulan.xls";
header("Content-Disposition: attachment; filename=$judul");
 
?>
	<h4>DAFTAR STNK & BPKB BULAN <?echo $periode_bulan?> TAHUN <?echo $periode_tahun?></h4>
	
				                        <table id="example1" class="table table-striped table-bordered" style="min-width:520%">
				                            <thead style="cursor:pointer">
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KELURAHAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KECAMATAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KABUPATEN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. RANGKA</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. MESIN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL STCK SELESAI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL STCK DIAMBIL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PENGAMBIL STCK</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL KIRIM STNK KE SAMSAT</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL NOTICE PAJAK SELESAI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NOMOR POLISI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NOMOR STNK</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL STNK SELESAI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL NOTICE PAJAK & STNK DIAMBIL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PENGAMBIL NOTICE & STNK</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NOMOR BPKB</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL BPKB SELESAI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL BPKB DIAMBIL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA PENGAMBIL BPKB</th>
											</thead>
											<tbody style="cursor:pointer">
											<?
											$qX = mysql_query("SELECT * FROM tbl_stnkbpkb WHERE id%2=0 AND nonota IN (SELECT nonota FROM tbl_notajual WHERE id%2=0 AND adm='1' AND bulan='$periode_bulan' AND tahun='$periode_tahun')");
											while($dX = mysql_fetch_array($qX))
												{
													$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$dX[nonota]'"));
													$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
													$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dX[idbarang]'"));
													$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stnkbpkb WHERE id%2=0 AND norangka='$dX[norangka]'"));
													$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dX[norangka]'"));
													if($d3[stckselesai]=='0000-00-00' || $d3[stckselesai]=='1970-01-01'){
														$stckselesai = '<span style="text-align:center">-</span>';
														}
													else{
														$stckselesai = date("d-m-Y",strtotime($d3[stckselesai]));
														}
													if($d3[stckdiambil]=='0000-00-00' || $d3[stckdiambil]=='1970-01-01'){
														$stckdiambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stckdiambil = date("d-m-Y",strtotime($d3[stckdiambil]));
														}
													if(empty($d3[stckpengambil])){
														$stckpengambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stckpengambil = $d3[stckpengambil];
														}
													if($d3[krmstnkesmsat]=='0000-00-00' || $d3[krmstnkesmsat]=='1970-01-01'){
														$krmstnkesmsat = '<div style="text-align:center">-</div>';
														}
													else{
														$krmstnkesmsat = date("d-m-Y",strtotime($d3[krmstnkesmsat]));
														}
													if($d3[noticeselesai]=='0000-00-00' || $d3[noticeselesai]=='1970-01-01'){
														$noticeselesai = '<div style="text-align:center">-</div>';
														}
													else{
														$noticeselesai = date("d-m-Y",strtotime($d3[noticeselesai]));
														}
													if(empty($d3[nopol])){
														$nopol = '<div style="text-align:center">-</div>';
														}
													else{
														$nopol = $d3[nopol];
														}
													if(empty($d3[nostnk])){
														$nostnk = '<div style="text-align:center">-</div>';
														}
													else{
														$nostnk = $d3[nostnk];
														}
													if($d3[stnkselesai]=='0000-00-00' || $d3[stnkselesai]=='1970-01-01'){
														$stnkselesai = '<div style="text-align:center">-</div>';
														}
													else{
														$stnkselesai = date("d-m-Y",strtotime($d3[stnkselesai]));
														}
													if($d3[stnkdiambil]=='0000-00-00' || $d3[stnkdiambil]=='1970-01-01'){
														$stnkdiambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stnkdiambil = date("d-m-Y",strtotime($d3[stnkdiambil]));
														}
													if(empty($d3[stnkpengambil])){
														$stnkpengambil = '<div style="text-align:center">-</div>';
														}
													else{
														$stnkpengambil = $d3[stnkpengambil];
														}
													if(empty($d3[nobpkb])){
														$nobpkb = '<div style="text-align:center">-</div>';
														}
													else{
														$nobpkb = $d3[nobpkb];
														}
													if($d3[bpkbselesai]=='0000-00-00' || $d3[bpkbselesai]=='1970-01-01'){
														$bpkbselesai = '<div style="text-align:center">-</div>';
														}
													else{
														$bpkbselesai = date("d-m-Y",strtotime($d3[bpkbselesai]));
														}
													if($d3[bpkbdiambil]=='0000-00-00' || $d3[bpkbdiambil]=='1970-01-01'){
														$bpkbdiambil = '<div style="text-align:center">-</div>';
														}
													else{
														$bpkbdiambil = date("d-m-Y",strtotime($d3[bpkbdiambil]));
														}
														
													if($dA[jnstransaksi]=='KREDIT' OR ($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='LEASING'))
														{
														$dL = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
														$bpkbpengambil = $dL[namaleasing];
														}
													else
														{
														if(empty($d3[bpkbpengambil])){
															$bpkbpengambil = '<div style="text-align:center">-</div>';
															}
														else{
															$bpkbpengambil = $d3[bpkbpengambil];
															}
														}
											?>
													<tr>
														<td align="center"><?echo $dA[nonota]?></td>
														<td align="center"><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
														<td align="left"><?echo $d1[nama]?></td>
			                                    		<td align="left"><?echo $d1[alamat]?></td>
			                                    		<td align="left"><?echo $d1[namakel]?></td>
			                                    		<td align="left"><?echo $d1[namakec]?></td>
			                                    		<td align="left"><?echo $d1[namakab]?></td>
			                                    		<td align="right"><?echo "'".$d1[notelepon]?></td>
			                                    		<td align="right"><?echo $d4[norangka]?></td>
			                                    		<td align="right"><?echo $d4[nomesin]?></td>
			                                    		<td align="left"><?echo $d2[kodebarang]?></td>
			                                    		<td align="left"><?echo $d2[namabarang]?></td>
			                                    		<td align="left"><?echo $d2[varian]?></td>
			                                    		<td align="left"><?echo $d2[warna]?></td>
			                                    		<td align="center"><?echo $stckselesai?></td>
			                                    		<td align="center"><?echo $stckdiambil?></td>
			                                    		<td align="left"><?echo $stckpengambil?></td>
			                                    		<td align="center"><?echo $krmstnkesmsat?></td>
			                                    		<td align="center"><?echo $noticeselesai?></td>
			                                    		<td align="center"><?echo $nopol?></td>
			                                    		<td align="center"><?echo $nostnk?></td>
			                                    		<td align="center"><?echo $stnkselesai?></td>
			                                    		<td align="center"><?echo $stnkdiambil?></td>
			                                    		<td align="left"><?echo $stnkpengambil?></td>
			                                    		<td align="center"><?echo $nobpkb?></td>
			                                    		<td align="center"><?echo $bpkbselesai?></td>
			                                    		<td align="center"><?echo $bpkbdiambil?></td>
			                                    		<td align="left"><?echo $bpkbpengambil?></td>
													</tr>
											<?
												}
											?>
											</tbody>
										</table>