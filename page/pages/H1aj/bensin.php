<?
	if($submenu == 'save')
		{
		if(!empty($_REQUEST[input]))
			{
			$jenis = strtoupper($_REQUEST['jenis']);
			$keterangan = strtoupper($_REQUEST['keterangan']);
			$jumlah = $_REQUEST['jumlah'];
			$jum = substr_count($jumlah, ".");
							
			if($jum > '1')
				{
				echo "<script>alert ('Jumlah Yang Diinput Salah.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
				exit();
				}
			else{
				$pisah = explode(".",$jumlah);
				if(strlen($pisah[1]) > 1)
					{
					echo "<script>alert ('Jumlah Yang Diinput Tidak Boleh 2 Angka Dibelakang Koma.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
					exit();
					}
				if(empty($pisah[0]))
					{
					$karakter1 = "0";
					}
				else if(!empty($pisah[0]))
					{	
					$karakter1 = $pisah[0];
					}
				if(empty($pisah[1]))
					{
					$karakter2 = "0";
					}
				else if(!empty($pisah[1]))
					{	
					$karakter2 = $pisah[1];
					}
				}
					
			$input = "$karakter1.$karakter2";
				
			if($jumlah=='0')
				{
				echo "<script>alert ('Jumlah Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
				exit();
				}
			
			$tanggal 	= date("Y-m-d", strtotime($_POST['tanggal']));
				
			$q1 = mysql_query("INSERT INTO tbl_bensin (
													jenis,
													tanggal,
													keterangan,
													jumlah) 
												VALUES (
													'$jenis',
													'$tanggal',
													'$keterangan',
													'$input')");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_bensin',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    '$jenis $_REQUEST[jumlah]')
								");
								
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		}
	if($submenu == 'A')
		{
			
		if(!empty($_REQUEST[ubah]))
			{
			$jenis = strtoupper($_REQUEST['jenis']);
			$keterangan = strtoupper($_REQUEST['keterangan']);
			$jumlah = $_REQUEST['jumlah'];
			$jum = substr_count($jumlah, ".");
							
			if($jum > '1')
				{
				echo "<script>alert ('Jumlah Yang Diinput Salah.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			else{
				$pisah = explode(".",$jumlah);
				if(strlen($pisah[1]) > 1)
					{
					echo "<script>alert ('Jumlah Yang Diinput Tidak Boleh 2 Angka Dibelakang Koma.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				if(empty($pisah[0]))
					{
					$karakter1 = "0";
					}
				else if(!empty($pisah[0]))
					{	
					$karakter1 = $pisah[0];
					}
				}
				
			if($jumlah=='0')
				{
				echo "<script>alert ('Jumlah Yang Diinput Tidak Bisa 0 (Nol).')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			$input = "$karakter1.$pisah[1]";
			
			$tanggal 	= date("Y-m-d", strtotime($_POST['tanggal']));
				
			$q1 = mysql_query("UPDATE tbl_bensin SET jenis='$jenis', keterangan='$keterangan', jumlah='$input', tanggal='$tanggal'
			                                               WHERE id%2=0 AND id='$_REQUEST[ubah]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_bensin',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH')
								");
			}
			
		if(!empty($_REQUEST[delkas]))
			{
			$q1 = mysql_query("DELETE FROM tbl_bensin WHERE id%2=0 AND id='$_REQUEST[delkas]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_bensin',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'HAPUS $_REQUEST[jenis] $_REQUEST[jumlah]')
								");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>BENSIN <small>CATATAN KELUAR MASUK BENSIN</small></h4>	 
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    		<!--
                                    			<td align="right">
													<a href="printaj/kas1.php" target="_blank" style="cursor:pointer">
				                           				<button type="button" class="btn btn-info"><i class="fa fa-print"></i> &nbsp; Cetak</button>
													</a>
												</td>
											-->
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="width:100%;height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
												<?
												if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
													{
												?>
	                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
														<button type="button"  onclick="window.open('printaj/h1/bensin.php?periode_awal=<?echo $_SESSION[periode_awal]?>&periode_akhir=<?echo $_SESSION[periode_akhir]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
					                           		</td>
												<?
			                           				}
			                           			?>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									<?
									if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
										{
									?>
										<a data-toggle="modal" data-target="#compose-modal-inputkas" style="cursor:pointer">
	                           				<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Masuk/Keluar Bensin</button>
										</a>
									<?
										}
									?>
									
								<?
								if(!empty($_REQUEST[periode]))
									{
								?>	
			                        <table id="example2" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="10%">TANGGAL</th>
												<th>KETERANGAN</th>
												<th width="15%">MASUK (LITER)</th>
												<th width="15%">KELUAR (LITER)</th>
												<th width="5%">AKSI</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
			                            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            //echo  $_SESSION[periode_awal].$_SESSION[periode_akhir];
			                            
										$q1 = mysql_query("SELECT * FROM tbl_bensin WHERE id%2=0 AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0' ORDER BY id DESC");
										$dI = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT' AND status='0'"));
										$dO = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT' AND status='0'"));
										$dIx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0'"));
										$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0'"));
										$dT = $dI[total]-$dO[total];
										
										$cek1 = strpos($dIx[total],".");
										if($cek1){
										  $dItotal = $dIx[total];
											}
										else{
										  $dItotal = $dIx[total]+0 .".0";
											}
											
										$cek2 = strpos($dOx[total],".");
										if($cek2){
										  $dOtotal = $dOx[total];
											}
										else{
										  $dOtotal = $dOx[total]+0 .".0";
											}
											
										$cek3 = strpos($dT,".");
										if($cek3){
										  $dTX = $dT;
											}
										else{
										  $dTX = "$dT.0";
											}
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$cek4 = strpos($d1[jumlah],".");
											if($cek4){
											  $jumlah = $d1[jumlah];
												}
											else{
											  $jumlah = "$d1[jumlah].0";
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
			                                    <td><?echo $d1['keterangan']?></td>
		                                    <?
		                                    if($d1['jenis']=='INPUT')
		                                    	{
											?>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlah?></span></td>
			                                    <td align="center">-</td>
											<?	
												}
											else
												{
											?>
			                                    <td align="center">-</td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlah?></span></td>
											<?
												}
		                                    ?>
			                                    <td width="1%" align="center">
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                                    	<div class="btn-group">
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<li><a data-toggle="modal" data-target="#compose-modal-ubah<?echo $d1[id]?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&delkas=$d1[id]&periode=$_REQUEST[periode]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                            </ul>
			                                        </div>
			                                    <?
			                                    	}
			                                    ?>
			                                        </td>
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="5"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">TOTAL (LITER) : </th>
			                                    <th style="text-align:center;font-size:15px"><?echo ROUND($dItotal,1)?></th>
			                                    <th style="text-align:center;font-size:15px"><?echo ROUND($dOtotal,1)?></th>
			                                    <th rowspan="2"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">STOK AKHIR (LITER) : </th>
			                                    <th colspan="2" style="text-align:center;font-size:15px"><?echo ROUND($dTX,1)?></th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                    <?
			                    	}
			                    	
								else
									{
								?>	
			                        <table id="example2" class="table table-bordered table-striped">
			                            <?
			                            $dI = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT' AND status='0'"));
										$dO = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT' AND status='0'"));
										$dT = $dI[total]-$dO[total];
										?>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="5"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">STOK AKHIR (LITER) : </th>
			                                    <th colspan="2" style="text-align:center;font-size:15px"><?echo $dT?></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="5"></th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                    <?
			                    	}
			                    ?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
			        <?
			        $qM = mysql_query("SELECT * FROM tbl_bensin WHERE id%2=0 AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='0' ORDER BY id DESC");
					while($dM = mysql_fetch_array($qM))
			            {
			        ?>
<!-- ################## MODAL UBAH BENSIN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah<?echo $dM[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL BENSIN</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
					                    <table width="100%">
					                    		<tr>
					                    			<td width="180px">JENIS</td>
					                    			<td>:</td>
					                    			<td colspan="3"><select name="jenis" onchange="populateSelect(this.value)" style="width:44%" class="form-control" required>
															<option value='' >- PILIH -</option>
															<option value='OUTPUT' <?if($dM[jenis]=='OUTPUT'){?>selected=""<?}?>>KELUAR</option>
															<option value='INPUT' <?if($dM[jenis]=='INPUT'){?>selected=""<?}?>>MASUK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL</td>
					                    			<td>:</td>
					                    			<td colspan="3">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="min-width:50px;text-align:center"><i class="fa fa-calendar"></i></span>
															<input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($dM[tanggal]))?>" class="form-control" style="width:35%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="">
					                    				</div>		
													</td>
												</tr>
					                    		<tr>
					                    			<td valign="top">KETERANGAN</td>
					                    			<td valign="top">:</td>
					                    			<td valign="top" colspan="3"><textarea name="keterangan" class="form-control" maxlength="50" required><?echo $dM[keterangan]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                    					<input type="text" name="jumlah" lass="form-control" maxlength="6" value="<?echo $dM[jumlah]?>" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789.')" required>
					                                        <span class="input-group-addon" style="min-width:50px;text-align:center">LITER</span>
					                    				</div>
													</td>
													<td colspan="2"></td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
													<td colspan="3"><i>Gunakan Tanda Titik "." Jangan Tanda Koma ","</i></td>
												</tr>
					                    		<input type="hidden" name="ubah" value="<?echo $dM[id]?>">
					                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
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
			        
<!-- ################## MODAL INPUT BENSIN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-inputkas" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">KELUAR/MASUK BENSIN</h4>
				                    </div>
				                    
				                   	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
			                        <div class="modal-body">
					                    <table width="100%">
					                    		<tr>
					                    			<td width="180px">JENIS</td>
					                    			<td>:</td>
					                    			<td colspan="3"><select name="jenis" onchange="populateSelect(this.value)" style="width:44%" class="form-control" required>
															<option value='' >- PILIH -</option>
															<option value='OUTPUT' >KELUAR</option>
															<option value='INPUT' >MASUK</option>
														</select></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TANGGAL</td>
					                    			<td>:</td>
					                    			<td colspan="3">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="min-width:50px;text-align:center"><i class="fa fa-calendar"></i></span>
															<input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width:35%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="">
					                    				</div>		
													</td>
												</tr>
					                    		<tr>
					                    			<td valign="top">KETERANGAN</td>
					                    			<td valign="top">:</td>
					                    			<td valign="top" colspan="3"><textarea name="keterangan" maxlength="50" class="form-control" required><?echo $d1[keterangan]?></textarea></td>
					                    		</tr>
					                    		<tr>
					                    			<td>JUMLAH</td>
					                    			<td>:</td>
					                    			<td width="25%">
					                                    <div class="input-group">
					                    					<input type="text" name="jumlah" class="form-control" maxlength="6" placeholder="0" style="width:100%;text-align:right"  onkeypress="return buat_angka(event,'0123456789.')"required>
					                                        <span class="input-group-addon" style="min-width:50px;text-align:center">LITER</span>
					                    				</div>
													</td>
													<td colspan="2"></td>
												</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
													<td colspan="3"><i>Gunakan Tanda Titik "." Jangan Tanda Koma ","</i></td>
												</tr>
					                    		<input type="hidden" name="input" value="1">
					                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
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
				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
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

            });
            //Date range as a button
                //Date range picker
                $('#reservation').daterangepicker();

        </script>
<?
		}
?>