<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "STOK$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");

$dG = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$_REQUEST[idgudang]'"));

?>
	<h4> LAPORAN STOK UNIT PER TANGGAL <?echo date("d-m-Y")?></h4>
        <?
		if(!empty($_REQUEST[idgudang]))
			{
		?>
			<h4> LOKASI : <?echo $dG[gudang]?></h4>
		<?
			}
		else{
		?>
			<h4> LOKASI : SEMUA LOKASI</h4>
		<?
			}
        ?>
    <table>
        <thead>
            <tr>
                <th style="height:45px;background:#37A58A;color:#fff;">NO.</th>
                <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
                <th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
                <th style="height:45px;background:#37A58A;color:#fff;">TAHUN</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NOMOR RANGKA</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NOMOR MESIN</th>
                <th style="height:45px;background:#37A58A;color:#fff;">LOKASI GUDANG</th>
            </tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
		<tbody style="cursor:pointer">
        <?
		$no=1;
		if(!empty($_REQUEST[idgudang]))
			{
        	$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE status='STOK' AND idgudang='$_REQUEST[idgudang]' ORDER BY kodebarang");
			}
		else{
        	$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE status='STOK' ORDER BY gudang,kodebarang");
			}
        while($d1 = mysql_fetch_array($q1))
        	{
        ?>
            <tr style="cursor:pointer">
                <td align="right"><?echo $no?>.</td>
                <td><?echo $d1[kodebarang]?></td>
                <td><?echo $d1[namabarang]?></td>
                <td><?echo $d1[varian]?></td>
                <td><?echo $d1[warna]?></td>
                <td align="center"><?echo $d1[thnproduksi]?></td>
                <td align=""><?echo $d1[norangka]?></td>
                <td align=""><?echo $d1[nomesin]?></td>
                <td><?echo $d1[gudang]?></td>
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