<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[input1]))
			{
			$tgltagihan   = date("Y-m-d", strtotime($_REQUEST['tgltagihan']));
			$q1 = mysql_query("UPDATE x23_notaservice_det SET tgltagihan='$tgltagihan',idtagihan='$_SESSION[id]' WHERE id='$_REQUEST[input1]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notaservice_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'KIRIM TAGIHAN SERVIS KPB KE MPM $_REQUEST[nonota]')
								");
			}
		if(!empty($_REQUEST[input2]))
			{
			$tglbayarkpb     = date("Y-m-d", strtotime($_REQUEST['tglbayarkpb']));
			$jumlahbayarkpb  = preg_replace( "/[^0-9]/", "",$_REQUEST['jumlahbayarkpb']);
			
			if($jumlahbayarkpb != $_REQUEST[total]){
				$status = "0";
				}
			if($jumlahbayarkpb == $_REQUEST[total]){
				$status = "1";
				}
				
			//echo "<script>alert ('$jumlahbayarkpb.$_REQUEST[total]')</script>";
			//exit();
				
			$q1 = mysql_query("UPDATE x23_notaservice_det SET tglbayarkpb='$tglbayarkpb',jumlahbayarkpb='$jumlahbayarkpb',idbayar='$_SESSION[id]',statusbayar='1' WHERE id='$_REQUEST[input2]'");
			
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'x23_notaservice_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR SERVIS KPB DARI MPM $_REQUEST[nonota]')
								");
			
			if($jumlahbayarkpb != $_REQUEST[total])
				{
				$p_tahun = date("Y");
				$p_bulan = date("m");
				mysql_query("INSERT INTO x23_abis_ikesalahan (
												idnotaservicedet, 
												tahun, 
												bulan, 
												tanggal,
												kasus, 
												tbl,
												inputx) 
											VALUES (
												'$_REQUEST[input2]', 
												'$p_tahun', 
												'$p_bulan', 
												CURDATE(), 
												'INDIKASI KESALAHAN : JUMLAH SERVIS KPB YANG DIBAYAR MPM TIDAK SAMA DENGAN JUMLAH TAGIHANNYA', 
												'x23_notaservice_det', 
												NOW())
							");
				}
				
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&save=1&periode=$_REQUEST[periode]'/>";
			exit();
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
                           		<div class="tab-content">	
				                	<h4>ADMINISTRASI <small>BUAT KWITANSI PENAGIHAN SERVIS KPB KE MPM <?//echo $_SESSION[id]?></small></h4>	
	                                    <div style="float:right;width:85%">
					                   	<form method="post" action="" enctype="multipart/form-data">
	                                    	<table width="100%">
	                                    		<tr>
	                                    			<td>
														<a href="<?echo "?opt=$opt&menu=$menu&submenu=B"?>" style="cursor:pointer">
					                           				<button type="button" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> &nbsp; Buat Kwitansi Penagihan KPB ke MPM Hari Ini</button>
														</a>
	                                    			</td>
	                                    			<td>
	                                       	 			<div class="input-group">
				                                            <div class="input-group-addon">
				                                                <i class="fa fa-calendar"></i>
				                                            </div>
			                                            	<input type="text" name="periode" style="height:33px" placeholder="Pilih Periode Tanggal Penagihan Ke MPM" class="form-control pull-right" id="reservation"/>
			                                            </div>
	                                    			</td>
	                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
	                                    			</td>
	                                    		</tr>
	                                    	</table>
	                                    </form>
										</div>
										
			                        	<table id="example2" class="table table-bordered table-striped table-hover" style="width:100%">
											<thead>
												<tr>
													<th>NO. KWITANSI PENAGIHAN</th>
													<th>TANGGAL PENAGIHAN KE MPM</th>
													<th>TOTAL KPB</th>
													<th>JUMLAH TAGIHAN (RP)</th>
													<th>JUMLAH TAGIHAN (-2%) (RP)</th>
													<th width="1%">CETAK</th>
												</tr>
											</thead>
				                            <tbody>
				                            <?
				                            $no = 1;
				                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
				                            $periode_awal  = date("Y-m-d",strtotime($pecah[0]));
				                            $periode_akhir = date("Y-m-d",strtotime($pecah[1]));
				                            if(!empty($_REQUEST[periode]))
				                            	{
												$q1 = mysql_query("SELECT tglpenagihan,COUNT(id) AS qty,SUM(jumlahtagih) AS jumlahtagih,SUM(jumlahtagih2) AS jumlahtagih2,nokwitansi FROM x23_kwitansikpb_vw WHERE tglpenagihan BETWEEN '$periode_awal' AND '$periode_akhir' GROUP BY nokwitansi ORDER BY nokwitansi");
												}
				                           else
				                            	{
												$q1 = mysql_query("SELECT tglpenagihan,COUNT(id) AS qty,SUM(jumlahtagih) AS jumlahtagih,SUM(jumlahtagih2) AS jumlahtagih2,nokwitansi FROM x23_kwitansikpb GROUP BY nokwitansi ORDER BY nokwitansi DESC LIMIT 0,20");
												}
				                            
											while($d1 = mysql_fetch_array($q1))
				                            	{
				                            	if($no%2==0){
				                            ?>
				                                <tr style="cursor:pointer">
				                                	<td align="center"><?echo $d1[nokwitansi]?></td>
				                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglpenagihan]))?></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[qty],"0","",".")?></span></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahtagih],"0","",".")?></span></td>
			                                		<td align="right"><span style="padding-right:20%"><?echo number_format($d1[jumlahtagih2],"0","",".")?></span></td>
			                                		<td align="center"><i class="fa fa-print" onclick="window.open('printaj/kwitansikpb.php?nokwitansi=<?echo $d1[nokwitansi]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')"></i></td>
				                                </tr>
				                            <?
												}
				                            	$no++;
				                            	}
				                            ?>
				                            </tbody>
				                            <tfoot>
				                                <tr>
				                                    <td colspan="8">&nbsp;</td>
				                                </tr>
				                            </tfoot>
				                        </table>
				                        
			                    	</div>
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
				
			        </div>
				</section>
			</aside>
<?
		}
		
	if($submenu == 'B')
		{
		$p_tahun  = date("Y");
		$p_tahun2 = date("y");
		$p_bulan  = date("m");
		$p_tgl    = date("d");
		
        $dNB = mysql_fetch_array(mysql_query("SELECT nokwitansi FROM x23_kwitansikpb WHERE tglpenagihan=CURDATE() ORDER BY SUBSTR(nokwitansi,-3,3) DESC LIMIT 1"));
            
		if(empty($dNB[nokwitansi]))
			{
			$dig3=1;
			$dig2=0;
			$dig1=0;	
			}
		else
			{
			$x=substr("$dNB[nokwitansi]",-3,3);
			$dig3 = substr($x,-1,1)+1;
			$dig2 = substr($x,-2,1);
			$dig1 = substr($x,-3,1);
			
			if ($dig3>9)
				{
				$dig3=0;
				$dig2=$dig2+1;
				}
			else
				{
				$dig3=$dig3;
				}
			
			if ($dig2>9)
				{
				$dig2=0;
				$dig1=$dig1+1;
				}
			else
				{
				$dig2=$dig2;
				}
			
			if ($dig1>9)
				{
				echo "kode habis";
				exit();
				}
			else
				{
				$dig1=$dig1;
				}
			}
			
			$nokwitansi = "KPK$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
			
		$q1 = mysql_query("SELECT * FROM x23_penagihankpb WHERE statuspenagihan='0' AND tglpenagihan<=CURDATE() AND nonotaservis!=''");
		while($d1 = mysql_fetch_array($q1))
			{
			mysql_query("INSERT INTO x23_kwitansikpb (
												iduser, 
												nokwitansi, 
												tglkpb, 
												nopkb, 
												nonotaservis, 
												kodepaket, 
												jumlahtagih, 
												jumlahtagih2, 
												tglpenagihan) 
											VALUES (
												'$_SESSION[id]', 
												'$nokwitansi', 
												'$d1[tglkpb]', 
												'$d1[nopkb]', 
												'$d1[nonotaservis]', 
												'$d1[kodepaket]', 
												'$d1[jumlahtagih]', 
												'$d1[jumlahtagih2]', 
												CURDATE())
						");
			
			mysql_query("UPDATE x23_penagihankpb SET statuspenagihan='1',tglpenagihan=CURDATE() WHERE id='$d1[id]'");
			}
			
		echo "			
		<script type='text/javascript'>
			window.open('printaj/kwitansikpb.php?nokwitansi=$nokwitansi','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
		</script>";
		
		print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A'/>";
		exit();
		
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
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
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