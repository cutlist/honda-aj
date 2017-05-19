<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "STOK$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 

$dL = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id='$_REQUEST[idgudang]'"));

?>
	<h4>LAPORAN STOK BARANG H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI KODE BARANG / VARIAN / NAMA BARANG : <?echo $_REQUEST[cari]?></h4>
	<h4>LOKASI : <?echo $dL[gudang]?></h4>
    <table>
        <thead>
            <tr>
                <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
                <th style="height:45px;background:#37A58A;color:#fff;">STOK</th>
                <th style="height:45px;background:#37A58A;color:#fff;">GUDANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">RAK</th>
                <th style="height:45px;background:#37A58A;color:#fff;">HARGA JUAL (RP)</th>
            </tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
		<tbody style="cursor:pointer">
        <?
		if(empty($_REQUEST[cari]) AND empty($_REQUEST[idgudang]))
			{
			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
			}
		if(empty($_REQUEST[cari]) AND !empty($_REQUEST[idgudang]))
			{
			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE idgudang='$_REQUEST[idgudang]' GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
			}
		if(!empty($_REQUEST[cari]) AND empty($_REQUEST[idgudang]))
			{
			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE kodebarang LIKE '%$_REQUEST[cari]%' OR namabarang LIKE '%$_REQUEST[cari]%' OR varian LIKE '%$_REQUEST[cari]%' GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
			}
		if(!empty($_REQUEST[cari]) AND !empty($_REQUEST[idgudang]))
			{
			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE idgudang='$_REQUEST[idgudang]' AND (kodebarang LIKE '%$_REQUEST[cari]%' OR namabarang LIKE '%$_REQUEST[cari]%' OR varian LIKE '%$_REQUEST[cari]%') GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
			}
			
		while($d1 = mysql_fetch_array($q1))
        	{
        	if($d1[totalstok]!='0')
        		{
				if($d1[totalstok]<'0'){
					$red = "color:#ff0227";
					}
				else{$red="";}
        ?>
	            <tr style="cursor:pointer">
	                <td><?echo $d1[kodebarang]?></td>
	                <td><?echo $d1[namabarang]?></td>
	                <td><?echo $d1[varian]?></td>
	            	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[totalstok],"0","",".")?> PCS</span></td>
	                <td><?echo $d1[gudang]?></td>
	                <td><?echo $d1[rak]?></td>
	            	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
	            </tr>
            
        <?
				}
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