<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KINERJA_SALES_$_REQUEST[periode_tahun]_$_REQUEST[periode_bulan].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KINERJA SALES <?echo "BULAN $_REQUEST[periode_bulan] TAHUN $_REQUEST[periode_tahun]"?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">PENJUALAN CASH (UNIT)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">PENJUALAN KREDIT (UNIT)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL PENJUALAN (UNIT)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KOMISI CASH (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KOMISI KREDIT (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL KOMISI (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
											<?
											$qA = mysql_query("SELECT id,nama FROM tbl_user_vw WHERE id_posisi IN ('2','7','6','9') ORDER BY nama");
											while($dA = mysql_fetch_array($qA))
												{
												$h1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='MANDIRI'))"));
												$h2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
												if(!empty($h1[total])){
													$pc = number_format($h1[total],"0","",".");
													}
												else{
													$pc = "-";
													}
												if(!empty($h2[total])){
													$pk = number_format($h2[total],"0","",".");
													}
												else{
													$pk = "-";
													}
												$hp = $h1[total]+$h2[total];
												if($hp!='0'){
													$tp = number_format($hp,"0","",".");
													}
												else{
													$tp = "-";
													}
													
						                        $dB = mysql_fetch_array(mysql_query("SELECT id_karyawan FROM tbl_user_vw WHERE id='$dA[id]'"));
					                    		$dB1=mysql_fetch_array(mysql_query("SELECT cash FROM tbl_insentif_karyawan WHERE id_karyawan='$dB[id_karyawan]' AND target <= '$h1[total]' ORDER BY target DESC LIMIT 1"));
					                    		$ict1 = $dB1[cash]*$h1[total];
					                    		
					                    		$dB2=mysql_fetch_array(mysql_query("SELECT kredit FROM tbl_insentif_karyawan WHERE id_karyawan='$dB[id_karyawan]' AND target <= '$h2[total]' ORDER BY target DESC LIMIT 1"));
					                    		$ict2 = $dB2[kredit]*$h2[total];
					                    		
					                    		$ict = $ict1+$ict2;
												
											?>
													<tr>
														<td align="left"><span style="margin-left:5%"><?echo $dA[nama]?></span></td>
														<td align="right"><span style="margin-right:40%"><?echo $pc?></span></td>
														<td align="right"><span style="margin-right:40%"><?echo $pk?></span></td>
														<td align="right"><span style="margin-right:40%"><?echo $tp?></span></td>
														<td align="right"><span style="margin-right:20%"><?echo number_format($ict1,"0","",".")?></span></td>
														<td align="right"><span style="margin-right:20%"><?echo number_format($ict2,"0","",".")?></span></td>
														<td align="right"><span style="margin-right:20%"><?echo number_format($ict,"0","",".")?></span></td>
													</tr>
											<?
												}
											?>
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