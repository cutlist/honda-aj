<?
	if($submenu == 'saveA')
		{
        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
        $bulan	  = substr($tanggal,5,2);
        $tahun	  = substr($tanggal,1,4);
        
        $dCek = mysql_fetch_array(mysql_query("SELECT id FROM tbl_lembur WHERE id%2=0 AND idkaryawan='$_REQUEST[idkaryawan]' AND tanggal='$tanggal'"));
        if(!empty($dCek[id]))
        	{
			echo "<script>alert ('Karyawan Yang Sama Telah Melakukan Lembur Pada Tanggal Yang Sama.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
			
		$dK    = mysql_fetch_array(mysql_query("SELECT nik FROM tbl_karyawan WHERE id%2=0 AND id='$_REQUEST[idkaryawan]'"));
		$dCek2 = mysql_fetch_array(mysql_query("SELECT id FROM abs_status WHERE id%2=0 AND EmployeeID='$dK[nik]' AND  awal <= '$tanggal' AND akhir >= '$tanggal'"));
		if(!empty($dCek2[id]))
			{
			echo "<script>alert ('Karyawan Tersebut Telah Tercatat Melakukan Dispensasi Pada Periode Ini.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
   				
   		$q1 = mysql_query("INSERT INTO tbl_lembur (
   													idkaryawan, 
   													tahun, 
   													bulan, 
   													tanggal, 
   													updatex) 
   												VALUES (
   													'$_REQUEST[idkaryawan]',
   													'$tahun',
   													'$bulan',
   													'$tanggal',
   													'$updatex')
   							");
			
		//echo "<script>alert ('Proses berhasil.')</script>";
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		}
		
	else if($submenu == 'A')
		{
		if(!empty($_REQUEST[input]))
			{
	        $tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
	        $bulan	  = substr($tanggal,5,2);
	        $tahun	  = substr($tanggal,1,4);
	   				
	   		$q1 = mysql_query("INSERT INTO tbl_lembur (
	   													idkaryawan, 
	   													tahun, 
	   													bulan, 
	   													tanggal, 
	   													updatex) 
	   												VALUES (
	   													'$_REQUEST[idkaryawan]',
	   													'$tahun',
	   													'$bulan',
	   													'$tanggal',
	   													'$updatex')
	   							");
				
			//echo "<script>alert ('Proses berhasil.')</script>";
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
			exit();
			}
		if(!empty($_REQUEST[del]))
			{
			mysql_query("DELETE FROM tbl_lembur WHERE id%2=0 AND id='$_REQUEST[del]'");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SDM <small>DAFTAR LEMBUR</small></h4>
                                    <div style="float:right" class="col-xs-6">
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
										
										$q1 = mysql_query("SELECT * FROM tbl_lembur_vw WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun'");
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
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%">
													<a data-toggle="modal" data-target="#compose-modal-baru" style="cursor:pointer">
				                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Input Baru</button>
													</a>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
									<table id="example3" class="table table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px" width="">NAMA KARYAWAN</th>
			                                    <th style="padding:7px" width="25%">POSISI</th>
			                                    <th style="padding:7px" width="15%">TANGGAL LEMBUR</th>
			                                    <th style="padding:7px" width="20%">UANG LEMBUR (RP)</th>
			                                    <th style="padding:7px" width="1%">DEL</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align=""><?echo $d1[nama]?></td>
			                                    <td align=""><?echo $d1[posisi]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="right"><span style="margin-right:30%"><?echo number_format($d1[ulembur])?></span></td>
			                                    <td align="center">
			                            <?
	                                    	if($_SESSION[posisi]=='DIREKSI')
	                                    		{		
												$d2	= mysql_fetch_array(mysql_query("SELECT id FROM tbl_uanglembur WHERE id%2=0 AND idkaryawan='$d1[idkaryawan]' AND tanggal='$d1[tanggal]'"));
				                            	if(empty($d2[id]))
				                            		{
			                           	?>
			                                    	<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>">
				                                    	<button type="button" class="btn btn-info" onclick="return confirm('Anda yakin akan menghapus data?')" style="padding:0 5px 0 5px;">
				                                    		<i class="fa fa-trash-o"></i>
				                                    	</button>
			                                    	</a>
			                            <?
			                            			}
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
				        <div class="modal fade " id="compose-modal-baru" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">TAMBAH LEMBUR</h4>
				                    </div>
									
				                   	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=saveA"?>" enctype="multipart/form-data">
			                        <div class="modal-body">
				                    	<table border="0" width="100%">
				                    		<tr>
				                    			<td width="30%">NAMA KARYAWAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><select name="idkaryawan" class="form-control" id="select1" style="font-size:12px;padding:3px" required>
				                    									<option value=''>PILIH NAMA KARYAWAN</option>
																		<?
																			$q1 = mysql_query("SELECT id,nama FROM tbl_karyawan WHERE id%2=0 AND posisi NOT IN ('1','6') ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>'><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select>
		                                        </td>
				                    		</tr>
				                    		<tr>
				                    			<td>TANGGAL LEMBUR</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="tanggal" class="form-control" style="width:30%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required></td>
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
		if($_REQUEST[mod] == "save")
			{
			if($_REQUEST[bayar]=="1")
				{
				$tglbayar  = date("Y-m-d",strtotime($_REQUEST[tglbayar]));
				if($tglbayar < $_REQUEST[tanggal])
					{
					echo "<script>alert ('Tanggal Bayar Tidak Boleh Lebih Kecil Dari Tanggal Lembur.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&mod='/>";
					exit();
					}
						
				$q1 = mysql_query("INSERT INTO tbl_uanglembur (
															idkaryawan, 
															nama, 
															posisi,
															tahun, 
															bulan, 
															tanggal, 
															ulembur, 
															tglbayar, 
															updatex) 
														VALUES (
															'$_REQUEST[idkaryawan]',
															'$_REQUEST[nama]',
															'$_REQUEST[posisi]',
															'$_REQUEST[tahun]',
															'$_REQUEST[bulan]',
															'$_REQUEST[tanggal]',
															'$_REQUEST[ulembur]',
															'$tglbayar',
															'$updatex')
									");
					
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=B&input=0'/>";
				exit();
				}
			}
		if(empty($_REQUEST[mod]))
			{
			if(!empty($_REQUEST[batal]))
				{
				mysql_query("DELETE FROM tbl_uanglembur WHERE id%2=0 AND id='$_REQUEST[batal]'");
				}
?>
				<aside class="right-side">
					<section class="content">
						<div class="row">
							<div class="col-xs-12">	     
								<div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
									<div class="box-body table-responsive" style="width:100%;margin:0 auto;">
									<h4>SDM <small>PEMBAYARAN UANG LEMBUR</small></h4>
                                    	<div style="float:right" class="col-xs-6">
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
											
											$q1 = mysql_query("SELECT * FROM tbl_lembur_vw WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idkaryawan IN (SELECT id FROM tbl_karyawan WHERE id%2=0 AND status='AKTIF')");
											$q2 = mysql_query("SELECT * FROM tbl_lembur_vw WHERE id%2=0 AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND idkaryawan IN (SELECT id FROM tbl_karyawan WHERE id%2=0 AND status='AKTIF')");
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
												<?
												if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
													{
												?>
						                           		<td width="1%">
													<button type="button"  onclick="window.open('printaj/h1/pembayaranlembur.php?bulan=<?echo $_REQUEST[bulan]?>&tahun=<?echo $_REQUEST[tahun]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
			                           			
						                           		</td>
												<?
			                           				}
			                           			?>
												</tr>
											</table>
											</form>
										</div>
										
										<table id="example3" class="table table-striped">
											<thead style="color:#666;font-size:13px">
												<tr>
													<th style="padding:7px" width="">NAMA KARYAWAN</th>
													<th style="padding:7px" width="25%">POSISI</th>
													<th style="padding:7px" width="15%">TANGGAL LEMBUR</th>
													<th style="padding:7px" width="20%">UANG LEMBUR (RP)</th>
													<th style="padding:7px">STATUS</th>
													<th style="padding:7px;width:1%">BATAL</th>
												</tr>
											</thead>
											<tbody>
											<?
											while($d1 = mysql_fetch_array($q1))
												{
												$d2	= mysql_fetch_array(mysql_query("SELECT id FROM tbl_uanglembur WHERE id%2=0 AND idkaryawan='$d1[idkaryawan]' AND tanggal='$d1[tanggal]'"));
												if($d1[ulembur]!='0'){
													if(empty($d2[id])){
														$status = "<a data-toggle='modal' data-target='#compose-modal-sts$d1[id]'><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:120px'>Belum Dibayar</span></a>";
														}
													else{
														$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:120px'> Dibayar</span>";
														}
													}
												else{
													$status = "";
													}
											?>
												<tr style="cursor:pointer">
													<td align=""><?echo $d1[nama]?></td>
													<td align=""><?echo $d1[posisi]?></td>
													<td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
													<td align="right"><span style="margin-right:30%"><?echo number_format($d1[ulembur])?></span></td>
													<td align="center"><?echo $status?></td>
													<td align="center">
											<?
												if($_SESSION[posisi]=='DIREKSI')
													{
													if(!empty($d2[id]))
														{
											?>			   
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&batal=$d2[id]"?>">
															<button type="button" class="btn btn-warning" onclick="return confirm('Batal Bayar?')" style="padding:0 5px 0 5px;">
																<i class="fa fa-times-circle"></i>
															</button>
														</a>
											<?
														}
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
									<?  
									while($dA = mysql_fetch_array($q2))
										{
										//$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_lembur_vw WHERE id%2=0 AND id='$d2[id]'"));
									?>
								<!-- ################## MODAL ########################################################################################## -->
										<div class="modal fade " id="compose-modal-sts<?echo $dA[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog" style="width:30%;">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">BAYAR UANG LEMBUR</h4>
													</div>
													
													<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=save"?>" enctype="multipart/form-data">
													<div class="modal-body">
														<table width="100%">
															<tr>
																<td width="40%">TANGGAL BAYAR</td>
																<td width="2%">:</td>
																<td><div class="input-group">
																		<span class="input-group-addon" style="min-width:45px;text-align:center;"><i class="fa fa-calendar"></i> &nbsp;</span>
																			<input type="text" name="tglbayar" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%" readonly="">
																	</div>                                        		
																</td>
															</tr>
															<tr>
																<td>JUMLAH BAYAR</td>
																<td>:</td>
																<td><div class="input-group">
																		<span class="input-group-addon" style="min-width:45px;text-align:center;">RP.</span>
																			<input type="text" value="<?echo number_format($dA[ulembur],"0","",".")?>" style="width:80%;text-align:right" class="form-control uang" onkeypress="return buat_angka(event,'1234567890')"  readonly> 
																	</div>                                        		
																</td>
															</tr>
															<input type="hidden" name="bayar" value="1">
															<input type="hidden" name="idkaryawan" value="<?echo $dA[idkaryawan]?>">
															<input type="hidden" name="nama" value="<?echo $dA[nama]?>">
															<input type="hidden" name="posisi" value="<?echo $dA[posisi]?>">
															<input type="hidden" name="ulembur" value="<?echo $dA[ulembur]?>">
															<input type="hidden" name="tanggal" value="<?echo $dA[tanggal]?>">
															<input type="hidden" name="tahun" value="<?echo $periode_tahun?>">
															<input type="hidden" name="bulan" value="<?echo $periode_bulan?>">
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
                    "bFilter": true,
                    "bSort": true,
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