<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if($_REQUEST[input]=="1")
				{	
				$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_stokmin WHERE idbarang='$_REQUEST[idbarang]'"));
				if(!empty($dCek[id]))
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&input=0&note=2'/>";
					exit();
					}
				
				$stokminimum 	= preg_replace( "/[^0-9]/", "",$_REQUEST[stokminimum]);
				$q1 = mysql_query("INSERT INTO x23_stokmin VALUES ('','$_REQUEST[idbarang]','$stokminimum')");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_stokmin',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'TAMBAH STOK MINIMUM $_REQUEST[idbarang]')
								");
						
				if($q1 && $q2)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=0&note=1&input='/>";
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
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah]))
				{				
				$stokminimum 	= preg_replace( "/[^0-9]/", "",$_REQUEST[stokminimum]);
				$q1 = mysql_query("UPDATE x23_stokmin SET
													stokmin='$stokminimum'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_stokmin',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH STOK MINIMUM $_REQUEST[ubah]')
									");
					
					if($q1 && $q2)
						{
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
			                	<h4>MASTER <small>STOK MINIMUM</small></h4>
									<?
									if($_REQUEST[note]=="1")
										{
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <p>Proses Berhasil, Stok Minimum Telah Disimpan.</p>
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
	                                        <p>Proses Gagal, Stok Minimum Untuk Barang Tersebut Sudah Ada Pada Database, Silahkan Menggunakan Tombol Ubah Jika Ingin Mengubah Stok Minimumnya.</p>
	                                    </div>
									<?
										}
									?>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Stok Minimum Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
	                           				<button type="button"  onclick="window.open('printaj/h2/stokminimum.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">NAMA BARANG</th>
			                                    <th style="padding:7px">VARIAN</th>
			                                    <th style="padding:7px">STOK MINIMUM</th>
			                                    <th style="padding:7px">STOK TERKINI</th>
			                                    <th style="padding:7px">STATUS</th>
			                                    <th width="5%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_stokmin");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$d1[idbarang]'"));
			                            	$d3 = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS totqty FROM x23_stokpart WHERE idbarang='$d1[idbarang]' GROUP BY idbarang"));
			                            	
			                            	if($d3[totqty]>$d1[stokmin]){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>STOK AMAN</span>";}
			                            	if($d3[totqty]<=$d1[stokmin]){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>HARAP PESAN</span>";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[idbarang]"?>'"><?echo $d2[kodebarang]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[idbarang]"?>'"><?echo $d2[namabarang]?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[idbarang]"?>'"><?echo $d2[varian]?></td>
			                                	<td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[idbarang]"?>'"><span style="padding-right:20%"><?echo number_format($d1[stokmin],"0","",".")?> PCS</span></td>
			                                	<td align="right" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[idbarang]"?>'"><span style="padding-right:20%"><?echo number_format(round($d3[totqty]/2),"0","",".")?> PCS</span></td>
			                                    <td align="center" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[ididbarang]"?>'"><?echo $status?></td>
			                                    <td width="1%" align="center"><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i></a></td>
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
					
<!-- ################## MODAL STOK MINIMUM ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:60%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">STOK MINIMUM BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang WHERE id%2=0 ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>"><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STOK MINIMUM</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="stokminimum" style="width:100%;text-align:right" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
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
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokmin WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                    <h4>MASTER <small>STOK MINIMUM</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:70%;">
				                    		<tr>
				                    			<td width="20%">NAMA BARANG</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idbarang" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterbarang ORDER BY kodebarang");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[id]?>"<?if($dA[id]==$d1[idbarang]){?>selected=""<?}?>><?echo "$dA[kodebarang] | $dA[namabarang] | $dA[varian]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>STOK MINIMUM</td>
				                    			<td>:</td>
				                    			<td width="15%">
				                                    <div class="input-group">
				                                        <input type="text" name="stokminimum" style="width:100%;text-align:right" value="<?echo $d1[stokmin]?>" class="form-control uang" maxlength="4" onkeypress="return buat_angka(event,'1234567890')"  required>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
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
						
					else if($mod == "view")
						{
						$dA = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterbarang WHERE id='$_REQUEST[id]'"));
			            $dB = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS totqty FROM x23_stokpart WHERE idbarang='$_REQUEST[id]' GROUP BY idbarang"));
?>
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                	<h4>LIHAT STOK <small>BARANG &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Detail Barang</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">KODE BARANG</td>
					                    			<td width="3%">:</td>
					                    			<td><input type="text" value="<?echo $dA[kodebarang]?>" class="form-control" style="width:100%" disabled></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NAMA BARANG</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo $dA[namabarang]?>" class="form-control" style="width:100%" disabled></td>
					                        	</tr>
					                        	<tr>
					                        		<td>VARIAN</td>
					                        		<td>:</td>
					                    			<td><input type="text" value="<?echo $dA[varian]?>" class="form-control" style="width:100%" disabled></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td>TOTAL STOK</td>
					                        		<td>:</td>
					                    			<td><div class="input-group">
				                                        <input type="text" name="qty" style="width:100%;text-align:right" class="form-control uang" value="<?echo number_format($dB[totqty])?>" disabled>
				                                    	<span class="input-group-addon" style="width:30%;text-align:left">PCS</span>
				                                    </div></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
				                        	<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										</div>
					                </div>
				                    </form>
			                    </div>
			                </div>
			            </div>
			            
			            <div class="col-xs-12">
			                <div class="box box-info">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:260px;">
			                        <table id="example2" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="12%" style="padding:7px">NO. NOTA BELI</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="10%" style="padding:7px"><center>GUDANG</center></th>
			                                    <th width="10%" style="padding:7px"><center>RAK</center></th>
			                                    <th width="10%" style="padding:7px"><center>TANGGAL BELI</center></th>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                                    	<th width="12%" style="padding:7px"><center>HARGA BELI + PPN (RP)</center></th>
			                                    <?
			                                    	}
			                                    ?>
			                                    <th width="12%" style="padding:7px"><center>HARGA JUAL</br>NORMAL (RP)</center></th>
			                                    <th width="7%" style="padding:7px"><center>STOK</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?	                         
										$qA = mysql_query("SELECT * FROM x23_stokpart_vw WHERE idbarang='$_REQUEST[id]'");
			                            while($dA = mysql_fetch_array($qA))
			                            	{
			                            	$dS = mysql_fetch_array(mysql_query("SELECT nama FROM x23_notabeli_vw WHERE nonota='$dA[nonota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $dA[nonota]?></td>
			                                    <td><?echo $dS[nama]?></td>
			                                    <td><?echo $dA[gudang]?></td>
			                                    <td><?echo $dA[rak]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($dA[tglnota]))?></td>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
			                                    	<td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargabelibersih]*1.1,"0","",".")?></span></td>
			                                    <?
			                                    	}
			                                    ?>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="margin-right:0%"><?echo number_format(round($dA[stok]/2),"0","",".")?> PCS</span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                             ?>
			                            </tbody>
			                            <!--
			                            <tfoot>
			                            	<tr>
			                            		<th colspan=""></th>
			                            		<th colspan="" align="right">GRAND TOTAL</th>
			                            		<td colspan="" align="right"><span style="margin-right:0%"><b><?echo number_format($d1[totalqty])?> PCS</b></span></td>
			                            		<td colspan="" align="right"></td>
			                            		<td colspan="" align="right"><span style="margin-right:20%"><b><?echo number_format($d1[grandtotal])?></b></span></td>
			                            		<th colspan="2"></th>
			                            	</tr>
			                            </tfoot>
			                            -->
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
?>
	
        <script src="js/jquery.min.js"></script>
        <script>
        //SELECT2
			$(function(){
			           
			  var select = $('.select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });
			  $("#tagPicker2").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>