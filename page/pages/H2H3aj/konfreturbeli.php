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
			                	<h4>GUDANG & PDI <small>KONFIRMASI RETUR BELI</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Saat Ini Menunggu Konfirmasi Pihak Manajemen.</p>";
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
									<!--
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA RETUR BELI/ NO. PO / NAMA SUPPLIER ..." class="form-control"/>
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
	                           		</div>
									-->
			                        <table id="example4" class="table table-striped" style="width:140%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="6%">NO. NOTA RETUR BELI</th>
			                                    <th style="padding:7px" width="6%">TGL NOTA RETUR BELI</th>
			                                    <th style="padding:7px" width="9%">NO. NOTA BELI</th>
			                                    <th style="padding:7px" width="8%">TGL NOTA BELI</</th>
			                                    <th style="padding:7px" width="9%">NO. PO</th>
			                                    <th style="padding:7px" width="6%">TGL PO</th>
			                                    <th style="padding:7px" width="">NAMA SUPPLIER</th>
			                                    <th style="padding:7px" width="7%">QTY RETUR BELI</th>
			                                    <th style="padding:7px" width="9%">JUMLAH RETUR BELI (RP)</th>
			                                    <th style="padding:7px" width="7%">QTY KELUAR</th>
			                                    <th style="padding:7px" width="9%">JUMLAH KELUAR (RP)</th>
			                                    <th style="padding:7px" width="10%">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_returbeli_vw WHERE id%2=0 AND (nopo LIKE '%$_REQUEST[cari]%' OR noretur LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_returbeli_vw WHERE id%2=0 AND status IN ('0','1') ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS totqty,SUM(total) AS totjum,SUM(qtykeluar) AS qtykeluar,SUM(totalkeluar) AS totalkeluar FROM x23_returbeli_det WHERE id%2=0 AND noretur='$d1[noretur]'"));
			                            	
											if($d1[status]=="3"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Gudang</span>";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[noretur]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="center"><?echo $d1[noretur]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center"><?echo $d1[nopo]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align=""><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totqty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totjum],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[qtykeluar],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d2[totalkeluar],"0","",".")?></span></td>
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
			        </div>
				</section>
			</aside>
<?
		}
	else if($submenu == 'B')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));  
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_returbeli_det WHERE id%2=0 AND noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));  
		
											if($d1[status]=="3"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Gudang</span>";}
			                             
		
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>GUDANG & PDI <small>KONFIRMASI RETUR BELI</small></h4>
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C&id=$_REQUEST[id]"?>">  
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
					                        		<td><input type="text" name="noretur" value="<?echo $d1[noretur]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>STATUS</td>
					                        		<td>:</td>
					                        		<td><?echo $status?></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
												<tr>
					                        		<td>NO. NOTA RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="noretur" value="<?echo $d1[noretur]?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
												<tr>
					                        		<td>TGL RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
												<tr>
					                        		<td>TOTAL QTY RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo number_format($d2[total])?> PCS" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
					                
			                        <table id="example2" class="table table-striped table-hover" style="width:150%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="" style="padding:7px">STOK (PCS)</th>
			                                    <th width="" style="padding:7px"><center>QTY KELUAR (PCS)</center></th>
			                                    <th width="" style="padding:7px"><center>QTY RETUR BELI (PCS)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>KETERANGAN</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            if($d1[status]=='0')
			                            	{
											$qX = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE id%2=0 AND noretur='$d1[noretur]' AND qtykeluar=''");
				                            while($dX = mysql_fetch_array($qX))
				                            	{
												$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND idbarang='$dX[idbarang]' AND idgudang='$dX[idgudang]' AND rak='$dX[rak]' AND nonota='$dX[nonota]'"));
			                           			$dSt = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE id%2=0 AND idbarang='$dX[idbarang]' AND idgudang='$dX[idgudang]' AND rak='$dX[rak]' AND nonota='$dX[nonota]'"));
									   ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $dX[kodebarang]?></td>
				                                    <td><?echo "$dX[namabarang] | $dX[varian]"?></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
				                                    <td><?echo $dX[gudang]?></td>
				                                    <td><?echo $dX[rak]?></td>
				                                    <td align="right"><?echo number_format($dSt[stok],"0","",".")?></td>
				                                    <td align="right"><input type="text" name="qtyout<?echo $dX[id]?>" value="0" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" required=""></td>
				                                    <td align="right"><input type="text" name="qtytiba<?echo $dX[id]?>" value="<?echo number_format($dX[qty],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="right"><input type="text" name="jumlahretur<?echo $dX[id]?>" value="<?echo number_format($dX[total],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="center"><input type="text" name="ket<?echo $dX[id]?>" value="<?echo $dX[ket]?>" class="form-control" style="width:90%;height:25px" readonly></td>
				                                </tr>
			                            <?
			                            		}
			                            	}
			                            	
			                            else
			                            	{
											$qX = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE id%2=0 AND noretur='$d1[noretur]'");
				                            while($dX = mysql_fetch_array($qX))
				                            	{
												$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND idbarang='$dX[idbarang]' AND idgudang='$dX[idgudang]' AND rak='$dX[rak]' AND nonota='$dX[nonota]'"));
			                            		$dSt = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE id%2=0 AND idbarang='$dX[idbarang]' AND idgudang='$dX[idgudang]' AND rak='$dX[rak]' AND nonota='$dX[nonota]'"));
									    ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $dX[kodebarang]?></td>
				                                    <td><?echo "$dX[namabarang] | $dX[varian]"?></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
				                                    <td><?echo $dX[gudang]?></td>
				                                    <td><?echo $dX[rak]?></td>
				                                    <td align="right"><?echo number_format($dSt[stok],"0","",".")?></td>
				                                    <td align="right"><input type="text" name="qtyout<?echo $dX[id]?>" value="<?echo number_format($dX[qtykeluar],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="right"><input type="text" name="qtytiba<?echo $dX[id]?>" value="<?echo number_format($dX[qty],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="right"><input type="text" name="jumlahretur<?echo $dX[id]?>" value="<?echo number_format($dX[total],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="center"><input type="text" name="ket<?echo $dX[id]?>" value="<?echo $dX[ket]?>" class="form-control" style="width:90%;height:25px" readonly></td>
				                                </tr>
			                            <?
			                            		}
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="12"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                        <?
				                        if($d1[status]=='0')
				                        	{
										?>
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
										<?
											}
				                        ?>
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
<?
		}
		
	else if($submenu == 'C')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_vw WHERE id%2=0 AND id='$_REQUEST[id]'"));  
		$d2 = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM x23_returbeli_det WHERE id%2=0 AND noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));                              
		
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>ADMINISTRASI <small>RETUR BELI <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save&id=$_REQUEST[id]"?>">  
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
					                        		<td><input type="text" name="noretur" value="<?echo $d1[noretur]?>" class="form-control" maxlength="20" style="width:50%"  readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo date("d-m-Y",strtotime($_REQUEST[tglretur]))?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix"></div>
					                
			                        <table id="example2" class="table table-striped table-hover" style="width:150%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="" style="padding:7px">STOK (PCS)</th>
			                                    <th width="" style="padding:7px"><center>QTY KELUAR (PCS)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH KELUAR (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>QTY RETUR (PCS)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH RETUR BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>KETERANGAN</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE id%2=0 AND noretur='$d1[noretur]' AND qtykeluar=''");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]' AND nonota='$d1[nonota]'"));
			                           
			                            	$id = $d1[id];
			                            	if($_REQUEST[qtyout.$id] != "0")
			                            		{
												if($d1[qty] != $_REQUEST[qtyout.$id]){$red = "color:red";}
												else{$red = "";}
											
											$totalkeluar = preg_replace( "/[^0-9]/", "",$_REQUEST[qtyout.$id])*$dA[hargabelibersih];
											
											$dSt = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE id%2=0 AND idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND rak='$d1[rak]' AND nonota='$d1[nonota]'"));
											
											if($_REQUEST[qtyout.$id] > $dSt[stok]){
												echo "<script>alert ('Stok Barang $d1[kodebarang] | $d1[namabarang] | $d1[varian] Tidak Mencukupi.')</script>";
												print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B&id=$_REQUEST[id]'/>";
												exit();
												}
									    ?>
				                                <tr style="cursor:pointer;<?echo $red?>">
				                                    <td><?echo $d1[kodebarang]?></td>
				                                    <td><?echo "$d1[namabarang] | $d1[varian]"?></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
				                                    <td><?echo $d1[gudang]?></td>
				                                    <td><?echo $d1[rak]?></td>
				                                    <td align="right"><?echo number_format($dSt[stok],"0","",".")?></td>
				                                    <td align="right"><input type="text" name="qtyout<?echo $d1[id]?>" value="<?echo number_format($_REQUEST[qtyout.$id],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly=""></td>
				                                    <td align="right"><input type="text" name="totalkeluar<?echo $d1[id]?>" value="<?echo number_format($totalkeluar,"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly=""></td>
				                                    <td align="right"><input type="text" name="qtytiba<?echo $d1[id]?>" value="<?echo number_format($d1[qty],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="right"><input type="text" name="jumlahretur<?echo $d1[id]?>" value="<?echo number_format($d1[total],"0","",".")?>" class="form-control uang" value="0" onfocus="this.select();" style="width:80%;text-align:right;height:25px" readonly></td>
				                                    <td align="center"><input type="text" name="ket<?echo $d1[id]?>" value="<?echo $d1[ket]?>" class="form-control" style="width:90%;height:25px" readonly></td>
				                                </tr>
			                            <?
			                            		}
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="12"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                        </br>
			                        <table>
			                        	<tr>
			                        		<td colspan="3"><b>Keterangan</b></td>
			                        	</tr>
			                        	<tr>
			                        		<td style="color:#ff0227">Merah</td>
			                        		<td width="15px" align="center">:</td>
			                        		<td>Qty Barang Keluar Tidak Sama Dengan Qty Retur</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Qty Barang Keluar Sama Dengan Qty Retur</td>
			                        	</tr>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Konfirmasi</button>
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
		$p_tahun = date("Y");
		$p_bulan = date("m");
        
		$qA = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE id%2=0 AND noretur='$_REQUEST[noretur]'");
        while($dA = mysql_fetch_array($qA))
        	{
        	$id = $dA[id];
        	if(!empty($_REQUEST[qtyout.$id]))
        		{
        		$qtykeluar   = preg_replace( "/[^0-9]/", "",$_REQUEST[qtyout.$id]);
        		$totalkeluar = preg_replace( "/[^0-9]/", "",$_REQUEST[totalkeluar.$id]);
        		
        		mysql_query("UPDATE x23_returbeli_det SET qtykeluar='$qtykeluar',totalkeluar='$totalkeluar' WHERE id%2=0 AND id='$id'");
        		}
        	}
							
			mysql_query("INSERT INTO x23_abis_dkonfirmasi (
											idreturbeli, 
											tahun, 
											bulan, 
											tanggal,
											kasus, 
											tbl,
											inputx) 
										VALUES (
											'$_REQUEST[id]', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'KONFIRMASI RETUR BELI DENGAN NO. NOTA  RETUR $_REQUEST[noretur]', 
											'x23_returbeli', 
											NOW())
						");
        	
		$q1 = mysql_query("UPDATE x23_returbeli SET
											status='1',
											idgdg='$_SESSION[id]',
											updatex='$updatex'
										WHERE id%2=0 AND noretur='$_REQUEST[noretur]'
							");
							
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_returbeli',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'KONFIRMASI RETUR BELI $_REQUEST[noretur]')
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