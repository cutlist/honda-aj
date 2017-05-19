<?
	if($submenu == 'A')
		{
		unset($_SESSION[tanggal]);
		unset($_SESSION[idgudang1]);
		unset($_SESSION[idgudang2]);
		unset($_SESSION[dealer1]);
		unset($_SESSION[dealer2]);
		unset($_SESSION[rak1]);
		unset($_SESSION[rak2]);
		
		mysql_query("TRUNCATE x23_temp_pindah_det");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
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
	                           		<div style="float:right" class="col-xs-8">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Pindah Lokasi</button>
										</a>
													<?
													if($_SESSION[posisi]=='DIREKSI')
														{
													?>
				                           				<button type="button"  onclick="window.open('printaj/h2/pindahlokasi.php?bulan=<?echo $periode_bulan?>&tahun=<?echo $periode_tahun?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                           			<?
				                           				}
				                           			?>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">TGL PINDAH LOKASI</th>
			                                    <th style="padding:7px">GUDANG/RAK ASAL</th>
			                                    <th style="padding:7px">GUDANG/RAK TUJUAN</th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_pindah WHERE id%2=0 AND  bulan='$periode_bulan' AND tahun='$periode_tahun'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dG1 = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE  id='$d1[idgudang1]'"));
			                            	$dG2 = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE  id='$d1[idgudang2]'"));
			                            	$dT  = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM x23_pindah_det WHERE  idpindah='$d1[id]'"));
			                            
											if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo "$dG1[gudang] | $d1[rak1]"?></td>
			                                    <td><?echo "$dG2[gudang] | $d1[rak2]"?></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
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
<?
		}
		
	else if($submenu == 'view')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_pindah WHERE  id='$_REQUEST[id]'"));
    
		if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
    	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM DIKONFIRMASI PIHAK MANAJEMEN</span>";}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:300px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
				                	<div style="padding:20px">
				                		<table width="100%">
				                        	<tr>
				                        		<td width="22%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="5"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td><select name="idgudang1" class="form-control" disabled="" style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($d1[idgudang1]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="12%" align="center">GUDANG TUJUAN</td>
				                        		<td colspan="2"><select name="idgudang2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($d1[idgudang2]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td></td>
				                        		<td></td>
				                        		<td><select name="rak1" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($d1[rak1]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="6%" align="center">KE</td>
				                        		<td colspan="2"><select name="rak2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($d1[rak2]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td>STATUS</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="5"><?echo $status?></td>
				                        	</tr>
				                        </table>
				                        
					           			<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
					                        	<button type="button"  onclick="window.open('printaj/h2/pindahlokasidet.php?id=<?echo $_REQUEST[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-info pull-left"><i class="fa fa-print"></i> Export Ke Excel</button>
					                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
					                    </div>
					                </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:220px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th width="" style="padding:7px">HARGA BELI (RP)</th>
			                                    <th width="" style="padding:7px">QTY PINDAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_pindah_det_vw WHERE  idpindah='$_REQUEST[id]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE  nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dNbl[tglnota]))?></td>
			                                    <td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right" width="1%"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                </tr>
			                                
			                            <?
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
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
			                	
								<!--
									<script>
									function vPindah()
										{
										if (document.formPindah.idgudang1.value == document.formPindah.idgudang2.value)
											{
											alert ("Lokasi asal dan tujuan sama.");	 	
											return false;
											}
										}
									</script>
								-->
				                	<form name="formPindah" onsubmit="return vPindah();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="22%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="4"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td><select name="idgudang1" class="form-control" required style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>'><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="12%" align="center">GUDANG TUJUAN</td>
				                        		<td><select name="idgudang2" class="form-control" required style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>'><?echo $dB[gudang]?></option>
																<?
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
		mysql_query("TRUNCATE x23_temp_pindah_det");
		
		unset($_SESSION[rak2]);
		unset($_SESSION[rak1]);
		if(empty($_SESSION[tanggal]))
			{
			$_SESSION[tanggal]   = $_REQUEST[tanggal];
			$_SESSION[idgudang1] = $_REQUEST[idgudang1];
			$_SESSION[idgudang2] = $_REQUEST[idgudang2];
			}
		
		if(!empty($_REQUEST[norangka]))
			{
			mysql_query("INSERT INTO temp_pindah_det VALUES ('$_REQUEST[norangka]','$_SESSION[user]')");
			}
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM temp_pindah_det WHERE  norangka='$_REQUEST[del]'");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
				                	<div style="padding:20px">
				                		<form name="formPindah" onsubmit="return vPindah();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="22%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="5"><input type="text" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td><select name="idgudang1" class="form-control" readonly style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[idgudang1]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="12%" align="center">GUDANG TUJUAN</td>
				                        		<td colspan="2"><select name="idgudang2" class="form-control" readonly style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[idgudang2]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td></td>
				                        		<td></td>
				                        		<td><select name="rak1" class="form-control" required style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_stokpart WHERE  idgudang='$_SESSION[idgudang1]' GROUP BY rak ORDER BY rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[rak]?>' <?if($_SESSION[rak1]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="6%" align="center">KE</td>
				                        		<td colspan="2"><select name="rak2" class="form-control" required style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[rak]?>' <?if($_SESSION[rak2]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        </table>
				                        
					           			<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                        <button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
	else if($submenu == 'D')
		{
		if(empty($_SESSION[rak1]))
			{
			$_SESSION[rak1] = $_REQUEST[rak1];
			$_SESSION[rak2] = $_REQUEST[rak2];
			}
		if($_SESSION[idgudang1] == $_SESSION[idgudang2] )
			{
			if($_SESSION[rak1] == $_SESSION[rak2] )
				{
				echo "<script>alert ('Mohon Ulangi, Karena Pada Gudang Yang Sama Tidak Bisa Pindah Ke Rak Yang Sama!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
				exit();
				}
			}
		
		if(!empty($_REQUEST[deltemp]))
			{
			mysql_query("DELETE FROM x23_temp_pindah_det WHERE  id='$_REQUEST[deltemp]'");
			}
			
		if(!empty($_REQUEST[temp]))
			{
            $idbarang  = $_REQUEST[idbarang];
            $nonota    = $_REQUEST[notabeli];
				
			$qty 	= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			if($_REQUEST['qty'] == "0")
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Qty Tidak Boleh 0 (Nol)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=D'/>";
				exit();
				}
				
			$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_temp_pindah_det WHERE  idgudang1='$_SESSION[idgudang1]' AND rak1='$_SESSION[rak1]' AND idbarang='$idbarang' AND nonota='$nonota'"));
			if(!empty($dCek2[id]))
				{
				echo "<script>alert ('Barang Pada Lokasi Tersebut Sudah Ada Pada Detail Pindah Lokasi.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&temp='/>";
				exit();
				}
				
			$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart_group_vw WHERE  idgudang='$_SESSION[idgudang1]' AND rak='$_SESSION[rak1]' AND idbarang='$idbarang' AND nonota='$nonota'"));
			
            /*
				echo "<script>alert ('$dCek[totalstok].$qty')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
				exit();
			*/
				
			if($dCek[totalstok] < $qty)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Qty Melebihi Stok.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&temp='/>";
				exit();
				}
			else{
				mysql_query("INSERT INTO x23_temp_pindah_det (
													dealer1,
													nonota,
													idgudang1,
													rak1,
													dealer2,
													idgudang2,
													rak2,
													idbarang,
													qty,
													hargabelibersih,
													hargajual,
													hargajual2) 
												VALUES (
													'$_SESSION[dealer1]',
													'$nonota',
													'$_SESSION[idgudang1]',
													'$_SESSION[rak1]',
													'$_SESSION[dealer2]',
													'$_SESSION[idgudang2]',
													'$_SESSION[rak2]',
													'$idbarang',
													'$qty',
													'$dCek[hargabelibersih]',
													'$dCek[hargajual]',
													'$dCek[hargajual2]') 
							");
							
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&temp='/>";
				exit();
				}
			} 
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
				                	<div style="padding:20px">
				                		<form name="formPindah" onsubmit="return vPindah();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="22%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="5"><input type="text" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td><select name="idgudang1" class="form-control" disabled="" style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[idgudang1]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="12%" align="center">GUDANG TUJUAN</td>
				                        		<td colspan="2"><select name="idgudang2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[idgudang2]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td></td>
				                        		<td></td>
				                        		<td><select name="rak1" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_stokpart WHERE  idgudang='$_SESSION[idgudang1]' GROUP BY rak ORDER BY rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[rak1]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="6%" align="center">KE</td>
				                        		<td colspan="2"><select name="rak2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[rak2]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        </table>
				                        
					           			<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
						                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
						                    	
						                    	<button type="button" class="btn btn-warning pull-left" data-toggle="modal" data-target="#compose-modal-pilihbarang"><i class="fa fa-plus"></i> &nbsp; Pilih Barang</button>
				                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
					                    </div>
					                    </form>
					                </div>
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL PILIH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-pilihbarang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG</h4>
				                    </div>
									
				                   	<form method="post" name="inpNJ" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width="" colspan="2"><select name="idbarang" class="form-control select1" onchange="populateSelectNJ1(this.value)" style="font-size:12px;padding:3px;width:100%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw WHERE  idgudang='$_SESSION[idgudang1]' AND rak='$_SESSION[rak1]' AND totalstok!='0' GROUP BY idgudang,rak,idbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[idbarang]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. NOTA BELI / TGL NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="notabeli" class="form-control select1" id="NJ2" style="font-size:12px;padding:3px;width: 100%" disabled="">
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY PINDAH</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                    		</tr>
					                    	<input type="hidden" name="temp" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Pilih</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->
					
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th width="" style="padding:7px">STOK</th>
			                                    <th width="" style="padding:7px">HARGA BELI (RP)</th>
			                                    <th width="" style="padding:7px">QTY PINDAH</th>
			                                    <th width="" style="padding:7px">DEL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_temp_pindah_det_vw");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="right" width="7%"><span style="padding-right:20%"><?echo number_format($d1[stok],"0","",".")?> PCS</span></td>
			                                    <td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right" width="7%"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                    <td align="center" width="1%"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deltemp=$d1[id]"?>"><i class="fa fa-trash-o"></i></a></td>
			                                </tr>
			                                
			                            <?
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
<?
		}
		
	if($submenu == 'NJ1')
		{
		$q  = $_GET['q'];	
		$_SESSION[idbarang] = $q;
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE  idbarang='$q' AND idgudang='$_SESSION[idgudang1]' AND rak='$_SESSION[rak1]' AND stok>'0' GROUP BY nonota,idbarang ORDER BY nonota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[nonota]'>$d[nonota] | ".date("d-m-Y",strtotime($d[tglnota]))." | STOK : $d[stok] PCS</option>";
			}
		}
		
	else if($submenu == 'save')
		{
        $tanggal  = date("Y-m-d", strtotime($_SESSION[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        
		$q1 = mysql_query("INSERT INTO x23_pindah (
											tahun, 
											bulan, 
											tanggal, 
											dealer1, 
											dealer2, 
											idgudang1, 
											idgudang2, 
											rak1, 
											rak2, 
											user, 
											inputx) 
										VALUES (
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'$_SESSION[dealer1]', 
											'$_SESSION[dealer2]', 
											'$_SESSION[idgudang1]', 
											'$_SESSION[idgudang2]', 
											'$_SESSION[rak1]', 
											'$_SESSION[rak2]', 
											'$_SESSION[id]', 
											NOW())
							");
							
		$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
		$idpindah	= $id[id];
		
		mysql_query("INSERT INTO x23_abis_dkonfirmasi (
										idpindah, 
										tahun, 
										bulan, 
										tanggal,
										kasus, 
										tbl,
										inputx) 
									VALUES (
										'$idpindah', 
										'$tahun', 
										'$bulan', 
										CURDATE(), 
										'KONFIRMASI PINDAH LOKASI BARANG', 
										'x23_notabeli', 
										NOW())
					");
		
		$qA = mysql_query("SELECT * FROM x23_temp_pindah_det");
        while($dA = mysql_fetch_array($qA))
        	{
			
        	mysql_query("INSERT INTO x23_pindah_det (
        									idpindah,
        									nonota,
        									dealer1,
        									idgudang1,
        									rak1,
        									dealer2,
        									idgudang2,
        									rak2,
        									idbarang,
        									hargabelibersih,
        									hargajual,
        									hargajual2,
        									qty)
        								VALUES (
        									'$idpindah',
        									'$dA[nonota]',
        									'$dA[dealer1]',
        									'$dA[idgudang1]',
        									'$dA[rak1]',
        									'$dA[dealer2]',
        									'$dA[idgudang2]',
        									'$dA[rak2]',
        									'$dA[idbarang]',
        									'$dA[hargabelibersih]',
        									'$dA[hargajual]',
        									'$dA[hargajual2]',
        									'$dA[qty]')
        				");
        	}
        	
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_pindah',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH PINDAH STOK $tanggal $idpindah')
							");
				
		
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
?>
	
        <script src="js/jquery.min.js"></script>
		<script>
		function populateSelectNJ1(str)
		{
			if (str==""){
				document.getElementById("NJ2").value="";
				false;
			}
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			}
			else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (this.readyState == 4)
				{
					if (this.status == 200)
					{
					document.getElementById("NJ2").innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ1"?>&q="+str,true);
			xmlhttp.send();
			
			pilihan = document.inpNJ.idbarang.value;
			if(pilihan==''){
			document.inpNJ.notabeli.disabled = 1;
			document.inpNJ.notabeli.required = 0;
			}else{
			document.inpNJ.notabeli.disabled = 0;
			document.inpNJ.notabeli.required = 1;
			}
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
        
        <script>
			$(function(){
			           
			  var select = $('.select1').select2();
			});
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