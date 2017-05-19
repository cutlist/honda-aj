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
			                	<h4>AKTIVITAS BISNIS <small>RINGKASAN MOTOR SERVIS</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
	                           		<div class="col-xs-7">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" required style="height:33px" placeholder="Pilih Periode Tanggal Kwitansi Servis" class="form-control pull-right" id="reservation"/>
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
											<button type="button"  onclick="window.open('printaj/h2/abis_motorservis.php','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
	                           			<?
	                           				}
	                           			?>
	                           		</div>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{     
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:140%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="10" style="font-size:14px"><b>JUMLAH UNIT SEPEDA MOTOR YANG DISERVIS</b></td>
											</tr>
											<tr>
												<th rowspan="2">KODE MOTOR</th>
												<th rowspan="2">NAMA MOTOR</th>
												<th rowspan="2">VARIAN</th>
												<th rowspan="2">JUMLAH MOTOR YANG DISERVIS</br>(NON JR)</th>
												<th colspan="4"><center>KARTU PERAWATAN BERKALA</center></th>
												<th rowspan="2">KONSUMEN (NON KPB)</th>
												<th rowspan="2">SERVIS JR</th>
											</tr>
											<tr>
												<th><center>1</center></th>
												<th><center>2</center></th>
												<th><center>3</center></th>
												<th><center>4</center></th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
										$no = 1;
										$q1 = mysql_query("SELECT *,COUNT(id) AS jumlah FROM x23_notaservice WHERE id%2=0 AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND statuskwitansi='1' GROUP BY kodemotor");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dA = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='1' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dB = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='2' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dC = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='3' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dD = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE kpbke='4' AND nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]')"));
			                            	$dE = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice_det1_vw WHERE nonota IN (SELECT nonota FROM x23_notaservice WHERE kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]') AND kpbke!=''"));
			            					$jumlahnonkpb = $d1[jumlah]-$dE[jumlah];
			            					$dF = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice WHERE jns='SERVIS JR' AND kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'"));
			            					
			            					$dG = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS jumlah FROM x23_notaservice WHERE jns='SERVIS JR' AND kodemotor='$d1[kodemotor]' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]' AND grandtotal='0'"));
			            					
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
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align=""><?echo $d1[kodemotor]?></td>
			                                    <td align=""><?echo $d1[tipemotor]?></td>
			                                    <td align=""><?echo $d1[varianmotor]?></td>
			                                    <td align="right"><span style="padding-right:30%"><?echo $d1[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dA[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dB[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dC[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dD[jumlah]?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $jumlahnonkpb?> UNIT</span></td>
			                                    <td align="right"><span style="padding-right:10%"><?echo $dF[jumlah]?> UNIT</span></td>
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
                $('#example3').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": true
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