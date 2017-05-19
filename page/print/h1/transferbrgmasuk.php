<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "MUTASI_BARANG_MASUK$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 
$dT=mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' AND id='$_REQUEST[idasal]'"));


?>
	<h4>DAFTAR MUTASI BARANG MASUK PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA MUTASI MASUK : <?echo $_REQUEST[cari]?></h4>
	<h4>ASAL : <?echo $dT[nama]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA MUTASI MASUK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA MUTASI MASUK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ASAL MUTASI MASUK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">QTY MUTASI MASUK (UNIT)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL MUTASI MASUK (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL MUTASI MASUK + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]) AND !empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE jenis='MASUK' AND notransfer LIKE '%$_REQUEST[cari]%' AND idasal='$_REQUEST[idasal]' GROUP BY notransfer LIMIT 0,20");
											}
										if(!empty($_REQUEST[cari]) AND empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE jenis='MASUK' AND (notransfer LIKE '%$_REQUEST[cari]%') GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
										if(empty($_REQUEST[cari]) AND empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE jenis='MASUK' GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
										if(empty($_REQUEST[cari]) AND !empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE jenis='MASUK' AND idasal='$_REQUEST[idasal]' GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idasal]'"));
			                            ?>
			                                <tr style="cursor:pointer"  onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&notransfer=$d1[notransfer]"?>'">
			                                    <td><?echo $d1[notransfer]?></td>
			                                    <td><?echo $d1[tgltransfer]?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[harga]+$d1[ppn],"0","",".")?></span></td>
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