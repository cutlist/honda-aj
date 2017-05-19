<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
if(empty($_REQUEST[periode])){
            $periode_awal  = date("Y-m-d");
            $periode_akhir = date("Y-m-d");
}
else{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
}
										
$judul = "PENDAPATAN_HARIAN_PERIODE_$periode_awal-$periode_akhir.xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
<h4>PENDAPATAN HARIAN SERVIS PERIODE TANGGAL NOTA SERVIS <?echo date("d-m-Y",strtotime($periode_awal))?> SAMPAI DENGAN <?echo date("d-m-Y",strtotime($periode_akhir))?></h4>
			                        <table id="example2" class="table table-bordered table-striped" style="width:160%">
										<thead>
											<tr>
												<th rowspan="2" colspan="7" style="background:#37A58A;color:#fff;"></th>
												<th colspan="10" style="background:#37A58A;color:#fff;">PEMBAYARAN</th>
												<th rowspan="3" style="background:#37A58A;color:#fff;">TOTAL (RP)</th>
											</tr>
											<tr>
												<th colspan="5" style="background:#37A58A;color:#fff;">KONSUMEN</th>
												<th colspan="5" style="background:#37A58A;color:#fff;">MAIN DEALER</th>
											</tr>
											<tr>
												<th style="background:#37A58A;color:#fff;">NO.</th>
												<th style="background:#37A58A;color:#fff;">TGL NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. NOTA SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NO. PKB</th>
												<th style="background:#37A58A;color:#fff;">NO. POLISI</th>
												<th style="background:#37A58A;color:#fff;">WAKTU SERVIS</th>
												<th style="background:#37A58A;color:#fff;">NAMA MEKANIK</th>
												<th style="background:#37A58A;color:#fff;">JASA (RP)</th>
												<th style="background:#37A58A;color:#fff;">DISKON JASA (RP)</th>
												<th style="background:#37A58A;color:#fff;">JASA + PPN (RP)</th>
												<th style="background:#37A58A;color:#fff;">PART (RP)</th>
												<th style="background:#37A58A;color:#fff;">DISKON PART (RP)</th>
												<th style="background:#37A58A;color:#fff;">JASA (RP)</th>
												<th style="background:#37A58A;color:#fff;">JASA (- 2%) (RP)</th>
												<th style="background:#37A58A;color:#fff;">DISKON JASA (RP)</th>
												<th style="background:#37A58A;color:#fff;">PART (RP)</th>
												<th style="background:#37A58A;color:#fff;">DISKON PART (RP)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
			                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            $no=1;
										mysql_query("TRUNCATE temp_x23_pndharian");
										if(empty($_REQUEST[periode]))
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND tglnota=CURDATE() AND status='2'");
											}
										else
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND status='2'");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
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
											
											$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id%2=0 AND id='$d1[idmekanik]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT SUM(tarifasli) AS tarifasli, SUM(tarifkpb*0.98) AS tarifkpb, SUM(diskon) AS diskon, SUM(tarif*1.1) AS tarif FROM x23_notaservice_det WHERE id%2=0 AND nonota='$d1[nonota]'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT SUM(totdiskon) AS totdiskon, SUM(total) AS total FROM x23_notajual_det WHERE id%2=0 AND nonota='$d1[nonota]'"));
											$hargasli = $d4[total]+$d4[diskon];
											
											$total = $d3[tarif]+$hargasli+$d3[tarifkpb];
											
											$dcp = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice_det1_vw WHERE id%2=0 AND nonota='$d1[nonota]' AND jnskj='KPB'"));	
											
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right:20%"><?echo "$no."?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?echo $d1[nopkb]?></td>
			                                    <td align=""><?echo $d1[nopol]?></td>
			                                    <td align="right"><span style="padding-right:0%"><?echo "$hari $jam $jumlah_menit Menit"?></span></td>
			                                    <td align=""><?echo $d2[nama]?></td>
										<?
												if(empty($dcp[id]))
													{
													mysql_query("INSERT INTO temp_x23_pndharian (a,b,c,d,e,x) VALUES (
																										'$d3[tarifasli]',
																										'$d3[diskon]',
																										'$d3[tarif]',
																										'$hargasli',
																										'$d4[totdiskon]',
																										$total)
																");
										?>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifasli],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarif],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($hargasli,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d4[totdiskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
				                                    <td align="right"><span style="padding-right:20%">0</span></td>
										<?
													}
												if(!empty($dcp[id]))
													{
													mysql_query("INSERT INTO temp_x23_pndharian (a,b,c,d,e,f,x) VALUES (
																										'$d3[tarifasli]',
																										'$d3[diskon]',
																										'$d3[tarif]',
																										'$hargasli',
																										'$d4[totdiskon]',
																										'$d3[tarifkpb]',
																										$total)
																");
										?>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifasli],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarif],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($hargasli,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d4[totdiskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifkpb]/0.98,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[tarifkpb],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format(0,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format(0,"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format(0,"0","",".")?></span></td>
										<?
													}
										?>
				                                <td align="right"><span style="padding-right:20%"><?echo number_format($total,"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
											
										$dA = mysql_fetch_array(mysql_query("SELECT SUM(a) AS a,
																					SUM(b) AS b,
																					SUM(c) AS c,
																					SUM(d) AS d,
																					SUM(e) AS e,
																					SUM(f) AS f,
																					SUM(g) AS g,
																					SUM(h) AS h,
																					SUM(i) AS i,
																					SUM(j) AS j,
																					SUM(x) AS x
																				FROM temp_x23_pndharian"));
																				
										$konsumen   = $dA[c]+$dA[d];
										$maindealer = $dA[f];
										
										//$pot = ROUND($dA[e]*0.02,0);
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="20"></th>
			                                </tr>
			                                <tr>
			                                    <td colspan="7" style="text-align:center;font-weight:bold">GRAND TOTAL (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[a],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[b],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[c],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[d],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[e],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[f]/0.98,"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[f],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[g],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[h],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[i],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[x],"0","",".")?></span></td>
			                                </tr>
			                                <!--
			                                <tr>
			                                    <td colspan="6" style="text-align:center;font-weight:bold">GRAND TOTAL - 2% (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
												
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[e]-$pot,"0","",".")?></span></td>
												
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold">-</span></td>
			                                </tr>
			                                -->
			                                <tr>
			                                    <td colspan="7" style="text-align:center;font-weight:bold">TOTAL PENDAPATAN BENGKEL JASA & PART (RP) : </td>
			                                    <td colspan="5" align="center"><span style="padding-right:0%;font-weight:bold"><?echo number_format($konsumen,"0","",".")?></span></td>
			                                    <td colspan="5" align="center"><span style="padding-right:0%;font-weight:bold"><?echo number_format($maindealer,"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[x],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        <?
			                        unset ($_SESSION[periode_awal]);
			                        unset ($_SESSION[periode_akhir]);
			                        ?>