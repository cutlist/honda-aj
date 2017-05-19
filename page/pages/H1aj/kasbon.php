<?
	if($submenu == 'A')
		{
		if(!empty($_REQUEST[bayar]))
			{
			$tanggal 	= date("Y-m-d", strtotime($_POST['tanggal']));
			$p_tahun  = date("Y");
			$p_tahun2 = date("y");
			$p_bulan  = date("m");
			$p_tgl    = date("d");
				
	        $dK = mysql_fetch_array(mysql_query("SELECT kwitansicb FROM tbl_notajual_det WHERE id%2=0 AND tglbayarkomisi=CURDATE() ORDER BY SUBSTR(kwitansicb,-3,3) DESC LIMIT 1"));
	            
			if(empty($dK[kwitansicb]))
				{
				$dig3=1;
				$dig2=0;
				$dig1=0;	
				}
			else
				{
				$x=substr("$dK[kwitansicb]",-3,3);
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
				
				$kwitansicb = "KCB$p_tahun2$p_bulan$p_tgl-$dig1$dig2$dig3";
		
			$q1 = mysql_query("UPDATE tbl_notajual_det SET tglbayarkomisi='$tanggal', statuskomisi='1', kwitansicb='$kwitansicb'
			                                               WHERE id%2=0 AND id='$_REQUEST[bayar]'");
			$q2 = mysql_query("INSERT INTO log_act VALUES (										
		                                    '',
		                                    'tbl_notajual_det',
		                                    CURDATE(),
		                                    CURTIME(),
		                                    '$_SESSION[user]',
		                                    'BAYAR POTONGAN TAMBAHAN ID $_REQUEST[bayar]')
								");
								
			print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu&periode=$_REQUEST[periode]&save=1'>";
			/*
			echo "			
			<script type='text/javascript'>
				window.open('printaj/kwitansi_kasbon.php?id=$_REQUEST[bayar]','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
			</script>";
			*/
			}
			
		if(!empty($_REQUEST[periode]))
			{
            $pecah = explode(" s.d. ", $_REQUEST[periode]);
            $_SESSION[periode_awal]  = date("Y-m-d",strtotime($pecah[0]));
            $_SESSION[periode_akhir] = date("Y-m-d",strtotime($pecah[1]));
            }
        else{
            $_SESSION[periode_awal]  = date("Y-m-d");
            $_SESSION[periode_akhir] = date("Y-m-d");
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">	     
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-body table-responsive" style="width:100%;margin:0 auto;">
			                	<h4>KASIR <small>CASH BON</small></h4>	 
                                    <div style="float:right;width:45%">
				                   	<form method="post" action="" enctype="multipart/form-data">
                                    	<table width="100%">
                                    		<tr>
                                    			<td>
                                       	 			<div class="input-group">
			                                            <div class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </div>
		                                            	<input type="text" name="periode" style="height:33px" <?if(empty($_REQUEST[periode])){?>placeholder="Pilih Periode Tanggal Nota Jual"<?} else {?>value="<?echo $_REQUEST[periode]?>"<?}?>  class="form-control pull-right" id="reservation"/>
		                                            </div>
                                    			</td>
                                    			<td width="40%"><button type="submit" class="btn btn-primary pull-left"><i class="fa fa-search"></i></button>
				                           				<button type="button"  onclick="window.open('printaj/h1/kasbon.php?periode_awal=<?echo $_SESSION[periode_awal]?>&periode_akhir=<?echo $_SESSION[periode_akhir]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Export Ke Excel</button>
				                           		</td>
                                    		</tr>
                                    	</table>
                                    </form>
									</div>
									
			                        <table id="example2" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="1%"><center>TGL NOTA JUAL</center></th>
												<th width="10%">NO. NOTA JUAL</th>
												<th>BARANG</th>
												<th width="">NOMOR RANGKA</th>
												<th width="">BROKER</th>
												<th width="10%">NO. TELEPON BROKER</th>
												<th width="10%">POTONGAN TAMBAHAN (RP)</th>
												<th width="10%">STATUS</th>
												<th width="5%">CETAK</th>
											</tr>
										</thead>
			                            <tbody>
			                            <?
			                            
			                            //echo  $_SESSION[periode_awal].$_SESSION[periode_akhir];
			                            
										$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE id%2=0 AND ref!='' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
										while($d1 = mysql_fetch_array($q1))
			                            	{
			                            	$dBrg = mysql_fetch_array(mysql_query("SELECT * FROM tbl_masterbarang WHERE id='$d1[idbarang]'"));
			                            	if($d1[statuskomisi]=='0'){
						                        $statuskomisi = "<span data-toggle='modal' data-target='#compose-modal-bayar$d1[id]' class='btn btn-danger' style='padding:0px 10px;font-size:12px;'>Belum Bayar</span>";
												}
											else{
						                        $statuskomisi = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Terbayar</span>";
												}
			                            ?>
											<script type="text/javascript">
												var s5_taf_parent = window.location;
												function popup_print<?echo $d1[id]?>(){
													window.open('printaj/kwitansi_kasbon.php?id=<?echo $d1[id]?>','page','toolbar=0,titlebar=0,fullscreen=0,directories=0,channelmode=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1,height=1,left=150,top=100')
													}
											</script>
			                                <tr style="cursor:pointer">
			                                	<td align="center"><?echo date("d-m-Y",strtotime($d1[tglnota]))?></td>
			                                	<td align="center"><?echo $d1[nonota]?></td>
			                                	<td align="left"><?echo "$dBrg[namabarang] $dBrg[warna]"?></td>
			                                	<td align="center"><?echo $d1[norangka]?></td>
			                                	<td align="left"><?echo $d1[ref]?></td>
			                                	<td align="left"><?echo $d1[notelpref]?></td>
			                                	<td align="right"><span style="padding-right:20%"><?echo number_format($d1[komisi],"0","",".")?></span></td>
			                                	<td align="center"><?echo $statuskomisi?></td>
			                                    <td width="6%" align="center">
			                            <?
			                            	if($d1[statuskomisi]=='0')
			                            		{
												}
											else
												{
										?>
										
			                                        <a href="#" onClick="popup_print<?echo $d1[id]?>()"><i class="fa fa-print"></i></a>
										<?		
												}
			                            ?>
			                                        </td>
			                            
			                                </tr>
			                                
			                            <?
			                            	}
			                            ?>
			                            </tbody>
			                            <tfoot>
			                                <tr>
			                                    <th colspan="10">&nbsp;</th>
			                                </tr>
			                            </tfoot>
			                        </table>
							        <?
									$q1 = mysql_query("SELECT * FROM tbl_notajual_det_vw WHERE id%2=0 AND ref!='' AND tglnota BETWEEN '$_SESSION[periode_awal]' AND '$_SESSION[periode_akhir]'");
									while($d1 = mysql_fetch_array($q1))
				                    	{
							        ?>
				<!-- ################## MODAL BAYAR ########################################################################################## -->
								        <div class="modal fade " id="compose-modal-bayar<?echo $d1[id]?>" tabindex="-1" role="dialog" aria-hidden="true">
								            <div class="modal-dialog"  style="width:600px;">
								                <div class="modal-content">
								                    <div class="modal-header">
								                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								                        <h4 class="modal-title">PEMBAYARAN POTONGAN TAMBAHAN</h4>
								                    </div>
								                    
								                   	<form method="post" action="" enctype="multipart/form-data">
							                        <div class="modal-body">
									                    <table width="100%">
									                    		<tr>
									                    			<td width="180px">BROKER</td>
									                    			<td>:</td>
									                    			<td colspan="3"><input type="text" value="<?echo $d1[ref]?>" class="form-control" style="width:90%"readonly=""></td>
									                    		</tr>
									                    		<tr>
									                    			<td>TANGGAL</td>
									                    			<td>:</td>
									                    			<td colspan="3">
									                                    <div class="input-group">
									                                        <span class="input-group-addon" style="min-width:50px;text-align:center"><i class="fa fa-calendar"></i></span>
																			<input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" style="width:35%" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="">
									                    				</div>		
																	</td>
																</tr>
									                    		<tr>
									                    			<td>POTONGAN TAMBAHAN</td>
									                    			<td>:</td>
									                    			<td colspan="3">
									                                    <div class="input-group">
									                                        <span class="input-group-addon" style="min-width:50px;text-align:center">RP.</span>
									                    					<input type="text" class="form-control" value="<?echo number_format($d1[komisi],"0","",".")?>" style="width:35%;text-align:right" " readonly="">
									                    				</div>
																	</td>
																</tr>
									                    		<input type="hidden" name="bayar" value="<?echo $d1[id]?>">
									                    		<input type="hidden" name="periode" value="<?echo $_REQUEST[periode]?>">
						                            	</table>
								               		</div>
							                        <div class="modal-footer clearfix">
							                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> &nbsp;Batal</button>
														<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								                	</div>
													</form>
								                </div>
								            </div>
								        </div>
				<!-- ################################################################################################################################# -->
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
        
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
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