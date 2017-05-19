<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PIUTANG$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR PIUTANG H1 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI  NAMA KARYAWAN : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TOTAL PIUTANG (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">SISA PIUTANG (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT idkaryawan,nama,SUM(jumlah) AS total FROM tbl_piutang WHERE id%2=0 AND jenis='piutang' AND status='1' AND nama LIKE '%$_REQUEST[cari]%' GROUP BY idkaryawan ORDER BY id DESC LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT idkaryawan,nama,SUM(jumlah) AS total FROM tbl_piutang WHERE id%2=0 AND jenis='piutang' AND status='1' GROUP BY idkaryawan ORDER BY id DESC LIMIT 0,20");
											}
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE id%2=0 AND jenis='pembayaran' AND status='1' AND idkaryawan='$d1[idkaryawan]' GROUP BY idkaryawan"));
											$sisa = $d1[total]-$d2[total];
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&idkaryawan=$d1[idkaryawan]"?>'">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo number_format($sisa,"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>