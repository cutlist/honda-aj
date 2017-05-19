<?
	if(!empty($_REQUEST[update]))
		{
		$nostnk		= strtoupper($_REQUEST[nostnk]);
		$nobpkb		= strtoupper($_REQUEST[nobpkb]);
		mysql_query("UPDATE tbl_notajual_det SET
										statusleasing='$_REQUEST[statusleasing]',								
										statusbbn='$_REQUEST[statusbbn]',								
										nostnk='$nostnk',								
										nobpkb='$nobpkb'
									WHERE 	
										norangka='$_REQUEST[update]'						
						");
		}
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
			                	<h4>AKTIVITAS BISNIS <small>HASIL SURVEY LEASING</small></h4>
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:45%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" placeholder="Pilih Periode Tanggal Nota Pesan" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
													<button type="button"  onclick="window.open('print/h1/abis_sleasing.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                       			<?
				                       				}
				                       			?>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{      
			                    ?>
				                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:290%;padding-right:20px">
											<thead>
												<tr>
													<th rowspan="2">TGL NOTA PESAN</th>
													<th rowspan="2">NO. NOTA PESAN</th>
													<th rowspan="2">TGL NOTA JUAL</th>
													<th rowspan="2">NO. NOTA JUAL</th>
													<th rowspan="2">NAMA PELANGGAN</th>
													<th rowspan="2">NO. KTP</th> 
													<th rowspan="2">NAMA BARANG</th>
													<th rowspan="2">VARIAN</th> 
													<th rowspan="2">WARNA</th> 
													<th rowspan="2">TOTAL TITIPAN/UANG MUKA (RP)</th> 
													<th rowspan="2">LEASING</th> 
													<th rowspan="2">JANGKA WAKTU ANGSURAN (KALI)</th> 
													<th rowspan="2">ANGSURAN (RP)</th> 
													<th rowspan="2">HASIL SURVEY</th> 
													<th rowspan="2">PIHAK PEMBATAL</th>
													<th colspan="4"><center>RIWAYAT LEASING</center></th> 
												</tr>
												<tr>
													<th>TANGGAL PENGAJUAN LEASING</th> 
													<th>LEASING</th> 
													<th>BARANG</th> 
													<th>HASIL SURVEY LEASING</th
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											
											$no=1;
											$q1 = mysql_query("SELECT * FROM tbl_pesanan_vw WHERE tglpesan BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND (jnstransaksi='KREDIT' OR  jnstransaksi='CASH TEMPO' AND jnscashtempo='LEASING')");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{
			                            		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notajual WHERE nopesan='$d1[nopesan]'"));
				                            	$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
			                            		$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
				                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_leasing WHERE id='$d1[idleasing]'"));
				                            	
			                            		if(!empty($d1[batal])){
				                            		if($d1[status]=="0" || $d1[status]=="MENUNGGU KONFIRMASI"){
					                            		$statusleasing = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>Diproses</span>";
														$batal = "<center>-</center>";
					                            		}
					                            	else{
					                            		$statusleasing = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Ditolak</span>";
														$batal = $d1[batal];
														}
													}
												else if(empty($d1[batal])){
				                            		if($d1[status]=="0"){
					                            		$statusleasing = "<span class='btn btn-info' style='padding:0px 10px;font-size:12px;'>Diproses</span>";
					                            		}
					                            	else{
						                            	$statusleasing = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Disetujui</span>";
														}
													$batal = "<center>-</center>";
													}
				                            	
				                            	if($dI[penyerahan]=='KIRIM'){
													$dJ = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user_vw WHERE id='$dI[user]'"));
													$penyerahan = $dJ[nama];	
													}
												else{
													$penyerahan = $dI[penyerahan];	
													}
													
					                            if(empty($dA[tglnota])){
													$tglnota 	= "-";
													$nonota	 	= "-";
													}
												else{
													$tglnota 	= date("d-m-Y",strtotime($dA[tglnota]));
													$nonota	 	= $dA[nonota];
													}
				                            ?>
				                                <tr style="cursor:pointer">
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpesan]))?></td>
				                                    <td align="center"><?echo $d1[nopesan]?></td>
				                                    <td align="center"><?echo $tglnota?></td>
				                                    <td align="center"><?echo $nonota?></td>
				                                    <td><?echo $dD[nama]?></td>
				                                    <td align="center"><?echo $dD[noktp]?></td>
				                                    <td><?echo $dB[namabarang]?></td>
				                                    <td><?echo $dB[varian]?></td>
				                                    <td><?echo $dB[warna]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[utitipan],"0","",".")?></span></td>
				                                    <td><?echo $dC[namaleasing]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?if(empty($dA[termin])){echo "-";}else{echo number_format($dA[termin],"0","",".");}?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?if(empty($dA[angsuran])){echo "-";}else{echo number_format($dA[angsuran],"0","",".");}?></span></td>
				                                    <td align="center"><?echo $statusleasing?></td>
				                                    <td><?echo $batal?></td>
				                                   	<td align="center">
					                                <?
					                                	$qH = mysql_query("SELECT tanggal FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
													?>
															<?echo date("d-m-Y",strtotime($dH[tanggal]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qH = mysql_query("SELECT namaleasing FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
													?>
															<?echo $dH[namaleasing]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
			                                   		<td>
					                                <?
					                                	$qH = mysql_query("SELECT unit FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
													?>
															<?echo $dH[unit]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
			                                   		<td align="center">
					                                <?
					                                	$qH = mysql_query("SELECT status,ketstatus FROM tbl_hleasing_vw WHERE id_pelanggan='$d1[idpelanggan]' ORDER BY tanggal");
					                                	while($dH = mysql_fetch_array($qH))
					                                		{
							                            	if($dH[status]=='1'){
																$statusvw = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:100px'>Disetujui</span>";
																}
															else{
																$statusvw = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:100px'>Ditolak</span>";
																}
													?>
															<?echo $statusvw?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
													<?
															}
														if(empty($dH[tanggal])){echo "-";}
					                                ?>	
				                                	</td>
				                                </tr>
				                                
				                            <?
												$no++;
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <th colspan="29">&nbsp;</th>
				                                </tr>
				                            </tfoot>
				                        </table>
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