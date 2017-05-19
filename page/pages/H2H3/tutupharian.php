<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[del]))
				{
				$q1 = mysql_query("DELETE FROM x23_tutupharian WHERE id='$_REQUEST[del]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_tutupharian',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS TUTUP HARIAN HARIAN ID $_REQUEST[del]')
									");
				
				
				if($q1 && $q2)
					{
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>KASIR <small>TUTUP HARIAN</small></h4>
                                    <div style="float:left;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Tutup Harian" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
		                           	<div style="float:right" class="col-xs-6">
									<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL'){
									?>
                           					<button type="button"  onclick="window.open('print/h2/tutupharian.php?periode_awal=<?echo $_SESSION[periode_awal]?>&periode_akhir=<?echo $_SESSION[periode_akhir]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
                           			<?
                           					}
											
									$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_tutupharian WHERE tanggal=CURDATE()"));	
									if(empty($dCek[id])){
                                    ?>
											<a data-toggle="modal" data-target="#compose-modal-baru-jasa" style="cursor:pointer">
		                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Tutup Hari Ini</button>
											</a>
		                           	<?
		                           		}
		                           	?>
		                           	</div>
									
			                        <table id="example1" class="table table-bordered table-striped" style="width:220%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">TGL TUTUP HARIAN</th>
			                                    <th style="padding:7px" width="">TOTAL PENERIMAAN JASA + PPN (TIDAK TERMASUK KPB) (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL KPB (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PENERIMAAN JASA + PPN (TERMASUK KPB) (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PENGELUARAN H2H3 (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL NOTA KECIL (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PENJUALAN S. PART (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PENJUALAN S. PART MPM (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PEMBULATAN (SERVIS DAN PENJUALAN) (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL BIAYA HO (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL UANG MUKA INDENT (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PELUNASAN INDENT (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL PENGEMBALIAN KELEBIHAN BAYAR (RP)</th>
			                                    <th style="padding:7px" width="">JUMLAH + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            
										if(!empty($_REQUEST[periode]))
											{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
				                            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											}
										else
											{
				                            $_SESSION[periode_awal]  = date("Y-m-d");
				                            $_SESSION[periode_akhir] = date("Y-m-d");
											}
										$q1 = mysql_query("SELECT * FROM x23_tutupharian WHERE tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[penerimaan]-$d1[kpb],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[kpb],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[penerimaan],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[pengeluaran],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[notakecil],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[pjs],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[pjmpm],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[pembulatan],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[ho],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[um],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[pelunasan],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[pengembalian],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
												<!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
												-->
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
			            <?
						if(!empty($_REQUEST[input]))
							{
							$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_tutupharian WHERE tanggal=CURDATE()"));	
							if(!empty($dCek[id]))
								{
								echo "<script>alert ('Periode Hari Ini ".date("d-m-Y")." Sudah Tutup Harian.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
								
							$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_penagihankpb WHERE tglpenagihan=CURDATE() AND statuspenagihan='0'"));	
							if(!empty($dCek2[id]))
								{
								echo "<script>alert ('Periode Hari Ini ".date("d-m-Y")." Masih Ada KPB Yang Belum Dibuat Tagihannya.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
								
							$dCek3 = mysql_fetch_array(mysql_query("SELECT id FROM x23_tutupservis WHERE tanggal=CURDATE()"));	
							if(empty($dCek3[id]))
								{
								echo "<script>alert ('Periode Hari Ini ".date("d-m-Y")." Belum Tutup Servis.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
								
							$dCek4 = mysql_fetch_array(mysql_query("SELECT id FROM x23_kwitansi_vw WHERE jnskwitansi='penjualan' AND status='0'"));	
							if(!empty($dCek4[id]))
								{
								echo "<script>alert ('Masih Ada Kwitansi Penjualan Yang Belum Dicetak.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
								
							$dCek5 = mysql_fetch_array(mysql_query("SELECT id FROM x23_kwitansi_vw WHERE jnskwitansi='indent' AND status='0'"));	
							if(!empty($dCek5[id]))
								{
								echo "<script>alert ('Masih Ada Kwitansi Indent Yang Belum Dicetak.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
								exit();
								}
							
							$tahun = date("Y");
							$bulan = date("m");
							$penerimaan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['penerimaan']);
							$kpb 			= preg_replace( "/[^0-9]/", "",$_REQUEST['kpb']);
							$pengeluaran 	= preg_replace( "/[^0-9]/", "",$_REQUEST['pengeluaran']);
							$notakecil 		= preg_replace( "/[^0-9]/", "",$_REQUEST['notakecil']);
							$pjs 			= preg_replace( "/[^0-9]/", "",$_REQUEST['pjs']);
							$pjmpm 			= preg_replace( "/[^0-9]/", "",$_REQUEST['pjmpm']);
							$ho 			= preg_replace( "/[^0-9]/", "",$_REQUEST['ho']);
							$pembulatan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['pembulatan']);
							$um 			= preg_replace( "/[^0-9]/", "",$_REQUEST['um']);
							$pelunasan 		= preg_replace( "/[^0-9]/", "",$_REQUEST['pelunasan']);
							$pengembalian 	= preg_replace( "/[^0-9]/", "",$_REQUEST['pengembalian']);
							$jumlah 		= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
										
							$q1 = mysql_query("INSERT INTO x23_tutupharian (
																		tahun,
																		bulan,
																		tanggal,
																		penerimaan,
																		kpb,
																		pengeluaran,
																		notakecil,
																		pjs,
																		pjmpm,
																		ho,
																		pembulatan,
																		um,
																		pelunasan,
																		pengembalian,
																		jumlah,
																		iduser,
																		inputx)
																	VALUES (
																		'$tahun', 
																		'$bulan', 
																		CURDATE(), 
																		'$penerimaan', 
																		'$kpb', 
																		'$pengeluaran', 
																		'$notakecil', 
																		'$pjs', 
																		'$pjmpm', 
																		'$ho', 
																		'$pembulatan', 
																		'$um', 
																		'$pelunasan', 
																		'$pengembalian', 
																		'$jumlah',
																		'$_SESSION[id]',
																		CURDATE())
												");
												
							$p_tahun = date("Y");
							$p_bulan = date("m");
							$tglttp = date("d-m-Y");
							$idtutupharian = mysql_insert_id();
							mysql_query("INSERT INTO x23_abis_dkonfirmasi (
															idtutupharian, 
															tahun, 
															bulan, 
															tanggal,
															kasus, 
															tbl,
															inputx) 
														VALUES (
															'$idtutupharian', 
															'$p_tahun', 
															'$p_bulan', 
															CURDATE(), 
															'TUTUP HARIAN TANGGAL $tglttp : JUMLAH + PPN = RP. $_REQUEST[jumlah]', 
															'x23_tutupharian', 
															NOW())
										");
						
							$q2 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'x23_tutupharian',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'TAMBAH TUTUP HARIAN')
												");
									
							if($_SESSION[posisi]=='DIREKSI'){
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
								exit();
								}
							else
								{
								session_destroy();
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
								exit();
								}
							}
							
			            $dA1 = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws5a WHERE tglnota=CURDATE()"));
			            //$dA2 = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws5b WHERE tglnota=CURDATE()"));
			            $dB1 = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1a WHERE tglnota=CURDATE()"));
						
			            $dH1 = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws_pjmpm WHERE tglnota=CURDATE()"));
			            //$dB2 = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1b WHERE tglnota=CURDATE()"));
			            
			            //$dA  = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND nomor IN (SELECT nonota FROM x23_notajual_det_ws5 WHERE tglnota=CURDATE()) AND status='1'"));
			            //$dB1 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jumlah>'0'  AND nomor IN (SELECT nonota FROM x23_notajual_det_ws1 WHERE tglnota=CURDATE())  AND status='1'"));
			            //$dB3 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jumlah<'0'  AND nomor IN (SELECT nonota FROM x23_notajual_det_ws1 WHERE tglnota=CURDATE())  AND status='1'"));
			            //$dB2 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND nomor IN (SELECT notaindent FROM x23_notajual_det_ws1 WHERE tglnota=CURDATE())  AND status='1'"));
			           
			            //$dC  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('servis') AND status='1'"));
			            //$dC  = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total1,SUM(jumlah) AS total1, FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('servis') AND status='1'"));
			            
			            $dC1 = mysql_fetch_array(mysql_query("SELECT *,SUM(tarifppn) AS total FROM x23_servis_th WHERE tanggal=CURDATE()"));
			            $dD1 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total1,SUM(pembulatan) AS total2 FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan','servis') AND jumlah>0 AND status='1'"));
			            
			            $dE1 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('indent') AND status='1'"));
			            $dF1 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan') AND noindent!='' AND jumlah>0 AND status='1'"));
			            $dG1 = mysql_fetch_array(mysql_query("SELECT SUM(pembulatan) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('penjualan') AND noindent!='' AND jumlah<0 AND status='1'"));
			            
			            $dHO = mysql_fetch_array(mysql_query("SELECT SUM(jumlahho) AS total FROM x23_kwitansi WHERE tanggal=CURDATE() AND jnskwitansi IN ('indent') AND status='1'"));
						
			            $qD = mysql_query("SELECT nonota FROM x23_notaservice WHERE tglnota=CURDATE() AND status='2'");
							  mysql_query("TRUNCATE temp_x23_pndharian");
						while($dD = mysql_fetch_array($qD))
                        	{			
							$d3 = mysql_fetch_array(mysql_query("SELECT SUM(tarifasli) AS tarifasli, SUM(tarifkpb*0.98) AS tarifkpb, SUM(diskon) AS diskon, SUM(tarif*1.1) AS tarif FROM x23_notaservice_det WHERE nonota='$dD[nonota]'"));
							$d4 = mysql_fetch_array(mysql_query("SELECT SUM(totdiskon) AS totdiskon, SUM(total) AS total FROM x23_notajual_det WHERE nonota='$dD[nonota]'"));
							$hargasli = $d4[total]+$d4[diskon];
							
							$total = $d3[tarif]+$hargasli-$d4[totdiskon]+$d3[tarifkpb];
							$dcp = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice_det1_vw WHERE nonota='$dD[nonota]' AND jnskj='KPB'"));	
							
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
						$dE = mysql_fetch_array(mysql_query("SELECT SUM(a) AS a,
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
													
						$konsumen   = $dE[c]+$dE[d]-$dE[e];
						$maindealer = $dE[f];
						
					    $dF  = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_kaskecil WHERE tanggal=CURDATE() AND jenis='OUTPUT' AND status='1'"));
						
						$penerimaan = $maindealer+$dC1[total];
			            ?>
					
<!-- ################## MODAL TUTUP HARIAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-jasa" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TUTUP HARIAN TGL <?echo date("d-m-Y")?></h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="50%" valign="">TOTAL PENERIMAAN JASA TERMASUK KPB DAN PPN</td>
				                    			<td width="2%" valign="">:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="penerimaan" value="<?echo number_format($penerimaan,"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL KPB (-2%)</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="kpb" value="<?echo number_format($maindealer,"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL PENGELUARAN</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="pengeluaran" value="<?echo number_format($dF[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL NOTA KECIL</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="notakecil" value="<?echo number_format($dA1[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL PENJUALAN S. PART</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="pjs" value="<?echo number_format($dB1[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL PENJUALAN S. PART MPM</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="pjmpm" value="<?echo number_format($dH1[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEMBULATAN (SERVIS DAN PENJUALAN)</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="pembulatan" value="<?echo number_format($dD1[total2]-$dD1[total1],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL BIAYA HO</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ho" value="<?echo number_format($dHO[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL UANG MUKA INDENT</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="um" value="<?echo number_format($dE1[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL PELUNASAN INDENT</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="pelunasan" value="<?echo number_format($dF1[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL PENGEMBALIAN KELEBIHAN BAYAR</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="pengembalian" value="<?echo number_format($dG1[total],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<?
											$jumlah = $penerimaan-$maindealer-$dF[total]+$dA1[total]+$dA2[total]+$dB1[total]+$dH1[total]+
													  $dHO[total]+$dD1[total2]-$dD1[total1]+$dE1[total]+$dF1[total]-$dG1[total];
				                    		?>
				                    		<tr>
				                    			<td>JUMLAH + PPN</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="jumlah" value="<?echo number_format($jumlah,"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari Ini</span>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyimpan Data Ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->
<?
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
?>
	
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
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
        </script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
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