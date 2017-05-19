<?
	if($submenu == 'A')
		{
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
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>AKTIVITAS BISNIS <small>DAFTAR KONFIRMASI</small></h4>	
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Proses Dilanjutkan Ke Menu Master Input Harga.</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="2")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Barang Sudah Pindah Ke Lokasi Tujuan.</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="3")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Stok Sudah Terbarui Dan Besar Nilai Retur Sudah Dapat Digunakan Untuk Potong Nota Beli.</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="4")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Stok Sudah Terbarui Dan Besar Nilai Selisih Penyesuaian Stok Sudah Masuk Arus Kas.</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="5")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Akses Tutup Harian Sudah Dibuka.</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="A1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Pembayaran Piutang & Potongan Kompensasi Pada Bagian Kasir.</p>
	                                    </div>
									<?
										}
									?>
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:35%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px" required="">
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
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px" required="">
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
									</div>
                                    </form>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{         
			                    ?>
				                        <table id="example3" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th width="10%">TANGGAL</th>
													<th>PERIHAL KONFIRMASI</th>
													<th>STATUS</th>
												</tr>
											</thead>
				                            <tbody>
					                        <?
												$q1	 = mysql_query("SELECT * FROM x23_abis_dkonfirmasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' GROUP BY inputx ORDER BY id DESC");
												while($d1  = mysql_fetch_array($q1))
													{
					                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:130px'>Ditolak</span>";}
					                            	if($d1[status]=="3"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:130px'>Sudah Direspon</span>";}
					                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:130px'>Disetujui</span>";}
					                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:130px'>Belum Direspon</span>";}
					                            	
					                            	if($d1[idopname]!='0' OR $d1[idtutupservis]!='0' OR $d1[idtutupharian]!='0'){}
					                            	else{
					                        ?>
													<tr style='cursor:pointer' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
				                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
														<td><?echo $d1[kasus]?></td>
														<td align='center'><?echo $status?></td>
														<!--
														<td align='center'>
															<div class='btn-group'>
					                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' style='font-size: 2px'>
					                                                <span class='caret'></span>
					                                                <span class='sr-only'></span>
					                                            </button>
					                                            <ul class='dropdown-menu' role='menu' style='margin-left:-95px;font-size: 12px'>
					                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>"><i class='fa fa-search'></i>Lihat Detail</a></li>
					                                            </ul>
					                                        </div>
															</td> 
														-->
													</tr>
											<?
													}
												}
											?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="10">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
			                    		<div class="clearfix"></div>
								<?
				                	}
				                ?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'view')
		{
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM x23_abis_dkonfirmasi WHERE id='$_REQUEST[id]'"));
		if(!empty($dX[idkaskecil]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_kaskecil WHERE id='$dX[idkaskecil]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI KAS KECIL</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>JUMLAH</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="RP. <?echo number_format($dA[jumlah],"0","",".")?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td valign="top">KETERANGAN</td>
				                        		<td valign="top">:</td>
				                        		<td colspan="2"><textarea class="form-control" readonly><?echo $dA[keterangan]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:200px;margin-top:-20px">
					                    	
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                    <?
						                    if($dX[status]=='0')
						                    	{
											?>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=tolak&id=$_REQUEST[id]"?>"><button type="button" style="margin-left: 5px" class="btn btn-danger pull-left" onclick="return confirm('Anda Yakin Akan Menolak?')"><i class="fa fa-thumbs-o-down"></i> &nbsp;Tolak</button></a>
						                    <?
												}	
						                    ?>
						                      	<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			
		if(!empty($dX[idnotabeli]))
			{
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$dX[idnotabeli]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d1[iduserkonf]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI QTY TIBA</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
									<?
									$dC2 = mysql_fetch_array(mysql_query("SELECT jns FROM x23_notabeli WHERE nonota='$d1[nonota]'"));
									if($dC2[jns]=="PEMBELIAN")
										{
									?>
			                			<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
											<div class="col-xs-6">
												<table width="100%">
													<tr>
														<td width="35%">NAMA SUPPLIER</td>
														<td width="3%">:</td>
														<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																			<option value=''>Pilih</option>
																			
																		<?
																			$qA = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
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
														<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
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
														<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:60%"></td>
													</tr>
													<tr>
														<td>TGL NOTA BELI</td>
														<td>:</td>
														<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:60%"></td>
													</tr>
												</table>
											</div>
										
							                <?
							                if($dX[status]=='0')
							                	{
											?>
								            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u2"?>">
						                        <table class="table table-striped" id="example4">
						                            <thead style="color:#666;font-size:13px">
						                                <tr>
						                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
						                                    <th style="padding:7px">NAMA BARANG</th>
						                                    <th style="padding:7px">VARIAN</th>
						                                    <th width="" style="padding:7px">GUDANG</th>
						                                    <th width="" style="padding:7px">RAK</th>
						                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
						                                    <th width="10%" style="padding:7px"><center>QTY TIBA</center></th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            <?
													$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
						                            while($dA = mysql_fetch_array($q1))
						                            	{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE nonota='$dA[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]'AND rak='$dA[rak]'"));
						                            	if($dB[stok] != $dA[qty]){
							                                if($d1[konf]=='1')
							                                	{
																$red = "color:#ff0227";
																}
															}
														else{$red="";}
						                            ?>
						                                <tr style="cursor:pointer;<?echo $red?>">
						                                    <td><?echo "$dA[kodebarang]"?></td>
						                                    <td><?echo "$dA[namabarang]"?></td>
						                                    <td><?echo "$dA[varian]"?></td>
						                                    <td><?echo $dA[gudang]?></td>
						                                    <td><?echo $dA[rak]?></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
						                                <?
						                                if($dB[status]=='0')
						                                	{
						                                ?>
						                                    <td align="center"><input type="text" name="qtytiba<?echo $dA[id]?>" value="<?echo number_format($dB[stok],"0","",".")?>" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" style="width:80%;text-align:right;height:25px" required=""></td>
						                                <?
						                                	}
						                                else
						                                	{
						                                ?>
						                                    <td align="center"><input type="text" name="qtytiba<?echo $dA[id]?>" value="<?echo number_format($dB[stok],"0","",".")?>" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" style="width:80%;text-align:right;height:25px" readonly=""></td>
						                                <?
															}
														?>
						                                </tr>
						                            <?
						                            	}
						                            ?>
						                            </tbody>
						                        </table>
						                        <?
				                                if($d1[konf]=='1')
				                                	{
				                                ?>
							                        </br>
							                        <table>
							                        	<tr>
							                        		<td colspan="3"><b>Keterangan</b></td>
							                        	</tr>
							                        	<tr>
							                        		<td style="color:#ff0227">Merah</td>
							                        		<td width="15px" align="center">:</td>
							                        		<td>Qty Barang Tiba Tidak Sama Dengan Qty Beli</td>
							                        	</tr>
							                        	<tr>
							                        		<td>Hitam</td>
							                        		<td align="center">:</td>
							                        		<td>Qty Barang Tiba Sama Dengan Qty Beli</td>
							                        	</tr>
							                        </table>
						                        <?
						                        	}
						                        ?>
								                
							           			<div class="col-xs-12">
							           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
							           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
							                        <div class="modal-footer clearfix"> 
							                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
							                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
													</div>
							                    </div>
						                        </form>
											<?
												}
							                if($dX[status]=='1')
							                	{
											?>
						                        <table class="table table-striped" id="example4">
						                            <thead style="color:#666;font-size:13px">
						                                <tr>
						                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
						                                    <th style="padding:7px">NAMA BARANG</th>
						                                    <th style="padding:7px">VARIAN</th>
						                                    <th width="" style="padding:7px">GUDANG</th>
						                                    <th width="" style="padding:7px">RAK</th>
						                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
						                                    <th width="10%" style="padding:7px"><center>QTY TIBA</center></th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            <?
													$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
						                            while($dA = mysql_fetch_array($q1))
						                            	{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE nonota='$dA[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]'AND rak='$dA[rak]'"));
						                            ?>
						                                <tr style="cursor:pointer;<?echo $red?>">
						                                    <td><?echo "$dA[kodebarang]"?></td>
						                                    <td><?echo "$dA[namabarang]"?></td>
						                                    <td><?echo "$dA[varian]"?></td>
						                                    <td><?echo $dA[gudang]?></td>
						                                    <td><?echo $dA[rak]?></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
						                                 	<td align="right"><span style="margin-right:20%"><?echo number_format($dB[stok],"0","",".")?> PCS</span></td>
														</tr>
						                            <?
						                            	}
						                            ?>
						                            </tbody>
						                        </table>
								                
							           			<div class="col-xs-12">
							           				<div class="modal-footer clearfix"> 
							                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
													</div>
							                    </div>
						                    <?
												}
							                ?>
					                    </div>
					                <?
					                	}
					                	
									if($dC2[jns]=="CLAIM")
										{
									?>
			                			<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
			                				<div class="col-xs-6">
												<table width="100%">
													<tr>
														<td width="35%">NAMA SUPPLIER</td>
														<td width="3%">:</td>
														<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																			<option value='' selected>MPM</option></select></td>
													</tr>
													<tr>
														<td>NO. PO CLAIM OLI</td>
														<td>:</td>
														<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
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
														<td width="40%">TGL PO CLAIM MPM</td>
														<td width="3%">:</td>
														<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:60%"></td>
													</tr>
													<tr>
														<td>TGL NOTA CLAIM MPM</td>
														<td>:</td>
														<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:60%"></td>
													</tr>
												</table>
											</div>
										
							                <?
							                if($dX[status]=='0')
							                	{
											?>
								            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u2"?>">
						                        <table class="table table-striped" id="example4">
						                            <thead style="color:#666;font-size:13px">
						                                <tr>
						                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
						                                    <th style="padding:7px">NAMA BARANG</th>
						                                    <th style="padding:7px">VARIAN</th>
						                                    <th width="" style="padding:7px">GUDANG</th>
						                                    <th width="" style="padding:7px">RAK</th>
						                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
						                                    <th width="10%" style="padding:7px"><center>QTY TIBA</center></th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            <?
													$q1 = mysql_query("SELECT * FROM x23_notabeli_det WHERE nonota='$d1[nonota]'");
						                            while($dA = mysql_fetch_array($q1))
						                            	{
														$dC = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$dA[idbarang]]'"));
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE nonota='$dA[nonota]' AND idbarang='$dA[idbarang]'"));
														$dD = mysql_fetch_array(mysql_query("SELECT gudang FROM x23_gudang WHERE id='$dB[idgudang]]'"));
						                            	if($dB[stok] != $dA[qty]){
							                                if($d1[konf]=='1')
							                                	{
																$red = "color:#ff0227";
																}
															}
														else{$red="";}
						                            ?>
						                                <tr style="cursor:pointer;<?echo $red?>">
						                                    <td><?echo "$dC[kodebarang]"?></td>
						                                    <td><?echo "$dC[namabarang]"?></td>
						                                    <td><?echo "$dC[varian]"?></td>
						                                    <td><?echo $dD[gudang]?></td>
						                                    <td><?echo $dB[rak]?></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
						                                <?
						                                if($dB[status]=='0')
						                                	{
						                                ?>
						                                    <td align="center"><input type="text" name="qtytiba<?echo $dA[id]?>" value="<?echo number_format($dB[stok],"0","",".")?>" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" style="width:80%;text-align:right;height:25px" required=""></td>
						                                <?
						                                	}
						                                else
						                                	{
						                                ?>
						                                    <td align="center"><input type="text" name="qtytiba<?echo $dA[id]?>" value="<?echo number_format($dB[stok],"0","",".")?>" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" style="width:80%;text-align:right;height:25px" readonly=""></td>
						                                <?
															}
														?>
						                                </tr>
						                            <?
						                            	}
						                            ?>
						                            </tbody>
						                        </table>
						                        <?
				                                if($d1[konf]=='1')
				                                	{
				                                ?>
							                        </br>
							                        <table>
							                        	<tr>
							                        		<td colspan="3"><b>Keterangan</b></td>
							                        	</tr>
							                        	<tr>
							                        		<td style="color:#ff0227">Merah</td>
							                        		<td width="15px" align="center">:</td>
							                        		<td>Qty Barang Tiba Tidak Sama Dengan Qty Beli</td>
							                        	</tr>
							                        	<tr>
							                        		<td>Hitam</td>
							                        		<td align="center">:</td>
							                        		<td>Qty Barang Tiba Sama Dengan Qty Beli</td>
							                        	</tr>
							                        </table>
						                        <?
						                        	}
						                        ?>
								                
							           			<div class="col-xs-12">
							           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
							           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
							                        <div class="modal-footer clearfix"> 
							                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
							                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
													</div>
							                    </div>
						                        </form>
											<?
												}
							                if($dX[status]=='1')
							                	{
											?>
						                        <table class="table table-striped" id="example4">
						                            <thead style="color:#666;font-size:13px">
						                                <tr>
						                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
						                                    <th style="padding:7px">NAMA BARANG</th>
						                                    <th style="padding:7px">VARIAN</th>
						                                    <th width="" style="padding:7px">GUDANG</th>
						                                    <th width="" style="padding:7px">RAK</th>
						                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
						                                    <th width="10%" style="padding:7px"><center>QTY TIBA</center></th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            <?
													$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
						                            while($dA = mysql_fetch_array($q1))
						                            	{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE nonota='$dA[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]'AND rak='$dA[rak]'"));
						                            ?>
						                                <tr style="cursor:pointer;<?echo $red?>">
						                                    <td><?echo "$dA[kodebarang]"?></td>
						                                    <td><?echo "$dA[namabarang]"?></td>
						                                    <td><?echo "$dA[varian]"?></td>
						                                    <td><?echo $dA[gudang]?></td>
						                                    <td><?echo $dA[rak]?></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
						                                 	<td align="right"><span style="margin-right:20%"><?echo number_format($dB[stok],"0","",".")?> PCS</span></td>
														</tr>
						                            <?
						                            	}
						                            ?>
						                            </tbody>
						                        </table>
								                
							           			<div class="col-xs-12">
							           				<div class="modal-footer clearfix"> 
							                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
													</div>
							                    </div>
						                    <?
												}
							                ?>
					                    </div>
					                <?
					                	}
					                ?>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
			}
			
		if(!empty($dX[idnotabeli2]))
			{
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id='$dX[idnotabeli2]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d1[iduserbyr]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>INPUT HARGA JUAL BARANG</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$qA = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
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
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
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
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:60%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:60%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                    
						                <?
						                if($dX[status]=='0')
						                	{
										?>
							            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u3"?>">
					                        <table id="example4" class="table table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">KODE BARANG</th>
					                                    <th style="padding:7px">NAMA BARANG</th>
					                                    <th style="padding:7px">VARIAN</th>
					                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
					                                    <th width="" style="padding:7px">GUDANG</th>
					                                    <th width="" style="padding:7px">RAK</th>
					                                    <th width="13%" style="padding:7px"><center>HARGA BELI (RP)</center></th>
					                                    <th width="13%" style="padding:7px"><center>HARGA JUAL</br>NORMAL (RP)</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo $dA[kodebarang]?></td>
					                                    <td><?echo "$dA[namabarang]"?></td>
					                                    <td><?echo "$dA[varian]"?></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[stok],"0","",".")?> PCS</span></td>
					                                    <td><?echo $dA[gudang]?></td>
					                                    <td><?echo $dA[rak]?></td>
					                                    <td><input type="text" name="hargabelibersih<?echo $dA[id]?>" value="<?echo number_format($dA[hargabelibersih],"0","",".")?>" class="form-control uang" maxlength="13" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:90%;height:25px;text-align:right" required="" ></td>
					                                    <td><input type="text" name="hargajual<?echo $dA[id]?>" class="form-control uang" maxlength="13" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" style="width:90%;height:25px;text-align:right" required="" ></td>
					                                </tr>
					                                
					                            <?
					                            	}
					                             ?>
					                            </tbody>
					                            <tfoot>
					                            	<tr>
					                            		<th colspan=""></th>
					                            		<th colspan="" align="right">GRAND TOTAL</th>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[totalqty])?> PCS</b></span></td>
					                            		<td colspan="" align="right"></td>
					                            		<th colspan="2"></th>
					                            	</tr>
					                            </tfoot>
					                        </table>
					                        
						           			<div class="col-xs-12">
						           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
						           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
						                        <div class="modal-footer clearfix"> 
						                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
						                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
												</div>
						                    </div>
					                        </form>
						                <?
						                	}
						                	
						                if($dX[status]=='1')
						                	{
										?>
					                        <table id="example4" class="table table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">KODE BARANG</th>
					                                    <th style="padding:7px">NAMA BARANG</th>
					                                    <th style="padding:7px">VARIAN</th>
					                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
					                                    <th width="" style="padding:7px">GUDANG</th>
					                                    <th width="" style="padding:7px">RAK</th>
					                                    <th width="13%" style="padding:7px"><center>HARGA BELI (RP)</center></th>
					                                    <th width="13%" style="padding:7px"><center>HARGA JUAL</br>NORMAL (RP)</center></th>
					                                    <th width="13%" style="padding:7px"><center>HARGA JUAL</br>KPB (RP)</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo $dA[kodebarang]?></td>
					                                    <td><?echo "$dA[namabarang]"?></td>
					                                    <td><?echo "$dA[varian]"?></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[stok],"0","",".")?> PCS</span></td>
					                                    <td><?echo $dA[gudang]?></td>
					                                    <td><?echo $dA[rak]?></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual2],"0","",".")?></span></td>
					                                </tr>
					                                
					                            <?
					                            	}
					                             ?>
					                            </tbody>
					                            <tfoot>
					                            	<tr>
					                            		<th colspan=""></th>
					                            		<th colspan="" align="right">GRAND TOTAL</th>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[totalqty])?> PCS</b></span></td>
					                            		<td colspan="" align="right"></td>
					                            		<th colspan="3"></th>
					                            	</tr>
					                            </tfoot>
					                        </table>
					                        
						           			<div class="col-xs-12">
						                        <div class="modal-footer clearfix"> <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
												</div>
						                    </div>
										<?
											}
										?>
				                    </div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
			}
			
		if(!empty($dX[idreturbeli]))
			{   
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_vw WHERE id='$dX[idreturbeli]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d1[idgdg]'"));
			$d3 = mysql_fetch_array(mysql_query("SELECT SUM(qtykeluar) AS total FROM x23_returbeli_det WHERE noretur='$d1[noretur]' AND tanggal='$d1[tanggal]'"));  
			
					                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:130px'>Ditolak</span>";}
					                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:130px'>Disetujui</span>";}
					                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:130px'>Belum Direspon</span>";}
					                       
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI RETUR BELI</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:auto;height:300px;margin-top:-20px">
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
					                        		<td>NO. NOTA RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo $d1[noretur]?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
												<tr>
					                        		<td>TGL RETUR BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglretur" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
												<tr>
					                        		<td>QTY KELUAR</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo number_format($d3[total])?> PCS" class="form-control" readonly="" style="width:60%"></td>
					                        	</tr>
												<tr>
					                        		<td>STATUS</td>
					                        		<td>:</td>
					                    			<td><?echo $status?></td>
					                        	</tr>
					                        </table>
					                    </div>
					                    
				                        <table id="example4" class="table table-striped table-hover" style="width:160%">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">BARANG</th>
				                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
				                                    <th width="" style="padding:7px"><center>HARGA BELI (RP)</center></th>
				                                    <th width="" style="padding:7px"><center>JUMLAH BELI (RP)</center></th>
				                                    <th width="" style="padding:7px">GUDANG</th>
				                                    <th width="" style="padding:7px">RAK</th>
				                                    <th width="6%" style="padding:7px"><center>STOK TERKINI</center></th>
				                                    <th width="6%" style="padding:7px"><center>QTY KELUAR</center></th>
				                                    <th width="9%" style="padding:7px"><center>JUMLAH KELUAR (RP)</center></th>
				                                    <th width="6%" style="padding:7px"><center>QTY RETUR</center></th>
				                                    <th width="9%" style="padding:7px"><center>JUMLAH RETUR BELI (RP)</center></th>
				                                    <th width="" style="padding:7px"><center>KETERANGAN</center></th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
												$cs = 1;
												$dZ = mysql_fetch_array(mysql_query("SELECT SUM(qtykeluar) AS qtykeluar,SUM(totalkeluar) AS totalkeluar FROM x23_returbeli_det_vw WHERE noretur='$d1[noretur]'"));
												$qY = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE noretur='$d1[noretur]'");
					                            while($dY = mysql_fetch_array($qY))
					                            	{
													$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE idbarang='$dY[idbarang]' AND idgudang='$dY[idgudang]' AND rak='$dY[rak]' AND nonota='$dY[nonota]'"));
													$dSt = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE idbarang='$dY[idbarang]' AND idgudang='$dY[idgudang]' AND rak='$dY[rak]' AND nonota='$dY[nonota]'"));
				                            
													if($dSt[stok] < $dY[qtykeluar]){
														$cs++;
														}
											?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo "$dY[kodebarang] $dY[namabarang] | $dY[varian]"?></td>
					                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
					                                    <td><?echo $dY[gudang]?></td>
					                                    <td><?echo $dY[rak]?></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dSt[stok],"0","",".")?> PCS</span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dY[qtykeluar],"0","",".")?> PCS</span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dY[totalkeluar],"0","",".")?></span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dY[qty],"0","",".")?> PCS</span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dY[total],"0","",".")?></span></td>
					                                    <td align=""><?echo $dY[ket]?></td>
					                                </tr>
				                            <?
				                            		}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                            	<tr>
				                            		<td colspan="7" align="right"><b>GRAND TOTAL</b></td>
					                                    <td align="right"><span style="margin-right:20%"><b><?echo number_format($dZ[qtykeluar],"0","",".")?> PCS</b></span></td>
					                                    <td align="right"><span style="margin-right:20%"><b><?echo number_format($dZ[totalkeluar],"0","",".")?></b></span></td>
				                            		<td colspan="7"></td>
				                            	</tr>
				                            </tfoot>
				                        </table>
					                        
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                    <?
						                    if($dX[status]=='0'){
												if($cs=="1"){
											?>
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]&nonota=$d1[nonota]&idsupplier=$d1[idsupplier]&noretur=$d1[noretur]&qtykeluar=$dZ[qtykeluar]&totalkeluar=$dZ[totalkeluar]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
											<?
													}
											?>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=tolak&id=$_REQUEST[id]&nonota=$d1[nonota]&noretur=$d1[noretur]"?>"><button type="button" style="margin-left: 5px" class="btn btn-danger pull-left" onclick="return confirm('Anda Yakin Akan Menolak?')"><i class="fa fa-thumbs-o-down"></i> &nbsp;Tolak</button></a>
						                    <?
												}	
						                    ?>
						                      	<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			
		if(!empty($dX[idpiutang]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang_vw WHERE id='$dX[idpiutang]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI PIUTANG KARYAWAN</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TGL PENGAJUAN</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[namapic]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td valign="top">KETERANGAN</td>
				                        		<td valign="top">:</td>
				                        		<td colspan="2"><textarea class="form-control" readonly><?echo $dA[ket]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:200px;margin-top:-20px">
					                    	
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                    <?
						                    if($dX[status]=='0')
						                    	{
											?>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=tolak&id=$_REQUEST[id]"?>"><button type="button" style="margin-left: 5px" class="btn btn-danger pull-left" onclick="return confirm('Anda Yakin Akan Menolak?')"><i class="fa fa-thumbs-o-down"></i> &nbsp;Tolak</button></a>
						                    <?
												}	
						                    ?>
						                      	<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
			
		if(!empty($dX[idbyrpiutang]))
			{
    		$periode_tahun = date("Y");
			$periode_bulan = date('m');
			
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang_vw WHERE id='$dX[idbyrpiutang]'"));
			
			$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='piutang' AND idkaryawan='$dA[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
			$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='pembayaran' AND idkaryawan='$dA[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
			
			$totpiutang    = $dPiu[total];
			$totpembayaran = $dPby[total];
			$sisapiutang   = $dPiu[total]-$dPby[total];
			
			$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$dA[idkaryawan]'"));
			$dC = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS totjum FROM x23_potkompensasi WHERE idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1'"));
			$dD	= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND status='1'"));

			$total = $dC[totjum]+$dD[total]+$dA[jumlah];
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN <?//echo $total?></small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[namapic]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>METODE PEMBAYARAN</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[metodebayar]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td valign="top">KETERANGAN</td>
				                        		<td valign="top">:</td>
				                        		<td colspan="2"><textarea class="form-control" readonly><?echo $dA[ket]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:200px;margin-top:-20px">
					                    	
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
											<?//echo "$total $dB[ugapok] $dA[jumlah] $sisapiutang";?>
						                    <?
						                    if($dX[status]=='0'){
											if($dA[jumlah] <= $sisapiutang){
												if($dA[metodebayar] == "GAJI"){
						                    		if($total <= $dB[ugapok]){
											?>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
											<?
														}
													}
													
												if($dA[metodebayar] == "TUNAI"){
						                    		if($dA[jumlah] <= $sisapiutang){
											?>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
											<?
														}
													}
												}
											?>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=tolak&id=$_REQUEST[id]"?>"><button type="button" style="margin-left: 5px" class="btn btn-danger pull-left" onclick="return confirm('Anda Yakin Akan Menolak?')"><i class="fa fa-thumbs-o-down"></i> &nbsp;Tolak</button></a>
						                   	<?
										   		}
											?>
						                      	<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
											
											<?
						                    if($dX[status]=='0'){
												if($dA[metodebayar] == "GAJI"){
							                    	if($total > $dB[ugapok]){
												?>
					                                    <div class="alert alert-danger" style="margin-top:5px;margin-bottom:5px;">
					                                        <i class="fa fa-warning"></i>
					                                        <p>Total Potongan (Piutang Dan Potongan Kompensasi) Melebihi Sisa Gaji Pokok Karyawan.</p>
					                                    </div>
												<?
														}
													}
													
												if($dA[jumlah] > $sisapiutang){
												?>
				                                    <div class="alert alert-danger" style="margin-top:5px;margin-bottom:5px;">
				                                        <i class="fa fa-warning"></i>
				                                        <p>Pembayaran Piutang Melebihi Sisa Piutang Karyawan.</p>
				                                    </div>
												<?
													}
												}
											?>
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
			
		if(!empty($dX[idpotkompensasi]))
			{
    		$periode_tahun = date("Y");
			$periode_bulan = date('m');
							
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_potkompensasi_vw WHERE id='$dX[idpotkompensasi]'"));
			$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$dA[idkaryawan]'"));
			$dC = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS totjum FROM x23_potkompensasi WHERE idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1'"));
			$dD	= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND status='1'"));

			$total = $dC[totjum]+$dD[total]+$dA[jumlah];
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI POTONGAN KOMPENSASI <?//echo $dC[totjum]?></small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TGL POTONGAN KOMPENSASI</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[namapic]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>METODE PEMBAYARAN</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[metodebayar]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td valign="top">KETERANGAN</td>
				                        		<td valign="top">:</td>
				                        		<td colspan="2"><textarea class="form-control" readonly><?echo $dA[ket]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:200px;margin-top:-20px">
					                    	
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                    <?
						                    if($dX[status]=='0'){
						                    	if($total <= $dB[ugapok]){
											?>
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]&metodebayar=$dA[metodebayar]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
											<?
													}
											?>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=tolak&id=$_REQUEST[id]"?>"><button type="button" style="margin-left: 5px" class="btn btn-danger pull-left" onclick="return confirm('Anda Yakin Akan Menolak?')"><i class="fa fa-thumbs-o-down"></i> &nbsp;Tolak</button></a>
						                    <?
												}
						                    ?>
						                      	<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>	
											
											<?
						                    if($total > $dB[ugapok]){
											?>
			                                    <div class="alert alert-danger" style="margin-top:15px;margin-bottom:5px;">
			                                        <i class="fa fa-warning"></i>
			                                        <p>Potongan Kompensasi Melebihi Sisa Gaji Pokok Karyawan.</p>
			                                    </div>
											<?
												}
											?>
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
			
		if(!empty($dX[idpindah]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_pindah WHERE id='$dX[idpindah]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$dA[user]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI PINDAH LOKASI</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="90%">
				                        	<tr>
				                        		<td width="22%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td colspan="3"><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL</td>
				                        		<td>:</td>
				                        		<td colspan="3"><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td colspan="3"><input type="text" value="<?echo $d2[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td><select name="idgudang1" class="form-control" disabled="" style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($dA[idgudang1]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="15%" align="center">GUDANG TUJUAN</td>
				                        		<td colspan="2"><select name="idgudang2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Gudang</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($dA[idgudang2]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td></td>
				                        		<td></td>
				                        		<td><select name="rak1" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_stokpart WHERE idgudang='$dA[idgudang1]' GROUP BY rak ORDER BY rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($dA[rak1]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="6%" align="center">KE</td>
				                        		<td colspan="2"><select name="rak2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih Rak</option>
																<?
																	$qB = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($dA[rak2]==$dB[rak]){?>selected=""<?}?>><?echo $dB[rak]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:210px;margin-top:-20px">
				                        <table id="example2" class="table table-striped">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th style="padding:7px">VARIAN</th>
				                                    <th style="padding:7px">NO. NOTA BELI</th>
				                                    <th width="" style="padding:7px">HARGA BELI (RP)</th>
				                                    <th width="" style="padding:7px">QTY PINDAH</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$no=1;
											$q1 = mysql_query("SELECT * FROM x23_pindah_det_vw WHERE idpindah='$dX[idpindah]'");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $d1[kodebarang]?></td>
				                                    <td><?echo $d1[namabarang]?></td>
				                                    <td><?echo $d1[varian]?></td>
				                                    <td><?echo $d1[nonota]?></td>
				                                    <td align="right" width="12%"><span style="padding-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right" width="7%"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?> PCS</span></td>
				                                </tr>
				                                
				                            <?
												$no++;
				                            	}
				                             ?>
				                            </tbody>
				                        </table>
					                    	
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                    <?
						                    if($dX[status]=='0')
						                    	{
											?>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=setuju&id=$_REQUEST[id]"?>"><button type="button" class="btn btn-primary pull-left" onclick="return confirm('Anda Yakin Akan Menyetujui?')"><i class="fa fa-thumbs-o-up"></i> &nbsp;Setuju</button></a>
												<a href="<?echo "?opt=$opt&menu=$menu&submenu=tolak&id=$_REQUEST[id]"?>"><button type="button" style="margin-left: 5px" class="btn btn-danger pull-left" onclick="return confirm('Anda Yakin Akan Menolak?')"><i class="fa fa-thumbs-o-down"></i> &nbsp;Tolak</button></a>
						                    <?
												}	
						                    ?>
						                      	<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		}
		
	else if($submenu == 'u2')
		{
		$dC2 = mysql_fetch_array(mysql_query("SELECT jns,idsupplier FROM x23_notabeli WHERE nonota='$_REQUEST[nonota]'"));
			
		if($dC2[jns]=="PEMBELIAN")
			{
			$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$_REQUEST[nonota]'");
			
	        while($dA = mysql_fetch_array($qA))
	        	{
				$dB = mysql_fetch_array(mysql_query("SELECT id FROM x23_stokpart WHERE nonota='$dA[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]'AND rak='$dA[rak]'"));
	        	$id = $dA[id];
	        	$stok = preg_replace( "/[^0-9]/", "",$_REQUEST[qtytiba.$dA[id]]);
				$total = $stok*$dA[hargabelibersih];
	        	
	        	mysql_query("UPDATE x23_stokpart SET
	        									stok='$stok', 
	        									status='1',
	        									updatex='$updatex'
	        								WHERE id='$dB[id]'
	        				");
	        				
	        	mysql_query("UPDATE x23_notabeli_det SET
	        									status='1',
	        									qty='$stok',
												total='$total'
	        								WHERE id='$id'
	        				");
	        	}
	        }
	        
		if($dC2[jns]=="CLAIM")
			{
			$qA = mysql_query("SELECT * FROM x23_notabeli_det WHERE nonota='$_REQUEST[nonota]'");
			
	        while($dA = mysql_fetch_array($qA))
	        	{
				$dB = mysql_fetch_array(mysql_query("SELECT id FROM x23_stokpart WHERE nonota='$dA[nonota]' AND idbarang='$dA[idbarang]'"));
	        	$id = $dA[id];
	        	$stok = $_REQUEST[qtytiba.$dA[id]];
	        	$selisih = $dA[qty]-$stok;
	        	
	        	if($selisih > "0")
	        		{
					$p_tahun  = date("Y");
					$p_tahun2 = date("y");
					$p_bulan  = date("m");
					$p_tgl    = date("d");
						
			        $dNA = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notajual_det WHERE tglnota=CURDATE() AND notabeli='CLAIM' ORDER BY nonota DESC LIMIT 1"));
					if(empty($dNA[nonota]))
						{
						$dig3=1;
						$dig2=0;	
						$dig1=0;	
						}
					else
						{
						$x=substr("$dNA[nonota]",-3,3);
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
						
						$ulang = "ULANG$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
						
					mysql_query("INSERT INTO x23_notajual_det (notabeli,nonota,tahun,bulan,tglnota,qty,idbarang) VALUES ('CLAIM','$ulang','$p_tahun','$p_bulan',CURDATE(),'$selisih','$dA[idbarang]')");
					}
	        	
	        	mysql_query("UPDATE x23_stokpart SET
	        									stok='$stok', 
	        									status='1',
	        									updatex='$updatex'
	        								WHERE id='$dB[id]'
	        				");
	        				
	        	mysql_query("UPDATE x23_notabeli_det SET
	        									status='1',
	        									qty='$stok' 
	        								WHERE id='$id'
	        				");
	        	}
	        }
        	
        $dC = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS totalqty FROM x23_notabeli_det WHERE nonota='$_REQUEST[nonota]'"));
        $dD = mysql_fetch_array(mysql_query("SELECT SUM(tot) AS grandtotal FROM x23_stokpart_gt_vw WHERE nonota='$_REQUEST[nonota]'"));		                           
		if($dC2[idsupplier]=="1"){
			$ppn = round($dD[grandtotal]*0.1,0);  
			}
		else{
			$ppn = 0;
			} 
        
		$q1 = mysql_query("UPDATE x23_notabeli SET scan='1',totalqty='$dC[totalqty]',grandtotal='$dD[grandtotal]',grandtotalppn=$dD[grandtotal]+$ppn,gtbayar=$dD[grandtotal]+$ppn,updatex='$updatex' WHERE nonota='$_REQUEST[nonota]'");
		
		$q2 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_abis_dkonfirmasi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'MENYETUJUI KONFIRMASI SELISIH QTY TIBA $dX[idpesanan]')
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
		
	else if($submenu == 'u3')
		{
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE nonota='$_REQUEST[nonota]'");
        while($dA = mysql_fetch_array($qA))
        	{
        	$id = $dA[id];
        	$hargajual 		  = preg_replace( "/[^0-9]/", "",$_REQUEST[hargajual.$id]);
        	$hargabelibersih  = preg_replace( "/[^0-9]/", "",$_REQUEST[hargabelibersih.$id]);
        	
			
			if(!empty($_REQUEST[hargajual.$id]) && !empty($_REQUEST[hargabelibersih.$id]))
				{
		    	mysql_query("UPDATE x23_stokpart SET hargajual='$hargajual',hargabelibersih='$hargabelibersih' WHERE id='$id'");
				}
        	}
        	
		$q1 = mysql_query("UPDATE x23_notabeli SET harga='1',dk='0' WHERE nonota='$_REQUEST[nonota]'");	
								
		$q3 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
		$q4 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_stokpart',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'UPDATE HARGA JUAL $_REQUEST[nonota]')
							");
				
		if($q1)
			{
			//echo "<script>alert ('Proses berhasil.')</script>";
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
		
	else if($submenu == 'setuju')
		{
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM x23_abis_dkonfirmasi WHERE id='$_REQUEST[id]'"));
			
		if(!empty($dX[idkaskecil]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_kaskecil SET status='1' WHERE id='$dX[idkaskecil]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI KASKECIL ID $dX[idkaskecil]')
								");
			}
		if(!empty($dX[idreturbeli]))
			{		
			$dZ = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli WHERE id='$dX[idreturbeli]'"));
			$qY = mysql_query("SELECT * FROM x23_returbeli_det_vw WHERE noretur='$dZ[noretur]'");
            while($dY = mysql_fetch_array($qY))
            	{
				$dSt = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE idbarang='$dY[idbarang]' AND idgudang='$dY[idgudang]' AND rak='$dY[rak]' AND nonota='$dY[nonota]'"));
        		if($dSt[stok] < $dY[qtykeluar]){
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
					exit();
					}
        		}
									
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_returbeli SET status='2',qtykeluar='$_REQUEST[qtykeluar]',totalkeluar='$_REQUEST[totalkeluar]',updatex='$updatex' WHERE id='$dX[idreturbeli]'");
							 
			$qY = mysql_query("SELECT * FROM x23_returbeli_det WHERE noretur='$_REQUEST[noretur]'");
            while($dY = mysql_fetch_array($qY))
            	{
            	mysql_query("UPDATE x23_stokpart SET stok=stok-$dY[qtykeluar] WHERE idbarang='$dY[idbarang]' AND idgudang='$dY[idgudang]' AND rak='$dY[rak]' AND nonota='$_REQUEST[nonota]'");
            	}
			
			$q3 = mysql_query("INSERT INTO x23_notaretur VALUES (										
		                                    '',
		                                    '$_REQUEST[noretur]',
		                                    '$_REQUEST[idsupplier]',
		                                    '$_REQUEST[nonota]',
		                                    '$_REQUEST[totalkeluar]',
		                                    '',
		                                    '$_REQUEST[totalkeluar]',
		                                    '',
		                                    '',
		                                    '')
								");
								
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI RETUR BELI ID $dX[idreturbeli]')
								");
			$note = "3";
			}
			
		if(!empty($dX[idpiutang]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_piutang SET status='0',updatex='$updatex' WHERE id='$dX[idpiutang]'");
			$q3 = mysql_query("UPDATE x23_kwitansi SET status='1' WHERE nomor='$dX[idpiutang]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID $dX[idpiutang]')
								");
			}
			
		if(!empty($dX[idbyrpiutang]))
			{ 	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_piutang SET status='0',updatex='$updatex' WHERE id='$dX[idbyrpiutang]'");
			
			$dcek = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$dX[idbyrpiutang]'"));
			if($dcek[metodebayar]=="GAJI"){
				mysql_query("UPDATE x23_piutang SET status='1',updatex='$updatex' WHERE id='$dX[idbyrpiutang]'");
				}
			
			$q3 = mysql_query("UPDATE x23_kwitansi SET status='1' WHERE nomor='$dX[idbyrpiutang]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID $dX[idbyrpiutang]')
								");
			}
			
		if(!empty($dX[idpotkompensasi]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID $dX[idpotkompensasi]')
								");
			if($_REQUEST[metodebayar]=='TUNAI')
				{
				$q2 = mysql_query("UPDATE x23_potkompensasi SET status='0',updatex='$updatex' WHERE id='$dX[idpotkompensasi]'");
				$q3 = mysql_query("UPDATE x23_kwitansi SET status='1' WHERE idpotkom='$dX[idpotkompensasi]'");
				$note = "A1";
				//echo "<script>alert ('Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Pada Bagian Kasir.')</script>";	
				}
			else{
				$q2 = mysql_query("UPDATE x23_potkompensasi SET status='1',updatex='$updatex' WHERE id='$dX[idpotkompensasi]'");
				}
			}
			
		if(!empty($dX[idpindah]))
			{                       	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_pindah SET status='1' WHERE id='$dX[idpindah]'");
			
	        //$dA = mysql_fetch_array(mysql_query("SELECT idgudang2 FROM tbl_pindah WHERE id='$dX[idpindah]'"));
			
			$qA = mysql_query("SELECT * FROM x23_pindah_det WHERE idpindah='$dX[idpindah]'");
	        while($dA = mysql_fetch_array($qA))
	        	{
	    		mysql_query("INSERT INTO x23_stokpart (
	    										nonota,
	    										idgudang,
	    										hargabelibersih,
	    										hargajual,
	    										hargajual2,
	    										rak,
	    										idbarang,
	    										stok,
	    										status,
	    										inputx,
	    										updatex)
	    									VALUES (
	    										'$dA[nonota]',
	    										'$dA[idgudang2]',
	    										'$dA[hargabelibersih]',
	    										'$dA[hargajual]',
	    										'$dA[hargajual2]',
	    										'$dA[rak2]',
	    										'$dA[idbarang]',
	    										'$dA[qty]',
	    										'1',
	    										NOW(),
	    										'$updatex')
	    					");
							
				mysql_query("UPDATE x23_stokpart SET stok=stok-$dA[qty], updatex='$updatex' WHERE idgudang='$dA[idgudang1]' AND rak='$dA[rak1]' AND idbarang='$dA[idbarang]' AND nonota='$dA[nonota]' LIMIT 1");
        		}
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PEMINDAHAN STOK ID $dX[idpindah]')
								");
			$note = "2";
			}
			
		if(!empty($dX[idopname]))
			{
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_opname SET status='1' WHERE id='$dX[idopname]'");
			
			$qA = mysql_query("SELECT * FROM x23_opname_det WHERE idopname='$dX[idopname]' AND opname!=''");
	        while($dA = mysql_fetch_array($qA))
	        	{
				mysql_query("UPDATE x23_stokpart SET stok='$dA[opname]' WHERE id='$dA[idstok]'");
				}
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI STOCK OPNAME ID $dX[idopname]')
								");
			$note = "4";
			}
			
		if(!empty($dX[idtutupservis]))
			{
			$p_tahun = date("Y");
			$p_bulan = date("m");
			$nginap   = preg_replace( "/[^0-9]/", "",$_REQUEST['nginap']);
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_tutupservis SET status='1',nginap='$nginap' WHERE id='$dX[idtutupservis]'");
			
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_tutupservis WHERE id='$dX[idtutupservis]'"));
			
			//echo "<script>alert ('$dA[asnginap].$dA[asmulaiservis].$dA[asmasukbengkel].$dA[nginap]')</script>";
			//exit();
			
			if($dA[asnginap] < 0)
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis1, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$dX[idtutupservis]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : JUMLAH SCAN KELUAR LEBIH BANYAK DARI JUMLAH SCAN MASUK', 
												'x23_tutupservis', 
												NOW())
							");
				}
			if($dA[asmulaiservis] != $dA[asmasukbengkel])
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis2, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$dX[idtutupservis]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH MULAI SERVIS DENGAN JUMLAH SCAN MASUK', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			if($dA[asselesaiservis] != $dA[askeluarbengkel])
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis3, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$dX[idtutupservis]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH SELESAI SERVIS DENGAN JUMLAH SCAN KELUAR', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			if($dA[asselesaiservis] != $dA[askwitansiservis])
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis4, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$dX[idtutupservis]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : TERDAPAT SELISIH ANTARA JUMLAH KWITANSI SERVIS DENGAN JUMLAH SELESAI SERVIS', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			if($dA[nginap] > $dA[asmasukbengkel])
				{
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idtutupservis5, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$dX[idtutupservis]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : JUMLAH MOTOR MENGINAP LEBIH BANYAK DARI JUMLAH SCAN MASUK', 
												'x23_tutupservis', 
												NOW())
							");
				}
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI TUTUP SERVIS ID $dX[idtutupservis]')
								");
			}
	
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=$note'/>";
		exit();
		}
		
	else if($submenu == 'tolak')
		{    
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM x23_abis_dkonfirmasi WHERE id='$_REQUEST[id]'"));
			  
		if(!empty($dX[idkaskecil]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_kaskecil SET status='2' WHERE id='$dX[idkaskecil]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI KASKECIL ID $dX[idkaskecil]')
								");
			}
			
		if(!empty($dX[idreturbeli]))
			{                       	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_returbeli SET status='3',updatex='$updatex' WHERE id='$dX[idreturbeli]'");
							 			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI RETUR BELI ID $dX[idreturbeli]')
								");
			}
			
		if(!empty($dX[idpiutang]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_piutang SET status='2',updatex='$updatex' WHERE id='$dX[idpiutang]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PIUTANG KARYAWAN ID $dX[idpiutang]')
								");
			}
			
		if(!empty($dX[idbyrpiutang]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_piutang SET status='2',updatex='$updatex' WHERE id='$dX[idbyrpiutang]'");
			$q3 = mysql_query("UPDATE x23_kwitansi SET status='2',cetak='1' WHERE nomor='$dX[idbyrpiutang]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID $dX[idbyrpiutang]')
								");
			}
			
		if(!empty($dX[idpotkompensasi]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_potkompensasi SET status='2',updatex='$updatex' WHERE id='$dX[idpotkompensasi]'");
			$q3 = mysql_query("UPDATE x23_kwitansi SET status='2' WHERE idpotkom='$dX[idpotkompensasi]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID $dX[idpotkompensasi]')
								");
			}
			
		if(!empty($dX[idpindah]))
			{                       	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_pindah SET status='2' WHERE id='$dX[idpindah]'");
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PEMINDAHAN STOK ID $dX[idpindah]')
								");
			}
			
		if(!empty($dX[idopname]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_opname SET status='2' WHERE id='$dX[idopname]'");
							
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI STOCK OPNAME ID $dX[idopname]')
								");
			}
			
		if(!empty($dX[idtutupservis]))
			{              	
			$q1 = mysql_query("UPDATE x23_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE x23_tutupservis SET status='2' WHERE id='$dX[idtutupservis]'");
							
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI TUTUP SERVIS ID $dX[idtutupservis]')
								");
			}
	
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
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
        
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>
        <script>
        //SELECT2
			$(function(){
			           
			  /* dropdown and filter select */
			  var select = $('#select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
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