<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "REKAPITULASI_ABSENSI_H2H3_$_SESSION[periode_awal]_SD_$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>REKAPITULASI ABSENSI H2H3 PERIODE TANGGAL ABSENSI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
    <table id="example2" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
		<thead>
			<tr>
				<th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
				<th style="height:45px;background:#37A58A;color:#fff;">POSISI</th>
				<th style="height:45px;background:#37A58A;color:#fff;">TOTAL HARI KERJA</th> 
				<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH KEHADIRAN</th> 
				<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH TERLAMBAT</th> 
				<th style="height:45px;background:#37A58A;color:#fff;">DURASI TERLAMBAT</th> 
				<th style="height:45px;background:#37A58A;color:#fff;">IZIN</th> 
				<th style="height:45px;background:#37A58A;color:#fff;">SAKIT</th>
				<th style="height:45px;background:#37A58A;color:#fff;">TANPA KETERANGAN</th>
			</tr>
		</thead>
        <tbody>
        <?
		$q2	 = mysql_query("SELECT * FROM abs_x23_employee");
		while($d2  = mysql_fetch_array($q2))
			{
			$dD	 = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_department WHERE id%2=0 AND DepartmentID='$d2[DepartmentID]'"));
			$awal  = $_SESSION[periode_awal];
			$akhir = $_SESSION[periode_akhir];
        	
			while (strtotime($awal) <= strtotime($akhir)) 
				{
				$d3  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_status WHERE id%2=0 AND EmployeeID='$d2[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
				mysql_query("INSERT INTO temp_abs_x23_status (
												EmployeeID,
												tgl,
												status,
												keterangan)
											VALUES (
												'$d2[EmployeeID]',
												'$awal',
												'$d3[status]',
												'$d3[keterangan]')");
												
				$d4  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_result_vw WHERE id%2=0 AND EmployeeID='$d2[EmployeeID]' AND substr(Date,1,10)='$awal'"));
				
				$selesai 		= substr($d4['Date'],11,8);
				$mulai	 		= "07:29:59";
				$mulai_time	 	=(is_string($mulai)?strtotime($mulai):$mulai);
				$selesai_time	=(is_string($selesai)?strtotime($selesai):$selesai);
				$detik			=$selesai_time-$mulai_time; //hitung selisih dalam detik
				$menit			=round($detik/60); //hiutng menit
				$sisa_detik		=$detik%$menit; //hitung sisa detik
				
				if($menit <= 0){
					$terlambat = "";
					}
				else{
					$terlambat = $menit;
					if(substr($d4[Scan4],0,10) != "0000-00-00")
						{
						mysql_query("INSERT INTO temp_abs_x23_terlambat (
														EmployeeID,
														tgl,
														total)
													VALUES (
														'$d2[EmployeeID]',
														'$awal',
														'$terlambat')");
						}
					}
				
				$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
				}
				
				$jangka 	= selisihHari($_SESSION[periode_awal], $_SESSION[periode_akhir]);
				$hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE id%2=0 AND substr(Scan4,1,10) BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND EmployeeID='$d2[EmployeeID]' GROUP BY EmployeeID"));
				$izin 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM temp_abs_x23_status WHERE id%2=0 AND status='IZIN' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
				$sakit 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM temp_abs_x23_status WHERE id%2=0 AND status='SAKIT' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
				
				if($periode_awal==$_SESSION[periode_akhir])
					{
					$hadir = $hadir[total]+1;
                    //$tanpaket	= $jangka-$izin[total]-$cuti[total]-$sakit[total]-$hadir[total]+1;
					}
				else{
					$hadir = $hadir[total];
					}	
					
				$tanpaketX	= $jangka-$izin[total]-$sakit[total]-$hadir[total]+1;
				if($tanpaketX<0){
					$tanpaket = "0";
					}
				else{
					$tanpaket = $tanpaketX;
					}
				
				$bterlambat = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_abs_x23_terlambat WHERE id%2=0 AND total!='0' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
				$dterlambat = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM temp_abs_x23_terlambat WHERE id%2=0 AND total!='0' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
					
				echo"
					<tr> 
						<td>$d2[FirstName] $d2[LastName]</td>
						<td>$dD[DepartmentName]</td>
						<td align='center'>".number_format($jangka+1)." Hari</td> 
						<td align='center'>".number_format($hadir[total])." Hari</td> 
						<td align='center'>".number_format($bterlambat[total])." Hari</td> 
						<td align='right'>".number_format($dterlambat[total])." Menit</td> 
						<td align='center'>".number_format($izin[total])." Hari</td> 
						<td align='center'>".number_format($sakit[total])." Hari</td> 
						<td align='center'>".number_format($tanpaket)." Hari</td> 
					</tr>";
			}
									mysql_query("TRUNCATE temp_abs_x23_status");
									mysql_query("TRUNCATE temp_abs_x23_terlambat");
									mysql_query("TRUNCATE temp_abs_x23_overbreak");
									mysql_query("TRUNCATE temp_abs_x23_overtime");
		?>
        </tbody>
    </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>