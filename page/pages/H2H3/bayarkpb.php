<?
	if($submenu == 'dir')
		{
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&save=1&periode=$_REQUEST[periode]&input2='/>";
		}
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[input1]))
			{
			$tgltagihan   = date("Y-m-d", strtotime($_REQUEST['tgltagihan']));
			$q1 = mysql_query("UPDATE x23_notaservice_det SET tgltagihan='$tgltagihan',idtagihan='$_SESSION[id]' WHERE id='$_REQUEST[input1]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notaservice_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'KIRIM TAGIHAN SERVIS KPB KE MPM $_REQUEST[nonota]')
								");
			}
			
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_penagihankpb WHERE id='$_REQUEST[input2]'"));
		if(!empty($_REQUEST[input2]))
			{
			if($_REQUEST[statuspembayaran]=="TERBAYAR")
				{		
				$tglpembayaran  = date("Y-m-d", strtotime($_REQUEST['tglpembayaran']));
				$jumlahbayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlahbayar']);				
				if($jumlahbayar=='0')
					{
					echo "<script>alert ('Jumlah Tidak Boleh 0 (Nol).')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1&periode=$_REQUEST[periode]&input2='/>";
					exit();
					}				
				if($tglpembayaran > date("Y-m-d"))
					{
					echo "<script>alert ('Mohon Ulangi, Karena Tanggal Pembayaran Tidak Boleh Melebihi Dari Hari Ini.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1&periode=$_REQUEST[periode]&input2='/>";
					exit();
					}
				if($tglpembayaran < $_REQUEST[tgltagih])
					{
					echo "<script>alert ('Mohon Ulangi, Karena Tanggal Pembayaran Harus Melebihi Atau Sama Dengan Tanggal Tagih.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1&periode=$_REQUEST[periode]&input2='/>";
					exit();
					}
				
				$q1 = mysql_query("UPDATE x23_penagihankpb SET tglpembayaran='$tglpembayaran',jumlahbayar='$jumlahbayar',idbayar='$_SESSION[id]',statuspembayaran='$_REQUEST[statuspembayaran]' WHERE id='$_REQUEST[input2]'");
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_penagihankpb',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'BAYAR SERVIS KPB DARI MPM $_REQUEST[nonota]')
									");
									
				if($jumlahbayar != $_REQUEST[total])
					{
					$p_tahun = date("Y");
					$p_bulan = date("m");
					mysql_query("INSERT INTO x23_abis_ikesalahan (
													idpenagihankpb, 
													tahun, 
													bulan, 
													tanggal,
													kasus, 
													tbl,
													inputx) 
												VALUES (
													'$_REQUEST[input2]', 
													'$p_tahun', 
													'$p_bulan', 
													CURDATE(), 
													'INDIKASI KESALAHAN : JUMLAH SERVIS KPB YANG DIBAYAR MPM TIDAK SAMA DENGAN JUMLAH TAGIHANNYA PADA NO. NOTA SERVIS $dA[nonotaservis]', 
													'x23_penagihankpb', 
													NOW())
								");
					}
				}
				
			if($_REQUEST[statuspembayaran]=="DITOLAK")
				{
				$kettolak  	= strtoupper($_REQUEST['kettolak']);

				if($_REQUEST[tagihkembali]=="TIDAK")
					{	
					$q1 = mysql_query("UPDATE x23_penagihankpb SET tagihkembali='$_REQUEST[tagihkembali]',kettolak='$kettolak',idbayar='$_SESSION[id]',statuspembayaran='$_REQUEST[statuspembayaran]' WHERE id='$_REQUEST[input2]'");
					}
					
				if($_REQUEST[tagihkembali]=="YA")
					{
					$tglpenagihan = date("Y-m-d", strtotime($_REQUEST['tglpenagihan']));
					if($tglpenagihan < date("Y-m-d"))
						{
						echo "<script>alert ('Mohon Ulangi, Karena Tanggal Penagihan Tidak Boleh Kurang Dari Hari Ini.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1&periode=$_REQUEST[periode]&input2='/>";
						exit();
						}
												
					$q1 = mysql_query("UPDATE x23_penagihankpb SET tagihkembali='$_REQUEST[tagihkembali]',kettolak='$kettolak',idbayar='$_SESSION[id]',statuspembayaran='$_REQUEST[statuspembayaran]' WHERE id='$_REQUEST[input2]'");
						  mysql_query("INSERT INTO x23_penagihankpb (
			    										tglkpb, 
			    										nonotaservis, 
			    										nopkb, 
			    										kodepaket, 
			    										idpelanggan, 
			    										idmekanik, 
			    										tglpenagihan, 
			    										jumlahtagih, 
			    										jumlahtagih2) 
			    									VALUES (
			    										'$dA[tglkpb]', 
			    										'$dA[nonotaservis]', 
			    										'$dA[nopkb]', 
			    										'$dA[kodepaket]', 
			    										'$dA[idpelanggan]', 
			    										'$dA[idmekanik]', 
			    										'$tglpenagihan', 
			    										'$dA[jumlahtagih]', 
			    										'$dA[jumlahtagih2]')
			    					");
					}
					
					$p_tahun = date("Y");
					$p_bulan = date("m");
					mysql_query("INSERT INTO x23_abis_ikesalahan (
													idpenagihankpb, 
													tahun, 
													bulan, 
													tanggal,
													kasus, 
													tbl,
													inputx) 
												VALUES (
													'$_REQUEST[input2]', 
													'$p_tahun', 
													'$p_bulan', 
													CURDATE(), 
													'INDIKASI KESALAHAN : PENAGIHAN SERVIS KPB ADA YANG DITOLAK MPM PADA NO. NOTA SERVIS $dA[nonotaservis]', 
													'x23_penagihankpb', 
													NOW())
								");
				}

			
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=dir&save=1&periode=$_REQUEST[periode]&input2='/>";
			exit();
			}
			
		if($_REQUEST[reset]=='1')
			{
			$dC1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_penagihankpb WHERE id='$_REQUEST[id]'"));
			if($dC1[statuspembayaran]=="DITOLAK" && $dC1[tagihkembali]=="YA"){
				mysql_query("DELETE FROM x23_penagihankpb WHERE nonotaservis='$dC1[nonotaservis]' AND id!='$_REQUEST[id]'");
				}
			
			mysql_query("UPDATE x23_penagihankpb SET tglpembayaran='',jumlahbayar='',tagihkembali='',kettolak='',idbayar='$_SESSION[id]',statuspembayaran='' WHERE id='$_REQUEST[id]'");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&reset=&periode=$_REQUEST[periode]'/>";
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
                           		<div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">	
				                	<h4>ADMINISTRASI <small>PENAGIHAN SERVIS KPB KE MPM</small></h4>	
	                                    <div style="float:right;width:45%">
					                   	<form method="post" action="" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal KPB" class="form-control pull-right" id="reservation" readonly=""/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
	                                    			</td>
	                                    			<td width="1%">
	                                    				<a href="#" onclick="window.open('print/penagihankpb.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
										</div>
										
									<?
									if(!empty($_REQUEST[periode]))
										{
									?>	
			                        	<table id="example2" class="table table-bordered table-striped" style="min-width:220%">
											<thead>
												<tr>
													<th width="100px">TANGGAL KPB</th>
													<th>NO NOTA SERVIS</th>
													<th>JENIS KPB</th>
													<th>NAMA PELANGGAN</th>
													<th>NAMA MEKANIK</th>
													<th >STATUS PENAGIHAN KE MPM</th>
													<th >TGL PENAGIHAN KE MPM</th>
													<th >JUMLAH TAGIHAN (RP)</th>
													<th >JUMLAH TAGIHAN (-2%) (RP)</th>
													<th >STATUS PEMBAYARAN KPB</th>
													<th >TGL PEMBAYARAN KPB</th>
													<th >JUMLAH YANG DIBAYAR (RP)</th>
													<th width="">KETERANGAN TOLAK</th>
													<th>RESET</th>
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
				                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
				                            
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
				                    	while($dA = mysql_fetch_array($qA))
				                            {
				                    ?>
									<!-- ################## MODAL TAGIHAN ########################################################################################## 
									        <div class="modal fade " id="compose-modal-tgltagihan1<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT TANGGAL KIRIM TAGIHAN</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tgltagihan" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="input1" value="<?echo $dA[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $dA[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
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
									<!-- ################## MODAL BAYAR PKB ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-tglbayarkpb1<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:45%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN KPB DARI MPM</h4>
									                    </div>
															
														<script>
														function populateSelect<?echo $dA[id]?>(str)
															{
															pilihan = document.inp<?echo $dA[id]?>.statuspembayaran.value;
															if(pilihan=='')
																{
																document.inp<?echo $dA[id]?>.tagihkembali.disabled = 1;
																document.inp<?echo $dA[id]?>.kettolak.disabled = 1;
																document.inp<?echo $dA[id]?>.tglpenagihan.disabled = 1;
																document.inp<?echo $dA[id]?>.tglpembayaran.disabled = 1;
																document.inp<?echo $dA[id]?>.jumlahbayar.disabled = 1;
																}
															else if(pilihan=='TERBAYAR')
																{
																document.inp<?echo $dA[id]?>.tagihkembali.disabled = 1;
																document.inp<?echo $dA[id]?>.kettolak.disabled = 1;
																document.inp<?echo $dA[id]?>.tglpenagihan.disabled = 1;
																document.inp<?echo $dA[id]?>.tglpembayaran.readonly = 1;
																document.inp<?echo $dA[id]?>.jumlahbayar.disabled = 0;
																document.inp<?echo $dA[id]?>.jumlahbayar.required = 1;
																}
															else if(pilihan=='DITOLAK')
																{
																document.inp<?echo $dA[id]?>.tagihkembali.disabled = 0;
																document.inp<?echo $dA[id]?>.tagihkembali.required = 1;
																document.inp<?echo $dA[id]?>.kettolak.disabled = 0;
																document.inp<?echo $dA[id]?>.kettolak.required = 1;
																document.inp<?echo $dA[id]?>.tglpenagihan.disabled = 1;
																document.inp<?echo $dA[id]?>.tglpembayaran.disabled = 1;
																document.inp<?echo $dA[id]?>.jumlahbayar.disabled = 1;
																}
															}
															
														function populateSelect2<?echo $dA[id]?>(str)
															{
															pilihan = document.inp<?echo $dA[id]?>.tagihkembali.value;
															if(pilihan=='YA')
																{
																document.inp<?echo $dA[id]?>.tglpenagihan.disabled = 0;
																document.inp<?echo $dA[id]?>.tglpenagihan.required = 1;
																}
															else if(pilihan=='TIDAK')
																{
																document.inp<?echo $dA[id]?>.tglpenagihan.disabled = 1;
																}
															}
														</script>
														
									                   	<form method="post" name="inp<?echo $dA[id]?>" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">UBAH STATUS</td>
									                    			<td width="2%">:</td>
									                    			<td><select name="statuspembayaran" class="form-control" style="width: 100%" onchange="populateSelect<?echo $dA[id]?>(this.value)">
																			<option value="" selected="">BELUM TERBAYAR</option>
																			<option value="TERBAYAR">TERBAYAR</option>
																			<option value="DITOLAK">DITOLAK</option>
																			</select></td>
									                    		</tr>
									                    		<tr>
									                    			<td width="40%">TAGIH KEMBALI</td>
									                    			<td width="2%">:</td>
									                    			<td><select name="tagihkembali" class="form-control" style="width: 30%" disabled="" onchange="populateSelect2<?echo $dA[id]?>(this.value)">
																			<option value="YA">YA</option>
																			<option value="TIDAK" selected="">TIDAK</option>
																			</select></td>
									                    		</tr>
									                    		<tr>
									                    			<td>TANGGAL TAGIH KEMBALI</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglpenagihan" disabled="" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask style="width:60%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>KETERANGAN DITOLAK</td>
									                    			<td>:</td>
									                    			<td><textarea name="kettolak" class="form-control" maxlength="400" disabled=""></textarea></td>
									                    		</tr>
									                    		<tr>
									                    			<td>TANGGAL BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglpembayaran" readonly="" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask style="width:60%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH TAGIHAN</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="" value="<?echo number_format($dA[jumlahtagih2],"0","",".")?>" disabled="" style="width:40%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" > 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="jumlahbayar" placeholder="0" disabled="" style="width:40%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" > 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="input2" value="<?echo $dA[id]?>">
									                    		<input type="hidden" name="total" value="<?echo $dA[jumlahtagih2]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $dA[nonotaservis]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
									                    		<input type="hidden" name="tgltagih" value="<?echo $dA[tglpenagihan]?>">
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
			                    	</div>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
		
	if($submenu == 'B')
		{
		if(!empty($_REQUEST[input1]))
			{
			$tgltagihan   = date("Y-m-d", strtotime($_REQUEST['tgltagihan']));
			$q1 = mysql_query("UPDATE x23_notajual_det SET tgltagihan='$tgltagihan',idtagihan='$_SESSION[id]' WHERE id='$_REQUEST[input1]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notajual_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'KIRIM TAGIHAN PENJUALAN BARANG KPB KE MPM $_REQUEST[nonota]')
								");
			}
		if(!empty($_REQUEST[input2]))
			{
			$tglbayarkpb     = date("Y-m-d", strtotime($_REQUEST['tglbayarkpb']));
			$jumlahbayarkpb  = preg_replace( "/[^0-9]/", "",$_REQUEST['jumlahbayarkpb']);
			
			if($jumlahbayarkpb != $_REQUEST[total]){
				$status = "0";
				}
			if($jumlahbayarkpb == $_REQUEST[total]){
				$status = "1";
				}
				
			$q1 = mysql_query("UPDATE x23_notajual_det SET tglbayarkpb='$tglbayarkpb',jumlahbayarkpb='$jumlahbayarkpb',idbayar='$_SESSION[id]',statusbayar='1' WHERE id='$_REQUEST[input2]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notajual_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR PENJUALAN BARANG KPB DARI MPM $_REQUEST[nonota]')
								");
			
			if($jumlahbayarkpb != $_REQUEST[total])
				{
				$p_tahun = date("Y");
				$p_bulan = date("m");
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idnotajualdet, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$_REQUEST[input2]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : JUMLAH BARANG KPB YANG DIBAYAR MPM TIDAK SAMA DENGAN JUMLAH TAGIHANNYA', 
												'x23_notajual_det', 
												NOW())
							");
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
                           		<div class="tab-content" style="overflow-x:auto;overflow-y:auto;height:460px;">	
				                	<h4>ADMINISTRASI <small>PEMBAYARAN PENJUALAN BARANG KPB DARI MPM</small></h4>	 
	                                    <div style="float:right;width:35%">
					                   	<form method="post" action="" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation" readonly=""/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
										</div>
										
									<?
									if(!empty($_REQUEST[periode]))
										{
									?>	
			                        	<table id="example2" class="table table-bordered table-striped" style="min-width:200%">
											<thead>
												<tr>
													<th width="100px">TANGGAL KPB</th>
													<th>KODE BARANG</th>
													<th>BARANG</th>
													<th>NAMA PELANGGAN</th>
													<th>NAMA MEKANIK</th>
													<th ><center>STATUS TAGIHAN KE MPM</center></th>
													<th ><center>JUMLAH TAGIHAN (RP)</center></th>
													<th ><center>STATUS PEMBAYARAN KPB</center></th>
													<th ><center>JUMLAH YANG DIBAYAR (RP)</center></th>
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
				                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
				                            
											$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nonota FROM x23_notaservice_det1_vw WHERE jnskj='KPB')");
											$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nonota FROM x23_notaservice_det1_vw WHERE jnskj='KPB')");
											while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	$d3 = mysql_fetch_array(mysql_query("SELECT nama,idmekanik FROM x23_notaservice_vw WHERE nonota='$d1[nonota]'"));
				                            	$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id='$d3[idmekanik]'"));
				                            	
				                            	if($d1[tgltagihan]=='0000-00-00'){
							                        $tgltagihan = "<a data-toggle='modal' data-target='#compose-modal-tgltagihan1$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Tertagih</span></a>";
													}
												else{
							                        $tgltagihan = date("d-m-Y",strtotime($d1[tgltagihan]));
													}
													
				                            	if($d1[tglbayarkpb]=='0000-00-00'){
							                        $tglbayarkpb = "<a data-toggle='modal' data-target='#compose-modal-tglbayarkpb1$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:150px'>Belum Terbayar</span></a>";
													}
												else{
							                        $tglbayarkpb = date("d-m-Y",strtotime($d1[tglbayarkpb]));
													}
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
				                                	<td align="left"><?echo $d1[kodebarang]?></td>
				                                	<td align="left"><?echo "$d1[namabarang] | $d1[varian]"?></td>
				                                	<td align="left"><?echo $d3[nama]?></td>
				                                	<td align="left"><?echo $d4[nama]?></td>
				                                	<td align="center"><?echo $tgltagihan?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
				                                	<td align="center"><?echo $tglbayarkpb?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahbayarkpb],"0","",".")?></span></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <td colspan="9">&nbsp;</td>
				                                </tr>
				                            </tfoot>
				                        </table>
				                    <?
				                    	while($dA = mysql_fetch_array($qA))
				                            {
				                    ?>
									<!-- ################## MODAL TAGIHAN ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-tgltagihan1<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT TANGGAL KIRIM TAGIHAN</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tgltagihan" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="input1" value="<?echo $dA[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $dA[nonota]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
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
									<!-- ################## MODAL BAYAR PKB ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-tglbayarkpb1<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:30%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">INPUT PEMBAYARAN PENJUALAN BARANG KPB</h4>
									                    </div>
														
									                   	<form method="post" action="" enctype="multipart/form-data">
								                        <div class="modal-body">
									                    	<table width="100%">
									                    		<tr>
									                    			<td width="40%">TANGGAL BAYAR</td>
									                    			<td width="2%">:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
									                                        	<input type="text" name="tglbayarkpb" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<tr>
									                    			<td>JUMLAH BAYAR</td>
									                    			<td>:</td>
									                    			<td><div class="input-group">
									                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
									                                        	<input type="text" name="jumlahbayarkpb"  style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
									                                    </div>                                        		
									                                </td>
									                    		</tr>
									                    		<input type="hidden" name="input2" value="<?echo $dA[id]?>">
									                    		<input type="hidden" name="nonota" value="<?echo $dA[nonota]?>">
									                    		<input type="hidden" name="total" value="<?echo $dA[total]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
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
			                    	</div>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
?>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
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