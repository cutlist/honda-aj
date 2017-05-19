<?
	if($submenu == 'A')
		{
		mysql_query("DELETE FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
		
		unset($_SESSION[notransfer]);
		unset($_SESSION[tgltransfer]);
		unset($_SESSION[idtujuan]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM tbl_notabeli WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
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
			
		mysql_query("DELETE FROM tbl_notabeli_det WHERE nonota='$nonota'");
		
		if(empty($mod))
			{
			if(!empty($_REQUEST[delnota]))
				{
				$q1 = mysql_query("DELETE FROM tbl_notabeli WHERE id='$_REQUEST[delnota]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notabeli',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS BARANG KELUAR $_REQUEST[nonota]')
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
			                	<h4>MUTASI <small>BARANG KELUAR</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="60%"><input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA MUTASI KELUAR ..." class="form-control"/>
		                                        </td>
				                        		<td><select name="idtujuan" style="font-size:12px;padding:3px;height:34px" class="form-control">
																	<option value='' selected>SEMUA TUJUAN</option>
																	<?
																		$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value="<?echo $dA[id]?>" <?if($dA[id]==$_REQUEST[idtujuan]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																	<?
																			}
																	?>
															    </select></td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Mutasi Barang Keluar Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
											{
										?>
	                           				<button type="button"  onclick="window.open('printaj/h1/transferbrgkeluar.php?cari=<?echo $_REQUEST[cari]?>&idtujuan=<?echo $_REQUEST[idtujuan]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
							 
			                        <table id="example3" class="table table-striped table-hover" style="width:140%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA MUTASI KELUAR <?//echo $_REQUEST[idtujuan];?></th>
			                                    <th style="padding:7px">TGL NOTA MUTASI KELUAR</th>
			                                    <th style="padding:7px">TUJUAN MUTASI KELUAR</th>
			                                    <th width="" style="padding:7px">QTY MUTASI KELUAR (UNIT)</th>
			                                    <th style="padding:7px">GRAND TOTAL MUTASI KELUAR (RP)</th>
			                                    <th style="padding:7px">GRAND TOTAL MUTASI KELUAR + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]) AND !empty($_REQUEST[idtujuan]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='KELUAR' AND notransfer LIKE '%$_REQUEST[cari]%' AND idtujuan='$_REQUEST[idtujuan]' GROUP BY notransfer LIMIT 0,20");
											}
										if(!empty($_REQUEST[cari]) AND empty($_REQUEST[idtujuan]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='KELUAR' AND notransfer LIKE '%$_REQUEST[cari]%' GROUP BY notransfer LIMIT 0,20");
											}
										if(empty($_REQUEST[cari]) AND empty($_REQUEST[idtujuan]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='KELUAR' GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
										if(empty($_REQUEST[cari]) AND !empty($_REQUEST[idtujuan]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='KELUAR' AND idtujuan='$_REQUEST[idtujuan]' GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idtujuan]'"));
			                            ?>
			                                <tr style="cursor:pointer"  onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&notransfer=$d1[notransfer]"?>'">
			                                    <td><?echo $d1[notransfer]?></td>
			                                    <td><?echo $d1[tgltransfer]?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[harga]+$d1[ppn],"0","",".")?></span></td>
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
						
					else if($mod == "edit")
						{
						if(!empty($_REQUEST[del]))
							{
							mysql_query("DELETE FROM tbl_transfer WHERE	norangka='$_REQUEST[del]'");
							mysql_query("UPDATE tbl_stokunit SET status='STOK' WHERE norangka='$_REQUEST[del]'");
							}
							
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_GET[notransfer]' GROUP BY notransfer"));
							
						if(!empty($_REQUEST[tambahbarang]))
							{
							$norangka 	= strtoupper($_REQUEST['norangka']);
							$dcek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transfer WHERE norangka='$norangka'"));		
							if($dcek[id])
								{
								echo "<script>alert ('Nomor Rangka Sudah Diinput.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&notransfer=$_GET[notransfer]'/>";
								exit();
								}
							
							$dcs  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$norangka'"));	
							
							mysql_query("UPDATE tbl_stokunit SET status='MUTASI' WHERE norangka='$norangka'");
							$q1 = mysql_query("INSERT INTO tbl_transfer (
																jenis,
																notransfer,
																tgltransfer,
																idtujuan,
																idbarang,
																norangka,
																nomesin,
																harga,
																ppn,status)
															VALUE (
																'KELUAR',
																'$_GET[notransfer]',
																'$d1[tgltransfer]',
																'$d1[idtujuan]',
																'$dcs[idbarang]',
																'$dcs[norangka]',
																'$dcs[nomesin]',
																'$dcs[hargabelibersih]',
																'$dcs[ppn]','1')
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
							
						$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_GET[notransfer]' GROUP BY notransfer"));
						$ppn = ROUND($dB[total] * 0.1,0);
						
						if(empty($dB[qty]))
							{
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
							exit();
							}
					?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/transferkeluar.php?notransfer=<?echo $d1[notransfer]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MUTASI <small>BARANG KELUAR &nbsp;</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="55%">NO. NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" value="<?echo $d1[notransfer]?>" readonly="" class="form-control" maxlength="40" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">TUJUAN MUTASI KELUAR</td>
					                        		<td width="">:</td>
					                        		<td><select name="idtujuan" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d1[idtujuan]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" readonly="" value="<?echo date("d-m-Y", strtotime($d1[tgltransfer]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" readonly style="width:100%;height:90px"><?echo $_SESSION[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">	
											<!--				                    	
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Barang</button>
											</a>
											-->
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Mutasi Keluar</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <?
						$dA1 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_accu WHERE nonota='$d1[notransfer]'"));
						$dA2 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_alaskaki WHERE nonota='$d1[notransfer]'"));
						$dA3 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_anakkunci WHERE nonota='$d1[notransfer]'"));
						$dA4 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_helm WHERE nonota='$d1[notransfer]'"));
						$dA5 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_spion WHERE nonota='$d1[notransfer]'"));
						$dA6 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_toolkit WHERE nonota='$d1[notransfer]'"));
						$dA7 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_jaket WHERE nonota='$d1[notransfer]'"));
						$dA8 = mysql_fetch_array(mysql_query("SELECT jual FROM stok_bukuservis WHERE nonota='$d1[notransfer]'"));
							
						?>
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" value="<?echo $dA4[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="bukuservis" value="<?echo $dA8[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $dA5[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" value="<?echo $dA1[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>JAKET</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="jaket" value="<?echo $dA7[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $dA6[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="anakkunci" value="<?echo $dA3[jual]?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="<?echo $dA2[jual]?>" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA MUTASI KELUAR (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>PPN (RP)</center></th>
												<!--
			                                    <th width="" style="padding:7px"><center>DEL</center></th>
												-->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_GET[notransfer]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[warna]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
												<!--
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&notransfer=$_GET[notransfer]&del=$d1[norangka]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a></td>
			                               		-->
										    </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI KELUAR (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI KELUAR + PPN (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">TOTAL QTY MUTASI KELUAR</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		-->
			                            		<th colspan="2"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH BARANG</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NO. RANGKA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="norangka" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_stokunit WHERE status='STOK' AND norangka NOT IN (SELECT norangka FROM tbl_transfer WHERE notransfer='$_GET[notransfer]') ORDER BY norangka");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[norangka]?>'><?echo "$dA[norangka]"?></option>
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
			
        $dNB = mysql_fetch_array(mysql_query("SELECT notransfer FROM tbl_transfer WHERE tgltransfer=CURDATE() ORDER BY SUBSTR(notransfer,-3,3) DESC LIMIT 1"));
            
		if(empty($dNB[notransfer]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNB[notransfer]",-3,3);
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
			
			$notransfer = "NT$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$action = "?opt=$opt&menu=$menu&submenu=C";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MUTASI <small>BARANG KELUAR &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Mutasi Keluar</small></h4>
			                	
				                	<form method="post" action="<?echo $action?>" enctype="multipart/form-data">
				                	<div style="padding:20px 0px">
				                	<?
									if(empty($_SESSION[notransfer]))
										{
				                	?>
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="55%">NO. NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" readonly="" value="<?echo $notransfer?>" class="form-control" maxlength="40" style="width:100%" required></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">TUJUAN MUTASI KELUAR</td>
					                        		<td width="">:</td>
					                        		<td><select name="idtujuan" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$_SESSION[idtujuan]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" readonly="" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height: 90px"><?echo $_SESSION[memo]?></textarea></td>
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
					                        		<td width="55%">NO. NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" readonly="" value="<?echo $_SESSION[notransfer]?>" class="form-control" maxlength="40" style="width:100%" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">TUJUAN MUTASI</td>
					                        		<td width="">:</td>
					                        		<td><select name="idtujuan" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$_SESSION[idtujuan]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" readonly value="<?echo date("d-m-Y", strtotime($_SESSION[tgltransfer]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:70%"></td>
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
			$_SESSION[notransfer]    = strtoupper($_REQUEST[notransfer]);
			$_SESSION[tgltransfer]   = date("Y-m-d", strtotime($_REQUEST['tgltransfer']));
			$_SESSION[idtujuan]    = $_REQUEST[idtujuan];
			$_SESSION[memo]    = strtoupper($_REQUEST[memo]);
			$_SESSION[p_tahun] = strtoupper($_REQUEST[p_tahun]);
			$_SESSION[p_bulan] = strtoupper($_REQUEST[p_bulan]);
			}
		
		if(!empty($_REQUEST[tambahbarang]))
			{
			$norangka 	= strtoupper($_REQUEST['norangka']);
			$dcek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transfer WHERE norangka='$norangka' AND jenis='KELUAR'"));		
			if($dcek[id])
				{
				echo "<script>alert ('Nomor Rangka Sudah Diinput.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			
			$dcs  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$norangka'"));	
			
			$q1 = mysql_query("INSERT INTO tbl_transfer (
												jenis,
												notransfer,
												tgltransfer,
												idtujuan,
												idbarang,
												norangka,
												nomesin,
												harga,
												ppn)
											VALUE (
												'KELUAR',
												'$_SESSION[notransfer]',
												'$_SESSION[tgltransfer]',
												'$_SESSION[idtujuan]',
												'$dcs[idbarang]',
												'$dcs[norangka]',
												'$dcs[nomesin]',
												'$dcs[hargabelibersih]',
												'$dcs[ppn]')
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
			
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM tbl_transfer WHERE	id='$_REQUEST[del]'");
			}
					                           
		$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'"));
		$ppn = ROUND($dB[total] * 0.1,0);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MUTASI <small>BARANG KELUAR &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Mutasi Keluar</small></h4>
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="55%">NO. NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" value="<?echo $_SESSION[notransfer]?>" class="form-control" maxlength="40" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">TUJUAN MUTASI KELUAR</td>
					                        		<td width="">:</td>
					                        		<td><select name="idtujuan" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$_SESSION[idtujuan]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI KELUAR</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" value="<?echo date("d-m-Y", strtotime($_SESSION[tgltransfer]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height: 90px" readonly><?echo $_SESSION[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $dB[qty]?>">
											<button type="submit" class="btn btn-info"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&notransfer=$_SESSION[notransfer]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Barang</button>
											</a>
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" width="130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA MUTASI KELUAR (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>PPN (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[warna]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI KELUAR (RP)</th>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		-->
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI KELUAR + PPN (RP)</th>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		-->
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">TOTAL QTY MUTASI KELUAR</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		-->
			                            		<th colspan="2"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH BARANG</h4>
				                    </div>
									
			                        <script>
			                        var norangka = new Array();
			                        var idgudang = new Array();
									var nomesin = new Array();
									var kodebarang = new Array();
									var namabarang = new Array();
									var varian = new Array();
									var warna = new Array();
									var hargabelibersih = new Array();

									norangka[0] = "";
									idgudang[0] = "";
									nomesin[0] = "";
									kodebarang[0] = "";
									namabarang[0] = "";
									varian[0] = "";
									warna[0] = "";
									hargabelibersih[0] = "";
									
									<?
										$no = 1;
										$qB = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE status='STOK' AND norangka NOT IN (SELECT norangka FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]') ORDER BY norangka");
										while($dB=mysql_fetch_array($qB))
											{
											$dG = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$dB[idgudang]'"));
									?>
											norangka[<?echo $no;?>] = "<?echo $dB[norangka];?>";
											idgudang[<?echo $no;?>] = "<?echo $dG[gudang];?>";
											nomesin[<?echo $no;?>] = "<?echo $dB[nomesin];?>";
											kodebarang[<?echo $no;?>] = "<?echo $dB[kodebarang];?>";
											namabarang[<?echo $no;?>] = "<?echo $dB[namabarang];?>";
											varian[<?echo $no;?>] = "<?echo $dB[varian];?>";
											warna[<?echo $no;?>] = "<?echo $dB[warna];?>";
											hargabelibersih[<?echo $no;?>] = "<?echo $dB[hargabelibersih];?>";
									<?
											$no++;
											}
									?>

									        function Choice() {
									            //x = document.getElementById("users");
									            y = document.getElementById("selectAuto");

									              //x.value = y.options[y.selectedIndex].text;
									              document.getElementById("norangka").value = norangka[y.selectedIndex];
									              document.getElementById("idgudang").value = idgudang[y.selectedIndex];
									              document.getElementById("nomesin").value = nomesin[y.selectedIndex];
									              document.getElementById("kodebarang").value = kodebarang[y.selectedIndex];
									              document.getElementById("namabarang").value = namabarang[y.selectedIndex];
									              document.getElementById("varian").value = varian[y.selectedIndex];
									              document.getElementById("warna").value = warna[y.selectedIndex];
									              document.getElementById("hargabelibersih").value = formatAngka(hargabelibersih[y.selectedIndex]);
									         }

									        </script>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">NO. RANGKA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select id="selectAuto" name="no" class="form-control select1" style="font-size:12px;padding:3px" onChange='Choice();' required=""><option value='' selected>Pilih</option>
																		<?
																			$no = 1;
																			$q1 = mysql_query("SELECT * FROM tbl_stokunit WHERE status='STOK' AND norangka NOT IN (SELECT norangka FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]') ORDER BY norangka");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo "$no"?>"><?echo "$dA[norangka]"?></option>
																		<?
																				$no++;
																				}
																		?>
																    </select></td>
				                    			<input type="hidden" id="norangka" name="norangka" >
				                    		</tr>
				                    		<tr>
				                    			<td>KODE BARANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" id="kodebarang" name="kodebarang" style="width:100%;" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA BARANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" id="namabarang" name="namabarang" style="width:100%;" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>VARIAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" id="varian" name="varian" style="width:100%;" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>WARNA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" id="warna" name="warna" style="width:60%;" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR MESIN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" id="nomesin" name="nomesin" style="width:60%;" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG ASAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" id="idgudang" name="idgudang" style="width:60%;" class="form-control" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA BELI BERSIH</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" id="hargabelibersih" name="hargabelibersih" class="form-control uang" placeholder="0" style="width:50%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
						                        </td>
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
		$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'"));
		$ppn = ROUND($dB[total] * 0.1,0);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MUTASI <small>BARANG KELUAR &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Mutasi Keluar</small></h4>
						            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E"?>">
						            <?
									$h1 = $dB[qty];
									$h2 = $dB[qty]*2;
						            ?>
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="bukuservis" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $h2?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>JAKET</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="jaket" value="0" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="anakkunci" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="0" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $dB[qty]?>">
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&notransfer=$_SESSION[notransfer]&direct=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" width="130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th width="" style="padding:7px"><center>HARGA MUTASI KELUAR (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>PPN (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[warna]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI KELUAR (RP)</th>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		-->
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
			                            		<td colspan=""></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI KELUAR + PPN (RP)</th>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		-->
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
			                            		<td colspan=""></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="" align="right">TOTAL QTY MUTASI KELUAR</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
			                            		<td colspan=""></td>
			                                 </tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'E')
		{
		if(empty($_REQUEST[qty]))
			{
			echo "<script>alert ('Proses Gagal, Mohon Tambah Detail Barang Terlebih Dahulu.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&direct=1'/>";
			exit();
			}
			
			mysql_query("UPDATE tbl_transfer SET status='1',idtujuan='$_SESSION[idtujuan]' WHERE notransfer='$_SESSION[notransfer]'");
			$q = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
			while($d = mysql_fetch_array($q))
				{
				mysql_query("UPDATE tbl_stokunit SET status='MUTASI' WHERE norangka='$d[norangka]'");
				}
				
		$q2 = mysql_query("INSERT INTO stok_accu VALUES ('$_SESSION[notransfer]','','$_REQUEST[accu]')");
		
		$q3 = mysql_query("INSERT INTO stok_alaskaki VALUES ('$_SESSION[notransfer]','','$_REQUEST[alaskaki]')");
		
		$q4 = mysql_query("INSERT INTO stok_anakkunci VALUES ('$_SESSION[notransfer]','','$_REQUEST[anakkunci]')");
		
		$q5 = mysql_query("INSERT INTO stok_helm VALUES ('$_SESSION[notransfer]','','$_REQUEST[helm]')");
		
		$q6 = mysql_query("INSERT INTO stok_spion VALUES ('$_SESSION[notransfer]','','$_REQUEST[spion]')");
		
		$q7 = mysql_query("INSERT INTO stok_toolkit VALUES ('$_SESSION[notransfer]','','$_REQUEST[toolkit]')");
		
		$q8 = mysql_query("INSERT INTO stok_jaket VALUES ('$_SESSION[notransfer]','','$_REQUEST[jaket]')");
		
		$q9 = mysql_query("INSERT INTO stok_bukuservis VALUES ('$_SESSION[notransfer]','','$_REQUEST[bukuservis]')");
			
		$q10 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'tbl_transfer',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'TAMBAH MUTASI KELUAR $_SESSION[notransfer]')
						");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/transferkeluar.php?notransfer=$_SESSION[notransfer]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
					
		unset($_SESSION[notransfer]);
		unset($_SESSION[tgltransfer]);
		unset($_SESSION[idtujuan]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
		
		if($q2)
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
		
	else if($submenu == 'F')
		{
		mysql_query("DELETE FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
		
		unset($_SESSION[notransfer]);
		unset($_SESSION[tgltransfer]);
		unset($_SESSION[idasal]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
		if(empty($mod))
			{
			if(!empty($_REQUEST[delnota]))
				{
				$q1 = mysql_query("DELETE FROM tbl_notabeli WHERE id='$_REQUEST[delnota]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_notabeli',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS BARANG KELUAR $_REQUEST[nonota]')
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
			                	<h4>MUTASI <small>BARANG MASUK</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="60%"><input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA MUTASI MASUK ..." class="form-control"/>
		                                        </td>
				                        		<td><select name="idasal" style="font-size:12px;padding:3px;height:34px" class="form-control">
																	<option value='' selected>SEMUA ASAL</option>
																	<?
																		$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value="<?echo $dA[id]?>" <?if($dA[id]==$_REQUEST[idasal]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																	<?
																			}
																	?>
															    </select></td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=G"?>" style="cursor:pointer">
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Mutasi Barang Masuk Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
	                           				<button type="button"  onclick="window.open('printaj/h1/transferbrgmasuk.php?cari=<?echo $_REQUEST[cari]?>&idasal=<?echo $_REQUEST[idasal]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover" style="width:140%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA MUTASI MASUK<?//echo "$_REQUEST[idasal].$_REQUEST[cari]"?></th>
			                                    <th style="padding:7px">TGL NOTA MUTASI MASUK</th>
			                                    <th style="padding:7px">ASAL MUTASI</th>
			                                    <th width="" style="padding:7px">QTY MUTASI MASUK (UNIT)</th>
			                                    <th style="padding:7px">GRAND TOTAL MUTASI MASUK (RP)</th>
			                                    <th style="padding:7px">GRAND TOTAL MUTASI MASUK + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]) AND !empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='MASUK' AND notransfer LIKE '%$_REQUEST[cari]%' AND idasal='$_REQUEST[idasal]' GROUP BY notransfer LIMIT 0,20");
											}
										if(!empty($_REQUEST[cari]) AND empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='MASUK' AND (notransfer LIKE '%$_REQUEST[cari]%') GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
										if(empty($_REQUEST[cari]) AND empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='MASUK' GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
										if(empty($_REQUEST[cari]) AND !empty($_REQUEST[idasal]))
											{
											$q1 = mysql_query("SELECT *,COUNT(id) AS qty,SUM(harga) AS harga,SUM(ppn) AS ppn FROM tbl_transfer WHERE id%2=0 AND jenis='MASUK' AND idasal='$_REQUEST[idasal]' GROUP BY notransfer ORDER BY id DESC LIMIT 0,20");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idasal]'"));
			                            ?>
			                                <tr style="cursor:pointer"  onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&notransfer=$d1[notransfer]"?>'">
			                                    <td><?echo $d1[notransfer]?></td>
			                                    <td><?echo $d1[tgltransfer]?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[harga]+$d1[ppn],"0","",".")?></span></td>
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
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_GET[notransfer]' GROUP BY notransfer"));
						$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_GET[notransfer]' GROUP BY notransfer"));
						$ppn = ROUND($dB[total] * 0.1,0);
						
						if(empty($dB[qty]))
							{
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
							exit();
							}
					?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/transfermasuk.php?notransfer=<?echo $d1[notransfer]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MUTASI <small>BARANG MASUK</small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" value="<?echo $d1[notransfer]?>" class="form-control" maxlength="40" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">ASAL MUTASI</td>
					                        		<td width="">:</td>
					                        		<td><select name="idtujuan" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$d1[idasal]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" value="<?echo date("d-m-Y", strtotime($d1[tgltransfer]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" readonly style="width:100%;height:90px;"><?echo $_SESSION[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">					                    	
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=F"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<button type="button" class="btn btn-info" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Mutasi Masuk</button>
					                	</div>
				                    </div>
				                </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" width="130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">GUDANG TUJUAN</th>
			                                    <th style="padding:7px"><center>HARGA MUTASI MASUK (RP)</center></th>
			                                    <th style="padding:7px"><center>PPN (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_GET[notransfer]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$d1[idgudangtujuan]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[warna]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td><?echo $d3[gudang]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI MASUK (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<th colspan="" align="right">GRAND TOTAL MUTASI MASUK + PPN (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<th colspan="" align="right">TOTAL QTY MUTASI MASUK</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
			                                    <!--
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		-->
			                            		<th colspan="2"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH BARANG</h4>
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
				                    			<td>NO. RANGKA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="norangka" style="width:40%;" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. MESIN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nomesin" style="width:40%;" class="form-control"  required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>HARGA MUTASI MASUK</td>
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
				                    			<td>QTY MUTASI (UNIT)</td>
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
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'G')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNB = mysql_fetch_array(mysql_query("SELECT notransfer FROM tbl_transfer WHERE tgltransfer=CURDATE() ORDER BY SUBSTR(notransfer,-3,3) DESC LIMIT 1"));
            
		if(empty($dNB[notransfer]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNB[notransfer]",-3,3);
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
			
			$notransfer = "NT$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$action = "?opt=$opt&menu=$menu&submenu=H";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MUTASI <small>BARANG MASUK &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Mutasi Masuk</small></h4>
			                	
				                	<form method="post" action="<?echo $action?>" enctype="multipart/form-data">
				                	<div style="padding:20px 0px">
				                	<?
									if(empty($_SESSION[notransfer]))
										{
				                	?>
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" value="<?echo $notransfer?>" class="form-control" maxlength="40" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">ASAL MUTASI</td>
					                        		<td width="">:</td>
					                        		<td><select name="idasal" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$_SESSION[idasal]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
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
					                        		<td width="40%">NO. NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" value="<?echo $_SESSION[notransfer]?>" class="form-control" maxlength="40" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">ASAL MUTASI</td>
					                        		<td width="">:</td>
					                        		<td><select name="idasal" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$_SESSION[idasal]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" value="<?echo date("d-m-Y", strtotime($_SESSION[tgltransfer]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px;"><?echo $_SESSION[memo]?></textarea></td>
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
					                        
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=F"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'H')
		{
		if(empty($_REQUEST[direct]) && empty($_REQUEST[tambahbarang]) && empty($_REQUEST[del]) && empty($_REQUEST[ubahbarang]))
			{
			$_SESSION[notransfer]    = strtoupper($_REQUEST[notransfer]);
			$_SESSION[tgltransfer]   = date("Y-m-d", strtotime($_REQUEST['tgltransfer']));
			$_SESSION[idasal]    = $_REQUEST[idasal];
			$_SESSION[memo]    = strtoupper($_REQUEST[memo]);
			$_SESSION[p_tahun] = strtoupper($_REQUEST[p_tahun]);
			$_SESSION[p_bulan] = strtoupper($_REQUEST[p_bulan]);
			}
		
		if(!empty($_REQUEST[tambahbarang]))
			{
			$norangka 	= strtoupper($_REQUEST['norangka']);
			$nomesin 	= strtoupper($_REQUEST['nomesin']);
			/*
			$dcs = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli_det WHERE norangka='$norangka'"));	
			if(!empty($dcs[norangka]))
				{
				echo "<script>alert ('Barang Sudah Pernah Diinput Dalam Stok!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			*/
			$hargabelibersih 	= preg_replace( "/[^0-9]/", "",$_REQUEST['hargabelibersih']);
			$ppn1 = 	ROUND(($hargabelibersih*10)/100);	                           
								
			if($hargabelibersih=='0')
				{
				echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
				
			
			$dcek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transfer WHERE norangka='$norangka' AND jenis='MASUK'"));		
			if($dcek[id])
				{
				echo "<script>alert ('Nomor Rangka Sudah Diinput.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&direct=1'/>";
				exit();
				}
			
			$q1 = mysql_query("INSERT INTO tbl_transfer (
												jenis,
												notransfer,
												tgltransfer,
												idasal,
												idgudangtujuan,
												idbarang,
												norangka,
												nomesin,
												harga,
												ppn)
											VALUE (
												'MASUK',
												'$_SESSION[notransfer]',
												'$_SESSION[tgltransfer]',
												'$_SESSION[idasal]',
												'$_REQUEST[idgudang]',
												'$_REQUEST[idbarang]',
												'$norangka',
												'$nomesin',
												'$hargabelibersih',
												'$ppn1')
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
			
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM tbl_transfer WHERE	id='$_REQUEST[del]'");
			}
					                           
		$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'"));
		$ppn = ROUND($dB[total] * 0.1,0);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MUTASI <small>BARANG MASUK &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Mutasi Masuk</small></h4>
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="notransfer" value="<?echo $_SESSION[notransfer]?>" class="form-control" maxlength="40" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="">ASAL MUTASI</td>
					                        		<td width="">:</td>
					                        		<td><select name="idasal" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_pelanggan WHERE grup='1' ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>" <?if($dA[id]==$_SESSION[idasal]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL NOTA MUTASI MASUK</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgltransfer" value="<?echo date("d-m-Y", strtotime($_SESSION[tgltransfer]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px;" readonly><?echo $_SESSION[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=I"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $dB[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $dB[total]?>">
					                    	<input type="hidden" name="grandtotalppn" value="<?echo $ppn+$dB[total]?>">
											<button type="submit" class="btn btn-info"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=G&notransfer=$_SESSION[notransfer]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
											<a data-toggle="modal" data-target="#compose-modal-tambah-barang" style="cursor:pointer">
		                           				<button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Barang</button>
											</a>
					                	</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">GUDANG TUJUAN</th>
			                                    <th width="" style="padding:7px"><center>HARGA MUTASI</br>MASUK (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>PPN (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$d1[idgudangtujuan]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[warna]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td><?echo $d3[gudang]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="2" align="right">GRAND TOTAL MUTASI MASUK (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="2" align="right">GRAND TOTAL MUTASI MASUK + PPN (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="2" align="right">TOTAL QTY MUTASI MASUK</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>

<!-- ################## MODAL TAMBAH BARANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-tambah-barang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH BARANG</h4>
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
																					<option value='<?echo $dA[id]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian] $dA[warna]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG TUJUAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:50%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
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
				                    			<td>NO. RANGKA</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="norangka" style="width:40%;" class="form-control" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. MESIN</td>
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
				                    			<td>QTY MUTASI (UNIT)</td>
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
		
	else if($submenu == 'I')
		{
		$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty, SUM(harga) AS total FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'"));
		$ppn = ROUND($dB[total] * 0.1,0);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>MUTASI <small>BARANG MASUK &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Input Mutasi Masuk</small></h4>
						            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=J"?>">
						            <?
									$h1 = $dB[qty];
									$h2 = $dB[qty]*2;
						            ?>
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="bukuservis" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $h2?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>JAKET</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="jaket" value="0" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="anakkunci" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="0" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $dB[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $dB[total]?>">
					                    	<input type="hidden" name="grandtotalppn" value="<?echo $ppn+$dB[total]?>">
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=H&notransfer=$_SESSION[notransfer]&direct=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px" width="23%">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">GUDANG TUJUAN</th>
			                                    <th width="" style="padding:7px"><center>HARGA MUTASI</br>MASUK (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>PPN (RP)</center></th>
			                                 </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$d1[idgudangtujuan]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d2[kodebarang]?></td>
			                                    <td><?echo $d2[namabarang]?></td>
			                                    <td><?echo $d2[varian]?></td>
			                                    <td><?echo $d2[warna]?></td>
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td><?echo $d3[gudang]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[harga],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[ppn],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="2" align="right">GRAND TOTAL MUTASI MASUK (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[total])?></b></span></td>
			                            		<th colspan="1"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="2" align="right">GRAND TOTAL MUTASI MASUK + PPN (RP)</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppn+$dB[total])?></b></span></td>
			                            		<th colspan="1"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="5"></th>
			                            		<th colspan="2" align="right">TOTAL QTY MUTASI MASUK</th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[qty])?> UNIT</b></span></td>
			                            		<th colspan="1"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'J')
		{
		if(empty($_REQUEST[qty]))
			{
			echo "<script>alert ('Proses Gagal, Mohon Tambah Detail Barang Terlebih Dahulu.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=H&direct=1'/>";
			exit();
			}
			
		mysql_query("UPDATE tbl_transfer SET status='1',idasal='$_SESSION[idasal]' WHERE notransfer='$_SESSION[notransfer]'");
		$q = mysql_query("SELECT * FROM tbl_transfer WHERE notransfer='$_SESSION[notransfer]'");
		while($dA = mysql_fetch_array($q))
			{
        	$bulan = substr($dA[tgltransfer],5,2);
        	$tahun = substr($dA[tgltransfer],0,4);
        	mysql_query("INSERT INTO tbl_stokunit (
        									tahun, 
        									bulan, 
        									tgltiba, 
        									idgudang, 
        									nonota, 
        									idbarang, 
        									norangka, 
        									nomesin, 
        									hargabelibersih, 
        									ppn, 
        									status, 
        									inputx,
        									iduser,
        									updatex) 
        								VALUES (
        									'$tahun', 
        									'$bulan', 
        									'$dA[tgltransfer]', 
        									'$dA[idgudangtujuan]', 
        									'$dA[notransfer]', 
        									'$dA[idbarang]', 
        									'$dA[norangka]', 
        									'$dA[nomesin]', 
        									'$dA[harga]', 
        									'$dA[ppn]', 
        									'STOK',
        									NOW(),
        									'$_SESSION[id]',
        									'$updatex')
        				");
        				
			mysql_query("INSERT INTO tbl_notabeli_det (
											nonota,
											idbarang,
											hargabelibersih,
											ppn,
											norangka,
											nomesin,
											status,
											tgltiba,
											idgudang,
											qty)
										VALUE (
											'$_SESSION[notransfer]',
											'$dA[idbarang]',
											'$dA[harga]',
											'$dA[ppn]',
        									'$dA[norangka]', 
        									'$dA[nomesin]', 
        									'1', 
        									'$dA[tgltransfer]', 
        									'$dA[idgudangtujuan]', 
											'1')
						");
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
										scan,
										status,
										updatex)
									VALUES (
										'$_SESSION[notransfer]',
										'$_SESSION[p_tahun]',
										'$_SESSION[p_bulan]',
										'$_SESSION[tgltransfer]',
										'',
										'',
										'',
										'',
										'$_SESSION[memo]',
										'$_REQUEST[qty]',
										'$_REQUEST[grandtotal]',
										'$_REQUEST[grandtotalppn]',
										'$_SESSION[id]',
										NOW(),
										'1',
										'1',
										'$updatex')
						");
				
		$q2 = mysql_query("INSERT INTO stok_accu VALUES ('$_SESSION[notransfer]','$_REQUEST[accu]','')");
		
		$q3 = mysql_query("INSERT INTO stok_alaskaki VALUES ('$_SESSION[notransfer]','$_REQUEST[alaskaki]','')");
		
		$q4 = mysql_query("INSERT INTO stok_anakkunci VALUES ('$_SESSION[notransfer]','$_REQUEST[anakkunci]','')");
		
		$q5 = mysql_query("INSERT INTO stok_helm VALUES ('$_SESSION[notransfer]','$_REQUEST[helm]','')");
		
		$q6 = mysql_query("INSERT INTO stok_spion VALUES ('$_SESSION[notransfer]','$_REQUEST[spion]','')");
		
		$q7 = mysql_query("INSERT INTO stok_toolkit VALUES ('$_SESSION[notransfer]','$_REQUEST[toolkit]','')");
		
		$q8 = mysql_query("INSERT INTO stok_jaket VALUES ('$_SESSION[notransfer]','$_REQUEST[jaket]','')");
		
		$q9 = mysql_query("INSERT INTO stok_bukuservis VALUES ('$_SESSION[notransfer]','$_REQUEST[bukuservis]','')");

		$q10 = mysql_query("INSERT INTO log_act VALUES (										
                                    '',
                                    'tbl_notabeli',
                                    CURDATE(),
                                    CURTIME(),
                                    '$_SESSION[user]',
                                    'TAMBAH NOTA BELI $_SESSION[nonota]')
						");
		
		unset($_SESSION[notransfer]);
		unset($_SESSION[tgltransfer]);
		unset($_SESSION[idasal]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
					
		if($q1 && $q2)
			{
			//echo "<script>alert ('Proses Berhasil, Mohon Melanjutkan Ke Menu Konfirmasi Nota Beli Pada Bagian Gudang & PDI.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=F&note=1'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=H&direct=1'/>";
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
	
        <script src="http://labs.creative-area.net/jquery.formautofill/jquery.formautofill.min.js"></script>