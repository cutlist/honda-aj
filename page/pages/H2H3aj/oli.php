<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$kodeoli		= strtoupper(addslashes($_REQUEST['kodeoli']));
				$namaoli		= strtoupper(addslashes($_REQUEST['namaoli']));
				$varian			= strtoupper($_REQUEST['varian']);
				$satuan 		= $_REQUEST['satuan'];
				$idsupplier 	= $_REQUEST['idsupplier'];
							
				$q1 = mysql_query("INSERT INTO x23_masteroli (
												kodeoli, 
												namaoli, 
												varian, 
												satuan, 
												idsupplier) 
											VALUES (
												'$kodeoli', 
												'$namaoli', 
												'$varian', 
												'$satuan', 
												'$idsupplier');
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_masteroli',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH MASTEROLI $kodeoli')
									");
						
						
				if($q1)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
					exit();
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
				$q1 = mysql_query("DELETE FROM x23_masteroli WHERE id%2=0 AND id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_masteroli',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS MASTEROLI $_REQUEST[kodeoli]')
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
				$kodeoli		= strtoupper(addslashes($_REQUEST['kodeoli']));
				$namaoli		= strtoupper(addslashes($_REQUEST['namaoli']));
				$varian			= strtoupper($_REQUEST['varian']);
				$satuan 		= $_REQUEST['satuan'];
				$idsupplier 		= $_REQUEST['idsupplier'];
							
				$q1 = mysql_query("UPDATE x23_masteroli SET
													kodeoli='$kodeoli',
													namaoli='$namaoli', 
													varian='$varian',
													satuan='$satuan',
													idsupplier='$idsupplier'
											WHERE id%2=0 AND id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_masteroli',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH MASTEROLI $kodeoli')
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
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>OLI</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI KODE / VARIAN / NAMA OLI ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-oli" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Oli Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE OLI</th>
			                                    <th style="padding:7px">NAMA OLI</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="1%" style="padding:7px">SATUAN</th>
			                                    <th width="" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_masteroli WHERE id%2=0 AND kodeoli LIKE '%$_REQUEST[cari]%' OR namaoli LIKE '%$_REQUEST[cari]%' OR varian LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_masteroli ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodeoli]?></td>
			                                    <td><?echo $d1[namaoli]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td align="center">PCS</td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<!--
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	-->
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deluser=$d1[id]&kodeoli=$d1[kodeoli]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
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
					
<!-- ################## MODAL TAMBAH OLI ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-oli" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH OLI BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA OLI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="namaoli" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>VARIAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="varian" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>SATUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="satuan" style="width:50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_satuan WHERE id%2=0 AND sub='h2h3' ORDER BY satuan");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[satuan]?>' <?if($d1[satuan]==$dA[satuan]){?>selected=""<?}?>><?echo $dA[satuan]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>NAMA SUPPLIER</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="idsupplier" style="width:100%">
																	<option value=''>Pilih</option>
																	
																<?
																	$q1 = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>' <?if($d1[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KODE OLI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="kodeoli" class="form-control" maxlength="20" required></td>
				                    		</tr>
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
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masteroli WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>OLI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Oli</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td>KODE OLI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="kodeoli" value="<?echo $d1[kodeoli]?>" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA OLI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="namaoli" value="<?echo $d1[namaoli]?>" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>VARIAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="varian" value="<?echo $d1[varian]?>" class="form-control" maxlength="50" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>SATUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="satuan" style="width:50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_satuan WHERE id%2=0 AND sub='h2h3' ORDER BY satuan");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[satuan]?>' <?if($d1[satuan]==$dA[satuan]){?>selected=""<?}?>><?echo $dA[satuan]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA SUPPLIER</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="idsupplier" style="width:100%">
																	<option value=''>Pilih</option>
																	
																<?
																	$q1 = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>' <?if($d1[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
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
		$('#uang2').on('keypress', function(e) {
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
		$('#uang3').on('keypress', function(e) {
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
		$('#uang4').on('keypress', function(e) {
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
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>