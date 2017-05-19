<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KASBON$_SESSION[periode_awal]-$_SESSION[periode_akhir].xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>DAFTAR KAS BON PERIODE TANGGAL NOTA JUAL <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))." SAMPAI DENGAN ".date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
    <table>
										<thead>
											<tr>
												<th style="height:45px;background:#37A58A;color:#fff;"><center>TGL NOTA JUAL</center></th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. NOTA JUAL</th>
												<th style="height:45px;background:#37A58A;color:#fff;">BARANG</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NOMOR RANGKA</th>
												<th style="height:45px;background:#37A58A;color:#fff;">BROKER</th>
												<th style="height:45px;background:#37A58A;color:#fff;">NO. TELEPON BROKER</th>
												<th style="height:45px;background:#37A58A;color:#fff;">POTONGAN TAMBAHAN (RP)</th>
												<th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            
			                            //echo  $_SESSION[periode_awal].$_SESSION[periode_akhir];
			                            
										$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE id%2=0 AND ref!='' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$d1[idbarang]'"));
			                            	if($d1[statuskomisi]=='0'){
						                        $statuskomisi = "<span data-toggle='modal' data-target='#compose-modal-bayar$d1[id]' class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Belum Bayar</span>";
												}
											else{
						                        $statuskomisi = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terbayar</span>";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                	<td align="center"><?echo $d1[nonota]?></td>
			                                	<td align="left"><?echo "$dBrg[namabarang] $dBrg[warna]"?></td>
			                                	<td align="center"><?echo $d1[norangka]?></td>
			                                	<td align="left"><?echo $d1[ref]?></td>
			                                	<td align="left"><?echo $d1[notelpref]?></td>
			                                	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[komisi],"0","",".")?></span></td>
			                                	<td align="center"><?echo $statuskomisi?></td>
			                                </tr>
			                           	<?
			                           		}
			                           	?>
			                            </tbody>
			                        </table>
			                        
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>