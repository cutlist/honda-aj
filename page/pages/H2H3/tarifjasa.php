<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$idjasa	 	= $_REQUEST['idjasa'];
				$pangkat	= $_REQUEST['pangkat'];
				$tarif 		= preg_replace( "/[^0-9]/", "",$_REQUEST['tarif']);
				if($tarif=='0')
					{
					echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
					
				$dCek2 = mysql_fetch_array(mysql_query("SELECT tarif FROM x23_tarifjasa2_vw WHERE idjasa='$idjasa' AND pangkat='$pangkat' ORDER BY tarif DESC LIMIT 0,1"));
				if(!empty($dCek2[tarif]))
					{
					if($dCek2[tarif] > $tarif)
						{
						echo "<script>alert (' Mohon Ulangi, Karena Tarif Jasa Ke Mekanik Lebih Besar Dari Tarif Jasa Ke Konsumen.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
					}
				
				$dCek3 = mysql_fetch_array(mysql_query("SELECT id FROM x23_tarifjasa WHERE idjasa='$idjasa' AND pangkat='$pangkat' ORDER BY tarif DESC LIMIT 0,1"));
				if(!empty($dCek3[id]))
					{
					echo "<script>alert (' Mohon Ulangi, Karena Jasa Dan Pangkat Sudah Ada Pada Database.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				
				$q1 = mysql_query("INSERT INTO x23_tarifjasa (
												idjasa, 
												pangkat, 
												tarif) 
											VALUES (
												'$idjasa', 
												'$pangkat', 
												'$tarif');
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_tarifjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'TAMBAH TARIF JASA KONSUMEN $nama')
									");
						
						
				if($q1)
					{
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1'/>";
					}
				else
					{
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				}

			if(!empty($_REQUEST[deluser]))
				{
				$q1 = mysql_query("DELETE FROM x23_tarifjasa WHERE id='$_REQUEST[deluser]'");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_tarifjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'HAPUS TARIF JASA KONSUMEN $_REQUEST[nama]')
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
			if(!empty($_REQUEST[ubah]))
				{				
				$tarif 		= preg_replace( "/[^0-9]/", "",$_REQUEST['tarif']);
				/*
				if($tarif=='0')
					{
					echo "<script>alert ('Nominal Yang Diinput Tidak Bisa 0 (Nol).')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				*/
				$dCek2 = mysql_fetch_array(mysql_query("SELECT tarif FROM x23_tarifjasa2_vw WHERE idjasa='$_REQUEST[idjasa]' AND pangkat='$_REQUEST[pangkat]' ORDER BY tarif DESC LIMIT 0,1"));
				if(!empty($dCek2[tarif]))
					{
					if($dCek2[tarif] > $tarif)
						{
						echo "<script>alert (' Mohon Ulangi, Karena Tarif Jasa Ke Mekanik Lebih Besar Dari Tarif Jasa Ke Konsumen.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
					}
							
				$q1 = mysql_query("UPDATE x23_tarifjasa SET
													tarif='$tarif'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'x23_tarifjasa',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH TARIF JASA KONSUMEN $_REQUEST[ubah]')
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
			                	<h4>MASTER <small>TARIF JASA KONSUMEN</small></h4>
	                           		<div style="float:left" class="col-xs-5">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-filter"></i>
			                                            </div>
		                                            	<input type="text" style="height:34px" name="cari" autofocus placeholder="CARI KODE JASA / NAMA JASA / GOLONGAN ..." class="form-control"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
                                    </div>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-tarifjasa" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Tarif Jasa Baru</button>
										</a>
										<?
										if($_SESSION[posisi]=='DIREKSI' || $_SESSION[posisi]=='KEPALA BENGKEL')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/tarifjasa.php?cari=<?echo $_REQUEST[cari]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE JASA</th>
			                                    <th style="padding:7px">NAMA JASA</th>
			                                    <th width="" style="padding:7px">GOLONGAN</th>
			                                    <th width="20%" style="padding:7px">TARIF KE KONSUMEN (RP)</th>
			                                    <th width="1%" style="padding:7px">UBAH</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										if(!empty($_REQUEST[cari]))
											{
											$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw WHERE kodejasa LIKE '%$_REQUEST[cari]%' OR namajasa LIKE '%$_REQUEST[cari]%' OR pangkat LIKE '%$_REQUEST[cari]%' LIMIT 0,20");
											}
										else
											{
											$q1 = mysql_query("SELECT * FROM x23_tarifjasa_vw ORDER BY id DESC LIMIT 0,20");
											}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[kodejasa]?></td>
			                                    <td><?echo $d1[namajasa]?></td>
			                                    <td><?echo $d1[pangkat]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[tarif],"0","",".")?></span></td>
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
					
<!-- ################## MODAL TAMBAH TARIF JASA KONSUMEN ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-tarifjasa" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:55%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH TARIF JASA KONSUMEN BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">KODE JASA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idjasa" class="form-control select1" style="font-size:12px;padding:3px" required="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterjasa ORDER BY namajasa");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo "$dA[id]"?>'><?echo "$dA[kodejasa] | $dA[namajasa]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GOLONGAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="pangkat" style="width: 50%" required="">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM x23_pangkat ORDER BY pangkat");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[pangkat]?>' <?if($d1[pangkat]==$dA[pangkat]){?>selected=""<?}?>><?echo $dA[pangkat]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TARIF</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="tarif" class="form-control uang" placeholder="0" style="width:30%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
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
				
<!-- ################################################################################################################################# -->
<?
						}
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_tarifjasa WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>TARIF JASA KONSUMEN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Tarif Jasa</small></h4>
				                	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table width="60%">
				                    		<tr>
				                    			<td width="30%">KODE JASA</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idjasa" class="form-control select1" style="font-size:12px;padding:3px" disabled="">
																		<option value='' selected>Pilih</option>
																		<?
																			$q1 = mysql_query("SELECT * FROM x23_masterjasa ORDER BY namajasa");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo "$dA[id]"?>' <?if($dA[id]==$d1[idjasa]){?>selected=""<?}?>><?echo "$dA[kodejasa] | $dA[namajasa]"?></option>
																		<?
																				}
																		?>
																    </select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>GOLONGAN</td>
				                    			<td>:</td>
				                    			<td colspan="2"><select class="form-control" name="pangkat" style="width: 50%" disabled="">
																	<option value=''>Pilih</option>
																<?
																	$q1 = mysql_query("SELECT * FROM x23_pangkat ORDER BY pangkat");
																	while($dA=mysql_fetch_array($q1))
																		{
																?>
																			<option value='<?echo $dA[pangkat]?>' <?if($d1[pangkat]==$dA[pangkat]){?>selected=""<?}?>><?echo $dA[pangkat]?></option>
																<?
																		}
																?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TARIF</td>
				                    			<td>:</td>
				                    			<td colspan="2">
				                                    <div class="input-group">
				                                        <span class="input-group-addon">RP.</span>
				                                        <input type="text" name="tarif" value="<?echo number_format($d1[tarif],"0","",".")?>" class="form-control uang" placeholder="0" style="width:30%;text-align:right" maxlength="17" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required>
				                                    </div>
						                        </td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $_REQUEST[id]?>">
					                    	<input type="hidden" name="pangkat" value="<?echo $d1[pangkat]?>">
					                    	<input type="hidden" name="idjasa" value="<?echo $d1[idjasa]?>">
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
?>
	
        <script src="js/jquery.min.js"></script>
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
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>