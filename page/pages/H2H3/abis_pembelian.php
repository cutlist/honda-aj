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
			                	<h4>AKTIVITAS BISNIS <small>RINGKASAN PEMBELIAN</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:LEFT;width:50%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" required style="height:33px" placeholder="Pilih Periode Tanggal Nota Beli" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
	                           		<div style="float:right" class="col-xs-5">
										<?
										if($_SESSION[posisi]=='DIREKSI')
											{
										?>
											<button type="button"  onclick="window.open('print/h2/abis_pembelian.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{     
	                            	mysql_query("TRUNCATE temp_x23_abispenjualan");
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:350%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="19" style="font-size:14px"><b><center>RINGKASAN PEMBELIAN SPARE PARTS</center></b></td>
												<td colspan="10" style="font-size:14px"><b><center>RINGKASAN RETUR BELI</center></b></td>
											</tr>
											<tr>
												<th>TGL NOTA BELI</th>
												<th>NO. NOTA BELI</th>
												<th>TGL PO</th>
												<th>NO. PO</th>
												<th>NAMA SUPPLIER</th>
												<th>KODE BARANG</th>
												<th>NAMA BARANG</th>
												<th>VARIAN</th>
												<th>QTY BELI (PCS)</th>
												<th>HARGA BELI (RP)</th> 
												<th>JUMLAH BELI (RP)</th>
												<th>TOTAL PEMBELIAN (RP)</th>
												<th>TOTAL PEMBELIAN + PPN (RP)</th>
												<th>STATUS PEMBAYARAN KE SUPPLIER</th>
												<th>TOTAL PEMBAYARAN KE SUPPLIER (RP)</th>
												<th>TOTAL BUNGA (RP)</th>
												<th>LOKASI GUDANG AWAL</th>
												<th>TANGGAL MASUK GUDANG</th>
												<th>LOKASI RAK AWAL</th>
												<th>TGL NOTA RETUR BELI</th>
												<th>NO. NOTA RETUR BELI</th>
												<th>QTY RETUR BELI (PCS)</th>
												<th>JUMLAH RETUR BELI (RP)</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
										$no = 1;
										$q1 = mysql_query("SELECT * FROM x23_notabeli_vw WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND substr(nonota,1,2)='NB'");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			            					if(strlen($no)==1)
			            						{
												$nostart = "00".$no;
												}
			            					else if(strlen($no)==2)
			            						{
												$nostart = "0".$no;
												}
			            					else if(strlen($no)==3)
			            						{
												$nostart = $no;
												}
												
			                            	if($d1[status]=="1"){$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;width:90px'>Lunas</span>";}
			                            	if($d1[status]=="0"){
			                            		if($d1[gtbayar] >= $d1[bayar]){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Sebagian</span>";
													}
			                            		if($d1[bayar]=="0" || empty($d1[bayar])){
			                            			$status = "<span class='btn btn-danger' style='padding:0px 10px;font-size:12px;width:90px'>Belum Bayar</span>";
													}
			                            		}
			                            		
											$bungaX = $d1[bayar]-$d1[gtbayar];
											if($bungaX <= 0){
												$bunga = '0';
												}
											else{
												$bunga = $bungaX;
												}
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglpo]))?></td>
			                                    <td align=""><?echo $d1[nopo]?></td>
			                                    <td align=""><?echo $d1[nama]?></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[kodebarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[namabarang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[varian]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <span style="padding-right:30%"><?echo number_format($dA[qty],"0","",".")?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <span style="padding-right:20%"><?echo number_format($dA[hargabelibersih],"0","",".")?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <span style="padding-right:20%"><?echo number_format($dA[total],"0","",".")?></span><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotal],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[grandtotalppn],"0","",".")?></span></td>
			                                    <td align="center"><?echo $status?></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($d1[bayar])){echo "-";}else{echo $d1[bayar];}?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?if(empty($bunga)){echo "-";}else{echo number_format($bunga,"0","",".");}?></span></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[gudang]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="center">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
				                            		if($dA[tgltiba]!="0000-00-00")
				                            			{
				                            	?>
				                            			<?echo date("d-m-Y",strtotime($dA[tgltiba]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
				                            	<?
														}
													else{
														echo "-";
														}
													}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            ?>
						                               <?echo $dA[rak]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="center">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                            	if(!empty($dB[noretur]))
					                           			{
					                            ?>
						                               <?echo date("d-m-Y",strtotime($dB[tanggal]))?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                           		if(!empty($dB[noretur]))
					                           			{
					                            ?>
						                               <?echo $dB[noretur]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                           		if(!empty($dB[noretur]))
					                           			{
					                            ?>
			                                    		<span style="margin-right:30%"><?echo number_format($dB[qty],"0","",".")?></span>
					                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
				                                $hit=1;
												$qA = mysql_query("SELECT * FROM x23_notabeli_det2_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_returbeli_det WHERE nonota='$d1[nonota]' AND idbarang='$dA[idbarang]' AND idgudang='$dA[idgudang]' AND rak='$dA[rak]'"));
					                           		if(!empty($dB[noretur]))
					                           			{
					                            ?>
			                                    		<span style="margin-right:30%"><?echo number_format($dA[total],"0","",".")?></span>
					                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            		$hit++;
					                            		}
					                            	}
					                            if($hit=="1"){echo "-";}
				                                ?>	
			                                	</td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
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
                    "bPaginate": false,
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