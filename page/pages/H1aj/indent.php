<script src="js/jquery.min.js"></script>	
<?
		
	if($submenu == 'batal')
		{
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=2&cn=$_REQUEST[cn]&batal='/>";
		}
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[batal]))
			{
	        $tanggal  = date("Y-m-d");
	        $bulan	  = substr($tanggal,5,2);
	        $tahun	  = substr($tanggal,1,4);
	        
			$q1 = mysql_query("UPDATE tbl_pesanan SET status='MENUNGGU KONFIRMASI',batal='$_REQUEST[oleh]',updatex='$updatex' WHERE id%2=0 AND nopesan='$_REQUEST[batal]'");
								
			$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
												idpesanan, 
												tahun, 
												bulan, 
												tanggal, 
												kasus, 
												tbl, 
												inputx) 
											VALUES (
												'$_REQUEST[id]', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'PEMBATALAN PESANAN $_REQUEST[batal] A.N $_REQUEST[nama] OLEH $_REQUEST[oleh]', 
												'tbl_pesanan', 
												NOW())
								");
								
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_pesanan',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BATAL PESANAN $_REQUEST[batal]')
								");
								
			if($_REQUEST[oleh]!="PELANGGAN"){
				$cn="1";
				}
			else{
				$cn = "0";
				}
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=batal&cn=$cn'/>";
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
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>DAFTAR INDENT</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[cn]=="1")
											{	
											$ket2 = "<p>Setelah Memperoleh Konfirmasi Dari Pihak Manajemen, Buat Kwitansi Pengembalian Uang Muka / Uang Titipan Di Kasir (Bila Ada).</p>";
											}
										else{
											$ket2 = "";
											}
										if($_REQUEST[note]=="1")
											{	
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Pembuatan Kwitansi Pelunasan Pada Bagian Kasir.</p>";
											}
										else if($_REQUEST[note]=="2")
											{	
											//$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Cek Fisik Pada Bagian Gudang & PDI.</p>";
											$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</p>";
											}
										else if($_REQUEST[note]=="3")
											{	
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Cek Fisik Pada Bagian Gudang & PDI.</p>";
											}
										else if($_REQUEST[note]=="4")
											{	
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Untuk Mencetak Kwitansi Penambahan Uang Muka/Uang Tambahan.</p>";
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
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A2"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-danger" style="width:330px"><i class="fa fa-search"></i> &nbsp; Lihat Daftar Pesanan yang Dibatalkan</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA PESAN</th>
			                                    <th style="padding:7px">TGL NOTA PESAN</th>
			                                    <th style="padding:7px" width="20%">NAMA PELANGGAN</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th width="35%" style="padding:7px">BARANG PESANAN</th>
			                                    <th style="padding:7px">KUOTA</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th width="5%" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND status='0' AND id%2=0");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS stok FROM tbl_stokunit WHERE id%2=0 AND idbarang='$d1[idbarang]' AND status='STOK'"));
											$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pesanan_vw WHERE id%2=0 AND status='0' AND nopesan='$d1[nopesan]' LIMIT 1"));
			                            	if($d1[indent]=='1')
			                            		{
												$status = "<span class='label label-success'>INDENT</span>";
			                            		}
			                            	if($d1[indent]=='0')
			                            		{
				                            	if($d2[stok]=='0'){
													$status = "<span class='label label-warning'>MENUNGGU</span>";
													}
												else{
													$status = "<span class='label label-success'>ADA</span>";
													}		
												if(!empty($d1[utitipan]) || $d1[utitipan]!='0')
													{
													$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$d1[nopesan]' AND jnskwitansi!='nopol'"));
													if(!empty($dCek2[id])){
														$cek = "1";
														$red = "";
														}
													else{
														$cek = "0";
														$red = "color:#ff0227";
														}
													}
												if(empty($d1[utitipan]) || $d1[utitipan]=='0')
													{
													$cek = "1";
													$red = "";
													}
												}
													
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo $d1[nopesan]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[notelepon]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian] | $d1[warna] | $d1[thnproduksi]"?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo number_format($d2[stok],"0","",".")?></span></td>
			                                    <td><?echo $status?></td>
			                                    <td width="1%" align="center">
			                                    	<?
			                                    	if($dCek[id] == $d1[id])
			                                    		{
			                                    	?>
				                                    	<div class="btn-group">
				                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
				                                                <span class="caret"></span>
				                                                <span class="sr-only">Actions</span>
				                                            </button>
				                                            <ul class="dropdown-menu" role="menu" style="margin-left:-150px;font-size: 12px">
				                                            <?
							                            	if($d1[indent]=='0')
							                            		{
					                            				if($d2[stok]!='0')
					                            					{
					                            					if($cek=='1')
					                            						{
				                            				?>
				                                            			<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=C&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-paste"></i>Buat Nota Penjualan</a></li>
				                                            <?
				                                            			}
				                                            		}
				                                            	}
							                            	if($d1[indent]=='1')
							                            		{
				                            				?>
				                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=C&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-paste"></i>Buat Nota Penjualan</a></li>
				                                            <?
				                                            	}
				                                            ?>
				                                            	<li><a data-toggle="modal" data-target="#compose-modal-batal<?echo $d1[nopesan]?>" style="cursor:pointer" onclick="return confirm('Anda yakin akan membatalkan pesanan?')"><i class="fa fa-times"></i>Batalkan Pemesanan</a></li>
					                                       		<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]&sm="?>" style="cursor:pointer"><i class="fa fa-search"></i>Detail Pemesanan</a></li>
				                                            		<li class="divider"></li>
				                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=utitipan&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-paperclip"></i>Uang Titipan</a></li>
					                                        		<li class="divider"></li>
				                                            	<li><a data-toggle="modal" data-target="#compose-modal-hleasing<?echo $d1[idpelanggan]?>" style="cursor:pointer"><i class="fa fa-file"></i>Riwayat Leasing</a></li>
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
			                        <table>
			                        	<tr>
			                        		<td colspan="3"><b>Keterangan</b></td>
			                        	</tr>
			                        	<tr>
			                        		<td style="color:#ff0227">Merah</td>
			                        		<td width="15px" align="center">:</td>
			                        		<td>Kwitansi Uang Muka/Titipan Belum Dicetak</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Kwitansi Uang Muka/Titipan Sudah Dicetak Atau Tidak Perlu Dicetak</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
			            
	                    <?
							$q2 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND status='0'");
		                    while($d2 = mysql_fetch_array($q2))
		                    	{
								$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE id%2=0 AND nopesan='$d2[nopesan]'"));
		                ?>
								<!-- ################## MODAL RIWAYAT LEASING ########################################################################################## -->
						        <div class="modal fade " id="compose-modal-hleasing<?echo $d2[idpelanggan]?>" tabindex="-1" role="dialog" aria-hidden="true">
						            <div class="modal-dialog" style="width:70%;">
						                <div class="modal-content">
						                    <div class="modal-header">
						                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                        <h4 class="modal-title">BUAT NOTA PELANGGAN LAMA</h4>
						                    </div>
						                    
					                        <div class="modal-body" style="overflow-x:hidden;overflow-y:auto;height:450px;">
												<table class="table table-striped" >
													<thead>
						                                <tr>
						                                    <th width="">TANGGAL</th>
						                                    <th width="">KODE LEASING</th>
						                                    <th width="">NAMA LEASING</th>
						                                    <th width="">UNIT</th>
						                                    <th width="">STATUS</th>
						                                </tr>
						                       		</thead>
						                       		<tbody>
						                            <?
						                            $no = 1;
						                            $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id%2=0 AND id_pelanggan='$d2[idpelanggan]' ORDER BY tanggal DESC");
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
								
								<!-- ################## MODAL BATAL PESANAN ########################################################################################## -->
						        <div class="modal fade " id="compose-modal-batal<?echo $d2[nopesan]?>" tabindex="-1" role="dialog" aria-hidden="true">
						            <div class="modal-dialog" style="width:45%;">
						                <div class="modal-content">
						                    <div class="modal-header">
						                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                        <h4 class="modal-title">PEMBATALAN PEMESANAN</h4>
						                    </div>
						                    
						                   	<form method="post" action="" enctype="multipart/form-data">
					                        <div class="modal-body">
						                    	<table width="90%">
						                    		<tr>
						                    			<td width="40%">DIBATALKAN OLEH</td>
						                    			<td width="2%">:</td>
						                    			<td><select class="form-control" name="oleh" required="">
																			<option value=''>Pilih</option>
																			<?if($d2[jnstransaksi]=="KREDIT" OR ($d2[jnstransaksi]=="CASH TEMPO" AND $d2[jnscashtempo]=="LEASING")){?>
																				<option value='LEASING'>LEASING</option>
																			<?}?>
																			<option value='DEALER'>DEALER</option>
																			<option value='PELANGGAN'>PELANGGAN</option>
															</select></td>
						                    		</tr>
							                    	<input type="hidden" name="batal" value="<?echo $d2[nopesan]?>">
							                    	<input type="hidden" name="nama" value="<?echo $d2[nama]?>">
							                    	<input type="hidden" name="id" value="<?echo $d3[id]?>">
				                            	</table>
						               		</div>
					                        <div class="modal-footer clearfix">
					                            <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Reset</button>
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
		
	else if($submenu == 'A2')
		{
		if(!empty($_REQUEST[del]))
			{
			$q1 = mysql_query("DELETE FROM tbl_pesanan_vw WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
			$q2 = mysql_query("DELETE FROM tbl_pesanan WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_pesanan',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'HAPUS PESANAN $_REQUEST[nopesan]')
								");
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
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT YANG DIBATALKAN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA / NAMA / TANGGAL ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info" style="width:330px"><i class="fa fa-search"></i> &nbsp; Lihat Daftar Pesanan yang Aktif</button>
										</a>
	                           		</div>
									<table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA PESAN</th>
			                                    <th style="padding:7px">TGL NOTA PESAN</th>
			                                    <th style="padding:7px" width="23%">NAMA PELANGGAN</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th style="padding:7px">BARANG PESANAN</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th style="padding:7px">PIHAK PEMBATAL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND status IN ('BATAL','MENUNGGU KONFIRMASI') AND nama LIKE '%$_REQUEST[cari]%' OR nopesan LIKE '%$_REQUEST[cari]%' OR tglpesan LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND status IN ('BATAL','MENUNGGU KONFIRMASI') ORDER BY id DESC LIMIT 0,20");
											}
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=='BATAL'){$status = "<span class='label label-danger'>BATAL</span>";}
			                            	if($d1[status]=='MENUNGGU KONFIRMASI'){$status = "<span class='label label-warning'>MENUNGGU</span>";}
											
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B2&id=$d1[id]&sm=2"?>'">
			                                    <td><?echo $d1[nopesan]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[notelepon]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian] | $d1[warna] | $d1[thnproduksi]"?></td>
			                                    <td><?echo $status?></td>
			                                    <td><?echo $d1[batal]?></td>
			                                    <!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-150px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=B2&id=$d1[id]&sm=2"?>" style="cursor:pointer"><i class="fa fa-search"></i>Detail Pemesanan</a></li>
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-hleasing<?echo $d1[idpelanggan]?>" style="cursor:pointer"><i class="fa fa-file"></i>Riwayat Leasing</a></li>
				                                            	<li class="divider"></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=1&nopesan=$d1[nopesan]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>	
			                                    -->    
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
							$q2 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND status='0'");
		                    while($d2 = mysql_fetch_array($q2))
		                    	{
		                ?>
								<!-- ################## MODAL RIWAYAT LEASING ########################################################################################## -->
						        <div class="modal fade " id="compose-modal-hleasing<?echo $d2[idpelanggan]?>" tabindex="-1" role="dialog" aria-hidden="true">
						            <div class="modal-dialog" style="width:55%;">
						                <div class="modal-content">
						                    <div class="modal-header">
						                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                        <h4 class="modal-title">BUAT NOTA PELANGGAN LAMA</h4>
						                    </div>
						                    
					                        <div class="modal-body" style="overflow-x:hidden;overflow-y:auto;height:450px;">
												<table class="table table-striped" >
													<thead>
						                                <tr>
						                                    <th width="">TANGGAL</th>
						                                    <th width="">KODE LEASING<th>
						                                    <th width="">NAMA LEASING</th>
						                                    <th width="">STATUS</th>
						                                </tr>
						                       		</thead>
						                       		<tbody>
						                            <?
						                            $no = 1;
						                            $q1 = mysql_query("SELECT * FROM tbl_hleasing_vw WHERE id%2=0 AND id_pelanggan='$d2[idpelanggan]' ORDER BY tanggal DESC");
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
		
	else if($submenu == 'B')
		{
		if(!empty($_REQUEST[deltemp]))
			{
			mysql_query("DELETE FROM tbl_pesanan_det WHERE id%2=0 AND id='$_REQUEST[deltemp]'");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]&sm='/>";
			}
		if(!empty($_REQUEST[transaksi]))
			{
			$utitipan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipan']);
			
    		if($_REQUEST[jnstransaksi]!='CASH TEMPO'){
    			$tglpelunasan = "0000-00-00";
    			}
    		if($_REQUEST[jnstransaksi]=='CASH TEMPO'){
    			if($_REQUEST[jnscashtempo]=="DEALER"){
					$tglpelunasan = date("Y-m-d",strtotime($_REQUEST[tglpelunasan]));
					}
    			else{
					$tglpelunasan = "0000-00-00";
					}
    			}
			
			mysql_query("UPDATE tbl_pesanan SET jnstransaksi='$_REQUEST[jnstransaksi]',tglpelunasan='$tglpelunasan',jnscashtempo='$_REQUEST[jnscashtempo]',idleasing='$_REQUEST[idleasing]',idleasing='$_REQUEST[idleasing]',utitipan='$utitipan',termin='$_REQUEST[termin]' WHERE id%2=0 AND nopesan='$_REQUEST[transaksi]'");
			}
			
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
		
		if(!empty($_REQUEST[temp]))
			{
			mysql_query("INSERT INTO tbl_pesanan_det (nopesan,idpelanggan,idbarang) VALUES ('$_REQUEST[temp]','$dA[idpelanggan]','$_REQUEST[idbarang]')");
			} 
?>

			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/notapemesanan.php?nopesan=<?echo $dA[nopesan]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT</small></h4>
			                	
					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nopesan" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
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
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">DATA BPKB</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" name="rt" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
			                            	</table>
			                            </div>
			                            
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%" valign="top">PESAN NOPOL</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
				                    		</tr>
		                            	</table>
				                    	
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	<?
			                            	$dQ = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' GROUP BY nopesan"));
			                            	$qTemp = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'");
			                            	?>
					                    	<table width="70%">
											
					                    		<tr>
					                    			<td width="30%">BARANG</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="3">
													<!--<button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-warning" data-toggle="modal" data-target="#compose-modal-pilihbarang"><i class="fa fa-plus"></i> &nbsp; Pilih Barang</button>-->
														
													</td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="6"></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td colspan="3" style="background: #eee;padding: 0 10px"></td>
					                    		</tr>
					                    	<?
					                    	while($dB = mysql_fetch_array($qTemp))
					                    		{
					                    		$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dB[idbarang]'"))
					                    	?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td colspan="2" style="background: #eee;padding: 0 10px"><?echo "$dBrg[kodebarang] | $dBrg[namabarang] | $dBrg[varian] | $dBrg[warna]"?></td>
													<?
													if($dQ[total]!=1)
														{
													?>
						                    			<td width="5%" style="background: #eee;border-left:1px solid #f5f5f5" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deltemp=$dB[id]&id=$_REQUEST[id]"?>"><i class="fa fa-trash-o"></i></a></td>
						                    		<?
														}
													?>
												</tr>
					                    	<?
					                    		}
					                    	?>
					                    		<tr>
					                    			<td colspan="3"></td>
					                    			<td colspan="2" style="background: #eee;padding: 0 10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="5"></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KUANTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="3"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TNKB</td>
					                    			<td>:</td>
					                    			<td colspan="3"><input type="text" name="tnkb" value="<?echo $dA[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="5"></td>
					                    		</tr>
												
					                    		<tr>
					                    			<td>TRANSAKSI</td>
					                    			<td>:</td>
					                    			<td style="background: #eee;padding: 10px 0 0 10px;width: 15%">JENIS</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
					                    		</tr>
					                    		<?
					                    		if($dA[jnstransaksi]=='KREDIT')
					                    			{
												?>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
						                    		</tr>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
						                    		</tr>
							                    	<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
												<?
													}
													
					                    		if($dA[jnstransaksi]=='CASH TEMPO')
					                    			{
					                    		?>
					                    		<?
						                    		if($dA[jnscashtempo]=='LEASING')
						                    			{
														$jnscashtempoX = "LEASING";
												?>
														<tr>
															<td colspan="2"></td>
															<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMPO</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$jnscashtempoX"?></td>
														</tr>
							                    		<tr>
							                    			<td colspan="2"></td>
							                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
							                    		</tr>
							                    		<tr>
							                    			<td colspan="2"></td>
							                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
							                    		</tr>
							                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
												<?
														}
														
						                    		else if($dA[jnscashtempo]=='DEALER')
						                    			{
														$jnscashtempoX = "DEALER";
												?>
														<tr>
															<td colspan="2"></td>
															<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMPO</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$jnscashtempoX"?></td>
														</tr>
							                    		<tr>
							                    			<td colspan="2"></td>
							                    			<td style="background: #eee;padding: 0 0 0 10px">TANGGAL PELUNASAN</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo date("d-m-Y",strtotime($dA[tglpelunasan]))?></td>
							                    		</tr>
							                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
												<?
														}
													}
					                    		?>
					                    		<tr><td colspan="4"></td></tr>
												
					                    		<tr>
					                    			<td>UANG MUKA/TITIPAN</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    			<td><!--
													<button type="button"data-toggle="modal" data-target="#compose-modal-transaksi" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-warning"><i class="fa fa-edit"></i> &nbsp; Ubah Detail Transaksi</button>-->
														
													</td>
					                    		</tr>
												<?
												$dCek = mysql_fetch_array(mysql_query("SELECT status FROM tbl_kwitansi WHERE id%2=0 AND nomor='$dA[nopesan]' AND jnskwitansi IN ('umuka','titip')"));
												if(empty($dCek[status])){
													$sum = "BELUM TERBAYAR";
													}
												if($dCek[status]=="1"){
													$sum = "TERBAYAR";
													}
												?>
												<tr><td style="heigt:30px"></td></tr>
					                    		<tr>
					                    			<td>STATUS UANG MUKA/TITIPAN</td>
					                    			<td>:</td>
					                    			<td width="25%"><?echo $sum?></td>
					                    			<td></td>
					                    		</tr>
					                    		<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
					                    		<input type="hidden" name="tahun" value="<?echo $p_tahun?>">
					                    		<input type="hidden" name="bulan" value="<?echo $p_bulan?>">
					                    	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Pemesanan</button>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A$_REQUEST[sm]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
																			while($dX=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dX[id]?>'><?echo "$dX[kodebarang] | $dX[namabarang] | $dX[varian] | $dX[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="temp" value="<?echo $dA[nopesan]?>">
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
					
<!-- ################## MODAL TRANSAKSI ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL TRANSAKSI</h4>
				                    </div>
									
									<script>
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
											}else{
											document.inputpelanggan.idleasing.disabled = 1;
											document.inputpelanggan.termin.disabled = 1;
											document.inputpelanggan.jnscashtempo.disabled = 1;
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
				                   	<form name="inputpelanggan" method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table>
				                    		<tr>
				                    			<td width="35%">JENIS TRANSAKSI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="3"><select name="jnstransaksi" class="form-control" style="width: 60%" onchange="populateSelectA(this.value)" required="">
													<option value='KREDIT' <?if($dA[jnstransaksi]=='KREDIT'){?>selected=""<?}?>>KREDIT</option>
													<option value='CASH TEMPO' <?if($dA[jnstransaksi]=='CASH TEMPO'){?>selected=""<?}?>>CASH TEMPO</option>
													<option value='CASH' <?if($dA[jnstransaksi]=='CASH'){?>selected=""<?}?>>CASH</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>CASH TEMPO</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select name="jnscashtempo" class="form-control" style="width: 40%" onchange="populateSelectB(this.value)" <?if($dA[jnstransaksi]!='CASH TEMPO'){?> disabled="" <?}?>>
													<option value='' >Pilih</option>
													<option value='DEALER' <?if($dA[jnscashtempo]=='DEALER'){?>selected=""<?}?>>DEALER</option>
													<option value='LEASING' <?if($dA[jnscashtempo]=='LEASING'){?>selected=""<?}?>>LEASING</option>
													</select></td>
				                    		</tr>
				                    		<?
				                    		if($dA[jnstransaksi]!='CASH TEMPO'){
				                    			$tglpelunasan = "";
				                    			}
				                    		if($dA[jnstransaksi]=='CASH TEMPO'){
				                    			if($dA[jnscashtempo]=="DEALER"){
													$tglpelunasan = date("d-m-Y",strtotime($dA[tglpelunasan]));
													}
				                    			else{
													$tglpelunasan = "";
													}
				                    			}
				                    		?>
				                    		<tr>
				                    			<td>TANGGAL PELUNASAN</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tglpelunasan" value="<?echo $tglpelunasan?>" class="form-control" style="width: 30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask <?if($dA[jnscashtempo]!='DEALER'){?> disabled="" <?}?>></td>
				                    		</tr>
				                    		<tr>
				                    			<td>LEASING</td>
				                    			<td>:</td>
				                    			<td colspan="3"><select name="idleasing" class="form-control" style="width: 100%" <?if($dA[jnstransaksi]=='CASH'){?> disabled="" <?}if($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=="DEALER"){?> disabled="" <?}?>>
													<option value='' selected="">Pilih Leasing</option>
													<?
														$q = mysql_query('SELECT * FROM tbl_leasing ORDER BY namaleasing');
														while ($data = mysql_fetch_array($q)){
													?>
														<option value="<?echo $data[id]?>" <?if($dA[idleasing]==$data[id]){?>selected=""<?}?>><?echo $data[namaleasing]?></option>
													<?
														}
													?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>MASA ANGSURAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <input type="text" name="termin" class="form-control" style="width:100%;text-align:right;" value="<?echo $dA[termin]?>" onkeypress="return buat_angka(event,'0123456789')" <?if($dA[jnstransaksi]=='CASH'){?>disabled=""<?}?>>
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
				                                        <input type="text" name="utitipan" class="form-control uang" value="<?echo number_format($dA[utitipan],"0","",".")?>" style="width:54%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')">
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="transaksi" value="<?echo $dA[nopesan]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
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
		
	else if($submenu == 'B2')
		{
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT</small></h4>
			                	
					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nopesan" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
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
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">DATA BPKB</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" name="rt" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
			                            	</table>
			                            </div>
			                            
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%" valign="top">PESAN NOPOL</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
				                    		</tr>
		                            	</table>
				                    	
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	<?
			                            	$dQ = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' GROUP BY nopesan"));
			                            	$qTemp = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'");
			                            	?>
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">BARANG</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="3" style="background: #eee;padding: 0 10px"></td>
					                    		</tr>
					                    	<?
					                    	while($dB = mysql_fetch_array($qTemp))
					                    		{
					                    		$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dB[idbarang]'"))
					                    	?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td colspan="2" style="background: #eee;padding: 0 10px"><?echo "$dBrg[kodebarang] | $dBrg[namabarang] | $dBrg[varian] | $dBrg[warna]"?></td>
													<?
													if($dQ[total]!=1)
														{
													?>
						                    			<td width="5%" style="background: #eee;border-left:1px solid #f5f5f5" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&deltemp=$dB[id]&id=$_REQUEST[id]"?>"><i class="fa fa-trash-o"></i></a></td>
						                    		<?
														}
													?>
												</tr>
					                    	<?
					                    		}
					                    	?>
					                    		<tr>
					                    			<td colspan="3"></td>
					                    			<td colspan="2" style="background: #eee;padding: 0 10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="5"></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KUANTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="3"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TNKB</td>
					                    			<td>:</td>
					                    			<td colspan="3"><input type="text" name="tnkb" value="<?echo $dA[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="5"></td>
					                    		</tr>
												
					                    		<tr>
					                    			<td>TRANSAKSI</td>
					                    			<td>:</td>
					                    			<td style="background: #eee;padding: 10px 0 0 10px;width: 15%">JENIS</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
					                    		</tr>
					                    		<?
					                    		if($dA[jnstransaksi]!='CASH')
					                    			{
												?>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
						                    		</tr>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
						                    		</tr>
												<?
													}
					                    		?>
					                    		<tr><td colspan="4"></td></tr>
												
					                    		<tr>
					                    			<td>UANG MUKA/TITIPAN</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    			<td></td>
					                    		</tr>
					                    		<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
					                    		<input type="hidden" name="tahun" value="<?echo $p_tahun?>">
					                    		<input type="hidden" name="bulan" value="<?echo $p_bulan?>">
					                    	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A$_REQUEST[sm]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNJ = mysql_fetch_array(mysql_query("SELECT nonota FROM tbl_notajual WHERE id%2=0 AND tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
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
			
			$nonota = "NJ1$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		if(!empty($_REQUEST[temp]))
			{
			$otr  	= preg_replace( "/[^0-9]/", "",$_REQUEST['otr']);
			$disc  	= preg_replace( "/[^0-9]/", "",$_REQUEST['disc']); 
			$ppn    = ROUND((($otr-$disc)*10)/100);
			
				//echo "<script>alert ('$dA[utitipan].$otr')</script>";
				//exit();
			
			if($dA[utitipan] > $otr){
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena OTR Lebih Kecil Dari Uang Muka/Titipan.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&id=$_REQUEST[id]&sm='/>";
				exit();
				}
				
			if($otr <= $disc){
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Potongan Melebihi Atau Sama Dengan OTR.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&id=$_REQUEST[id]&sm='/>";
				exit();
				}
			
			/*
			if($dA[jnstransaksi]=='CASH')
				{
				if($dA[utitipan] < $disc){
					echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Potongan Melebihi Uang Muka/Titipan.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&id=$_REQUEST[id]&sm='/>";
					exit();
					}
				}
			*/
			
				$dC1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$_REQUEST[norangka]'"));
				$ppnbeli 	= $dC1[ppn];
				$hargabeli 	= $dC1[hargabelibersih];
				$jual_plus_ppnbeli   = $otr-$disc+$ppnbeli;
				$ppnjual_min_ppnbeli = $ppn-$ppnbeli;
				$jumlah1 = $jual_plus_ppnbeli-$hargabeli-$ppnjual_min_ppnbeli-$ppnbeli;
				$otrsetelahpajak = $otr-$disc-$ppn;
				
				mysql_query("UPDATE tbl_pesanan_det SET 
											norangka='$_REQUEST[norangka]',
											otr='$otr',
											disc='$disc',
											ppnjual='$ppn',
											hargabeli='$hargabeli',
											ppnbeli='$ppnbeli',
											jual_plus_ppnbeli='$jual_plus_ppnbeli',
											ppnjual_min_ppnbeli='$ppnjual_min_ppnbeli',
											jumlah1='$jumlah1',
											otrsetelahpajak='$otrsetelahpajak'
											WHERE id%2=0 AND id='$_REQUEST[temp]'");
			
			}
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT <?//echo $_REQUEST[id]?></small></h4>
			                	
					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $nonota?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text"  value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">DATA BPKB</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
			                            </div>
			                            
				                    	
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' GROUP BY nopesan"));
		                            	$dHB = mysql_fetch_array(mysql_query("SELECT SUM(hargabelibersih) AS total FROM tbl_stokunit WHERE id%2=0 AND norangka IN (SELECT norangka FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]')"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_pesanan_det_vw WHERE id%2=0 AND nopesan='$dA[nopesan]'");
		                            	?>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TNKB</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tnkb" value="<?echo $dA[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding: 0 10px;height:5px"></td>
				                    		</tr>
				                    	<?
				                    	while($dTemp = mysql_fetch_array($qTemp))
				                    		{
				                    	?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">KODE BARANG</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dTemp[kodebarang]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">NAMA BARANG</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dTemp[namabarang]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">VARIAN</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dTemp[varian]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">WARNA</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dTemp[warna]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">TAHUN</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dTemp[thnproduksi]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;"><hr style="border-bottom:1px #f5f5f5 dashed;margin: 5px 10px"></td>
				                    		</tr>
				                    	<?
				                    		}
				                    	?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding: 0 10px;height:5px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
				                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>TRANSAKSI</td>
				                    			<td>:</td>
				                    			<td style="background: #eee;padding: 0 10px">JENIS</td><td style="background: #eee;padding: 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
				                    		</tr>
			                    		<?
			                    		if($dA[jnstransaksi]=='KREDIT')
			                    			{
										?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
				                    		</tr>
					                    	<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
										<?
											}
											
			                    		if($dA[jnstransaksi]=='CASH TEMPO')
			                    			{
			                    		?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMPO</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$dA[jnscashtempo]"?></td>
				                    		</tr>
			                    		<?
				                    		if($dA[jnscashtempo]=='LEASING')
				                    			{
										?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
					                    		</tr>
										<?
												}
												
				                    		else if($dA[jnscashtempo]=='DEALER')
				                    			{
										?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">TANGGAL PELUNASAN</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo date("d-m-Y",strtotime($dA[tglpelunasan]))?></td>
					                    		</tr>
					                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
										<?
												}
											}
			                    		?>
			                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="utitipan" id="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
				                    		</tr>
				                    	</table>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            	<?
		                            	$dQ = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' GROUP BY nopesan"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'");
		                            	$qTemp2 = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'");
		                            	?>
										<table id="example2" class="table table-striped" width="100%">
				                            <thead>
				                                <tr>
					                    			<th>KODE BARANG</th>
					                    			<th>NOMOR RANGKA</th>
					                    			<th>OTR</th>
					                    			<th>POTONGAN</th>
					                    		</tr>
					                    	</thead>
			                            	<tbody>
					                    	<?
					                    	while($dTemp = mysql_fetch_array($qTemp))
					                    		{
					                    		$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"))
					                    	?>
					                    		<tr>
					                    			<td><?echo $dBrg[kodebarang]?></td>
					                    			<?
					                    			if(empty($dTemp[norangka]) AND empty($dTemp[otr]))
					                    				{
													?>
														<td><button type="button" style="padding-top:0px;padding-bottom:0px" class="btn btn-warning" data-toggle="modal" data-target="#compose-modal-pilihnoka<?echo $dTemp[id]?>"><i class="fa fa-plus"></i> &nbsp; Pilih Nomor Rangka</button></td>
														<td></td>
														<td></td>
													<?
														}
					                    			if(!empty($dTemp[norangka]) AND empty($dTemp[otr]))
														{
													?>
														<td><?echo $dTemp[norangka]?></td>
														<td><button type="button" style="padding-top:0px;padding-bottom:0px" class="btn btn-warning" data-toggle="modal" data-target="#compose-modal-otr<?echo $dTemp[id]?>"><i class="fa fa-plus"></i> &nbsp; Input OTR & Potongan</button></td>
														<td></td>
					                    			<?
														}
					                    			if(!empty($dTemp[norangka]) AND !empty($dTemp[otr]))
														{
													?>
														<td><?echo $dTemp[norangka]?></td>
														<td align="right" width="15%"><span style="padding-right:25%"><?echo number_format($dTemp[otr],"0","",".")?></span></td>
														<td align="right" width="15%"><span style="padding-right:25%"><?echo number_format($dTemp[disc],"0","",".")?></span></td>
					                    			<?
														}
					                    			?>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
				                    		</tbody>
				                    	</table>
				                    	<input type="hidden" name="id" value="<?echo $dA[id]?>"/>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=back1&nopesan=$dA[nopesan]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
				                	</div>
				                </form>
			                	</div>
			                </div>
					
                    	<?
                    	while($dTemp2 = mysql_fetch_array($qTemp2))
                    		{
                    	?>
<!-- ################## MODAL PILIH NOKA ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-pilihnoka<?echo $dTemp2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH NOMOR RANGKA</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NOMOR RANGKA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="norangka" class="form-control" id="select<?echo $dTemp2[id]?>" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND idbarang='$dTemp2[idbarang]' AND status='STOK' AND norangka NOT IN (SELECT norangka FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]')");
																			while($d1=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $d1[norangka]?>"><?echo "$d1[norangka] | $d1[nomesin]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>OTR</td>
				                    			<td>:</td>
				                    			<td><div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        	<input type="text" name="otr" placeholder="0"  style="width:30%;text-align:right" class="form-control otr" onkeypress="return buat_angka(event,'1234567890')"  required> 
				                                    </div>                                        		
				                                </td>
				                    		</tr>
				                    		<tr>
				                    			<td>POTONGAN</td>
				                    			<td>:</td>
				                    			<td><div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        	<input type="text" name="disc"  placeholder="0" style="width:30%;text-align:right" class="form-control disc" onkeypress="return buat_angka(event,'1234567890')" > 
				                                    </div>                                        		
				                                </td>
				                    		</tr>
					                    	<input type="hidden" name="temp" value="<?echo $dTemp2[id]?>">
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
				        <script>
							$(function(){
							           
							  var select = $('#select<?echo $dTemp2[id]?>').select2();
							});
							$(document).ready(function() {});
						</script>
<!-- ################################################################################################################################# -->
<!-- ################## MODAL OTR #################################################################################################### -->
				        <div class="modal fade " id="compose-modal-otr<?echo $dTemp2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">INPUT OTR & POTONGAN</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">OTR</td>
				                    			<td width="2%">:</td>
				                    			<td><div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        	<input type="text" name="otr" placeholder="0"  style="width:50%;text-align:right" class="form-control otr" onkeypress="return buat_angka(event,'1234567890')"  required> 
				                                    </div>                                        		
				                                </td>
				                    		</tr>
				                    		<tr>
				                    			<td>POTONGAN</td>
				                    			<td>:</td>
				                    			<td><div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        	<input type="text" name="disc"  placeholder="0" style="width:50%;text-align:right" class="form-control disc" onkeypress="return buat_angka(event,'1234567890')" > 
				                                    </div>                                        		
				                                </td>
				                    		</tr>
					                    	<input type="hidden" name="norangka" value="<?echo $dTemp2[norangka]?>">
					                    	<input type="hidden" name="temp" value="<?echo $dTemp2[id]?>">
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'back1')
		{
		mysql_query("UPDATE tbl_pesanan_det SET norangka='',otr='',disc='',disc='',hargabeli='',ppnbeli='' WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		}
		
	else if($submenu == 'D')
		{
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' AND norangka=''"));
		if(!empty($dCek[id]))
			{
			echo "<script>alert ('Lengkapi nomor rangka tiap pesanan.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&id=$_REQUEST[id]'/>";
			exit();
			}
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT</small></h4>
			                	
					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $_REQUEST[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nopesan" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text"  value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">DATA BPKB</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
			                            </div>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]' GROUP BY nopesan"));
		                            	$dHB = mysql_fetch_array(mysql_query("SELECT SUM(hargabelibersih) AS total,SUM(ppn) AS ppnbeli FROM tbl_stokunit WHERE id%2=0 AND norangka IN (SELECT norangka FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]')"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'");
		                            	?>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TNKB</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="tnkb" value="<?echo $dA[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding: 0 10px;height:5px"></td>
				                    		</tr>
				                    	<?
				                    	while($dTemp = mysql_fetch_array($qTemp))
				                    		{
											$d4   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
				                    	?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td width="30%" style="background: #eee;padding: 0 10px">NOMOR RANGKA</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $d4[norangka]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">NOMOR MESIN</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $d4[nomesin]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">KODE BARANG</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dA[kodebarang]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">NAMA BARANG</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dA[namabarang]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">VARIAN</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dA[varian]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">WARNA</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dA[warna]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">TAHUN</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": $dA[tahun]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">OTR</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": RP. ".number_format($dTemp[otr],"0","",".")?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">POTONGAN</td>
				                    			<td style="background: #eee;padding: 0 10px"><?echo ": RP. ".number_format($dTemp[disc],"0","",".")?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;"><hr style="border-bottom:1px #f5f5f5 dashed;margin: 5px 10px"></td>
				                    		</tr>
				                    	<?
				                    		}
				                    	?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding: 0 10px;height:5px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
				                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>TRANSAKSI</td>
				                    			<td>:</td>
				                    			<td style="background: #eee;padding: 0 10px">JENIS</td><td style="background: #eee;padding: 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
				                    		</tr>
				                    		<?
				                    		if($dA[jnstransaksi]=='KREDIT')
				                    			{
				                    		?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">LEASING</td><td style="background: #eee;padding: 0 10px">: <?echo "$d3[namaleasing]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 10px">: <?echo "$dA[termin]"?></td>
				                    		</tr>
				                    		<?
				                    			}
													
				                    		if($dA[jnstransaksi]=='CASH TEMPO')
				                    			{
				                    		?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMPO</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$dA[jnscashtempo]"?></td>
					                    		</tr>
				                    		<?
					                    		if($dA[jnscashtempo]=='LEASING')
					                    			{
											?>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
						                    		</tr>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
						                    		</tr>
											<?
													}
													
					                    		else if($dA[jnscashtempo]=='DEALER')
					                    			{
											?>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 0 10px">TANGGAL PELUNASAN</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo date("d-m-Y",strtotime($dA[tglpelunasan]))?></td>
						                    		</tr>
						                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
											<?
													}
												}
				                    		?>
				                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="utitipan" id="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
				                    		</tr>
				                    		<?
				                    		$dTot = mysql_fetch_array(mysql_query("SELECT SUM(otr) AS totr,SUM(disc) AS tdisc FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
				                    		$gt  = $dTot[totr] - $dTot[tdisc] ;
				                    		$ppn = 	ROUND(($gt*10)/100);	
				                    		
				                    		$tbayar = $gt + $ppn - $dA[utitipan] ;
				                    		?>
				                    		<tr>
				                    			<td>TOTAL OTR</td>
				                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="totr" id="totr" value="<?echo number_format($dTot[totr],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL POTONGAN</td>
				                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="tdisc" id="tdisc" value="<?echo number_format($dTot[tdisc],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
				                    		</tr>
				                    		<?
				                    		if($dA[jnstransaksi]!='KREDIT')
				                    			{
					                    		if($dA[jnstransaksi]=='CASH TEMPO')
					                    			{
						                    		if($dA[jnscashtempo]=='DEALER')
						                    			{
				                    		?>
							                    		<tr>
							                    			<td>GRAND TOTAL + PPN</td>
							                    			<td>:</td>
							                    			<td colspan="2">
							                                    <div class="input-group">
							                                        <span class="input-group-addon">RP.</span>
							                                        <input type="text" name="" id="bayar" class="form-control" value="<?echo number_format($ppn+$gt,"0","",".")?>" style="width:34%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
							                                    </div>
									                        </td>
							                    		</tr>
					                    	<?
														}
													}
													
					                    		else if($dA[jnstransaksi]=='CASH')
					                    			{
				                    		?>
						                    		<tr>
						                    			<td>GRAND TOTAL + PPN</td>
						                    			<td>:</td>
						                    			<td colspan="2">
						                                    <div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="" id="bayar" class="form-control" value="<?echo number_format($ppn+$gt,"0","",".")?>" style="width:34%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
						                                    </div>
								                        </td>
						                    		</tr>
						                    		<tr>
						                    			<td>TOTAL BAYAR</td>
						                    			<td>:</td>
							                    			<td colspan="2">
							                                    <div class="input-group">
							                                        <span class="input-group-addon">RP.</span>
							                                        <input type="text" name="tbayar" id="tbayar" value="<?echo number_format($tbayar,"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
							                                    </div>
									                        </td>
						                    		</tr>
					                    	<?
													}
				                    		?>
											<?
												}
											?>
				                    	</table>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<!--
				                    		<tr>
				                    			<td width="30%">HARGA JUAL</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargajual" id="hargajual" value="0" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>DISKON</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="diskon" id="diskon" class="form-control" value="0" style="width:34%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		-->
				                    		<?
				                    		if($dA[jnstransaksi]=='CASH')
				                    			{
				                    		?>
					                    		<tr>
					                    			<td>BAYAR</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="bayar" id="bayar" class="form-control" value="<?echo number_format($tbayar,"0","",".")?>" style="width:34%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">SISA PEMBAYARAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="sisabayar" id="sisabayar" value="<?echo number_format($tbayar,"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    		
				                    		else if($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='DEALER')
				                    			{
				                    		?>
					                    		<tr>
					                    			<td width="30%">SISA PEMBAYARAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="sisabayar" id="sisabayar" value="<?echo number_format($tbayar,"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
				                    	</table>
				                    	
				                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                    	<input type="hidden" name="idpelanggan" value="<?echo $dA[idpelanggan]?>"/>
				                    	<input type="hidden" name="jnstransaksi" value="<?echo $dA[jnstransaksi]?>"/>
				                    	<input type="hidden" name="idleasing" value="<?echo $dA[idleasing]?>"/>
				                    	<input type="hidden" name="termin" value="<?echo $dA[termin]?>"/>
				                    	<input type="hidden" name="sisabayarX" value="<?echo $tbayar?>"/>
				                    	<input type="hidden" name="idsales" value="<?echo $dA[idsales]?>"/>
				                    	<input type="hidden" name="jnscashtempo" value="<?echo $dA[jnscashtempo]?>"/>
				                    	<input type="hidden" name="tglpelunsan" value="<?echo $dA[tglpelunsan]?>"/>
				                    	
				                    	<input type="hidden" name="hargabelibersih" value="<?echo $dHB[total]?>"/>
				                    	<input type="hidden" name="ppn" value="<?echo $ppn?>"/>
				                    	<input type="hidden" name="ppnbeli" value="<?echo $dHB[ppnbeli]?>"/>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&id=$_REQUEST[id]"?>'" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="submit" class="btn btn-info pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
				                </form>
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			
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
			$('#bayar').on('keypress', function(e) {
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
	        <script type="text/javascript">
			    $("#bayar").keyup(function(){
			        var tbayar  = $("#tbayar").val().replace(".","").replace(".","");
			        var bayar   = $("#bayar").val().replace(".","").replace(".","");
			        var sisabayar  = eval(tbayar - bayar);
			        $("#sisabayar").val(formatAngka(sisabayar));
			      });
	        </script>
	        <!--
	        <script type="text/javascript">
			    $("#hargajual").keyup(function(){
			        var utitipan  = $("#utitipan").val().replace(".","").replace(".","");
			        var hargajual = $("#hargajual").val().replace(".","").replace(".","");
			        var total     = eval(hargajual - utitipan);
			        
			        $("#sisabayar").val(formatAngka(total));
			      });
			      
			    $("#diskon").keyup(function(){
			        var utitipan  = $("#utitipan").val().replace(".","").replace(".","");
			        var hargajual = $("#hargajual").val().replace(".","").replace(".","");
			        var total     = eval(hargajual - utitipan);
			        
			        var diskon    = $("#diskon").val().replace(".","").replace(".","");
			        var sisabayar  = eval(total - diskon);
			        $("#sisabayar").val(formatAngka(sisabayar));
			      });
			      
			    $("#bayar").keyup(function(){
			        var utitipan  = $("#utitipan").val().replace(".","").replace(".","");
			        var hargajual = $("#hargajual").val().replace(".","").replace(".","");
			        var total     = eval(hargajual - utitipan);
			        
			        var diskon    = $("#diskon").val().replace(".","").replace(".","");
			        var sisabayar1  = eval(total - diskon);
			        
			        var bayar    = $("#bayar").val().replace(".","").replace(".","");
			        var sisabayar2  = eval(sisabayar1 - bayar);
			        $("#sisabayar").val(formatAngka(sisabayar2));
			      });
	        </script>
	        -->
<?
		}
		
	else if($submenu == 'save')
		{	
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
		$utitipan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipan']);
		$sisabayar 	= preg_replace( "/[^0-9]/", "",$_REQUEST['sisabayar']);
		$bayar 		= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
		$totr 		= preg_replace( "/[^0-9]/", "",$_REQUEST['totr']);
		$tdisc 		= preg_replace( "/[^0-9]/", "",$_REQUEST['tdisc']);
		
		//$laba		= $totr - $tdisc - $_REQUEST[hargabelibersih];
		
		if($_REQUEST[sisabayarX] < $bayar)
			{
			echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal Pembayaran Melebihi Sisa Pembayaran.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=D&id=$_REQUEST[id]&nonota=$_REQUEST[nonota]'/>";
			exit();
			}
		
		$q2 = mysql_query("UPDATE tbl_pesanan SET status='TERJUAL' WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
		$q3 = mysql_query("UPDATE tbl_bpkb SET notajual='$_REQUEST[nonota]' WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
		
		$qT = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
		while($dT=mysql_fetch_array($qT))
			{
			mysql_query("INSERT INTO tbl_notajual_det (
													nonota,
													nopesan,
													idbarang,
													norangka,
													otr,
													disc,
													ppnjual,
													hargabeli,
													ppnbeli,
													jual_plus_ppnbeli,
													ppnjual_min_ppnbeli,
													jumlah1,
													otrsetelahpajak) 
												VALUES (
													'$_REQUEST[nonota]',
													'$_REQUEST[nopesan]',
													'$dT[idbarang]',
													'$dT[norangka]',
													'$dT[otr]',
													'$dT[disc]',
													'$dT[ppnjual]',
													'$dT[hargabeli]',
													'$dT[ppnbeli]',
													'$dT[jual_plus_ppnbeli]',
													'$dT[ppnjual_min_ppnbeli]',
													'$dT[jumlah1]',
													'$dT[otrsetelahpajak]')");
			mysql_query("UPDATE tbl_stokunit SET status='TERJUAL',updatex='$updatex' WHERE id%2=0 AND norangka='$dT[norangka]'");
			}
			
        $dZ = mysql_fetch_array(mysql_query("SELECT SUM(jumlah1) AS laba,SUM(jual_plus_ppnbeli) AS tjual_plus_ppnbeli,SUM(ppnjual_min_ppnbeli) AS tppnjual_min_ppnbeli FROM tbl_notajual_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
        $laba = $dZ[laba];
        $tjual_plus_ppnbeli 	= $dZ[tjual_plus_ppnbeli];
        $tppnjual_min_ppnbeli 	= $dZ[tppnjual_min_ppnbeli];
        	          
        $dNPDI = mysql_fetch_array(mysql_query("SELECT nopdi FROM tbl_notajual WHERE id%2=0 AND tahun='$p_tahun' AND bulan='$p_bulan' ORDER BY SUBSTR(nopdi,-3,3) DESC LIMIT 1"));
            
		if(empty($dNPDI[nopdi]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNPDI[nopdi]",-3,3);
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
			
			$nopdi = "PDI$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
				
		$q4 = mysql_query("INSERT INTO tbl_notajual (
												nonota, 
												nopdi, 
												nopesan, 
												idsales, 
												iduser, 
												idpelanggan, 
												tahun, 
												bulan,
												jnstransaksi, 
												jnscashtempo, 
												tnkb, 
												tglpelunasan, 
												idleasing, 
												termin, 
												tglnota, 
												status,
												hargabelibersih,
												totr, 
												tdisc, 
												utitipan, 
												sisabayar,
												bayar, 
												laba,  
												tjual_plus_ppnbeli,  
												tppnjual_min_ppnbeli,  
												ppn, 
												inputx, 
												updatex) 
											VALUES (
												'$_REQUEST[nonota]', 
												'$nopdi', 
												'$_REQUEST[nopesan]', 
												'$_REQUEST[idsales]', 
												'$_SESSION[id]',
												'$_REQUEST[idpelanggan]',
												'$p_tahun', 
												'$p_bulan', 
												'$_REQUEST[jnstransaksi]', 
												'$_REQUEST[jnscashtempo]', 
												'$_REQUEST[tnkb]', 
												'$_REQUEST[tglpelunasan]', 
												'$_REQUEST[idleasing]', 
												'$_REQUEST[termin]', 
												CURDATE(), 
												'0', 
												'$_REQUEST[hargabelibersih]', 
												'$totr', 
												'$tdisc', 
												'$utitipan',
												'$sisabayar', 
												'$bayar', 
												'$laba', 
												'$tjual_plus_ppnbeli', 
												'$tppnjual_min_ppnbeli', 
												'$_REQUEST[ppn]', 
												NOW(), 
												'$updatex') 
							");
						
		$q5 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_notajual',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH NOTA JUAL $_REQUEST[nonota]')
							");
			
		echo "			
		<script type='text/javascript'>
			window.open('printaj/notajual.php?nonota=$_REQUEST[nonota]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			
		if($q2 && $q3 && $q4)
			{
			if($_REQUEST[jnstransaksi]=="CASH")
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
				}
			if($_REQUEST[jnstransaksi]=="KREDIT")
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=3'/>";
				}
			if($_REQUEST[jnstransaksi]=="CASH TEMPO")
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=3'/>";
				}
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
		}
		
	else if($submenu == 'utitipan') 
		{
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT namaleasing FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
		
		if($dA[utitipan]!='0')
			{
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$dA[nopesan]' AND jnskwitansi IN ('umuka','titip','penambahan') AND status='0'"));
			if(!empty($dCek[id])){
				echo "<script>alert ('Proses Tambah Uang Titipan/Uang Muka Tidak Bisa Dilanjutkan Karena Belum Cetak Kwitansi Uang Titipan/Uang Muka Atau Belum Mencetak Kwitansi Penambahan Uang Titipan/Uang Muka Sebelumnya.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
				exit();
				}
			
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$dA[nopesan]' AND jnskwitansi IN ('umuka','titip')"));
			if(empty($dCek[id])){
				echo "<script>alert ('Proses Tambah Uang Titipan/Uang Muka Tidak Bisa Dilanjutkan Karena Belum Cetak Kwitansi Uang Titipan/Uang Muka')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
				exit();
				}	
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>PEMESANAN</small></h4>
					           		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td>TANGGAL PESAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:20%"><i class="fa fa-calendar"></i> &nbsp;</span>
				                                        <input type="text" name="tgl" value="<?echo date("d-m-Y",strtotime($dA[tglpesan]))?>" class="form-control" style="width: 62%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly>
				                                    </div>
				                                </td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text"  value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
				                    	
		                            		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">DATA BPKB</td>
					                    			<td width="2%"></td>
					                    			<td colspan="2"></td>
					                    		</tr>
			                            	</table>
		                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
			                            </div>
			                            
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width="25%" style="background: #eee;padding: 10px 0 0 10px">KODE BARANG</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[kodebarang]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">NAMA BARANG</td><td style="background: #eee;padding: 0 0 0 10px"">: <?echo "$dA[namabarang]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">VARIAN</td><td style="background: #eee;padding: 0 0 0 10px"">: <?echo "$dA[varian]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">WARNA</td><td style="background: #eee;padding: 0 0 0 10px"">: <?echo "$dA[warna]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 10px 10px">TAHUN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[tahun]"?></td>
				                    		</tr>
				                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>TRANSAKSI</td>
				                    			<td>:</td>
				                    			<td style="background: #eee;padding: 10px 0 0 10px">JENIS</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
				                    		</tr>
			                    		<?
			                    		if($dA[jnstransaksi]=='KREDIT')
			                    			{
										?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
				                    		</tr>
					                    	<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
										<?
											}
											
			                    		if($dA[jnstransaksi]=='CASH TEMPO')
			                    			{
			                    		?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMPO</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$dA[jnscashtempo]"?></td>
				                    		</tr>
			                    		<?
				                    		if($dA[jnscashtempo]=='LEASING')
				                    			{
										?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
					                    		</tr>
										<?
												}
												
				                    		else if($dA[jnscashtempo]=='DEALER')
				                    			{
										?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">TANGGAL PELUNASAN</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo date("d-m-Y",strtotime($dA[tglpelunasan]))?></td>
					                    		</tr>
					                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
										<?
												}
											}
			                    		?>
										<!--
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
				                    		</tr>
											-->
				                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>TOTAL UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="width:20%">RP.</span>
					                                        <input type="text" name="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
				                    		</tr>
				                    	</table>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
	                            	<?
	                            	$dchut = mysql_fetch_array(mysql_query("SELECT id FROM tbl_hutitipan WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
	                            	if(!empty($dchut[id]))
	                            		{
									?>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">RIWAYAT UANG MUKA/TITIPAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
		                            	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%"></td>
					                    			<td width="2%"></td>
					                    			<td colspan="2">
						                    			<table width="100%" style="background: #eee;">
						                    				<tr>
								                    			<td colspan="5" height="5px"><div style="border-bottom:1px #fff dashed;;margin: 8px"></div></td>
								                    		</tr>
						                    			<?
						                    			$qhut = mysql_query("SELECT * FROM tbl_hutitipan WHERE id%2=0 AND nopesan='$dA[nopesan]'");
						                    			while($dhut=mysql_fetch_array($qhut))
						                    				{
						                    			?>
						                    				<tr>
								                    			<td width="3%"></td>
								                    			<td width="20%">TANGGAL</td>
								                    			<td width="3%">:</td>
								                    			<td><?echo date("d-m-Y",strtotime($dhut[tgl]))?></td>
								                    			<td width="15%" rowspan="3" valign="middle">
								                    				<!--
																	<a data-toggle="modal" data-target="#compose-modal-ubah-utitipan<?echo $dhut[id]?>" style="cursor:pointer">
								                           				<button type="button" class="btn btn-warning" style="padding:3px;font-size:90%;font-weight: bold;"><i class="fa fa-edit"></i> Ubah</button>
																	</a>
																	-->
																	
																	<?
																	if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
																		{
																	?>
																	<a href="<?echo "?opt=$opt&menu=$menu&submenu=delhut&id=$_REQUEST[id]&utitipan1=$dA[utitipan]&idhut=$dhut[id]&nopesan=$dhut[nopesan]&jml=$dhut[jumlah]"?>" style="cursor:pointer">
								                           				<button type="button" class="btn btn-danger" style="padding:3px;font-size:90%;font-weight: bold;" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i> Hapus</button>
																	</a>
																		<?}?>
																	</td>
								                    		</tr>
						                    				<tr>
								                    			<td></td>
								                    			<td>JUMLAH</td>
								                    			<td>:</td>
								                    			<td>RP. <?echo number_format($dhut[jumlah],"0","",".")?></td>
								                    		</tr>
						                    				<tr>
								                    			<td></td>
								                    			<td>KETERANGAN</td>
								                    			<td>:</td>
								                    			<td><?echo $dhut[ket]?></td>
								                    		</tr>
						                    				<tr>
								                    			<td colspan="5"><div style="border-bottom:1px #fff dashed;margin: 8px"></div></td>
								                    		</tr>
								                    	<?
								                    		}
								                    	?>
						                            	</table>
					                            	</td>
					                    		</tr>
			                            	</table>
			                            </div>
		                    			<?
		                    			/*
		                    			$qhut2 = mysql_query("SELECT * FROM tbl_hutitipan WHERE id%2=0 AND nopesan='$dA[nopesan]'");
		                    			while($dhut2=mysql_fetch_array($qhut2))
		                    				{
		                    			?>								
											<!-- ################## MODAL UBAH UTITIPAN ########################################################################################## -->
									        <div class="modal fade " id="compose-modal-ubah-utitipan<?echo $dhut2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
									            <div class="modal-dialog" style="width:35%;">
									                <div class="modal-content">
									                    <div class="modal-header">
									                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                        <h4 class="modal-title">UBAH DETAIL</h4>
									                    </div>
									                    
								                        <div class="modal-body" style="overflow-x:hidden;overflow-y:auto;height:250px;">
								                    	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveut"?>" enctype="multipart/form-data">
							                			<table width="100%">
								                    		<tr>
								                    			<td width="30%">JUMLAH</td>
								                    			<td width="2%">:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
								                                        <span class="input-group-addon" style="width:20%">RP.</span>
								                                        <input type="text" name="utitipan" id="uange" class="form-control" value="<?echo number_format($dhut2[jumlah],"0","",".")?>" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
								                                    </div>
										                        </td>
											                </tr>
								                    		<tr>
								                    			<td>TANGGAL</td>
								                    			<td>:</td>
								                    			<td colspan="2">
								                                    <div class="input-group">
								                                        <span class="input-group-addon" style="width:20%"><i class="fa fa-calendar"></i> &nbsp;</span>
								                                        <input type="text" name="tgl" value="<?echo date("d-m-Y",strtotime($dhut2[tgl]))?>" class="form-control" style="width: 62%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required>
								                                    </div>
								                                </td>
											                </tr>
								                    		<tr>
								                    			<td>KETERANGAN</td>
								                    			<td>:</td>
								                    			<td colspan="2"><input type="text" name="ket" value="<?echo $dhut2[ket]?>" class="form-control" maxlength="100" width="100%"></td>
								                    		</tr>
									                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
									                    	<input type="hidden" name="idpelanggan" value="<?echo $dA[idpelanggan]?>"/>
									                    	<input type="hidden" name="nopesan" value="<?echo $dA[nopesan]?>"/>
									                    	<input type="hidden" name="utitipan1" value="<?echo $dA[utitipan]?>"/>
						                            	</table>
								                		</form>
									               		</div>
								                        <div class="modal-footer clearfix">
								                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
								                            <button type="submit" class="btn btn-info pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
									                	</div>
									                </div>
									            </div>
									        </div>
											<!-- ################################################################################################################################# -->
		                    			<?
		                    				}
		                    				*/
		                    			?>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
									<?
										}
	                            	?>
				                    	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveut"?>" enctype="multipart/form-data">
			                			<table width="70%">
				                    		<tr>
				                    			<td width="30%">TAMBAH UANG MUKA/TITIPAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:20%">RP.</span>
				                                        <input type="text" name="utitipan" id="uange" class="form-control" placeholder="0" style="width:60%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
				                                    </div>
						                        </td>
							                </tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:20%"><i class="fa fa-calendar"></i> &nbsp;</span>
				                                        <input type="text" name="tgl" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 62%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly>
				                                    </div>
				                                </td>
							                </tr>
				                    		<tr>
				                    			<td>KETERANGAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="ket" class="form-control" maxlength="100"></td>
				                    		</tr>
					                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
					                    	<input type="hidden" name="idpelanggan" value="<?echo $dA[idpelanggan]?>"/>
					                    	<input type="hidden" name="nopesan" value="<?echo $dA[nopesan]?>"/>
					                    	<input type="hidden" name="utitipan1" value="<?echo $dA[utitipan]?>"/>
					                    	<input type="hidden" name="idbarang" value="<?echo $dA[idbarang]?>"/>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="2"><button type="submit" class="btn btn-info pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button></td>
				                    		</tr>
		                            	</table>
				                		</form>
		                            	
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
			                	</div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			
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
			$('#uange').on('keypress', function(e) {
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
<?
		}
		
	else if($submenu == 'saveut')
		{		
		$utitipan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipan']);
		$tgl 		= date("Y-m-d", strtotime($_REQUEST['tgl']));
		$ket 		= strtoupper($_REQUEST['ket']);
		
		$tutitipan  = $_REQUEST[utitipan1]+$utitipan;
				              
		$dCek = mysql_fetch_array(mysql_query("SELECT hargabelibersih FROM tbl_stokunit WHERE id%2=0 AND idbarang='$_REQUEST[idbarang]'"));
		if($dCek[hargabelibersih] < $tutitipan)
			{
			echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Total Uang Muka/Uang Titipan Tidak Bisa Lebih Besar Dari Harga Beli Bersih.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=utitipan&id=$_REQUEST[id]'/>";
			exit();
			}
		
			$p_tahun  = date("Y");
			$p_tahun2 = date("y");
			$p_bulan  = date("m");
			$p_tgl    = date("d");
				
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='penambahan' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
			$nokwitansi = "KPU$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
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
											'penambahan',
											'$nokwitansi',
											'$_REQUEST[nopesan]',
											'$p_tahun',
											'$p_bulan',
											CURDATE(),
											'$_REQUEST[idpelanggan]', 
											'$utitipan',
											'$ket',
											'$_SESSION[id]',
											NOW())
						");
				                    	
		$q1 = mysql_query("INSERT INTO tbl_hutitipan (
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
											'$tgl', 
											'$utitipan', 
											'$ket', 
											NOW(), 
											'$updatex') 
							");
		$q2 = mysql_query("UPDATE tbl_pesanan SET utitipan='$tutitipan',updatex='$updatex' WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_hutitipan',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH RIWAYAT UANG TITIPAN JUAL $_REQUEST[nopesan] $tutitipan')
							");
						
		if($q1 && $q2 && $q3)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=4'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=utitipan&id=$_REQUEST[id]'/>";
			exit();
			}
			
		}
	/*
	else if($submenu == 'editut')
		{		
		$utitipan 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipan']);
		$tgl 		= date("Y-m-d", strtotime($_REQUEST['tgl']));
		$ket 		= strtoupper($_REQUEST['ket']);
		
		$tutitipan  = $_REQUEST[utitipan1]+$utitipan;
				                    	
		$q1 = mysql_query("UPDATE INTO tbl_hutitipan SET 
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
											'$tgl', 
											'$utitipan', 
											'$ket', 
											NOW(), 
											'$updatex') 
							");
		$q2 = mysql_query("UPDATE tbl_pesanan SET utitipan='$tutitipan' WHERE id%2=0 AND id='$_REQUEST[id]'");
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_hutitipan',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH RIWAYAT UANG TITIPAN JUAL $_REQUEST[nopesan] $tutitipan')
							");
						
		if($q1 && $q2 && $q3)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=utitipan&id=$_REQUEST[id]'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=utitipan&id=$_REQUEST[id]'/>";
			exit();
			}
		}
	*/
		
	else if($submenu == 'delhut')
		{		
		$tutitipan  = $_REQUEST[utitipan1]-$_REQUEST[jml];
				                    	
		$q1 = mysql_query("DELETE FROM tbl_hutitipan WHERE id%2=0 AND id='$_REQUEST[idhut]'");
		$q2 = mysql_query("UPDATE tbl_pesanan SET utitipan='$tutitipan' WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_hutitipan',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'HAPUS RIWAYAT UANG TITIPAN JUAL $_REQUEST[nopesan] $_REQUEST[jml]')
							");
						
		if($q1 && $q2 && $q3)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=utitipan&id=$_REQUEST[id]'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=utitipan&id=$_REQUEST[id]'/>";
			exit();
			}
			
		}
?>		
        <script>
			$(function(){
			           
			  var select = $('#select1').select2();
			});
			$(document).ready(function() {});
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
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
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
		$('.otr').on('keypress', function(e) {
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
		$('.disc').on('keypress', function(e) {
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
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();
        </script>