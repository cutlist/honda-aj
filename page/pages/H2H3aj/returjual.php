<script src="js/jquery.min.js"></script>	
<?
	if($submenu == 'saveB')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
		$qA = mysql_query("SELECT * FROM x23_returjual_det WHERE id%2=0 AND noreturjual='$_SESSION[noreturjual]'");
        while($dA = mysql_fetch_array($qA))
        	{		
        	mysql_query("INSERT INTO x23_stokpart (
        									idgudang, 
        									rak, 
        									nonota, 
        									idbarang,
        									hargabelibersih, 
        									hargajual, 
        									stok, 
        									status, 
        									inputx,
        									updatex) 
        								VALUES (
        									'$dA[idgudang]',
        									'$dA[rak]', 
        									'$dA[nonota]', 
        									'$dA[idbarang]', 
        									'$dA[hargabelibersih]', 
        									'$dA[qty]',
        									'1',
        									NOW(),
        									'$updatex') 
        				");
			}
		/*
		$qB = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND nonota='$_SESSION[nonotajual]'");
        while($dB = mysql_fetch_array($qB))
        	{
        	$dC = mysql_fetch_array(mysql_query("SELECT * FROM x23_returjual_det WHERE id%2=0 AND nonotajual='$_SESSION[nonotajual]' AND noreturjual='$_SESSION[noreturjual]' AND idbarang='$dB[idbarang]'"));
			mysql_query("UPDATE x23_stokpart SET stok=stok+$dC[qty] WHERE id%2=0 AND idgudang='$dB[idgudang]' AND rak='$dB[rak]' AND nonota='$dB[notabeli]' AND idbarang='$dB[idbarang]'");
			}
		*/
			
			$q1 = mysql_query("INSERT INTO x23_returjual (
										noreturjual, 
										nonotajual, 
										tahun, 
										bulan, 
										tanggal, 
										qtyretur,
										jumlah,
										iduser, 
										inputx,
										updatex) 
									VALUES (
										'$_SESSION[noreturjual]', 
										'$_SESSION[nonotajual]', 
										'$p_tahun', 
										'$p_bulan', 
										CURDATE(), 
										'$_REQUEST[totalqty]',
										'$_REQUEST[jumlah]',
										'$_SESSION[id]', 
										NOW(), 
										'$updatex')
								");
						
		$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_returjual',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH NOTA JUAL $_REQUEST[nonota]')
							");
								
							
		if($q1 && $q2)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
		
	else if($submenu == 'A')
		{
		unset ($_SESSION["nonotajual"]);
		unset ($_SESSION["noreturjual"]);
		$p_tahun = date("Y");
		$p_bulan = date("m");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>PENJUALAN <small>RETUR JUAL</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA JUAL / NO. NOTA RETUR / NAMA PELANGGAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> &nbsp; Tambah Baru</button>
										</a>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA RETUR JUAL</th>
			                                    <th style="padding:7px">TGL NOTA RETUR JUAL</th>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th width="" style="padding:7px">NAMA PELANGGAN</th>
			                                    <th width="" style="padding:7px">QTY RETUR BELI</th>
			                                    <th width="" style="padding:7px">JUMLAH RETUR BELI (RP)</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_returjual_vw WHERE id%2=0 AND noreturjual LIKE '%$_REQUEST[cari]%' OR nonotajual LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											$q2 = mysql_query("SELECT * FROM x23_returjual_vw WHERE id%2=0 AND noreturjual LIKE '%$_REQUEST[cari]%' OR nonotajual LIKE '%$_REQUEST[cari]%'");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_returjual_vw ORDER BY id DESC LIMIT 0,20");
											$q2 = mysql_query("SELECT * FROM x23_returjual_vw");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&id=$d1[id]"?>'" style="cursor:pointer">
			                                    <td><?echo $d1[noreturjual]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[noreturjual]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[qtyretur],"0","",".")?> PCS</span></td>
			                                	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlah],"0","",".")?></span></td>
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
		unset($_SESSION[nonotajual]);
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNR = mysql_fetch_array(mysql_query("SELECT noreturjual FROM x23_returjual WHERE id%2=0 AND tanggal=CURDATE() ORDER BY SUBSTR(noreturjual,-3,3) DESC LIMIT 1"));
            
		if(empty($dNR[noreturjual]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNR[noreturjual]",-3,3);
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
			
			$noreturjual = "NRJ$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			$_SESSION[noreturjual] = $noreturjual;
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENJUALAN <small>RETUR JUAL</small></h4>
			                	
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NOMOR RETUR JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="noreturjual" class="form-control" style="width: 40%" value="<?echo $_SESSION[noreturjual]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="30%">NOMOR NOTA JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="nonotajual" class="form-control" style="width: 40%" required ></td>
			                    		</tr>
	                            	</table>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                        <button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'C')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
		if(empty($_SESSION[nonotajual]))
			{
			$_SESSION[nonotajual] = strtoupper($_REQUEST[nonotajual]);
			}
			
		$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_vw WHERE id%2=0 AND nonota='$_SESSION[nonotajual]' AND grup='1' AND nonota NOT IN (SELECT nonotajual FROM x23_returjual)"));
		if(empty($dCek[id]))
			{
			echo "<script>alert ('Mohon Ulangi Nomor Nota Jual Yang Diinput, Karena Nomor Nota Jual Tidak Ada Pada Database.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=B'/>";
			exit();
			}
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id%2=0 AND id='$dCek[idpelanggan]'"));
			
		if(!empty($_REQUEST[temp]))
			{		
			$qty = preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
			$tglnota = date("Y-m-d", strtotime($_REQUEST['tglnota']));
			
			$dcs1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND idbarang='$_REQUEST[idbarang]' AND nonota='$_REQUEST[temp]'"));	
			if($qty > $dcs1[qty]){
				echo "<script>alert ('Mohon Ulangi, Karena Qty Retur Melebihi Qty Yang Dijual Sebelumnya!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&nonotajual=$_REQUEST[temp]'/>";
				exit();
				}	
			if($qty == "0"){
				echo "<script>alert ('Mohon Ulangi, Karena Qty Retur Tidak Boleh 0 (Nol)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&nonotajual=$_REQUEST[temp]'/>";
				exit();
				}
			
	
			if($dcs2[idsupplier]=="1"){
				$ppnbeli = round($dcs1[hargajual] * 0.1 , 0);
				}
				
			$hargajual			= $dcs1[hargajual]+$ppnbeli;
			$jumlah				= $hargajual*$qty;
				
			$q1 = mysql_query("INSERT INTO x23_returjual_det (
												notabeli,
												noreturjual,
												nonotajual,
												tahun,
												bulan,
												tglnota,
												idbarang, 
												hargabelibersih,
												hargajual,
												diskon,
												hargajualbersih,
												qty,
												totdiskon,
												tothargabelibersih,
												total,
												idgudang,
												rak)
											VALUE (
												'$dcs1[nonota]',
												'$_SESSION[noreturjual]',
												'$_REQUEST[temp]',
												'$p_tahun',
												'$p_bulan',
												CURDATE(),
												'$dcs1[idbarang]',
												'$dcs1[hargabelibersih]',
												'$hargajual',
												'0',
												'0',
												'$qty',
												'0',
												'0',
												'$jumlah',
												'$_REQUEST[idgudang]]',
												'$_REQUEST[rak]')
								");
					
			if($q1)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&nonotajual=$_REQUEST[temp]'/>";
				exit();
				}
			}	
			
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_returjual_det WHERE id%2=0 AND id='$_REQUEST[del]'");
			}
			
		if(!empty($_REQUEST[back]))
			{
			mysql_query("DELETE FROM x23_returjual_det WHERE id%2=0 AND noreturjual='$_SESSION[noreturjual]'");
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
			exit();
			}
					
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty,SUM(total) AS ttotal FROM x23_returjual_det_vw WHERE id%2=0 AND noreturjual='$_SESSION[noreturjual]'"));
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PENJUALAN <small>RETUR JUAL</small></h4>
			                	
			                    	<table width="100%">
			                    		<tr>
			                    			<td width="20%">NOMOR RETUR JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="1"><input type="text" name="noreturjual" class="form-control" style="width: 50%" value="<?echo $_SESSION[noreturjual]?>" readonly=""></td>
			                    			<td width="20%">NOMOR NOTA JUAL</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="1"><input type="text" name="nonotajual" class="form-control" style="width: 50%" value="<?echo $_SESSION[nonotajual]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL</td>
			                    			<td>:</td>
			                    			<td colspan="4"><input type="text" name="tglnota" value="<?echo date("d-m-Y")?>" class="form-control" style="width: 12%" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>NAMA PELANGGAN</td>
			                    			<td>:</td>
			                    			<td><input type="text" name="nama" value="<?echo $d1[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" readonly></td>
			                    			<td width="1%" colspan="3"><button type="button" style="padding-top:4px;padding-bottom:4px" class="btn btn-info" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}"><i class="fa fa-caret-square-o-down"></i> &nbsp; Lihat/Sembunyikan Riwayat</button></td>
			                    		</tr>
	                            	</table>
	                            	
			                    	<div id="spoiler" style="display:none">
			                    		<!--
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NOMOR OHC</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="4"><input type="text" name="ohc" value="<?echo $d1[ohc]?>" class="form-control" maxlength="20" placeholder="dikosongkan jika tidak memiliki OHC" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR TELEPON</td>
				                    			<td>:</td>
				                    			<td colspan="4"><input type="text" name="notelepon" value="<?echo $d1[notelepon]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NO. KTP/NO. IDENTITAS</td>
				                    			<td>:</td>
				                    			<td colspan="4"><input type="text" name="noktp" value="<?echo $d1[noktp]?>" class="form-control" maxlength="20" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td valign="top" >ALAMAT</td>
				                    			<td valign="top" >:</td>
				                    			<td valign="top" colspan="4"><textarea name="alamat" maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
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
				                    			<td colspan="4"><select class="form-control" style="width: 60%"  disabled="">
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
				                    			<td colspan="4"><select class="form-control" style="width: 60%" disabled="">
													<option value='<?echo "$d1[kodekab]-$d1[kodekec]-$d1[namakec]"?>' ><?echo $d1[namakec]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td></td>
				                    			<td></td>
				                    			<td colspan="4"><select class="form-control" style="width: 60%;" disabled="">
													<option value='<?echo "$d1[kodekel]-$d1[namakel]"?>' ><?echo $d1[namakel]?></option>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>EMAIL</td>
				                    			<td>:</td>
				                    			<td colspan="4"><input type="email" name="email" value="<?echo $d1[email]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>PEKERJAAN</td>
				                    			<td>:</td>
				                    			<td colspan="4"><input type="text" name="pekerjaan" value="<?echo $d1[pekerjaan]?>" class="form-control" maxlength="40" readonly></td>
				                    		</tr>
		                            	</table>
		                            	-->
		                            	
		                           		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
										<table class="table table-striped table-hover" >
											<thead>
				                                <tr>
				                                    <th width="25%">TGL NOTA JUAL</th>
				                                    <th width="">NO. NOTA JUAL</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $q1 = mysql_query("SELECT * FROM x23_notajual WHERE id%2=0 AND idpelanggan='$dCek[idpelanggan]' ORDER BY tglnota DESC");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr style="cursor: pointer" onclick="window.open('<?echo "?opt=$opt&menu=".md5(historyjual)."&submenu=B&id=$d1[id]"?>', 'newwindow', 'width=300, height=250'); return false;">
				                                    <td align="" valign="middle"><?echo $d1[tglnota]?></td>
				                                    <td align="" valign="middle"><?echo $d1[nonota]?></td>
				                                </tr>
				                                
				                            <?
				                            	$no++;
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
			                    	</div>
					                
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="totalqty" value="<?echo $dB[tqty]?>">
					                    	<input type="hidden" name="jumlah" value="<?echo $dB[ttotal]?>">
					                    	
					                        <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&back=1"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											
		                           				<button data-toggle="modal" data-target="#compose-modal-tambahbarang" type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> &nbsp; Tambah Detail Retur</button>
										</div>
				                    </div>
			                    	</form>
			                	</div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                    <?
			                    $dC1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_returjual_det_vw WHERE id%2=0 AND noreturjual='$_SESSION[noreturjual]'"));
			                    if(!empty($dC1[id]))
			                    	{
			                    ?>
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
			                                    <th width="1%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="1%" style="padding:7px"><center>DEL</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA = mysql_query("SELECT * FROM x23_returjual_det_vw WHERE id%2=0 AND noreturjual='$_SESSION[noreturjual]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td><?echo $dA[gudang]?></td>
			                                    <td><?echo $dA[rak]?></td>
			                                    <td align="center">
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$dA[id]&id=$_REQUEST[id]"?>">
				                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
				                                    		<i class="fa fa-trash-o"></i>
				                                    	</button>
			                                    	</a>
			                                     </td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
			                            		<th colspan="3"></th>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                        <!-- ########################################################################################################### -->
			                    <?
			                    	}
			                    ?>
			                       
			                    </div>
			                </div>
			            </div>
					
				        <div class="modal fade " id="compose-modal-tambahbarang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG RETUR</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td width="" colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px;width:100%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			//$q1 = mysql_query("SELECT * FROM x23_stokpart_group_vw GROUP BY idbarang ORDER BY kodebarang");
																			$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND nonota='$_SESSION[nonotajual]' AND id NOT IN (SELECT idbarang FROM x23_returjual_det WHERE id%2=0 AND nonotajual='$_SESSION[nonotajual]') ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[idbarang]?>'><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY BELI</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
				                                <td></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GUDANG</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="idgudang" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_gudang ORDER BY gudang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($dA[id]==$d3[idgudang]){?>selected=""<?}?>><?echo "$dA[gudang]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak" class="form-control select1" style="font-size:12px;padding:3px;width:40%" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_rak ORDER BY rak");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[rak]?>' <?if($dA[rak]==$d3[rak]){?>selected=""<?}?>><?echo "$dA[rak]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    			<!--
				                    			<td colspan="2"><input type="text" name="rak" maxlength="20" value="<?echo $d3[rak]?>" style="width:20%;" class="form-control"  required></td>
				                    			-->
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td colspan="4"><div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4"><b>ISI TANGGAL NOTA BELI UNTUK BARANG YANG AKAN DIRETUR</b></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tglnota" class="form-control" style="width: 20%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
				                    		</tr>
				                    		-->
					                    	<input type="hidden" name="temp" value="<?echo $_SESSION[nonotajual]?>">
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

			        </div>
				</section>
			</aside>
			
<?
		}
?>		
        <script>
        //SELECT2
			$(function(){
			  var select = $('.select1').select2();
			}); 
			$(document).ready(function() {});
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