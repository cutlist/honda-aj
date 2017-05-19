<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KINERJA_SEMUA(PCS)_MEKANIK.xls";
header("Content-Disposition: attachment; filename=$judul");
 
?>
	<h4>KINERJA MEKANIK SEMUA (PCS) H2H3 PERIODE TANGGAL SELESAI SERVIS <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?><br></h4>
    <table>
        <thead>
			<tr>
												<th style="height:45px;background:#37A58A;color:#fff;">NAMA MEKANIK</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH NOTA SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH UNIT SERVIS</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH UNIT KPB</th>
												<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH UNIT SERVIS JR</th>
												<th style="height:45px;background:#37A58A;color:#fff;">TOTAL WAKTU SERVIS</th>
			</tr>
        </thead>
		<tbody>
<?
										mysql_query("TRUNCATE temp_x23_kmindividu_wktsvc");
										$qM = mysql_query("SELECT nama,id FROM x23_karyawan WHERE posisi='4'");
										while($dM = mysql_fetch_array($qM))
											{
											$dA1 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
											$dA2 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice_det1_vw WHERE kpbke!='' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
											$dA4 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE jns='SERVIS JR' AND idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
										
											$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
												$mulai   = mktime(date("H",strtotime($d1[jammulai])), date("i",strtotime($d1[jammulai])), date("s",strtotime($d1[jammulai])), date("m",strtotime($d1[tglnota])), date("d",strtotime($d1[tglnota])), date("Y",strtotime($d1[tglnota])));
												$selesai = mktime(date("H",strtotime($d1[jamselesai])), date("i",strtotime($d1[jamselesai])), date("s",strtotime($d1[jamselesai])), date("m",strtotime($d1[tglselesai])), date("d",strtotime($d1[tglselesai])), date("Y",strtotime($d1[tglselesai])));
												$selisih_waktu = $selesai-$mulai;
												mysql_query("INSERT INTO temp_x23_kmindividu_wktsvc VALUES ('$dM[id]','$selisih_waktu')");
				                            	}
				                            	
					                        $dA3 = mysql_fetch_array(mysql_query("SELECT SUM(wktsvc) AS total FROM temp_x23_kmindividu_wktsvc WHERE idmekanik='$dM[id]'"));
					                        $selisih_waktu = $dA3[total];
											$jumlah_hari = floor($selisih_waktu/86400);
											if($jumlah_hari=="0"){
												$hari = "";
												}
											if($jumlah_hari!="0"){
												$hari = "$jumlah_hari HARI";
												}

											//Untuk menghitung jumlah dalam satuan jam:
											$sisa = $selisih_waktu % 86400;
											$jumlah_jam = floor($sisa/3600);
											if($jumlah_jam=="0"){
												$jam = "";
												}
											if($jumlah_jam!="0"){
												$jam = "$jumlah_jam JAM";
												}

											//Untuk menghitung jumlah dalam satuan menit:
											$sisa = $sisa % 3600;
											$jumlah_menit = floor($sisa/60);
											if(strlen($jumlah_menit)==1){
												$menit = "0".$jumlah_menit;
												}
											if(strlen($jumlah_menit) == 2){
												$menit = $jumlah_menit;
												}
												
											if($jumlah_menit < "0"){
												$durasi = "-";
												}
											else{
												$durasi = "$hari $jam $jumlah_menit MENIT";
												}
											if($dA1[total]>'0')
												{
										?>
				                                <tr style="cursor:pointer">
				                                    <td align=""><?echo $dM[nama]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA1[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA1[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA2[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA4[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $durasi?></span></td>
				                                </tr>
<?
			}
		}
?>
        </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th></th>
			                                </tr>
			                            </tfoot>
    </table>