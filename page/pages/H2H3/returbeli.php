<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> DAFTAR RETUR BELI</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Dilanjutkan Ke Menu Konfirmasi Retur Beli Pada Bagian Gudang Spare Part.</p>";
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
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA RETUR BELI / NO. PO / NAMA SUPPLIER ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A2"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Retur Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/returbeli.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example4" class="table table-striped" style="width:160%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="8%">NO. NOTA RETUR BELI</th>
			                                    <th style="padding:7px" width="8%">TGL NOTA RETUR BELI</th>
			                                    <th style="padding:7px" width="11%">NO. NOTA BELI</th>
			                                    <th style="padding:7px" width="8%">TGL NOTA BELI</</th>
			                                    <th style="padding:7px" width="11%">NO. PO</th>
			                                    <th style="padding:7px" width="8%">TGL PO</th>
			                                    <th style="padding:7px" width="">NAMA SUPPLIER</th>
			                                    <th style="padding:7px" width="">TOTAL QTY RETUR BELI</th>
			                                    <th style="padding:7px" width="">JUMLAH RETUR BELI (RP)</th>
			                                    <th style="padding:7px" width="">TOTAL QTY KELUAR</th>
			                                    <th style="padding:7px" width="">JUMLAH KELUAR (RP)</th>
			                                    <th style="padding:7px">TOTAL STOK</th>
			                                    <th style="padding:7px" width="1%">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_returbeli_vw WHERE (nopo LIKE '%$_REQUEST[cari]%' OR noretur LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_returbeli_vw ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS totqty,SUM(total) AS totjum,SUM(qtykeluar) AS totqty2,SUM(totalkeluar) AS totjum2 FROM x23_returbeli_det
											                                     WHERE noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));
			                            	
											if($d1[status]=="3"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Gudang</span>";}
			                            	if(empty($d2[totqty2])){
												$totqty2 = "-";
												}
											else{
												$totqty2 = number_format($d2[totqty2],"0","",".");
												}
											if(empty($d2[totjum2])){
												$totjum2 = "-";
												}
											else{
												$totjum2 = number_format($d2[totjum2],"0","",".");
												}
											$dB = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS tstok FROM x23_stokpart WHERE nonota='$d1[nonota]'"));
										?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[noretur]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="center"><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center"><?echo $d1[nopo]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align=""><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totqty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totjum],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totqty2?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totjum2?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dB[tstok],"0","",".")?> PCS</span></td>
			                                    <td align="center"><?echo $status?></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
			            
<!-- ################## MODAL LOG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-log" tabindex="-1" role="dialog" aria-hidden="true">
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
				                            $q1 = mysql_query("SELECT * FROM log_act WHERE x23='x23_returbeli' ORDER BY id DESC");
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
		
	else if($submenu == 'A2')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> BUAT RETUR BELI BARU</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-user"></i>
			                                            </div>
		                                            	<input type="text" name="cari" autofocus placeholder="CARI NO. NOTA BELI / SUPPLIER / NO. PO ..." class="form-control"/>
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
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i> &nbsp; Lihat Retur</button>
										</a>
	                           		</div>
			                        <table id="example4" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="15%">NO. NOTA BELI</th>
			                                    <th style="padding:7px" width="12%">TGL NOTA BELI</th>
			                                    <th style="padding:7px" width="15%">NO. PO</th>
			                                    <th style="padding:7px" width="12%">TGL PO</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th style="padding:7px">TOTAL QTY BELI</th>
			                                    <th style="padding:7px">JUMLAH BELI (RP)</th>
			                                    <th style="padding:7px">TOTAL STOK</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE scan='1' AND (nonota LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%' OR nopo LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE scan='1' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dB = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS tstok FROM x23_stokpart WHERE nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo $d1[tglnota]?></td>
			                                    <td align="center"><?echo $d1[nopo]?></td>
			                                    <td align="center"><?echo $d1[tglpo]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dB[tstok],"0","",".")?> PCS</span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_vw WHERE id='$_REQUEST[id]'"));                 
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(stok) AS qtystok FROM x23_stokpart WHERE nonota='$d1[nonota]'"));                 
		
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nonota]?></small></h4>
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>">  
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
					                
			                        <table id="example2" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="9%" style="padding:7px"><center>STOK</center></th>
			                                    <th width="9%" style="padding:7px"><center>QTY RETUR BELI</center></th>
			                                    <th width="" style="padding:7px"><center>KETERANGAN</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										//$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total, SUM(total) AS gtotal FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'"));			       
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]' AND nonota='$d1[nonota]'"));
			                            	if(empty($d2[stok]) OR $d2[stok]=="0"){
												$stok = "0";
												$r = "disabled";
												$r2 = "disabled";
												}
											else{
												$stok = $d2[stok];
												$r = "required";
												$r2 = "";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian]"?></td>
			                                    <td align="right"><span style="margin-right:10%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td><?echo $d1[gudang]?></td>
			                                    <td><?echo $d1[rak]?></td>
			                                    <td align="right"><span style="margin-right:10%"><?echo number_format($stok,"0","",".")?> PCS</span></td>
			                                    <td align="right"><input type="text" name="qtytiba<?echo $d1[id]?>" class="form-control uang" value="0" onkeypress="return buat_angka(event,'0123456789')" onfocus="this.select();" style="width:80%;text-align:right;height:25px" <?echo $r?>></td>
			                                    <td align="center"><input type="text" name="ket<?echo $d1[id]?>" class="form-control" maxlength="20" style="width:90%;height:25px" <?echo $r2?>></td>
			                                </tr>
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                            <!--
			                            <tfoot>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[qty])?></b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[total])?></b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[gtotal])?></b></span></td>
			                            		<th colspan="4"></th>
			                            	</tr>
			                            </tfoot>
			                            -->
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
										<?
										if($dB[qtystok]>0)
											{
										?>
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
										<?
											}
										?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali <?//echo $dB[qtystok].$dB[nonota]?></button>
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
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_vw WHERE id='$_REQUEST[id]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty, SUM(hargabelibersih) AS total, SUM(total) AS gtotal FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'"));		
		$tglretur = date("Y-m-d",strtotime($_REQUEST[tglretur]));    
		if($tglretur < $d1[tglnota]){
			echo "<script>alert ('Tanggal Nota Retur Tidak Boleh Lebih Kecil Dari Tanggal Nota Beli.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}                       
		
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nonota]?></small></h4>
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>">  
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($d1[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
														<input type="hidden" name="idsupplier" value="<?echo $d1[idsupplier]?>">
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo date("d-m-Y",strtotime($_REQUEST[tglretur]))?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
					                
			                        <table id="example2" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="9%" style="padding:7px"><center>STOK</center></th>
			                                    <th width="9%" style="padding:7px"><center>QTY RETUR BELI</center></th>
			                                    <th width="9%" style="padding:7px"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>KETERANGAN</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            $htg = 1;
										$_SESSION[qr] = "0";
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$id = $d1[id];
			                            	if($_REQUEST[qtytiba.$id] != "0" AND !empty($_REQUEST[qtytiba.$id]))
			                            		{
												$_SESSION[qr] = "1";
												$jumlahretur = $d1[hargabelibersih]*$_REQUEST[qtytiba.$id];
												/*
												if(empty($_REQUEST[ket.$id]))
			                            			{
													echo "<script>alert ('Keterangan Tidak Boleh Kosong.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
												*/	
												$d2 = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]' AND nonota='$d1[nonota]'"));
			                            		if($d2[stok] < $_REQUEST[qtytiba.$id])
			                            			{
													echo "<script>alert ('Mohon Ulangi Qty Retur Yang Diinput, Karena Qty Melewati Stok.')</script>";
													print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
													exit();
													}
			                            		//echo $_REQUEST[qtytiba.$id];
			                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $d1[kodebarang]?></td>
				                                    <td><?echo "$d1[namabarang] | $d1[varian]"?></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
				                                    <td><?echo $d1[gudang]?></td>
				                                    <td><?echo $d1[rak]?></td>
				                                    <td align="right"><input type="text" name="qtytiba<?echo $d1[id]?>" value="<?echo number_format($d2[stok],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="right"><input type="text" name="qtytiba<?echo $d1[id]?>" value="<?echo number_format($_REQUEST[qtytiba.$id],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="right"><input type="text" name="jumlahretur<?echo $d1[id]?>" value="<?echo number_format($jumlahretur,"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="center"><input type="text" name="ket<?echo $d1[id]?>" value="<?echo strtoupper($_REQUEST[ket.$id])?>" class="form-control" style="width:90%;height:25px" readonly></td>
				                                </tr>
			                            <?
			                            		$htg++;
												}
			                            	}
			                            	
										if($htg=='1')
	                            			{
											echo "<script>alert ('Mohon Ulangi Qty Retur Yang Diinput, Karena Total Qty Tidak Boleh Nol (0).')</script>";
											print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
											exit();
											}
			                            ?>
			                            </tbody>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'save')
		{
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tglretur]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNR = mysql_fetch_array(mysql_query("SELECT noretur FROM x23_returbeli WHERE tanggal=CURDATE() ORDER BY SUBSTR(noretur,-3,3) DESC LIMIT 1"));
            
		if(empty($dNR[noretur]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNR[noretur]",-3,3);
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
			
			$noretur = "NR2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
        
		$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$_REQUEST[nonota]'");
        while($dA = mysql_fetch_array($qA))
        	{
        	$id = $dA[id];
        	if(!empty($_REQUEST[qtytiba.$id]))
        		{
        		$total = $_REQUEST[qtytiba.$id] * $dA[hargabelibersih];
        		$ket = $_REQUEST[ket.$id];
        		$qty = $_REQUEST[qtytiba.$id];
        		
				//echo "<script>alert ('$ket')</script>";
				//exit();
			
        		mysql_query("INSERT INTO x23_returbeli_det (
					        						noretur,
					        						tanggal,
					        						nonota,
					        						idbarang,
					        						hargabelibersih,
					        						qty,
					        						total,
					        						ket,
					        						idgudang,
					        						rak)
					        					VALUES (
													'$noretur',
													NOW(),
													'$dA[nonota]',
													'$dA[idbarang]',
													'$dA[hargabelibersih]',
													'$qty',
													'$total',
													'$ket',
													'$dA[idgudang]',
													'$dA[rak]')
        					");
        		}
        	}
        	
		$q1 = mysql_query("INSERT INTO x23_returbeli (
													noretur, 
													nonota, 
													nopo, 
													tahun, 
													bulan, 
													tanggal, 
													user, 
													idsupplier, 
													inputx, 
													updatex) 
												VALUES (
													'$noretur', 
													'$_REQUEST[nonota]', 
													'$_REQUEST[nopo]', 
													'$tahun', 
													'$bulan', 
													'$tanggal', 
													'$_SESSION[id]', 
													'$_REQUEST[idsupplier]',
													NOW(), 
													'$updatex')
							");
							
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_returbeli',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH RETUR BELI $_REQUEST[nonota]')
							");
				
		
		if($q1)
			{
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
		
	else if($submenu == 'D')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_vw WHERE id='$_REQUEST[id]'"));  
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_returbeli_det WHERE noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));   
		
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nopo]?></small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$q1 = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																		while($dA=mysql_fetch_array($q1))
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
												<tr>
					                        		<td>TGL RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
												<tr>
					                        		<td>QTY RETUR BELI (PCS)</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo number_format($d2[total])?>" class="form-control" readonly="" style="width:40%"></td>
					                        	</tr>
												<?
												if($d1[status]=="3"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";}
				                            	if($d1[status]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";}
				                            	if($d1[status]=="1"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
				                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Gudang</span>";}
												?>
												<tr>
					                        		<td>STATUS</td>
					                        		<td>:</td>
					                    			<td><?echo $status?></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
					                
			                        <table id="example2" class="table table-striped table-hover" style="width:130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="6%" style="padding:7px"><center>STOK</center></th>
			                                    <th width="6%" style="padding:7px"><center>QTY RETUR BELI</center></th>
			                                    <th width="8%" style="padding:7px"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th style="padding:7px" width="6%"><center>QTY KELUAR</center></th>
			                                    <th style="padding:7px" width="8%"><center>JUMLAH KELUAR (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>KETERANGAN</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE noretur='$d1[noretur]'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]'"));
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]' AND nonota='$d1[nonota]'"));
				                           	if(empty($d2[totqty2])){
													$totqty2 = "-";
													}
												else{
													$totqty2 = number_format($d2[totqty2],"0","",".");
													}	
											if(empty($d1[totalkeluar])){
													$totalkeluar = "-";
													}
												else{
													$totalkeluar = number_format($d1[totalkeluar],"0","",".");
													}
									    ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian]"?></td>
			                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td><?echo $d1[gudang]?></td>
			                                    <td><?echo $d1[rak]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($dB[stok],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totqty2?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $totalkeluar?></span></td>
			                                    <td align="center"><?echo $d1[ket]?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
											<button type="button"  onclick="window.open('print/h2/returbelidet.php?id=<?echo $_REQUEST[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-info pull-left"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           				<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
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
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
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
                $('#example3').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example4').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>