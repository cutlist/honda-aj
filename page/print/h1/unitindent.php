<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "UNIT_INDENT$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR UNIT INDENT PER TANGGAL <?echo date("d-m-Y")?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA PESAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA PESAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">BARANG PESANAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NOMOR RANGKA</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE status='0' AND indent='1'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nopesan]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo "'".$d1[notelepon]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian] | $d1[warna] | $d1[thnproduksi]"?></td>
			                                    <td><?echo $d1[norangka]?></td>
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