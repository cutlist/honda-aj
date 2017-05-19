<?
	if($submenu == 'A')
		{
			$periode_tahun = date("Y");
			$periode_bulan = date("m");		
			
			unset($_SESSION[periode]);
			unset($_SESSION[periode_awal]);
			unset($_SESSION[periode_akhir]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-4">		                
			                <div class="small-box bg-blue" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff">
			                	<h4><b>PENCARIAN NOTA BELI</b></h4>
			                	<h5>BERDASARKAN</h5><h5><b>PERIODE</b></h5></br></br></br></br>
			                	
	                                <div class="inner">
					                   	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar" style="font-size:20px"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:50px;font-size:14px;cursor:pointer;" placeholder="Pilih Periode Tgl. Nota" class="form-control" id="reservation" readonly=""/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit"style="height:50px;" class="btn btn-danger pull-left"><i class="fa fa-arrow-right"></i></button>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
			               		 	</div>
			                </div>
			            </div>
			            <div class="col-xs-4">		                
			                <div class="small-box bg-green" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff">
			                	<h4>NOTA <b>SUDAH</b> BAYAR</h4>
			                	<h5 style="margin-top:-10px">BULAN INI</h5>
			                	<?
								$pA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notabeli WHERE tahun='$periode_tahun' AND bulan='$periode_bulan' AND bayar NOT IN ('0','') AND dk='0'"));
			                	?>
	                                <div class="inner">
	                                	<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="color:#fff">
	                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
		                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo $pA[total]?></h3>
		                                    </div>
	                                    </div>
	                                    </a>
	                                </div></br>
	                                
	                                <div class="col-xs-12" style="margin:10px 10px 10px 10px;cursor: pointer;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96%">5 NOTA TERBARU (SUDAH BAYAR)</h4>
				                        <table class="table" style="width:96%">
				                            <thead style="font-size:12px">
				                                <tr>
			                                    <th style="padding:7px" width="">NO. NOTA BELI</th>
			                                    <th style="padding:7px" width="">TGL NOTA BELI</th>
			                                    <th style="padding:7px" width="">TOTAL BAYAR (RP)</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
				                            $dc1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE bayar NOT IN ('0','') AND dk='0' ORDER BY tglbayar DESC"));
				                            if(empty($dc1[id]))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td colspan="4"><i>DATA TIDAK DITEMUKAN</i></td>
				                                </tr>
				                            <?
												}
				                            
											$q1 = mysql_query("SELECT * FROM x23_notabeli WHERE bayar NOT IN ('0','') AND dk='0' ORDER BY tglbayar DESC LIMIT 0,5");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="left"><?echo $d1[nonota]?></td>
				                                    <td align="left"><span style="padding-left:10px"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></span></td>
				                                    <td><?echo number_format($d1[bayar],"0","",".")?></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
		                           	</div>
			                    
	                                <a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" class="small-box-footer">
	                                    Lihat Detail <i class="fa fa-search"></i>
	                                </a>
			                </div>
			            </div>
			            <div class="col-xs-4">			                
			                <div class="small-box bg-orange" style="text-align:center;height:520px;border-radius:5px 5px 0 0;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff">
			                	<h4>NOTA <b>BELUM</b> BAYAR</h4>
			                	<h5 style="margin-top:-10px">BULAN INI</h5>
			                	<?
								$pB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notabeli WHERE jns='PEMBELIAN' AND tahun='$periode_tahun' AND bulan='$periode_bulan' AND bayar IN ('0','') AND gtbayar!='' AND dk='0' AND harga='1'"));
			                	?>
	                                <div class="inner" style="cursor:pointer">
	                                	<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="color:#fff">
		                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;">
			                                	<div class="bg-orange" style="width:60px;height:60px;border-radius:60px;padding:7px;">
			                                    	<h3><?echo $pB[total]?></h3>
			                                    </div>
		                                    </div>
		                                </a>
	                                </div></br>
	                                
	                                <div class="col-xs-12" style="margin:10px 10px 10px 10px;cursor: pointer;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96%">5 NOTA TERBARU (BELUM BAYAR)</h4>
				                        <table class="table" style="width:96%">
				                            <thead style="font-size:12px">
				                                <tr>
			                                    <th style="padding:7px" >NO. NOTA BELI</th>
			                                    <th style="padding:7px" >TGL NOTA BELI</th>
			                                    <th style="padding:7px" >GRAND TOTAL + PPN (RP)</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
				                            $dc1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli WHERE jns='PEMBELIAN' AND bayar IN ('0','') AND gtbayar!='' AND dk='0' AND harga='1' ORDER BY tglbayar DESC LIMIT 0,5"));
				                            if(empty($dc1[id]))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td colspan="4"><i>DATA TIDAK DITEMUKAN</i></td>
				                                </tr>
				                            <?	
												}
				                            
											$q1 = mysql_query("SELECT * FROM x23_notabeli WHERE jns='PEMBELIAN' AND bayar IN ('0','') AND gtbayar!='' AND dk='0' AND harga='1' ORDER BY tglbayar DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="left"><?echo $d1[nonota]?></td>
				                                    <td align="left"><span style="padding-left:10px"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></span></td>
				                                    <td><?echo number_format($d1[gtbayar],"0","",".")?></td>
				                                </tr>
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
		                           	</div>
	                                <a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" class="small-box-footer">
	                                    Lihat Detail <i class="fa fa-search"></i>
	                                </a>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		$p_tahun = date("Y");
		$p_bulan = date("m");
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
			                	<h4>PEMBELIAN <small>NOTA BELI BELUM BAYAR</small></h4>
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. PO</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="" style="padding:7px">QTY TOTAL</th>
			                                    <th style="padding:7px">JUMLAH + PPN (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE bayar IN ('0','') AND gtbayar!='' AND dk='0' AND harga='1'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[gtbayar],"0","",".")?></span></td>
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
						$q3 = mysql_query("SELECT * FROM x23_notabeli WHERE bayar IN ('0','') AND dk='0'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="harga" value="<?echo $d3[harga]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
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
						
					else if($mod == "view")
						{
		                mysql_query("TRUNCATE temp_x23_bayarsup_notaretur");
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled>
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-info" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=bayar&id=$d1[id]"?>'"><i class="fa fa-dollar"></i> &nbsp;Bayar</button>
					                    	
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
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
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[nonota]'"));
			                            $q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
										 while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo "$dA[kodebarang]"?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty]*$dA[hargabelibersih],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[totalqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[grandtotal])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL + PPN (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[grandtotalppn])?></b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
<?
						}
						
					else if($mod == "bayar")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
							
						if(!empty($_REQUEST[temp]))
							{
							mysql_query("INSERT INTO temp_x23_bayarsup_notaretur VALUES ('','$_REQUEST[noretur]')");
							}
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
							    	<form method="post" name="" action="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=save"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled>
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>JUMLAH NOTA</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" value="<?echo number_format($d1[gtbayar],"0","",".")?>" onfocus="this.select();" style="width:60%;text-align:right" class="form-control uang" readonly> 
					                                    </div></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix" style="margin-bottom:20px"></div>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                
				                	<div style="padding:20px">
					           			<div class="col-xs-8">
					                        <table width="100%">
					                    		<tr>
					                    			<td colspan="4">GUNAKAN NOTA RETUR UNTUK MEMOTONG PEMBAYARAN NOTA BELI INI</td>
					                    		</tr>
					                    		<tr><td colspan="4" height='10px'></td></tr>
					                    		<tr>
					                    			<td>NOTA RETUR BELI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><button type="button" data-toggle="modal" data-target="#compose-modal-notaretur"  class="btn btn-info" style="padding:2px;font-size:12px"> &nbsp;&nbsp; <i class="fa fa-search"></i> &nbsp;&nbsp;Pilih Nota Retur&nbsp;&nbsp;</button></td>
					                    		</tr>
												<?
								                $d3 = mysql_fetch_array(mysql_query("SELECT SUM(sisa) AS total FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur) AND status!='1'"));
												if(!empty($d3[total]))
													{
												?>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2">
						                    				<table class="table table-striped" style="width:50%">
									                            <thead style="color:#666;font-size:13px">
									                                <tr>
									                                    <th style="padding:2px">NO. NOTA RETUR BELI</th>
									                                    <th style="padding:2px">JUMLAH (RP)</th>
									                                </tr>
									                            </thead>
									                            <tbody>
									                    		<?
									                    		$q2 = mysql_query("SELECT * FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur) AND status!='1'");
									                    		while($d2 = mysql_fetch_array($q2))
										                    		{
									                    		?>
										                    		<tr>
										                    			<td><?echo $d2[noretur]?></td>
										                    			<td align="right"><span style="padding-right:20%"><?echo number_format($d2[sisa],"0","",".")?></span></td>
										                    		</tr>
										                    	<?
										                    		}
										                    	?>
									                                <tr>
									                                    <td style="padding:2px"><b>TOTAL (RP)</b></td>
										                    			<td align="right"><b><span style="padding-right:20%"><?echo number_format($d3[total],"0","",".")?></span></b></td>
									                                </tr>
									                            </tbody>
						                    				</table>
						                    				
						                    			</td>
						                    		</tr>
						                    		<tr><td colspan="4" height='10px'></td></tr>
												<?
													}
												?>
												<?
												//echo "$d3[total]-$d1[gtbayar]";
												if($d3[total] < $d1[gtbayar])
													{
												?>
						                    		<tr>
						                    			<td>TAMBAH BAYAR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        	<input type="text" name="bayar" value="0" onfocus="this.select();" style="width:40%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
						                                    </div>                                        		
						                                </td>
						                    		</tr>
												<?
													}
												?>
												<tr>
					                    			<td width="30%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:30%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
			                            	</table>
					                	</div>
				                	</div>

				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"> 
											<input type="hidden" name="totalretur" value="<?echo $d3[total]?>"> 
					                    	<input type="hidden" name="bayarnota" value="<?echo $d1[id]?>">
				                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
				                    		<input type="hidden" name="gtbayar" value="<?echo $d1[gtbayar]?>">
				                    		<input type="hidden" name="harga" value="<?echo $d1[harga]?>">
				                    		
											<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
						                        
			<!-- ################## MODAL PILIH NOTA RETUR ########################################################################################## -->
									<?
									$dS = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$d1[idsupplier]'"));
									?>
							        <div class="modal fade " id="compose-modal-notaretur" tabindex="-1" role="dialog" aria-hidden="true">
							            <div class="modal-dialog" style="width:35%;">
							                <div class="modal-content">
							                    <div class="modal-header">
							                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                        <h4 class="modal-title">NOTA RETUR UNTUK <?echo $dS[nama]?></h4>
							                    </div>
														
							                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
						                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;">
							                    	<table width="100%">
							                    		<tr>
							                    			<td width="30%">PILIH NOTA RETUR BELI</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><select class="form-control" name="noretur" required style="width: 100%" required="">
																				<option value=''>Pilih</option>
																			<?
																				$q1 = mysql_query("SELECT * FROM x23_notaretur WHERE idsupplier='$d1[idsupplier]' AND status!='1' ORDER BY noretur");
																				while($dA=mysql_fetch_array($q1))
																					{
																			?>
																						<option value='<?echo $dA[noretur]?>'><?echo $dA[noretur]." Rp. ".number_format($dA[sisa],"0","",".")?></option>
																			<?
																					}
																			?>
																</select></td>
							                    		</tr>
								                    	<input type="hidden" name="temp" value="1">
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
			                </div>
			            </div>
<?
						}
						
					else if($mod == "save")
						{
						$tahun = date("Y");
						$bulan = date("m");	
						//echo "$_REQUEST[gtbayar]-$_REQUEST[totalretur]";
						//exit();
						if(!empty($_REQUEST[bayarnota]))
							{
							$tglnota   = date("Y-m-d", strtotime($_REQUEST['tglnota']));
							$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
							$bayarX  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							$bayar		= $bayarX + $_REQUEST['totalretur'];
							
							if($bayar=="0"){
								echo "<script>alert ('Pembayaran Tidak Boleh Nol (0)!')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=bayar&id=$_REQUEST[id]'/>";
								exit();
							}
							
							if($tglbayar < $tglnota){
								echo "<script>alert ('Tanggal Pembayaran Tidak Boleh Lebih Kecil Dari Tanggal Nota Beli.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=bayar&id=$_REQUEST[id]'/>";
								exit();
							} 
							if($_REQUEST[gtbayar] >= $_REQUEST['totalretur'])
								{
				  				$qA = mysql_query("SELECT * FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur) AND status!='1'");
	                    		while($dA = mysql_fetch_array($qA))
		                    		{
		                    		mysql_query("UPDATE x23_notaretur SET status='1',sisa='0',potong=jumlah,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dA[noretur]'");
		                    		mysql_query("INSERT INTO x23_notaretur_use (
		                    											noretur,
		                    											tanggal,
		                    											bulan,
		                    											tahun,
		                    											idsupplier,
		                    											jumlah,
		                    											nonota2,
		                    											iduser)  
		                    										VALUES (
		                    											'$dA[noretur]',
		                    											CURDATE(),
		                    											'$bulan',
		                    											'$tahun',
		                    											'$dA[idsupplier]',
		                    											'$dA[jumlah]',
		                    											'$_REQUEST[nonota]',
		                    											'$_SESSION[id]')
		                    					");
		                    		}
									
							  	mysql_query("INSERT INTO x23_bayarsup_history VALUES (
							  								'',
							  								'$_REQUEST[nonota]',
							  								'$bayar',
							  								CURDATE(),
							  								'$_SESSION[id]')
							  				");
								}		
							if($_REQUEST[gtbayar] < $_REQUEST['totalretur'])
								{
								/*
								echo "<script>alert ('$_REQUEST[gtbayar].$_REQUEST[totalretur].$sisaZ')</script>";
								exit();
								*/
				  				$dA1 = mysql_fetch_array(mysql_query("SELECT noretur FROM temp_x23_bayarsup_notaretur ORDER BY id DESC LIMIT 0,1"));
				  				
								$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaretur WHERE noretur='$dA1[noretur]' AND status!='1'"));
				  				$noreturX = $dA[noretur];
				  				
				  				$dB = mysql_fetch_array(mysql_query("SELECT SUM(sisa) AS total FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur WHERE noretur!='$noreturX') AND status!='1'"));
				  				$sisa  = $_REQUEST[gtbayar]-$dB[total];
				  				$sisa2 = $dA[sisa]-$sisa;
								$sisaZ = $sisa+$dB[total]; 
								
	                    		mysql_query("UPDATE x23_notaretur SET status='2',potong='$sisa',sisa=$sisa2,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dA[noretur]'");
	                    		mysql_query("INSERT INTO x23_notaretur_use (
		                    											noretur,
		                    											tanggal,
		                    											bulan,
		                    											tahun,
		                    											idsupplier,
		                    											jumlah,
		                    											nonota2,
		                    											iduser)  
		                    										VALUES (
		                    											'$dA[noretur]',
		                    											CURDATE(),
		                    											'$bulan',
		                    											'$tahun',
		                    											'$dA[idsupplier]',
		                    											'$sisa',
		                    											'$_REQUEST[nonota]',
		                    											'$_SESSION[id]')
		                    					");
	                    		
				  				$qC = mysql_query("SELECT * FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur WHERE noretur!='$noreturX') AND status!='1'");
	                    		while($dC = mysql_fetch_array($qC))
		                    		{
		                    		mysql_query("UPDATE x23_notaretur SET status='1',sisa='0',potong=jumlah,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dC[noretur]'");
		                    		mysql_query("INSERT INTO x23_notaretur_use (
			                    											noretur,
			                    											tanggal,
			                    											bulan,
			                    											tahun,
			                    											idsupplier,
			                    											jumlah,
			                    											nonota2,
			                    											iduser)  
			                    										VALUES (
			                    											'$dC[noretur]',
			                    											CURDATE(),
			                    											'$bulan',
			                    											'$tahun',
			                    											'$dC[idsupplier]',
		                    												'$dC[sisa]',
			                    											'$_REQUEST[nonota]',
			                    											'$_SESSION[id]')
			                    					");
		                    		}
								  	
								mysql_query("INSERT INTO x23_bayarsup_history VALUES (
							  								'',
							  								'$_REQUEST[nonota]',
							  								'$sisaZ',
							  								CURDATE(),
							  								'$_SESSION[id]')
							  				");
		                    	}
		                    	
		                    mysql_query("TRUNCATE temp_x23_bayarsup_notaretur");
							  				
							if($_REQUEST[harga]=='0'){
								//$q1 = mysql_query("UPDATE x23_notabeli SET dk='1',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
									
								if($_REQUEST[gtbayar] < $_REQUEST['totalretur']){
									$q1 = mysql_query("UPDATE x23_notabeli SET dk='1',status='$status',bayar='$sisaZ',tglbayar='$tglbayar',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
									}
								else{
									$q1 = mysql_query("UPDATE x23_notabeli SET dk='1',status='$status',bayar='$bayar',tglbayar='$tglbayar',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
									}
									
								  mysql_query("INSERT INTO x23_abis_dkonfirmasi (
																idnotabeli2, 
																tahun, 
																bulan, 
																tanggal,
																kasus, 
																tbl,
																inputx) 
															VALUES (
																'$_REQUEST[bayarnota]', 
																'$p_tahun', 
																'$p_bulan', 
																CURDATE(), 
																'KONFIRMASI NOTA BELI NO. $_REQUEST[nonota] : PEMBAYARAN KE SUPPLIER SEBELUM INPUT HARGA JUAL', 
																'x23_notabeli', 
																NOW())
											");
								}
								
							if($_REQUEST[harga]=='1'){
								if($_REQUEST[gtbayar] <= $bayar){
									$status = '1';
									}
									
								if($_REQUEST[gtbayar] < $_REQUEST['totalretur']){
									$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$sisaZ',tglbayar='$tglbayar',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
									}
								else{
									$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$bayar',tglbayar='$tglbayar',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
									}
									
								$q3 = mysql_query("INSERT INTO log_act VALUES (										
							                                    '',
							                                    'x23_notabeli',
							                                    CURDATE(),
							                                    CURTIME(),
							                                    '$_SESSION[user]',
							                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
													");
								}
								
							if($q1)
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'C')
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
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>PEMBELIAN <small>NOTA BELI SUDAH BAYAR</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA BELI / NO.PO / TGL BAYAR / NAMA SUPPLIER ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
			                        <table id="example3" class="table table-striped table-hover" style="width:130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. PO</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="" style="padding:7px">QTY TOTAL</th>
			                                    <th style="padding:7px">JUMLAH + PPN (RP)</th>
			                                    <th style="padding:7px">TGL BAYAR</th>
			                                    <th style="padding:7px">JUMLAH BAYAR (RP)</th>
			                                    <th style="padding:7px">BUNGA (RP)</th>
			                                    <th style="padding:7px">STATUS PEMBAYARAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE bayar NOT IN ('0','') AND scan='1' AND dk='0' AND nonota LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' OR tglbayar LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											$q3 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE bayar NOT IN ('0','') AND scan='1' AND dk='0' AND nonota LIKE '%$_REQUEST[cari]%' OR nodo LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE bayar NOT IN ('0','') AND scan='1' AND dk='0' ORDER BY id DESC LIMIT 0,20");
											$q3 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE bayar NOT IN ('0','') AND scan='1' AND dk='0' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Lunas</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
											$bungaX = $d1[bayar]-$d1[gtbayar];
											if($bungaX <= 0){
												$bunga = '0';
												}
											else{
												$bunga = $bungaX;
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[gtbayar],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglbayar]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[bayar],"0","",".")?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($bunga,"0","",".")?></span></td>
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
					
<?
						}
						
					else if($mod == "edit")
						{
						if(!empty($_REQUEST[ubah]))
							{
							$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							$q1 = mysql_query("UPDATE x23_bayarsup_history SET jumlah='$bayar' WHERE id='$_REQUEST[ubah]'");
							
							
							$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
							$selisih = $_REQUEST[jumlah]-$bayar;
							$bayarupdate = $d1[bayar]-$selisih;
								
							if($d1[gtbayar] <= $bayarupdate){
								$status = '1';
								}
							else{
								$status = '0';
								}
							
							$q2 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$bayarupdate',tglbayar=CURDATE(),updatex='$updatex' WHERE id='$_REQUEST[id]'");
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'x23_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $d1[nonota]')
												");
							if($q1)
								{
								//echo "<script>alert ('Proses berhasil.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]'/>";
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]'/>";
								exit();
								}
							}
							
						$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_bayarsup_history WHERE id='$_REQUEST[idbayar]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Pembayaran Nota <?echo $dA[nonota]?></small></h4>
				                	<div style="padding:20px">
                                    	
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="50%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y",strtotime($dA[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled="" style="width:60%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" value="<?echo number_format($dA[jumlah],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="jumlah" value="<?echo $dA[jumlah]?>">
					                    		<input type="hidden" name="ubah" value="<?echo $_REQUEST[idbayar]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&mod=view&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
										
                       		 		</div>
                       		 	</div>
                        	</div>
                        </div>
<?
						}
						
					else if($mod == "view")
						{
		                mysql_query("TRUNCATE temp_x23_bayarsup_notaretur");
						if(!empty($_REQUEST[bayarnota]))
							{
							$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
							$gtbayar    = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
							$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
							$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							$bayar		= $bayar1+$bayar2;
							
							if($gtbayar <= $bayar){
								$status = '1';
								}
							else{
								$status = '0';
								}
							
							$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$bayar',tglbayar='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
							      mysql_query("INSERT INTO x23_bayarsup_history VALUES (
								  								'',
								  								'$_REQUEST[nonota]',
								  								'$bayar2',
								  								CURDATE(),
								  								'$_SESSION[id]')
								  				");
							
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'x23_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
												");
							if($q1)
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
							
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL NOTA BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E&id=$_REQUEST[id]"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled>
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
												<?
												$shX = $d1[gtbayar]-$d1[bayar];
												if($shX >= 0){
													$sh = number_format($shX,"0","",".");
													}
												if($shX < 0){
													$sh = "-";
													}
												?>
					                        	<tr>
					                        		<td>SISA HUTANG</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" value="<?echo $sh?>" onfocus="this.select();" style="width:60%;text-align:right" class="form-control uang" readonly> 
					                                    </div></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <a data-toggle="modal" data-target="#compose-modal-history" style="cursor:pointer"><button type="button" class="btn btn-primary pull-left"><i class="fa fa-search"></i> &nbsp;Riwayat Pembayaran</button></a>
				                        <?
                                    	if($d1[status]=='0')
                                    		{
										?>
					                    	<button type="button" class="btn btn-info" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=bayar&id=$d1[id]"?>'"><i class="fa fa-dollar"></i> &nbsp;Bayar</button>
					                    <?
					                    	}
					                    ?>
					                        <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			                                    <th style="padding:7px">KODE <?echo $d1[nonota]?></th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[nonota]'"));
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty]*$dA[hargabelibersih],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[totalqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[grandtotal])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL + PPN (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[grandtotalppn])?></b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
			            
	<!-- ################## MODAL RIWAYAT ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-history" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:50%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">RIWAYAT PEMBAYARAN <?echo $d1[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                        <table id="example2" class="table table-striped" style="width:100%">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th width="40%" style="padding:7px"><center>TANGGAL PEMBAYARAN</center></th>
					                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
					                                    <th width="1%" style="padding:7px"><center>AKSI</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$d2 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_bayarsup_history WHERE nonota='$d1[nonota]'"));
												$q1 = mysql_query("SELECT * FROM x23_bayarsup_history WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($q1))
					                            	{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td align="center"><?echo date("d-m-Y",strtotime($dA[tanggal]))?></td>
					                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[jumlah],"0","",".")?></span></td>
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
					                                            	<li>
																		<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&idbayar=$dA[id]&id=$_REQUEST[id]"?>" style="cursor:pointer">
									                           				<i class="fa fa-edit"></i>Ubah
																		</a>
																	</li>
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
					                            <tfoot>
					                            	<tr><th colspan="3">&nbsp;</th></tr>
					                            	<tr>
					                            		<th align="right"><center>GRAND TOTAL (RP)</center></th>
					                            		<td align="right"><span style="margin-right:30%"><b><?echo number_format($d2[total])?></b></span></td>
					                            		<th ></th>
					                            	</tr>
					                            </tfoot>
					                        </table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
					
<?
						}
						
					else if($mod == "bayar")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
							
						if(!empty($_REQUEST[temp]))
							{
							mysql_query("INSERT INTO temp_x23_bayarsup_notaretur VALUES ('','$_REQUEST[noretur]')");
							}
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
							    	<form method="post" name="" action="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=save"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled>
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>JUMLAH NOTA</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" value="<?echo number_format($d1[gtbayar],"0","",".")?>" onfocus="this.select();" style="width:60%;text-align:right" class="form-control uang" readonly> 
					                                    </div></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOTAL SUDAH BAYAR</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" value="<?echo number_format($d1[bayar],"0","",".")?>" onfocus="this.select();" style="width:60%;text-align:right" class="form-control uang" readonly> 
					                                    </div></td>
					                        	</tr>
												<?
												$shX = $d1[gtbayar]-$d1[bayar];
												if($shX >= 0){
													$sh = number_format($shX,"0","",".");
													}
												if($shX < 0){
													$sh = "-";
													}
												?>
					                        	<tr>
					                        		<td>SISA HUTANG</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" value="<?echo $sh?>" onfocus="this.select();" style="width:60%;text-align:right" class="form-control uang" readonly> 
					                                    </div></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="clearfix" style="margin-bottom:20px"></div>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                
				                	<div style="padding:20px">
					           			<div class="col-xs-8">
					                        <table width="100%">
					                    		<tr>
					                    			<td colspan="4">GUNAKAN NOTA RETUR UNTUK MEMOTONG PEMBAYARAN NOTA BELI INI</td>
					                    		</tr>
					                    		<tr><td colspan="4" height='10px'></td></tr>
					                    		<tr>
					                    			<td>NOTA RETUR BELI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><button type="button" data-toggle="modal" data-target="#compose-modal-notaretur"  class="btn btn-info" style="padding:2px;font-size:12px"> &nbsp;&nbsp; <i class="fa fa-search"></i> &nbsp;&nbsp;Pilih Nota Retur&nbsp;&nbsp;</button></td>
					                    		</tr>
												<?
								                $d3 = mysql_fetch_array(mysql_query("SELECT SUM(sisa) AS total FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur) AND status!='1'"));
												if(!empty($d3[total]))
													{
												?>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2">
						                    				<table class="table table-striped" style="width:50%">
									                            <thead style="color:#666;font-size:13px">
									                                <tr>
									                                    <th style="padding:2px">NO. NOTA RETUR BELI</th>
									                                    <th style="padding:2px">JUMLAH (RP)</th>
									                                </tr>
									                            </thead>
									                            <tbody>
									                    		<?
									                    		$q2 = mysql_query("SELECT * FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur) AND status!='1'");
									                    		while($d2 = mysql_fetch_array($q2))
										                    		{
									                    		?>
										                    		<tr>
										                    			<td><?echo $d2[noretur]?></td>
										                    			<td align="right"><span style="padding-right:20%"><?echo number_format($d2[sisa],"0","",".")?></span></td>
										                    		</tr>
										                    	<?
										                    		}
										                    	?>
									                                <tr>
									                                    <td style="padding:2px"><b>TOTAL (RP)</b></td>
										                    			<td align="right"><b><span style="padding-right:20%"><?echo number_format($d3[total],"0","",".")?></span></b></td>
									                                </tr>
									                            </tbody>
						                    				</table>
						                    				
						                    			</td>
						                    		</tr>
						                    		<tr><td colspan="4" height='10px'></td></tr>
												<?
													}
												?>
												<?
												//echo "$d3[total]-$d1[gtbayar]";
												if($d3[total] < $shX)
													{
												?>
						                    		<tr>
						                    			<td>TAMBAH BAYAR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        	<input type="text" name="bayar" value="0" onfocus="this.select();" style="width:40%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
						                                    </div>                                        		
						                                </td>
						                    		</tr>
												<?
													}
												?>
					                    		<tr>
					                    			<td width="30%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:30%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
			                            	</table>
					                	</div>
				                	</div>

				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<input type="hidden" name="totalretur" value="<?echo $d3[total]?>"> 
				                    		<input type="hidden" name="gtbayar" value="<?echo $shX?>">
				                    		<input type="hidden" name="bayar1" value="<?echo $d1[bayar]?>">
				                    		<input type="hidden" name="bayarnota" value="<?echo $d1[id]?>">
				                    		<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>">
				                    		
											<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
				                    </form>
						                        
			<!-- ################## MODAL PILIH NOTA RETUR ########################################################################################## -->
									<?
									$dS = mysql_fetch_array(mysql_query("SELECT nama FROM x23_supplier WHERE id='$d1[idsupplier]'"));
									?>
							        <div class="modal fade " id="compose-modal-notaretur" tabindex="-1" role="dialog" aria-hidden="true">
							            <div class="modal-dialog" style="width:35%;">
							                <div class="modal-content">
							                    <div class="modal-header">
							                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                        <h4 class="modal-title">NOTA RETUR UNTUK <?echo $dS[nama]?></h4>
							                    </div>
														
							                   	<form method="post" name="inputkaryawan" action="" enctype="multipart/form-data">
						                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;">
							                    	<table width="100%">
							                    		<tr>
							                    			<td width="30%">PILIH NOTA RETUR BELI</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><select class="form-control" name="noretur" required style="width: 100%" required="">
																				<option value=''>Pilih</option>
																			<?
																				$q1 = mysql_query("SELECT * FROM x23_notaretur WHERE idsupplier='$d1[idsupplier]' AND status!='1' ORDER BY noretur");
																				while($dA=mysql_fetch_array($q1))
																					{
																			?>
																						<option value='<?echo $dA[noretur]?>'><?echo $dA[noretur]." Rp. ".number_format($dA[sisa],"0","",".")?></option>
																			<?
																					}
																			?>
																</select></td>
							                    		</tr>
								                    	<input type="hidden" name="temp" value="1">
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
			                </div>
			            </div>
<?
						}
						
						
					else if($mod == "save")
						{
						$tahun = date("Y");
						$bulan = date("m");	
						//echo "$_REQUEST[gtbayar]-$_REQUEST[totalretur]";
						//exit();
						if(!empty($_REQUEST[bayarnota]))
							{
							$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
							$bayarX  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
							$bayar1		= $_REQUEST['bayar1'];
							$bayarZ		= $bayar1+$bayarX+$_REQUEST['totalretur'];
														
							$bayar		= $bayarX + $_REQUEST['totalretur'];
							
							//echo "$bayarZ";
							//exit();
							  				
							if($_REQUEST[gtbayar] >= $_REQUEST['totalretur'])
								{
				  				$qA = mysql_query("SELECT * FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur) AND status!='1'");
	                    		while($dA = mysql_fetch_array($qA))
		                    		{
		                    		mysql_query("UPDATE x23_notaretur SET status='1',sisa='0',potong=jumlah,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dA[noretur]'");
		                    		mysql_query("INSERT INTO x23_notaretur_use (
			                    											noretur,
			                    											tanggal,
			                    											bulan,
			                    											tahun,
			                    											idsupplier,
			                    											jumlah,
			                    											nonota2,
			                    											iduser)  
			                    										VALUES (
			                    											'$dA[noretur]',
			                    											CURDATE(),
			                    											'$bulan',
			                    											'$tahun',
			                    											'$dA[idsupplier]',
			                    											'$dA[jumlah]',
			                    											'$_REQUEST[nonota]',
			                    											'$_SESSION[id]')
			                    					");
		                    		}
									
							  	mysql_query("INSERT INTO x23_bayarsup_history VALUES (
							  								'',
							  								'$_REQUEST[nonota]',
							  								'$bayar',
							  								CURDATE(),
							  								'$_SESSION[id]')
							  				");
								}
										
							if($_REQUEST[gtbayar] < $_REQUEST['totalretur'])
								{
				  				$dA1 = mysql_fetch_array(mysql_query("SELECT noretur FROM temp_x23_bayarsup_notaretur ORDER BY id DESC LIMIT 0,1"));
				  				
								$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaretur WHERE noretur='$dA1[noretur]' AND status!='1'"));
				  				$noreturX = $dA[noretur];
				  				
				  				$dC = mysql_fetch_array(mysql_query("SELECT COUNT(noretur) AS tot FROM temp_x23_bayarsup_notaretur WHERE noretur!='$dA1[noretur]'"));
				  				if($dC[tot]=='0')
				  					{
					  				$sisa  = $_REQUEST[gtbayar];
					  				$sisa2 = $dA[sisa]-$sisa;
									$sisaZ = $sisa+$bayar1; 	
									
									//echo "$dA[sisa]-$sisa";
									//exit();
									
									mysql_query("UPDATE x23_notaretur SET status='2',potong='$sisa',sisa=$sisa2,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dA[noretur]'");
		                    		mysql_query("INSERT INTO x23_notaretur_use (
			                    											noretur,
			                    											tanggal,
			                    											bulan,
			                    											tahun,
			                    											idsupplier,
			                    											jumlah,
			                    											nonota2,
			                    											iduser)  
			                    										VALUES (
			                    											'$dA[noretur]',
			                    											CURDATE(),
			                    											'$bulan',
			                    											'$tahun',
			                    											'$dA[idsupplier]',
			                    											'$dA[sisa]',
			                    											'$_REQUEST[nonota]',
			                    											'$_SESSION[id]')
			                    					");
		                    		
									mysql_query("INSERT INTO x23_bayarsup_history VALUES (
								  								'',
								  								'$_REQUEST[nonota]',
								  								'$sisa',
								  								CURDATE(),
								  								'$_SESSION[id]')
								  				");
								  	}
				  				else
				  					{
					  				$dB = mysql_fetch_array(mysql_query("SELECT SUM(sisa) AS total FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur WHERE noretur!='$noreturX') AND status!='1'"));
					  				$sisa  = $_REQUEST[gtbayar]-$dB[total];
					  				$sisa2 = $dA[sisa]-$sisa;
									$sisaZ = $sisa+$bayar1+$dB[total]; 	
									
									//echo "$sisaZ-$_REQUEST[gtbayar]-$sisa2";
									//exit();
					  				
		                    		mysql_query("UPDATE x23_notaretur SET status='2',potong='$sisa',sisa=$sisa2,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dA[noretur]'");
		                    		
					  				$qC = mysql_query("SELECT * FROM x23_notaretur WHERE noretur IN (SELECT noretur FROM temp_x23_bayarsup_notaretur where noretur!='$noreturX') AND status!='1'");
		                    		while($dC = mysql_fetch_array($qC))
			                    		{
			                    		mysql_query("UPDATE x23_notaretur SET status='1',sisa='0',potong=jumlah,nonota2='$_REQUEST[nonota]',iduser='$_SESSION[id]' WHERE noretur='$dC[noretur]'");
			                    		mysql_query("INSERT INTO x23_notaretur_use (
				                    											noretur,
				                    											tanggal,
				                    											bulan,
				                    											tahun,
				                    											idsupplier,
				                    											jumlah,
				                    											nonota2,
				                    											iduser)  
				                    										VALUES (
				                    											'$dC[noretur]',
				                    											CURDATE(),
				                    											'$bulan',
				                    											'$tahun',
				                    											'$dC[idsupplier]',
				                    											'$dC[jumlah]',
				                    											'$_REQUEST[nonota]',
				                    											'$_SESSION[id]')
				                    					");
			                    		}
			                    		
									mysql_query("INSERT INTO x23_bayarsup_history VALUES (
								  								'',
								  								'$_REQUEST[nonota]',
								  								'$_REQUEST[gtbayar]',
								  								CURDATE(),
								  								'$_SESSION[id]')
								  				");
									}
		                    	}
		                    	
		                    mysql_query("TRUNCATE temp_x23_bayarsup_notaretur");
							  				
							if($_REQUEST[gtbayar] <= $bayar){
								$status = '1';
								}
							else{
								$status = '0';
								}
								
							if($_REQUEST[gtbayar] < $_REQUEST['totalretur']){
								$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$sisaZ',tglbayar='$tglbayar',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
								}
							else{
								$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$bayarZ',tglbayar='$tglbayar',iduserbyr='$_SESSION[id]',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
								}
								
							$q3 = mysql_query("INSERT INTO log_act VALUES (										
						                                    '',
						                                    'x23_notabeli',
						                                    CURDATE(),
						                                    CURTIME(),
						                                    '$_SESSION[user]',
						                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
												");
								
							if($q1)
								{
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$_REQUEST[bayarnota]&save=1'/>";
								exit();
								}
							else
								{
								echo "<script>alert ('Proses gagal.')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$_REQUEST[bayarnota]'/>";
								exit();
								}
							}
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'D')
		{
		if(!empty($_REQUEST[bayarnota]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$gtbayar = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
			$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
			$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$bayar		= $bayar1+$bayar2;
			
			if($gtbayar <= $bayar){
				$status = '1';
				}
			
			$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$bayar',tglbayar='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[bayarnota]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notabeli',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR NOTA BELI $_REQUEST[nonota]')
								");
			if($q1)
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
			
		if(!empty($_REQUEST[ubahbayarnota]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$gtbayar = preg_replace( "/[^0-9]/", "",$_REQUEST['gtbayar']);
			$bayar1  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar1']);
			$bayar2  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$bayar		= $bayar1+$bayar2;
			
			if($gtbayar <= $bayar){
				$status = '1';
				}
			
			$q1 = mysql_query("UPDATE x23_notabeli SET status='$status',bayar='$bayar2',tglbayar='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[ubahbayarnota]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notabeli',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH BAYAR NOTA BELI $_REQUEST[nonota]')
								");
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			}
		
		if(empty($_SESSION[periode]))
			{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $_SESSION[periode]	= $_REQUEST[periode];
            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
			}
		if(!empty($_REQUEST[find]))
			{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $_SESSION[periode]	= $_REQUEST[periode];
            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
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
			                	<h4>PENCARIAN NOTA BELI</h4>
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px;font-size:14px;cursor:pointer;" <?if(empty($_SESSION[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_SESSION[periode]?>"<?}?>  class="form-control pull-right" readonly="" id="reservation"/>
		                                            </div>
		                                            <input type="hidden" name="find" value="1">
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
													<button type="button"  onclick="window.open('print/h2/bayarsup.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                       			<?
				                       				}
				                       			?>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width: 130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. PO</th>
			                                    <th style="padding:7px">TGL PO</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="" style="padding:7px">QTY TOTAL</th>
			                                    <th style="padding:7px">JUMLAH + PPN (RP)</th>
			                                    <th style="padding:7px">TGL BAYAR</th>
			                                    <th style="padding:7px">JUMLAH BAYAR (RP)</th>
			                                    <th style="padding:7px">BUNGA (RP)</th>
			                                    <th style="padding:7px">STATUS PEMBAYARAN</th>
			                                    <!--
			                                    <th width="" style="padding:7px">AKSI</th>
			                                    -->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?			                            
										$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND gtbayar!='' AND dk='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Lunas</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
			                           		if($d1[bayar] < $d1[gtbayar] || empty($d1[bayar])){
												$bunga = "-";
												}
											else if($d1[bayar] >= $d1[gtbayar]){
			                           			$bungaX = $d1[bayar]-$d1[gtbayar];
												$bunga  = number_format($bungaX,"0","",".");
												}
											if($d1[tglbayar]=="0000-00-00"){
												$tglbayar = "-";
												}
											else{
												$tglbayar =	date("d-m-Y",strtotime($d1[tglbayar]));
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nonota]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nopo]?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d1[gtbayar],"0","",".")?></span></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><?echo $tglbayar?></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo number_format($d1[bayar],"0","",".")?></span></td>
			                                    <td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>'"><span style="padding-right:20%"><?echo $bunga?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <!--
			                                    <td width="1%" align="center">
                                            	<?
                                            	if($d1[status]=='0')
                                            		{
												?>
			                                    	<div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                                	<li><a data-toggle="modal" data-target="#compose-modal-bayar<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-dollar"></i> Bayar</a></li>
			                                           	</ul>
			                                        </div>
		                                        <?
													}
													
                                            	if($d1[status]=='1')
                                            		{
												?>
			                                    	<div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-110px;font-size: 12px">
			                                                	<li><a data-toggle="modal" data-target="#compose-modal-ubahbayar<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i> Ubah Bayar</a></li>
			                                           	</ul>
			                                        </div>
		                                        <?
													}
                                            	?>
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
						$q3 = mysql_query("SELECT * FROM x23_notabeli WHERE status='0'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d3[bayar]?>">
					                    		<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					                	</div>
										</form>
					                </div>
					            </div>
					        </div>
	<!-- ################################################################################################################################# -->
<?
							}
							
						$q3 = mysql_query("SELECT * FROM x23_notabeli WHERE status='1'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
?>
	<!-- ################## MODAL BAYAR ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-ubahbayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">UBAH PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y",strtotime($d3[tglbayar]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" value="<?echo number_format($d3[bayar],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<input type="hidden" name="gtbayar" value="<?echo $d3[gtbayar]?>">
					                    		<input type="hidden" name="bayar1" value="<?echo $d3[bayar]?>">
					                    		<input type="hidden" name="ubahbayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
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
						
					else if($mod == "view")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PEMBAYARAN KE SUPPLIER <small>DETAIL BELI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Lihat Nota Beli</small></h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled>
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                        <?/*
                                    	if($d1[status]=='0')
                                    		{
										?>
					                        <a data-toggle="modal" data-target="#compose-modal-bayar<?echo $_REQUEST[id]?>" style="cursor:pointer"><button type="submit" class="btn btn-info"><i class="fa fa-dollar"></i> &nbsp;Bayar</button></a>
					                    <?
					                    	}
										*/
					                    ?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
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
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty]*$dA[hargabelibersih],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[totalqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[grandtotal])?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<th colspan="" align="center"><center>GRAND TOTAL + PPN (RP)</center></th>
			                            		<td colspan="" align="right"><span style="margin-right:20%"></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[grandtotalppn])?></b></span></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
		            <?
						$q3 = mysql_query("SELECT * FROM x23_notabeli WHERE id='$_REQUEST[id]'");
			            while($d3 = mysql_fetch_array($q3))
			            	{
		            ?>
	<!-- ################## MODAL UBAH BARANG ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-bayar<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:30%;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">PEMBAYARAN <?echo $d3[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL BAYAR</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i> &nbsp;</span>
					                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        	<input type="text" name="bayar" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  required> 
					                                    </div>                                        		
					                                </td>
					                    		</tr>
						                    	<input type="hidden" name="bayarnota" value="<?echo $d3[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $d3[nonota]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
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
?>
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
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
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();

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