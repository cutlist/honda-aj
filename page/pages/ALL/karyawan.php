<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$nama 		= strtoupper(addslashes($_REQUEST['nama']));
				$posisi		= strtoupper($_REQUEST['posisi']);
				$tmplahir 	= strtoupper(addslashes($_REQUEST['tmplahir']));
				$tgllahir 	= date("Y-m-d", strtotime($_REQUEST['tgllahir']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$tglmulaikerja 	= date("Y-m-d", strtotime($_REQUEST['tglmulaikerja']));
				$ugapok 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ugapok']);
				$uharian 	= preg_replace( "/[^0-9]/", "",$_REQUEST['uharian']);
				$ukomisi 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ukomisi']);
				$ulembur 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ulembur']);
							
				$q1 = mysql_query("INSERT INTO tbl_karyawan (
													nama, 
													posisi, 
													tmplahir, 
													tgllahir, 
													noktp, 
													notelepon, 
													alamat, 
													tglmulaikerja, 
													ugapok, 
													uharian, 
													ukomisi, 
													ulembur,
													pic_user) 
												VALUES (
													'$nama', 
													'$posisi', 
													'$tmplahir', 
													'$tgllahir', 
													'$noktp', 
													'$notelepon', 
													'$alamat', 
													'$tglmulaikerja', 
													'$ugapok', 
													'$uharian', 
													'$ukomisi', 
													'$ulembur',
													'$_SESSION[user]');
									");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_karyawan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH KARYAWAN $nama')
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

			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM tbl_karyawan WHERE id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_karyawan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS KARYAWAN $_REQUEST[nama]')
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
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah]))
				{				
				$nama 		= strtoupper(addslashes($_REQUEST['nama']));
				$posisi		= strtoupper($_REQUEST['posisi']);
				$tmplahir 	= strtoupper(addslashes($_REQUEST['tmplahir']));
				$tgllahir 	= date("Y-m-d", strtotime($_REQUEST['tgllahir']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$tglmulaikerja 	= date("Y-m-d", strtotime($_REQUEST['tglmulaikerja']));
				$ugapok 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ugapok']);
				$uharian 	= preg_replace( "/[^0-9]/", "",$_REQUEST['uharian']);
				$ukomisi 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ukomisi']);
				$ulembur 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ulembur']);
							
				$q1 = mysql_query("UPDATE tbl_karyawan SET
													nama='$nama',
													posisi='$posisi', 
													tmplahir='$tmplahir',
													tgllahir='$tgllahir',
													noktp='$noktp', 
													notelepon='$notelepon',
													alamat='$alamat', 
													tglmulaikerja='$tglmulaikerja', 
													ugapok='$ugapok', 
													uharian='$uharian', 
													ukomisi='$ukomisi', 
													ulembur='$ulembur',
													pic_user='$_SESSION[user]'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_karyawan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH KARYAWAN $nama')
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
			                	<h4>MASTER <small>KARYAWAN</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-karyawan" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Karyawan Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NAMA</th>
			                                    <th style="padding:7px">POSISI</th>
			                                    <th width="1%" style="padding:7px">USIA</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th style="padding:7px">ALAMAT</th>
			                                    <th width="10%" style="padding:7px">MULAI KERJA</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id !='1' ORDER BY nama");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[posisi]?></td>
			                                    <td align="right"><?echo $d1[usia]?></td>
			                                    <td align="right"><?echo $d1[notelepon]?></td>
			                                    <td><?echo $d1[alamat]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deluser=$d1[id]&nama=$d1[nama]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
					
<!-- ################## MODAL TAMBAH KARYAWAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-karyawan" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KARYAWAN BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table>
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" required style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi WHERE id!='1' ORDER BY posisi");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>'><?echo $dA[posisi]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TEMPAT/TGL LAHIR</td>
				                    			<td>:</td>
				                    			<td colspan="1"><input type="text" name="tmplahir" maxlength="20" class="form-control" required></td>
				                    			<td colspan="1" width="20%"><input type="text" name="tgllahir" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="noktp" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="notelepon" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL MULAI KERJA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tglmulaikerja" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>GAJI POKOK</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ugapok" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="uharian" id="uang2" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ukomisi" id="uang3" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ulembur" id="uang4" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
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
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KARYAWAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Karyawan</small></h4>
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" readonly style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi WHERE id!='1' ORDER BY posisi");
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KARYAWAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Karyawan</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" required style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi WHERE id!='1' ORDER BY posisi");
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
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>