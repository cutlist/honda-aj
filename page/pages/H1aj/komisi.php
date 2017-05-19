<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[delinsentif]))
				{
				$q1 = mysql_query("DELETE FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$_REQUEST[delinsentif]'");
				
				if($q1)
					{
					//echo "<script>alert ('Proses berhasil.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
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
						unset($_SESSION[grup]);
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Komisi Baru</button>
										</a>
										
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px">POSISI</th>
			                                    <th width="" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if($_SESSION[posisi]=="DIREKSI"){
											$q1 = mysql_query("SELECT * FROM tbl_insentif_karyawan_vw GROUP BY id_karyawan");
											}
										else{
											$q1 = mysql_query("SELECT * FROM tbl_insentif_karyawan_vw WHERE id%2=0 AND id_posisi NOT IN ('1','6') GROUP BY id_karyawan");
											}
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[posisi]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
													<?
													if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
														{
													?>
															<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
																<span class="caret"></span>
																<span class="sr-only">Actions</span>
															</button>
															<ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id_karyawan=$d1[id_karyawan]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id_karyawan=$d1[id_karyawan]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
																<?
																if($_SESSION[posisi]=='DIREKSI'){
																?>
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delinsentif=$d1[id_karyawan]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
																<?
																}
																?>	
															</ul>
														</div>
													<?
														}
													?>
			                                        </td>
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
<?
						}
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_insentif_karyawan_vw WHERE id%2=0 AND id_karyawan='$_REQUEST[id_karyawan]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Komisi</small></h4>
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="" value="<?echo $d1[nama]?>" class="form-control" maxlength="20" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="" value="<?echo $d1[posisi]?>" class="form-control" maxlength="50" readonly=""></td>
				                    		</tr>
		                            	</table>
				                    </div>
								<?
									if($d1[id_posisi]=='2' || $d1[id_posisi]=='7' || $d1[id_posisi]=='6')
										{
								?>
										<div style="min-height:90px;padding:20px">
				                    		<table style="width:100%;">
					                    		<tr>
					                    			<td width="15%" valign="top">KOMISI</td>
					                    			<td width="1%" valign="top">:</td>
					                    			<td>
									                    <table class="table table-striped" style="width:100%"> 
								                            <thead style="cursor:pointer">
																<th class="btn-info" style="text-align:center">TARGET PENJUALAN MINIMUM</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN CASH</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN KREDIT</th>
															</thead>
							                    	<?
							                    		$qG = mysql_query("SELECT * FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$d1[id_karyawan]'");
							                    		while($dG=mysql_fetch_array($qG))
							                    			{
							                    	?>
															<tr>
																<td align="center"><u>></u> <?echo number_format($dG[target],'0','','.')?> UNIT</td>
																<td align="center">RP. <?echo number_format($dG[cash],'0','','.')?> PER UNIT</td>
																<td align="center">RP. <?echo number_format($dG[kredit],'0','','.')?> PER UNIT</td>
															</tr>
													<?
															}
													?>
												        </table>
													</td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
								<?
										}
										
									else if($d1[id_posisi]=='9')
										{
								?>
										<div style="min-height:90px;padding:20px">
				                    		<table style="width:100%;">
					                    		<tr>
					                    			<td width="15%" valign="top">KOMISI</td>
					                    			<td width="1%" valign="top">:</td>
					                    			<td>
									                    <table class="table table-striped" style="width:100%"> 
								                            <thead style="cursor:pointer">
																<th class="btn-info" style="text-align:center">TARGET PENJUALAN MINIMUM</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN CASH</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN KREDIT</th>
															</thead>
							                    	<?
							                    		$qG = mysql_query("SELECT * FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$d1[id_karyawan]'");
							                    		while($dG=mysql_fetch_array($qG))
							                    			{
							                    	?>
															<tr>
																<td align="center"><input type="text" name="target1" class="form-control" style="width:100%;padding-right:20%;text-align:right" value="<?echo number_format($dG[target],'0','','.')?> UNIT" onkeypress="return buat_angka(event,'1234567890')" readonly=""/></td>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" class="form-control" name="cash1" style="padding-right:15%;text-align:right" value="<?echo number_format($dG[cash],'0','','.')?> PER UNIT" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																	</div>
																</td>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
								                                        <span class="input-group-addon">RP.</span>
																		<input type="text" class="form-control" name="kredit1" style="padding-right:15%;text-align:right" value="<?echo number_format($dG[kredit],'0','','.')?> PER UNIT" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																	</div>
																</td>
															</tr>
													<?
															}
													?>
												        </table>
													</td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
								<?
										}
									
									else if($d1[id_posisi]=='3' || $d1[id_posisi]=='4' || $d1[id_posisi]=='5' || $d1[id_posisi]=='8')
										{
			                    		$dG=mysql_fetch_array(mysql_query("SELECT * FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$d1[id_karyawan]'"));
								?>
										
										<div style="min-height:90px;padding:20px"">
				                    		<table style="width:50%;">
					                    		<tr>
					                    			<td width="30%">KOMISI</td>
					                    			<td width="2%">:</td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" class="form-control uang" value="<?echo number_format($dG[flat],'0','','.')?> PER TRANSAKSI UNIT MOTOR" style="width:85%;text-align:right" readonly="" onkeypress="return buat_angka(event,'1234567890')"/>
														</div>
													</td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
								<?
										}
								?>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                </div>
			                </div>
			            </div>
<?
						}
						
					else if($mod == "edit")
						{
						if(!empty($_REQUEST[tambahdetinsentif]))
							{
							if($_REQUEST[id_posisi]=='2' || $_REQUEST[id_posisi]=='7' || $_REQUEST[id_posisi]=='6' || $_REQUEST[id_posisi]=='9')
								{
					            $target = preg_replace( "/[^0-9]/", "",$_POST['target'.$count]);
					            $cash   = preg_replace( "/[^0-9]/", "",$_POST['cash'.$count]);
					            $kredit = preg_replace( "/[^0-9]/", "",$_POST['kredit'.$count]);
					            
								$q1 = mysql_query("INSERT INTO tbl_insentif_karyawan VALUES ('','$_REQUEST[id_karyawan]','$target','$cash','$kredit','')");
						        }
							else 
								{
						        $flat = preg_replace( "/[^0-9]/", "",$_POST[flat]);
								$q1 = mysql_query("UPDATE tbl_insentif_karyawan SET flat='$flat' WHERE id%2=0 AND id='$_REQUEST[id]'");
								}
							
							if($q1)
								{ 
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&&mod=edit&id_karyawan=$_GET[id_karyawan]'/>";
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								exit();
								}
							}
							
						if(!empty($_REQUEST[deldetinsentif]))
							{
							$q1 = mysql_query("DELETE FROM tbl_insentif_karyawan WHERE id%2=0 AND id='$_REQUEST[iddet]'");
							
							if($q1)
								{
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								exit();
								}
							}
		
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_insentif_karyawan_vw WHERE id%2=0 AND id_karyawan='$_REQUEST[id_karyawan]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive">
			                	<h4>MASTER <small>KOMISI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Komisi</small></h4>
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="" value="<?echo $d1[nama]?>" class="form-control" maxlength="20" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="" value="<?echo $d1[posisi]?>" class="form-control" maxlength="50" readonly=""></td>
				                    		</tr>
		                            	</table>
				                    </div>
								<?
									if($d1[id_posisi]=='2' || $d1[id_posisi]=='7' || $d1[id_posisi]=='6')
										{
								?>
										<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:220px;">
				                    		<table style="width:100%;">
					                    		<tr>
					                    			<td width="15%" valign="top">KOMISI</td>
					                    			<td width="1%" valign="top">:</td>
					                    			<td>
									                    <table class="table table-striped" style="width:100%"> 
								                            <thead style="cursor:pointer">
																<th class="btn-info" style="text-align:center">TARGET PENJUALAN MINIMUM</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN CASH</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN KREDIT</th>
																<th class="btn-info" style="text-align:center">DEL</th>
															</thead>
							                    	<?
							                    		$qG = mysql_query("SELECT * FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$d1[id_karyawan]' ORDER BY target");
							                    		while($dG=mysql_fetch_array($qG))
							                    			{
							                    	?>
															<tr>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
																	<input type="text" name="target1" class="form-control" style="width:100%;padding-right:20%;text-align:right" value="<?echo number_format($dG[target],'0','','.')?>" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																		<span class="input-group-addon">UNIT</span>
																	</div>
																</td>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" class="form-control" name="cash1" style="padding-right:15%;text-align:right" value="<?echo number_format($dG[cash],'0','','.')?>" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																		<span class="input-group-addon">PER UNIT</span>
																	</div>
																</td>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
								                                        <span class="input-group-addon">RP.</span>
																		<input type="text" class="form-control" name="kredit1" style="padding-right:15%;text-align:right" value="<?echo number_format($dG[kredit],'0','','.')?>" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																		<span class="input-group-addon">PER UNIT</span>
																	</div>
																</td>
																<td align="center">
																	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&deldetinsentif=1&iddet=$dG[id]&id_karyawan=$d1[id_karyawan]"?>" onclick="return confirm('Anda yakin akan menghapus data?')">
																			<i class="fa fa-trash-o" style="font-size:15px;margin-top:7px"></i>
																	</a>
																</td>
															</tr>
													<?
															}
													?>
															<tr>
																<td align="center" colspan="4">
																	<a data-toggle="modal" data-target="#compose-modal-tambahdetinsentif" style="cursor:pointer">
																		<button type="button" class="btn btn-info" style="width:100%;height:30px;font-size:12px"><i class="fa fa-plus"></i> &nbsp;Tambah</button>
																	</a>
																</td>
															</tr>
												        </table>
													</td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
					
<!-- ################## MODAL TAMBAH KARYAWAN ########################################################################################## -->
								        <div class="modal fade " id="compose-modal-tambahdetinsentif" tabindex="-1" role="dialog" aria-hidden="true">
								            <div class="modal-dialog" style="width:40%;">
								                <div class="modal-content">
								                    <div class="modal-header">
								                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								                        <h4 class="modal-title">TAMBAH DAFTAR KOMISI</h4>
								                    </div>
													
								                   	<form method="post" action="" enctype="multipart/form-data">
							                        <div class="modal-body">
								                    	<table>
								                    		<tr>
								                    			<td width="40%">TARGET MINIMUM</td>
								                    			<td width="2%">:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
																	<input type="text" name="target" style="width:100%;text-align:right" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,' 1234567890')" required>
								                    				<span class="input-group-addon">UNIT</span>
																	</div>
																</td>
															</tr>
								                    		<tr>
								                    			<td>KOMISI PENJUALAN CASH</td>
								                    			<td>:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" name="cash" class="form-control uangA" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
								                                    	<span class="input-group-addon">PER UNIT</span>
																	</div>
										                        </td>
								                    		</tr>
								                    		<tr>
								                    			<td>KOMISI PENJUALAN KREDIT</td>
								                    			<td>:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" name="kredit" class="form-control uangB" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
								                                    	<span class="input-group-addon">PER UNIT</span>
																	</div>
										                        </td>
								                    		</tr>
									                    	<input type="hidden" name="id_karyawan" value="<?echo $d1[id_karyawan]?>">
									                    	<input type="hidden" name="id_posisi" value="<?echo $d1[id_posisi]?>">
									                    	<input type="hidden" name="tambahdetinsentif" value="1">
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
										
									else if($d1[id_posisi]=='9')
										{
								?>
										<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:220px;">
				                    		<table style="width:100%;">
					                    		<tr>
					                    			<td width="15%" valign="top">KOMISI</td>
					                    			<td width="1%" valign="top">:</td>
					                    			<td>
									                    <table class="table table-striped" style="width:100%"> 
								                            <thead style="cursor:pointer">
																<th class="btn-info" style="text-align:center">TARGET PENJUALAN MINIMUM</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN CASH</th>
																<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN KREDIT</th>
																<th class="btn-info" style="text-align:center">DEL</th>
															</thead>
							                    	<?
							                    		$qG = mysql_query("SELECT * FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$d1[id_karyawan]' ORDER BY target");
							                    		while($dG=mysql_fetch_array($qG))
							                    			{
							                    	?>
															<tr>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
																	<input type="text" name="target1" class="form-control" style="width:100%;padding-right:20%;text-align:right" value="<?echo number_format($dG[target],'0','','.')?>" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																		<span class="input-group-addon">UNIT</span>
																	</div>
																</td>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" class="form-control" name="cash1" style="padding-right:15%;text-align:right" value="<?echo number_format($dG[cash],'0','','.')?>" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																		<span class="input-group-addon">PER UNIT</span>
																	</div>
																</td>
																<td align="center">
								                                    <div class="input-group" style="margin-left:0%">
								                                        <span class="input-group-addon">RP.</span>
																		<input type="text" class="form-control" name="kredit1" style="padding-right:15%;text-align:right" value="<?echo number_format($dG[kredit],'0','','.')?>" onkeypress="return buat_angka(event,'1234567890')" readonly=""/>
																		<span class="input-group-addon">PER UNIT</span>
																	</div>
																</td>
																<td align="center">
																	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&deldetinsentif=1&iddet=$dG[id]&id_karyawan=$d1[id_karyawan]"?>" onclick="return confirm('Anda yakin akan menghapus data?')">
																			<i class="fa fa-trash-o" style="font-size:15px;margin-top:7px"></i>
																	</a>
																</td>
															</tr>
													<?
															}
													?>
															<tr>
																<td align="center" colspan="4">
																	<a data-toggle="modal" data-target="#compose-modal-tambahdetinsentif" style="cursor:pointer">
																		<button type="button" class="btn btn-info" style="width:100%;height:30px;font-size:12px"><i class="fa fa-plus"></i> &nbsp;Tambah</button>
																	</a>
																</td>
															</tr>
												        </table>
													</td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
					
<!-- ################## MODAL TAMBAH KARYAWAN ########################################################################################## -->
								        <div class="modal fade " id="compose-modal-tambahdetinsentif" tabindex="-1" role="dialog" aria-hidden="true">
								            <div class="modal-dialog" style="width:40%;">
								                <div class="modal-content">
								                    <div class="modal-header">
								                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								                        <h4 class="modal-title">TAMBAH DAFTAR KOMISI</h4>
								                    </div>
													
								                   	<form method="post" action="" enctype="multipart/form-data">
							                        <div class="modal-body">
								                    	<table>
								                    		<tr>
								                    			<td width="40%">TARGET MINIMUM</td>
								                    			<td width="2%">:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
																	<input type="text" name="target" style="width:100%;text-align:right" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,' 1234567890')" required>
								                    				<span class="input-group-addon">UNIT</span>
																	</div>
																</td>
															</tr>
								                    		<tr>
								                    			<td>KOMISI PENJUALAN CASH</td>
								                    			<td>:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" name="cash" class="form-control uangA" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
								                                    	<span class="input-group-addon">PER UNIT</span>
																	</div>
										                        </td>
								                    		</tr>
								                    		<tr>
								                    			<td>KOMISI PENJUALAN KREDIT</td>
								                    			<td>:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
								                                        <span class="input-group-addon">RP.</span>
								                                        <input type="text" name="kredit" class="form-control uangB" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
								                                    	<span class="input-group-addon">PER UNIT</span>
																	</div>
										                        </td>
								                    		</tr>
									                    	<input type="hidden" name="id_karyawan" value="<?echo $d1[id_karyawan]?>">
									                    	<input type="hidden" name="id_posisi" value="<?echo $d1[id_posisi]?>">
									                    	<input type="hidden" name="tambahdetinsentif" value="1">
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
									
									else if($d1[id_posisi]=='3' || $d1[id_posisi]=='4' || $d1[id_posisi]=='5' || $d1[id_posisi]=='8')
										{
			                    		$dG=mysql_fetch_array(mysql_query("SELECT * FROM tbl_insentif_karyawan WHERE id%2=0 AND id_karyawan='$d1[id_karyawan]'"));
			                    		$simpan = "<button type='submit' class='btn btn-primary pull-left'><i class='fa fa-save'></i> &nbsp;Simpan</button>";
								?>
										
								    <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=tambahinsentif"?>" enctype="multipart/form-data">
										<div style="min-height:90px;padding:20px"">
				                    		<table style="width:50%;">
					                    		<tr>
					                    			<td width="30%">KOMISI</td>
					                    			<td width="2%">:</td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="flat" class="form-control uang" value="<?echo number_format($dG[flat],'0','','.')?>" style="width:100%;text-align:right" required="" onkeypress="return buat_angka(event,'1234567890')"/>
					                                        <span class="input-group-addon">PER TRANSAKSI UNIT MOTOR</span>
														</div>
													</td>
					                    		</tr>
						                    	<input type="hidden" name="id" value="<?echo $dG[id]?>">
									            <input type="hidden" name="id_karyawan" value="<?echo $d1[id_karyawan]?>">
						                    	<input type="hidden" name="id_posisi" value="<?echo $d1[id_posisi]?>">
			                            	</table>
				                   	 	</div>
								<?
										}
								?>
			                        <div class="modal-footer clearfix">
			                        	<?echo $simpan?>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
									</form>
				                </div>
			                </div>
			            </div>
<?
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
	/*
	else if($submenu == 'deldetinsentif')
		{
		$q1 = mysql_query("DELETE FROM tbl_insentif_karyawan WHERE id%2=0 AND id='$_REQUEST[iddet]'");
		
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=edit&id_karyawan=$_REQUEST[id_karyawan]'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=edit&id_karyawan=$_REQUEST[id_karyawan]'/>";
			exit();
			}
		}
		
	else if($submenu == 'tambahdetinsentif')
		{
		if($_REQUEST[id_posisi]=='2' || $_REQUEST[id_posisi]=='7')
			{
            $target = preg_replace( "/[^0-9]/", "",$_POST['target'.$count]);
            $cash   = preg_replace( "/[^0-9]/", "",$_POST['cash'.$count]);
            $kredit = preg_replace( "/[^0-9]/", "",$_POST['kredit'.$count]);
            
			$q1 = mysql_query("INSERT INTO tbl_insentif_karyawan VALUES ('','$_REQUEST[id_karyawan]','$target','$cash','$kredit','')");
	        }
		else 
			{
	        $flat = preg_replace( "/[^0-9]/", "",$_POST[flat]);
			$q1 = mysql_query("UPDATE tbl_insentif_karyawan SET flat='$flat' WHERE id%2=0 AND id='$_REQUEST[id]'");
			}
		
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=edit&id_karyawan=$_REQUEST[id_karyawan]'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=edit&id_karyawan=$_REQUEST[id_karyawan]'/>";
			exit();
			}
		}
	*/
	
	else if($submenu == 'B')
		{
?>
			<script language="JavaScript">
			function MM_jumpMenu(targ,selObj,restore){ //v3.0
			eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
			if (restore) selObj.selectedIndex=0;
			}
			</script>
			
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Tambah Master Komisi</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
									<?
									if($_SESSION[posisi]=="DIREKSI"){
									?>
				                    	<table style="width:100%;">
				                    		<tr>
				                    			<td width="30%" valign="top">BUAT MASTER KOMISI UNTUK</td>
				                    			<td width="1%" valign="top">:</td>
				                    			<td><select class="form-control" name="grup" style="width:50%" onChange="MM_jumpMenu('parent',this,1)">
																	<option value=''>Pilih</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=C&grup=1"?>' <?if($_SESSION[grup]=='1'){?>selected=""<?}?>>Sales, Counter Sales & Direksi</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=C&grup=2"?>' <?if($_SESSION[grup]=='2'){?>selected=""<?}?>>Kasir, Administrasi, Driver, Gudang & PDI</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=C&grup=3"?>' <?if($_SESSION[grup]=='3'){?>selected=""<?}?>>PIC</option>
													</select></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
									<?
										}
									else
										{
									?>
				                    	<table style="width:100%;">
				                    		<tr>
				                    			<td width="30%" valign="top">BUAT MASTER KOMISI UNTUK</td>
				                    			<td width="1%" valign="top">:</td>
				                    			<td><select class="form-control" name="grup" style="width:50%" onChange="MM_jumpMenu('parent',this,1)">
																	<option value=''>Pilih</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=C&grup=1"?>' <?if($_SESSION[grup]=='1'){?>selected=""<?}?>>Sales, Counter Sales</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=C&grup=2"?>' <?if($_SESSION[grup]=='2'){?>selected=""<?}?>>Kasir, Administrasi, Driver, Gudang & PDI</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=C&grup=3"?>' <?if($_SESSION[grup]=='3'){?>selected=""<?}?>>PIC</option>
													</select></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
									<?											
										}
									?>
				                    </div>
									<!--
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									-->
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
		$_SESSION[grup]	= $_REQUEST[grup];
		
		if($_SESSION[grup]==1)
			{
			$pos = "AND posisi IN ('2','7','6')";
			}
		else if($_SESSION[grup]==2)
			{
			$pos = "AND posisi IN ('3','4','5','8')";
			}
		else if($_SESSION[grup]==3)
			{
			$pos = "AND posisi IN ('9')";
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Tambah Master Komisi</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:100%">
					                    		<tr>
					                    			<td width="15%">PILIH KARYAWAN</td>
					                    			<td width="1%">:</td>
					                    			<td><select name="idkaryawan[]" class="form-control" id="tagPicker2" multiple="multiple">
																			<?
																				$q1 = mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND id NOT IN (SELECT id_karyawan FROM tbl_insentif_karyawan) $pos ORDER BY nama");
																				while($dA=mysql_fetch_array($q1))
																					{
																			?>
																						<option value='<?echo $dA[id]?>'><?echo $dA[nama]?></option>
																			<?
																					}
																			?>
																    </select></td>
					                    		</tr>
			                            	</table>
										</div>
										<hr>
								<?
									if($_SESSION[grup]==1)
										{
								?>
										<div style="min-height:90px">
						                    <table class="table table-striped"> 
					                    		<thead>
													<th class="btn-info" style="text-align:center">TARGET PENJUALAN MINIMUM</th>
													<th class="btn-info" style="width:40%;text-align:center">KOMISI PENJUALAN CASH</th>
													<th class="btn-info" style="width:40%;text-align:center">KOMISI PENJUALAN KREDIT</th>
					                    		</thead>
					                    		<!--
												<tr>
													<td align="center"><input type="text" name="target1" class="form-control" style="width:50%;padding-right:20%;text-align:right" placeholder="" onkeypress="return buat_angka(event,'1234567890')"/></td>
													<td align="center">
					                                    <div class="input-group" style="margin-left:28%">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" class="form-control" name="cash1" style="width:50%;padding-right:15%;text-align:right" onkeypress="return buat_angka(event,'1234567890')"/>
														</div>
													</td>
													<td align="center">
					                                    <div class="input-group" style="margin-left:28%">
					                                        <span class="input-group-addon">RP.</span>
															<input type="text" class="form-control" name="kredit1" style="width:50%;padding-right:15%;text-align:right"  onkeypress="return buat_angka(event,'1234567890')"/>
														</div>
													</td>
												</tr>
												-->
								           		<tbody id="container">
								       			</tbody>
									        </table>
											</br>
											<button type="button" class="btn btn-info" name="add_btn" value="Tambah Jenjang" id="add_btn"><i class="fa fa-plus"></i> &nbsp;Tambah Jenjang</button>
				                   	 	</div>
				                <?
				                		}
				                		
									else if($_SESSION[grup]==2)
										{
								?>
										<div style="min-height:90px">
					                    	<table style="width:100%">
					                    		<tr>
					                    			<td width="15%">KOMISI</td>
					                    			<td width="1%">:</td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" class="form-control uang" name="flat" style="width:15%;text-align:right" onkeypress="return buat_angka(event,'1234567890')"/>
														</div>
													</td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                <?
				                		}
				                		
									else if($_SESSION[grup]==3)
										{
								?>
										<div style="min-height:90px">
						                    <table class="table table-striped"> 
					                    		<thead>
													<th class="btn-info" style="text-align:center">TARGET PENJUALAN MINIMUM</th>
													<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN CASH</th>
													<th class="btn-info" style="width:30%;text-align:center">KOMISI PENJUALAN KREDIT</th>
					                    		</thead>
								           		<tbody id="container">
								       			</tbody>
									        </table>
											</br>
											<button type="button" class="btn btn-info" name="add_btn" value="Tambah Jenjang" id="add_btn"><i class="fa fa-plus"></i> &nbsp;Tambah Jenjang</button>
				                   	 	</div>
				                <?
				                		}
				                ?>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										<!--
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
										-->
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
	else if($submenu == 'tambahinsentif')
		{
			        $flat = preg_replace( "/[^0-9]/", "",$_POST[flat]);
		mysql_query("UPDATE tbl_insentif_karyawan SET flat='$flat' WHERE id%2=0 AND id='$_REQUEST[id]'"); 
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		}
		
	else if($submenu == 'D')
		{
			foreach($_REQUEST['idkaryawan'] AS $idkaryawan)
				{
				if($_SESSION[grup]==1)
					{
					foreach ($_POST['rows'] as $key => $count )
						{
			            $target = preg_replace( "/[^0-9]/", "",$_POST['target'.$count]);
			            $cash   = preg_replace( "/[^0-9]/", "",$_POST['cash'.$count]);
			            $kredit = preg_replace( "/[^0-9]/", "",$_POST['kredit'.$count]);
			            
			            if(!empty($cash) && !empty($kredit))
			            	{
							mysql_query("INSERT INTO tbl_insentif_karyawan VALUES ('','$idkaryawan','$target','$cash','$kredit','')");
							}
			        	}
					}
				else if($_SESSION[grup]==2)
					{
			        $flat = preg_replace( "/[^0-9]/", "",$_POST[flat]);
					mysql_query("INSERT INTO tbl_insentif_karyawan VALUES ('','$idkaryawan','','','','$flat')");
					}
				else if($_SESSION[grup]==3)
					{
					foreach ($_POST['rows'] as $key => $count )
						{
			            $target = preg_replace( "/[^0-9]/", "",$_POST['target'.$count]);
			            $cash   = preg_replace( "/[^0-9]/", "",$_POST['cash'.$count]);
			            $kredit = preg_replace( "/[^0-9]/", "",$_POST['kredit'.$count]);
			            
			            if(!empty($cash) && !empty($kredit))
			            	{
							mysql_query("INSERT INTO tbl_insentif_karyawan VALUES ('','$idkaryawan','$target','$cash','$kredit','')");
							}
			        	}
					}
				}
            	
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
		}
?>
	
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
		$('.uangA').on('keypress', function(e) {
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
		$('.uangB').on('keypress', function(e) {
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
			  $("#tagPicker2").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
		</script>
		
		<script>
			$(document).ready(function() {
            var count = 0;
 
            $("#add_btn").click(function(){
                count += 1;
                $('#container').append(
												
                            '<tr class="records"><td align="center"><div class="input-group"><input type="text" class="form-control" name="target'+count+'" style="width:100%;padding-right:20%;text-align:right" placeholder="" onkeypress="return buat_angka(event,\'1234567890\')"/><span class="input-group-addon" style="width:30%">UNIT</span></div></td>'
                           +'<td align="center"><div class="input-group" style="margin-left:28%"><span class="input-group-addon">RP.</span><input type="text" name="cash'+count+'" class="form-control uangA" style="width:100%;padding-right:15%;text-align:right" onkeypress="return buat_angka(event,\'1234567890\')"/><span class="input-group-addon" style="width:30%">PER UNIT</span></div></td>'
                           +'<td align="center"><div class="input-group" style="margin-left:28%"><span class="input-group-addon">RP.</span><input type="text" name="kredit'+count+'" class="form-control uangB" style="width:100%;padding-right:15%;text-align:right" onkeypress="return buat_angka(event,\'1234567890\')"/><span class="input-group-addon" style="width:30%">PER UNIT</span></div></td>'
                           +'<input id="rows_' + count + '" name="rows[]" value="'+ count +'" type="hidden"></td></tr>'
                   	);
                });
	        });
		</script>