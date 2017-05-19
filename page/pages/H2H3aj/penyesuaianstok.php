<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME</small></h4>
	                           		<div style="float:right" class="col-xs-7">
	                           		<?
	                           		if(empty($_SESSION[tanggal]))
	                           			{
									?>
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Stock Opname</button>
										</a>
									<?
										}
	                           		else
	                           			{
									?>
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Stock Opname</button>
										</a>
									<?
										}
	                           		?>
	                           		</div>
                                    <div style="float:left;width:30%;margin-left:15px">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
                                    	if(!empty($_REQUEST[tahun]) && !empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = $_REQUEST[tahun];
                                    		$periode_bulan = $_REQUEST[bulan];
											}
                                    	else if(empty($_REQUEST[tahun]) && empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = date("Y");
											$periode_bulan = date('m');
                                    		}
										?>
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
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
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">TGL STOCK OPNAME</th>
			                                    <th style="padding:7px">LOKASI GUDANG</th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_opname WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dG = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id%2=0 AND id='$d1[idgudang]'"));
			                            	if(empty($dG[gudang])){
												$lokasi = "SEMUA GUDANG";
												}
											else{
												$lokasi = $dG[gudang];
												}
											if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>Belum Dikonfirmasi Pihak Manajemen</span>";}
			                            
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td align=""><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $lokasi?></td>
			                                    <td align="center"><?echo $status?></td>
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
		
	else if($submenu == 'view')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_opname WHERE id%2=0 AND id='$_REQUEST[id]'"));
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
?>
		<script type="text/javascript">
			var s5_taf_parent = window.location;
			function popup_print(){
				window.open('printaj/h2/stokopname.php?id=<?echo $_REQUEST[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
				}
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>GUDANG & PDI <small>LIHAT STOCK OPNAME</small></h4>		
			                		<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TGL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width="25%"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:45%"></td>
				                        		<td rowspan="2" width="15%"></td>
				                        		<td rowspan="3"></td>
				                        		<td rowspan="3"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI GUDANG</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:100%" disabled="">
														<option value='' >SEMUA LOKASI GUDANG</option>
														<?php
														$q = mysql_query('SELECT * FROM x23_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($d1[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>
														<?php
															}
														?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td>STATUS</td>
				                        		<td>:</td>
				                        		<td colspan="2"><?echo $status?></td>
				                        	</tr>
				                        </table>
					                </div>
									</br>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:320px;margin-top:-20px">
				                        <table id="example1" class="table table-striped table-hover">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th width="5%" style="padding:7px">RAK</th>
				                                    <th width="10%" style="padding:7px"><center>NO.NOTA BELI</center></th>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th style="padding:7px">VARIAN</th>
				                                    <th width="1%" style="padding:7px">OPNAME</th>
				                                    <th width="8%" style="padding:7px">STOK</th>
				                                    <th width="12%" style="padding:7px"><center>SELISIH</center></th>
				                                    <th width="15%" style="padding:7px"><center>JUMLAH SELISIH (RP)</center></th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?	
											$qIm = mysql_query("SELECT * FROM x23_opname_det_vw WHERE id%2=0 AND idopname='$_REQUEST[id]'");
				                            while($d1 = mysql_fetch_array($qIm))
				                            	{
        										if(!empty($d1[opname]) OR $d1[opname]=="0"){
													$red = "";
													$opname = number_format($d1[opname],"0","",".");
													if($d1[selisih] < 0){
														$selisihX = (-1)*($d1[selisih]);
														$selisihY = number_format($selisihX,"0","",".");
														$selisih = "LEBIH $selisihY PCS";
														}
													else if($d1[selisih] > 0){
														$selisihY = number_format($d1[selisih],"0","",".");
														$selisih = "KURANG $selisihY PCS";
														}
													else if($d1[selisih] == 0){
														$selisih = "0 PCS";
														}
														
													if($d1[totalselisih] < 0){
														$totselisihX = (-1)*($d1[totalselisih]);
														$totselisihY = number_format($totselisihX,"0","",".");
														$totselisih = "LEBIH $totselisihY";
														}
													else if($d1[totalselisih] > 0){
														$totselisihY = number_format($d1[totalselisih],"0","",".");
														$totselisih = "KURANG $totselisihY";
														}
													else if($d1[totalselisih] == 0){
														$totselisih = "0";
														}
													}
												else{
													$red = "color:#ff0227";
													$opname ="-";
													$selisih ="-";
													$totselisih ="-";
													}
				                            ?>
				                                <tr style="cursor:pointer;<?echo $red?>" data-toggle="modal" data-target="#compose-modal-opname<?echo $d1[id]?>" style="cursor:pointer">
				                                    <td><?echo $d1[rak]?></td>
				                                    <td><?echo $d1[nonota]?></td>
				                                    <td><?echo $d1[kodebarang]?> </td>
				                                    <td><?echo $d1[namabarang]?></td>
				                                    <td><?echo $d1[varian]?></td>
				                                    <td align="right"><?echo $opname?> PCS</td>
				                                    <td align="right"><?echo number_format($d1[stok],"0","",".")?> PCS</td>
				                                    <td align="right"><?echo $selisih?></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo $totselisih?></span></td>
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
				                        		<td>Rak Tidak Terscan, Jika Disetujui Maka Tidak Mempengaruhi Stok Pada Rak Tersebut</td>
				                        	</tr>
				                        	<tr>
				                        		<td>Hitam</td>
				                        		<td align="center">:</td>
				                        		<td>Rak Terscan</td>
				                        	</tr>
				                        </table>
				                        
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
					                        	<a href="#" onClick="popup_print()"><button type="button" class="btn btn-info pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a>
						                    	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
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
		
	else if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME</small></h4>
				                	<form name="formPindah" onsubmit="return vPindah();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=temp1"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TGL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width="25%"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:45%"></td>
				                        		<td rowspan="2" width="15%"></td>
				                        		<td rowspan="3"></td>
				                        		<td rowspan="3"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI GUDANG</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:100%" required="">
														<option value='' >PILIH GUDANG</option>
														<?php
														$q = mysql_query('SELECT * FROM x23_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>"><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
				                        </table>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
	else if($submenu == 'reset')
		{
		unset ($_SESSION["tanggal"]);
		unset ($_SESSION["idgudang"]);
		mysql_query("TRUNCATE temp_x23_opname_det");
		
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		}
		
	else if($submenu == 'temp1')
		{
		if(empty($_SESSION[tanggal]))
			{
			$_SESSION[tanggal]  = $_REQUEST[tanggal];
			$_SESSION[idgudang] = $_REQUEST[idgudang];
			}
			
		$qIm = mysql_query("SELECT * FROM x23_stokpart_opname_vw WHERE id%2=0 AND idgudang='$_SESSION[idgudang]'");
        while($d1 = mysql_fetch_array($qIm))
        	{
			mysql_query("INSERT INTO temp_x23_opname_det (
											idstok, 
											idgudang, 
											rak, 
											nonota, 
											tglnota, 
											idbarang, 
											stok,
											hargabeli) 
										VALUES (
											'$d1[id]', 
											'$d1[idgudang]', 
											'$d1[rak]', 
											'$d1[nonota]',
											'$d1[tglnota]',
											'$d1[idbarang]',
											'$d1[totalstok]',
											'$d1[hargabelibersih]')");
			}
			
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
			exit();
		}
		
	else if($submenu == 'C')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME</small></h4>		
			                		<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TGL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width=""><input type="text" style="width:45%" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI GUDANG</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:35%" disabled="">
														<option value='' >SEMUA LOKASI GUDANG</option>
														<?php
														$q = mysql_query('SELECT * FROM x23_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($_SESSION[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
				                        </table>
									</br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>1. Klik <i class="fa fa-star"></i></i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>2. Scan Nomor Rak Untuk Melakukan Stock Opname</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>3. Isi Hasil Opname</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>4. Klik Simpan</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>5. Klik <i class="fa fa-star"></i> Kembali Untuk Pindah Ke Nomor Rak Berikutnya</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>6. Jika Sudah Selesai Melakukan Stok Opname Pada Semua Rak, Maka Klik Lanjutkan</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>7. Jangan Klik Lanjutkan Jika Belum Selesai Melakukan Stok Opname Untuk Semua Rak</i></span>
				                        
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                        <a href="<?echo "?opt=$opt&menu=$menu&submenu=D"?>"><button type="button" class="btn btn-info pull-left" onclick="return confirm('Anda Yakin Akan Melanjutkan Proses Stock Opname?')"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button></a>
													
													<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-star"></i></button>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=reset"?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda Yakin Akan Mengulang Perhitungan?')"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button></a>
												<!--
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
												-->
											</div>
					                    </div>
					                </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="5%" style="padding:7px">RAK</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">KODE BARANG  <?echo $_REQUEST[kode]?></th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="1%" style="padding:7px">OPNAME</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[update])){
											$opname  = preg_replace( "/[^0-9]/", "",$_REQUEST['opname']);
											mysql_query("UPDATE temp_x23_opname_det SET opname='$opname' WHERE id%2=0 AND id='$_REQUEST[update]'");
											}
										
										$q3  = mysql_query("SELECT * FROM temp_x23_opname_det_vw WHERE id%2=0 AND idgudang='$_SESSION[idgudang]' AND rak='$_REQUEST[koderak]'");
										$qIm = mysql_query("SELECT * FROM temp_x23_opname_det_vw WHERE id%2=0 AND idgudang='$_SESSION[idgudang]' AND rak='$_REQUEST[koderak]'");
										if(empty($_REQUEST[koderak]))
											{}
										else
											{
											$x = 1;
				                            while($d1 = mysql_fetch_array($qIm))
				                            	{
				                            	if(!empty($d1[opname])){$x++;}
			                            ?>
				                                <tr data-toggle="modal" data-target="#compose-modal-opname<?echo $d1[id]?>" style="cursor:pointer">
				                                    <td><?echo $d1[rak]?></td>
				                                    <td><?echo $d1[nonota]?></td>
				                                    <td><?echo $d1[kodebarang]?> </td>
				                                    <td><?echo $d1[namabarang]?></td>
				                                    <td><?echo $d1[varian]?></td>
				                                    <td align="right" width="8%"><input type="text" value="<?echo number_format($d1[opname],"0","",".")?>" onkeypress="return buat_angka(event,'0123456789')" onfocus="this.select();" style="width:80%;text-align:right;height:25px" class="form-control uang" readonly=""></td>
				                                </tr>
			                            <?
												}
			                            	}
			                            ?>
			                            </tbody>
			                            <?if($x > 1){?>
										<input type='hidden' name="simpanrak" value="<?echo $_REQUEST[koderak]?>">
			                        	<a href=""><button type="button" class="btn btn-primary pull-right" onclick="return confirm('Anda yakin Akan Menyimpan Data Dan Melanjutkan Ke Rak Berikutnya?')" style="margin-right:55px"><i class="fa fa-save"></i> &nbsp;Simpan</button></a>
			                        	<?}?>
			                        </table>
<?
		            			while($d3 = mysql_fetch_array($q3))
									{
?>
			<!-- ################## MODAL BAYAR ########################################################################################## -->
							        <div class="modal fade " id="compose-modal-opname<?echo $d3[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
							            <div class="modal-dialog" style="width:30%;">
							                <div class="modal-content">
							                    <div class="modal-header">
							                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                        <h4 class="modal-title">OPNAME <?echo $d3[kodebarang]?></h4>
							                    </div>
												
							                   	<form method="post" action="" enctype="multipart/form-data">
						                        <div class="modal-body">
							                    	<table width="100%">
							                    		<tr>
							                    			<td width="40%">QTY OPNAME</td>
							                    			<td width="2%">:</td>
							                    			<td width="35%">
							                                    <div class="input-group">
							                                        <input type="text" name="opname" style="width:100%;text-align:right" class="form-control uang" maxlength="6" onkeypress="return buat_angka(event,'1234567890')"  required>
							                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
							                                    </div></td>
							                                <td></td>
							                    		</tr>
							                    		<input type="hidden" name="update" value="<?echo $d3[id]?>">
							                    		<input type="hidden" name="koderak" value="<?echo $_REQUEST[koderak]?>">
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
?>
						
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			
			<form method="post" action="">
				<input type="text" name="koderak" autofocus maxlength="5" style="width:0%">
			</form>
<?
		}
		
	else if($submenu == 'D')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME</small></h4>		
			                		<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TGL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td width=""><input type="text" style="width:45%" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>LOKASI GUDANG</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:35%" disabled="">
														<option value='' >SEMUA LOKASI GUDANG</option>
														<?php
														$q = mysql_query('SELECT * FROM x23_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($_SESSION[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
															}
														?>
													</select></td>
				                        	</tr>
				                        </table>
				                        
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                        <a href="<?echo "?opt=$opt&menu=$menu&submenu=save"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyimpan Hasil Stock Opname?')"><i class="fa fa-save"></i> &nbsp;Simpan</button></a>
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
					                    </div>
					                </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="5%" style="padding:7px">RAK</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">KODE BARANG  <?//echo $_REQUEST[kode]?></th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="1%" style="padding:7px">OPNAME</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?	
										$qIm = mysql_query("SELECT * FROM temp_x23_opname_det_vw WHERE id%2=0 AND idgudang='$_SESSION[idgudang]'");
										
			                            while($d1 = mysql_fetch_array($qIm))
			                            	{
			                            	if(!empty($d1[opname]) OR $d1[opname]=="0"){
			                            		$opname = number_format($d1[opname],"0","",".");
													$red = "";
												}
			                            	else{
			                            		$opname = "-";
													$red = "color:#ff0227";
												}
			                            ?>
			                                <tr data-toggle="modal" data-target="#compose-modal-opname<?echo $d1[id]?>" style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo $d1[rak]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo $d1[kodebarang]?> </td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
				                                <td align="right" width="8%"><?echo $opname?> PCS</td>
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
		
	else if($submenu == 'save')
		{
        $tanggal  = date("Y-m-d", strtotime($_SESSION[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
		
		$dG = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id%2=0 AND id='$_SESSION[idgudang]'"));
        
		$q1 = mysql_query("INSERT INTO x23_opname (
											tahun, 
											bulan, 
											tanggal, 
											idgudang, 
											user, 
											inputx) 
										VALUES (
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'$_SESSION[idgudang]', 
											'$_SESSION[id]', 
											NOW())
							");
							
		//$idopname = mysql_insert_id();
		$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
		$idopname	= $id[id];
		
		$qIm = mysql_query("SELECT * FROM temp_x23_opname_det_vw WHERE id%2=0 AND idgudang='$_SESSION[idgudang]'");
		while($d1 = mysql_fetch_array($qIm))
        	{
        	if(!empty($d1[opname]) OR $d1[opname]=="0"){
				$selisih = $d1[stok]-$d1[opname];
				$totalselisih = $selisih*$d1[hargabeli];
				}
        	else{
				$selisih = "";
				$totalselisih = "";
				}
				
			mysql_query("INSERT INTO x23_opname_det (
												idopname, 
												idstok, 
												idgudang, 
												rak, 
												nonota, 
												tglnota, 
												idbarang, 
												stok, 
												opname, 
												hargabeli, 
												selisih, 
												totalselisih) 
											VALUES (
												'$idopname', 
												'$d1[idstok]', 
												'$_SESSION[idgudang]', 
												'$d1[rak]', 
												'$d1[nonota]', 
												'$d1[tglnota]', 
												'$d1[idbarang]', 
												'$d1[stok]', 
												'$d1[opname]', 
												'$d1[hargabeli]', 
												'$selisih', 
												'$totalselisih')
						");
			}	
								
		$dS  = mysql_fetch_array(mysql_query("SELECT SUM(selisih) AS totselisih, SUM(totalselisih) AS totjumselisih FROM x23_opname_det WHERE id%2=0 AND idopname='$idopname'"));
		       mysql_query("UPDATE x23_opname SET totselisih='$dS[totselisih]', totjumselisih='$dS[totjumselisih]' WHERE id%2=0 AND id='$idopname'");
											
		$q2 = mysql_query("INSERT INTO x23_abis_dkonfirmasi (
											idopname, 
											tahun, 
											bulan, 
											tanggal, 
											kasus, 
											tbl, 
											inputx) 
										VALUES (
											'$idopname', 
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'KONFIRMASI STOCK OPNAME $dG[gudang]', 
											'x23_opname', 
											NOW())
							");
							
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_opname',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH STOCK OPNAME $idopname')
							");
		
		unset($_SESSION[tanggal]);
		unset($_SESSION[idgudang]);
		mysql_query("TRUNCATE temp_x23_opname_det");
		
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		}
?>
	
        <script src="js/jquery.min.js"></script>
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
                    "bAutoWidth": false
                });
            });
        </script>