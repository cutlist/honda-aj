<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[ubah]))
			{			
			$nama 		= strtoupper(addslashes($_REQUEST['nama']));
			$tmplahir 	= strtoupper(addslashes($_REQUEST['tmplahir']));
			$tgllahir 	= date("Y-m-d", strtotime($_REQUEST['tgllahir']));
			$noktp 		= $_REQUEST['noktp'];
			$notelepon 	= $_REQUEST['notelepon'];
			$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
			$_SESSION['nama'] = $nama;
			
			$q1 = mysql_query("UPDATE x23_karyawan SET
												nama='$nama',
												tmplahir='$tmplahir',
												tgllahir='$tgllahir',
												noktp='$noktp', 
												notelepon='$notelepon',
												alamat='$alamat'
										WHERE id='$_REQUEST[ubah]'
								");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_karyawan',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH KARYAWAN $nama')
								");
				
				if($q1 && $q2)
					{
					echo "<script>alert ('Data Berhasil Disimpan.')</script>";
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
			$pass1 	= $_REQUEST['pass1'];
			$pass2 	= $_REQUEST['pass2'];
			$pass	= md5($pass2);
			if($pass1 != $pass2)
				{
					echo "<script>alert ('Password yang Anda ulangi tidak sama.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
				}
			else
				{
				$q1 = mysql_query("UPDATE x23_user SET pass='$pass' WHERE id='$_SESSION[id]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_user',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'RESET PASSWORD $_REQUEST[nama]')
								");
				}
			
			if($q1)
				{
				echo "<script>alert ('Password Anda Berhasil Diubah.')</script>";
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
			    <section class="content">
			        <div class="row">
<?
						$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan_vw WHERE nama='$_SESSION[nama]'"));
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan_vw WHERE id='$dA[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PROFILE <small><?echo $_SESSION['nama']?> &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Profile</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:60%;">
				                    		<tr>
				                    			<td width="30%">USERNAME</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1"><input type="text" value="<?echo $_SESSION[user]?>" class="form-control" readonly=""></td>
				                    			<td colspan="1">
														<a data-toggle="modal" data-target="#compose-modal-resetpassword" style="cursor:pointer">
															<button type="button" class="btn btn-warning" style="height:30px"><i class="fa fa-key"></i> &nbsp; Ganti Password</button>
														</a>
												</td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NIK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nik" value="<?echo $d1[nik]?>" class="form-control" style="width: 50%" maxlength="12" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" readonly style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM x23_posisi WHERE id!='1' ORDER BY posisi");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[id]?>' <?if($d1[posisi]==$dA[posisi]){?>selected=""<?}?>><?echo $dA[posisi]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    	<?
				                    	if($d1[posisi]=="8")
				                    		{
										?>
				                    		<tr>
				                    			<td>GOLONGAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="pangkat" readonly style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM x23_pangkat ORDER BY pangkat");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[pangkat]?>' <?if($d1[pangkat]==$dA[pangkat]){?>selected=""<?}?>><?echo $dA[pangkat]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
										<?
											}
				                    	?>
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
				                    			<td colspan="2"><input type="text" name="tglmulaikerja" value="<?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?>" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
											</tr>
				                    		<tr>
				                    			<td>GAJI POKOK</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="ugapok" value="<?echo number_format($d1[ugapok],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="uharian" value="<?echo number_format($d1[uharian],"0","",".")?>" id="uang2" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
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
				                                        <input type="text" name="ulembur" value="<?echo number_format($d1[ulembur],"0","",".")?>" id="uang4" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
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
			        </div>
				</section>
			</aside>
			
<!-- ################## MODAL RESET PASSWORD ####################################################################################### -->
				        <div class="modal fade " id="compose-modal-resetpassword" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">GANTI PASSWORD</h4>
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
					                    	<input type="hidden" name="resetpass" value="<?echo $d1[id]?>">
					                    	<input type="hidden" name="nama" value="<?echo $d1[nama]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
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