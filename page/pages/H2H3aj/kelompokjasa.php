<?
	if($submenu == 'A')
		{
		unset($_SESSION[jnskj]);
		unset($_SESSION[kode]);
		unset($_SESSION[namajasa]);
		unset($_SESSION[harga]);
		unset($_SESSION[hargampm]);
		unset($_SESSION[kpbke]);
		unset($_SESSION[bataskm]);
		unset($_SESSION[batashari]);
		unset($_SESSION[hargaoli]);
		unset($_SESSION[oli]);
		unset($_SESSION[qtyoli]);
		
		if(empty($mod))
			{
			if(!empty($_REQUEST[delnota]))
				{
				$q1 = mysql_query("DELETE FROM x23_kelompokjasa WHERE id%2=0 AND id='$_REQUEST[delnota]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_kelompokjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS PENGELOMPOKAN JASA $_REQUEST[kode]')
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
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>PENGELOMPOKAN JASA</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B2"?>" style="cursor:pointer">
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Jasa KPB</button>
										</a>
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Jasa Lainnya</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h2/kelompokjasa.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
	                           		
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE</br>KELOMPOK JASA</th>
			                                    <th style="padding:7px">JENIS</th>
			                                    <th style="padding:7px">KPB KE</th>
			                                    <th style="padding:7px">NAMA KELOMPOK JASA</th>
			                                    <th width="15%" style="padding:7px">TARIF KELOMPOK</br>JASA KE KONSUMEN</th>
			                                    <th width="15%" style="padding:7px">HARGA</br>KPB KE MPM</th>
			                                    <th width="15%" style="padding:7px">HARGA</br>PENGGANTIAN OLI</th>
			                                    <th width="9%" style="padding:7px">STATUS</th>
			                                    <th width="1%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_kelompokjasa");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$d1[kode]'"));
											if($d1[status]=="1"){
												$status="AKTIF";
												}
											else{
												$status="TIDAK AKTIF";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kode]?></td>
			                                    <td><?echo $d1[jnskj]?></td>
			                                    <td align="center"><?echo $d1[kpbke]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[hargampm],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[hargaoli],"0","",".")?></span></td>
			                                    <td align=""><?echo $status?></td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a></td>
			                                    <!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <?
			                                                if(empty($dA[id]))
			                                                	{
															?>
															    <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delnota=$d1[id]&kode=$d1[kode]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                           		<?
																}
			                                                ?>
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
						}
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE id%2=0 AND id='$_REQUEST[id]'"));
						
						if(!empty($_REQUEST[tambahbarang]))
							{
							$norangka 	= strtoupper($_REQUEST['norangka']);
							$dcs = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_det WHERE id%2=0 AND kode='$d1[kode]' AND idtarifjasa='$_REQUEST[idtarifjasa]'"));	
							if(!empty($dcs[id]))
								{
								echo "<script>alert (' Mohon Ulangi, Karena Jasa Dan Kelompok Ini Sudah Ada Pada Database.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$_REQUEST[id]'/>";
								exit();
								}
							
							$q1 = mysql_query("INSERT INTO x23_kelompokjasa_det (
																kode,
																idtarifjasa)
															VALUE (
																'$d1[kode]',
																'$_REQUEST[idtarifjasa]')
												");
										
							if($q1)
								{
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							}
			
						if(!empty($_REQUEST[tambaholi]))
							{
							$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_oli WHERE id%2=0 AND kode='$d1[kode]' AND idoli='$_REQUEST[idoli]'"));
							if(!empty($dCek[id]))
								{
								echo "<script>alert (' Mohon Ulangi, Karena Oli Ini Sudah Ada Pada Database.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							
							$q1 = mysql_query("INSERT INTO x23_kelompokjasa_oli (
																kode,
																idoli)
															VALUE (
																'$d1[kode]',
																'$_REQUEST[idoli]')
												");
							
										
							if($q1)
								{
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							}
							 
						if(!empty($_REQUEST[del]))
							{
							mysql_query("DELETE FROM x23_kelompokjasa_det WHERE	id='$_REQUEST[del]'");
							}
							 
						if(!empty($_REQUEST[del2]))
							{
							mysql_query("DELETE FROM x23_kelompokjasa_oli WHERE	id='$_REQUEST[del2]'");
							}
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MASTER <small>PENGELOMPOKAN JASA &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Pengelompokan Jasa</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                	<?
				                	if($d1[jnskj]=="LAINNYA")
				                		{
									?>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">KODE KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="kode" value="<?echo $d1[kode]?>" class="form-control" maxlength="20" style="width:90%" disabled=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NAMA KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="namajasa" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" style="width:90%" disabled></td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">TARIF KELOMPOK JASA KE KONSUMEN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="harga" class="form-control uang" value="<?echo number_format($d1[harga],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
									<?
										}
										
				                	if($d1[jnskj]=="KPB")
				                		{
									?>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">KODE KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td colspan="2"><input type="text" name="kode" value="<?echo $d1[kode]?>" class="form-control" maxlength="20" style="width:90%" disabled=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>KPB KE</td>
					                        		<td>:</td>
					                        		<td colspan="2"><select name="kpbke" class="form-control" onchange="populateSelect1(this.value)" style="font-size:12px;padding:3px;width:30%" disabled="">
																		<option value='' selected></option>
																		<option value='1' <?if($d1[kpbke]=='1'){?>selected<?}?>>1</option>
																		<option value='2' <?if($d1[kpbke]=='2'){?>selected<?}?>>2</option>
																		<option value='3' <?if($d1[kpbke]=='3'){?>selected<?}?>>3</option>
																		<option value='4' <?if($d1[kpbke]=='4'){?>selected<?}?>>4</option>
																    </select>
					                        		</td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">MELIPUTI OLI</td>
					                    			<td>:</td>
					                        		<td colspan="2"><select name="oli" class="form-control" onchange="populateSelect1(this.value)" style="font-size:12px;padding:3px;width:30%" disabled="">
																		<option value='YA' <?if($d1[oli]=='YA'){?>selected<?}?>>YA</option>
																		<option value='TIDAK' <?if($d1[oli]=='TIDAK'){?>selected<?}?>>TIDAK</option>
																    </select>
					                        		</td>
					                    		</tr>
					                    		<tr>
					                    			<td>QTY OLI</td>
					                    			<td>:</td>
					                    			<td width="25%"><div class="input-group">
					                                        <input type="text" name="qtyoli" class="form-control uang" value="<?echo number_format($d1[qtyoli],"0","",".")?>" style="width:100%;text-align:right" maxlength="6" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">PCS</span>
					                                    </div>
							                        </td>
							                        <td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BATAS KM</td>
					                    			<td>:</td>
					                    			<td width="25%"><div class="input-group">
					                                        <input type="text" name="bataskm" class="form-control uang" value="<?echo number_format($d1[bataskm],"0","",".")?>" style="width:100%;text-align:right" maxlength="6" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">KM</span>
					                                    </div>
							                        </td>
							                        <td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BATAS SERVIS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><div class="input-group">
					                                        <input type="text" name="batashari" class="form-control uang" value="<?echo number_format($d1[batashari],"0","",".")?>" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">HARI SETELAH TANGGAL BELI</span>
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NAMA KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="namajasa" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" style="width:90%" disabled></td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">HARGA OLI</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargaoli" class="form-control uang" value="<?echo number_format($d1[hargaoli],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">HARGA KPB KE MPM</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargampm" class="form-control uang" value="<?echo number_format($d1[hargampm],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">TARIF KELOMPOK JASA KE KONSUMEN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="harga" class="form-control uang" value="<?echo number_format($d1[harga],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
									<?
										}
				                	?>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">STATUS</td>
					                        		<td width="3%">:</td>
					                        		<td colspan="2"><select name="status" class="form-control" onchange="populateSelect1(this.value)" style="font-size:12px;padding:3px;width:60%" required="">
																		<option value='1' <?if($d1[status]=='1'){?>selected<?}?>>AKTIF</option>
																		<option value='0' <?if($d1[status]=='0'){?>selected<?}?>>TIDAK AKTIF</option>
																    </select>
													</td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">					                    	
					                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Jasa</button>
											</a>
											<?
											if($d1[oli]=='YA')
												{
											?>
												<a data-toggle="modal" data-target="#compose-modal-tambah-oli" style="cursor:pointer">
			                           				<button type="button" class="btn btn-info pull-left" style="margin-left:10px"><i class="fa fa-plus"></i> &nbsp; Tambah Daftar Oli</button>
												</a>
											<?	
												}
											?> 
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE JASA</th>
			                                    <th style="padding:7px">NAMA JASA</th>
			                                    <th style="padding:7px">GOLONGAN</th>
			                                    <th width="20%" style="padding:7px">TARIF JASA SATUAN (RP)</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$d1[kode]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodejasa]?></td>
			                                    <td><?echo $dA[namajasa]?></td>
			                                    <td><?echo $dA[pangkat]?></td>
			                                    <td align="right"><span style="margin-right:40%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
			                                    <td width="1%" align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&del=$dA[id]&id=$_REQUEST[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a>
			                                    </td>
			                                </tr>
			                                
			                            <?
			                            	}
										$d2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$d1[kode]'"));		
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:40%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
									<?
									if($d1[oli]=='YA')
										{
									?>
									<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
								
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE OLI</th>
			                                    <th style="padding:7px">NAMA OLI</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA2 = mysql_query("SELECT * FROM x23_kelompokjasa_oli WHERE id%2=0 AND kode='$d1[kode]'");
			                            while($dA2 = mysql_fetch_array($qA2))
			                            	{
			                            	$dA3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id%2=0 AND id='$dA2[idoli]'"))
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA3[kodebarang]?></td>
			                                    <td><?echo $dA3[namabarang]?></td>
			                                    <td><?echo $dA3[varian]?></td>
			                                    <td align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&del2=$dA2[id]&id=$_REQUEST[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a>
			                                    </td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table> 
			                        <?
			                        	}
			                        ?>
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL JASA</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">KODE JASA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idtarifjasa" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw ORDER BY namajasa");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodejasa] | $dA[namajasa] | $dA[pangkat]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambahbarang" value="1">
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

<!-- ################## MODAL TAMBAH OLI ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-oli" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DAFTAR OLI</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">KODE OLI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idoli" class="form-control" id="select2" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang WHERE id%2=0 AND jns='OLI' ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambaholi" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                        	<!--
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
			                           	-->
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
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B2')
		{
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
			
        $dK = mysql_fetch_array(mysql_query("SELECT kode FROM x23_kelompokjasa WHERE id%2=0 AND SUBSTR(kode,3,2)='$p_tahun2' AND SUBSTR(kode,5,2)='$p_bulan' ORDER BY SUBSTR(kode,-3,3) DESC LIMIT 1"));
            
		if(empty($dK[kode]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dK[kode]",-3,3);
			$dig3 = substr($x,-1,1)+1;
			$dig2 = substr($x,-2,1);
			$dig1 = substr($x,-3,1);
			
			if ($dig3>9)
				{
				$dig3=0;
				$dig2=$dig2+1;
				}
			else
				{
				$dig3=$dig3;
				}
			
			if ($dig2>9)
				{
				$dig2=0;
				$dig1=$dig1+1;
				}
			else
				{
				$dig2=$dig2;
				}
			
			if ($dig1>9)
				{
				echo "kode habis";
				exit();
				}
			else
				{
				$dig1=$dig1;
				}
			}
			
			$kode = "KJ$p_tahun2$p_bulan-$dig1$dig2$dig3";
			
		mysql_query("DELETE FROM x23_kelompokjasa_det WHERE id%2=0 AND kode='$kode'");
		mysql_query("DELETE FROM x23_kelompokjasa_oli WHERE id%2=0 AND kode='$kode'");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>PENGELOMPOKAN JASA &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Pengelompokan Jasa</small></h4>
			                	
									<script>
									function populateSelect1(str)
									{
										pilihan = document.inputkj.oli.value;
										if(pilihan=='YA'){
										document.inputkj.hargaoli.disabled = 0;
										document.inputkj.hargaoli.required = 1;
										document.inputkj.qtyoli.disabled = 0;
										document.inputkj.qtyoli.required = 1;
										}else {
										document.inputkj.hargaoli.disabled = 1;
										document.inputkj.hargaoli.required = 0;
										document.inputkj.qtyoli.disabled = 1;
										document.inputkj.qtyoli.required = 0;
										}
									}
									</script>
				                	<form method="post" name="inputkj" action="<?echo "?opt=$opt&menu=$menu&submenu=C2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">KODE KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td colspan="2"><input type="text" name="kode" value="<?echo $kode?>" class="form-control" maxlength="20" style="width:90%" readonly></td>
					                        			<input type="hidden" name="jnskj" value="KPB">
					                        	</tr>
					                        	<tr>
					                        		<td>KPB KE</td>
					                        		<td>:</td>
					                        		<td colspan="2"><select name="kpbke" class="form-control" style="font-size:12px;padding:3px;width:30%" required="">
																		<option value='' selected></option>
																		<option value='1' <?if($_SESSION[kpbke]=='1'){?>selected<?}?>>1</option>
																		<option value='2' <?if($_SESSION[kpbke]=='2'){?>selected<?}?>>2</option>
																		<option value='3' <?if($_SESSION[kpbke]=='3'){?>selected<?}?>>3</option>
																		<option value='4' <?if($_SESSION[kpbke]=='4'){?>selected<?}?>>4</option>
																    </select>
					                        		</td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">MELIPUTI OLI</td>
					                    			<td>:</td>
					                        		<td colspan="2"><select name="oli" class="form-control" onchange="populateSelect1(this.value)" style="font-size:12px;padding:3px;width:30%" required="">
																		<option value='YA' <?if($_SESSION[oli]=='YA'){?>selected<?}?>>YA</option>
																		<option value='TIDAK' <?if($_SESSION[oli]=='TIDAK'){?>selected<?}?>>TIDAK</option>
																    </select>
					                        		</td>
					                    		</tr>
					                    		<tr>
					                    			<td>QTY OLI</td>
					                    			<td>:</td>
					                    			<td width="25%"><div class="input-group">
					                                        <input type="text" name="qtyoli" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="6" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">PCS</span>
					                                    </div>
							                        </td>
							                        <td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BATAS KM</td>
					                    			<td>:</td>
					                    			<td width="25%"><div class="input-group">
					                                        <input type="text" name="bataskm" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="6" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">KM</span>
					                                    </div>
							                        </td>
							                        <td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BATAS SERVIS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><div class="input-group">
					                                        <input type="text" name="batashari" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">HARI SETELAH TANGGAL BELI</span>
					                                    </div>
							                        </td>
							                    </tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NAMA KPB</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="namajasa" value="<?echo $_SESSION[namajasa]?>" class="form-control" maxlength="40" style="width:90%" required></td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">HARGA OLI</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargaoli" class="form-control uang" value="<?echo number_format($_SESSION[hargaoli],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" <?if($_SESSION[oli]=='TIDAK'){?>disabled=""<?}else{?>required=""<?}?>>
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">HARGA KPB KE MPM</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargampm" class="form-control uang" value="<?echo number_format($_SESSION[hargampm],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%" valign="top">TARIF KELOMPOK JASA KE KONSUMEN</td>
					                    			<td valign="top">:</td>
					                    			<td valign="top"><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="harga" class="form-control uang" value="<?echo number_format($_SESSION[harga],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
				                    </div>
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
	else if($submenu == 'C2')
		{			
		if(empty($_REQUEST[direct]) && empty($_REQUEST[tambahbarang]) && empty($_REQUEST[del]) && empty($_REQUEST[del2]) && empty($_REQUEST[ubahbarang]) && empty($_REQUEST[tambaholi]))
			{
			if($_REQUEST[bataskm]=="0"){
				echo "<script>alert ('Mohon Ulangi, Batas KM Tidak Boleh (Nol)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B2'/>";
				exit();
				}
			if($_REQUEST[batashari]=="0"){
				echo "<script>alert ('Mohon Ulangi, Batas Servis Tidak Boleh (Nol)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B2'/>";
				exit();
				}
			$_SESSION[jnskj]    = strtoupper($_REQUEST[jnskj]);
			$_SESSION[kode]    	= strtoupper($_REQUEST[kode]);
			$_SESSION[kpbke]    = strtoupper($_REQUEST[kpbke]);
			$_SESSION[oli]    	= strtoupper($_REQUEST[oli]);
			$_SESSION[qtyoli]   = strtoupper($_REQUEST[qtyoli]);
			$_SESSION[namajasa] = strtoupper($_REQUEST[namajasa]);
			$_SESSION[harga] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['harga']);
			$_SESSION[hargaoli] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargaoli']);
			$_SESSION[hargampm] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargampm']);
			$_SESSION[bataskm] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['bataskm']);
			$_SESSION[batashari] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['batashari']);
			}
			
		if(!empty($_REQUEST[tambahbarang]))
			{
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_det WHERE id%2=0 AND kode='$_SESSION[kode]' AND idtarifjasa='$_REQUEST[idtarifjasa]'"));
			if(!empty($dCek[id]))
				{
				echo "<script>alert (' Mohon Ulangi, Karena Jasa Dan Kelompok Ini Sudah Ada Pada Database.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			
			$q1 = mysql_query("INSERT INTO x23_kelompokjasa_det (
												kode,
												idtarifjasa)
											VALUE (
												'$_SESSION[kode]',
												'$_REQUEST[idtarifjasa]')
								");
			
						
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			}
			
		if(!empty($_REQUEST[tambaholi]))
			{
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_oli WHERE id%2=0 AND kode='$_SESSION[kode]' AND idoli='$_REQUEST[idoli]'"));
			if(!empty($dCek[id]))
				{
				echo "<script>alert (' Mohon Ulangi, Karena Oli Ini Sudah Ada Pada Database.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			
			$q1 = mysql_query("INSERT INTO x23_kelompokjasa_oli (
												kode,
												idoli)
											VALUE (
												'$_SESSION[kode]',
												'$_REQUEST[idoli]')
								");
			
						
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			}
			 
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_kelompokjasa_det WHERE	id='$_REQUEST[del]'");
			}
			 
		if(!empty($_REQUEST[del2]))
			{
			mysql_query("DELETE FROM x23_kelompokjasa_oli WHERE	id='$_REQUEST[del2]'");
			}
		
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$_SESSION[kode]'"));			                           
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MASTER <small>PENGELOMPOKAN JASA &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Pengelompokan Jasa</small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">KODE KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td colspan="2"><input type="text" name="kode" value="<?echo $_SESSION[kode]?>" class="form-control" maxlength="20" style="width:90%" readonly></td>
					                        			<input type="hidden" name="jnskj" value="KPB">
					                        	</tr>
					                        	<tr>
					                        		<td>KPB KE</td>
					                        		<td>:</td>
					                        		<td colspan="2"><select name="kpbke" class="form-control" onchange="populateSelect1(this.value)" style="font-size:12px;padding:3px;width:30%" disabled="">
																		<option value='' selected></option>
																		<option value='1' <?if($_SESSION[kpbke]=='1'){?>selected<?}?>>1</option>
																		<option value='2' <?if($_SESSION[kpbke]=='2'){?>selected<?}?>>2</option>
																		<option value='3' <?if($_SESSION[kpbke]=='3'){?>selected<?}?>>3</option>
																		<option value='4' <?if($_SESSION[kpbke]=='4'){?>selected<?}?>>4</option>
																    </select>
					                        		</td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">MELIPUTI OLI</td>
					                    			<td>:</td>
					                        		<td colspan="2"><select name="oli" class="form-control" onchange="populateSelect1(this.value)" style="font-size:12px;padding:3px;width:30%" disabled="">
																		<option value='YA' <?if($_SESSION[oli]=='YA'){?>selected<?}?>>YA</option>
																		<option value='TIDAK' <?if($_SESSION[oli]=='TIDAK'){?>selected<?}?>>TIDAK</option>
																    </select>
					                        		</td>
					                    		</tr>
					                    		<tr>
					                    			<td>QTY OLI</td>
					                    			<td>:</td>
					                    			<td width="25%"><div class="input-group">
					                                        <input type="text" name="qtyoli" class="form-control uang" value="<?echo number_format($_SESSION[qtyoli],"0","",".")?>" style="width:100%;text-align:right" maxlength="6" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">PCS</span>
					                                    </div>
							                        </td>
							                        <td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BATAS KM</td>
					                    			<td>:</td>
					                    			<td width="25%"><div class="input-group">
					                                        <input type="text" name="bataskm" class="form-control uang" value="<?echo number_format($_SESSION[bataskm],"0","",".")?>" style="width:100%;text-align:right" maxlength="6" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">KM</span>
					                                    </div>
							                        </td>
							                        <td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BATAS SERVIS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><div class="input-group">
					                                        <input type="text" name="batashari" class="form-control uang" value="<?echo number_format($_SESSION[batashari],"0","",".")?>" style="width:100%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                        <span class="input-group-addon" style="width:60px;text-align:left">HARI SETELAH TANGGAL BELI</span>
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NAMA KPB</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="namajasa" value="<?echo $_SESSION[namajasa]?>" class="form-control" maxlength="40" style="width:90%" disabled></td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">HARGA OLI</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargaoli" class="form-control uang" value="<?echo number_format($_SESSION[hargaoli],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">HARGA KPB KE MPM</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargampm" class="form-control uang" value="<?echo number_format($_SESSION[hargampm],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">TARIF KELOMPOK JASA KE KONSUMEN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="harga" class="form-control uang" value="<?echo number_format($_SESSION[harga],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled>
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
					                    	<input type="hidden" name="kpbke" value="<?echo $_SESSION[kpbke]?>">
					                    	<input type="hidden" name="oli" value="<?echo $_SESSION[oli]?>">
					                    	<input type="hidden" name="bataskm" value="<?echo $_SESSION[bataskm]?>">
					                    	<input type="hidden" name="batashari" value="<?echo $_SESSION[batashari]?>">
					                    	<?
											$dTS = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS ts FROM x23_kelompokjasa_det WHERE id%2=0 AND kode='$_SESSION[kode]'"));
											if($dTS[ts]!="0"){
												if($_SESSION[oli]=='YA'){
												$dTS2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS ts FROM x23_kelompokjasa_oli WHERE id%2=0 AND kode='$_SESSION[kode]'"));
													if($dTS2[ts]!="0"){
											?>
					                        		<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<?
													}
												}
												else{
											?>
					                        		<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<?
												}
											}
											?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B2&kode=$_SESSION[kode]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Jasa</button>
											</a>
											<?
											if($_SESSION[oli]=='YA')
												{
											?>
												<a data-toggle="modal" data-target="#compose-modal-tambah-oli" style="cursor:pointer">
			                           				<button type="button" class="btn btn-info pull-left" style="margin-left:10px"><i class="fa fa-plus"></i> &nbsp; Tambah Daftar Oli</button>
												</a>
											<?	 
												}
											?> 
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE JASA</th>
			                                    <th style="padding:7px">NAMA JASA</th>
			                                    <th style="padding:7px">GOLONGAN</th>
			                                    <th width="20%" style="padding:7px">TARIF JASA SATUAN (RP)</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$_SESSION[kode]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodejasa]?></td>
			                                    <td><?echo $d1[namajasa]?></td>
			                                    <td><?echo $d1[pangkat]?></td>
			                                    <td align="right"><span style="margin-right:40%"><?echo number_format($d1[tarif],"0","",".")?></span></td>
			                                    <td width="1%" align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]&direct="?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a>
			                                    </td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:40%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
									<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
								
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE OLI</th>
			                                    <th style="padding:7px">NAMA OLI</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA2 = mysql_query("SELECT * FROM x23_kelompokjasa_oli WHERE id%2=0 AND kode='$_SESSION[kode]'");
			                            while($dA2 = mysql_fetch_array($qA2))
			                            	{
			                            	$dA3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id%2=0 AND id='$dA2[idoli]'"))
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA3[kodebarang]?></td>
			                                    <td><?echo $dA3[namabarang]?></td>
			                                    <td><?echo $dA3[varian]?></td>
			                                    <td align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del2=$dA2[id]&direct="?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a>
			                                    </td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table> 
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL JASA</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">KODE JASA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idtarifjasa" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw ORDER BY namajasa");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodejasa] | $dA[namajasa] | $dA[pangkat]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambahbarang" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                        	<!--
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
			                           	-->
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

<!-- ################## MODAL TAMBAH OLI ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-oli" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DAFTAR OLI</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">KODE OLI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idoli" class="form-control" id="select2" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang WHERE id%2=0 AND jns='OLI' ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambaholi" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                        	<!--
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
			                           	-->
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
			
        $dK = mysql_fetch_array(mysql_query("SELECT kode FROM x23_kelompokjasa WHERE id%2=0 AND SUBSTR(kode,3,2)='$p_tahun2' AND SUBSTR(kode,5,2)='$p_bulan' ORDER BY SUBSTR(kode,-3,3) DESC LIMIT 1"));
            
		if(empty($dK[kode]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dK[kode]",-3,3);
			$dig3 = substr($x,-1,1)+1;
			$dig2 = substr($x,-2,1);
			$dig1 = substr($x,-3,1);
			
			if ($dig3>9)
				{
				$dig3=0;
				$dig2=$dig2+1;
				}
			else
				{
				$dig3=$dig3;
				}
			
			if ($dig2>9)
				{
				$dig2=0;
				$dig1=$dig1+1;
				}
			else
				{
				$dig2=$dig2;
				}
			
			if ($dig1>9)
				{
				echo "kode habis";
				exit();
				}
			else
				{
				$dig1=$dig1;
				}
			}
			
			$kode = "KJ$p_tahun2$p_bulan-$dig1$dig2$dig3";
			
		mysql_query("DELETE FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$nonota'");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>PENGELOMPOKAN JASA &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Pengelompokan Jasa</small></h4>
			                	
				                	<form method="post" name="inputkj" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">KODE KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="kode" value="<?echo $kode?>" class="form-control" maxlength="20" style="width:90%" readonly></td>
					                        			<input type="hidden" name="jnskj" value="LAINNYA">
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-8">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NAMA KELOMPOK JASA</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="namajasa" value="<?echo $_SESSION[namajasa]?>" class="form-control" maxlength="40" style="width:90%" required></td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">TARIF KELOMPOK JASA KE KONSUMEN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="harga" class="form-control uang" value="<?echo number_format($_SESSION[harga],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
				                    </div>
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
					                	</div>
				                    </div>
				                    </form>
				                </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			<script>
			function populateSelect1(str)
			{
				pilihan = document.inputkj.jnskj.value;
				if(pilihan=='KPB'){
				document.inputkj.hargampm.disabled = 0;
				}else{
				document.inputkj.hargampm.disabled = 1;
				}
			}
			</script>
<?
		}
		
	else if($submenu == 'C')
		{
		if(empty($_REQUEST[direct]) && empty($_REQUEST[tambahbarang]) && empty($_REQUEST[del]) && empty($_REQUEST[ubahbarang]))
			{
			$_SESSION[jnskj]    = strtoupper($_REQUEST[jnskj]);
			$_SESSION[kode]    	= strtoupper($_REQUEST[kode]);
			$_SESSION[namajasa] = strtoupper($_REQUEST[namajasa]);
			$_SESSION[harga] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['harga']);
			$_SESSION[hargampm] 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargampm']);
			}
			
		if(!empty($_REQUEST[tambahbarang]))
			{
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_kelompokjasa_det WHERE id%2=0 AND kode='$_SESSION[kode]' AND idtarifjasa='$_REQUEST[idtarifjasa]'"));
			if(!empty($dCek[id]))
				{
				echo "<script>alert (' Mohon Ulangi, Karena Jasa Dan Kelompok Ini Sudah Ada Pada Database.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			
			$q1 = mysql_query("INSERT INTO x23_kelompokjasa_det (
												kode,
												idtarifjasa)
											VALUE (
												'$_SESSION[kode]',
												'$_REQUEST[idtarifjasa]')
								");
			
						
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			}
			 
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_kelompokjasa_det WHERE	id='$_REQUEST[del]'");
			}
		
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(tarif) AS total FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$_SESSION[kode]'"));			                           
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MASTER <small>PENGELOMPOKAN JASA &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Pengelompokan Jasa</small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">KODE KELOMPOK JASA</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="kode" value="<?echo $_SESSION[kode]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-8">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NAMA KELOMPOK JASA</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="namajasa" value="<?echo $_SESSION[namajasa]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
					                        	</tr>
					                    		<tr>
					                    			<td width="40%">TARIF KELOMPOK JASA KE KONSUMEN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="harga" class="form-control uang" value="<?echo number_format($_SESSION[harga],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
					                    	<?
											$dTS = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS ts FROM x23_kelompokjasa_det WHERE id%2=0 AND kode='$_SESSION[kode]'"));
											if($dTS[ts]!="0"){
											?>
					                        	<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<?
											}
											?>
											
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&kode=$_SESSION[kode]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Jasa</button>
											</a>
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE JASA</th>
			                                    <th style="padding:7px">NAMA JASA</th>
			                                    <th style="padding:7px">GOLONGAN</th>
			                                    <th width="20%" style="padding:7px">TARIF JASA SATUAN (RP)</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE id%2=0 AND kode='$_SESSION[kode]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodejasa]?></td>
			                                    <td><?echo $d1[namajasa]?></td>
			                                    <td><?echo $d1[pangkat]?></td>
			                                    <td align="right"><span style="margin-right:40%"><?echo number_format($d1[tarif],"0","",".")?></span></td>
			                                    <td width="1%" align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]&direct="?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a>
			                                    </td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:40%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL JASA</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">KODE JASA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idtarifjasa" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw ORDER BY namajasa");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodejasa] | $dA[namajasa] | $dA[pangkat]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambahbarang" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                        	<!--
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
			                           	-->
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'D')
		{
		$q1 = mysql_query("INSERT INTO x23_kelompokjasa (
										jnskj,
										kode,
										kpbke,
										oli,
										qtyoli,
										nama,
										harga,
										hargaoli,
										hargampm,
										bataskm,
										batashari,
										inputx)
									VALUES (
										'$_SESSION[jnskj]',
										'$_SESSION[kode]',
										'$_SESSION[kpbke]',
										'$_SESSION[oli]',
										'$_SESSION[qtyoli]',
										'$_SESSION[namajasa]',
										'$_SESSION[harga]',
										'$_SESSION[hargaoli]',
										'$_SESSION[hargampm]',
										'$_SESSION[bataskm]',
										'$_SESSION[batashari]',
										NOW())
						");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'x23_kelompokjasa',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'TAMBAH PENGELOMPOKAN JASA $_SESSION[kode] $_SESSION[namajasa]')
						");
					
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&direct=1'/>";
			exit();
			}
		}
		
	else if($submenu == 'E')
		{
		$harga	  = preg_replace( "/[^0-9]/", "",$_REQUEST['harga']);
		$hargampm	  = preg_replace( "/[^0-9]/", "",$_REQUEST['hargampm']);
		$hargaoli	  = preg_replace( "/[^0-9]/", "",$_REQUEST['hargaoli']);
			
		$q1 = mysql_query("UPDATE x23_kelompokjasa SET 
										harga='$harga',
										hargampm='$hargampm',
										hargaoli='$hargaoli',
										status='$_REQUEST[status]',
										updatex='$updatex'
									WHERE id%2=0 AND id='$_REQUEST[id]'
						");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'x23_kelompokjasa',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'UBAH PENGELOMPOKAN JASA $_REQUEST[id]')
						");
					
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=edit&id=$_REQUEST[id]'/>";
			exit();
			}
		}
?>
	
        <script src="js/jquery.min.js"></script>
        <script>
        //SELECT2
			$(function(){
			           
			  var select = $('#select1').select2();
			  var select = $('#select2').select2();
			  
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
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>