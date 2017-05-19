<?
error_reporting(0);
include "../../include/application_top.php";
include "../../include/fungsi_indotgl1.php";


// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$tgl = date("Ymd");
$judul = "KOMPENSASI_RINCIAN.xls";
header("Content-Disposition: attachment; filename=$judul");
 
$dnk = mysql_fetch_array(mysql_query("SELECT id,nama FROM x23_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));

		$periode_tahun1 = $_REQUEST[tahun1];
		$periode_bulan1 = $_REQUEST[bulan1];
		$periode_tahun2 = $_REQUEST[tahun2];
		$periode_bulan2 = $_REQUEST[bulan2];

	                            $start 		= date("$_REQUEST[tahun1]-$_REQUEST[bulan1]-01");
	                            $end		= date("$_REQUEST[tahun2]-$_REQUEST[bulan2]-01");;
								$timeStart 	= strtotime($start);
								$timeEnd 	= strtotime($end);
								// Menambah bulan ini + semua bulan pada tahun sebelumnya
								$numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
								// menghitung selisih bulan
								$numBulan += date("m",$timeEnd)-date("m",$timeStart);
?>
	<h4>KOMPENSASI RINCIAN H2H3<br>
	NAMA KARYAWAN : <?echo $dnk[nama]?><br>
	BULAN AWAL/TAHUN AWAL : <?echo "$_REQUEST[bulan1] / $_REQUEST[tahun1]"?><br>
	BULAN AWAL/TAHUN AKHIR : <?echo "$_REQUEST[bulan2] / $_REQUEST[tahun2]"?></h4>
    <table>
        <thead>
			<tr>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">BULAN</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">TAHUN</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">GAJI POKOK (RP)</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">UANG HARIAN (RP)</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">KOMISI SERVIS (RP)</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">KOMISI JASA (RP)</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">KOMISI KEPALA BENGKEL (RP)</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">TAMBAHAN (RP)</th>
			                    			<th style="height:45px;background:#37A58A;color:#fff;">POTONGAN (RP)</th>
			</tr>
        </thead>
		<tbody>
			                    		
	                            <?
		                            	for($selisihbulan = 1; $selisihbulan <= $numBulan; $selisihbulan++) 
		                            		{
		                            		$periode_bulan 	= $periode_bulan1-1+$selisihbulan;
		                            		if($periode_bulan > 12){
												$periode_tahun = $periode_tahun1+1;
												$periode_bulan = $periode_bulan-12;
												}
											else{
												$periode_tahun = $periode_tahun1;
												$periode_bulan = $periode_bulan;
												}
												
			            					if(strlen($periode_bulan)==1){
												$periode_bulan = "0".$periode_bulan;
												}
			            					else{
												$periode_bulan = $periode_bulan;
												}
											
											//echo "$periode_bulan $periode_tahun</br>";
		                            		
				                            $dBln = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bulan WHERE angkabln='$periode_bulan'"));
				                            
				                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
				                            
				                            $hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE SUBSTR(Scan4,1,4)='$periode_tahun' AND SUBSTR(DATE,6,2)='$periode_bulan' AND EmployeeID='$_REQUEST[EmployeeID]'"));
				                            $gaji 		= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
				                            $tharian	= $gaji[uharian]*$hadir[total]; 
				                            
				                            // HITUNG UANG LEMBUR
				                            $dL 		= mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS totulembur FROM x23_uanglembur WHERE tahun='$periode_tahun' AND bulan='$periode_bulan' AND idkaryawan='$dA[id]'"));
				                            
				                            // HITUNG POTONG
				                            $dP1 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[id]' AND metodebayar='GAJI' AND status='1'"));
				                            $dP2 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[id]' AND metodebayar='GAJI' AND status='1'"));
				                            $totpot		= $dP1[total]+$dP2[total];
				                            
				                            // HITUNG TAMBAHAN
											$dTt = mysql_fetch_array(mysql_query("SELECT * FROM x23_kompensasi WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND idkaryawan='$dA[id]'"));
			                    		
											$dNS1x = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
											$dNS2x = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
											$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE jenis='OUTPUT' AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND status='1'"));
											
											$x = round(($dNS1x[total]-($dNS1x[total]*2/100)+$dNS2x[total])/1.1,0);
											$y = round($dOx[total]/$x*100,0);
											
				                    		if($dA[posisi]=="4")
				                    			{
												$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dA[id]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
												$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dA[id]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
												$d = round(($dNS1[total]-($dNS1[total]*2/100)+$dNS2[total])/1.1,0);
												$e = round($d*$y/100,0);
												$f = $d-$e;
												
					                    		$dB1=mysql_fetch_array(mysql_query("SELECT persenkomisi FROM x23_komsetbruto WHERE omsetbruto <= '$f' ORDER BY omsetbruto DESC LIMIT 1"));
					                    		$g = round($f+($f*$dB1[persenkomisi]/100),0);
					                    		
					                    		$dB2=mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
												$a = round($x*$y/100,0);
												$b = $x-$a;
												
					                    		if($dA[pangkat]=="KEPALA MEKANIK"){
													$c = round($b*$dB2[kepalamekanik]/100,0);
													}
												}
												
				                    		if($dA[posisi]=="3" || $dA[posisi]=="7")
				                    			{
					                    		$dB2=mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
												$a = round($x*$y/100,0);
												$b = $x-$a;
												if($dA[posisi]=="3"){$c = round($b*$dB2[sa]/100,0);}
												if($dA[posisi]=="7"){$c = round($b*$dB2[kepalamekanik]/100,0);}
												
					                    		if($dA[posisi]=="7")
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
															
													$d2 = $dAX[c]+$servis-$dC[total];
													$e2 = round($d2/1.1,0);
													$f2 = round($e2*0.01,0);
													}
												}
								?>
				                    		
			                                <tr style="cursor:pointer">
				                    			<td><?echo $dBln[namabln]?></td>
				                    			<td><?echo $periode_tahun?></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($gaji[ugapok],"0","",".")?></span></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($tharian,"0","",".")?></span></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($g,"0","",".")?></span></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($c,"0","",".")?></span></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($f2,"0","",".")?></span></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($dTt[utambahan],"0","",".")?></span></td>
				                    			<td align="right"><span style="padding-right:10%"><?echo number_format($totpot,"0","",".")?></span></td>
				                    		</tr>
				                <?
											}
								?>
        </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th></th>
			                                </tr>
			                            </tfoot>
    </table>
			                        