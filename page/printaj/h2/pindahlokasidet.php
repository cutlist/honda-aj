<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PINDAH_LOKASI_BARANG_H2H3.xls";
header("Content-Disposition: attachment; filename=$judul");
 

		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_pindah WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$g1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang1]'"));
		$g2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang2]'"));
    
		if($d1[status]=="2"){$status = "DITOLAK";}
    	if($d1[status]=="1"){$status = "DISETUJUI";}
    	if($d1[status]=="0"){$status = "BELUM DIKONFIRMASI PIHAK MANAJEMEN";}

?>
	<h4>PINDAH LOKASI BARANG H2H3<br>
	GUDANG ASAL : <?echo $g1[gudang]?><br>
	RAK ASAL : <?echo $d1[rak1]?><br>
	GUDANG TUJUAN : <?echo $g2[gudang]?><br>
	RAK TUJUAN : <?echo $d1[rak2]?><br>
	STATUS : <?echo $status?></h4>
    <table>
        <thead>
			<tr>
	            <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
	            <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
	            <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
	            <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA BELI</th>
	            <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA BELI</th>
	            <th style="height:45px;background:#37A58A;color:#fff;">HARGA BELI (RP)</th>
	            <th style="height:45px;background:#37A58A;color:#fff;">QTY PINDAH</th>
			</tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
		<tbody>
<?
			
		$q1 = mysql_query("SELECT * FROM x23_pindah_det_vw WHERE id%2=0 AND idpindah='$_REQUEST[id]'");
        while($d1 = mysql_fetch_array($q1))
        	{
											$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND nonota='$d1[nonota]'"));
?>
            <tr style="cursor:pointer">
                <td><?echo $d1[kodebarang]?></td>
                <td><?echo $d1[namabarang]?></td>
                <td><?echo $d1[varian]?></td>
                <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dNbl[tglnota]))?></td>
                <td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
                <td align="right" width="1%"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
            </tr>
<?
		}
?>
        </tbody>
    </table>