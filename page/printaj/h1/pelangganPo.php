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
 


if(!empty($_SESSION[periode_awal]))
	{
?>
	<h4>DAFTAR PELANGGAN POTENSIAL PERIODE TANGGAL TRANSAKSI TERAKHIR <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
<?}else{?>
	<h4>DAFTAR PELANGGAN POTENSIAL PERIODE TANGGAL TRANSAKSI</h4>
<?}?>
    <table width="150%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TANGGAL TRANSAKSI TERAKHIR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TAHUN KENDARAAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_SESSION[periode_awal]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanganpotensial WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY idpelanggan");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanganpotensial GROUP BY idpelanggan ORDER BY id DESC LIMIT 0,100");
											}
										while($d1 = mysql_fetch_array($q1))
			                            	{
											if(!empty($d1[tglnota]))
												{
												$dTk = mysql_fetch_array(mysql_query("SELECT thnproduksi FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
												$tglnota = "<span style='color:'>$d1[tglnota]</span>";
												$tahunkendaraan = "<span style='color:'>$dTk[thnproduksi]</span>";
												
			                            ?>
				                                <tr <?echo $red?>>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo "$d1[alamat]. KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="center"><?echo $tglnota?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="center"><?echo $tahunkendaraan?></td>
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