<?
	if($submenu == 'A')
		{
?>
		<script type="text/javascript">
			var s5_taf_parent = window.location;
			function popup_print(){
				window.open('print/stokunit.php?idgudang=<?echo $_REQUEST[idgudang]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
				}
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>LIHAT STOK</h4>
                                    <div style="float:right;" class="col-xs-5">
			                   			<form method="post" action="" enctype="multipart/form-data">
			                   			<?
			                   			if(!empty($_REQUEST[idgudang]))
			                   				{
											$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE idgudang='$_REQUEST[idgudang]' GROUP BY idbarang,idgudang");
											}
										else
			                   				{
											$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw GROUP BY idbarang,idgudang");
											}
			                   			?>
                                    	<table>
                                    		<tr>
                                    			<td><select name="idgudang" class="form-control" style="height:35px">
														<option value='' >SEMUA LOKASI</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($_REQUEST[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width=""  style="padding:7px">WARNA</th>
			                                    <th width="" style="padding:7px">TAHUN</th>
			                                    <th width="" style="padding:7px">STOK (UNIT)</th>
			                                    <th width="" style="padding:7px">LOKASI GUDANG</th>
			                                    <!--
			                                    <th width="1%" style="padding:7px">AKSI</th>
			                                    -->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dS = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS stok FROM tbl_stokunit WHERE idbarang='$d1[idbarang]' AND idgudang='$d1[idgudang]' AND (status='STOK' OR substr(status,1,2)='NP')"))
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&idbarang=$d1[idbarang]&idgudang=$d1[idgudang]"?>'">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[warna]?></td>
			                                    <td align="center"><?echo $d1[thnproduksi]?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo number_format($dS[stok],"0","",".")?></span></td>
			                                    <td><?echo $d1[gudang]?></td>
			                                    <!--
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-120px;font-size: 12px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-detailstok<?echo $d1[nonota]?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat Detail</a></li>
			                                           	</ul>
			                                        </div>
			                                        </td>
			                                    -->
			                                </tr>
			                                
			                            <?
											$no++;
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
		
	if($submenu == 'B')
		{
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$_REQUEST[idbarang]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>LIHAT STOK </h4>
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">KODE BARANG</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" value="<?echo $dA[kodebarang]?>" class="form-control" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NAMA BARANG</td>
					                        		<td>:</td>
					                        		<td><input type="text" value="<?echo $dA[namabarang]?>" class="form-control" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>VARIAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $dA[varian]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">WARNA</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $dA[warna]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
												<tr>
					                        		<td>TAHUN PRODUKSI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $dA[thnproduksi]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
					                    </div>
				                    </div>
									
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. RANGKA <?//echo $_REQUEST[idbarang].$_REQUEST[idgudang]?></th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th width="" style="padding:7px">LOKASI</th>
												<?
												if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
													{
												?>
				                                    <th width="15%" style="padding:7px">HARGA MODAL (RP)</th>
				                                    <th width="20%" style="padding:7px">HARGA MODAL+PPN (RP)</th>
												<?
													}
												?>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[idgudang])){
											$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE idbarang='$_REQUEST[idbarang]' AND idgudang='$_REQUEST[idgudang]' AND (status='STOK' OR substr(status,1,2)='NP')");
				                            }
										if(empty($_REQUEST[idgudang])){
											$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE idbarang='$_REQUEST[idbarang]' AND (status='STOK' OR substr(status,1,2)='NP')");
				                            }
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer" >
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td><?echo $d1[gudang]?></td>
												<?
												if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
													{
												?>
				                                    <td align="right"><?echo number_format($d1[hargabelibersih],"0","",".")?></td>
				                                    <td align="right"><?echo number_format(($d1[hargabelibersih]+$d1[ppn]),"0","",".")?></td>
												<?
													}
												?>
			                                </tr>
			                                
			                            <?
											$no++;
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
?>
	
        <script src="js/jquery.min.js"></script>
        
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
            });
        </script>