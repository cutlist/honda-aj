<?
	if($submenu == 'dir1')
		{
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=km&input='/>";
		exit();
		}
	if($submenu == 'dir2')
		{
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&idkaryawan=$_REQUEST[idkaryawan]&note=km&input='/>";
		exit();
		}
		
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$jumlah			= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
				$karyawan 		= explode("-",$_REQUEST['karyawan']);
				$idkaryawan		= strtoupper($karyawan[0]);
				$nama 			= strtoupper($karyawan[1]);
					
				$tgl		 	= date("Y-m-d", strtotime($_REQUEST['tgl']));
		        $bulan			= substr($tgl,5,2);
		        $tahun			= substr($tgl,1,4);
				$ket			= strtoupper($_REQUEST['ket']);
				$jumlah2		= number_format($jumlah,"0","",".");
				
				$dck = mysql_fetch_array(mysql_query("SELECT id FROM x23_potkompensasi WHERE idkaryawan='$idkaryawan' AND tgl='$tgl' AND jumlah='$jumlah' AND metodebayar='$_REQUEST[metodebayar]' AND ket='$ket'"));
				if(!empty($dck[id]))
					{
					echo "<script>alert ('Potongan Kompensasi Untuk Data Tersebut Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&idkaryawan=$idkaryawan'/>";
					exit();
					}
				
				if($jumlah=='0')
					{
					echo "<script>alert ('Jumlah Tidak Boleh Nol (0).')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&idkaryawan=$idkaryawan'/>";
					exit();
					}
					
				if($_REQUEST[metodebayar]=='GAJI')	
					{
					$dCG = mysql_fetch_array(mysql_query("SELECT ugapok FROM x23_karyawan_vw WHERE id='$idkaryawan'"));
						//echo "<script>alert ('$idkaryawan.$dCG[ugapok]')</script>";
						//exit();
						
					if($dCG[ugapok] < $jumlah)
						{
						echo "<script>alert ('Jumlah Melebihi Gaji Pokok.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&idkaryawan=$idkaryawan'/>";
						exit();
						}
					
					}
							
				$q1 = mysql_query("INSERT INTO x23_potkompensasi (
												idkaryawan, 
												nama, 
												tgl, 
												jumlah, 
												ket, 
												metodebayar,
												iduser, 
												inputx, 
												updatex) 
											VALUES (
												'$idkaryawan', 
												'$nama', 
												'$tgl', 
												'$jumlah', 
												'$ket', 
												'$_REQUEST[metodebayar]', 
												'$_SESSION[id]', 
												NOW(), 
												'$updatex');
									");
									
				$idpotkompensasi = mysql_insert_id();
									
				$q2 = mysql_query("INSERT INTO x23_abis_dkonfirmasi (
													idpotkompensasi, 
													tahun, 
													bulan, 
													tanggal, 
													kasus, 
													tbl, 
													inputx) 
												VALUES (
													'$idpotkompensasi', 
													'$tahun', 
													'$bulan', 
													'$tgl', 
													'POTONGAN KOMPENSASI $nama RP. $jumlah2 METODE PEMBAYARAN : $_REQUEST[metodebayar]', 
													'x23_potkompensasi', 
													NOW())
									");
				
				$q3 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_potkompensasi',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH POTONGAN KOMPENSASI $nama $jumlah')
									");
							
				if($_REQUEST[metodebayar]=='TUNAI')	
					{
					$p_tahun  = date("Y");
					$p_tahun2 = date("y");
					$p_bulan  = date("m");
					$p_tgl    = date("d");
						
			        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansi WHERE jnskwitansi='tunai' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
			            
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
						
					$nokwitansi = "KT2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
					
					mysql_query("INSERT INTO x23_kwitansi (
													jnskwitansi,
													nokwitansi,
													nomor,
													idpotkom,
													tahun,
													bulan,
													tanggal,
													idpelanggan,
													jumlah,
													keterangan,
													user,
													inputx)
												VALUES (
													'tunai',
													'$nokwitansi',
													'$idpotkompensasi',
													'$idpotkompensasi',
													'$p_tahun',
													'$p_bulan',
													'$tgl',
													'$idkaryawan', 
													'$jumlah',
													'$ket',
													'$_SESSION[id]',
													NOW())
								");
					}
			
				//echo "<script>alert ('Proses berhasil.')</script>";
				//print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&input=&save=1'/>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=dir1&input=&note=km'/>";
				exit();
				}
				
			else if(!empty($_REQUEST[del]))
				{	
				$q1 = mysql_query("DELETE FROM x23_potkompensasi WHERE id='$_REQUEST[del]'");
				$q2 = mysql_query("DELETE FROM x23_kwitansi WHERE nomor='$_REQUEST[del]'");
				$q3 = mysql_query("DELETE FROM x23_abis_dkonfirmasi WHERE idpotkompensasi='$_REQUEST[del]'");
				$q4 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_potkompensasi',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS POTONGAN KOMPENSASI $_REQUEST[del] $_REQUEST[nama]')
									");
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
			                	<h4>SDM <small>POTONGAN KOMPENSASI</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="km")
											{
											$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</br>Mohon Melanjutkan Ke Menu Kwitansi Pembayaran Piutang & Potongan Kompensasi Pada Bagian Kasir Setelah Pihak Manajemen Selesai Melakukan Konfirmasi (Jika Metode Pembayaran Tunai).</p>";
											//$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</br>Mohon Melanjutkan Ke Menu Kwitansi Potongan Kompensasi Dan Pembayaran Piutang Tunai Pada Bagian Kasir (Bila Ada).</p>";
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
                                    <div style="float:right;width:58%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="45%">
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Potongan Kompensasi" class="form-control pull-right reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%">
													<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												</td>
				                           		<td width="1%">
													<a data-toggle="modal" data-target="#compose-modal-baru-piutang" style="cursor:pointer">
				                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Potongan Kompensasi</button>
													</a>
				                           		</td>
												<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
													{
												?>
						                           		<td width="1%">
													<button type="button"  onclick="window.open('print/h2/potongankompensasi.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
			                           			
						                           		</td>
												<?
			                           				}
			                           			?>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
			                        <table id="example1" class="table table-hover table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="15%" style="padding:7px">TGL POT. KOMPENSASI</th>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px">JUMLAH POTONGAN (RP)</th>
			                                    <th style="padding:7px">METODE POTONGAN</th>
			                                    <th style="padding:7px">KETERANGAN</th>
			                                    <th style="padding:7px">STATUS KONFIRMASI</th>
			                                    <th style="padding:7px">STATUS CETAK KWITANSI</th>
			                                    <th width="1%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            if(empty($_REQUEST[periode])){
											if(!empty($_REQUEST[cari])){
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE (nama LIKE '%$_REQUEST[cari]%' OR metodebayar LIKE '%$_REQUEST[cari]%' OR tgl LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else{
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi ORDER BY id DESC LIMIT 0,20");
												}
											}
			                            if(!empty($_REQUEST[periode])){
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
											if(!empty($_REQUEST[cari])){
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (nama LIKE '%$_REQUEST[cari]%' OR metodebayar LIKE '%$_REQUEST[cari]%' OR tgl LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
												}
											else{
												$q1 = mysql_query("SELECT * FROM x23_potkompensasi WHERE tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' ORDER BY id DESC LIMIT 0,20");
												}
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE idpotkom='$d1[id]' AND jnskwitansi='tunai'"));
											if($d1[metodebayar]=="TUNAI"){
				                            	if($d1[status]=="0"){
													if($dB[status]=="0"){
														$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
														$status2 = "";
														}
													if($dB[status]=="1"){
														$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
														$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
														}
													}
				                            	if($d1[status]=="1"){
													$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
													if($dB[status]=="0"){
														$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
														}
													if($dB[status]=="1"){
														$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
														}
													}
				                            	if($d1[status]=="2"){
													$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";
													$status2 = "";
													}
												}
											if($d1[metodebayar]=="GAJI"){
				                            	if($d1[status]=="0"){
													$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
													$status2 = "";
													}
				                            	if($d1[status]=="1"){
													$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
													$status2 = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>TIDAK PERLU CETAK</span>";
													}
				                            	if($d1[status]=="2"){
													$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";
													$status2 = "";
													}
												}
											/*
			                            	if($d1[status]=="0"){
												if($dB[status]=="0"){
													$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
													$status2 = "";
													}
												if($dB[status]=="1"){
													$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
													$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
													}
												if(empty($dB[status])){
													$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
													$status2 = "";
													}
												}
			                            	if($d1[status]=="1"){
												$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";
												if($dB[status]=="0"){
													$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
													}
												if($dB[status]=="1"){
													$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
													}
												if(empty($dB[status])){
													$status2 = "";
													}
												}
			                            	if($d1[status]=="2"){
												$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";
												$status2 = "";
												}
									    	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
									    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
									    	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            	*/
										?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tgl]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:15%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td><?echo $d1[metodebayar]?></td>
			                                    <td><?echo $d1[ket]?></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td align="center"><?echo $status2?></td>
			                                    <td width="1%" align="center">
			                                    	<?
	                                            	if($_SESSION[posisi]=='DIREKSI')
	                                            		{
													?>
				                                    	<div class="btn-group">
				                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
				                                                <span class="caret"></span>
				                                                <span class="sr-only">Actions</span>
				                                            </button>
				                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
				                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]&nama=$d1[nama]"?>" onclick="return confirm('Anda yakin akan menghapus data?')" style="cursor:pointer"><i class="fa fa-trash-o"></i>Hapus</a></li>
				                                            </ul>
				                                        </div>
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
					
<!-- ################## MODAL TAMBAH POTONGAN KOMPENSASI ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-piutang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:50%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH POTONGAN KOMPENSASI BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="40%">NAMA KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="karyawan" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_karyawan WHERE id!='1' AND status='AKTIF' AND posisi!= '6' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo "$dA[id]-$dA[nama]"?>'><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL PENGAJUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tgl" class="form-control" value="<?echo date("d-m-Y")?>" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
											</tr>
				                    		<tr>
				                    			<td>JUMLAH POTONGAN KOMPENSASI</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="jumlah" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="12" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>KETERANGAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="ket" maxlength="70" class="form-control" style="width:100%" ></td>
				                    		</tr>
				                    		<tr>
				                    			<td>DIAMBIL DARI</td>
				                    			<td>:</td>
				                    			<td><select class="form-control" name="metodebayar" required="" style="width:50%">
																	<option value=''>Pilih</option>
																	<option value='TUNAI'>TUNAI</option>
																	<option value='GAJI'>GAJI</option>
																	<!--
																	<option value='UANG HARIAN'>UANG HARIAN</option>
																	-->
													</select></td>
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
			if(!empty($_REQUEST[input]))
				{	
				$dPiuX = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE jenis='piutang' AND idkaryawan='$_REQUEST[idkaryawan]' GROUP BY idkaryawan"));
				$dPbyX = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE jenis='pembayaran' AND idkaryawan='$_REQUEST[idkaryawan]' GROUP BY idkaryawan"));
				
				$totpiutangX    = $dPiuX[total];
				$totpembayaranX = $dPbyX[total];
				$sisapiutangX   = $dPiuX[total]-$dPbyX[total];
				
				$jumlah			= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
				
				if($jumlah=='0')
					{
					echo "<script>alert ('JumlahTidak Boleh Nol (0).')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&idkaryawan=$_REQUEST[idkaryawan]'/>";
					exit();
					}
					
				if($jumlah > $sisapiutangX)
					{
					echo "<script>alert ('Jumlah melebihi sisa piutang.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&idkaryawan=$_REQUEST[idkaryawan]'/>";
					exit();
					}
					
				$tgl		 	= date("Y-m-d", strtotime($_REQUEST['tgl']));
				$ket			= strtoupper($_REQUEST['ket']);
				$jumlah2		= number_format($jumlah,"0","",".");
							
				$q1 = mysql_query("INSERT INTO x23_potkompensasi (
												jenis, 
												idkaryawan, 
												nama, 
												tgl, 
												jumlah, 
												ket, 
												metodebayar, 
												inputx, 
												updatex) 
											VALUES (
												'pembayaran', 
												'$_REQUEST[idkaryawan]', 
												'$_REQUEST[nama]', 
												'$tgl', 
												'$jumlah', 
												'$ket', 
												'$_REQUEST[metodebayar]', 
												NOW(), 
												'$updatex');
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_potkompensasi',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH PEMBAYARAN $_REQUEST[nama] $jumlah')
									");
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$_REQUEST[idkaryawan]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>SDM <small>POTONGAN KOMPENSASI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Riwayat Piutang</small></h4>
								
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
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
					                    			<td width="30%">POSISI</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><select class="form-control" name="posisi" readonly style="width: 50%">
																		<option value=''>Pilih</option>
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_posisi WHERE id!='1' ORDER BY posisi");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($d1[posisi]==$dA[id]){?>selected=""<?}?>><?echo $dA[posisi]?></option>
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
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TGL MULAI KERJA</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo date("d-m-Y",strtotime($d1[tglmulaikerja]))?>" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td>GAJI POKOK</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" value="<?echo number_format($d1[ugapok],"0","",".")?>" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UANG HARIAN</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" value="<?echo number_format($d1[uharian],"0","",".")?>"class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>KOMISI</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" value="<?echo number_format($d1[ukomisi],"0","",".")?>" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UANG LEMBUR</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" value="<?echo number_format($d1[ulembur],"0","",".")?>" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
							                        </td>
					                    		</tr>
			                            	</table>
										</div>
										<?
										$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE jenis='piutang' AND idkaryawan='$_REQUEST[idkaryawan]' GROUP BY idkaryawan"));
										$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_potkompensasi WHERE jenis='pembayaran' AND idkaryawan='$_REQUEST[idkaryawan]' GROUP BY idkaryawan"));
										
										$totpiutang    = $dPiu[total];
										$totpembayaran = $dPby[total];
										$sisapiutang   = $dPiu[total]-$dPby[total];
										?>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">TOTAL POTONGAN KOMPENSASI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" value="<?echo number_format($totpiutang,"0","",".")?>"class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL PEMBAYARAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" value="<?echo number_format($totpembayaran,"0","",".")?>" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>SISA POTONGAN KOMPENSASI</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" value="<?echo number_format($sisapiutang,"0","",".")?>" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
				                    		</tr>
		                            	</table>
										
										
										<div style="margin-top:20px">
					                    	<table width="100%">
					                    		<tr>
					                    			<td align="center">
						                           		<div style="float:right" class="col-xs-7">
															<a data-toggle="modal" data-target="#compose-modal-baru-pembayaran" style="cursor:pointer">
						                           				<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp; Pembayaran Baru</button>
															</a>
														</div>
									                    <table id="example2" class="table table-striped" style="width:100%"> 
								                            <thead style="cursor:pointer">
																<th class="btn-info" style="width:13%;text-align:center">TANGGAL</th>
																<th class="btn-info" style="width:15%;text-align:center">JENIS</th>
																<th class="btn-info" style="width:15%;text-align:center">JUMLAH</th>
																<th class="btn-info" style="text-align:center">KETERANGAN</th>
															</thead>
															<tbody>
								                    	<?
								                    		$qA = mysql_query("SELECT * FROM x23_potkompensasi WHERE idkaryawan='$_REQUEST[idkaryawan]' ORDER BY tgl DESC");
								                    		while($dA=mysql_fetch_array($qA))
								                    			{
								                    	?>
																<tr style="cursor:pointer">
																	<td align="center"><?echo date("d-m-Y",strtotime($dA[tgl]))?></td>
																	<td align="left"><span style="padding-left:10%"><?echo strtoupper($dA[jenis])?></span></td>
																	<td align="right"><span style="padding-right:20%"><?echo number_format($dA[jumlah],"0","",".")?></span></td>
																	<td align="left"><?echo $dA[ket]?></td>
																</tr>
														<?
																}
														?>
															</tbody>
												        </table>
													</td>
													<td width="30%"></td>
												</tr>
											</table>
				                   	 	</div>
										
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                </div>
			                </div>
			            </div>
					
<!-- ################## MODAL TAMBAH PEMBAYARAN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-pembayaran" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH PEMBAYARAN BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">TANGGAL</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="tgl" class="form-control" value="<?echo date("d-m-Y")?>" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
											</tr>
				                    		<tr>
				                    			<td>JUMLAH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="jumlah" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="12" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >KETERANGAN</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="2"><textarea name="ket" maxlength="100" class="form-control"></textarea></td>
				                    		</tr>
				                    		<tr>
				                    			<td>DIAMBIL DARI</td>
				                    			<td>:</td>
				                    			<td><select class="form-control" name="metodebayar" required="" style="width:50%">
																	<option value=''>Pilih</option>
																	<option value='TUNAI'>TUNAI</option>
																	<option value='GAJI'>GAJI</option>
																	<option value='UANG HARIAN'>UANG HARIAN</option>
													</select></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
					                    	<input type="hidden" name="idkaryawan" value="<?echo $d1[id]?>">
					                    	<input type="hidden" name="nama" value="<?echo $d1[nama]?>">
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
			        </div>
				</section>
			</aside>
<?
		}
?>
	
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		
        <script>
        //SELECT2
			$(function(){
			  var select = $('#select1').select2();
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
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
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
            //Date range as a button
                //Date range picker
                $('.reservation').daterangepicker();

        </script>