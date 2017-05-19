<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "RINGKASAN_SERVIS.xls";
header("Content-Disposition: attachment; filename=$judul");
 
	                            	mysql_query("TRUNCATE temp_x23_abispenjualan");


?>
	<h4>LAPORAN RINGKASAN MOTOR SERVIS PERIODE TANGGAL KWITANSI SERVIS <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="10" style="background:#37A58A;color:#fff;"><b>JUMLAH UNIT SEPEDA MOTOR YANG DISERVIS</b></td>
											</tr>
											<tr>
												<th rowspan="2" style="background:#37A58A;color:#fff;">KODE MOTOR</th>
												<th rowspan="2" style="background:#37A58A;color:#fff;">NAMA MOTOR</th>
												<th rowspan="2" style="background:#37A58A;color:#fff;">VARIAN</th>
												<th rowspan="2" style="background:#37A58A;color:#fff;">JUMLAH MOTOR YANG DISERVIS (NON JR)</th>
												<th colspan="4" style="background:#37A58A;color:#fff;"><center>KARTU PERAWATAN BERKALA</center></th>
												<th rowspan="2" style="background:#37A58A;color:#fff;">KONSUMEN (NON KPB)</th>
												<th rowspan="2" style="background:#37A58A;color:#fff;">SERVIS JR</th>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;"><center>1</center></th>
												<th style="background:#37A58A;color:#fff;"><center>2</center></th>
												<th style="background:#37A58A;color:#fff;"><center>3</center></th>
												<th style="background:#37A58A;color:#fff;"><center>4</center></th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $no= 1;
										$q1 = mysql_query("SELECT *,COUNT(id) AS jumlah FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1' GROUP BY kodemotor");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='1' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='2' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dC = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='3' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dD = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='4' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dE = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]') AND kpbke!=''"));
			            					$jumlahnonkpb = $d1[jumlah]-$dE[jumlah];
			            					$dF = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice WHERE jns='SERVIS JR' AND kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'"));
			            					
			            					$dG = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice WHERE jns='SERVIS JR' AND kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND grandtotal='0'"));
			            					
			            					if(strlen($no)==1)
			            						{
												$nostart = "00".$no;
												}
			            					else if(strlen($no)==2)
			            						{
												$nostart = "0".$no;
												}
			            					else if(strlen($no)==3)
			            						{
												$nostart = $no;
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align=""><?echo $d1[kodemotor]?></td>
			                                    <td align=""><?echo $d1[tipemotor]?></td>
			                                    <td align=""><?echo $d1[varianmotor]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $d1[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dA[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dB[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dC[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dD[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $jumlahnonkpb?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dF[jumlah]?> UNIT</span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            	<tr><td></td></tr>
			                            </tbody>
			                        </table>
		                    		<div class="clearfix"></div>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>