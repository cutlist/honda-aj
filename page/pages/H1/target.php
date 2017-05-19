<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			if(!empty($_REQUEST[input]))
				{		
				$target 	= preg_replace( "/[^0-9]/", "",$_REQUEST['target']);
				$dCek = mysql_fetch_array(mysql_query("SELECT target FROM tbl_target WHERE bulan='$_REQUEST[bulan]' AND tahun='$_REQUEST[tahun]'"));
				if(!empty($dCek[target]))
					{
					echo "<script>alert ('Target sudah diinput.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
				else
					{
					$q1 = mysql_query("INSERT INTO tbl_target (
														tahun, 
														bulan, 
														target) 
													VALUES (
														'$_REQUEST[tahun]', 
														'$_REQUEST[bulan]', 
														'$target');
										");
							
					if($q1)
						{
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
					}
				}

			if(!empty($_REQUEST[del]))
				{
				$q1 = mysql_query("DELETE FROM tbl_target WHERE id='$_REQUEST[del]'");
				
				if($q1)
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
				$nama 		= strtoupper(addslashes($_REQUEST['nama']));
				$posisi		= strtoupper($_REQUEST['posisi']);
				$tmplahir 	= strtoupper(addslashes($_REQUEST['tmplahir']));
				$tgllahir 	= date("Y-m-d", strtotime($_REQUEST['tgllahir']));
				$noktp 		= $_REQUEST['noktp'];
				$notelepon 	= $_REQUEST['notelepon'];
				$alamat 	= strtoupper(addslashes($_REQUEST['alamat']));
				$tglmulaikerja 	= date("Y-m-d", strtotime($_REQUEST['tglmulaikerja']));
				$ugapok 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ugapok']);
				$uharian 	= preg_replace( "/[^0-9]/", "",$_REQUEST['uharian']);
				$ukomisi 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ukomisi']);
				$ulembur 	= preg_replace( "/[^0-9]/", "",$_REQUEST['ulembur']);
							
				$q1 = mysql_query("UPDATE tbl_karyawan SET
													nama='$nama',
													posisi='$posisi', 
													tmplahir='$tmplahir',
													tgllahir='$tgllahir',
													noktp='$noktp', 
													notelepon='$notelepon',
													alamat='$alamat', 
													tglmulaikerja='$tglmulaikerja', 
													ugapok='$ugapok', 
													uharian='$uharian', 
													ukomisi='$ukomisi', 
													ulembur='$ulembur',
													pic_user='$_SESSION[user]'
											WHERE id='$_REQUEST[ubah]'
									");
				$q2 = mysql_query("INSERT INTO log_act VALUES (										
			                                    '',
			                                    'tbl_karyawan',
			                                    CURDATE(),
			                                    CURTIME(),
			                                    '$_SESSION[user]',
			                                    'UBAH KARYAWAN $nama')
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
			            
			            <div class="col-xs-6">		
                            <div class="small-box bg-aqua" style="text-align:center;height:200px;border-radius:5px;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;cursor: pointer;">
                                <div class="inner" style="height:160px;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-10px;font-weight:bold">PERIODE SAAT INI</h4>
			                		<?
			                		$bulan = date("m");
			                		$tahun = date("Y");
			                		$dPeriode = mysql_fetch_array(mysql_query("SELECT namabln FROM tbl_bulan WHERE angkabln='$bulan'"));
			                		?>
	                                	<div class="bg-aqua">
	                                    	<h3 style="text-align: center;margin-top:40px"><?echo "$dPeriode[namabln] $tahun"?></h3>
	                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
			            </div>
			            
			            <div class="col-xs-3">		
                            <div class="small-box bg-orange" style="text-align:center;height:200px;border-radius:5px;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;cursor: pointer;">
                                <div class="inner" style="height:160px;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-10px;font-weight:bold">TARGET</h4>
			                		<?
			                		$dTarget = mysql_fetch_array(mysql_query("SELECT target FROM tbl_target WHERE bulan='$bulan' AND tahun='$tahun'"));
			                		?>
	                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;margin-top:20px">
		                                	<div class="bg-orange" style="width:60px;height:60px;border-radius:60px;padding:10px;">
		                                    	<h4><b><?echo $dTarget[target]?></b></h4>
		                                    </div>
	                                    </div>
                                </div>
                            </div>
			            </div>
			            
			            <div class="col-xs-3">		
                            <div class="small-box bg-green" style="text-align:center;height:200px;border-radius:5px;margin-top:0px;padding:20px 0 0 0;border-bottom: 5px solid #fff;cursor: pointer;">
                                <div class="inner" style="height:160px;">
			                		<h4 style="border-bottom:1px dashed #ddd;padding-bottom:5px;width:96;margin-top:-10px;font-weight:bold">REALISASI</h4>
			                		<?
			                		$dReal = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE bulan='$bulan' AND tahun='$tahun'"));
			                		?>
	                                	<div style="width:80px;height:80px;border-radius:80px;background:#fff;margin:0 auto;padding:10px;margin-top:20px">
		                                	<div class="bg-green" style="width:60px;height:60px;border-radius:60px;padding:10px;">
		                                    	<h4><b><?echo $dReal[total]?></b></h4>
		                                    </div>
	                                    </div>
                                </div>
                            </div>
			            </div>
			            <div class="clearfix"></div>
			            
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:320px;">
			                	<h4>MASTER <small>TARGET</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-targetbaru" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Target Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="18%" style="padding:7px"><center>PERIODE TAHUN</center></th>
			                                    <th width="18%" style="padding:7px"><center>PERIODE BULAN</center></th>
			                                    <th width="" style="padding:7px"><center>TARGET</center></th>
			                                    <th width="" style="padding:7px"><center>REALISASI</center></th>
			                                    <th width="" style="padding:7px"><center>PERSENTASE %</center></th>
			                                    <th width="5%" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM tbl_target ORDER BY tahun,bulan DESC");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                				$dBln  = mysql_fetch_array(mysql_query("SELECT namabln FROM tbl_bulan WHERE angkabln='$d1[bulan]'"));
			                				$dReal = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS total FROM tbl_notajual_qty WHERE bulan='$d1[bulan]' AND tahun='$d1[tahun]'"));
			                				$per   = round(($dReal[total]/$d1[target])*100,2);
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo $d1[tahun]?></td>
			                                    <td align="center"><?echo $d1[bulan]?></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $d1[target]?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $dReal[total]?></span></td>
			                                    <td align="right"><span style="padding-right:40%"><?echo $per?></span></td>
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
																-->
																<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
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
					
<!-- ################## MODAL TAMBAH TARGET ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-targetbaru" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:350px;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH TARGET BARU</h4>
				                    </div>
				                    
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table>
				                    		<tr>
				                    			<td width="30%">TAHUN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="tahun" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_tahun ORDER BY tahun');
														while ($data = mysql_fetch_array($q)){
														?>
														<option value="<?echo $data['tahun'];?>" <?if($tahun == $data['tahun']){?>selected='selected'<?}?>><? echo $data['tahun'];?></option>
														<?php
															}
														?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>BULAN <?//echo $bulan;?></td>
				                    			<td>:</td>
				                    			<td colspan="2"><select name="bulan" class="form-control" style="height:35px">
														<option value='' >- PILIH -</option>
														<?php
														$q = mysql_query('SELECT * FROM tbl_bulan ORDER BY id');
														while ($data = mysql_fetch_array($q)){
															if($bulan+1==13)
																{
																?>
																<option value="<?echo $data['angkabln'];?>" <?if("01" == $data['id']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>
																<?
																}
															else
																{
																?>
																<option value="<?echo $data['angkabln'];?>" <?if($bulan+1 == $data['id']){?>selected='selected'<?}?>><? echo $data['namabln'];?></option>
																<?
																}
															}
														?>
													</select></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TARGET</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="target" id="uang" class="form-control" placeholder="0" style="width:40%;text-align:right" maxlength="4" onfocus="this.select();" onkeypress="return buat_angka(event,'0123456789')" required></td>
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
        </script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>