<?
error_reporting(0);
include "../include/application_top.php";
include "../include/fungsi_indotgl1.php";


$periode_tahun = $_REQUEST[tahun];
$periode_bulan = $_REQUEST[bulan];

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "REKAPITULASI_KOMPENSASI_".$periode_bulan."_".$periode_tahun.".xls";
header("Content-Disposition: attachment; filename=$judul");
 


?>
	<h4>REKAPITULASI KOMPENSASI <?echo "BULAN $periode_bulan TAHUN $periode_tahun"?></h4>
        <table>
			<thead>
				<tr>
					<th style="height:45px;background:#37A58A;color:#fff;">NAMA KARYAWAN</th>
					<th style="height:45px;background:#37A58A;color:#fff;">POSISI</th>
					<th style="height:45px;background:#37A58A;color:#fff;">GAJI POKOK (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">UANG HARIAN (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">KOMISI SERVIS (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">KOMISI JASA (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">KOMISI KEPALA BENGKEL (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">TAMBAHAN (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">POTONGAN (RP)</th> 
					<th style="height:45px;background:#37A58A;color:#fff;">STATUS</th>
				</tr>
			</thead>
            <tbody>
				                <?
												$q2	 = mysql_query("SELECT * FROM x23_kompensasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND idkaryawan IN (SELECT id FROM x23_karyawan WHERE status='AKTIF')");
												while($d2  = mysql_fetch_array($q2))
													{
					                            	if($d2[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Lunas</span>";}
					                            	if($d2[status]=="0"){$status = "<a data-toggle='modal' data-target='#compose-modal-bayar$d2[id]' style='cursor:pointer'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span></a>";}
													
													$dPos = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d2[idkaryawan]'"));
													
													$dNS1x = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
													$dNS2x = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
													$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE jenis='OUTPUT' AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND status='1'"));
													
													$x = round(($dNS1x[total]-($dNS1x[total]*2/100)+$dNS2x[total])/1.1,0);
													$y = round($dOx[total]/$x*100,0);
													
													$g = "0";
													$c = "0";
													$f2 = "0";
						                    		if($dPos[posisi]=="4"){
														$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$d2[idkaryawan]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
														$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$d2[idkaryawan]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
														$d = round(($dNS1[total]-($dNS1[total]*2/100)+$dNS2[total])/1.1,0);
														$e = round($d*$y/100,0);
														$f = $d-$e;
														
							                    		$dB1=mysql_fetch_array(mysql_query("SELECT persenkomisi FROM x23_komsetbruto WHERE omsetbruto <= '$f' ORDER BY omsetbruto DESC LIMIT 1"));
							                    		$g = round($f+($f*$dB1[persenkomisi]/100),0);
							                    		
							                    		$dB2=mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
														$a = round($x*$y/100,0);
														$b = $x-$a;
														
							                    		if($dPos[pangkat]=="KEPALA MEKANIK"){
															$c = round($b*$dB2[kepalamekanik]/100,0);
															}
														}
												
						                    		if($dPos[posisi]=="3" || $dPos[posisi]=="7"){
							                    		$dB2=mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
														$a = round($x*$y/100,0);
														$b = $x-$a;
														if($dPos[posisi]=="3"){$c = round($b*$dB2[sa]/100,0);}
														if($dPos[posisi]=="7"){$c = round($b*$dB2[kepalamekanik]/100,0);}
														}
														
						                    		if($dPos[posisi]=="7")
						                    			{
														$dAX = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																											SUM(diskon) AS b,
																											SUM(total) AS c
																										FROM x23_notajual_det WHERE 
																										substr(tglnota,6,2)='$periode_bulan' AND substr(tglnota,1,4)='$periode_tahun' AND 
																										nonota IN (
																											SELECT nomor FROM x23_kwitansi WHERE 
																											substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND 
																											jnskwitansi IN ('penjualan') AND jumlah>0 AND status='1')"));
																											
														
														mysql_query("TRUNCATE temp_x23_pndharian");
							                            $q1 = mysql_query("SELECT * FROM x23_notaservice WHERE substr(tglnota,6,2)='$periode_bulan' AND substr(tglnota,1,4)='$periode_tahun' AND status='2'");
														while($d1 = mysql_fetch_array($q1))
							                            	{
															$d3 = mysql_fetch_array(mysql_query("SELECT SUM(tarifasli) AS tarifasli, SUM(tarifkpb*0.98) AS tarifkpb, SUM(diskon) AS diskon, SUM(tarif*1.1) AS tarif FROM x23_notaservice_det WHERE nonota='$d1[nonota]'"));
															$d4 = mysql_fetch_array(mysql_query("SELECT SUM(totdiskon) AS totdiskon, SUM(total) AS total FROM x23_notajual_det WHERE nonota='$d1[nonota]'"));
															$hargasli = $d4[total]+$d4[diskon];
															$total = $d3[tarif]+$hargasli+$d3[tarifkpb];
															
															$dcp = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]' AND jnskj='KPB'"));	
															
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
																	}
							                            	}
															
														$dB = mysql_fetch_array(mysql_query("SELECT SUM(a) AS a,
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
																								
														$servis   = $dB[d]-$dB[e];
														
														$dC = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS total FROM x23_claimoli_det WHERE substr(tglservis,6,2)='$periode_bulan' AND substr(tglservis,1,4)='$periode_tahun'"));
																
														$d2x = $dAX[c]+$servis-$dC[total];
														$e2 = round($d2x/1.1,0);
														$f2 = round($e2*0.01,0);
														}
								?>
													
														<tr> 
															<td><?echo $d2[nama]?></td>
															<td><?echo $d2[posisi]?></td>
															<td align='right'><?echo number_format($d2[ugapok],"0","",".")?></td> 
															<td align='right'><?echo number_format($d2[uharian],"0","",".")?></td> 
															<td align='right'><?echo number_format(round($g/2),"0","",".")?></td> 
															<td align='right'><?echo number_format(round($c/2),"0","",".")?></td> 
															<td align='right'><?echo number_format(round($f2/2),"0","",".")?></td> 
															<td align='right'><?echo number_format($d2[utambahan],"0","",".")?></td> 
															<td align='right'><?echo number_format($d2[upotongan],"0","",".")?></td> 
															<td align='center'><?echo $status?></td>
														    <td align='center'>
												<?
														if($d2[status]=='1')
															{
												?>			   
					                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&batal=$d2[id]&idkaryawan=$d2[idkaryawan]"?>">
						                                    	<button type="button" class="btn btn-warning" onclick="return confirm('Batal Bayar?')" style="padding:0 5px 0 5px;">
						                                    		<i class="fa fa-times-circle"></i>
						                                    	</button>
					                                    	</a>
												<?
															}
												?>
						                                     </td>
														</tr>
												<?
													}
												?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10">&nbsp;</th>
                </tr>
            </tfoot>
        </table>