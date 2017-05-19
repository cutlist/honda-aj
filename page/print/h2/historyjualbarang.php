<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RIWAYAT_JUAL_NAMA_BARANG_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR RIWAYAT PENJUALAN BARANG H2H3 PER TANGGAL <?echo date("d-m-Y")?> BERDASARKAN NAMA BARANG</h4>
	<h4>CARI KODE BARANG / NAMA BARANG : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">HARGA JUAL (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">DISKON (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE (namabarang LIKE '%$_REQUEST[cari]%' OR kodebarang LIKE '%$_REQUEST[cari]%') AND substr(nonota,1,2)='NJ' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE substr(nonota,1,2)='NJ' ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[notabeli]'"));
			                            ?>
			                                <tr style="cursor:pointer" >
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[notabeli]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[qty])?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
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