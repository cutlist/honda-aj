<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "BENSIN$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KELUAR MASUK BENSIN PERIODE <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
			                        <table width="100%">
										<thead>
											<tr>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">MASUK (LITER)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KELUAR (LITER)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            
										$q1 = mysql_query("SELECT * FROM tbl_bensin WHERE id%2=0 AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0' ORDER BY id DESC");
										$dI = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT' AND status='0'"));
										$dO = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT' AND status='0'"));
										$dIx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0'"));
										$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0'"));
										$dT = $dI[total]-$dO[total];
										
										$cek1 = strpos($dIx[total],".");
										if($cek1){
										  $dItotal = $dIx[total];
											}
										else{
										  $dItotal = $dIx[total]+0 .".0";
											}
											
										$cek2 = strpos($dOx[total],".");
										if($cek2){
										  $dOtotal = $dOx[total];
											}
										else{
										  $dOtotal = $dOx[total]+0 .".0";
											}
											
										$cek3 = strpos($dT,".");
										if($cek3){
										  $dTX = $dT;
											}
										else{
										  $dTX = "$dT.0";
											}
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$cek4 = strpos($d1[jumlah],".");
											if($cek4){
											  $jumlah = $d1[jumlah];
												}
											else{
											  $jumlah = "$d1[jumlah].0";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
			                                    <td><?echo $d1['keterangan']?></td>
		                                    <?
		                                    if($d1['jenis']=='INPUT')
		                                    	{
											?>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlah?></span></td>
			                                    <td align="center">-</td>
											<?	
												}
											else
												{
											?>
			                                    <td align="center">-</td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlah?></span></td>
											<?
												}
		                                    ?>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="5"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">TOTAL (LITER) : </th>
			                                    <th style="text-align:center;font-size:15px"><?echo ROUND($dItotal,1)?></th>
			                                    <th style="text-align:center;font-size:15px"><?echo ROUND($dOtotal,1)?></th>
			                                    <th rowspan="2"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">STOK AKHIR (LITER) : </th>
			                                    <th colspan="2" style="text-align:center;font-size:15px"><?echo ROUND($dTX,1)?></th>
			                                </tr>
			                            </tfoot>
			                        </table>