<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[input]))
			{
			function rand_string( $length ) {
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

				$size = strlen( $chars );
				for( $i = 0; $i < $length; $i++ ) {
					$str .= $chars[ rand( 0, $size - 1 ) ];
				}

				return $str;
			}

			function UploadUser($fupload_name){
			  $vdir_upload = "img/foto_user/";
			  $vfile_upload = $vdir_upload . $fupload_name;
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
			}
			
			$user 	= $_POST['user'];
			$pass1 	= $_POST['pass1'];
			$pass2 	= $_POST['pass2'];
			$nama 	= $_POST['nama'];
			$tmplahir 	= $_POST['tmplahir'];
			$tgllahir 	= date("Y-m-d", strtotime($_POST['tgllahir']));
			$alamat 	= $_POST['alamat'];
			$notelp 	= $_POST['notelp'];
			$hakakses	= $_POST['hakakses'];
							
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$tipe_file   = $_FILES['fupload']['type'];
			$nama_file   = rand_string(5).$_FILES['fupload']['name'];

			$pass	= md5($pass2);

			$d1 = mysql_fetch_array(mysql_query("SELECT user FROM tbl_user WHERE user='$user'"));

			if($pass1 != $pass2)
				{
					echo "<script>alert ('Password yang Anda ulangi tidak sama.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
				}
			else
				{
				if(!empty($d1[user]))
					{
						echo "<script>alert ('User tidak bisa digunakan.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
					}
				else
					{
						
					if(!empty($lokasi_file))
						{
						if($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg")
							{
							echo "<script>alert ('Upload Gagal, Pastikan File yang di Upload bertipe *.jpg')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit(); 
							}
						else
							{
							UploadUser($nama_file);					
							$q1 = mysql_query("INSERT INTO tbl_user (
														user, 
														pass, 
														nama, 
														tmplahir, 
														tgllahir, 
														alamat, 
														notelp, 
														hakakses, 
														foto) 
													VALUES (
														'$user', 
														'$pass', 
														'$nama', 
														'$tmplahir', 
														'$tgllahir', 
														'$alamat', 
														'$notelp', 
														'$hakakses', 
														'$nama_file')");
							}
						}
						
					else
						{				
						$q1 = mysql_query("INSERT INTO tbl_user (
													user, 
													pass, 
													nama, 
													tmplahir, 
													tgllahir, 
													alamat, 
													notelp, 
													hakakses, 
													foto) 
												VALUES (
													'$user', 
													'$pass', 
													'$nama', 
													'$tmplahir', 
													'$tgllahir', 
													'$alamat', 
													'$notelp', 
													'$hakakses', 
													'default.jpg')");
						}
					}
					
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
				                                    '',
				                                    'tbl_user',
				                                    CURDATE(),
				                                    CURTIME(),
				                                    '$_SESSION[user]',
				                                    'TAMBAH USER $_REQUEST[nama]')
										");
					
					if($q1)
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

		if(!empty($_REQUEST[deluser]))
			{
			$q1 = mysql_query("DELETE FROM tbl_user WHERE id='$_REQUEST[deluser]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_user',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'HAPUS USER $_REQUEST[nama]')
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

		if(!empty($_REQUEST[resetpass]))
			{
			$pass1 	= $_POST['pass1'];
			$pass2 	= $_POST['pass2'];
			$pass	= md5($pass2);
			if($pass1 != $pass2)
				{
					echo "<script>alert ('Password yang Anda ulangi tidak sama.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
				}
			else
				{
				$q1 = mysql_query("UPDATE tbl_user SET pass='$pass' WHERE id='$_REQUEST[resetpass]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_user',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'RESET PASSWORD $_REQUEST[nama]')
								");
				}
			
			if($q1 && $q2)
				{
				//echo "<script>alert ('Proses berhasil.')</script>";
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
			
		if(!empty($_REQUEST[ubahdetail]))
			{
			function rand_string( $length ) {
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

				$size = strlen( $chars );
				for( $i = 0; $i < $length; $i++ ) {
					$str .= $chars[ rand( 0, $size - 1 ) ];
				}

				return $str;
			}

			function UploadUser($fupload_name){
			  $vdir_upload = "img/foto_user/";
			  $vfile_upload = $vdir_upload . $fupload_name;
			  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
			}
			
			$nama 	= $_POST['nama'];
			$tmplahir 	= $_POST['tmplahir'];
			$tgllahir 	= date("Y-m-d", strtotime($_POST['tgllahir']));
			$alamat 	= $_POST['alamat'];
			$notelp 	= $_POST['notelp'];
			$hakakses	= $_POST['hakakses'];
							
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$tipe_file   = $_FILES['fupload']['type'];
			$nama_file   = rand_string(5).$_FILES['fupload']['name'];
			
			if(!empty($lokasi_file))
				{
				if($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg")
					{
					echo "<script>alert ('Upload Gagal, Pastikan File yang di Upload bertipe *.jpg')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit(); 
					}
				else
					{
					UploadUser($nama_file);					
					$q1 = mysql_query("UPDATE tbl_user SET
												nama='$nama', 
												tmplahir='$tmplahir',
												tgllahir='$tgllahir', 
												alamat='$alamat', 
												notelp='$notelp', 
												hakakses='$hakakses', 
												foto='$nama_file'
											WHERE id='$_REQUEST[ubahdetail]'
										");
					}
				}
				
			else
				{				
				$q1 = mysql_query("UPDATE tbl_user SET
											nama='$nama', 
											tmplahir='$tmplahir',
											tgllahir='$tgllahir', 
											alamat='$alamat', 
											notelp='$notelp', 
											hakakses='$hakakses'
										WHERE id='$_REQUEST[ubahdetail]'
									");
				}
				
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_user',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH USER $_REQUEST[nama]')
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
?>
			<aside class="right-side">
			    <section class="content-header">
			        <h1>
			            MASTER & LAPORAN <small>USER</small>
			        </h1>
			        <ol class="breadcrumb">
			        	<div style="margin-left:-170px;margin-top:-25px"><script>document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);</script> <span style="font-size:30px"> </span> </div>
			        	<div id="clock" style="margin-top:-35px;font-size:25px"></div>
			        </ol>
			    </section>
				
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:490px;">
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-userbaru" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; User Baru</button>
										</a>
										<a data-toggle="modal" data-target="#compose-modal-loguser" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-primary"><i class="fa fa-list"></i> &nbsp; Log</button>
										</a>
	                           		</div>
			                        <table id="example5" class="table table-bordered table-striped">
			                            <thead>
			                                <tr>
			                                    <th width="1%">NO.</th>
			                                    <th>USERNAME</th>
			                                    <th>NAMA</th>
			                                    <th width="1%">TELEPON</th>
			                                    <th>ALAMAT</th>
			                                    <th width="10%">PANGKAT</th>
			                                    <th width="5%">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_user ORDER BY nama");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><?echo $no?>.</td>
			                                    <td><?echo $d1['user']?></td>
			                                    <td><?echo $d1['nama']?></td>
			                                    <td align="right"><?echo $d1['notelp']?></td>
			                                    <td><?echo $d1['alamat']?></td>
			                                    <td><?echo strtoupper($d1['hakakses'])?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-120px;font-size: 12px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-resetpassword<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-key"></i>Reset Password</a></li>
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-ubahdetail<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah Detail</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deluser=$d1[id]&nama=$d1[nama]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus User</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="10">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
						
			    <?
                    $q2 = mysql_query("SELECT * FROM tbl_user");
                    while($d2 = mysql_fetch_array($q2))
                    	{
                ?>
<!-- ################## MODAL UBAH DETAIL ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubahdetail<?echo $d2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL USER</h4>
				                    </div>
				                    
				                   	<form method="post" action="" onsubmit="return vTambahuser();" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table>
				                    		<tr>
				                    			<td width="180px">USERNAME</td>
				                    			<td>:</td>
				                    			<td colspan="1"><input type="text" name="user" id="user" value="<?echo $d2[user]?>" class="form-control" style="width:300px" onkeyup="twitter.updateUrl(this.value)" readonly=""></td>
				                    			<td colspan="2"><div id="status"></div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="nama" value="<?echo $d2[nama]?>" class="form-control" style="width:300px" required></td>
											</tr>
				                    		<tr>
				                    			<td>TEMPAT LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tmplahir" value="<?echo $d2[tmplahir]?>" class="form-control" style="width:300px" required></td>
											</tr>
				                    		<tr>
				                    			<td>TANGGAL LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tgllahir" value="<?echo date("d-m-Y", strtotime($d2[tgllahir]));?>" class="form-control" style="width:125px" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top">ALAMAT</td>
				                    			<td valign="top">:</td>
				                    			<td valign="top" colspan="3"><textarea name="alamat" class="form-control" style="width:300px" required><?echo $d2[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="notelp" value="<?echo $d2[notelp]?>" onkeypress="return buat_angka(event,'0123456789')" class="form-control" style="width:300px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HAK AKSES</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select class="form-control" name="hakakses" style="width:175px" required>
														<option value="">Pilih</option>
														<option value="asisten" <?if($d2[hakakses]=='asisten'){?>selected<?}?>>ASISTEN</option>
														<option value="terapis" <?if($d2[hakakses]=='terapis'){?>selected<?}?>>TERAPIS</option>
														<option value="kasir" <?if($d2[hakakses]=='kasir'){?>selected<?}?>>KASIR</option>
														<option value="super admin" <?if($d2[hakakses]=='super admin'){?>selected<?}?>>SUPER ADMIN</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td >FOTO</td>
				                    			<td>:</td>
				                    			<td colspan="3"><img src="img/foto_user/<?echo $d2[foto]?>" width="100px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="3"><input type="file" name="fupload" id="exampleInputFile"></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="3"><i style="font-size:10px">Kosongkan jika foto tidak ingin diganti. Format foto *.jpg berbentuk persegi dengan ukuran maks. 150 x 150 pixel.</i></td>
				                    		</tr>
					                    	<input type="hidden" name="ubahdetail" value="<?echo $d2[id]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> &nbsp;Batal</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ############################################################################################################################### -->

<!-- ################## MODAL RESET PASSWORD ####################################################################################### -->
				        <div class="modal fade " id="compose-modal-resetpassword<?echo $d2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">RESET PASSWORD</h4>
				                    </div>
				                    
									<script>
									function vResetpass()
										{
										if (document.formResetpass.pass1.value != document.formResetpass.pass2.value)
											{
											alert ("Password yang Anda ulangi tidak sama.");	 	
											return false;
											}
										}
									</script>
									
				                   	<form name="formResetpass" method="post" action="" onsubmit="return vResetpass();" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="35%">PASSWORD BARU</td>
				                    			<td width="5%">:</td>
				                    			<td><input type="password" name="pass1" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>ULANGI PASSWORD</td>
				                    			<td>:</td>
				                    			<td><input type="password" name="pass2" class="form-control" required></td>
				                    		</tr>
					                    	<input type="hidden" name="nama" value="<?echo $d2[nama]?>">
					                    	<input type="hidden" name="resetpass" value="<?echo $d2[id]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> &nbsp;Batal</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ############################################################################################################################### -->
                <?
                		}
                ?>
					
<!-- ################## MODAL TAMBAH USER ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-userbaru" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH USER BARU</h4>
				                    </div>
									
									<script>
									function vTambahuser()
										{
										if (document.formTambahuser.pass1.value != document.formTambahuser.pass2.value)
											{
											alert ("Password yang Anda ulangi tidak sama.");	 	
											return false;
											}
										}
									</script>
									
				                   	<form name="formTambahuser" method="post" action="" onsubmit="return vTambahuser();" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table>
				                    		<tr>
				                    			<td width="180px">USERNAME</td>
				                    			<td>:</td>
				                    			<td colspan="1"><input type="text" name="user" id="user" class="form-control" style="width:300px" onkeyup="twitter.updateUrl(this.value)" required></td>
				                    			<td colspan="2"><div id="status"></div></td>
				                    		
				                    		</tr>
				                    		<tr>
				                    			<td>PASSWORD</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="password" name="pass1" class="form-control" style="width:300px" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>ULANGI PASSWORD</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="password" name="pass2" class="form-control" style="width:300px" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" style="width:300px" required></td>
											</tr>
				                    		<tr>
				                    			<td>TEMPAT LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tmplahir" value="<?echo $d1[nama]?>" class="form-control" style="width:300px" required></td>
											</tr>
				                    		<tr>
				                    			<td>TANGGAL LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tgllahir" class="form-control" style="width:125px" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top">ALAMAT</td>
				                    			<td valign="top">:</td>
				                    			<td valign="top" colspan="3"><textarea name="alamat" class="form-control" style="width:300px" required></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="notelp" onkeypress="return buat_angka(event,'0123456789')" class="form-control" style="width:300px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HAK AKSES</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select class="form-control" name="hakakses" style="width:175px" required>
														<option value="">Pilih</option>
														<option value="asisten">ASISTEN</option>
														<option value="terapis">TERAPIS</option>
														<option value="kasir">KASIR</option>
														<option value="super admin">SUPER ADMIN</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>FOTO</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="file" name="fupload" id="exampleInputFile"></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="3"><i style="font-size:10px">Format foto *.jpg berbentuk persegi dengan ukuran maks. 150 x 150 pixel.</i></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> &nbsp;Batal</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->
				
<!-- ################## MODAL LOG USER ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-loguser" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">LOG</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
										<table id="example4" class="table table-striped" style="">
											<thead>
				                                <tr>
				                                    <th width="1%">DATE</th>
				                                    <th width="1%">TIME</th>
				                                    <th width="1%">USER</th>
				                                    <th>ACTION</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $no = 1;
				                            $q1 = mysql_query("SELECT * FROM log_act WHERE tbl='tbl_user' ORDER BY id DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr>
				                                    <td align=""><?echo $d1['tgl']?></td>
				                                    <td align=""><?echo substr($d1['jam'],0,5)?></td>
				                                    <td align=""><?echo $d1['user']?></td>
				                                    <td align=""><?echo $d1['act']?></td>
				                                </tr>
				                                
				                            <?
				                            	$no++;
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
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
		
	if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content-header">
			        <h1>
			            MASTER & LAPORAN <small>USER</small>
			        </h1>
			        <ol class="breadcrumb">
			        	<div style="margin-left:-170px;margin-top:-25px"><script>document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);</script> <span style="font-size:30px"> </span> </div>
			        	<div id="clock" style="margin-top:-35px;font-size:25px"></div>
			        </ol>
			    </section>
			    
						<input type="text" id="type1" onkeyup="kalkulatorTambah(this.value,getElementById('type2').value);" />x
						<input type="text" id="type2" onkeyup="kalkulatorTambah(getElementById('type1').value,this.value);" />
						=
						<span id="result">
						</span>
						
						<script>
						function kalkulatorTambah(type1,type2){
						var hasil = eval(type1) * eval(type2);
						document.getElementById('result').innerHTML = hasil;
						}
						</script>
						
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	
							<h1>UNDER CONTRUCTION</h1>
			            </div>
			        </div>
                    
				</section>
			</aside>

<?
		}
?>
	
        <script src="js/jquery.min.js"></script>
        
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
		$('#uang5').on('keypress', function(e) {
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
		$('#uang6').on('keypress', function(e) {
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
		$('#uang7').on('keypress', function(e) {
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
		$('#uang8').on('keypress', function(e) {
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
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example3').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example5').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>