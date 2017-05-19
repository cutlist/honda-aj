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
			                	<h4>GUDANG & PDI <small>STOCK OPNAME BENSIN</small></h4>
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="km")
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
                                    <div style="float:left;width:30%;margin-left:15px">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    	<?
                                    	if(!empty($_REQUEST[tahun]) && !empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = $_REQUEST[tahun];
                                    		$periode_bulan = $_REQUEST[bulan];
											}
                                    	else if(empty($_REQUEST[tahun]) && empty($_REQUEST[bulan]))
                                    		{
                                    		$periode_tahun = date("Y");
											$periode_bulan = date('m');
                                    		}
										?>
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['angkabln'];?>" <?if($periode_bulan == $data['angkabln']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($periode_tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>";
														<?php
															}
														?>
													</select>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
	                           		<div style="float:right" class="col-xs-7">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Stock Opname</button>
										</a>
	                           		</div>
			                        <table id="example3" class="table table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">TANGGAL STOK OPNAME</th>
			                                    <th style="padding:7px">HASIL STOK OPNAME</th>
			                                    <th style="padding:7px">KETERANGAN</th>
			                                    <th style="padding:7px" width="1%">STATUS</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$q1 = mysql_query("SELECT * FROM tbl_bensin WHERE id%2=0 AND kode='OPNAME' AND substr(tanggal,6,2)='$periode_bulan' AND substr(tanggal,1,4)='$periode_tahun'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-warning' style='padding:0px 10px;font-size:12px;'>MENUNGGU</span>";}
			                            	if($d1[status]=="0"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>DISETUJUI</span>";}
			                            	if($d1[status]=="2"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>DITOLAK</span>";}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $d1[opname]?> LITER</span></td>
			                                    <td><?echo $d1[keterangan]?></td>
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
		
	else if($submenu == 'B')
		{
		$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM tbl_bensin WHERE id%2=0 AND kode='OPNAME' AND status='1'"));
		if(!empty($dCek2[id]))
			{
			echo "<script>alert ('Stok Opname Bensin Tidak Dapat Dilakukan, Karena Masih Ada Proses Stok Opname Bensin Yang Belum Selesai')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
				
		if(!empty($_REQUEST[input]))
			{
			$tanggal  = date("Y-m-d", strtotime($_REQUEST[tanggal]));
			$bulan	  = substr($tanggal,5,2);
			$tahun	  = substr($tanggal,1,4);
			
			$dCek = mysql_fetch_array(mysql_query("SELECT tanggal FROM tbl_bensin WHERE id%2=0 AND kode='OPNAME' ORDER BY tanggal DESC LIMIT 1"));
			if($dCek[tanggal] > $tanggal)
				{
				echo "<script>alert ('Mohon Ulangi, Karena Tanggal Stok Opname Bensin Kurang Dari Tanggal Stok Opname Bensin Terakhir')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			
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
			
			$dI = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='INPUT' AND status='0'"));
			$dO = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_bensin WHERE id%2=0 AND jenis='OUTPUT' AND status='0'"));
			$dT = ROUND(($dI[total]-$dO[total]),1);
			
			$selisih = $dT - $input;
			$selisihX   = abs($selisih);
			if($selisih > 0){
				$jenis = "OUTPUT";
				$ket = "STOK DI PROGRAM LEBIH $selisihX LITER";
				}
			else if($selisih < 0){
				$jenis = "INPUT";
				$ket = "STOK DI PROGRAM KURANG $selisihX LITER";
				}
			else if($selisih == 0){
				$jenis = "INPUT";
				$ket = "SUDAH SAMA DENGAN STOK DI PROGRAM";
				}
			$keterangan = "HASIL STOCK OPNAME BENSIN $input LITER, $ket";
								
			$q1 = mysql_query("INSERT INTO tbl_bensin (
													kode,
													jenis,
													tanggal,
													keterangan,
													status,
													opname,
													iduser,
													jumlah) 
												VALUES (
													'OPNAME',
													'$jenis',
													'$tanggal',
													'$keterangan',
													'1',
													'$input',
													'$_SESSION[id]',
													'$selisihX')");
													
							
			$id = mysql_fetch_array(mysql_query("SELECT last_insert_id() AS id"));
			$idbensin	= $id[id];
								
			$q2 = mysql_query("INSERT INTO tbl_abis_dkonfirmasi (
												idbensin, 
												tahun, 
												bulan, 
												tanggal, 
												kasus, 
												tbl, 
												inputx) 
											VALUES (
												'$idbensin', 
												'$tahun', 
												'$bulan', 
												NOW(), 
												'HASIL STOCK OPNAME BENSIN $input LITER : $ket', 
												'tbl_bensin', 
												NOW())
								");
			$q3 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_bensin',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'OPNAME $_REQUEST[jumlah]')
								");
								
			if($q1 && $q2)
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=km'/>";
				exit();
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>GUDANG & PDI <small>STOCK OPNAME BENSIN</small></h4>
				                	<form name="formPindah" onsubmit="return vPindah();" method="post" action="" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                        <table width="100%">
				                        	<tr>
				                        		<td width="20%">TANGGAL STOCK OPNAME</td>
				                        		<td width="2%">:</td>
				                        		<td colspan="2"><input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:14%"></td>
				                        	</tr>
				                        	<tr>
				                        		<td>HASIL STOCK OPNAME BENSIN</td>
				                        		<td>:</td>
				                    			<td colspan="" width="16%">
				                                    <div class="input-group">
				                                        <input type="text" name="jumlah" class="form-control" maxlength="6" value="<?echo $dM[jumlah]?>" style="width:100%;text-align:right" onkeypress="return buat_angka(event,'0123456789.')" required>
				                                    	<span class="input-group-addon" style="text-align:left">Liter</span>
				                                    </div>
						                        </td>
						                        <td></td>
				                        	</tr>
					                    		<tr>
					                    			<td></td>
					                    			<td></td>
													<td colspan="3"><i>Gunakan Tanda Titik "." Jangan Tanda Koma ","</i></td>
												</tr>
				                        </table>
					                </div>
					                
				           			<div class="col-xs-12">
				                        <div class="modal-footer clearfix">
					                    	<input type="hidden" name="input" value="1">
					                    	<button type="submit" class="btn btn-primary pull-left" onclick="return confirm('Anda yakin akan menyimpan data ini?')"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
?>
	
        <script src="js/jquery.min.js"></script>
        
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