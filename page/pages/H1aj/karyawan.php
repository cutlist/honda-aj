<?
	if($submenu == 'A')
		{
		include "include/fungsi_thumb.php";
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{
				if($_REQUEST['posisi']=="9")
					{
					$dCek = mysql_fetch_array(mysql_query("SELECT id,nama FROM tbl_karyawan WHERE id%2=0 AND posisi='9'"));
					if(!empty($dCek[id]))
						{
						echo "<script>alert ('Posisi PIC Sudah Diisi Oleh $dCek[nama].')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
					}
				/*	
				$p_tahun  = date("y", strtotime($_REQUEST['tgllahir']));
				$p_bulan  = date("m", strtotime($_REQUEST['tgllahir']));
				$p_tgl    = date("d", strtotime($_REQUEST['tgllahir']));
				*/
				
		        $dN = mysql_fetch_array(mysql_query("SELECT nik FROM tbl_karyawan ORDER BY SUBSTR(nik,-3,3) DESC LIMIT 1"));
		            
				if(empty($dN[nik]))
					{
					$dig3=1;
					$dig2=0;
					$dig1=0;	
					}
				else
					{
					$x=substr("$dN[nik]",-3,3);
					$dig3 = substr($x,-1,1)+1;
					$dig2 = substr($x,-2,1);
					$dig1 = substr($x,-3,1);
					
					if ($dig3>9)
						{
						$dig3=0;
						$dig2=$dig2+1;
						}
					else
						{
						$dig3=$dig3;
						}
					
					if ($dig2>9)
						{
						$dig2=0;
						$dig1=$dig1+1;
						}
					else
						{
						$dig2=$dig2;
						}
					
					if ($dig1>9)
						{
						echo "kode habis";
						exit();
						}
					else
						{
						$dig1=$dig1;
						}
					}
					
				$nik = "H1"."-$dig1$dig2$dig3";
				
				$lokasi_file    = $_FILES['fupload']['tmp_name'];
				$tipe_file      = $_FILES['fupload']['type'];
				$nama_file      = $_FILES['fupload']['name'];
				$acak           = rand(1,99);
				if (!empty($lokasi_file))
					{
					$nama_file_unik = $acak.$nama_file; 
					UploadKaryawanH1($nama_file_unik);
					}
				else{
					$nama_file_unik =""; 
					}
					
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
													nik, 
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
													photo,
													pic_user) 
												VALUES (
													'$nama', 
													'$nik', 
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
													'$nama_file_unik',
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
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'>";
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
				$q1 = mysql_query("DELETE FROM tbl_karyawan WHERE id%2=0 AND id='$_REQUEST[deluser]'");
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
					//echo "<script>alert ('Proses berhasil.')</script>";
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
	    		$periode_tahun = date("Y");
				$periode_bulan = date('m');			
				
				$lokasi_file    = $_FILES['fupload']['tmp_name'];
				$tipe_file      = $_FILES['fupload']['type'];
				$nama_file      = $_FILES['fupload']['name'];
				$acak           = rand(1,99);
					
				$nama 		= strtoupper(addslashes($_REQUEST['nama']));
				//$nik		= strtoupper($_REQUEST['nik']);
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
				
				$dC = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS totjum FROM tbl_potkompensasi WHERE id%2=0 AND idkaryawan='$_REQUEST[ubah]' AND metodebayar='GAJI' AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1'"));
				$dD	= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE id%2=0 AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$_REQUEST[ubah]' AND metodebayar='GAJI' AND status='1'"));

				$total = $dC[totjum]+$dD[total];
				
					//echo "<script>alert ('$total.$ugapok')</script>";
					//print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					//exit();
					
				if($total > $ugapok){
					echo "<script>alert ('Proses Gagal, Karena Besar Gaji Pokok Yang Baru Lebih Kecil Dari Total Potongan.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
							
				if (!empty($lokasi_file))
					{
					$nama_file_unik = $acak.$nama_file; 
					UploadKaryawanH1($nama_file_unik);
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
														photo='$nama_file_unik',
														pic_user='$_SESSION[user]',
														status='$_REQUEST[status]'
												WHERE id%2=0 AND id='$_REQUEST[ubah]'
										");
					}
				else{
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
														pic_user='$_SESSION[user]',
														status='$_REQUEST[status]'
												WHERE id%2=0 AND id='$_REQUEST[ubah]'
										");
					}
					
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
										<?
										if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h1/karyawan.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px">NIK</th>
			                                    <th style="padding:7px">POSISI</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th style="padding:7px">ALAMAT</th>
			                                    <th width="10%" style="padding:7px">MULAI KERJA</th>
			                                    <th width="10%" style="padding:7px">STATUS</th>
			                                    <th width="5%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										if($_SESSION[posisi]=="DIREKSI"){
											$q1 = mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id%2=0 AND id !='1' ORDER BY nama");
											}
										else{
											$q1 = mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id%2=0 AND id_posisi NOT IN ('1','6') ORDER BY nama");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[nik]?></td>
			                                    <td><?echo $d1[posisi]?></td>
			                                    <td align="right"><?echo $d1[notelepon]?></td>
			                                    <td><?echo $d1[alamat]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?></td>
			                                    <td width="" align="center"><?echo $d1[status]?></td>
			                                    <td width="1%" align="center">
													<?
													if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
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
					
<!-- ################## MODAL TAMBAH KARYAWAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-karyawan" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content" style="overflow-x:hidden;overflow-y:auto;height:520px;">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KARYAWAN BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table border="0">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>NIK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nik" class="form-control" style="width: 50%" maxlength="12" required></td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" required style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi WHERE id%2=0 AND id!='1' ORDER BY posisi");
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
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ugapok" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Bulan</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="uharian" id="uang2" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ukomisi" id="uang3" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ulembur" id="uang4" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Kali</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4"><hr></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4"><div class="box-body table-responsive">
						                            <div class="form-group">
						                            	<center>
						                                    <label for="exampleInputFile" style="margin-bottom: 20px;"><i class="fa fa-user"></i> Upload Photo</label>
						                                </center>
						                                 <input type=file name='fupload'>
						                                    <p class="help-block">Pilih Photo *.jpg Dengan Maksimal Size 200KB</p>
						                                </div>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KARYAWAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Detail Karyawan</small></h4>
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NIK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nik" value="<?echo $d1[nik]?>" class="form-control" style="width: 50%" maxlength="12" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>POSISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="posisi" readonly style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi WHERE id%2=0 AND id!='1' ORDER BY posisi");
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
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ugapok" value="<?echo number_format($d1[ugapok],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="uharian" value="<?echo number_format($d1[uharian],"0","",".")?>" id="uang2" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ukomisi" value="<?echo number_format($d1[ukomisi],"0","",".")?>" id="uang3" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ulembur" value="<?echo number_format($d1[ulembur],"0","",".")?>" id="uang4" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/karyawanh1.php?id=<?echo $_REQUEST[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KARYAWAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Karyawan</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div class="col-xs-8" style="padding:20px">
				                    	<table style="width:100%;">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
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
				                    			<td colspan="2"><select class="form-control" name="posisi" required style="width: 50%">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_posisi WHERE id%2=0 AND id!='1' ORDER BY posisi");
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
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ugapok" value="<?echo number_format($d1[ugapok],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Bulan</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="uharian" value="<?echo number_format($d1[uharian],"0","",".")?>" id="uang2" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Hari</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>KOMISI</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ukomisi" value="<?echo number_format($d1[ukomisi],"0","",".")?>" id="uang3" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="ulembur" value="<?echo number_format($d1[ulembur],"0","",".")?>" id="uang4" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    	<span class="input-group-addon" style="width:40%;text-align:left">Per Kali</span>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="status" required style="width: 50%">
																	<option value='AKTIF' <?if($d1[status]=="AKTIF"){?>selected<?}?>>AKTIF</option>
																	<option value='TIDAK AKTIF' <?if($d1[status]=="TIDAK AKTIF"){?>selected<?}?>>TIDAK AKTIF</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4"><hr></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4"><div class="box-body table-responsive">
						                            <div class="form-group">
						                            	<center>
						                                    <label for="exampleInputFile" style="margin-bottom: 20px;"><i class="fa fa-user"></i> Upload Photo</label>
						                                </center>
						                                 <input type=file name='fupload'>
						                                    <p class="help-block">Pilih Photo *.jpg Dengan Maksimal Size 200KB</p>
						                                    <p class="help-block">KOSONGKAN JIKA TIDAK INGIN MENGGANTI PHOTO KARYAWAN</p>
						                                </div>
								                    </div>
								                </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
				                    </div>
				                    <?
				                    if(!empty($d1[photo]))
				                    	{
									?>
					                	<div class="col-xs-4" style="padding:20px;text-align: center;">
					                		<div style="border: 1px #ccc solid;padding:20px;width:80%;padding-top:10px">
						                		<h5>PHOTO KARYAWAN</h5></br>
						                		<img src="../foto/H1/H1_<?echo $d1[photo]?>"/>
					                		</div>
					                	</div>
									<?
										}
				                    ?>
				                	
			                        <div class="clearfix"></div>
			                        <div class="modal-footer clearfix">
										<a href="#" onClick="popup_print()"><button type="button" class="btn btn-info"><i class="fa fa-print"></i> Cetak</button></a>
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
        <!-- mousetrap -->
        <script>
			Mousetrap.bind("+",function modal() {
				$('#compose-modal-baru-karyawan').modal('show');
				});
			Mousetrap.bind("esc",function modal() {
				$('#compose-modal-baru-karyawan').modal('hide');
				});
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