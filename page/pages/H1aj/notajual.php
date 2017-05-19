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
			                	<h4>PENJUALAN <small>NOTA PENJUALAN</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA JUAL / NAMA PELANGGAN / JENIS TRANSAKSI ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=".md5(indent)."&submenu=A"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> &nbsp; Tambah Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
	                           				<button type="button"  onclick="window.open('printaj/h1/notajual.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
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
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND id%2=0 AND (nama LIKE '%$_REQUEST[cari]%' OR jnstransaksi LIKE '%$_REQUEST[cari]%' OR nonota LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND id%2=0 ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS qty FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$d1[nopesan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$d1[idleasing]'"));
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'">
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo "$d1[jnstransaksi] $d1[jnscashtempo]"?></td>
			                                    <td><?echo $d4[namaleasing]?></td>
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
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND nopesan='$dB[nopesan]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dA[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dA[nopesan]'"));
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id%2=0 AND id='$dA[idleasing]'"));
		$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dB[norangka]'"));
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/notajual.php?nonota=<?echo $dB[nonota]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>INDENT</small></h4>
			                	
					            <form name="inputpelanggan" onsubmit="return validA();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
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
				                    	
				                    	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]' GROUP BY nonota"));
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
				                    			<td colspan="2"><input type="text" name="tnkb" value="<?echo $dA[tnkb]?>" class="form-control" style="width:100%;" readonly=""></td>
				                    		</tr>
				                    		<tr><td colspan="4"></td></tr>
				                    		<tr>
				                    			<td>TRANSAKSI</td>
				                    			<td>:</td>
				                    			<td style="background: #eee;padding: 0 10px">JENIS</td><td style="background: #eee;padding: 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
				                    		</tr>
				                    		<?
				                    		if($dA[jnstransaksi]=='KREDIT')
				                    			{
				                    		?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">LEASING</td><td style="background: #eee;padding: 0 10px">: <?echo "$d3[namaleasing]"?></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td style="background: #eee;padding: 0 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 10px">: <?echo "$dA[termin]"?></td>
				                    		</tr>
				                    		<tr><td colspan="4"></td></tr>
				                    		<?
				                    			}
													
				                    		if($dA[jnstransaksi]=='CASH TEMPO')
				                    			{
				                    		?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMPO</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$dA[jnscashtempo]"?></td>
					                    		</tr>
				                    		<?
					                    		if($dA[jnscashtempo]=='LEASING')
					                    			{
											?>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 0 10px">LEASING</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$d3[namaleasing]"?></td>
						                    		</tr>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 10px 10px">MASA ANGSURAN</td><td style="background: #eee;padding: 0 0 10px 10px">: <?echo "$dA[termin]"?></td>
						                    		</tr>
											<?
													}
													
					                    		else if($dA[jnscashtempo]=='DEALER')
					                    			{
											?>
						                    		<tr>
						                    			<td colspan="2"></td>
						                    			<td style="background: #eee;padding: 0 0 0 10px">TANGGAL PELUNASAN</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo date("d-m-Y",strtotime($dA[tglpelunasan]))?></td>
						                    		</tr>
						                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
						                    		<tr><td colspan="2"></td></tr>
											<?
													}
												}
												
				                    		if($dB[cekfisik]=="1"){
		                            			$qTemp  = mysql_query("SELECT * FROM tbl_cekfisik WHERE id%2=0 AND nonota='$dB[nonota]'");
												}
				                    		if($dB[cekfisik]=="0"){
		                            			$qTemp  = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]'");
												}
				                    		?>
					                    		<tr>
					                    			<td width="30%">DATA TRANSAKSI BARANG</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><button type="button" style="padding-top:4px;padding-bottom:4px;width:100%" class="btn btn-primary" onclick="if(document.getElementById('spoiler3') .style.display=='none') {document.getElementById('spoiler3') .style.display=''}else{document.getElementById('spoiler3') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Detail</button></td>
					                    		</tr>
		                            	</table>
		                            	
				                    	<div id="spoiler3" style="display:none">
		                            	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            <table width="100%" class="table table-striped">
				                    	<?
		                            	while($dTemp = mysql_fetch_array($qTemp))
				                    		{
											$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
											$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
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
						                    			<td colspan="2"><?echo $dC[kodebarang]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NAMA BARANG</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dC[namabarang]?></td>
						                    		</tr>
				                            	</table>
					                    	</div>
			                            	<div class="col-xs-6">
						                    	<table width="80%">
						                    		<tr>
						                    			<td width="40%">VARIAN</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><?echo $dC[varian]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>WARNA</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dC[warna]?></td>
						                    		</tr>
						                    		<tr>
						                    			<td>TAHUN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><?echo $dC[thnproduksi]?></td>
						                    		</tr>
				                            	</table>
					                    	</div>
					                    	<div class="clearfix" style="border-bottom:1px #eee dashed;margin:0 10px; margin-bottom:5px"></div>
					                    	
			                            	<div class="col-xs-6">
						                    	<table width="80%">
						                    		<tr>
						                    			<td width="40%">NOMOR RANGKA</td>
						                    			<td width="2%">:</td>
						                    			<td colspan="2"><input type="text" <?if($dB[cekfisik]=="1"){?>value="<?echo $dTemp[norangka]?>"<?}?> class="form-control" maxlength="40" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>NOMOR MESIN</td>
						                    			<td>:</td>
						                    			<td colspan="2"><input type="text"  <?if($dB[cekfisik]=="1"){?>value="<?echo $dU[nomesin]?>"<?}?> class="form-control" maxlength="20" readonly=""></td>
						                    		</tr>
						                    		<tr>
						                    			<td>BENSIN AWAL</td>
						                    			<td>:</td>
						                    			<td colspan="2"><select class="form-control" style="width: 60%"  readonly="">
																<option value='' <?if($dB[cekfisik]=="0"){?>selected=""<?}?>></option>
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
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">HARGA JUAL</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="totr" id="totr" value="<?echo number_format($dB[totr],"0","",".")?>" value="0" class="form-control" placeholder="0" style="width:34%;text-align:right" readonly="">
				                                    </div>
						                        </td>
				                    		</tr>
			                    		<?
			                    		if($dA[jnstransaksi]=='CASH')
			                    			{
			                    		?>
				                    		<tr>
				                    			<td>HARGA JUAL + PPN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="utitipan" value="<?echo number_format($dB[totr]*1.1,"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:34%;text-align:right" disabled="">
				                                    </div>
						                        </td>
				                    		</tr>
										<?
											}
			                    		if($dA[jnstransaksi]=='CASH TEMPO' AND $dA[jnscashtempo]=='DEALER')
			                    			{
			                    		?>
				                    		<tr>
				                    			<td>HARGA JUAL + PPN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="utitipan" value="<?echo number_format($dB[totr]*1.1,"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:34%;text-align:right" disabled="">
				                                    </div>
						                        </td>
				                    		</tr>
										<?
											}
										?>
				                    		<tr>
				                    			<td>TOTAL POTONGAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="tdisc" id="diskon" value="<?echo number_format($dB[tdisc],"0","",".")?>" class="form-control" value="0" style="width:34%;text-align:right" readonly="">
				                                    </div>
						                        </td>
				                    		</tr>
			                    		<?
			                    		if($dA[jnstransaksi]=='CASH')
			                    			{
			                    		?>
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
											<!--
				                    		<tr>
				                    			<td>SISA PEMBAYARAN</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="sisabayar" id="sisabayar" value="<?echo number_format($dB[sisabayar]+$dB[bayar],"0","",".")?>" class="form-control" placeholder="0" style="width:34%;text-align:right" readonly="">
				                                    </div>
						                        </td>
				                    		</tr>
											-->
				                    	<?
				                    		}
				                    	?>
				                    	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
										<button type="button" class="btn btn-primary pull-left" onClick="popup_print()"><i class="fa fa-print"></i> &nbsp;Cetak Nota Jual</button>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A$_REQUEST[sm]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>