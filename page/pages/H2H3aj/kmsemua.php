
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KINERJA MEKANIK <small>SEMUA (PCS)</small></h4>	
                                    <div style="float:right;width:50%">
			                   			<form method="post" action="" enctype="multipart/form-data">
                                    	<table>
                                    		<tr>
                                    			<td><input type="text" name="periode" style="height:33px" required="" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode Tanggal Selesai Servis"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/></td>
                                    			
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    			<td width="1%">	<button type="button"  onclick="window.open('printaj/h2/kmsemua.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           					</td>
                                    		</tr>
                                    	</table>
                                    	</form>
									</div>
									
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:100%;padding-right:20px">
										<thead>
											<tr>
												<td style="font-size:14px"><b><center>NAMA MEKANIK</center></b></td>
												<td style="font-size:14px"><b><center>JUMLAH NOTA SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>JUMLAH UNIT SERVIS</center></b></td>
												<td style="font-size:14px"><b><center>JUMLAH UNIT KPB</center></b></td>
												<td style="font-size:14px"><b><center>JUMLAH UNIT SERVIS JR</center></b></td>
												<td style="font-size:14px"><b><center>TOTAL WAKTU SERVIS</center></b></td>
											</tr>
										</thead>
			                            <tbody>
			                            <?
							            $pecah = explode(" s.d. ", $_REQUEST[periode]);
							            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
							            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
						            
										mysql_query("TRUNCATE temp_x23_kmindividu_wktsvc");
										$qM = mysql_query("SELECT nama,id FROM x23_karyawan WHERE posisi='4'");
										while($dM = mysql_fetch_array($qM))
											{
											$dA1 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE id%2=0 AND idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
											$dA2 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice_det1_vw WHERE id%2=0 AND kpbke!='' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1')"));
											$dA4 = mysql_fetch_array(mysql_query("SELECT COUNT(nonota) AS total FROM x23_notaservice WHERE id%2=0 AND jns='SERVIS JR' AND idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'"));
										
											$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE id%2=0 AND idmekanik='$dM[id]' AND  tglselesai BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1'");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
												$mulai   = mktime(date("H",strtotime($d1[jammulai])), date("i",strtotime($d1[jammulai])), date("s",strtotime($d1[jammulai])), date("m",strtotime($d1[tglnota])), date("d",strtotime($d1[tglnota])), date("Y",strtotime($d1[tglnota])));
												$selesai = mktime(date("H",strtotime($d1[jamselesai])), date("i",strtotime($d1[jamselesai])), date("s",strtotime($d1[jamselesai])), date("m",strtotime($d1[tglselesai])), date("d",strtotime($d1[tglselesai])), date("Y",strtotime($d1[tglselesai])));
												$selisih_waktu = $selesai-$mulai;
												mysql_query("INSERT INTO temp_x23_kmindividu_wktsvc VALUES ('$dM[id]','$selisih_waktu')");
				                            	}
				                            
				                            
					                        $dA3 = mysql_fetch_array(mysql_query("SELECT SUM(wktsvc) AS total FROM temp_x23_kmindividu_wktsvc WHERE idmekanik='$dM[id]'"));
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
											if($dA1[total]>'0')
												{
										?>
				                                <tr style="cursor:pointer">
				                                    <td align=""><?echo $dM[nama]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA1[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA1[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA2[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $dA4[total]?> PCS</span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo $durasi?></span></td>
				                                </tr>
			                            <?
												}
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                            </tfoot>
									</table>
			                        			                        
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