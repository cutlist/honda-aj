<?
	include "include/fungsi_indotgl1.php";
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/abs_individuh23.php?EmployeeID=<?echo $_REQUEST[EmployeeID]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>ABSENSI <small>INDIVIDU</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:left;width:55%">
				                    	<table style="width:100%">
				                    		<tr>
				                    			<td><select name="EmployeeID" style="padding:3px;" class="form-control" id="select1" required="">
				                    							<option value=''>PILIH KARYAWAN</option>
																		<?
																		if($_SESSION[posisi]=='DIREKSI'){
																			$q1 = mysql_query("SELECT * FROM abs_x23_employee GROUP BY EmployeeID ORDER BY FirstName");
																			}
																		else{
																			$q1 = mysql_query("SELECT * FROM abs_x23_employee WHERE EmployeeID IN (SELECT nik FROM x23_karyawan WHERE posisi!='6') GROUP BY EmployeeID  ORDER BY FirstName");
																			}
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value="<?echo $dA[EmployeeID]?>" <?if($_REQUEST[EmployeeID]==$dA[EmployeeID]){?>selected=""<?}?> ><?echo "$dA[FirstName] $dA[LastName]"?></option>
																		<?
																				}
																		?>
															    </select></td>
				                    		</tr>
		                            	</table>
	                            	</div>
                                    <div style="float:right;width:45%">
                                    	<table width="100%">
                                    		<tr>
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
												<?
												if($_SESSION[posisi]=='DIREKSI' OR $_SESSION[posisi]=='PIC')
													{
												?>
	                                    			<td width="1%">
	                                    				<a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a>
	                                    			</td>
												<?
													}
												?>
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
												<th>TANGGAL</th>
												<th>HARI</th>
												<th>JAM MASUK</th>
												<th>TERLAMBAT</th>
												<th>JAM KELUAR</th>
												<th>OVER TIME</th>
												<th>KETERANGAN</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
										$awal  = date("Y-m-d",strtotime($pecah[0]));
										$akhir = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            //echo  $awal.$akhir;
			                            
										$no=0;
										$izin=0;
										$sakit=0;
										$tanpaket=0;
										$hadir=0;
										while (strtotime($awal) <=  strtotime($akhir)) 
			                            	{
											$d1  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
											mysql_query("INSERT INTO temp_abs_x23_status (
																			EmployeeID,
																			tgl,
																			status,
																			keterangan)
																		VALUES (
																			'$_REQUEST[EmployeeID]',
																			'$awal',
																			'$d1[status]',
																			'$d1[keterangan]')");
																			
											$d2  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_result_vw WHERE EmployeeID='$_REQUEST[EmployeeID]' AND substr(Date,1,10)='$awal'"));
											
											$selesai 		= substr($d2['Date'],11,8);
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
												$terlambat = $menit." Menit";
												mysql_query("INSERT INTO temp_abs_x23_terlambat (
																				EmployeeID,
																				tgl,
																				total)
																			VALUES (
																				'$_REQUEST[EmployeeID]',
																				'$awal',
																				'$terlambat')");
												}
																			
											//HITUNG OVERBREAK
											$selesai2 		= substr($d2['Scan3'],11,8);
											$mulai2	 		= "12:59:59";
											$mulai_time2	=(is_string($mulai2)?strtotime($mulai2):$mulai2);
											$selesai_time2	=(is_string($selesai2)?strtotime($selesai2):$selesai2);
											$detik2			=$selesai_time2-$mulai_time2; //hitung selisih dalam detik
											$menit2			=round($detik2/60); //hiutng menit
											$sisa_detik2	=$detik2%$menit2; //hitung sisa detik
											
											if($menit2 <= 0){
												$overbreak = "";
												}
											else{
												$overbreak = $menit2." Menit";
												mysql_query("INSERT INTO temp_abs_x23_overbreak (
																				EmployeeID,
																				tgl,
																				total)
																			VALUES (
																				'$_REQUEST[EmployeeID]',
																				'$awal',
																				'$overbreak')");
												}
												
											//HITUNG OVERTIME
											$selesai3 		= substr($d2['Scan4'],11,8);
											$mulai3	 		= "16:00:00";
											$mulai_time3	=(is_string($mulai3)?strtotime($mulai3):$mulai3);
											$selesai_time3	=(is_string($selesai3)?strtotime($selesai3):$selesai3);
											$detik3			=$selesai_time3-$mulai_time3; //hitung selisih dalam detik
											$menit3			=round($detik3/60); //hiutng menit
											$sisa_detik3	=$detik3%$menit3; //hitung sisa detik
											
											if($menit3 <= 0){
												$overtime = "";
												}
											else{
												$overtime = $menit3." Menit";
												mysql_query("INSERT INTO temp_abs_x23_overtime (
																				EmployeeID,
																				tgl,
																				total)
																			VALUES (
																				'$_REQUEST[EmployeeID]',
																				'$awal',
																				'$overtime')");
												}
												
											$hari_ar = array("Monday"=>"Senin", "Tuesday"=>"Selasa", "Wednesday"=>"Rabu", "Thursday"=>"Kamis", "Friday"=>"Jumat", "Saturday"=>"Sabtu", "Sunday"=>"Minggu");
											$hari_en = date('l',strtotime($awal));
											$hari	 = $hari_ar[$hari_en];
									
											$jammasukX 	= substr($d2['Date'],11,8);
											$istirahatX = substr($d2['Scan2'],11,8);
											$selesaiistirahatX = substr($d2['Scan3'],11,8);
											$jamkeluarX = substr($d2['Scan4'],11,8);
											
											if(empty($jammasukX)){
												$jammasuk = "-";
												}
											else{
												$jammasuk = $jammasukX;
												}
											if(empty($istirahatX) || $istirahatX == "00:00:00"){
												$istirahat = "-";
												}
											else{
												$istirahat = $istirahatX;
												}
											if(empty($selesaiistirahatX) || $selesaiistirahatX == "00:00:00"){
												$selesaiistirahat = "-";
												}
											else{
												$selesaiistirahat = $selesaiistirahatX;
												}
											if(empty($jamkeluarX) || $jamkeluarX == "00:00:00"){
												$jamkeluar = "-";
												}
											else{
												$jamkeluar = $jamkeluarX;
												}
												
												
											$d3  = mysql_fetch_array(mysql_query("SELECT * FROM abs_x23_status WHERE EmployeeID='$_REQUEST[EmployeeID]' AND awal <= '$awal' AND akhir >= '$awal'"));
											if(empty($d3['id'])){
												if($jamkeluar == "-"){
													$status = "TIDAK HADIR";
													$tanpaket++;
													}
												else{
													$status = "HADIR";
													$hadir++;
													}
												}
											else{
												$status = $d3['status'];
												if($status=="SAKIT"){
													$sakit++;
													}
												if($status=="IZIN"){
													$izin++;
													}
												}
												
												echo"
													<tr style='cursor:pointer'> 
														<td align='center'>".tgl_indo1($awal)."</td> 
														<td align='left'>$hari</td> 
														<td align='center'>$jammasuk</td> 
														<td align='center'>$terlambat</td> 
														<td align='center'>$jamkeluar</td> 
														<td align='center'>$overtime</td> 
														<td align='center'>$status</td> 
													</tr>";
											//	}
												$awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));
												$no++;
											}
										?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="10">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
		                            <div style="border-bottom:1px #aaa dashed;margin: 10px 0 10px"></div>
		                            <?
		                            $periode_awal = date("Y-m-d",strtotime($pecah[0]));
									
			                        $terlambat  = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_abs_x23_terlambat"));
			                        $overtime   = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM temp_abs_x23_overtime"));
			                        
			                        $dterlambat = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM temp_abs_x23_terlambat WHERE EmployeeID='$_REQUEST[EmployeeID]' AND tgl BETWEEN '$periode_awal' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
			                        $dovertime  = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM temp_abs_x23_overtime WHERE EmployeeID='$_REQUEST[EmployeeID]' AND tgl BETWEEN '$periode_awal' AND '$_SESSION[periode_akhir]' GROUP BY EmployeeID"));
									?>
	                            	<div class="col-xs-6">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="40%">JUMLAH KEHADIRAN</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($hadir)?>" style="text-align:right" class="form-control" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                                <td width="35%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td>JUMLAH IZIN</td>
				                    			<td>:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($izin)?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>JUMLAH SAKIT</td>
				                    			<td>:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($sakit)?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>JUMLAH TANPA KETERANGAN</td>
				                    			<td>:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($tanpaket)?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL</td>
				                    			<td>:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($no)?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                    		</tr>
		                            	</table>
			                    	</div>
	                            	<div class="col-xs-6">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="40%">JUMLAH TERLAMBAT MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($terlambat[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                                <td width="35%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="40%">DURASI TERLAMBAT MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($dterlambat[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Menit</span>
				                                    </div></td>
				                                <td width="35%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="40%">JUMLAH OVER TIME</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($overtime[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Hari</span>
				                                    </div></td>
				                                <td width="35%"></td>
				                    		</tr>
				                    		<tr>
				                    			<td width="40%">DURASI OVER TIME</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($dovertime[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Menit</span>
				                                    </div></td>
				                                <td width="35%"></td>
				                    		</tr>
		                            	</table>
			                    	</div>
			                    	<div class="clearfix"></div>
				                <?
									mysql_query("TRUNCATE temp_abs_x23_status");
									mysql_query("TRUNCATE temp_abs_x23_terlambat");
									mysql_query("TRUNCATE temp_abs_x23_overbreak");
									mysql_query("TRUNCATE temp_abs_x23_overtime");
				                	}
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
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
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