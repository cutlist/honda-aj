<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RIWAYAT_SERVIS_H2H3$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR RIWAYAT SERVIS H2H3 PER TANGGAL <?echo date("d-m-Y")?></h4>
	<h4>CARI NO. NOTA SERVIS / NO. NOTA SERVIS JR / NO. PKB / NAMA PELANGGAN : <?echo $_REQUEST[cari]?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA SERVIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA SERVIS JR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. PKB</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TGL NOTA SERVIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JENIS SERVIS</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">WAKTU MULAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">WAKTU SELESAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GRAND TOTAL (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">PEMBAYARAN (PEMBULATAN) (RP)</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA MEKANIK</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notaservice_vw WHERE id%2=0 AND jamselesai!='00:00:00' AND (nama LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%' OR noclaim LIKE '%$_REQUEST[cari]%' OR nopkb LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notaservice_vw WHERE id%2=0 AND jamselesai!='00:00:00' ORDER BY id DESC LIMIT 0,20");
											}
											
										while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id%2=0 AND id='$d1[idmekanik]'"));
			                            	if($d1[status]=="1"){$status = "Belum Lunas";}
			                            	if($d1[status]=="2"){$status = "Lunas";}
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND jnskwitansi='servis' AND nomor='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td><?echo $d1[noclaim]?></td>
			                                    <td><?echo $d1[nopkb]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[jns]?></td>
			                                    <td align="center"><?echo $d1[jammulai]?></td>
			                                    <td align="center"><?echo $d1[jamselesai]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[kodemotor]?></td>
			                                    <td><?echo $d1[tipemotor]?></td>
			                                    <td><?echo $d1[varianmotor]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[grandtotal],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d3[pembulatan],"0","",".")?></span></td>
			                                    <td><?echo $d2[nama]?></td>
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