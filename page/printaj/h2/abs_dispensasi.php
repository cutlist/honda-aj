<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "DISPENSASI$_SESSION[periode_awal]SD$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR DISPENSASI PERIODE TANGGAL MULAI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">POSISI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">JENIS DISPENSASI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TANGGAL MULAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">TANGGAL SELESAI</th>
			                                    <th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?			   
										$q1 = mysql_query("SELECT * FROM abs_x23_status_vw WHERE id%2=0 AND awal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
		                            while($d1 = mysql_fetch_array($q1))
		                            	{
		                            ?>
		                                <tr style="cursor:pointer">
		                                    <td><?echo "$d1[FirstName] $d1[LastName]"?></td>
		                                    <td><?echo $d1[DepartmentName]?></td>
		                                    <td><?echo $d1[status]?></td>
		                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[awal]))?></td>
		                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[akhir]))?></td>
		                                    <td><?echo $d1[keterangan]?></td>
		                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>