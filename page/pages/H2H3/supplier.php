<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$nama	= strtoupper(addslashes($_REQUEST['nama']));
				$alamat	= strtoupper(addslashes($_REQUEST['alamat']));
				$telp 	= $_REQUEST['telp'];
				$fax 	= $_REQUEST['fax'];
				$email	= $_REQUEST['email'];
							
				$q1 = mysql_query("INSERT INTO x23_supplier (
												nama, 
												alamat, 
												telp, 
												grup, 
												fax, 
												email) 
											VALUES (
												'$nama', 
												'$alamat', 
												'$telp', 
												'$_REQUEST[grup]', 
												'$fax', 
												'$email');
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_supplier',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH SUPPLIER $nama')
									");
						
						
				if($q1)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&input='/>";
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
				$q1 = mysql_query("DELETE FROM x23_supplier WHERE id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_supplier',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS SUPPLIER $_REQUEST[nama]')
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
				$nama	= strtoupper(addslashes($_REQUEST['nama']));
				$alamat	= strtoupper(addslashes($_REQUEST['alamat']));
				$telp 	= $_REQUEST['telp'];
				$fax 	= $_REQUEST['fax'];
				$email	= $_REQUEST['email'];
							
				$q1 = mysql_query("UPDATE x23_supplier SET
													nama='$nama',
													alamat='$alamat', 
													telp='$telp',
													fax='$fax',
													email='$email',
													grup='$_REQUEST[grup]',
													status='$_REQUEST[status]'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_supplier',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH SUPPLIER $nama')
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
			                	<h4>MASTER <small>SUPPLIER</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus  placeholder="CARI NAMA SUPPLIER ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-supplier" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Supplier Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th style="padding:7px">ALAMAT</th>
			                                    <th width="10%" style="padding:7px">TELEPON</th>
			                                    <th width="10%" style="padding:7px">FAX</th>
			                                    <th width="" style="padding:7px">EMAIL</th>
			                                    <th width="" style="padding:7px">GRUP</th>
			                                    <th width="" style="padding:7px">STATUS</th>
			                                    <th width="1%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_supplier WHERE nama LIKE '%$_REQUEST[cari]%' OR telp LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_supplier ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[grup]=="1"){
												$gr = "YA";
												}
			                            	if($d1[grup]=="0"){
												$gr = "TIDAK";
												}
			                            	if($d1[status]=="1"){
												$sts = "AKTIF";
												}
			                            	if($d1[status]=="0"){
												$sts = "TIDAK AKTIF";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[alamat]?></td>
			                                    <td align="right"><?echo $d1[telp]?></td>
			                                    <td align="right"><?echo $d1[fax]?></td>
			                                    <td><?echo $d1[email]?></td>
			                                    <td><?echo $gr?></td>
			                                    <td><?echo $sts?></td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL TAMBAH SUPPLIER ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-supplier" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH SUPPLIER BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA SUPPLIER</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="nama" class="form-control" maxlength="40" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TELEPON</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="telp" class="form-control" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>FAX</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="fax" class="form-control" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" ></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td><input type="email" name="email" class="form-control" maxlength="50" ></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GRUP</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="grup" class="form-control" style="font-size:12px;padding:3px" required>
																		<option value='0' selected>TIDAK</option>
																		<option value='1' >YA</option>
																    </select></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_supplier WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>SUPPLIER &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Supplier</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="60%">
				                    		<tr>
				                    			<td width="30%">NAMA SUPPLIER</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TELEPON</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="telp" value="<?echo $d1[telp]?>" class="form-control" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>FAX</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="fax" value="<?echo $d1[fax]?>" class="form-control" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" ></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="50" ></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GRUP</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="grup" class="form-control" style="font-size:12px;padding:3px" required>
																		<option value='0' <?if($d1[grup]=="0"){?>selected<?}?>>TIDAK</option>
																		<option value='1' <?if($d1[grup]=="1"){?>selected<?}?>>YA</option>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="status" class="form-control" style="font-size:12px;padding:3px" required>
																		<option value='1' <?if($d1[status]=="1"){?>selected<?}?>>AKTIF</option>
																		<option value='0' <?if($d1[status]=="0"){?>selected<?}?>>TIDAK AKTIF</option>
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>