<script src="js/jquery.min.js"></script>	
<?
	if($submenu == 'saveB')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
		$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_REQUEST[nonota]'");
        while($dA = mysql_fetch_array($qA))
        	{
			mysql_query("UPDATE x23_stokpart SET stok=stok-$dA[qty] WHERE idgudang='$dA[idgudang]' AND rak='$dA[rak]' AND nonota='$dA[notabeli]' AND idbarang='$dA[idbarang]'");
			}
		
		$q1 = mysql_query("UPDATE x23_notaservice SET
										tglselesai		=CURDATE(),
										jamselesai		=CURTIME(),
										nonota			='$_REQUEST[nonota]',
										tottarifaslisvc	='$_REQUEST[tottarifaslisvc]', 
										totdiskonsvc	='$_REQUEST[totdiskonsvc]', 
										totservice		='$_REQUEST[totservice]', 
										tothargabelisp	='$_REQUEST[tothargabelisp]', 
										totdiskonsp		='$_REQUEST[totdiskonsp]', 
										totsparepart	='$_REQUEST[totsparepart]',
										grandtotal		='$_REQUEST[grandtotal]', 
										status			='1', 
										updatex			='$updatex'
									WHERE id='$_REQUEST[id]'
						");
						
		$q1 = mysql_query("UPDATE x23_penagihankpb SET nonotaservis='$_REQUEST[nonota]' WHERE nopkb='$_REQUEST[nopkb]'");
						
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansi WHERE jnskwitansi='servis' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
		if(empty($dNK[nokwitansi]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNK[nokwitansi]",-3,3);
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
			
			$nokwitansi = "KS$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
		
		$q1 = mysql_query("INSERT INTO x23_kwitansi (
												jnskwitansi, 
												nokwitansi, 
												tahun, 
												bulan, 
												tanggal, 
												nomor, 
												idpelanggan, 
												waktuselesai, 
												noantrian, 
												nopol, 
												jumlah, 
												user,
												keterangan, 
												status,
												inputx, 
												updatex) 
											VALUES (
												'servis', 
												'$nokwitansi', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'$_REQUEST[nonota]', 
												'$_REQUEST[idpelanggan]', 
												CURTIME(), 
												'$_REQUEST[noantrian]', 
												'$_REQUEST[nopol]', 
												'$_REQUEST[grandtotal]', 
												'$_SESSION[id]', 
												'',
												'0', 
												NOW(), 
												'$updatex')
						");
		/*				
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice WHERE tglnota=CURDATE() AND status='0' ORDER BY noantrian ASC LIMIT 0,1"));
		mysql_query("UPDATE x23_notaservice SET jammulai=CURTIME() WHERE noantrian='$dB[noantrian]'");
		mysql_query("UPDATE x23_antrian SET status='1',jammulai=CURTIME() WHERE tanggal=CURDATE() AND noantrian='$dB[noantrian]'");
		*/
							
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_notaservice',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'UPDATE NOTA SERVIS $_REQUEST[nonota]')
							");
			
		if($q1 && $q2 )
			{
			//echo "<script>alert ('Proses berhasil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	else if($submenu == 'saveC')
		{
		$nama 		= strtoupper(addslashes($_REQUEST['nama']));
		$ohc 		= strtoupper($_REQUEST['ohc']);
		$noktp 		= $_REQUEST['noktp'];
		$notelepon 	= $_REQUEST['notelepon'];
		$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
		$rt 		= $_REQUEST['rt'];
		$rw 		= $_REQUEST['rw'];
					
		$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pelanggan WHERE ohc='$ohc'"));		
		if(!empty($ohc) && !empty($dCek[id]))
			{
			echo "<script>alert ('Mohon Ulangi OHC Yang Diinput, Karena OHC Sudah Ada Pada Database.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		
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
		$pnopol		= strtoupper($_REQUEST['pnopolB']);
		$utitipan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipan']);
					
		$q1 = mysql_query("INSERT INTO tbl_pelanggan (
												nama, 
												ohc, 
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
		$id=mysql_insert_id();
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_pelanggan',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH PELANGGAN $nama')
							");

		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$id'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	else if($submenu == 'A')
		{
		unset($_SESSION[nonota]);
		unset($_SESSION[noclaim]);
		unset($_SESSION[noservis]);
		
		$p_tahun = date("Y");
		$p_bulan = date("m");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
						if(!empty($_REQUEST[del]))
							{
							mysql_query("DELETE FROM x23_notaservice WHERE id='$_REQUEST[del]'");
							mysql_query("DELETE FROM x23_antrian WHERE noantrian='$_REQUEST[noantrian]'");
							}
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SERVIS <small>INPUT NOTA SERVIS</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Proses Dilanjutkan Ke Pembuatan Kwitansi Servis Pada Bagian Kasir.</p>
	                                    </div>
									<?
										}
									?>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=".md5(notaservice)."&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> &nbsp; Tambah Baru</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="" style="padding:7px">TGL NOTA SERVIS</th>
			                                    <th width="" style="padding:7px">WAKTU</br>MULAI</th>
			                                    <th width="12%" style="padding:7px">NO. ANTRIAN</th>
			                                    <th width="" style="padding:7px">NO. PKB</th>
			                                    <th width="" style="padding:7px">JENIS</th>
			                                    <th width="" style="padding:7px">NO. POLISI</th>
			                                    <th width="" style="padding:7px">NAMA PELANGGAN</th>
			                                    <th width="" style="padding:7px">NO. MESIN</th>
			                                    <th width="" style="padding:7px">DEL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notaservice_vw WHERE status='0'");
										while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
											//$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_user_vw WHERE id='$d1[idmekanik]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[jammulai]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="center"><?echo $d1[noantrian]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nopkb]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[jns]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nopol]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nomesin]?></td> 
												<td align="center">
			                                    	<?
	                                            	if($_SESSION[posisi]=='DIREKSI')
	                                            		{
													?>
				                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]&noantrian=$d1[noantrian]"?>">
					                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
					                                    		<i class="fa fa-trash-o"></i>
					                                    	</button>
				                                    	</a>
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
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE id='$_REQUEST[id]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE nomesin='$d1[nomesin]' AND status='TERJUAL'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNS = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notaservice WHERE tglselesai=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNS[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNS[nonota]",-3,3);
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
			
			$nonota = "NS$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$_SESSION[nonota]   = $nonota;
			$_SESSION[noservis] = $d1[noservis];
			$_SESSION[noclaim]  = $d1[noclaim];
			
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>SERVIS <small>INPUT NOTA SERVIS</small></h4>
			                	
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:10px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NOMOR ANTRIAN</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" name="noantrian" class="form-control" style="width:50%" value="<?echo $d1[noantrian]?>" maxlength="4" readonly=""></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NOMOR PKB</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopkb]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NOMOR NOTA SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="30%">TGL NOTA SERVIS</td>
					                        		<td width="3%">:</td>
					                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 50%" readonly=""></td>
					                        	</tr>
					                        	<?
					                        	if(!empty($_SESSION[noservis]))
					                        		{
												?>
						                        	<tr>
						                        		<td>NOMOR NOTA SERVIS JR</td>
						                        		<td>:</td>
						                        		<td colspan="2"><input type="text" name="noclaim" value="<?echo $_SESSION[noclaim]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
						                        	</tr>
												<?
													}
					                        	?>
					                        	<tr>
					                        		<td>NAMA PELANGGAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
					                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-search"></i></button></td>
					                        	</tr>
					                        </table>
					                        
					                    	<div id="spoiler" style="display:none">
						                    	<table width="100%">
						                    		<tr>
						                    			<td width="30%">NOMOR OHC</td>
						                    			<td width="3%">:</td>
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
						                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
															<option value=''>Pilih Kabupaten</option>
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
						                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
															<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
															</select></td>
						                    		</tr>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
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
					                    </div>
				                        <div class="clearfix"></div>
					                </div>
		                            <div style="border-bottom:1px #aaa dashed;margin: 0px 0 10px"></div>
	                            	
	                            	
		                        	<?
		                        	if(empty($_SESSION[noservis]))
		                        		{
									?>
					                	<div style="padding:10px">
						           			<div class="col-xs-12">
						                    	<table width="90%">
						                    		<tr>
						                    			<td>NAMA MEKANIK</td>
						                    			<td>:</td>
						                    			<td colspan="2"><select name="idmekanik" class="form-control select1" style="font-size:12px;padding:3px;width:60%" disabled="">
																					<option value='' selected>Pilih</option>
																						<?
																							$q1 = mysql_query("SELECT * FROM x23_karyawan WHERE posisi='4' ORDER BY nama");
																							while($dA=mysql_fetch_array($q1))
																								{
																						?>
																									<option value='<?echo $dA[id]?>' <?if($d1[idmekanik]==$dA[id]){?>selected=''<?}?>><?echo $dA[nama]?></option>
																						<?
																								}
																						?>
																			    </select></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR POLISI</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" style="width: 40%" value="<?echo $d1[nopol]?>" class="form-control" maxlength="20" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KODE MOTOR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><select name="kodemotor" class="form-control select1" style="font-size:12px;padding:3px;width:100%" disabled="">
																			<option value='' selected>Pilih</option>
																			<?
																				$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																				while($dA=mysql_fetch_array($q1))
																					{
																			?>
																						<option value='<?echo $dA[kodebarang]?>' <?if($d1[kodemotor]==$dA[kodebarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] | $dA[warna]"?></option>
																			<?
																					}
																			?>
																	    </select></td>
						                    		</tr>
						                    		<tr>
						                    			<td width="19%">NOMOR MESIN</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $d1[nomesin]?>" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KM</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="km" class="form-control" style="width: 10%;text-align:right" value="<?echo number_format($d1[km],"0","",".")?>" readonly=""></td>
						                    		</tr>
						                    		<?
						                    		if($d1[jns]=="KPB")
						                    			{
													?>
							                    		<tr>
							                    			<td>TGL BELI MOTOR</td>
							                    			<td>:</td>
							                    			<td colspan="2"><input type="text" name="tglbelimotor" value="<?echo date("d-m-Y",strtotime($d1[tglbelimotor]))?>" class="form-control" style="width: 15%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
							                    		</tr>
													<?
														}
						                    		?>
						                    		<tr>
						                    			<td>NOMOR RANGKA</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="norangka" class="form-control" style="width: 40%" value="<?echo $d2[norangka]?>" maxlength="30" required=""></td>
						                    		</tr>
				                            	</table>
			                            	</div>
			                            </div>
			                        <?
			                        	}
			                        	
		                        	if(!empty($_SESSION[noservis]))
		                        		{
		                        		$dS = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice WHERE nonota='$_SESSION[noservis]'"));
									?>
					                	<div style="padding:10px">
						           			<div class="col-xs-12">
						                    	<table width="90%">
						                    		<tr>
						                    			<td>NAMA MEKANIK</td>
						                    			<td>:</td>
						                    			<td colspan="2"><select name="idmekanik" class="form-control select1" style="font-size:12px;padding:3px;width:60%" disabled="">
																					<option value='' selected>Pilih</option>
																						<?
																							$q1 = mysql_query("SELECT * FROM x23_karyawan WHERE posisi='4' ORDER BY nama");
																							while($dA=mysql_fetch_array($q1))
																								{
																						?>
																									<option value='<?echo $dA[id]?>' <?if($dS[idmekanik]==$dA[id]){?>selected=''<?}?>><?echo $dA[nama]?></option>
																						<?
																								}
																						?>
																			    </select></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR POLISI</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" style="width: 40%" value="<?echo $dS[nopol]?>" class="form-control" maxlength="20" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KODE MOTOR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><select name="kodemotor" class="form-control select1" style="font-size:12px;padding:3px;width:100%" disabled="">
																			<option value='' selected>Pilih</option>
																			<?
																				$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																				while($dA=mysql_fetch_array($q1))
																					{
																			?>
																						<option value='<?echo $dA[kodebarang]?>' <?if($dS[kodemotor]==$dA[kodebarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] | $dA[warna]"?></option>
																			<?
																					}
																			?>
																	    </select></td>
						                    		</tr>
						                    		<tr>
						                    			<td width="19%">NOMOR MESIN</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dS[nomesin]?>" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KM</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="km" class="form-control" style="width: 10%;text-align:right" value="<?echo number_format($d1[km],"0","",".")?>" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR RANGKA</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="norangka" class="form-control" style="width: 40%" value="<?echo $dS[norangka]?>" maxlength="30" required=""></td>
						                    		</tr>
				                            	</table>
			                            	</div>
			                            </div>
			                        <?
			                        	}
			                        ?>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
					                        
					                        <button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                    	</form>
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			
<?
		}
		
	else if($submenu == 'C')
		{
		$p_tahun = date("Y");
		$p_bulan = date("m");
		$norangka = strtoupper($_REQUEST[norangka]);
		
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE id='$_REQUEST[id]'"));
		
		if(!empty($_REQUEST[norangka]))
			{				
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE kodebarang='$d1[kodemotor]'"));
			mysql_query("UPDATE x23_notaservice SET
												norangka='$norangka',
												tipemotor='$dA[namabarang]',
												varianmotor='$dA[varian]',
												warnamotor='$dA[warna]',
												tahunmotor='$dA[thnproduksi]',
												updatex='$updatex'
						  					WHERE 
						  						id='$_REQUEST[id]'
						");
			}
			
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det1_vw WHERE nonota='$_SESSION[nonota]'"));
					
			
		if(!empty($_REQUEST[temp]))
			{
			$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det WHERE notabeli='$_REQUEST[notabeli]' AND idgudang='$_REQUEST[idgudang]' AND 
																						 rak='$_REQUEST[rak]' AND nonota='$_REQUEST[temp]' AND idbarang='$_REQUEST[idbarang]'"));
								
			$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_REQUEST[idbarang]' AND nonota='$_REQUEST[notabeli]' AND idgudang='$_REQUEST[idgudang]' AND 
																						 rak='$_REQUEST[rak]'"));	
																																		
			if(!empty($dCek1[id])){
				echo "<script>alert ('Barang Tersebut Sudah Ada Pada Detail Nota Jual.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
			
			if(empty($dStok[id])){
				echo "<script>alert ('Mohon Ulangi, Karena Nota Beli Atau Lokasi Untuk Barang Tersebut Tidak Ada!)</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
			else{			
			
				$qty = preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
				if($_REQUEST[optdis] == "1")
					{
					$diskon	= preg_replace( "/[^0-9]/", "",$_REQUEST['diskon2']);
					}
				if($_REQUEST[optdis] == "2")
					{
					$diskon	= ROUND((($dStok[hargajual]*$_REQUEST[diskon1])/100),0);
					}
				
				if($qty=='0'){
					echo "<script>alert ('Qty Tidak Boleh Nol (0)!')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
					exit();
					}
							
				if($qty <= $dStok[stok])
					{
					$dCek2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent_det WHERE noindent='$_SESSION[noindent]' AND idbarang='$dStok[idbarang]'"));
					if(!empty($dCek2[id])){
						echo "<script>alert ('Barang Tersebut Sudah Ada Pada Detail Nota Indent.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
						exit();
						}
						
	            	if(empty($dStok[stok]) OR $dStok[stok]=="0"){
						$stok = "0";
						}
					else{
						$stok = $dStok[stok];
						}
						
					$qty1 = $stok;
					$qty2 = $qty-$stok;
					
					$totdiskon			= $diskon*$qty;
					$tothargabelibersih	= $dStok[hargabelibersih]*$qty;
					
						$hargajual			= $dStok[hargajual]-$diskon;
						$jumlah				= $hargajual*$qty;
														
					
					if($_REQUEST[oli]=="1")
						{
						$q1 = mysql_query("INSERT INTO x23_notajual_det (
															notabeli,
															nonota,
															tahun,
															bulan,
															tglnota,
															idbarang,
															hargabelibersih,
															hargajual,
															diskon,
															hargajualbersih,
															qty,
															totdiskon,
															tothargabelibersih,
															total,
															idgudang,
															rak)
														VALUE (
															'$dStok[nonota]',
															'$_REQUEST[temp]',
															'$p_tahun',
															'$p_bulan',
															CURDATE(),
															'$dStok[idbarang]',
															'$dStok[hargabelibersih]',
															'0',
															'0',
															'0',
															'1',
															'0',
															'$tothargabelibersih',
															'0',
															'$dStok[idgudang]',
															'$dStok[rak]')
											");
											
							$id_notajual_det = mysql_insert_id();
							$dKP = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$d3[kodepaket]'"));
		        			mysql_query("INSERT INTO x23_claimoli_det (
		        											id_notajual_det,
		        											nonotaservis,
		        											tglservis,
		        											kodepaket,
		        											kpbke,
		        											namakpb,
		        											idbarang,
		        											kodebarang,
		        											varian,
		        											namabarang,
		        											hargaoli)
		        										VALUES (
		        											'$id_notajual_det',
		        											'$_SESSION[nonota]',
		        											CURDATE(),
		        											'$d3[kodepaket]',
		        											'$dKP[kpbke]',
		        											'$dKP[nama]',
		        											'$dStok[idbarang]',
		        											'$dStok[kodebarang]',
		        											'$dStok[varian]',
		        											'$dStok[namabarang]',
		        											'$dKP[hargaoli]')
		        							");
						}
					if(empty($_REQUEST[oli]))
						{							
						//echo "<script>alert ('$dStok[hargajual].$jumlah')</script>";
						//exit();
					
						$q1 = mysql_query("INSERT INTO x23_notajual_det (
															notabeli,
															nonota,
															tahun,
															bulan,
															tglnota,
															idbarang, 
															hargabelibersih,
															hargajual,
															diskon,
															hargajualbersih,
															qty,
															totdiskon,
															tothargabelibersih,
															total,
															idgudang,
															rak)
														VALUE (
															'$dStok[nonota]',
															'$_REQUEST[temp]',
															'$p_tahun',
															'$p_bulan',
															CURDATE(),
															'$dStok[idbarang]',
															'$dStok[hargabelibersih]',
															'$dStok[hargajual]',
															'$diskon',
															'$hargajual',
															'$qty',
															'$totdiskon',
															'$tothargabelibersih',
															'$jumlah',
															'$dStok[idgudang]',
															'$dStok[rak]')
											");
						}
							
					if($q1)
						{
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&direct=1'/>";
						exit();
						}
					}
				else{
					echo "<script>alert ('Stok Untuk Barang Tersebut Tidak Mencukupi.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&direct=1'/>";
					exit();
					}
				}
			}
					
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_notajual_det WHERE	id='$_REQUEST[del]'");
			mysql_query("DELETE FROM x23_claimoli_det WHERE id_notajual_det='$_REQUEST[del]'");
			}
			
		if(!empty($_REQUEST[tempsvc]))
			{
				
			if($_REQUEST[jnsservice]=='PAKET')
				{
				/*
				$qA = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE kode='$_REQUEST[kodepaket]'");
				while($dA=mysql_fetch_array($qA))
					{
					$dB=mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$_REQUEST[kodepaket]'"));
					mysql_query("INSERT INTO x23_notaservice_det (
														nonota,
														tahun,
														bulan,
														tglnota,
														kodepaket,
														idjasa,
														tarif)
													VALUES (
														'$_SESSION[nonota]',
														'$p_tahun',
														'$p_bulan',
														CURDATE(),
														'$_REQUEST[kodepaket]',
														'$dA[idjasa]',
														'$dB[harga]')
					");
					}
				*/	
				
					$dA=mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$_REQUEST[kodepaket]'"));
					$diskon		= preg_replace( "/[^0-9]/", "",$_REQUEST['diskon']);
					$tarif		= $dA[harga]-$diskon;
					if($diskon > $dA[harga]){
						echo "<script>alert ('Mohon Ulangi, Karena Diskon Melebihi Tarif Servis!')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
						exit();
						}
						
					if($dA[jnskj]=="KPB"){
						if($d1[km] > $dA[bataskm]){
							echo "<script>alert ('Mohon Ulangi, Karena KM Saat Ini Melebihi Batas KM Paket KPB Yang Dipilih!')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
							exit();
							}
						if($d1[umurmotor] > $dA[batashari]){
							echo "<script>alert ('Mohon Ulangi, Karena Umur Motor Saat Ini Melebihi Batas Hari Paket KPB Yang Dipilih!')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
							exit();
							}
						}
						
					$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]' AND tglnota=CURDATE() AND 
																								 kodepaket='$_REQUEST[kodepaket]' AND tarifasli='$dA[harga]'"));
										
					if(!empty($dCek1[id])){
						echo "<script>alert ('Servis Tersebut Sudah Ada Pada Detail Servis.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
						exit();
						}
				
					mysql_query("INSERT INTO x23_notaservice_det (
														nonota,
														tahun,
														bulan,
														tglnota,
														kodepaket,
														tarifasli,
														diskon,
														tarif,
														tarifkpb)
													VALUES (
														'$_SESSION[nonota]',
														'$p_tahun',
														'$p_bulan',
														CURDATE(),
														'$_REQUEST[kodepaket]',
														'$dA[harga]',
														'$diskon',
														'$tarif',
														'$dA[hargampm]')
					");
				}
				
			if($_REQUEST[jnsservice]=='RETAIL')
				{
					$dB=mysql_fetch_array(mysql_query("SELECT * FROM x23_tarifjasa WHERE idjasa='$_REQUEST[idjasa]'"));
					$diskon		= preg_replace( "/[^0-9]/", "",$_REQUEST['diskon']);
					$tarif		= $dB[tarif]-$diskon;
					if($diskon > $dB[tarif]){
						echo "<script>alert ('Mohon Ulangi, Karena Diskon Melebihi Tarif Servis!')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
						exit();
						}
					
						
					$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]' AND tglnota=CURDATE() AND 
																								 idjasa='$_REQUEST[idjasa]' AND tarifasli='$dB[tarif]'"));
										
					if(!empty($dCek1[id])){
						echo "<script>alert ('Servis Tersebut Sudah Ada Pada Detail Servis.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
						exit();
						}
						
					mysql_query("INSERT INTO x23_notaservice_det (
														nonota,
														tahun,
														bulan,
														tglnota,
														idjasa,
														tarifasli,
														diskon,
														tarif)
													VALUES (
														'$_SESSION[nonota]',
														'$p_tahun',
														'$p_bulan',
														CURDATE(),
														'$_REQUEST[idjasa]',
														'$dB[tarif]',
														'$diskon',
														'$tarif')
					");
				}
				
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]&tempsvc='/>";
			}
					
		if(!empty($_REQUEST[delsvc]))
			{
			mysql_query("DELETE FROM x23_notaservice_det WHERE id='$_REQUEST[delsvc]'");
			}
			
		if(!empty($_REQUEST[back]))
			{
			mysql_query("DELETE FROM x23_notajual_det WHERE nonota='$_SESSION[nonota]'");
			mysql_query("DELETE FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]' AND nopkb=''");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}	
			
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelisp FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonota]'"));
		$dC = mysql_fetch_array(mysql_query("SELECT *,COUNT(tarif) AS tqty, SUM(tarif) AS ttotal, SUM(tarifasli) AS tottarifasli, SUM(diskon) AS totdiskon FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]'"));
		$ppnjasa = round($dC[ttotal] * 0.1 , 0);
		$ttotal = $dB[ttotal]+$dC[ttotal]+$ppnjasa;
		
		mysql_query("UPDATE x23_notaservice_det SET nonota='$_SESSION[nonota]' WHERE nopkb='$d1[nopkb]'");
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:250px;">
			                	<h4>SERVIS <small>INPUT NOTA SERVIS</small></h4>
			                	
				                	<div style="padding:10px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NOMOR ANTRIAN</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" name="noantrian" class="form-control" style="width:50%" value="<?echo $d1[noantrian]?>" maxlength="4" readonly=""></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NOMOR PKB</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopkb]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NOMOR NOTA SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%" border="0">
					                        	<tr>
					                        		<td width="30%">TGL NOTA SERVIS</td>
					                        		<td width="3%">:</td>
					                    			<td colspan="3"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 50%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NAMA PELANGGAN</td>
					                        		<td>:</td>
					                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
					                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-search"></i></button></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NOMOR POLISI</td>
					                        		<td>:</td>
					                    			<td width="25%"><input type="text" style="width:100%" value="<?echo $d1[nopol]?>" class="form-control" maxlength="20" readonly></td>
					                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler1') .style.display=='none') {document.getElementById('spoiler1') .style.display=''}else{document.getElementById('spoiler1') .style.display='none'}"><i class="fa fa-search"></i></button></td>
					                    		</tr>
					                        </table>
					                    </div>
					                </div>
				                    <div class="clearfix"></div>
			                    	
			                    	<div id="spoiler" style="display:none">
				                    <div class="clearfix"></div>
		                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 0px"></div>
					                	<div style="padding:10px">
						           			<div class="col-xs-12">
						                    	<table width="90%">
						                    		<tr>
						                    			<td width="19%">NOMOR OHC</td>
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
						                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
															<option value=''>Pilih Kabupaten</option>
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
						                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
															<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
															</select></td>
						                    		</tr>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
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
				                    	</div>
			                    	</div>
					                    	
			                    	<div id="spoiler1" style="display:none">
				                    <div class="clearfix"></div>
		                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 0px"></div>
					                	<div style="padding:10px">
						           			<div class="col-xs-12">
					                    		<table width="90%">
						                    		<tr>
						                    			<td width="19%">NOMOR RANGKA</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" name="norangka" class="form-control" style="width: 55%" value="<?echo $d1[norangka]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KODE MOTOR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="kodemotor" class="form-control" style="width: 55%" value="<?echo $d1[kodemotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TIPE MOTOR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tipemotor" name="pekerjaan" class="form-control" style="width: 55%" value="<?echo $d1[tipemotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>VARIAN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="varianmotor" class="form-control" style="width: 55%" value="<?echo $d1[varianmotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>WARNA</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="warnamotor" class="form-control" style="width: 55%" value="<?echo $d1[warnamotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TAHUN PRODUKSI</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tahunmotor" class="form-control" style="width: 13%;text-align:right" value="<?echo $d1[tahunmotor]?>" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KM</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="km" class="form-control" style="width: 20%;text-align:right" value="<?echo $d1[km]?>" maxlength="8"  readonly=""></td>
						                    		</tr>
						                    		<?
						                    		if($d1[jns]=="KPB")
						                    			{
													?>
							                    		<tr>
							                    			<td>TGL BELI MOTOR</td>
							                    			<td>:</td>
							                    			<td colspan="2"><input type="text" name="tglbelimotor" class="form-control" style="width: 20%;text-align:left" value="<?echo date("d-m-Y",strtotime($d1[tglbelimotor]))?>" maxlength="8"  readonly=""></td>
							                    		</tr>
							                    	<?
							                    		}
							                    	?>
						                    		<tr>
						                    			<td>NAMA MEKANIK</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="warnamotor" class="form-control" style="width: 55%" value="<?echo $d2[nama]?>" maxlength="30" readonly=""></td>
						                    		</tr>
				                            	</table>
					                    	</div>
					                    </div>
				                    </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
					                    	<input type="hidden" name="nonota" value="<?echo $_SESSION[nonota]?>">
					                    	
					                    	<input type="hidden" name="tottarifaslisvc" value="<?echo $dC[tottarifasli]?>">
					                    	<input type="hidden" name="totdiskonsvc" value="<?echo $dC[totdiskon]?>">
					                    	<input type="hidden" name="totservice" value="<?echo $dC[ttotal]?>">
					                    	
					                    	<input type="hidden" name="tothargabelisp" value="<?echo $dB[tothargabelisp]?>">
					                    	<input type="hidden" name="totdiskonsp" value="<?echo $dB[totdiskon]?>">
					                    	<input type="hidden" name="totsparepart" value="<?echo $dB[ttotal]?>">
					                    	
					                    	<input type="hidden" name="grandtotal" value="<?echo $ttotal?>">
					                    	
					                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[idpelanggan]?>">
					                    	<input type="hidden" name="noantrian" value="<?echo $d1[noantrian]?>">
					                    	<input type="hidden" name="nopol" value="<?echo $d1[nopol]?>">
					                    	<input type="hidden" name="nopkb" value="<?echo $d1[nopkb]?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&back=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
					                   		 
		                           			<button data-toggle="modal" data-target="#compose-modal-tambahservice" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Servis</button>
										<?
				                            $dA1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonota]'"));
				                            $dA2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]'"));
				                            
											if(!empty($_SESSION[noclaim])){
										?>
												<button data-toggle="modal" data-target="#compose-modal-tambahbarang" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Barang</button>
					                	<?
												}
											else{
												if(!empty($dA2[id])){
										?>
													<button data-toggle="modal" data-target="#compose-modal-tambahbarang" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Barang</button>
					                	<?
													}
												}
											
											$dcp = mysql_fetch_array(mysql_query("SELECT id,kodepaket FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]' AND tarifkpb NOT IN ('','0')"));
											if(!empty($dcp[id])){
												$dcp2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonota]' AND total='0' AND totdiskon='0' AND qty='1'"));	
												if(empty($dcp2[id])){
													$kodekpb = $dcp[kodepaket];
										?>	
													<button data-toggle="modal" data-target="#compose-modal-tambaholi" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Oli KPB</button>
					                	<?
					                				}
					                			}
										?>
										</div>
				                    </div>
			                    	</form>
			                	</div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:270px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG/KODE JASA</th>
			                                    <th style="padding:7px">NAMA JASA/BARANG</th>
			                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
			                                    <th width="1%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
			                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA  = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonota]' ORDER BY id DESC");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:1%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$dA[id]&id=$_REQUEST[id]"?>">
				                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
				                                    		<i class="fa fa-trash-o"></i>
				                                    	</button>
			                                    	</a>
			                                     </td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            if(!empty($dA1[nonota]))
			                            	{
			                            ?>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>TOTAL BARANG</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:1%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            <?
			                            	}
			                            	
										$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            	if(!empty($dA[kodepaket]))
			                            		{
												$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
				                            	if(!empty($dB[kpbke]))
				                            		{
													$kpbke = "KPB KE $dB[kpbke] - ";
													}
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $dA[kodepaket]?></td>
				                                    <td><?echo $kpbke.$dB[nama]?></br>
				                                    <?
													$qB2 = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE kode='$dA[kodepaket]'");
						                            while($dB2 = mysql_fetch_array($qB2))
						                            	{
														echo "- $dB2[namajasa]</br>";
														}
				                                    ?>
				                                    	
				                                    </td>
				                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
			                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:5%">-</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
				                                    <td align="center">
				                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delsvc=$dA[id]&id=$_REQUEST[id]"?>">
					                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
					                                    		<i class="fa fa-trash-o"></i>
					                                    	</button>
				                                    	</a>
				                                     </td>
				                                </tr>
			                                
			                            <?
												}
											else
												{
												$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
			                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $dB[kodejasa]?></td>
				                                    <td><?echo $dB[namajasa]?></td>
				                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
			                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:5%">-</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
				                                    <td align="center">
				                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delsvc=$dA[id]&id=$_REQUEST[id]"?>">
					                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
					                                    		<i class="fa fa-trash-o"></i>
					                                    	</button>
				                                    	</a>
				                                     </td>
				                                </tr>
			                            <?	
												}
			                            	}
			                            	
			                            if(!empty($_SESSION[noclaim]))
			                            	{
											$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$_SESSION[noservis]'");
				                            while($dA = mysql_fetch_array($qA))
				                            	{
				                            	if(!empty($dA[kodepaket]))
				                            		{
													$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
					                            	if(!empty($dB[kpbke]))
					                            		{
														$kpbke = "KPB KE $dB[kpbke] - ";
														}
				                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo $dA[kodepaket]?></td>
					                                    <td><?echo $kpbke.$dB[nama]?></br>
					                                    <?
														$qB2 = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE kode='$dA[kodepaket]'");
							                            while($dB2 = mysql_fetch_array($qB2))
							                            	{
															echo "- $dB2[namajasa]</br>";
															}
					                                    ?>
					                                    	
					                                    </td>
					                                    <td align="right"><span style="margin-right:30%">0</span></td>
				                                    	<td align="right"><span style="margin-right:1%">0</span></td>
					                                    <td align="right"><span style="margin-right:5%">-</span></td>
					                                    <td align="right"><span style="margin-right:20%">0</span></td>
					                                    <td align="center">
					                                     </td>
					                                </tr>
			                                
			                            <?
													}
												else
													{
													$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
			                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo $dB[kodejasa]?></td>
					                                    <td><?echo $dB[namajasa]?></td>
					                                    <td align="right"><span style="margin-right:30%">0</span></td>
				                                    	<td align="right"><span style="margin-right:1%">0</span></td>
					                                    <td align="right"><span style="margin-right:5%">-</span></td>
					                                    <td align="right"><span style="margin-right:20%">0</span></td>
					                                    <td align="center">
					                                     </td>
					                                </tr>
			                            <?	
			                            			}
												}
			                            	}
			                            	
			                            //echo "$dA2[nonota].13212312313";
			                            if(!empty($dA2[id]))
			                            	{
			                            ?>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>TOTAL JUMLAH JASA</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dC[ttotal])?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>PPN 10% (RP)</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppnjasa)?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>TOTAL JUMLAH JASA + PPN 10% (RP)</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dC[ttotal]+$ppnjasa)?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="10"><div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ttotal)?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
		                            
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL PILIH SERVIS ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambahservice" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH JASA</h4>
				                    </div>
									
									<script>
									function populateSelectA(str)
										{
											pilihan = document.service.jnsservice.value;
											if(pilihan==''){
											document.service.kodepaket.disabled = 1;
											document.service.idjasa.disabled = 1;
											}else if(pilihan=='RETAIL'){
											document.service.kodepaket.disabled = 1;
											document.service.idjasa.disabled = 0;
											}else if(pilihan=='PAKET'){
											document.service.kodepaket.disabled = 0;
											document.service.idjasa.disabled = 1;
											}
										}
									</script>
				                   	<form name="service" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">JENIS SERVIS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="3"><select name="jnsservice" class="form-control" style="width: 30%" onchange="populateSelectA(this.value)" required="">
													<option value=''>PILIH</option>
													<option value='RETAIL' <?if($dA[jnsservice]=='RETAIL'){?>selected=""<?}?>>RETAIL</option>
													<option value='PAKET' <?if($dA[jnsservice]=='PAKET'){?>selected=""<?}?>>PAKET</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="20%">PAKET JASA <?//echo $_SESSION[nonota]?></td>
				                    			<td width="2%">:</td>
				                    			<td width=""><select name="kodepaket" class="form-control select1" style="font-size:12px;padding:3px;width:100%" disabled="">
																		<option value='' selected>Pilih</option>
																		<!--
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_kelompokjasa ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[kode]?>'><?echo "$dA[kode] | $dA[nama]"?></option>
																		<?
																				}
																		?>
																		-->
																		<?
																			$dCkpb = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice_det WHERE nonota='$_SESSION[nonota]' AND tarifkpb NOT IN ('','0')"));
																			if(empty($dCkpb[id])){
																				//$k1 = "'LAINNYA','KPB'";
																				$k1 = "'LAINNYA'";
																				}
																			else{
																				$k1 = "'LAINNYA'";
																				}
																			$q1 = mysql_query("SELECT * FROM x23_kelompokjasa WHERE jnskj IN ($k1) AND status='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[kode]?>'><?echo "$dA[nama] | $dA[kode]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="20%">JASA</td>
				                    			<td width="2%">:</td>
				                    			<td width=""><select name="idjasa" class="form-control select1" style="font-size:12px;padding:3px;width:100%" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterjasa ORDER BY namajasa");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[namajasa] | $dA[kodejasa]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>DISKON</td>
				                    			<td>:</td>
				                    			<td colspan="2" width="">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="diskon" style="width:100%;text-align:right" value="0" onfocus="this.select();" class="form-control uang" maxlength="12" onkeypress="return buat_angka(event,'1234567890')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>DISKON</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="diskon" style="width:20%;text-align:right" value="0" onfocus="this.select();" class="form-control uang" maxlength="12" onkeypress="return buat_angka(event,'1234567890')" required></td>
				                    		</tr>
				                    		-->
					                    	<input type="hidden" name="tempsvc" value="<?echo $_SESSION[nonota]?>">
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Pilih</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

<!-- ################## MODAL PILIH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambahbarang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG</h4>
				                    </div>
									
				                   	<form method="post" name="inpNJ" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width="" colspan="2"><select name="idbarang" class="form-control select1" onchange="populateSelectNJ1(this.value)" style="font-size:12px;padding:3px;width:100%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw GROUP BY idbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[idbarang]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="notabeli" class="form-control select1" id="NJ2" style="font-size:12px;padding:3px;width: 50%" onchange="populateSelectNJ2(this.value)" disabled="">
													</select></td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>TANGGAL NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="tglnota" class="form-control select1" id="NJ3" style="font-size:12px;padding:3px;width: 50%" onchange="populateSelectNJ3(this.value)" disabled="">
													</select></td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" id="NJ4" style="font-size:12px;padding:3px;width: 70%" onchange="populateSelectNJ4(this.value)" disabled="">
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" id="NJ5" style="font-size:12px;padding:3px;width: 50%" disabled="">
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY JUAL</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                    		</tr>
												<script>
												function populateSelect(str)
												{
													pilihan = document.inpNJ.optdis.value;
													if(pilihan==''){
													document.inpNJ.diskon1.disabled = 1;
													document.inpNJ.diskon2.disabled = 0;
													}
													else if(pilihan=='1'){
													document.inpNJ.diskon1.disabled = 1;
													document.inpNJ.diskon2.disabled = 0;
													}else{
													document.inpNJ.diskon1.disabled = 0;
													document.inpNJ.diskon2.disabled = 1;
													}
												}
												</script>
					                    		<tr>
					                    			<td>DISKON</td>
					                    			<td>:</td>
					                    			<td colspan="2" width=""><select name="optdis" class="form-control" style="font-size:12px;padding:3px;width:8%" onchange="populateSelect(this.value)" required="">
																		<option value='1' selected>Rp.</option>
																		<option value='2' >%</option>
																    </select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td>
					                                    <div class="input-group">
					                                    	<input type="text" name="diskon1" style="width:100%;text-align:right" value="0" onfocus="this.select();" class="form-control uang" maxlength="12" onkeypress="return buat_angka(event,'1234567890')" disabled="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">% Per PCS</span>
					                                    </div>
							                        </td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2" width="">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="width:15%">RP.</span>
					                                        <input type="text" name="diskon2" style="width:100%;text-align:right" value="0" onfocus="this.select();" class="form-control uang" maxlength="12" onkeypress="return buat_angka(event,'1234567890')" required>
					                                    	<span class="input-group-addon" style="width:30%;text-align:left">Per PCS</span>
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<input type="hidden" name="temp" value="<?echo $_SESSION[nonota]?>">
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Pilih</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

<!-- ################## MODAL TAMBAH OLI ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambaholi" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DAFTAR OLI <?echo $dB[kodejasa]?></h4>
				                    </div>
									
				                   	<form method="post" name="inpNO" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">KODE OLI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" onchange="populateSelectNO1(this.value)" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																		$q1 = mysql_query("SELECT * FROM x23_kelompokjasa_oli_vw WHERE kode='$kodekpb'");
																		while($dA=mysql_fetch_array($q1))
																			{ 
																		?>
																				<option value='<?echo $dA[idoli]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																			}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="notabeli" class="form-control select1" id="NO2" style="font-size:12px;padding:3px;width: 50%" onchange="populateSelectNO2(this.value)" disabled="">
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" id="NO4" style="font-size:12px;padding:3px;width: 70%" onchange="populateSelectNO4(this.value)" disabled="">
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" id="NO5" style="font-size:12px;padding:3px;width: 50%" disabled="">
													</select></td>
				                    		</tr>
					                    	<input type="hidden" name="temp" value="<?echo $_SESSION[nonota]?>">
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
					                    	<input type="hidden" name="oli" value="1">
					                    	<input type="hidden" name="qty" value="1">
					                    	<input type="hidden" name="diskon" value="0">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                        	<!--
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
			                           	-->
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
	if($submenu == 'NJ1')
		{
		$q  = $_GET['q'];	
		$_SESSION[idbarang] = $q;
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$q' AND stok>'0' AND hargajual!='' GROUP BY nonota,idbarang ORDER BY nonota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[nonota]'>$d[nonota]</option>";
			}
		}
		
	if($submenu == 'NJ2')
		{
		$q  = $_GET['q'];
		$_SESSION[notabeli] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND nonota='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota ORDER BY tglnota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[idgudang]'>$d[gudang]</option>";
			//echo "<option value='$d[tglnota]'>".date("d-m-Y",strtotime($d[tglnota]))."</option>";
			}
		}
		
	if($submenu == 'NJ3')
		{
		$q  = $_GET['q'];
		$_SESSION[tglnota] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND  nonota='$_SESSION[notabeli]' AND tglnota='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota,gudang ORDER BY gudang");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[idgudang]'>$d[gudang]</option>";
			}
		}
		
	if($submenu == 'NJ4')
		{
		$q  = $_GET['q'];
		$_SESSION[idgudang] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND  nonota='$_SESSION[notabeli]' AND idgudang='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota,gudang,rak ORDER BY rak");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[rak]'>$d[rak] | $d[stok] PCS</option>";
			}
		}
		
	if($submenu == 'NO1')
		{
		$q  = $_GET['q'];	
		$_SESSION[idbarang] = $q;
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$q' AND stok>'0' AND hargajual!='' GROUP BY nonota,idbarang ORDER BY nonota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[nonota]'>$d[nonota]</option>";
			}
		}
		
	if($submenu == 'NO2')
		{
		$q  = $_GET['q'];
		$_SESSION[notabeli] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND nonota='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota ORDER BY tglnota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[idgudang]'>$d[gudang]</option>";
			//echo "<option value='$d[tglnota]'>".date("d-m-Y",strtotime($d[tglnota]))."</option>";
			}
		}
		
	if($submenu == 'NO3')
		{
		$q  = $_GET['q'];
		$_SESSION[tglnota] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND  nonota='$_SESSION[notabeli]' AND tglnota='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota,gudang ORDER BY gudang");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[idgudang]'>$d[gudang]</option>";
			}
		}
		
	if($submenu == 'NO4')
		{
		$q  = $_GET['q'];
		$_SESSION[idgudang] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND  nonota='$_SESSION[notabeli]' AND idgudang='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota,gudang,rak ORDER BY rak");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[rak]'>$d[rak] | $d[stok] PCS</option>";
			}
		}
?>	
        <script src="js/jquery.min.js"></script>
		<script>
		function populateSelectNJ1(str)
		{
			if (str==""){
				document.getElementById("NJ2").value="";
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
					document.getElementById("NJ2").innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ1"?>&q="+str,true);
			xmlhttp.send();
			
			pilihan = document.inpNJ.idbarang.value;
			if(pilihan==''){
			document.inpNJ.notabeli.disabled = 1;
			document.inpNJ.notabeli.required = 0;
			}else{
			document.inpNJ.notabeli.disabled = 0;
			document.inpNJ.notabeli.required = 1;
			}
		}

		function populateSelectNJ2(str)
			{
				if (str==""){
					document.getElementById("NJ4").value="";
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
						document.getElementById("NJ4").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ2"?>&q="+str,true);
				xmlhttp.send();
				
				pilihan = document.inpNJ.notabeli.value;
				if(pilihan==''){
				document.inpNJ.idgudang.disabled = 1;
				document.inpNJ.idgudang.required = 0;
				}else{
				document.inpNJ.idgudang.disabled = 0;
				document.inpNJ.idgudang.required = 1;
				}
			}

		function populateSelectNJ4(str)
			{
				if (str==""){
					document.getElementById("NJ5").value="";
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
						document.getElementById("NJ5").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ4"?>&q="+str,true);
				xmlhttp.send();
				
				pilihan = document.inpNJ.idgudang.value;
				if(pilihan==''){
				document.inpNJ.rak.disabled = 1;
				document.inpNJ.rak.required = 0;
				}else{
				document.inpNJ.rak.disabled = 0;
				document.inpNJ.rak.required = 1;
				}
			}
		function populateSelectNJ5(str)
			{
				if (str==""){
					document.getElementById("NJ6").value="";
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
						document.getElementById("NJ6").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ5"?>&q="+str,true);
				xmlhttp.send();
			}
			
		function populateSelectNO1(str)
		{
			if (str==""){
				document.getElementById("NO2").value="";
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
					document.getElementById("NO2").innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NO1"?>&q="+str,true);
			xmlhttp.send();
			
			pilihan = document.inpNO.idbarang.value;
			if(pilihan==''){
			document.inpNO.notabeli.disabled = 1;
			document.inpNO.notabeli.required = 0;
			}else{
			document.inpNO.notabeli.disabled = 0;
			document.inpNO.notabeli.required = 1;
			}
		}

		function populateSelectNO2(str)
			{
				if (str==""){
					document.getElementById("NO4").value="";
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
						document.getElementById("NO4").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NO2"?>&q="+str,true);
				xmlhttp.send();
				
				pilihan = document.inpNO.notabeli.value;
				if(pilihan==''){
				document.inpNO.idgudang.disabled = 1;
				document.inpNO.idgudang.required = 0;
				}else{
				document.inpNO.idgudang.disabled = 0;
				document.inpNO.idgudang.required = 1;
				}
			}

		function populateSelectNO4(str)
			{
				if (str==""){
					document.getElementById("NO5").value="";
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
						document.getElementById("NO5").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NO4"?>&q="+str,true);
				xmlhttp.send();
				
				pilihan = document.inpNO.idgudang.value;
				if(pilihan==''){
				document.inpNO.rak.disabled = 1;
				document.inpNO.rak.required = 0;
				}else{
				document.inpNO.rak.disabled = 0;
				document.inpNO.rak.required = 1;
				}
			}
		function populateSelectNO5(str)
			{
				if (str==""){
					document.getElementById("NO6").value="";
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
						document.getElementById("NO6").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NO5"?>&q="+str,true);
				xmlhttp.send();
			}
		</script>
        <script>
        //SELECT2
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
        <!-- uang -->
        <script type="text/javascript">
		// memformat angka ribuan
		function formatAngka(angka) {
			 if (typeof(angka) != 'string') angka = angka.toString();
			 var reg = new RegExp('([0-9]+)([0-9]{3})');
			 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			 return angka;
			}
		
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