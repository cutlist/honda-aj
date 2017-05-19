<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$kodebarang		= strtoupper(addslashes($_REQUEST['kodebarang']));
				$namabarang		= strtoupper(addslashes($_REQUEST['namabarang']));
				$varian			= strtoupper($_REQUEST['varian']);
				$warna			= strtoupper($_REQUEST['warna']);
				$thnproduksi 	= $_REQUEST['thnproduksi'];
				$satuan 		= $_REQUEST['satuan'];
				$noticehitam 	= preg_replace( "/[^0-9]/", "",$_REQUEST['noticehitam']);
				$noticemerah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['noticemerah']);
							
				$q1 = mysql_query("INSERT INTO tbl_masterbarang (
												kodebarang, 
												namabarang, 
												varian, 
												warna, 
												thnproduksi, 
												satuan, 
												noticehitam, 
												noticemerah, 
												literawal, 
												pic_user) 
											VALUES (
												'$kodebarang', 
												'$namabarang', 
												'$varian', 
												'$warna', 
												'$thnproduksi', 
												'UNIT', 
												'$noticehitam', 
												'$noticemerah', 
												'1', 
												'$_SESSION[user]');
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_masterbarang',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH MASTERBARANG $kodebarang')
									");
						
						
						if($q1)
							{
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}

			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM tbl_masterbarang WHERE id%2=0 AND id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_masterbarang',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS MASTERBARANG $_REQUEST[kodebarang]')
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
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah]))
				{				
				$kodebarang		= strtoupper(addslashes($_REQUEST['kodebarang']));
				$namabarang		= strtoupper(addslashes($_REQUEST['namabarang']));
				$varian			= strtoupper($_REQUEST['varian']);
				$warna			= strtoupper($_REQUEST['warna']);
				$thnproduksi 	= $_REQUEST['thnproduksi'];
				$satuan 		= $_REQUEST['satuan'];
				$noticehitam 	= preg_replace( "/[^0-9]/", "",$_REQUEST['noticehitam']);
				$noticemerah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['noticemerah']);
							
				$q1 = mysql_query("UPDATE tbl_masterbarang SET
													kodebarang='$kodebarang',
													namabarang='$namabarang', 
													varian='$varian',
													warna='$warna',
													thnproduksi='$thnproduksi', 
													noticehitam='$noticehitam', 
													noticemerah='$noticemerah', 
													pic_user='$_SESSION[user]'
											WHERE id%2=0 AND id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_masterbarang',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH MASTERBARANG $kodebarang')
									");
					
					if($q1 && $q2)
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
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
			                	<h4>MASTER <small>BARANG</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-barang" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Barang Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
											{
										?>
	                           				<button type="button"  onclick="window.open('printaj/h1/barang.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width=""  style="padding:7px">WARNA</th>
			                                    <th width="1%" style="padding:7px">TAHUN</th>
			                                    <th style="padding:7px">NOTICE PLAT HITAM (RP)</th>
			                                    <th style="padding:7px">NOTICE PLAT MERAH (RP)</th>
			                                    <th width="1%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[warna]?></td>
			                                    <td align="center"><?echo $d1[thnproduksi]?></td>
			                                    <td align="right"><?echo number_format($d1[noticehitam],"0","",".")?></td>
			                                    <td align="right"><?echo number_format($d1[noticemerah],"0","",".")?></td>
			                                    <td width="1%" align="center">
													<?
													if($_SESSION[posisi]=='DIREKSI')
														{
													?>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a>
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
					
<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH BARANG BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td>KODE BARANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kodebarang" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" style="width:100%" name="namabarang" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>VARIAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="varian" style="width:100%" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>WARNA</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="warna" style="width:100%" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TAHUN PRODUKSI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="thnproduksi" style="width:20%" placeholder="YYYY" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOTICE PLAT HITAM</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="noticehitam" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOTICE PLAT MERAH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="noticemerah" class="form-control uang" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<input type="hidden" name="literawal" value="1">
				                    		<!--
				                    		<tr>
				                    			<td>LITER AWAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="literawal" style="width:30%">
																	<option value=''>Pilih</option>
																	<option value='1'>1 LITER</option>
																	<option value='2'>2 LITER</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>SATUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="satuan" style="width:20%" readonly >
																	<option value='UNIT' selected="" >UNIT</option>
													</select></td>
				                    		</tr>
				                    		-->
					                    	<input type="hidden" name="input" value="1">
					                    	<input type="hidden" name="input" value="1">
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
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>BARANG &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Barang</small></h4>
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td>KODE BARANG</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="kodebarang" value="<?echo $d1[kodebarang]?>" class="form-control" maxlength="20" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="namabarang" value="<?echo $d1[namabarang]?>" class="form-control" maxlength="50" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>VARIAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="varian" value="<?echo $d1[varian]?>" class="form-control" maxlength="50" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>WARNA</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="warna" value="<?echo $d1[warna]?>" style="width:50%" class="form-control" maxlength="20" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TAHUN PRODUKSI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="thnproduksi" value="<?echo $d1[thnproduksi]?>" style="width:20%" placeholder="YYYY" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  readonly=""></td>
				                    		</tr>
				                    		<input type="hidden" name="literawal" value="1">
				                    		<tr>
				                    			<td>SATUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="satuan" style="width:20%" readonly >
																	<option value='UNIT' selected="" >UNIT</option>
													</select></td>
				                    		</tr>
		                            	</table>
				                    </div>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>BARANG &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Barang</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td>KODE BARANG</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="kodebarang" value="<?echo $d1[kodebarang]?>" style="width:100%" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="namabarang" value="<?echo $d1[namabarang]?>" style="width:100%" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>VARIAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="varian" value="<?echo $d1[varian]?>" style="width:100%" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>WARNA</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="warna" value="<?echo $d1[warna]?>" style="width:100%" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TAHUN PRODUKSI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="thnproduksi" value="<?echo $d1[thnproduksi]?>" style="width:20%" placeholder="YYYY" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOTICE PLAT HITAM</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="noticehitam" class="form-control uang" value="<?echo number_format($d1[noticehitam],"0","",".")?>" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOTICE PLAT MERAH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="noticemerah" class="form-control uang" value="<?echo number_format($d1[noticemerah],"0","",".")?>" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<input type="hidden" name="literawal" value="1">
											<!--
				                    		<tr>
				                    			<td>SATUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="satuan" style="width:20%" readonly >
																	<option value='UNIT' selected="" >UNIT</option>
													</select></td>
				                    		</tr>
											-->
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
		$('#uang').on('keypress', function(e) {
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
            });
        </script>