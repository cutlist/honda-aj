<?
	if($submenu == 'A')
		{		
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_indent WHERE noindent='$_REQUEST[del]'");
			mysql_query("DELETE FROM x23_indent_det WHERE noindent='$_REQUEST[del]'");
			}
					
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
			                	<h4>PENJUALAN <small>DAFTAR INDENT</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Penambahan Uang Muka Untuk Nomor Nota Indent <?echo $_REQUEST[ni]?> Berhasil. Proses Dilanjutkan Ke Menu Kwitansi Indent Pada Bagian Kasir.</p>
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
	                                        <p>Proses Berhasil, Proses Dilanjutkan Ke Menu Kwitansi Penjualan Pada Bagian Kasir.</p>
	                                    </div>
									<?
										}
									?>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA INDENT / NAMA PELANGGAN ..." class="form-control"/>
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
											<button type="button"  onclick="window.open('print/h2/indent.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
									<table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="17%">NO. NOTA INDENT</th>
			                                    <th style="padding:7px" width="12%">TGL NOTA INDENT</th>
			                                    <th style="padding:7px" width="35%">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">NO. TELEPON</th>
			                                    <th style="padding:7px" width="12%">TOTAL QTY INDENT</th>
			                                    <!--
			                                    <th style="padding:7px" width="12%">JUMLAH STOK</th>
			                                    -->
			                                    <th style="padding:7px" width="15%">TOTAL UANG MUKA (RP)</th>
			                                    <th style="padding:7px" width="12%">STATUS</th>
			                                    <th style="padding:7px" width="1%">DEL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_indent_vw WHERE (nama LIKE '%$_REQUEST[cari]%' OR noindent LIKE '%$_REQUEST[cari]%' OR tglindent LIKE '%$_REQUEST[cari]%') LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_indent_vw WHERE status='0' ORDER BY id DESC LIMIT 0,20");
											}
										while($d1 = mysql_fetch_array($q1))
			                            	{
											if($d1[status]=='0'){
				                            	$d2 = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE idbarang IN (SELECT idbarang FROM x23_indent_det WHERE noindent='$d1[noindent]') GROUP BY idbarang"));
				                            	if($d2[stok]<$d1[totalqty]){
													$status = "<span class='label label-warning'>MENUNGGU</span>";
													}
												else{
													$status = "<span class='label label-success'>ADA</span>";
													}
												}
											if($d1[status]=='1'){
												$status = "<span class='label label-info'>SELESAI</span>";
												}
												
											$d3 = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS jumlah FROM x23_kwitansi WHERE jnskwitansi='indent' AND nomor='$d1[noindent]' AND status='1'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT status FROM x23_kwitansi WHERE jnskwitansi='penjualan' AND nomor='$d1[notajual]'"));
											if(!empty($d1[notajual]))
												{
												if($d4[status]=="1")
													{
				                        ?>
					                                <tr style="cursor:pointer">
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[noindent]?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglindent]))?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty])?> PCS</span></td>
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:30%"><?echo number_format($d3[jumlah])?></span></td>
					                                    <!--
					                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d2[stok])?> PCS</span></td>
					                                    -->
					                                    <td align="center"><?echo $status?></td>
					                                    <td align="center">
															<?
															if($d1[status]=='0'){
															if($_SESSION[posisi]=='DIREKSI'){
															?>
						                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[noindent]"?>">
							                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
							                                    		<i class="fa fa-trash-o"></i>
							                                    	</button>
						                                    	</a>
															<?}}?>
					                                     </td>
					                                </tr>
			                            <?
													}
												}
											else{
				                        ?>
				                                <tr style="cursor:pointer">
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[noindent]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo date("d-m-Y",strtotime($d1[tglindent]))?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[nama]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'"><?echo $d1[notelepon]?></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty])?> PCS</span></td>
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:30%"><?echo number_format($d3[jumlah])?></span></td>
				                                    <!--
				                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$d1[id]"?>'" align="right"><span style="padding-right:20%"><?echo number_format($d2[stok])?> PCS</span></td>
				                                    -->
				                                    <td align="center"><?echo $status?></td>
				                                    <td align="center">
														<?
														if($d1[status]=='0'){
														?>
					                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[noindent]"?>">
						                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
						                                    		<i class="fa fa-trash-o"></i>
						                                    	</button>
					                                    	</a>
														<?}?>
				                                     </td>
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
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent_vw WHERE id='$_REQUEST[id]'"));
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qty) AS tqty FROM x23_indent_det_vw WHERE noindent='$d1[noindent]'"));
		
		$dC = mysql_fetch_array(mysql_query("SELECT *,SUM(jumlah) AS jumlah FROM x23_kwitansi WHERE nomor='$d1[noindent]' AND jnskwitansi='indent' AND status='1'"));
		if(empty($dC[jumlah])){
			$status = "1";
			}
		else{
			$status = "2";
			}
			
		if($_REQUEST[tambahdp]=="1")
			{	
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansi WHERE jnskwitansi='indent' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
				$nokwitansi = "KI$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			$jumlahtambahdp  	= preg_replace( "/[^0-9]/", "",$_REQUEST['jumlahtambahdp']);
				
			if($jumlahtambahdp=="0"){
				echo "<script>alert ('Mohon Ulangi, Karena Jumlah Tidak Boleh Nol (0)!')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&id=$_REQUEST[id]'/>";
				exit();
				}
			
			$q1 = mysql_query("INSERT INTO x23_kwitansi (
													jnskwitansi, 
													nokwitansi, 
													tahun, 
													bulan, 
													tanggal, 
													nomor, 
													idpelanggan, 
													noantrian, 
													nopol, 
													jumlah, 
													user,
													keterangan, 
													tambahdp,
													status,
													inputx, 
													updatex) 
												VALUES (
													'indent', 
													'$nokwitansi', 
													'$p_tahun', 
													'$p_bulan', 
													CURDATE(), 
													'$d1[noindent]', 
													'$d1[idpelanggan]', 
													'', 
													'', 
													'$jumlahtambahdp', 
													'$_SESSION[id]', 
													'',
													'1', 
													'0', 
													NOW(), 
													'$updatex')
							");
							
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1&ni=$d1[noindent]'/>";
			exit();
			}
?>

			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PENJUALAN <small>RIWAYAT PENJUALAN <?//echo $status?></small></h4>
			                	
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NO. NOTA INDENT</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="noindent" class="form-control" style="width: 40%" value="<?echo $d1[noindent]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL NOTA INDENT</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text" name="tglindent" value="<?echo date("d-m-Y",strtotime($d1[tglindent]))?>" class="form-control" style="width: 20%" readonly=""></td>
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
					                <?
		                        	if($status=='1')
		                        		{
									?>
			                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
			                                        <i class="fa fa-warning"></i>
			                                        <b>Catatan!</b>
			                                        <p>Silahkan Membuat Kwitansi Indent Terlebih Dahulu.</p>
			                                    </div>
									<?
										}
									?>
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                        	<?
											if($d1[status]=='0'){
					                        	if($status=='2')
					                        		{
											?>
													<button type="button" class="btn btn-info pull-left" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=C&noindent=$d1[noindent]&idnotaindent=$d1[id]"?>'"><i class="fa fa-mail-forward"></i> &nbsp;Buat Nota Penjualan</button>
													<button type="submit" class="btn btn-warning pull-left"data-toggle="modal" data-target="#compose-modal-baru"><i class="fa fa-plus"></i> &nbsp; Tambah Uang Muka</button>
											<?
													}
												}
				                        	?>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                	</div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="15%" style="padding:7px"><center>QTY INDENT</center></th>
			                                    <th width="15%" style="padding:7px"><center>JUMLAH STOK</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qA = mysql_query("SELECT * FROM x23_indent_det_vw WHERE noindent='$d1[noindent]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE idbarang IN ($dA[idbarang]) GROUP BY idbarang"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[kodebarang]?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($d2[stok],"0","",".")?> PCS</span></td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
												<td></td>
			                            	</tr>
			                            </tfoot>
			                        </table>
			                    </div>
			                </div>
			            </div>
			        </div>
				</section>
			</aside>
			
<!-- ################## MODAL TAMBAH ########################################################################################## -->
	        <div class="modal fade " id="compose-modal-baru" tabindex="-1" role="dialog" aria-hidden="true">
	            <div class="modal-dialog" style="width:45%;">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                        <h4 class="modal-title">TAMBAH UANG MUKA</h4>
	                    </div>
						
	                   	<form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
	                    	<table width="100%">
	                    		<tr>
	                    			<td width="40%">TOTAL UANG MUKA</td>
	                    			<td width="2%">:</td>
	                    			<td><div class="input-group">
	                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
	                                        	<input type="text" name="jumlahbayar" value="<?echo number_format($dC[jumlah],"0","",".")?>" disabled="" style="width:40%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" > 
	                                    </div>                                        		
	                                </td>
	                    		</tr>
	                    		<tr>
	                    			<td>TAMBAH UANG MUKA</td>
	                    			<td>:</td>
	                    			<td><div class="input-group">
	                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
	                                        	<input type="text" name="jumlahtambahdp" value="" maxlength="12" required="" style="width:40%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" > 
	                                    </div>                                        		
	                                </td>
	                    		</tr>
		                    	<input type="hidden" name="tambahdp" value="1">
                        	</table>
	               		</div>
                        <div class="modal-footer clearfix">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
							<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
	                	</div>
						</form>
	                </div>
	            </div>
	        </div>
<!-- ################################################################################################################################# -->
<?
		}
		
	else if($submenu == 'C')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
		mysql_query("DELETE FROM x23_notajual_det WHERE notabeli=''");
		mysql_query("DELETE FROM x23_notajual_det WHERE nonota='$nonota'");
		
		mysql_query("DELETE FROM x23_abis_ikesalahan WHERE idnotaindent='$_REQUEST[idnotaindent]'");
			
		$qA = mysql_query("SELECT * FROM x23_indent_det WHERE noindent='$_REQUEST[noindent]'");
		while($dA = mysql_fetch_array($qA))
			{
			mysql_query("INSERT INTO x23_notajual_det (
										notaindent,
										tahun,
										bulan,
										tglnota,
										idbarang, 
										hargabelibersih,
										hargajual,
										diskon,
										hargajualbersih,
										qtyindent,
										qtyindentsisa,
										qty,
										totdiskon,
										tothargabelibersih,
										total,
										idgudang,
										rak)
									VALUE (
										'$_REQUEST[noindent]',
										'$p_tahun',
										'$p_bulan',
										CURDATE(),
										'$dA[idbarang]',
										'',
										'',
										'',
										'',
										'$dA[qty]',
										'$dA[qty]',
										'0',
										'',
										'',
										'',
										'',
										'')
								");
			}
			
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=D&noindent=$_REQUEST[noindent]&save=1'/>";
		exit();
		}
		
	else if($submenu == 'D')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNJ = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notajual WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNJ[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNJ[nonota]",-3,3);
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
			
			$nonotaik = "NJ2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
		
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_indent_vw WHERE noindent='$_REQUEST[noindent]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
		
		//echo "<script>alert ('$_REQUEST[idbarang].$_REQUEST[tglnota]')</script>";
		//exit();
		
		if(!empty($_REQUEST[del]))
			{
			$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$_REQUEST[idbarang]'"));
			$dP = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$dA[idpelanggan]'"));
			$q1 = mysql_query("DELETE FROM x23_notajual_det WHERE id='$_REQUEST[del]'");		
			
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_abis_ikesalahan WHERE idnotaindent='$dA[id]' AND notajual='$nonotaik' AND idbarangindent='$_REQUEST[idbarang]'"));
			if(empty($dCek[id]))
				{
				$q2 = mysql_query("INSERT INTO x23_abis_ikesalahan (
													idnotaindent, 
													notajual, 
													idbarangindent, 
													tahun, 
													bulan, 
													tanggal,
													kasus, 
													tbl,
													inputx) 
												VALUES (
													'$dA[id]',
													'$nonotaik',
													'$_REQUEST[idbarang]',
													'$p_tahun',
													'$p_bulan',
													CURDATE(),
													'INDIKASI KESALAHAN : $dBrg[kodebarang] | $dBrg[namabarang] | $dBrg[varian] TELAH DIHAPUS DARI NOTA INDENT $dA[noindent] A.N. $dP[nama]', 
													'x23_indent_det', 
													NOW())
								");	
				}
				
			
				//echo "<script>alert ('$dP[nama].$dA[idpelanggan].$dA[noindent]')</script>";
				//exit();
			}
				
		$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(qtyindent) AS tqtyindent,SUM(qty) AS tqty, SUM(total) AS ttotal, SUM(totdiskon) AS totdiskon, SUM(tothargabelibersih) AS tothargabelibersih FROM x23_notajual_det WHERE nonota=''"));
		$dZ = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS jumlah FROM x23_kwitansi WHERE jnskwitansi='indent' AND nomor='$_REQUEST[noindent]' AND status='1'"));
		
		$grandtotal = $dB[ttotal]-$dZ[jumlah];
								
?>
			        
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
				        <form method="post" name="indent" onsubmit="return validA();" action="<?echo "?opt=$opt&menu=$menu&submenu=saveB"?>" enctype="multipart/form-data">
			            <div class="col-xs-12" style="margin-bottom:10px">                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>PENJUALAN <small>NAMA BARANG</small></h4>
			                	
			                    	<table width="70%">
			                    		<tr>
			                    			<td width="30%">NO. NOTA INDENT</td>
			                    			<td width="2%">:</td>
			                    			<td colspan="2"><input type="text" name="noindent" class="form-control" style="width: 40%" value="<?echo $dA[noindent]?>" readonly=""></td>
			                    		</tr>
			                    		<tr>
			                    			<td>TANGGAL NOTA JUAL</td>
			                    			<td>:</td>
			                    			<td colspan="2"><input type="text"  value="<?echo date("d-m-Y")?>" class="form-control" style="width: 20%" readonly=""></td>
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
				                    			<td valign="top" colspan="2"><textarea maxlength="400" class="form-control" readonly><?echo $d1[alamat]?></textarea></td>
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
				                                        <input type="text" value="<?echo $d1[rw]?>" class="form-control" placeholder="-" style="width:22%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" readonly>
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
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="nonota" value="<?echo $dB[nonota]?>">
					                    	<input type="hidden" name="id" value="<?echo $dA[id]?>">
					                    	<input type="hidden" name="noindent" value="<?echo $dA[noindent]?>">
					                    	<input type="hidden" name="idpelanggan" value="<?echo $d1[id]?>">
					                    	<input type="hidden" name="totalqty" value="<?echo $dB[tqty]?>">
					                    	<input type="hidden" name="totdiskon" value="<?echo $dB[totdiskon]?>">
					                    	<input type="hidden" name="tothargabelibersih" value="<?echo $dB[tothargabelibersih]?>">
					                    	<input type="hidden" name="ttotal" value="<?echo $dB[ttotal]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $grandtotal?>">
					                    	<?
											$dCh = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE nonota=''"));
											if(!empty($dCh[id]))
												{
											?>
												<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<?
												}
											?>
					                        <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B&id=$dA[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
				                    </div>
			                	</div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:auto;height:260px;">
			                    <?
			                    $dC1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE nonota=''"));
			                    if(!empty($dC1[id]))
			                    	{
			                    ?>
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="" style="padding:7px"><center>HARGA JUAL (RP)</center></th>
			                                    <th width="1%" style="padding:7px"><center>DISKON/PCS (RP)</center></th>
			                                    <th width="7%" style="padding:7px"><center>QTY INDENT</center></th>
			                                    <th width="7%" style="padding:7px"><center>QTY JUAL</center></th>
			                                    <th width="" style="padding:7px"><center>JUMLAH INDENT (RP)</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                    <th width="1%" style="padding:7px"><center>UBAH</center></th>
			                                    <th width="1%" style="padding:7px"><center>HAPUS</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$qC = mysql_query("SELECT * FROM x23_notajual_det2_vw WHERE nonota=''");
										$qD = mysql_query("SELECT * FROM x23_notajual_det2_vw WHERE nonota=''");
										$qE = mysql_query("SELECT * FROM x23_notajual_det2_vw WHERE nonota=''");
			                            while($dD = mysql_fetch_array($qD))
			                            	{
											$dX = mysql_fetch_array(mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id='$dD[id]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dD[kodebarang]?></td>
			                                    <td><?echo "$dD[namabarang] | $dD[varian]"?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dX[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dX[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dD[qtyindent],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dD[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dX[total],"0","",".")?></span></td>
			                                    <td><?echo $dX[gudang]?></td>
			                                    <td><?echo $dX[rak]?></td>
			                                    <td align="center">
				                                    <?
				                                    if($dD[qty]=='0')
				                                    	{
													?>
				                                    	<a data-toggle="modal" data-target="#compose-modalubah<?echo $dD[id]?>"><i class="fa fa-edit"></i></a>
													<?
														}
				                                    ?>
			                                    </td>
			                                    <td align="center">
												<?if($_SESSION[posisi]=='DIREKSI'){?>
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$dD[id]&idbarang=$dD[idbarang]&noindent=$_REQUEST[noindent]"?>"><i class="fa fa-trash-o"></i></a></td>
			                                    <?}?>
			                                    <!--
			                                    <td align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	<li><a data-toggle="modal" data-target="#compose-modalubah<?echo $dD[id]?>"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$dD[id]&noindent=$_REQUEST[noindent]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
			                                    -->	
			                                </tr>
											<input type="hidden" name="gudang<?echo $dD[id]?>" value="<?echo $dX[gudang]?>">
			                                
											<script>
											function validA()
												{
												if (document.indent.gudang<?echo $dD[id]?>.value == '')
													{
													alert ("Mohon periksa Kembali, Karena Ada Barang Yang Belum Dilengkapi!");	 	
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
			                            </tbody>
			                            <tfoot>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>GRAND TOTAL</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[tqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dB[ttotal])?></b></span></td>
			                            		<th colspan="4"></th>
			                            	</tr>
			                            	<tr>
			                            		<th colspan="2"></th>
			                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>JUMLAH UANG MUKA</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($dZ[jumlah])?></b></span></td>
			                            		<th colspan="4"></th>
			                            	</tr>
											<?
											if($grandtotal < '0'){
											?>
				                            	<tr style="color:red">
				                            		<th colspan="2"></th>
				                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>KELEBIHAN BAYAR</b></span></td>
				                            		<td colspan="" align="right"></td>
				                            		<td colspan="" align="right"></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($grandtotal*(-1))?></b></span></td>
				                            		<th colspan="4"></th>
				                            	</tr>
				                            	<tr style="color:red">
				                            		<th colspan="2"></th>
				                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>KEMBALI</b></span></td>
				                            		<td colspan="" align="right"></td>
				                            		<td colspan="" align="right"></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($grandtotal*(-1))?></b></span></td>
				                            		<th colspan="4"></th>
				                            	</tr>
			                            	<?
			                            		}
			                            	else
			                            		{
			                            	?>
				                            	<tr>
				                            		<th colspan="2"></th>
				                            		<td colspan="2" align="right"><span style="margin-right:20%"><b>KEKURANGAN BAYAR</b></span></td>
				                            		<td colspan="" align="right"></td>
				                            		<td colspan="" align="right"></td>
				                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($grandtotal)?></b></span></td>
				                            		<th colspan="4"></th>
				                            	</tr>
			                            	<?
			                            		}
			                            	?>
			                            </tfoot>
			                        </table>
			                        <!-- ########################################################################################################### -->
			                    <?
			                    	}
			                    ?>
			                    </div>
			                </div>
			            </div>
			            </form>
					<?
                    while($dE = mysql_fetch_array($qE))
                    	{
						if($_REQUEST[temp]==$dE[id])
							{
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
								echo "<script>alert ('Mohon Ulangi, Karena Tanggal Nota Beli Untuk Barang Tersebut Tidak Ada!')</script>";
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&noindent=$_REQUEST[noindent]'/>";
								exit();
								}
							else{				
								$qty 				= preg_replace( "/[^0-9]/", "",$_REQUEST['qty']);
								if($_REQUEST[optdis] == "1")
									{
									$diskon	= preg_replace( "/[^0-9]/", "",$_REQUEST['diskon2']);
									}
								if($_REQUEST[optdis] == "2")
									{
									$diskon	= ROUND((($dStok[hargajual]*$_REQUEST[diskon1])/100),0);
									}
								
								if($qty > $dStok[stok])
									{
									echo "<script>alert ('Mohon Ulangi, Karena Stok Untuk Nota Beli Tersebut Tidak Tersedia!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&noindent=$_REQUEST[noindent]'/>";
									exit();
									}
								
								if($diskon > $dStok[hargajual]){
									//$dStok = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli_det_vw WHERE idbarang='$_REQUEST[idbarang]' AND tglnota='$tglnota' LIMIT 1,1"));
									echo "<script>alert ('Mohon Ulangi, Karena Diskon Melebihi Harga Jual!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&noindent=$_REQUEST[noindent]'/>";
									exit();
									}
									
								$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE notaindent='$_REQUEST[noindent]' AND idbarang='$idbarang' AND 
																											   idgudang='$idgudang' AND rak='$rak' AND
																											   notabeli='$notabeli'"));
																																			
								//echo "<script>alert ('$dCek2[id].$idbarang.$idgudang.$rak.$tglnota.$_REQUEST[temp].$notabeli')</script>";
								//exit();
																				   
								if(!empty($dCek2[id]))
									{
									echo "<script>alert ('Barang Pada Lokasi Tersebut Sudah Ada Pada Detail Nota Jual!')</script>";
									print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&noindent=$_REQUEST[noindent]'/>";
									exit();
									}
									
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
										
								if($qty < $_REQUEST[qtyindentsisa])
									{
									$sisa = $_REQUEST[qtyindentsisa]-$qty;
									$dCek1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE notaindent='$_REQUEST[noindent]' AND idbarang='$idbarang' AND qtyindentsisa='$sisa'"));
									if(!empty($dCek1[id]))
										{
										echo "<script>alert ('Detail Nota Jual Sudah Terbarui!')</script>";
										print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&noindent=$_REQUEST[noindent]'/>";
										exit();
										}
										
									mysql_query("INSERT INTO x23_notajual_det (
																notaindent,
																tahun,
																bulan,
																tglnota,
																idbarang, 
																hargabelibersih,
																hargajual,
																diskon,
																hargajualbersih,
																qtyindent,
																qtyindentsisa,
																qty,
																totdiskon,
																tothargabelibersih,
																total,
																idgudang,
																rak)
															VALUE (
																'$_REQUEST[noindent]',
																'$p_tahun',
																'$p_bulan',
																CURDATE(),
																'$idbarang',
																'',
																'',
																'',
																'',
																'$_REQUEST[qtyindent]',
																'$sisa',
																'0',
																'',
																'',
																'',
																'',
																'')
														");
									}
									
								print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&mod=$mod&submenu=$submenu&noindent=$_REQUEST[noindent]'/>";
								exit();
								}
							}
                    	}
                    	
                    while($dC = mysql_fetch_array($qC))
                    	{
                    ?>
<!-- ################## MODAL PILIH JUAL ########################################################################################## -->
				        <div class="modal fade " id="compose-modalubah<?echo $dC[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:65%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH BARANG</h4>
				                    </div>
									
				                   	<form method="post" name="inpNJ<?echo $dC[id]?>" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
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
				                    			<td>NO. NOTA BELI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="notabeli<?echo $dC[id]?>" class="form-control select1" id="NJ2<?echo $dC[id]?>" style="font-size:12px;padding:3px;width: 50%" onchange="populateSelectNJ2<?echo $dC[id]?>(this.value)" required="">
													<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$dC[idbarang]' AND stok>'0' AND hargajual!='' GROUP BY nonota,idbarang ORDER BY nonota");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo "$dA[nonota]*$dC[idbarang]"?>" ><?echo "$dA[nonota]"?></option>
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
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>RAK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="rak<?echo $dC[id]?>" class="form-control select1" id="NJ5<?echo $dC[id]?>" style="font-size:12px;padding:3px;width: 50%" disabled="">
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>QTY JUAL</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" placeholder="<?echo number_format($dC[qty],"0","",".")?>" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
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
					                    	<input type="hidden" name="qtyindent" value="<?echo $dC[qtyindent]?>">
					                    	<input type="hidden" name="qtyindentsisa" value="<?echo $dC[qtyindentsisa]?>">
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
		$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$q' AND stok>'0' GROUP BY nonota,idbarang ORDER BY nonota");
		while($d = mysql_fetch_array($qA))
			{
			echo "<option value='$d[nonota]'>$d[nonota]</option>";
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
		
	else if($submenu == 'saveB')
		{
		if($_REQUEST[ttotal]=='0')
			{
			echo "<script>alert ('Mohon Ulangi, Karena Barang Jual Tidak Ada.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
			
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
			
        $dNJ = mysql_fetch_array(mysql_query("SELECT nonota FROM x23_notajual WHERE tglnota=CURDATE() ORDER BY SUBSTR(nonota,-3,3) DESC LIMIT 1"));
            
		if(empty($dNJ[nonota]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNJ[nonota]",-3,3);
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
			
			$nonota = "NJ2$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
		
		
			  mysql_query("UPDATE x23_indent SET status='1' WHERE id='$_REQUEST[id]'");
			  mysql_query("UPDATE x23_notajual_det SET nonota='$nonota' WHERE notaindent='$_REQUEST[noindent]'");
			  
		$dJ = mysql_fetch_array(mysql_query("SELECT id FROM x23_notajual_det WHERE nonota='$nonota'"));
		if(!empty($dJ[id]))
			{
			$q1 = mysql_query("INSERT INTO x23_notajual (
											nonota, 
											idpelanggan, 
											tahun, 
											bulan, 
											tglnota, 
											totalqty, 
											totdiskon, 
											tothargabelibersih, 
											grandtotal,
											iduser,
											inputx, 
											updatex) 
										VALUES (
											'$nonota', 
											'$_REQUEST[idpelanggan]', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'$_REQUEST[totalqty]', 
											'$_REQUEST[totdiskon]', 
											'$_REQUEST[tothargabelibersih]', 
											'$_REQUEST[ttotal]',
											'$_SESSION[id]', 
											NOW(), 
											'$updatex')
							");
							
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notajual',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'TAMBAH NOTA JUAL $_REQUEST[nonota]')
								");
								
	        $dNK = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansi WHERE jnskwitansi='penjualan' AND tanggal=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
	            
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
				
				$nokwitansi = "KPJ$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
			$q1 = mysql_query("INSERT INTO x23_kwitansi (
													jnskwitansi, 
													nokwitansi, 
													tahun, 
													bulan, 
													tanggal, 
													nomor, 
													noindent, 
													idpelanggan, 
													noantrian, 
													nopol, 
													jumlah, 
													user,
													keterangan, 
													status,
													inputx, 
													updatex) 
												VALUES (
													'penjualan', 
													'$nokwitansi', 
													'$p_tahun', 
													'$p_bulan', 
													CURDATE(), 
													'$nonota', 
													'$_REQUEST[noindent]', 
													'$_REQUEST[idpelanggan]', 
													'', 
													'', 
													'$_REQUEST[grandtotal]', 
													'$_SESSION[id]', 
													'',
													'0', 
													NOW(), 
													'$updatex')
							");
			}
		if($_REQUEST[grandtotal]!="0"){$note="2";}else{$note="";}
		
		if($q1)
			{
			//echo "<script>alert ('Proses berhasil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=$note'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&id=$_REQUEST[id]'/>";
			exit();
			}
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