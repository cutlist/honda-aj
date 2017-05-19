<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM x23_uangharian WHERE dari='$_REQUEST[del]'");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SDM <small>UANG HARIAN</small></h4>
                                    <div class="col-xs-4">
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
										
										$q1 = mysql_query("SELECT COUNT(nik) AS jk,SUM(totuharian) AS totuharian,dari,sampai FROM x23_uangharian WHERE idkaryawan IN (SELECT id FROM x23_karyawan WHERE posisi!='6') AND substr(dari,6,2)='$periode_bulan' AND substr(dari,1,4)='$periode_tahun' GROUP BY dari ORDER BY id DESC");
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
	                           		<div class="col-xs-8">
										<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Input Baru</button>
										</a>
	                           		</div>
									
									<table id="example2" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="25%">DARI TANGGAL</th>
			                                    <th style="padding:7px" width="25%">SAMPAI TANGGAL</th>
			                                    <th style="padding:7px" width="25%">JUMLAH KARYAWAN (ORANG)</th>
			                                    <th style="padding:7px" width="25%">TOTAL UANG HARIAN (RP)</th>
			                                    <th style="padding:7px" width="1%">DEL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&dari=$d1[dari]"?>'" align="center"><?echo date("d-m-Y",strtotime($d1[dari]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&dari=$d1[dari]"?>'" align="center"><?echo date("d-m-Y",strtotime($d1[sampai]))?></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&dari=$d1[dari]"?>'" align="right"><span style="margin-right:40%"><?echo number_format($d1[jk])?></span></td>
			                                    <td onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=D&dari=$d1[dari]"?>'" align="right"><span style="margin-right:40%"><?echo number_format($d1[totuharian])?></span></td>
			                                    <td align="center">
			                                    	<?
	                                            	if($_SESSION[posisi]=='DIREKSI')
	                                            		{
													?>
				                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[dari]"?>">
					                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
					                                    		<i class="fa fa-trash-o"></i>
					                                    	</button>
				                                    	</a>
				                                    <?
				                                    	}
				                                    ?>
			                                     </td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL TAMBAH INPUT ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-input" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH KARYAWAN BARU</h4>
				                    </div>
									
				                   	<form method="post" action="" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table border="0" width="100%">
				                    		<tr>
				                    			<td width="30%">PERIODE</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/>
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
				
			        </div>
				</section>
			</aside>
<?
		}

	else if($submenu == 'B')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SDM <small>INPUT UANG HARIAN</small></h4>
			                	
					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=C"?>" enctype="multipart/form-data">
			                		<div style="padding:20px 0px 20px 20px;overflow-x:hidden;overflow-y:auto;height:380px;">
				                    	<table border="0" width="50%">
				                    		<tr>
				                    			<td width="30%">PERIODE</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2">
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" required="" placeholder="Pilih Periode"  class="form-control pull-right" id="reservation"/>
		                                            </div>
		                                        </td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
		                            	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="submit" class="btn btn-info pull-left"><i class="fa fa-mail-forward"></i> &nbsp;Lanjutkan</button>
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
		
	else if($submenu == 'C')
		{
        $pecah = explode(" s.d. ", $_REQUEST[periode]);
        
		$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
		$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
		
		$awal  = date("Y-m-d",strtotime($pecah[0]));
		$akhir = date("Y-m-d",strtotime($pecah[1]));

		while (strtotime($awal) <= strtotime($akhir)) 
			{
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM x23_uangharian WHERE dari <= '$awal' AND sampai >= '$awal'"));
			if(!empty($dCek[id])){
				echo "<script>alert ('Mohon Ulangi, Karena Periode Tersebut Sudah Diinput.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B'/>";
				exit();
				}
			
			$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
			}
		
?>			
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SDM <small>INPUT UANG HARIAN</small></h4>	
					            <form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=save"?>" enctype="multipart/form-data">
                                    <div style="float:right;width:34%">
                                    	<table width="100%">
                                    		<tr>
												<td>PERIODE : </td>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation" disabled="" />
		                                            </div>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    
			                        <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
										<thead>
											<tr>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px">POSISI</th>
			                                    <th style="padding:7px">DARI TANGGAL</th>
			                                    <th style="padding:7px">SAMPAI TANGGAL</th>
			                                    <th style="padding:7px">HADIR (HARI)</th>
			                                    <th style="padding:7px">UANG HARIAN (RP)</th>
			                                    <th style="padding:7px">TOTAL (RP)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$q2	 = mysql_query("SELECT * FROM abs_x23_employee WHERE EmployeeID IN (SELECT nik FROM x23_karyawan WHERE posisi!='6' AND status='AKTIF')");
										while($d2  = mysql_fetch_array($q2))
											{
											$dD	   = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_department WHERE DepartmentID='$d2[DepartmentID]'"));
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
			                            	
											while (strtotime($awal) <= strtotime($akhir)) 
												{
												$d3  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_status WHERE EmployeeID='$d2[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
												$d4  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_result_vw WHERE EmployeeID='$d2[EmployeeID]' AND substr(Date,1,10)='$awal'"));
												
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
												}
												
												$hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE substr(Scan4,1,10) BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND EmployeeID='$d2[EmployeeID]' GROUP BY EmployeeID"));
												$gaji 		= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$d2[EmployeeID]'"));
		                           				$tharian	= $gaji[uharian]*$hadir[total];
												echo"
													<tr> 
														<td>$d2[FirstName] $d2[LastName]</td>
														<td>$dD[DepartmentName]</td>
														<td align='center'>".date("d-m-Y",strtotime($_SESSION[periode_awal]))."</td> 
														<td align='center'>".date("d-m-Y",strtotime($_SESSION[periode_akhir]))."</td> 
														<td align='right'><span style='padding-right:35%'>".number_format($hadir[total])."</span></td> 
														<td align='right'><span style='padding-right:20%'>".number_format($gaji[uharian])."</span></td> 
														<td align='right'><span style='padding-right:20%'>".number_format($tharian)."</span></td> 
													</tr>";
											}
										?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="10">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        <div class="modal-footer clearfix">
			                        	<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>"/>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=B"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                		<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
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
		
	else if($submenu == 'save')
		{
		$pecah = explode(" s.d. ", $_REQUEST[periode]);
		
		$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
		$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
        
		$q2	 = mysql_query("SELECT * FROM abs_x23_employee WHERE EmployeeID IN (SELECT nik FROM x23_karyawan WHERE posisi!='6' AND status='AKTIF')");
		while($d2  = mysql_fetch_array($q2))
			{
			$dD	   = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_department WHERE DepartmentID='$d2[DepartmentID]'"));
			$awal  = date("Y-m-d",strtotime($pecah[0]));
			$akhir = date("Y-m-d",strtotime($pecah[1]));
        	
			while (strtotime($awal) <= strtotime($akhir)) 
				{
				$d3  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_status WHERE EmployeeID='$d2[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
				$d4  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_result_vw WHERE EmployeeID='$d2[EmployeeID]' AND substr(Date,1,10)='$awal'"));
				
				$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
				}
				
				$hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE substr(Date,1,10) BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND EmployeeID='$d2[EmployeeID]' GROUP BY EmployeeID"));
				$gaji 		= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan WHERE nik='$d2[EmployeeID]'"));
   				$tharian	= $gaji[uharian]*$hadir[total];
   				
   				mysql_query("INSERT INTO x23_uangharian (
   													nik, 
   													idkaryawan, 
   													nama, 
   													dari, 
   													sampai, 
   													hadir, 
   													uharian, 
   													totuharian, 
   													inputx) 
   												VALUES (
   													'$d2[EmployeeID]', 
   													'$gaji[id]', 
   													'$d2[FirstName] $d2[LastName]', 
   													'$_SESSION[periode_awal]', 
   													'$_SESSION[periode_akhir]', 
   													'$hadir[total]', 
   													'$gaji[uharian]', 
   													'$tharian', 
   													NOW())
   							");
			}
			
		//echo "<script>alert ('Proses berhasil.')</script>";
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		
		}
		
	else if($submenu == 'D')
		{
		if(!empty($_REQUEST[bayar]))
			{
			$tglbayar   = date("Y-m-d", strtotime($_REQUEST['tglbayar']));
			$bayar  	= preg_replace( "/[^0-9]/", "",$_REQUEST['bayar']);
			$q1 = mysql_query("UPDATE x23_uangharian SET status='1',tglbayar='$tglbayar',updatex='$updatex' WHERE id='$_REQUEST[update]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_uangharian',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR UANG HARIAN $bayar $_REQUEST[bayar]')
								");
			mysql_query("UPDATE x23_potkompensasi SET status='1' WHERE idkaryawan='$_REQUEST[idkaryawan]' AND status='0' AND metodebayar='UANG HARIAN'");
			mysql_query("UPDATE x23_piutang SET status='1' WHERE idkaryawan='$_REQUEST[idkaryawan]' AND status='0' AND metodebayar='UANG HARIAN'");
			}
		if(!empty($_REQUEST[batal]))
			{
			$q1 = mysql_query("UPDATE x23_uangharian SET status='0',tglbayar='',updatex='$updatex' WHERE id='$_REQUEST[batal]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_uangharian',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BATAL BAYAR UANG HARIAN $_REQUEST[batal]')
								");
			}
?>			
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SDM <small>INPUT UANG HARIAN</small></h4>	
			                        <table id="example1" class="table table-striped table-hover" style="width:100%;padding-right:20px">
										<thead>
											<tr>
			                                    <th style="padding:7px">NAMA KARYAWAN</th>
			                                    <th style="padding:7px">POSISI</th>
			                                    <th style="padding:7px">DARI TANGGAL</th>
			                                    <th style="padding:7px">SAMPAI TANGGAL</th>
			                                    <th style="padding:7px" width="50px">HADIR</br>(HARI)</th>
			                                    <th style="padding:7px" width="100px">UANG HARIAN</br>(RP)</th>
			                                    <th style="padding:7px" width="100px">TOTAL</br>(RP)</th>
			                                    <th style="padding:7px">STATUS BAYAR</th>
			                                    <th style="padding:7px;width:1%">BATAL</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
										$q2	 = mysql_query("SELECT * FROM x23_uangharian WHERE dari='$_REQUEST[dari]'");
										while($d2 = mysql_fetch_array($q2))
											{
											$dD	= mysql_fetch_array(mysql_query("SELECT * FROM x23_karyawan_vw WHERE nik='$d2[nik]'"));
											if($d2[totuharian]!='0'){
				                            	if($d2[status]=='0'){
							                        $status = "<a data-toggle='modal' data-target='#compose-modal-sts$d2[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Dibayar</span></a>";
													}
												else{
							                        $status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'>Sudah Dibayar</span>";
													}
												}
											else{
												$status = "";
												}
											if(empty($d2[hadir])){
												$hadir = "0";
												}
											else{
												$hadir = $d2[hadir];
												}
											echo"
												<tr style='cursor:pointer'> 
													<td>$d2[nama]</td>
													<td>$dD[posisi]</td>
													<td align='center'>".date("d-m-Y",strtotime($d2[dari]))."</td> 
													<td align='center'>".date("d-m-Y",strtotime($d2[sampai]))."</td> 
													<td align='right'><span style='padding-right:35%'>".number_format($hadir)."</span></td> 
													<td align='right'><span style='padding-right:20%'>".number_format($d2[uharian],"0","",".")."</span></td> 
													<td align='right'><span style='padding-right:20%'>".number_format($d2[totuharian],"0","",".")."</span></td> 
													<td align='center'>$status</td>
												    <td align='center'>";
												if($d2[status]=='1')
													{
										?>			   
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&batal=$d2[id]&dari=$_REQUEST[dari]"?>">
				                                    	<button type="button" class="btn btn-warning" onclick="return confirm('Batal Bayar?')" style="padding:0 5px 0 5px;">
				                                    		<i class="fa fa-times-circle"></i>
				                                    	</button>
			                                    	</a>
										<?
													}
											echo"
				                                     </td>
												</tr>";
											}
										?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="10">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        <div class="modal-footer clearfix">
			                        	<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>"/>
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=A"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
				                	</div>
			                	</div>
						        <?  
								$q1 = mysql_query("SELECT * FROM x23_uangharian WHERE dari='$_REQUEST[dari]'");
								while($d1 = mysql_fetch_array($q1))
	                            	{
						        ?>
							<!-- ################## MODAL ########################################################################################## -->
							        <div class="modal fade " id="compose-modal-sts<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
							            <div class="modal-dialog" style="width:30%;">
							                <div class="modal-content">
							                    <div class="modal-header">
							                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                        <h4 class="modal-title">BAYAR UANG HARIAN</h4>
							                    </div>
												
							                   	<form method="post" action="" enctype="multipart/form-data">
						                        <div class="modal-body">
							                    	<table width="100%">
							                    		<tr>
							                    			<td width="40%">TANGGAL BAYAR</td>
							                    			<td width="2%">:</td>
							                    			<td><div class="input-group">
							                                        <span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
							                                        	<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:60%">
							                                    </div>                                        		
							                                </td>
							                    		</tr>
							                    		<tr>
							                    			<td>JUMLAH BAYAR</td>
							                    			<td>:</td>
							                    			<td><div class="input-group">
							                                        <span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
							                                        	<input type="text" name="bayar" value="<?echo number_format($d1[totuharian],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
							                                    </div>                                        		
							                                </td>
							                    		</tr>
							                    		<input type="hidden" name="update" value="<?echo $d1[id]?>">
							                    		<input type="hidden" name="idkaryawan" value="<?echo $d1[idkaryawan]?>">
					                            	</table>
							               		</div>
						                        <div class="modal-footer clearfix">
						                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
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
			            </div>
			        </div>
				</section>
			</aside>
<?
		}
?>
	
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		
        <script>
        //SELECT2
			$(function(){
			  var select = $('#select1').select2();
			}); 
			$(document).ready(function() {});
		</script>
		
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
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