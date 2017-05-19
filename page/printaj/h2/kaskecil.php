<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KASKECIL$_SESSION[periode_awal]-$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 
										if(empty($_SESSION[periode_awal]))
											{
								            $_SESSION[periode_awal]  = date("Y-m-d");
								            $_SESSION[periode_akhir] = date("Y-m-d");
											}


?>
	<h4>DAFTAR KAS KECIL PERIODE TANGGAL KAS KECIL <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
    <table>
										<thead>
											<tr>
												<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN</th>
												<th style="height:45px;background:#37A58A;color:#fff;">UANG MASUK (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">UANG KELUAR (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            //echo  $_SESSION[periode_awal].$_SESSION[periode_akhir];
			                            
										$dB  = mysql_fetch_array(mysql_query("SELECT id FROM x23_kaskecil ORDER BY id DESC LIMIT 0,1"));
										$q1  = mysql_query("SELECT * FROM x23_kaskecil WHERE id%2=0 AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' ORDER BY id DESC");
										$dI  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND jenis='INPUT' AND status='1'"));
										$dO  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND jenis='OUTPUT' AND status='1'"));
										$dIx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND jenis='INPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='1'"));
										$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE id%2=0 AND jenis='OUTPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='1'"));
										$dT  = $dI[total]-$dO[total];
										
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
			                                    <td><?echo $d1['keterangan']?></td>
		                                    <?
		                                    if($d1['jenis']=='INPUT')
		                                    	{
											?>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    <td align="center">-</td>
											<?	
												}
											else
												{
											?>
			                                    <td align="center">-</td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
											<?
												}
		                                    ?>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                                <tr>
			                                    <td colspan="10"></td>
			                                </tr>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="6"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">TOTAL (RP) : </th>
			                                    <th style="text-align:center;font-size:15px"><?echo number_format($dIx[total],"0","",".")?></th>
			                                    <th style="text-align:center;font-size:15px"><?echo number_format($dOx[total],"0","",".")?></th>
			                                    <th></th>
			                                    <th></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">SALDO AKHIR (RP) : </th>
			                                    <th colspan="2" style="text-align:center;font-size:15px"><?echo number_format($dT,"0","",".")?></th>
			                                    <th></th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>