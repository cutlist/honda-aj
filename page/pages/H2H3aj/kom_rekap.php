<?
	include "include/fungsi_indotgl1.php";
	if(!empty($_REQUEST[tahun]) && !empty($_REQUEST[bulan]))
		{
		$periode_tahun = $_REQUEST[tahun];
		$periode_bulan = $_REQUEST[bulan];
		}
	else if(empty($_REQUEST[tahun]) && empty($_REQUEST[bulan]))
		{
		$periode_tahun = date("Y");
		$periode_bulan = date('m');
		}
		
	if(!empty($_REQUEST[reset]))
		{
		mysql_query("DELETE FROM x23_kompensasi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'");
		mysql_query("UPDATE x23_piutang       SET potkompensasi='0' WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI'");
		mysql_query("UPDATE x23_potkompensasi SET potkompensasi='0' WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1' AND metodebayar='GAJI'");
		
		echo "<script>alert ('Proses Reset Periode Bulan $periode_bulan Tahun $periode_tahun Berhasil.')</script>";
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&bulan=$periode_bulan&tahun=$periode_tahun'/>";
		exit();
		}
		
	if(!empty($_REQUEST[bayar]))
		{
		$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
		$ugapok		= preg_replace( "/[^0-9]/", "",$_REQUEST['ugapok']);
		$uharian	= preg_replace( "/[^0-9]/", "",$_REQUEST['uharian']);
		$ulembur	= preg_replace( "/[^0-9]/", "",$_REQUEST['ulembur']);
		$utambahan	= preg_replace( "/[^0-9]/", "",$_REQUEST['utambahan']);
		$upotongan	= preg_replace( "/[^0-9]/", "",$_REQUEST['upotongan']);
		$kservis	= preg_replace( "/[^0-9]/", "",$_REQUEST['kservis']);
		$kjasa		= preg_replace( "/[^0-9]/", "",$_REQUEST['kjasa']);
		$kkplbengkel	= preg_replace( "/[^0-9]/", "",$_REQUEST['kkplbengkel']);
		$total		= $ugapok+$utambahan+$kservis+$kjasa+$kkplbengkel-$upotongan;
		
		mysql_query("UPDATE x23_kompensasi SET 
										ugapok='$ugapok', 
										uharian='$uharian', 
										ulembur='$ulembur', 
										utambahan='$utambahan', 
										upotongan='$upotongan',
										kservis='$kservis',
										kjasa='$kjasa',
										kkplbengkel='$kkplbengkel',
										total='$total',
										tglbayar='$tglbayar',
										status='1'
									WHERE 
										id='$_REQUEST[bayar]'");
										
		mysql_query("UPDATE x23_potkompensasi SET potkompensasi='1' WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$_REQUEST[idkaryawan]' AND status='1' AND metodebayar='GAJI'");
		mysql_query("UPDATE x23_piutang SET       potkompensasi='1' WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$_REQUEST[idkaryawan]' AND status='1' AND metodebayar='GAJI'");
										
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&bulan=$periode_bulan&tahun=$periode_tahun'/>";
		exit();
		}
	
	if(!empty($_REQUEST[batal]))
		{
		$q1 = mysql_query("UPDATE x23_kompensasi SET status='0',tglbayar='',updatex='$updatex' WHERE id='$_REQUEST[batal]'");
		
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_kompensasi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'BATAL BAYAR UANG HARIAN $_REQUEST[batal]')
							");
							
		mysql_query("UPDATE x23_potkompensasi SET potkompensasi='0' WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$_REQUEST[idkaryawan]' AND status='1' AND metodebayar='GAJI'");
		mysql_query("UPDATE x23_piutang       SET potkompensasi='0' WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$_REQUEST[idkaryawan]' AND status='1' AND metodebayar='GAJI'");
		}
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kom_rekaph2h3.php?tahun=<?echo $periode_tahun?>&bulan=<?echo $periode_bulan?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KOMPENSASI <small>REKAPITULASI</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div class="col-xs-7" style="float:right;">
                                    <?
                                    /*
                                    //echo date("Y-m-d",strtotime("$periode_tahun-$periode_bulan"));
                                    if(date("Y-m-d") > date("Y-m-d",strtotime("$periode_tahun-$periode_bulan"))){
										echo "1";
										}
									else{
										echo "2";
										}
									*/
                                    ?>
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px" required="">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px" required="">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&reset=1&bulan=$periode_bulan&tahun=$periode_tahun"?>"><button type="button" onclick="return confirm('Anda Yakin Akan Mengulang Perhitungan Rekapitulasi Kompensasi?')"class="btn btn-warning pull-left"><i class="fa fa-refresh"></i> Hitung Ulang</button></a></td>
                                    			<td width="1%">
                                    				<a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{
                                    if(date("Y-m-d") < date("Y-m-d",strtotime("$periode_tahun-$periode_bulan"))){
										echo "<script>alert ('Periode Ini Belum Dapat Dilakukan Rekapitulasi.')</script>";
										}
									else{
										/*
										if(date("d") != date('t'))
											{
											}
										else if (date("d") != date('t'))
											{
										*/
			                            	$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_kompensasi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' GROUP BY bulan,tahun"));
			                            	
			                           		if(empty($dCek[id]))
		                        				{
		                        					
												/*
					                            $p1 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_notajual_qty WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
					                            $p2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_notajual_qty WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnstransaksi='CASH'"));
					                            $p3 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_notajual_qty WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND jnstransaksi='KREDIT'"));
					                            */
												$q2	 = mysql_query("SELECT * FROM abs_x23_employee");
												while($d2  = mysql_fetch_array($q2))
													{
						                            // HITUNG KOMISI
						                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_user_vw WHERE nik='$d2[EmployeeID]'"));
						                            
													$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
													$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='MANDIRI'))"));
													$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND idsales='$dA[id]' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
											
													// HITUNG UANG HARIAN
													//$dD	= mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_department WHERE DepartmentID='$d2[DepartmentID]'"));
													$dD	 	= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan_vw WHERE nik='$d2[EmployeeID]'"));
						                            $hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE SUBSTR(Scan4,1,4)='$periode_tahun' AND SUBSTR(DATE,6,2)='$periode_bulan' AND EmployeeID='$d2[EmployeeID]'"));
						                            $gaji 		= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$d2[EmployeeID]'"));
						                            $tharian	= $gaji[uharian]*$hadir[total];
															
						                            // HITUNG UANG LEMBUR
						                            $dL 		= mysql_fetch_array(mysql_query("SELECT totulembur FROM x23_uanglembur WHERE tahun='$periode_tahun' AND bulan='$periode_bulan' AND idkaryawan='$dD[id]'"));
						                            
						                            // HITUNG POTONG
						                            $dP1 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dD[id]' AND metodebayar='GAJI' AND status='1'"));
						                            $dP2 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dD[id]' AND metodebayar='GAJI' AND status='1'"));
						                            $totpot		= $dP1[total]+$dP2[total];
						                            
						                            $total		= $gaji[ugapok]+$ict;
													
													$dPos = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$d2[EmployeeID]'"));
													
													$dNS1x = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
													$dNS2x = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
													$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE jenis='OUTPUT' AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun' AND status='1'"));
													
													$x = round(($dNS1x[total]-($dNS1x[total]*2/100)+$dNS2x[total])/1.1,0);
													$y = round($dOx[total]/$x*100,0);
													
													$g = "0";
													$c = "0";
													$f2 = "0";
						                    		if($dPos[posisi]=="4"){
														$dNS1 = mysql_fetch_array(mysql_query("SELECT SUM(hargampm) AS total FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dPos[id]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
														$dNS2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_notaservice_det WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dPos[id]' AND substr(tglselesai,6,2)='$periode_bulan' AND substr(tglselesai,1,4)='$periode_tahun' AND statuskwitansi='1')"));
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
														
						                            mysql_query("INSERT INTO x23_kompensasi (
																					bulan,
																					tahun,
																					nik,
																					idkaryawan,
																					nama,
																					posisi,
																					ugapok,
																					uharian,
																					ulembur,
																					kservis,
																					kjasa,
																					kkplbengkel,
																					utambahan,
																					upotongan,
																					total,
																					inputx)
																				VALUES (
																					'$periode_bulan',
																					'$periode_tahun',
																					'$d2[EmployeeID]',
																					'$dD[id]',
																					'$d2[FirstName] $d2[LastName]',
																					'$dD[posisi]',
																					'$gaji[ugapok]',
																					'$tharian',
																					'$dL[totulembur]',
																					'$g',
																					'$c',
																					'$f2',
																					'0',
																					'$totpot',
																					'$total',
																					NOW())
																			");
													}
												}
											//}
								?>
								
					                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
												<thead>
													<tr>
														<th><center>NAMA KARYAWAN <?//echo date("d").date("t")?></center></th>
														<th><center>POSISI</center></th>
														<th width="9%"><center>GAJI</br>POKOK (RP)</center></th> 
														<th width="9%"><center>UANG</br>HARIAN (RP)</center></th> 
														<th width="9%"><center>KOMISI SERVIS (RP)</center></th> 
														<th width="9%"><center>KOMISI JASA (RP)</center></th> 
														<th width="9%"><center>KOMISI KEPALA BENGKEL (RP)</center></th> 
														<th width="9%"><center>TAMBAHAN (RP)</center></th> 
														<th width="9%"><center>POTONGAN (RP)</center></th> 
														<th width="1%"><center>STATUS</center></th>
			                                    		<th width="1%"><center>BATAL</center></th>
													</tr>
												</thead>
					                            <tbody>
				                <?
												$q2	 = mysql_query("SELECT * FROM x23_kompensasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' AND idkaryawan IN (SELECT id FROM x23_karyawan WHERE status='AKTIF')");
												while($d2  = mysql_fetch_array($q2))
													{
					                            	if($d2[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Lunas</span>";}
					                            	if($d2[status]=="0"){$status = "<a data-toggle='modal' data-target='#compose-modal-bayar$d2[id]' style='cursor:pointer'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span></a>";}
													
								?>
													
														<tr style='font-size:12px'> 
															<td><?echo $d2[nama]?></td>
															<td><?echo $d2[posisi]?></td>
															<td align='right'><?echo number_format($d2[ugapok],"0","",".")?></td> 
															<td align='right'><?echo number_format($d2[uharian],"0","",".")?></td> 
															<td align='right'><?echo number_format(round($d2[kservis]/2),"0","",".")?></td> 
															<td align='right'><?echo number_format(round($d2[kjasa]/2),"0","",".")?></td> 
															<td align='right'><?echo number_format(round($d2[kkplbengkel]/2),"0","",".")?></td> 
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
								<?
										}
			                    ?>
			                    		<div class="clearfix"></div>
					
							    <?
											$q3 = mysql_query("SELECT * FROM x23_kompensasi WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'");
								            while($d3 = mysql_fetch_array($q3))
								            	{
							    ?>
						<!-- ################## MODAL BAYAR ########################################################################################## -->
										        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
										            <div class="modal-dialog" style="width:50%;">
										                <div class="modal-content">
										                    <div class="modal-header">
										                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										                        <h4 class="modal-title">PEMBAYARAN KOMPENSASI <?echo "$d3[FirstName] $d3[LastName]"?></h4>
										                    </div>
															
										                   	<form method="post" action="" enctype="multipart/form-data">
									                        <div class="modal-body">
										                    	<table width="100%">
										                    		<tr>
										                    			<td width="30%">NAMA PELANGGAN</td>
										                    			<td width="2%">:</td>
										                    			<td><input type="text" name="nama" value="<?echo $d3[nama]?>" class="form-control" required="" style="width:80%" readonly=""></td>
										                    		</tr>
										                    		<tr>
										                    			<td>NIK</td>
										                    			<td >:</td>
										                    			<td><input type="text" value="<?echo $d3[nik]?>" class="form-control" required="" style="width:50%" readonly=""></td>
										                    		</tr>
										                    		<tr>
										                    			<td>POSISI</td>
										                    			<td >:</td>
										                    			<td><input type="text" value="<?echo $d3[posisi]?>" class="form-control" required="" style="width:50%" readonly=""></td>
										                    		</tr>
										                    		<tr>
										                    			<td>GAJI POKOK</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="ugapok" value="<?echo number_format($d3[ugapok],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>UANG HARIAN</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="uharian" value="<?echo number_format($d3[uharian],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>KOMISI SERVIS</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="kservis" value="<?echo number_format($d3[kservis],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" onfocus="this.select();" readonly=""> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>KOMISI JASA</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="kjasa" value="<?echo number_format($d3[kjasa],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" onfocus="this.select();" readonly=""> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>KOMISI KEPALA BENGKEL</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="kkplbengkel" value="<?echo number_format($d3[kkplbengkel],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" onfocus="this.select();" readonly=""> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>TAMBAHAN</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="utambahan" value="<?echo number_format($d3[utambahan],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" onfocus="this.select();" required> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>POTONGAN</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon">RP.</span>
										                                        	<input type="text" name="upotongan" value="<?echo number_format($d3[upotongan],'0','','.')?>" style="width:30%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<tr>
										                    			<td>TANGGAL BAYAR</td>
										                    			<td>:</td>
										                    			<td><div class="input-group">
										                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
										                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:30%">
										                                    </div>                                        		
										                                </td>
										                    		</tr>
										                    		<input type="hidden" name="idkaryawan" value="<?echo $d3[idkaryawan]?>">
										                    		<input type="hidden" name="bayar" value="<?echo $d3[id]?>">
										                    		<input type="hidden" name="tahun" value="<?echo $periode_tahun?>">
										                    		<input type="hidden" name="bulan" value="<?echo $periode_bulan?>">
								                            	</table>
										               		</div>
									                        <div class="modal-footer clearfix">
									                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
																<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
										                	</div>
															</form>
										                </div>
										            </div>
										        </div>
					<!-- ################################################################################################################################# -->
					<?
												}
				                	}
				                ?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        <!-- buat angka -->
        <script type="text/javascript">
			function buat_angka(e,teks)
			{
				var goodInput = teks;
				var evt = (e)?e:window.event;
				var key_code = (document.all)?evt.keyCode:evt.which;
				
				if (key_code == 0 || key_code == 8 || key_code == 11 || key_code == 9 || key_code == 13) 
					return true;
				if (goodInput.indexOf(String.fromCharCode(key_code)) == -1)	
					return false;
				else
					return true;
			}
        </script>
        <!-- uang -->
        <script type="text/javascript">
		// memformat angka ribuan
		function formatAngka(angka) {
			 if (typeof(angka) != 'string') angka = angka.toString();
			 var reg = new RegExp('([0-9]+)([0-9]{3})');
			 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			 return angka;
			}
		
		$('.uang').on('keypress', function(e) {
			 var c = e.keyCode || e.charCode;
			 switch (c) {
			  case 8: case 9: case 27: case 13: return;
			  case 65:
			   if (e.ctrlKey === true) return;
			 }
			 if (c < 48 || c > 57) e.preventDefault();
			})
			.on('keyup', function() {
			 var inp = $(this).val().replace(/\./g, '');
		  
			 $(this).val(formatAngka(inp));
			});
		</script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>
        <script>
        //SELECT2
			$(function(){
			           
			  /* dropdown and filter select */
			  var select = $('#select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
		</script>
        <!-- datemask -->
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

            });
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();

        </script>