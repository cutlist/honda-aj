<?
	if($submenu == 'A')
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
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>RIWAYAT SERVIS</small></h4>
	                           		<div style="float:left" class="col-xs-8">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA SERVIS / NO. NOTA SERVIS JR / NO. PKB / NAMA PELANGGAN / STATUS PEMBAYARAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-4">
										<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/historyservice.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
									<table id="example1" class="table table-striped table-hover" style="width:220%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA SERVIS</th>
			                                    <th style="padding:7px" width="1%">STATUS PEMBAYARAN</th>
			                                    <th style="padding:7px">NO. NOTA SERVIS JR</th>
			                                    <th style="padding:7px">NO. PKB</th>
			                                    <th style="padding:7px" width="5%">TGL NOTA SERVIS</th>
			                                    <th style="padding:7px" width="5%">JENIS SERVIS</th>
			                                    <th style="padding:7px" width="4%">WAKTU</br>MULAI</th>
			                                    <th style="padding:7px" width="4%">WAKTU</br>SELESAI</th>
			                                    <th style="padding:7px" width="">NAMA PELANGGAN</th>
			                                    <th style="padding:7px" width="">KODE MOTOR</th>
			                                    <th style="padding:7px" width="">NAMA MOTOR</th>
			                                    <th style="padding:7px" width="">VARIAN MOTOR</th>
			                                    <th style="padding:7px" width="6%">GRAND TOTAL (RP)</th>
			                                    <th style="padding:7px" width="6%">PEMBAYARAN (PEMBULATAN) (RP)</th>
			                                    <th style="padding:7px" width="">NAMA MEKANIK</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notaservice_vw WHERE jamselesai!='00:00:00' AND (ket LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%' OR noclaim LIKE '%$_REQUEST[cari]%' OR nopkb LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notaservice_vw WHERE jamselesai!='00:00:00' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Lunas</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'>Sudah Lunas</span>";}
											
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE jnskwitansi='servis' AND nomor='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td><?echo $d1[noclaim]?></td>
			                                    <td><?echo $d1[nopkb]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[jns]?></td>
			                                    <td align="center"><?echo $d1[jammulai]?></td>
			                                    <td align="center"><?echo $d1[jamselesai]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[kodemotor]?></td>
			                                    <td><?echo $d1[tipemotor]?></td>
			                                    <td><?echo $d1[varianmotor]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[grandtotal])?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d3[pembulatan])?></span></td>
			                                    <td><?echo $d2[nama]?></td>
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
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_vw WHERE id='$_REQUEST[id]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelisp FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'"));
		$dC = mysql_fetch_array(mysql_query("SELECT *,COUNT(tarif) AS tqty, SUM(tarif) AS ttotal, SUM(tarifasli) AS tottarifasli, SUM(diskon) AS totdiskon FROM x23_notaservice_det WHERE nonota='$d1[nonota]'"));
		$ttotal = $dB[ttotal]+$dC[ttotal];
		
    	if($d1[status]=="1"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Lunas</span>";}
    	if($d1[status]=="2"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'>Lunas</span>";}
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:250px;">
			                	<h4>SERVIS <small>RIWAYAT NOTA SERVIS</small></h4>
			                	
				                	<div style="padding:10px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NOMOR ANTRIAN</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" name="noantrian" class="form-control" style="width:50%" value="<?echo $d1[noantrian]?>" maxlength="4" readonly=""></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NOMOR PKB</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopkb]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NOMOR NOTA SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>STATUS</td>
					                        		<td>:</td>
					                        		<td><?echo $status?></td>
					                        	</tr>
												<?
												if(!empty($d1[noclaim]))
													{
												?>
					                        	<tr>
					                        		<td>NOMOR NOTA SERVIS SEBELUMNYA</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[noservis]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
												<?
													}
												?>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%" border="0">
												<?
												if(!empty($d1[noclaim]))
													{
												?>
					                        	<tr>
					                        		<td>NOMOR NOTA SERVIS JR</td>
					                        		<td>:</td>
					                        		<td colspan="3"><input type="text" name="nonota" value="<?echo $d1[noclaim]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
												<?
													}
												?>
					                        	<tr>
					                        		<td width="34%">TANGGAL SERVIS</td>
					                        		<td width="3%">:</td>
					                    			<td colspan="3"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 50%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NAMA PELANGGAN</td>
					                        		<td>:</td>
					                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
					                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-search"></i></button></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NOMOR POLISI</td>
					                        		<td>:</td>
					                    			<td width="25%"><input type="text" style="width:100%" value="<?echo $d1[nopol]?>" class="form-control" maxlength="20" readonly></td>
					                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler1') .style.display=='none') {document.getElementById('spoiler1') .style.display=''}else{document.getElementById('spoiler1') .style.display='none'}"><i class="fa fa-search"></i></button></td>
					                    		</tr>
					                        </table>
					                    </div>
					                </div>
				                    <div class="clearfix"></div>
			                    	
			                    	<div id="spoiler" style="display:none">
				                    <div class="clearfix"></div>
		                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 0px"></div>
					                	<div style="padding:10px">
						           			<div class="col-xs-12">
						                    	<table width="70%">
						                    		<tr>
						                    			<td width="24%">NOMOR OHC</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR TELEPON</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. KTP/NO. IDENTITAS</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td valign="top" >ALAMAT</td>
						                    			<td valign="top" >:</td>
						                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
						                    		</tr>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td width="15%">
						                                    <div class="input-group">
						                                        <span class="input-group-addon">RT</span>
						                                        <input type="text" name="rt" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
						                                    </div>
						                                </td>
						                    			<td>
						                                    <div class="input-group">
						                                        <span class="input-group-addon">RW</span>
						                                        <input type="text" name="rw" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
						                                    </div>
						                                </td>
													</tr>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
															<option value=''>Pilih Kabupaten</option>
															<?
																$q = mysql_query('SELECT * FROM kd_kabupaten ORDER BY namakab');
																while ($data = mysql_fetch_array($q)){
															?>
																<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d1[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
															<?
																}
															?>
															</select></td>
						                    		</tr>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
															<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
															</select></td>
						                    		</tr>
						                    		<tr>
						                    			<td></td>
						                    			<td></td>
						                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
															<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
															</select></td>
						                    		</tr>
						                    		<tr>
						                    			<td>EMAIL</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>PEKERJAAN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
						                    		</tr>
				                            	</table>
				                    		</div>
				                    	</div>
			                    	</div>
					                    	
			                    	<div id="spoiler1" style="display:none">
				                    <div class="clearfix"></div>
		                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 0px"></div>
					                	<div style="padding:10px">
						           			<div class="col-xs-12">
					                    		<table width="70%">
						                    		<tr>
						                    			<td width="24%">NOMOR RANGKA</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" name="norangka" class="form-control" style="width: 55%" value="<?echo $d1[norangka]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR MESIN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="kodemotor" class="form-control" style="width: 55%" value="<?echo $d1[nomesin]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KODE MOTOR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="kodemotor" class="form-control" style="width: 55%" value="<?echo $d1[kodemotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TIPE MOTOR</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tipemotor" name="pekerjaan" class="form-control" style="width: 55%" value="<?echo $d1[tipemotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>VARIAN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="varianmotor" class="form-control" style="width: 55%" value="<?echo $d1[varianmotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>WARNA</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="warnamotor" class="form-control" style="width: 55%" value="<?echo $d1[warnamotor]?>" maxlength="30" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TAHUN PRODUKSI</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tahunmotor" class="form-control" style="width: 13%;text-align:right" value="<?echo $d1[tahunmotor]?>" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KM</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="km" class="form-control" style="width: 20%;text-align:right" value="<?echo $d1[km]?>" maxlength="8"  readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA MEKANIK</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="warnamotor" class="form-control" style="width: 55%" value="<?echo $d2[nama]?>" maxlength="30" readonly=""></td>
						                    		</tr>
				                            	</table>
					                    	</div>
					                    </div>
				                    </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
					                	</div>
				                    </div>
			                	</div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:270px;">
			                        <table id="example2" class="table table-striped table-hover" style="width:130%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG/KODE JASA<?//echo $d1[nonota]?></th>
			                                    <th style="padding:7px">NAMA BARANG/JASA</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
			                                    <th width="1%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
			                                    <th width="8%" style="padding:7px"><center>QTY JUAL (PCS)</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
			                                    <!--
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                    -->
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelisp FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'"));
										$dC = mysql_fetch_array(mysql_query("SELECT *,COUNT(tarif) AS tqty, SUM(tarif) AS ttotal, SUM(tarifasli) AS tottarifasli, SUM(diskon) AS totdiskon FROM x23_notaservice_det WHERE nonota='$d1[nonota]'"));
										$ppnjasa = round($dC[ttotal] * 0.1 , 0);
		                            	$ttotal = $dB[ttotal]+$dC[ttotal]+$ppnjasa;
												
			                            $dA1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'"));
										
										$qA  = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
											$dNbl = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$dA[notabeli]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td><?echo $dA[notabeli]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dNbl[tglnota]))?></td>
			                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            if(!empty($dA1[nonota]))
			                            	{
			                            ?>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:10%"><b>TOTAL BARANG</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($dB[tqty])?></b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($dB[ttotal])?></b></span></td>
			                            	</tr>
			                            <?
			                            	}
			                            	
			                            $dA2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'"));
										$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
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
													<td></td>
													<td></td>
				                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
			                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:5%">-</span></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
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
													<td></td>
													<td></td>
				                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
			                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:5%">-</span></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
				                                </tr>
			                            <?	
												}
			                            	}
			                            	
			                            $dA2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[noservis]' AND nonota!=''"));
										$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[noservis]' AND nonota!=''");
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
													<td></td>
													<td></td>
				                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
			                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:5%">-</span></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
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
													<td></td>
													<td></td>
				                                    <td align="right"><span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span></td>
			                                    	<td align="right"><span style="margin-right:1%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
				                                    <td align="right"><span style="margin-right:5%">-</span></td>
				                                    <td align="right"><span style="margin-right:10%"><?echo number_format($dA[tarif],"0","",".")?></span></td>
				                                </tr>
			                            <?	
												}
			                            	}
					                            	
			                            if(!empty($dA2[nonota]))
			                            	{
			                            ?>
			                            	<tr>
			                            		<th colspan="8"><div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:10%"><b>TOTAL JUMLAH JASA</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($dC[ttotal]);?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:10%"><b>PPN 10%</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($ppnjasa)?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:10%"><b>TOTAL JUMLAH JASA + PPN 10%</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($dC[ttotal]+$ppnjasa)?></b></span></td>
			                            	</tr>
			                            <?
			                            	}
											
										$dA3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE jnskwitansi='servis' AND nomor='$d1[nonota]'"));
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="8"><div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:10%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($ttotal)?></b></span></td>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:10%"><b>PEMBAYARAN (PEMBULATAN)</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:10%"><b><?echo number_format($dA3[pembulatan])?></b></span></td>
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
            });
        </script>