<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "TARIF_JASA_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR TARIF JASA KE KONSUMEN H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI KODE JASA / NAMA JASA / GOLONGAN: <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE JASA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA JASA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GOLONGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TARIF KE KONSUMEN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw WHERE id%2=0 AND kodejasa LIKE '%$_REQUEST[cari]%' OR namajasa LIKE '%$_REQUEST[cari]%' OR pangkat LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodejasa]?></td>
			                                    <td><?echo $d1[namajasa]?></td>
			                                    <td><?echo $d1[pangkat]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[tarif],"0","",".")?></span></td>
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