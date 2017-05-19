<?
	if($submenu == 'save')
		{
		$pnopol		= strtoupper($_REQUEST['pnopol']);
		
		if(empty($_REQUEST[status])){
			$q1 = mysql_query("UPDATE tbl_bpkb SET pnopol='$pnopol',status='0' WHERE id%2=0 AND notajual='$_REQUEST[nonota]'");
			}
		else if($_REQUEST[status]=="1"){
			$q1 = mysql_query("UPDATE tbl_bpkb SET pnopol='$pnopol',status='1' WHERE id%2=0 AND notajual='$_REQUEST[nonota]'");
			}
		else if($_REQUEST[status]=="2"){
			$harganopol 	= preg_replace( "/[^0-9]/", "",$_REQUEST['harganopol']);
			$sisabayar		= $harganopol-$_REQUEST['utitipannopol'];
			
			$p_tahun  = date("Y");
			$p_tahun2 = date("y");
			$p_bulan  = date("m");
			$p_tgl    = date("d");
				
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='nopol' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
			$nokwitansi = "KNP$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			if($sisabayar >= "0"){
				$ket = "PELUNASAN PEMESANAN NOPOL";
				}
			else{
				$ket = "PENGEMBALIAN PEMBAYARAN PEMESANAN NOPOL";
				}
			/*
			echo "<script>alert ('$nokwitansi.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			*/
			
			if($sisabayar != "0"){
				mysql_query("INSERT INTO tbl_kwitansi (
												jnskwitansi,
												nokwitansi,
												nomor,
												tahun,
												bulan,
												tanggal,
												idpelanggan,
												jumlah,
												keterangan,
												user,
												inputx)
											VALUES (
												'nopol',
												'$nokwitansi',
												'$_REQUEST[nonota]',
												'$p_tahun',
												'$p_bulan',
												CURDATE(),
												'$_REQUEST[idpelanggan]', 
												'$sisabayar',
												'$pnopol',
												'$_SESSION[id]',
												NOW())
							");
				}
			
			$q1 = mysql_query("UPDATE tbl_bpkb SET pnopol='$pnopol',harganopol='$harganopol',status='2',sisabayar='$sisabayar' WHERE id%2=0 AND notajual='$_REQUEST[nonota]'");
			}
			
		if($q1)
			{
			if($sisabayar == "0"){
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
				}
			else if($sisabayar >= "0"){
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=2'/>";
				}
			else{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=3'/>";
				}
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	if($submenu == 'A')
		{
?>
		<script type="text/javascript">
			var s5_taf_parent = window.location;
			function popup_print(){
				window.open('printaj/pesannopol.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
				}
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>PENJUALAN <small>PEMESANAN NOPOL</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "Proses Berhasil. Mohon Melanjukan Ke Pembuatan Kwitansi Pemesanan Nopol Pada Bagian Kasir";
											}
										if($_REQUEST[note]=="2")
											{
											$ket = "Proses Berhasil, Mohon Melanjukan Ke Pembuatan Kwitansi Pemesanan Nopol Pada Bagian Kasir (Penambahan Bayar Sisa Uang Nopol).";
											}
										if($_REQUEST[note]=="3")
											{
											$ket = "Proses Berhasil, Mohon Melanjukan Ke Pembuatan Kwitansi Pemesanan Nopol Pada Bagian Kasir (Pengembalian Kelebihan Bayar Uang Nopol).";
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
                                    <div style="float:right;" class="col-xs-5">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="99%" align="right">
													<a href="<?echo "?opt=$opt&menu=$menu&submenu=C"?>">
				                           				<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Pemesanan Nopol Baru</button>
													</a>
												</td>
                                    			<td align="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
									</div>	
															
			                        <table id="example1" class="table table-striped table-hover" style="width:160%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="" style="padding:7px">TGL NOTA JUAL</th>
			                                    <th width="" style="padding:7px">NO. NOTA JUAL</th>
			                                    <th width="" style="padding:7px">NAMA PELANGGAN</th>
			                                    <th width="" style="padding:7px">NO. TELEPON</th>
								                <th style="padding:7px">KODE BARANG</th>
								                <th style="padding:7px">BARANG</th>
								                <th style="padding:7px">NO. RANGKA</th>
			                                    <th width="" style="padding:7px">NAMA BPKB</th>
			                                    <th width="" style="padding:7px">NOPOL PEMESANAN</th>
			                                    <th width="" style="padding:7px">STATUS BAYAR</th>
			                                    <th width="" style="padding:7px">STATUS NOPOL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND pnopol!='' AND notajual!=''");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_vw WHERE id%2=0 AND nonota='$d1[notajual]'"));
			                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE id%2=0 AND nonota='$d1[notajual]'"));
			                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dB[idbarang]'"));
											if($d1[status] == "0"){
												$status1 = "<span class='btn btn-warning' style='padding:0 8px;font-size:12px;'>BELUM BAYAR</span>";
												$status2 = "<span class='btn btn-warning' style='padding:0 8px;font-size:12px;'>BELUM SELESAI</span>";
												}
											else if($d1[status] == "1"){
												$status1 = "<span class='btn btn-primary' style='padding:0 8px;font-size:12px;'>SUDAH BAYAR</span>";
												$status2 = "<span class='btn btn-warning' style='padding:0 8px;font-size:12px;'>BELUM SELESAI</span>";
												}
											else if($d1[status] == "2"){
												$status1 = "<span class='btn btn-primary' style='padding:0 8px;font-size:12px;'>SUDAH BAYAR</span>";
												$status2 = "<span class='btn btn-primary' style='padding:0 8px;font-size:12px;'>SUDAH SELESAI</span>";
												}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&nonota=$d1[notajual]"?>'">
			                                    <td><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
			                                    <td><?echo $dA[nonota]?></td>
			                                    <td><?echo $dA[nama]?></td>
			                                    <td><?echo $dA[notelepon]?></td>
								                <td><?echo "$dC[kodebarang]"?></td>
								                <td><?echo "$dC[namabarang] | $dC[varian] | $dC[warna]"?></td>
								                <td><?echo $dB[norangka]?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[pnopol]?></td>
			                                    <td align="center"><?echo $status1?></td>
			                                    <td align="center"><?echo $status2?></td>
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
		
	else if($submenu == 'B')
		{
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dB[idpelanggan]'"));
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE id%2=0 AND nopesan='$dB[nopesan]'"));
		$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE id%2=0 AND nopesan='$dB[nopesan]'"));
		$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id%2=0 AND id='$d7[idsales]'"));
		
		if($d2[status] == "0"){
			$status1 = "<span class='btn btn-warning' style='padding:0 18px;font-size:12px;width:170px'>BELUM BAYAR</span>";
			$status2 = "<span class='btn btn-warning' style='padding:0 18px;font-size:12px;width:170px'>BELUM SELESAI</span>";
			}
		else if($d2[status] == "1"){
			$status1 = "<span class='btn btn-primary' style='padding:0 18px;font-size:12px;width:170px'>SUDAH BAYAR</span>";
			$status2 = "<span class='btn btn-warning' style='padding:0 18px;font-size:12px;width:170px'>BELUM SELESAI</span>";
			}
		else if($d2[status] == "2"){
			$status1 = "<span class='btn btn-primary' style='padding:0 18px;font-size:12px;width:170px'>SUDAH BAYAR</span>";
			$status2 = "<span class='btn btn-primary' style='padding:0 18px;font-size:12px;width:170px'>SUDAH SELESAI</span>";
			}
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>DETAIL PEMESANAN NOPOL</small></h4>
			                	
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PESAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo $dB[nopesan]?>" readonly=""></td>
				                    		</tr>
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
				                    	</div>
			                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            
	                            	<script>
									function populateSelectA(str)
										{
										pilihan = document.updatebpkb.status.value;
										if(pilihan=='2'){
											document.updatebpkb.harganopol.disabled = 0;
										}else{
											document.updatebpkb.harganopol.disabled = 1;
											}
										}
									</script>
									<script>
									function vharganopol()
										{
										if (document.updatebpkb.harganopol.value == '')
											{
											alert ("Harga Nopol Tidak Boleh Kosong.");	 	
											return false;
											}
										}
									</script>
					            	<form name="updatebpkb" method="post" onsubmit="return vharganopol();" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
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
					                    	<?
					                    	if($d2[status]=="0")
					                    		{
					                    	?>
					                    		<tr>
					                    			<td valign="top">NOPOL YANG DIPESAN</td>
					                    			<td valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" required=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UBAH STATUS</td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 100%" disabled="">
															<option value='0' <?if($d2[status]=="0"){?>selected=""<?}?>>BELUM BAYAR DAN BELUM SELESAI</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">HARGA NOPOL</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="width:15%">RP.</span>
					                                        <input type="text" name="harganopol" class="form-control uang"  value="0" style="width:50%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    	else if($d2[status]=="1")
					                    		{
					                    	?>
					                    		<tr>
					                    			<td valign="top">NOPOL YANG DIPESAN</td>
					                    			<td valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" required=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UBAH STATUS</td>
					                    			<td></td>
					                    			<td colspan="2"><select name="status" class="form-control" style="width: 100%" onchange="populateSelectA(this.value)" required="">
															<option value='1' <?if($d2[status]=="1"){?>selected=""<?}?>>SUDAH BAYAR DAN BELUM SELESAI</option>
															<option value='2' <?if($d2[status]=="2"){?>selected=""<?}?>>SUDAH BAYAR DAN SUDAH SELESAI</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">HARGA NOPOL</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="width:15%">RP.</span>
					                                        <input type="text" name="harganopol" class="form-control uang"  value="0" style="width:50%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                   		 else if($d2[status]=="2")
					                    		{
					                    	?>
					                    		<tr>
					                    			<td valign="top">NOPOL YANG DIPESAN</td>
					                    			<td valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td>UBAH STATUS</td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 100%" disabled="">
															<option value='2' <?if($d2[status]=="2"){?>selected=""<?}?>>SUDAH BAYAR DAN SUDAH SELESAI</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%">HARGA NOPOL</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="width:15%">RP.</span>
					                                        <input type="text" name="harganopol" class="form-control uang"  value="<?echo number_format($d2[harganopol],"0","",".")?>" style="width:50%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
					                                    </div>
							                        </td>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
		                            	</table>
			                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">UANG TITIPAN PESAN NOPOL</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" class="form-control" value="<?echo number_format($d2[utitipannopol],"0","",".")?>" placeholder="0" style="width:50%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS PEMBAYARAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><?echo $status1?></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STATUS NOPOL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><?echo $status2?></td>
				                    		</tr>
		                            	</table>
		                            
				                    	<?
		                            	$dQ  = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]' GROUP BY nonota"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND nonota='$dB[nonota]'");
		                            	?>	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">KUANTITAS</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
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
											$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND norangka='$dTemp[norangka]'"));
											$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"));
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
					                    	<div class="clearfix"></div>
			                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
			                            	</td></tr>
				                    	<?
				                    		}
				                    	?>
			                            </table>
					                </div>
					                
				                    <div class="modal-footer">
				                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
				                    	<input type="hidden" name="utitipannopol" value="<?echo $d2[utitipannopol]?>">
				                    	<input type="hidden" name="idpelanggan" value="<?echo $dB[idpelanggan]?>">
				                    	
				                    	<?
				                    	if($d2[status]!="2")
				                    		{
				                    	?>
			                        		<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'C')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENJUALAN <small>BUAT PEMESANAN NOPOL</small></h4>
			                	
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nonota" class="form-control" maxlength="20" style="width: 40%" required="" ></td>
				                    		</tr>
				                   	 	</table>
				                    	</div>
				                   	 	<p>Pembuatan Pemesanan Nopol Hanya Untuk Transaksi Yang Sudah Terbit Nomor Nota Penjualnya.</p>
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
		
	else if($submenu == 'D')
		{
		$nonota = strtoupper($_REQUEST[nonota]);
		$dC1 = mysql_fetch_array(mysql_query("SELECT id,idpelanggan FROM tbl_notajual WHERE id%2=0 AND nonota='$nonota'"));
		if(empty($dC1[id]))
			{
			echo "<script>alert ('Nomor Nota Jual Tidak Ada Atau Salah.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
			exit();
			}
		else{
			$dC2 = mysql_fetch_array(mysql_query("SELECT id,nopesan FROM tbl_bpkb WHERE id%2=0 AND notajual='$nonota' AND pnopol='' AND status='0'"));
			if(empty($dC2[id]))
				{
				echo "<script>alert ('Sudah Ada Pemesanan Nopol Untuk Nota Jual $nonota.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
				exit();
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENJUALAN <small>BUAT PEMESANAN NOPOL</small></h4>
			                	
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=E"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nonota" class="form-control" style="width: 40%" value="<?echo $nonota?>" readonly="" ></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="">NOPOL YANG DIPESAN</td>
				                    			<td valign="">:</td>
				                    			<td colspan="2"><input type="text" name="pnopol" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" required=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td>UANG TITIPAN PESAN NOPOL</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="width:15%">RP.</span>
				                                        <input type="text" name="utitipannopol" class="form-control uang" value="<?echo number_format($d2[utitipannopol],"0","",".")?>" placeholder="0" style="width:50%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required="">
				                                    </div>
						                        </td>
				                    		</tr>
				                   	 	</table>
				                    	</div>
				                    </div>
			                        <div class="modal-footer clearfix">
			                        	<input type="hidden" name="nopesan" value="<?echo $dC2[nopesan]?>">
			                        	<input type="hidden" name="idpelanggan" value="<?echo $dC1[idpelanggan]?>">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										
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
		
	else if($submenu == 'E')
		{
		$utitipannopol 	= preg_replace( "/[^0-9]/", "",$_REQUEST['utitipannopol']);
		$pnopol			= strtoupper($_REQUEST[pnopol]);
		
		$q1 = mysql_query("UPDATE tbl_bpkb SET pnopol='$pnopol',utitipannopol='$utitipannopol' WHERE id%2=0 AND notajual='$_REQUEST[nonota]' AND nopesan='$_REQUEST[nopesan]'");
		
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM tbl_kwitansi WHERE id%2=0 AND jnskwitansi='nopol' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
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
			
		$nokwitansi = "KNP$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
		
		mysql_query("INSERT INTO tbl_kwitansi (
										jnskwitansi,
										nokwitansi,
										nomor,
										tahun,
										bulan,
										tanggal,
										idpelanggan,
										jumlah,
										keterangan,
										user,
										inputx)
									VALUES (
										'nopol',
										'$nokwitansi',
										'$_REQUEST[nopesan]',
										'$p_tahun',
										'$p_bulan',
										CURDATE(),
										'$_REQUEST[idpelanggan]', 
										'$utitipannopol',
										'$pnopol',
										'$_SESSION[id]',
										NOW())
					");	
					
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
			exit();
			}
		else
			{
			//echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
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