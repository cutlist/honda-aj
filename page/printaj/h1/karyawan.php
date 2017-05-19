<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KARYAWAN_H1$tgl.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KARYAWAN H1 PER TANGGAL <?echo date("d-m-Y")?></h4>
    <table>
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NIK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">POSISI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">MULAI KERJA</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">GAJI POKOK</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">UANG HARIAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">UANG LEMBUR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id%2=0 AND id !='1' ORDER BY nama");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[nik]?></td>
			                                    <td><?echo $d1[posisi]?></td>
			                                    <td align="right"><?echo "'".$d1[notelepon]?></td>
			                                    <td><?echo $d1[alamat]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?></td>
			                                    <td align="right"><?echo $d1[ugapok]?></td>
			                                    <td align="right"><?echo $d1[uharian]?></td>
			                                    <td align="right"><?echo $d1[ulembur]?></td>
			                                    <td width="" align="center"><?echo $d1[status]?></td>
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