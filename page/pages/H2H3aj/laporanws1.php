<?
	if($submenu == 'A')
		{
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/h2/laporanws1.php?periode_awal=<?echo $_SESSION[periode_awal]?>&periode_akhir=<?echo $_SESSION[periode_akhir]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>LAPORAN PENJUALAN WORKSHOP SUMA </small></h4>	 
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Nota Jual" class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
										
			                        <table id="example2" class="table table-bordered table-striped" style="width:100%">
										<thead>
											<tr>
												<th rowspan="2" width="15%"><center>NO. NOTA JUAL</center></th>
												<th rowspan="2" width="12%"><center>TGL NOTA JUAL</center></th>
												<th rowspan="2" width="12%"><center>JUMLAH JUAL (RP)</center></th>
												<th colspan="2"><center>PEMBAYARAN (RP)</center></th>
												<!--
												<th colspan="3"><center>JENIS JASA PEKERJAAN</center></th>
												-->
												<th colspan="2"><center>PEMAKAIAN SPARE PART (RP)</center></th>
											</tr>
											<tr>
												<th width="12%"><center>CASH</center></th>
												<th width="12%"><center>UANG MUKA</center></th>
												<!--
												<th width="8%"><center>SERVIS JR</center></th>
												<th width="8%"><center>KPB</center></th>
												<th width="8%"><center>NON KPB</center></th>
												-->
												<th width="12%"><center>S. PART</center></th>
												<th width="12%"><center>OLI</center></th>
											</tr>
										</thead>
			                            <tbody>
			                <?
										if(empty($_REQUEST[periode]))
											{
											$_SESSION[periode_awal]  = date("Y-m-d");
											$_SESSION[periode_akhir] = date("Y-m-d");
											}
										else if(!empty($_REQUEST[periode]))
											{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            
											$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
											$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
											}
											
										$dA = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1a WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'"));
										$dB = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1a WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND jns='SPARE PART'"));
										$dC = mysql_fetch_array(mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1a WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND jns='OLI'"));
										
										$q1 = mysql_query("SELECT *,SUM(total) AS total FROM x23_notajual_det_ws1a WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' GROUP BY nonota");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
											/*
											if(!empty($d1[total])){
												$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi WHERE id%2=0 AND nomor='$d1[nonota]'"));
												if($d2[status]=="0"){
													$cash = "0";
													}
												if($d2[status]=="1"){
													$cash = number_format($d2[pembulatan],"0","",".");
													}
												}
											else{
												$cash = "0";
												}
											*/
												
											$d3 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_notajual_det_ws1a WHERE id%2=0 AND nonota='$d1[nonota]' AND jns='SPARE PART'"));
											$d4 = mysql_fetch_array(mysql_query("SELECT SUM(total) AS total FROM x23_notajual_det_ws1a WHERE id%2=0 AND nonota='$d1[nonota]' AND jns='OLI'"));
											
			                ?>
			                                <tr style="cursor:pointer">
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%">0</span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d3[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d4[total],"0","",".")?></span></td>
			                                </tr>
			                <?
			                				}
			                ?>
			                            </tbody>
			                            <tfoot>
			                                <tr style="cursor:pointer">
			                                    <td colspan="2" align="right"><span style="padding-right:20%"><b>TOTAL</span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dA[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><b>0</span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dB[total],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><b><?echo number_format($dC[total],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
		
	else if($submenu == 'B')
		{
?>
			<script type="text/javascript">
				var s5_taf_parent = window.location;
				function popup_print(){
					window.open('printaj/pndharianpenjualan.php?periode=<?echo $_REQUEST[periode]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
					}
			</script>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:auto;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>PENDAPATAN HARIAN <i class="fa fa-angle-right"></i> BARANG</small></h4>	 
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation" readonly=""/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button></td>
                                    			<td width="1%"><a href="#" onClick="popup_print()"><button type="button" class="btn btn-danger pull-left"><i class="fa fa-print"></i> Export Ke Excel</button></a></td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
			                        <table id="example2" class="table table-bordered table-striped" style="width:130%">
										<thead>
											<tr>
												<th width="3%"><center>NO.</center></th>
												<th width="5%"><center>TGL NOTA JUAL</center></th>
												<th width="10%"><center>NO. NOTA JUAL</center></th>
												<th width=""><center>KODE BARANG</center></th>
												<th width=""><center>BARANG</center></th>
												<th width="10%"><center>HARGA JUAL (RP) (RP)</center></th>
												<th width="7%"><center>QTY JUAL (PCS)</center></th>
												<th width="10%"><center>DISKON (RP)</center></th>
												<th width="10%"><center>JUMLAH JUAL (RP)</center></th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
			                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
			                            
			                            $no=1;
										if(empty($_REQUEST[periode]))
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND tglnota=CURDATE() AND nonota IN (SELECT nonota FROM x23_notajual WHERE id%2=0 AND tglnota=CURDATE())");
											$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																					SUM(diskon) AS b,
																					SUM(total) AS c
																				FROM x23_notajual_det WHERE id%2=0 AND tglnota=CURDATE() AND nonota IN (SELECT nonota FROM x23_notajual WHERE id%2=0 AND tglnota=CURDATE())"));
											}
										else
											{
			                            	$q1 = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nonota FROM x23_notajual WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir')");
											$dA = mysql_fetch_array(mysql_query("SELECT SUM(qty) AS a,
																					SUM(diskon) AS b,
																					SUM(total) AS c
																				FROM x23_notajual_det WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND nonota IN (SELECT nonota FROM x23_notajual WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir')"));
			                            	}
			                            while($d1 = mysql_fetch_array($q1))
			                            	{											
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><span style="padding-right:20%"><?echo "$no."?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align=""><?echo $d1[kodebarang]?></td>
			                                    <td align=""><?echo "$d1[namabarang] | $d1[varian]"?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[hargajual],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[diskon],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo number_format($d1[total],"0","",".")?></span></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="19"></th>
			                                </tr>
			                                <tr>
			                                    <td colspan="6" style="text-align:center;font-weight:bold">TOTAL (RP) : </td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[a],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[b],"0","",".")?></span></td>
			                                    <td align="right"><span style="padding-right:20%;font-weight:bold"><?echo number_format($dA[c],"0","",".")?></span></td>
			                                </tr>
			                            </tfoot>
			                        </table>
			                        
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
?>
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