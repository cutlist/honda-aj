<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PEMESANAN_NOPOL$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>PEMESANAN NOMOR POLISI PER TANGGAL <?echo date("d-m-Y")?></h4>
    <table>
        <thead>
            <tr>							
                <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA JUAL</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
                <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">BARANG</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NO. RANGKA</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NAMA BPKB</th>
                <th style="height:45px;background:#37A58A;color:#fff;">NOPOL PESANAN</th>
                <th style="height:45px;background:#37A58A;color:#fff;">STATUS BAYAR</th>
                <th style="height:45px;background:#37A58A;color:#fff;">STATUS NOPOL</th>
            </tr>
        </thead>
		<tbody style="cursor:pointer">
        <?
		$no=1;
		$q1 = mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND pnopol!='' AND notajual!=''");
        while($d1 = mysql_fetch_array($q1))
        	{
        	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND nonota='$d1[notajual]'"));
        	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE id%2=0 AND nonota='$d1[notajual]'"));
        	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dB[idbarang]'"));
			if($d1[status] == "0"){
				$status1 = "<span class='btn btn-warning' style='padding:0 8px;font-size:12px;'>BELUM BAYAR</span>";
				$status2 = "<span class='btn btn-warning' style='padding:0 8px;font-size:12px;'>BELUM SELESAI</span>";
				}
			else if($d1[status] == "1"){
				$status1 = "<span class='btn btn-primary' style='padding:0 8px;font-size:12px;'>SUDAH BAYAR</span>";
				$status2 = "<span class='btn btn-warning' style='padding:0 8px;font-size:12px;'>BELUM SELESAI</span>";
				}
			else if($d1[status] == "2"){
				$status1 = "<span class='btn btn-primary' style='padding:0 8px;font-size:12px;'>SUDAH BAYAR</span>";
				$status2 = "<span class='btn btn-primary' style='padding:0 8px;font-size:12px;'>SUDAH SELESAI</span>";
				}
        ?>
            <tr style="cursor:pointer">
                <td><?echo $dA[tglnota]?></td>
                <td><?echo $dA[nonota]?></td>
                <td><?echo $dA[nama]?></td>
                <td><?echo "'".$dA[notelepon]?></td>
                <td><?echo "$dC[kodebarang]"?></td>
                <td><?echo "$dC[namabarang] | $dC[varian] | $dC[warna]"?></td>
                <td><?echo $dB[norangka]?></td>
                <td><?echo $d1[nama]?></td>
                <td><?echo $d1[pnopol]?></td>
                <td align="center"><?echo $status1?></td>
                <td align="center"><?echo $status2?></td>
            </tr>
        <?
        	mysql_query("UPDATE tbl_bpkb SET status='1',updatex='$updatex' WHERE id%2=0 AND notajual='$d1[nonota]'");
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