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
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ADMINISTRASI <small>DAFTAR PENGELUARAN UNIT</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Mohon Cetak Surat Jalan Di Menu Konfirmasi Surat Jalan Pada Bagian Administrasi, Dan Mohon Ingatkan Driver Untuk Melakukan Konfirmasi Ke Menu Konfirmasi Surat Jalan.</p>";
											}
										if($_REQUEST[note]=="2")
											{
											$ket = "<p>Proses Berhasil, Mohon Cetak Surat Jalan Dan Konfirmasi Surat Jalan Di Menu Konfirmasi Surat Jalan Pada Bagian Administrasi.</p>";
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
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-danger"><i class="fa fa-list"></i> &nbsp; Riwayat Pengeluaran Unit</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">NAMA SALES</th>
			                                    <th style="padding:7px">NAMA PDI</th>
			                                    <th style="padding:7px">QTY JUAL (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notajual WHERE status='1' AND cekfisik='1' AND adm='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_pesanan_det WHERE nopesan='$d1[nopesan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE nopesan='$d1[nopesan]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d1[iduserpdi]'"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d4[idsales]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td><?echo $d6[nama]?></td>
			                                    <td><?echo $d5[nama]?></td>
			                                    <td width="8%" align="right"><span style="padding-right:50%"><?echo $d3[qty]?></span></td>
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
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduserpdi]'"));
		$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE nopesan='$dB[nopesan]'"));
		$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d7[idsales]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ADMINISTRASI <small>PENGELUARAN UNIT</small></h4>
			                	
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL NOTA PENJUALAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo date("d-m-Y",strtotime($dB[tglnota]))?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA SALES / COUNTER</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d8[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER PDI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA PELANGGAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
			                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%"><b>DATA BPKB</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea  maxlength="100" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            
				                    	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE nonota='$dB[nonota]' GROUP BY nonota"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'");
		                            	?>	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
								    		<tr>
								    			<td>TNKB</td>
								    			<td>:</td>
								    			<td colspan="2"><input type="text" name="tnkb" value="<?echo $dB[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
								    		</tr>
				                    		<tr>
				                    			<td width="30%">DETAIL BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<div id="spoiler2" style="display:none">
		                            	
			                            <table width="100%" class="table table-striped">
				                    	<?
		                            	while($dTemp = mysql_fetch_array($qTemp))
				                    		{
											$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dTemp[norangka]'"));
											$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dTemp[idbarang]'"));
											$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det WHERE norangka='$dTemp[norangka]'"));
											$dD   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_grossubsidi WHERE status='1'"));
				                    	?>
			                            	
			                            	<tr><td>
			                            	<div class="col-xs-6">
						                    	<table width="80%">
						                    		<tr>
						                    			<td width="40%">NOMOR RANGKA</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><?echo $dTemp[norangka]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR MESIN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dU[nomesin]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KODE BARANG</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dA[kodebarang]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA BARANG</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dA[namabarang]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>BENSIN AWAL</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dTemp[bensinawal]?> LITER</td>
						                    		</tr>
						                    		<tr>
						                    			<td>VARIAN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dA[varian]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>WARNA</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dA[warna]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TAHUN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dA[thnproduksi]?></td>
						                    		</tr>
												</table>
					                    	</div>
					                    	
			                            	<div class="col-xs-6">
						                    	<table width="80%">
						                    		<tr>
						                    			<td width="40%">ANAK KUNCI 2 PCS </td>
						                    			<td width="5%">:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>SPION</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>ACCU</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TOOLKIT</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>HELM</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>ALAS KAKI</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>JAKET</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[jaket]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[jaket]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>BUKU SERVIS</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[bukuservis]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[bukuservis]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>CEK FISIK 2 LBR</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='1'){?>checked=""<?}?>> ADA</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
						                    		</tr>
						                    		<tr>
						                    			<td>KONDISI MOTOR</td>
						                    			<td>:</td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='1'){?>checked=""<?}?>> BAIK</label></td>
						                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='0'){?>checked=""<?}?>> TIDAK BAIK</label></td>
						                    		</tr>
				                            	</table>
					                    	</div>
					                    	<div class="clearfix"></div>
			                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	</td></tr>
				                    	<?
				                    		}
				                    	?>
			                            </table>
					                </div>
					                
					            	<form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
				                    	
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td height="40px"><b>PENGAMBILAN STNK</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="35%">NAMA 1</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="namaambilstkn1" class="form-control" maxlength="40" required=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELP / HP 1</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tlpambilstkn1" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA 2</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="namaambilstkn2" class="form-control" maxlength="40"></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELP / HP 2</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="tlpambilstkn2" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td height="40px"><b>PENGAMBILAN BPKB</b></td>
					                    		</tr>
					                    		<?
					                    		if($dB[jnstransaksi]=='KREDIT')
					                    			{
												?>
						                    		<tr>
						                    			<td width="35%">NAMA 1</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" name="namaambilbpkb" value="<?echo $d3[namaleasing]?>" class="form-control" maxlength="40" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. TELP / HP 1</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tlpambilbpkb" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
						                    		</tr>
						                    		<tr>
						                    			<td width="35%">NAMA 2</td>
						                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="namaambilbpkb2" class="form-control" maxlength="40"</td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. TELP / HP 2</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tlpambilbpkb2" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
						                    		</tr>
					                    		<?
					                    			}
					                    		else if($dB[jnstransaksi]=='CASH TEMPO' && $dB[jnscashtempo]=='LEASING')
					                    			{
												?>
						                    		<tr>
						                    			<td width="35%">NAMA 1</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" name="namaambilbpkb" value="<?echo $d3[namaleasing]?>" class="form-control" maxlength="40" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. TELP / HP 1</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tlpambilbpkb" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
						                    		</tr>
						                    		<tr>
						                    			<td width="35%">NAMA 2</td>
						                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="namaambilbpkb2" class="form-control" maxlength="40"></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. TELP / HP 2</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tlpambilbpkb2" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
						                    		</tr>
					                    		<?
					                    			}
					                    		else
					                    			{
												?>
						                    		<tr>
						                    			<td width="35%">NAMA 1</td>
						                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="namaambilbpkb" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" required=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. TELP / HP 1</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tlpambilbpkb" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20" required=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td width="35%">NAMA 2</td>
						                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="namaambilbpkb2" class="form-control" maxlength="40"></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NO. TELP / HP 2</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" name="tlpambilbpkb2" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20"></td>
						                    		</tr>
					                    		<?
													}
												?>
			                            	</table>
				                    	</div>
			                            	
		                            	<div class="col-xs-12" style="margin-top:10px">
		                            	<div style="border-bottom:1px #aaa dashed;margin-bottom:10px"></div>
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">TANGGAL KELUAR</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" name="tanggal" style="width: 25%" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PENYERAHAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" name="penyerahan" required style="width: 50%">
																	<option value='' selected="">Pilih</option>
																	<option value='KIRIM'>KIRIM</option>
																	<option value='BAWA SENDIRI'>BAWA SENDIRI</option>
														</select></td>
					                    		</tr>
					                    		<?
					                    		if($dB[jnstransaksi]=='KREDIT' OR ($dB[jnstransaksi]=='CASH TEMPO' && $dB[jnscashtempo]=='LEASING'))
					                    			{
												?>
						                    		<tr>
						                    			<td>ANGSURAN</td>
						                    			<td>:</td>
						                    			<td colspan="2">
						                                    <div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" name="angsuran" class="form-control uang" placeholder="0" style="width:34%;text-align:right" required="">
						                                    </div>
								                        </td>
						                    		</tr>
						                    		<tr>
						                    			<td>MASA ANGSURAN</td>
						                    			<td>:</td>
						                    			<td width="15%">
						                                    <div class="input-group">
						                                        <input type="text" name="termin" value="<?echo $dB[termin]?>" class="form-control" style="width:100%" onkeypress="return buat_angka(event,'0123456789')">
						                                        <span class="input-group-addon">Kali</span>
						                                    </div>
						                                </td>
						                    			<td colspan="1"></td>
						                    		</tr>
												<?
													}
					                    		?>
					                    	</table>
					               		</div>
					               	<?
									$p_tahun  = date("Y");
									$p_tahun2 = date("y");
									$p_bulan  = date("m");
									$p_tgl    = date("d");
										
							        $dSJ = mysql_fetch_array(mysql_query("SELECT nosj FROM tbl_pengeluaranunit WHERE tanggal=CURDATE() GROUP BY nosj ORDER BY SUBSTR(nosj,-3,3) DESC LIMIT 1"));
							            
									if(empty($dSJ[nosj]))
										{
										$dig3=1;
										$dig2=0;
										$dig1=0;	
										}
									else
										{
										$x=substr("$dSJ[nosj]",-3,3);
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
										
										$nosj = "SJ$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
					               	?>
					                <div class="clearfix"></div>
			                        <div class="modal-footer">
				                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
				                    	<input type="hidden" name="nosj" value="<?echo $nosj?>">
				                    	<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>">
				                    	
			                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                	</form>
				                	</div>
				                </div>
				            </div>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
		
	else if ($submenu == 'save')
		{
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
		
		$angsuran  		= preg_replace( "/[^0-9]/", "",$_REQUEST['angsuran']);
		
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id='$_REQUEST[id]'"));
		$dC = mysql_fetch_array(mysql_query("SELECT otr FROM tbl_notajual_det WHERE nonota='$_REQUEST[nonota]'"));
			
		$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dB[idleasing]'"));
		$dE = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det_pesanan_vw WHERE nonota='$_REQUEST[nonota]'"));
		if($tanggal < $dB[tglnota])
			{
			echo "<script>alert ('Mohon Ulangi Tanggal Yang Diinput, Karena Tanggal Keluar Tidak BOoleh Melebihi Tanggal Nota Jual.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		if($dC[otr] < $angsuran)
			{
			echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Angsuran melebihi OTR.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		if($angsuran=="0")
			{
			echo "<script>alert ('Angsuran Tidak Boleh Nol (0).')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
        if($dB[jnstransaksi]=='KREDIT' || ($dB[jnstransaksi]=='CASH TEMPO' && $dB[jnscashtempo]=='LEASING'))
        	{
			mysql_query("INSERT INTO tbl_hleasing VALUES (										
			                                    '',
			                                    '$dB[idpelanggan]',
			                                    '$dD[kodeleasing]',
			                                    '$dE[namabarang]',
			                                    '$_REQUEST[termin]',
			                                    CURDATE(),
			                                    '1')
									");
			}
		
		$namaambilstkn1 = strtoupper($_REQUEST[namaambilstkn1]);
		$tlpambilstkn1	= strtoupper($_REQUEST[tlpambilstkn1]);
		$namaambilstkn2	= strtoupper($_REQUEST[namaambilstkn2]);
		$tlpambilstkn2	= strtoupper($_REQUEST[tlpambilstkn2]);
		$namaambilbpkb	= strtoupper($_REQUEST[namaambilbpkb]);
		$namaambilbpkb2	= strtoupper($_REQUEST[namaambilbpkb2]);
		$tlpambilbpkb	= strtoupper($_REQUEST[tlpambilbpkb]);
		$tlpambilbpkb2	= strtoupper($_REQUEST[tlpambilbpkb2]);
        
		$q1 = mysql_query("INSERT INTO tbl_pengeluaranunit (
													tahun, 
													bulan, 
													tanggal, 
													nonota, 
													nosj, 
													user, 
													namaambilstkn1, 
													tlpambilstkn1, 
													namaambilstkn2, 
													tlpambilstkn2, 
													namaambilbpkb, 
													tlpambilbpkb, 
													namaambilbpkb2, 
													tlpambilbpkb2, 
													penyerahan, 
													angsuran, 
													termin, 
													inputx, 
													updatex) 
												VALUES (
													'$tahun', 
													'$bulan', 
													'$tanggal', 
													'$_REQUEST[nonota]', 
													'$_REQUEST[nosj]', 
													'$_SESSION[id]', 
													'$namaambilstkn1', 
													'$tlpambilstkn1', 
													'$namaambilstkn2', 
													'$tlpambilstkn2', 
													'$namaambilbpkb', 
													'$tlpambilbpkb',  
													'$namaambilbpkb2', 
													'$tlpambilbpkb2', 
													'$_REQUEST[penyerahan]', 
													'$angsuran', 
													'$_REQUEST[termin]', 
													NOW(), 
													'$updatex')
							");

		$qT = mysql_query("SELECT * FROM tbl_notajual_det WHERE nonota='$_REQUEST[nonota]'");
		while($dT=mysql_fetch_array($qT))
			{
			mysql_query("INSERT INTO tbl_stnkbpkb (nonota,idbarang,norangka) VALUES ('$_REQUEST[nonota]','$dT[idbarang]','$dT[norangka]')");
			}
		$q2 = mysql_query("UPDATE tbl_notajual SET adm='1',iduseradm='$_SESSION[id]',angsuran='$angsuran',termin='$_REQUEST[termin]' WHERE nonota='$_REQUEST[nonota]'");
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_pengeluaranunit',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH PENGELUARAN UNIT $_REQUEST[nonota]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('print/bast.php?nonota=$_REQUEST[nonota]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			
		if($q1 && $q2 && $q3)
			{
			if($_REQUEST[penyerahan]=="KIRIM")
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
				}
			else
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=2'/>";
				}
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
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
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ADMINISTRASI <small>RIWAYAT PENGELUARAN UNIT</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA JUAL / NAMA PELANGGAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i> &nbsp; Daftar Pengeluaran Unit</button>
										</a>
											<button type="button"  onclick="window.open('print/h1/pengeluaranunit.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
									<table id="example3" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. SURAT JALAN</th>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL KELUAR</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">NAMA SALES</th>
			                                    <th style="padding:7px">NAMA PDI</th>
			                                    <th style="padding:7px">QTY JUAL (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE status='1' AND cekfisik='1' AND adm='1' AND (nonota LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE status='1' AND cekfisik='1' AND adm='1' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_pesanan_det WHERE nopesan='$d1[nopesan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE nopesan='$d1[nopesan]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d1[iduserpdi]'"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$d1[nonota]'"));
			                            	$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d4[idsales]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td><?echo $d6[nosj]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d6[tanggal]))?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d7[nama]?></td>
			                                    <td><?echo $d5[nama]?></td>
			                                    <td><?echo $d3[qty]?></td>
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
		
	else if($submenu == 'view')
		{
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id='$_REQUEST[id]'"));
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE nopesan='$dB[nopesan]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE norangka='$dB[norangka]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduserpdi]'"));
		
		$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE nonota='$dB[nonota]'"));
		$d9 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduseradm]'"));
		
		$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE nopesan='$dB[nopesan]'"));
		$d10 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d7[idsales]'"));
?>

			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('print/bast.php?nonota=<?echo $dB[nonota]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ADMINISTRASI <small>PENGELUARAN UNIT</small></h4>
			                	
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL NOTA PENJUALAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo date("d-m-Y",strtotime($dB[tglnota]))?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA SALES / COUNTER</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d10[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER PDI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA PELANGGAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
				                    			<td width="1%"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
				                    	<div id="spoiler" style="display:none">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR OHC</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELEPON</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea maxlength="100" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d1[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="2" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
					                    			<td colspan="2"><input type="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PEKERJAAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
					                    		</tr>
			                            	</table>
			                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%"><b>DATA BPKB</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">NAMA PELANGGAN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea  maxlength="100" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d2[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d2[kodekab]-$d2[kodekec]-$d2[namakec]"?>' ><?echo $d2[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d2[kodekel]-$d2[namakel]"?>' ><?echo $d2[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            
				                    	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE nonota='$dB[nonota]' GROUP BY nonota"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'");
		                            	?>	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    		<tr>
								    			<td>TNKB</td>
								    			<td>:</td>
								    			<td colspan="2"><input type="text" name="tnkb" value="<?echo $dB[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
								    		</tr>
				                    		<tr>
				                    			<td width="30%">DATA TRANSAKSI BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
			                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<div id="spoiler2" style="display:none">
				                            <table width="100%" class="table table-striped">
					                    	<?
			                            	while($dTemp = mysql_fetch_array($qTemp))
					                    		{
												$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dTemp[norangka]'"));
												$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dTemp[idbarang]'"));
					                    	?>
				                            	
				                            	<tr><td>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">NOMOR RANGKA</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><?echo $dTemp[norangka]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NOMOR MESIN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dU[nomesin]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>KODE BARANG</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[kodebarang]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NAMA BARANG</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[namabarang]?></td>
							                    		</tr>
					                            	</table>
						                    	</div>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">VARIAN</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><?echo $dA[varian]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>WARNA</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[warna]?></td>
							                    		</tr>
							                    		<tr>
							                    			<td>TAHUN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><?echo $dA[thnproduksi]?></td>
							                    		</tr>
					                            	</table>
						                    	</div>
						                    	<div class="clearfix" style="border-bottom:1px #eee dashed;margin:0 10px; margin-bottom:5px"></div>
						                    	
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">NOMOR RANGKA</td>
							                    			<td width="2%">:</td>
							                    			<td colspan="2"><input type="text" value="<?echo $dTemp[norangka]?>" class="form-control" maxlength="40" readonly=""></td>
							                    		</tr>
							                    		<tr>
							                    			<td>NOMOR MESIN</td>
							                    			<td>:</td>
							                    			<td colspan="2"><input type="text" value="<?echo $dU[nomesin]?>" class="form-control" maxlength="20" readonly=""></td>
							                    		</tr>
							                    		<tr>
							                    			<td>BENSIN AWAL</td>
							                    			<td>:</td>
							                    			<td colspan="2"><select class="form-control" style="width: 60%"  disabled="">
																	<option value='1' <?if($dTemp[bensinawal]=='1'){?>selected=""<?}?>>1 LITER</option>
																	<option value='2' <?if($dTemp[bensinawal]=='2'){?>selected=""<?}?>>2 LITER</option>
																</select></td>
							                    		</tr>
					                            	</table>
						                    	</div>
				                            	<div class="col-xs-6">
							                    	<table width="80%">
							                    		<tr>
							                    			<td width="40%">ANAK KUNCI 2 PCS </td>
							                    			<td width="5%">:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[anakkunci]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>SPION</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[spion]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>ACCU</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[accu]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>TOOLKIT</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[toolkit]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>HELM</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[helm]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>ALAS KAKI</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[alaskaki]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>JAKET</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[jaket]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[jaket]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>BUKU SERVIS</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[bukuservis]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[bukuservis]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>CEK FISIK 2 LBR</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='1'){?>checked=""<?}?>> ADA</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[cekfisik]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
							                    		</tr>
							                    		<tr>
							                    			<td>KONDISI MOTOR</td>
							                    			<td>:</td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='1'){?>checked=""<?}?>> BAIK</label></td>
							                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($dTemp[kondisimotor]=='0'){?>checked=""<?}?>> TIDAK BAIK</label></td>
							                    		</tr>
					                            	</table>
						                    	</div>
						                    	<input type="hidden" name="idbarang<?echo $dTemp[id]?>" value="<?echo $d4[idbarang]?>">
						                    	<div class="clearfix"></div>
				                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
				                            	</td></tr>
					                    	<?
					                    		}
					                    	?>
				                            </table>
		                            	</div>
		                            	
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td height="40px"><b>PENGAMBILAN STNK</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="35%">NAMA 1</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[namaambilstkn1]?>" class="form-control" maxlength="40" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELP / HP 1</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[tlpambilstkn1]?>" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA 2</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[namaambilstkn2]?>" class="form-control" maxlength="40" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELP / HP 2</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[tlpambilstkn2]?>" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td height="40px"><b>PENGAMBILAN BPKB</b></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="35%">NAMA 1</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[namaambilbpkb]?>" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELP / HP 1</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[tlpambilbpkb]?>" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="35%">NAMA 2</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[namaambilbpkb2]?>" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELP / HP 2</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d8[tlpambilbpkb2]?>" onkeypress="return buat_angka(event,'1234567890')" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
			                            	</table>
				                    	</div>
			                            	
		                            	<div class="col-xs-12" style="margin-top:10px">
		                            	<div style="border-bottom:1px #aaa dashed;margin-bottom:10px"></div>
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">TANGGAL KELUAR</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo date('d-m-Y',strtotime($d8[tanggal]))?>" style="width: 25%" class="form-control" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA ADMINISTRASI</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d9[nama]?>" style="width: 50%" class="form-control" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PENYERAHAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" disabled="" style="width: 50%">
																	<option value='KIRIM' <?if($d8[penyerahan]=='KIRIM'){?>selected=""<?}?>>KIRIM</option>
																	<option value='BAWA SENDIRI' <?if($d8[penyerahan]=='BAWA SENDIRI'){?>selected=""<?}?>>BAWA SENDIRI</option>
														</select></td>
					                    		</tr>
					                    		<?
					                    		if($dB[jnstransaksi]=='KREDIT')
					                    			{
												?>
						                    		<tr>
						                    			<td>ANGSURAN</td>
						                    			<td>:</td>
						                    			<td colspan="2">
						                                    <div class="input-group">
						                                        <span class="input-group-addon">RP.</span>
						                                        <input type="text" value="<?echo number_format($dB[angsuran],"0","",".")?>" class="form-control uang" value="0" style="width:34%;text-align:right" readonly="">
						                                    </div>
								                        </td>
						                    		</tr>
						                    		<tr>
						                    			<td>MASA ANGSURAN</td>
						                    			<td>:</td>
						                    			<td colspan="2"> <input type="text" value="<?echo number_format($dB[termin],"0","",".")?> KALI" class="form-control uang" value="0" style="width:25%;" readonly=""></td>
						                    		</tr>
												<?
													}
					                    		?>
					                    	</table>
					               		</div>
					                
			                        <div class="clearfix"></div>
			                        <div class="modal-footer">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak BAST</button>
				                    	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example4').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
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