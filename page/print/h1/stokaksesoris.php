<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "STOK_AKSESORIS$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR STOK AKSESORIS PER TANGGAL <?echo date("d-m-Y")?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ACCU (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAS KAKI (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">2 ANAK KUNCI (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">HELM (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">SPION (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOOLKIT (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JAKET (PCS)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">BUKU SERVIS (PCS)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            	$d1 = mysql_fetch_array(mysql_query("SELECT SUM(accu) AS stok,SUM(jual) AS jual FROM stok_accu"));
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT SUM(alaskaki) AS stok,SUM(jual) AS jual FROM stok_alaskaki"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT SUM(anakkunci) AS stok,SUM(jual) AS jual FROM stok_anakkunci"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT SUM(helm) AS stok,SUM(jual) AS jual FROM stok_helm"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT SUM(spion) AS stok,SUM(jual) AS jual FROM stok_spion"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT SUM(toolkit) AS stok,SUM(jual) AS jual FROM stok_toolkit"));
			                            	$d7 = mysql_fetch_array(mysql_query("SELECT SUM(jaket) AS stok,SUM(jual) AS jual FROM stok_jaket"));
			                            	$d8 = mysql_fetch_array(mysql_query("SELECT SUM(bukuservis) AS stok,SUM(jual) AS jual FROM stok_bukuservis"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d1[stok]-$d1[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d2[stok]-$d2[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d3[stok]-$d3[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d4[stok]-$d4[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d5[stok]-$d5[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d6[stok]-$d6[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d7[stok]-$d7[jual]?></span></td>
			                                    <td align="right"><span style="padding-right: 25%"><?echo $d8[stok]-$d8[jual]?></span></td>
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