<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RIWAYAT_JUAL_NOTA_JUAL_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR RIWAYAT PENJUALAN BARANG H2H3 PER TANGGAL <?echo date("d-m-Y")?> BERDASARKAN NOTA JUAL</h4>
	<h4>CARI NO. NOTA JUAL / NAMA PELANGGAN / STATUS: <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL QTY BELI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_vw WHERE ket LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_vw ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="0"){$status = "Belum Lunas";}
			                            	if($d1[status]=="1"){$status = "Lunas";}
			                            ?>
			                                <tr style="cursor:pointer" >
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[totalqty])?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal])?></span></td>
			                                    <td align="center"><?echo $status?></td>
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