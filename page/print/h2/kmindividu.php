<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KINERJA_MEKANIK_INDIVIDU.xls";
header("Content-Disposition: attachment; filename=$judul");
 
$dnk = mysql_fetch_array(mysql_query("SELECT id,nama FROM x23_karyawan WHERE id='$_REQUEST[idmekanik]'"));
?>
	<h4>KINERJA MEKANIK INDIVIDU H2H3 PERIODE TANGGAL SELESAI SERVIS <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></br>
	NAMA MEKANIK : <?echo $dnk[nama]?></h4>
    <table>
        <thead>
			<tr>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. PKB</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA SERVIS JR</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. POLISI</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. KPB</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA JASA</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA SPARE PART</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JAM MASUK BENGKEL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JAM MULAI SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TGL SELESAI SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JAM SELESAI SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">DURASI SERVIS</th>
			</tr>
        </thead>
		<tbody>
<?
								mysql_query("TRUNCATE temp_x23_kmindividu_wktsvc");
								
								$dA1 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
								$dA2 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice_det1_vw WHERE kpbke!='' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
								$dA4 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE jns='SERVIS JR' AND idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
								
								$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'");
	                            while($d1 = mysql_fetch_array($q1))
	                            	{
									$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]'"));
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
										
									if($jumlah_menit < "0"){
										$durasi = "-";
										}
									else{
										$durasi = "$hari $jam $jumlah_menit Menit";
										}
										
										mysql_query("INSERT INTO temp_x23_kmindividu_wktsvc VALUES ('','$selisih_waktu')");
										
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE noantrian='$d1[noantrian]' AND tanggal='$d1[tglnota]'"));
?>
			                                <tr style="cursor:pointer">
			                                    <td><span style="padding-right:20%"><?echo $d1[nopkb]?></span></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[noclaim]?></td>
			                                    <td align=""><?echo $d1[nopol]?></td>
			                                    <td align="center"><?echo $d2[kpbke]?></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
						                        ?>
						                                <?echo $dB[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                                
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                <?echo $dB[namajasa]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
														}
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
						                                    <?echo $dA[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="center"><?echo "$d3[jam]"?></td>
			                                    <td align="center"><?echo "$d1[jammulai]"?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglselesai]))?></td>
			                                    <td align="center"><?echo "$d1[jamselesai]"?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $durasi?></span></td>
			                                </tr>
<?
		}
?>
        </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th></th>
			                                </tr>
			                            </tfoot>
    </table>
			                        
			                        <?
			                        $dA3 = mysql_fetch_array(mysql_query("SELECT SUM(wktsvc) AS total FROM temp_x23_kmindividu_wktsvc"));
			                        $selisih_waktu = $dA3[total];
									$jumlah_hari = floor($selisih_waktu/86400);
									if($jumlah_hari=="0"){
										$hari = "";
										}
									if($jumlah_hari!="0"){
										$hari = "$jumlah_hari HARI";
										}

									//Untuk menghitung jumlah dalam satuan jam:
									$sisa = $selisih_waktu % 86400;
									$jumlah_jam = floor($sisa/3600);
									if($jumlah_jam=="0"){
										$jam = "";
										}
									if($jumlah_jam!="0"){
										$jam = "$jumlah_jam JAM";
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
										
									if($jumlah_menit < "0"){
										$durasi = "-";
										}
									else{
										$durasi = "$hari $jam $jumlah_menit MENIT";
										}
									?>
			                        <table style="font-weight:bold">
			                        	<tr>
			                        		<td>JUMLAH UNIT DISERVIS</td>
			                        		<td width="35px" align="center">:</td>
			                        		<td align="right"><?echo $dA1[total]?> UNIT</td>
			                        	</tr>
			                        	<tr>
			                        		<td>JUMLAH KPB</td>
			                        		<td align="center">:</td>
			                        		<td align="right"><?echo $dA2[total]?> UNIT</td>
			                        	</tr>
			                        	<tr>
			                        		<td>JUMLAH SERVIS JR</td>
			                        		<td align="center">:</td>
			                        		<td align="right"><?echo $dA4[total]?> UNIT</td>
			                        	</tr>
			                        	<tr>
			                        		<td>TOTAL WAKTU SERVIS</td>
			                        		<td align="center">:</td>
			                        		<td align="right"><?echo $durasi?></td>
			                        	</tr>
			                        </table>