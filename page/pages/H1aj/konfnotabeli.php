<?
	if($submenu == 'unit')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Nota Beli Sudah Dapat Dibayar.</p>
	                                    </div>
									<?
										}
									if($_REQUEST[note]=="2")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Terdapat Selisih Didalam Konfirmasi Nota Beli. Harap Menghubungi Pihak Manajemen.</p>
	                                    </div>
									<?
										}
									?>
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">TGL NOTA BELI</th>
			                                    <th style="padding:7px">NO. FAKTUR</th>
			                                    <th style="padding:7px">TGL FAKTUR</th>
			                                    <th style="padding:7px">NO. SURAT PESANAN</th>
			                                    <th style="padding:7px">TGL SURAT PESANAN</th>
			                                    <th width="13%" style="padding:7px">QTY BELI (UNIT)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND scan='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$dA = mysql_fetch_array(mysql_query("SELECT id FROM tbl_notabeli WHERE id%2=0 AND bayar='' AND id='$d1[id]'"));
											if(!empty($dA[id]))
												{
			                            ?>
				                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=u1&id=$d1[id]"?>'">
				                                    <td><?echo $d1[nonota]?></td>
				                                    <td><?echo $d1[tglnota]?></td>
				                                    <td><?echo $d1[nodo]?></td>
				                                    <td><?echo $d1[tgldo]?></td>
				                                    <td><?echo $d1[nopo]?></td>
				                                    <td><?echo $d1[tglpo]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
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
			        </div>
				</section>
			</aside>
<?
		}
	else if($submenu == 'u1')
		{
		$p_tahun = date("Y");
		$p_bulan = date("m");
		
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
		
		if(!empty($_REQUEST[scan]))
			{
			$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli_det WHERE id%2=0 AND norangka='$_REQUEST[scan]'"));
			$ppn = 	ROUND(($d2[hargabelibersih]*10)/100);	
			
			if($d2[status]=='0')
				{
				mysql_query("UPDATE tbl_notabeli_det SET status='1' WHERE id%2=0 AND norangka='$_REQUEST[scan]' AND nonota='$d1[nonota]'");
				mysql_query("UPDATE tbl_notabeli SET gtbayar=gtbayar+$d2[hargabelibersih],gtbayarppn=gtbayarppn+$ppn WHERE id%2=0 AND nonota='$d1[nonota]'");
				}
			}
			
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK</small></h4>
			                	
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-5">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">NO. FAKTUR</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="nodo" value="<?echo $d1[nodo]?>" class="form-control" maxlength="20" style="width:100%" disabled=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. SURAT PESANAN</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:100%" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">TGL FAKTUR </td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tgldo" value="<?echo date("d-m-Y", strtotime($d1[tgldo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:90%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL SURAT PESANAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y", strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:90%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y", strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:90%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-3">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%" valign="top">MEMO</td>
					                        		<td width="3%" valign="top">:</td>
					                    			<td valign="top"><textarea name="memo" class="form-control" style="width:100%;height:90px" readonly=""><?echo $d1[memo]?></textarea></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
									<!--
					            	<form method="post" action="">
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="20%">SCAN</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="scan" autofocus class="form-control" maxlength="40" style="width:100%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                </form>
									-->
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u2"?>">
			                        <table class="table table-striped" id="example4">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no = 0;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
				                            if($dA[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												//$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
												}
											else if($dA[status]=='0'){
												$status = "-";
												//$checkbox = "<input type='checkbox' class='flat-red' name='scan[]' value='$dA[norangka]'/>";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                	<!--
			                                    <td><label><?echo "$checkbox $dA[kodebarang]"?></label></td>
			                                    -->
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[warna]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td><?echo $status?></td>
			                                </tr>
			                            <?
											$no++;
			                            	}
											
			                             ?>
			                            </tbody>
			                        </table>
									</br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>1. Klik <i class="fa fa-star"></i></i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>2. Scan Nomor Rangka Untuk Melakukan Konfirmasi Nota Beli</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>3. Klik Lanjutkan</i></span>
									
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
										<?
										if($no!="0"){
										?>
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
										<?	
										}
										?>
											<button type="button" class="btn btn-warning" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&id=$_REQUEST[id]"?>'"><i class="fa fa-star"></i></button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=unit"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                        </form>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			<form method="post" action="">
				<input type="text" name="scan" autofocus maxlength="40" style="width:0%">
			</form>
<?
		}
		
	else if($submenu == 'u2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT nodo,nonota FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
		
		/*
		foreach($_REQUEST['scan'] AS $scan)
			{
			$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli_det WHERE id%2=0 AND norangka='$scan'"));
			
			mysql_query("UPDATE tbl_notabeli_det SET status='1' WHERE id%2=0 AND norangka='$scan'");
			mysql_query("UPDATE tbl_notabeli SET gtbayar=gtbayar+$d2[hargabelibersih] WHERE id%2=0 AND nonota='$d1[nonota]'");
			}
		*/
		if(!empty($_REQUEST['scan']))
			{
			$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli_det WHERE id%2=0 AND norangka='$scan'"));
			$ppn = 	ROUND(($d2[hargabelibersih]*10)/100);	 
			
			if($d2[status]=='0')
				{
				mysql_query("UPDATE tbl_notabeli_det SET status='1' WHERE id%2=0 AND norangka='$scan'");
				mysql_query("UPDATE tbl_notabeli SET gtbayar=gtbayar+$d2[hargabelibersih],gtbayarppn=gtbayarppn+$ppn WHERE id%2=0 AND nonota='$d1[nonota]'");
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
			                						                
						            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u3"?>">
						            <?
									$dHitung = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
									$h1 = $dHitung[total];
									$h2 = $dHitung[total]*2;
						            ?>
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="bukuservis" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $h2?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>JAKET</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="jaket" value="0" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%">ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="anakkunci" value="<?echo $h1?>" class="form-control" onkeypress="return buat_angka(event,'1234567890')" maxlength="4" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="0" class="form-control" maxlength="4" onkeypress="return buat_angka(event,'1234567890')" style="width:40%;text-align:right;" required=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px" width="12%">TGL TIBA</th>
			                                    <th style="padding:7px">GUDANG</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
				                            if($dA[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
												}
											else if($dA[status]=='0'){
												$status = "-";
												$checkbox = "<input type='checkbox' class='flat-red' name='scan[]'/>";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[warna]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td><input type="text" name="tgltiba<?echo $dA[id]?>" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
			                                    <td><select name="idgudang<?echo $dA[id]?>" class="form-control" required style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($dA[idgudang]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
			                                </tr>
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=u1&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
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
		
	else if($submenu == 'u3')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT nodo,nonota,tglnota FROM tbl_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
		
		$qA = mysql_query("SELECT id FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'");
        while($dA = mysql_fetch_array($qA))
        	{
        	$id = $dA[id];
        	$tgltiba  = date("Y-m-d", strtotime($_REQUEST[tgltiba.$id]));
			/*
				echo "<script>alert ('$tgltiba.$d1[tglnota]')</script>";
				exit();
				*/
		
			if($tgltiba < $d1[tglnota])
				{
				echo "<script>alert ('Tanggal Tiba Tidak Bisa Lebih Kecil Dari Tanggal Nota Beli.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=u2&id=$_REQUEST[id]'/>";
				exit();
				}
        	$idgudang = $_REQUEST[idgudang.$id];
        	mysql_query("UPDATE tbl_notabeli_det SET tgltiba='$tgltiba',idgudang='$idgudang' WHERE id%2=0 AND id='$id'");
        	}
        	
		$dHitung = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'"));
		$h1 = $dHitung[total];
		$h2 = $dHitung[total]*2;
		
		mysql_query("TRUNCATE tbl_temp_qtytiba");
		if($_REQUEST[helm] != $h1){
			$red1 = "style='color:red'";
	        mysql_query("INSERT INTO tbl_temp_qtytiba values ('1')");
			}
		if($_REQUEST[bukuservis] != $h1){
			$red2 = "style='color:red'";
	        mysql_query("INSERT INTO tbl_temp_qtytiba values ('1')");
			}
		if($_REQUEST[spion] != $h2){
			$rd3 = "style='color:red'";
	        	mysql_query("INSERT INTO tbl_temp_qtytiba values ('1')");
			}
		if($_REQUEST[accu] != $h1){
			$red4 = "style='color:red'";
	        mysql_query("INSERT INTO tbl_temp_qtytiba values ('1')");
			}
		if($_REQUEST[toolkit] != $h1){
			$red6 = "style='color:red'";
	        mysql_query("INSERT INTO tbl_temp_qtytiba values ('1')");
			}
		if($_REQUEST[anakkunci] != $h1){
			$red7 = "style='color:red'";
	        mysql_query("INSERT INTO tbl_temp_qtytiba values ('1')");
			}
			
		$dD = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS cek FROM tbl_temp_qtytiba"));
		/*
		echo "<script>alert ('$dD[cek].')</script>";
		exit();
		*/
        if($dD[cek] > "0")
        	{
        	mysql_query("UPDATE tbl_notabeli SET ikesalahanacc='1' WHERE id%2=0 AND id='$_REQUEST[id]'");
        	}
        
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
			                						                
						            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u4"?>">
				                	<div style="padding:20px 0px">
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%" <?echo $red1?>>HELM</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="helm" value="<?echo $_REQUEST[helm]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red2?>>BUKU SERVIS</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="bukuservis" value="<?echo $_REQUEST[bukuservis]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red3?>>SPION</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="spion" value="<?echo $_REQUEST[spion]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%" <?echo $red4?>>ACCU</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="accu" value="<?echo $_REQUEST[accu]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red5?>>JAKET</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="jaket" value="<?echo $_REQUEST[jaket]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td <?echo $red6?>>TOOLKIT</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="toolkit" value="<?echo $_REQUEST[toolkit]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-4">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="50%" <?echo $red7?>>ANAK KUNCI 2 PCS</td>
					                        		<td width="3%">:</td>
					                        		<td><input type="text" name="anakkunci" value="<?echo $_REQUEST[anakkunci]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        	<tr>
					                        		<td>ALAS KAKI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="alaskaki" value="<?echo $_REQUEST[alaskaki]?>" class="form-control" maxlength="4" style="width:40%;text-align:right;" readonly=""></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NO. RANGKA</th>
			                                    <th style="padding:7px">NO. MESIN</th>
			                                    <th style="padding:7px" width="12%">TGL TIBA</th>
			                                    <th style="padding:7px">GUDANG</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]' AND status='1'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
				                            if($dA[status]=='1'){
												$status = "<span class='label label-success'>ADA</span>";
												$checkbox = "<input type='checkbox' class='flat-red' checked disabled=''/>";
												}
											else if($dA[status]=='0'){
												$status = "-";
												$checkbox = "<input type='checkbox' class='flat-red' name='scan[]'/>";
												}
											$dB = mysql_fetch_array(mysql_query("SELECT gudang FROM tbl_gudang WHERE id%2=0 AND id='$dA[idgudang]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo $dA[namabarang]?></td>
			                                    <td><?echo $dA[varian]?></td>
			                                    <td><?echo $dA[warna]?></td>
			                                    <td><?echo $dA[norangka]?></td>
			                                    <td><?echo $dA[nomesin]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($dA[tgltiba]))?></td>
			                                    <td><?echo $dB[gudang]?></td>
			                                </tr>
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=u1&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
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
		
	else if($submenu == 'u4')
		{
			  mysql_query("DELETE FROM tbl_stokunit WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$qA = mysql_query("SELECT * FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$_REQUEST[nonota]' AND status='1'");
        while($dA = mysql_fetch_array($qA))
        	{
        	$bulan = substr($dA[tgltiba],5,2);
        	$tahun = substr($dA[tgltiba],0,4);
        	mysql_query("INSERT INTO tbl_stokunit (
        									tahun, 
        									bulan, 
        									tgltiba, 
        									idgudang, 
        									nonota, 
        									idbarang, 
        									norangka, 
        									nomesin, 
        									hargabelibersih, 
        									ppn, 
        									status, 
        									inputx,
        									iduser,
        									updatex) 
        								VALUES (
        									'$tahun', 
        									'$bulan', 
        									'$dA[tgltiba]', 
        									'$dA[idgudang]', 
        									'$dA[nonota]', 
        									'$dA[idbarang]', 
        									'$dA[norangka]', 
        									'$dA[nomesin]', 
        									'$dA[hargabelibersih]', 
        									'$dA[ppn]', 
        									'STOK',
        									NOW(),
        									'$_SESSION[id]',
        									'$updatex') 
        				");
        	}
			$q1 = mysql_query("UPDATE tbl_notabeli SET scan='1',updatex='$updatex' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			$note =1;
		/*
		$dB = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS qty FROM tbl_notabeli_det2_vw WHERE id%2=0 AND nonota='$_REQUEST[nonota]' AND status='1'"));
		$dC = mysql_fetch_array(mysql_query("SELECT qty FROM tbl_notabeli WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		if($dB[qty]==$dC[qty])
			{
			$q1 = mysql_query("UPDATE tbl_notabeli SET scan='1',updatex='$updatex' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			$note =1;
			}
		else
			{
			$q1 = mysql_query("UPDATE tbl_notabeli SET updatex='$updatex' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			$note =2;
			}
		*/
        
			  mysql_query("DELETE FROM stok_accu WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$q2 = mysql_query("INSERT INTO stok_accu VALUES ('$_REQUEST[nonota]','$_REQUEST[accu]','')");
		
			  mysql_query("DELETE FROM stok_alaskaki WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$q3 = mysql_query("INSERT INTO stok_alaskaki VALUES ('$_REQUEST[nonota]','$_REQUEST[alaskaki]','')");
		
			  mysql_query("DELETE FROM stok_anakkunci WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$q4 = mysql_query("INSERT INTO stok_anakkunci VALUES ('$_REQUEST[nonota]','$_REQUEST[anakkunci]','')");
		
			  mysql_query("DELETE FROM stok_helm WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$q5 = mysql_query("INSERT INTO stok_helm VALUES ('$_REQUEST[nonota]','$_REQUEST[helm]','')");
		
			  mysql_query("DELETE FROM stok_spion WHERE id%2=0 AND nonota='$_REQUEST[nonota])");
		$q6 = mysql_query("INSERT INTO stok_spion VALUES ('$_REQUEST[nonota]','$_REQUEST[spion]','')");
		
			  mysql_query("DELETE FROM stok_toolkit WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$q7 = mysql_query("INSERT INTO stok_toolkit VALUES ('$_REQUEST[nonota]','$_REQUEST[toolkit]','')");
		
			  mysql_query("DELETE FROM stok_jaket WHERE id%2=0 AND nonota='$_REQUEST[jaket]'");
		$q8 = mysql_query("INSERT INTO stok_jaket VALUES ('$_REQUEST[nonota]','$_REQUEST[jaket]','')");
		
			  mysql_query("DELETE FROM stok_bukuservis WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$q9 = mysql_query("INSERT INTO stok_bukuservis VALUES ('$_REQUEST[nonota]','$_REQUEST[bukuservis]','')");
		
		$q10 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_stokunit',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH STOK $_REQUEST[nonota]')
							");
				
		
		if($q1)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=unit&note=$note'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=unit'/>";
			exit();
			}
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
		$('#uang3').on('keypress', function(e) {
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
		$('#uang4').on('keypress', function(e) {
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
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
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
                    "bAutoWidth": false
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