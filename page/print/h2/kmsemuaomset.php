<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KINERJA_SEMUA(RP)_MEKANIK.xls";
header("Content-Disposition: attachment; filename=$judul");
 
										$dC1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
										$widthtable  = $dC1[total]*25 ."%";
										$widthtable2 = 82/$dC1[total] ."%";
										$widthtable3 = 82/$dC1[total]/2 ."%";
										$colspan = $dC1[total]*2;
?>
	<h4>KINERJA MEKANIK SEMUA (RP) H2H3 PERIODE TANGGAL SELESAI SERVIS <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?><br></h4>
   
   <table>
										<thead>
											<tr>
												<th rowspan="3" style="background:#37A58A;color:#fff;"><b><center>TANGGAL SERVIS</center></b></th>
												<th colspan="<?echo $colspan;?>" style="background:#37A58A;color:#fff;"><b><center>NAMA MEKANIK</center></b></th>
											</tr>
											<tr>
												<?
												$qM = mysql_query("SELECT nama FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
												?>
													<th style="background:#37A58A;color:#fff;" colspan="2"><b><center><?echo $dM[nama]?></center></b></th>
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
													<th style="background:#37A58A;color:#fff;"><b><center>KPB (RP)</center></b></th>
													<th style="background:#37A58A;color:#fff;"><b><center>CASH (RP)</center></b></th>
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
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<td align="center" rowspan="2"><b>TOTAL (RP) (KPB - 2%)</b></td>
												<?
												$qM = mysql_query("SELECT id FROM x23_karyawan WHERE posisi='4' AND id IN (SELECT idmekanik FROM x23_notaservice WHERE tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')");
												while($dM = mysql_fetch_array($qM))
													{
													$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
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
													$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
													$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
												?>
													<td align="center" colspan="2"><b><span style="margin-right:0%"><?echo number_format(round($dNS1[total]-($dNS1[total]*2/100),0)+$dNS2[total],"0","",".")?></span></td>
												<?
													}
												?>
											</tr>
			                            </tfoot>
    </table>