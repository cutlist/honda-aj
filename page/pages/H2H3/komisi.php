<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{	
				$omsetbruto 	= preg_replace( "/[^0-9]/", "",$_REQUEST[omsetbruto]);
				
				$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_komsetbruto WHERE omsetbruto='$omsetbruto'"));
				if(!empty($dCek[id])){
					echo "<script>alert ('Jasa Tersebut Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
							
					$q1 = mysql_query("INSERT INTO x23_komsetbruto (
													omsetbruto, 
													persenkomisi) 
												VALUES (
													'$omsetbruto',
													'$_REQUEST[persenkomisi]');
									");
					$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_komsetbruto',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH KOMISI OMSET BRUTO $omsetbruto')
									");
						
						
						if($q1 && $q2)
							{
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}

			if(!empty($_REQUEST[del]))
				{
				$q1 = mysql_query("DELETE FROM x23_komsetbruto WHERE id='$_REQUEST[del]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_komsetbruto',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS KOMISI OMSET BRUTO $omsetbruto')
									");
				
				
				if($q1 && $q2)
					{
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				}
			}
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah])){				
				$omsetbruto 	= preg_replace( "/[^0-9]/", "",$_REQUEST[omsetbruto]);
				/*
				$dCek = mysql_fetch_array(mysql_query("SELECT * FROM x23_komsetbruto WHERE omsetbruto='$omsetbruto'"));
				if(!empty($dCek[id])){
					echo "<script>alert ('Jasa Tersebut Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				*/
				$q1 = mysql_query("UPDATE x23_komsetbruto SET
													omsetbruto='$omsetbruto', 
													persenkomisi='$_REQUEST[persenkomisi]'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_komsetbruto',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH KOMISI OMSET BRUTO $omsetbruto')
									");
					
					if($q1 && $q2)
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&mod='/>";
						exit();
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
				}
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
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI OMSET BRUTO</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-gudang" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Komisi Omset Bruto Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px"><center>OMSET BRUTO</center></th>
			                                    <th style="padding:7px"><center>PERSENTASE KOMISI</center></th>
			                                    <th style="padding:7px;width: 1%">DEL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_komsetbruto");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><u>></u> <?echo number_format($d1[omsetbruto],"0","",".")?></td>
			                                    <td align="center"><?echo $d1[persenkomisi]?> %</td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i></a>
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
					
<!-- ################## MODAL TAMBAH GUDANG ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-gudang" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:40%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH GUDANG BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="40%">JUMLAH OMSET BRUTO</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="omsetbruto" class="form-control uang" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>PERSENTASE KOMISI</td>
				                    			<td>:</td>
				                    			<td width="48%">
				                                    <div class="input-group">
				                    					<input type="text" name="persenkomisi" value="" maxlength="3" class="form-control" placeholder="0" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" required>
				                    					<span class="input-group-addon" style="min-width:50px;text-align:center">%</span>
				                                    </div>
												</td>
												<td></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
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
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_komsetbruto WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI OMSET BRUTO</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="40%">JUMLAH OMSET BRUTO</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="omsetbruto" class="form-control uang" value="<?echo number_format($d1[omsetbruto],"0","",".");?>" placeholder="0" style="width:80%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>PERSENTASE KOMISI</td>
				                    			<td>:</td>
				                    			<td width="48%">
				                                    <div class="input-group">
				                    					<input type="text" name="persenkomisi" value="<?echo $d1[persenkomisi];?>" maxlength="3" class="form-control" placeholder="0" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" required>
				                    					<span class="input-group-addon" style="min-width:50px;text-align:center">%</span>
				                                    </div>
												</td>
												<td></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
		                            	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
				                	</form>
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
		
	if($submenu == 'B')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{
				$tanggal 	= date("Y-m-d", strtotime($_POST['tanggal']));
				
				mysql_query("UPDATE x23_kjasa SET tgl2='$tanggal' WHERE status='1'");
				mysql_query("UPDATE x23_kjasa SET status='0'");
				
				$q1 = mysql_query("INSERT INTO x23_kjasa (
														kepalamekanik,
														sa,
														tgl1, 
														status) 
													VALUES (
														'$_REQUEST[kepalamekanik]',
														'$_REQUEST[sa]',
														'$tanggal',
														'1')");
									
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_kjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH KOMISI JASA $tanggal')
									");
						
						
						if($q1 && $q2)
							{
							//echo "<script>alert ('Proses berhasil.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}

			if(!empty($_REQUEST[del]))
				{
				$q1 = mysql_query("DELETE FROM x23_kjasa WHERE id='$_REQUEST[del]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_kjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS PAJAK')
									");
				
				
				if($q1 && $q2)
					{
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				}

			if(!empty($_REQUEST[aktif]))
				{
				$q1 = mysql_query("UPDATE x23_kjasa SET status='1',tgl2='' WHERE id='$_REQUEST[aktif]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_kjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'AKTIF PAJAK')
									");
				
				
				if($q1 && $q2)
					{
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				}
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
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KOMISI JASA</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-input" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Komisi Jasa</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
												<th width="12%">MULAI</th>
												<th width="12%">SAMPAI</th>
												<th width="">KEPALA BENGKEL & KEPALA MEKANIK (%)</th>
												<th width="">SALES ADVISOR (%)</th>
												<th width="">STATUS</th>
												<th width="">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$dB = mysql_fetch_array(mysql_query("SELECT id FROM x23_kjasa ORDER BY id DESC LIMIT 0,1"));
										$q1 = mysql_query("SELECT * FROM x23_kjasa ORDER BY id DESC");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[tgl2]=="0000-00-00"){$tgl2 = "Saat ini";}
			                            	else{$tgl2 = date("d-m-Y",strtotime($d1[tgl2]));}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Aktif</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Tidak Aktif</span>";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tgl1]))?></td>
			                                    <td align="center"><?echo $tgl2?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $d1[kepalamekanik]?></span></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $d1[sa]?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
													<?
													if($_SESSION[posisi]=='DIREKSI')
														{
													?>
															<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
																<span class="caret"></span>
																<span class="sr-only">Actions</span>
															</button>
															<ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
																<!--
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
																-->
																<?
																	if($d1[id] == $dB[id])
																		{
																		if($d1[status]=="0")
																			{
																?>
																		<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&aktif=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Aktifkan</a></li>
																<?
																			}
																		}
																?>
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
															</ul>
														</div>
													<?
														}
													?>
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
					
<!-- ################## MODAL INPUT ########################################################################################## -->
                        <?
						$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_kjasa WHERE status='1'"));
                        ?>
				        <div class="modal fade " id="compose-modal-input" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:40%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">INPUT KOMISI JASA</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
					                    <table width="100%">
				                    		<tr>
				                    			<td width="50%">TANGGAL BERLAKU</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="3">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="min-width:50px;text-align:center"><i class="fa fa-calendar"></i></span>
														<input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width:52%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="">
				                    				</div>		
												</td>
											</tr>
				                    		<tr>
				                    			<td>KEPALA MEKANIK & KEPALA BENGKEL</td>
				                    			<td>:</td>
				                    			<td width="30%">
				                                    <div class="input-group">
				                    					<input type="text" name="kepalamekanik" value="<?echo $dA[kepalamekanik]?>" maxlength="5" class="form-control" placeholder="0" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789.')" required>
				                    				    <span class="input-group-addon" style="min-width:50px;text-align:center">%</span>
				                    				</div>
												</td>
				                    			<td colspan="2"></td>
											</tr>
				                    		<tr>
				                    			<td>SALES ADVISOR</td>
				                    			<td>:</td>
				                    			<td>
				                                    <div class="input-group">
				                    					<input type="text" name="sa" value="<?echo $dA[sa]?>" maxlength="5" class="form-control" placeholder="0" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789.')" required>
				                    					<span class="input-group-addon" style="min-width:50px;text-align:center">%</span>
				                                    </div>
												</td>
				                    			<td colspan="2"></td>
											</tr>
				                    		<input type="hidden" name="input" value="1">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> &nbsp;Batal</button>
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