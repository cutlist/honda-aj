<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "UBAH_HARGA_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR UBAH HARGA H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI KODE BARANG /VARIAN / NAMA BARANG : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STOK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">HARGA JUAL (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT *,SUM(totalstok) AS qty FROM x23_stokpart_group_vw2 WHERE kodebarang LIKE '%$_REQUEST[cari]%' OR namabarang LIKE '%$_REQUEST[cari]%' OR varian LIKE '%$_REQUEST[cari]%' GROUP BY hargajual ORDER BY totalstok LIMIT 0,20");
											}
										else
											{
				                   			$q1 = mysql_query("SELECT *,SUM(totalstok) AS qty FROM x23_stokpart_group_vw2 GROUP BY hargajual ORDER BY totalstok LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                	<td align="right" width="7%"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                	<td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
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