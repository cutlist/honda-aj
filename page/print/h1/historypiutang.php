<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RIWAYAT_PIUTANG_KARYAWAN_H1.xls";
header("Content-Disposition: attachment; filename=$judul");
 


$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id='$_REQUEST[idkaryawan]'"));
?>
<h4>RIWAYAT PIUTANG KARYAWAN <?echo $d1[nama]?> H1</h4>

<table width="100%">
<tr>
	<td>NAMA KARYAWAN : <?echo $d1[nama]?></td>
</tr>
</table>
<?
$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE jenis='piutang' AND idkaryawan='$_REQUEST[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE jenis='pembayaran' AND idkaryawan='$_REQUEST[idkaryawan]' AND status='1' GROUP BY idkaryawan"));

$totpiutang    = $dPiu[total];
$totpembayaran = $dPby[total];
$sisapiutang   = $dPiu[total]-$dPby[total];
?>
<table>
<tr>
	<td>TOTAL PIUTANG</td>
	<td>: RP. </td>
	<td align="right"><?echo number_format($totpiutang,"0","",".")?></td>
</tr>
<tr>
	<td>TOTAL PEMBAYARAN</td>
	<td>: RP. </td>
	<td align="right"><?echo number_format($totpembayaran,"0","",".")?></td>
</tr>
<tr>
	<td>SISA PIUTANG</td>
	<td>: RP. </td>
	<td align="right"><?echo number_format($sisapiutang,"0","",".")?></td>
</tr>
</table>

<table width="100%" class="table table-striped table-bordered">
    <thead style="color:#666;font-size:11px">
        <tr>
			<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL</th>
			<th style="height:45px;background:#37A58A;color:#fff;">JENIS</th>
			<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH</th>
			<th style="height:45px;background:#37A58A;color:#fff;">DIAMBIL DARI</th>
			<th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
			<th style="height:45px;background:#37A58A;color:#fff;">STATUS KONFIRMASI</th>
			<th style="height:45px;background:#37A58A;color:#fff;">STATUS CETAK KWITANSI</th>
        </tr>
    </thead>
															<tbody>
								                    	<?
								                    		$qA = mysql_query("SELECT * FROM tbl_piutang WHERE idkaryawan='$_REQUEST[idkaryawan]' ORDER BY tgl DESC");
								                    		while($dA=mysql_fetch_array($qA))
								                    			{
																$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE nomor='$dA[id]' AND idpotkom='0'"));
								                            	if($dA[status]=="0"){
																	if($dB[status]=="0"){
																		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
																		$status2 = "";
																		}
																	if($dB[status]=="1"){
																		$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
																		$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
																		}
																	if(empty($dB[status])){
																		$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
																		$status2 = "";
																		}
																	}
								                            	if($dA[status]=="1"){
																	$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
																	if($dB[status]=="0"){
																		$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
																		}
																	if($dB[status]=="1"){
																		$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
																		}
																	if(empty($dB[status])){
																		$status2 = "";
																		}
																	}
								                            	if($dA[status]=="2"){
																	$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";
																	$status2 = "";
																	}
								                    	?>
																<tr style="cursor:pointer">
																	<td align="center"><?echo date("d-m-Y",strtotime($dA[tgl]))?></td>
																	<td align="left"><span style="padding-left:10%"><?echo strtoupper($dA[jenis])?></span></td>
																	<td align="right"><span style="padding-right:20%"><?echo number_format($dA[jumlah],"0","",".")?></span></td>
																	<td align="left"><?echo $dA[metodebayar]?></td>
																	<td align="left"><?echo $dA[ket]?></td>
																	<td align="center"><?echo $status?></td>
																	<td align="center"><?echo $status2?></td>
																</tr>
														<?
																}
														?>
															</tbody>
</table>