<?
	if($submenu == 'r1')
		{
		$q  = $_GET['q'];	
		$qx = explode("-", $q);
		$q1 = $qx[0];
		
		echo "<option value=''>Pilih Kecamatan</option>";
		$qA = mysql_query("SELECT * FROM kd_kecamatan WHERE kodekab='$q1' ORDER BY namakec");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[kodekab]-$d[kodekec]-$d[namakec]'>$d[namakec]</option>";
			}
		}
		
	else if($submenu == 'kab')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$kodekab 	= strtoupper($_REQUEST['kodekab']);
				$namakab	= strtoupper($_REQUEST['namakab']);
							
				$dCek = mysql_fetch_array(mysql_query("SELECT kodekab FROM kd_kabupaten WHERE kodekab='$kodekab' OR namakab='$namakab'"));
				if(!empty($dCek[kodekab]))
					{
					echo "<script>alert ('Kabupaten Yang Diinput Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				
				$q1 = mysql_query("INSERT INTO kd_kabupaten (
													kodekab, 
													namakab) 
												VALUES (
													'$kodekab', 
													'$namakab');
									");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kabupaten',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH KABUPATEN $kodekab')
									");
						
						
						if($q1 && $q2)
							{
							//echo "<script>alert ('Proses berhasil.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							//exit();
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
				$q1 = mysql_query("DELETE FROM kd_kabupaten WHERE kodekab='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kabupaten',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS KABUPATEN $_REQUEST[deluser]')
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
				$namakab	= strtoupper($_REQUEST['namakab']);
							
				$q1 = mysql_query("UPDATE kd_kabupaten SET
													namakab='$namakab'
											WHERE kodekab='$_REQUEST[kodekab]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kabupaten',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH KABUPATEN $_REQUEST[kodekab]')
									");
					
					if($q1 && $q2)
						{
						//echo "<script>alert ('Proses berhasil.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						//exit();
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
			                	<h4>MASTER <small>DAERAH <i class="fa fa-angle-right"></i> KABUPATEN</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-kabupaten" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Kabupaten Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px;width:15%">KODE KABUPATEN</th>
			                                    <th style="padding:7px">NAMA KABUPATEN</th>
			                                    <th width="5%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM kd_kabupaten");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodekab]?></td>
			                                    <td><?echo $d1[namakab]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
													<?
													if($_SESSION[posisi]=='DIREKSI')
														{
													?>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&kodekab=$d1[kodekab]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a>
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
					
<!-- ################## MODAL TAMBAH KABUPATEN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-kabupaten" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:40%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KABUPATEN BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">KODE KABUPATEN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="kodekab" class="form-control" style="width:30%" maxlength="2" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KABUPATEN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakab" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM kd_kabupaten WHERE kodekab='$_REQUEST[kodekab]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>DAERAH <i class="fa fa-angle-right"></i> KABUPATEN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Kabupaten</small></h4>
			                		<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">KODE KABUPATEN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="kodekab" value="<?echo $d1[kodekab]?>" class="form-control" style="width:30%" maxlength="2" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KABUPATEN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakab" value="<?echo $d1[namakab]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required=""></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[kodekab]?>">
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
		
	else if($submenu == 'kec')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$kodekab 	= strtoupper($_REQUEST['kodekab']);
				$dA = mysql_fetch_array(mysql_query("SELECT kodekec FROM kd_kecamatan WHERE kodekab='$kodekab' ORDER BY kodekec DESC"));
				$kodekecX = $dA['kodekec'] + 1;
				if(strlen($kodekecX) == 1){
					$kodekec = "0".$kodekecX;}
				else if(strlen($kodekecX) == 2){
					$kodekec = $kodekecX;}
			
				$namakec	= strtoupper($_REQUEST['namakec']);
							
				$dCek = mysql_fetch_array(mysql_query("SELECT kodekab FROM kd_kecamatan WHERE kodekab='$kodekab' AND namakec='$namakec'"));
				if(!empty($dCek[kodekab]))
					{
					echo "<script>alert ('Kecamatan Yang Diinput Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
							
				$q1 = mysql_query("INSERT INTO kd_kecamatan (
													kodekab, 
													kodekec, 
													namakec) 
												VALUES (
													'$kodekab', 
													'$kodekec', 
													'$namakec');
									");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kecamatan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH KECAMATAN $kodekab.$kodekec')
									");
						
						
						if($q1 && $q2)
							{
							//echo "<script>alert ('Proses berhasil.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							//exit();
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}

			if(!empty($_REQUEST[delkodekec]))
				{
				$q1 = mysql_query("DELETE FROM kd_kecamatan WHERE kodekab='$_REQUEST[kodekab]' AND kodekec='$_REQUEST[delkodekec]'");
				$q1 = mysql_query("DELETE FROM kd_kelurahan WHERE kodekab='$_REQUEST[kodekab]' AND kodekec='$_REQUEST[delkodekec]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kecamatan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS KECAMATAN $_REQUEST[kodekab].$_REQUEST[delkodekec]')
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
				$kodekab 	= strtoupper($_REQUEST['kodekab']);
				$kodekec 	= strtoupper($_REQUEST['kodekec']);
				$namakec	= strtoupper($_REQUEST['namakec']);
							
				$q1 = mysql_query("UPDATE kd_kecamatan SET
													namakec='$namakec'
											WHERE kodekab='$_REQUEST[kodekab]' AND kodekec='$_REQUEST[kodekec]'
									");
				$q1 = mysql_query("UPDATE kd_kelurahan SET
													namakec='$namakec'
											WHERE kodekab='$_REQUEST[kodekab]' AND kodekec='$_REQUEST[kodekec]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kecamatan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH KECAMATAN $_REQUEST[kodekab].$_REQUEST[kodekec]')
									");
					
					if($q1 && $q2)
						{
						//echo "<script>alert ('Proses berhasil.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						//exit();
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
			                	<h4>MASTER <small>DAERAH <i class="fa fa-angle-right"></i> KECAMATAN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="NAMA KECAMATAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-kecupaten" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Kecamatan Baru</button>
										</a>
	                           		</div>
			                        <table id="example2" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px;width:15%">KODE KECAMATAN</th>
			                                    <th style="padding:7px;width:20%"">NAMA KABUPATEN</th>
			                                    <th style="padding:7px">NAMA KECAMATAN</th>
			                                    <th width="5%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM kd_kecamatan WHERE namakec LIKE '%$_REQUEST[cari]%'");
											}
										else{
											$q1 = mysql_query("SELECT * FROM kd_kecamatan");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT namakab FROM kd_kabupaten WHERE kodekab='$d1[kodekab]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo "$d1[kodekab].$d1[kodekec]"?></td>
			                                    <td><?echo $d2[namakab]?></td>
			                                    <td><?echo $d1[namakec]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
													<?
													if($_SESSION[posisi]=='DIREKSI')
														{
													?>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&kodekec=$d1[kodekec]&kodekab=$d1[kodekab]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a>
													<?
														}
													?>
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
					
<!-- ################## MODAL TAMBAH KECAMATAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-kecupaten" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:40%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KECAMATAN BARU</h4>
				                    </div>
									
				                   	<form method="post" name="inputkec" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA KABUPATEN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelectA(this.value)">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
														echo "<option value='$data[kodekab]'>$data[namakab]</option>";
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KECAMATAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakec" value="<?echo $d1[namakec]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled=""></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM kd_kecamatan WHERE kodekab='$_REQUEST[kodekab]' AND kodekec='$_REQUEST[kodekec]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT namakab FROM kd_kabupaten WHERE kodekab='$_REQUEST[kodekab]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>DAERAH <i class="fa fa-angle-right"></i> KECAMATAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Kecamatan</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">KODE KECAMATAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" name="namakab" value="<?echo "$d1[kodekab].$d1[kodekec]"?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KABUPATEN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakec" value="<?echo $d2[namakab]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KECAMATAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakec" value="<?echo $d1[namakec]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required=""></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
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
		
	else if($submenu == 'kel')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$kode_kabA 		= explode("-",$_REQUEST['kodekab']);
					$kodekab 	= strtoupper($kode_kabA[0]);
					$namakab 	= strtoupper($kode_kabA[1]);
					
				$kode_kecA 		= explode("-",$_REQUEST['kodekec']);
					$kodekec 	= strtoupper($kode_kecA[1]);
					$namakec 	= strtoupper($kode_kecA[2]);
					
				$namakel 	= strtoupper($_REQUEST['namakel']);
							
				$dCek = mysql_fetch_array(mysql_query("SELECT kodekab FROM kd_kelurahan WHERE kodekab='$kodekab' AND kodekec='$kodekec' AND namakel='$namakel'"));
				if(!empty($dCek[kodekab]))
					{
					echo "<script>alert ('Kelurahan Yang Diinput Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
					
				$dA = mysql_fetch_array(mysql_query("SELECT kodekel FROM kd_kelurahan WHERE kodekab='$kodekab' AND kodekec='$kodekec' ORDER BY kodekel DESC"));
				$kodekelX = $dA['kodekel'] + 1;
				if(strlen($kodekelX) == 1){
					$kodekel = "0".$kodekelX;}
				else if(strlen($kodekelX) == 2){
					$kodekel = $kodekelX;}
					
				$kode		 = "$kodekab.$kodekec.$kodekel";
							
				$q1 = mysql_query("INSERT INTO kd_kelurahan (
													kode, 
													kodekab, 
													namakab, 
													kodekec, 
													namakec, 
													kodekel, 
													namakel) 
												VALUES (
													'$kode', 
													'$kodekab', 
													'$namakab', 
													'$kodekec', 
													'$namakec', 
													'$kodekel',
													'$namakel');
									");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kelurahan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH KELURAHAN $kode')
									");
						
						
						if($q1 && $q2)
							{
							//echo "<script>alert ('Proses berhasil.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							//exit();
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}

			if(!empty($_REQUEST[delkode]))
				{
				$q1 = mysql_query("DELETE FROM kd_kelurahan WHERE kode='$_REQUEST[delkode]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kelurahan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS KELURAHAN $_REQUEST[delkode]')
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
				$kode 		= strtoupper($_REQUEST['kode']);
				$namakel	= strtoupper($_REQUEST['namakel']);
							
				$q1 = mysql_query("UPDATE kd_kelurahan SET
													namakel='$namakel'
											WHERE kode='$kode'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'kd_kelurahan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH KELURAHAN $kode')
									");
					
					if($q1 && $q2)
						{
						//echo "<script>alert ('Proses berhasil.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						//exit();
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
			                	<h4>MASTER <small>DAERAH <i class="fa fa-angle-right"></i> KELURAHAN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="NAMA KELURAHAN / NAMA KECAMATAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-kecupaten" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Kelurahan Baru</button>
										</a>
	                           		</div>
			                        <table id="example2" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px;width:15%">KODE KELURAHAN</th>
			                                    <th style="padding:7px;width:20%"">NAMA KABUPATEN</th>
			                                    <th style="padding:7px;width:20%"">NAMA KECAMATAN</th>
			                                    <th style="padding:7px">NAMA KELURAHAN</th>
			                                    <th width="5%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM kd_kelurahan WHERE namakec LIKE '%$_REQUEST[cari]%' OR namakel LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM kd_kelurahan LIMIT 0,100");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo "$d1[kode]"?></td>
			                                    <td><?echo $d1[namakab]?></td>
			                                    <td><?echo $d1[namakec]?></td>
			                                    <td><?echo $d1[namakel]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
													<?
													if($_SESSION[posisi]=='DIREKSI')
														{
													?>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&kodekel=$d1[kodekel]&kodekec=$d1[kodekec]&kodekab=$d1[kodekab]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a>
													<?
														}
													?>
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
					
<!-- ################## MODAL TAMBAH KELURAHAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-kecupaten" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:40%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KELURAHAN BARU</h4>
				                    </div>
									
				                   	<form method="post" name="inputkel" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA KABUPATEN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
														echo "<option value='$data[kodekab]-$data[namakab]'>$data[namakab]</option>";
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KECAMATAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
													<option value='' >Pilih Kecamatan</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KELURAHAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakel" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled=""></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM kd_kelurahan WHERE kodekab='$_REQUEST[kodekab]' AND kodekec='$_REQUEST[kodekec]' AND kodekel='$_REQUEST[kodekel]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>DAERAH <i class="fa fa-angle-right"></i> KELURAHAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Kelurahan</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">KODE KELURAHAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="kode" class="form-control" value="<?echo "$d1[kode]"?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KABUPATEN</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo $d1[namakab]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KECAMATAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo $d1[namakec]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA KELURAHAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="namakel" value="<?echo $d1[namakel]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required=""></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="1">
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
		function populateSelectA(str)
		{
			pilihan = document.inputkec.kodekab.value;
			if(pilihan==''){
			document.inputkec.namakec.disabled = 1;
			}else{
			document.inputkec.namakec.disabled = 0;
			}
		}
		
		function populateSelect(str)
		{
			if (str==""){
				document.getElementById("r1").value="";
				false;
			}
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			}
			else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (this.readyState == 4)
				{
					if (this.status == 200)
					{
					document.getElementById("r1").innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=r1"?>&q="+str,true);
			xmlhttp.send();
			
			pilihan = document.inputkel.kodekab.value;
			if(pilihan==''){
			document.inputkel.kodekec.disabled = 1;
			document.inputkel.kodekel.disabled = 1;
			}else{
			document.inputkel.kodekec.disabled = 0;
			document.inputkel.kodekel.disabled = 1;
			}
		}

		function populateSelect2(str)
		{
			if (str==""){
				document.getElementById("r2").value="";
				false;
			}
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			}
			else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (this.readyState == 4)
				{
					if (this.status == 200)
					{
					document.getElementById("r2").innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=r2"?>&q="+str,true);
			xmlhttp.send();
			
			pilihan = document.inputkel.kodekec.value;
			if(pilihan==''){
			document.inputkel.namakel.disabled = 1;
			}else{
			document.inputkel.namakel.disabled = 0;
			}
		}
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>