<?
	include "include/fungsi_indotgl1.php";
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/abs_rekaph23.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ABSENSI <small>REKAPITULASI</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:45%">
                                    	<table width="100%">
                                    		<tr>
                                    		<!--
                                    			<td align="right">
													<a href="printaj/kas1.php" target="_blank" style="cursor:pointer">
				                           				<button type="button" class="btn btn-info"><i class="fa fa-print"></i> &nbsp; Cetak</button>
													</a>
												</td>
											-->
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Absensi" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    			<td width="1%">
                                    				<a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
										
	                            <?
	                            if(!empty($_REQUEST[periode]))
	                            	{
									mysql_query("TRUNCATE temp_abs_x23_status");
									mysql_query("TRUNCATE temp_abs_x23_terlambat");
									mysql_query("TRUNCATE temp_abs_x23_overbreak");
									mysql_query("TRUNCATE temp_abs_x23_overtime");
	                            ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
										<thead>
											<tr>
												<th><center>NAMA KARYAWAN</center></th>
												<th><center>POSISI</center></th>
												<th width="9%"><center>TOTAL HARI KERJA</center></th> 
												<th width="9%"><center>JUMLAH KEHADIRAN</center></th> 
												<th width="9%"><center>JUMLAH TERLAMBAT</center></th> 
												<th width="9%"><center>DURASI TERLAMBAT</center></th> 
												<th width="7%"><center>JUMLAH IZIN</center></th> 
												<th width="7%"><center>JUMLAH SAKIT</center></th>
												<th width="9%"><center>TANPA KETERANGAN</center></th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
			                            //echo  $awal.$akhir;
			                            
										if($_SESSION[posisi]=='DIREKSI'){
											$q2	 = mysql_query("SELECT * FROM abs_x23_employee");
											}
										else{
											$q2	 = mysql_query("SELECT * FROM abs_x23_employee WHERE  EmployeeID IN (SELECT nik FROM x23_karyawan WHERE  posisi!='6')");
											}
										while($d2  = mysql_fetch_array($q2))
											{
											$dD	 = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_department WHERE  DepartmentID='$d2[DepartmentID]'"));
											$awal  = date("Y-m-d",strtotime($pecah[0]));
											$akhir = date("Y-m-d",strtotime($pecah[1]));
			                            	
											while (strtotime($awal) <= strtotime($akhir)) 
												{
												$d3  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_status WHERE  EmployeeID='$d2[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
												mysql_query("INSERT INTO temp_abs_x23_status (
																				EmployeeID,
																				tgl,
																				status,
																				keterangan)
																			VALUES (
																				'$d2[EmployeeID]',
																				'$awal',
																				'$d3[status]',
																				'$d3[keterangan]')");
																				
												$d4  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_result_vw WHERE  EmployeeID='$d2[EmployeeID]' AND substr(Date,1,10)='$awal'"));
												
												$selesai 		= substr($d4['Date'],11,8);
												$mulai	 		= "07:29:59";
												$mulai_time	 	=(is_string($mulai)?strtotime($mulai):$mulai);
												$selesai_time	=(is_string($selesai)?strtotime($selesai):$selesai);
												$detik			=$selesai_time-$mulai_time; //hitung selisih dalam detik
												$menit			=round($detik/60); //hiutng menit
												$sisa_detik		=$detik%$menit; //hitung sisa detik
												
												if($menit <= 0){
													$terlambat = "";
													}
												else{
													$terlambat = $menit;
													if(substr($d4[Scan4],0,10) != "0000-00-00")
														{
														mysql_query("INSERT INTO temp_abs_x23_terlambat (
																						EmployeeID,
																						tgl,
																						total)
																					VALUES (
																						'$d2[EmployeeID]',
																						'$awal',
																						'$terlambat')");
														}
													}
												
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
												}
												
												$jangka 	= selisihHari($_SESSION[periode_awal], $_SESSION[periode_akhir]);
												$hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_x23_result_vw WHERE  substr(Scan4,1,10) BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND EmployeeID='$d2[EmployeeID]' GROUP BY EmployeeID"));
												$izin 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM temp_abs_x23_status WHERE  status='IZIN' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
												$sakit 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM temp_abs_x23_status WHERE  status='SAKIT' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
												
												if($periode_awal==$_SESSION[periode_akhir])
													{
													$hadir = $hadir[total]+1;
							                        //$tanpaket	= $jangka-$izin[total]-$cuti[total]-$sakit[total]-$hadir[total]+1;
													}
												else{
													$hadir = $hadir[total];
													}	
													
												$tanpaketX	= $jangka-$izin[total]-$sakit[total]-$hadir[total]+1;
												if($tanpaketX<0){
													$tanpaket = "0";
													}
												else{
													$tanpaket = $tanpaketX;
													}
												
												$bterlambat = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_abs_x23_terlambat WHERE  total!='0' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
												$dterlambat = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM temp_abs_x23_terlambat WHERE  total!='0' AND EmployeeID='$d2[EmployeeID]' AND tgl BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
													
												echo"
													<tr> 
														<td>$d2[FirstName] $d2[LastName]</td>
														<td>$dD[DepartmentName]</td>
														<td align='center'>".number_format($jangka+1)." Hari</td> 
														<td align='center'>".number_format($hadir[total])." Hari</td> 
														<td align='center'>".number_format($bterlambat[total])." Hari</td> 
														<td align='right'>".number_format($dterlambat[total])." Menit</td> 
														<td align='center'>".number_format($izin[total])." Hari</td> 
														<td align='center'>".number_format($sakit[total])." Hari</td> 
														<td align='center'>".number_format($tanpaket)." Hari</td> 
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
			                        
			                    	<div class="clearfix"></div>
				                <?
				                	}
									mysql_query("TRUNCATE temp_abs_x23_status");
									mysql_query("TRUNCATE temp_abs_x23_terlambat");
									mysql_query("TRUNCATE temp_abs_x23_overbreak");
									mysql_query("TRUNCATE temp_abs_x23_overtime");
				                ?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
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