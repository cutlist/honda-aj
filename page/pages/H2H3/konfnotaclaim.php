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
			                	<h4>KONFIRMASI NOTA CLAIM <small>OLI KE MPM</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Dilanjutkan Ke Menu Master Input Harga Untuk Claim Oli Yang Tiba, Dan Untuk Claim Oli Yang Ditolak Proses Dilanjutkan Ke Menu Penagihan Oli MPM Pada Bagian Administrasi Jika Ditagih Kembali.</p>";
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
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA CLAIM OLI</th>
			                                    <th style="padding:7px">TGL NOTA CLAIM OLI</th>
			                                    <th style="padding:7px">NO. PO CLAIM MPM</th>
			                                    <th style="padding:7px">TGL PO CLAIM MPM</th>
			                                    <th width="10%" style="padding:7px">TOTAL QTY CLAIM</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli WHERE scan='0' AND jns='CLAIM'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=u1&id=$d1[id]"?>'">
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nopo]?></td>
			                                    <td align=""><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
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
		
	else if($submenu == 'u1')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KONFIRMASI NOTA CLAIM <small>OLI KE MPM</small></h4>
			                	
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" name="" value="MPM" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u2"?>">
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">TGL NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">KODE PAKET</th>
			                                    <th style="padding:7px">KPB KE</th>
			                                    <th style="padding:7px">NAMA KPB</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            mysql_query("TRUNCATE temp_x23_konfclaim_det");
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE nonota='$d1[nonota]'");
			                            while($d2 = mysql_fetch_array($q1))
			                            	{
			                            	$dD1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_claimoli_det WHERE id='$d2[id_claimoli_det]'"));
			                            	
			                            	mysql_query("INSERT INTO temp_x23_konfclaim_det VALUES ('','$d2[nonota]','$d2[id]','$d2[idbarang]','$d2[qty]','','','','$d2[id_claimoli_det]','','','')");
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$dD1[nonotaservis]"?></label></td>
			                                    <td><?echo date("d-m-Y",strtotime($dD1[tglservis]))?></td>
			                                    <td><?echo $dD1[kodepaket]?></td>
			                                    <td><?echo $dD1[kpbke]?></td>
			                                    <td><?echo $dD1[namakpb]?></td>
			                                    <td><?echo $dD1[kodebarang]?></td>
			                                    <td><?echo "$dD1[namabarang] | $dD1[varian]"?></td>
			                                </tr>
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
			                        <?
	                                if($d1[konf]=='1')
	                                	{
	                                ?>
				                        </br>
				                        <table>
				                        	<tr>
				                        		<td colspan="3"><b>Keterangan</b></td>
				                        	</tr>
				                        	<tr>
				                        		<td style="color:#ff0227">Merah</td>
				                        		<td width="15px" align="center">:</td>
				                        		<td>Qty Barang Tiba Tidak Sama Dengan Qty Claim</td>
				                        	</tr>
				                        	<tr>
				                        		<td>Hitam</td>
				                        		<td align="center">:</td>
				                        		<td>Qty Barang Tiba Sama Dengan Qty Claim</td>
				                        	</tr>
				                        </table>
			                        <?
			                        	}
			                        ?>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix"> 
				                        <?
			                                if($d1[konf]=='0')
			                                	{
			                            ?>
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
				                        <?
				                        		}
				                        ?>
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
		
	else if($submenu == 'u2')
		{
		if(!empty($_REQUEST[ubahbarang]))
			{
			$q1 = mysql_query("UPDATE temp_x23_konfclaim_det SET
												statusclaim='$_REQUEST[statusclaim]',
												kettolak='$_REQUEST[kettolak]',
												tagihkembali='$_REQUEST[tagihkembali]',
												idgudang='$_REQUEST[idgudang]',
												rak='$_REQUEST[rak]'
											WHERE id='$_REQUEST[ubahbarang]'
								");
						
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&cek=0'/>";
				exit();
				}
			}
			
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>KONFIRMASI NOTA CLAIM <small>OLI KE MPM</small></h4>
			                	
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" name="" value="MPM" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u3"?>">
			                        <table class="table table-striped" id="example2" style="width: 130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="1%" style="padding:7px"><center>UBAH</center></th>
			                                    <th style="padding:7px">NO. NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">TGL NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">KODE PAKET</th>
			                                    <th style="padding:7px">KPB KE</th>
			                                    <th style="padding:7px">NAMA KPB</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th style="padding:7px">TAGIH KEMBALI</th>
			                                    <th style="padding:7px">KETERANGAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM temp_x23_konfclaim_det WHERE notabeli='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            	$dD1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_claimoli_det WHERE id='$dA[id_claimoli_det]'"));
											$dB  = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id='$dA[idgudang]]'"));
			                            ?>
			                                <tr style="cursor:pointer;">
			                                    <td width="1%" align="center"><a data-toggle="modal" data-target="#compose-modal-ubah-barang<?echo $dA[id]?>" style="cursor:pointer">
							                           				<i class="fa fa-edit"></i>
																</a>
			                                        </td>
			                                    <td><?echo "$dD1[nonotaservis]"?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dD1[tglservis]))?></td>
			                                    <td><?echo "$dD1[kodepaket]"?></td>
			                                    <td><?echo "$dD1[kpbke]"?></td>
			                                    <td><?echo "$dD1[namakpb]"?></td>
			                                    <td><?echo "$dD1[kodebarang]"?></td>
			                                    <td><?echo "$dD1[namabarang] | $dD1[varian]"?></td>
			                                    <?
			                                    if(empty($dA[statusclaim]))
			                                    	{
												?>
				                                    <td>-</td>
				                                    <td>-</td>
				                                    <td>-</td>
				                                    <td>-</td>
				                                    <td>-</td>
												<?
													}
												else
													{
												?>
				                                    <td><?echo $dB[gudang]?></td>
				                                    <td><?echo $dA[rak]?></td>
			                                    	<td><?echo $dA[statusclaim]?></td>
				                                    <td><?echo $dA[tagihkembali]?></td>
			                                    	<td><?echo $dA[kettolak]?></td>
												<?
													}
			                                    ?>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        <?
	                                if($d1[konf]=='1')
	                                	{
	                                ?>
				                        </br>
				                        <table>
				                        	<tr>
				                        		<td colspan="3"><b>Keterangan</b></td>
				                        	</tr>
				                        	<tr>
				                        		<td style="color:#ff0227">Merah</td>
				                        		<td width="15px" align="center">:</td>
				                        		<td>Qty Barang Tiba Tidak Sama Dengan Qty Claim</td>
				                        	</tr>
				                        	<tr>
				                        		<td>Hitam</td>
				                        		<td align="center">:</td>
				                        		<td>Qty Barang Tiba Sama Dengan Qty Claim</td>
				                        	</tr>
				                        </table>
			                        <?
			                        	}
			                        ?>
					                
				           			<div class="col-xs-12">
				                        	
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
				                        <div class="modal-footer clearfix"> 
				                        <?
			                                if($d1[konf]=='0'){
												$dc1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_x23_konfclaim_det WHERE notabeli='$d1[nonota]' AND statusclaim=''"));
				                                if($dc1[total]>'0'){}
												else{
			                            ?>
			                            			<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                        <?
													}
				                        		}
				                        ?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                        </form>
			                    </div>
			                </div>
		            <?
					$q3 = mysql_query("SELECT * FROM temp_x23_konfclaim_det WHERE notabeli='$d1[nonota]'");
		            while($d3 = mysql_fetch_array($q3))
		            	{
						//$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id='$d3[id]'"));
		            ?>
<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah-barang<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL BARANG</h4>
				                    </div>
									
									<script>
									function populateSelect<?echo $d3[id]?>(str)
										{
										pilihan = document.inp<?echo $d3[id]?>.statusclaim.value;
										if(pilihan=='')
											{
											document.inp<?echo $d3[id]?>.tagihkembali.disabled = 1;
											document.inp<?echo $d3[id]?>.kettolak.disabled = 1;
											document.inp<?echo $d3[id]?>.idgudang.disabled = 1;
											document.inp<?echo $d3[id]?>.rak.disabled = 1;
											}
										else if(pilihan=='TERGANTIKAN')
											{
											document.inp<?echo $d3[id]?>.tagihkembali.disabled = 1;
											document.inp<?echo $d3[id]?>.kettolak.disabled = 1;
											document.inp<?echo $d3[id]?>.idgudang.disabled = 0;
											document.inp<?echo $d3[id]?>.idgudang.required = 1;
											document.inp<?echo $d3[id]?>.rak.disabled = 0;
											document.inp<?echo $d3[id]?>.rak.required = 1;
											}
										else if(pilihan=='DITOLAK')
											{
											document.inp<?echo $d3[id]?>.tagihkembali.disabled = 0;
											document.inp<?echo $d3[id]?>.tagihkembali.required = 1;
											document.inp<?echo $d3[id]?>.kettolak.disabled = 0;
											document.inp<?echo $d3[id]?>.kettolak.required = 1;
											document.inp<?echo $d3[id]?>.idgudang.disabled = 1;
											document.inp<?echo $d3[id]?>.rak.disabled = 1;
											}
										}
									</script>
									
				                   	<form method="post" name="inp<?echo $d3[id]?>" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d3[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="statusclaim" class="form-control" style="width: 100%" onchange="populateSelect<?echo $d3[id]?>(this.value)">
														<option value="" selected="">PILIH</option>
														<option value="TERGANTIKAN">SUDAH TERGANTIKAN</option>
														<option value="DITOLAK">DITOLAK</option>
														</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TAGIH KEMBALI</td>
				                    			<td>:</td>
				                    			<td><select name="tagihkembali" class="form-control" style="width: 30%" disabled="">
														<option value="YA">YA</option>
														<option value="TIDAK" selected="">TIDAK</option>
														</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KETERANGAN TOLAK</td>
				                    			<td>:</td>
				                    			<td><textarea name="kettolak" class="form-control" maxlength="200" disabled=""></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:40%" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($dA[id]==$d3[idgudang]){?>selected=""<?}?>><?echo "$dA[gudang]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" style="font-size:12px;padding:3px;width:40%" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[rak]?>' <?if($dA[rak]==$d3[rak]){?>selected=""<?}?>><?echo "$dA[rak]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="ubahbarang" value="<?echo $d3[id]?>">
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'u3')
		{
		//mysql_query("DELETE FROM x23_stokpart WHERE nonota='$_REQUEST[nonota]'");
			  
		$p_tahun = date("Y");
		$p_bulan = date("m");
			
		$qA  = mysql_query("SELECT * FROM temp_x23_konfclaim_det WHERE notabeli='$_REQUEST[nonota]'");
		$dId = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli WHERE nonota='$_REQUEST[nonota]'"));
		
		$qty=0;
        while($dA = mysql_fetch_array($qA))
        	{   
        	mysql_query("UPDATE x23_claimoli_det SET statusclaim='$dA[statusclaim]',tagihkembali='$dA[tagihkembali]',kettolak='$dA[kettolak]' WHERE id='$dA[id_claimoli_det]'");
        	if($dA[statusclaim] == "TERGANTIKAN")
				{
	        	mysql_query("UPDATE x23_notabeli_det SET tgltiba=CURDATE(),idgudang='$dA[idgudang]',rak='$dA[rak]' WHERE id='$dA[idnotabelidet]'");	
	        	mysql_query("INSERT INTO x23_stokpart (
	        									idgudang, 
	        									rak, 
	        									nonota, 
	        									idbarang,
	        									hargabelibersih, 
	        									hargajual, 
	        									stok, 
	        									status, 
	        									inputx,
	        									updatex) 
	        								VALUES (
	        									'$dA[idgudang]',
	        									'$dA[rak]', 
	        									'$dA[notabeli]', 
	        									'$dA[idbarang]', 
	        									'0', 
	        									'0', 
	        									'1',
	        									'1',
	        									NOW(),
	        									'$updatex') 
	        				");
	        	$qty++;
	        	} 
			else if($dA[statusclaim] == "DITOLAK")
				{
				if($dA[tagihkembali] == "YA")
					{
					$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_claimoli_det WHERE id='$dA[id_claimoli_det]'"));
        			mysql_query("INSERT INTO x23_claimoli_det (
        											id_notajual_det,
        											nonotaservis,
        											tglservis,
        											kodepaket,
        											kpbke,
        											namakpb,
        											idbarang,
        											kodebarang,
        											varian,
        											namabarang,
        											hargaoli)
        										VALUES (
        											'$dB[id_notajual_det]',
        											'$dB[nonotaservis]',
        											'$dB[tglservis]',
        											'$dB[kodepaket]',
        											'$dB[kpbke]',
        											'$dB[namakpb]',
        											'$dB[idbarang]',
        											'$dB[kodebarang]',
        											'$dB[varian]',
        											'$dB[namabarang]',
        											'$dB[hargaoli]')
        							");
		        	}
	        	}
        	}
			
		$dH1 = mysql_fetch_array(mysql_query("SELECT *,COUNT(statusclaim) AS total FROM x23_claimoli_det WHERE nonota='$_REQUEST[nonota]' AND statusclaim='DITOLAK'"));
    	if($dH1[total] > '0'){
			$p_tahun = date("Y");
			$p_bulan = date("m");	
			mysql_query("INSERT INTO x23_abis_ikesalahan (
											idpenagihanoli, 
											tahun, 
											bulan, 
											tanggal,
											kasus, 
											tbl,
											inputx) 
										VALUES (
											'$dId[id]', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'INDIKASI KESALAHAN : TERDAPAT CLAIM OLI YANG DITOLAK SEBANYAK $dH1[total] PCS PADA NO. NOTA CLAIM OLI : $_REQUEST[nonota]', 
											'x23_notabeli', 
											NOW())
							");
			}
									
		mysql_query("UPDATE x23_notabeli SET totalqty='$qty',idsupplier='1',scan='1',konf='1',harga='0',gtbayar=grandtotal,iduserkonf='$_SESSION[id]',updatex='$updatex' WHERE nonota='$_REQUEST[nonota]'");
		
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_stokpart',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH STOK $_REQUEST[nonota]')
							");
		
		if($q3)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
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
        //SELECT2
			$(function(){
			           
			  var select = $('.select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });
			  $("#tagPicker2").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
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
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>