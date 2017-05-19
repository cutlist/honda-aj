<?
	if($submenu == 'A')
		{
		if(empty($mod))
			{
			$dNA = mysql_fetch_array(mysql_query("SELECT noantrian FROM x23_antrian WHERE tanggal=CURDATE() ORDER BY noantrian DESC LIMIT 1"));
			if(empty($dNA[noantrian]))
				{
				$dig3=1;
				$dig2=0;	
				$dig1=0;	
				}
			else
				{
				$x=substr("$dNA[noantrian]",-3,3);
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
				
				$noantrian = "$dig1$dig2$dig3";
				
			if(!empty($_REQUEST[input]) && $noantrian=="$_REQUEST[noantrian]")
				{
				$nopol 	  = strtoupper($_REQUEST['nopol']);
        		$tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
				/*
				if($_REQUEST[noantrian]=="0001"){
					$status='1';
					}
				*/			
				$dcek = mysql_fetch_array(mysql_query("SELECT id FROM x23_antrian WHERE tanggal='$tanggal' AND jam='$_REQUEST[jam]' AND nopol='$nopol' AND status=0''"));
				if(empty($dcek[id])){
					$q1 = mysql_query("INSERT INTO x23_antrian (
														tanggal, 
														jam, 
														nopol, 
														status, 
														noantrian) 
													VALUES (
														'$tanggal', 
														'$_REQUEST[jam]', 
														'$nopol', 
														'0', 
														'$_REQUEST[noantrian]');
										");
					}	
				}
				
			if(!empty($_REQUEST[del]))
				{
				$nopol 	  = strtoupper($_REQUEST['nopol']);
        		$tanggal  = date("Y-m-d",strtotime($_REQUEST[tanggal]));
				/*
				if($_REQUEST[noantrian]=="0001"){
					$status='1';
					}
				*/			
							
				$q1 = mysql_query("DELETE FROM x23_antrian WHERE id='$_REQUEST[del]'");
						
						if($q1)
							{
							//echo "<script>alert ('Proses berhasil.')</script>";
							}
						else
							{
							echo "<script>alert ('Proses gagal.')</script>";
							print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
							exit();
							}
				}
			}
			
		else if($mod == "edit")
			{
			if(!empty($_REQUEST[ubah]))
				{	
				$dC1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice WHERE noantrian='$_REQUEST[noantrian]' AND tglnota=CURDATE() AND status='1'"));
				if(!empty($dC1[id])){
					echo "<script>alert ('Proses gagal.')</script>";
					print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
					exit();
					}
								
				$nopol 	  = strtoupper($_REQUEST['nopol']);
							
				$q1 = mysql_query("UPDATE x23_antrian SET
													nopol='$nopol'
											WHERE id='$_REQUEST[ubah]'
									");
					
					if($q1)
						{
						//echo "<script>alert ('Proses berhasil.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
					else
						{
						echo "<script>alert ('Proses gagal.')</script>";
						print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=$submenu'/>";
						exit();
						}
				}
			}
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
<?
					if(empty($mod))
						{
						$dNA = mysql_fetch_array(mysql_query("SELECT noantrian FROM x23_antrian WHERE tanggal=CURDATE() ORDER BY noantrian DESC LIMIT 1"));
			            
						if(empty($dNA[noantrian]))
							{
							$dig3=1;
							$dig2=0;	
							$dig1=0;	
							}
						else
							{
							$x=substr("$dNA[noantrian]",-3,3);
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
							
						$noantrian = "$dig1$dig2$dig3";
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>SERVIS <small>INPUT ANTRIAN</small></h4>
	                           		<div style="float:right" class="col-xs-7">
										<a data-toggle="modal" data-target="#compose-modal-baru-karyawan" style="cursor:pointer">
	                           				<button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i> &nbsp; Antrian Baru</button>
										</a>
	                           		</div>
			                        <table id="example1" class="table table-bordered table-striped">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px;width:15%"><center>NO. POLISI</center></th>
			                                    <th style="padding:7px"><center>TANGGAL SERVIS</center></th>
			                                    <th style="padding:7px"><center>WAKTU MULAI ANTRI</center></th>
			                                    <th style="padding:7px"><center>NO. ANTRIAN</center></th>
			                                    <th width="5%" style="padding:7px"><center>AKSI</center></th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM x23_antrian WHERE tanggal=CURDATE()  ORDER BY noantrian DESC");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><span style="padding-left:20%"><?echo $d1[nopol]?></span></td>
			                                    <td align="center"><?echo date("d-m-Y",strtotime($d1[tanggal]))?></td>
			                                    <td align="center"><?echo $d1[jam]?></td>
			                                    <td align="center"><?echo $d1[noantrian]?></td>
			                                    <td width="1%" align="center"><div class="btn-group">
													<?
													$dC1 = mysql_fetch_array(mysql_query("SELECT id FROM x23_notaservice WHERE noantrian='$d1[noantrian]' AND tglnota=CURDATE() AND status='1'"));
													if(empty($dC1[id])){
													?>
			                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="font-size: 2px">
			                                                <span class="caret"></span>
			                                                <span class="sr-only">Actions</span>
			                                            </button>
			                                            <ul class="dropdown-menu" role="menu" style="margin-left:-70px;font-size: 12px">
			                                            	<!--
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=view&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-search"></i>Lihat</a></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                            	<li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&del=$d1[id]"?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash-o"></i>Hapus</a></li>
			                                           	
			                                                -->
			                                                <li><a href="<?echo "?opt=$opt&menu=$menu&submenu=$submenu&mod=edit&id=$d1[id]"?>" style="cursor:pointer"><i class="fa fa-edit"></i>Ubah</a></li>
			                                            </ul>
			                                        </div>
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
			                    </div>
			                </div>
			            </div>
					
<!-- ################## MODAL TAMBAH  ########################################################################################## -->
				        <div class="modal fade " id="compose-modal-baru-karyawan" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog" style="width:45%;">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                        <h4 class="modal-title">INPUT ANTRIAN BARU</h4>
				                    </div>
											
				                   	<form method="post"  action="" enctype="multipart/form-data">
			                        <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;">
				                    	<table width="100%">
				                    		<tr>
				                    			<td width="30%">TANGGAL MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><div class="input-group">
				                                        			<span class="input-group-addon" style="width:50px"><i class="fa fa-calendar"></i></span>
				                                        			<input type="text" name="tanggal" value="<?echo date("d-m-Y")?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask required="" style="width:80%" readonly>
				                                   				</div>                                        		
				                                </td>
				                    		</tr>
				                    		<tr>
				                    			<td>JAM MASUK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><div class="input-group">    
					                                                <span class="input-group-addon" style="width:50px"><i class="fa fa-clock-o"></i></span>                                        
					                                                <input type="text"name="jam" class="form-control timepicker" value="<?echo date("H:i:s")?>" style="width:60%;cursor: pointer;" readonly/>
					                                            </div><!-- /.input group -->
					                                    	</td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR POLISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nopol" class="form-control" autofocus style="width: 50%" maxlength="10" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" height="20px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" align="center"><b>NOMOR ANTRIAN</b></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" height="20px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" align="center">
					                                <div class="inner">
					                                	<div style="text-align:center;width:280px;height:180px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
						                                	<div class="btn-danger" style="width:258px;height:158px;border-radius:5px;padding:40px;">
							                                    	<span style="font-size:52px"><b><?echo $noantrian?></b></span>
						                                    </div>
					                                    </div>
					                                </div></td>
				                    		</tr>
					                    	<input type="hidden" name="input" value="1">
					                    	<input type="hidden" name="noantrian" value="<?echo $noantrian?>">
		                            	</table>
				               		</div>
			                        <div class="modal-footer clearfix">
			                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> &nbsp;Reset</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
									</form>
				                </div>
				            </div>
				        </div>
<!-- ################################################################################################################################# -->
<?
						}
						
					else if($mod == "edit")
						{
						$d1 = mysql_fetch_array(mysql_query("SELECT * FROM x23_antrian WHERE id='$_REQUEST[id]'"));
?>
			            <div class="col-xs-12">
			                <div class="box box-danger">
			                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                	<h4>MASTER <small>KARYAWAN &nbsp; <i class="fa fa-angle-right"></i> &nbsp; Ubah Detail Karyawan</small></h4>
				                	<form method="post" action="" name="inputkaryawan" enctype="multipart/form-data">
				                	<div style="padding:20px">
				                    	<table style="width:50%;">
				                    		<tr>
				                    			<td width="30%">TANGGAL MASUK</td>
				                    			<td width="2%">:</td>
				                    			<td colspan="2"><div class="input-group">
				                                        			<span class="input-group-addon" style="width:50px"><i class="fa fa-calendar"></i></span>
				                                        			<input type="text" name="tanggal" value="<?echo date("d-m-Y",strtotime($d1[tanggal]))?>" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask readonly="" style="width:80%">
				                                   				</div>                                        		
				                                </td>
				                    		</tr>
				                    		<tr>
				                    			<td>JAM MASUK</td>
				                    			<td>:</td>
				                    			<td colspan="2"><div class="bootstrap-timepicker">
					                                            <div class="input-group">    
					                                                <span class="input-group-addon" style="width:50px"><i class="fa fa-clock-o"></i></span>                                        
					                                                <input type="text"name="jam" class="form-control" value="<?echo $d1[jam]?>" style="width:60%;" readonly/>
					                                            </div><!-- /.input group -->
					                                    </div></td>
				                    		</tr>
				                    		<tr>
				                    			<td>NOMOR POLISI</td>
				                    			<td>:</td>
				                    			<td colspan="2"><input type="text" name="nopol" class="form-control" value="<?echo $d1[nopol]?>" style="width: 50%" maxlength="10" required></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" height="20px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" align="center"><b>NOMOR ANTRIAN</b></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" height="20px"></td>
				                    		</tr>
				                    		<tr>
				                    			<td colspan="4" align="center">
					                                <div class="inner">
					                                	<a href="#" style="color:#fff">
					                                	<div style="text-align:center;width:280px;height:180px;border-radius:10px;background:#fff;padding:10px;border:1px solid #ddd">
						                                	<div class="btn-danger" style="width:258px;height:158px;border-radius:5px;padding:40px;">
							                                    	<span style="font-size:52px"><b><?echo $d1[noantrian]?></b></span>
						                                    </div>
					                                    </div>
					                                    </a>
					                                </div></td>
				                    		</tr>
					                    	<input type="hidden" name="ubah" value="<?echo $d1[id]?>">
					                    	<input type="hidden" name="noantrian" value="<?echo $d1[noantrian]?>">
		                            	</table>
				                    </div>
			                        <div class="modal-footer clearfix">
			                            <button type="button" class="btn btn-danger" onclick="location.href='<?echo "?opt=$opt&menu=$menu&submenu=$submenu"?>'"><i class="fa fa-mail-reply"></i> &nbsp;Kembali</button>
										<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i> &nbsp;Simpan</button>
				                	</div>
				                	</form>
				                </div>
			                </div>
			            </div>
<?
						}
?>
			        </div>
				</section>
			</aside>
<?
		}
?>
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
				    disableFocus: false,
				    isOpen: false,
				    minuteStep: 1,
				    modalBackdrop: false,
				    secondStep: 1,
				    showSeconds: true,
				    showMeridian: false,
				    template: 'dropdown',
                });
            });
        </script>
        <!-- urut table -->
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>