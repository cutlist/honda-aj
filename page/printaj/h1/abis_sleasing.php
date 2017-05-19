<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "AKTIVITAS_BISNIS_SURVEY_LEASING$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");

?>
	<h4>DAFTAR AKTIVITAS BISNIS SURVEY LEASING PERIODE TANGGAL NOTA PESAN <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
				                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:250%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">TGL NOTA PESAN</th>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">NO. NOTA PESAN</th>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">NO. KTP</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">VARIAN</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">WARNA</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">TOTAL TITIPAN/UANG MUKA (RP)</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">LEASING</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">JANGKA WAKTU ANGSURAN (KALI)</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">ANGSURAN (RP)</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">HASIL SURVEY</th> 
													<th rowspan="2" style="height:45px;background:#37A58A;color:#fff;">PIHAK PEMBATAL</th>
													<th colspan="4" style="height:45px;background:#37A58A;color:#fff;"><center>RIWAYAT LEASING</center></th> 
												</tr>
												<tr>
													<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL PENGAJUAN LEASING</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">LEASING</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">BARANG</th> 
													<th style="height:45px;background:#37A58A;color:#fff;">HASIL SURVEY LEASING</th
												</tr>
											</thead>
				                            <tbody>
				                            <?
											$no=1;
											$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND  tglpesan BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (jnstransaksi='KREDIT' OR  jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING')");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
			                            		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nopesan='$d1[nopesan]'"));
				                            	$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
				                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$d1[idleasing]'"));
				                            	
			                            		if(!empty($d1[batal])){
				                            		if($d1[status]=="0" || $d1[status]=="MENUNGGU KONFIRMASI"){
					                            		$statusleasing = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>Diproses</span>";
														$batal = "<center>-</center>";
					                            		}
					                            	else{
					                            		$statusleasing = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";
														$batal = $d1[batal];
														}
													}
												else if(empty($d1[batal])){
				                            		if($d1[status]=="0"){
					                            		$statusleasing = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>Diproses</span>";
					                            		}
					                            	else{
						                            	$statusleasing = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";
														}
													$batal = "<center>-</center>";
													}
				                            	
				                            	if($dI[penyerahan]=='KIRIM'){
													$dJ = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dI[user]'"));
													$penyerahan = $dJ[nama];	
													}
												else{
													$penyerahan = $dI[penyerahan];	
													}
													
					                            if(empty($dA[tglnota])){
													$tglnota 	= "-";
													$nonota	 	= "-";
													}
												else{
													$tglnota 	= date("d-m-Y",strtotime($dA[tglnota]));
													$nonota	 	= $dA[nonota];
													}
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
				                                    <td align="center"><?echo $d1[nopesan]?></td>
				                                    <td align="center"><?echo $tglnota?></td>
				                                    <td align="center"><?echo $nonota?></td>
				                                    <td><?echo $dD[nama]?></td>
				                                    <td align="center"><?echo $dD[noktp]?></td>
				                                    <td><?echo $dB[namabarang]?></td>
				                                    <td><?echo $dB[varian]?></td>
				                                    <td><?echo $dB[warna]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[utitipan],"0","",".")?></span></td>
				                                    <td><?echo $dC[namaleasing]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?if(empty($dA[termin])){echo "-";}else{echo number_format($dA[termin],"0","",".");}?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?if(empty($dA[angsuran])){echo "-";}else{echo number_format($dA[angsuran],"0","",".");}?></span></td>
				                                    <td align="center"><?echo $statusleasing?></td>
				                                    <td><?echo $batal?></td>
				                                   	<td align="center">
					                                <?
					                                	$qH = mysql_query("SELECT tanggal FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
													?>
															<?echo date("d-m-Y",strtotime($dH[tanggal]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qH = mysql_query("SELECT namaleasing FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
													?>
															<?echo $dH[namaleasing]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qH = mysql_query("SELECT unit FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
													?>
															<?echo $dH[unit]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
			                                   		<td align="center">
					                                <?
					                                	$qH = mysql_query("SELECT status,ketstatus FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
							                            	if($dH[status]=='1'){
																$statusvw = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:100px'>Disetujui</span>";
																}
															else{
																$statusvw = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:100px'>Ditolak</span>";
																}
													?>
															<?echo $statusvw?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
				                                </tr>
				                                
				                            <?
												$no++;
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