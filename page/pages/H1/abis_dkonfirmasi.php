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
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="A1")
											{
											$ket = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Pada Bagian Kasir.</p>";
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
				                        <table id="example6" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
											<thead>
												<tr>
													<th width="10%">TANGGAL</th>
													<th>PERIHAL KONFIRMASI</th>
													<th>STATUS</th>
												</tr>
											</thead>
				                            <tbody>
					                        <?
												$q1	 = mysql_query("SELECT * FROM tbl_abis_dkonfirmasi WHERE bulan='$periode_bulan'  AND tahun='$periode_tahun' ORDER BY id DESC");
												while($d1  = mysql_fetch_array($q1))
													{
					                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:130px'> Ditolak</span>";}
					                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:130px'> Disetujui</span>";}
					                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;width:130px'>Belum Direspon</span>";}
													if($d1[tbl]=="tbl_pesanan" AND $d1[idpesanan]=='0')
														{
														}
													else
														{
											?>
														<tr style='cursor:pointer' onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
					                                    	<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
															<td><?echo $d1[kasus]?></td>
															<td align='center'><?echo $status?></td>
														</tr>
											<?	
														}
					                        ?>
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
											<?
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
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM tbl_abis_dkonfirmasi WHERE id='$_REQUEST[id]'"));
		if(!empty($dX[idkaskecil]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kaskecil WHERE id='$dX[idkaskecil]'"));
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
			
		if(!empty($dX[idpesanan]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE id='$dX[idpesanan]'"));
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE nopesan='$dA[nopesan]'"));
			$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
			$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dA[idsales]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI PEMBATALAN PESANAN</small></h4>	
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="2%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL PESANAN</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA SALES/COUNTER</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $d4[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">NO. NOTA PEMESANAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><input type="text" name="nopesan" class="form-control" style="width: 40%" value="<?echo $dA[nopesan]?>" readonly=""></td>
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
					                    			<td colspan="2"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NOMOR TELESURAT PESANANN</td>
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
					                    			<td colspan="2"><input type="text" name="nama" value="<?echo $d2[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" name="noktp" value="<?echo $d2[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="alamat" maxlength="400" class="form-control" disabled><?echo $d2[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" name="rt" value="<?echo $d2[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" name="rw" value="<?echo $d2[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
				                    			<td width="30%" valign="top">PESAN NOSURAT PESANANL</td>
				                    			<td width="2%" valign="top">:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d2[pnopol]?>" name="pnopol" class="form-control" disabled></td>
				                    		</tr>
		                            	</table>
				                    	
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	<?
		                            	$dQ = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE nopesan='$dA[nopesan]' GROUP BY nopesan"));
		                            	$qTemp = mysql_query("SELECT * FROM tbl_pesanan_det WHERE nopesan='$dA[nopesan]'");
		                            	?>
				                    	<table width="70%">
				                    		<tr>
				                    			<td width="30%">BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="3" style="background: #eee;padding: 0 10px"></td>
				                    		</tr>
				                    	<?
				                    	while($dB = mysql_fetch_array($qTemp))
				                    		{
				                    		$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dB[idbarang]'"))
				                    	?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding: 0 10px 10px 10px"><?echo "$dBrg[kodebarang] | $dBrg[namabarang] | $dBrg[varian] | $dBrg[warna]"?></td>
											</tr>
				                    	<?
				                    		}
				                    	?>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KUANTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="3"><input type="text" name="qty" value="<?echo $dQ[total]?>" class="form-control" style="width:10%;text-align:right" readonly=""></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="5"></td>
				                    		</tr>
											
				                    		<tr>
				                    			<td>TRANSAKSI</td>
				                    			<td>:</td>
				                    			<td style="background: #eee;padding: 10px 0 0 10px;width: 15%">JENIS</td><td style="background: #eee;padding: 10px 0 0 10px">: <?echo "$dA[jnstransaksi]"?></td>
				                    		</tr>
				                    		<?
				                    		if($dA[jnstransaksi]=='KREDIT')
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
						                    	<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
											<?
												}
												
				                    		if($dA[jnstransaksi]=='CASH TEMSURAT PESANAN')
				                    			{
				                    		?>
					                    		<tr>
					                    			<td colspan="2"></td>
					                    			<td style="background: #eee;padding: 0 0 0 10px">JENIS CASH TEMSURAT PESANAN</td><td style="background: #eee;padding: 0 0 0 10px">: <?echo "$dA[jnscashtempo]"?></td>
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
						                    		<tr><td colspan="2"></td><td colspan="2" style="background: #eee;padding: 0 0 10px 10px"></td></tr>
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
											<?
													}
												}
				                    		?>
				                    		<tr>
				                    			<td colspan="2"></td>
				                    			<td colspan="2" style="background: #eee;padding:5px"></td>
				                    		</tr>
				                    		<tr><td colspan="4"></td></tr>
											
				                    		<tr>
				                    			<td>UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
				                    			<td width="25%">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="utitipan" value="<?echo number_format($dA[utitipan],"0","",".")?>" id="uang" class="form-control" placeholder="0" style="width:100%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" disabled="">
				                                    </div>
						                        </td>
				                    			<td></td>
				                    		</tr>
											<?
											$dCek = mysql_fetch_array(mysql_query("SELECT status FROM tbl_kwitansi WHERE nomor='$dA[nopesan]' AND jnskwitansi IN ('umuka','titip')"));
											if(empty($dCek[status])){
												$sum = "BELUM TERBAYAR";
												}
											if($dCek[status]=="1"){
												$sum = "TERBAYAR";
												}
											?>
											<tr><td style="heigt:30px"></td></tr>
				                    		<tr>
				                    			<td>STATUS UANG MUKA/TITIPAN</td>
				                    			<td>:</td>
				                    			<td width="25%"><?echo $sum?></td>
				                    			<td></td>
				                    		</tr>
				                    		<input type="hidden" name="idpelanggan" value="<?echo $_REQUEST[id]?>">
				                    		<input type="hidden" name="tahun" value="<?echo $p_tahun?>">
				                    		<input type="hidden" name="bulan" value="<?echo $p_bulan?>">
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
			
		if(!empty($dX[idreturbeli]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE id='$dX[idreturbeli]'"));
			$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE nodo='$dA[nodo]'"));
			$d2 = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id='$dA[iduser]'"));
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
				                        		<td>TGL RETUR BELI</td>
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
					                	<div style="padding:20px">
						           			<div class="col-xs-4">
						                        <table width="100%">
						                        	<tr>
						                        		<td width="50%">NO. FAKTUR</td>
						                        		<td width="3%">:</td>
						                        		<td><input type="text" name="nodo" value="<?echo $d1[nodo]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
						                        	</tr>
						                        	<tr>
						                        		<td>NO. SURAT PESANAN</td>
						                        		<td>:</td>
						                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
						                        	</tr>
						                        	<tr>
						                        		<td>NO. NOTA BELI</td>
						                        		<td>:</td>
						                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:90%" readonly=""></td>
						                        	</tr>
						                        </table>
						                    </div>
						           			<div class="col-xs-4">
						                        <table width="100%">
						                        	<tr>
						                        		<td width="50%">TGL FAKTUR</td>
						                        		<td width="3%">:</td>
						                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($d1[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
						                        	</tr>
						                        	<tr>
						                        		<td>TGL SURAT PESANAN</td>
						                        		<td>:</td>
						                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
						                        	</tr>
						                        	<tr>
						                        		<td>TGL NOTA BELI</td>
						                        		<td>:</td>
						                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:70%"></td>
						                        	</tr>
						                        </table>
						                    </div>
						           			<div class="col-xs-4">
						                        <table width="100%">
						                        	<tr>
						                        		<td width="20%" valign="top">MEMO</td>
						                        		<td width="3%" valign="top">:</td>
						                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height: 90px" readonly=""><?echo $d1[memo]?></textarea></td>
						                        	</tr>
						                        </table>
						                    </div>
						                </div>
						                
				                        <table class="table table-striped" id="example3" width="120%">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px"> &nbsp;&nbsp;&nbsp;&nbsp; KODE BARANG</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th style="padding:7px">VARIAN</th>
				                                    <th style="padding:7px">WARNA</th>
				                                    <th style="padding:7px">NO. RANGKA</th>
				                                    <th style="padding:7px">NO. MESIN</th>
				                                    <th style="padding:7px">STATUS</th>
				                                    <th style="padding:7px">TGL TIBA</th>
				                                    <th style="padding:7px">GUDANG</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$q1 = mysql_query("SELECT * FROM tbl_notabeli_det_vw WHERE nonota='$d1[nonota]'");
				                            while($dY = mysql_fetch_array($q1))
				                            	{
					                            if($dY[status]=='1'){
													$status = "<span class='label label-success'>ADA</span>";
													$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
													}
												else if($dY[status]=='0'){
													$status = "-";
													$checkbox = "<input type='checkbox' class='flat-red' name='scan[]' value='$dY[norangka]'/>";
													}
												$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE norangka='$dY[norangka]'"));
												$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$dB[idgudang]'"));
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><label><?echo "$checkbox $dY[kodebarang]"?></label></td>
				                                    <td><?echo $dY[namabarang]?></td>
				                                    <td><?echo $dY[varian]?></td>
				                                    <td><?echo $dY[warna]?></td>
				                                    <td><?echo $dY[norangka]?></td>
				                                    <td><?echo $dY[nomesin]?></td>
				                                    <td><?echo $status?></td>
				                                    <td><?echo $dB[tgltiba]?></td>
				                                    <td><?echo $dC[gudang]?></td>
				                                </tr>
				                            <?
				                            	}
				                             ?>
				                            </tbody>
				                        </table>
				                        <?
				                        $dhelm  = mysql_fetch_array(mysql_query("SELECT helm FROM stok_helm WHERE nonota='$d1[nonota]'"));
				                        $dspion = mysql_fetch_array(mysql_query("SELECT spion FROM stok_spion WHERE nonota='$d1[nonota]'"));
				                        $daccu	= mysql_fetch_array(mysql_query("SELECT accu FROM stok_accu WHERE nonota='$d1[nonota]'"));
				                        $dtoolkit	= mysql_fetch_array(mysql_query("SELECT toolkit FROM stok_toolkit WHERE nonota='$d1[nonota]'"));
				                        $danakkunci	= mysql_fetch_array(mysql_query("SELECT anakkunci FROM stok_anakkunci WHERE nonota='$d1[nonota]'"));
				                        $dalaskaki	= mysql_fetch_array(mysql_query("SELECT alaskaki FROM stok_alaskaki WHERE nonota='$d1[nonota]'"));
				                        ?>
					                	<div style="padding:20px">
						           			<div class="col-xs-4">
						                        <table width="100%">
						                        	<tr>
						                        		<td width="50%">HELM</td>
						                        		<td width="3%">:</td>
						                        		<td><input type="text" value="<?echo $dhelm[helm]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
						                        	</tr>
						                        	<tr>
						                        		<td>SPION</td>
						                        		<td>:</td>
						                        		<td><input type="text" value="<?echo $dspion[spion]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
						                        	</tr>
						                        </table>
						                    </div>
						           			<div class="col-xs-4">
						                        <table width="100%">
						                        	<tr>
						                        		<td width="50%">ACCU</td>
						                        		<td width="3%">:</td>
						                        		<td><input type="text" value="<?echo $daccu[accu]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
						                        	</tr>
						                        	<tr>
						                        		<td>TOOLKIT</td>
						                        		<td>:</td>
						                        		<td><input type="text" value="<?echo $dtoolkit[toolkit]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
						                        	</tr>
						                        </table>
						                    </div>
						           			<div class="col-xs-4">
						                        <table width="100%">
						                        	<tr>
						                        		<td width="50%">ANAK KUNCI 2 PCS</td>
						                        		<td width="3%">:</td>
						                        		<td><input type="text" value="<?echo $danakkunci[anakkunci]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
						                        	</tr>
						                        	<tr>
						                        		<td>ALAS KAKI</td>
						                        		<td>:</td>
						                        		<td><input type="text" value="<?echo $dalaskaki[alaskaki]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
						                        	</tr>
						                        </table>
						                    </div>
						                </div>
						                <div class="clearfix"></div>
				                        <div style="border-bottom:1px #aaa dashed;margin: 10px 0 -10px"></div>
						                
										<div style="padding:20px;">
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">TGL RETUR BELI</td>
					                    			<td width="2%">:</td>
					                    			<td><input type="text" value="<?echo date("d-m-Y",strtotime($dA[tanggal]))?>" style="width: 25%" class="form-control" readonly=""></td>
					                    		</tr>
					                    		<tr>
					                    			<td><h5><b>BARANG YANG DIRETUR</b></h5></td>
					                    		</tr>
					                    		<?
					                    		if(!empty($dA[helm]))
					                    		{
					                    		?>
					                        	<tr>
					                        		<td>HELM</td>
					                        		<td >:</td>
					                        		<td><input type="text" name="helm" value="<?echo $dA[helm]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
					                        	</tr>
					                    		<?
					                    		}
					                    		if(!empty($dA[spion]))
					                    		{
					                    		?>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $dA[spion]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
					                        	</tr>
					                    		<?
					                    		}
					                    		if(!empty($dA[accu]))
					                    		{
					                    		?>
					                        	<tr>
					                        		<td>ACCU</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="accu" value="<?echo $dA[accu]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
					                        	</tr>
					                    		<?
					                    		}
					                    		if(!empty($dA[toolkit]))
					                    		{
					                    		?>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $dA[toolkit]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
					                        	</tr>
					                    		<?
					                    		}
					                    		if(!empty($dA[alaskaki]))
					                    		{
					                    		?>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="<?echo $dA[alaskaki]?>" class="form-control" maxlength="4" style="width:15%;text-align:right;" readonly></td>
					                        	</tr>
					                        	<?
					                        	}
					                        	?>
					                    		<tr>
					                    			<td valign="top" >KETERANGAN</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea name="keterangan" maxlength="200" class="form-control" readonly><?echo $dA[keterangan]?></textarea></td>
					                    		</tr>
			                            	</table>
			                            </div>
					                    	
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
			
		if(!empty($dX[idpindah]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pindah_vw WHERE id='$dX[idpindah]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI MUTASI</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL MUTASI</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
				                        <table id="example2" class="table table-striped">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">NO. RANGKA</th>
				                                    <th style="padding:7px">NO. MESIN</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th style="padding:7px">VARIAN</th>
				                                    <th style="padding:7px">WARNA</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$no=1;
											$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka IN (SELECT norangka FROM tbl_pindah_det WHERE idpindah='$dX[idpindah]')");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $d1[norangka]?></td>
				                                    <td><?echo $d1[nomesin]?></td>
				                                    <td><?echo $d1[kodebarang]?></td>
				                                    <td><?echo $d1[namabarang]?></td>
				                                    <td><?echo $d1[varian]?></td>
				                                    <td><?echo $d1[warna]?></td>
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
			
		if(!empty($dX[idopname]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_opname WHERE id='$dX[idopname]'"));
			$dB = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id='$dA[iduser]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI STOCK OPNAME BARANG</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL STOCK OPNAME</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENANGGUNG JAWAB</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dB[nama]?>" style="width: 55%" class="form-control" readonly></td>
				                    		</tr>
				                        	<tr>
				                        		<td>LOKASI</td>
				                        		<td>:</td>
				                        		<td colspan="2"><select name="idgudang" class="form-control" style="height:35px;width:50%" disabled="">
														<option value='' >SEMUA LOKASI</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_gudang ORDER BY gudang');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['id'];?>" <?if($dA[idgudang] == $data['id']){?>selected='selected'<?}?>><? echo $data['gudang'];?></option>";
														<?php
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
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:auto;height:300px;margin-top:-20px">
				                        <table class="table table-striped" id="example2" style="width:110%">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">NO. RANGKA <?//echo $dX[idopname]?></th>
				                                    <th style="padding:7px">NO. MESIN</th>
				                                    <th style="padding:7px">KODE BARANG</th>
				                                    <th style="padding:7px">NAMA BARANG</th>
				                                    <th style="padding:7px">VARIAN</th>
				                                    <th style="padding:7px">WARNA</th>
				                                    <th style="padding:7px">KETERANGAN</th>
				                                    <th style="padding:7px">HARGA BELI (RP)</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$d2 = mysql_fetch_array($q2 = mysql_query("SELECT SUM(hargabeli) AS totjumselisih FROM tbl_opname_det_vw WHERE idopname='$dX[idopname]'"));
											$q1 = mysql_query("SELECT * FROM tbl_opname_det_vw WHERE idopname='$dX[idopname]'");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td><?echo $d1[norangka]?></td>
				                                    <td><?echo $d1[nomesin]?></td>
				                                    <td><?echo $d1[kodebarang]?></td>
				                                    <td><?echo $d1[namabarang]?></td>
				                                    <td><?echo $d1[varian]?></td>
				                                    <td><?echo $d1[warna]?></td>
				                                    <td><?echo $d1[keterangan]?></td>
				                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d1[hargabeli],"0","",".")?></span></td>
				                                </tr>
				                            <?
				                            	}
				                             ?>
				                            </tbody>
				                            <tfoot>
				                            	<tr>
				                            		<td colspan="6" align="right"><b>GRAND TOTAL</b></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d2[totjumselisih])?></b></span></td>
				                            	</tr>
				                            </tfoot>
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
			
		if(!empty($dX[idpiutang]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_piutang_vw WHERE id='$dX[idpiutang]'"));
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
			
		if(!empty($dX[idbensin]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bensin WHERE id='$dX[idbensin]'"));
			$dB = mysql_fetch_array(mysql_query("SELECT nama FROM tbl_user_vw WHERE id='$dA[iduser]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI OPNAME BENSIN</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL OPNAME BENSIN</td>
				                        		<td>:</td>
				                        		<td><input type="text" style="width:30%" value="<?echo date("d-m-Y",strtotime($dX[tanggal]))?>" class="form-control" readonly=""></td>
				                        	</tr>
				                        	<tr>
				                        		<td>NAMA PENGINPUT</td>
				                        		<td>:</td>
				                    			<td><input type="text" value="<?echo $dB[nama]?>" style="width: 55%" class="form-control" readonly></td>
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
			
		if(!empty($dX[idbyrpiutang]))
			{
    		$periode_tahun = date("Y");
			$periode_bulan = date('m');
			
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_piutang_vw WHERE id='$dX[idbyrpiutang]'"));
			
			$dPiu = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE jenis='piutang' AND idkaryawan='$dA[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
			$dPby = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE jenis='pembayaran' AND idkaryawan='$dA[idkaryawan]' AND status='1' GROUP BY idkaryawan"));
			
			$totpiutang    = $dPiu[total];
			$totpembayaran = $dPby[total];
			$sisapiutang   = $dPiu[total]-$dPby[total];
			
			$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id='$dA[idkaryawan]'"));
			$dC = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS totjum FROM tbl_potkompensasi WHERE idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1'"));
			$dD	= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND status='1'"));

			$total = $dC[totjum]+$dD[total]+$dA[jumlah];
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN</small></h4>		
			                		<div style="padding:20px">
				                    	<table width="70%">
				                        	<tr>
				                        		<td width="30%" valign="top">KASUS</td>
				                        		<td width="5%" valign="top" >:</td>
				                        		<td><textarea class="form-control" readonly=""><?echo $dX[kasus]?></textarea></td>
				                        	</tr>
				                        	<tr>
				                        		<td>TANGGAL PEMBAYARAN PIUTANG</td>
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
			
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_potkompensasi_vw WHERE id='$dX[idpotkompensasi]'"));
			$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE id='$dA[idkaryawan]'"));
			$dC = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS totjum FROM tbl_potkompensasi WHERE idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND status='1'"));
			$dD	= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[idkaryawan]' AND metodebayar='GAJI' AND status='1'"));

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
				                    			<td><input type="text" name="metodebayar" value="<?echo $dA[metodebayar]?>" style="width: 55%" class="form-control" readonly></td>
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
			
		if(!empty($dX[idkwitansi]))
			{
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kwitansi_vw WHERE id='$dX[idkwitansi]'"));
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="height:520px;">
			                	<h4>AKTIVITAS BISNIS <small>KONFIRMASI PENGEMBALIAN UANG MUKA/UANG TITIPAN</small></h4>		
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
				                        		<td>&nbsp;</td>
				                        	</tr>
				                        </table>
		                            <div style="border-bottom:1px #aaa dashed;"></div>
					                </div>
					                		
			                		<div style="padding:20px;overflow-y:auto;overflow-x:hidden;height:300px;margin-top:-20px">
				                    	<table style="width:70%">
				                    		<tr>
				                    			<td width="30%">NOMOR NOTA PENJUALAN</td>
				                    			<td width="2%">:</td>
				                    			<td><input type="text" name="nonota" class="form-control" value="<?echo $dA[nomor]?>" style="width:30%" readonly/></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR KWITANSI</td>
				                    			<td>:</td>
				                    			<td><input type="text" name="nokwitansi" class="form-control" value="<?echo $dA[nokwitansi]?>" style="width:30%" readonly/></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($dA[tanggal]))?>" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly></td>
											</tr>
				                    		<tr>
				                    			<td>JAKET</td>
				                    			<td>:</td>
				                    			<td><select class="form-control" name="jaket" readonly style="width: 30%">
																	<option value='YA' <?if($dA[jaket]=='YA'){?>selected=""<?}?>>YA</option>
																	<option value='TIDAK' <?if($dA[jaket]=='TIDAK'){?>selected=""<?}?>>TIDAK</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>BUKU SERVICE</td>
				                    			<td>:</td>
				                    			<td><select class="form-control" name="bukuservice" readonly style="width: 30%">
																	<option value='YA' <?if($dA[bukuservice]=='YA'){?>selected=""<?}?>>YA</option>
																	<option value='TIDAK' <?if($dA[bukuservice]=='TIDAK'){?>selected=""<?}?>>TIDAK</option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td height="10px"></td>
				                    		</tr>
				                    		<?
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
				                    		?>
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
				                                        <input type="text" name="jumlah" id="uang" class="form-control" value="<?echo number_format($dA[jumlah],"0","",".")?>" style="width:25%;text-align:right" maxlength="20" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" readonly>
				                                    </div>
				                                </td>
				                    		</tr>
				                    		<tr>
				                    			<td>UNTUK PEMBAYARAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="PENGEMBALIAN UANG MUKA/UANG TITIPAN" class="form-control" style="width:70%" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>KETERANGAN</td>
				                    			<td>:</td>
				                    			<td><input type="text" value="<?echo $dA[keterangan]?>" class="form-control" style="width:70%" readonly></td>
				                    		</tr>
		                            	</table>
										<table id="example3" class="table table-striped">
				                            <thead style="color:#666;font-size:13px">
				                                <tr>
				                                    <th style="padding:7px">BARANG</th>
				                                    <th style="padding:7px">WARNA</th>
				                                    <th style="padding:7px">TAHUN</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                            <?
											$qB = mysql_query("SELECT * FROM tbl_pesanan_det WHERE nopesan='$dA[nomor]'");
				                            while($dB = mysql_fetch_array($qB))
				                            	{
				                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$dB[idbarang]'"));
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
		
	else if($submenu == 'setuju')
		{      
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM tbl_abis_dkonfirmasi WHERE id='$_REQUEST[id]'"));
		
		if(!empty($dX[idkaskecil]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_kaskecil SET status='1' WHERE id='$dX[idkaskecil]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI KASKECIL ID $dX[idkaskecil]')
								");
			}
		
		if(!empty($dX[idpesanan]))
			{                       	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_pesanan SET status='BATAL',updatex='$updatex' WHERE id='$dX[idpesanan]'");
			
			$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE id='$dX[idpesanan]'"));
			$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$dA[idleasing]'"));
			$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan_det_vw WHERE nopesan='$dA[nopesan]'"));
			
            if($dA[jnstransaksi]=='KREDIT')
            	{
				mysql_query("INSERT INTO tbl_hleasing VALUES (										
				                                    '',
				                                    '$dA[idpelanggan]',
				                                    '$dB[kodeleasing]',
				                                    '$dC[namabarang]',
				                                    '$dA[termin]',
				                                    CURDATE(),
				                                    '0')
										");
				}
            if($dA[jnstransaksi]=='CASH TEMPO' && $dA[jnscashtempo]=='LEASING')
            	{
				mysql_query("INSERT INTO tbl_hleasing VALUES (										
				                                    '',
				                                    '$dA[idpelanggan]',
				                                    '$dB[kodeleasing]',
				                                    '$dC[namabarang]',
				                                    '$dA[termin]',
				                                    CURDATE(),
				                                    '0')
										");
				}
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PEMBATALAN PESANAN ID $dX[idpesanan]')
								");
			}
			
		if(!empty($dX[idreturbeli]))
			{                       	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_returbeli SET status='1',updatex='$updatex' WHERE id='$dX[idreturbeli]'");
							
	        $dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE id='$dX[idreturbeli]'"));
			$dB = mysql_fetch_array(mysql_query("SELECT nonota FROM tbl_notabeli WHERE nodo='$dA[nodo]'"));
			if(!empty($dA[helm])){
				mysql_query("UPDATE stok_helm SET helm=helm-$dA[helm] WHERE nonota='$dB[nonota]'");
				}
			if(!empty($dA[spion])){
				mysql_query("UPDATE stok_spion SET spion=spion-$dA[spion] WHERE nonota='$dB[nonota]'");
				}
			if(!empty($dA[accu])){
				mysql_query("UPDATE stok_accu SET accu=accu-$dA[accu] WHERE nonota='$dB[nonota]'");
				}
			if(!empty($dA[toolkit])){
				mysql_query("UPDATE stok_toolkit SET toolkit=toolkit-$dA[toolkit] WHERE nonota='$dB[nonota]'");
				}
			if(!empty($dA[alaskaki])){
				mysql_query("UPDATE stok_alaskaki SET alaskaki=alaskaki-$dA[alaskaki] WHERE nonota='$dB[nonota]'");
				}
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI RETUR BELI ID $dX[idreturbeli]')
								");
			}
			
		if(!empty($dX[idpindah]))
			{                       	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_pindah SET status='1' WHERE id='$dX[idpindah]'");
			
	        $dA = mysql_fetch_array(mysql_query("SELECT idgudang2 FROM tbl_pindah WHERE id='$dX[idpindah]'"));
			$qB = mysql_query("SELECT norangka FROM tbl_pindah_det WHERE idpindah='$dX[idpindah]'");
	        while($dB = mysql_fetch_array($qB))
	        	{
	        	mysql_query("UPDATE tbl_stokunit SET idgudang='$dA[idgudang2]',updatex='$updatex' WHERE norangka='$dB[norangka]'");
	        	}
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PEMINDAHAN STOK ID $dX[idpindah]')
								");
			}
			
		if(!empty($dX[idopname]))
			{
			$d2 = mysql_fetch_array($q2 = mysql_query("SELECT SUM(hargabeli) AS totjumselisih FROM tbl_opname_det_vw WHERE idopname='$dX[idopname]'"));
			
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_opname SET status='1',totjumselisih='$d2[totjumselisih]' WHERE id='$dX[idopname]'");
			
			$qA = mysql_query("SELECT norangka,keterangan FROM tbl_opname_det WHERE idopname='$dX[idopname]'");
	        while($dA = mysql_fetch_array($qA))
	        	{
				mysql_query("UPDATE tbl_stokunit SET status='$dA[keterangan]' WHERE norangka='$dA[norangka]'");
				}
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI SELISIH STOCK OPNAME ID $dX[idopname]')
								");
			}
			
		if(!empty($dX[idpiutang]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_piutang SET status='0',updatex='$updatex' WHERE id='$dX[idpiutang]'");
			$q3 = mysql_query("UPDATE tbl_kwitansi SET status='1' WHERE nomor='$dX[idpiutang]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID $dX[idpiutang]')
								");
			}
			
		if(!empty($dX[idbyrpiutang]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_piutang SET status='0',updatex='$updatex' WHERE id='$dX[idbyrpiutang]'");
			
			$dcek = mysql_fetch_array(mysql_query("SELECT * FROM tbl_piutang WHERE id='$dX[idbyrpiutang]'"));
			if($dcek[metodebayar]=="GAJI"){
				mysql_query("UPDATE tbl_piutang SET status='1',updatex='$updatex' WHERE id='$dX[idbyrpiutang]'");
				}
				
			$q3 = mysql_query("UPDATE tbl_kwitansi SET status='1' WHERE nomor='$dX[idbyrpiutang]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID $dX[idbyrpiutang]')
								");
			}
			
		if(!empty($dX[idpotkompensasi]))
			{            	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID $dX[idpotkompensasi]')
								");
			if($_REQUEST[metodebayar]=='TUNAI')
				{
				$q2 = mysql_query("UPDATE tbl_potkompensasi SET status='0',updatex='$updatex' WHERE id='$dX[idpotkompensasi]'");
				$q3 = mysql_query("UPDATE tbl_kwitansi SET status='1' WHERE idpotkom='$dX[idpotkompensasi]'");
				$note = "A1";
				//echo "<script>alert ('Proses Berhasil, Mohon Melanjutkan Ke Menu Kwitansi Pada Bagian Kasir.')</script>";	
				}
			else{
				$q2 = mysql_query("UPDATE tbl_potkompensasi SET status='1',updatex='$updatex' WHERE id='$dX[idpotkompensasi]'");
				}
			}
			
		if(!empty($dX[idkwitansi]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_kwitansi SET status='1',updatex='$updatex' WHERE id='$dX[idkwitansi]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI PENGEMBALIAN UANG MUKA/TITIPAN ID $dX[idkwitansi]')
								");
			}
			
		if(!empty($dX[idbensin]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='1' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_bensin SET status='0' WHERE id='$dX[idbensin]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENYETUJUI KONFIRMASI OPNAME BENSIN ID $dX[idkwitansi]')
								");
			}
	
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		}
		
	else if($submenu == 'tolak')
		{      
		$dX = mysql_fetch_array(mysql_query("SELECT * FROM tbl_abis_dkonfirmasi WHERE id='$_REQUEST[id]'"));
		if(!empty($dX[idkaskecil]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_kaskecil SET status='2' WHERE id='$dX[idkaskecil]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI KASKECIL ID $dX[idkaskecil]')
								");
			}
			
		if(!empty($dX[idpesanan]))
			{                       	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_pesanan SET status='0',batal='',updatex='$updatex' WHERE id='$dX[idpesanan]'");
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PEMBATALAN PESANAN ID $dX[idpesanan]')
								");
			}
			
		if(!empty($dX[idreturbeli]))
			{                       	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_returbeli SET status='2',updatex='$updatex' WHERE id='$dX[idreturbeli]'");
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI RETUR BELI ID $dX[idpesanan]')
								");
			}
			
		if(!empty($dX[idpindah]))
			{                       	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_pindah SET status='2' WHERE id='$dX[idpindah]'");
			
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PEMINDAHAN STOK ID $dX[idpindah]')
								");
			}
			
		if(!empty($dX[idopname]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_opname SET status='2' WHERE id='$dX[idopname]'");
			
			$qA = mysql_query("SELECT norangka,keterangan FROM tbl_opname_det WHERE idopname='$dX[idopname]'");
	        while($dA = mysql_fetch_array($qA))
	        	{
				mysql_query("UPDATE tbl_stokunit SET status='STOK' WHERE norangka='$dA[norangka]'");
				}
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI SELISIH STOCK OPNAME ID $dX[idopname]')
								");
			}
			
		if(!empty($dX[idpiutang]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_piutang SET status='2',updatex='$updatex' WHERE id='$dX[idpiutang]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PIUTANG KARYAWAN ID $dX[idpiutang]')
								");
			}
			
		if(!empty($dX[idbyrpiutang]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_piutang SET status='2',updatex='$updatex' WHERE id='$dX[idbyrpiutang]'");
			$q3 = mysql_query("UPDATE tbl_kwitansi SET status='2',cetak='1' WHERE nomor='$dX[idbyrpiutang]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID $dX[idbyrpiutang]')
								");
			}
			
		if(!empty($dX[idpotkompensasi]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_potkompensasi SET status='2',updatex='$updatex' WHERE id='$dX[idpotkompensasi]'");
			$q3 = mysql_query("UPDATE tbl_kwitansi SET status='2',cetak='1' WHERE idpotkom='$dX[idpotkompensasi]'");
			
			$q4 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID $dX[idpotkompensasi]')
								");
			}
			
		if(!empty($dX[idkwitansi]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_kwitansi SET status='2',updatex='$updatex' WHERE id='$dX[idkwitansi]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI PENGEMBALIAN UANG MUKA/TITIPAN ID $dX[idkwitansi]')
								");
			}
			
		if(!empty($dX[idbensin]))
			{              	
			$q1 = mysql_query("UPDATE tbl_abis_dkonfirmasi SET status='2' WHERE id='$_REQUEST[id]'");
			$q2 = mysql_query("UPDATE tbl_bensin SET status='2' WHERE id='$dX[idbensin]'");
				
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_abis_dkonfirmasi',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'MENOLAK KONFIRMASI OPNAME BENSIN ID $dX[idkwitansi]')
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
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example5').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example6').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
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