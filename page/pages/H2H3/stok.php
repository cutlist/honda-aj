<?
	if($submenu == 'A')
		{
?>
		<script type="text/javascript">
			var s5_taf_parent = window.location;
			function popup_print(){
				window.open('print/h2/stoksparepart.php?idgudang=<?echo $_REQUEST[idgudang]?>&cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
				}
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>LIHAT STOK</h4>
	                           		<div style="float:left" class="col-xs-10">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI KODE BARANG / VARIAN / NAMA BARANG ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="30%"><select name="idgudang" class="form-control" style="height:35px">
														<option value='' >SEMUA LOKASI</option>
														<?php
														$q = mysql_query('SELECT * FROM x23_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($_REQUEST[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
                                    <div style="float:right;" class="col-xs-2">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    		<tr>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
			                        <table id="example1" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="" style="padding:7px">STOK</th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="" style="padding:7px">HARGA JUAL (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(empty($_REQUEST[cari]) AND empty($_REQUEST[idgudang]))
											{
											$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
											}
										if(empty($_REQUEST[cari]) AND !empty($_REQUEST[idgudang]))
											{
											$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE idgudang='$_REQUEST[idgudang]' GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
											}
										if(!empty($_REQUEST[cari]) AND empty($_REQUEST[idgudang]))
											{
											$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE kodebarang LIKE '%$_REQUEST[cari]%' OR namabarang LIKE '%$_REQUEST[cari]%' OR varian LIKE '%$_REQUEST[cari]%' GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
											}
										if(!empty($_REQUEST[cari]) AND !empty($_REQUEST[idgudang]))
											{
											$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw2 WHERE idgudang='$_REQUEST[idgudang]' AND (kodebarang LIKE '%$_REQUEST[cari]%' OR namabarang LIKE '%$_REQUEST[cari]%' OR varian LIKE '%$_REQUEST[cari]%') GROUP BY idbarang,nonota,idgudang,rak LIMIT 0,60");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[totalstok]!='0')
			                            		{
												if($d1[totalstok]<'0'){
													$red = "color:#ff0227";
													}
												else{$red="";}
				                        ?>
				                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&idbarang=$d1[idbarang]&idgudang=$d1[idgudang]&gudang=$d1[gudang]&rak=$d1[rak]&totalstok=$d1[totalstok]&&varian=$d1[varian]&namabarang=$d1[namabarang]&kodebarang=$d1[kodebarang]"?>'">
				                                    <td><?echo $d1[kodebarang]?></td>
				                                    <td><?echo $d1[namabarang]?></td>
				                                    <td><?echo $d1[varian]?></td>
				                                	<td align="right" width="10%"><span style="padding-right:20%"><?echo number_format($d1[totalstok],"0","",".")?> PCS</span></td>
				                                    <td><?echo $d1[gudang]?></td>
				                                    <td><?echo $d1[rak]?></td>
				                                	<td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
				                                </tr>
			                            <?
			                            		}
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
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>LIHAT STOK <small>BARANG &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Barang</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">KODE BARANG</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[kodebarang]?>" class="form-control" style="width:100%" disabled></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NAMA BARANG</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[namabarang]?>" class="form-control" style="width:100%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>VARIAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[varian]?>" class="form-control" style="width:100%" disabled></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">GUDANG</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[gudang]?>" class="form-control" style="width:100%" disabled></td>
					                    		</tr>
					                        	<tr>
					                        		<td>RAK</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[rak]?>" class="form-control" style="width:100%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOTAL STOK</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" class="form-control uang" value="<?echo number_format($_REQUEST[totalstok])?>" disabled>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<button type="button"  onclick="window.open('print/h2/stokdetail.php?<?echo "&idbarang=$_REQUEST[idbarang]&idgudang=$_REQUEST[idgudang]&gudang=$_REQUEST[gudang]&rak=$_REQUEST[rak]&totalstok=$_REQUEST[totalstok]&&varian=$_REQUEST[varian]&namabarang=$_REQUEST[namabarang]&kodebarang=$_REQUEST[kodebarang]";?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-info pull-left"><i class="fa fa-print"></i> Cetak</button>
	                           			
				                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			                                    <th width="12%" style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="10%" style="padding:7px"><center>TANGGAL BELI</center></th>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                                    	<th width="12%" style="padding:7px"><center>HARGA BELI + PPN (RP)</center></th>
			                                    <?
			                                    	}
			                                    ?>
			                                    <th width="12%" style="padding:7px"><center>HARGA JUAL</br>NORMAL (RP)</center></th>
			                                    <th width="7%" style="padding:7px"><center>STOK</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?	                         
										$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND rak='$_REQUEST[rak]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            	$dS = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notabeli_vw WHERE nonota='$dA[nonota]'"));
			                            	if(empty($dA[stok])){
												$stok = "0";
												}
											else{
												$stok = $dA[stok];
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[nonota]?></td>
			                                    <td><?echo $dS[nama]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                                    	<td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih]*1.1,"0","",".")?></span></td>
			                                    <?
			                                    	}
			                                    ?>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:0%"><?echo number_format($stok,"0","",".")?> PCS</span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <!--
			                            <tfoot>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<th colspan="" align="right">GRAND TOTAL</th>
			                            		<td colspan="" align="right"><span style="margin-right:0%"><b><?echo number_format($d1[totalqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[grandtotal])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            </tfoot>
			                            -->
			                        </table>
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
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>