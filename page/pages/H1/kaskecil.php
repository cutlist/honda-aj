<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[input]))
			{
			$jenis = strtoupper($_REQUEST['jenis']);
			$keterangan = strtoupper($_REQUEST['keterangan']);
			$jumlah = preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
			$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
			$tahun = substr($tanggal,1,4);
			$bulan = substr($tanggal,5,2);
				
			$q1 = mysql_query("INSERT INTO tbl_kaskecil (
													jenis,
													tanggal,
													keterangan,
													jumlah) 
												VALUES (
													'$jenis',
													'$tanggal',
													'$keterangan',
													'$jumlah')");
													
			$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
			$idkaskecil	= $id[id];
													
			$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
												idkaskecil, 
												tahun, 
												bulan, 
												tanggal, 
												kasus, 
												tbl, 
												inputx) 
											VALUES (
												'$idkaskecil', 
												'$tahun', 
												'$bulan', 
												'$tanggal', 
												'$jenis KAS KECIL : $keterangan RP. $_REQUEST[jumlah]', 
												'tbl_kaskecil', 
												NOW())
								");
							
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_kaskecil',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    '$jenis $_REQUEST[jumlah]')
								");
								
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'>";
			}
			
		if(!empty($_REQUEST[ubah]))
			{
			$jenis = strtoupper($_REQUEST['jenis']);
			$keterangan = strtoupper($_REQUEST['keterangan']);
			$jumlah = preg_replace( "/[^0-9]/", "",$_REQUEST['jumlah']);
			$tanggal 	= date("Y-m-d", strtotime($_POST['tanggal']));
				
			$q1 = mysql_query("UPDATE tbl_kaskecil SET jenis='$jenis', keterangan='$keterangan', jumlah='$jumlah', tanggal='$tanggal'
			                                               WHERE id='$_REQUEST[ubah]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_kaskecil',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH')
								");
			}
			
		if(!empty($_REQUEST[delkas]))
			{
			$q1 = mysql_query("DELETE FROM tbl_kaskecil WHERE id='$_REQUEST[delkas]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_kaskecil',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'HAPUS $_REQUEST[jenis] $_REQUEST[jumlah]')
								");
			}
			
		if(!empty($_REQUEST[periode]))
			{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
            }
        else{
            $_SESSION[periode_awal]  = date("Y-m-d");
            $_SESSION[periode_akhir] = date("Y-m-d");
			}
										
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>KAS KECIL</small></h4>	 
                                    <div style="float:right;width:55%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode Tanggal Kas Kecil"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="40%">
													<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
													
				                           				<button type="button"  onclick="window.open('print/h1/kaskecil.php?periode_awal=<?echo $_SESSION[periode_awal]?>&periode_akhir=<?echo $_SESSION[periode_akhir]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                           		</td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
									<a data-toggle="modal" data-target="#compose-modal-inputkas" style="cursor:pointer">
                           				<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Keluar/Masuk Kas</button>
									</a>
									
			                        <table id="" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="10%">TANGGAL</th>
												<th>KETERANGAN</th>
												<th width="15%">UANG MASUK (RP)</th>
												<th width="15%">UANG KELUAR (RP)</th>
												<th width="5%">STATUS</th>
												<th width="5%">AKSI</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            //echo  $_SESSION[periode_awal].$_SESSION[periode_akhir];
			                            
										$no=1;
										$dB = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kaskecil ORDER BY id DESC LIMIT 0,1"));
										$q1 = mysql_query("SELECT * FROM tbl_kaskecil WHERE tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' ORDER BY id DESC");
										$dI = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE jenis='INPUT' AND status='1'"));
										$dO = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE jenis='OUTPUT' AND status='1'"));
										$dIx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE jenis='INPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='1'"));
										$dOx = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_kaskecil WHERE jenis='OUTPUT' AND tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND status='1'"));
										$dT = $dI[total]-$dO[total];
										
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1['tanggal']))?></td>
			                                    <td><?echo $d1['keterangan']?></td>
		                                    <?
		                                    if($d1['jenis']=='INPUT')
		                                    	{
											?>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
			                                    <td align="center">-</td>
											<?	
												}
											else
												{
											?>
			                                    <td align="center">-</td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1['jumlah'],0,",",".")?></span></td>
											<?
												}
		                                    ?>
			                                    <td width="1%" align="center"><?echo $status?></td>
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
											$no++;
			                            	}
			                            ?>
			                                <tr>
			                                    <td colspan="10"></td>
			                                </tr>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="6"></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">TOTAL (RP) : </th>
			                                    <th style="text-align:center;font-size:15px"><?echo number_format($dIx[total],"0","",".")?></th>
			                                    <th style="text-align:center;font-size:15px"><?echo number_format($dOx[total],"0","",".")?></th>
			                                    <th></th>
			                                    <th></th>
			                                </tr>
			                                <tr>
			                                    <th colspan="2" style="text-align:right">SALDO AKHIR (RP) : </th>
			                                    <th colspan="2" style="text-align:center;font-size:15px"><?echo number_format($dT,"0","",".")?></th>
			                                    <th></th>
			                                    <th></th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
			        <?
			        $qM = mysql_query("SELECT * FROM tbl_kaskecil WHERE tanggal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' ORDER BY id DESC");
					while($dM = mysql_fetch_array($qM))
			            {
			        ?>
<!-- ################## MODAL UBAH KAS ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-ubah<?echo $dM[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">UBAH DETAIL KAS</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
					                    <table width="100%">
					                    		<tr>
					                    			<td width="180px">JENIS</td>
					                    			<td>:</td>
					                    			<td colspan="3"><select name="jenis" onchange="populateSelect(this.value)" style="width:44%" class="form-control" required>
															<option value='' >- PILIH -</option>
															<option value='OUTPUT' <?if($dM[jenis]=='OUTPUT'){?>selected=""<?}?>>UANG KELUAR</option>
															<option value='INPUT' <?if($dM[jenis]=='INPUT'){?>selected=""<?}?>>UANG MASUK</option>
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
					                    			<td colspan="3">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="min-width:50px;text-align:center">RP.</span>
					                    					<input type="text" name="jumlah" id="uang2" class="form-control" maxlength="20" value="<?echo number_format($dM[jumlah],"0","",".")?>" style="width:35%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" required>
					                    				</div>
													</td>
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
			        
<!-- ################## MODAL INPUT KAS ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-inputkas" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">KELUAR/MASUK KAS</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
					                    <table width="100%">
					                    		<tr>
					                    			<td width="180px">JENIS</td>
					                    			<td>:</td>
					                    			<td colspan="3"><select name="jenis" onchange="populateSelect(this.value)" style="width:44%" class="form-control" required>
															<option value='' >- PILIH -</option>
															<option value='OUTPUT' >UANG KELUAR</option>
															<option value='INPUT' >UANG MASUK</option>
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
					                    			<td colspan="3">
					                                    <div class="input-group">
					                                        <span class="input-group-addon" style="min-width:50px;text-align:center">RP.</span>
					                    					<input type="text" name="jumlah" class="form-control uang" maxlength="14" placeholder="0" style="width:35%;text-align:right" onkeypress="return buat_angka(event,'0123456789')" required>
					                    				</div>
													</td>
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
				
<!-- ################## MODAL LOG KAS ########################################################################################## 
				        <div class="modal fade " id="compose-modal-logkas" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog"  style="width:600px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">LOG</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;height:500px;">
										<table id="example4" class="table table-striped">
											<thead>
				                                <tr>
				                                    <th width="1%">DATE</th>
				                                    <th width="1%">TIME</th>
				                                    <th width="1%">USER</th>
				                                    <th>ACTION</th>
				                                </tr>
				                       		</thead>
				                       		<tbody>
				                            <?
				                            $no = 1;
				                            $q1 = mysql_query("SELECT * FROM log_act WHERE tbl='tbl_kaskecil' ORDER BY id DESC LIMIT 100");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
				                            ?>
				                                <tr>
				                                    <td align=""><?echo $d1['tgl']?></td>
				                                    <td align=""><?echo substr($d1['jam'],0,5)?></td>
				                                    <td align=""><?echo $d1['user']?></td>
				                                    <td align=""><?echo $d1['act']?></td>
				                                </tr>
				                                
				                            <?
				                            	$no++;
				                            	}
				                            ?>
				                            </tbody>
				                        </table>
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