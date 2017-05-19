<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "LAPORAN_WORKSHOP_LAINNYA.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>LAPORAN PENJUALAN WORKSHOP LAINNYA PERIODE TANGGAL NOTA JUAL <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
    <table>
        <thead>
			<tr>
				<th rowspan="2" style="background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
				<th rowspan="2" style="background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
				<th rowspan="2" style="background:#37A58A;color:#fff;">JUMLAH JUAL (RP)</th>
				<th colspan="2" style="background:#37A58A;color:#fff;">PEMBAYARAN (RP)</th>
				<th colspan="2" style="background:#37A58A;color:#fff;">PEMAKAIAN SPARE PART (RP)</th>
			</tr>
			<tr>
				<th style="background:#37A58A;color:#fff;">CASH</th>
				<th style="background:#37A58A;color:#fff;">UANG MUKA</th>
				<th style="background:#37A58A;color:#fff;">S. PART</th>
				<th style="background:#37A58A;color:#fff;">OLI</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
			                            <tbody>
			                <?
											
										$dA = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1b WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'"));
										$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1b WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND jns='SPARE PART'"));
										$dC = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1b WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND jns='OLI'"));
										
										$q1 = mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1b WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY nonota");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											/*
											if(!empty($d1[total])){
												$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND nomor='$d1[nonota]'"));
												if($d2[status]=="0"){
													$cash = "0";
													}
												if($d2[status]=="1"){
													$cash = number_format($d2[pembulatan],"0","",".");
													}
												}
											else{
												$cash = "0";
												}
											*/
												
											$d3 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_notajual_det_ws1b WHERE id%2=0 AND nonota='$d1[nonota]' AND jns='SPARE PART'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_notajual_det_ws1b WHERE id%2=0 AND nonota='$d1[nonota]' AND jns='OLI'"));
											
			                ?>
			                                <tr style="cursor:pointer">
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%">0</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d4[total],"0","",".")?></span></td>
			                                </tr>
			                <?
			                				}
			                ?>
			                            </tbody>
			                            <tfoot>
			                                <tr style="cursor:pointer">
			                                    <td colspan="2" align="right"><span style="padding-right:20%"><b>TOTAL</span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><b>0</span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dB[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dC[total],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>