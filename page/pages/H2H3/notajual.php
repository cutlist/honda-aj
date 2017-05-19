<script src="js/jquery.min.js"></script>
<?
	if($submenu == 'saveB')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		/*
		$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_REQUEST[nonota]'");
        while($dA = mysql_fetch_array($qA))
        	{
			mysql_query("UPDATE x23_stokpart SET stok=stok-$dA[qty] WHERE idgudang='$dA[idgudang]' AND rak='$dA[rak]' AND nonota='$dA[notabeli]' AND idbarang='$dA[idbarang]'");
			}
		*/
		$noteA = "0";
		$noteB = "0";
			
		$dJ = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE nonota='$_SESSION[nonotajual]'"));
		if(!empty($dJ[id]))
			{
			$notajual = $_REQUEST[nonota];	
			$q1 = mysql_query("INSERT INTO x23_notajual (
											nonota, 
											notaindent, 
											idpelanggan, 
											tahun, 
											bulan, 
											tglnota, 
											totalqty, 
											totdiskon, 
											tothargabelibersih, 
											grandtotal,
											iduser,
											inputx, 
											updatex) 
										VALUES (
											'$_REQUEST[nonota]', 
											'$_SESSION[notaindent]', 
											'$_REQUEST[idpelanggan]', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'$_REQUEST[totalqty]', 
											'$_REQUEST[totdiskon]', 
											'$_REQUEST[tothargabelibersih]', 
											'$_REQUEST[grandtotal]',
											'$_SESSION[id]', 
											NOW(), 
											'$updatex')
							");
							
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notajual',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'TAMBAH NOTA JUAL $_REQUEST[nonota]')
								");
								
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansi WHERE jnskwitansi='penjualan' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
				$nokwitansi = "KPJ$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			$q1 = mysql_query("INSERT INTO x23_kwitansi (
													jnskwitansi, 
													nokwitansi, 
													tahun, 
													bulan, 
													tanggal, 
													nomor, 
													idpelanggan, 
													noantrian, 
													nopol, 
													jumlah, 
													user,
													keterangan, 
													status,
													inputx, 
													updatex) 
												VALUES (
													'penjualan', 
													'$nokwitansi', 
													'$p_tahun', 
													'$p_bulan', 
													CURDATE(), 
													'$_REQUEST[nonota]', 
													'$_REQUEST[idpelanggan]', 
													'', 
													'', 
													'$_REQUEST[grandtotal]', 
													'$_SESSION[id]', 
													'',
													'0', 
													NOW(), 
													'$updatex')
							");
			$noteA = "1";
			}
		
		/*
			echo "<script>alert ('$_SESSION[nonotajual].$dJ[id].$noteA.$noteB')</script>";
			exit();
		*/
			
		$dI = mysql_fetch_array(mysql_query("SELECT id FROM x23_indent_det WHERE noindent='$_SESSION[noindent]'"));
		if(!empty($dI[id]))
			{	
			$q2 = mysql_query("INSERT INTO x23_indent (
											noindent, 
											notajual, 
											idpelanggan, 
											tahun, 
											bulan, 
											tglindent, 
											totalqty, 
											iduser,
											inputx, 
											updatex) 
										VALUES (
											'$_SESSION[noindent]', 
											'$notajual', 
											'$_REQUEST[idpelanggan]', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'$_REQUEST[totalqty2]',
											'$_SESSION[id]', 
											NOW(), 
											'$updatex')
							");
							
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansi WHERE jnskwitansi='indent' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
				$nokwitansi = "KI$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			$q1 = mysql_query("INSERT INTO x23_kwitansi (
													jnskwitansi, 
													nokwitansi, 
													tahun, 
													bulan, 
													tanggal, 
													nomor, 
													idpelanggan, 
													noantrian, 
													nopol, 
													jumlah, 
													user,
													keterangan, 
													status,
													inputx, 
													updatex) 
												VALUES (
													'indent', 
													'$nokwitansi', 
													'$p_tahun', 
													'$p_bulan', 
													CURDATE(), 
													'$_SESSION[noindent]', 
													'$_REQUEST[idpelanggan]', 
													'', 
													'', 
													'0', 
													'$_SESSION[id]', 
													'',
													'0', 
													NOW(), 
													'$updatex')
							");
			$noteB = "1";
							
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_indent',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH NOTA INDENT $_SESSION[noindent]')
							");
			}
		
			
		if($q1 || $q2)
			{
			//echo "<script>alert ('Proses berhasil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&noteA=$noteA&noteB=$noteB'/>";
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
	        <!-- disable klik kanan dan blok -->
	        <script language="JavaScript">
				document.addEventListener("contextmenu", function(e){
				    e.preventDefault();
				}, false);
				
				function disableselect(e){
				return false
				}
				function reEnable(){
				return true
				}
				document.onselectstart=new Function ("return false")
				if (window.sidebar){
				document.onmousedown=disableselect
				document.onclick=reEnable
				}
			</script>
			
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
			                	<h4>PENJUALAN <small>NAMA BARANG</small></h4>
									<?
									if(!empty($_REQUEST[noteA]) OR !empty($_REQUEST[noteB]))
										{
										if($_REQUEST[noteA]=="1" AND $_REQUEST[noteB]=="0")
											{
											$ket = "<p>Proses Berhasil, Proses Penjualan Dilanjutkan Ke Pembuatan Kwitansi Penjualan Pada Bagian Kasir.</p>";
											}
										if($_REQUEST[noteB]=="1" AND $_REQUEST[noteA]=="0")
											{
											$ket2 = "<p>Proses Berhasil, Proses Indent Dilanjutkan Ke Pembuatan Kwitansi Indent Pada Bagian Kasir.</p>";
											}
										if($_REQUEST[noteB]=="1" AND $_REQUEST[noteA]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Penjualan Dilanjutkan Ke Pembuatan Kwitansi Penjualan Pada Bagian Kasir,</br>
													Lalu Dilanjutkan Ke Pembuatan Kwitansi Indent Pada Bagian Kasir.</p>";
											}
				
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
	                                        <?echo $ket2?>
	                                    </div>
									<?
										}
									?>
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
									<table id="example2" class="table table-striped table-hover">
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
											$q2 = mysql_query("SELECT * FROM tbl_pelanggan WHERE nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan ORDER BY id DESC LIMIT 0,20");
											$q2 = mysql_query("SELECT * FROM tbl_pelanggan");
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
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-25px;font-weight:bold">PENJUALAN BULAN INI</h4>
			                		<?
			                		$dP1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notajual WHERE bulan='$p_bulan' AND tahun='$p_tahun'"));
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
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-25px;font-weight:bold">PENJUALAN HARI INI</h4>
			                		<?
			                		$dP2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notajual WHERE tglnota=CURDATE()"));
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNJ = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notajual WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNJ[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNJ[nonota]",-3,3);
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
			
			$nonota = "NJ2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$_SESSION[nonotajual] = $nonota;
			
        $dNI = mysql_fetch_array(mysql_query("SELECT noindent FROM x23_indent WHERE tglindent=CURDATE() ORDER BY SUBSTR(noindent,-3,3) DESC LIMIT 1"));
            
		if(empty($dNI[noindent]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNI[noindent]",-3,3);
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
			
			$noindent = "NI$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$_SESSION[noindent] = $noindent;
			
		if(!empty($_REQUEST[temp]))
			{
			//$tglnota = date("Y-m-d", strtotime($_REQUEST['tglnota']));

			//$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det_vw WHERE idbarang='$_REQUEST[idbarang]' AND tglnota='$tglnota' LIMIT 0,1"));	
			//$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det_vw WHERE idbarang='$_REQUEST[idbarang]' AND notabeli='$_REQUEST[notabeli]' AND tglnota='$tglnota' AND idgudang='$_REQUEST[idgudang]' AND 
			//																			 rak='$_REQUEST[rak]'"));	
			
			$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det WHERE notabeli='$_REQUEST[notabeli]' AND idgudang='$_REQUEST[idgudang]' AND 
																						 rak='$_REQUEST[rak]' AND nonota='$_REQUEST[temp]' AND idbarang='$_REQUEST[idbarang]'"));
								
			$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_REQUEST[idbarang]' AND nonota='$_REQUEST[notabeli]' AND idgudang='$_REQUEST[idgudang]' AND 
																						 rak='$_REQUEST[rak]'"));	
																																		
				//echo "<script>alert ('$dStok[stok].$_REQUEST[idbarang].$_REQUEST[idgudang].$_REQUEST[rak].$tglnota.$_REQUEST[temp].$_REQUEST[notabeli]')</script>";
				//exit();
					
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
				//echo "<script>alert ('$_REQUEST[diskon2].$_REQUEST[optdis]')</script>";
				//exit();
																														
				//echo "<script>alert ('$dStok[stok].$_REQUEST[idbarang].$_REQUEST[idgudang].$_REQUEST[rak].$tglnota.$_REQUEST[temp]')</script>";
				//exit();
					
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
				
												
				if($qty > $dStok[stok])
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
					//$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det_vw WHERE idbarang='$_REQUEST[idbarang]' AND tglnota='$tglnota' LIMIT 1,1"));
					//echo "<script>alert ('Sisa Stok $stok Pcs! Sisa Pemesanan Akan Otomatis Masuk Kedalam Nota Indent')</script>";
					//print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
					//exit();
					$qty1 = $stok;
					$qty2 = $qty-$stok;
					
					$totdiskon			= $diskon*$qty1;
					$tothargabelibersih	= $dStok[hargabelibersih]*$qty1;
					$hargajual			= $dStok[hargajual]-$diskon;
					$jumlah				= $hargajual*$qty1;
					
					if($qty1>0)
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
															'$dStok[hargajual]',
															'$diskon',
															'$hargajual',
															'$qty1',
															'$totdiskon',
															'$tothargabelibersih',
															'$jumlah',
															'$dStok[idgudang]',
															'$dStok[rak]')
											");
						}
						
					$dStok2 = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS total, COUNT(id) AS hit FROM x23_stokpart_vw WHERE idbarang='$_REQUEST[idbarang]'"));		
					$dStok3 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total, COUNT(id) AS hit FROM x23_notajual_det WHERE nonota='$_SESSION[nonotajual]' AND idbarang='$_REQUEST[idbarang]'"));	
						
					if($dStok2[hit] > $dStok3[hit]){
						
					//echo "<script>alert ('$dStok2[hit].$dStok3[hit].$qty1.$qty')</script>";
					//exit();
					
						if($qty1 < $qty){
							echo "<script>alert ('Qty Jual Yang Anda Masukkan Melebihi Jumlah Stok Yang Ada Di Rak $_REQUEST[rak], Namun Stoknya Masih Terdapat Di Nomor Rak Yang Lain. Silahkan Pilih Kembali Barang Tersebut Di Nomor Rak / Gudang / No. Nota Beli Yang Lain.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
							exit();
							}
						}
					if($dStok2[hit]  == $dStok3[hit]){
						$q2 = mysql_query("INSERT INTO x23_indent_det (
															noindent,
															tahun,
															bulan,
															tglindent,
															idbarang,
															qty)
														VALUE (
															'$_SESSION[noindent]',
															'$p_tahun',
															'$p_bulan',
															CURDATE(),
															'$dStok[idbarang]',
															'$qty2')
											");
						}
					}
				else{
						
					$totdiskon			= $diskon*$qty;
					$tothargabelibersih	= $dStok[hargabelibersih]*$qty;
					
					
					
           			if($d1[grup]=="0"){
						$hargajual			= $dStok[hargajual]-$diskon;
						}
           			if($d1[grup]=="1"){
           				if($dStok[idsupplier]=="1"){
							$ppnbeli = round($dStok[hargabelibersih] * 0.1 , 0);
							}
						$hargajual			= $dStok[hargabelibersih]+$ppnbeli;
						}
						$jumlah				= $hargajual*$qty;
						
					//echo "<script>alert ('$hargajual.$jumlah')</script>";
					//exit();
					
					//echo "<script>alert ('$d1[grup].$dStok[idsupplier].$dStok[hargabelibersih].$ppnbeli.$hargajual')</script>";
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
				}
			}
			
		if(!empty($_REQUEST[temp2]))
			{
			$qty = preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			
			if($qty=="0"){
				echo "<script>alert ('Mohon Ulangi, Karena Qty Tidak Boleh Nol (0)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
			/*
				echo "<script>alert ('$_SESSION[noindent].$qty.$_REQUEST[idbarang]')</script>";
				exit();
			*/	
				
			$dCek2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent_det WHERE noindent='$_SESSION[noindent]' AND idbarang='$_REQUEST[idbarang]'"));
			if(!empty($dCek2[id])){
				echo "<script>alert ('Barang Tersebut Sudah Ada Pada Detail Nota Indent.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
			
			$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE idbarang='$_REQUEST[idbarang]'"));	
			if($dStok[totalstok] > "0"){
				echo "<script>alert ('Stok Untuk Barang Tersebut Masih Tersedia, Silahkan Melakukan Proses Penjualan Melalui Tombol Tambah Detail Penjualan. ')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
				
			$q1 = mysql_query("INSERT INTO x23_indent_det (
												noindent,
												tahun,
												bulan,
												tglindent,
												idbarang,
												qty)
											VALUE (
												'$_SESSION[noindent]',
												'$p_tahun',
												'$p_bulan',
												CURDATE(),
												'$_REQUEST[idbarang]',
												'$qty')
								");
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
					
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_notajual_det WHERE	id='$_REQUEST[del]'");
			}
					
		if(!empty($_REQUEST[del2]))
			{
			mysql_query("DELETE FROM x23_indent_det WHERE id='$_REQUEST[del2]'");
			}
			
		if(!empty($_REQUEST[back]))
			{
			mysql_query("DELETE FROM x23_notajual_det WHERE nonota='$_SESSION[nonotajual]'");
			mysql_query("DELETE FROM x23_indent_det WHERE noindent='$_SESSION[noindent]'");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelibersih FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonotajual]'"));
		$dBx= mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty FROM x23_indent_det WHERE noindent='$_SESSION[noindent]'"));
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PENJUALAN <small>NAMA BARANG</small></h4>
			                	
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NOMOR NOTA JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $_SESSION[nonotajual]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="30%">NAMA PELANGGAN</td>
			                    			<td width="2%">:</td>
			                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
			                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
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
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
					                    	<input type="hidden" name="noindent" value="<?echo $dBx[noindent]?>">
					                    	<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
					                    	<input type="hidden" name="totalqty" value="<?echo $dB[tqty]?>">
					                    	<input type="hidden" name="totalqty2" value="<?echo $dBx[tqty]?>">
					                    	<input type="hidden" name="totdiskon" value="<?echo $dB[totdiskon]?>">
					                    	<input type="hidden" name="tothargabelibersih" value="<?echo $dB[tothargabelibersih]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $dB[ttotal]?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&back=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
		                           				<button data-toggle="modal" data-target="#compose-modal-tambahbarang" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Penjualan</button>
		                           			<?
		                           			if($d1[grup]=="0")
		                           				{
											?>
												<button data-toggle="modal" data-target="#compose-modal-tambahindent" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Indent</button>
											<?
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
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                    <?
			                    $dC1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonotajual]'"));
			                    if(!empty($dC1[id]))
			                    	{
			                    ?>
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
			                                    <th width="1%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
			                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH JUAL (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_SESSION[nonotajual]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <?
			                           			if($d1[grup]=="0")
			                           				{
												?>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
												<?
													}
			                           			else
			                           				{
												?>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajualbersih],"0","",".")?></span></td>
												<?
													}
			                           			?>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td><?echo $dA[gudang]?></td>
			                                    <td><?echo $dA[rak]?></td>
			                                    <td align="center">
												<?
												$dDel1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_indent_det WHERE noindent='$_SESSION[noindent]' AND idbarang='$dA[idbarang]?'"));
												if(empty($dDel1[id]))
													{
												?>
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$dA[id]&id=$_REQUEST[id]"?>">
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
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                        <!-- ########################################################################################################### -->
			                    <?
			                    	}
								?>
								<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
								<?
			                    $dC2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_indent_det WHERE noindent='$_SESSION[noindent]'"));
			                    if(!empty($dC2[id]))
			                    	{
			                    ?>
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. INDENT</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="10%" style="padding:7px"><center>QTY JUAL</center></th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA2 = mysql_query("SELECT * FROM x23_indent_det WHERE noindent='$_SESSION[noindent]'");
			                            while($dA2 = mysql_fetch_array($qA2))
			                            	{
			                            	$dB2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$dA2[idbarang]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA2[noindent]?></td>
			                                    <td><?echo $dB2[kodebarang]?></td>
			                                    <td><?echo "$dB2[namabarang] | $dB2[varian]"?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA2[qty],"0","",".")?> PCS</span></td>
			                                    <td align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del2=$dA2[id]&id=$_REQUEST[id]"?>">
				                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
				                                    		<i class="fa fa-trash-o"></i>
				                                    	</button>
			                                    	</a>
			                                     </td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<td colspan="3" align="right"><span style="margin-right:1%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dBx[tqty])?> PCS</b></span></td>
			                            		<th colspan="1"></th>
			                            	</tr>
			                            </tfoot>
			                        </table> 
			                    <?
			                    	}
			                    ?>
			                       
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL PILIH JUAL ########################################################################################## -->
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
				                    			<td width="28%">NAMA BARANG</td>
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
				                    			<td>NO. NOTA BELI / TGL NOTA BELI</td>
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
				                    		<?
		                           			if($d1[grup]=="0")
		                           				{
											?>	
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
					                    	<?
					                    		}
					                    	else{echo "<input type='hidden' name='diskon' value='0'>";}
					                    	?>
					                    	<input type="hidden" name="temp" value="<?echo $_SESSION[nonotajual]?>">
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

<!-- ################## MODAL PILIH INDENT ########################################################################################### -->
				        <div class="modal fade " id="compose-modal-tambahindent" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG INDENT</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width="" colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px;width:100%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			//$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw GROUP BY idbarang ORDER BY kodebarang");
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
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
					                    	<input type="hidden" name="temp2" value="<?echo $_SESSION[noindent]?>">
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
			echo "<option value='$d[nonota]'>$d[nonota] | ".date("d-m-Y",strtotime($d[tglnota]))."</option>";
			}
		}
		
	if($submenu == 'NJ2')
		{
		$q  = $_GET['q'];
		$_SESSION[notabeli] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND nonota='$q' AND stok>'0' GROUP BY nonota,idbarang,idgudang ORDER BY gudang");
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
		
	else if($submenu == 'C')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNJ = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notajual WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNJ[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNJ[nonota]",-3,3);
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
			
			$nonota = "NJ2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$_SESSION[nonotajual] = $nonota;
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>NAMA BARANG</small></h4>
			                	
					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveC"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA JUAL</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $_SESSION[nonotajual]?>" readonly=""></td>
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
			
		function populateSelectA(str)
		{
			if (str==""){
				document.getElementById("r1A").value="";
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
					document.getElementById("r1A").innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=r1"?>&q="+str,true);
			xmlhttp.send();
			
			pilihan = document.inputpelanggan.kodekabB.value;
			if(pilihan==''){
			document.inputpelanggan.kodekecB.disabled = 1;
			document.inputpelanggan.kodekelB.disabled = 1;
			}else{
			document.inputpelanggan.kodekecB.disabled = 0;
			document.inputpelanggan.kodekelB.disabled = 1;
			}
		}

		function populateSelect2A(str)
			{
			if (str==""){
				document.getElementById("r2A").value="";
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
						document.getElementById("r2A").innerHTML=xmlhttp.responseText;
						}
					}
				}
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=r2"?>&q="+str,true);
				xmlhttp.send();
				
				pilihan = document.inputpelanggan.kodekecB.value;
				if(pilihan==''){
				document.inputpelanggan.kodekelB.disabled = 1;
				}else{
				document.inputpelanggan.kodekelB.disabled = 0;
				}
			}
			
		function validA()
			{
			if (document.inputpelanggan.jnstransaksi.value == 'KREDIT')
				{
				if (document.inputpelanggan.idleasing.value == '' || document.inputpelanggan.termin.value == '')
					{
					alert ("Pilih Leasing!");	 	
					return false;		
					}	
				else
					{
					return true;	
					}
				}
			}
			
		function populateSelectC(str)
			{
				pilihan = document.inputpelanggan.bpkb.value;
				if(pilihan=='0'){
				document.inputpelanggan.namaB.disabled = 1;
				document.inputpelanggan.noktpB.disabled = 1;
				document.inputpelanggan.rtB.disabled = 1;
				document.inputpelanggan.rwB.disabled = 1;
				document.inputpelanggan.alamatB.disabled = 1;
				document.inputpelanggan.kodekabB.disabled = 1;
				document.inputpelanggan.kodekecB.disabled = 1;
				document.inputpelanggan.kodekelB.disabled = 1;
				}else{
				document.inputpelanggan.namaB.disabled = 0;
				document.inputpelanggan.noktpB.disabled = 0;
				document.inputpelanggan.rtB.disabled = 0;
				document.inputpelanggan.rwB.disabled = 0;
				document.inputpelanggan.alamatB.disabled = 0;
				document.inputpelanggan.kodekabB.disabled = 0;
				document.inputpelanggan.kodekecB.disabled = 1;
				document.inputpelanggan.kodekelB.disabled = 1;
				}
			}
			
		function populateSelectB(str)
			{
				pilihan = document.inputpelanggan.jnstransaksi.value;
				if(pilihan=='KREDIT'){
				document.inputpelanggan.idleasing.disabled = 0;
				document.inputpelanggan.termin.disabled = 0;
				}else{
				document.inputpelanggan.idleasing.disabled = 1;
				document.inputpelanggan.termin.disabled = 1;
				}
			}
		</script>
        <script>
        //SELECT2
			$(function(){
			  var select = $('.select1').select2();
			}); 
			$(document).ready(function() {});
		</script>
<?
		}
?>			
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

		/*
		function populateSelectNJ3(str)
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
				xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ3"?>&q="+str,true);
				xmlhttp.send();
				
				pilihan = document.inpNJ.tglnota.value;
				if(pilihan==''){
				document.inpNJ.idgudang.disabled = 1;
				document.inpNJ.idgudang.required = 0;
				}else{
				document.inpNJ.idgudang.disabled = 0;
				document.inpNJ.idgudang.required = 1;
				}
			}
		*/

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
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
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