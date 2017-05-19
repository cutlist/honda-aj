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
			                	<h4>AKTIVITAS BISNIS <small>PEMBELIAN UNIT</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:right;width:45%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" placeholder="Pilih Periode Tanggal Nota Beli" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
												<?
												if($_SESSION[posisi]=='DIREKSI')
													{
												?>
													<button type="button"  onclick="window.open('print/h1/abis_pembelian.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
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
				                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:350%;padding-right:20px">
											<thead>
												<tr>
												<!--
													<th>NO.</th>
												-->
													<th>TGL NOTA BELI</th>
													<th>NO. NOTA BELI</th>
													<th>TGL FAKTUR</th>
													<th>NO. FAKTUR</th>
													<th>TGL SURAT PESANAN</th>
													<th>NO. SURAT PESANAN</th>
													<th>KODE BARANG</th> 
													<th>NAMA BARANG</th>
													<th>VARIAN</th> 
													<th>WARNA</th>
													<th>NOSIN</th> 
													<th>NOKA</th> 
													<th>HARGA BELI (RP)</th> 
													<th>GRAND TOTAL TIBA (RP)</th> 
													<th>GRAND TOTAL TIBA + PPN (RP)</th> 
													<th>TOTAL PEMBAYARAN (RP)</th> 
													<th>TOTAL BUNGA (RP)</th> 
													<th>LOKASI GUDANG</th>
													<th>TGL MASUK GUDANG</th> 
													<th>STATUS PEMBAYARAN KE SUPPLIER</th>
													<th>TGL NOTA RETUR BELI</th> 
													<th>NO NOTA RETUR BELI</th> 
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											
											$no=1;
											$q1 = mysql_query("SELECT * FROM tbl_notabeli_det_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND nodo!=''");
				                            while($d1 = mysql_fetch_array($q1))
				                            	{				             
				                            	$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));    
				                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM tbl_stokunit_vw WHERE norangka='$d1[norangka]'"));
				                            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_notabeli WHERE nonota='$d1[nonota]'"));
				                            	$dD = mysql_fetch_array(mysql_query("SELECT * FROM tbl_returbeli WHERE nodo='$d1[nodo]'"));
				                            	if($dC[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'> Bayar</span>";}
				                            	else if($dC[status]=="0"){$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";}
				                            	if(empty($dD[nodo])){
				                            		$tglreturbeli = "-";
				                            		$noretur = "-";}
				                            	else{$tglreturbeli = date("d-m-Y",strtotime($dD[tanggal]));$noretur = $dD[noretur];}
												
				                            	$bungax = $dC[bayar]-$dC[gtbayar]-$dC[gtbayarppn];
				                            	if($bungax > 0){
													$bunga = $bungax;
													}
												else{
													$bunga = '0';
													}
				                            	
				                            ?>
				                                <tr style="cursor:pointer">
													<!--
				                                    <td align="right"><span style="padding-right:20%"><?echo $no."."?></span></td>
													-->
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
				                                    <td align="center"><?echo $d1[nonota]?></td>
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tgldo]))?></td>
				                                    <td align="center"><?echo $d1[nodo]?></td>
				                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
				                                    <td align="center"><?echo $d1[nopo]?></td>
				                                    <td><?echo $dA[kodebarang]?></td>
				                                    <td><?echo $dA[namabarang]?></td>
				                                    <td><?echo $dA[varian]?></td>
				                                    <td><?echo $dA[warna]?></td>
				                                    <td><?echo $dB[nomesin]?></td>
				                                    <td><?echo $d1[norangka]?></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargabelibersih],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dC[gtbayar],"0","",".")?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($dC[gtbayar]+$dC[gtbayarppn],"0","",".")?></span></td>
			                                    	<td align="right"><span style="padding-right:20%"><?if(empty($dC[bayar])){echo "-";}else{echo number_format($dC[bayar],"0","",".");}?></span></td>
				                                    <td align="right"><span style="padding-right:20%"><?echo number_format($bunga,"0","",".")?></span></td>
				                                    <td><?echo $dB[gudang]?></td>
				                                    <td align="center"><?echo date("d-m-Y",strtotime($dB[tgltiba]))?></td>
				                                    <td align="center"><?echo $status?></td>
				                                    <td align="center"><?echo $tglreturbeli?></td>
				                                    <td align="center"><?echo $noretur?></td>
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