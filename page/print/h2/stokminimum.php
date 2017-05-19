<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "STOK_MINIMUM$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


$dx = mysql_fetch_array(mysql_query("SELECT * FROM tbl_perusahaan WHERE id='1'"));
$d3 = mysql_fetch_array(mysql_query("SELECT nama,posisi FROM x23_user_vw WHERE id='$d1[user]'"));

?>
<h4>STOK MINIMUM</h4>

<table width="100%">
<tr>
	<td colspan="6">CABANG : <?echo $dx[namacabang]?></td>
</tr>
<tr>
	<td colspan="6">TANGGAL : <?echo date("d-m-Y")?></td>
</tr>
</table>

			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STOK MINIMUM</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STOK TERKINI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_stokmin");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$d1[idbarang]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS totqty FROM x23_stokpart WHERE idbarang='$d1[idbarang]' GROUP BY idbarang"));
			                            	
			                            	if($d3[totqty]>$d1[stokmin]){$status = "STOK AMAN";}
			                            	if($d3[totqty]<=$d1[stokmin]){$status = "HARAP PESAN";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[stokmin],"0","",".")?> PCS</span></td>
			                                	<td align="right"><span style="padding-right:20%"><?echo number_format($d3[totqty],"0","",".")?> PCS</span></td>
			                                    <td align=""><?echo $status?></td>
			                                 </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                        </table>