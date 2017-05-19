<?
	if($submenu == 'A')
		{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>SERVIS <small>ARUS SERVIS</small></h4>	 
                                    <div style="float:right;width:35%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="<?echo date("d-m-Y")." s.d. ".date("d-m-Y")?>"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation" readonly=""/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
			                        <table id="example4" class="table table-bordered table-striped table-hover">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th width="" style="padding:7px">KETERANGAN</th>
			                                    <th width="25%" style="padding:7px"><center>TOTAL</center></th>
			                                </tr>
			                            </thead>
										<?
										if(!empty($pecah))
											{
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
				                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
											}
										else
											{
				                            $periode_awal  = date("Y-m-d");
				                            $periode_akhir = date("Y-m-d");
											}
											
											
										$dA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scanmasuk WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir'"));
										if(empty($dA[total])){
											$a = "-";
											}
										else{
											$a = round($dA[total]/2)." Unit";
											}
											
										$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir'"));
										if(empty($dB[total])){
											$b = "-";
											}
										else{
											$b = "$dB[total] Unit";
											}
											
										$dC = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND status!='0'"));
										if(empty($dC[total])){
											$c = "-";
											}
										else{
											$c = "$dC[total] Unit";
											}
											
										$dD = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_scankeluar WHERE id%2=0 AND tanggal BETWEEN '$periode_awal' AND '$periode_akhir'"));
										if(empty($dD[total])){
											$d = "-";
											}
										else{
											$d = round($dD[total]/2)." Unit";
											}
											
										$dF = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS total FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$periode_awal' AND '$periode_akhir' AND status='2'"));
										if(empty($dF[total])){
											$f = "-";
											}
										else{
											$f = "$dF[total] Unit";
											}
											
										$nginep = round($dA[total]/2)-round($dD[total]/2);
										if(empty($nginep)){
											$e = "-";
											}
										else{
											$e = "$nginep Unit";
											}
										?>
			                            <tbody>
			                                <tr>
												<td>Jumlah Motor Mulai Servis <?//echo "$dA[total]-$dD[total]"?></td>
												<td align="right"><span style="margin-right:30%"><?echo $b?></span></td>
			                                </tr>
			                                <tr>
												<td>Jumlah Motor Masuk Bengkel</td>
												<td align="right"><span style="margin-right:30%"><?echo $a?></span></td>
			                                </tr>
			                                <tr>
												<td>Jumlah Motor Keluar Bengkel</td>
												<td align="right"><span style="margin-right:30%"><?echo $d?></span></td>
			                                </tr>
			                                <tr>
												<td>Jumlah Motor Selesai Servis</td>
												<td align="right"><span style="margin-right:30%"><?echo $c?></span></td>
			                                </tr>
			                                <tr>
												<td>Jumlah Kwitansi Servis</td>
												<td align="right"><span style="margin-right:30%"><?echo $f?></span></td>
			                                </tr>
			                                <tr>
												<td>Jumlah Motor Menginap</td>
												<td align="right"><span style="margin-right:30%"><?echo $e?></span></td>
			                                </tr>
			                            </tbody>
			                        </table>
									
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
<?
		}
?>