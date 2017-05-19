<?
	if($submenu == 'A')
		{
		include "include/fungsi_thumb.php";
		if(!empty($_REQUEST[update]))
			{
			$tglsampai	 	= date("Y-m-d", strtotime($_REQUEST['tglsampai']));	        
			$jamsampai	 	= date("H:i:S", strtotime($_REQUEST['jamsampai']));
			
				$lokasi_file    = $_FILES['fupload']['tmp_name'];
				$tipe_file      = $_FILES['fupload']['type'];
				$nama_file      = $_FILES['fupload']['name'];
				$acak           = rand(1,99);
				if (!empty($lokasi_file))
					{
					$nama_file_unik = $acak.$nama_file; 
					UploadSurjal($nama_file_unik);
					}
				else{
					$nama_file_unik =""; 
					}
				        
			$q1 = mysql_query("UPDATE tbl_notajual_det SET tglsampai='$tglsampai',photo='$nama_file_unik', jamsampai='$jamsampai',updatex='$updatex' WHERE  id='$_REQUEST[update]'");
			//$q1 = mysql_query("UPDATE tbl_pengeluaranunit SET status='1', tglsampai='$tglsampai', jamsampai='$jamsampai',updatex='$updatex' WHERE  id='$_REQUEST[update]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_pengeluaranunit',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH PENGIRIMAN UNIT UNIT $_REQUEST[norangka] $_REQUEST[nonota]')
								");
				
			if($q1 && $q2)
				{
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
				exit();
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="margin:0 auto;">
			                	<h4>ADMINISTRASI <small>DAFTAR KONFIRMASI SURAT JALAN</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-danger"><i class="fa fa-list"></i> &nbsp; Riwayat Surat Jalan</button>
										</a>
	                           		</div>
	                           		
				                    <table id="example3" class="table table-striped table-bordered table-hover" style="min-width:250%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">CETAK</th>
			                                    <th style="padding:7px">NO. SURAT JALAN</th>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">ALAMAT</th>
			                                    <th style="padding:7px">NO. TELEPON</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NAMA SALES</th>
			                                    <th style="padding:7px">NAMA PDI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND tglsampai='0000-00-00' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE  status='0')");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE  nonota='$d1[nonota]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE  id='$d2[idpelanggan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE  id='$d1[idbarang]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d2[iduser]'"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d2[iduserpdi]'"));
											$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE  norangka='$d1[norangka]'"));
											$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE  nonota='$d1[nonota]'"));
			                            ?>
											<script type="text/javascript">
												var s5_taf_parent = window.location;
												function popup_print<?echo $d1[id]?>(){
													window.open('printaj/suratjalan.php?id=<?echo $d1[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
													}
											</script>
			                                <tr style="cursor:pointer">
			                                	<td align="center" style="width: 1%"><a href="#" onClick="popup_print<?echo $d1[id]?>()"><button type="button" class="btn btn-info" style="padding:0px 10px"><i class="fa fa-print"></i></button></a></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>" align="center"><?echo $d8[nosj]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>" align="center"><?echo $d2[nonota]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>" align="center"><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d3[nama]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d3[alamat]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d3[notelepon]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d7[norangka]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d7[nomesin]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d4[kodebarang]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d4[namabarang]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d4[varian]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d4[warna]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d5[nama]?></td>
			                                    <td data-toggle="modal" data-target="#compose-modal-update<?echo $d1[id]?>"><?echo $d6[nama]?></td>
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
						$qA = mysql_query("SELECT * FROM tbl_notajual_det WHERE  tglsampai='0000-00-00' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE  status='0')");
			            while($dA = mysql_fetch_array($qA))
			            	{
		            ?>
	<!-- ################## MODAL UPDATE SURAT JALAN ########################################################################################## -->
					        <div class="modal fade " id="compose-modal-update<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
					            <div class="modal-dialog" style="width:500px;">
					                <div class="modal-content">
					                    <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                        <h4 class="modal-title">KONFIRMASI SURAT JALAN <?echo $dA[nonota]?></h4>
					                    </div>
										
					                   	<form method="post" action="" enctype="multipart/form-data">
				                        <div class="modal-body">
					                    	<table width="100%">
					                    		<tr>
					                    			<td width="40%">TANGGAL SAMPAI</td>
					                    			<td width="2%">:</td>
					                    			<td><div class="input-group">
					                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					                                        	<input type="text" name="tglsampai" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:60%" readonly="">
					                                    </div>                                        		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td>JAM SAMPAI</td>
					                    			<td>:</td>
					                    			<td><div class="bootstrap-timepicker">
					                    					<div class="input-group">                                   
					                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>         
			                                               		<input type="text" name="jamsampai" value="<?echo date("H:i")?>" class="form-control timepicker" required="" style="width:60%" readonly=""/>
			                                           		</div>                               		
			                                            </div>                               		
					                                </td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="4"><hr></td>
					                    		</tr>
					                    		<tr>
					                    			<td colspan="4"><div class="box-body table-responsive">
							                            <div class="form-group">
							                            	<center>
							                                    <label for="exampleInputFile" style="margin-bottom: 20px;"><i class="fa fa-truck"></i> Upload Photo</label>
							                                </center>
							                                <input type=file name='fupload'>
							                                <!--
							                                	<p class="help-block">Pilih Photo *.jpg Dengan Maksimal Size 200KB</p>
							                                -->
							                                </div>
									                    </div>
									                </td>
					                    		</tr>
					                    		<input type="hidden" name="update" value="<?echo $dA[id]?>">
					                    		<input type="hidden" name="nonota" value="<?echo $dA[nonota]?>">
					                    		<input type="hidden" name="norangka" value="<?echo $dA[norangka]?>">
			                            	</table>
					               		</div>
				                        <div class="modal-footer clearfix">
				                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
											<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
	else if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="margin:0 auto;">
			                	<h4>ADMINISTRASI <small>RIWAYAT KONFIRMASI SURAT JALAN</small></h4>
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI NO. NOTA JUAL / NO. SURAT JALAN / TGL NOTA JUAL ..." class="form-control"/>
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
	                           				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i> &nbsp; Daftar Konfirmasi Surat Jalan</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
											{
										?>
											<button type="button"  onclick="window.open('printaj/h1/konfsuratjalan.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
				                    <table id="example2" class="table table-striped table-bordered table-hover" style="min-width:250%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">CETAK</th>
			                                    <th style="padding:7px">NO. SURAT JALAN</th>
			                                    <th style="padding:7px">NO. NOTA JUAL</th>
			                                    <th style="padding:7px">TGL NOTA JUAL</th>
			                                    <th style="padding:7px">TGL SAMPAI</th>
			                                    <th style="padding:7px">JAM SAMPAI</th>
			                                    <th style="padding:7px">NAMA PELANGGAN</th>
			                                    <th style="padding:7px">ALAMAT</th>
			                                    <th style="padding:7px">NO. TELEPON</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">WARNA</th>
			                                    <th style="padding:7px">NAMA SALES</th>
			                                    <th style="padding:7px">NAMA PDI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											//$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE  updatex!='' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE  penyerahan='KIRIM' AND status='0' AND (nonota LIKE '%$_REQUEST[cari]%' OR nosj LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%'))");
											$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND  tglsampai!='0000-00-00' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE  penyerahan='KIRIM' AND status='0' AND (nonota LIKE '%$_REQUEST[cari]%' OR nosj LIKE '%$_REQUEST[cari]%' OR tglnota LIKE '%$_REQUEST[cari]%'))");
											}
										else
											{
											//$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE  updatex!='' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE  penyerahan='KIRIM' AND status='0') ORDER BY tglsampai DESC LIMIT 0,20");
											$q1 = mysql_query("SELECT * FROM tbl_notajual_det WHERE id%2=0 AND  tglsampai!='0000-00-00' AND nonota IN (SELECT nonota FROM tbl_pengeluaranunit WHERE  penyerahan='KIRIM' AND status='0') ORDER BY tglsampai DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE  nonota='$d1[nonota]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE  id='$d2[idpelanggan]'"));
			                            	$d4 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE  id='$d1[idbarang]'"));
			                            	$d5 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d2[iduser]'"));
			                            	$d6 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$d2[iduserpdi]'"));
											$d7 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE  norangka='$d1[norangka]'"));
											$d8 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE  nonota='$d1[nonota]'"));
			                            ?>
											<script type="text/javascript">
												var s5_taf_parent = window.location;
												function popup_print<?echo $d1[id]?>(){
													window.open('printaj/suratjalan.php?id=<?echo $d1[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
													}
											</script>
			                                <tr style="cursor:pointer">
			                                	<td align="center" style="width: 1%"><a href="#" onClick="popup_print<?echo $d1[id]?>()"><button type="button" class="btn btn-info" style="padding:0px 10px"><i class="fa fa-print"></i></button></a></td>
			                                	<td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'" align="center"><?echo $d8[nosj]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'" align="center"><?echo $d1[nonota]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'" align="center"><?echo date("d-m-Y",strtotime($d2[tglnota]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'" align="center"><?echo date("d-m-Y",strtotime($d1[tglsampai]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'" align="center"><?echo date("H:i:s",strtotime($d1[jamsampai]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d3[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d3[alamat]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d3[notelepon]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d7[norangka]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d7[nomesin]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d4[kodebarang]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d4[namabarang]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d4[varian]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d4[warna]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d5[nama]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'"><?echo $d6[nama]?></td>
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
		
	else if($submenu == 'view')
		{
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual_det WHERE  id='$_REQUEST[id]'"));
		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengeluaranunit WHERE  nonota='$dA[nonota]'"));
		$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE  nonota='$dA[nonota]'"));
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE  id='$dC[idpelanggan]'"));;
		$d2 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE  id='$dB[user]'"));
		
		$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_bpkb WHERE  notajual='$dA[nonota]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ADMINISTRASI <small>KONFIRMASI SURAT JALAN</small></h4>
			                	
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
				                    			<td colspan="2"><input type="text" class="form-control" style="width: 40%" value="<?echo date("d-m-Y",strtotime($dC[tglnota]))?>" readonly=""></td>
				                    		</tr>
				                    		<!--
				                    		<tr>
				                    			<td>NAMA SALES / COUNTER</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d7[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NAMA CHECKER PDI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" value="<?echo $d6[nama]?>" class="form-control" maxlength="20" onkeypress="return buat_angka(event,'1234567890')" readonly></td>
				                    		</tr>
				                    		-->
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
					                    			<td colspan="2"><input type="text" value="<?echo $d3[nama]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NO. KTP/NO. IDENTITAS</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d3[noktp]?>" class="form-control" maxlength="20" disabled></td>
					                    		</tr>
					                    		<tr>
					                    			<td valign="top" >ALAMAT</td>
					                    			<td valign="top" >:</td>
					                    			<td valign="top" colspan="2"><textarea  maxlength="100" class="form-control" disabled><?echo $d3[alamat]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td width="15%">
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RT</span>
					                                        <input type="text" value="<?echo $d3[rt]?>" class="form-control" placeholder="-" style="width:100%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
					                                    </div>
					                                </td>
					                    			<td>
					                                    <div class="input-group">
					                                        <span class="input-group-addon">RW</span>
					                                        <input type="text" value="<?echo $d3[rw]?>" class="form-control" placeholder="-" style="width:20%;text-align:right" maxlength="3" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789-')" disabled>
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
															<option value='<?echo "$data[kodekab]-$data[namakab]"?>' <?if($d3[kodekab]==$data[kodekab]){?>selected=""<?}?>><?echo "$data[namakab]"?></option>
														<?
															}
														?>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%" disabled="">
														<option value='<?echo "$d3[kodekab]-$d3[kodekec]-$d3[namakec]"?>' ><?echo $d3[namakec]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
					                    			<td colspan="2"><select class="form-control" style="width: 60%;" disabled="">
														<option value='<?echo "$d3[kodekel]-$d3[namakel]"?>' ><?echo $d3[namakel]?></option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="30%" valign="top">PESAN NOPOL</td>
					                    			<td width="2%" valign="top">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d3[pnopol]?>" name="pnopol" class="form-control" disabled></td>
					                    		</tr>
			                            	</table>
				                    	</div>
				                        <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
									    <!-- ################################################################################################################# -->
									    
										<div class="col-xs-12">
											<b>DETAIL UNIT</b>
										</div>
										<div class="col-xs-12">
									    	<?
											$dTemp = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cekfisik WHERE  norangka='$dA[norangka]'"));
											$dU   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit WHERE  norangka='$dTemp[norangka]'"));
											$dC   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE  id='$dTemp[idbarang]'"));
											$dD   = mysql_fetch_array(mysql_query("SELECT jaket,bukuservice FROM tbl_notajual_det WHERE  norangka='$dTemp[norangka]'"));
									    	?>
									        	
									        	<div class="col-xs-6" style="font-size:12px">
									            	<table width="80%">
									            		<tr>
									            			<td width="50%">NOMOR RANGKA</td>
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
									            		<tr>
									            			<td width="">VARIAN</td>
									            			<td width="">:</td>
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
									            		<tr>
									            			<td width="">BENSIN AWAL</td>
									            			<td width="">:</td>
									            			<td colspan="2"><?echo $dTemp[bensinawal]?> LITER</td>
									            		</tr>
									            	</table>
									        	</div>
									        	<div class="col-xs-6" style="font-size:12px">
									            	<table width="80%">
									            		<tr>
									            			<td width="50%">ANAK KUNCI 2 PCS </td>
									            			<td width="5%">:</td>
									            			<td colspan="2"><?if($dTemp[anakkunci]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>SPION</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[spion]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>ACCU</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[accu]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>TOOLKIT</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[toolkit]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>HELM</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[helm]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>ALAS KAKI</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[alaskaki]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>JAKET</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[jaket]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>BUKU SERVIS</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[bukuservis]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>CEK FISIK 2 LBR</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[cekfisik]=='1'){?>ADA<?}else{?>TIDAK ADA<?}?></td>
									            		</tr>
									            		<tr>
									            			<td>KONDISI MOTOR</td>
									            			<td>:</td>
									            			<td colspan="2"><?if($dTemp[kondisimotor]=='1'){?>BAIK<?}else{?>TIDAK BAIK<?}?></td>
									            		</tr>
									            	</table>
									        	</div>
									        	<div class="col-xs-12">
									        		<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
									        	</div>
									        	
									        <div class="clearfix"></div>
									        
					                    	<table width="70%">
					                    		<tr>
					                    			<td width="30%">TANGGAL KELUAR</td>
					                    			<td width="2%">:</td>
					                    			<td colspan="2"><input type="text" value="<?echo date('d-m-Y',strtotime($dB[tanggal]))?>" style="width: 25%" class="form-control" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>NAMA PENANGGUNG JAWAB</td>
					                    			<td>:</td>
					                    			<td colspan="2"><input type="text" value="<?echo $d2[nama]?>" style="width: 50%" class="form-control" readonly></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PENYERAHAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><select class="form-control" disabled="" style="width: 50%">
																	<option value='KIRIM' <?if($dB[penyerahan]=='KIRIM'){?>selected=""<?}?>>KIRIM</option>
																	<option value='BAWA SENDIRI' <?if($dB[penyerahan]=='BAWA SENDIRI'){?>selected=""<?}?>>BAWA SENDIRI</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>PHOTO PENGIRIMAN</td>
					                    			<td>:</td>
					                    			<td colspan="2"><img src="../foto/suratjalan/sj_<?echo $dA[photo]?>"/></td>
					                    		</tr>
					                    	</table>
					               		</div>
					                </div>
					                
			                        <div class="clearfix"></div>
			                        <div class="modal-footer">
				                    	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
        $tanggal  = date("Y-m-d");
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        
		$namaambilstkn1 = strtoupper($_REQUEST[namaambilstkn1]);
		$tlpambilstkn1	= strtoupper($_REQUEST[tlpambilstkn1]);
		$namaambilstkn2	= strtoupper($_REQUEST[namaambilstkn2]);
		$tlpambilstkn2	= strtoupper($_REQUEST[tlpambilstkn2]);
		$namaambilbpkb	= strtoupper($_REQUEST[namaambilbpkb]);
		$tlpambilbpkb	= strtoupper($_REQUEST[tlpambilbpkb]);
        
		$q1 = mysql_query("INSERT INTO tbl_pengeluaranunit (
													tahun, 
													bulan, 
													tanggal, 
													nonota, 
													user, 
													namaambilstkn1, 
													tlpambilstkn1, 
													namaambilstkn2, 
													tlpambilstkn2, 
													namaambilbpkb, 
													tlpambilbpkb, 
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
													'$_SESSION[id]', 
													'$namaambilstkn1', 
													'$tlpambilstkn1', 
													'$namaambilstkn2', 
													'$tlpambilstkn2', 
													'$namaambilbpkb', 
													'$tlpambilbpkb', 
													'$_REQUEST[penyerahan]', 
													'$_REQUEST[angsuran]', 
													'$_REQUEST[termin]', 
													NOW(), 
													'$updatex')
							");
		$q2 = mysql_query("UPDATE tbl_notajual SET adm='1', iduseradm='$_SESSION[id]' WHERE  nonota='$_REQUEST[nonota]'");
		$q3 = mysql_query("INSERT INTO tbl_stnkbpkb (nonota) VALUES ('$_REQUEST[nonota]')");
		$q4 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_pengeluaranunit',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH PENGELUARAN UNIT $_REQUEST[nonota]')
							");
			
		if($q1 && $q2 && $q3 && $q4)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		else
			{
			echo "<script>alert ('Proses gagal.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
?>
	
        <script src="js/jquery.min.js"></script>
		
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
                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
				    showMeridian: false,
                });

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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>