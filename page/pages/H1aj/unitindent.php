<script src="js/jquery.min.js"></script>
<?
	if($submenu == 'A')
		{
		unset($_SESSION[nopesan]);
?>
        <script>
			$(function(){
			           
			  var select = $('#select1').select2();
			});
			$(document).ready(function() {});
		</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENJUALAN <small>UNIT INDENT</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ketX = "<p>Proses Berhasil, Mohon Melanjutkan Ke Menu Indent Untuk Membuat Nota Penjualan.</p>";
											}
				
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
	                                        <?echo $ketX?>
	                                    </div>
									<?
										}
									?>
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>">
	                           				<button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Unit Indent Baru</button>
										</a>
	                           				<button type="button"  onclick="window.open('printaj/h1/unitindent.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           		</div>
									<table id="example1" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">NO. NOTA PESAN</th>
			                                    <th style="padding:7px">TGL NOTA PESAN</th>
			                                    <th style="padding:7px" width="20%">NAMA PELANGGAN</th>
			                                    <th width="1%" style="padding:7px">TELEPON</th>
			                                    <th width="35%" style="padding:7px">BARANG PESANAN</th>
			                                    <th style="padding:7px">NOMOR RANGKA</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE id%2=0 AND status='0' AND indent='1' AND id%2=0");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS stok FROM tbl_stokunit WHERE id%2=0 AND idbarang='$d1[idbarang]' AND status='STOK'"));
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo $d1[nopesan]?></td>
			                                    <td><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td><?echo $d1[notelepon]?></td>
			                                    <td><?echo "$d1[namabarang] | $d1[varian] | $d1[warna] | $d1[thnproduksi]"?></td>
			                                    <td><?echo $d1[norangka]?></td>
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
		
	if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENJUALAN <small>UNIT INDENT</small></h4>
			                	
				                	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NO. NOTA PESAN</td>
					                    			<td width="2%">:</td>
					                        		<td><input type="text" name="nopesan" value="<?echo $_SESSION[nopesan]?>" class="form-control" maxlength="40" style="width:30%" required></td>
					                        	</tr>
					                        </table>
					                    </div>
				                   	 	<p>Pembuatan Unit Indent Dilakukan Jika Sudah Dilakukannya Pembayaran Uang Muka/Uang Titipan.</p>
				                    </div>
				                    
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">					                        
				                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
											<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
	if($submenu == 'C')
		{
		if(empty($_SESSION[nopesan]))
			{
			$_SESSION[nopesan] = strtoupper($_REQUEST[nopesan]);
			$dC1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pesanan WHERE id%2=0 AND nopesan='$_SESSION[nopesan]' AND status='0' AND indent='0'"));
			
	        if(empty($dC1[id]))
				{
				echo "<script>alert ('Nomor Nota Pesan Yang Diinput Salah.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
				exit();
				}
				
			if(!empty($dC1[utitipan]) || $dC1[utitipan]!='0')
				{
				$dC2 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_kwitansi WHERE id%2=0 AND nomor='$_SESSION[nopesan]' AND jnskwitansi!='nopol'"));
				if(!empty($dC2[id])){
					$cek = "1";
					$red = "";
					}
				else{
					$cek = "0";
					$red = "color:#ff0227";
					}
				}
			if(empty($dC1[utitipan]) || $dC1[utitipan]=='0')
				{
				$cek = "1";
				$red = "";
				}
				
	        if($cek == "0")
				{
				echo "<script>alert ('Nomor Nota Pesan Yang Diinput Belum Melakukan Pembayaran Uang Muka/Uang Titipan.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
				exit();
				}
			}
				
		if(!empty($_REQUEST[temp]))
			{
			mysql_query("UPDATE tbl_pesanan_det SET 
										norangka='$_REQUEST[norangka]'
										WHERE id%2=0 AND id='$_REQUEST[temp]'");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>PENJUALAN <small>UNIT INDENT</small></h4>
			                	
				                	<form method="post" action="<?echo $action?>" enctype="multipart/form-data">
				                	<div style="padding:20px;min-height:200px;">
										<div style="min-height:90px">
					                    	<table style="width:70%">
					                    		<tr>
					                    			<td width="30%">NO. NOTA PESAN</td>
					                    			<td width="2%">:</td>
					                        		<td><input type="text" name="nopesan" value="<?echo $_SESSION[nopesan]?>" class="form-control" maxlength="40" style="width:30%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
				                    	
		                            	<div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            	
		                            	<?
		                            	$dQ = mysql_fetch_array(mysql_query("SELECT COUNT(nopesan) AS total FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_SESSION[nopesan]' GROUP BY nopesan"));
		                            	$qTemp  = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_SESSION[nopesan]'");
		                            	$qTemp2 = mysql_query("SELECT * FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_SESSION[nopesan]'");
		                            	?>
										<table id="example2" class="table table-striped" width="100%">
				                            <thead>
				                                <tr>
					                    			<th>KODE BARANG</th>
					                    			<th>BARANG</th>
					                    			<th>VARIAN</th>
					                    			<th>WARNA</th>
					                    			<th width="1%">TAHUN</th>
					                    			<th>NOMOR RANGKA</th>
					                    			<th width="1%"></th>
					                    		</tr>
					                    	</thead>
			                            	<tbody>
					                    	<?
					                    	while($dTemp = mysql_fetch_array($qTemp))
					                    		{
					                    		$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id%2=0 AND id='$dTemp[idbarang]'"))
					                    	?>
					                    		<tr>
					                    			<td><?echo $dBrg[kodebarang]?></td>
					                    			<td><?echo $dBrg[namabarang]?></td>
					                    			<td><?echo $dBrg[varian]?></td>
					                    			<td><?echo $dBrg[warna]?></td>
					                    			<td><?echo $dBrg[thnproduksi]?></td>
					                    			<?
					                    			if(empty($dTemp[norangka]))
					                    				{
													?>
														<td><button type="button" style="padding-top:0px;padding-bottom:0px" class="btn btn-warning" data-toggle="modal" data-target="#compose-modal-pilihnoka<?echo $dTemp[id]?>"><i class="fa fa-plus"></i> &nbsp; Pilih Nomor Rangka</button></td>
														<td></td>
													<?
														}
													else
														{
													?>
														<td><?echo $dTemp[norangka]?></td>
														<td align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=D&id=$dTemp[id]"?>"><i class="fa fa-trash-o"></i></a></td>
													<?
														}
					                    			?>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
				                    		</tbody>
				                    	</table>
				                    	<input type="hidden" name="id" value="<?echo $dA[id]?>"/>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="button" class="btn btn-primary pull-left" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=E"?>'"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
				                </form>
			                	</div>
			                </div>
					
                    	<?
                    	while($dTemp2 = mysql_fetch_array($qTemp2))
                    		{
                    	?>
<!-- ################## MODAL PILIH NOKA ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-pilihnoka<?echo $dTemp2[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">PILIH NOMOR RANGKA</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NOMOR RANGKA <?//echo $dTemp2[idbarang]?></td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="norangka" class="form-control" id="select<?echo $dTemp2[id]?>" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM tbl_stokunit WHERE id%2=0 AND idbarang='$dTemp2[idbarang]' AND status='STOK' AND norangka NOT IN (SELECT norangka FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_SESSION[nopesan]')");
																			while($d1=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $d1[norangka]?>"><?echo "$d1[norangka] | $d1[nomesin]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
					                    	<input type="hidden" name="temp" value="<?echo $dTemp2[id]?>">
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
				        <script>
							$(function(){
							           
							  var select = $('#select<?echo $dTemp2[id]?>').select2();
							});
							$(document).ready(function() {});
						</script>
<!-- ################################################################################################################################# -->
						<?
							}
						?>
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
	
	if($submenu == 'D')
		{
			mysql_query("UPDATE tbl_pesanan_det SET 
										norangka=''
										WHERE id%2=0 AND id='$_REQUEST[id]'");
										
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=C'/>";
			exit();
		}
	
	if($submenu == 'E')
		{
			$qA = mysql_query("SELECT norangka FROM tbl_pesanan_det WHERE id%2=0 AND nopesan='$_SESSION[nopesan]'");
			while($dA=mysql_fetch_array($qA))
				{
				mysql_query("UPDATE tbl_stokunit SET 
											status='$_SESSION[nopesan]'
											WHERE id%2=0 AND norangka='$dA[norangka]'");
				}
				
			mysql_query("UPDATE tbl_pesanan SET 
										indent='1'
										WHERE id%2=0 AND nopesan='$_SESSION[nopesan]'");
				
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
			exit();				
		}
?>		        
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>