<?
	if($submenu == 'save')
		{
		mysql_query("UPDATE x23_notajual SET totalqty='$_REQUEST[tqty]',totdiskon='$_REQUEST[ttotdiskon]',tothargabelibersih='$_REQUEST[ttothargabelibersih]',grandtotal='$_REQUEST[ttotal]' WHERE nonota='$_REQUEST[nonota]'");
		mysql_query("UPDATE x23_kwitansi SET jumlah='$_REQUEST[ttotal]' WHERE nomor='$_REQUEST[nonota]'");
		
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=A&note=1'/>";
		exit();
		}
		
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
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>RIWAYAT PENJUALAN</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Ubah Detail Penjualan Berhasil. Proses Dilanjutkan Ke Menu Kwitansi Penjualan Pada Bagian Kasir.</p>
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
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA JUAL / NAMA PELANGGAN / STATUS..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/historyjual.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px" width="35%">NAMA PELANGGAN</th>
			                                    <th style="padding:7px" width="12%">TOTAL QTY JUAL</th>
			                                    <th style="padding:7px" width="20%">GRAND TOTAL (RP)</th>
			                                    <th style="padding:7px" width="1%">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_vw WHERE ket LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_vw ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Lunas</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'>Lunas</span>";}
			                            	
			                            	$dcek = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE nonota='$d1[nonota]' AND notaindent=''"));
			                            	if(!empty($dcek[id]) OR (empty($dcek[id]) && $d1[status]=="1"))
			                            		{
			                            ?>
				                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
				                                    <td><?echo $d1[nonota]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
				                                    <td><?echo $d1[nama]?></td>
				                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[totalqty])?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal])?></span></td>
				                                    <td align="center"><?echo $status?></td>
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
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE id='$_REQUEST[id]'"));
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Lunas</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'>Lunas</span>";}
			                            	
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>RIWAYAT PENJUALAN</small></h4>
			                	
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NOMOR NOTA JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $d1[nonota]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL NOTA JUAL</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" style="width: 20%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="30%">NAMA PELANGGAN</td>
			                    			<td width="2%">:</td>
			                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
			                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
			                    		</tr>
			                        	<tr>
			                        		<td>STATUS</td>
			                        		<td>:</td>
			                        		<td><?echo $status?></td>
			                        	</tr>
	                            	</table>
	                            	
			                    	<div id="spoiler" style="display:none">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR OHC</td>
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
				                    
	                            	<div style="overflow-x:auto;overflow-y:auto;">
				                        <table id="example2" class="table table-striped table-hover" style="width:150%">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th style="padding:7px">NO. NOTA BELI</th>
				                                    <th style="padding:7px">TGL NOTA BELI</th>
				                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
				                                    <th width="7%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
								                    <?
								                    if($d1[status]=='0'){
								                    ?>
				                                    	<th width="7%" style="padding:7px"><center>STOK TERKINI</center></th>
				                                    <?}?>
				                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
				                                    <th width="" style="padding:7px"><center>JUMLAH JUAL (RP)</center></th>
				                                    <th width="" style="padding:7px">GUDANG</th>
				                                    <th width="" style="padding:7px">RAK</th>
								                    <?
								                    if($d1[status]=='0'){
								                    ?>
				                                    <th width="1%" style="padding:7px"><center>UBAH</center></th>
				                                    <?}?>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, 
																											SUM(totdiskon) AS ttotdiskon,
																											SUM(tothargabelibersih) AS ttothargabelibersih
																											FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'"));
											
											$qE = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
											$qC = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
											$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
				                            while($dA = mysql_fetch_array($qA))
				                            	{
								                if($d1[status]=='0'){
					                            	$dCs = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE nonota='$dA[notabeli]' AND idgudang='$dA[idgudang]' AND idbarang='$dA[idbarang]' AND rak='$dA[rak]'"));
					                            	if($dCs[stok]<$dA[qty]){
														$red = "color:#ff0227";
														}
													else{$red="";}
													}
												$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$dA[notabeli]'"));
				                            ?>
							                    <tr style="cursor:pointer;<?echo $red?>">
				                                    <td><?echo $dA[kodebarang]?></td>
				                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
				                                    <td><?echo $dA[notabeli]?></td>
				                                    <td><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
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
									                    <?
									                    if($d1[status]=='0'){
									                    ?>
						                                    <td align="center">
							                                    <a data-toggle="modal" data-target="#compose-modalubah<?echo $dA[id]?>"><i class="fa fa-edit"></i></a>
						                                    </td>
						                                <?}?>
				                                </tr>
				                                
				                            <?
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                            	<tr>
				                            		<th colspan="4"></th>
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
				                            </tfoot>
				                        </table>
				                    </div>
			                        
				                    <?
				                    if($d1[status]=='0'){
				                    ?>
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
				                        </table>
				                    <?}?>
				                    
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
						                    <?
						                    if($d1[status]=='1'){
						                    ?>
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<?
						                    }if($d1[status]=='0'){
						                    ?>
				                				<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
				                					<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
				                					<input type="hidden" name="tqty" value="<?echo $dB[tqty]?>">
				                					<input type="hidden" name="ttotdiskon" value="<?echo $dB[ttotdiskon]?>">
				                					<input type="hidden" name="ttothargabelibersih" value="<?echo $dB[ttothargabelibersih]?>">
				                					<input type="hidden" name="ttotal" value="<?echo $dB[ttotal]?>">
													<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
												</form>
											<?}?>
										</div>
				                    </div>
			                    </div>
			                </div>
			            </div>
					<?
                    while($dE = mysql_fetch_array($qE))
                    	{
						if($_REQUEST[temp]==$dE[id])
							{
							$dcek = mysql_fetch_array(mysql_query("SELECT status FROM x23_kwitansi WHERE nomor='$_REQUEST[nonota]' AND jnskwitansi='penjualan'"));
							if($dcek[status]=='1'){
								echo "<script>alert ('Proses Gagal!')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}																 
																										 
							$id = $dE[id];
							//$tglnota = date("Y-m-d", strtotime($_REQUEST[tglnota.$id])); 
							$qx = explode("*", $_REQUEST[notabeli.$id]);
							$notabeli = $qx[0];
							$idbarang = $qx[1];
							$idgudang = $_REQUEST[idgudang.$id];
							$rak = $_REQUEST[rak.$id];
									
							$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$idbarang' AND nonota='$notabeli' AND idgudang='$idgudang' AND 
																										 rak='$rak'"));	
							
																																	
								//echo "<script>alert ('$dStok[stok].$idbarang.$idgudang.$rak.$tglnota.$_REQUEST[temp].$notabeli')</script>";
								//exit();
								
							if(empty($dStok[id])){
								echo "<script>alert ('Mohon Ulangi, Karena Nota Beli Dan Lokasi Untuk Barang Tersebut Tidak Ada!')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}
							else{				
								$qty = preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
								if($_REQUEST[optdis] == "1")
									{
									$diskon	= preg_replace( "/[^0-9]/", "",$_REQUEST['diskon2']);
									}
								if($_REQUEST[optdis] == "2")
									{
									$diskon	= ROUND((($dStok[hargajual]*$_REQUEST[diskon1])/100),0);
									}
								
								if($qty=='0')
									{
									echo "<script>alert ('Qty Tidak Boleh Nol (0)!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
									exit();
									}
									
								if($qty > $dStok[stok])
									{
									echo "<script>alert ('Mohon Ulangi, Karena Stok Untuk Nota Beli Tersebut Tidak Tersedia!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
									exit();
									}
								/*
								if($diskon > $dStok[hargajual]){
									//$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det_vw WHERE idbarang='$_REQUEST[idbarang]' AND tglnota='$tglnota' LIMIT 1,1"));
									echo "<script>alert ('Mohon Ulangi, Karena Diskon Melebihi Harga Jual!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
									exit();
									}
								*/
									
								$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE notaindent='$_REQUEST[noindent]' AND idbarang='$idbarang' AND 
																											   idgudang='$idgudang' AND rak='$rak' AND
																											   notabeli='$notabeli'"));
																																			
								//echo "<script>alert ('$dCek2[id].$idbarang.$idgudang.$rak.$tglnota.$_REQUEST[temp].$notabeli')</script>";
								//exit();
								/*						   
								if(!empty($dCek2[id]))
									{
									echo "<script>alert ('Barang Pada Lokasi Tersebut Sudah Ada Pada Detail Nota Jual!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
									exit();
									}
								*/
									
								$totdiskon			= $diskon*$qty;
								$tothargabelibersih	= $dStok[hargabelibersih]*$qty;
								$hargajual			= $dStok[hargajual]-$diskon;
								$jumlah				= $hargajual*$qty;
								
								$q1 = mysql_query("UPDATE x23_notajual_det SET
																	notabeli='$dStok[nonota]',
																	hargabelibersih='$dStok[hargabelibersih]',
																	hargajual='$dStok[hargajual]',
																	diskon='$diskon',
																	hargajualbersih='$hargajual',
																	qty='$qty',
																	totdiskon='$totdiskon',
																	tothargabelibersih='$tothargabelibersih',
																	total='$jumlah',
																	idgudang='$dStok[idgudang]',
																	rak='$dStok[rak]'
																WHERE 
																	id='$_REQUEST[temp]'
													");
								
			
								$dU = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal, 
																								SUM(totdiskon) AS ttotdiskon,
																								SUM(tothargabelibersih) AS ttothargabelibersih
																								FROM x23_notajual_det_vw WHERE nonota='$_REQUEST[nonota]'"));
										
								//echo "<script>alert ('$_REQUEST[nonota].$dU[tqty].$dU[nonota]')</script>";
								//exit();
																											
								mysql_query("UPDATE x23_notajual SET totalqty='$dU[tqty]',totdiskon='$dU[ttotdiskon]',tothargabelibersih='$dU[ttothargabelibersih]',grandtotal='$dU[ttotal]' WHERE nonota='$_REQUEST[nonota]'");
								mysql_query("UPDATE x23_kwitansi SET jumlah='$dU[ttotal]' WHERE nomor='$_REQUEST[nonota]'");
								
								
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
								exit();
								}
							}
                    	}
                    	
                    while($dC = mysql_fetch_array($qC))
                    	{
                    	$dCsC = mysql_fetch_array(mysql_query("SELECT stok FROM x23_stokpart WHERE nonota='$dC[notabeli]' AND idgudang='$dC[idgudang]' AND idbarang='$dC[idbarang]' AND rak='$dC[rak]'"));
                    ?>
<!-- ################## MODAL PILIH JUAL ########################################################################################## -->
				        <div class="modal fade " id="compose-modalubah<?echo $dC[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG <?//echo $dC[notabeli]?></h4>
				                    </div>
									
				                   	<form method="post" name="inpNJ<?echo $dC[id]?>" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="28%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width="" colspan="2"><select name="idbarang" class="form-control select1" onchange="populateSelectNJ1(this.value)" style="font-size:12px;padding:3px;width:100%" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw GROUP BY idbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[idbarang]?>" <?if($dC[idbarang]==$dA[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. NOTA BELI / TGL NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="notabeli<?echo $dC[id]?>" class="form-control select1" id="NJ2<?echo $dC[id]?>" style="font-size:12px;padding:3px;width: 50%" onchange="populateSelectNJ2<?echo $dC[id]?>(this.value)" required="">
													<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$dC[idbarang]' AND stok>'0' GROUP BY nonota,idbarang ORDER BY nonota");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo "$dA[nonota]*$dC[idbarang]"?>" <?if($dC[notabeli]==$dA[nonota]){?>selected=""<?}?>><?echo "$dA[nonota] | ".date("d-m-Y",strtotime($dA[tglnota]))?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>TANGGAL NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="tglnota<?echo $dC[id]?>" class="form-control select1" id="NJ3<?echo $dC[id]?>" style="font-size:12px;padding:3px;width: 50%" onchange="populateSelectNJ3<?echo $dC[id]?>(this.value)" disabled="">
													</select></td>
				                    		</tr>
				                    		-->
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang<?echo $dC[id]?>" class="form-control select1" id="NJ4<?echo $dC[id]?>" style="font-size:12px;padding:3px;width: 70%" onchange="populateSelectNJ4<?echo $dC[id]?>(this.value)" disabled="">
														<option ><?echo "$dC[gudang]"?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak<?echo $dC[id]?>" class="form-control select1" id="NJ5<?echo $dC[id]?>" style="font-size:12px;padding:3px;width: 50%" disabled="">
														<option ><?echo "$dC[rak]"?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY JUAL</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" value="<?echo number_format($dC[qty],"0","",".")?>" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                    		</tr>
											<script>
											function populateSelectNJ2<?echo $dC[id]?>(str)
												{
													if (str==""){
														document.getElementById("NJ4<?echo $dC[id]?>").value="";
														false;
													}
													if (window.XMLHttpRequest){
														xmlhttp=new XMLHttpRequest();
													}
													else{
														xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
													}
													xmlhttp.onreadystatechange=function()
													{
														if (this.readyState == 4)
														{
															if (this.status == 200)
															{
															document.getElementById("NJ4<?echo $dC[id]?>").innerHTML=xmlhttp.responseText;
															}
														}
													}
													xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ2"?>&q="+str,true);
													xmlhttp.send();
													
													pilihan = document.inpNJ<?echo $dC[id]?>.notabeli<?echo $dC[id]?>.value;
													if(pilihan==''){
													document.inpNJ<?echo $dC[id]?>.idgudang<?echo $dC[id]?>.disabled = 1;
													document.inpNJ<?echo $dC[id]?>.idgudang<?echo $dC[id]?>.required = 0;
													}else{
													document.inpNJ<?echo $dC[id]?>.idgudang<?echo $dC[id]?>.disabled = 0;
													document.inpNJ<?echo $dC[id]?>.idgudang<?echo $dC[id]?>.required = 1;
													}
												}
											function populateSelectNJ4<?echo $dC[id]?>(str)
												{
													if (str==""){
														document.getElementById("NJ5<?echo $dC[id]?>").value="";
														false;
													}
													if (window.XMLHttpRequest){
														xmlhttp=new XMLHttpRequest();
													}
													else{
														xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
													}
													xmlhttp.onreadystatechange=function()
													{
														if (this.readyState == 4)
														{
															if (this.status == 200)
															{
															document.getElementById("NJ5<?echo $dC[id]?>").innerHTML=xmlhttp.responseText;
															}
														}
													}
													xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ4"?>&q="+str,true);
													xmlhttp.send();
													
													pilihan = document.inpNJ<?echo $dC[id]?>.idgudang<?echo $dC[id]?>.value;
													if(pilihan==''){
													document.inpNJ<?echo $dC[id]?>.rak<?echo $dC[id]?>.disabled = 1;
													document.inpNJ<?echo $dC[id]?>.rak<?echo $dC[id]?>.required = 0;
													}else{
													document.inpNJ<?echo $dC[id]?>.rak<?echo $dC[id]?>.disabled = 0;
													document.inpNJ<?echo $dC[id]?>.rak<?echo $dC[id]?>.required = 1;
													}
												}
											function populateSelectNJ5<?echo $dC[id]?>(str)
												{
													if (str==""){
														document.getElementById("NJ6<?echo $dC[id]?>").value="";
														false;
													}
													if (window.XMLHttpRequest){
														xmlhttp=new XMLHttpRequest();
													}
													else{
														xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
													}
													xmlhttp.onreadystatechange=function()
													{
														if (this.readyState == 4)
														{
															if (this.status == 200)
															{
															document.getElementById("NJ6<?echo $dC[id]?>").innerHTML=xmlhttp.responseText;
															}
														}
													}
													xmlhttp.open("GET","<?echo "?opt=$opt&menu=$menu&submenu=NJ5"?>&q="+str,true);
													xmlhttp.send();
												}
											</script>
				                    		<?
		                           			if($d1[grup]=="0")
		                           				{
											?>	
												<script>
												function populateSelect(str)
												{
													pilihan = document.inpNJ<?echo $dC[id]?>.optdis.value;
													if(pilihan==''){
													document.inpNJ<?echo $dC[id]?>.diskon1.disabled = 1;
													document.inpNJ<?echo $dC[id]?>.diskon2.disabled = 0;
													}
													else if(pilihan=='1'){
													document.inpNJ<?echo $dC[id]?>.diskon1.disabled = 1;
													document.inpNJ<?echo $dC[id]?>.diskon2.disabled = 0;
													}else{
													document.inpNJ<?echo $dC[id]?>.diskon1.disabled = 0;
													document.inpNJ<?echo $dC[id]?>.diskon2.disabled = 1;
													}
												}
												</script>
					                    		<tr>
					                    			<td>DISKON</td>
					                    			<td>:</td>
					                    			<td colspan="2" width=""><select name="optdis" class="form-control" style="font-size:12px;padding:3px;width:8%" onchange="populateSelect(this.value)" required="">
																		<option value='1' selected>Rp.</option>
																		<option value='2' >%</option>
																    </select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td>
					                                    <div class="input-group">
					                                    	<input type="text" name="diskon1" style="width:100%;text-align:right" value="0" onfocus="this.select();" class="form-control uang" maxlength="12" onkeypress="return buat_angka(event,'1234567890')" disabled="">
					                                    	<span class="input-group-addon" style="width:40%;text-align:left">% Per PCS</span>
					                                    </div>
							                        </td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2" width="">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="width:15%">RP.</span>
					                                        <input type="text" name="diskon2" style="width:100%;text-align:right" value="0" onfocus="this.select();" class="form-control uang" maxlength="12" onkeypress="return buat_angka(event,'1234567890')" required>
					                                    	<span class="input-group-addon" style="width:30%;text-align:left">Per PCS</span>
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    	else{echo "<input type='hidden' name='diskon' value='0'>";}
					                    	?>
					                    	<input type="hidden" name="temp" value="<?echo $dC[id]?>">
					                    	<input type="hidden" name="nonota" value="<?echo $dC[nonota]?>">
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
					<?
						}
					?>
			        </div>
				</section>
			</aside>
<?
		}
		
	if($submenu == 'NJ1')
		{
		$q  = $_GET['q'];	
		$_SESSION[idbarang] = $q;
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$q' AND stok>'0' AND hargajual!='' GROUP BY nonota,idbarang ORDER BY nonota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[nonota]'>$d[nonota] | ".date("d-m-Y",strtotime($d[tglnota]))."</option>";
			}
		}
		
	if($submenu == 'NJ2')
		{
		$q  = $_GET['q']; 
		$qx = explode("*", $q);
		$q1 = $qx[0];
		$q2 = $qx[1];
		
		$_SESSION[notabeli] = $q1;	
		$_SESSION[idbarang] = $q2;
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND nonota='$q1' AND stok>'0' GROUP BY nonota,idbarang,tglnota ORDER BY tglnota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[idgudang]'>$d[gudang]</option>";
			//echo "<option value='$d[tglnota]'>".date("d-m-Y",strtotime($d[tglnota]))."</option>";
			}
		}
		
	if($submenu == 'NJ3')
		{
		$q  = $_GET['q'];
		$_SESSION[tglnota] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND  nonota='$_SESSION[notabeli]' AND tglnota='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota,gudang ORDER BY gudang");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[idgudang]'>$d[gudang]</option>";
			}
		}
		
	if($submenu == 'NJ4')
		{
		$q  = $_GET['q'];
		$_SESSION[idgudang] = $q;	
					
		echo "<option value=''>Pilih</option>";
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_SESSION[idbarang]' AND  nonota='$_SESSION[notabeli]' AND idgudang='$q' AND stok>'0' GROUP BY nonota,idbarang,tglnota,gudang,rak ORDER BY rak");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[rak]'>$d[rak] | $d[stok] PCS</option>";
			}
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
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>RIWAYAT PENJUALAN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI KODE BARANG / NAMA BARANG ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/historyjualbarang.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
									<table id="example1" class="table table-striped table-hover" style="width:160%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px" width="9%">HARGA JUAL (RP)</th>
			                                    <th style="padding:7px" width="4%">QTY JUAL</th>
			                                    <th style="padding:7px" width="9%">DISKON (RP)</th>
			                                    <th style="padding:7px" width="9%">GRAND TOTAL (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE (namabarang LIKE '%$_REQUEST[cari]%' OR kodebarang LIKE '%$_REQUEST[cari]%') AND substr(nonota,1,2)='NJ' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE substr(nonota,1,2)='NJ' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$d1[notabeli]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&nonota=$d1[nonota]"?>'">
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td><?echo $d1[notabeli]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual])?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo number_format($d1[qty])?> PCS</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[diskon])?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total])?></span></td>
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
		
	else if($submenu == 'D')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE nonota='$_REQUEST[nonota]'"));
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty, SUM(total) AS ttotal FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'"));
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Lunas</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'>Lunas</span>";}
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PENJUALAN <small>RIWAYAT PENJUALAN</small></h4>
			                	
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NOMOR NOTA JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $d1[nonota]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL NOTA JUAL</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" style="width: 20%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="30%">NAMA PELANGGAN</td>
			                    			<td width="2%">:</td>
			                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
			                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
			                    		</tr>
				                        	<tr>
				                        		<td>STATUS</td>
				                        		<td>:</td>
				                        		<td><?echo $status?></td>
				                        	</tr>
	                            	</table>
	                            	
			                    	<div id="spoiler" style="display:none">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NOMOR OHC</td>
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
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                	</div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                        <table id="example2" class="table table-striped table-hover" style="width:120%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
			                                    <th width="6%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
			                                    <th width="6%" style="padding:7px"><center>QTY JUAL</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH JUAL (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE nonota='$dA[notabeli]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td><?echo $dA[notabeli]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
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
			                            		<th colspan="4"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
			                            		<th colspan="3"></th>
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
        			
        <script>
        //SELECT2
			$(function(){
			  var select = $('.select1').select2();
			}); 
			$(document).ready(function() {});
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