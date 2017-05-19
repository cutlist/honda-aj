<?
	if($submenu == 'A')
		{
		unset($_SESSION[grup]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> SERVIS</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA PELANGGAN / NO. ANTRIAN / NO. POLISI ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<button type="button"  onclick="window.open('printaj/h2/kwitansiservis.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
	                           		
									<table id="example3" class="table table-striped table-hover" style="width:130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="10%">NO. KWITANSI</th>
			                                    <th style="padding:7px" width="10%">JENIS SERVIS</th>
			                                    <th style="padding:7px" width="10%">NO. NOTA SERVIS</th>
			                                    <th style="padding:7px" width="10%">TGL NOTA SERVIS</th>
			                                    <th style="padding:7px" width="1%">WAKTU</br>SELESAI</th>
			                                    <th style="padding:7px" width="12%">NO.</br>ANTRIAN</th>
			                                    <th style="padding:7px" width="10%">NO. POLISI</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px" width="10%">JUMLAH (RP)</th>
			                                    <th style="padding:7px" width="10%">JUMLAH (PEMBULATAN) (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND  jnskwitansi='servis' AND (nama LIKE '%$_REQUEST[cari]%' OR nopol LIKE '%$_REQUEST[cari]%' OR noantrian LIKE '%$_REQUEST[cari]%') ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND  jnskwitansi='servis' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice WHERE nonota='$d1[nomor]'"));
											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo $d2[jns]?></td>
			                                    <td><?echo $d1[nomor]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="center"><?echo $d1[waktuselesai]?></td>
			                                    <td align="center"><?echo $d1[noantrian]?></td>
			                                    <td><?echo $d1[nopol]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[pembulatan],"0","",".")?></span></td>
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
			                        		<td>Belum Dicetak</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Sudah Dicetak</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					if($mod=='detail')
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE nonota='$d1[nomor]'"));
						$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/kwitansi_h23svc.php?nokwitansi=<?echo $d1[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> SERVIS</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveA"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="35%">NOMOR NOTA SERVIS</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d2[nonota]?>" style="width:35%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:35%" readonly/></td>
					                    		</tr>
												<?
							                    if($d2[jns]=='SERVIS JR'){
												?>
					                    		<tr>
					                    			<td>NOMOR NOTA SERVIS JR</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="noclaim" class="form-control" value="<?echo $d2[noclaim]?>" style="width:35%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR NOTA SERVIS SEBELUMNYA</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="noservis" class="form-control" value="<?echo $d2[noservis]?>" style="width:35%" readonly/></td>
					                    		</tr>
							                    <?
													}
													
							                    if($d1[status]=='0'){
							                    ?>
						                    		<tr>
						                    			<td>TANGGAL KWITANSI</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
													</tr>
							                    <?
													}
													
												else{
												?>
													<tr>
						                    			<td>TANGGAL KWITANSI</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
													</tr>
												<?
													}
							                    ?>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d3[nama]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UANG SEJUMLAH</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEMBULATAN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="pembulatan" id="uang2" class="form-control" value="<?echo number_format($d1[pembulatan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" <?if($d1[status]=='0'){?>required<?}else{?>readonly<?}?>>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[jns]?>" class="form-control" style="width:50%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" <?if($d1[status]=='1'){?>value="<?echo $d1[keterangan]?>" readonly=""<?}?> maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
			                            	
					                        <table id="example2" class="table table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">KODE BARANG/KODE JASA</th>
					                                    <th style="padding:7px">NAMA BARANG/ NAMA JASA</th>
					                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
					                                    <th width="1%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
					                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
					                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelisp FROM x23_notajual_det_vw WHERE nonota='$d1[nomor]'"));
												$dC = mysql_fetch_array(mysql_query("SELECT *,COUNT(tarif) AS tqty, SUM(tarif) AS ttotal, SUM(tarifasli) AS tottarifasli, SUM(diskon) AS totdiskon FROM x23_notaservice_det WHERE nonota='$d1[nomor]'"));
												$ppnjasa = round($dC[ttotal] * 0.1 , 0);
				                            	$ttotal = $dB[ttotal]+$dC[ttotal]+$ppnjasa;
												
					                            $dA1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nomor]'"));
												$qA  = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo $dA[kodebarang]?></td>
					                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
					                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
					                                    <td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
					                                    <td align="right"><span style="margin-right:1%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
					                                </tr>
					                                
					                            <?
					                            	}
					                            if(!empty($dA1[nonota]))
					                            	{
					                            ?>
					                            	<tr>
					                            		<th colspan="6"><div style="border-bottom:1px #aaa dashed;margin: 3px 0 3px"></div></th>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2"></th>
					                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>TOTAL BARANG</b></span></td>
					                            		<td colspan="" align="right"><span style="margin-right:1%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
					                            	</tr>
					                            <?
					                            	}
					                            	
					                            $dA2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nomor]'"));
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dA[kodepaket]?></td>
						                                    <td><?echo "$dB[nama]"?></br>
						                                    <?
															$qB2 = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE kode='$dA[kodepaket]'");
								                            while($dB2 = mysql_fetch_array($qB2))
								                            	{
																echo "- $dB2[namajasa]</br>";
																}
						                                    ?>
						                                    	
						                                    </td>
						                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
					                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
						                                    <td align="right"><span style="margin-right:5%">-</span></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
						                                </tr>
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dB[kodejasa]?></td>
						                                    <td><?echo $dB[namajasa]?></td>
						                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
					                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
						                                    <td align="right"><span style="margin-right:5%">-</span></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
						                                </tr>
					                            <?	
														}
					                            	}
					                            
					                            $dA2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d2[noservis]' AND nonota!=''"));
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d2[noservis]' AND nonota!=''");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dA[kodepaket]?></td>
						                                    <td><?echo "$dB[nama]"?></br>
						                                    <?
															$qB2 = mysql_query("SELECT * FROM x23_kelompokjasa_det_vw WHERE kode='$dA[kodepaket]'");
								                            while($dB2 = mysql_fetch_array($qB2))
								                            	{
																echo "- $dB2[namajasa]</br>";
																}
						                                    ?>
						                                    	
						                                    </td>
						                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
					                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
						                                    <td align="right"><span style="margin-right:5%">-</span></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
						                                </tr>
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                <tr style="cursor:pointer">
						                                    <td><?echo $dB[kodejasa]?></td>
						                                    <td><?echo $dB[namajasa]?></td>
						                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
					                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
						                                    <td align="right"><span style="margin-right:5%">-</span></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
						                                </tr>
					                            <?	
														}
					                            	}
					                            	
					                            //echo "$dA2[nonota].13212312313";
					                            if(!empty($dA2[nonota]))
					                            	{
					                            ?>
					                            	<tr>
					                            		<th colspan="6"><div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div></th>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2"></th>
					                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>TOTAL JUMLAH JASA</b></span></td>
					                            		<td colspan="" align="right"></td>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dC[ttotal]);?></b></span></td>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2"></th>
					                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>PPN 10%</b></span></td>
					                            		<td colspan="" align="right"></td>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ppnjasa)?></b></span></td>
					                            		<th colspan="3"></th>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2"></th>
					                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>TOTAL JUMLAH JASA + PPN 10%</b></span></td>
					                            		<td colspan="" align="right"></td>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dC[ttotal]+$ppnjasa)?></b></span></td>
					                            		<th colspan="3"></th>
					                            	</tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                            <tfoot>
					                            	<tr>
					                            		<th colspan="6"><div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div></th>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2"></th>
					                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
					                            		<td colspan="" align="right"></td>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($ttotal)?></b></span></td>
					                            	</tr>
					                            </tfoot>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
					                    <input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
					                    <?
					                    if($d1[status]=='0')
					                    	{
					                    ?>
			                            <button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
										<?
											}
										else
											{
										?>
											<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
										<?
											}
					                    ?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
				                	</form>
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

	else if($submenu == 'saveA')
		{
        $tanggal    = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	    = substr($tanggal,5,2);
        $tahun	    = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
		$pembulatan = preg_replace( "/[^0-9]/", "",$_REQUEST['pembulatan']);
		$jumlah = preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
			
        /*
		$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_REQUEST[nonota]'");
        while($dA = mysql_fetch_array($qA))
        	{
			mysql_query("UPDATE x23_stokpart SET stok=stok-$dA[qty] WHERE idgudang='$dA[idgudang]' AND rak='$dA[rak]' AND nonota='$dA[notabeli]' AND idbarang='$dA[idbarang]'");
			}
        */
			
        if($pembulatan < $jumlah)
			{
			echo "<script>alert ('Mohon Ulangi, Karena Pembulatan Lebih Kecil Dari Jumlah Pembayaran!')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=detail&id=$_REQUEST[id]'/>";
			exit();
			}
			
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&mod=detail&id=$_REQUEST[id]'/>";
			exit();
			}
			
			  mysql_query("UPDATE x23_notaservice SET status='2' WHERE nonota='$_REQUEST[nonota]'");
		$q1 = mysql_query("UPDATE x23_kwitansi SET
										status='1',
										tanggal='$tanggal',
										tahun='$tahun',
										bulan='$bulan',
										pembulatan='$pembulatan',
										keterangan='$keterangan'
									WHERE id='$_REQUEST[id]'
							");
	
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi_h23svc.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			

		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	else if($submenu == 'B')
		{
		unset($_SESSION[grup]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> PENJUALAN BARANG</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA PELANGGAN / NO. KWITANSI / NO. NOTA JUAL ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<button type="button"  onclick="window.open('printaj/h2/kwitansipenjualan.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
									<table id="example3" class="table table-striped table-hover" style="width:110%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="15%">NO. KWITANSI</th>
			                                    <th style="padding:7px" width="15%">NO. NOTA JUAL</th>
			                                    <th style="padding:7px" width="10%">TGL NOTA JUAL</th>
			                                    <th style="padding:7px" width="35%">NAMA PELANGGAN</th>
			                                    <th style="padding:7px" width="12%">TOTAL QTY JUAL</th>
			                                    <th style="padding:7px" width="18%">JUMLAH (RP)</th>
			                                    <th style="padding:7px" width="18%">JUMLAH (RP) (PEMBULATAN)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND  jnskwitansi='penjualan' AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%' OR nomor LIKE '%$_REQUEST[cari]%') ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND  jnskwitansi='penjualan' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d3 = mysql_fetch_array(mysql_query("SELECT totalqty FROM x23_notajual WHERE nonota='$d1[nomor]'"));

											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											if($d1[jumlah]<0){
												$pembulatan = -1*$d1[pembulatan];
												}
											else{
												$pembulatan = $d1[pembulatan];
												}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo $d1[nomor]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo number_format($d3[totalqty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($pembulatan,"0","",".")?></span></td>
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
			                        		<td>Belum Dicetak</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Sudah Dicetak</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					if($mod=='detail')
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE nonota='$d1[nomor]'"));
						$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
						
						$qAx = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nomor]'");
                        while($dAx = mysql_fetch_array($qAx))
                        	{
			                if($d1[status]=='0'){
                            	$dCsx = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE nonota='$dAx[notabeli]' AND idgudang='$dAx[idgudang]' AND idbarang='$dAx[idbarang]' AND rak='$dAx[rak]'"));
                            	if($dCsx[stok]<$dAx[qty]){
									$x = "1";
									}
								}
							}
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/kwitansi_h23sp.php?nokwitansi=<?echo $d1[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> PENJUALAN SPARE PART</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA JUAL</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d2[nonota]?>" style="width:35%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:35%" readonly/></td>
					                    		</tr>
							                    <?
							                    if($d1[status]=='0')
							                    	{
							                    ?>
						                    		<tr>
						                    			<td>TANGGAL NOTA JUAL</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
													</tr>
							                    <?
													}
												else
													{
												?>
													<tr>
						                    			<td>TANGGAL NOTA JUAL</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
													</tr>
												<?
													}
							                    ?>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
												<?
												if($d1[jumlah] < '0')
													{
													$cekjml = '0';
												?>
						                    		<tr>
						                    			<td><b>DIKEMBALIKAN KE</b></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA PELANGGAN</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d3[nama]?>" class="form-control" style="width:70%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>UANG SEJUMLAH</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format(($d1[jumlah]*(-1)),"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    </div>
						                                </td>
						                    		</tr>
						                    		<tr>
						                    			<td>PEMBULATAN</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="pembulatan" id="uang2" class="form-control" value="<?echo number_format($d1[pembulatan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" <?if($d1[status]=='0'){?>required<?}else{?>readonly<?}?>>
						                                    </div>
						                                </td>
						                    		</tr>
					                            <?
				                            		}
				                            	else
				                            		{
													$cekjml = '1';
					                            ?>
						                    		<tr>
						                    			<td><b>TERIMA DARI</b></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA PELANGGAN</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d3[nama]?>" class="form-control" style="width:70%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>UANG SEJUMLAH</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    </div>
						                                </td>
						                    		</tr>
						                    		<tr>
						                    			<td>PEMBULATAN</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <?if($x!='1'){?>
						                                        	<input type="text" name="pembulatan" id="uang2" class="form-control" value="<?echo number_format($d1[pembulatan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" <?if($d1[status]=='0'){?>required<?}else{?>readonly<?}?>>
						                                    	<?}if(($x=='1')){?>
																	<input type="text" name="pembulatan" id="uang2" class="form-control" value="<?echo number_format($d1[pembulatan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    	<?}?>
						                                    </div>
						                                </td>
						                    		</tr>
					                            <?
					                            	}
					                            ?>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="PENJUALAN SPARE PART" class="form-control" style="width:50%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td>
			                                        <?if($x!='1'){?>
			                                        	<input type="text" name="keterangan" <?if($d1[status]=='1'){?>value="<?echo $d1[keterangan]?>" readonly=""<?}?> maxlength="50" class="form-control" style="width:70%" >
			                                    	<?}if(($x=='1')){?>
														<input type="text" name="keterangan"  readonly="" maxlength="50" class="form-control" style="width:70%" >
			                                    	<?}?>
					                    			</td>
					                    		</tr>
													<input type="hidden" name='cekjml' value="<?echo $cekjml?>">
			                            	</table>
			                            	
			                            	<div style="overflow-x:auto;overflow-y:auto;">
						                        <table id="example2" class="table table-striped table-hover" style="width:120%">
						                            <thead style="color:#666;font-size:13px">
						                                <tr>
						                                    <th style="padding:7px">KODE BARANG</th>
						                                    <th style="padding:7px">NAMA BARANG</th>
						                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
						                                    <th width="7%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
										                    <?
										                    if($d1[status]=='0'){
										                    ?>
						                                    	<th width="7%" style="padding:7px"><center>STOK TERKINI</center></th>
						                                    <?}?>
						                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
						                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
						                                    <th width="" style="padding:7px">GUDANG</th>
						                                    <th width="" style="padding:7px">RAK</th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            <?
													$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal FROM x23_notajual_det_vw WHERE nonota='$d1[nomor]'"));
													$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nomor]'");
						                            while($dA = mysql_fetch_array($qA))
						                            	{
										                if($d1[status]=='0'){
							                            	$dCs = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE nonota='$dA[notabeli]' AND idgudang='$dA[idgudang]' AND idbarang='$dA[idbarang]' AND rak='$dA[rak]'"));
							                            	if($dCs[stok]<$dA[qty]){
																$red = "color:#ff0227";
																}
															else{$red="";}
															}
														?>
						                                <tr style="cursor:pointer;<?echo $red?>">
						                                    <td><?echo $dA[kodebarang]?></td>
						                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
						                                    <?
						                           			if($d1[grup]=="0"){
															?>
							                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
															<?
																}
						                           			else{
															?>
							                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajualbersih]+$dA[diskon],"0","",".")?></span></td>
															<?
																}
						                           			?>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
						                                    
											                    <?
											                    if($d1[status]=='0'){
											                    ?>
							                                   	 	<td align="right"><span style="margin-right:20%"><?echo number_format($dCs[stok],"0","",".")?> PCS</span></td>
							                                   	<?}?>
							                                   	
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
						                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
						                                    <td><?echo $dA[gudang]?></td>
						                                    <td><?echo $dA[rak]?></td>
						                                </tr>
						                                
						                            <?
						                            	}
						                            ?>
						                            </tbody>
						                            <tfoot>
						                            	<tr>
						                            		<th colspan="2"></th>
										                    <?
										                    if($d1[status]=='0'){
										                    ?>
						                            			<td colspan="3" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
						                            		<?}else{?>
						                            			<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
															<?}?>
						                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
						                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
						                            		<th colspan="3"></th>
						                            	</tr>
						                            <?
						                            if(!empty($d1[noindent]))
						                            	{		
						                            	$dZ = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS jumlah FROM x23_kwitansi WHERE jnskwitansi='indent' AND nomor='$d1[noindent]'"));
														$grandtotal = $dB[ttotal]-$dZ[jumlah];
						                            ?>
						                            	<tr>
						                            		<th colspan="2"></th>
						                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>JUMLAH UANG MUKA</b></span></td>
						                            		<td colspan="" align="right"></td>
						                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dZ[jumlah])?></b></span></td>
						                            		<th colspan="3"></th>
						                            	</tr>
													<?
														if($grandtotal < '0')
															{
													?>
							                            	<tr style="color:red">
							                            		<th colspan="2"></th>
							                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>KELEBIHAN BAYAR</b></span></td>
							                            		<td colspan="" align="right"></td>
							                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($grandtotal*(-1))?></b></span></td>
							                            		<th colspan="3"></th>
							                            	</tr>
							                            	<tr style="color:red">
							                            		<th colspan="2"></th>
							                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>KEMBALI</b></span></td>
							                            		<td colspan="" align="right"></td>
							                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($grandtotal*(-1))?></b></span></td>
							                            		<th colspan="3"></th>
							                            	</tr>
						                            <?
						                            		}
						                            	else
						                            		{
						                            ?>
							                            	<tr>
							                            		<th colspan="2"></th>
							                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>KEKURANGAN BAYAR</b></span></td>
							                            		<td colspan="" align="right"></td>
							                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($grandtotal)?></b></span></td>
							                            		<th colspan="3"></th>
							                            	</tr>
						                            <?
						                            		}
						                            	}
						                            ?>
						                            </tfoot>
						                        </table>
					                        </div>
			                        
					                        <table width="100%">
					                        	<tr>
					                        		<td colspan="3"><b>Keterangan</b></td>
					                        	</tr>
					                        	<tr>
					                        		<td style="color:#ff0227">Merah</td>
					                        		<td width="15px" align="center">:</td>
					                        		<td>Qty Stok Terkini Tidak Mencukupi</td>
					                        	</tr>
					                        	<tr>
					                        		<td>Hitam</td>
					                        		<td align="center">:</td>
					                        		<td>Qty Stok Terkini Mencukupi</td>
					                        	</tr>
					                        	<?if($x=='1'){?>
					                        	<tr>
					                        		<td colspan="3">
					                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
					                                        <i class="fa fa-warning"></i>
					                                        <b>Catatan!</b>
					                                        <p>Untuk Mengubah Nota Jual Silahkan Ke Menu Riwayat - No. Nota Jual Pada Bagian Penjualan.</p>
					                                    </div>
					                        		</td>
					                        	</tr>
					                        	<?}?>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
					                    <input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
					                    <input type="hidden" name="noindent" value="<?echo $d1[noindent]?>">
					                    <?
					                    if($d1[status]=='0'){
			                                if($x!='1'){
					                    ?>
			                           			<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
										<?
												}
											}
										else{
										?>
											<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
										<?
											}
					                    ?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
				                	</form>
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

	else if($submenu == 'saveB')
		{
        $tanggal    = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	    = substr($tanggal,5,2);
        $tahun	    = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
		$pembulatan = preg_replace( "/[^0-9]/", "",$_REQUEST['pembulatan']);
		$jumlah = preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
        
		$dcek = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual WHERE nonota='$_REQUEST[nonota]'"));
		if(empty($_REQUEST[noindent])){
			if($_REQUEST[cekjml]=='1')
				{
				if($jumlah != $dcek[grandtotal])
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=detail&id=$_REQUEST[id]'/>";
					exit();
					}
		        if($pembulatan < $jumlah)
					{
					echo "<script>alert ('Mohon Ulangi, Karena Pembulatan Lebih Kecil Dari Jumlah Pembayaran!')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=detail&id=$_REQUEST[id]'/>";
					exit();
					}
				}
			if($_REQUEST[cekjml]=='0'){
				if(($jumlah*(-1)) != $dcek[grandtotal])
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=detail&id=$_REQUEST[id]'/>";
					exit();
					}
				}
			}
		
			
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod=detail&id=$_REQUEST[id]'/>";
			exit();
			}
        
		$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$_REQUEST[nonota]'");
        while($dA = mysql_fetch_array($qA))
        	{
			mysql_query("UPDATE x23_stokpart SET stok=stok-$dA[qty] WHERE idgudang='$dA[idgudang]' AND rak='$dA[rak]' AND 
																		  nonota='$dA[notabeli]' AND idbarang='$dA[idbarang]'");
			}
			
			  mysql_query("UPDATE x23_notajual SET status='1' WHERE nonota='$_REQUEST[nonota]'");
		$q1 = mysql_query("UPDATE x23_kwitansi SET
										status='1',
										tanggal='$tanggal',
										tahun='$tahun',
										bulan='$bulan',
										pembulatan='$pembulatan',
										keterangan='$keterangan'
									WHERE id='$_REQUEST[id]'
							");
	
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi_h23sp.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			

		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
			exit();
			}
		}
		
	else if($submenu == 'penjualan1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Uang Muka</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=penjualan2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA JUAL</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nonota" style="width:30%" /></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		unset($_SESSION[grup]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> INDENT</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Indent Dilanjutkan Ke Menu Indent Pada Bagian Penjualan Untuk Mengubah Detail Indent.</p>";
											}
				
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
	                                        <?echo $ket2?>
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
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA PELANGGAN / NO. NOTA INDENT / NO. KWITANSI ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<button type="button"  onclick="window.open('printaj/h2/kwitansiindent.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
									<table id="example3" class="table table-striped table-hover" style="width:110%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="15%">NO. KWITANSI</th>
			                                    <th style="padding:7px" width="15%">NO. NOTA INDENT</th>
			                                    <th style="padding:7px" width="10%">TGL NOTA INDENT</th>
			                                    <th style="padding:7px" width="35%">NAMA PELANGGAN</th>
			                                    <th style="padding:7px" width="12%">TOTAL QTY INDENT</th>
			                                    <th style="padding:7px" width="18%">JUMLAH UANG MUKA INDENT (RP)</th>
			                                    <th style="padding:7px" width="18%">JUMLAH HO (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND  jnskwitansi='indent' AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%' OR nomor LIKE '%$_REQUEST[cari]%') ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id%2=0 AND  jnskwitansi='indent' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent WHERE noindent='$d1[nomor]'"));

											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											if(!empty($d3[notajual]))
												{
												$d4 = mysql_fetch_array(mysql_query("SELECT status FROM x23_kwitansi WHERE jnskwitansi='penjualan' AND nomor='$d3[notajual]'"));
												if($d4[status]=="1")
													{
			                            ?>
				                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
				                                    <td><?echo $d1[nokwitansi]?></td>
				                                    <td><?echo $d1[nomor]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
				                                    <td><?echo $d1[nama]?></td>
				                                    <td align="right"><span style="padding-right:10%"><?echo number_format($d3[totalqty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlahho],"0","",".")?></span></td>
				                                </tr>
			                            <?
													}
												}
											else
												{
			                            ?>
				                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
				                                    <td><?echo $d1[nokwitansi]?></td>
				                                    <td><?echo $d1[nomor]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
				                                    <td><?echo $d1[nama]?></td>
				                                    <td align="right"><span style="padding-right:10%"><?echo number_format($d3[totalqty],"0","",".")?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlahho],"0","",".")?></span></td>
				                                </tr>
			                            <?
												}
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
			                        		<td>Belum Dicetak</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Sudah Dicetak</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					if($mod=='detail')
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent_vw WHERE noindent='$d1[nomor]'"));
						$d3 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/kwitansi_h23ind.php?nokwitansi=<?echo $d1[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> INDENT</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveC"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA INDENT</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="noindent" class="form-control" value="<?echo $d2[noindent]?>" style="width:35%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:35%" readonly/></td>
					                    		</tr>
							                    <?
							                    if($d1[status]=='0')
							                    	{
							                    ?>
						                    		<tr>
						                    			<td>TANGGAL NOTA INDENT</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
													</tr>
							                    <?
													}
												else
													{
												?>
													<tr>
						                    			<td>TANGGAL NOTA INDENT</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
													</tr>
												<?
													}
							                    ?>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d3[nama]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
							                    <?
							                    if($d1[status]=='0')
							                    	{
							                    	if($d1[tambahdp]=="0")
							                    		{
												?>
							                    		<tr>
							                    			<td>UANG MUKA SEJUMLAH</td>
							                    			<td>:</td>
							                    			<td><div class="input-group">
							                                        <span class="input-group-addon">RP.</span>
							                                        <input type="text" name="jumlah" class="form-control uang" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
							                                    </div>
							                                </td>
							                    		</tr>
							                    		<tr>
							                    			<td>BIAYA HO</td>
							                    			<td>:</td>
							                    			<td><div class="input-group">
							                                        <span class="input-group-addon">RP.</span>
							                                        <input type="text" name="jumlahho" class="form-control uang" value="" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
							                                    </div>
							                                </td>
							                    		</tr>
												<?
														}
							                    	if($d1[tambahdp]=="1")
							                    		{
												?>
							                    		<tr>
							                    			<td>TAMBAH UANG MUKA SEJUMLAH</td>
							                    			<td>:</td>
							                    			<td><div class="input-group">
							                                        <span class="input-group-addon">RP.</span>
							                                        <input type="text" name="jumlah" class="form-control uang" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
							                                    </div>
							                                </td>
							                    		</tr>
												<?
														}
													}
												else
													{
												?>
						                    		<tr>
						                    			<td>UANG SEJUMLAH</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="jumlah" class="form-control uang" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
						                                    </div>
						                                </td>
						                    		</tr>
												<?
							                    	if($d1[tambahdp]=="0")
							                    		{
												?>
							                    		<tr>
							                    			<td>BIAYA HO</td>
							                    			<td>:</td>
							                    			<td><div class="input-group">
							                                        <span class="input-group-addon">RP.</span>
							                                        <input type="text" name="jumlahho" class="form-control uang" value="<?echo number_format($d1[jumlahho],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
							                                    </div>
							                                </td>
							                    		</tr>
												<?
														}
													}
							                    ?>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="INDENT SPARE PART" class="form-control" style="width:50%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" <?if($d1[status]=='1'){?>value="<?echo $d1[keterangan]?>" readonly=""<?}?> maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
			                            	
					                        <table id="example2" class="table table-striped table-hover">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">KODE BARANG</th>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th width="15%" style="padding:7px"><center>QTY INDENT</center></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM x23_indent_det_vw WHERE noindent='$d1[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE idbarang IN ($dA[idbarang]) GROUP BY idbarang"));
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo $dA[kodebarang]?></td>
					                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
					                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
					                                </tr>
					                                
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                            <tfoot>
					                            	<tr>
					                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
					                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[totalqty])?> PCS</b></span></td>
					                            	</tr>
					                            </tfoot>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
					                    <input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
					                    <?
					                    if($d1[status]=='0')
					                    	{
					                    ?>
			                            <button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
										<?
											}
										else
											{
										?>
											<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
										<?
											}
					                    ?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
				                	</form>
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

	else if($submenu == 'saveC')
		{
        $tanggal    = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	    = substr($tanggal,5,2);
        $tahun	    = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
		$jumlahho 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlahho']);
		
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE nokwitansi='$_REQUEST[nomor]'"));
		
		if($d1[idpotkom]=="0"){
			$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$d1[nomor]'"));
			$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='piutang' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
			$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='pembayaran' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
			
			$totpiutang    = $dPiu[total];
			$totpembayaran = $dPby[total];
			$sisapiutang   = $dPiu[total]-$dPby[total];
			
			if($sisapiutang < $d1[jumlah]){
				echo "<script>alert ('Proses Gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
				exit();
				}
			}
		
        if($jumlah=='0')
			{
			echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Tidak Boleh 0 (Nol).')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=detail&id=$_REQUEST[id]'/>";
			exit();
			}
        
        
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&mod=detail&id=$_REQUEST[id]'/>";
			exit();
			}
			
			  mysql_query("UPDATE x23_notajual SET status='1' WHERE nonota='$_REQUEST[nonota]'");
		$q1 = mysql_query("UPDATE x23_kwitansi SET
										status='1',
										tanggal='$tanggal',
										tahun='$tahun',
										bulan='$bulan',
										keterangan='$keterangan',
										jumlah='$jumlah',
										jumlahho='$jumlahho'
									WHERE id='$_REQUEST[id]'
							");
	
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi_h23ind.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			

		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C&note=1'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
			exit();
			}
		}
		
	else if($submenu == 'D')
		{
		unset($_SESSION[grup]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> PEMBAYARAN PIUTANG TUNAI & POTONGAN KOMPENSASI TUNAI</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA KARYAWAN / NO. KWITANSI ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<button type="button"  onclick="window.open('printaj/h2/kwitansitunai.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
									<table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="17%">NO. KWITANSI</th>
			                                    <th style="padding:7px" width="12%">TANGGAL KWITANSI</th>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px" width="17%">JUMLAH (RP)</th>
			                                    <th style="padding:7px" width="17%">STATUS CETAK KWITANSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_tunai_vw WHERE id%2=0 AND  jnskwitansi IN ('tunai') AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%') AND status!='2' ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_tunai_vw WHERE id%2=0 AND  jnskwitansi IN ('tunai') AND status!='2' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_potkompensasi WHERE id='$d1[idpotkom]'"));
											if($d1[cetak]=="0"){
												$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
												}
											if($d1[cetak]=="1"){
												$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
												}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="center"><?echo $status2?></td>
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
			                        		<td>Belum Dikonfirmasi Pihak Manajemen</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Sudah Dikonfirmasi Pihak Manajemen</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					if($mod=='detail')
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d1[idpelanggan]'"));
						
				    	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
				    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
				    	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/kwitansi_tnx23.php?nokwitansi=<?echo $d1[nokwitansi]?>&status=1','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> PEMBAYARAN PIUTANG TUNAI & POTONGAN KOMPENSASI TUNAI</small></h4>
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR KWITANSI</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:35%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td>STATUS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $status?></td>
												</tr>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA KARYAWAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[nama]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[noktp]?>" class="form-control" style="width:40%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UANG SEJUMLAH</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
													<?
													if($d1[idpotkom]=="0"){
													?>
					                    				<td><input type="text" value="PEMBAYARAN PIUTANG TUNAI" class="form-control" style="width:100%" readonly></td>
													<?
														}
													if($d1[idpotkom]!="0"){
													?>
					                    				<td><input type="text" value="POTONGAN KOMPENSASI TUNAI" class="form-control" style="width:100%" readonly></td>
													<?
														}
													?>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d1[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    				<input type="hidden" name="nomor" value="<?echo $_REQUEST[nomor]?>">
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                        <?
			                        if($d1[status]=='1'){
										if($d1[idpotkom]=="0"){
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$d1[nomor]'"));
											$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='piutang' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
											$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM x23_piutang WHERE jenis='pembayaran' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
											
											$totpiutang    = $dPiu[total];
											$totpembayaran = $dPby[total];
											$sisapiutang   = $dPiu[total]-$dPby[total];
											
											if($d1[cetak]=="0"){
											if($sisapiutang < $d1[jumlah]){
									?>
			                                    <div class="alert alert-danger" style="margin-top:0px;margin-bottom:10px;text-align: left">
			                                        <i class="fa fa-warning"></i>
			                                        <p>Sisa Piutang Lebih Kecil Dari Jumlah Pembayaran Piutang Tunai.</p>
			                                        <p>Mohon Konfirmasi Kepada Pihak Manajemen Untuk Menghapus Riwayat Pembayaran Piutang Pada Menu Piutang.</p>
			                                    </div>
									<?
												}}
												
											if($d1[cetak]=="0"){
												if($sisapiutang >= $d1[jumlah]){
									?>
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=D"?>"><button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
				                        			</a>
									<?
													}
												}
											else{
									?>
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=D"?>"><button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
				                        			</a>
									<?
												}
											}
										}
									?>
										<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
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
		
	else if($submenu == 'E')
		{
		unset($_SESSION[grup]);
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
?>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> PIUTANG KARYAWAN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NAMA KARYAWAN / NO. KWITANSI ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<button type="button"  onclick="window.open('printaj/h2/kwitansipiutang.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
									<table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="17%">NO. KWITANSI</th>
			                                    <th style="padding:7px" width="15%">TGL KWITANSI</th>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px" width="17%">JUMLAH (RP)</th>
			                                    <th style="padding:7px" width="17%">STATUS CETAK KWITANSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_piutang_vw WHERE id%2=0 AND  jnskwitansi IN ('piutang') AND (nama LIKE '%$_REQUEST[cari]%' OR nokwitansi LIKE '%$_REQUEST[cari]%') AND status!='2' ORDER BY id DESC");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_kwitansi_piutang_vw WHERE id%2=0 AND  jnskwitansi IN ('piutang') AND status!='2' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$d1[nomor]'"));
											
											if($d1[status]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											
											$dCek1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$d1[nomor]'"));
											if($dCek1[status]=="0"){
												$status2 = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>BELUM CETAK</span>";
												}
											if($dCek1[status]=="1"){
												$status2 = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>SUDAH CETAK</span>";
												}
											
											if($d1[jnskwitansi]=="tunai"){
												$jns = "PEMBAYARAN PIUTANG TUNAI DAN POTONGAN KOMPENSASI TUNAI";
												}
											if($d1[jnskwitansi]=="piutang"){
												$jns = "PIUTANG";
												}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=detail&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nokwitansi]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
			                                    <td align="center"><?echo $status2?></td>
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
			                        		<td>Belum Dikonfirmasi Pihak Manajemen</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Sudah Dikonfirmasi Pihak Manajemen</td>
			                        	</tr>
			                        </table>
			                    </div>
			                </div>
			            </div>
<?
						}
						
					if($mod=='detail')
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE id='$_REQUEST[id]'"));
						$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d1[idpelanggan]'"));
						
				    	if($d1[status]=="0"){
								$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_piutang WHERE id='$d1[nomor]'"));
								if($dA[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";
									}
								else{$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
							}
				    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
				    	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
?>
						<script type="text/javascript">
							var s5_taf_parent = window.location;
							function popup_print(){
								window.open('printaj/kwitansi_tnx23.php?nokwitansi=<?echo $d1[nokwitansi]?>&status=1','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
								}
						</script>
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI <i class="fa fa-angle-double-right"></i> PIUTANG KARYAWAN</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveC"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR KWITANSI</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:35%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td>STATUS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><?echo $status?></td>
												</tr>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>DIBERIKAN KEPADA</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA KARYAWAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[nama]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[noktp]?>" class="form-control" style="width:40%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UANG SEJUMLAH</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="PIUTANG KARYAWAN" class="form-control" style="width:50%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d1[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
			                            	</table>
			                            	<!--
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">NAMA BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE nopesan='$_REQUEST[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dA[idbarang]'"));
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo "$d3[kodebarang] | $d3[namabarang] | $d3[varian]"?></td>
					                                    <td><?echo $d3[warna]?></td>
					                                    <td align="center"><?echo $d3[thnproduksi]?></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                        </table>
					                        -->
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                        <?
			                        if($d1[status]=='1')
			                        	{
									?>
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
			                        <?
										}
									?>
										<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=E"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
				                	</form>
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
		
	else if($submenu == 'penjualan1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Uang Muka</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=penjualan2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA JUAL</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nonota" style="width:30%" /></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
		$('#uang').on('keypress', function(e) {
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
		$('#uang2').on('keypress', function(e) {
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
                    "bFilter": false,
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