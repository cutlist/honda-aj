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
	<h4>LAPORAN RINGKASAN SERVIS PERIODE TANGGAL NOTA SERVIS <?echo date("d-m-Y",strtotime($_SESSION[periode_awal]))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($_SESSION[periode_akhir]))?></h4>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:650%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="41" style="background:#37A58A;color:#fff;"><b>RINGKASAN SERVIS</b></td>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">TGL NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS JR</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS SEBELUMNYA</th>
												<th style="background:#37A58A;color:#fff;">NO PKB</th>
												<th style="background:#37A58A;color:#fff;">NO POLISI PELANGGAN</th>
												<th style="background:#37A58A;color:#fff;">NAMA PELANGGAN</th>
												<th style="background:#37A58A;color:#fff;">NO. OHC</th> 
												<th style="background:#37A58A;color:#fff;">KODE MOTOR</th> 
												<th style="background:#37A58A;color:#fff;">NAMA MOTOR</th> 
												<th style="background:#37A58A;color:#fff;">VARIAN MOTOR</th> 
												<th style="background:#37A58A;color:#fff;">TAHUN MOTOR</th> 
												<th style="background:#37A58A;color:#fff;">WAKTU MASUK SERVIS</th> 
												<th style="background:#37A58A;color:#fff;">WAKTU MULAI SERVIS</th> 
												<th style="background:#37A58A;color:#fff;">WAKTU SELESAI SERVIS</th> 
												<th style="background:#37A58A;color:#fff;">WAKTU SERVIS</th> 
												<th style="background:#37A58A;color:#fff;">NAMA MEKANIK</th>
												<th style="background:#37A58A;color:#fff;">JENIS SERVIS</th>
												<th style="background:#37A58A;color:#fff;">KELOMPOK SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. KPB</th>
												<th style="background:#37A58A;color:#fff;">KODE SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NAMA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">HARGA JUAL JASA SEBELUM DISKON (RP)</th> 
												<th style="background:#37A58A;color:#fff;">DISKON JASA (RP)</th> 
												<th style="background:#37A58A;color:#fff;">HARGA JUAL JASA SETELAH DISKON (RP)</th>
												<th style="background:#37A58A;color:#fff;">KODE BARANG</th>
												<th style="background:#37A58A;color:#fff;">NAMA BARANG</th>
												<th style="background:#37A58A;color:#fff;">VARIAN</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA BELI</th>
												<th style="background:#37A58A;color:#fff;">QTY JUAL</th>
												<th style="background:#37A58A;color:#fff;">HARGA JUAL BARANG SEBELUM DISKON (RP)</th> 
												<th style="background:#37A58A;color:#fff;">DISKON BARANG (RP)</th> 
												<th style="background:#37A58A;color:#fff;">HARGA JUAL BARANG SETELAH DISKON (RP)</th>
												<th style="background:#37A58A;color:#fff;">JUMLAH JUAL BARANG SETELAH DISKON (RP)</th>
												<th style="background:#37A58A;color:#fff;">STATUS PEMBAYARAN</th> 
												<th style="background:#37A58A;color:#fff;">NO. KWITANSI PEMBAYARAN</th> 
												<th style="background:#37A58A;color:#fff;">TOTAL JUMLAH PENJUALAN (RP)</th> 
												<th style="background:#37A58A;color:#fff;">TOTAL JUMLAH PENJUALAN (PEMBULATAN) (RP)</th> 
												<th style="background:#37A58A;color:#fff;">NAMA COUNTER PART</th> 
												<th style="background:#37A58A;color:#fff;">SISA STOK</th> 
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            mysql_query("TRUNCATE temp_x23_abisservis");
										
										$no = 1;
										$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{											
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]' AND kpbke!=''"));
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											
											$mulai   = mktime(date("H",strtotime($d1[jammulai])), date("i",strtotime($d1[jammulai])), date("s",strtotime($d1[jammulai])), date("m",strtotime($d1[tglnota])), date("d",strtotime($d1[tglnota])), date("Y",strtotime($d1[tglnota])));
											$selesai = mktime(date("H",strtotime($d1[jamselesai])), date("i",strtotime($d1[jamselesai])), date("s",strtotime($d1[jamselesai])), date("m",strtotime($d1[tglselesai])), date("d",strtotime($d1[tglselesai])), date("Y",strtotime($d1[tglselesai])));
											
											$selisih_waktu = $selesai-$mulai;
											$jumlah_hari = floor($selisih_waktu/86400);
											if($jumlah_hari=="0"){
												$hari = "";
												}
											if($jumlah_hari!="0"){
												$hari = "$jumlah_hari Hari";
												}

											//Untuk menghitung jumlah dalam satuan jam:
											$sisa = $selisih_waktu % 86400;
											$jumlah_jam = floor($sisa/3600);
											if($jumlah_jam=="0"){
												$jam = "";
												}
											if($jumlah_jam!="0"){
												$jam = "$jumlah_jam Jam";
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
												$durasi = "$hari $jam $jumlah_menit Menit";
												}
												
											$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
											
											if(!empty($d2[id])){
												$kelompokservis = "MAIN DEALER (KPB)";
												}
											else{
												$kelompokservis = "KONSUMEN (NON KPB)";
												}
												
											$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE nomor='$d1[nonota]'"));
											if($d5[status]=="1"){
												$statuspembayaran = "SUDAH TERBAYAR";
												$nokwitansi = $d5[nokwitansi];
												$jumlahpenjualan = number_format(($d5[jumlah]),"0","",".");
												$pembulatan= number_format(($d5[pembulatan]),"0","",".");
												$qtykwitansi = "1";
												}
											else{
												$statuspembayaran = "BELUM TERBAYAR";
												$nokwitansi = "";
												$jumlahpenjualan = "";
												$pembulatan = "";
												$qtykwitansi = "0";
												}
												
											$d6 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d1[iduser]'"));
											$d7 = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE noantrian='$d1[noantrian]' AND tanggal='$d1[tglnota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?if(empty($d1[noclaim])){echo "-";}else{echo $d1[noclaim];}?></td>
			                                    <td align=""><?if(empty($d1[noservis])){echo "-";}else{echo $d1[noservis];}?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $d1[nopkb]?></span></td>
			                                    <td align=""><?echo $d1[nopol]?></td>
			                                    <td align=""><?echo $d3[nama]?></td>
			                                    <td align=""><?if(empty($d3[ohc])){echo "-";}else{echo $d3[ohc];}?></td>
			                                    <td align=""><?echo $d1[kodemotor]?></td>
			                                    <td align=""><?echo $d1[tipemotor]?></td>
			                                    <td align=""><?echo $d1[varianmotor]?></td>
			                                    <td align="center"><?echo $d1[tahunmotor]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d7[tanggal]))." / $d7[jam]"?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))." / $d1[jammulai]"?></td>
			                                    <td align="center">
			                            <?
			                            		if($d1[tglselesai]!="0000-00-00")
			                            			{
													echo date("d-m-Y",strtotime($d1[tglselesai]))." / $d1[jamselesai]";
													}
												else{
													echo "- / -";
													}
			                            ?>
			                                    </td>
			                                    <td align="right"><span style="padding-right:0%"><?echo $durasi?></span></td>
			                                    <td align=""><?echo $d4[nama]?></td>
			                                    <td align=""><?echo $d1[jns]?></td>
			                                    <td align=""><?echo $kelompokservis?></td>
			                                    <td align="center"><?if(empty($d2[kpbke])){echo "-";}else{echo $d2[kpbke];}?></td>
			                                    <td>
				                                <?
				                                $hit = 1;
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
						                        ?>
						                                    <?echo $dA[kodepaket]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                                
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                    <?echo $dB[kodejasa]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
														}
													$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
						                            	if(!empty($dB[kpbke]))
						                            		{
															$kpbke = "KPB KE $dB[kpbke] - ";
															}
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
						                        ?>
						                                    <?echo $kpbke.$dB[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                                
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                    <?echo $dB[namajasa]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
														}
													$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
													$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[diskon],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
							                            	mysql_query("INSERT INTO temp_x23_abisservis (diskon1) VALUES ('$dA[diskon]')");
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[tarif],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?							                            		
															if($d5[status]=="1"){
							                            		mysql_query("INSERT INTO temp_x23_abisservis (tjsemua1A) VALUES ('$dA[tarif]')");
							                            		}				                            		
															if($d5[status]=="0"){
							                            		mysql_query("INSERT INTO temp_x23_abisservis (tjsemua1B) VALUES ('$dA[tarif]')");
							                            		}
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
						                                    <?echo $dA[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
						                                    <?echo $dA[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
						                                    <?echo $dA[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
						                                    <?echo $dA[notabeli]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
													$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$dA[notabeli]'"));
						                        ?>
						                                    <?echo date("d-m-Y",strtotime($dNbl[tglnota]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[qty],"0","",".")?> PCS</span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
							                				mysql_query("INSERT INTO temp_x23_abisservis (qty) VALUES ('$dA[qty]')");
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[hargajual],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[diskon],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            			$tdiskon = $dA[diskon]*$dA[qty];
							                            	mysql_query("INSERT INTO temp_x23_abisservis (diskon2) VALUES ('$tdiskon')");
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[hargajualbersih],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[total],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
															if($d5[status]=="1"){
							                            		mysql_query("INSERT INTO temp_x23_abisservis (tjsemua2A) VALUES ('$dA[total]')");
							                            		}				                            		
															if($d5[status]=="0"){
							                            		mysql_query("INSERT INTO temp_x23_abisservis (tjsemua2B) VALUES ('$dA[total]')");
							                            		}
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
				                                </td>
			                                    <td align=""><?echo $statuspembayaran?></td>
			                                    <td align=""><?if(empty($nokwitansi)){echo "-";}else{echo $nokwitansi;}?></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($jumlahpenjualan)){echo "-";}else{echo $jumlahpenjualan;}?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($pembulatan)){echo "-";}else{echo $pembulatan;}?></span></td>
			                                    <td align=""><?echo $d6[nama]?></td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
													$dB = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE idbarang='$dA[idbarang]' GROUP BY idbarang"));
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dB[stok],"0","",".")?> PCS</span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	$hit++;
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                </tr>
			                                
			                            <?
							                mysql_query("INSERT INTO temp_x23_abisservis (qtykwitansi) VALUES ('$qtykwitansi')");
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