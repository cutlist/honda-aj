<?
	if($submenu == 'A')
		{
		unset($_SESSION[nodo]);
		unset($_SESSION[tgldo]);
		unset($_SESSION[nopo]);
		unset($_SESSION[tglpo]);
		unset($_SESSION[nonotabeli]);
		unset($_SESSION[tglnota]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
		unset($_SESSION[idsupplier]);
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notabeli WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNB[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNB[nonota]",-3,3);
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
			
			$nonota = "NB2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		mysql_query("DELETE FROM x23_notabeli_det WHERE nonota='$nonota'");
		
		if(empty($mod))
			{
			if(!empty($_REQUEST[delnota]))
				{
				$q1 = mysql_query("DELETE FROM x23_notabeli WHERE id='$_REQUEST[delnota]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_notabeli',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS NOTA BELI $_REQUEST[nonota]')
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
			                	<h4>PEMBELIAN <small>NOTA BELI</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Mohon Melanjutkan Ke Menu Konfirmasi Nota Beli Pada Bagian Gudang Spare Part.</p>
	                                    </div>
									<?
										}
									?>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA BELI / NO. PO / TGL NOTA / NAMA SUPPLIER ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Nota Beli Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/notabeli.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. PO</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="10%" style="padding:7px">TOTAL QTY BELI</th>
			                                    <th style="padding:7px">JUMLAH BELI (RP)</th>
			                                    <th style="padding:7px">JUMLAH BELI + PPN (RP)</th>
			                                    <th width="" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE jns='PEMBELIAN' AND (nonota LIKE '%$_REQUEST[cari]%' OR nopo LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE jns='PEMBELIAN' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE nonota='$d1[nonota]'"));
			                            	$db = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE nonota='$d1[nonota]'"));
											
											if(empty($d1[konf])){
												$red = "color:#ff0227";
												}
											else{$red="";}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nopo]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotalppn],"0","",".")?></span></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
															<?
															if(empty($d1[konf])){
															?>
				                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
				                                                <?
				                                                if(empty($dA[qty]) || $dA[qty]=='0')
				                                                	{
																?>
															    	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delnota=$d1[id]&nonota=$d1[nonota]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
				                                            	<?
																	}
																}
															else{
																?>
				                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
				                                            	<?
																}
			                                                ?>
			                                            </ul>
			                                        </div>
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
			                        		<td>Belum Dilakukan Konfirmasi Nota Beli</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Sudah Dilakukan Konfirmasi Nota Beli</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					else if($mod == "edit1")
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=edit&submenu=$submenu&id=$_REQUEST[id]'/>";
						}
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
						
						if(!empty($_REQUEST[tambahbarang]))
							{
							/*
							$dcs = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det WHERE idbarang='$_REQUEST[idbarang]' AND nonota='$d1[nonota]'"));	
							if(!empty($dcs[id]))
								{
								echo "<script>alert ('Mohon Ulangi, Karena Barang Sudah Ada Pada Nota Beli Ini!')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]&direct=1'/>";
								exit();
								}
							*/
							
							$qty = preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
							if($qty=="0"){
								echo "<script>alert ('Qty Tidak Boleh 0 (Nol).')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}
							$rak  = strtoupper($_REQUEST[rak]);
							$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
							$jumlah				= $hargabelibersih*$qty;
			
							$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det WHERE nonota='$d1[nonota]' AND idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND rak='$rak'"));
							
							if(!empty($dCek2[id]))
								{
								echo "<script>alert ('Barang Tersebut Sudah Ada Pada Detail Nota.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}
							
							$q1 = mysql_query("INSERT INTO x23_notabeli_det (
																nonota,
																idbarang,
																hargabelibersih,
																qty,
																total,
																idgudang,
																rak)
															VALUE (
																'$d1[nonota]',
																'$_REQUEST[idbarang]',
																'$hargabelibersih',
																'$qty',
																'$jumlah',
																'$_REQUEST[idgudang]',
																'$rak')
												");
										
							if($q1)
								{
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}
							}
						
						if(!empty($_REQUEST[ubahbarang]))
							{
							$qty 				= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
							if($qty=="0"){
								echo "<script>alert ('Qty Tidak Boleh 0 (Nol).')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}
							$rak  = strtoupper($_REQUEST[rak]);
							$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
							$jumlah				= $hargabelibersih*$qty;
			
							$dCek4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det WHERE id='$_REQUEST[ubahbarang]'"));
							if($dCek4[idgudang]!=$_REQUEST[idgudang] OR $dCek4[rak]!=$rak){
								$dCek3 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det WHERE nonota='$dCek4[nonota]' AND idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND rak='$rak'"));
								if(!empty($dCek3[id]))
									{
									echo "<script>alert ('Barang Tersebut Sudah Ada Pada Gudang Dan Rak Yang Sama.')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
									exit();
									}
								}
								
							$q1 = mysql_query("UPDATE x23_notabeli_det SET
																hargabelibersih='$hargabelibersih',
																qty='$qty',
																total='$jumlah',
																idgudang='$_REQUEST[idgudang]',
																rak='$rak'
															WHERE id='$_REQUEST[ubahbarang]'
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
							mysql_query("DELETE FROM x23_notabeli_det WHERE	id='$_REQUEST[del]'");
							}
						
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total, SUM(total) AS gtotal FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'"));			                           
						if($d1[idsupplier]=="1"){
							$ppn = round($d2[gtotal]*0.1,0);  
							}
						else{
							$ppn = 0;
							} 
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('print/notabelih23.php?nonota=<?echo $d1[nonota]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBELIAN <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$qA = mysql_query("SELECT * FROM x23_supplier WHERE status='1' ORDER BY nama");
																		while($dA=mysql_fetch_array($qA))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($d1[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="30" style="width:80%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="totalqty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[gtotal]?>">
					                    	<input type="hidden" name="grandtotalppn" value="<?echo ($d2[gtotal]+$ppn)?>">
					                    	
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Beli</button>
					                    	<?
					                    	if(empty($d1[konf]))
					                    		{
											?>
												<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
			                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Barang</button>
												</a>
						                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<?
												}
											else{
											?>
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="1%" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?	                         
										$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td align="right"><span style="margin-right:0%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td><?echo $dA[gudang]?></td>
			                                    <td><?echo $dA[rak]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
							                    	<?
							                    	if(empty($d1[konf]))
							                    		{
													?>
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li>
																<a data-toggle="modal" data-target="#compose-modal-ubah-barang<?echo $dA[id]?>" style="cursor:pointer">
							                           				<i class="fa fa-edit"></i>Ubah
																</a>
															</li>
															<?
										if($_SESSION[posisi]=='DIREKSI'){
															?>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&del=$dA[id]&id=$_REQUEST[id]&direct=1"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            <?}?>
			                                            </ul>
			                                        </div>
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
			                            <tfoot>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:0%"><b><?echo number_format($d2[qty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal])?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL + PPN</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:0%"></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal]+$ppn)?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
					$q3 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
		            while($d3 = mysql_fetch_array($q3))
		            	{
						//$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id='$d3[id]'"));
		            ?>
<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah-barang<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang WHERE idsupplier='$d3[idsupplier]' ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d3[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" value="<?echo number_format($d3[hargabelibersih],"0","",".")?>" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY BELI</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" value="<?echo number_format($d3[qty],"0","",".")?>" style="width:100%;text-align:right" class="form-control uang" maxlength="10" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                                <!--
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo number_format($d3[qty],"0","",".")?>" style="width:10%;text-align:right" class="form-control uang" maxlength="10" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    			-->
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($dA[id]==$d3[idgudang]){?>selected=""<?}?>><?echo "$dA[gudang]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[rak]?>' <?if($dA[rak]==$d3[rak]){?>selected=""<?}?>><?echo "$dA[rak]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    			<!--
				                    			<td colspan="2"><input type="text" name="rak" maxlength="20" value="<?echo $d3[rak]?>" style="width:20%;" class="form-control"  required></td>
				                    			-->
				                    		</tr>
					                    	<input type="hidden" name="ubahbarang" value="<?echo $d3[id]?>">
					                    	<input type="hidden" name="idbarang" value="<?echo $d3[idbarang]?>">
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

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang WHERE idsupplier='$d1[idsupplier]' ORDER BY kodebarang");
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
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY BELI</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" value="" style="width:100%;text-align:right" class="form-control uang" maxlength="10" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                                <!--
				                    			<td colspan="2"><input type="text" name="qty" style="width:10%;text-align:right" class="form-control" maxlength="10" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    			-->
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($dA[id]==$d3[idgudang]){?>selected=""<?}?>><?echo "$dA[gudang]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[rak]?>' <?if($dA[rak]==$d3[rak]){?>selected=""<?}?>><?echo "$dA[rak]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambahbarang" value="1">
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
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notabeli WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNB[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNB[nonota]",-3,3);
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
			
			$nonota = "NB2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
				$action = "?opt=$opt&menu=$menu&submenu=C";
				
		mysql_query("DELETE FROM x23_notabeli_det WHERE nonota='$nonota'");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PEMBELIAN <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Nota Beli</small></h4>
			                	
				                	<form method="post" action="<?echo $action?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                	<?
									if(empty($_SESSION[nonotabeli]))
										{
				                	?>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" required="" >
																		<option value=''>Pilih</option>
																		
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_supplier WHERE status='1' ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($_SESSION[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="30" style="width:80%" required></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $nonota?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					                <?
					                	}
					                	
					                else
					                	{
									?>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" required="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_supplier WHERE status='1' ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($_SESSION[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="30" style="width:50%" required></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonotabeli]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
									<?										
										}
				                    ?>
				                    </div>
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <input type="hidden" name="p_tahun" value="<?echo $p_tahun?>">
					                        <input type="hidden" name="p_bulan" value="<?echo $p_bulan?>">
					                        
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli WHERE nopo='$_REQUEST[nopo]'"));
		if(!empty($dCek[id]))
			{
			echo "<script>alert ('Nomor PO Sudah Pernah Diinput.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&direct=1'/>";
			exit();
			}
			
		if(empty($_REQUEST[direct]) && empty($_REQUEST[tambahbarang]) && empty($_REQUEST[del]) && empty($_REQUEST[ubahbarang]))
			{
			$_SESSION[idsupplier]    = strtoupper($_REQUEST[idsupplier]);
			$_SESSION[nopo]    = strtoupper($_REQUEST[nopo]);
			$_SESSION[tglpo]   = date("Y-m-d", strtotime($_REQUEST['tglpo']));
			$_SESSION[nonotabeli]  = strtoupper($_REQUEST[nonota]);
			$_SESSION[tglnota] = date("Y-m-d", strtotime($_REQUEST['tglnota']));
			$_SESSION[p_tahun] = strtoupper($_REQUEST[p_tahun]);
			$_SESSION[p_bulan] = strtoupper($_REQUEST[p_bulan]);
			}
		
		if($_REQUEST[tambahbarang]=='1')
			{
			/*
			$dcs = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det WHERE idbarang='$_REQUEST[idbarang]' AND nonota='$_SESSION[nonotabeli]'"));	
			if(!empty($dcs[id]))
				{
				echo "<script>alert ('Mohon Ulangi, Karena Barang Sudah Ada Pada Nota Beli Ini!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			*/
			$rak  = strtoupper($_REQUEST[rak]);
			$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
			$qty 				= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			
			$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det WHERE nonota='$_SESSION[nonotabeli]' AND idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND rak='$rak'"));
			
			if(!empty($dCek2[id]))
				{
				echo "<script>alert ('Barang Tersebut Sudah Ada Pada Detail Nota.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&tambahbarang=0&submenu=$submenu&direct=1'/>";
				exit();
				}
				
			if($hargabelibersih=='0' || $qty=='0')
				{
				echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&tambahbarang=0&submenu=$submenu&direct=1'/>";
				exit();
				}
			
			$jumlah				= $hargabelibersih*$qty;
			
			$q1 = mysql_query("INSERT INTO x23_notabeli_det (
												nonota,
												idbarang,
												hargabelibersih,
												idgudang,
												rak,
												qty,
												total)
											VALUE (
												'$_SESSION[nonotabeli]',
												'$_REQUEST[idbarang]',
												'$hargabelibersih',
												'$_REQUEST[idgudang]',
												'$rak',
												'$qty',
												'$jumlah')
								");
						
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			}
		
		if(!empty($_REQUEST[ubahbarang]))
			{
			$rak  = strtoupper($_REQUEST[rak]);
			$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
			$qty 				= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			
			$dCek4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det WHERE id='$_REQUEST[ubahbarang]'"));
			if($dCek4[idgudang]!=$_REQUEST[idgudang] OR $dCek4[rak]!=$rak){
				$dCek3 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli_det WHERE nonota='$_SESSION[nonotabeli]' AND idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND rak='$rak'"));
				if(!empty($dCek3[id]))
					{
					echo "<script>alert ('Barang Tersebut Sudah Ada Pada Gudang Dan Rak Yang Sama.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&tambahbarang=0&submenu=$submenu&direct=1'/>";
					exit();
					}
				}
			
			
			if($hargabelibersih=='0' || $qty=='0')
				{
				echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
				
			$jumlah				= $hargabelibersih*$qty;
			$q1 = mysql_query("UPDATE x23_notabeli_det SET
												hargabelibersih='$hargabelibersih',
												qty='$qty',
												total='$jumlah',
												idgudang='$_REQUEST[idgudang]',
												rak='$rak'
											WHERE id='$_REQUEST[ubahbarang]'
								");
						
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			}
			
		if(!empty($_REQUEST[del])){
			mysql_query("DELETE FROM x23_notabeli_det WHERE	id='$_REQUEST[del]'");
			}
		
		$d2  = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total, SUM(total) AS gtotal FROM x23_notabeli_det WHERE nonota='$_SESSION[nonotabeli]'"));			                           
		if($_SESSION[idsupplier]=="1"){
			$ppn = round($d2[gtotal]*0.1,0);  
			}
		else{
			$ppn = 0;
			} 
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBELIAN <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Nota Beli</small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_supplier WHERE status='1' ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($_SESSION[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="30" style="width:80%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonotabeli]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($_SESSION[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($_SESSION[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="totalqty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[gtotal]?>">
					                    	<input type="hidden" name="grandtotalppn" value="<?echo $d2[gtotal]+$ppn?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&nonota=$_SESSION[nonotabeli]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Barang</button>
											</a>
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="1%" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE nonota='$_SESSION[nonotabeli]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$d1[idbarang]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id='$d1[idgudang]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d4[kodebarang]?></td>
			                                    <td><?echo "$d4[namabarang] | $d4[varian]"?></td>
			                                    <td align="right"><span style="margin-right:0%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td><?echo $d3[gudang]?></td>
			                                    <td><?echo $d1[rak]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li>
																<a data-toggle="modal" data-target="#compose-modal-ubah-barang<?echo $d1[id]?>" style="cursor:pointer">
							                           				<i class="fa fa-edit"></i>Ubah
																</a>
															</li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]&direct=1"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:0%"><b><?echo number_format($d2[qty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal])?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL + PPN</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:0%"></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal]+$ppn)?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
					$q2 = mysql_query("SELECT * FROM x23_notabeli_det WHERE nonota='$_SESSION[nonotabeli]'");
		            while($d2 = mysql_fetch_array($q2))
		            	{
		            ?>
<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah-barang<?echo $d2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d2[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" value="<?echo number_format($d2[hargabelibersih],"0","",".")?>" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY BELI</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" value="<?echo number_format($d2[qty],"0","",".")?>" style="width:100%;text-align:right" class="form-control" maxlength="10" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($dA[id]==$d2[idgudang]){?>selected=""<?}?>><?echo "$dA[gudang]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[rak]?>' <?if($dA[rak]==$d2[rak]){?>selected=""<?}?>><?echo "$dA[rak]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="ubahbarang" value="<?echo $d2[id]?>">
					                    	<input type="hidden" name="idbarang" value="<?echo $d2[idbarang]?>">
					                    	<input type="hidden" name="direct" value="1">
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

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH DETAIL BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
									<?
									$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_supplier WHERE id='$_SESSION[idsupplier]'"));
									if($dCek[grup]=="1")
										{$q1 = mysql_query("SELECT * FROM x23_masterbarang ORDER BY kodebarang");}
									else{$q1 = mysql_query("SELECT * FROM x23_masterbarang WHERE idsupplier='$_SESSION[idsupplier]' ORDER BY kodebarang");}
									?>
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			
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
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY BELI</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" class="form-control uang" maxlength="7" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[gudang]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[rak]?>' <?if($dA[rak]==$d3[rak]){?>selected=""<?}?>><?echo "$dA[rak]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="tambahbarang" value="1">
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

			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'D')
		{
		$q1 = mysql_query("INSERT INTO x23_notabeli (
										jns,
										nonota,
										idsupplier,
										tahun,
										bulan,
										tglnota,
										nopo,
										tglpo,
										totalqty,
										grandtotal,
										grandtotalppn,
										iduserbeli,
										inputx,
										updatex)
									VALUES (
										'PEMBELIAN',
										'$_SESSION[nonotabeli]',
										'$_SESSION[idsupplier]',
										'$_SESSION[p_tahun]',
										'$_SESSION[p_bulan]',
										'$_SESSION[tglnota]',
										'$_SESSION[nopo]',
										'$_SESSION[tglpo]',
										'$_REQUEST[totalqty]',
										'$_REQUEST[grandtotal]',
										'$_REQUEST[grandtotalppn]',
										'$_SESSION[id]',
										NOW(),
										'$updatex')
						");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'x23_notabeli',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'TAMBAH NOTA BELI $_SESSION[nonotabeli]')
						");
		
		echo "			
		<script type='text/javascript'>
			window.open('print/notabelih23.php?nonota=$_SESSION[nonotabeli]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
					
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&direct=1'/>";
			exit();
			}
		}
		
	else if($submenu == 'E')
		{
		//$_SESSION[idsupplier]    = strtoupper($_REQUEST[idsupplier]);
		//$_SESSION[nopo]    = strtoupper($_REQUEST[nopo]);nopo='$_SESSION[nopo]',
		$_SESSION[tglpo]   = date("Y-m-d", strtotime($_REQUEST['tglpo']));
		$_SESSION[nonotabeli]  = strtoupper($_REQUEST[nonota]);
		$_SESSION[tglnota] = date("Y-m-d", strtotime($_REQUEST['tglnota']));
			
		$q1 = mysql_query("UPDATE x23_notabeli SET 
										tglnota='$_SESSION[tglnota]',
										tglpo='$_SESSION[tglpo]',
										totalqty='$_REQUEST[totalqty]',
										grandtotal='$_REQUEST[grandtotal]',
										grandtotalppn='$_REQUEST[grandtotalppn]',
										updatex='$updatex'
									WHERE nonota='$_SESSION[nonotabeli]'
						");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'x23_notabeli',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'UBAH NOTA BELI $nonota')
						");
					
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=edit&id=$_REQUEST[id]'/>";
			exit();
			}
		}
?>
	
        <script src="js/jquery.min.js"></script>
        <script>
        //SELECT2
			$(function(){
			           
			  var select = $('.select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });
			  $("#tagPicker2").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

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
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>