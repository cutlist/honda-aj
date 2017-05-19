
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KINERJA MEKANIK <small>INDIVIDU</small></h4>	
                                    <div style="float:left;width:75%">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    		<tr>
                                    			<td width="45%"><select name="idmekanik" required="" class="form-control" id="select1" style="font-size:12px;padding:3px">
																		<option value='' selected>PILIH MEKANIK</option>
																		<?
																			$q1 = mysql_query("SELECT id,nama FROM x23_karyawan WHERE posisi IN ('4') ORDER BY nama");
																			while($dA=mysql_fetch_array($q1))
																				{
																		?>
																					<option value='<?echo $dA[id]?>' <?if($_REQUEST[idmekanik]==$dA[id]){?>selected=""<?}?>><?echo "$dA[nama]"?></option>
																		<?
																				}
																		?>
																    </select></td>
                                    			<td><input type="text" name="periode" required="" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode Tanggal Selesai Servis"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/></td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    			<td width="1%">	<button type="button"  onclick="window.open('print/h2/kmindividu.php?idmekanik=<?echo $_REQUEST[idmekanik]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           					</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
										
	                            <?
	                            if(!empty($_REQUEST[idmekanik]))
	                            	{     
						            $pecah = explode(" s.d. ", $_REQUEST[periode]);
						            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
						            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:200%;padding-right:20px">
										<thead>
											<tr>
												<td style="font-size:14px"><b><center>NO. PKB</center></b></td>
												<td style="font-size:14px"><b><center>NO. NOTA SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>TGL NOTA SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>NO. NOTA SERVIS JR</center></b></td>
												<td style="font-size:14px"><b><center>NO. POLISI</center></b></td>
												<td style="font-size:14px"><b><center>NO. KPB</center></b></td>
												<td style="font-size:14px"><b><center>NAMA JASA</center></b></td>
												<td style="font-size:14px"><b><center>NAMA SPARE PART</center></b></td>
												<td style="font-size:14px"><b><center>JAM MASUK BENGKEL</center></b></td>
												<td style="font-size:14px"><b><center>JAM MULAI SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>TGL SELESAI SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>JAM SELESAI SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>DURASI SERVIS</center></b></td>
											</tr>
										</thead>
			                            <tbody>
			                            <?
										mysql_query("TRUNCATE temp_x23_kmindividu_wktsvc");
										
										$dA1 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
										$dA2 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice_det1_vw WHERE kpbke!='' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
										$dA4 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE jns='SERVIS JR' AND idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
										
										$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE idmekanik='$_REQUEST[idmekanik]' AND tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]'"));
											$mulai   = mktime(date("H",strtotime($d1[jammulai])), date("i",strtotime($d1[jammulai])), date("s",strtotime($d1[jammulai])), date("m",strtotime($d1[tglnota])), date("d",strtotime($d1[tglnota])), date("Y",strtotime($d1[tglnota])));
											$selesai = mktime(date("H",strtotime($d1[jamselesai])), date("i",strtotime($d1[jamselesai])), date("s",strtotime($d1[jamselesai])), date("m",strtotime($d1[tglselesai])), date("d",strtotime($d1[tglselesai])), date("Y",strtotime($d1[tglselesai])));
											
											$selisih_waktu = $selesai-$mulai;
											$jumlah_hari = floor($selisih_waktu/86400);
											if($jumlah_hari=="0"){
												$hari = "";
												}
											if($jumlah_hari!="0"){
												$hari = "$jumlah_hari Hari";
												}

											//Untuk menghitung jumlah dalam satuan jam:
											$sisa = $selisih_waktu % 86400;
											$jumlah_jam = floor($sisa/3600);
											if($jumlah_jam=="0"){
												$jam = "";
												}
											if($jumlah_jam!="0"){
												$jam = "$jumlah_jam Jam";
												}

											//Untuk menghitung jumlah dalam satuan menit:
											$sisa = $sisa % 3600;
											$jumlah_menit = floor($sisa/60);
											if(strlen($jumlah_menit)==1){
												$menit = "0".$jumlah_menit;
												}
											if(strlen($jumlah_menit) == 2){
												$menit = $jumlah_menit;
												}
												
											if($jumlah_menit < "0"){
												$durasi = "-";
												}
											else{
												$durasi = "$hari $jam $jumlah_menit Menit";
												}
												
												mysql_query("INSERT INTO temp_x23_kmindividu_wktsvc VALUES ('','$selisih_waktu')");
												
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE noantrian='$d1[noantrian]' AND tanggal='$d1[tglnota]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><span style="padding-right:20%"><?echo $d1[nopkb]?></span></td>
			                                    <td><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td><?echo $d1[noclaim]?></td>
			                                    <td align=""><?echo $d1[nopol]?></td>
			                                    <td align="center"><?echo $d2[kpbke]?></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
						                        ?>
						                                <?echo $dB[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                                
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                <?echo $dB[namajasa]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
														}
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
						                                    <?echo $dA[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="center"><?echo "$d3[jam]"?></td>
			                                    <td align="center"><?echo "$d1[jammulai]"?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglselesai]))?></td>
			                                    <td align="center"><?echo "$d1[jamselesai]"?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $durasi?></span></td>
			                                </tr>
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            </tfoot>
									</table>
			                        
			                        <?
			                        $dA3 = mysql_fetch_array(mysql_query("SELECT SUM(wktsvc) AS total FROM temp_x23_kmindividu_wktsvc"));
			                        $selisih_waktu = $dA3[total];
									$jumlah_hari = floor($selisih_waktu/86400);
									if($jumlah_hari=="0"){
										$hari = "";
										}
									if($jumlah_hari!="0"){
										$hari = "$jumlah_hari HARI";
										}

									//Untuk menghitung jumlah dalam satuan jam:
									$sisa = $selisih_waktu % 86400;
									$jumlah_jam = floor($sisa/3600);
									if($jumlah_jam=="0"){
										$jam = "";
										}
									if($jumlah_jam!="0"){
										$jam = "$jumlah_jam JAM";
										}

									//Untuk menghitung jumlah dalam satuan menit:
									$sisa = $sisa % 3600;
									$jumlah_menit = floor($sisa/60);
									if(strlen($jumlah_menit)==1){
										$menit = "0".$jumlah_menit;
										}
									if(strlen($jumlah_menit) == 2){
										$menit = $jumlah_menit;
										}
										
									if($jumlah_menit < "0"){
										$durasi = "-";
										}
									else{
										$durasi = "$hari $jam $jumlah_menit MENIT";
										}
									?>
			                        <table style="font-weight:bold">
			                        	<tr>
			                        		<td>JUMLAH UNIT DISERVIS</td>
			                        		<td width="35px" align="center">:</td>
			                        		<td align="right"><?echo $dA1[total]?> UNIT</td>
			                        	</tr>
			                        	<tr>
			                        		<td>JUMLAH KPB</td>
			                        		<td align="center">:</td>
			                        		<td align="right"><?echo $dA2[total]?> UNIT</td>
			                        	</tr>
			                        	<tr>
			                        		<td>JUMLAH SERVIS JR</td>
			                        		<td align="center">:</td>
			                        		<td align="right"><?echo $dA4[total]?> UNIT</td>
			                        	</tr>
			                        	<tr>
			                        		<td>TOTAL WAKTU SERVIS</td>
			                        		<td align="center">:</td>
			                        		<td align="right"><?echo $durasi?></td>
			                        	</tr>
			                        </table>
								<?
									}
									//mysql_query("TRUNCATE temp_x23_kmindividu_wktsvc");
								?>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>				
			        </div>
				</section>
			</aside>
			
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
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
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('#example4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example5').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
                });
                $('#example6').dataTable({
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