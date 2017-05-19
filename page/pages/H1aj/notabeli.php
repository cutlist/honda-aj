<?
	if($submenu == 'A')
		{
		unset($_SESSION[nodo]);
		unset($_SESSION[tgldo]);
		unset($_SESSION[nopo]);
		unset($_SESSION[tglpo]);
		unset($_SESSION[nonota]);
		unset($_SESSION[tglnota]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM tbl_notabeli WHERE  tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
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
			
			$nonota = "NB1$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		mysql_query("DELETE FROM tbl_notabeli_det WHERE  nonota='$nonota'");
		
		if(empty($mod))
			{
			if(!empty($_REQUEST[delnota]))
				{
				$q1 = mysql_query("DELETE FROM tbl_notabeli WHERE  id='$_REQUEST[delnota]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notabeli',
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
			                	<h4>BELI <small>NOTA BELI</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Mohon Melanjutkan Ke Menu Konfirmasi Nota Beli Pada Bagian Gudang & PDI.</p>
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
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA BELI / NO. FAKTUR / NO. SURAT PESANAN ..." class="form-control"/>
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
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h1/notabeli.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. FAKTUR</th>
			                                    <th style="padding:7px">TGL FAKTUR</th>
			                                    <th style="padding:7px">NO. SURAT PESANAN</th>
			                                    <th style="padding:7px">TGL SURAT PESANAN</th>
			                                    <th width="" style="padding:7px">QTY BELI (UNIT)</th>
			                                    <th style="padding:7px">GRAND TOTAL BELI (RP)</th>
			                                    <th style="padding:7px">GRAND TOTAL BELI + PPN (RP)</th>
			                                    <th width="" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND  nodo!='' AND  nonota LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' OR nopo LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND  nodo!='' AND id%2=0 ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS qty, SUM(hargabelibersih) AS tot FROM tbl_notabeli_det WHERE  nonota='$d1[nonota]'"));
											$ppn = ROUND($d2[tot] * 0.1,0);
											
											if(empty($d1[gtbayar])){
												$red = "color:#ff0227";
												}
											else{$red="";}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nodo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d2[qty],"0","",".")?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d2[tot],"0","",".")?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($ppn+$d2[tot],"0","",".")?></span></td>
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
																<?
																if(empty($d1[gtbayar])){
																	?>
					                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
					                                            	<?
					                                            	if(empty($d2[qty]) || $d2[qty]=='0')
					                                            		{
																	?>
																     	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delnota=$d1[id]&nonota=$d1[nonota]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
					                                           		<?
																		}
																	}
																else{
																	?>
					                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
					                                            	<?
																	}
																?>
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
			                        		<td>Belum Dilakukan Konfirmasi Nota Beli</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td> Dilakukan Konfirmasi Nota Beli</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE  id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE  nonota='$d1[nonota]'"));	
						$ppn = 	ROUND(($d2[total]*10)/100);	                           	
						
						if(!empty($_REQUEST[tambahbarang]))
							{
							$norangka 	= strtoupper($_REQUEST['norangka']);
							$dcs = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli_det WHERE  norangka='$norangka'"));	
							if(!empty($dcs[norangka]))
								{
								echo "<script>alert ('Barang sudah pernah diinput!')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$_REQUEST[id]'/>";
								exit();
								}
							
							$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
							$ppn1 = 	ROUND(($hargabelibersih*10)/100);	                           
								
							if($hargabelibersih=='0')
								{
								echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
								
							$nomesin 	= strtoupper($_REQUEST['nomesin']);
							$q1 = mysql_query("INSERT INTO tbl_notabeli_det (
																nonota,
																idbarang,
																hargabelibersih,
																ppn,
																norangka,
																nomesin,
																qty)
															VALUE (
																'$d1[nonota]',
																'$_REQUEST[idbarang]',
																'$hargabelibersih',
																'$ppn1',
																'$norangka',
																'$nomesin',
																'1')
												");
										
							if($q1)
								{
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							}
						
						if(!empty($_REQUEST[ubahbarang]))
							{
							$norangka 	= strtoupper($_REQUEST['norangka']);
							$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
							$ppn1 = 	ROUND(($hargabelibersih*10)/100);	                           
							$nomesin 	= strtoupper($_REQUEST['nomesin']);
							
							if($hargabelibersih=='0')
								{
								echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							
							$q1 = mysql_query("UPDATE tbl_notabeli_det SET
																idbarang='$_REQUEST[idbarang]',
																hargabelibersih='$hargabelibersih',
																ppn='$ppn1',
																norangka='$norangka',
																nomesin='$nomesin'
															WHERE  id='$_REQUEST[ubahbarang]'
												");
										
							if($q1)
								{
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
								exit();
								}
							}
							
						if(!empty($_REQUEST[del]))
							{
							mysql_query("DELETE FROM tbl_notabeli_det WHERE	id='$_REQUEST[del]'");
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]'/>";
							exit();
							}
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/notabeli.php?nonota=<?echo $d1[nonota]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>BELI <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-5">
					           			<?
                                    	if($_SESSION[posisi]=='DIREKSI')
                                    		{
                                    		$attr = 'required=""';
                                    		}
                                    	else{
                                    		$attr  = 'readonly=""';
                                    		$attr2 = 'readonly=""';
											}
										?>
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $d1[nodo]?>" class="form-control" maxlength="40" style="width:100%" <?echo $attr?>></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="40" style="width:100%" <?echo $attr?>></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL FAKTUR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($d1[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask <?echo $attr?> style="width:90%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL SURAT PESANAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask <?echo $attr?> style="width:90%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:90%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px" <?echo $attr2?>><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
                                    	<?
                                    	if($_SESSION[posisi]=='DIREKSI')
                                    		{
										?>
					                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
					                    	<input type="hidden" name="grandtotalppn" value="<?echo $ppn?>">
					                    	
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Barang</button>
											</a>
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Beli</button>
					                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                    <?
					                    	}
                                    	if($_SESSION[posisi]=='PIC')
                                    		{
										?>
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Beli</button>
					                    <?
					                    	}
					                    ?>
										<!--
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											-->
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE  nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td width="1%" align="center">
		                                    	<?
												if($dA[status]!='1'){
	                                            	if($_SESSION[posisi]=='DIREKSI')
	                                            		{
												?>
				                                    	<div class="btn-group">
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
				                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&del=$dA[id]&id=$_REQUEST[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
				                                            </ul>
				                                        </div>
			                                    <?
														}
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
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="left">GRAND TOTAL BELI (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="left">GRAND TOTAL BELI + PPN (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total]+$ppn)?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="left">QTY BELI (UNIT)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?;
					$q3 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE  nonota='$d1[nonota]'");
		            while($d3 = mysql_fetch_array($q3))
		            	{
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
				                    			<td width="20%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d3[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] $dA[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR RANGKA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="norangka" value="<?echo $d3[norangka]?>" style="width:40%;" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR MESIN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nomesin" value="<?echo $d3[nomesin]?>" style="width:40%;" class="form-control"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" value="<?echo number_format($d3[hargabelibersih],"0","",".")?>" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="12" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>QTY BELI (UNIT)</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo number_format($d2[qty],"0","",".")?>" style="width:10%;text-align:right" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    		</tr>
				                    		-->
					                    	<input type="hidden" name="ubahbarang" value="<?echo $d3[id]?>">
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
				                    			<td width="20%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] $dA[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR RANGKA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="norangka" style="width:40%;" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR MESIN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nomesin" style="width:40%;" class="form-control"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="12" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>QTY BELI (UNIT)</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="qty" style="width:10%;text-align:right" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    		</tr>
				                    		-->
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
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE  id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE  nonota='$d1[nonota]'"));	
						$ppn = 	ROUND(($d2[total]*10)/100);	  
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/notabeli.php?nonota=<?echo $d1[nonota]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>BELI <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-5">
					           			<?
                                    		$attr  = 'readonly=""';
                                    		$attr2 = 'readonly=""';
										?>
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $d1[nodo]?>" class="form-control" maxlength="40" style="width:100%" <?echo $attr?>></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="40" style="width:100%" <?echo $attr?>></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL FAKTUR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($d1[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask <?echo $attr?> style="width:90%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL SURAT PESANAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask <?echo $attr?> style="width:90%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask <?echo $attr?> style="width:90%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px" <?echo $attr2?>><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Beli</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE  nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="3"></th>
			                            		<th colspan="" align="left">GRAND TOTAL BELI (RP)</th>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="3"></th>
			                            		<th colspan="" align="left">GRAND TOTAL BELI + PPN (RP)</th>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total]+$ppn)?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="3"></th>
			                            		<th colspan="" align="left">QTY BELI (UNIT)</th>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            	</tr>
			                            </tfoot>
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
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM tbl_notabeli WHERE  tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
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
			
			$nonota = "NB1$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$action = "?opt=$opt&menu=$menu&submenu=C";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>BELI <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Nota Beli</small></h4>
			                	
				                	<form method="post" action="<?echo $action?>" enctype="multipart/form-data">
				                	<div style="padding:20px 0px">
				                	<?
									if(empty($_SESSION[nonota]))
										{
				                	?>
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $_SESSION[nodo]?>" class="form-control" maxlength="40" style="width:100%" required></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="40" style="width:100%" required></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $nonota?>" class="form-control" maxlength="20" style="width:100%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL FAKTUR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL SURAT PESANAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px"><?echo $_SESSION[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                <?
					                	}
					                	
					                else
					                	{
									?>
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $_SESSION[nodo]?>" class="form-control" maxlength="40" style="width:100%" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="40" style="width:100%" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonota]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL FAKTUR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($_SESSION[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL SURAT PESANAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($_SESSION[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($_SESSION[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px"><?echo $_SESSION[memo]?></textarea></td>
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
		if(empty($_REQUEST[direct]) && empty($_REQUEST[tambahbarang]) && empty($_REQUEST[del]) && empty($_REQUEST[ubahbarang]))
			{
			$_SESSION[nodo]    = strtoupper($_REQUEST[nodo]);
			$_SESSION[tgldo]   = date("Y-m-d", strtotime($_REQUEST['tgldo']));
			$_SESSION[nopo]    = strtoupper($_REQUEST[nopo]);
			$_SESSION[tglpo]   = date("Y-m-d", strtotime($_REQUEST['tglpo']));
			$_SESSION[nonota]  = strtoupper($_REQUEST[nonota]);
			$_SESSION[tglnota] = date("Y-m-d", strtotime($_REQUEST['tglnota']));
			$_SESSION[memo]    = strtoupper($_REQUEST[memo]);
			$_SESSION[p_tahun] = strtoupper($_REQUEST[p_tahun]);
			$_SESSION[p_bulan] = strtoupper($_REQUEST[p_bulan]);
			}
		
		if(!empty($_REQUEST[tambahbarang]))
			{
			$norangka 	= strtoupper($_REQUEST['norangka']);
			$nomesin 	= strtoupper($_REQUEST['nomesin']);
			$dcs = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli_det WHERE  norangka='$norangka' OR nomesin='$nomesin'"));	
			if(!empty($dcs[norangka]))
				{
				echo "<script>alert ('Barang sudah pernah diinput!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
				
			$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
			$ppn1 = 	ROUND(($hargabelibersih*10)/100);	                           
								
			if($hargabelibersih=='0')
				{
				echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
				
			/*
			$qty 				= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			$total 				= $hargabelibersih*$qty;
			*/
			$q1 = mysql_query("INSERT INTO tbl_notabeli_det (
												nonota,
												idbarang,
												hargabelibersih,
												ppn,
												norangka,
												nomesin,
												qty)
											VALUE (
												'$_SESSION[nonota]',
												'$_REQUEST[idbarang]',
												'$hargabelibersih',
												'$ppn1',
												'$norangka',
												'$nomesin',
												'1')
								");
						
			if($q1)
				{
				/*
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				*/
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
			$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
								
			if($hargabelibersih=='0')
				{
				echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
				
			$norangka 	= strtoupper($_REQUEST['norangka']);
			$nomesin 	= strtoupper($_REQUEST['nomesin']);
			/*
			$qty 				= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			$total 				= $hargabelibersih*$qty;
			*/
			$q1 = mysql_query("UPDATE tbl_notabeli_det SET
												idbarang='$_REQUEST[idbarang]',
												hargabelibersih='$hargabelibersih',
												norangka='$norangka',
												nomesin='$nomesin'
											WHERE  id='$_REQUEST[ubahbarang]'
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
			
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM tbl_notabeli_det WHERE	id='$_REQUEST[del]'");
			}
		
		$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notabeli WHERE  nodo='$_SESSION[nodo]' OR nopo='$_SESSION[nopo]'"));	
		if(!empty($dCek[id]))
			{
			echo "<script>alert ('Nomor DO / Nomor PO Sudah Pernah Diinput.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
			exit();
			}
					                           
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE  nonota='$_SESSION[nonota]'"));
		$ppn = 	ROUND(($d2[total]*10)/100);	                           
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>BELI <small>NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Nota Beli</small></h4>
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $_SESSION[nodo]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonota]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL FAKTUR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($_SESSION[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL SURAT PESANAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($_SESSION[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($_SESSION[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px" readonly=""><?echo $_SESSION[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
					                    	<input type="hidden" name="grandtotalppn" value="<?echo $ppn?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&nonota=$_SESSION[nonota]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
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
				                    <!--
	                           		<div style="float:right" class="col-xs-7">
	                           			<table width="100%" border="0">
	                           				<tr>	
	                           					<td><a data-toggle="modal" data-target="#compose-modal-import-barang" style="cursor:pointer">
			                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-file"></i> &nbsp; Import by Excel *.xls</button>
													</a>
												</td>
	                           				</tr>
	                           			</table>
	                           		</div>
	                           		-->
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <!--
			                                    <th width="1%" style="padding:7px"><center>QTY BELI (UNIT)</center></th>
			                                    -->
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE  nonota='$_SESSION[nonota]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <!--
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    -->
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
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
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="right">GRAND TOTAL BELI (RP)</th>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		-->
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="right">GRAND TOTAL BELI + PPN (RP)</th>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		-->
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$d2[total])?></b></span></td>
			                            		<th colspan=""></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<th colspan="" align="right">QTY BELI</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?> UNIT</b></span></td>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		-->
			                            		<th colspan=""></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
					$q2 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE  nonota='$_SESSION[nonota]'");
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
				                    			<td width="20%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d2[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] $dA[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR RANGKA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="norangka" value="<?echo $d2[norangka]?>" style="width:40%;" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR MESIN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nomesin" value="<?echo $d2[nomesin]?>" style="width:40%;" class="form-control"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" value="<?echo number_format($d2[hargabelibersih],"0","",".")?>" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="12" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>QTY BELI (UNIT)</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo number_format($d2[qty],"0","",".")?>" style="width:10%;text-align:right" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    		</tr>
				                    		-->
					                    	<input type="hidden" name="ubahbarang" value="<?echo $d2[id]?>">
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

<!-- ################## MODAL IMPORT BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-import-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:35%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">IMPORT DETAIL BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=import"?>" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td colspan="4"><div class="box-body table-responsive">
						                            <div class="form-group">
						                            	<center>
						                                    <label for="exampleInputFile" style="margin-bottom: 20px;"><i class="fa fa-file"></i> Import Detail Barang</label>
						                                </center>
						                                 <input type="file" name="import" id="exampleInputFile" required>
						                                    <p class="help-block">Pilih File Excel dengan Format yang Sudah Ditentukan untuk Input Detail Barang</p>
						                                </div>
								                    </div>
								                </td>
				                    		</tr>
				                    		<tr>
				                    			<td height="30px"></td>
				                    		</tr>
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Import</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->

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
				                    			<td width="20%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] $dA[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR RANGKA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="norangka" style="width:40%;" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR MESIN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nomesin" style="width:40%;" class="form-control"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="hargabelibersih" class="form-control uang" placeholder="0" style="width:20%;text-align:right" maxlength="12" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>QTY BELI (UNIT)</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="qty" style="width:10%;text-align:right" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required></td>
				                    		</tr>
				                    		-->
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
		if(empty($_REQUEST[qty]))
			{
			echo "<script>alert ('Proses Gagal, Mohon Tambah Detail Barang Terlebih Dahulu.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&direct=1'/>";
			exit();
			}
			
		$q1 = mysql_query("INSERT INTO tbl_notabeli (
										nonota,
										tahun,
										bulan,
										tglnota,
										nodo,
										tgldo,
										nopo,
										tglpo,
										memo,
										qty,
										grandtotal,
										grandtotalppn,
										iduser,
										inputx,
										updatex)
									VALUES (
										'$_SESSION[nonota]',
										'$_SESSION[p_tahun]',
										'$_SESSION[p_bulan]',
										'$_SESSION[tglnota]',
										'$_SESSION[nodo]',
										'$_SESSION[tgldo]',
										'$_SESSION[nopo]',
										'$_SESSION[tglpo]',
										'$_SESSION[memo]',
										'$_REQUEST[qty]',
										'$_REQUEST[grandtotal]',
										'$_REQUEST[grandtotalppn]',
										'$_SESSION[id]',
										NOW(),
										'$updatex')
						");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'tbl_notabeli',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'TAMBAH NOTA BELI $_SESSION[nonota]')
						");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/notabeli.php?nonota=$_SESSION[nonota]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
					
		if($q1 && $q2)
			{
			//echo "<script>alert ('Proses Berhasil, Mohon Melanjutkan Ke Menu Konfirmasi Nota Beli Pada Bagian Gudang & PDI.')</script>";
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
		$nodo    = strtoupper($_REQUEST[nodo]);
		$tgldo   = date("Y-m-d", strtotime($_REQUEST['tgldo']));
		$nopo    = strtoupper($_REQUEST[nopo]);
		$tglpo   = date("Y-m-d", strtotime($_REQUEST['tglpo']));
		$nonota  = strtoupper($_REQUEST[nonota]);
		$tglnota = date("Y-m-d", strtotime($_REQUEST['tglnota']));
		$memo    = strtoupper($_REQUEST[memo]);
			
		$d1 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total FROM tbl_notabeli_det2_vw WHERE  nonota='$nonota'"));		
			
		$q1 = mysql_query("UPDATE tbl_notabeli SET 
										tglnota='$tglnota',
										nodo='$nodo',
										tgldo='$tgldo',
										nopo='$nopo',
										tglpo='$tglpo',
										memo='$memo',
										qty='$_REQUEST[qty]',
										grandtotal='$_REQUEST[grandtotal]',
										grandtotalppn='$_REQUEST[grandtotalppn]',
										updatex='$updatex'
									WHERE  nonota='$nonota'
						");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'tbl_notabeli',
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
			           
			  var select = $('#select1').select2();
			  
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