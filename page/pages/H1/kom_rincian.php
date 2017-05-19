<?
	include "include/fungsi_indotgl1.php";
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
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KOMPENSASI <small>RINCIAN</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:left;width:60%">
				                    	<table style="width:100%">
				                    		<tr>
				                    			<td>
																		<?
																			if($_SESSION[posisi]=='DIREKSI')
												                            	{
																		?>
																				<select name="EmployeeID" style="padding:3px;" class="form-control" id="select1" required="">
																					<option value=''>PILIH KARYAWAN</option>
																		<?
																				$q1 = mysql_query("SELECT * FROM abs_employee_vw WHERE status='AKTIF' GROUP BY EmployeeID  ORDER BY FirstName");
																				while($dA=mysql_fetch_array($q1))
																					{
																		?>
																					<option value="<?echo $dA[EmployeeID]?>" <?if($_REQUEST[EmployeeID]==$dA[EmployeeID]){?>selected=""<?}?> ><?echo "$dA[FirstName] $dA[LastName] | $dA[DepartmentName]"?></option>
																		<?
																					}
																		?>
																				</select>
																		<?
																				}
																			else
												                            	{
												                            	$dEmp = mysql_fetch_array(mysql_query("SELECT nik FROM tbl_user_vw WHERE id='$_SESSION[id]'"));
																				$dA = mysql_fetch_array(mysql_query("SELECT * FROM abs_employee_vw WHERE EmployeeID='$dEmp[nik]'"));
																		?>
																				<input type="text" class="form-control" style="width:100%;" readonly value="<?echo "$dA[FirstName] $dA[LastName] | $dA[DepartmentName]"?>"/>  
																				<input type="hidden" name="EmployeeID" value="<?echo $dA[EmployeeID]?>"/>  
																		<?
																				}
																		?>
															    <//?echo $_SESSION[id]?></td>
				                    		</tr>
		                            	</table>
	                            	</div>
                                    <div style="float:right;width:35%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td width="70%"><select name="bulan" class="form-control" style="height:35px" required="">
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
                                    			<td width="30%"><select name="tahun" class="form-control" style="height:35px" required="">
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
									</div>
                                    </form>
	                            <?
	                            if(!empty($_REQUEST[EmployeeID]))
	                            	{
	                            	/*
		                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
									$awal  = date("Y-m-d",strtotime($pecah[0]));
									$akhir = date("Y-m-d",strtotime($pecah[1]));
									*/
		                            
		                            $dU 		= mysql_fetch_array(mysql_query("SELECT id FROM tbl_user_vw WHERE nik='$_REQUEST[EmployeeID]'"));
		                            
		                            $hadir 		= mysql_fetch_array(mysql_query("SELECT COUNT(EmployeeID) AS total FROM abs_result_vw WHERE SUBSTR(Scan4,1,4)='$periode_tahun' AND SUBSTR(DATE,6,2)='$periode_bulan' AND EmployeeID='$_REQUEST[EmployeeID]'"));
		                            $gaji 		= mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
		                            $tharian	= $gaji[uharian]*$hadir[total];
		                            
		                            $dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_karyawan WHERE nik='$_REQUEST[EmployeeID]'"));
									if($dA[posisi]=='9')
										{
										$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
										$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
										$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
			                            
			                    		$dB1=mysql_fetch_array(mysql_query("SELECT cash FROM tbl_insentif_karyawan WHERE id_karyawan='$dA[id]' AND target <= '$p2[total]' ORDER BY target DESC LIMIT 1"));
			                    		$ict1 = $dB1[cash]*$p2[total];
			                    		
			                    		$dB2=mysql_fetch_array(mysql_query("SELECT kredit FROM tbl_insentif_karyawan WHERE id_karyawan='$dA[id]' AND target <= '$p3[total]' ORDER BY target DESC LIMIT 1"));
			                    		$ict2 = $dB2[kredit]*$p3[total];
										}
									else if($dA[posisi]=='2' || $dA[posisi]=='7' || $dA[posisi]=='6')
										{
										$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE idsales='$dU[id]' AND bulan='$periode_bulan' AND tahun='$periode_tahun'"));
										$p2 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE idsales='$dU[id]' AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='CASH' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='DEALER'))"));
										$p3 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE idsales='$dU[id]' AND bulan='$periode_bulan' AND tahun='$periode_tahun' AND (jnstransaksi='KREDIT' OR (jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING'))"));
			                            
			                    		$dB1=mysql_fetch_array(mysql_query("SELECT cash FROM tbl_insentif_karyawan WHERE id_karyawan='$dA[id]' AND target <= '$p2[total]' ORDER BY target DESC LIMIT 1"));
			                    		$ict1 = $dB1[cash]*$p2[total];
			                    		
			                    		$dB2=mysql_fetch_array(mysql_query("SELECT kredit FROM tbl_insentif_karyawan WHERE id_karyawan='$dA[id]' AND target <= '$p3[total]' ORDER BY target DESC LIMIT 1"));
			                    		$ict2 = $dB2[kredit]*$p3[total];
										}
									else if($dA[posisi]=='3' || $dA[posisi]=='4' || $dA[posisi]=='5' || $dA[posisi]=='8')
										{
										$p1 = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM tbl_ksindividu_vw WHERE bulan='$periode_bulan' AND tahun='$periode_tahun'"));
			                            
			                    		$dB=mysql_fetch_array(mysql_query("SELECT flat FROM tbl_insentif_karyawan WHERE id_karyawan='$dA[id]'"));
			                    		$ict = $dB[flat]*$p1[total];
										}
										
		                            // HITUNG UANG LEMBUR
		                            $dL 		= mysql_fetch_array(mysql_query("SELECT SUM(ulembur) AS totulembur FROM tbl_uanglembur WHERE tahun='$periode_tahun' AND bulan='$periode_bulan' AND idkaryawan='$dA[id]'"));
		                            
									
									?>
	                            	<div class="col-xs-6" style="padding:10px">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="40%">GAJI POKOK <?//echo $dA[id].$dU[id]?></td>
				                    			<td width="2%">:</td>
				                    			<td>
				                                    <div class="input-group">
				                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
				                                      	<input type="text" value="<?echo number_format($gaji[ugapok])?>" style="text-align:right;width:60%" class="form-control" readonly="">
				                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL UANG HARIAN</td>
				                    			<td>:</td>
				                    			<td>
				                                    <div class="input-group">
				                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
				                                      	<input type="text" value="<?echo number_format($tharian)?>" style="text-align:right;width:60%" class="form-control" readonly="">
				                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL UANG LEMBUR</td>
				                    			<td>:</td>
				                    			<td>
				                                    <div class="input-group">
				                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
				                                      	<input type="text" value="<?echo number_format($dL[totulembur])?>" style="text-align:right;width:60%" class="form-control" readonly="">
				                                    </div></td>
				                    		</tr>
				                    		<?
				                    		if($dA[posisi]=='2' || $dA[posisi]=='7' || $dA[posisi]=='6' || $dA[posisi]=='9')
												{
				                    		?>
					                    		<tr>
					                    			<td>TOTAL KOMISI CASH <?//echo $p2[total].$dB1[cash].$dA[id]?></td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
					                                      	<input type="text" value="<?echo number_format($ict1)?>" style="text-align:right;width:60%" class="form-control" readonly="">
					                                    </div></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TOTAL KOMISI KREDIT</td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
					                                      	<input type="text" value="<?echo number_format($ict2)?>" style="text-align:right;width:60%" class="form-control" readonly="">
					                                    </div></td>
					                    		</tr>
					                    	<?
					                    		}
											else if($dA[posisi]=='3' || $dA[posisi]=='4' || $dA[posisi]=='5' || $dA[posisi]=='8')
												{
					                    	
				                            // HITUNG KOMISI PENYESUAIAN & HITUNG TAMBAHAN
											$dTt = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kompensasi WHERE substr(tglbayar,6,2)='$periode_bulan' AND substr(tglbayar,1,4)='$periode_tahun' AND idkaryawan='$dA[id]'"))
				                    		?>
					                    		<tr>
					                    			<td>TOTAL KOMISI (PERHITUNGAN)<?//echo $dB[flat].$dA[id]?></td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
					                                      	<input type="text" value="<?echo number_format($ict)?>" style="text-align:right;width:60%" class="form-control" readonly="">
					                                    </div></td>
					                    		</tr>
					                    		<tr>
					                    			<td>TOTAL KOMISI (PENYESUAIAN)</td>
					                    			<td>:</td>
					                    			<td>
					                                    <div class="input-group">
					                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
					                                      	<input type="text" value="<?echo number_format($dTt[uinsentif])?>" style="text-align:right;width:60%" class="form-control" readonly="">
					                                    </div></td>
					                    		</tr>
				                    		<?
				                    			}
												
				                            // HITUNG POTONG
				                            $dP1 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_potkompensasi WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[id]' AND metodebayar='GAJI' AND status='1'"));
				                            $dP2 		= mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total FROM tbl_piutang WHERE substr(tgl,6,2)='$periode_bulan' AND substr(tgl,1,4)='$periode_tahun' AND idkaryawan='$dA[id]' AND metodebayar='GAJI' AND status='1'"));
				                            $totpot		= $dP1[total]+$dP2[total];
				                            ?>
				                    		<tr>
				                    			<td>TOTAL TAMBAHAN</td>
				                    			<td>:</td>
				                    			<td>
				                                    <div class="input-group">
				                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
				                                      	<input type="text" value="<?echo number_format($dTt[utambahan])?>" style="text-align:right;width:60%" class="form-control" readonly="">
				                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>TOTAL POTONGAN</td>
				                    			<td>:</td>
				                    			<td>
				                                    <div class="input-group">
				                                    	<span class="input-group-addon" style="min-width:30px">RP</span>
				                                      	<input type="text" value="<?echo number_format($totpot)?>" style="text-align:right;width:60%" class="form-control" readonly="">
				                                    </div></td>
				                    		</tr>
		                            	</table>
			                    	</div>
	                            	<div class="col-xs-6" style="padding:10px">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="55%">JUMLAH PENJUALAN SEPEDA MOTOR</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="1">
				                                    <div class="input-group">
				                                      	 <input type="text" value="<?echo number_format($p1[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
				                                        <span class="input-group-addon" style="min-width:60px">Pcs</span>
				                                    </div></td>
				                                <td width="15%"></td>
				                    		</tr>
				                    		<?
				                    		if($dA[posisi]=='2' || $dA[posisi]=='7' || $dA[posisi]=='6' || $dA[posisi]=='9')
												{
				                    		?>
					                    		<tr>
					                    			<td width="">JUMLAH PENJUALAN CASH</td>
					                    			<td width="">:</td>
					                    			<td colspan="1">
					                                    <div class="input-group">
					                                      	 <input type="text" value="<?echo number_format($p2[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
					                                        <span class="input-group-addon" style="min-width:60px">Pcs</span>
					                                    </div></td>
					                                <td width="15%"></td>
					                    		</tr>
					                    		<tr>
					                    			<td width="">JUMLAH PENJUALAN KREDIT</td>
					                    			<td width="">:</td>
					                    			<td colspan="1">
					                                    <div class="input-group">
					                                      	 <input type="text" value="<?echo number_format($p3[total])?>" style="text-align:right" class="form-control" maxlength="40" readonly="">
					                                        <span class="input-group-addon" style="min-width:60px">Pcs</span>
					                                    </div></td>
					                                <td width="15%"></td>
					                    		</tr>
					                    	<?
					                    		}
					                    	?>
		                            	</table>
			                    	</div>
			                    	<div class="clearfix"></div>
				                <?
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
                    "bPaginate": false,
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