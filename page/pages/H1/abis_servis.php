<?
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
			                	<h4>AKTIVITAS BISNIS <small>RINGKASAN SERVIS</small></h4>	
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    <div style="float:LEFT;width:50%">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" readonly style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="1%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
                                    			</td>
                                    		</tr>
                                    	</table>
									</div>
                                    </form>
										
	                            <?
	                            if(!empty($periode_bulan))
	                            	{     
	                            	mysql_query("TRUNCATE temp_x23_abispenjualan");
			                    ?>
			                        <table id="example2" class="table table-bordered table-striped table-hover" style="width:550%;padding-right:20px">
										<thead>
											<tr>
												<td colspan="39" style="font-size:14px"><b><center>RINGKASAN SERVIS</center></b></td>
											</tr>
											<tr>
												<th width="1px">NO.</th>
												<th>TGL NOTA SERVIS</th>
												<th>NO. NOTA SERVIS</th>
												<th>NO PKB</th>
												<th>NO POLISI PELANGGAN</th>
												<th>NAMA PELANGGAN</th>
												<th>NO. OHC</th> 
												<th>KODE MOTOR</th> 
												<th>NAMA MOTOR</th> 
												<th>VARIAN MOTOR</th> 
												<th>TAHUN MOTOR</th> 
												<th>WAKTU MASUK SERVIS</th> 
												<th>WAKTU MULAI SERVIS</th> 
												<th>WAKTU SELESAI SERVIS</th> 
												<th>WAKTU SERVIS</th> 
												<th>NAMA MEKANIK</th>
												<th>JENIS SERVIS</th>
												<th>KELOMPOK SERVIS</th>
												<th>NO. KPB</th>
												<th>KODE SERVIS</th>
												<th>NAMA SERVIS</th>
												<th>HARGA JUAL JASA SEBELUM DISKON (RP)</th> 
												<th>DISKON JASA (RP)</th> 
												<th>HARGA JUAL JASA SETELAH DISKON (RP)</th>
												<th>KODE BARANG</th>
												<th>NAMA BARANG</th>
												<th>VARIAN</th>
												<th>QTY BARANG</th>
												<th>HARGA JUAL BARANG SEBELUM DISKON (RP)</th> 
												<th>DISKON BARANG (RP)</th> 
												<th>HARGA JUAL BARANG SETELAH DISKON (RP)</th>
												<th>JUMLAH JUAL BARANG SETELAH DISKON (RP)</th>
												<th>STATUS PEMBAYARAN</th> 
												<th>NO. KWITANSI PEMBAYARAN</th> 
												<th>TOTAL JUMLAH PENJUALAN (RP)</th> 
												<th>NAMA COUNTER PART</th> 
												<th>SISA STOK</th> 
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            $pecah = explode(" s.d. ", $_REQUEST[periode]);
			                            
										$_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
										$_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
										
										$no = 1;
										$q1 = mysql_query("SELECT * FROM x23_notaservice WHERE tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
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
											
											$d2 = mysql_fetch_array(mysql_query("SELECT * FROM x23_notaservice_det1_vw WHERE nonota='$d1[nonota]'"));
											$d3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id='$d1[idpelanggan]'"));
											
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
												
											$d4 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_karyawan WHERE id='$d1[idmekanik]'"));
											
											if(!empty($d2[id])){
												$kelompokservis = "MAIN DEALER (KPB)";
												}
											else{
												$kelompokservis = "KONSUMEN (NON KPB)";
												}
												
											$d5 = mysql_fetch_array(mysql_query("SELECT * FROM x23_kwitansi_vw WHERE nomor='$d1[nonota]'"));
											if($d5[status]=="1"){
												$statuspembayaran = "SUDAH TERBAYAR";
												$nokwitansi = $d5[nokwitansi];
												$jumlahpenjualan = number_format(($d5[jumlah]),"0","",".");
												}
											else{
												$statuspembayaran = "BELUM TERBAYAR";
												$nokwitansi = "";
												$jumlahpenjualan = "";
												}
												
											$d6 = mysql_fetch_array(mysql_query("SELECT nama FROM x23_user_vw WHERE id='$d1[iduser]'"));
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td align="right"><?echo $nostart?>.</td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                    <td align=""><?echo $d1[nonota]?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $d1[nopkb]?></span></td>
			                                    <td align=""><?echo $d1[nopol]?></td>
			                                    <td align=""><?echo $d3[nama]?></td>
			                                    <td align=""><?echo $d3[ohc]?></td>
			                                    <td align=""><?echo $d1[kodemotor]?></td>
			                                    <td align=""><?echo $d1[tipemotor]?></td>
			                                    <td align=""><?echo $d1[varianmotor]?></td>
			                                    <td align="center"><?echo $d1[tahunmotor]?></td>
			                                    <td></td>
			                                    <td align="center"><?echo "$d1[tglnota] $d1[jammulai]"?></td>
			                                    <td align="center"><?echo "$d1[tglselesai] $d1[jamselesai]"?></td>
			                                    <td align="right"><span style="padding-right:0%"><?echo $durasi?></span></td>
			                                    <td align=""><?echo $d4[nama]?></td>
			                                    <td align=""><?echo $d1[jns]?></td>
			                                    <td align=""><?echo $kelompokservis?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $d2[kpbke]?></span></td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
						                        ?>
						                                    <?echo $dA[kodepaket]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                                
					                            <?
														}
													else
														{
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_masterjasa WHERE id='$dA[idjasa]'"));
					                            ?>
						                                    <?echo $dB[kodejasa]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
														}
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
					                            	if(!empty($dA[kodepaket]))
					                            		{
						                            	if(!empty($dB[kpbke]))
						                            		{
															$kpbke = "KPB KE $dB[kpbke] - ";
															}
														$dB = mysql_fetch_array(mysql_query("SELECT * FROM x23_kelompokjasa WHERE kode='$dA[kodepaket]'"));
						                        ?>
						                                    <?echo $kpbke.$dB[nama]?><div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                                
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
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[tarifasli],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[diskon],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notaservice_det WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[tarif],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td>
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
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
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
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
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
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
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[qty],"0","",".")?> PCS</span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[hargajual],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[diskon],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[hargajualbersih],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                	</td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dA[total],"0","",".")?></span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
				                                ?>	
			                                    <td align=""><?echo $statuspembayaran?></td>
			                                    <td align=""><?echo $nokwitansi?></td>
			                                    <td align="right"><span style="padding-right:20%"><?echo $jumlahpenjualan?></span></td>
			                                    <td align=""><?echo $d6[nama]?></td>
			                                    <td align="right">
				                                <?
												$qA = mysql_query("SELECT * FROM x23_notajual_det_vw WHERE nonota='$d1[nonota]'");
					                            while($dA = mysql_fetch_array($qA))
					                            	{
													$dB = mysql_fetch_array(mysql_query("SELECT SUM(totalstok) AS stok FROM x23_stokpart_group_vw WHERE idbarang='$dA[idbarang]' GROUP BY idbarang"));
						                        ?>
				                                    		<span style="margin-right:30%"><?echo number_format($dB[stok],"0","",".")?> PCS</span>
						                                    <div style="border-bottom:1px #aaa dashed;margin:0"></div>
					                            <?	
					                            	}
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
			                    	</br></br>
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