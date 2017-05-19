<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "EFEKTIVITAS_SALES_$_REQUEST[periode_tahun]_$_REQUEST[periode_bulan].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR EFEKTIVITAS SALES <?echo "BULAN $_REQUEST[periode_bulan] TAHUN $_REQUEST[periode_tahun]"?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH PROSEPEK (ORANG)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH TINDAK LANJUT (TINDAKAN)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH PENJUALAN (TRANSAKSI)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
											<?
											mysql_query("TRUNCATE temp_ksefektivitas ");
											if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
												{
												$qA = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id_posisi IN ('2','7') ORDER BY nama");
												}
											else
												{
												$qA = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id_posisi IN ('2','7') ORDER BY nama");
												}
											while($dA = mysql_fetch_array($qA))
												{
												$h1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_prospek WHERE bulan='$_REQUEST[periode_bulan]' AND tahun='$_REQUEST[periode_tahun]' AND idsales='$dA[id]'"));
												if(!empty($h1[total])){
													$jps = number_format($h1[total],"0","",".");
													}
												else{
													$jps = "-";
													}
													
												$h2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_pesanan_vw WHERE bulan='$_REQUEST[periode_bulan]' AND tahun='$_REQUEST[periode_tahun]' AND idsales='$dA[id]' AND id%2=0 AND idpelanggan IN (SELECT idpelanggan FROM tbl_prospek WHERE bulan='$_REQUEST[periode_bulan]' AND tahun='$_REQUEST[periode_tahun]' AND idsales='$dA[id]')"));
												if(!empty($h2[total])){
													$jtl = number_format($h2[total],"0","",".");
													}
												else{
													$jtl = "-";
													}
													
												$h3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notajual_det_vw WHERE bulan='$_REQUEST[periode_bulan]' AND tahun='$_REQUEST[periode_tahun]' AND idsales='$dA[id]' AND id%2=0 AND tglsampai!='0000-00-00' AND idpelanggan IN (SELECT idpelanggan FROM tbl_prospek WHERE bulan='$_REQUEST[periode_bulan]' AND tahun='$_REQUEST[periode_tahun]' AND idsales='$dA[id]')"));
												if(!empty($h3[total])){
													$jpl = number_format($h3[total],"0","",".");
													}
												else{
													$jpl = "-";
													}
												
												mysql_query("INSERT INTO temp_ksefektivitas VALUES ('$jps','$jtl','$jpl')");
											?>
												<tr>
													<td align="left"><span style="margin-left:5%"><?echo $dA[nama]?></span></td>
													<td align="right"><span style="margin-right:40%"><?echo $jps?></span></td>
													<td align="right"><span style="margin-right:40%"><?echo $jtl?></span></td>
													<td align="right"><span style="margin-right:40%"><?echo $jpl?></span></td>
												</tr>
											<?
												}
												
												$dTh = mysql_fetch_array(mysql_query("SELECT SUM(jps) AS tjps, SUM(jtl) AS tjtl, SUM(jpl) AS tjpl FROM temp_ksefektivitas"));
											?>
												<tr>
													<td colspan="4"></td>
												</tr>
												<tr>
													<td align="left"><span style="margin-left:5%"><b>TOTAL</b></span></td>
													<td align="right"><span style="margin-right:40%"><b><?echo $dTh[tjps]?></b></span></td>
													<td align="right"><span style="margin-right:40%"><b><?echo $dTh[tjtl]?></b></span></td>
													<td align="right"><span style="margin-right:40%"><b><?echo $dTh[tjpl]?></b></span></td>
												</tr>
											</tbody>
		<tfoot>
            <tr>
                <th>&nbsp;</th>
            </tr>
			<!--
			<tr>
				<td colspan="2"><b><span style="margin-left:10%">TOTAL</b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gtp[grandtotal])?></b></span></td>
				<td align="right"><b><span style="margin-right:30%"><?echo number_format($gto[grandtotal])?></b></span></td>
			</tr>
			-->
		</tfoot>
	</table>