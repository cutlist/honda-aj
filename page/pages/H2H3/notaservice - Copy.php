<script src="js/jquery.min.js"></script>	
<?
	if($submenu == 'saveB')
		{
		$p_tahun = date("Y");
		$p_bulan = date("m");
		$nomesin = strtoupper($_REQUEST[nomesin]);
		$nopkb 	 = strtoupper($_REQUEST[nopkb]);
		$noservis 	 = strtoupper($_REQUEST[noservis]);
		$km = preg_replace( "/[^0-9]/", "",$_REQUEST[km]);
		$tglbelimotor = date("Y-m-d", strtotime($_REQUEST[tglbelimotor]));
		
		if($_REQUEST[jns]=="CLAIM")
			{
			if($_REQUEST[km] == "0"){
				echo "<script>alert ('Mohon Ulangi, Karena KM Tidak Boleh 0 (Nol)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B&id=$_REQUEST[idpelanggan]'/>";
				exit();
				}
			if(!empty($noservis)){
				$dCkm = mysql_fetch_array(mysql_query("SELECT km FROM x23_notaservice WHERE nonota='$noservis'"));
				$selisihkm = abs($km-$dCkm[km]);
				if($selisihkm > "500"){
					echo "<script>alert ('Mohon Ulangi, Karena KM Saat Ini Melebihi Batas KM Claim! ')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B&id=$_REQUEST[idpelanggan]'/>";
					exit();
					}
				}
				
			$noclaim	 = strtoupper($_REQUEST[noclaim]);
			$dCns =mysql_fetch_array(mysql_query("SELECT *,(TO_DAYS(CURDATE())- TO_DAYS(tglnota)) AS lama FROM x23_notaservice WHERE nonota='$noservis'"));
			if(empty($dCns[id]))
				{
				echo "<script>alert ('Mohon Ulangi, Karena Nomor Nota Servis Sebelumnya Tidak Ada Pada Database!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B&id=$_REQUEST[idpelanggan]'/>";
				exit();
				}
			else if($dCns[nomesin] != $nomesin)
				{
				echo "<script>alert ('Mohon Ulangi, Karena Nomor Mesin Yang Diinput Tidak Sama Dengan Nomor Mesin Pada Nota Servis Sebelumnya!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B&id=$_REQUEST[idpelanggan]'/>";
				exit();
				}
			else
				{
				if($dCns[lama] > "7"){
					echo "<script>alert ('Mohon Ulangi, Karena Tanggal Nota Servis Sudah Melewati 7 Hari!')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B&id=$_REQUEST[idpelanggan]'/>";
					exit();
					}
					
				}
			}
		
		$dNP = mysql_fetch_array(mysql_query("SELECT nopol FROM x23_antrian WHERE tanggal=CURDATE() AND noantrian='$_REQUEST[noantrian]'"));
		
		mysql_query("UPDATE x23_antrian SET status='1',jammulai=CURTIME() WHERE tanggal=CURDATE() AND noantrian='$_REQUEST[noantrian]'");
		
		$q1 = mysql_query("INSERT INTO x23_notaservice (
										jns,
										noclaim, 
										noservis, 
										idpelanggan, 
										tahun, 
										bulan, 
										tglnota, 
										noantrian, 
										jammulai, 
										nopkb, 
										kodemotor, 
										km, 
										tglbelimotor, 
										idmekanik, 
										nopol,
										nomesin,
										iduser,
										inputx, 
										updatex) 
									VALUES (
										'$_REQUEST[jns]', 
										'$noclaim', 
										'$noservis', 
										'$_REQUEST[idpelanggan]', 
										'$p_tahun', 
										'$p_bulan', 
										CURDATE(), 
										'$_REQUEST[noantrian]', 
										CURTIME(), 
										'$nopkb', 
										'$_REQUEST[kodemotor]',
										'$km',
										'$tglbelimotor',
										'$_REQUEST[idmekanik]',
										'$dNP[nopol]', 
										'$nomesin',
										'$_SESSION[id]', 
										NOW(), 
										'$updatex')
						");
			
		if($q1)
			{
			//echo "<script>alert ('Proses berhasil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
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
		
	else if($submenu == 'r1')
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
		$p_tahun = date("Y");
		$p_bulan = date("m");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:380px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SERVIS <small>INPUT NOTA SERVIS</small></h4>
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
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> &nbsp; Tambah Baru</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="23%">NAMA PELANGGAN</th>
			                                    <th width="" style="padding:7px">OHC</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th width="1%" style="padding:7px">EMAIL</th>
			                                    <th style="padding:7px">ALAMAT</th>
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
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[ohc]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[email]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo "$d1[alamat]</br>KEL. $d1[namakel], KEC. $d1[namakec], KAB. $d1[namakab]"?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-6">		
                            <div class="small-box bg-aqua" style="text-align:center;height:150px;border-radius:5px;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;cursor: pointer;">
                                <div class="inner" style="height:110px;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-25px;font-weight:bold">TOTAL PENDAFTAR HARI INI</h4>
			                		<?
			                		$dP1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_antrian WHERE tanggal=CURDATE()"));
			                		?>
	                                	<a href="<?echo "?opt=$opt&menu=".md5(historyjual)."&submenu=A"?>" style="color:#fff">
		                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;margin-top:20px">
			                                	<div class="bg-aqua" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo number_format($dP1[total])?></h3>
			                                    </div>
		                                    </div>
		                                </a>
                                </div>
                            </div>
			            </div>
			            
			            <div class="col-xs-6">		
                            <div class="small-box bg-green" style="text-align:center;height:150px;border-radius:5px;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;cursor: pointer;">
                                <div class="inner" style="height:110px;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-25px;font-weight:bold">SISA ANTRIAN HARI INI</h4>
			                		<?
			                		$dP2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_antrian WHERE tanggal=CURDATE() AND status='0'"));
			                		?>
	                                	<a href="<?echo "?opt=$opt&menu=".md5(historyjual)."&submenu=A"?>" style="color:#fff">
		                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;margin-top:20px">
			                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo number_format($dP2[total])?></h3>
			                                    </div>
		                                    </div>
		                                </a>
                                </div>
                            </div>
			            </div>
			            
		                <?
						}
						?>
<!-- ################## MODAL LOG PENJUALAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-log-pesan" tabindex="-1" role="dialog" aria-hidden="true">
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
				                            $q1 = mysql_query("SELECT * FROM log_act WHERE tbl='x23_notaservice' ORDER BY id DESC LIMIT 0,50");
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
		
	else if($submenu == 'B')
		{
		$dCs = mysql_fetch_array(mysql_query("SELECT aksi FROM x23_scanhistory WHERE tanggal=CURDATE() ORDER BY id DESC LIMIT 0,1"));
		if($dCs[aksi]=='stop' || empty($dCs[aksi]))
			{
			echo "<script>alert ('Sensor Infra Red Sedang Tidak Aktif, Silakan Mengaktifkan Sensor Infra Red Terlebih Dahulu!')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
		$dC2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_antrian WHERE tanggal=CURDATE() AND status='0'"));
		if(empty($dC2[id]))
			{
			echo "<script>alert ('Mohon Ambil Nomor Antrian Terlebih Dahulu!')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
				
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
			
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNA = mysql_fetch_array(mysql_query("SELECT noantrian FROM x23_notaservice WHERE tglnota=CURDATE() ORDER BY noantrian DESC LIMIT 1"));
		if(empty($dNA[noantrian]))
			{
			$dig3=1;
			$dig2=0;	
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNA[noantrian]",-3,3);
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
			
			$noantrian = "$dig1$dig2$dig3";
			
        $dNC = mysql_fetch_array(mysql_query("SELECT noclaim FROM x23_notaservice WHERE tglnota=CURDATE() ORDER BY SUBSTR(noclaim,-3,3) DESC LIMIT 1"));
            
		if(empty($dNC[noclaim]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNC[noclaim]",-3,3);
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
			
			$noclaim = "NC$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
        $dP = mysql_fetch_array(mysql_query("SELECT nopkb FROM x23_notaservice WHERE tglnota=CURDATE() ORDER BY SUBSTR(nopkb,-3,3) DESC LIMIT 1"));
            
		if(empty($dP[nopkb]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dP[nopkb]",-3,3);
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
			
			$nopkb = "PKB$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice WHERE id='$_REQUEST[id]'"));
			
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>SERVIS <small>INPUT NOTA SERVIS</small></h4>
			                	
				                	<form method="post" name="inputns" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
			                    	<table width="90%">
			                    		<tr>
			                    			<td width="25%">NOMOR ANTRIAN</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="noantrian" class="form-control" style="width: 13%" value="<?echo $noantrian?>" onkeypress="return buat_angka(event,'0123456789')" maxlength="4" required=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>NOMOR PKB</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="nopkb" value="<?echo $nopkb?>" class="form-control" style="width: 40%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TGL NOTA SERVIS</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>NOMOR POLISI</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" style="width: 40%" value="<?echo $dX[nopol]?>" class="form-control" maxlength="20" readonly></td>
			                    		</tr>
			                    		<tr>
			                    			<td>JENIS</td>
			                    			<td>:</td>
			                    			<td colspan="2"><select name="jns" class="form-control" style="width: 30%" onchange="populateSelect1(this.value)">
													<option value="SERVIS BARU" selected="">SERVIS BARU</option>
													<option value="CLAIM">CLAIM</option>
													<option value="KPB">KPB</option>
													</select>
											</td>
			                    		</tr>
			                    		<tr>
			                    			<td>NOMOR NOTA SERVIS SEBELUMNYA</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="noservis" class="form-control" maxlength="20" style="width: 40%" disabled=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>KODE MOTOR</td>
			                    			<td>:</td>
			                    			<td colspan="2"><select name="kodemotor" class="form-control select1" style="font-size:12px;padding:3px;width:100%" required="">
																<option value='' selected>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[kodebarang]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] | $dA[warna]"?></option>
																<?
																		}
																?>
														    </select></td>
			                    		</tr>
			                    		<tr>
			                    			<td>NOMOR MESIN</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="nomesin" class="form-control" maxlength="20" style="width: 40%" required=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>KM</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="km" class="form-control uang" style="width: 20%;text-align:right" value="" maxlength="8" onkeypress="return buat_angka(event,'1234567890')" required=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TGL BELI MOTOR</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglbelimotor" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>NAMA MEKANIK</td>
			                    			<td>:</td>
			                    			<td colspan="2"><select name="idmekanik" class="form-control select1" style="font-size:12px;padding:3px;width:60%" required="">
																		<option value='' selected>Pilih</option>
																			<?
																				$q1 = mysql_query("SELECT * FROM x23_karyawan WHERE posisi='4' ORDER BY nama");
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
			                    			<td>NAMA PELANGGAN</td>
			                    			<td>:</td>
			                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
			                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
			                    		</tr>
	                            	</table>
	                            	
		                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                    	<div id="spoiler" style="display:none">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="25%">NOMOR OHC</td>
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
		                            	
		                           		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
										<table class="table table-striped table-hover" >
											<thead>
				                                <tr>
				                                    <th width="">JENIS SERVIS</th>
				                                    <th width="">TGL NOTA SERVIS</th>
				                                    <th width="">NO. NOTA SERVIS</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $q1 = mysql_query("SELECT * FROM x23_notaservice WHERE idpelanggan='$_REQUEST[id]' AND nonota!='' ORDER BY tglnota DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor: pointer" onclick="window.open('<?echo "?opt=$opt&menu=".md5(historyservice)."&submenu=B&id=$d1[id]"?>', 'newwindow', 'width=300, height=250'); return false;">
				                                    <td align="" valign="middle"><?echo $d1[tglnota]?></td>
				                                    <td align="" valign="middle"><?echo $d1[jns]?></td>
				                            <?
				                            	if($d1[jns]=='SERVIS BARU')
				                            		{
				                            ?>
				                                    <td align="" valign="middle"><?echo $d1[nonota]?></td>
				                            <?
														
													}
												
				                            	if($d1[jns]=='CLAIM')
				                            		{
				                            ?>
				                                    <td align="" valign="middle"><?echo $d1[noclaim]?></td>
				                            <?
													}
				                            ?>
				                                </tr>
				                                
				                            <?
				                            	$no++;
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
			                    	</div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
					                    	<input type="hidden" name="noclaim" value="<?echo $noclaim?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
			
			<script>
			function populateSelect1(str)
			{
				pilihan = document.inputns.jns.value;
				if(pilihan=='CLAIM'){
				document.inputns.noservis.disabled = 0;
				document.inputns.kodemotor.disabled = 1;
				document.inputns.nomesin.disabled = 0;
				document.inputns.tglbelimotor.disabled = 1;
				document.inputns.idmekanik.disabled = 1;
				document.inputns.tglbelimotor.disabled = 1;
				}else if(pilihan=='SERVIS BARU'){
				document.inputns.noservis.disabled = 1;
				document.inputns.kodemotor.disabled = 0;
				document.inputns.nomesin.disabled = 0;
				document.inputns.tglbelimotor.disabled = 0;
				document.inputns.idmekanik.disabled = 0;
				document.inputns.tglbelimotor.disabled = 1;
				}else if(pilihan=='KPB'){
				document.inputns.noservis.disabled = 1;
				document.inputns.kodemotor.disabled = 0;
				document.inputns.nomesin.disabled = 0;
				document.inputns.tglbelimotor.disabled = 0;
				document.inputns.idmekanik.disabled = 0;
				document.inputns.tglbelimotor.disabled = 0;
				}
			}
			</script>
<?
		}
		
	else if($submenu == 'C')
		{
		$p_tahun = date("Y");
		$p_bulan = date("m");
			
        $dNP = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_pesanan WHERE tahun='$p_tahun' AND bulan='$p_bulan' ORDER BY SUBSTR(nopesan,-3,3) DESC LIMIT 1"));
            
		if(empty($dNP[nopesan]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNP[nopesan]",-3,3);
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
			
			$nopesan = "NP$p_tahun$p_bulan$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SERVIS <small>INPUT NOTA SERVIS</small></h4>
			                	
					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveC"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA SERVIS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nopesan" class="form-control" style="width: 40%" value="<?echo $nopesan?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
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
				                                        <input type="text" name="rt" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')">
				                                    </div>
				                                </td>
				                    			<td>
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RW</span>
				                                        <input type="text" name="rw" class="form-control" placeholder="-" style="width:17%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')">
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
				                    			<td colspan="2"><input type="email" name="email" class="form-control" maxlength="40"></td>
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
		                            	</table>
				                    	
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan & Lanjutkan <i class="fa fa-angle-double-right"></i></button>
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
?>	
        <script src="js/jquery.min.js"></script>
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
                    "bFilter": false,
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