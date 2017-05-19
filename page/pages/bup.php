<?			
if($submenu == 'C')
	{	
	if(!empty($_REQUEST[res]))
		{
			//BACKUP DATABASE SEBELUMNYA
			$kode = date("ymd-his");
			$q1 = mysql_query("SELECT table_name AS tabel FROM information_schema.tables WHERE table_schema = DATABASE()");
			while($d1=mysql_fetch_array($q1))
				{
					$qA = mysql_query("SELECT * FROM $d1[tabel] INTO OUTFILE 'D:/Backup Database SIHONDA/$kode-$d1[tabel].sql'");
				}
				
			//BERSIHKAN TABEL
			$q2 = mysql_query("SELECT table_name AS tabel FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name!='tbl_bup'");
			while($d2=mysql_fetch_array($q2))
				{
					$qA = mysql_query("TRUNCATE $d2[tabel]");
				}
				
			//RESTORE DATABASE
			$q3 = mysql_query("SELECT table_name AS tabel FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name!='tbl_bup'");
			while($d3=mysql_fetch_array($q3))
				{
					$qA = mysql_query("LOAD DATA INFILE 'D:/Backup Database SIHONDA/$_REQUEST[res]-$d3[tabel].sql' INTO TABLE $d3[tabel]");
				}
				
			$qx = mysql_query("INSERT INTO tbl_bup VALUES ('','$kode',NOW(),'$updatex')");
			if($qx)
				{
				//echo "<script>alert ('Proses Backup Dan Restore Berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=2'/>";
				exit();
				}
		}
	}
	
if($submenu == 'B')
	{	
	if(!empty($_REQUEST[tanggal]))
		{
			$kode = date("ymd-his");
			//echo $_REQUEST['tanggal'];exit();
			$q1 = mysql_query("SELECT table_name AS tabel FROM information_schema.tables WHERE table_schema = DATABASE()");
			while($d1=mysql_fetch_array($q1))
				{
					$qA = mysql_query("SELECT * FROM $d1[tabel] INTO OUTFILE 'D:/Backup Database SIHONDA/$kode-$d1[tabel].sql'");
				}
				
			$q2 = mysql_query("INSERT INTO tbl_bup VALUES ('','$kode',NOW(),'$updatex')");
			if($q2)
				{
				//echo "<script>alert ('Proses Backup Berhasil.')</script>";
				print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=A&note=1'/>";
				exit();
				}
		}
	}
	
if($submenu == 'A')
	{
?>
			<aside class="right-side">
			    <section class="content">
			        <div class="row">
			            <div class="col-xs-12">		                
			                <div class="box box-danger" style="overflow-x:hidden;overflow-y:auto;height:520px;">
			                    <div class="box-header">
			                        <h3 class="box-title">Backup Database</h3>                                    
			                    </div><!-- /.box-header -->
									<?
									if(!empty($_REQUEST[note]))
										{
										if($_REQUEST[note]=="1")
											{
											$ket = "<p>Proses Backup Berhasil!</p>";
											}
										if($_REQUEST[note]=="2")
											{
											$ket = "<p>Proses Backup Dan Restore Berhasil!</p>";
											}
				
									?>
	                                    <div class="alert alert-danger alert-dismissable" style="margin-top:15px;margin-bottom:5px;">
	                                        <i class="fa fa-warning"></i>
	                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                        <b>Catatan!</b>
	                                        <?echo $ket?>
	                                    </div>
									<?
										}
									?>
			                    
			                    <div class="box-body table-responsive" style="width:75%;margin:0 auto">
		                            <div class="small-box bg-green" style="width:100%;margin:0 auto;margin-bottom:30px;cursor: pointer;"">
		                                <div class="inner">
		                                    <h3>
		                                        Hari Ini
		                                    </h3>
		                                    <p>
		                                       Tanggal <b><?echo date("d")?></b> Bulan <b><?echo date("m")?></b> Tahun <b><?echo date("Y")?></b>
		                                    </p>
		                                </div>
		                                <div class="icon" style="margin-bottom:-20px">
		                                    <i class="fa fa-archive" style="font-size:70px"></i>
		                                </div>
		                                <!--
		                                <a href="#" class="small-box-footer">
		                                   	Backup Database <i class="fa fa-arrow-circle-down"></i>
		                                </a>
		                                -->
		                            </div>
		                            <h5>Lokasi Data Hasil Backup "F:\Backup Database SIHONDA\"</h5></br>
                                    
				                    <form method="POST" action="<?echo "?opt=$opt&menu=$menu&submenu=B&res=$d2[kode]"?>" enctype="multipart/form-data">
				                    	<table border="0" width="100%" style="margin: 0 auto">
				                    		<tr>
				                    			<input type="hidden" name="tanggal" value="<?echo date("Ymd")?>">
												<td align="center"><button type="submit" class="btn btn-warning" onclick="return confirm('Backup Database Tanggal <?echo date('d')?> Bulan <?echo date('m')?> Tahun <?echo date('Y')?>')" style="width:200px"><i class="fa fa-hdd-o"></i> &nbsp; Backup Sekarang!</button></td>
				                    		</tr>
				                    		<tr>
				                    			<td height="20px"></td>
				                    		</tr>
				                    	</table>
				                    </form>
				                    
			                        <table id="example1" class="table table-bordered table-hover" style="width:100%;padding-right:20px">
										<thead>
											<tr>
												<th><center>LAST BACKUP DATABASE</center></th>
												<th><center>STATUS</center></th>
												<th><center>RESTORE</center></th>
											</tr>
										</thead>
			                            <tbody>
			                        	<?
										$q2	 = mysql_query("SELECT * FROM tbl_bup ORDER BY id DESC");
										while($d2  = mysql_fetch_array($q2))
											{
			                            	$status = "<span class='btn btn-primary' style='padding:0px 10px;font-size:12px;'>Backup Sukses</span>";
			                        	?>
												<tr> 
													<td align='center'><?echo $d2[tgl]?></td>
													<td align='center'><?echo $status?></td>
													<td align='center'><a href="<?echo "?opt=$opt&menu=$menu&submenu=C&res=$d2[kode]"?>"><span class='btn btn-danger' style='padding:0px 10px;font-size:12px;' onclick="return confirm('Data Saat Ini Akan Otomatis Ter-Backup, Dan Akan Diperbarui Dengan Data Backup Yang Terpilih Untuk Di-Restore.')"><i class='fa fa-refresh'></i> Perbarui Database Dengan Data Backup Ini</span></a></td>
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
			                    </div><!-- /.box-body -->
			                </div><!-- /.box -->
			            </div>
			        </div>
				</section>
			</aside>
			
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
        </script>
<?
	}
?>