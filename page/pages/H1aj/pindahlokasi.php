<?
	if($submenu == 'A')
		{
		unset($_SESSION[tanggal]);
		unset($_SESSION[idgudang1]);
		unset($_SESSION[idgudang2]);
		mysql_query("DELETE FROM temp_pindah_det WHERE id%2=0 AND user='$_SESSION[user]'");
		
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Mohon Tunggu Konfirmasi Dari Pihak Manajemen.</p>";
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
	                           		<div style="float:left" class="col-xs-6">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI TANGGAL PINDAH / GUDANG ASAL / GUDANG TUJUAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
									
	                           		<div style="float:right" class="col-xs-6">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Pindah Lokasi</button>
										</a>
	                           		</div>
			                        <table id="example4" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">TANGGAL PINDAH</th>
			                                    <th style="padding:7px">GUDANG ASAL</th>
			                                    <th style="padding:7px">GUDANG TUJUAN</th>
			                                    <th width="15%"  style="padding:7px">QTY PINDAH (UNIT)</th>
			                                    <th width="1%" style="padding:7px">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM tbl_pindah_vw WHERE id%2=0 AND (tanggal LIKE '%$_REQUEST[cari]%' OR gudang1 LIKE '%$_REQUEST[cari]%' OR gudang2 LIKE '%$_REQUEST[cari]%')");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM tbl_pindah_vw WHERE id%2=0 ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dT  = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM tbl_pindah_det WHERE id%2=0 AND idpindah='$d1[id]'"));
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=view&id=$d1[id]"?>'">
			                                    <td><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td><?echo $d1[gudang1]?></td>
			                                    <td><?echo $d1[gudang2]?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $dT[total]?></span></td>
			                                    <td align="center"><?echo $status?></td>
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
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pindah WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:240px;">
			                	<h4>GUDANG & PDI <small>LIHAT PINDAH LOKASI</small></h4>
				                	<div style="padding:20px">
				                        <table width="90%">
				                        	<tr>
				                        		<td width="18%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="5"><input type="text" name="tanggal" value="<?echo $d1[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td><select name="idgudang1" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($d1[idgudang1]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="15%" align="center">GUDANG TUJUAN</td>
				                        		<td colspan="2"><select name="idgudang2" class="form-control" disabled style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($d1[idgudang2]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        	</tr>
				                        </table>
				                        
					                	<div class="col-xs-12">
					                        <div class="modal-footer clearfix">
						                        <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
					                    </div>
					                </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:280px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE id%2=0 AND norangka IN (SELECT norangka FROM tbl_pindah_det WHERE id%2=0 AND idpindah='$d1[id]')");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
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
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
			                	
									<script>
									function vPindah()
										{
										if (document.formPindah.idgudang1.value == document.formPindah.idgudang2.value)
											{
											alert ("Lokasi asal dan tujuan sama.");	 	
											return false;
											}
										}
									</script>
				                	<form name="formPindah" onsubmit="return vPindah();" method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                        <table width="90%">
				                        	<tr>
				                        		<td width="18%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="4"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td width="25%"><select name="idgudang1" class="form-control" required style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>'><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="15%" align="center">GUDANG TUJUAN</td>
				                        		<td><select name="idgudang2" class="form-control" required style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>'><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
												<td width="15%"></td>
				                        	</tr>
				                        </table>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="qty" value="<?echo $d2[qty]?>">
					                    	<input type="hidden" name="grandtotal" value="<?echo $d2[total]?>">
					                    	
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
		if(empty($_SESSION[tanggal]))
			{
			$_SESSION[tanggal]   = $_REQUEST[tanggal];
			$_SESSION[idgudang1] = $_REQUEST[idgudang1];
			$_SESSION[idgudang2] = $_REQUEST[idgudang2];
			}
			
		
		if(!empty($_REQUEST[norangka]))
			{
			mysql_query("INSERT INTO temp_pindah_det VALUES ('$_REQUEST[norangka]','$_SESSION[user]')");
			}
		else{
			if(!empty($_REQUEST[del]))
				{
				mysql_query("DELETE FROM temp_pindah_det WHERE id%2=0 AND norangka='$_REQUEST[del]'");
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>GUDANG & PDI <small>PINDAH LOKASI</small></h4>
				                	<div style="padding:20px">
				                        <table width="90%" border="0">
				                        	<tr>
				                        		<td width="18%">TANGGAL PINDAH</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="5"><input type="text" name="tanggal" value="<?echo $_SESSION[tanggal]?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:20%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>GUDANG ASAL</td>
				                        		<td>:</td>
				                        		<td width="25%"><select name="idgudang1" class="form-control" disabled="" style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[idgudang1]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
				                        		<td width="15%" align="center">GUDANG TUJUAN</td>
				                        		<td colspan="2"><select name="idgudang2" class="form-control" disabled="" style="width:100%">
																	<option value=''>Pilih</option>
																<?
																	$qB = mysql_query("SELECT * FROM tbl_gudang ORDER BY gudang");
																	while($dB=mysql_fetch_array($qB))
																		{
																?>
																			<option value='<?echo $dB[id]?>' <?if($_SESSION[idgudang2]==$dB[id]){?>selected=""<?}?>><?echo $dB[gudang]?></option>
																<?
																		}
																?>
													</select></td>
												<td></td>
				                        	</tr>
						               		<form method="post" action="" enctype="multipart/form-data">
				                        	<tr>
				                        		<td width="23%">PILIH NOMOR RANGKA</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="2"><select name="norangka" class="form-control" id="select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE id%2=0 AND idgudang='$_SESSION[idgudang1]' AND status='STOK' AND norangka NOT IN (SELECT norangka FROM tbl_pindah_det_vw WHERE id%2=0 AND idgudang1='$_SESSION[idgudang1]' AND status='0') AND norangka NOT IN (SELECT norangka FROM temp_pindah_det WHERE id%2=0 AND user='$_SESSION[user]')");
																			while($d1=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $d1[norangka]?>"><?echo "$d1[norangka]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                        		<td width="2%"><button type="submit" class="btn btn-info pull-left"><i class="fa fa-arrow-right"></i></button></td>
												<td width="20%"></td>
				                        	</tr>
					                   		</form>
				                        </table>
									</br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>1. Pilih Nomor Rangka</i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>2. Klik <i class="fa fa-arrow-right"></i></i></span></br>
					                <span style="font-weight:bold;font-size:12px;padding-top:10px;color:red"><i>3. Setelah Selesai Klik Simpan</i></span>
				                        
						                <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=D"?>" enctype="multipart/form-data">
						                	<div class="col-xs-12" style="margin-left:800px;margin-top:-50px;">
												<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
												<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											</div>
					                    </form>
					                </div>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                    <th style="padding:7px">NOMOR MESIN</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th width="" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_stokunit_vw WHERE id%2=0 AND norangka IN (SELECT norangka FROM temp_pindah_det WHERE id%2=0 AND user='$_SESSION[user]')");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[norangka]?></td>
			                                    <td><?echo $d1[nomesin]?></td>
			                                    <td><?echo $d1[kodebarang]?></td>
			                                    <td><?echo $d1[namabarang]?></td>
			                                    <td><?echo $d1[varian]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[norangka]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                        </td>
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
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'D')
		{
        $tanggal  = date("Y-m-d", strtotime($_SESSION[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
			                            	
		$dT  = mysql_fetch_array(mysql_query("SELECT COUNT(norangka) AS total FROM temp_pindah_det WHERE id%2=0 AND user='$_SESSION[user]'"));
		if($dT[total]=='0')
			{
			echo "<script>alert ('Proses Tidak Dapat Disimpan, Mohon Pilih Nomor Rangka Terlebih Dahulu')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
			exit();
			}
        
		$q1 = mysql_query("INSERT INTO tbl_pindah (
											tahun, 
											bulan, 
											tanggal, 
											idgudang1, 
											idgudang2, 
											iduser, 
											user, 
											inputx) 
										VALUES (
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'$_SESSION[idgudang1]', 
											'$_SESSION[idgudang2]', 
											'$_SESSION[id]', 
											'$_SESSION[user]', 
											NOW())
							");
							
		$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
		$idpindah	= $id[id];
		
		$no = 1;
		$qA = mysql_query("SELECT norangka FROM temp_pindah_det WHERE id%2=0 AND user='$_SESSION[user]'");
        while($dA = mysql_fetch_array($qA))
        	{
        	//mysql_query("UPDATE tbl_stokunit SET idgudang='$_SESSION[idgudang2]',updatex='$updatex' WHERE id%2=0 AND norangka='$dA[norangka]'");
        	mysql_query("INSERT INTO tbl_pindah_det VALUES ('','$idpindah','$dA[norangka]')");
        	$no++;
        	}
        	
		$dB  = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pindah_vw WHERE id%2=0 AND id='$idpindah'"));
		$jml = $no-1;
        	
		$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
											idpindah, 
											tahun, 
											bulan, 
											tanggal, 
											kasus, 
											tbl, 
											inputx) 
										VALUES (
											'$idpindah', 
											'$tahun', 
											'$bulan', 
											'$tanggal', 
											'PINDAH LOKASI DARI $dB[gudang1] KE $dB[gudang2] SEBANYAK $jml UNIT', 
											'tbl_pindah', 
											NOW())
							");
        	
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'tbl_pindah',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH PINDAH STOK $tanggal')
							");
				
		
		if($q1)
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
?>
	
        <script src="js/jquery.min.js"></script>
        
        <script>
			$(function(){
			           
			  var select = $('#select1').select2();
			});
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
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example3').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example4').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>