<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "ABSENSI_INDIVIDU_H1_$_SESSION[periode_awal]_SD_$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");

 $dnk = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
 


?>
	<h4>ABSENSI INDIVIDU H1 PERIODE TANGGAL ABSENSI <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]));?></h4>
	<h4>NAMA KARYAWAN : <?echo $dnk[nama]?></h4>
	            <table>
					<thead>
						<tr>
							<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL</th>
							<th style="height:45px;background:#37A58A;color:#fff;">HARI</th>
							<th style="height:45px;background:#37A58A;color:#fff;">JAM MASUK</th>
							<th style="height:45px;background:#37A58A;color:#fff;">TERLAMBAT</th>
							<th style="height:45px;background:#37A58A;color:#fff;">JAM KELUAR</th>
							<th style="height:45px;background:#37A58A;color:#fff;">OVER TIME</th>
							<th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
						</tr>
					</thead>
	                <tbody>
	                <?
					$awal  = $_SESSION[periode_awal];
					$akhir = $_SESSION[periode_akhir];
	                
	                //echo  $awal.$akhir;
	                
					$no=0;
					$izin=0;
					$sakit=0;
					$tanpaket=0;
					$hadir=0;
					while (strtotime($awal) <=  strtotime($akhir)) 
	                	{
						$d1  = mysql_fetch_array(mysql_query("SELECT * FROM abs_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
						mysql_query("INSERT INTO temp_abs_status (
														EmployeeID,
														tgl,
														status,
														keterangan)
													VALUES (
														'$_REQUEST[EmployeeID]',
														'$awal',
														'$d1[status]',
														'$d1[keterangan]')");
														
						$d2  = mysql_fetch_array(mysql_query("SELECT * FROM abs_result_vw WHERE EmployeeID='$_REQUEST[EmployeeID]' AND substr(Date,1,10)='$awal'"));
						
						$selesai 		= substr($d2['Date'],11,8);
						$mulai	 		= "06:59:59";
						$mulai_time	 	=(is_string($mulai)?strtotime($mulai):$mulai);
						$selesai_time	=(is_string($selesai)?strtotime($selesai):$selesai);
						$detik			=$selesai_time-$mulai_time; //hitung selisih dalam detik
						$menit			=round($detik/60); //hiutng menit
						$sisa_detik		=$detik%$menit; //hitung sisa detik
						
						if($menit <= 0){
							$terlambat = "";
							}
						else{
							$terlambat = $menit." Menit";
							mysql_query("INSERT INTO temp_abs_terlambat (
															EmployeeID,
															tgl,
															total)
														VALUES (
															'$_REQUEST[EmployeeID]',
															'$awal',
															'$terlambat')");
							}
						
							
						//HITUNG OVERTIME
						$selesai3 		= substr($d2['Scan4'],11,8);
						$mulai3	 		= "16:00:00";
						$mulai_time3	=(is_string($mulai3)?strtotime($mulai3):$mulai3);
						$selesai_time3	=(is_string($selesai3)?strtotime($selesai3):$selesai3);
						$detik3			=$selesai_time3-$mulai_time3; //hitung selisih dalam detik
						$menit3			=round($detik3/60); //hiutng menit
						$sisa_detik3	=$detik3%$menit3; //hitung sisa detik
						
						if($menit3 <= 0){
							$overtime = "";
							}
						else{
							$overtime = $menit3." Menit";
							mysql_query("INSERT INTO temp_abs_overtime (
															EmployeeID,
															tgl,
															total)
														VALUES (
															'$_REQUEST[EmployeeID]',
															'$awal',
															'$overtime')");
							}
							
						$hari_ar = array("Monday"=>"Senin", "Tuesday"=>"Selasa", "Wednesday"=>"Rabu", "Thursday"=>"Kamis", "Friday"=>"Jumat", "Saturday"=>"Sabtu", "Sunday"=>"Minggu");
						$hari_en = date('l',strtotime($awal));
						$hari	 = $hari_ar[$hari_en];
				
						$jammasukX 	= substr($d2['Date'],11,8);
						$istirahatX = substr($d2['Scan2'],11,8);
						$selesaiistirahatX = substr($d2['Scan3'],11,8);
						$jamkeluarX = substr($d2['Scan4'],11,8);
						
						if(empty($jammasukX)){
							$jammasuk = "-";
							}
						else{
							$jammasuk = $jammasukX;
							}
						if(empty($istirahatX) || $istirahatX == "00:00:00"){
							$istirahat = "-";
							}
						else{
							$istirahat = $istirahatX;
							}
						if(empty($selesaiistirahatX) || $selesaiistirahatX == "00:00:00"){
							$selesaiistirahat = "-";
							}
						else{
							$selesaiistirahat = $selesaiistirahatX;
							}
						if(empty($jamkeluarX) || $jamkeluarX == "00:00:00"){
							$jamkeluar = "-";
							}
						else{
							$jamkeluar = $jamkeluarX;
							}
							
						$d3  = mysql_fetch_array(mysql_query("SELECT * FROM abs_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
						if(empty($d3['id'])){
												if($jamkeluar == "-"){
													$status = "TIDAK HADIR";
													$tanpaket++;
													}
												else{
													$status = "HADIR";
													$hadir++;
													}
												}
											else{
												$status = $d3['status'];
												if($status=="SAKIT"){
													$sakit++;
													}
												if($status=="IZIN"){
													$izin++;
													}
												}
							
						$dNm = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
							echo"
								<tr style='cursor:pointer'> 
									<td align='center'>".tgl_indo1($awal)."</td> 
									<td align='left'>$hari</td> 
									<td align='center'>$jammasuk</td> 
									<td align='center'>$terlambat</td> 
									<td align='center'>$jamkeluar</td> 
									<td align='center'>$overtime</td> 
									<td align='center'>$status</td> 
								</tr>";
							$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
							$no++;
						}
					?>
	                </tbody>
	                <tfoot>
	                    <tr>
	                        <th colspan="10">&nbsp;</th>
	                    </tr>
	                </tfoot>
	            </table>
	            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
	            <?
	            $periode_awal = date("Y-m-d",strtotime($pecah[0]));
	            $terlambat  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_abs_terlambat"));
	            $overtime   = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_abs_overtime"));
	            
	            $dterlambat = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM temp_abs_terlambat WHERE EmployeeID='$_REQUEST[EmployeeID]' AND tgl BETWEEN '$periode_awal' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
	            $dovertime  = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM temp_abs_overtime WHERE EmployeeID='$_REQUEST[EmployeeID]' AND tgl BETWEEN '$periode_awal' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
				
				?>
	            	<table width="100%">
	            		<tr>
	            			<td>JUMLAH KEHADIRAN </td><td>: <?echo number_format($hadir)?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>JUMLAH IZIN </td><td>: <?echo number_format($izin)?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>JUMLAH SAKIT </td><td>: <?echo number_format($sakit)?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>JUMLAH TANPA KETERANGAN </td><td>: <?echo number_format($tanpaket)?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>TOTAL </td><td>: <?echo number_format($no)?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>JUMLAH TERLAMBAT MASUK </td><td>: <?echo number_format($terlambat[total])?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>DURASI TERLAMBAT MASUK </td><td>: <?echo number_format($dterlambat[total])?> Menit</td>
	            		</tr>
						<tr>
	            			<td>JUMLAH OVER TIME </td><td>: <?echo number_format($overtime[total])?> Hari</td>
	            		</tr>
	            		<tr>
	            			<td>DURASI OVER TIME </td><td>: <?echo number_format($dovertime[total])?> Menit</td>
	            		</tr>
	            	</table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>