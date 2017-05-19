<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PENGELUARAN_UNIT_$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>RIWAYAT PENGELUARAN UNIT PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA JUAL / NAMA PELANGGAN : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. SURAT JALAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL KELUAR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA SALES</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PDI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY JUAL (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND status='1' AND cekfisik='1' AND adm='1' AND (nonota LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND status='1' AND cekfisik='1' AND adm='1' ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE  id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_pesanan_det WHERE  nopesan='$d1[nopesan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE  nopesan='$d1[nopesan]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d1[iduserpdi]'"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE  nonota='$d1[nonota]'"));
			                            	$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d4[idsales]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td><?echo $d6[nosj]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d6[tanggal]))?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d7[nama]?></td>
			                                    <td><?echo $d5[nama]?></td>
			                                    <td><?echo $d3[qty]?></td>
			                                </tr>
			                            <?
											$no++;
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