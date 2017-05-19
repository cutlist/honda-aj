<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
				                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
											
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "PENAGIHAN_KPB.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
<h4>PENAGIHAN KPB KE MPM PERIODE TANGGAL KPB <?echo date("d-m-Y",strtotime($periode_awal))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($periode_akhir))?></h4>
			                        	<table id="example2" class="table table-bordered table-striped" style="min-width:150%">
											<thead>
												<tr>
													<th style="height:45px;background:#37A58A;color:#fff;">TANGGAL KPB</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NO NOTA SERVIS</th>
													<th style="height:45px;background:#37A58A;color:#fff;">JENIS KPB</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
													<th style="height:45px;background:#37A58A;color:#fff;">NAMA MEKANIK</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS TAGIHAN KE MPM</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL PENAGIHAN KE MPM</th>
													<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH TAGIHAN (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH TAGIHAN (-2%) (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">STATUS PEMBAYARAN KPB</th>
													<th style="height:45px;background:#37A58A;color:#fff;">TGL PEMBAYARAN KPB</th>
													<th style="height:45px;background:#37A58A;color:#fff;">JUMLAH YANG DIBAYAR (RP)</th>
													<th style="height:45px;background:#37A58A;color:#fff;">KETERANGAN TOLAK</th>
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            
				                            
											$qA = mysql_query("SELECT * FROM x23_penagihankpb WHERE tglkpb BETWEEN '$periode_awal' AND '$periode_akhir' AND nonotaservis!=''");
											$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE tglkpb BETWEEN '$periode_awal' AND '$periode_akhir' AND nonotaservis!=''");
											while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
				                            	$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
				                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$d1[kodepaket]'"));
				                            	
				                            	
				                            	if($d1[statuspenagihan]=='0'){
							                        $statustagihan = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Tertagih</span>";
							                        $tglpembayaran = "";
							                        $tglpenagihan = "";
													$statuspembayaran = "";
													}
												if($d1[statuspenagihan]=='1')
													{
							                        $statustagihan = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Sudah Tertagih</span>";
							                        $tglpenagihan = date("d-m-Y",strtotime($d1[tglpenagihan]));
													if(empty($d1[statuspembayaran]))
														{
														$statuspembayaran = "<a data-toggle='modal' data-target='#compose-modal-tglbayarkpb1$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
														$tglpembayaran = "";
														}
													if($d1[statuspembayaran]=="DITOLAK")
														{
														if($d1[tagihkembali]=="TIDAK")
															{
															$statuspembayaran = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Ditolak</span>";
															$tglpembayaran = "";
															}
														if($d1[tagihkembali]=="YA")
															{
															$statuspembayaran = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:150px'>Tagih Kembali</span>";
															$tglpembayaran = "";
															}
														}
													if($d1[statuspembayaran]=="TERBAYAR")
														{
														$statuspembayaran = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:150px'>Sudah Terbayar</span>";
								                        $tglpembayaran = date("d-m-Y",strtotime($d1[tglpembayaran]));
														}
													}
													
												$pot = round($d1[hargampm] * 0.02 , 0);
												$hargapot = $d1[hargampm]-$pot;
													
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglkpb]))?></td>
				                                	<td align="left"><?echo $d1[nonotaservis]?></td>
				                                	<td align="left"><?echo $d5[nama]?></td>
				                                	<td align="left"><?echo $d3[nama]?></td>
				                                	<td align="left"><?echo $d4[nama]?></td>
				                                	<td align="center"><?echo $statustagihan?></td>
				                                	<td align="center"><?echo $tglpenagihan?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahtagih],"0","",".")?></span></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahtagih2],"0","",".")?></span></td>
				                                	<td align="center"><?echo $statuspembayaran?></td>
				                                	<td align="center"><?echo $tglpembayaran?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahbayar],"0","",".")?></span></td>
				                                	<td align="left"><?echo $d1[kettolak]?></td>
				                                	<td width="1%" align="center">
														<?if($_SESSION[posisi]=='DIREKSI'){
															if(!empty($d1[statuspembayaran])){
														?>
															<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&reset=1&id=$d1[id]&periode=$_REQUEST[periode]"?>" style="cursor:pointer"><i class="fa fa-refresh"></i></a>
					                                	<?}}?>
				                                	</td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <td colspan="8">&nbsp;</td>
				                                </tr>
				                            </tfoot>
				                        </table>
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>