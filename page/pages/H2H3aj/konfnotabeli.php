<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Berhasil, Proses Dilanjutkan Ke Menu Master Input Harga.</p>";
											}
										if($_REQUEST[note]=="2")
											{
											$ket = "<p>Proses Berhasil, Membutuhkan Konfirmasi Pihak Manajemen Dikarenakan Ada Qty Tiba Yang Tidak Sama Dengan Qty Beli.</p>";
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
	                           		<div style="float:right" class="col-xs-7">
	                           		</div>
			                        <table id="example1" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="15%">NO. NOTA BELI</th>
			                                    <th style="padding:7px" width="12%">TGL NOTA BELI</th>
			                                    <th style="padding:7px" width="15%">NO. PO</th>
			                                    <th style="padding:7px" width="12%">TGL PO</th>
			                                    <th style="padding:7px">NAMA SUPPLIER</th>
			                                    <th width="10%" style="padding:7px">QTY BELI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE id%2=0 AND scan='0'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=u1&id=$d1[id]"?>'">
			                                    <td align="center"><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="center"><?echo $d1[nopo]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td><?echo $d1[nama]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[totalqty],"0","",".")?> PCS</span></td>
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
	else if($submenu == 'u1')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK</small></h4>			                	
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$qA = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																		while($dA=mysql_fetch_array($qA))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($d1[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="30" style="width:90%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u2"?>">
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="10%" style="padding:7px"><center>QTY TIBA</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
											$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_stokpart WHERE id%2=0 AND nonota='$dA[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]'AND rak='$dA[rak]'"));
			                            	if($dB[stok] != $dA[qty]){
				                                if($d1[konf]=='1')
				                                	{
													$red = "color:#ff0227";
													}
												}
											else{$red="";}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo "$dA[kodebarang]"?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                <?
			                                if($d1[konf]=='0')
			                                	{
			                                ?>
			                                    <td align="center"><input type="text" name="qtytiba<?echo $dA[id]?>" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')" style="width:80%;text-align:right;height:25px" required=""></td>
			                                <?
			                                	}
			                                else
			                                	{
			                                ?>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dB[stok],"0","",".")?> PCS</span></td>
											<?
												}
											?>
			                                    <td><?echo $dA[gudang]?></td>
			                                    <td><?echo $dA[rak]?></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        <?
	                                if($d1[konf]=='1')
	                                	{
	                                ?>
				                        </br>
				                        <table>
				                        	<tr>
				                        		<td colspan="3"><b>Keterangan</b></td>
				                        	</tr>
				                        	<tr>
				                        		<td style="color:#ff0227">Merah</td>
				                        		<td width="15px" align="center">:</td>
				                        		<td>Qty Barang Tiba Tidak Sama Dengan Qty Beli</td>
				                        	</tr>
				                        	<tr>
				                        		<td>Hitam</td>
				                        		<td align="center">:</td>
				                        		<td>Qty Barang Tiba Sama Dengan Qty Beli</td>
				                        	</tr>
				                        </table>
			                        <?
			                        	}
			                        ?>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				                        <div class="modal-footer clearfix"> 
				                        <?
			                                if($d1[konf]=='0')
			                                	{
			                            ?>
				                        	<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
				                        <?
				                        		}
				                        ?>
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
		
	else if($submenu == 'u2')
		{
		$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notabeli WHERE id%2=0 AND id='$_REQUEST[id]'"));
		$qA = mysql_query("SELECT id FROM x23_notabeli_det WHERE id%2=0 AND nonota='$d1[nonota]'");
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12" style="margin-bottom:10px">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>KONFIRMASI NOTA BELI <small>UNIT MASUK <i class="fa fa-angle-right"></i> <?echo $d1[nodo]?></small></h4>
			                						              
				                	<div style="padding:20px">
					           			<div class="col-xs-6">
					                        <table width="100%">
					                    		<tr>
					                    			<td width="35%">NAMA SUPPLIER</td>
					                    			<td width="3%">:</td>
					                    			<td><select class="form-control" name="idsupplier" style="width:100%" disabled="">
																		<option value=''>Pilih</option>
																		
																	<?
																		$qA = mysql_query("SELECT * FROM x23_supplier ORDER BY nama");
																		while($dA=mysql_fetch_array($qA))
																			{
																	?>
																				<option value='<?echo $dA[id]?>' <?if($d1[idsupplier]==$dA[id]){?>selected=""<?}?>><?echo $dA[nama]?></option>
																	<?
																			}
																	?>
														</select></td>
					                    		</tr>
					                        	<tr>
					                        		<td>NO. PO SUPPLIER</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nopo" value="<?echo $d1[nopo]?>" class="form-control" maxlength="30" style="width:90%" readonly></td>
					                        	</tr>
					                        	<tr>
					                        		<td>NO. NOTA BELI</td>
					                        		<td>:</td>
					                        		<td><input type="text" name="nonota" value="<?echo $d1[nonota]?>" class="form-control" maxlength="20" style="width:50%" readonly></td>
					                        	</tr>
					                        </table>
					                    </div>
					           			<div class="col-xs-6">
					                        <table width="100%">
					                        	<tr>
					                        		<td width="40%">TGL PO SUPPLIER</td>
					                        		<td width="3%">:</td>
					                    			<td><input type="text" name="tglpo" value="<?echo date("d-m-Y",strtotime($d1[tglpo]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        	<tr>
					                        		<td>TGL NOTA BELI</td>
					                        		<td>:</td>
					                    			<td><input type="text" name="tglnota" value="<?echo date("d-m-Y",strtotime($d1[tglnota]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly style="width:40%"></td>
					                        	</tr>
					                        </table>
					                    </div>
					                </div>
					                <div class="col-xs-12" style="margin:5px"></div>
					                
					            	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=u3"?>">  
			                        <table class="table table-striped" id="example2">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">KODE BARANG</th>
			                                    <th style="padding:7px">BARANG</th>
			                                    <th width="7%" style="padding:7px"><center>QTY BELI</center></th>
			                                    <th width="10%" style="padding:7px"><center>QTY TIBA</center></th>
			                                    <th width="" style="padding:7px">GUDANG</th>
			                                    <th width="" style="padding:7px">RAK</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND nonota='$d1[nonota]'");
			                            while($dA = mysql_fetch_array($q1))
			                            	{
											$qtytiba 	= preg_replace( "/[^0-9]/", "",$_REQUEST[qtytiba.$dA[id]]);
			                            	if($qtytiba != $dA[qty]){
												$red = "color:#ff0227";
												}
											else{$red="";}
			                            ?>
			                                <tr style="cursor:pointer;<?echo $red?>">
			                                    <td><?echo "$dA[kodebarang]"?></td>
			                                    <td><?echo "$dA[namabarang] | $dA[varian]"?></td>
			                                    <td align="right"><span style="margin-right:20%"><?echo number_format($dA[qty],"0","",".")?> PCS</span></td>
			                                    <td align="right"><input type="text" name="qtytiba<?echo $dA[id]?>" class="form-control uang" value="<?echo $qtytiba?>" style="width:80%;text-align:right;height:25px" readonly=""></td>
			                                    <td><?echo $dA[gudang]?></td>
			                                    <td><?echo $dA[rak]?></td>
			                                </tr>
			                                
			                           	<?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                        </br>
			                        <table>
			                        	<tr>
			                        		<td colspan="3"><b>Keterangan</b></td>
			                        	</tr>
			                        	<tr>
			                        		<td style="color:#ff0227">Merah</td>
			                        		<td width="15px" align="center">:</td>
			                        		<td>Qty Barang Tiba Tidak Sama Dengan Qty Beli</td>
			                        	</tr>
			                        	<tr>
			                        		<td>Hitam</td>
			                        		<td align="center">:</td>
			                        		<td>Qty Barang Tiba Sama Dengan Qty Beli</td>
			                        	</tr>
			                        </table>
					                
				           			<div class="col-xs-12">
				           				<input type="hidden" name="id" value="<?echo $_REQUEST[id]?>"/>
				           				<input type="hidden" name="nonota" value="<?echo $d1[nonota]?>"/>
				                        <div class="modal-footer clearfix">
				                        	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
											<button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=u1&id=$_REQUEST[id]"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
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
		
	else if($submenu == 'u3')
		{
		//mysql_query("DELETE FROM x23_stokpart WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			  
		$p_tahun = date("Y");
		$p_bulan = date("m");
			
		$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
		$dId = mysql_fetch_array(mysql_query("SELECT id FROM x23_notabeli WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		
		mysql_query("TRUNCATE x23_temp_qtytiba");
        while($dA = mysql_fetch_array($qA))
        	{
        	$id = $dA[id];
        	$stok = $_REQUEST[qtytiba.$dA[id]];
        	$selisih = $dA[qty] - $stok;
        	
			//echo "<script>alert ('$dA[qty].$stok.$_REQUEST[nonota]')</script>";
			//exit();
			
	        mysql_query("UPDATE x23_notabeli_det SET tgltiba=CURDATE() WHERE id%2=0 AND id='$id'");	
	        	
        	if($dA[qty] != $stok){		
	        	$status = "0";
	        	mysql_query("INSERT INTO x23_temp_qtytiba values ('1')");	
				}
			else{
	        	$status = "1";
				}				
	        	mysql_query("INSERT INTO x23_stokpart (
	        									idgudang, 
	        									rak, 
	        									nonota, 
	        									idbarang,
	        									hargabelibersih, 
	        									stok, 
	        									status, 
	        									inputx,
	        									updatex) 
	        								VALUES (
	        									'$dA[idgudang]',
	        									'$dA[rak]', 
	        									'$dA[nonota]', 
	        									'$dA[idbarang]', 
	        									'$dA[hargabelibersih]', 
	        									'$stok',
	        									'$status',
	        									NOW(),
	        									'$updatex') 
	        				");
        	}
        	
		$dD = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS cek FROM x23_temp_qtytiba"));
		/*
			echo "<script>alert ('$dD[cek].')</script>";
			exit();
        */
        if($dD[cek] > "0")
        	{
        	$note = "2";
			mysql_query("UPDATE x23_notabeli SET updatex='$updatex',konf='1',iduserkonf='$_SESSION[id]' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			mysql_query("INSERT INTO x23_abis_dkonfirmasi (
											idnotabeli, 
											tahun, 
											bulan, 
											tanggal,
											kasus, 
											tbl,
											inputx) 
										VALUES (
											'$dId[id]', 
											'$p_tahun', 
											'$p_bulan', 
											CURDATE(), 
											'KONFIRMASI NOTA BELI NO. $_REQUEST[nonota] : QTY TIBA TIDAK SAMA DENGAN QTY BELI ', 
											'x23_notabeli', 
											NOW())
						");
			}
        if($dD[cek] == "0")
        	{
        	$note = "1";
			mysql_query("UPDATE x23_notabeli SET scan='1',konf='1',gtbayar=grandtotalppn,iduserkonf='$_SESSION[id]',updatex='$updatex' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			}
        /*
		$dB = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS qty FROM x23_notabeli_det WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		$dC = mysql_fetch_array(mysql_query("SELECT SUM(stok) AS qty FROM x23_stokpart WHERE id%2=0 AND nonota='$_REQUEST[nonota]'"));
		if($dB[qty]==$dC[qty])
			{
			mysql_query("UPDATE x23_notabeli SET gtbayar=grandtotal WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			mysql_query("UPDATE x23_notabeli SET scan='1',konf='1',updatex='$updatex' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			}
		else
			{
			mysql_query("UPDATE x23_notabeli SET updatex='$updatex',konf='1' WHERE id%2=0 AND nonota='$_REQUEST[nonota]'");
			}
		*/		
		$q3 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'x23_stokpart',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH STOK $_REQUEST[nonota]')
							");
				
		if($q3)
			{
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=$note'/>";
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
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>