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
		
	else if($submenu == 'r2')
		{
		$q  = $_GET['q'];	 
		$qx = explode("-", $q);
		$q1 = $qx[0];
		$q2 = $qx[1];
		
		$dB = mysql_fetch_array( mysql_query("SELECT * FROM kd_kelurahan WHERE kodekab ='$q1' AND kodekec='$q2'"));
		$dC = mysql_fetch_array(mysql_query("SELECT * FROM kd_kecamatan WHERE kodekab ='$q1' AND kodekec='$q2'"));
		
		if(empty($dB['namakel']))
			{
			echo "<option value='00-$dC[namakec]'>$dC[namakec]</option>";
			}
		if(!empty($dB['namakel']))
			{
			echo "<option value=''>- Pilih Kelurahan -</option>";
				$qA = mysql_query("SELECT * FROM kd_kelurahan WHERE kodekab ='$q1' AND kodekec='$q2' ORDER BY namakel");
				while($dA = mysql_fetch_array($qA))
				{
				echo "<option value='$dA[kodekel]-$dA[namakel]'>$dA[namakel]</option>";
				}
			}
		}
		
	else if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$nama 		= strtoupper(addslashes($_REQUEST['nama']));
				$ohc 		= strtoupper($_REQUEST['ohc']);
				$kadaluarsaohc 	= date("Y-m-d", strtotime($_REQUEST['kadaluarsaohc']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$rt 		= $_REQUEST['rt'];
				$rw 		= $_REQUEST['rw'];
				
				$email		= $_REQUEST['email'];
				
					$kode_kabA 		= explode("-",$_REQUEST['kodekab']);
						$kodekab 	= strtoupper($kode_kabA[0]);
						$namakab 	= strtoupper($kode_kabA[1]);
						
					$kode_kecA 		= explode("-",$_REQUEST['kodekec']);
						$kodekec 	= strtoupper($kode_kecA[1]);
						$namakec 	= strtoupper($kode_kecA[2]);
						
					$kode_kelA 		= explode("-",$_REQUEST['kodekel']);
						$kodekel 	= strtoupper($kode_kelA[0]);
						$namakel 	= strtoupper($kode_kelA[1]);
						
					$kodealamat		= "$kodekab.$kodekec.$kodekel";
					
				$pekerjaan	= strtoupper($_REQUEST['pekerjaan']);
							
				$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pelanggan WHERE ohc='$ohc'"));				
				if(!empty($dCek[id]))
					{
					echo "<script>alert ('Mohon Ulangi OHC Yang Diinput, Karena OHC Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				
				$q1 = mysql_query("INSERT INTO tbl_pelanggan (
														nama, 
														ohc, 
														kadaluarsaohc, 
														notelepon, 
														noktp, 
														alamat, 
														rt, 
														rw, 
														kodekab, 
														namakab, 
														kodekec, 
														namakec, 
														kodekel, 
														namakel, 
														kodealamat, 
														email, 
														pekerjaan) 
													VALUES (
														'$nama', 
														'$ohc', 
														'$kadaluarsaohc', 
														'$notelepon', 
														'$noktp', 
														'$alamat', 
														'$rt', 
														'$rw', 
														'$kodekab', 
														'$namakab', 
														'$kodekec', 
														'$namakec', 
														'$kodekel', 
														'$namakel', 
														'$kodealamat', 
														'$email', 
														'$pekerjaan');
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH PELANGGAN $nama')
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
				$q1 = mysql_query("DELETE FROM tbl_pelanggan WHERE id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS PELANGGAN $_REQUEST[nama]')
									");
				/*
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
				*/
				}
			}
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah]))
				{				
				$nama 		= strtoupper(addslashes($_REQUEST['nama']));
				$ohc 		= strtoupper($_REQUEST['ohc']);
				$kadaluarsaohc 	= date("Y-m-d", strtotime($_REQUEST['kadaluarsaohc']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$rt 		= $_REQUEST['rt'];
				$rw 		= $_REQUEST['rw'];
				
				$email		= $_REQUEST['email'];
				
					$kode_kabA 		= explode("-",$_REQUEST['kodekab']);
						$kodekab 	= strtoupper($kode_kabA[0]);
						$namakab 	= strtoupper($kode_kabA[1]);
						
					$kode_kecA 		= explode("-",$_REQUEST['kodekec']);
						$kodekec 	= strtoupper($kode_kecA[1]);
						$namakec 	= strtoupper($kode_kecA[2]);
						
					$kode_kelA 		= explode("-",$_REQUEST['kodekel']);
						$kodekel 	= strtoupper($kode_kelA[0]);
						$namakel 	= strtoupper($kode_kelA[1]);
						
					$kodealamat		= "$kodekab.$kodekec.$kodekel";
					
				$pekerjaan	= strtoupper($_REQUEST['pekerjaan']);
							
							
				$q1 = mysql_query("UPDATE tbl_pelanggan SET
													nama='$nama', 
													ohc='$ohc', 
													ohc='$ohc', 
													kadaluarsaohc='$kadaluarsaohc', 
													noktp='$noktp', 
													alamat='$alamat', 
													rt='$rt', 
													rw='$rw', 
													kodekab='$kodekab', 
													namakab='$namakab', 
													kodekec='$kodekec', 
													namakec='$namakec', 
													kodekel='$kodekel', 
													namakel='$namakel', 
													kodealamat='$kodealamat', 
													email='$email', 
													pekerjaan='$pekerjaan'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH PELANGGAN $nama')
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
			
		else if($mod == "hleasing")
			{
			if(!empty($_REQUEST[input]))
				{				
				$kodeleasing 	= $_REQUEST['kodeleasing'];
				$tanggal	 	= date("Y-m-d", strtotime($_REQUEST['tanggal']));
				$status 		= $_REQUEST['status'];
				$unit 			= strtoupper($_REQUEST['unit']);
				$termin 		= $_REQUEST['termin'];
											
				$q1 = mysql_query("INSERT INTO tbl_hleasing VALUES (										
			                                    '',
			                                    '$_REQUEST[id]',
			                                    '$kodeleasing',
			                                    '$unit',
			                                    '$termin',
			                                    '$tanggal',
			                                    '$status')
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'INPUT RIWAYAT LEASING $kodeleasing')
									");
					/*
					if($q1 && $q2)
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
						exit();
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
						exit();
						}
					*/
				}

			if(!empty($_REQUEST[delhleasing]))
				{
				$q1 = mysql_query("DELETE FROM tbl_hleasing WHERE id='$_REQUEST[delhleasing]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS RIWAYAT LEASING $_REQUEST[kodeleasing]')
									");
				/*
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				*/
				}

			if(!empty($_REQUEST[ubah]))
				{
				$kodeleasing 	= $_REQUEST['kodeleasing'];
				$tanggal	 	= date("Y-m-d", strtotime($_REQUEST['tanggal']));
				$status 		= $_REQUEST['status'];
				
				$q1 = mysql_query("UPDATE tbl_hleasing SET	
			                                    kodeleasing='$kodeleasing',
			                                    tanggal='$tanggal',
			                                    status='$status'
			                                WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH RIWAYAT LEASING $kodeleasing')
									");
				
				
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
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
			                	<h4>PELANGGAN <small>DAFTAR SEMUA PELANGGAN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA PELANGGAN / OHC / NO. TELEPON ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-barang" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Pelanggan Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="22%" style="padding:7px">NAMA</th>
			                                    <th width="13%" style="padding:7px">OHC</th>
			                                    <th width="10%" style="padding:7px">KADALUARSA</th>
			                                    <th width="12%" style="padding:7px">TELEPON</th>
			                                    <th width="40%" style="padding:7px">ALAMAT</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[kadaluarsaohc]=="0000-00-00"){
												$kadaluarsaohc = "-";
													$red = "style='cursor:pointer'";
												}
											else{
												$kadaluarsaohcX = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
												$expired_date   = $d1[kadaluarsaohc];
												list($year, $month, $day) = explode('-', $expired_date);
												$new_expired_date = sprintf('%04d%02d%02d', $year, $month, $day);
												$date_now = date("Ymd");
												if($new_expired_date > $date_now)
													{
													$kadaluarsaohc 	= $kadaluarsaohcX;
													$red = "style='cursor:pointer'";
													}
												else{
													$kadaluarsaohc 	= "$kadaluarsaohcX";
													$red = "style='color:red;cursor:pointer'";
													}
												}
			                            ?>
			                                <tr <?echo $red?>>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[ohc]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="center"><?echo $kadaluarsaohc?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo "$d1[alamat]</br>KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-file"></i>Riwayat Leasing</a></li>
				                                                <li class="divider"></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deluser=$d1[id]&nama=$d1[nama]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
					
<!-- ################## MODAL TAMBAH DAFTAR PELANGGAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DAFTAR PELANGGAN BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:420px;">
				                    	<table>
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KADALUARSA OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kadaluarsaohc" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask></td>
											</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" class="form-control" maxlength="20" required></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required></textarea></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" class="form-control" placeholder="-" style="width:17%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 100%" onchange="populateSelect(this.value)">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
														echo "<option value='$data[kodekab]-$data[namakab]'>$data[namakab]</option>";
														}
													?>
													</select></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 100%" onchange="populateSelect2(this.value)" disabled="">
													<option value='' >Pilih Kecamatan</option>
													</select></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 100%;" disabled="">
													<option value='' >Pilih Kelurahan</option>
													</select></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" class="form-control" maxlength="40" placeholder="dikosongkan jika tidak memiliki email"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" class="form-control" maxlength="40" required></td><td><i class="fa fa-star"></i></td>
				                    		</tr>
				                    		<tr>
				                    			<td height="20px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><i class="fa fa-star"></i> Harus Diisi.</td>
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
						
					else if($mod == "hleasing")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
						if($d1[kadaluarsaohc]=="0000-00-00"){
							$kadaluarsaohc = "-";
							}
						else{
							$kadaluarsaohc = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
							}
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Pelanggan</small></h4>
			                		<div style="padding:20px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="submit" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KADALUARSA OHC</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo $kadaluarsaohc?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)" disabled="">
														<option value='' >Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
														<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;" disabled="">
														<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>EMAIL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<hr>
		                            	
		                           		<div style="margin-bottom:10px">
											<a data-toggle="modal" data-target="#compose-modal-baru-hleasing" style="cursor:pointer">
		                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Riwayat Leasing Baru</button>
											</a>
		                           		</div>
										<table class="table table-striped" >
											<thead>
				                                <tr>
				                                    <th width="">TANGGAL</th>
				                                    <th width="">KODE LEASING</th>
				                                    <th width="">NAMA LEASING</th>
				                                    <th width="">UNIT</th>
				                                    <th width="">MASA ANGSURAN</th>
				                                    <th width="">STATUS</th>
				                                    <th width="1%">ACTION</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $no = 1;
				                            $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$_REQUEST[id]' ORDER BY tanggal DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	if($d1[status]=='1'){
													$statusvw = "<button type='button' class='btn btn-primary' style='width:120px;font-size:10px'><i class='fa fa-thumbs-o-up'></i> &nbsp;$d1[ketstatus]</button>";
													}
												else{
													$statusvw = "<button type='button' class='btn btn-danger' style='width:120px;font-size:10px'><i class='fa fa-thumbs-o-down'></i> &nbsp;$d1[ketstatus]</button>";
													}
				                            ?>
				                                <tr>
				                                    <td align="" valign="middle"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
				                                    <td align="" valign="middle"><?echo $d1['kodeleasing']?></td>
				                                    <td align="" valign="middle"><?echo $d1['namaleasing']?></td>
				                                    <td align="" valign="middle"><?echo $d1['unit']?></td>
				                                    <td align="center" valign="middle"><?echo $d1['termin']?> KALI</td>
				                                    <td align="" valign="middle"><?echo $statusvw?></td>
				                                    <td width="1%" align="center" valign="middle"><div class="btn-group">
				                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
				                                                <span class="caret"></span>
				                                                <span class="sr-only">Actions</span>
				                                            </button>
				                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
				                                            	<!--<li><a  data-toggle="modal" data-target="#compose-modal-ubah-hleasing<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>-->
				                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]&delhleasing=$d1[id]&kodeleasing=$d1[kodeleasing]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                </div>
			                </div>
			            </div>
			        <?
                    $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$_REQUEST[id]' ORDER BY tanggal DESC");
                    while($d1 = mysql_fetch_array($q1))
                    	{
			        ?>
<!-- ################## MODAL EDIT RIWAYAT LEASING ########################################################################################## -->
				        <div class="modal fade" id="compose-modal-ubah-hleasing<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH RIWAYAT BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">LEASING</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodeleasing" class="form-control" style="width: 90%" onchange="populateSelect(this.value)" required>
													<option value='' >Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo $data[kodeleasing]?>' <?if($d1[kodeleasing]==$data[kodeleasing]){?>selected=""<?}?>><?echo $data[namaleasing]?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="1" <?if($d1[status]==1){?>checked=""<?}?>>
			                                                    DISETUJUI
			                                                </label> &nbsp;&nbsp;
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="0" <?if($d1[status]==0){?>checked=""<?}?>>
			                                                    DITOLAK
			                                                </label>
			                                            </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:30%"></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
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
			        ?>
					
<!-- ################## MODAL TAMBAH RIWAYAT LEASING ########################################################################################## -->
				        <div class="modal fade" id="compose-modal-baru-hleasing" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH RIWAYAT BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">LEASING</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodeleasing" class="form-control" style="width: 90%" onchange="populateSelect(this.value)" required>
													<option value='' >Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
														echo "<option value='$data[kodeleasing]'>$data[namaleasing]</option>";
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
			                                                    DISETUJUI
			                                                </label> &nbsp;&nbsp;
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="0" >
			                                                    DITOLAK
			                                                </label>
			                                            </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:30%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UNIT</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="unit" class="form-control" required style="width:90%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" onkeypress="return buat_angka(event,'0123456789')">
				                                        <span class="input-group-addon">Kali</span>
				                                    </div>
				                                </td>
				                    			<td colspan=""></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
						if($d1[kadaluarsaohc]=="0000-00-00"){
							$kadaluarsaohc = "-";
							}
						else{
							$kadaluarsaohc = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
							}
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KADALUARSA OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo $kadaluarsaohc?>" class="form-control" readonly></td>
											</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)" disabled="">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;" disabled="">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
		                            </form>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KADALUARSA OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo date("d-m-Y",strtotime($d1[kadaluarsaohc]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" required></td>
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
		
	else if($submenu == 'B')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM tbl_pelanggan WHERE id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS PELANGGAN $_REQUEST[nama]')
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
				$ohc 		= strtoupper($_REQUEST['ohc']);
				$kadaluarsaohc 	= date("Y-m-d", strtotime($_REQUEST['kadaluarsaohc']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$rt 		= $_REQUEST['rt'];
				$rw 		= $_REQUEST['rw'];
				
				$email		= $_REQUEST['email'];
				
					$kode_kabA 		= explode("-",$_REQUEST['kodekab']);
						$kodekab 	= strtoupper($kode_kabA[0]);
						$namakab 	= strtoupper($kode_kabA[1]);
						
					$kode_kecA 		= explode("-",$_REQUEST['kodekec']);
						$kodekec 	= strtoupper($kode_kecA[1]);
						$namakec 	= strtoupper($kode_kecA[2]);
						
					$kode_kelA 		= explode("-",$_REQUEST['kodekel']);
						$kodekel 	= strtoupper($kode_kelA[0]);
						$namakel 	= strtoupper($kode_kelA[1]);
						
					$kodealamat		= "$kodekab.$kodekec.$kodekel";
					
				$pekerjaan	= strtoupper($_REQUEST['pekerjaan']);
							
							
				$q1 = mysql_query("UPDATE tbl_pelanggan SET
													nama='$nama', 
													ohc='$ohc', 
													kadaluarsaohc='$kadaluarsaohc', 
													notelepon='$notelepon', 
													noktp='$noktp', 
													alamat='$alamat', 
													rt='$rt', 
													rw='$rw', 
													kodekab='$kodekab', 
													namakab='$namakab', 
													kodekec='$kodekec', 
													namakec='$namakec', 
													kodekel='$kodekel', 
													namakel='$namakel', 
													kodealamat='$kodealamat', 
													email='$email', 
													pekerjaan='$pekerjaan'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH PELANGGAN $nama')
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
			
		else if($mod == "hleasing")
			{
			if(!empty($_REQUEST[input]))
				{				
				$kodeleasing 	= $_REQUEST['kodeleasing'];
				$tanggal	 	= date("Y-m-d", strtotime($_REQUEST['tanggal']));
				$status 		= $_REQUEST['status'];
				$unit 			= strtoupper($_REQUEST['unit']);
				$termin 		= $_REQUEST['termin'];
											
				$q1 = mysql_query("INSERT INTO tbl_hleasing VALUES (										
			                                    '',
			                                    '$_REQUEST[id]',
			                                    '$kodeleasing',
			                                    '$unit',
			                                    '$termin',
			                                    '$tanggal',
			                                    '$status')
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'INPUT RIWAYAT LEASING $kodeleasing')
									");
					/*
					if($q1 && $q2)
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
						exit();
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
						exit();
						}
					*/
				}

			if(!empty($_REQUEST[delhleasing]))
				{
				$q1 = mysql_query("DELETE FROM tbl_hleasing WHERE id='$_REQUEST[delhleasing]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS RIWAYAT LEASING $_REQUEST[kodeleasing]')
									");
				/*
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				*/
				}

			if(!empty($_REQUEST[ubah]))
				{
				$kodeleasing 	= $_REQUEST['kodeleasing'];
				$tanggal	 	= date("Y-m-d", strtotime($_REQUEST['tanggal']));
				$status 		= $_REQUEST['status'];
				
				$q1 = mysql_query("UPDATE tbl_hleasing SET	
			                                    kodeleasing='$kodeleasing',
			                                    tanggal='$tanggal',
			                                    status='$status'
			                                WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH RIWAYAT LEASING $kodeleasing')
									");
				
				
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
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
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN OHC</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA PELANGGAN / OHC / NO. TELEPON ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<table id="example1" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="22%" style="padding:7px">NAMA</th>
			                                    <th width="13%" style="padding:7px">OHC</th>
			                                    <th width="10%" style="padding:7px">KADALUARSA</th>
			                                    <th width="12%" style="padding:7px">TELEPON</th>
			                                    <th width="40%" style="padding:7px">ALAMAT</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE ohc!='' AND (nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%') LIMIT 0,5");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE ohc!='' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[kadaluarsaohc]=="0000-00-00"){
												$kadaluarsaohc = "-";
													$red = "style='cursor:pointer'";
												}
											else{
												$kadaluarsaohcX = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
												$expired_date   = $d1[kadaluarsaohc];
												list($year, $month, $day) = explode('-', $expired_date);
												$new_expired_date = sprintf('%04d%02d%02d', $year, $month, $day);
												$date_now = date("Ymd");
												if($new_expired_date > $date_now)
													{
													$kadaluarsaohc 	= $kadaluarsaohcX;
													$red = "style='cursor:pointer'";
													}
												else{
													$kadaluarsaohc 	= "<span style='color:#ec0244'>$kadaluarsaohcX</span>";
													$red = "style='color:red;cursor:pointer'";
													}
												}
			                            ?>
			                                <tr <?echo $red?>>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[ohc]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="center"><?echo $kadaluarsaohc?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo "$d1[alamat]</br>KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-file"></i>Riwayat Leasing</a></li>
				                                                <li class="divider"></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deluser=$d1[id]&nama=$d1[nama]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
<?
						}
						
					else if($mod == "hleasing")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
						if($d1[kadaluarsaohc]=="0000-00-00"){
							$kadaluarsaohc = "-";
							}
						else{
							$kadaluarsaohc = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
							}
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Pelanggan</small></h4>
			                		<div style="padding:20px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="submit" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KADALUARSA OHC</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo $kadaluarsaohc?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)" disabled="">
														<option value='' >Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
														<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;" disabled="">
														<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>EMAIL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<hr>
		                            	
		                           		<div style="margin-bottom:10px">
											<a data-toggle="modal" data-target="#compose-modal-baru-hleasing" style="cursor:pointer">
		                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Riwayat Leasing Baru</button>
											</a>
		                           		</div>
										<table class="table table-striped" >
											<thead>
				                                <tr>
				                                    <th width="">TANGGAL</th>
				                                    <th width="">KODE LEASING</th>
				                                    <th width="">NAMA LEASING</th>
				                                    <th width="">MASA ANGSURAN</th>
				                                    <th width="">STATUS</th>
				                                    <th width="1%">ACTION</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $no = 1;
				                            $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$_REQUEST[id]' ORDER BY tanggal DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	if($d1[status]=='1'){
													$statusvw = "<button type='button' class='btn btn-primary' style='width:120px;font-size:10px'><i class='fa fa-thumbs-o-up'></i> &nbsp;$d1[ketstatus]</button>";
													}
												else{
													$statusvw = "<button type='button' class='btn btn-danger' style='width:120px;font-size:10px'><i class='fa fa-thumbs-o-down'></i> &nbsp;$d1[ketstatus]</button>";
													}
				                            ?>
				                                <tr>
				                                    <td align="" valign="middle"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
				                                    <td align="" valign="middle"><?echo $d1['kodeleasing']?></td>
				                                    <td align="" valign="middle"><?echo $d1['namaleasing']?></td>
				                                    <td align="" valign="middle"><?echo $d1['unit']?></td>
				                                    <td align="center" valign="middle"><?echo $d1['termin']?></td>
				                                    <td align="" valign="middle"><?echo $statusvw?></td>
				                                    <td width="1%" align="center" valign="middle"><div class="btn-group">
				                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
				                                                <span class="caret"></span>
				                                                <span class="sr-only">Actions</span>
				                                            </button>
				                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
				                                            	<!--<li><a  data-toggle="modal" data-target="#compose-modal-ubah-hleasing<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>-->
				                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]&delhleasing=$d1[id]&kodeleasing=$d1[kodeleasing]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                </div>
			                </div>
			            </div>
			        <?
                    $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$_REQUEST[id]' ORDER BY tanggal DESC");
                    while($d1 = mysql_fetch_array($q1))
                    	{
			        ?>
<!-- ################## MODAL EDIT RIWAYAT LEASING ########################################################################################## -->
				        <div class="modal fade" id="compose-modal-ubah-hleasing<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH RIWAYAT BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">LEASING</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodeleasing" class="form-control" style="width: 90%" onchange="populateSelect(this.value)" required>
													<option value='' >Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo $data[kodeleasing]?>' <?if($d1[kodeleasing]==$data[kodeleasing]){?>selected=""<?}?>><?echo $data[namaleasing]?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="1" <?if($d1[status]==1){?>checked=""<?}?>>
			                                                    DISETUJUI
			                                                </label> &nbsp;&nbsp;
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="0" <?if($d1[status]==0){?>checked=""<?}?>>
			                                                    DITOLAK
			                                                </label>
			                                            </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:30%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UNIT</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="unit" class="form-control" required style="width:90%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" onkeypress="return buat_angka(event,'0123456789')">
				                                        <span class="input-group-addon">Kali</span>
				                                    </div>
				                                </td>
				                    			<td colspan=""></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
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
			        ?>
					
<!-- ################## MODAL TAMBAH RIWAYAT LEASING ########################################################################################## -->
				        <div class="modal fade" id="compose-modal-baru-hleasing" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH RIWAYAT BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">LEASING</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodeleasing" class="form-control" style="width: 90%" onchange="populateSelect(this.value)" required>
													<option value='' >Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
														echo "<option value='$data[kodeleasing]'>$data[namaleasing]</option>";
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
			                                                    DISETUJUI
			                                                </label> &nbsp;&nbsp;
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="0" >
			                                                    DITOLAK
			                                                </label>
			                                            </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:30%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UNIT</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="unit" class="form-control" required style="width:90%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" onkeypress="return buat_angka(event,'0123456789')">
				                                        <span class="input-group-addon">Kali</span>
				                                    </div>
				                                </td>
				                    			<td colspan=""></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
						if($d1[kadaluarsaohc]=="0000-00-00"){
							$kadaluarsaohc = "-";
							}
						else{
							$kadaluarsaohc = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
							}
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KADALUARSA OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo $kadaluarsaohc?>" class="form-control" readonly></td>
											</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)" disabled="">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;" disabled="">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
		                            </form>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KADALUARSA OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo date("d-m-Y",strtotime($d1[kadaluarsaohc]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" required></td>
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
		
	else if($submenu == 'C')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM tbl_pelanggan WHERE id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS PELANGGAN $_REQUEST[nama]')
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
				$ohc 		= strtoupper($_REQUEST['ohc']);
				$kadaluarsaohc 	= date("Y-m-d", strtotime($_REQUEST['kadaluarsaohc']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$rt 		= $_REQUEST['rt'];
				$rw 		= $_REQUEST['rw'];
				
				$email		= $_REQUEST['email'];
				
					$kode_kabA 		= explode("-",$_REQUEST['kodekab']);
						$kodekab 	= strtoupper($kode_kabA[0]);
						$namakab 	= strtoupper($kode_kabA[1]);
						
					$kode_kecA 		= explode("-",$_REQUEST['kodekec']);
						$kodekec 	= strtoupper($kode_kecA[1]);
						$namakec 	= strtoupper($kode_kecA[2]);
						
					$kode_kelA 		= explode("-",$_REQUEST['kodekel']);
						$kodekel 	= strtoupper($kode_kelA[0]);
						$namakel 	= strtoupper($kode_kelA[1]);
						
					$kodealamat		= "$kodekab.$kodekec.$kodekel";
					
				$pekerjaan	= strtoupper($_REQUEST['pekerjaan']);
							
							
				$q1 = mysql_query("UPDATE tbl_pelanggan SET
													nama='$nama', 
													ohc='$ohc', 
													kadaluarsaohc='$kadaluarsaohc', 
													notelepon='$notelepon', 
													noktp='$noktp', 
													alamat='$alamat', 
													rt='$rt', 
													rw='$rw', 
													kodekab='$kodekab', 
													namakab='$namakab', 
													kodekec='$kodekec', 
													namakec='$namakec', 
													kodekel='$kodekel', 
													namakel='$namakel', 
													kodealamat='$kodealamat', 
													email='$email', 
													pekerjaan='$pekerjaan'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_pelanggan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH PELANGGAN $nama')
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
			
		else if($mod == "hleasing")
			{
			if(!empty($_REQUEST[input]))
				{				
				$kodeleasing 	= $_REQUEST['kodeleasing'];
				$tanggal	 	= date("Y-m-d", strtotime($_REQUEST['tanggal']));
				$status 		= $_REQUEST['status'];
				$unit 			= strtoupper($_REQUEST['unit']);
				$termin 		= $_REQUEST['termin'];
											
				$q1 = mysql_query("INSERT INTO tbl_hleasing VALUES (										
			                                    '',
			                                    '$_REQUEST[id]',
			                                    '$kodeleasing',
			                                    '$unit',
			                                    '$termin',
			                                    '$tanggal',
			                                    '$status')
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'INPUT RIWAYAT LEASING $kodeleasing')
									");
					/*
					if($q1 && $q2)
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
						exit();
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
						exit();
						}
					*/
				}

			if(!empty($_REQUEST[delhleasing]))
				{
				$q1 = mysql_query("DELETE FROM tbl_hleasing WHERE id='$_REQUEST[delhleasing]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS RIWAYAT LEASING $_REQUEST[kodeleasing]')
									");
				/*
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				*/
				}

			if(!empty($_REQUEST[ubah]))
				{
				$kodeleasing 	= $_REQUEST['kodeleasing'];
				$tanggal	 	= date("Y-m-d", strtotime($_REQUEST['tanggal']));
				$status 		= $_REQUEST['status'];
				
				$q1 = mysql_query("UPDATE tbl_hleasing SET	
			                                    kodeleasing='$kodeleasing',
			                                    tanggal='$tanggal',
			                                    status='$status'
			                                WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_hleasing',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH RIWAYAT LEASING $kodeleasing')
									");
				
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
					exit();
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$_REQUEST[id]'/>";
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
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN NON OHC</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA PELANGGAN / OHC / NO. TELEPON ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<table id="example1" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="" style="padding:7px">NAMA</th>
			                                    <th width="12%" style="padding:7px">TELEPON</th>
			                                    <th width="20%" style="padding:7px">EMAIL</th>
			                                    <th width="40%" style="padding:7px">ALAMAT</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE ohc='' AND (nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%') LIMIT 0,5");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE ohc='' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[email]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo "$d1[alamat]</br>KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=hleasing&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-file"></i>Riwayat Leasing</a></li>
				                                                <li class="divider"></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deluser=$d1[id]&nama=$d1[nama]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
<?
						}
						
					else if($mod == "hleasing")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="submit" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)" disabled="">
														<option value='' >Pilih Kabupaten</option>
														<?
															$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
															while ($data = mysql_fetch_array($q)){
														?>
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
														<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;" disabled="">
														<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>EMAIL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<hr>
		                            	
		                           		<div style="margin-bottom:10px">
											<a data-toggle="modal" data-target="#compose-modal-baru-hleasing" style="cursor:pointer">
		                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Riwayat Leasing Baru</button>
											</a>
		                           		</div>
										<table class="table table-striped" >
											<thead>
				                                <tr>
				                                    <th width="">TANGGAL</th>
				                                    <th width="">KODE LEASING</th>
				                                    <th width="">NAMA LEASING</th>
				                                    <th width="">MASA ANGSURAN</th>
				                                    <th width="">STATUS</th>
				                                    <th width="1%">ACTION</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $no = 1;
				                            $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$_REQUEST[id]' ORDER BY tanggal DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	if($d1[status]=='1'){
													$statusvw = "<button type='button' class='btn btn-primary' style='width:120px;font-size:10px'><i class='fa fa-thumbs-o-up'></i> &nbsp;$d1[ketstatus]</button>";
													}
												else{
													$statusvw = "<button type='button' class='btn btn-danger' style='width:120px;font-size:10px'><i class='fa fa-thumbs-o-down'></i> &nbsp;$d1[ketstatus]</button>";
													}
				                            ?>
				                                <tr>
				                                    <td align="" valign="middle"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
				                                    <td align="" valign="middle"><?echo $d1['kodeleasing']?></td>
				                                    <td align="" valign="middle"><?echo $d1['namaleasing']?></td>
				                                    <td align="" valign="middle"><?echo $d1['unit']?></td>
				                                    <td align="center" valign="middle"><?echo $d1['termin']?></td>
				                                    <td align="" valign="middle"><?echo $statusvw?></td>
				                                    <td width="1%" align="center" valign="middle"><div class="btn-group">
				                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
				                                                <span class="caret"></span>
				                                                <span class="sr-only">Actions</span>
				                                            </button>
				                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
				                                            	<!--<li><a  data-toggle="modal" data-target="#compose-modal-ubah-hleasing<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>-->
				                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]&delhleasing=$d1[id]&kodeleasing=$d1[kodeleasing]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                </div>
			                </div>
			            </div>
			        <?
                    $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$_REQUEST[id]' ORDER BY tanggal DESC");
                    while($d1 = mysql_fetch_array($q1))
                    	{
			        ?>
<!-- ################## MODAL EDIT RIWAYAT LEASING ########################################################################################## -->
				        <div class="modal fade" id="compose-modal-ubah-hleasing<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH RIWAYAT BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">LEASING</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodeleasing" class="form-control" style="width: 90%" onchange="populateSelect(this.value)" required>
													<option value='' >Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo $data[kodeleasing]?>' <?if($d1[kodeleasing]==$data[kodeleasing]){?>selected=""<?}?>><?echo $data[namaleasing]?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="1" <?if($d1[status]==1){?>checked=""<?}?>>
			                                                    DISETUJUI
			                                                </label> &nbsp;&nbsp;
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="0" <?if($d1[status]==0){?>checked=""<?}?>>
			                                                    DITOLAK
			                                                </label>
			                                            </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:30%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UNIT</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="unit" class="form-control" required style="width:90%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" onkeypress="return buat_angka(event,'0123456789')">
				                                        <span class="input-group-addon">Kali</span>
				                                    </div>
				                                </td>
				                    			<td colspan=""></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
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
			        ?>
					
<!-- ################## MODAL TAMBAH RIWAYAT LEASING ########################################################################################## -->
				        <div class="modal fade" id="compose-modal-baru-hleasing" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH RIWAYAT BARU</h4>
				                    </div>
				                    
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">LEASING</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="kodeleasing" class="form-control" style="width: 90%" onchange="populateSelect(this.value)" required>
													<option value='' >Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
														echo "<option value='$data[kodeleasing]'>$data[namaleasing]</option>";
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
			                                                    DISETUJUI
			                                                </label> &nbsp;&nbsp;
			                                                <label>
			                                                    <input type="radio" name="status" id="optionsRadios1" value="0" >
			                                                    DITOLAK
			                                                </label>
			                                            </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:30%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UNIT</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="unit" class="form-control" required style="width:90%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" onkeypress="return buat_angka(event,'0123456789')">
				                                        <span class="input-group-addon">Kali</span>
				                                    </div>
				                                </td>
				                    			<td colspan=""></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)" disabled="">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)" disabled="">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;" disabled="">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
		                            </form>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>DAFTAR PELANGGAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Pelanggan</small></h4>
				                	<div style="padding:20px">
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NAMA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KADALUARSA OHC</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="kadaluarsaohc" value="<?echo date("d-m-Y",strtotime($d1[kadaluarsaohc]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
											</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" required><?echo $d1[alamat]?></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RT</span>
				                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" >
				                                    </div>
				                                </td>
											</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekab" class="form-control" style="width: 60%" onchange="populateSelect(this.value)">
													<option value='' >Pilih Kabupaten</option>
													<?
														$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekec" class="form-control" id="r1" style="width: 60%" onchange="populateSelect2(this.value)">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><select name="kodekel" class="form-control" id="r2" style="width: 60%;">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" required></td>
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
		
	else if($submenu == 'D')
		{
		if(!empty($_REQUEST[idpelanggan]))
			{
			$kadaluarsaohc 	= date("Y-m-d", strtotime($_REQUEST['kadaluarsaohc']));
			$ohc 			= strtoupper($_REQUEST['ohc']);
			$q1 = mysql_query("INSERT INTO tbl_hohc VALUES ('','$_REQUEST[idpelanggan]','$_REQUEST[ohclama]','$kadaluarsaohc')");
			$q2 = mysql_query("UPDATE tbl_pelanggan SET ohc='$ohc', kadaluarsaohc='$kadaluarsaohc' WHERE id='$_REQUEST[idpelanggan]'");
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
			                	<h4>PELANGGAN <small>DAFTAR PELANGGAN OHC EXPIRED</small></h4> 
                                    <div style="float:right;width:35%">
					                   	<form method="post" action="" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    		<!--
	                                    			<td align="right">
														<a href="print/kas1.php" target="_blank" style="cursor:pointer">
					                           				<button type="button" class="btn btn-info"><i class="fa fa-print"></i> &nbsp; Cetak</button>
														</a>
													</td>
												-->
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
									</div>
									
								<?
								if(!empty($_REQUEST[periode]))
									{
								?>	
	                           		<table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="22%" style="padding:7px">NAMA</th>
			                                    <th width="13%" style="padding:7px">OHC</th>
			                                    <th width="10%" style="padding:7px">KADALUARSA</th>
			                                    <th width="12%" style="padding:7px">TELEPON</th>
			                                    <th width="40%" style="padding:7px">ALAMAT</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
			                            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
			                            
										$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE kadaluarsaohc BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[kadaluarsaohc]=="0000-00-00"){
												$kadaluarsaohc = "-";
												$red = "style='cursor:pointer'";
												}
											else{
												$kadaluarsaohcX = date("d-m-Y",strtotime($d1[kadaluarsaohc]));
												$expired_date   = $d1[kadaluarsaohc];
												list($year, $month, $day) = explode('-', $expired_date);
												$new_expired_date = sprintf('%04d%02d%02d', $year, $month, $day);
												$date_now = date("Ymd");
												if($new_expired_date > $date_now)
													{
													$kadaluarsaohc 	= $kadaluarsaohcX;
													$red = "style='cursor:pointer'";
													}
												else{
													$kadaluarsaohc 	= "<span style='color:#ec0244'>$kadaluarsaohcX</span>";
													$red = "style='color:red;cursor:pointer'";
													}
												}
			                            ?>
			                                <tr <?echo $red?>>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[ohc]?></td>
			                                    <td align="center"><?echo $kadaluarsaohc?></td>
			                                    <td><?echo $d1[notelepon]?></td>
			                                    <td><?echo "$d1[alamat]</br>KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-renew<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-star"></i>Perbaharui OHC</a></li>
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
			                    <?
			                    	}
			                    ?>
			                    </div>
			                </div>
			            </div>
					
		            <?
						$qA = mysql_query("SELECT * FROM tbl_pelanggan WHERE kadaluarsaohc!='0000-00-00' AND kadaluarsaohc <= CURDATE()");
			            while($dA = mysql_fetch_array($qA))
			            	{
		            ?>
	<!-- ################## MODAL RENEW OHC ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-renew<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:550px;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PERBAHARUAN OHC <?echo $dA[ohc]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">NAMA</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" style="width:80%;" class="form-control" value="<?echo $dA[nama]?>" readonly> </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">OHC BARU</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="ohc" style="width:80%;" class="form-control"  required> </td>
					                    		</tr>
					                    		<tr>
					                    			<td>KADALUARSA OHC BARU</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="kadaluarsaohc" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:40%"></td>
					                    		</tr>
					                    		<input type="hidden" name="idpelanggan" value="<?echo $dA[id]?>">
					                    		<input type="hidden" name="ohclama" value="<?echo $dA[ohc]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="reset" class="btn btn-danger"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
<!-- ################################################################################################################################# -->
<?
							}
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'E')
		{
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
			                	<h4>PELANGGAN <small>RIWAYAT OHC</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp; Daftar OHC Expired</button>
										</a>
	                           		</div>
	                           		<table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="23%">NAMA</th>
			                                    <th width="" style="padding:7px">OHC</th>
			                                    <th width="1%" style="padding:7px">KADALUARSA</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th style="padding:7px">ALAMAT</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$qA = mysql_query("SELECT * FROM tbl_hohc");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            	$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
											if($dA[kadaluarsaohc]=="0000-00-00"){
												$kadaluarsaohc = "-";
												}
											else{
												$kadaluarsaohc = date("d-m-Y",strtotime($dA[kadaluarsaohc]));
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $dA[ohc]?></td>
			                                    <td align="center"><?echo $kadaluarsaohc?></td>
			                                    <td><?echo $d1[notelepon]?></td>
			                                    <td><?echo "$d1[alamat]</br>KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
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
?>
			        </div>
				</section>
			</aside>
<?
		}
?>
					
		<script>
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
			
			pilihan = document.inputpelanggan.kodekab.value;
			if(pilihan==''){
			document.inputpelanggan.kodekec.disabled = 1;
			document.inputpelanggan.kodekel.disabled = 1;
			}else{
			document.inputpelanggan.kodekec.disabled = 0;
			document.inputpelanggan.kodekel.disabled = 1;
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
			
			pilihan = document.inputpelanggan.kodekec.value;
			if(pilihan==''){
			document.inputpelanggan.kodekel.disabled = 1;
			}else{
			document.inputpelanggan.kodekel.disabled = 0;
			}
		}
		</script>
			
<!-- ################## MODAL LOG DAFTAR PELANGGAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-log-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">LOG</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body"style="overflow-y:auto;overflow-x:hidden;height:520px;">
										<table id="example4" class="table table-striped" >
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
				                            $q1 = mysql_query("SELECT * FROM log_act WHERE tbl='tbl_pelanggan' ORDER BY id DESC");
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

        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
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
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();
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