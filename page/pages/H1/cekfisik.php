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
			                	<h4>GUDANG & PDI <small>DAFTAR CEK FISIK</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil.</p><p>1. Mohon Melanjutkan Ke Menu Update Penjualan Pada Bagian Kasir. Mohon Beritahu Pelanggan Untuk Ke Kasir.</p>
											<p>2. Mohon Melanjutkan Ke Sales Counter Untuk Mencetak Nota Jual.</p>";
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
	                           				<button type="submit" class="btn btn-danger"><i class="fa fa-list"></i> &nbsp; Riwayat Cek Fisik</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="13%">NO. PDI</th>
			                                    <th style="padding:7px" width="14%">NO. NOTA JUAL</th>
			                                    <th style="padding:7px" width="14%">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px" width="13%">QTY JUAL (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
			                            /*
										$q1 = mysql_query("SELECT * FROM tbl_notajual WHERE cekfisik='0' AND jnstransaksi IN ('CASH','KREDIT') AND (
																								nonota IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi='lunas') OR 
																								nopesan IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi='umuka'))
																								OR
																							cekfisik='0' AND jnstransaksi IN ('CASH TEMPO') AND (
																								nopesan IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi IN ('umuka','titip'))	
																								) ");
										*/
										$q1 = mysql_query("SELECT * FROM tbl_notajual WHERE 
																	(
																	cekfisik='0' AND 
																	jnstransaksi IN ('CASH','KREDIT') AND 
																		(
																		nonota IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi='lunas') OR 
																		nopesan IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi='umuka')
																		)
																	)
																OR
																	(
																	cekfisik='0' AND 
																	jnstransaksi IN ('CASH TEMPO') AND 
																		(
																		nopesan IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi IN ('umuka','titip')) OR 
																		nonota IN (SELECT nomor FROM tbl_kwitansi WHERE jnskwitansi='CASHTEMPO')	
																		)
																	)"
															);
																	
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_notajual_det WHERE nonota='$d1[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nopdi]?></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td align="right"><span style="padding-right:50%"><?echo $d3[qty]?></span></td>
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
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id='$_REQUEST[id]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		
		$dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE nomor='$dB[nopesan]' AND jnskwitansi='penambahan' AND status='0'"));
		if(!empty($dCek[id])){
			echo "<script>alert ('Cek Fisik Tidak Bisa Dilanjutkan, Karena Kwitansi Penambahan Uang Titipan/Uang Muka Belum Dicetak.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>GUDANG & PDI <small>CEK FISIK</small></h4>

					            <form name="cekfisik" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. PDI</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nopdi]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
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
				                    	</div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            
			                    	<?
	                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE nonota='$dB[nonota]' GROUP BY nonota"));
	                            	$qTemp  = mysql_query("SELECT * FROM tbl_notajual_det WHERE nonota='$dB[nonota]'");
	                            	?>	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
											<tr>
											<td>TNKB</td>
											<td>:</td>
											<td colspan="2"><input type="text" name="tnkb" value="<?echo $dB[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
											</tr>
				                    	<?
				                    	if(!empty($dB[ketreject]))
				                    		{
										?>
				                    		<tr>
				                    			<td valign="top">KETERANGAN TOLAK</td>
				                    			<td valign="top">:</td>
				                    			<td colspan="2"><textarea class="form-control" readonly=""><?echo $dB[ketreject]?></textarea></td>
				                    		</tr>
										<?
											}
				                    	?>
				                    	</table>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            <table width="100%" class="table table-striped">
			                    	<?
	                            	while($dTemp = mysql_fetch_array($qTemp))
			                    		{
										$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dTemp[norangka]'"));
										$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dTemp[idbarang]'"));
			                    	?>
		                            	
		                            	<tr><td>
		                            	<div class="col-xs-6">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">NOMOR RANGKA</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><?echo $dU[norangka]?></td>
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
					                    	<table width="100%">
					                    		<tr>
					                    			<td>NAMA CHECKER</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $_SESSION[nama]?>" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">NOMOR RANGKA</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="" width="1%"><input type="password" style="width:0%" name="norangka<?echo $dTemp[id]?>" class="form-control" maxlength="40" required=""></td>
					                    			<td colspan=""><i style="font-size:11px;color:red"><b> TARUH CURSOR DAN SCAN NOMOR RANGKA</b></i></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR MESIN</td>
					                    			<td>:</td>
					                    			<td colspan="1"><input type="password" style="width:0%" width="1%" name="nomesin<?echo $dTemp[id]?>" class="form-control" maxlength="20" required=""></td>
													<td colspan=""><i style="font-size:11px;color:red"><b> TARUH CURSOR DAN SCAN NOMOR MESIN</b></i></td>
												</tr>
					                    		<input type="hidden" name="bensinawal<?echo $dTemp[id]?>" value="1">
					                    		<!--
					                    		<tr>
					                    			<td>BENSIN AWAL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select name="bensinawal<?echo $dTemp[id]?>" class="form-control" style="width: 60%"  required="">
															<option value='1' <?if($dA[literawal]=='1'){?>selected=""<?}?>>1 LITER</option>
															<option value='2' <?if($dA[literawal]=='2'){?>selected=""<?}?>>2 LITER</option>
														</select></td>
					                    		</tr>
					                    		-->
			                            	</table>
				                    	</div>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="40%">ANAK KUNCI 2 PCS</td>
					                    			<td width="5%">:</td>
					                    			<td><label><input type='radio' name="anakkunci<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="anakkunci<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>SPION</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="spion<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="spion<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>ACCU</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="accu<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="accu<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TOOLKIT</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="toolkit<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="toolkit<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>HELM</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="helm<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="helm<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>ALAS KAKI</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="alaskaki<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="alaskaki<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="jaket<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="jaket<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="bukuservis<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="bukuservis<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>CEK FISIK 2 LBR</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="cekfisik<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> ADA</label></td>
					                    			<td><label><input type='radio' name="cekfisik<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KONDISI MOTOR</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' name="kondisimotor<?echo $dTemp[id]?>" class='flat-red' required='' value="1"> BAIK</label></td>
					                    			<td><label><input type='radio' name="kondisimotor<?echo $dTemp[id]?>" class='flat-red' required='' value="0"> TIDAK BAIK</label></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                    	<input type="hidden" name="idbarang<?echo $dTemp[id]?>" value="<?echo $d4[idbarang]?>">
				                    	<div class="clearfix"></div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	</td></tr>
		                            	
										<script>
										function validA()
											{
											if (document.cekfisik.norangka<?echo $dTemp[id]?>.value != '<?echo $dU[norangka]?>')
												{
												alert ("Cek Nomor Rangka, Karena Nomor Rangka Yang Diinput Tidak Sama.");	 	
												return false;		
												}	
											else if (document.cekfisik.nomesin<?echo $dTemp[id]?>.value != '<?echo $dU[nomesin]?>')
												{
												alert ("Cek Nomor Mesin, Karena Nomor Mesin Yang Diinput Tidak Sama.");	 	
												return false;		
												}	
											else
												{
												return true;	
												}
											}
										</script>
			                    	<?
			                    		}
			                    	?>
		                            </table>
		                            
				                    </div>
		                            	
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
							                    	
			                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
			                        	<button type="reset" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]"?>'"><i class="fa fa-refresh"></i> &nbsp;Bersihkan</button>
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
		
	else if ($submenu == 'save')
		{
        $tanggal  = date("Y-m-d");
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        
        $qTemp  = mysql_query("SELECT * FROM tbl_notajual_det WHERE nonota='$_REQUEST[nonota]'");
    	while($dTemp = mysql_fetch_array($qTemp))
    		{
    		$id 			= $dTemp[id];
			$idbarang 		= $dTemp[idbarang];
			$norangka		= $dTemp[norangka];
			//$norangka 		= $_REQUEST[norangka.$id];
			$nomesin 		= $_REQUEST[nomesin.$id];
			$accu 			= $_REQUEST[accu.$id];
			$alaskaki 		= $_REQUEST[alaskaki.$id];
			$anakkunci 		= $_REQUEST[anakkunci.$id];
			$helm 			= $_REQUEST[helm.$id];
			$spion 			= $_REQUEST[spion.$id];
			$toolkit 		= $_REQUEST[toolkit.$id];
			$jaket 			= $_REQUEST[jaket.$id];
			$bukuservis 	= $_REQUEST[bukuservis.$id];
			$cekfisik 		= $_REQUEST[cekfisik.$id];
			$bensinawal 	= $_REQUEST[bensinawal.$id];
			$kondisimotor 	= $_REQUEST[kondisimotor.$id];
			
			if($accu=='0' || $alaskaki=='0' || $anakkunci=='0' || $helm=='0' || $spion=='0' || $toolkit=='0' || $cekfisik=='0' || $kondisimotor=='0' || $jaket=='0' || $bukuservis=='0'){
				$ikesalahan = '1';
				}
			/*	
			echo "<script>alert ('Proses gagal $ikesalahan $accu.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			*/
			mysql_query("INSERT INTO tbl_cekfisik (
												nonota, 
												idbarang, 
												norangka, 
												nomesin, 
												tahun, 
												bulan, 
												tanggal, 
												user, 
												accu, 
												alaskaki, 
												anakkunci, 
												helm, 
												spion, 
												toolkit, 
												jaket, 
												bukuservis, 
												cekfisik, 
												bensinawal, 
												kondisimotor, 
												ikesalahan, 
												inputx) 
											VALUES (
												'$_REQUEST[nonota]', 
												'$idbarang', 
												'$norangka', 
												'$nomesin', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$_SESSION[id]', 
												'$accu', 
												'$alaskaki', 
												'$anakkunci', 
												'$helm', 
												'$spion', 
												'$toolkit', 
												'$jaket', 
												'$bukuservis', 
												'$cekfisik', 
												'$bensinawal', 
												'$kondisimotor', 
												'$ikesalahan', 
												NOW())
							");
			/* PENGURANG STOK AKSESORIS				
			if(!empty($helm)){
				mysql_query("UPDATE stok_helm SET helm=helm-1 WHERE nonota='$_REQUEST[nonota]'");
				}
			if(!empty($spion)){
				mysql_query("UPDATE stok_spion SET spion=spion-1 WHERE nonota='$_REQUEST[nonota]'");
				}
			if(!empty($accu)){
				mysql_query("UPDATE stok_accu SET accu=accu-1 WHERE nonota='$_REQUEST[nonota]'");
				}
			if(!empty($toolkit)){
				mysql_query("UPDATE stok_toolkit SET toolkit=toolkit-1 WHERE nonota='$_REQUEST[nonota]'");
				}
			if(!empty($alaskaki)){
				mysql_query("UPDATE stok_alaskaki SET alaskaki=alaskaki-1 WHERE nonota='$_REQUEST[nonota]'");
				}
			*/	
			mysql_query("INSERT INTO tbl_bensin (
												jenis,
												tanggal,
												keterangan,
												jumlah) 
											VALUES (
												'OUTPUT',
												CURDATE(),
												'CEK FISIK NO. NOTA JUAL $_REQUEST[nonota] NO RANGKA $norangka',
												'$bensinawal')");
    		}
    					
		$q2 = mysql_query("UPDATE tbl_notajual SET cekfisik='1',iduserpdi='$_SESSION[id]' WHERE nonota='$_REQUEST[nonota]'");
							
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_cekfisik',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH CEK FISIK $_REQUEST[nonota]')
							");
		
		echo "			
		<script type='text/javascript'>
			window.open('print/cekfisik.php?nonota=$_REQUEST[nonota]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
			
		if($q2 && $q3)
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
			                	<h4>GUDANG & PDI <small>RIWAYAT CEK FISIK</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA JUAL / NO. PDI / NAMA PELANGGAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i> &nbsp; Daftar Cek Fisik</button>
										</a>
	                           		</div>
									<table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">NO. PDI</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">CHECKER PDI</th>
			                                    <th style="padding:7px" width="13%">QTY JUAL (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE cekfisik='1' AND nonota LIKE '%$_REQUEST[cari]%' OR nopdi LIKE '%$_REQUEST[cari]%' OR nama LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE cekfisik='1' ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_notajual_det WHERE nonota='$d1[nonota]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d1[iduserpdi]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo $d1[nopdi]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td><?echo $d4[nama]?></td>
			                                    <td align="right"><span style="padding-right:50%"><?echo $d3[qty]?></span></td>
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
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduserpdi]'"));
?>

			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('print/cekfisik.php?nonota=<?echo $dB[nonota]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>GUDANG & PDI <small>CEK FISIK</small></h4>

					            	<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 60%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. PDI</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 60%" value="<?echo $dB[nopdi]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL CEK FISIK</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($d5[tanggal]))?>" style="width: 60%" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" style="width: 100%" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
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
				                    	</div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            
			                    	<?
	                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE nonota='$dB[nonota]' GROUP BY nonota"));
	                            	$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'");
	                            	?>	
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
				                    	</table>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
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
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  readonly="">
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
		                            	
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Cek Fisik</button>
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
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