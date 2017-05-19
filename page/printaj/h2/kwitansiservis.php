<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KWITANSI_SERVIS_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KWITANSI SERVIS H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NAMA PELANGGAN / NO. ANTRIAN / NO. POLISI : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. KWITANSI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JENIS SERVIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA SERVIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA SERVIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">WAKTU SELESAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. ANTRIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. POLISI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JUMLAH (PEMBULATAN) (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND jnskwitansi='servis' AND (nama LIKE '%$_REQUEST[cari]%' OR nopol LIKE '%$_REQUEST[cari]%' OR noantrian LIKE '%$_REQUEST[cari]%') ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND jnskwitansi='servis' ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND nonota='$d1[nomor]'"));
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo $d2[jns]?></td>
			                                    <td><?echo $d1[nomor]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="center"><?echo $d1[waktuselesai]?></td>
			                                    <td align="center"><?echo $d1[noantrian]?></td>
			                                    <td><?echo $d1[nopol]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[pembulatan],"0","",".")?></span></td>
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
		</tfoot>
	</table>