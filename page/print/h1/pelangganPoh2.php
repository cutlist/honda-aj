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
<h4>DAFTAR PELANGGAN POTENSIAL H2H3 TAHUN PRODUKSI <?echo $_SESSION[tahunkend]?></h4>
<table width="100%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">ALAMAT</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KODE MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">VARIAN MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">WARNA MOTOR</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TAHUN PRODUKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
											$q1 = mysql_query("SELECT * FROM x23_notaservice_vw WHERE tahunmotor='$_SESSION[tahunkend]' GROUP BY idpelanggan,kodemotor");
										while($d1 = mysql_fetch_array($q1))
			                            	{
												
			                            ?>
			                                <tr <?echo $red?>>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[notelepon]?></td>
			                                    <td><?echo "$d1[alamat]. KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                    <td><?echo $d1[kodemotor]?></td>
			                                    <td><?echo $d1[tipemotor]?></td>
			                                    <td><?echo $d1[varianmotor]?></td>
			                                    <td><?echo $d1[warnamotor]?></td>
			                                    <td><?echo $d1[tahunmotor]?></td>
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