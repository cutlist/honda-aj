<?
	if($submenu == 'A')
		{
		mysql_query("UPDATE x23_claimoli_det SET statuscek='0' WHERE id%2=0 AND nonota=''");	
										
		unset($_SESSION[nokwitansi]);
		unset($_SESSION[nodo]);
		unset($_SESSION[tgldo]);
		unset($_SESSION[nopo]);
		unset($_SESSION[tglpo]);
		unset($_SESSION[nonotaclaim]);
		unset($_SESSION[tglnota]);
		unset($_SESSION[memo]);
		unset($_SESSION[p_tahun]);
		unset($_SESSION[p_bulan]);
		unset($_SESSION[idsupplier]);
		unset($_SESSION[totalqty]);
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notabeli WHERE id%2=0 AND tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
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
			
			$nonota = "NC$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		mysql_query("DELETE FROM x23_notabeli_det WHERE id%2=0 AND nonota='$nonota'");
		
		if(empty($mod))
			{
			if(!empty($_REQUEST[delnota]))
				{
				$q1 = mysql_query("DELETE FROM x23_notabeli WHERE id%2=0 AND id='$_REQUEST[delnota]'");
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
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
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
			                	<h4>PENAGIHAN <small>TAGIHAN OLI KE MPM</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Dilanjutkan Ke Menu Konfirmasi Claim Oli Pada Bagian Gudang Spare Part.</p>";
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
                                    <div style="float:left;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Nota Claim Oli" class="form-control pull-right" id="reservation"/>
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
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Nota Claim Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h2/claimoli.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. KWITANSI CLAIM OLI</th>
			                                    <th style="padding:7px">NO. NOTA CLAIM OLI</th>
			                                    <th style="padding:7px">TGL NOTA CLAIM OLI</th>
			                                    <th style="padding:7px">NO. PO CLAIM MPM</th>
			                                    <th style="padding:7px">TGL PO CLAIM MPM</th>
			                                    <th width="10%" style="padding:7px">TOTAL QTY CLAIM</th>
			                                    <th width="" style="padding:7px">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[periode]))
											{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
				                            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											}
										else
											{
				                            $_SESSION[periode_awal]  = date("Y-m-d");
				                            $_SESSION[periode_akhir] = date("Y-m-d");
											}
										$q1 = mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND jns='CLAIM'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nopo]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <?
			                                                if(empty($dA[qty]) || $dA[qty]=='0')
			                                                	{
															?>
														    	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delnota=$d1[id]&nonota=$d1[nonota]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
			                    </div>
			                </div>
			            </div>
<?
						}
						
					else if($mod == "edit")
						{
						if(!empty($_REQUEST[ubahbarang]))
							{
							$q1 = mysql_query("UPDATE x23_notabeli_det SET
																idgudang='$_REQUEST[idgudang]',
																rak='$_REQUEST[rak]'
															WHERE id%2=0 AND id='$_REQUEST[ubahbarang]'
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
							mysql_query("DELETE FROM x23_notabeli_det WHERE	nonota='$_REQUEST[del]'");
							mysql_query("UPDATE x23_claimoli_det SET nonota='',statuscek='0' WHERE	nonota='$_REQUEST[del]'");
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&save=1'/>";
							exit();
							}
						
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'"));			                           
						$d3 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS hargaoli FROM x23_claimoli_det WHERE id%2=0 AND nonota='$d1[nonota]'"));	
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/penagihanoli.php?nokwitansi=<?echo $d1[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PENAGIHAN <small>OLI KE MPM &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Claim Oli</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" value="MPM" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NO. KWITANSI CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nokwitansi" value="<?echo $d1[nokwitansi]?>" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required style="width:40%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<?
					                    	if($d1[konf]=="0")
					                    		{
											?>
				                           		<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=$mod&id=$_REQUEST[id]&del=$d1[nonota]"?>">
				                           			<button type="button" class="btn btn-info pull-left" onclick="return confirm('Anda yakin akan menghapus seluruh daftar oli?')"><i class="fa fa-trash-o"></i> &nbsp; Hapus Daftar Oli</button>
				                           		</a>
				                           	<?
				                           		}
				                           	?>
											<a href="#" onClick="popup_print()"><button type="button" style="margin-left:10px" class="btn btn-warning pull-left"><i class="fa fa-print"></i> Cetak Kwitansi</button></a>
					                		<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" style="width:150%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">TGL NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">KODE PAKET</th>
			                                    <th style="padding:7px">KPB KE</th>
			                                    <th style="padding:7px">NAMA KPB</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">HARGA OLI</br>PENGGANTIAN (RP)</th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th style="padding:7px">TAGIH KEMBALI</th>
			                                    <th style="padding:7px">KETERANGAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dD1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_claimoli_det WHERE id%2=0 AND id='$d1[id_claimoli_det]'"));
											$dB  = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang]]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$dD1[nonotaservis]"?></label></td>
			                                    <td><?echo date("d-m-Y",strtotime($dD1[tglservis]))?></td>
			                                    <td><?echo $dD1[kodepaket]?></td>
			                                    <td><?echo $dD1[kpbke]?></td>
			                                    <td><?echo $dD1[namakpb]?></td>
			                                    <td><?echo $dD1[kodebarang]?></td>
			                                    <td><?echo "$dD1[namabarang] | $dD1[varian]"?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dD1[hargaoli],"0","",".")?></span></td>
			                                    <td><?echo $dB[gudang]?></td>
			                                    <td><?echo $d1[rak]?></td>
		                                    	<td><?echo $dD1[statusclaim]?></td>
			                                    <td><?echo $dD1[tagihkembali]?></td>
		                                    	<td><?echo $dD1[kettolak]?></td>
			                                </tr>
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d3[hargaoli])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>TOTAL QTY CLAIM</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?> PCS</b></span></td>
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
		
        $dNB = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notabeli WHERE id%2=0 AND tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
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
			
			$nonota = "NC$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
		
        $dPO = mysql_fetch_array(mysql_query("SELECT nopo FROM x23_notabeli WHERE id%2=0 AND tglnota=CURDATE() AND jns='CLAIM' ORDER BY SUBSTR(nopo,-3,3) DESC LIMIT 1"));
            
		if(empty($dPO[nopo]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dPO[nopo]",-3,3);
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
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_notabeli WHERE id%2=0 AND tglnota=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
			$nokwitansi = "KPO$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			$nopo = "POC$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$action = "?opt=$opt&menu=$menu&submenu=C";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENAGIHAN <small>CLAIM OLI &nbsp; <i class="fa fa-angle-right"></i> &nbsp;<?echo $nokwitansi?></small></h4>
			                	
				                	<form method="post" action="<?echo $action?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                	<?
									if(empty($_SESSION[nonotaclaim]))
										{
				                	?>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" value="MPM" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $nopo?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $nonota?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NO. KWITANSI CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nokwitansi" value="<?echo $nokwitansi?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
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
					                    			<td><input type="text" value="MPM" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $nopo?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonotaclaim]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NO. KWITANSI CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nokwitansi" value="<?echo $_SESSION[nokwitansi]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($_SESSION[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($_SESSION[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
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
			$_SESSION[nopo]    = strtoupper($_REQUEST[nopo]);
			$_SESSION[tglpo]   = date("Y-m-d", strtotime($_REQUEST['tglpo']));
			$_SESSION[nonotaclaim]  = strtoupper($_REQUEST[nonota]);
			$_SESSION[tglnota] = date("Y-m-d", strtotime($_REQUEST['tglnota']));
			$_SESSION[p_tahun] = strtoupper($_REQUEST[p_tahun]);
			$_SESSION[p_bulan] = strtoupper($_REQUEST[p_bulan]);
			$_SESSION[nokwitansi] = strtoupper($_REQUEST[nokwitansi]);
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
					                    			<td><input type="text" value="MPM" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonotaclaim]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NO. KWITANSI CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nokwitansi" value="<?echo $_SESSION[nokwitansi]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($_SESSION[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($_SESSION[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&nonota=$_SESSION[nonotaclaim]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">TGL NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">KODE PAKET</th>
			                                    <th style="padding:7px">KPB KE</th>
			                                    <th style="padding:7px">NAMA KPB</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">HARGA OLI</br>PENGGANTIAN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
											  mysql_query("UPDATE x23_claimoli_det SET nonota='' WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'");	
										$q1 = mysql_query("SELECT * FROM x23_claimoli_det WHERE id%2=0 AND nonota=''");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[statuscek]=="0"){
												$checkbox = "<input type='checkbox' class='flat-red' name='scan[]' value='$d1[id]'/>";
												}
											else{
												$checkbox = "<input type='checkbox' class='flat-red' checked='' name='scan[]' value='$d1[id]'/>";
												}
											 
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$checkbox $d1[nonotaservis]"?></label></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglservis]))?></td>
			                                    <td><?echo $d1[kodepaket]?></td>
			                                    <td><?echo $d1[kpbke]?></td>
			                                    <td><?echo $d1[namakpb]?></td>
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian]"?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargaoli],"0","",".")?></span></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
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
		
	else if($submenu == 'D')
		{
		mysql_query("UPDATE x23_claimoli_det SET statuscek='0' WHERE id%2=0 AND nonota=''");	
		foreach($_REQUEST['scan'] AS $scan)
			{
			mysql_query("UPDATE x23_claimoli_det SET statuscek='1',nonota='$_SESSION[nonotaclaim]' WHERE id%2=0 AND id='$scan'");	
			}
			
        mysql_query("DELETE FROM x23_notabeli_det WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'");
		$qT2 = mysql_query("SELECT * FROM x23_claimoli_det WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'");
        while($dT2 = mysql_fetch_array($qT2))
        	{
        	mysql_query("INSERT INTO x23_notabeli_det (
												nonota,
												idbarang,
												hargabelibersih,
												qty,
												id_claimoli_det,
												total)
											VALUE (
												'$_SESSION[nonotaclaim]',
												'$dT2[idbarang]',
												'0',
												'1',
												'$dT2[id]',
												'0')
        				");
        	}
			
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'"));			                           
		$d3 = mysql_fetch_array(mysql_query("SELECT SUM(hargaoli) AS hargaoli FROM x23_claimoli_det WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'"));			                           
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
					                    			<td><input type="text" value="MPM" class="form-control" maxlength="20" style="width:50%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. PO CLAIM MPM</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $_SESSION[nopo]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $_SESSION[nonotaclaim]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>NO. KWITANSI CLAIM OLI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nokwitansi" value="<?echo $_SESSION[nokwitansi]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td width="40%">TGL PO CLAIM MPM</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($_SESSION[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA CLAIM OLI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($_SESSION[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask  readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="totalqty" value="<?echo $d2[qty]?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&nonota=$_SESSION[nonotaclaim]&direct=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			                                    <th style="padding:7px">NO. NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">TGL NOTA</br>SERVIS</th>
			                                    <th style="padding:7px">KODE PAKET</th>
			                                    <th style="padding:7px">KPB KE</th>
			                                    <th style="padding:7px">NAMA KPB</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">HARGA OLI</br>PENGGANTIAN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dD1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_claimoli_det WHERE id%2=0 AND id='$d1[id_claimoli_det]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><label><?echo "$dD1[nonotaservis]"?></label></td>
			                                    <td><?echo date("d-m-Y",strtotime($dD1[tglservis]))?></td>
			                                    <td><?echo $dD1[kodepaket]?></td>
			                                    <td><?echo $dD1[kpbke]?></td>
			                                    <td><?echo $dD1[namakpb]?></td>
			                                    <td><?echo $dD1[kodebarang]?></td>
			                                    <td><?echo "$dD1[namabarang] | $dD1[varian]"?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dD1[hargaoli],"0","",".")?></span></td>
			                                </tr>
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d3[hargaoli])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="6"></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>TOTAL QTY CLAIM</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?> PCS</b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
					?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'E')
		{
		$q1 = mysql_query("INSERT INTO x23_notabeli (
										jns,
										nokwitansi,
										nonota,
										tahun,
										bulan,
										tglnota,
										nopo,
										tglpo,
										totalqty,
										grandtotal,
										iduserbeli,
										inputx,
										updatex)
									VALUES (
										'CLAIM',
										'$_SESSION[nokwitansi]',
										'$_SESSION[nonotaclaim]',
										'$_SESSION[p_tahun]',
										'$_SESSION[p_bulan]',
										'$_SESSION[tglnota]',
										'$_SESSION[nopo]',
										'$_SESSION[tglpo]',
										'$_REQUEST[totalqty]',
										'0',
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
                                    'TAMBAH NOTA BELI $_SESSION[nonotaclaim]')
						");
		echo "			
		<script type='text/javascript'>
			window.open('printaj/penagihanoli.php?nokwitansi=$_SESSION[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
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
		
	else if($submenu == 'F')
		{
		//$_SESSION[idsupplier]    = strtoupper($_REQUEST[idsupplier]);
		//$_SESSION[nopo]    = strtoupper($_REQUEST[nopo]);nopo='$_SESSION[nopo]',
		$_SESSION[tglpo]   = date("Y-m-d", strtotime($_REQUEST['tglpo']));
		$_SESSION[nonotaclaim]  = strtoupper($_REQUEST[nonota]);
		$_SESSION[tglnota] = date("Y-m-d", strtotime($_REQUEST['tglnota']));
			
		$q1 = mysql_query("UPDATE x23_notabeli SET 
										tglnota='$_SESSION[tglnota]',
										tglpo='$_SESSION[tglpo]',
										totalqty='$_REQUEST[totalqty]',
										grandtotal='$_REQUEST[grandtotal]',
										updatex='$updatex'
									WHERE id%2=0 AND nonota='$_SESSION[nonotaclaim]'
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
	
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
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