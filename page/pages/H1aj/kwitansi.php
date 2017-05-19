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
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KWITANSI</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Indent Pada Bagian Sales/Sales Counter.</p>";
											}
										if($_REQUEST[note]=="2")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Cek Fisik Pada Bagian Gudang & PDI.</p>";
											}
										if($_REQUEST[note]=="tm")
											{
											$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</p>";
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
	                           		<div style="float:left" class="col-xs-8">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="40%">
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="NOMOR KWITANSI ..." class="form-control"/>
		                                            </div>
                                    			</td>
				                        		<td><select name="idjenis" style="font-size:12px;padding:3px;height:34px" class="form-control">
																	<option value='' <?if($_REQUEST[idjenis]==""){?>selected<?}?>>SEMUA JENIS</option>
																	<option value='1' <?if($_REQUEST[idjenis]=="1"){?>selected<?}?>>PELUNASAN (TRANSAKSI CASH)</option>
																	<option value='2' <?if($_REQUEST[idjenis]=="2"){?>selected<?}?>>UANG MUKA (TRANSAKSI KREDIT/CASH TEMPO LEASING)</option>
																	<option value='3' <?if($_REQUEST[idjenis]=="3"){?>selected<?}?>>UANG TITIPAN (TRANSAKSI CASH/CASH TEMPO DEALER)</option>
																	<option value='4' <?if($_REQUEST[idjenis]=="4"){?>selected<?}?>>PENGEMBALIAN UANG MUKA/UANG TITIPAN</option>
																	<option value='8' <?if($_REQUEST[idjenis]=="8"){?>selected<?}?>>PENAMBAHAN UANG MUKA/UANG TITIPAN</option>
																	<option value='6' <?if($_REQUEST[idjenis]=="6"){?>selected<?}?>>PEMBAYARAN PIUTANG CASH TEMPO DEALER</option>
																	<option value='7' <?if($_REQUEST[idjenis]=="7"){?>selected<?}?>>PEMESANAN NOPOL</option>
																	<option value='5' <?if($_REQUEST[idjenis]=="5"){?>selected<?}?>>PEMBAYARAN PEMBAYARAN PIUTANG TUNAI DAN POTONGAN KOMPENSASI TUNAI</option>
																	<option value='9' <?if($_REQUEST[idjenis]=="9"){?>selected<?}?>>PIUTANG KARYAWAN TUNAI</option>
															    </select></td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-4">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=add1"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> &nbsp; Tambah Baru</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. KWITANSI</th>
			                                    <th style="padding:7px">TGL KWITANSI</th>
			                                    <th style="padding:7px">JENIS</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">JUMLAH (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if($_REQUEST[idjenis]=="1"){
											$jns = "lunas";
											}
										else if($_REQUEST[idjenis]=="2"){
											$jns = "umuka";
											}
										else if($_REQUEST[idjenis]=="3"){
											$jns = "titip";
											}
										else if($_REQUEST[idjenis]=="4"){
											$jns = "pengembalian";
											}
										else if($_REQUEST[idjenis]=="5"){
											$jns = "tunai";
											}
										else if($_REQUEST[idjenis]=="6"){
											$jns = "cashtempo";
											}
										else if($_REQUEST[idjenis]=="7"){
											$jns = "nopol";
											}
										else if($_REQUEST[idjenis]=="8"){
											$jns = "penambahan";
											}
										else if($_REQUEST[idjenis]=="9"){
											$jns = "putang";
											}
											
										if(!empty($_REQUEST[cari]) AND !empty($_REQUEST[idjenis]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND id%2=0 AND nokwitansi LIKE '%$_REQUEST[cari]%' AND jnskwitansi='$jns' ORDER BY id DESC LIMIT 0,100");
											}
										if(!empty($_REQUEST[cari]) AND empty($_REQUEST[idjenis]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND id%2=0 AND nokwitansi LIKE '%$_REQUEST[cari]%' ORDER BY id DESC LIMIT 0,100");
											}
										if(empty($_REQUEST[cari]) AND !empty($_REQUEST[idjenis]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND id%2=0 AND jnskwitansi='$jns' ORDER BY id DESC LIMIT 0,100");
											}
										if(empty($_REQUEST[cari]) AND empty($_REQUEST[idjenis]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND id%2=0 AND cetak='0' ORDER BY id DESC");
											}
											
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											
											if($d1[jnskwitansi]=="piutang"){
												$dZ = mysql_fetch_array(mysql_query("SELECT status FROM tbl_piutang WHERE id%2=0 AND id='$d1[nomor]'"));
												if($dZ[status]=="2"){$show = "0";}
												else{$show = "1";}
												}
											else if($d1[jnskwitansi]=="tunai" && $d1[idpotkom]=="0"){
												$dZ = mysql_fetch_array(mysql_query("SELECT status FROM tbl_piutang WHERE id%2=0 AND id='$d1[nomor]'"));
												if($dZ[status]=="2"){$show = "0";}
												else{$show = "1";}
												}
											else if($d1[jnskwitansi]=="tunai" && $d1[idpotkom]!="0"){
												$dZ = mysql_fetch_array(mysql_query("SELECT status FROM tbl_potkompensasi WHERE id%2=0 AND id='$d1[idpotkom]'"));
												if($dZ[status]=="2"){$show = "0";}
												else{$show = "1";}
												}
											else{
												$show = "1";
												}
											
											if($d1[jnskwitansi]=="tunai" OR $d1[jnskwitansi]=="piutang"){
												$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
												}
											else{
												$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
												}
			                            	if($d1[jnskwitansi]=='lunas'){
												$jenis = "PELUNASAN";
												$target = "?opt=$opt&menu=$menu&submenu=B4&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='umuka'){
												$jenis = "UANG MUKA";
												$target = "?opt=$opt&menu=$menu&submenu=B1&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='titip'){
												$jenis = "UANG TITIPAN";
												$target = "?opt=$opt&menu=$menu&submenu=B1&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='pengembalian'){
												$jenis = "PENGEMBALIAN UANG MUKA/UANG TITIPAN";
												$target = "?opt=$opt&menu=$menu&submenu=B2&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='tunai'){
												$jenis = "PEMBAYARAN PEMBAYARAN PIUTANG TUNAI DAN POTONGAN KOMPENSASI TUNAI";
												$target = "?opt=$opt&menu=$menu&submenu=B3A&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='cashtempo'){
												$jenis = "PEMBAYARAN PIUTANG CASH TEMPO DEALER";
												$target = "?opt=$opt&menu=$menu&submenu=B4&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='nopol'){
												$jenis = "PEMESANAN NOPOL";
												$target = "?opt=$opt&menu=$menu&submenu=B5&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='penambahan'){
												$jenis = "PENAMBAHAN UANG MUKA/UANG TITIPAN";
												$target = "?opt=$opt&menu=$menu&submenu=B6&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}
											else if($d1[jnskwitansi]=='piutang'){
												$jenis = "PIUTANG KARYAWAN TUNAI";
												$target = "?opt=$opt&menu=$menu&submenu=B3&id=$d1[id]&nomor=$d1[nokwitansi]&jenis=$jenis";
												}

											if($d1[cetak]=="0"){
												$red = "color:#ff0227";
												}
											else{$red="";}
											if($show == "1")
												{
			                            ?>
				                                <tr style="cursor:pointer;<?echo $red?>" onclick="location.href='<?echo $target?>'">
				                                    <td><?echo $d1[nokwitansi]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
				                                    <td><?echo $jenis?></td>
				                                    <td><?echo $d2[nama]?></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format(abs($d1[jumlah]),"0","",".")?></span></td>
				                                </tr>
			                            <?
												$no++;
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
?>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'add1')
		{
?>
			<script language="JavaScript">
			function MM_jumpMenu(targ,selObj,restore){ //v3.0
			eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
			if (restore) selObj.selectedIndex=0;
			}
			</script>
			
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Baru</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:70%;">
				                    		<tr>
				                    			<td width="30%" valign="top">BUAT KWITANSI UNTUK</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td><select class="form-control" name="grup" style="width:80%" onChange="MM_jumpMenu('parent',this,1)">
																	<option value=''>Pilih</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=umuka1"?>'>UANG MUKA (TRANSAKSI KREDIT/CASH TEMPO LEASING)</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=titip1"?>'>UANG TITIPAN (TRANSAKSI CASH/CASH TEMPO DEALER)</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=lunas1"?>'>PELUNASAN (TRANSAKSI CASH)</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=kembali1"?>'>PENGEMBALIAN UANG MUKA/UANG TITIPAN</option>
																	<option value='<?echo "?opt=$opt&menu=$menu&submenu=cashtempo1"?>'>PEMBAYARAN CASH TEMPO DEALER</option>
													</select></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
				                    </div>
									<!--
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									-->
				                	</form>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'cashtempo1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Pembayaran Cash Tempo Dealer</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=cashtempo2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA JUAL</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nonota" style="width:35%" maxlength="25"/></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                   	 	<p>Pembuatan Kwitansi Cash Tempo Dealer Hanya Untuk Pembayaran Transaksi Cash Tempo Dealer.</p>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
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
		
	else if($submenu == 'cashtempo2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		if($d1[jnstransaksi]!='CASH TEMPO' && $d1[jnscashtempo]=='DEALER')
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Pembuatan Kwitansi Hanya Untuk Transaksi Cash Tempo Dealer.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=cashtempo1'/>";
			exit();
			}
			
		if(empty($d1[id]))
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Tidak Ada.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=cashtempo1'/>";
			exit();
			}
		else
			{
			if($d1[sisabayar]<='0')
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Tidak Ada Sisa Pembayarannya.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=cashtempo1'/>";
				exit();
				}
			}
			
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='cashtempo' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
			$nokwitansi = "KCT$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Cash Tempo Dealer</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=cashtempo3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $_REQUEST[nonota]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $nokwitansi?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly=""></td>
												</tr>
												<!--
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="jaket" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK' selected="">TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="bukuservice" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK' selected="">TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[nama]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[noktp]?>" class="form-control" style="width:40%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="PEMBAYARAN CASH TEMPO DEALER" class="form-control" style="width:100%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>SISA PIUTANG</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" class="form-control uang" name="sisabayar" value="<?echo number_format($d1[sisabayar],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH BAYAR</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="jumlah" class="form-control uang" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                    <th style="padding:7px">NOMOR RANGKA</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo "$d3[kodebarang] | $d3[namabarang] | $d3[varian]"?></td>
					                                    <td><?echo $d3[warna]?></td>
					                                    <td align="center"><?echo $d3[thnproduksi]?></td>
					                                    <td><?echo $dA[norangka]?></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[idpelanggan]?>">
				                    	
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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

	else if($submenu == 'cashtempo3')
		{
		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
		$sisabayar 	= preg_replace( "/[^0-9]/", "",$_REQUEST['sisabayar']);
        if($jumlah=='0')
			{
			echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Tidak Boleh 0 (Nol).')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=cashtempo1'/>";
			exit();
			}
			/*
        if($sisabayar < $jumlah)
			{
			echo "<script>alert ('Mohon Ulangi Jumlah Yang Diinput, Karena Jumlah Melebihi Sisa Piutang.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=cashtempo1'/>";
			exit();
			}
			*/
        if($sisabayar == $jumlah)
			{
			$tglpelunasan = date("Y-m-d");
			}
		else{
			$tglpelunasan = "0000-00-00";
			}
		
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
        
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=cashtempo1'/>";
			exit();
			}
			
		$nonota = strtoupper($_REQUEST[nonota]);
			
		$q  = mysql_query("INSERT INTO tbl_history_bcashtempo VALUES ('','$nonota','$tahun','$bulan','$tanggal','$jumlah')");
		$q1 = mysql_query("UPDATE tbl_notajual SET sisabayar=sisabayar-$jumlah, tglpelunasan='$tglpelunasan' WHERE id%2=0 AND nonota='$nonota'");
		$q2 = mysql_query("INSERT INTO tbl_kwitansi (
												jnskwitansi, 
												nokwitansi, 
												tahun, 
												bulan, 
												tanggal, 
												nomor, 
												idpelanggan, 
												jaket, 
												bukuservice, 
												jumlah, 
												status, 
												cetak, 
												user, 
												keterangan, 
												inputx, 
												updatex) 
											VALUES (
												'cashtempo', 
												'$_REQUEST[nokwitansi]', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$nonota',
												'$_REQUEST[idpelanggan]',
												'$_REQUEST[jaket]',
												'$_REQUEST[bukuservice]',
												'$jumlah',
												'1',
												'1',
												'$_SESSION[id]',
												'$keterangan',
												NOW(),
												'$updatex')
							");
	
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
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
		
	else if($submenu == 'umuka1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Uang Muka</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=umuka2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nonota" style="width:35%" maxlength="25"/></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                   	 	<p>Pembuatan Kwitansi Uang Muka Dealer Hanya Untuk Pembayaran Uang Muka Transaksi Kredit Atau Cash Tempo Leasing.</p>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
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
		
	else if($submenu == 'umuka2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan,utitipan,jnstransaksi,jnscashtempo FROM tbl_pesanan WHERE id%2=0 AND nopesan='$_REQUEST[nonota]'"));
		if($d1[jnstransaksi]=='CASH')
			{ 
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Pembuatan Kwitansi Uang Muka Hanya Untuk Transaksi Kredit.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		if($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='DEALER')
			{ 
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Pembuatan Kwitansi Uang Muka Hanya Untuk Transaksi Kredit.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
			
		if(empty($d1[id]))
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Tidak Ada.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		else
			{
			$d3 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_REQUEST[nonota]' AND jnskwitansi='umuka'"));
			if(!empty($d3[id]))
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Sudah Dibuat Kwitansi Uang Muka.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			if(empty($d1[utitipan]) || $d1[utitipan]=="0")
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Uang Muka/Titipan Tidak Ada pada Nomor Nota Tersebut.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			}
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='umuka' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
			$nokwitansi = "KUM$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Uang Muka</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=umuka3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $_REQUEST[nonota]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $nokwitansi?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
												<!--
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="jaket" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK' selected="">TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="bukuservice" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK' selected="">TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
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
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[utitipan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="UANG MUKA" class="form-control" style="width:30%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_REQUEST[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[idpelanggan]?>">
				                    	
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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

	else if($submenu == 'umuka3')
		{
		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
        
		$nonota = strtoupper($_REQUEST[nonota]);
		
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
		$q1 = mysql_query("INSERT INTO tbl_kwitansi (
												jnskwitansi, 
												nokwitansi, 
												tahun, 
												bulan, 
												tanggal, 
												nomor, 
												idpelanggan, 
												jaket, 
												bukuservice, 
												jumlah, 
												status, 
												cetak, 
												user, 
												keterangan, 
												inputx, 
												updatex) 
											VALUES (
												'umuka', 
												'$_REQUEST[nokwitansi]', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$nonota',
												'$_REQUEST[idpelanggan]',
												'$_REQUEST[jaket]',
												'$_REQUEST[bukuservice]',
												'$jumlah',
												'1',
												'1',
												'$_SESSION[id]',
												'$keterangan',
												NOW(),
												'$updatex')
							");
	
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			

		if($q1 && $q2)
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
		
	else if($submenu == 'titip1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Titipan</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=titip2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nonota" style="width:35%" maxlength="25"/></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                   	 	<p>Pembuatan Kwitansi Uang Titipan Dealer Hanya Untuk Pembayaran Uang Titipan Transaksi Cash Atau Cash Tempo Dealer.</p>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
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
		
	else if($submenu == 'titip2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan,utitipan,jnstransaksi,jnscashtempo FROM tbl_pesanan WHERE id%2=0 AND nopesan='$_REQUEST[nonota]'"));
		if($d1[jnstransaksi]=='KREDIT')
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Pembuatan Kwitansi Titipan Hanya Untuk Transaksi Cash.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		if($d1[jnstransaksi]=='CASH TEMPO' && $d1[jnscashtempo]=='LEASING')
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Pembuatan Kwitansi Titipan Hanya Untuk Transaksi Cash.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
			
		if(empty($d1[id]))
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Tidak Ada.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		else
			{
			$d3 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_REQUEST[nonota]' AND jenis='titip'"));
			if(!empty($d3[id]))
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Sudah Dibuat Kwitansi Titipan.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			if(empty($d1[utitipan]) || $d1[utitipan]=="0")
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Uang Muka/Titipan Tidak Ada pada Nomor Nota Tersebut.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			}
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='titip' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
			$nokwitansi = "KT$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Titipan</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=titip3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $_REQUEST[nonota]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $nokwitansi?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
												<!--
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="jaket" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK' selected="">TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="bukuservice" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK' selected="">TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
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
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[utitipan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="TITIPAN" class="form-control" style="width:30%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_REQUEST[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[idpelanggan]?>">
				                    	
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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

	else if($submenu == 'titip3')
		{
		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
		
		$nonota = strtoupper($_REQUEST[nonota]);
        
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
  
		$q1 = mysql_query("INSERT INTO tbl_kwitansi (
												jnskwitansi, 
												nokwitansi, 
												tahun, 
												bulan, 
												tanggal, 
												nomor, 
												idpelanggan, 
												jaket, 
												bukuservice, 
												jumlah, 
												status, 
												cetak, 
												user, 
												keterangan, 
												inputx, 
												updatex) 
											VALUES (
												'titip', 
												'$_REQUEST[nokwitansi]', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$nonota',
												'$_REQUEST[idpelanggan]',
												'$_REQUEST[jaket]',
												'$_REQUEST[bukuservice]',
												'$jumlah',
												'1',
												'1',
												'$_SESSION[id]',
												'$keterangan',
												NOW(),
												'$updatex')
							");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";

		if($q1 && $q2)
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
		
	else if($submenu == 'kembali1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Pengembalian Uang Muka/Uang Titipan</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=kembali2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nopesan" style="width:30%" maxlength="30"/></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                   	 	<p>Pembuatan Kwitansi Pengembalian Uang Muka/Uang Titipan Hanya Untuk Pembayaran Pengembalian Uang Muka/Uang Titipan Jika Pembatalan Transaksi Tidak Disebabkan Oleh Konsumen.</p>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
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
		
	else if($submenu == 'kembali2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT batal,idpelanggan,utitipan FROM tbl_pesanan WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'"));
		if(empty($d1[batal]))
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Tidak Ada.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		else if($d1[batal]=='PELANGGAN')
			{
			echo "<script>alert ('Pengembalian hanya dapat dilakukan jika bukan dibatalkan oleh Konsumen.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		else
			{
			$d3 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_REQUEST[nopesan]' AND jnskwitansi='pengembalian'"));
			$d4 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_REQUEST[nopesan]' AND jnskwitansi IN ('umuka','titip')"));
			if(empty($d4[id]))
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Belum Dibuat Kwitansi Uang Muka / Uang Titipan.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			if(!empty($d3[id]))
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Sudah Dibuat Kwitansi Pengembalian.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			if(empty($d1[utitipan]) || $d1[utitipan]=="0")
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Uang Muka/Uang Titipan Tidak Ada.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			}
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='pengembalian' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
			$nokwitansi = "KKB$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Pengembalian Uang Muka/Uang Titipan</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=kembali3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PEMESANAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nopesan" class="form-control" value="<?echo $_REQUEST[nopesan]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $nokwitansi?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
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
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d1[utitipan],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="" >
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="PENGEMBALIAN UANG MUKA/UANG TITIPAN" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_REQUEST[nopesan]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[idpelanggan]?>">
				                    	
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
	else if($submenu == 'kembali3')
		{
		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan	  = strtoupper($_REQUEST[keterangan]);
		
		$nonota = strtoupper($_REQUEST[nopesan]);
        
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}

		$q1 = mysql_query("INSERT INTO tbl_kwitansi (
												jnskwitansi, 
												nokwitansi, 
												tahun, 
												bulan, 
												tanggal, 
												nomor, 
												idpelanggan, 
												jumlah, 
												status, 
												cetak, 
												user, 
												keterangan, 
												inputx, 
												updatex) 
											VALUES (
												'pengembalian', 
												'$_REQUEST[nokwitansi]', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$nonota',
												'$_REQUEST[idpelanggan]',
												'$jumlah',
												'1',
												'1',
												'$_SESSION[id]',
												'$keterangan',
												NOW(),
												'$updatex')
							");
		/*					
		$idkwitansi = mysql_insert_id();
		
		$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
											idkwitansi, 
											tahun, 
											bulan, 
											tanggal, 
											kasus, 
											tbl, 
											inputx) 
										VALUES (
											'$idkwitansi', 
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'KWITANSI PENGEMBALIAN UANG MUKA / TITIPAN NO. KWITANSI $_REQUEST[nokwitansi] RP. $_REQUEST[jumlah]', 
											'tbl_kwitansi', 
											NOW())
							");
		*/
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		/*
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
		*/

		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
		
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=tm'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}

		
	else if($submenu == 'lunas1')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Pelunasan</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=lunas2"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" class="form-control" name="nonota" style="width:35%" maxlength="25"/></td>
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                   	 	<p>Pembuatan Kwitansi Pelunasan Hanya Untuk Pelunasan Transaksi Cash.</p>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
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
		
	else if($submenu == 'lunas2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan,bayar,jnstransaksi FROM tbl_notajual WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		if($d1[jnstransaksi]!='CASH')
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Pembuatan Kwitansi Uang Muka Hanya Untuk Transaksi Cash.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=lunas1'/>";
			exit();
			}
			
		if(empty($d1[id]))
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Tidak Ada.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
			exit();
			}
		else
			{
			$d3 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_REQUEST[nonota]' AND jnskwitansi='lunas'"));
			if(!empty($d3[id]))
				{
				echo "<script>alert ('Mohon Ulangi Nomor Nota Yang Diinput, Karena Nomor Nota Sudah Dibuat Kwitansi Pelunasan.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=add1'/>";
				exit();
				}
			}
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='lunas' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
			$nokwitansi = "KPL$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Buat Kwitansi Pelunasan</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=lunas3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $_REQUEST[nonota]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $nokwitansi?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
												<!--
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="jaket" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK'>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="bukuservice" required style="width: 30%">
																		<option value='YA'>YA</option>
																		<option value='TIDAK'>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[nama]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[noktp]?>" class="form-control" style="width:40%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>SISA PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="sisa" class="form-control" value="<?echo number_format($d1[bayar],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UANG SEJUMLAH</td>
					                    			<td>:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="jumlah" id="uang" class="form-control" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="PELUNASAN" class="form-control" style="width:30%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="keterangan" maxlength="50" class="form-control" style="width:70%" ></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                    <th style="padding:7px">NOMOR RANGKA</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo "$d3[kodebarang] | $d3[namabarang] | $d3[varian]"?></td>
					                                    <td><?echo $d3[warna]?></td>
					                                    <td align="center"><?echo $d3[thnproduksi]?></td>
					                                    <td><?echo $dA[norangka]?></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[idpelanggan]?>">
				                    	
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=add1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
	else if($submenu == 'lunas3')
		{
		$sisa 	= preg_replace( "/[^0-9]/", "",$_REQUEST['sisa']);
		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        $keterangan = strtoupper($_REQUEST[keterangan]);
        /*
        $dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
        $gt = $dA[totr]-$dA[tdisc]-$dA[utitipan];
        
			echo "<script>alert ('$dA[totr].$_REQUEST[nonota].$gt')</script>";
			exit();
		*/
												
        if($sisa > $jumlah)
			{
			echo "<script>alert ('Jumlah Pembayaran Tidak Bisa Lebih Kecil Dari Sisa Pembayaran.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
		$nonota = strtoupper($_REQUEST[nonota]);
		
        if(date("Y-m-d") < $tanggal)
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Melewati Tanggal Hari Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
		$q1 = mysql_query("INSERT INTO tbl_kwitansi (
												jnskwitansi, 
												nokwitansi, 
												tahun, 
												bulan, 
												tanggal, 
												nomor, 
												idpelanggan, 
												jaket, 
												bukuservice, 
												jumlah,  
												status,
												cetak,  
												user, 
												keterangan, 
												inputx, 
												updatex) 
											VALUES (
												'lunas', 
												'$_REQUEST[nokwitansi]', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$nonota',
												'$_REQUEST[idpelanggan]',
												'$_REQUEST[jaket]',
												'$_REQUEST[bukuservice]',
												'$jumlah',
												'1',
												'1',
												'$_SESSION[id]',
												'$keterangan',
												NOW(),
												'$updatex')
							");
		mysql_query("UPDATE tbl_notajual SET sisabayar=sisabayar-$jumlah WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");

		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_kwitansi',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH KWITANSI $_REQUEST[nokwitansi]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansi.php?nokwitansi=$_REQUEST[nokwitansi]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";

		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=2'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	else if($submenu == 'B1')
		{
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan FROM tbl_pesanan WHERE id%2=0 AND nopesan='$d3[nomor]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
		//$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_REQUEST[nomor]' AND jnskwitansi='umuka'"));
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansi.php?nokwitansi=<?echo $d3[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d3[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d3[nokwitansi]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d3[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
												<!--
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="jaket" readonly style="width: 30%">
																		<option value='YA' <?if($d3[jaket]=='YA'){?>selected=""<?}?>>YA</option>
																		<option value='TIDAK' <?if($d3[jaket]=='TIDAK'){?>selected=""<?}?>>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="bukuservice" readonly style="width: 30%">
																		<option value='YA' <?if($d3[bukuservice]=='YA'){?>selected=""<?}?>>YA</option>
																		<option value='TIDAK' <?if($d3[bukuservice]=='TIDAK'){?>selected=""<?}?>>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
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
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d3[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[jenis]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d3[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$d3[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
			                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B5')
		{
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND notajual='$d2[nomor]' OR nopesan='$d2[nomor]'"));
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansinopol.php?nokwitansi=<?echo $d2[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    	<?
					                    	if($d1[status]=="2")
					                    		{
												$qA = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$d2[nomor]'");
											?>
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d2[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
											<?
												}
					                    	else
					                    		{
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$d2[nomor]'");
											?>
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PESAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d2[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
											<?
												}
					                    	?>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d2[nokwitansi]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d2[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
												<?
												if($d2[jumlah] < '0')
													{
												?>
						                    		<tr>
						                    			<td><b>DIKEMBALIKAN KE</b></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA PELANGGAN</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" style="width:70%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. KTP/NO. IDENTITAS</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d1[noktp]?>" class="form-control" style="width:40%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>UANG SEJUMLAH</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format(abs($d2[jumlah]),"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    </div>
						                                </td>
						                    		</tr>
					                            <?
				                            		}
				                            	else
				                            		{
					                            ?>
						                    		<tr>
						                    			<td><b>TERIMA DARI</b></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA PELANGGAN</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" style="width:70%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. KTP/NO. IDENTITAS</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d1[noktp]?>" class="form-control" style="width:40%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>UANG SEJUMLAH</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format(abs($d2[jumlah]),"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    </div>
						                                </td>
						                    		</tr>
					                            <?
					                            	}
					                            ?>
						                    	<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[jenis]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
			                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B6')
		{
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan FROM tbl_pesanan WHERE id%2=0 AND nopesan='$d2[nomor]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansi.php?nokwitansi=<?echo $d2[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    	<?
					                    	if($d1[status]=="2")
					                    		{
												$qA = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$d2[nomor]'");
											?>
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $_REQUEST[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
											<?
												}
					                    	else
					                    		{
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$d2[nomor]'");
											?>
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PESAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $_REQUEST[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
											<?
												}
					                    	?>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d2[nokwitansi]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d2[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
												<?
												if($d2[jumlah] < '0')
													{
												?>
						                    		<tr>
						                    			<td><b>DIKEMBALIKAN KE</b></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA PELANGGAN</td>
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
						                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format(abs($d2[jumlah]),"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    </div>
						                                </td>
						                    		</tr>
					                            <?
				                            		}
				                            	else
				                            		{
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
						                    			<td>NO. KTP/NO. IDENTITAS</td>
						                    			<td>:</td>
						                    			<td><input type="text" value="<?echo $d3[noktp]?>" class="form-control" style="width:40%" readonly></td>
						                    		</tr>
						                    		<tr>
						                    			<td>UANG SEJUMLAH</td>
						                    			<td>:</td>
						                    			<td><div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format(abs($d2[jumlah]),"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
						                                    </div>
						                                </td>
						                    		</tr>
					                            <?
					                            	}
					                            ?>
						                    	<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[jenis]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d2[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
			                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
									</div>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B4')
		{
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan FROM tbl_notajual WHERE id%2=0 AND nonota='$d3[nomor]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansi.php?nokwitansi=<?echo $d3[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=lunas3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d3[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d3[nokwitansi]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d3[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
												</tr>
												<!--
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="jaket" readonly style="width: 30%">
																		<option value='YA' <?if($d3[jaket]=='YA'){?>selected=""<?}?>>YA</option>
																		<option value='TIDAK' <?if($d3[jaket]=='TIDAK'){?>selected=""<?}?>>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><select class="form-control" name="bukuservice" readonly style="width: 30%">
																		<option value='YA' <?if($d3[bukuservice]=='YA'){?>selected=""<?}?>>YA</option>
																		<option value='TIDAK' <?if($d3[bukuservice]=='TIDAK'){?>selected=""<?}?>>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
					                    		<tr>
					                    			<td height="10px"></td>
					                    		</tr>
					                    		<tr>
					                    			<td><b>TERIMA DARI</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PELANGGAN</td>
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
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d3[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $_REQUEST[jenis]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d3[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                    <th style="padding:7px">NOMOR RANGKA</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$d3[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo "$d3[kodebarang] | $d3[namabarang] | $d3[varian]"?></td>
					                                    <td><?echo $d3[warna]?></td>
					                                    <td align="center"><?echo $d3[thnproduksi]?></td>
					                                    <td><?echo $dA[norangka]?></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
			                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'B2')
		{
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		
		$d1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan FROM tbl_pesanan WHERE id%2=0 AND nopesan='$d3[nomor]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
    	if($d3[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
    	if($d3[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
    	if($d3[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansi.php?nokwitansi=<?echo $d3[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=lunas3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $d3[nomor]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR KWITANSI</td>
					                    			<td>:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d3[nokwitansi]?>" style="width:30%" readonly/></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL KWITANSI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d3[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
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
					                    			<td>NAMA PELANGGAN</td>
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
					                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($d3[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
					                                    </div>
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>UNTUK</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="PENGEMBALIAN Uang Muka/UANG TITIPAN" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d3[keterangan]?>" class="form-control" style="width:70%" readonly></td>
					                    		</tr>
			                            	</table>
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$d3[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
					                            ?>
					                                <tr style="cursor:pointer">
					                                    <td><?echo "$d4[kodebarang] | $d4[namabarang] | $d4[varian]"?></td>
					                                    <td><?echo $d4[warna]?></td>
					                                    <td align="center"><?echo $d4[thnproduksi]?></td>
					                                </tr>
					                            <?
					                            	}
					                            ?>
					                            </tbody>
					                        </table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                        <?
			                        if($d3[status]!='2')
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B3')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
    	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
    	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
		
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansi_piutang.php?nokwitansi=<?echo $d1[nokwitansi]?>&status=1','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=lunas3"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR KWITANSI</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:30%" readonly/></td>
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
					                    			<td><input type="text" value="<?echo $_REQUEST[jenis]?>" class="form-control" style="width:100%" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KETERANGAN</td>
					                    			<td>:</td>
					                    			<td><input type="text" value="<?echo $d1[keterangan]?>" class="form-control" style="width:100%" readonly></td>
					                    		</tr>
			                            	</table>
			                            	<!--
											<table id="example2" class="table table-striped">
					                            <thead style="color:#666;font-size:13px">
					                                <tr>
					                                    <th style="padding:7px">BARANG</th>
					                                    <th style="padding:7px">WARNA</th>
					                                    <th style="padding:7px">TAHUN</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?
												$qA = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_REQUEST[nomor]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dA[idbarang]'"));
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
										<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'B3A')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi WHERE id%2=0 AND nokwitansi='$_REQUEST[nomor]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id%2=0 AND id='$d1[idpelanggan]'"));
		
    	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
    	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
    	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
		
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/kwitansi_tn.php?nokwitansi=<?echo $d1[nokwitansi]?>&status=1','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KASIR <small>KWITANSI &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Kwitansi</small></h4>
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NOMOR KWITANSI</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $d1[nokwitansi]?>" style="width:30%" readonly/></td>
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
					                    			<td><b>DITERIMA DARI</b></td>
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
					                    			<td><input type="text" value="<?echo $d1[keterangan]?>" class="form-control" style="width:100%" readonly></td>
					                    				<input type="hidden" name="nomor" value="<?echo $_REQUEST[nomor]?>">
					                    		</tr>
			                            	</table>
				                   	 	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                        <?
			                        if($d1[status]=='1'){
										if($d1[idpotkom]=="0"){
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_piutang WHERE id%2=0 AND id='$d1[nomor]'"));
											$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE id%2=0 AND jenis='piutang' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
											$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE id%2=0 AND jenis='pembayaran' AND idkaryawan='$dB[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
											
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
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>"><button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
				                        			</a>
									<?
													}
												}
											else{
									?>
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>"><button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Kwitansi</button>
				                        			</a>
									<?
												}
											}
										}
									?>
										<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
                    "bFilter": false,
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
            });
        </script>