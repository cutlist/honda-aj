<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{
				$lainbbn 	= preg_replace( "/[^0-9]/", "",$_REQUEST['lainbbn']);
				$tanggal 	= date("Y-m-d", strtotime($_POST['tanggal']));
				
				mysql_query("UPDATE tbl_lainbbn SET tgl2='$tanggal' WHERE status='1'");
				mysql_query("UPDATE tbl_lainbbn SET status='0'");
				
				$q1 = mysql_query("INSERT INTO tbl_lainbbn (
														lainbbn,
														tgl1, 
														status) 
													VALUES (
														'$lainbbn',
														'$tanggal',
														'1')");
									
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_lainbbn',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH BIAYA LAIN-LAIN BBN $tanggal')
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
				$q1 = mysql_query("DELETE FROM tbl_lainbbn WHERE id='$_REQUEST[del]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_lainbbn',
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
				$q1 = mysql_query("UPDATE tbl_lainbbn SET status='1',tgl2='' WHERE id='$_REQUEST[aktif]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_lainbbn',
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
			                	<h4>MASTER <small>BIAYA LAIN-LAIN BBN</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-input" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Biaya Lain-Lain BBN</button>
										</a>
	                           		</div>
			                        <table id="example2" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
												<th width="12%">MULAI</th>
												<th width="12%">SAMPAI</th>
												<th width="">BIAYA LAIN BBN (RP)</th>
												<th width="">STATUS</th>
												<th width="1%">AKSI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$dB = mysql_fetch_array(mysql_query("SELECT id FROM tbl_lainbbn ORDER BY id DESC LIMIT 0,1"));
										$q1 = mysql_query("SELECT * FROM tbl_lainbbn ORDER BY id DESC");
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
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[lainbbn],"0","",".")?></span></td>
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
						$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_lainbbn WHERE status='1'"));
                        ?>
				        <div class="modal fade " id="compose-modal-input" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">INPUT BIAYA LAIN-LAIN BBN</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
					                    <table width="100%">
				                    		<tr>
				                    			<td width="30%">TANGGAL BERLAKU</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="3">
				                                    <div class="input-group">
				                                        <span class="input-group-addon" style="min-width:50px;text-align:center"><i class="fa fa-calendar"></i></span>
														<input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width:55%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="">
				                    				</div>		
												</td>
											</tr>
				                    		<tr>
				                    			<td>BIAYA LAIN-LAIN BBN</td>
				                    			<td>:</td>
				                    			<td width="35%">
				                                    <div class="input-group">
				                                   	 	<span class="input-group-addon" style="min-width:50px;text-align:center">RP</span>
				                    					<input type="text" name="lainbbn" value="<?echo $dA[pajak1]?>" maxlength="11" class="form-control uang" placeholder="0" style="width:55%;text-align:right" onkeypress="return buat_angka(event,'0123456789.')" required>
				                    				</div>
												</td>
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
                    "bFilter": true,
                    "bSort": false,
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