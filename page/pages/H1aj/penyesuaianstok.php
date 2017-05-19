<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME BARANG</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="km")
											{
											$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</p>";
											}
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
	                                    </div>
									<?
										}
									?>
                                    <div style="float:left;width:30%;margin-left:15px">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
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
										?>
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px">
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
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px">
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
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
	                           		<div style="float:right" class="col-xs-7">
	                           		<?
	                           		if(empty($_SESSION[tanggal]))
	                           			{
									?>
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Stock Opname</button>
										</a>
									<?
										}
	                           		else
	                           			{
									?>
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Stock Opname</button>
										</a>
									<?
										}
	                           		?>
										<?
										/*
										if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
											{
										?>
											<button type="button"  onclick="window.open('print/h1/penyesuaianstokfront.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
										*/
	                           			?>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="22%">TANGGAL STOCK OPNAME</th>
			                                    <th style="padding:7px">LOKASI GUDANG</th>
			                                    <th style="padding:7px" width="10%">STOK (UNIT)</th>
			                                    <th style="padding:7px" width="10%">SCAN (UNIT)</th>
			                                    <th style="padding:7px" width="10%">SISA (UNIT)</th>
			                                    <th style="padding:7px" width="1%">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_opname WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dG = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id='$d1[idgudang]'"));
			                            	if(empty($dG[gudang])){
												$lokasi = "SEMUA GUDANG";
												}
											else{
												$lokasi = $dG[gudang];
												}
											if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'> Ditolak</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'> Disetujui</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $lokasi?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[stok]?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[scan]?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[sisa]?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
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
			            
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'view')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_opname WHERE id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>GUDANG & PDI <small>LIHAT STOCK OPNAME</small></h4>		
			                		<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TANGGAL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width="25%"><input type="text" style="width:45%" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
				                        		<td rowspan="2" width="15%"></td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-blue" style="font-weight:bold;height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>STOK</b></h5>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo $d1[stok]?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-green" style="font-weight:bold;height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>SCAN</b></h5>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo $d1[scan]?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-orange" style="font-weight:bold;height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>SISA</b></h5>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo $d1[sisa]?></span>
				                        					</div>
				                        		</td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:100%" readonly="">
														<option value='' >SEMUA LOKASI</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($d1[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
					            			<form method="post" action="">
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
					                		</form>
				                        </table>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:320px;margin-top:-20px">
					                        <table class="table table-striped" id="example2">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">NO. RANGKA</th>
					                                    <th style="padding:7px">NO. MESIN</th>
					                                    <th style="padding:7px">KODE BARANG</th>
					                                    <th style="padding:7px">NAMA BARANG</th>
					                                    <th style="padding:7px">VARIAN</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">KETERANGAN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
												<?
												if($d1[status]=="0")
													{
													$qA = mysql_query("SELECT * FROM tbl_opname_det WHERE idopname='$d1[id]'");
						                            while($dA = mysql_fetch_array($qA))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$dA[norangka]'"));
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $d2[norangka]?></td>
						                                    <td><?echo $d2[nomesin]?></td>
						                                    <td><?echo $d2[kodebarang]?></td>
						                                    <td><?echo $d2[namabarang]?></td>
						                                    <td><?echo $d2[varian]?></td>
						                                    <td><?echo $d2[warna]?></td>
						                                    <td><?echo $dA[keterangan]?></td>
						                                    
						                                </tr>
					                            <?
						                            	}
													$qB = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE status='STOK' AND idgudang='$d1[idgudang]' AND norangka NOT IN (SELECT norangka FROM tbl_opname_det WHERE idopname='$d1[id]')");
						                            while($dB = mysql_fetch_array($qB))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dB[norangka]?></td>
						                                    <td><?echo $dB[nomesin]?></td>
						                                    <td><?echo $dB[kodebarang]?></td>
						                                    <td><?echo $dB[namabarang]?></td>
						                                    <td><?echo $dB[varian]?></td>
						                                    <td><?echo $dB[warna]?></td>
						                                    <td>ADA</td>
						                                    
						                                </tr>
					                            <?
					                            		}
													}
													
												else
													{
													$qB = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE idgudang='$d1[idgudang]'");
						                            while($dB = mysql_fetch_array($qB))
						                            	{
					                            		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
														if($dB[status]=="STOK"){
															$status="ADA";
														}
														else{
															$status=$dB[status];
														}
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dB[norangka]?></td>
						                                    <td><?echo $dB[nomesin]?></td>
						                                    <td><?echo $dB[kodebarang]?></td>
						                                    <td><?echo $dB[namabarang]?></td>
						                                    <td><?echo $dB[varian]?></td>
						                                    <td><?echo $dB[warna]?></td>
						                                    <td><?echo $status?></td>
						                                    
						                                </tr>
					                            <?
					                            		}
													}
					                            ?>
					                            </tbody>
					                        </table>
				                        
						                	<div class="col-xs-12">
						                        <div class="modal-footer clearfix">
													<?
													if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
														{
													?>
				                           				<button type="button"  onclick="window.open('print/h1/stokopname.php?id=<?echo $_REQUEST[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-warning pull-left"><i class="fa fa-print"></i> Export Ke Excel</button>
				                           			<?
				                           				}
				                           			?>
							                    	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
												</div>
						                    </div>
					                </div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME BARANG</small></h4>
				                	<form name="formPindah" onsubmit="return vPindah();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TANGGAL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width="25%"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:45%"></td>
				                        		<td rowspan="2" width="15%"></td>
				                        		<td rowspan="3"></td>
				                        		<td rowspan="3"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:100%">
														<!--<option value='' >SEMUA LOKASI</option>-->
														<?php
														$q = mysql_query('SELECT * FROM tbl_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>"><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
				                        </table>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
					                    	
					                        <button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'C')
		{
		if(empty($_SESSION[tanggal]))
			{
			$tanggal  = date("Y-m-d", strtotime($_REQUEST[tanggal]));
			
			$dCek1 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pindah WHERE status='0'"));
			if(!empty($dCek1[id]))
				{
				echo "<script>alert ('Stock Opname Tidak Dapat Dilakukan, Karena Masih Ada Proses Pindah Barang Yang Belum Selesai.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
				exit();
				}
				
			$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_opname WHERE idgudang='$_REQUEST[idgudang]' AND status='0'"));
			if(!empty($dCek2[id]))
				{
				echo "<script>alert ('Stock Opname Tidak Dapat Dilakukan, Masih Ada Proses Stok Opname Yang Belum Selesai.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
				exit();
				}
				
			$dCek3 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_opname WHERE idgudang='0' AND status='0'"));
			if(!empty($dCek3[id]))
				{
				echo "<script>alert ('Stock Opname Tidak Dapat Dilakukan, Masih Ada Proses Stok Opname Yang Belum Selesai.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
				exit();
				}
				
			$_SESSION[tanggal]  = $_REQUEST[tanggal];
			$_SESSION[idgudang] = $_REQUEST[idgudang];
			if(!empty($_REQUEST[idgudang]))
				{
				$qIm = mysql_query("SELECT norangka FROM tbl_stokunit WHERE status='STOK' AND idgudang='$_REQUEST[idgudang]'");
				}
			else
				{
				$qIm = mysql_query("SELECT norangka FROM tbl_stokunit WHERE status='STOK' AND idgudang NOT IN (SELECT idgudang FROM tbl_opname WHERE status='0')");
				}
				
			while($dIm = mysql_fetch_array($qIm))
				{
				mysql_query("INSERT INTO temp_opname_det VALUES ('$dIm[norangka]','$dIm[idgudang]','$_SESSION[user]','')");
				}
			}
		if(!empty($_REQUEST[scan]))
			{
			mysql_query("UPDATE temp_opname_det SET status='1' WHERE norangka='$_REQUEST[scan]'");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME BARANG</small></h4>		
			                		<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TANGGAL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width="25%"><input type="text" style="width:45%" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
				                        		<td rowspan="2" width="15%"></td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-blue" style="font-weight:bold;height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5 style="font-weight: bold"><b>STOK</b></h5>
				                        					<?
				                        					$dstok = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_opname_det WHERE user='$_SESSION[user]'"));
				                        					?>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo round($dstok[total]/2)?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-green" style="font-weight:bold;height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>SCAN</b></h5>
				                        					<?
				                        					$dscan = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_opname_det WHERE user='$_SESSION[user]' AND status='1'"));
				                        					?>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo $dscan[total]?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-orange" style="font-weight:bold;height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>SISA</b></h5>
				                        					<?
				                        					$dsisa = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_opname_det WHERE user='$_SESSION[user]' AND status='0'"));
				                        					?>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo round($dsisa[total]/2)?></span>
				                        					</div>
				                        		</td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:100%" disabled="">
														<option value='' >SEMUA LOKASI</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($_SESSION[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
				                        </table>
									</br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>1. Klik <i class="fa fa-star"></i></i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>2. Scan Nomor Rangka Untuk Melakukan Stock Opname</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>3. Klik Lanjutkan</i></span>
				                        
						                <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
						                	<div class="col-xs-12" style="margin-left:640px;margin-top:-50px;">
							                        <button type="submit" class="btn btn-info"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
													
													<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]"?>'"><i class="fa fa-star"></i></button>
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=reset"?>"><button type="button" class="btn btn-warning" onclick="return confirm('Anda yakin akan mereset data ini?')"><i class="fa fa-refresh"></i> &nbsp;Reset</button></a>
													<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
					                    </form>
					                </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">GUDANG</th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT norangka,status FROM temp_opname_det WHERE user='$_SESSION[user]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
			                            	
				                            if($d1[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												}
											else if($d1[status]=='0'){
												$status = "-";
												}
											if($no%2==0){
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[norangka]?></td>
			                                    <td><?echo $d2[nomesin]?></td>
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[gudang]?></td>
			                                    <td><?echo $status?></td>
			                                </tr>
			                                
			                            <?
			                            		}
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			
			<form method="post" action="">
				<input type="text" name="scan" autofocus maxlength="40" style="width:0%">
			</form>
<?
		}
		
	else if($submenu == 'D')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME BARANG</small></h4>		
			                		<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TANGGAL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width="25%"><input type="text" style="width:45%" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
				                        		<td rowspan="2" width="15%"></td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-blue" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>STOK</b></h5>
				                        					<?
				                        					$dstok = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_opname_det WHERE user='$_SESSION[user]'"));
				                        					?>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo round($dstok[total]/2)?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-green" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>SCAN</b></h5>
				                        					<?
				                        					$dscan = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_opname_det WHERE user='$_SESSION[user]' AND status='1'"));
				                        					?>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo $dscan[total]?></span>
				                        					</div>
				                        		</td>
				                        		<td rowspan="3" width="13%" valign="top">
				                        					<div class="small-box bg-orange" style="height:auto;margin-left:15px;text-align:center;padding:10px;border-radius:5px;cursor:pointer;">
				                        					<h5><b>SISA</b></h5>
				                        					<?
				                        					$dsisa = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_opname_det WHERE user='$_SESSION[user]' AND status='0'"));
				                        					?>
				                        					<span style="font-size:18px;font-weight:bold;"><?echo round($dsisa[total])?></span>
				                        					</div>
				                        		</td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:100%" disabled="">
														<option value='' >SEMUA LOKASI</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($_SESSION[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
					            			<form method="post" action="">
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
					                		</form>
				                        </table>
					                </div>
									<?
									if($dscan[total]=='0')
										{
										echo "<script>alert ('Proses Tidak Dapat Disimpan, Scan Nomor Rangka Terlebih Dahulu')</script>";
										print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
										exit();
										}
									?>
										<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:320px;margin-top:-20px">
											<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
					                	
											<?
											if($dsisa[total] != '0')
												{
											?>
												<table class="table table-striped" id="example2">
													<thead style="color:#666;font-size:13px">
														<tr>
															<th style="padding:7px">NO. RANGKA</th>
															<th style="padding:7px">NO. MESIN</th>
															<th style="padding:7px">KODE BARANG</th>
															<th style="padding:7px">NAMA BARANG</th>
															<th style="padding:7px">VARIAN</th>
			                                    			<th style="padding:7px">GUDANG</th>
															<th style="padding:7px">KETERANGAN</th>
														</tr>
													</thead>
													<tbody>
													<?
													$no=1;
													$q1 = mysql_query("SELECT * FROM temp_opname_det WHERE id%2=0 AND user='$_SESSION[user]' AND status='0'");
													while($d1 = mysql_fetch_array($q1))
														{
														$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
														if($no%2==0){
													?>
															<tr style="cursor:pointer">
																<td><?echo $d2[norangka]?></td>
																<td><?echo $d2[nomesin]?></td>
																<td><?echo $d2[kodebarang]?></td>
																<td><?echo $d2[namabarang]?></td>
																<td><?echo $d2[varian]?></td>
																<td><?echo $d2[gudang]?></td>
																<td><input type="text" name="ket<?echo $d2[norangka]?>" maxlength="30" class="form-control" required></td>
															</tr>
													<?
															}
														$no++;
														}
													 ?>
													</tbody>
												</table>
											<?
												}
											else
												{
											?>
												<h3 style="color:red"><i><b>Tidak Ada Sisa Stok Barang, Mohon Klik Simpan Untuk Melanjutkan.</b></i></h3>
											<?
												}
											?>
											
												<div class="col-xs-12">
													<div class="modal-footer clearfix">
														<input type="hidden" name="stok" value="<?echo $dstok[total]?>">
														<input type="hidden" name="scan" value="<?echo $dscan[total]?>">
														<input type="hidden" name="sisa" value="<?echo $dsisa[total]?>">
														
														<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
														<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
													</div>
												</div>
											</form>
										</div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'reset')
		{
		unset($_SESSION[tanggal]);
		unset($_SESSION[idgudang]);
		mysql_query("DELETE FROM temp_opname_det WHERE user='$_SESSION[user]'");
		
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";		
		}
		
	else if($submenu == 'save')
		{
        $tanggal  = date("Y-m-d", strtotime($_SESSION[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
		
		$q1 = mysql_query("INSERT INTO tbl_opname (
											tahun, 
											bulan, 
											tanggal, 
											idgudang, 
											stok, 
											scan, 
											sisa, 
											iduser, 
											user, 
											inputx) 
										VALUES (
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'$_SESSION[idgudang]', 
											'$_REQUEST[stok]', 
											'$_REQUEST[scan]', 
											'$_REQUEST[sisa]', 
											'$_SESSION[id]', 
											'$_SESSION[user]', 
											NOW())
							");
							
		$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
		$idopname	= $id[id];
							
		$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
											idopname, 
											tahun, 
											bulan, 
											tanggal, 
											kasus, 
											tbl, 
											inputx) 
										VALUES (
											'$idopname', 
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'SELISIH STOCK OPNAME BARANG : $_REQUEST[sisa] UNIT', 
											'tbl_opname', 
											NOW())
							");
							
		
		
		$qA = mysql_query("SELECT * FROM temp_opname_det WHERE user='$_SESSION[user]' AND status='0'");
        while($dA = mysql_fetch_array($qA))
        	{
        	$id  = $dA[norangka];
        	$ket = strtoupper($_REQUEST[ket.$id]);
        	
        	mysql_query("INSERT INTO tbl_opname_det VALUES ('','$idopname','$dA[norangka]','$ket')");
        	mysql_query("UPDATE tbl_stokunit SET status='MENUNGGU KONFIRMASI' WHERE norangka='$dA[norangka]'");
        	}
        	
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_opname',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH STOCK OPNAME $tanggal')
							");
				
		
		if($q1 && $q2)
			{
			unset($_SESSION[tanggal]);
			unset($_SESSION[idgudang]);
			mysql_query("DELETE FROM temp_opname_det WHERE user='$_SESSION[user]'");
			
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=km'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=D'/>";
			exit();
			}	
		}
?>
	
        <script src="js/jquery.min.js"></script>
        
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
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>