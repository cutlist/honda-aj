<?
	if($mod == "save")
		{
		if(!empty($_REQUEST[input]))
			{
			$tahun = date("Y");
			
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			$awal  = date("Y-m-d",strtotime($pecah[0]));
			$akhir = date("Y-m-d",strtotime($pecah[1]));
			$keterangan	= strtoupper($_REQUEST['keterangan']);
			$status	= strtoupper($_REQUEST['status']);
		 
		 	$qCek1 = mysql_query("SELECT * FROM abs_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND substr(awal,1,4)='$tahun'");
		 	while($dCek1 = mysql_fetch_array($qCek1)){
				$f1 = date("Y-m-d", strtotime("-1 day", strtotime("$dCek1[awal]")));
				$t1 = $dCek1[akhir];
				while (strtotime($f1)<strtotime($t1)){
					$f1 = mktime(0,0,0,date("m",strtotime($f1)),date("d",strtotime($f1))+1,date("Y",strtotime($f1)));
					$f1 = date("Y-m-d", $f1);
					
					$f2 = date("Y-m-d", strtotime("-1 day", strtotime("$awal")));
					$t2 = $akhir;
					
					while (strtotime($f2)<strtotime($akhir)){
						$f2 = mktime(0,0,0,date("m",strtotime($f2)),date("d",strtotime($f2))+1,date("Y",strtotime($f2)));
						$f2=date("Y-m-d", $f2);
					
							//echo "<script>alert ('$f2.$dCek1[awal]')</script>";
							//exit();
						
						//$dCek = mysql_fetch_array(mysql_query("SELECT id FROM abs_x23_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND awal <= '$f2' AND akhir <= '$akhir'"));
						//if(!empty($dCek[id]))
						if($f1 == $f2){
							echo "<script>alert ('Karyawan Tersebut Telah Tercatat Melakukan Dispensasi Pada Periode Ini.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&input='/>";
							exit();
							}
						}
					}
				}
			
			/*
			$dCek = mysql_fetch_array(mysql_query("SELECT id FROM abs_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND awal <= '$awal' AND akhir >= '$akhir'"));
			if(!empty($dCek[id]))
				{
				echo "<script>alert ('Karyawan Tersebut Telah Tercatat Melakukan Dispensasi Pada Periode Ini.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
				exit();
				}
			*/
			
			$q1 = mysql_query("INSERT INTO abs_status (
												EmployeeID,
												awal,
												akhir,
												status,
												keterangan
												) 
											VALUES (
												'$_REQUEST[EmployeeID]',
												'$awal',
												'$akhir',
												'$status',
												'$keterangan')
								");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
	                                    '',
	                                    'abs_status',
	                                    CURDATE(),
	                                    CURTIME(),
	                                    '$_SESSION[user]',
	                                    'TAMBAH DISPENSASI $_REQUEST[EmployeeID] $status')
							");
					
					
			if($q1 && $q2)
				{
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&input='/>";
				exit();
				}
			else
				{
				echo "<script>alert ('Proses gagal.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&input='/>";
				exit();
				}
			}
		}
	if(empty($mod))
		{
		if(!empty($_REQUEST[del]))
			{
			$q1 = mysql_query("DELETE FROM abs_status WHERE id='$_REQUEST[del]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'abs_status',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'HAPUS DISPENSASI $_REQUEST[EmployeeID] $_REQUEST[status]')
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
			$gudang	= strtoupper($_REQUEST['gudang']);
						
			$q1 = mysql_query("UPDATE tbl_gudang SET
												gudang='$gudang'
										WHERE id='$_REQUEST[ubah]'
								");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_gudang',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'UBAH GUDANG $gudang')
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
		                	<h4>ABSENSI <small>DISPENSASI</small></h4>
                                    <div style="float:right;width:55%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="40%">
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Mulai" class="form-control pull-right reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%">
													<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												</td>
				                           		<td width="1%">
													<a data-toggle="modal" data-target="#compose-modal-baru" style="cursor:pointer">
				                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Buat Dispensasi</button>
													</a>
				                           		</td>
										<?
										if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
											{
										?>
				                           		<td width="1%">
											<button type="button"  onclick="window.open('print/h1/abs_dispensasi.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			
				                           		</td>
										<?
	                           				}
	                           			?>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
		                        <table id="example1" class="table table-bordered table-striped">
		                            <thead style="color:#666;font-size:13px">
		                                <tr>
		                                    <th style="padding:7px">NAMA KARYAWAN</th>
		                                    <th style="padding:7px">POSISI</th>
		                                    <th style="padding:7px">JENIS DISPENSASI</th>
		                                    <th style="padding:7px">TANGGAL MULAI</th>
		                                    <th style="padding:7px">TANGGAL SELESAI</th>
		                                    <th style="padding:7px">KETERANGAN</th>
		                                    <th width="5%" style="padding:7px">AKSI</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            <?
									$no=1;
			
									if(!empty($_REQUEST[periode]))
										{
							            $pecah = explode(" s.d. ", $_REQUEST[periode]);
							            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
							            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
							            
										$q1 = mysql_query("SELECT * FROM abs_status_vw WHERE awal BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
							            }
							        else{
										$q1 = mysql_query("SELECT * FROM abs_status_vw LIMIT 0,20");
										}
		                            while($d1 = mysql_fetch_array($q1))
		                            	{
		                            ?>
		                                <tr style="cursor:pointer">
		                                    <td><?echo "$d1[FirstName] $d1[LastName]"?></td>
		                                    <td><?echo $d1[DepartmentName]?></td>
		                                    <td><?echo $d1[status]?></td>
		                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[awal]))?></td>
		                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[akhir]))?></td>
		                                    <td><?echo $d1[keterangan]?></td>
		                                    <td width="1%" align="center"><div class="btn-group">
		                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
		                                                <span class="caret"></span>
		                                                <span class="sr-only">Actions</span>
		                                            </button>
		                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
		                                            	<!--
		                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
		                                                -->
		                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]&EmployeeID=$d1[EmployeeID]&status=$d1[status]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
		                                            </ul>
		                                        </div>
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
				
<!-- ################## MODAL TAMBAH DISPENSASI ########################################################################################## -->
			        <div class="modal fade " id="compose-modal-baru" tabindex="-1" role="dialog" aria-hidden="true">
			            <div class="modal-dialog" style="width:50%;">
			                <div class="modal-content">
			                    <div class="modal-header">
			                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                        <h4 class="modal-title">BUAT DISPENSASI</h4>
			                    </div>
								
			                   	<form method="post" action="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=save"?>" enctype="multipart/form-data">
		                        <div class="modal-body">
			                    	<table width="100%">
			                    		<tr>
			                    			<td width="30%">NAMA KARYAWAN</td>
			                    			<td width="2%">:</td>
			                    			<td><select name="EmployeeID" class="form-control" id="select1" required="">
	                    							<option value=''>PILIH KARYAWAN</option>
															<?
																$q1 = mysql_query("SELECT * FROM abs_employee_vw GROUP BY EmployeeID  ORDER BY FirstName");
																while($dA=mysql_fetch_array($q1))
																	{
															?>
																		<option value="<?echo $dA[EmployeeID]?>" ><?echo "$dA[FirstName] $dA[LastName] | $dA[DepartmentName]"?></option>
															<?
																	}
															?>
												    </select></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="">JENIS DISPENSASI</td>
			                    			<td width="">:</td>
			                    			<td><select name="status" style="width:50%" class="form-control" required="">
	                    							<option value='' selected="">PILIH</option>
	                    							<option value='IZIN'>IZIN</option>
	                    							<option value='SAKIT'>SAKIT</option>
	                    							<!--
	                    							<option value='CUTI'>CUTI</option>
	                    							<option value='TERLAMBAT MASUK'>TERLAMBAT MASUK</option>
	                    							<option value='PULANG AWAL'>PULANG AWAL</option>
	                    							-->
												    </select></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="">TANGGAL DISPENSASI</td>
			                    			<td width="">:</td>
			                    			<td><div class="input-group">
		                                            <div class="input-group-addon">
		                                                <i class="fa fa-calendar"></i>
		                                            </div>
	                                            	<input type="text" name="periode" style="height:33px;" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right reservation" required/>
	                                            </div></td>
			                    		</tr>
			                    		<tr>
			                    			<td width="">KETERANGAN</td>
			                    			<td width="">:</td>
			                    			<td><input type="text" name="keterangan" class="form-control" maxlength="20" required></td>
			                    		</tr>
				                    	<input type="hidden" name="input" value="1">
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
					
				else if($mod == "edit")
					{
					$d1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_gudang WHERE id='$_REQUEST[id]'"));
?>
		            <div class="col-xs-12">
		                <div class="box box-danger">
		                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
		                	<h4>MASTER <small>GUDANG &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Gudang</small></h4>
			                	<form method="post" action="" enctype="multipart/form-data">
			                	<div style="padding:20px">
			                    	<table style="width:50%;">
			                    		<tr>
			                    			<td width="30%">GUDANG</td>
			                    			<td width="2%">:</td>
			                    			<td><input type="text" name="gudang" value="<?echo $d1[gudang]?>" class="form-control" maxlength="40" onkeypress="return buat_angka(event,' qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')" required=""></td>
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
?>
		        </div>
			</section>
		</aside>
	
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script>
        //SELECT2
			$(function(){
			           
			  /* dropdown and filter select */
			  var select = $('#select1').select2();
			  
			  /* Select2 plugin as tagpicker */
			  $("#tagPicker").select2({
			    closeOnSelect:false
			  });

			}); //script         
			      

			$(document).ready(function() {});
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
                $('.reservation').daterangepicker();

        </script>