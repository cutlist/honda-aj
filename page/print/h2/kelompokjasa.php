<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KELOMPOK_JASA_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KELOMPOK JASA H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE KELOMPOK JASA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JENIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KPB KE</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA KELOMPOK JASA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TARIF KELOMPOK JASA KE KONSUMEN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">HARGA KPB KE MPM</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">HARGA PENGGANTIAN OLI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_kelompokjasa");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_det_vw WHERE kode='$d1[kode]'"));
											if($d1[status]=="1"){
												$status="AKTIF";
												}
											else{
												$status="TIDAK AKTIF";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kode]?></td>
			                                    <td><?echo $d1[jnskj]?></td>
			                                    <td align="center"><?echo $d1[kpbke]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[hargampm],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[hargaoli],"0","",".")?></span></td>
			                                    <td><?echo $status?></td>
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