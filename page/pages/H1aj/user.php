<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{			
				$id_karyawan	= $_POST['id_karyawan'];
				$user 	= $_POST['user'];
				$pass1 	= $_POST['pass1'];
				$pass2 	= $_POST['pass2'];
				$hakakses	= $_POST['hakakses'];
				
				$pass	= md5($pass2);

				$d1 = mysql_fetch_array(mysql_query("SELECT user FROM tbl_user WHERE id%2=0 AND user='$user' OR id_karyawan='$id_karyawan'"));

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
						$q1 = mysql_query("INSERT INTO tbl_user (
													id_karyawan, 
													user, 
													pass,
													hakakses,
													pic_user) 
												VALUES (
													'$id_karyawan', 
													'$user', 
													'$pass', 
													'$hakakses', 
													'$_SESSION[user]')
											");
						}
									
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_user',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH USER $user')
									");
						
						
						if($q1 && $q2)
							{
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
					$q1 = mysql_query("UPDATE tbl_user SET pass='$pass',pic_user='$_SESSION[user]' WHERE id%2=0 AND id='$_REQUEST[resetpass]'");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_user',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'RESET PASSWORD $_REQUEST[nama]')
									");
					}
				
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
			
			if(!empty($_REQUEST[ubahdetail]))
				{
				$q1 = mysql_query("UPDATE tbl_user SET hakakses='$_REQUEST[hakakses]',pic_user='$_SESSION[user]' WHERE id%2=0 AND id='$_REQUEST[ubahdetail]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_user',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH USER $_REQUEST[nama]')
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

			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM tbl_user WHERE id%2=0 AND id='$_REQUEST[deluser]'");
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
			                	<h4>MASTER <small>USER</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-user" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; User Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px">USERNAME</th>
			                                    <th width="20%" style="padding:7px">POSISI</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_user_vw WHERE id!='1' ORDER BY nama");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[user]?></td>
			                                    <td align="center"><?echo $d1[posisi]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-120px;font-size: 12px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-resetpassword<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-lock"></i>Reset Password</a></li>
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
			                        </table>
			                    </div>
			                </div>
			            </div>
			    <?
                    $q2 = mysql_query("SELECT * FROM tbl_user_vw");
                    while($d2 = mysql_fetch_array($q2))
                    	{
                ?>
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
					                    	<input type="hidden" name="resetpass" value="<?echo $d2[id]?>">
					                    	<input type="hidden" name="nama" value="<?echo $d2[nama]?>">
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
<!-- ############################################################################################################################### -->
                <?
                		}
                ?>

<!-- ################## MODAL TAMBAH USER ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-user" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
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
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select class="form-control select1" name="id_karyawan" style="width:70%;font-size:12px;padding:3px" required>
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND id NOT IN (SELECT id_karyawan FROM tbl_user) ORDER BY nama");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>'><?echo $dA[nama]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>USERNAME</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="user" class="form-control"required></td>
				                    		
				                    		</tr>
				                    		<tr>
				                    			<td>PASSWORD</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="password" name="pass1" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>ULANGI PASSWORD</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="password" name="pass2" class="form-control" required></td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>HAK AKSES</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="hakakses" style="width:40%" required>
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_hakakses ORDER BY hakakses");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[hakakses]?>'><?echo $dA[hakakses]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		-->
					                    	<input type="hidden" name="hakakses" value="USER">
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>USER &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail User</small></h4>
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" readonly style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi ORDER BY posisi");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>' <?if($d1[posisi]==$dA[posisi]){?>selected=""<?}?>><?echo $dA[posisi]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TEMPAT/TGL LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="1"><input type="text" name="tmplahir" value="<?echo $d1[tmplahir]?>" maxlength="20" class="form-control" readonly></td>
				                    			<td colspan="1" width="20%"><input type="text" name="tgllahir" value="<?echo date("d-m-Y",strtotime($d1[tgllahir]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
											</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL MULAI KERJA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tglmulaikerja" value="<?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?>" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
											</tr>
				                    		<tr>
				                    			<td>GAJI POKOK</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ugapok" value="<?echo number_format($d1[ugapok],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="uharian" value="<?echo number_format($d1[uharian],"0","",".")?>" id="uang2" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ukomisi" value="<?echo number_format($d1[ukomisi],"0","",".")?>" id="uang3" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ulembur" value="<?echo number_format($d1[ulembur],"0","",".")?>" id="uang4" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>USER &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail User</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" required style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi ORDER BY posisi");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>' <?if($d1[posisi]==$dA[posisi]){?>selected=""<?}?>><?echo $dA[posisi]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TEMPAT/TGL LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="1"><input type="text" name="tmplahir" value="<?echo $d1[tmplahir]?>" maxlength="20" class="form-control" required></td>
				                    			<td colspan="1" width="20%"><input type="text" name="tgllahir" value="<?echo date("d-m-Y",strtotime($d1[tgllahir]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL MULAI KERJA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tglmulaikerja" value="<?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?>" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>GAJI POKOK</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ugapok" value="<?echo number_format($d1[ugapok],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="uharian" value="<?echo number_format($d1[uharian],"0","",".")?>" id="uang2" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ukomisi" value="<?echo number_format($d1[ukomisi],"0","",".")?>" id="uang3" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ulembur" value="<?echo number_format($d1[ulembur],"0","",".")?>" id="uang4" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
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
        <script>
			$(function(){
			  var select = $('.select1').select2();
			}); 
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
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>