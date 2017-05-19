<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PELANGGAN_POTENSIAL.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR PELANGGAN POTENSIAL PERIODE TANGGAL TRANSAKSI TERAKHIR <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
	<table width="150%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TANGGAL TRANSAKSI TERAKHIR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA BARANG</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">WARNA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TAHUN PRODUKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transaksiakhir WHERE tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY idpelanggan");
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transaksiakhir WHERE idpelanggan='$d1[idpelanggan]' ORDER BY tanggal DESC LIMIT 0,1"));
			                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
			                            	
			                            ?>
				                                <tr <?echo $red?>>
				                                    <td><?echo $dA[nama]?></td>
				                                    <td><?echo "'$dA[notelepon]"?></td>
				                                    <td><?echo "$dA[alamat]. KEL. $dA[namakel], KEC. $dA[namakec], KAB. $dA[namakab]"?></td>
				                                    <td align=""><?echo $dB[tanggal]?></td>
				                                    <td align=""><?echo $dC[kodebarang]?></td>
				                                    <td align=""><?echo $dC[namabarang]?></td>
				                                    <td align=""><?echo $dC[varian]?></td>
				                                    <td align=""><?echo $dC[warna]?></td>
				                                    <td align=""><?echo $dC[thnproduksi]?></td>
				                                   
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