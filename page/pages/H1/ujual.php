<script src="js/jquery.min.js"></script>	
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
			                	<h4>KASIR <small>UPDATE PENJUALAN</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil.</p><p>1. Mohon Melanjutkan Ke Sales Counter Untuk Mencetak Nota Jual.</p> 
											<p>2. Mohon Melanjutkan Ke Menu Pengeluaran Unit Pada Bagian Administrasi.</p>";
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
	                           		<!--
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-danger"><i class="fa fa-list"></i> &nbsp; Riwayat Update Nota Jual</button>
										</a>
									-->
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">JENIS TRANSAKSI</th>
			                                    <th style="padding:7px">LEASING</th>
			                                    <th style="padding:7px" width="13%">QTY JUAL (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notajual WHERE status='0' AND cekfisik='1'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_pesanan_det WHERE nopesan='$d1[nopesan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			                            	if(!empty($d4[namaleasing])){
												$leasing = $d4[namaleasing];
												}
											else{
												$leasing = "";
												}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td><?echo "$d1[jnstransaksi] $d1[jnscashtempo]"?></td>
			                                    <td><?echo $leasing?></td>
			                                    <td align="right"><span style="padding-right:50%"><?echo $d3[qty]?></span></td>
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
		$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE nopesan='$dB[nopesan]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dB[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dB[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$dB[nonota]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dB[iduserpdi]'"));
		
		if(!empty($_REQUEST[reject]))
			{
			$ketreject = strtoupper($_REQUEST[ketreject]);
			mysql_query("UPDATE tbl_notajual SET cekfisik='0',ketreject='$ketreject' WHERE id='$_REQUEST[reject]'");
			mysql_query("DELETE FROM tbl_cekfisik WHERE nonota='$_REQUEST[nonota]'");
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
			                	<h4>KASIR <small>KONFIRMASI NOTA JUAL</small></h4>

					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" class="form-control" style="width: 50%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TGL CEK FISIK</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($d5[tanggal]))?>" style="width: 40%" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
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
		                            	
				                    	<table width="70%" style="margin-top:10px">
				                    		<tr>
				                    			<td width="30%">JENIS TRANSAKSI</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" value="<?echo "$dB[jnstransaksi]"?>" class="form-control" style="width:100%" disabled=""></td>
				                    		</tr>
				                    		<?
				                    		if($dB[jnstransaksi]=='KREDIT')
				                    			{
											?>
					                    		<tr>
					                    			<td>LEASING</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo "$d3[namaleasing]"?>" class="form-control" style="width:100%" disabled=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>MASA ANGSURAN</td>
					                    			<td>:</td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <input type="text" value="<?echo "$dB[termin]"?>" class="form-control" style="width:100%;text-align:right" readonly="">
					                                        <span class="input-group-addon">Kali</span>
					                                    </div>
					                                </td>
					                    			<td colspan="1"></td>
					                    		</tr>
											<?	
												}
												
				                    		if($dB[jnstransaksi]=='CASH TEMPO')
				                    			{
											?>
					                    		<tr>
					                    			<td>JENIS CASH TEMPO</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo "$dB[jnscashtempo]"?>" class="form-control" style="width:75%" disabled=""></td>
					                    		</tr>
				                    		<?
					                    		if($dB[jnscashtempo]=='LEASING')
					                    			{
											?>
						                    		<tr>
						                    			<td>LEASING</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" value="<?echo "$d3[namaleasing]"?>" class="form-control" style="width:75%" disabled=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>MASA ANGSURAN</td>
						                    			<td>:</td>
						                    			<td width="15%">
						                                    <div class="input-group">
						                                        <input type="text" value="<?echo "$dB[termin]"?>" class="form-control" style="width:100%;text-align:right" readonly="">
						                                        <span class="input-group-addon">Kali</span>
						                                    </div>
						                                </td>
						                    			<td colspan="1"></td>
						                    		</tr>
						                    <?
						                    		}
					                    		if($dB[jnscashtempo]=='DEALER')
					                    			{
											?>
						                    		<tr>
						                    			<td>TANGGAL PELUNASAN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text" value="<?echo date("d-m-Y",strtotime($dC[tglpelunasan]))?>" class="form-control" style="width:35%" disabled=""></td>
						                    		</tr>
						                    <?
						                    		}
						                    	}
						                    ?>
				                    		<tr>
				                    			<td>TOTAL UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" value="<?echo number_format($dB[utitipan],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<?
				                    		if($dB[jnstransaksi]=='CASH')
				                    			{
											?>
					                    		<tr>
					                    			<td>TOTAL BAYAR</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text"  value="<?echo number_format($dB[bayar],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
					                    	<!--
				                    		<tr>
				                    			<td>SISA PEMBAYARAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text"  value="<?echo number_format($dB[sisabayar],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		-->
				                    		<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
				                    		<input type="hidden" name="tahun" value="<?echo $p_tahun?>">
				                    		<input type="hidden" name="bulan" value="<?echo $p_bulan?>">
				                    	</table>
		                            
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
										$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det WHERE norangka='$dTemp[norangka]'"));
										$dD   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_grossubsidi WHERE status='1'"));
			                    	?>
		                            	<tr><td>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="50%">OTR</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="otr<?echo $dTemp[id]?>" value="<?echo number_format($dC[otr],"0","",".")?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>POTONGAN</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" value="<?echo number_format($dC[disc],"0","",".")?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
				                    		<?
				                    		if($dB[jnstransaksi]=='KREDIT')
				                    			{
											?>
					                    		<tr>
					                    			<td>PAJAK MATRIX 1</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                    					<input type="text" name="matrix1<?echo $dTemp[id]?>" id="matrix1<?echo $dTemp[id]?>" value="<?echo $dD[matrix1]?>" maxlength="2" class="form-control" placeholder="0" style="width:100%;text-align:right" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                    				    <span class="input-group-addon" style="min-width:30px;text-align:center">%</span>
					                    				</div>
													</td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PAJAK MATRIX 2</td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                    					<input type="text" name="matrix2<?echo $dTemp[id]?>" id="matrix2<?echo $dTemp[id]?>" value="<?echo $dD[matrix2]?>" maxlength="2" class="form-control" placeholder="0" style="width:100%;text-align:right" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                    				    <span class="input-group-addon" style="min-width:30px;text-align:center">%</span>
					                    				</div>
													</td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PAJAK SUBSIDI 1</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                    					<input type="text" name="subsidi1<?echo $dTemp[id]?>" id="subsidi1<?echo $dTemp[id]?>" value="" maxlength="2" class="form-control" placeholder="0" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" required="">
					                    				    <span class="input-group-addon" style="min-width:30px;text-align:center">%</span>
					                    				</div>
													</td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PAJAK SUBSIDI 2</td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                    					<input type="text" name="subsidi2<?echo $dTemp[id]?>" id="subsidi2<?echo $dTemp[id]?>" value="" maxlength="2" class="form-control" placeholder="0" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" required="">
					                    				    <span class="input-group-addon" style="min-width:30px;text-align:center">%</span>
					                    				</div>
													</td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">GROSS</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="gross<?echo $dTemp[id]?>" id="gross<?echo $dTemp[id]?>" placeholder="0" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>MATRIX</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="matrix<?echo $dTemp[id]?>" id="matrix<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>MATRIX SETELAH PAJAK</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="matrixpajak<?echo $dTemp[id]?>" id="matrixpajak<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right"readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>SUBSIDI</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="subsidi<?echo $dTemp[id]?>" id="subsidi<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>SUBSIDI SETELAH PAJAK</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="subsidipajak<?echo $dTemp[id]?>" id="subsidipajak<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>BBN</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="bbn<?echo $dTemp[id]?>" id="bbn<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>OFF THE ROAD</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="offtheroad<?echo $dTemp[id]?>" id="offtheroad<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
												<!--
					                    		<tr>
					                    			<td>SCP AHM</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="scpahm<?echo $dTemp[id]?>" id="scpahm<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>SCP MD</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="scpmd<?echo $dTemp[id]?>" id="scpmd<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
												-->
					                    	<?
					                    		}
					                    		
				                    		if($dB[jnstransaksi]=='CASH TEMPO' && $dB[jnscashtempo]=='LEASING')
				                    			{
											?>
					                    		<tr>
					                    			<td>PAJAK MATRIX 1</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                    					<input type="text" name="matrix1<?echo $dTemp[id]?>" id="matrix1<?echo $dTemp[id]?>" value="<?echo $dD[matrix1]?>" maxlength="2" class="form-control" placeholder="0" style="width:100%;text-align:right" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                    				    <span class="input-group-addon" style="min-width:30px;text-align:center">%</span>
					                    				</div>
													</td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PAJAK MATRIX 2</td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                    					<input type="text" name="matrix2<?echo $dTemp[id]?>" id="matrix2<?echo $dTemp[id]?>" value="<?echo $dD[matrix2]?>" maxlength="2" class="form-control" placeholder="0" style="width:100%;text-align:right" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                    				    <span class="input-group-addon" style="min-width:30px;text-align:center">%</span>
					                    				</div>
													</td>
					                    			<td></td>
					                    		</tr>
					                    		<tr>
					                    			<td>MATRIX</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="matrix<?echo $dTemp[id]?>" id="matrix<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>MATRIX SETELAH PAJAK</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="matrixpajak<?echo $dTemp[id]?>" id="matrixpajak<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right"readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
					                    		<tr>
					                    			<td>SCP AHM</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="scpahm<?echo $dTemp[id]?>" id="scpahm<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>SCP MD</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="scpmd<?echo $dTemp[id]?>" id="scpmd<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>POTONGAN TAMBAHAN</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="komisi<?echo $dTemp[id]?>" id="komisi<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH UANG MASUK</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="jumlah<?echo $dTemp[id]?>" id="jumlah<?echo $dTemp[id]?>" class="form-control" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>BROKER</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="ref<?echo $dTemp[id]?>" id="ref<?echo $dTemp[id]?>" class="form-control" style="width:100%;" maxlength="40"></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. TELEPON BROKER</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="notelpref<?echo $dTemp[id]?>" id="ref<?echo $dTemp[id]?>" class="form-control" style="width:100%;" maxlength="20" onkeypress="return buat_angka(event,'0123456789-')"></td>
					                    		</tr>
					                    		<!--
					                    		<tr><td colspan="3">&nbsp;</td></tr>
					                    		<tr>
					                    			<td>JAKET</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" name="jaket<?echo $dTemp[id]?>" required style="width: 60%" required="">
																		<option value='' selected="">PILIH</option>
																		<option value='YA'>YA</option>
																		<option value='TIDAK'>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BUKU SERVIS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" name="bukuservice<?echo $dTemp[id]?>" required style="width: 60%" required="">
																		<option value='' selected="">PILIH</option>
																		<option value='YA'>YA</option>
																		<option value='TIDAK'>TIDAK</option>
														</select></td>
					                    		</tr>
					                    		-->
			                            	</table>
				                    	</div>
				                    	
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
				                    	<input type="hidden" name="norangka<?echo $dTemp[id]?>" value="<?echo $dTemp[norangka]?>">
				                    	<div class="clearfix"></div>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	</td></tr>
		                            	
		                            	
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
											
										function formatAngka(angka) {
											 if (typeof(angka) != 'string') angka = angka.toString();
											 var reg = new RegExp('([0-9]+)([0-9]{3})');
											 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
											 return angka;
											}
										
										$('#matrix<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#matrixpajak<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#scpahm<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#scpmd<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#komisi<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#gross<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#subsidi<?echo $dTemp[id]?>').on('keypress', function(e) {
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
										$('#bbn<?echo $dTemp[id]?>').on('keypress', function(e) {
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
			                    		<?
			                    		if($dB[jnstransaksi]=='KREDIT')
			                    			{
										?>
									        <script type="text/javascript">
											    $("#matrix<?echo $dTemp[id]?>").keyup(function(){
											        var matrix  = $("#matrix<?echo $dTemp[id]?>").val().replace(".","").replace(".","");	
											        var subsidi1 = $("#subsidi1<?echo $dTemp[id]?>").val();									        
											        var subsidi2 = $("#subsidi2<?echo $dTemp[id]?>").val();							        

											        var A  = Math.round(eval(matrix/1.1));
											        var B  = Math.round(eval(A-(A*<?echo $dD[matrix1]?>/100)));
											        var C  = Math.round(eval(A-(A*<?echo $dD[matrix2]?>/100)));
											        var D  = Math.round(eval(A-B+C));
											        
											        $("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(D));
											      });
											      
											    $("#subsidi<?echo $dTemp[id]?>").keyup(function(){
											        var subsidi  = $("#subsidi<?echo $dTemp[id]?>").val().replace(".","").replace(".","");		
											        var subsidi1 = $("#subsidi1<?echo $dTemp[id]?>").val();									        
											        var subsidi2 = $("#subsidi2<?echo $dTemp[id]?>").val();							        
											        var A  = eval(100+subsidi1);
											        var B  = Math.round(eval(subsidi*100/A));
											        var C  = Math.round(eval(B*subsidi1/100));
											        var D  = Math.round(eval(B*subsidi2/100));
											        var E  = Math.round(eval(subsidi-C-D));
											        
											        $("#subsidipajak<?echo $dTemp[id]?>").val(formatAngka(E));
											      });
											      
											    $("#komisi<?echo $dTemp[id]?>").keyup(function(){
											        var komisi  = $("#komisi<?echo $dTemp[id]?>").val().replace(".","").replace(".","");
											        
											        var jumlah  = eval(<?echo $dB[utitipan]-$dC[disc]?>-komisi);
											        
											        //$("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(B));
											        $("#jumlah<?echo $dTemp[id]?>").val(formatAngka(jumlah));
											      });
											      
											    $("#bbn<?echo $dTemp[id]?>").keyup(function(){
											        var bbn  = $("#bbn<?echo $dTemp[id]?>").val().replace(".","").replace(".","");
											        
											        var offtheroad  = eval(<?echo $dC[otrsetelahpajak]?>-bbn);
											        
											        //$("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(B));
											        $("#offtheroad<?echo $dTemp[id]?>").val(formatAngka(offtheroad));
											      });
									        </script>
									    <?
									    	}
			                    		else if($dB[jnstransaksi]=='CASH')
									    	{
										?>
									        <script type="text/javascript">
											    $("#komisi<?echo $dTemp[id]?>").keyup(function(){
											        var komisi  = $("#komisi<?echo $dTemp[id]?>").val().replace(".","").replace(".","");
											        
											        var jumlah  = eval(<?echo $dC[otr]-$dC[disc]?>-komisi);
											        
											        //$("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(B));
											        $("#jumlah<?echo $dTemp[id]?>").val(formatAngka(jumlah));
											      });
									        </script>
									    <?
											}
											
			                    		else if($dB[jnstransaksi]=='CASH TEMPO')
									    	{
									    	if($dB[jnscashtempo]=='DEALER')
									    		{
										?>
									       	 	<script type="text/javascript">
												    $("#komisi<?echo $dTemp[id]?>").keyup(function(){
												        var komisi  = $("#komisi<?echo $dTemp[id]?>").val().replace(".","").replace(".","");
												        
												        var jumlah  = eval(<?echo $dC[otr]-$dC[disc]?>-komisi);
												        
												        //$("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(B));
												        $("#jumlah<?echo $dTemp[id]?>").val(formatAngka(jumlah));
												      });
										        </script>
									    <?
									    		}
									    		
									    	if($dB[jnscashtempo]=='LEASING')
									    		{
										?>
									       	 	<script type="text/javascript">
												    $("#matrix<?echo $dTemp[id]?>").keyup(function(){
												        var matrix  = $("#matrix<?echo $dTemp[id]?>").val().replace(".","").replace(".","");									        
												        var A  = eval(100+<?echo $dD[matrix2]?>);
												        var B  = Math.round(eval(matrix*100/A));
												        var C  = Math.round(eval(B*<?echo $dD[matrix1]?>/100));
												        var D  = Math.round(eval(B*<?echo $dD[matrix2]?>/100));
												        var E  = Math.round(eval(B-C+D));
												        
												        $("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(E));
												      });
												      
												    $("#komisi<?echo $dTemp[id]?>").keyup(function(){
												        var komisi  = $("#komisi<?echo $dTemp[id]?>").val().replace(".","").replace(".","");
												        
												        var jumlah  = eval(<?echo $dB[utitipan]-$dC[disc]?>-komisi);
												        
												        //$("#matrixpajak<?echo $dTemp[id]?>").val(formatAngka(B));
												        $("#jumlah<?echo $dTemp[id]?>").val(formatAngka(jumlah));
												      });
										        </script>
									    <?
									    		}
											}
										?>
			                    	<?
			                    		}
			                    	?>
		                            </table>
		                            
				                    </div>
		                            	
			                        <div class="modal-footer clearfix">
				                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
				                    	<input type="hidden" name="idB" value="<?echo $_REQUEST[id]?>">
				                    	
			                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
			                        	<button type="button" data-toggle="modal" data-target="#compose-modal-reject" class="btn btn-warning pull-left"><i class="fa fa-times-circle"></i> &nbsp;Cek Unit Kembali</button>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
				                </form>
			                	</div>
			                </div>
			            </div>
			            
<!-- ################## MODAL DITOLAK  ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-reject" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">KETERANGAN TOLAK</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%" valign="top">KETERANGAN</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td><textarea name="ketreject" style="width: 99%" maxlength="100" class="form-control"></textarea></td>
				                    		</tr>
				                    		<input type="hidden" name="reject" value="<?echo $_REQUEST[id]?>">
				                    		<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->
			        </div>
				</section>
			</aside>
<?
		}
		
	else if ($submenu == 'save')
		{
        $qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE nonota='$_REQUEST[nonota]'");
    	while($dTemp = mysql_fetch_array($qTemp))
    		{
    		$id 		= $dTemp[id];
    		$norangka	= $_REQUEST[norangka.$id];
    		$gross 		= preg_replace( "/[^0-9]/", "",$_REQUEST[gross.$id]);
    		$matrix 	= preg_replace( "/[^0-9]/", "",$_REQUEST[matrix.$id]);
    		$matrix1 	= $_REQUEST[matrix1.$id];
    		$matrix2 	= $_REQUEST[matrix2.$id];
    		$matrixpajak= preg_replace( "/[^0-9]/", "",$_REQUEST[matrixpajak.$id]);
    		$subsidi 	= preg_replace( "/[^0-9]/", "",$_REQUEST[subsidi.$id]);
    		$subsidi1 	= $_REQUEST[subsidi1.$id];
    		$subsidi2 	= $_REQUEST[subsidi2.$id];
    		$subsidipajak= preg_replace( "/[^0-9]/", "",$_REQUEST[subsidipajak.$id]);
    		$scpahm 	= preg_replace( "/[^0-9]/", "",$_REQUEST[scpahm.$id]);
    		$scpmd 		= preg_replace( "/[^0-9]/", "",$_REQUEST[scpmd.$id]);
    		$komisi 	= preg_replace( "/[^0-9]/", "",$_REQUEST[komisi.$id]);
    		$bbn 		= preg_replace( "/[^0-9]/", "",$_REQUEST[bbn.$id]);
    		$offtheroad	= preg_replace( "/[^0-9]/", "",$_REQUEST[offtheroad.$id]);
    		$jumlah 	= preg_replace( "/[^0-9]/", "",$_REQUEST[jumlah.$id]);
    		$ref 		= strtoupper($_REQUEST[ref.$id]);
    		$notelpref	= strtoupper($_REQUEST[notelpref.$id]);
    		$jaket		= strtoupper($_REQUEST[jaket.$id]);
    		$bukuservice	= strtoupper($_REQUEST[bukuservice.$id]);
    		
    		$otr 	= preg_replace( "/[^0-9]/", "",$_REQUEST[otr.$id]);

    		
			if($gross=='0' || $matrix=='0' || $subsidi=='0')
				{
				echo "<script>alert ('Nominal Tidak Boleh 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			
			$dCnb = mysql_fetch_array(mysql_query("SELECT nonota FROM tbl_stokunit WHERE norangka='$dTemp[norangka]'"));
			if($dTemp[helm]=='1'){
				mysql_query("UPDATE stok_helm SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[spion]=='1'){
				mysql_query("UPDATE stok_spion SET jual=jual+2 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[accu]=='1'){
				mysql_query("UPDATE stok_accu SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[toolkit]=='1'){
				mysql_query("UPDATE stok_toolkit SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[alaskaki]=='1'){
				mysql_query("UPDATE stok_alaskaki SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[anakkunci]=='1'){
				mysql_query("UPDATE stok_anakkunci SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[jaket]=='1'){
				mysql_query("UPDATE stok_jaket SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			if($dTemp[bukuservis]=='1'){
				mysql_query("UPDATE stok_bukuservis SET jual=jual+1 WHERE nonota='$dCnb[nonota]'");
				}
			
			if($ref!='')
				{
				if($komisi =='0')
					{
					echo "<script>alert ('Potongan Tambahan Tidak Boleh 0 (Nol).')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
					exit();
					}
				if(empty($notelpref))
					{
					echo "<script>alert ('Nomor Telepon Referensi Tidak Boleh Kosong.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
					exit();
					}
				}
			if($komisi > 0)
				{
				if(empty($ref))
					{
					echo "<script>alert ('Mohon Ulangi, Karena Referensi Harus Diisi.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
					exit();
					}
				}
			if($_REQUEST[jumlah.$id] < 0)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal Potongan Tambahan Melebihi Sisa Uang Masuk.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			if($otr < $gross)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal Gross Melebihi OTR.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			if($otr < $matrix)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal Matrix Melebihi OTR.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			if($otr < $subsidi)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal Subsidi Melebihi OTR.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			if($otr < $scpahm)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal SCP AHM Melebihi OTR.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			if($otr < $scpmd)
				{
				echo "<script>alert ('Mohon Ulangi Nominal Yang Diinput, Karena Nominal SCP MD Melebihi OTR.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[idB]'/>";
				exit();
				}
			
			mysql_query("UPDATE tbl_notajual_det SET 
				 								gross='$gross',
				 								matrix='$matrix',
				 								matrix1='$matrix1',
				 								matrix2='$matrix2',
				 								matrixpajak='$matrixpajak',
				 								subsidi='$subsidi',
				 								subsidi1='$subsidi1',
				 								subsidi2='$subsidi2',
				 								subsidipajak='$subsidipajak',
				 								scpahm='$scpahm',
				 								scpmd='$scpmd',
				 								komisi='$komisi',
				 								bbn='$bbn',
				 								offtheroad='$offtheroad',
				 								jumlah='$jumlah',
				 								ref='$ref',
				 								jaket='$jaket',
				 								bukuservice='$bukuservice',
				 								notelpref='$notelpref',
				 								updatex='$updatex'
						 					WHERE norangka='$norangka'");
			}
			
    	
		$q1 = mysql_query("UPDATE tbl_notajual SET status='1' WHERE nonota='$_REQUEST[nonota]'");
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_notajual',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'UPDATE SETUJUI $_REQUEST[nonota]')
							");
			
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
			                	<h4>KASIR <small>UPDATE PENJUALAN</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i> &nbsp; Daftar Update Nota Jual</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">TRANSAKSI</th>
			                                    <th style="padding:7px">LEASING</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notajual WHERE status='1' AND cekfisik='1'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$d1[idleasing]'"));
			                            	if(!empty($d4[namaleasing])){
												$leasing = $d4[namaleasing];
												}
											else{
												$leasing = "CASH";
												}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d2[nama]?></td>
			                                    <td><?echo "$d3[kodebarang] | $d3[namabarang]"?></td>
			                                    <td><?echo $d1[jnstransaksi]?></td>
			                                    <td><?echo $leasing?></td>
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
		
	else if($submenu == 'view')
		{
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id='$_REQUEST[id]'"));
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE nopesan='$dB[nopesan]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dB[norangka]'"));
		$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE norangka='$dB[norangka]'"));
		$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$d5[user]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT</small></h4>
			                	
					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nonota]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NO. NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="30%">NAMA PELANGGAN</td>
				                    			<td width="2%">:</td>
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
				                    	</div>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">DATA BPKB</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler2') .style.display=='none') {document.getElementById('spoiler2') .style.display=''}else{document.getElementById('spoiler2') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
				                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler2" style="display:none">
					                    	<table width="70%">
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
			                            	</table>
			                            </div>
			                            
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%" valign="top">PESAN NOPOL</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
				                    		</tr>
		                            	</table>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">NOMOR RANGKA | MESIN</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo "$d4[norangka] | $d4[nomesin]"?>" class="form-control" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">BARANG</td>
					                    			<td width="2%">:</td>
					                    			<td width="10%" style="background: #eee;padding: 10px 0 0 10px">KODE BARANG</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[kodebarang]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">NAMA BARANG</td><td style="background: #eee;padding: 0 0 0 10px"">: <?echo "$dA[namabarang]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">VARIAN</td><td style="background: #eee;padding: 0 0 0 10px"">: <?echo "$dA[varian]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">WARNA</td><td style="background: #eee;padding: 0 0 0 10px"">: <?echo "$dA[warna]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 10px 10px">TAHUN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[tahun]"?></td>
					                    		</tr>
					                    		<tr><td colspan="4"></td></tr>
					                    		<tr>
					                    			<td>TRANSAKSI</td>
					                    			<td>:</td>
					                    			<td style="background: #eee;padding: 10px 0 0 10px">JENIS</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
					                    		</tr>
					                    		<tr><td colspan="4"></td></tr>
					                    		<tr>
					                    			<td>TOTAL UANG MUKA/TITIPAN</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:34%;text-align:right" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	</table>
				                    	
			                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">HARGA JUAL</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="hargajual" id="hargajual" value="<?echo number_format($dB[hargajual],"0","",".")?>" value="0" class="form-control" placeholder="0" style="width:34%;text-align:right" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>DISKON</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="diskon" id="diskon" value="<?echo number_format($dB[diskon],"0","",".")?>" class="form-control" value="0" style="width:34%;text-align:right" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>BAYAR</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="bayar" id="bayar" value="<?echo number_format($dB[bayar],"0","",".")?>" class="form-control" value="0" style="width:34%;text-align:right" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    		<tr>
					                    			<td>SISA PEMBAYARAN</td>
					                    			<td>:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RP.</span>
					                                        <input type="text" name="sisabayar" id="sisabayar" value="<?echo number_format($dB[sisabayar],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" readonly="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	</table>
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td>NAMA CHECKER</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="40%">NOMOR RANGKA</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d5[norangka]?>" class="form-control" maxlength="40" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR MESIN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d5[nomesin]?>" class="form-control" maxlength="20" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>BENSIN AWAL</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%"  readonly="">
															<option value='1' <?if($d5[bensinawal]=='1'){?>selected=""<?}?>>1 LITER</option>
															<option value='2' <?if($d5[bensinawal]=='2'){?>selected=""<?}?>>2 LITER</option>
														</select></td>
					                    		</tr>
			                            	</table>
				                    	</div>
		                            	<div class="col-xs-6">
					                    	<table width="80%">
					                    		<tr>
					                    			<td width="40%">ANAK KUNCI 2 PCS</td>
					                    			<td width="5%">:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[anakkunci]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[anakkunci]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>SPION</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[spion]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[spion]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>ACCU</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[accu]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[accu]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TOOLKIT</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[toolkit]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[toolkit]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>HELM</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[helm]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[helm]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>ALAS KAKI</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[alaskaki]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[alaskaki]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>CEK FISIK 2 LBR</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[cekfisik]=='1'){?>checked=""<?}?>> ADA</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[cekfisik]=='0'){?>checked=""<?}?>> TIDAK ADA</label></td>
					                    		</tr>
					                    		<tr>
					                    			<td>KONDISI MOTOR</td>
					                    			<td>:</td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[kondisimotor]=='1'){?>checked=""<?}?>> BAIK</label></td>
					                    			<td><label><input type='radio' class='flat-red' disabled='' <?if($d5[kondisimotor]=='0'){?>checked=""<?}?>> TIDAK BAIK</label></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
				                    	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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