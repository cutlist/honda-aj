<script src="js/jquery.min.js"></script>	
<?
	if($submenu == 'saveB')
		{
		$utitipan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipan']);
		$utitipannopol 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipannopol']);
		
		$nama 		= strtoupper(addslashes($_REQUEST['nama']));
		$noktp 		= $_REQUEST['noktp'];
		$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
		$rt 		= $_REQUEST['rt'];
		$rw 		= $_REQUEST['rw'];
		
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
			
		$pnopol		= strtoupper($_REQUEST['pnopol']);
		
		if($_REQUEST[jnstransaksi]=="KREDIT" && $_REQUEST[utitipan] <= "0")
			{
			echo "<script>alert ('Transaksi Kredit Tidak Bisa Tanpa Uang Muka.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
		if($_REQUEST[jnstransaksi]=="CASH TEMPO" && $_REQUEST[jnscashtempo]=="LEASING" && $_REQUEST[utitipan] <= "0")
			{
			echo "<script>alert ('Transaksi Cash Tempo Leasing Tidak Bisa Tanpa Uang Muka.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
		if($_REQUEST[jnstransaksi]=="CASH TEMPO" && $_REQUEST[jnscashtempo]=="DEALER" && $_REQUEST[utitipan] <= "0")
			{
			echo "<script>alert ('Transaksi Cash Tempo Dealer Tidak Bisa Tanpa Uang Titipan.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
		if($_REQUEST[jnstransaksi]=="CASH TEMPO" && $_REQUEST[jnscashtempo]=="DEALER" && $_REQUEST[utitipan] >= "0")
			{
			$tglpelunasan 	= date("Y-m-d", strtotime($_REQUEST[tglpelunasan]));
			if($tglpelunasan < date("Y-m-d")){
				echo "<script>alert ('Tanggal Pelunasan Tidak Bisa Kurang Dari Hari Ini.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
				exit();
				}
			}
		
		$dC1 = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS tot FROM temp_pesanan_det WHERE nopesan='$_REQUEST[nopesan]'"));
		if($dC1[tot] == '0'){
			echo "<script>alert ('Barang Belum Dipilih.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
		if($_REQUEST[jnstransaksi]=='KREDIT' && $dC1[tot] > '1')
			{
			echo "<script>alert ('Transaksi Kredit Hanya Dapat Melakukan Pemesanan 1 Unit Per Nota.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
		if($_REQUEST[jnstransaksi]=='CASH TEMPO' && $_REQUEST[jnscashtempo]=='LEASING' && $dC1[tot] > '1')
			{
			echo "<script>alert ('Transaksi Cash Tempo Leasing Hanya Dapat Melakukan Pemesanan 1 Unit Per Nota.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
		
		$qT = mysql_query("SELECT * FROM temp_pesanan_det WHERE nopesan='$_REQUEST[nopesan]'");
		while($dT=mysql_fetch_array($qT))
			{
			/*
			$dCek = mysql_fetch_array(mysql_query("SELECT hargabelibersih FROM tbl_stokunit WHERE idbarang='$dT[idbarang]' AND status='STOK'"));
				echo "<script>alert ('$dCek[hargabelibersih].$utitipan')</script>";
				exit();
			*/
			
			$dCek = mysql_fetch_array(mysql_query("SELECT hargabelibersih FROM tbl_stokunit WHERE idbarang='$dT[idbarang]' AND status='STOK'"));
			if(!empty($dCek[hargabelibersih]) && ($dCek[hargabelibersih] < $utitipan))
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput. Karena Uang Titipan Yang Diinput Melebihi Harga Beli.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
				exit();
				}
			else
				{
				mysql_query("INSERT INTO tbl_pesanan_det (nopesan,idpelanggan,idbarang) VALUES ('$dT[nopesan]','$_REQUEST[idpelanggan]','$dT[idbarang]')");
				}
			}
		
		$q1 = mysql_query("INSERT INTO tbl_pesanan (
										nopesan, 
										tahun, 
										bulan, 
										tglpesan, 
										idsales, 
										idpelanggan, 
										jnstransaksi, 
										jnscashtempo, 
										tnkb, 
										tglpelunasan, 
										idleasing, 
										termin, 
										utitipan, 
										inputx, 
										updatex) 
									VALUES (
										'$_REQUEST[nopesan]', 
										'$_REQUEST[tahun]', 
										'$_REQUEST[bulan]', 
										CURDATE(), 
										'$_SESSION[id]', 
										'$_REQUEST[idpelanggan]', 
										'$_REQUEST[jnstransaksi]', 
										'$_REQUEST[jnscashtempo]', 
										'$_REQUEST[tnkb]', 
										'$tglpelunasan', 
										'$_REQUEST[idleasing]', 
										'$_REQUEST[termin]', 
										'$utitipan', 
										NOW(), 
										'$updatex')
						");
							
		if($utitipan!='0'){
			$q6 = mysql_query("INSERT INTO tbl_hutitipan (
												nopesan, 
												idpelanggan, 
												tgl, 
												jumlah, 
												ket, 
												input, 
												updatex) 
											VALUES (
												'$_REQUEST[nopesan]', 
												'$_REQUEST[idpelanggan]',
												CURDATE(), 
												'$utitipan', 
												'UANG TITIPAN/UANG MUKA PERTAMA', 
												NOW(), 
												'$updatex') 
								");
			}
							
						
		$q2 = mysql_query("INSERT INTO tbl_bpkb (
										nopesan, 
										nama, 
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
										utitipannopol, 
										pnopol) 
									VALUES (
										'$_REQUEST[nopesan]',
										'$nama', 
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
										'$utitipannopol', 
										'$pnopol')
						");
							
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_pesanan',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH PESANAN $_REQUEST[nopesan]')
								");
			mysql_query("DELETE FROM temp_pesanan_det WHERE nopesan='$_REQUEST[nopesan]'");
								
		if($_REQUEST['utitipannopol']!="0")
			{			
			$p_tahun  = date("Y");
			$p_tahun2 = date("y");
			$p_bulan  = date("m");
			$p_tgl    = date("d");
				
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE jnskwitansi='nopol' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
			$nokwitansi = "KNP$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			mysql_query("INSERT INTO tbl_kwitansi (
											jnskwitansi,
											nokwitansi,
											nomor,
											tahun,
											bulan,
											tanggal,
											idpelanggan,
											jumlah,
											keterangan,
											user,
											inputx)
										VALUES (
											'nopol',
											'$nokwitansi',
											'$_REQUEST[nopesan]',
											'$p_tahun',
											'$p_bulan',
											CURDATE(),
											'$_REQUEST[idpelanggan]', 
											'$utitipannopol',
											'$pnopol',
											'$_SESSION[id]',
											NOW())
						");
						
			$np = 1;
			}
			
		if($q1 && $q2 && $q3)
			{
			if($_REQUEST[jnstransaksi]=='KREDIT'){
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1&np=$np'/>";
				exit();
				}
			if($_REQUEST[jnstransaksi]=='CASH TEMPO'){
				if($_REQUEST[jnscashtempo]=='LEASING'){
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=2&np=$np'/>";
					exit();
					}
				else{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=3&np=$np'/>";
					exit();
					}
				}
			if($_REQUEST[jnstransaksi]=='CASH'){
				if(empty($utitipan)){
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=4&np=$np'/>";
					exit();
					}
				else{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=5&np=$np'/>";
					exit();
					}
				}
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
		$kadaluarsaohc 	= date("Y-m-d", strtotime($_REQUEST['kadaluarsaohc']));
		$noktp 		= $_REQUEST['noktp'];
		$notelepon 	= $_REQUEST['notelepon'];
		$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
		$rt 		= $_REQUEST['rt'];
		$rw 		= $_REQUEST['rw'];
		
		if(!empty($ohc))
			{
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pelanggan WHERE ohc='$ohc'"));			
			if(!empty($ohc) && !empty($dCek[id]))
				{
				echo "<script>alert ('Mohon Ulangi OHC Yang Diinput, Karena OHC Sudah Ada Pada Database.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
				exit();
				}
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
			                	<h4>PENJUALAN <small>PEMESANAN</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[np]=="1")
											{
											$ketX = "Mohon Melanjutkan Ke Menu Kwitansi Bayar Pemesanan Nopol.</br>";
											}
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Bayar Uang Muka Pada Bagian Kasir.</br> $ketX Mohon Ingat Nomor Nota Pesanannya!</br>Mohon Periksa Menu Indent Setelah Pelanggan Melakukan Pembayaran.</p>";
											}
										if($_REQUEST[note]=="2")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Bayar Uang Muka Pada Bagian Kasir.</br> $ketX Mohon Ingat Nomor Nota Pesanannya!</br>Mohon Periksa Menu Indent Setelah Pelanggan Melakukan Pembayaran.</p>";
											}
										if($_REQUEST[note]=="3")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Uang Titipan Pada Bagian Kasir.</br> $ketX Mohon Ingat Nomor Nota Pesanannya!</br>Mohon Periksa Menu Indent Setelah Pelanggan Melakukan Pembayaran.</p>";
											}
										if($_REQUEST[note]=="4")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Indent.</br> $ketX Mohon Ingat Nomor Nota Pesanannya!</p>";
											}
										if($_REQUEST[note]=="5")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Uang Titipan Pada Bagian Kasir.</br> $ketX Mohon Ingat Nomor Nota Pesanannya!</br>Mohon Periksa Menu Indent Setelah Pelanggan Melakukan Pembayaran.</p>";
											}
				
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
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
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA / OHC / TELEPON ..." class="form-control"/>
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
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%' AND grup='0' LIMIT 0,20");
											$q2 = mysql_query("SELECT * FROM tbl_pelanggan WHERE nama LIKE '%$_REQUEST[cari]%' OR ohc LIKE '%$_REQUEST[cari]%' OR notelepon LIKE '%$_REQUEST[cari]%' AND grup='0'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='0' ORDER BY id DESC LIMIT 0,20");
											$q2 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='0'");
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
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px;margin-top:-55px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-hleasing<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-file"></i>Riwayat Leasing</a></li>
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
			            
			            <div class="col-xs-6">		
                            <div class="small-box bg-aqua" style="text-align:center;height:150px;border-radius:5px;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;cursor: pointer;">
                                <div class="inner" style="height:110px;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-25px;font-weight:bold">PEMESANAN HARI INI</h4>
			                		<?
			                		$dPS = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_pesanan WHERE tglpesan=CURDATE() AND status='0'"));
			                		?>
	                                	<a href="<?echo "?opt=$opt&menu=".md5(indent)."&submenu=A"?>" style="color:#fff">
		                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;margin-top:20px">
			                                	<div class="bg-aqua" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo $dPS[total]?></h3>
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
			                		$dPJ = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notajual WHERE tglnota=CURDATE()"));
			                		?>
	                                	<a href="<?echo "?opt=$opt&menu=".md5(notajual)."&submenu=A"?>" style="color:#fff">
		                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;margin-top:20px">
			                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo $dPJ[total]?></h3>
			                                    </div>
		                                    </div>
		                                </a>
                                </div>
                            </div>
			            </div>
			            
	                    <?
		                    while($d2 = mysql_fetch_array($q2))
		                    	{
		                ?>	
								<!-- ################## MODAL RIWAYAT LEASING ########################################################################################## -->
						        <div class="modal fade " id="compose-modal-hleasing<?echo $d2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
						            <div class="modal-dialog" style="width:75%;">
						                <div class="modal-content">
						                    <div class="modal-header">
						                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                        <h4 class="modal-title">RIWAYAT LEASING</h4>
						                    </div>
						                    
					                        <div class="modal-body" style="overflow-x:hidden;overflow-y:auto;height:450px;">
												<table class="table table-striped" >
													<thead>
						                                <tr>
						                                    <th width="">TANGGAL</th>
						                                    <th width="">KODE LEASING</th>
						                                    <th width="">NAMA LEASING</th>
						                                    <th width="">UNIT</th>
						                                    <th width="">MASA ANGSURAN</th>
						                                    <th width="">STATUS</th>
						                                </tr>
						                       		</thead>
						                       		<tbody>
						                            <?
						                            $no = 1;
						                            $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id_pelanggan='$d2[id]' ORDER BY tanggal DESC");
						                            while($d1 = mysql_fetch_array($q1))
						                            	{
						                            	if($d1[status]=='1'){
															$statusvw = "<span class='label label-success'><i class='fa fa-thumbs-o-up'></i> &nbsp;$d1[ketstatus]</span>";
															}
														else{
															$statusvw = "<span class='label label-danger'><i class='fa fa-thumbs-o-down'></i> &nbsp;$d1[ketstatus]</span>";
															}
						                            ?>
						                                <tr style="cursor: pointer">
						                                    <td align="" valign="middle"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
						                                    <td align="" valign="middle"><?echo $d1['kodeleasing']?></td>
						                                    <td align="" valign="middle"><?echo $d1['namaleasing']?></td>
						                                    <td align="" valign="middle"><?echo $d1['unit']?></td>
						                                    <td align="" valign="middle"><?echo $d1['termin']?> KALI</td>
						                                    <td align="" valign="middle"><?echo $statusvw?></td>
						                                </tr>
						                                
						                            <?
						                            	$no++;
						                            	}
						                            ?>
						                            </tbody>
						                        </table>
						               		</div>
					                        <div class="modal-footer clearfix">
					                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
						                	</div>
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
		
	else if($submenu == 'Ba')
		{
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
		exit();
		}
		
	else if($submenu == 'B')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$_REQUEST[id]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNP = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_pesanan WHERE tglpesan=CURDATE() ORDER BY SUBSTR(nopesan,-3,3) DESC LIMIT 1"));
            
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
			
			$nopesan = "NP$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		if(!empty($_REQUEST[temp]))
			{
			mysql_query("INSERT INTO temp_pesanan_det VALUES ('','$_REQUEST[temp]','$_REQUEST[idbarang]')");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&id=$_GET[id]&save=1'/>";
			exit();
			}
		if(!empty($_REQUEST[deltemp]))
			{
			mysql_query("DELETE FROM temp_pesanan_det WHERE id='$_REQUEST[deltemp]'");
			}
		if(!empty($_REQUEST[back]))
			{
			mysql_query("DELETE FROM temp_pesanan_det WHERE nopesan='$nopesan'");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>PEMESANAN</small></h4>
			                	
					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="90%">
				                    		<tr>
				                    			<td width="25%">NO. NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nopesan" class="form-control" style="width: 40%" value="<?echo $nopesan?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="">NAMA PELANGGAN</td>
				                    			<td width="">:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width=""><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
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
				                    	</div>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            	<?
		                            	$dQ = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM temp_pesanan_det WHERE nopesan='$nopesan' GROUP BY nopesan"));
		                            	$qTemp = mysql_query("SELECT * FROM temp_pesanan_det WHERE nopesan='$nopesan'");
		                            	?>
				                    	<table width="90%" border="0">
				                    		<tr>
				                    			<td width="25%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1"><button type="button" style="padding-top:1px;padding-bottom:1px" class="btn btn-warning" data-toggle="modal" data-target="#compose-modal-pilihbarang"><i class="fa fa-plus"></i> &nbsp; Pilih Barang</button></td>
				                    			<td colspan="2"><span style="color:red;font-weight: bold;font-size:11px"><i>Transaksi Kredit Dan Cash Tempo Leasing Hanya Dapat Melakukan Pemesanan 1 Unit Per Nota.</i></span></td>
											</tr>
				                    		<tr>
				                    			<td colspan="6"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="3" style="background: #eee;padding: 0 10px"></td>
				                    		</tr>
				                    	<?
				                    	while($dTemp = mysql_fetch_array($qTemp))
				                    		{
				                    		$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dTemp[idbarang]'"))
				                    	?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding: 0 10px"><?echo "$dBrg[kodebarang] | $dBrg[namabarang] | $dBrg[varian] | $dBrg[warna]"?></td>
				                    			<td width="5%" style="background: #eee;border-left:1px solid #f5f5f5" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deltemp=$dTemp[id]&id=$_REQUEST[id]"?>"><i class="fa fa-trash-o"></i></a></td>
				                    		</tr>
				                    	<?
				                    		}
				                    	?>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KUANTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>JENIS TRANSAKSI</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select name="jnstransaksi" class="form-control" style="width: 40%" onchange="populateSelectA(this.value)" required="">
													<option value='KREDIT' >KREDIT</option>
													<option value='CASH TEMPO' >CASH TEMPO</option>
													<option value='CASH' >CASH</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TNKB</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select name="tnkb" class="form-control" style="width: 40%" onchange="populateSelectA(this.value)" required="">
													<option value='PLAT HITAM' selected="">PLAT HITAM</option>
													<option value='PLAT MERAH' >PLAT MERAH</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>CASH TEMPO</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select name="jnscashtempo" class="form-control" style="width: 40%" onchange="populateSelectB(this.value)" disabled="">
													<option value='' >Pilih</option>
													<option value='DEALER' >DEALER</option>
													<option value='LEASING' >LEASING</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL PELUNASAN</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tglpelunasan" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  disabled=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>LEASING</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select name="idleasing" class="form-control" style="width: 80%">
													<option value='' selected="">Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value='<?echo $data[id]?>'><?echo $data[namaleasing]?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" onkeypress="return buat_angka(event,'0123456789')">
				                                        <span class="input-group-addon">Kali</span>
				                                    </div>
				                                </td>
				                    			<td colspan="2"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
				                    			<td colspan="3">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="utitipan" class="form-control uang" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG TITIPAN PESAN NOPOL</td>
				                    			<td>:</td>
				                    			<td colspan="3">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="utitipannopol" class="form-control uang" value="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
				                    		<input type="hidden" name="tahun" value="<?echo $p_tahun?>">
				                    		<input type="hidden" name="bulan" value="<?echo $p_bulan?>">
				                    	</table>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
			                    	<?
			                    	$dCek = mysql_fetch_array(mysql_query("SELECT * FROM temp_pesanan_det WHERE nopesan='$nopesan'"));
			                    	if(!empty($dCek[nopesan]))
			                    		{
			                    	?>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">DATA BPKB</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Sama dengan Data Pembeli</button></td>
				                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required></td>
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
					                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')">
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')">
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
			                            	</table>
			                            </div>
			                            
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%" valign="top">PESAN NOPOL</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td colspan="2"><input type="text" name="pnopol" class="form-control"></td>
				                    		</tr>
		                            	</table>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            <?
		                            	}
		                            ?>
				                    </div>
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">

			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&back=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									</div>
				                </form>
			                	</div>
			                </div>
			            </div>
					
<!-- ################## MODAL PILIH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-pilihbarang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width=""><select name="idbarang" class="form-control" id="select1" style="font-size:12px;padding:3px;width:100%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] | $dA[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="temp" value="<?echo $nopesan?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-reply"></i> &nbsp;Kembali</button>
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
			
		function validA()
			{
			if (document.inputpelanggan.jnstransaksi.value == 'KREDIT')
				{
				if (document.inputpelanggan.idleasing.value == '')
					{
					alert ("Pilih Leasing!");	 	
					return false;		
					}	
				else if (document.inputpelanggan.termin.value == '')
					{
					alert ("Masa Angsuran Belum Diisi!");	 	
					return false;		
					}		
				else if (document.inputpelanggan.termin.value == '0')
					{
					alert ("Masa Angsuran Tidak Boleh 0 (Nol)!");	 	
					return false;		
					}	
				else
					{
					return true;	
					}
				}
			if (document.inputpelanggan.jnstransaksi.value == 'CASH TEMPO')
				{
				if (document.inputpelanggan.jnscashtempo.value == '')
					{
					alert ("Pilih Jenis Cash Tempo!");	 	
					return false;		
					}
				else if (document.inputpelanggan.jnscashtempo.value == 'LEASING')
					{
					if (document.inputpelanggan.idleasing.value == '')
						{
						alert ("Pilih Leasing!");	 	
						return false;		
						}	
					else if (document.inputpelanggan.termin.value == '')
						{
						alert ("Masa Angsuran Belum Diisi!");	 	
						return false;		
						}			
					else if (document.inputpelanggan.termin.value == '0')
						{
						alert ("Masa Angsuran Tidak Boleh 0 (Nol)!");	 	
						return false;		
						}	
					else
						{
						return true;	
						}
					}
				else if (document.inputpelanggan.jnscashtempo.value == 'DEALER')
					{
					if (document.inputpelanggan.tglpelunasan.value == '')
						{
						alert ("Tanggal Pelunasan Belum Diisi!");	 	
						return false;		
						}	
					else
						{
						return true;	
						}
					}
				else
					{
					return true;	
					}
				}
			}
			
		function populateSelectA(str)
			{
				pilihan = document.inputpelanggan.jnstransaksi.value;
				if(pilihan=='KREDIT'){
				document.inputpelanggan.idleasing.disabled = 0;
				document.inputpelanggan.termin.disabled = 0;
				document.inputpelanggan.jnscashtempo.disabled = 1;
				}else if(pilihan=='CASH TEMPO'){
				document.inputpelanggan.idleasing.disabled = 1;
				document.inputpelanggan.termin.disabled = 1;
				document.inputpelanggan.jnscashtempo.disabled = 0;
				}else if(pilihan=='CASH'){
				document.inputpelanggan.idleasing.disabled = 1;
				document.inputpelanggan.termin.disabled = 1;
				document.inputpelanggan.jnscashtempo.disabled =1;
				document.inputpelanggan.tglpelunasan.disabled =1;
				}else{
				document.inputpelanggan.idleasing.disabled = 1;
				document.inputpelanggan.termin.disabled = 1;
				document.inputpelanggan.jnscashtempo.disabled = 1;
				document.inputpelanggan.tglpelunasan.disabled = 1;
				}
			}
			
		function populateSelectB(str)
			{
				pilihan = document.inputpelanggan.jnscashtempo.value;
				if(pilihan=='LEASING'){
				document.inputpelanggan.idleasing.disabled = 0;
				document.inputpelanggan.tglpelunasan.disabled = 1;
				document.inputpelanggan.termin.disabled = 0;
				}else{
				document.inputpelanggan.idleasing.disabled = 1;
				document.inputpelanggan.tglpelunasan.disabled = 0;
				document.inputpelanggan.termin.disabled = 1;
				}
			}
		</script>
        <script>
        //SELECT2
			$(function(){
			  var select = $('#select1').select2();
			}); 
			$(document).ready(function() {});
		</script>
<?
		}
		
	else if($submenu == 'C')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNP = mysql_fetch_array(mysql_query("SELECT nopesan FROM tbl_pesanan WHERE tglpesan=CURDATE() ORDER BY SUBSTR(nopesan,-3,3) DESC LIMIT 1"));
            
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
			
			$nopesan = "NP$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>PEMESANAN</small></h4>
			                	
					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveC"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PEMESANAN</td>
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
			  var select = $('#select1').select2();
			}); 
			$(document).ready(function() {});
		</script>
<?
		}
?>		
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
                $('#example2').dataTable({
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